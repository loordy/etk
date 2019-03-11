<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\v1\vacanciesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class vacanciesController
 * @package App\Http\Controllers\API
 */

class vacanciesAPIController extends AppAPIv1BaseController
{
    /** @var  vacanciesRepository */
    private $vacanciesRepository;

    public function __construct(vacanciesRepository $vacanciesRepo)
    {
        $this->vacanciesRepository = $vacanciesRepo;
    }

    /**
     * Display a listing of the vacancies.
     * GET|HEAD /vacancies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $vacancies = $this->vacanciesRepository->all();

        return $this->sendResponse($vacancies->toArray(), 'Vacancy retrieved successfully');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $vacancies = $this->vacanciesRepository->create($input);

        return $this->sendResponse($vacancies->toArray(), 'vacancies saved successfully');
    }

    /**
     * Display the specified vacancies.
     * GET|HEAD /vacancies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vacancies $vacancies */
        $vacancies = $this->vacanciesRepository->find($id);

        if (empty($vacancies)) {
            return $this->sendError('vacancies not found');
        }

        return $this->sendResponse($vacancies->toArray(), 'vacancies retrieved successfully');
    }

    /**
     * Update the specified vacancies in storage.
     * PUT/PATCH /vacancies/{id}
     *
     * @param  int $id
     * @param UpdatevacanciesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatevacanciesAPIRequest $request)
    {
        $input = $request->all();

        /** @var vacancies $vacancies */
        $vacancies = $this->vacanciesRepository->findWithoutFail($id);

        if (empty($vacancies)) {
            return $this->sendError('vacancies not found');
        }

        $vacancies = $this->vacanciesRepository->update($input, $id);

        return $this->sendResponse($vacancies->toArray(), 'vacancies updated successfully');
    }

    /**
     * Remove the specified vacancies from storage.
     * DELETE /vacancies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var vacancies $vacancies */
        $vacancies = $this->vacanciesRepository->findWithoutFail($id);

        if (empty($vacancies)) {
            return $this->sendError('vacancies not found');
        }

        $vacancies->delete();

        return $this->sendResponse($id, 'vacancies deleted successfully');
    }
}
