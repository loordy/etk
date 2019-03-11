<?php

namespace App\Http\Controllers\API\v1;

use App\Models\v1\Lc;
use App\Repositories\v1\LcRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\v1\PositionsRepository;
use App\Repositories\v1\StructuresRepository;
use Illuminate\Support\Facades\DB;
use App\Models\v1\Users;
use App\Services\v2\ExternalIndividAPIService as Individ;
use App\Services\v2\ExternalCompanyAPIService as Company;
use App\Models\v1\Kodp;
use App\Rules\CheckTypeInConstants;
use App\Rules\CheckTermSalaryInConstants;
use App\Rules\CheckRateInConstants;
use App\Helpers\CollectionHelpers;


/**
 * Class LcController
 * @package App\Http\Controllers\API
 */
class LcAPIController extends AppAPIv1BaseController
{
    /** @var  LcRepository */
    private $lcRepository;

    /**
     * LcAPIController constructor.
     * @param LcRepository $lcRepo
     */
    public function __construct(LcRepository $lcRepo)
    {
        $this->lcRepository = $lcRepo;
    }

    /**
     * @OA\POST(
     *     path="/contract/",
     *     operationId="/contract/",
     *     tags={"Contract"},
     *     @OA\Response(
     *         response="200",
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Lc"
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
     *         description="Unauthorized to create this lc"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/LcStore"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     *
     * )
     */
    /**/

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        //В этом методе мы можем создать только договор пока

        $input = $this->validate($request, [
            'pin_lc' => 'required|regex:/^[0-9]{14}$/',
            'passport_lc' => 'required|regex:/^[A-Z]{2}[0-9]{7}$/',
            'tin_lc' => 'required|regex:/^[0-9]{9}$/',
            'order_lc' => 'nullable|string',
            'salary_lc' => 'numeric',
            'article_lc' => 'nullable|string',
            'type_emp_lc' => ['integer', new CheckTypeInConstants],
            'id_position_lc' => 'required|integer',
            'date_order_lc' => 'date',
            'date_start_lc' => 'required|date',
            'term_salary_lc' => ['integer', new CheckTermSalaryInConstants],
            'value_fields_lc' => 'nullable|array',
            'main_work_lc' => 'required|boolean',
            'flag_bonus_lc' => 'boolean',
            'date_of_contract_lc' => 'required|date',
            'rate_lc' => ['numeric', new CheckRateInConstants],
        ]);


        //проверка фл из БД ФЛ

        $individ = Individ::getIndivid($input['passport_lc'], $input['pin_lc']);
        if (!$individ) {
            return $this->sendError('Individ not found', 404);
        }

        $input['name_person_lc'] = $individ['name_latin'];
        $input['middlename_person_lc'] = $individ['patronym_latin'];
        $input['family_person_lc'] = $individ['surname_latin'];
        $input['gender_lc'] = $individ['sex'] == 1 ? true : false;
        $input['tax_person_lc'] = $individ['military']['inn'];

        // тут проверка на ЮЛ

        $company = Company::getCompany($input['tin_lc']);

        if (!$company) {
            return $this->sendError('Company not found', 404);
        }

        $input['name_company_lc'] = $company['ACRON_UZ'];
        $input['regionent_lc'] = $company['SOATO_CD'];


        //Проверка позиций и принадлежность структуре

        $positionRepos = new PositionsRepository(app());
        if ($input['id_position_lc']) {
            $position = $positionRepos->findWithStruct($input['id_position_lc']);

            if (empty($position)) {
                return $this->sendError('Position not found', 404);
            }

            //Структура не принадлежит этой организации
            if ($position->tin_company_structure !== $request->user()->tin_company_user) {
                return $this->sendError('Unauthorized to use this structure', 403);
            }

            //Позиция закрыта
            if (!$position->status_open_position) {
                return $this->sendError('Position closed', 424);
            }
            //Проверка дат

//            if ($position->date_start_position && Carbon::parse($input['date_start_lc']) < $position->date_start_position) {
//                return $this->sendError('Contract begin date must be bigger then position begin date', 424);
//            }
//
//            if ($position->date_end_position && Carbon::parse($input['date_start_lc']) > $position->date_start_position) {
//                return $this->sendError('Contract start date must be lower then position end date', 424);
//            }
        }
        //Проверка main work
//        if ($input['main_work_lc']) {
//            if (!empty($this->lcRepository->getByMainWork($input['pin_lc'], $input['date_start_lc']))) {
//                return $this->sendError('U allready have main work', 424);
//            }
//        }

