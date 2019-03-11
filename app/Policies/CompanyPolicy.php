<?php

namespace App\Policies;

use App\Models\v2\Company;
use App\Models\v2\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
     * Determine whether the user can view the company.
     *
     * @param  User  $user
     * @param  Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
        return $company->tin === $user->company_tin;
    }


    /**
     * Determine whether the user can view the company.
     *
     * @param  User  $user
     * @param  Company  $company
     * @return mixed
     */
    public function use(User $user, Company $company)
    {
        return $company->tin === $user->company_tin;
    }
}
