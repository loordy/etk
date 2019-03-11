<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\Constant;

/**
 * Class ConstantValidator
 * @package App\Validators
 */
class ConstantValidator extends BaseValidator
{
    /**
     * @var Constant
     */
    private $model;

    /**
     * KodpValidator constructor.
     * @param Constant $constant
     */
    public function __construct(Constant $constant)
    {
        $this->model = $constant;
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateRate($attribute, $value, $parameters, $validator)
    {
        return in_array($value, $this->model->where('code','rates')->first()->value_ru);
    }


    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validateTermsOfPayment($attribute, $value, $parameters, $validator)
    {
        return array_key_exists($value,$this->model->where('code','CondLab')->first()->value_ru);
    }


    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validateEmploymentType($attribute, $value, $parameters, $validator)
    {
        return array_key_exists($value,$this->model->where('code','TypeEmp')->first()->value_ru);
    }

    /**
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     * @return string
     */
    public function message($message, $attribute, $rule, $parameters)
    {

        return 'The ' . $attribute . ' didn`t pass ' . $rule . ' rule';

    }


}