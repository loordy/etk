<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Constant;


/**
 * Class constantsAPIController
 * @package App\Http\Controllers\API
 */

class ConstantsAPIController extends BaseAPIController
{
    /** @var  Constant */
    private $model;

    public function __construct(Constant $constant)
    {
        $this->model = $constant;
    }

    public function index()
    {
        /** @var \App\Models\v2\Constant $constant */
        $constant = $this->model->all();

        return $this->sendResponse($constant->toArray(), 'Constants retrieved successfully');


    }


}
