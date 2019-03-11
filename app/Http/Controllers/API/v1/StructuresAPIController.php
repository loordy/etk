<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateStructuresAPIRequest;
use App\Http\Requests\API\v1\UpdateStructuresAPIRequest;
use App\Models\v1\Structures;
use App\Repositories\v1\StructuresRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class StructuresController
 * @package App\Http\Controllers\API
 */
class StructuresAPIController extends AppAPIv1BaseController
{
    /** @var  StructureRepository */
    private $structuresRepository;

    /**
     * StructuresAPIController constructor.
     * @param StructureRepository $structuresRepo
     */
    public function __construct(StructuresRepository $structuresRepo)
    {
        $this->structuresRepository = $structuresRepo;
    }

    /**
     * @OA\POST(
     *     path="/structures/",
     *     operationId="/structures/",
     *     tags={"Structure"},
     *     @OA\Response(
     *         response="200",
     *         description="Structure saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Structures"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to create this structure"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Parent structure not found"
     *     ),
     *     @OA\Response(
     *         response=424,
     *         description="SMTH wrong with dates"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/StructuresStore"},
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
            'parent_id_structure' => 'required|integer',
            'name_structure' => 'required|string',
            'date_end_structure' => 'nullable|date|after:date_start_structure',
            'date_start_structure' => 'required|date',
        ]);

        $structures = $this->structuresRepository->create($input);


        if ($structures === 404) {
            return $this->sendError('Parent structure not found', 404);
        }

        if ($structures === 403) {
            return $this->sendError('Unauthorized to create this structure', 403);
        }

        if ($structures === 424) {
            return $this->sendError('SMTH wrong with dates', 424);
        }

        return $this->sendResponse($structures->toArray(), 'Department saved successfully');
    }

    /**
     * @OA\GET(
     *     path="/structure/{id}",
     *     operationId="/structure/",
     *     tags={"Structure"},
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
     *         description="Structure saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Structures"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to show this structure"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Structure not found"
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    public function show($id)
    {
        /** @var Structures $structures */
        $structures = $this->structuresRepository->find($id);

        if ($structures === 404) {
            return $this->sendError('Department not found', 404);
        }

        if ($structures === 403) {
            return $this->sendError('Unauthorized to show this structure', 403);
        }

        return $this->sendResponse($structures->toArray(), 'Department retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/structures/{tin}",
     *     operationId="/structures/{tin}",
     *     tags={"Structure"},
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
     *         description="Structure saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Structures"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract retrieved successfully")
     *     )
     *         ),
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    public function showByTin($tin)
    {
        /** @var Structures $structures */
        $structures = $this->structuresRepository->getStructureByTin($tin);

        if (empty($structures)) {
            return $this->sendError('Department not found');
        }

        return $this->sendResponse($structures->toArray(), 'Department retrieved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/structure/{id}",
     *     operationId="/structure/{id}",
     *     tags={"Structure"},
     *         @OA\Parameter(
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
     *         description="Structure updated successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Structures"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract updated successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this structure"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Parent structure not found"
     *     ),
     *     @OA\Response(
     *         response=424,
     *         description="SMTH wrong with dates"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/StructuresUpdate"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)
    {
        $input = $this->validate($request, [
            'parent_id_structure' => 'required|integer',
            'name_structure' => 'required|string',
            'date_end_structure' => 'nullable|date|after:date_start_structure',
            'date_start_structure' => 'required|date',
        ]);

        $structures = $this->structuresRepository->update($input, $id);

        if ($structures === 404) {
            return $this->sendError('Parent structure not found', 404);
        }

        if ($structures === 403) {
            return $this->sendError('Unauthorized to update this structure', 403);
        }

        if ($structures === 424) {
            return $this->sendError('SMTH wrong with dates', 424);
        }

        return $this->sendResponse($structures->toArray(), 'Department updated successfully');
    }

    /**
     * @OA\DELETE(
     *     path="/structure/{id}",
     *     operationId="/structure/{id}",
     *     tags={"Structure"},
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *@OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="date",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Structure stoped successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Structure stoped successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this structure"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Parent structure not found"
     *     ),
     *     @OA\Response(
     *         response=424,
     *         description="SMTH wrong with dates"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/StructuresDestroy"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    public function destroy($id, Request $request)
    {
        /** @var Structures $structures */


        $structures = $this->structuresRepository->delete($id);

        if ($structures === 404) {
            return $this->sendError('Parent structure not found', 404);
        }

        if ($structures === 403) {
            return $this->sendError('Unauthorized to update this structure', 403);
        }

        if ($structures === 424) {
            return $this->sendError('SMTH wrong with dates', 424);
        }


        return $this->sendResponse($id, 'Department deleted successfully');
    }

    /**
     * @OA\GET(
     *     path="/company/{tin}",
     *     operationId="/company/{tin}",
     *     tags={"Company"},
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
     *         description="Structure saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Structures"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract retrieved successfully")
     *     )
     *         ),
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    public function detailTin($tin)
    {
        /** @var Structures $structures */
        $structures = $this->structuresRepository->getStructureByTin($tin);

        if ($structures->isEmpty()) {
            return $this->sendError('Department not found');
        }

        return $this->sendResponse($structures->toArray()[0], 'Department retrieved successfully');
    }
}
