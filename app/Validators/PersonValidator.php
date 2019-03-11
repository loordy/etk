<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Services\External\ExternalIndividAPIService as Individ;

/**
 * Class PersonValidator
 * @package App\Validators
 */
class PersonValidator extends BaseValidator
{


    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validatePerson($attribute, $value, $parameters, $validator)
    {

        if ($this->checkOnValid($parameters, $validator)) {
            return false;
        };

        $pin = $this->getValue($validator->getData(),$parameters[0]);

        $individ = Individ::getIndivid($value, $pin);

        if (!$individ) {
            return false;
        }

        return true;

    }



}