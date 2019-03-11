<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;
use App\Helpers\ModelHelpers;


/**
 * Class BaseAPIController
 * @package App\Http\Controllers\API\v2
 */
class BaseAPIController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    /**
     * @param $error
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

    public function findWhere($model, $where, $columns = ['*'])
    {
        return ModelHelpers::findWhere($model, $where, $columns = ['*']);
    }
}
