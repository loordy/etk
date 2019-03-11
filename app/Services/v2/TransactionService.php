<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 28.02.2019
 * Time: 10:56
 */

namespace App\Services\v2;

use App\Events\ContractCreated;
use App\Models\v2\Kodp;
use App\Models\v2\Position;
use App\Models\v2\Transaction;
use App\Services\External\ExternalIndividAPIService as Individ;
use Carbon\Carbon;


/**
 * Class TransactionService
 * @package App\Services\v2
 */
class TransactionService

{


    /**
     * @param Transaction $transaction
     * @return Transaction
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function setData(Transaction $transaction)
    {


        //+Заполняем из внешних данных
        $individ = Individ::getIndivid($transaction->person_passport, $transaction->person_pin);

        $input['person_name'] = $individ['name_latin'];
        $input['person_surname'] = $individ['surname_latin'];
        $input['person_patronymic'] = $individ['patronym_latin'];
        $input['person_sex'] = $individ['sex'] == 1 ? true : false;
        $input['person_tin'] = $individ['military']['inn'];
        //-

        //+Заполняем из позиции
        $position = Position::with(['structure', 'company'])->find($transaction->position_id);

        $input['position_name'] = $position->name;
        $input['kodp_pn'] = $position->kodp_pn;
        $input['kodp_type'] = $position->kodp_type;
        //Если поле задано то берем его если нет берем по умолчению из позиции
        $input['contract_mark_surcharge'] = $input['contract_mark_surcharge'] ?? $position->mark_surcharge;
        $input['contract_type'] = $input['contract_type'] ?? $position->type;
        $input['contract_rate'] = $input['contract_rate'] ?? $position->rate;
        $input['contract_rate_coefficient'] = $input['contract_rate_coefficient'] ?? $position->rate_coefficient;
        $input['contract_rank'] = $input['contract_rank'] ?? $position->rank;

        $input['structure_name'] = $position->Structure->name;
        $input['structure_id'] = $position->Structure->id;

        $input['company_tin'] = $position->company_tin;
        $input['company_name'] = $position->Company->name;
        $input['company_oked'] = $position->Company->oked;
        $input['company_soato_code'] = $position->Company->soato_code;
        //-

        //+Заполняем из kodp. EagerLoading + composite не работает
        /** @var Kodp $kodp */
        $kodp = $position->Kodp;
        $input['kodp_nskz_code'] = $kodp->nskz_code;
        $input['kodp_personal_category'] = $kodp->personal_category;
        //-
        $transaction->fill($input);
        $transaction->save();

        event(new ContractCreated($individ, $transaction->person_pin));

