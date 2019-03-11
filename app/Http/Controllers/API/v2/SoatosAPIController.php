<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Soato;


/**
 * Class SoatosAPIController
 * @package App\Http\Controllers\API
 */

class SoatosAPIController extends BaseAPIController
{
    /** @var  Soato */
    private $model;

    public function __construct(Soato $soato)
    {
        $this->model = $soato;
    }

    public function index()
    {
        /** @var \App\Models\v2\Soato $soato */
        $soato = $this->model->all();

        return $this->sendResponse($soato->toArray(), 'Soatos retrieved successfully');


    }


}
