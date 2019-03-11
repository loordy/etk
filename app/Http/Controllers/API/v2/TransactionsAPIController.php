<?php

namespace App\Http\Controllers\API\v2;


use App\Models\v2\Transaction;
use App\Rules\CitizenExistsAndAuthorize;
use App\Services\v2\TransactionService;
use Illuminate\Http\Request;


/**
 * Class TransactionsAPIController
 * @package App\Http\Controllers\API
 */
class TransactionsAPIController extends BaseAPIController
{
    /** @var  Transaction */
    private $model;

    /**
     * TransactionsAPIController constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;

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
            'person_pin' => 'required|regex:/^[0-9]{14}$/',
        ]);


        $transactions = $this->findWhere($this->model,$input);;
        //
        //$transactions = TransactionService::validateCollection($transactions);

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Transaction::class);

        $input = $this->validate($request, [
            'person_pin' => 'required|regex:/^[0-9]{14}$/',
            'person_passport' => 'bail|required|regex:/^[A-Z]{2}[0-9]{7}$/|person:person_pin',
            'contract_rate' => 'bail|numeric|rate',
            //TODO нужна проверка дат... хоть какая то
            'date_start' => 'required|date',
            'position_id' => 'bail|required|regex:/^[0-9]+$/|position:date_start',
            'contract_date' => 'required|date',
            'contract_salary' => 'numeric',
            'contract_data' => 'array',
            'contract_mark_main' => 'required|boolean',
            'contract_mark_surcharge' => 'boolean',
            'contract_type' => 'bail|integer|employment_type',
            'contract_number' => 'string',
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
            'contract_rate_coefficient' => 'numeric',
            'contract_rank' => 'integer',
        ]);
        $transaction = $this->model->newInstance($input);
        $transaction = TransactionService::setData($transaction);

        return $this->sendResponse($transaction->toArray(), 'Transaction saved successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        /** @var \App\Models\v2\Transaction $transaction */
        $transaction = $this->model->findOrFail($id);
        $this->authorize('view', $transaction);
        return $this->sendResponse($transaction->toArray(), 'Transaction retrieved successfully');
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
        /** @var Transaction $transaction */
        $transaction = $this->model->with('parent')->findOrFail($id);

        $this->authorize('update', $transaction);

        TransactionService::checkForUpdate($transaction);

        $input = $this->validate($request, [
            'contract_rate' => 'bail|numeric|rate',
            'date_start' => 'required|date',
            'position_id' => 'bail|regex:/^[0-9]+$/|position:date_start'.$id,
            'contract_date' => 'date',
            'contract_salary' => 'numeric',
            'contract_data' => 'array',
            'contract_mark_main' => 'boolean',
            'contract_mark_surcharge' => 'boolean',
            'contract_type' => 'bail|integer|employment_type',
            'contract_number' => 'string',
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
            'contract_rate_coefficient' => 'numeric',
            'contract_rank' => 'integer',
        ]);

        $transaction->fill($input);

        if($transaction->Parent and $transaction->isDirty()){
            $transaction->Parent->date_stop = $transaction->date_start->subDay();
            $transaction->Parent->save();
        }
        $transaction->save();

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function mistake($id, Request $request)
    {
        $transaction = $this->model->with('parent','child')->findOrFail($id);

        $this->authorize('mistake', $transaction);

        TransactionService::checkForMistake($transaction);

        $pds = !empty($transaction->parent) ? '|after:' . $transaction->parent->date_start : '';
        $cds = !empty($transaction->child) ? '|before:' . $transaction->child->date_start : '';

        $input = $this->validate($request, [
            'contract_rate' => 'bail|numeric|rate',
            'date_start' => 'required|date' . $pds . $cds,
            'position_id' => 'bail|regex:/^[0-9]+$/|position:date_start,'.$id,
            'contract_date' => 'date',
            'contract_salary' => 'numeric',
            'contract_data' => 'array',
            'contract_mark_main' => 'boolean',
            'contract_mark_surcharge' => 'boolean',
            'contract_type' => 'bail|integer|employment_type',
            'contract_number' => 'string',
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
            'contract_rate_coefficient' => 'numeric',
            'contract_rank' => 'integer',
        ]);

        $transaction =  TransactionService::mistake($transaction,$input);

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function improve($id, Request $request)
    {
        $transaction = $this->model->with('child')->findOrFail($id);

        $this->authorize('update', $transaction);

        TransactionService::checkForMistake($transaction);

        $pds = '|after:' . $transaction->date_start;
        $cds = !empty($transaction->child) ? '|before:' . $transaction->Child->date_start : '';

        $input = $this->validate($request, [
            'contract_rate' => 'bail|numeric|rate',
            'date_start' => 'required|date' . $pds . $cds,
            'position_id' => 'bail|regex:/^[0-9]+$/|position:date_start,'.$id,
            'contract_date' => 'date',
            'contract_salary' => 'numeric',
            'contract_data' => 'array',
            'contract_mark_main' => 'boolean',
            'contract_mark_surcharge' => 'boolean',
            'contract_number' => 'string',
            'contract_type' => 'bail|integer|employment_type',
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
            'contract_rate_coefficient' => 'numeric',
            'contract_rank' => 'integer',
        ]);

        $transaction =  TransactionService::improve($transaction,$input);

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function stop($id, Request $request)
    {
        $transaction = $this->model->with('child')->findOrFail($id);

        $this->authorize('stop', $transaction);

        TransactionService::checkForStop($transaction);

        $pds = '|after:' . $transaction->date_start;


        $input = $this->validate($request, [
            'date_start' => 'required|date' . $pds,
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
        ]);

        $transaction =  TransactionService::stop($transaction,$input);

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateOrder($id, Request $request)
    {
        /** @var Transaction $transaction */
        $transaction = $this->model->findOrFail($id);

        //$this->authorize('stop', $transaction);

        TransactionService::checkForUpdateOrder($transaction);

        $input = $this->validate($request, [
            'order_date' => 'date',
            'order_number' => 'string',
            'order_article' => 'string',
        ]);

        $transaction->fill($input);
        $transaction->save();

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function workbook(Request $request)
    {

        $input = $this->validate($request, [
            'person_pin' => ['required','regex:/^[0-9]{14}$/',new CitizenExistsAndAuthorize],
        ]);

        $transactions = $this->findWhere($this->model,$input);;

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }


}
