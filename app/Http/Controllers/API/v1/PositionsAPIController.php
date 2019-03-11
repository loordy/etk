<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreatePositionsAPIRequest;
use App\Http\Requests\API\v1\UpdatePositionsAPIRequest;
use App\Models\v1\Positions;
use App\Repositories\v1\PositionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use App\Models\v1\Kodp;
use App\Rules\CheckTypeInConstants;
use App\Rules\CheckRateInConstants;
use App\Rules\CheckTermSalaryInConstants;

/**
 * Class PositionsController
 * @package App\Http\Controllers\API
 */
class PositionsAPIController extends AppAPIv1BaseController
{
    /** @var  PositionsRepository */
    private $positionsRepository;

    /**
     * PositionsAPIController constructor.
     * @param PositionsRepository $positionsRepo
     */
    public function __construct(PositionsRepository $positionsRepo)
    {
        $this->positionsRepository = $positionsRepo;
    }

    /**
     * @OA\POST(
     *     path="/position/",
     *     operationId="/position/",
     *     tags={"Position"},
     *     @OA\Response(
     *         response="200",
     *         description="Position saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     type="object",
     *     property="data",
     *     ref="#/components/schemas/Positions"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Position retrieved successfully")
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to save this position"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Parent position not found"
     *     ),
     *     @OA\Response(
     *         response=424,
     *         description="SMTH wrong with dates"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/PositionsStore"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     *
     * )
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'id_structure_position' => 'required|integer',
            'name_position' => 'required|string',
            'date_end_position' => 'nullable|date|after:date_start_position',
            'date_start_position' => 'required|date',
            'requirements_position' => 'nullable|string',
            'form_position' => 'nullable|integer',
            'code_prof_position' => 'required|string',
            'code_prof_type_position' => 'required|string|in:w,e',
            'flag_bonus_position' => 'boolean',
            'type_emp_position' => ['required','integer', new CheckTypeInConstants],
            'salary_position' => 'required|numeric',
            'duties_position' => 'nullable|string',
            'conditions_position' => 'nullable|string',
            'rate_position' => ['numeric', new CheckRateInConstants],
            'term_salary_position' => ['integer', new CheckTermSalaryInConstants],

        ]);

        $kodp = Kodp::where('pn',$input['code_prof_position'])
            ->where('type',$input['code_prof_type_position'])
            ->first();

        if(!$kodp){
            return $this->sendError('Kodp not found', 404);
        }

        $input['tmp_name_ru_position'] = $kodp->name_ru;
        $input['tmp_name_uz_position'] = $kodp->name_uz;
        $input['tmp_nskz_code_position'] = $kodp->nskz_code;
        $input['tmp_min_education_position'] = $kodp->min_education;
        $input['tmp_personal_category_position'] = $kodp->personal_category;

        $positions = $this->positionsRepository->create($input);

        if ($positions === 404) {
            return $this->sendError('Parent structure not found', 404);
        }

        if ($positions === 403) {
            return $this->sendError('Unauthorized to save this position', 403);
        }

        if ($positions === 424) {
            return $this->sendError('SMTH wrong with dates', 424);
        }

        return $this->sendResponse($positions->toArray(), 'Position saved successfully');
    }

    /**
     * @OA\GET(
     *     path="/position/{id}",
     *     operationId="/position/",
     *     tags={"Position"},
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Position saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Positions"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Position retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Position not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Positions $positions */

        $positions = $this->positionsRepository->find($id);

        if ($positions === 404) {
            return $this->sendError('Position not found');
        }

        if ($positions === 403) {
            return $this->sendError('No permission to show this position');
        }

        return $this->sendResponse($positions->toArray(), 'Position retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/positions/{tin}",
     *     operationId="/positions/{tin}",
     *     tags={"Position"},
     *   @OA\Parameter(
     *         name="tin",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Position saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Positions"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Position retrieved successfully")
     *     )
     *         ),
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $id_struct
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByOrgStruct($id_struct)
    {
        /** @var Positions $positions */
        $positions = $this->positionsRepository->getByOrgStruct($id_struct);

        if (empty($positions)) {
            return $this->sendError('Position not found');
        }

        return $this->sendResponse($positions->toArray(), 'Position retrieved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/position/{id}",
     *     operationId="/position/{id}",
     *     tags={"Position"},
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Position saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Positions"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Position retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this position"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Parent structure not found"
     *     ),
     *     @OA\Response(
     *         response=424,
     *         description="SMTH wrong with dates"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/PositionsUpdate"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $id
     * @param UpdatePositionsAPIRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)
    {
        $input = $this->validate($request, [
            'id_structure_position' => 'integer',
            'name_position' => 'string',
            'date_end_position' => 'nullable|date|after:date_start_structure',
            'date_start_position' => 'date',
            'requirements_position' => 'nullable|string',
            'form_position' => 'nullable|integer',
            'code_prof_position' => 'required_with:code_prof_type_position|string',
            'code_prof_type_position' => 'required_with:code_prof_position|string|in:w,e',
            'flag_bonus_position' => 'boolean',
            'type_emp_position' => ['integer', new CheckTypeInConstants],
            'salary_position' => 'numeric',
            'duties_position' => 'string',
            'conditions_position' => 'string',
            'rate_position' => ['numeric', new CheckRateInConstants],
            'term_salary_position' => ['integer', new CheckTermSalaryInConstants],
        ]);
        if(isset($input['code_prof_position']) and isset($input['code_prof_type_position'])) {
            $kodp = Kodp::where('pn', $input['code_prof_position'])
                ->where('type', $input['code_prof_type_position'])
                ->first();

            if (!$kodp) {
                return $this->sendError('Kodp not found', 404);
            }
        }

        $positions = $this->positionsRepository->update($input, $id);

        if ($positions === 404) {
            return $this->sendError('Parent structure not found', 404);
        }

        if ($positions === 403) {
            return $this->sendError('Unauthorized to update this position', 403);
        }

        if ($positions === 424) {
            return $this->sendError('SMTH wrong with dates', 424);
        }

        return $this->sendResponse($positions->toArray(), 'Position updated successfully');

    }

    /**
     * @OA\DELETE(
     *     path="/position/{id}",
     *     operationId="/position/{id}",
     *     tags={"Position"},
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Position saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Positions"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Position retrieved successfully")
     *     )
     *         ),
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/PositionsDestroy"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $positions = $this->positionsRepository->delete($id);

        if ($positions === 404) {
            return $this->sendError('Position not found');
        }

        if ($positions === 403) {
            return $this->sendError('U cant delete this position');
        }

        return $this->sendResponse($id, 'Position deleted successfully');
    }
}
