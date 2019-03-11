<?php

namespace App\Http\Controllers\API\v2;

use App\Models\v2\Structure;
use App\Services\v2\CheckStructureForUpdate;
use Illuminate\Http\Request;



/**
 * Class StructuresController
 * @package App\Http\Controllers\API
 */
class StructuresAPIController extends BaseAPIController
{
    /** @var  Structure */
    private $model;

    /**
     * StructuresAPIController constructor.
     * @param Structure $structures
     */
    public function __construct(Structure $structures)
    {
        $this->model = $structures;

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
        ]);
        /** @var Structure $structures */
        $structures = $this->findWhere($this->model,$input);

        return $this->sendResponse($structures->toArray(), 'Structures retrieved successfully');
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
            'parent_id' => 'bail|required|regex:/^[0-9]+$/|structure',
            'name' => 'required|string',
            'date_stop' => 'nullable|date|after:date_start',
            'date_start' => 'required|date',
            'company_tin' => 'bail|required|regex:/^[0-9]{9}$/|company',
        ]);

        $this->authorize('create', Structure::class);

        $structures = $this->model->create($input);


        return $this->sendResponse($structures->toArray(), 'Structure saved successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        /** @var Structure $structure */
        $structure = $this->model->findOrFail($id);

        $this->authorize('view', $structure);

        return $this->sendResponse($structure->toArray(), 'Structure retrieved successfully');
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
        /** @var Structure $structure */
        $structure = $this->model->findOrFail($id);

        $this->authorize('update', $structure);

        CheckStructureForUpdate::check($structure);

        $input = $this->validate($request, [
            'parent_id' => 'bail|regex:/^[0-9]+$/|structure',
            'name' => 'string',
            'date_stop' => 'nullable|date|after:date_start',
            'date_start' => 'date',
        ]);

        $structure->fill($input)->save();

        return $this->sendResponse($structure->toArray(), 'Structure updated successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Structure $structure */
        $structure = $this->model->findOrFail($id);
        $this->authorize('delete', $structure);
        CheckStructureForUpdate::check($structure);
        $structure->delete();
        return $this->sendResponse($id, 'Structure deleted successfully');
    }

}
