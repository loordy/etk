<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 17:28
 */

namespace App\Validators;


use Illuminate\Support\Arr;
use Illuminate\Validation\Validator;

/**
 * Class BaseValidator
 * @package App\Validators
 */
abstract class BaseValidator
{

    /**
     * @param array $parameters
     * @param Validator $validator
     * @return bool
     */
    protected function checkOnValid(array $parameters, Validator $validator)
    {
        if (!empty(array_intersect($parameters, array_keys($validator->failed())))) {
            return true;
        }

        return false;
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

        return 'The ' . $attribute . ' didn`t pass ' . $rule . ' rule with parameters: ' . implode(", ", $parameters) . '';

    }

    /**
     * Get the value of a given attribute.
     *
     * @param  string  $attribute
     * @return mixed
     */
    protected function getValue($data, $attribute)
    {
        return Arr::get($data, $attribute);
    }
}