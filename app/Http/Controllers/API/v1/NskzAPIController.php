<?php

namespace App\Http\Controllers\API\v1;


use App\Models\v1\Nskz;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */
class NskzAPIController extends AppAPIv1BaseController
{
    /** @var  nskz */
    private $model;

    /**
     * NskzAPIController constructor.
     * @param Nskz $nskzModel
     */
    public function __construct(Nskz $nskzModel)
    {
        $this->model = $nskzModel;
    }

    /**
     * @OA\Get(
     *     path="/helpers/search/nskz",
     *     operationId="/helpers/search/nskz",
     *     tags={"helpers"},
     *   @OA\Parameter(
     *         name="search",
     *         in="path",
     *         description="Поиск",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Nskz retrieved successfully",
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
    public function index(Request $request)
    {
        $input = $this->validate($request, [
            'search' => 'required|string|min:3'
        ]);

        $nskz = $this->model->searchRu(mb_strtolower($input['search']));


        return $this->sendResponse($nskz->toArray(), 'Nskz retrieved successfully');
    }

    /**
     * @OA\Get(
     *     path="/helpers/nskz",
     *     operationId="/helpers/nskz",
     *     tags={"helpers"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns nskz",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function full()
    {
        return $this->sendResponse($this->model->get()->toArray(), 'Full kodp retrieved successfully');
    }


}
