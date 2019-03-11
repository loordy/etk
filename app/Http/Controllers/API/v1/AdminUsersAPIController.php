<?php

namespace App\Http\Controllers\API\v1;

use App\Models\v1\Users;
use Illuminate\Http\Request;
use App\Services\External\ExternalIndividAPIService as Individ;


class AdminUsersAPIController extends AppAPIv1BaseController
{

    private $model;


    public function __construct(Users $users)
    {
        $this->authorize('su');
        $this->model = $users;

    }

    /**
     * @OA\GET(
     *     path="/admin/users",
     *     operationId="/admin/users/index",
     *     tags={"Admin Users"},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Users retrieved successfully",
     *     @OA\JsonContent(
     *             @OA\Items(
     *                  @OA\Property(
     *                      property="success",
     *                      type="string",
     *                      enum = {"true", "false"},
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *						type="object",
     *                      @OA\Property(
     *     						property="id_user",
     *     						type="integer",
     *     						example=777
     *     					),
     *                      @OA\Property(
     *     						property="active_user",
     *     						type="boolean",
     *     						example=true
     *     					),
     *                      @OA\Property(
     *     						property="type_user",
     *     						type="number",
     *     						example=4
     *     					),
     *                      @OA\Property(
     *     						property="tax_person_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="pin_user",
     *     						type="string",
     *     						example="11223344556677"
     *     					),
     *                      @OA\Property(
     *     						property="tin_company_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="is_admin_user",
     *     						type="boolean",
     *     						example=false
     *     					),
     *                      @OA\Property(
     *     						property="mobile_user",
     *     						type="string",
     *     						example="998991232333"
     *     					),
     *                      @OA\Property(
     *     						property="home_tel_user",
     *     						type="string",
     *     						example="998711232333"
     *     					),
     *                      @OA\Property(
     *     						property="token_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="company_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ws_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="visible_data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ml_right_user",
     *     						type="number",
     *     						example=1
     *     					),
     *                      @OA\Property(
     *     						property="su_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="soato_minlab_user",
     *     						type="string",
     *     						example="1726      "
     *     					),
     *                      @OA\Property(
     *     						property="email_user",
     *     						type="string",
     *     						example="emaildsf@site.uz"
     *     					),
     *                      @OA\Property(
     *     						property="soato_company_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="user_oked_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="family_person_user",
     *     						type="string",
     *     						example="Пользователь"
     *     					),
     *                      @OA\Property(
     *     						property="name_person_user",
     *     						type="string",
     *     						example="MinZTO"
     *     					),
     *                      @OA\Property(
     *     						property="middlename_person_user",
     *     						type="string",
     *     						example="Ташкент"
     *     					),
     *                      @OA\Property(
     *     						property="data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="residential_address_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User retrieved successfully"
     *                  )
     *         ),
     *     ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to access this users."
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */

    public function index(Request $request)
    {

        $users = $this->model->whereNotIn('type_user', [1, 2])->get();

        if ($users->isEmpty()) {
            return $this->sendError('Users not found', 404);
        }

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');

    }

