<?php

namespace App\Http\Controllers\API\v2;


use Illuminate\Http\Request;
use App\Services\External\ExternalIndividAPIService as Service;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */
class IndividsAPIController extends BaseAPIController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $input = $this->validate($request, [
            'pin' => 'required|string|size:14',
            'passport' => 'required|regex:/^[A-Z]{2}[0-9]{7}$/'
        ]);
        $individ = Service::getIndivid($input['passport'], $input['pin']);

        if (is_null($individ)) {
            return $this->sendError('Individ not found', 404);
        }
        return $this->sendResponse($individ, 'Individ retrieved successfully');
    }


}
