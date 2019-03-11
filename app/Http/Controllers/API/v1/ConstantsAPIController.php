<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateConstantsAPIRequest;
use App\Http\Requests\API\v1\UpdateConstantsAPIRequest;
use App\Repositories\v1\ConstantsRepository;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */

class ConstantsAPIController extends AppAPIv1BaseController
{
    /** @var  constantsRepository */
    private $constantsRepository;

    public function __construct(constantsRepository $constantsRepo)
    {
        $this->constantsRepository = $constantsRepo;
    }

//    /**
//     * Display a listing of the constants.
//     * GET|HEAD /constants
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function index(Request $request)
//    {
//        $this->constantsRepository->pushCriteria(new RequestCriteria($request));
//        $this->constantsRepository->pushCriteria(new LimitOffsetCriteria($request));
//        $constants = $this->constantsRepository->all(['commentconst']);
//
//        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
//    }
//
//    /**
//     * Store a newly created constants in storage.
//     * POST /constants
//     *
//     * @param CreateConstantsAPIRequest $request
//     *
//     * @return Response
//     */
//    public function store(CreateConstantsAPIRequest $request)
//    {
//        $input = $request->all();
//
//        $constants = $this->constantsRepository->create($input);
//
//        return $this->sendResponse($constants->toArray(), 'Constants saved successfully');
//    }
//
//    /**
//     * Display the specified constants.
//     * GET|HEAD /constants/{id}
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function show($id)
//    {
//        /** @var constants $constants */
//        $constants = $this->constantsRepository->findWithoutFail($id);
//
//        if (empty($constants)) {
//            return $this->sendError('Constants not found');
//        }
//
//        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
//    }
//
//    /**
//     * Update the specified constants in storage.
//     * PUT/PATCH /constants/{id}
//     *
//     * @param  int $id
//     * @param UpdateConstantsAPIRequest $request
//     *
//     * @return Response
//     */
//    public function update($id, UpdateConstantsAPIRequest $request)
//    {
//        $input = $request->all();
//
//        /** @var constants $constants */
//        $constants = $this->constantsRepository->findWithoutFail($id);
//
//        if (empty($constants)) {
//            return $this->sendError('Constants not found');
//        }
//
//        $constants = $this->constantsRepository->update($input, $id);
//
//        return $this->sendResponse($constants->toArray(), 'constants updated successfully');
//    }
//
//    /**
//     * Remove the specified constants from storage.
//     * DELETE /constants/{id}
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        /** @var constants $constants */
//        $constants = $this->constantsRepository->findWithoutFail($id);
//
//        if (empty($constants)) {
//            return $this->sendError('Constants not found');
//        }
//
//        $constants->delete();
//
//        return $this->sendResponse($id, 'Constants deleted successfully');
//    }


    /**
     * @OA\Get(
     *     path="/helpers/constants",
     *     operationId="/helpers/constants",
     *     tags={"helpers"},
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
    public function constants()
    {
        $constants = $this->constantsRepository->getConstants();

        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
    }


    public function soato()
    {

        $constants = $this->constantsRepository->getSoato();

        return $this->sendResponse($constants, 'Constants retrieved successfully');
    }



    public function kodp()
    {

        $constants = $this->constantsRepository->getKodp();

        return $this->sendResponse($constants, 'Constants retrieved successfully');
    }

}
