<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateUsersAPIRequest;
use App\Http\Requests\API\v1\UpdateUsersAPIRequest;
use App\Models\v1\Users;
use App\Repositories\v1\UsersRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\SendNotification;

/**
 * Class UsersController
 * @package App\Http\Controllers\API
 */

class UsersAPIController extends AppAPIv1BaseController
{
    /** @var  UsersRepository */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }


    public function index(Request $request)
    {
        $this->validate($request,[
            'tin' => 'required|regex:/^[0-9]{9}$/'
        ]);

        $users = $this->usersRepository->getUsersByTin($request->tin);
        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }


    public function store(CreateUsersAPIRequest $request)
    {
        $input = $request->all();

        $users = $this->usersRepository->create($input);

        return $this->sendResponse($users->toArray(), 'Users saved successfully');
    }

    /**
     * @OA\GET(
     *     path="/user/",
     *     operationId="/user/",
     *     tags={"Users"},
     *     @OA\Response(
     *         response="200",
     *         description="Users retrieved successfully",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */
    public function show()
    {
        /** @var Users $users */
        $users = $this->usersRepository->find(app('auth')->id());

        if (empty($users)) {
            return $this->sendError('Users not found');
        }

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/user/{id}",
     *     operationId="/user/{id}",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id юзера",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *     ),
     *     *@OA\Parameter(
     *         name="residential_address_user",
     *         in="query",
     *         description="Адрес проживания",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="home_tel_user",
     *         in="query",
     *         description="Номер домашнего телефона",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="mobile_user",
     *         in="query",
     *         description="Номер мобильного телефона",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="mobile_user",
     *         in="query",
     *         description="E-mail пользователя",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Users updated successfully",
     *     @OA\JsonContent(
     *             @OA\Items(
     *                  @OA\Property(
     *                      property="success",
     *                      type="string",
     *                      enum = {"true", "false"},
     *                      example="success"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *                      ref="#/components/schemas/Users"
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Contract retrieved successfully"
     *                  )
         *         ),
         *     ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this users."
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */
    public function update($id, Request $request)
    {
        $input = $this->validate($request, [
            'residential_address_user' => 'string',
            'home_tel_user' => 'regex:/^998[0-9]{9}$/',
            'mobile_user' => 'regex:/^998[0-9]{9}$/',
            'email_user' => 'email',
        ]);

        /** @var Users $users */
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            return $this->sendError('User not found');
        }

        if (Gate::denies('update-user', $users)) {
            abort(403, 'Unauthorized to update this users.');
        }

        $users = $this->usersRepository->update($input, $id);

        return $this->sendResponse($users->toArray(), 'Users updated successfully');
    }

    public function changePassword($pin)
    {

        /** @var Users $users */
        $user = $this->usersRepository->changePassword($pin);

        $phone_number = $user->mobile_user;

        return $this->sendResponse(substr_replace($phone_number,'*****',3,5), 'User updated successfully');
    }

}
