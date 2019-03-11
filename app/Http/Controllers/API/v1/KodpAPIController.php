<?php

namespace App\Http\Controllers\API\v1;


use App\Models\v1\Kodp;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */
class KodpAPIController extends AppAPIv1BaseController
{
    /** @var  kodp */
    private $model;

    /**
     * KodpAPIController constructor.
     * @param Kodp $kodpModel
     */
    public function __construct(Kodp $kodpModel)
    {
        $this->model = $kodpModel;
    }

    /**
     * @OA\Get(
     *     path="/helpers/search/kodp",
     *     operationId="/helpers/search/kodp",
     *     tags={"helpers"},
     *   @OA\Parameter(
     *         name="lang",
     *         in="path",
     *         description="Язык",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
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
     *         description="Kodp retrieved successfully",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */
    /**/

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $input = $this->validate($request, [
            'lang' => 'required|string|in:ru,uz',
            'search' => 'required|string|min:3'
        ]);
        if ($input['lang'] === 'ru') {

            $kodp = $this->model->searchRu(mb_strtolower($input['search']));

        } else {

            $kodp = $this->model->searchUz(mb_strtolower($input['search']));

        }

        return $this->sendResponse($kodp->toArray(), 'Kodp retrieved successfully');
    }

    /**
     * @OA\Get(
     *     path="/helpers/kodp",
     *     operationId="/helpers/kodp",
     *     tags={"helpers"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns kodp",
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
