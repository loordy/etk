<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Kodp;


/**
 * Class KodpsAPIController
 * @package App\Http\Controllers\API
 */

class KodpsAPIController extends BaseAPIController
{
    /** @var  Kodp */
    private $model;

    public function __construct(Kodp $kodp)
    {
        $this->model = $kodp;
    }

    public function index()
    {
        /** @var \App\Models\v2\Kodp $kodp */
        $kodp = $this->model->all();

        return $this->sendResponse($kodp->toArray(), 'Kodps retrieved successfully');


    }


}
