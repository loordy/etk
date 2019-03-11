<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class CompanyValidator
 * @package App\Validators
 */
class CompanyValidator extends BaseValidator
{
    /**
     * @var Company
     */
    private $model;

    /**
     * CompanyValidator constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;

    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateCompany($attribute, $value, $parameters, $validator)
    {

        if($value === Auth::user()->$attribute){
            return true;
        }
        $company = $this->model->findOrFail($value);

        return Gate::allows('use',$company);

    }



}