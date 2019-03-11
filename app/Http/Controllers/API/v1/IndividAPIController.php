<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\v1\IndividRepository;
use Illuminate\Http\Request;
use App\Services\v2\ExternalIndividAPIService as Service;




/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */

class IndividAPIController extends AppAPIv1BaseController
{
    /** @var  individRepository */
    private $constantsRepository;

//    public function __construct(IndividRepository $individRepo)
//    {
//        $this->individRepository = $individRepo;
//    }


    /**
     * @OA\Get(
     *     path="/helpers/individ",
     *     operationId="/helpers/individ",
     *     tags={"helpers"},
     *   @OA\Parameter(
     *         name="pin",
     *         in="path",
     *         description="ПИН ФЛ",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *   @OA\Parameter(
     *         name="passport",
     *         in="path",
     *         description="Пасспорт",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns base constants",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function individ(Request $request)
    {
        $input = $this->validate($request,[
            'pin' => 'required|string|size:14',
            'passport' => 'required|regex:/^[A-Z]{2}[0-9]{7}$/'
        ]);
        $individ = Service::getIndivid($input['passport'],$input['pin']);

        if(is_null($individ)){
            return $this->sendError('Individ not found',404);
        }
        return $this->sendResponse($individ, 'Individ retrieved successfully');
    }


}
