<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Position;
use App\Services\v2\CheckPositionForUpdate;
use Illuminate\Http\Request;


/**
 * Class PositionsAPIController
 * @package App\Http\Controllers\API
 */
class PositionsAPIController extends BaseAPIController
{
    /** @var  Position */
    private $model;

    /**
     * PositionsAPIController constructor.
     * @param Position $positionsRepo
     */
    public function __construct(Position $positions)
    {
        $this->model = $positions;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {

        $input = $this->validate($request, [
            'company_tin' => 'bail|required|regex:/^[0-9]{9}$/|company',
            'structure_id' => 'bail|regex:/^[0-9]+$/|structure',
        ]);

        $positions = $this->findWhere($this->model,$input);

        return $this->sendResponse($positions->toArray(), 'Positions retrieved successfully');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'structure_id' => 'bail|required|regex:/^[0-9]+$/|structure',
            'name' => 'required|string',
            'salary' => 'required|numeric',
            'requirements' => 'required|string',
            'date_stop' => 'nullable|date|after:date_start',
            'date_start' => 'required|date',
            'duties' => 'required|string',
            'conditions' => 'required|string',
            'kodp_type' => 'required|string|',
            'kodp_pn' => 'required|string|kodp:kodp_type',
            'mark_surcharge' => 'required|boolean',
            'type' => 'bail|required|integer|employment_type',
            'company_tin' => 'bail|required|regex:/^[0-9]{9}$/|company',
            'rate' => 'bail|required|numeric|rate',
            'rate_coefficient' => 'numeric',
            'rank' => 'integer',
        ]);
        $this->authorize('create', Position::class);
        $positions = $this->model->fill($input);
        $positions->save();


        return $this->sendResponse($positions->toArray(), 'Position saved successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        /** @var \App\Models\v2\Position $position */
        $position = $this->model->find($id);
        $this->authorize('view', $position);
        return $this->sendResponse($position->toArray(), 'Position retrieved successfully');
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)
    {
        /** @var Position $position */
        $position = $this->model->find($id);
        $this->authorize('update', $position);
        CheckPositionForUpdate::check($position);
        $input = $this->validate($request, [
            'structure_id' => 'bail|regex:/^[0-9]+$/|structure',
            'name' => 'string',
            'kodp_pn' => 'string',
            'salary' => 'numeric',
            'requirements' => 'string',
            'date_stop' => 'nullable|date|after:date_start',
            'date_start' => 'date',
            'duties' => 'string',
            'conditions' => 'string',
            'kodp_type' => 'string',
            'mark_surcharge' => 'boolean',
            'type' => 'bail|integer|employment_type',
            'rate' => 'bail|numeric|rate',
            'rate_coefficient' => 'numeric',
            'rank' => 'integer',
        ]);

        $position->fill($input)->save();

        return $this->sendResponse($position->toArray(), 'Position updated successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Position $position */
        $position = $this->model->find($id);
        $this->authorize('delete', $position);
        $position->delete();

        return $this->sendResponse($id, 'Position deleted successfully');
    }

}