        return $transaction;
    }

    /**
     * @param Transaction $transaction
     */
    public static function checkForUpdate(Transaction $transaction)
    {
        if ($transaction->created_at->diffInHours(Carbon::now()) > 24) {
            abort(422, 'u can action update transaction only in 24 hours');
        }
        if ($transaction->mark_confirmation) {
            abort(422, 'action update available only if employee didnt confirm this transaction');
        }
    }

    /**
     * @param Transaction $transaction
     */
    public static function checkForMistake(Transaction $transaction)
    {
        if (!$transaction->active) {
            abort(422, 'u can work only with active transaction');
        }

    }

    /**
     * @param Transaction $transaction
     */
    public static function checkForUpdateOrder(Transaction $transaction)
    {
        if (!$transaction->active) {
            abort(422, 'u can work only with active transaction');
        }
    }

    /**
     * @param Transaction $transaction
     */
    public static function checkForStop(Transaction $transaction)
    {
        if (!$transaction->active) {
            abort(422, 'u can work only with active transaction');
        }

        if ($transaction->Child) {
            abort(422, 'transaction have child');
        }


    }


    /**
     * @param Transaction $transaction
     * @param array $input
     * @return Transaction
     */
    public static function mistake(Transaction $transaction, array $input)
    {

        $newTransaction = $transaction->replicate();

        $input['error_id'] = $transaction->id;
        $newTransaction->fill($input);


        if ($newTransaction->isDirty('position_id')) {

            //+Заполняем из позиции
            $position = Position::with(['structure', 'company'])->find($newTransaction->position_id);

            $input['position_name'] = $position->name;
            $input['kodp_pn'] = $position->kodp_pn;
            $input['kodp_type'] = $position->kodp_type;
            //Если поле задано то берем его если нет берем по умолчению из позиции
            $input['contract_mark_surcharge'] = $input['contract_mark_of_surcharge'] ?? $position->mark_surcharge;
            $input['contract_type'] = $input['contract_type'] ?? $position->type;
            $input['contract_rate'] = $input['contract_rate'] ?? $position->rate;
            $input['contract_rate_coefficient'] = $input['contract_rate_coefficient'] ?? $position->rate_coefficient;
            $input['contract_rank'] = $input['contract_rank'] ?? $position->rank;

            $input['structure_name'] = $position->Structure->name;
            $input['structure_id'] = $position->Structure->id;

            $input['company_tin'] = $position->company_tin;
            $input['company_name'] = $position->Company->name;
            $input['company_oked'] = $position->Company->oked;
            $input['company_soato_code'] = $position->Company->soato_code;
            //-

            //+Заполняем из kodp. EagerLoading + composite не работает
            /** @var Kodp $kodp */
            $kodp = $position->Kodp;
            $input['kodp_nskz_code'] = $kodp->nskz_code;
            $input['kodp_personal_category'] = $kodp->personal_category;

        }
        if (!empty($transaction->Child)) {
            if ($transaction->Child->action) {
                $newTransaction->date_stop = $transaction->Child->date_start->subDay();
            } else {
                $transaction->Child->fill($newTransaction->toArray());
                $transaction->Child->action = false;
                $transaction->Child->parent_id = $newTransaction->id;
                $transaction->Child->date_start = $newTransaction->date_stop->addDay();
                $transaction->Child->save();
            }
        }
        if (!empty($transaction->Parent)) {
            $transaction->Parent->fill(['date_stop' => $newTransaction->date_start->subDay()]);
            $transaction->Parent->save();
        }

        $newTransaction->save();
        $transaction->Deactivate();

        return $newTransaction;
    }


    /**
     * @param Transaction $transaction
     * @param array $input
     * @return mixed
     */
    public static function improve(Transaction $transaction, array $input)
    {

        $newTransaction = $transaction->replicate(['parent_id', 'error_id']);
        $input['parent_id'] = $transaction->id;
        $newTransaction->fill($input);

        if ($newTransaction->isDirty('position_id')) {

            //+Заполняем из позиции
            $position = Position::with(['structure', 'company'])->find($newTransaction->position_id);

            $input['position_name'] = $position->name;
            $input['kodp_pn'] = $position->kodp_pn;
            $input['kodp_type'] = $position->kodp_type;
            //Если поле задано то берем его если нет берем по умолчению из позиции
            $input['contract_mark_surcharge'] = $input['contract_mark_surcharge'] ?? $position->mark_surcharge;
            $input['contract_type'] = $input['contract_type'] ?? $position->type;
            $input['contract_rate'] = $input['contract_rate'] ?? $position->rate;
            $input['contract_rate_coefficient'] = $input['contract_rate_coefficient'] ?? $position->rate_coefficient;
            $input['contract_rank'] = $input['contract_rank'] ?? $position->rank;

            $input['structure_name'] = $position->Structure->name;
            $input['structure_id'] = $position->Structure->id;

            $input['company_tin'] = $position->company_tin;
            $input['company_name'] = $position->Company->name;
            $input['company_oked'] = $position->Company->oked;
            $input['company_soato_code'] = $position->Company->soato_code;
            //-

            //+Заполняем из kodp. EagerLoading + composite не работает
            /** @var Kodp $kodp */
            $kodp = $position->Kodp;
            $input['kodp_nskz_code'] = $kodp->nskz_code;
            $input['kodp_personal_category'] = $kodp->personal_category;

        }
        if (!empty($transaction->Child)) {
            if ($transaction->Child->action) {
                $newTransaction->date_stop = $transaction->Child->date_start->subDay();

            } else {
                $transaction->Child->fill($newTransaction->toArray());
                $transaction->Child->action = false;
                $transaction->Child->parent_id = $newTransaction->id;
                $transaction->Child->date_start = $newTransaction->date_stop->addDay();
                $transaction->Child->save();
            }
        }

        $transaction->date_stop = $newTransaction->date_start->subDay();
        $transaction->save();

        $newTransaction->save();

        if (!empty($transaction->Child)) {
            $newTransaction->Child->parent_id = $newTransaction->id;
            $newTransaction->Child->save();
        }


        return $newTransaction;

    }


    /**
     * @param Transaction $transaction
     * @param array $input
     * @return Transaction
     */
    public static function stop(Transaction $transaction, array $input)
    {
        $newTransaction = $transaction->replicate(['parent_id', 'error_id']);
        $input['parent_id'] = $transaction->id;
        $input['action'] = false;
        $input['date_stop'] = $input['date_start'];

        $newTransaction->fill($input);
        $transaction->date_stop = $newTransaction->date_start->subDay();
        $newTransaction->save();
        $transaction->save();

        return $newTransaction;

    }


    /**
     * @param Transaction $transaction
     * @param array $input
     */
    public static function deactivate(Transaction $transaction, array $input)
    {


    }


}