<?php

namespace App\Http\Controllers\API\v2;



use App\Models\v2\ApproveCode;
use App\Services\v2\ApproveCodeService;
use Illuminate\Http\Request;



/**
 * Class ErrorsController
 * @package App\Http\Controllers\API
 */
class ApproveCodesAPIController extends BaseAPIController
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'transaction_id' => 'bail|required|regex:/^[0-9]+$/|transaction_exist_and_not_approved',
            'phone_number' => 'required|regex:/\d{10,12}$/',
        ]);
        $input['user_id'] = $request->user()->id;
        $input['code'] = rand(100000, 999999);
        /** @var ApproveCode $approveCode */
        $approveCode = $this->model->newInstance($input);
        $approveCode->save();

        ApproveCodeService::store($approveCode);

        return $this->sendResponse($approveCode->toArray(), 'ApproveCode saved successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $input = $this->validate($request, [
            'transaction_id' => 'bail|required|regex:/^[0-9]+$/|transaction_exist_and_not_approved',
            'code' => 'required|integer|between:100000, 1000000'
        ]);

        $input['approved_user_id'] = $request->user()->id;

        $approveCode = ApproveCodeService::update($input, $this->model);

        return $this->sendResponse($approveCode->toArray(), 'ApproveCode updated successfully');
    }

}
