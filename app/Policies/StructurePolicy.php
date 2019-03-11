<?php

namespace App\Policies;

use App\Models\v2\Structure;
use App\Models\v2\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StructurePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the structure.
     *
     * @param  User  $user
     * @param  Structure  $structure
     * @return mixed
     */
    public function view(User $user, Structure $structure)
    {
        return $structure->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can create structures.
     *
     * @param  User  $user
     * @param  Structure  $structure
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the structure.
     *
     * @param  User  $user
     * @param  Structure  $structure
     * @return mixed
     */
    public function update(User $user, Structure $structure)
    {
        return $structure->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can delete the structure.
     *
     * @param  User  $user
     * @param  Structure  $structure
     * @return mixed
     */
    public function delete(User $user, Structure $structure)
    {
        return $structure->company_tin === $user->company_tin;
    }

    /**
     * Determine whether the user can use the structure.
     *
     * @param  User  $user
     * @param  Structure  $structure
     * @return mixed
     */
    public function use(User $user, Structure $structure)
    {
        return $structure->company_tin === $user->company_tin;
    }

}
