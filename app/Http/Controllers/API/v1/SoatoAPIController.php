<?php

namespace App\Http\Controllers\API\v1;


use App\Models\v1\Soato;
use App\Utils\ResponseUtil;
use Illuminate\Http\Request;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */
class SoatoAPIController extends AppAPIv1BaseController
{
    /** @var  \soato */
    private $model;

    public function __construct(Soato $soatoModel)
    {
        $this->model = $soatoModel;
    }

    /**
     * @OA\Get(
     *     path="/helpers/search/soato",
     *     operationId="/helpers/search/soato",
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
     *         description="Soato retrieved successfully",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */

    /**
     * Display a listing of the constants.
     * GET|HEAD /soato
     *
     * @param Request $request
     * @return ResponseUtil
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $input = $this->validate($request, [
            'lang' => 'required|string|in:ru,uz',
            'search' => 'required|string|min:3'
        ]);

        if ($input['lang'] === 'ru') {

            $soato = $this->model->searchRu(mb_strtolower($input['search']));

        } else {

            $soato = $this->model->searchUz(mb_strtolower($input['search']));

        }

        return $this->sendResponse($soato->toArray(), 'Soato retrieved successfully');
    }

    /**
     * @OA\Get(
     *     path="/helpers/soato",
     *     operationId="/helpers/soato",
     *     tags={"helpers"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns soato",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */
    public function full()
    {
        return $this->sendResponse($this->model->get()->toArray(), 'Full soato retrieved successfully');
    }


}
