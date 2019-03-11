<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Helpers\ModelHelpers;
use App\Models\v2\Kodp;

/**
 * Class KodpValidator
 * @package App\Validators
 */
class KodpValidator extends BaseValidator
{
    /**
     * @var Kodp
     */
    private $model;

    /**
     * KodpValidator constructor.
     * @param Kodp $kodpRepository
     */
    public function __construct(Kodp $kodp)
    {
        $this->model = $kodp;

    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validateKodp($attribute, $value, $parameters, $validator)
    {

        if ($this->checkOnValid($parameters, $validator)) {
            return false;
        };

        $type = $this->getValue($validator->getData(),$parameters[0]);

        $conditions = [
            'type' => $type,
            'pn' => $value
        ];

        return ModelHelpers::findWhere($this->model, $conditions)->count() === 1;

    }



}