        $structuresRepo = new StructureRepository(app());
        $company = $structuresRepo->getStructureByTin($input['tin_lc'])->first();


        $input['regionent_lc'] = $company->region_structure;
        $input['name_position_lc'] = $position->name_position;
        $input['code_prof_lc'] = $position->code_prof_position;
        $input['code_prof_type_lc'] = $position->code_prof_type_position;
        $input['flag_bonus_lc'] = $input['flag_bonus_lc'] ?? $position->flag_bonus_position;
        $input['type_emp_lc'] = $input['type_emp_lc'] ?? $position->type_emp_position;
        $input['rate_lc'] = $input['rate_lc'] ?? $position->rate_position;
        $input['term_salary_lc'] = $input['term_salary_lc'] ?? $position->term_salary_position;
        $input['oked_lc'] = $company->oked_structure;

        $kodp = Kodp::where('pn', $input['code_prof_lc'])
            ->where('type', $input['code_prof_type_lc'])
            ->first();

        $input['code_nskz_lc'] = $kodp->nskz_code;
        $input['code_personal_category_lc'] = $kodp->personal_category;


        $input['type_lc'] = 1;


        $lc = $this->lcRepository->createStart($input);

        if ($lc === 403) {
            return $this->sendError('Unauthorized to create this lc', 403);
        }

        if ($lc === 400) {
            return $this->sendError('SMTH wrong', 400);
        }

        $users = Users::where('tax_person_user', $input['tax_person_lc'])
            //->where('tin_company_user', $input['tin_lc'])
            ->where('tin_company_user', '!=', null)
            ->get();

        foreach ($users as $user) {
            $user->fill(
                [
                    'soato_company_user' => $input['regionent_lc'],
                    'user_oked_user' => $input['oked_lc'],
                    'family_person_user' => $input['family_person_lc'],
                    'name_person_user' => $input['name_person_lc'],
                    'middlename_person_user' => $input['middlename_person_lc'],
                    'data_user' => $individ,
                ]
            );

            $user->save();
        };

        $user = Users::firstOrNew([
            'tax_person_user' => $input['tax_person_lc'],
            'tin_company_user' => null,

        ]);
        $user->fill([
            'family_person_user' => $input['family_person_lc'],
            'name_person_user' => $input['name_person_lc'],
            'middlename_person_user' => $input['middlename_person_lc'],
            'password' => app('hash')->make($input['pin_lc']),
            'pin_user' => $input['pin_lc'],
            'type_user' => 1,
            'data_user' => $individ
        ]);
        $user->save();


