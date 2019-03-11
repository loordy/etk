<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\PositionWithActiveTransaction;
use Illuminate\Http\Request;


/**
 * Class PositionWithActiveTransactionsAPIController
 * @package App\Http\Controllers\API
 */
class PositionsWithActiveTransactionAPIController extends BaseAPIController
{
    /** @var  PositionWithActiveTransaction */
    private $model;

    /**
     * PositionWithActiveTransactionsAPIController constructor.
     * @param PositionWithActiveTransaction $positions
     */
    public function __construct(PositionWithActiveTransaction $positions)
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

        return $this->sendResponse($positions->toArray(), 'PositionWithActiveTransactions retrieved successfully');
    }


}
