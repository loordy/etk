<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 18.02.2019
 * Time: 12:45
 */

namespace App\Validators;


use App\Models\v2\Transaction;
use App\Repositories\v2\TransactionRepository;
use Illuminate\Support\Facades\Gate;

/**
 * Class KodpValidator
 * @package App\Validators
 */
class TransactionValidator extends BaseValidator
{
    /**
     * @var Transaction
     */
    private $model;


    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    public function validateCheckMainWorkExistsByPin($attribute, $value, $parameters, $validator)
    {
        if ($value) {
            if ($this->checkOnValid($parameters, $validator)) {
                return false;
            };


            $pin = $this->getValue($validator->getData(), $parameters[0]);

            return $this->model->where('person_pin', $pin)->count() === 0;
        }
        return true;

    }

    public function validateTransactionExistAndNotApproved ($attribute, $value, $parameters, $validator){
        /** @var Transaction $transaction */
        $transaction = $this->model->findOrFail($value);

        if($transaction->mark_confirmation){
            return false;
        }


        return Gate::allows('approveTransaction',$transaction);

    }


}