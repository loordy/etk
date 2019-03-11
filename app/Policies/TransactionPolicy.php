<?php

namespace App\Policies;

use App\Models\v2\Transaction;
use App\Models\v2\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can create Transactions.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->active;
    }

    /**
     * Determine whether the user can update the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function update(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can delete the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function delete(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can use the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function use(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }


    /**
     * Determine whether the user can use the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function approveTransaction(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin || $transaction->person_pin === $user->person_pin;
    }

    /**
     * Determine whether the user can mistake the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function mistake(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }


    /**
     * Determine whether the user can improve the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function improve(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }


    /**
     * Determine whether the user can stop the Transaction.
     *
     * @param  User  $user
     * @param  Transaction  $transaction
     * @return mixed
     */
    public function stop(User $user, Transaction $transaction)
    {
        return $transaction->company_tin === $user->company_tin;
    }

}