    /**
     * @OA\POST(
     *     path="/admin/users/{id}",
     *     operationId="/admin/users/store",
     *     tags={"Admin Users"},
     *     @OA\Parameter(
     *         name="active_user",
     *         in="path",
     *         description="Активность пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="boolean"
     *         ),
     *     ),
     *     *@OA\Parameter(
     *         name="tax_person_user",
     *         in="query",
     *         description="ИНН пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="pin_user",
     *         in="query",
     *         description="ПИНФЛ пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="type_user",
     *         in="query",
     *         description="Тип пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Пароль",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="soato_minlab_user",
     *         in="query",
     *         description="СОАТО сотрудника минЗТО",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="email_user",
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
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *						type="object",
     *                      @OA\Property(
     *     						property="id_user",
     *     						type="integer",
     *     						example=777
     *     					),
     *                      @OA\Property(
     *     						property="active_user",
     *     						type="boolean",
     *     						example=true
     *     					),
     *                      @OA\Property(
     *     						property="type_user",
     *     						type="number",
     *     						example=4
     *     					),
     *                      @OA\Property(
     *     						property="tax_person_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="pin_user",
     *     						type="string",
     *     						example="11223344556677"
     *     					),
     *                      @OA\Property(
     *     						property="email_user",
     *     						type="string",
     *     						example="emaildsf@site.uz"
     *     					),
     *                      @OA\Property(
     *     						property="soato_minlab_user",
     *     						type="string",
     *     						example="1726      "
     *     					),
     *                      @OA\Property(
     *     						property="family_person_user",
     *     						type="string",
     *     						example="Пользователь"
     *     					),
     *                      @OA\Property(
     *     						property="name_person_user",
     *     						type="string",
     *     						example="MinZTO"
     *     					),
     *                      @OA\Property(
     *     						property="middlename_person_user",
     *     						type="string",
     *     						example="Ташкент"
     *     					),
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User saved successfully"
     *                  )
     *         ),
     *     ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to saved this users."
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */

    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'active_user' => 'required|boolean',
            'tax_person_user' => 'required|regex:/^[0-9]{9}$/',
            'pin_user' => 'required|regex:/^[0-9]{14}$/',
            'type_user' => 'required|integer|gt:2',
            'password' => 'required|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}$/',
            //TODO Переписать на селект из базы
            'soato_minlab_user' => 'string',
            'email_user' => 'email',
        ]);


        $individByPin = Individ::getIndividByPin($input['pin_user']);

        if ($input['tax_person_user'] != $individByPin['tin']) {
            abort(401, 'Invalid user credentials');
        }

        $individ = Individ::getIndivid($individByPin['doc_num'], $input['pin_user']);

        if (is_null($individ)) {
            abort(401, 'User not found in Gov Uz');
        }
        $input['name_person_user'] = $individ['name_latin'];
        $input['middlename_person_user'] = $individ['patronym_latin'];
        $input['family_person_user'] = $individ['surname_latin'];

        $input['password'] = app('hash')->make($input['password']);

        $users = $this->model->fill($input);
        $users->save();


        return $this->sendResponse($users->toArray(), 'User saved successfully');
    }

    /**
     * @OA\GET(
     *     path="/admin/users/{id}",
     *     operationId="/admin/users/show",
     *     tags={"Admin Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Users retrieved successfully",
     *     @OA\JsonContent(
     *             @OA\Items(
     *                  @OA\Property(
     *                      property="success",
     *                      type="string",
     *                      enum = {"true", "false"},
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *						type="object",
     *                      @OA\Property(
     *     						property="id_user",
     *     						type="integer",
     *     						example=777
     *     					),
     *                      @OA\Property(
     *     						property="active_user",
     *     						type="boolean",
     *     						example=true
     *     					),
     *                      @OA\Property(
     *     						property="type_user",
     *     						type="number",
     *     						example=4
     *     					),
     *                      @OA\Property(
     *     						property="tax_person_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="pin_user",
     *     						type="string",
     *     						example="11223344556677"
     *     					),
     *                      @OA\Property(
     *     						property="tin_company_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="is_admin_user",
     *     						type="boolean",
     *     						example=false
     *     					),
     *                      @OA\Property(
     *     						property="mobile_user",
     *     						type="string",
     *     						example="998991232333"
     *     					),
     *                      @OA\Property(
     *     						property="home_tel_user",
     *     						type="string",
     *     						example="998711232333"
     *     					),
     *                      @OA\Property(
     *     						property="token_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="company_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ws_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="visible_data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ml_right_user",
     *     						type="number",
     *     						example=1
     *     					),
     *                      @OA\Property(
     *     						property="su_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="soato_minlab_user",
     *     						type="string",
     *     						example="1726      "
     *     					),
     *                      @OA\Property(
     *     						property="email_user",
     *     						type="string",
     *     						example="emaildsf@site.uz"
     *     					),
     *                      @OA\Property(
     *     						property="soato_company_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="user_oked_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="family_person_user",
     *     						type="string",
     *     						example="Пользователь"
     *     					),
     *                      @OA\Property(
     *     						property="name_person_user",
     *     						type="string",
     *     						example="MinZTO"
     *     					),
     *                      @OA\Property(
     *     						property="middlename_person_user",
     *     						type="string",
     *     						example="Ташкент"
     *     					),
     *                      @OA\Property(
     *     						property="data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="residential_address_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User retrieved successfully"
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

    public function show($id)
    {

        $users = $this->model
            ->findOrFail($id);

        return $this->sendResponse($users->toArray(), 'User retrieved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/admin/users/{id}",
     *     operationId="/admin/users/update",
     *     tags={"Admin Users"},
     *     @OA\Parameter(
     *         name="active_user",
     *         in="path",
     *         description="Активность пользователя",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="boolean"
     *         ),
     *     ),
     *     *@OA\Parameter(
     *         name="type_user",
     *         in="query",
     *         description="Тип пользователя",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="number",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Пароль",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="soato_minlab_user",
     *         in="query",
     *         description="СОАТО сотрудника минЗТО",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     *@OA\Parameter(
     *         name="email_user",
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
     *                      example="true"
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *						type="object",
     *                      @OA\Property(
     *     						property="id_user",
     *     						type="integer",
     *     						example=777
     *     					),
     *                      @OA\Property(
     *     						property="active_user",
     *     						type="boolean",
     *     						example=true
     *     					),
     *                      @OA\Property(
     *     						property="type_user",
     *     						type="number",
     *     						example=4
     *     					),
     *                      @OA\Property(
     *     						property="tax_person_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="pin_user",
     *     						type="string",
     *     						example="11223344556677"
     *     					),
     *                      @OA\Property(
     *     						property="tin_company_user",
     *     						type="string",
     *     						example="123456789"
     *     					),
     *                      @OA\Property(
     *     						property="is_admin_user",
     *     						type="boolean",
     *     						example=false
     *     					),
     *                      @OA\Property(
     *     						property="mobile_user",
     *     						type="string",
     *     						example="998991232333"
     *     					),
     *                      @OA\Property(
     *     						property="home_tel_user",
     *     						type="string",
     *     						example="998711232333"
     *     					),
     *                      @OA\Property(
     *     						property="token_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="company_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ws_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="visible_data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="ml_right_user",
     *     						type="number",
     *     						example=1
     *     					),
     *                      @OA\Property(
     *     						property="su_right_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="soato_minlab_user",
     *     						type="string",
     *     						example="1726      "
     *     					),
     *                      @OA\Property(
     *     						property="email_user",
     *     						type="string",
     *     						example="emaildsf@site.uz"
     *     					),
     *                      @OA\Property(
     *     						property="soato_company_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="user_oked_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="family_person_user",
     *     						type="string",
     *     						example="Пользователь"
     *     					),
     *                      @OA\Property(
     *     						property="name_person_user",
     *     						type="string",
     *     						example="MinZTO"
     *     					),
     *                      @OA\Property(
     *     						property="middlename_person_user",
     *     						type="string",
     *     						example="Ташкент"
     *     					),
     *                      @OA\Property(
     *     						property="data_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                      @OA\Property(
     *     						property="residential_address_user",
     *     						type="string",
     *     						example=null
     *     					),
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="User updated successfully"
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
            'active_user' => 'boolean',
            'tax_person_user' => 'regex:/^[0-9]{9}$/',
            'pin_user' => 'regex:/^[0-9]{14}$/',
            //TODO добавить проверку через бд
            'type_user' => 'integer|gt:2',
            'password' => 'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}$/',
            //TODO Переписать на селект из базы
            'soato_minlab_user' => 'lt:10000',
            'email_user' => 'email',
        ]);

        if (isset($input['password'])) {
            $input['password'] = app('hash')->make($input['password']);
        }

        $users = $this->model->findOrFail($id);
        $users->fill($input)
            ->save();


        return $this->sendResponse($users->toArray(), 'User updated successfully');

    }

    /**
     * @OA\DELETE(
     *     path="/admin/users/{id}",
     *     operationId="/admin/users/destroy",
     *     tags={"Admin Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="User deleted successfully",
     *     @OA\JsonContent(
     *             @OA\Items(
     *                  @OA\Property(
     *                      property="success",
     *                      type="string",
     *                      enum = {"true", "false"},
     *                      example="true",
     *                  ),
     *                  @OA\Property(
     *                      property="data",
     *						type="string",
     *						example="777",
     *         			),
     *     			),
     *          ),
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

    public function destroy($id)
    {

        $users = $this->model
            ->findOrFail($id);

        if (in_array($users->type_user, [1, 2])) {
            return $this->sendError('User is not admin', 404);
        }

        $users->delete();

        return $this->sendResponse($id, 'User deleted successfully');
    }
}
