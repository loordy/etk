<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\Position;
use App\Models\v2\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class PositionValidator
 * @package App\Validators
 */
class PositionValidator extends BaseValidator
{
    /**
     * @var Position
     */
    private $model;

    /**
     * PositionValidator constructor.
     * @param Position $position
     */
    public function __construct(Position $position)
    {
        $this->model = $position;

    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    public function validatePosition($attribute, $value, $parameters, $validator)
    {
        $id = $parameters[1] ?? null;
        unset($parameters[1]);

        if ($this->checkOnValid($parameters, $validator)) {
            return false;
        };
        /** @var Position $position */
        $position = $this->model->findOrFail($value);

        if(Gate::denies('use',$position)){
            return false;
        }

        $date_start = $this->getValue($validator->getData(), $parameters[0]);


        /** @var Transaction $statusOpen */
        $statusOpen = $position->ActiveTransactionOnDate($date_start)->first();

        if(!is_null($statusOpen) and $statusOpen->id != $id){
            return false;
        };

        return true;

    }



}