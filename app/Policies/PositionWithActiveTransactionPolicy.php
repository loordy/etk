<?php

namespace App\Policies;

use App\Models\v2\PositionWithActiveTransaction;

use App\Models\v2\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionWithActiveTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  User  $user
     * @param  PositionWithActiveTransaction  $pwat
     * @return mixed
     */
    public function view(User $user, PositionWithActiveTransaction $pwat)
    {
        return $pwat->company_tin === $user->company_tin;
    }


    /**
     * Determine whether the user can use the position.
     *
     * @param  User  $user
     * @param  PositionWithActiveTransaction  $position
     * @return mixed
     */
    public function use(User $user, PositionWithActiveTransaction $position)
    {
        return $position->company_tin === $user->company_tin;
    }
}
