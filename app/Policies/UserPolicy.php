<?php

namespace App\Policies;

use App\Models\v2\User;
use App\Repositories\v2\UserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    private $repository;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  User $user
     * @param  User $user_cur
     * @return mixed
     */
    public function view(User $user, User $user_cur)
    {
        return $user->id === $user_cur->id;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  User $user
     * @param  User|string $user_cur
     * @return mixed
     */
    public function update(User $user, $user_cur)
    {
        if(!$user_cur instanceof User){
            $user_cur = $this->repository->find($user_cur);
        }

        return $user->id === $user_cur->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  User $user
     * @param  User $user_cur
     * @return mixed
     */
    public function delete(User $user, User $user_cur)
    {
        return $user->id === $user_cur->id;
    }

    /**
     * Determine whether the user can use the user.
     *
     * @param  User $user
     * @param  User $user_cur
     * @return mixed
     */
    public function use(User $user, User $user_cur)
    {
        return $user->id === $user_cur->id;
    }

    /**
     * Determine whether the user can update the users active attribute.
     *
     * @param  User $user
     * @param  User $user_cur
     * @return mixed
     */
    public function updateActive(User $user, User $user_cur)
    {
        return !empty($user->company_tin) && $user->company_tin === $user_cur->company_tin;
    }




}
