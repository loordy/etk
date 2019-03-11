<?php

namespace App\Http\Controllers\API\v1;


use Illuminate\Http\Request;
use App\Repositories\v1\ReportsRepository;


class ReportsAPIController extends AppAPIv1BaseController
{


    private $reportsRepository;


    public function __construct(ReportsRepository $reportsRepo)
    {
        $this->authorize('reports');
        $this->reportsRepository = $reportsRepo;
    }

    /**
     * @OA\GET(
     *     path="/reports/base",
     *     operationId="//reports/base",
     *     tags={"Reports"},
     *     @OA\Response(
     *         response="200",
     *         description="Statistic retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="object",
     *     @OA\Property(
     *     property="tin",
     *     type="integer",
     *     example=123456789
     *     ),
     *     @OA\Property(
     *     property="company_name",
     *     type="string",
     *     example="Roga&Kopita"
     *     ),
     *     @OA\Property(
     *     property="total_contracts",
     *     type="integer",
     *     example=3),
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
     * ),
     * @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Statistic retrieved successfully")
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
    public function getStatistic($soato){
        $statistic = $this->reportsRepository->getStatistic($soato);

        return $this->sendResponse($statistic, 'Statistic retrieved successfully');
    }

    /**
     * @OA\GET(
     *     path="/reports/basebysoato",
     *     operationId="/reports/basebysoato",
     *     tags={"Reports"},
     *		@OA\Parameter(
     *         name="soato",
     *         in="query",
     *         description="СОАТО региона",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Statistic retrieved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     type="object",
     *     @OA\Property(
     *     property="soato",
     *     type="string",
     *     example="1726"
     *     ),
     *     @OA\Property(
     *     property="company_count",
     *     type="string",
     *     example="10"),
     *     @OA\Property(
     *     property="workplaces",
     *     type="string",
     *     example="54"),
     *     @OA\Property(
     *     property="vacancies",
     *     type="string",
     *     example="17"),
     *     @OA\Property(
     *     property="total_rates",
     *     type="string",
     *     example="48.75"),
     *     @OA\Property(
     *     property="vacant_rates",
     *     type="string",
     *     example="17.00"),
     *     @OA\Property(
     *     property="employed",
     *     type="string",
     *     example="37"),
     *     @OA\Property(
     *     property="active_contracts_in_gender_male",
     *     type="string",
     *     example="32"),
     *     @OA\Property(
     *     property="active_contracts_in_gender_female",
     *     type="string",
     *     example="5")
     * ),
     * @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Statistic retrieved successfully")
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
    public function getStatisticBySoato(Request $request){

        $input = $this->validate($request, [
            'soato' => ['integer', 'max:9999999','exists:soato,code'],
        ]);

        $soato = isset($input['soato']) ? $input['soato'] . '' : '17';

        $statistic = $this->reportsRepository->getStatisticBySoato( $soato );

        return $this->sendResponse($statistic, 'Statistic retrieved successfully');
    }

}