        return $this->sendResponse($lc->toArray(), 'Contract saved successfully');
    }

    /**
     * @OA\GET(
     *     path="/contract/{id}",
     *     operationId="getContractById",
     *     tags={"Contract"},
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
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Lc"
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
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
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
        // abort(404, 'Unauthorized action.');
        /** @var Lc $lc */
        $lc = $this->lcRepository->find($id);

        if (empty($lc)) {
            return $this->sendError('Contract not found');
        }

        return $this->sendResponse($lc->toArray(), 'Contract retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/workbook/{pin}",
     *     operationId="/workbook/{pin}",
     *     tags={"Contract"},
     *     @OA\Parameter(
     *         name="pin",
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
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="array",
     *     maxItems=20,
     *     @OA\Items(
     *     ref="#/components/schemas/Lc"
     * ),
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
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
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
     * @param $pin
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByPin($pin)
    {
        /** @var Lc $lc */
        $lc = $this->lcRepository->getByPin($pin);

        if (empty($lc)) {
            return $this->sendError('Workbook not found');
        }

        return $this->sendResponse($lc->toArray(), 'Workbook retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/workbook/{pin}/experience",
     *     operationId="/workbook/{pin}/experience",
     *     tags={"Contract"},
     *     @OA\Parameter(
     *         name="pin",
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
     *         description="Expirience retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="number",
     *     example=5,
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Expirience retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Workbook not found"
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**
     * @param $pin
     * @return \Illuminate\Http\JsonResponse
     */

    public function showExperienceByPin($pin)
    {
        /** @var Lc $lc */
        $lc = $this->lcRepository->getByPin($pin);

        if (empty($lc)) {
            return $this->sendError('Workbook not found');
        }

        $expirience = CollectionHelpers::getExpirience($lc);

        return $this->sendResponse($expirience, 'Experience retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/contracts/archive/{tin}",
     *     operationId="/contracts/archive/{tin}",
     *     tags={"Contract"},
     *     @OA\Parameter(
     *         name="tin",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     * @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date values that needed to be considered for filter",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="date",
     *         )
     *     ),
     *      @OA\Response(
     *         response="200",
     *         description="Contracts retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="array",
     *     maxItems=20,
     *     @OA\Items(
     *     ref="#/components/schemas/Lc"
     * ),
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contracts retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
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
     * @param $pin
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByTinArchive($tin, Request $request)
    {
        $input = $this->validate($request, [
            'date' => 'date'
        ]);
        /** @var Lc $lc */
        $lc = $this->lcRepository->getByTinArchive($tin, $input['date'] ?? null);

        if (empty($lc)) {
            return $this->sendError('Workbook not found');
        }

        return $this->sendResponse($lc->toArray(), 'Workbook retrieved successfully');
    }


    /**
     * @OA\GET(
     *     path="/contracts/{tin}",
     *     operationId="/contracts/{tin}",
     *     tags={"Contract"},
     *     @OA\Parameter(
     *         name="tin",
     *         in="path",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *      @OA\Response(
     *         response="200",
     *         description="Contracts retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="array",
     *     maxItems=20,
     *     @OA\Items(
     *     ref="#/components/schemas/Lc"
     * ),
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contracts retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
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
     * @param $tin
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByTin($tin)
    {
        /** @var Lc $lc */
        $lc = $this->lcRepository->getByTin($tin);

        if (empty($lc)) {
            return $this->sendError('Contracts not found');
        }

        return $this->sendResponse($lc->toArray(), 'Contracts retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/person/{pin}",
     *     operationId="/person/{pin}",
     *     tags={"Contract"},
     *     @OA\Parameter(
     *         name="pin",
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
     *         description="Persons workbook retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Lc"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Persons workbook retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
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
     * @param $pin
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPerson($pin)
    {
        /** @var Lc $lc */
        $lc = $this->lcRepository->getByPin($pin);

        if (empty($lc)) {
            return $this->sendError('Workbook not found');
        }

        return $this->sendResponse($lc->toArray(), 'Workbook retrieved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/contract/{id}",
     *     operationId="/contracts/{id}",
     *     tags={"Contract"},
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
     *         description="Contract updated successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Lc"
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
     *         description="Unauthorized to update this lc"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/LcUpdate"},
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
            'order_lc' => 'nullable|string',
            'date_order_lc' => 'date',
            'salary_lc' => 'numeric',
            'article_lc' => 'nullable|string',
            'type_emp_lc' => ['integer', new CheckTypeInConstants],
            //TODO пока нельзя сменить позицию
            //'id_position' => 'nullable|integer',
            'date_start_lc' => 'date_format:Y-m-d',
            'term_salary_lc' => ['integer', new CheckTermSalaryInConstants],
            'value_fields_lc' => 'nullable|array',
            'main_work_lc' => 'boolean',
            'date_of_contract_lc' => 'date_format:Y-m-d',
            'rate_lc' => ['numeric', new CheckRateInConstants],
        ]);

        $lc = $this->lcRepository->updateStart($input, $id);

        if ($lc === 404) {
            return $this->sendError('lc start not found', 404);
        }

        if ($lc === 403) {
            return $this->sendError('Unauthorized to update this lc', 403);
        }


        return $this->sendResponse($lc, 'Contract updated successfully');
    }

    /**
     * @OA\DELETE(
     *     path="/contract/{id}",
     *     operationId="/contract/{id}",
     *     tags={"Contract"},
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Идентификатор ТД",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *@OA\Parameter(
     *         name="date_end_lc",
     *         in="query",
     *         description="Дата конца ТД",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="date",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="article_lc",
     *         in="query",
     *         description="Статья",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="order_lc",
     *         in="query",
     *         description="Приказ",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="date_order_lc",
     *         in="query",
     *         description="Дата приказа",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="date",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Contract stoped successfully",
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
     *     example="Contract stoped successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this lc"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/Contract"},
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
    public function stop($id, Request $request)
    {
        $input = $this->validate($request, [
            'date_end_lc' => 'required|date_format:Y-m-d',
            'article_lc' => 'string',
            'order_lc' => 'string',
            'date_order_lc' => 'date',
        ]);


        $lc = $this->lcRepository->stop($input, $id);

        if ($lc === 404) {
            return $this->sendError('lc start not found', 404);
        }

        if ($lc === 403) {
            return $this->sendError('Unauthorized to update this lc', 403);
        }


        return $this->sendResponse([], 'Contract stoped successfully');
    }

    /**
     * @OA\GET(
     *     path="/contractsbystruct/{id_struct}",
     *     operationId="/contractsbystruct/{id_struct}",
     *     tags={"Contract"},
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
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/Lc"
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
    /**
     * @param $id_struct
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByStructure($id_struct, Request $request)
    {
        $input = $request->json()->all();

        $lc = $this->lcRepository->getByStructure($id_struct);

        $lc = $lc->toArray();

        foreach ($lc as $key => $value) {

            if (is_null($value['id_position']))
                unset($lc[$key]);

        }

        return $this->sendResponse($lc, 'Contracts by structure id retrived successfully');
    }

    /**
     * @OA\GET(
     *     path="/company/{tin}/statistic",
     *     operationId="/company/{tin}/statistic",
     *     tags={"Company"},
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
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="object",
     *     @OA\Property(
     *     property="tin_company_structure",
     *     type="integer",
     *     example=123456789
     *     ),
     *     @OA\Property(
     *     property="total_positions",
     *     type="integer",
     *     example=4),
     *     @OA\Property(
     *     property="total_active_contracts",
     *     type="integer",
     *     example=3),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_1",
     *     type="integer",
     *     example=3),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_2",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_3",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_4",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_5",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_6",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_type_emp_7",
     *     type="integer",
     *     example=0),
     *     @OA\Property(
     *     property="active_contracts_in_gender_male",
     *     type="integer",
     *     example=2),
     *     @OA\Property(
     *     property="active_contracts_in_gender_female",
     *     type="integer",
     *     example=1),
     *     @OA\Property(
     *     property="total_rates",
     *     type="integer",
     *     example=5.00),
     *     @OA\Property(
     *     property="closed_rates",
     *     type="integer",
     *     example=2.25),
     *     @OA\Property(
     *     property="total_contracts",
     *     type="integer",
     *     example=3),
     * ),
     * @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Statistic retrived successfully")
     *     )
     * )
     * ),
     *
     *     )
     *         ),
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    public function getStatistic($tin)
    {

        $lc = $this->lcRepository->getStatistic($tin);

        return $this->sendResponse($lc, 'Statistic retrived successfully');
    }
}
