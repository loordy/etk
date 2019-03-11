<?php

namespace App\Http\Controllers\API\v2;

use App\Models\v2\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class CompaniesController
 * @package App\Http\Controllers\API
 */
class CompaniesAPIController extends BaseAPIController
{
    /** @var  Company */
    private $model;

    /**
     * CompaniesAPIController constructor.
     * @param Company $companies
     */
    public function __construct(Company $companies)
    {
        $this->model = $companies;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    //TODO обсудить что делать со списком
//    public function index(Request $request)
//    {
//        $input = $this->validate($request, [
//            'company_tin' => ['bail', 'required', 'regex:/^[0-9]{9}$/', new CompanyExistsAndAuthorize],
//        ]);
//
//        $this->model->conditions = $input;
//        $positions = $this->model->all();
//        return $this->sendResponse($positions->toArray(), 'Companies retrieved successfully');
//
//
//    }


    /**
     * @param $tin
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($tin)
    {

        /** @var Company $company */
        $company = $this->model->findOrFail($tin);
        $this->authorize('view', $company);
        return $this->sendResponse($company->toArray(), 'Company retrieved successfully');
    }


    public function statistic($tin){

        $company = $this->model->findOrFail($tin);

        $this->authorize('view', $company);

        $statistic = DB::select("
        select 
company_tin as tin,
SUM(CASE WHEN transaction_id is null then 1 else 0 END) as open_positions, 
SUM(CASE WHEN id is not null then 1 else 0 END) as total_positions,
SUM(CASE WHEN transaction_id is not null then 1 else 0 END) as closed_positions,
SUM(CASE WHEN transaction_id is not null and person_sex = true then 1 else 0 END) as workers_in_sex_male,
SUM(CASE WHEN transaction_id is not null and person_sex = true then 1 else 0 END) as workers_in_sex_female,
SUM(CASE WHEN transaction_id is not null and contract_type = 1 then 1 else 0 END) as contract_type_1,
SUM(CASE WHEN transaction_id is not null and contract_type = 2 then 1 else 0 END) as contract_type_2,
SUM(CASE WHEN transaction_id is not null and contract_type = 3 then 1 else 0 END) as contract_type_3,
SUM(CASE WHEN transaction_id is not null and contract_type = 4 then 1 else 0 END) as contract_type_4,
SUM(CASE WHEN transaction_id is not null and contract_type = 5 then 1 else 0 END) as contract_type_5,
SUM(CASE WHEN transaction_id is not null and contract_type = 6 then 1 else 0 END) as contract_type_6,
SUM(CASE WHEN transaction_id is not null and contract_type = 7 then 1 else 0 END) as contract_type_7


from positions_with_active_transaction
where company_tin = '".$company->tin."'
group by company_tin

        ");

        return $this->sendResponse($statistic, 'Company statistic retrieved successfully');
    }


}
