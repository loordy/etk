<?php

namespace App\Http\Controllers\API\v2;

use App\Models\v2\User;
use Illuminate\Http\Request;


/**
 * Class UsersAPIController
 * @package App\Http\Controllers\API
 */
class UsersAPIController extends BaseAPIController
{
    /** @var  User */
    private $model;

    /**
     * UsersAPIController constructor.
     * @param User $users
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $input = $this->validate($request, [
            'company_tin' => 'bail|required|regex:/^[0-9]{9}$/|company',
        ]);

        $users = $this->findWhere($this->model,$input);
        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');


    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        /** @var User $user */
        $user = $this->model->findOrFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        /** @var User $user */
        $user = app('auth')->user();
        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * @param $pin
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword($pin)
    {

        /** @var User $users */
        $user = $this->model->changePassword($pin);

        $phone_number = $user->mobile_phone;

        return $this->sendResponse(substr_replace($phone_number,'*****',3,5), 'User updated successfully');
    }

}
