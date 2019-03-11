<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Nskz;


/**
 * Class NskzsAPIController
 * @package App\Http\Controllers\API
 */

class NskzsAPIController extends BaseAPIController
{
    /** @var  Nskz */
    private $model;

    public function __construct(Nskz $nskz)
    {
        $this->model = $nskz;
    }

    public function index()
    {
        /** @var Nskz $nskz */
        $nskz = $this->model->all();

        return $this->sendResponse($nskz->toArray(), 'Nskzs retrieved successfully');


    }


}
