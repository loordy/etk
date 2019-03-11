<?php

namespace App\Http\Controllers\API\v1;

use App\Models\v2\ApproveCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Events\SendNotification;
use App\Models\v1\Lc;
use App\Models\v1\Users;
use App\Rules\LcExistAndNotApproved;


/**
 * Class ErrorsController
 * @package App\Http\Controllers\API
 */
class ApproveCodesAPIController extends AppAPIv1BaseController
{

    /**
     * @var ApproveCode
     */
    private $model;

    /**
     * ApproveCodesAPIController constructor.
     * @param ApproveCode $approveCode
     */
    public function __construct(ApproveCode $approveCode)
    {
        $this->model = $approveCode;
    }

    /**
     * @OA\POST(
     *     path="/contract/approve/",
     *     operationId="/contract/approve/",
     *     tags={"Contract"},
     *     @OA\Response(
     *         response="200",
     *         description="Contract saved successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/ApproveCode"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract retrieved successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to create this lc"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/ApproveCodeRequest"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     *
     * )
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'id_lc' => ['required',new LcExistAndNotApproved],
            'phone_number' => 'required|regex:/^998[0-9]{9}$/',
        ]);
        $input['user_id'] = $request->user()->id_user;
        $input['code'] = rand(100000, 999999);
        $approveCodes = $this->model->create($input);

        Lc::find($input['id_lc'])
            ->fill(
                ['phone_number_lc' => $input['phone_number']]
            )->save();

        event(new SendNotification($input['phone_number'], '<EHCT> Kod podtverjdeniya ' . $input['code']));


        return $this->sendResponse($approveCodes->toArray(), 'ApproveCode saved successfully');
    }

    /**
     * @OA\PUT(
     *     path="/contract/approve/",
     *     operationId="/contract/approve/",
     *     tags={"Contract"},
     *     @OA\Response(
     *         response="200",
     *         description="Contract updated successfully",
     *     @OA\JsonContent(
     *     @OA\Items(
     *     @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/ApproveCode"
     * ),
     *     @OA\Property(
     *     property="success",
     *     type="string",
     *     enum = {"true", "false"},
     *     example="success"),
     *     @OA\Property(
     *     property="message",
     *     type="string",
     *     example="Contract updated successfully")
     *     )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized to update this lc"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contract not found"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/ApproveCodeApprove"},
     *     security={
     *         {"etk_auth": {}}
     *     },
     * )
     */
    /**/

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $input = $this->validate($request, [
            'id_lc' => 'required|integer',
            'code' => 'required|integer|between:100000, 999999'
        ]);

        $approveCodes = $this->model->where('id_lc', $input['id_lc'])
            ->where('user_id_approved', null)
            ->where('code', $input['code'])
            ->first();

        if (empty($approveCodes)) {
            return $this->sendError('ApproveCode not found');
        }


        $input['user_id_approved'] = $request->user()->id_user;

        $approveCodes->fill($input);
        $approveCodes->save();

        $lc = Lc::find($input['id_lc']);

        $lc->fill([
            'approve_contract_employee_lc' => true,
        ]);
        $lc->save();

        Users::where('pin_user', $lc->pin_lc)
            ->where('type_user', 1)
            ->update([
                'active_user' => true,
                'mobile_user' => $approveCodes->phone_number
            ]);


        return $this->sendResponse($approveCodes->toArray(), 'ApproveCode updated successfully');
    }
//
//    /**
//     * Remove the specified Error from storage.
//     * DELETE /errors/{id}
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        /** @var Error $errors */
//        $errors = $this->errorsRepository->findWithoutFail($id);
//
//        if (empty($errors)) {
//            return $this->sendError('Error not found');
//        }
//
//        $errors->delete();
//
//        return $this->sendResponse($id, 'Error deleted successfully');
//    }
}
