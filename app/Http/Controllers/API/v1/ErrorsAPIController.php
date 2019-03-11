<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateErrorsAPIRequest;
use App\Http\Requests\API\v1\UpdateErrorsAPIRequest;
use App\Models\v1\Errors;
use App\Repositories\v1\ErrorsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

/**
 * Class ErrorsController
 * @package App\Http\Controllers\API
 */

class ErrorsAPIController extends AppAPIv1BaseController
{
    /** @var  ErrorsRepository */
    private $errorsRepository;

    public function __construct(ErrorsRepository $errorsRepo)
    {
        $this->errorsRepository = $errorsRepo;
    }
    /**
     * @OA\Get(
     *     path="/helpers/errors",
     *     operationId="/helpers/errors",
     *     tags={"helpers"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns errors list",
     *         @OA\JsonContent()
     *     ),
     *     security={
     *         {"etk_auth": {}}
     *     }
     * )
     */
    public function index()
    {
        $errors = $this->errorsRepository->all();

        return $this->sendResponse($errors->toArray(), 'Errors retrieved successfully');
    }

//    /**
//     * Store a newly created Error in storage.
//     * POST /errors
//     *
//     * @param CreateErrorsAPIRequest $request
//     *
//     * @return Response
//     */
//    public function store(CreateErrorsAPIRequest $request)
//    {
//        $input = $request->all();
//
//        $errors = $this->errorsRepository->create($input);
//
//        return $this->sendResponse($errors->toArray(), 'Error saved successfully');
//    }
//
//    /**
//     * Display the specified Error.
//     * GET|HEAD /errors/{id}
//     *
//     * @param  int $id
//     *
//     * @return Response
//     */
//    public function show($id)
//    {
//        /** @var Error $errors */
//        $errors = $this->errorsRepository->findWithoutFail($id);
//
//        if (empty($errors)) {
//            return $this->sendError('Error not found');
//        }
//
//        return $this->sendResponse($errors->toArray(), 'Error retrieved successfully');
//    }
//
//    /**
//     * Update the specified Error in storage.
//     * PUT/PATCH /errors/{id}
//     *
//     * @param  int $id
//     * @param UpdateErrorsAPIRequest $request
//     *
//     * @return Response
//     */
//    public function update($id, UpdateErrorsAPIRequest $request)
//    {
//        $input = $request->all();
//
//        /** @var Error $errors */
//        $errors = $this->errorsRepository->findWithoutFail($id);
//
//        if (empty($errors)) {
//            return $this->sendError('Error not found');
//        }
//
//        $errors = $this->errorsRepository->update($input, $id);
//
//        return $this->sendResponse($errors->toArray(), 'Error updated successfully');
//    }
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
