<?php

namespace App\Policies;

use App\Models\v2\Position;
use App\Models\v2\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function view(User $user, Position $position)
    {
        return $position->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can create positions.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function update(User $user, Position $position)
    {
        return $position->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can delete the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function delete(User $user, Position $position)
    {
        return $position->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can use the position.
     *
     * @param  User  $user
     * @param  Position  $position
     * @return mixed
     */
    public function use(User $user, Position $position)
    {
        return $position->company_tin === $user->company_tin;
    }
}
