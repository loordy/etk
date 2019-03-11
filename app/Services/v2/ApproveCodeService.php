<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 06.03.2019
 * Time: 17:01
 */

namespace App\Services\v2;


use App\Events\SendNotification;
use App\Models\v2\ApproveCode;
use App\Models\v2\Transaction;
use App\Models\v2\User;

class ApproveCodeService
{

    public static function store (ApproveCode $model){

        /** @var Transaction $order */
        $order = Transaction::find($model->transaction_id);
        $order->fill(['phone_number' => $model->phone_number]
        )->save();

        event(new SendNotification($model->phone_number, '<EHCT> Kod podtverjdeniya ' . $model->code));

        return $model;
    }

    public static function update(array $input, ApproveCode $model){

        /** @var  ApproveCode $approveCode */
        $approveCode = $model->whereTransactionId($input['transaction_id'])
            ->whereApprovedUserId(null)
            ->whereCode($input['code'])
            ->first();

        if (empty($approveCode)) {
            abort(404,'ApproveCode not found');
        }


        $approveCode->fill($input);
        $approveCode->save();
        /** @var Transaction $order */
        $order = Transaction::find($input['transaction_id']);

        $order->fill(['mark_confirmation' => true, 'person_phone_number' => $approveCode->phone_number]);
        $order->save();


        User::wherePersonPin($order->person_pin)
            ->whereType(1)
            ->update([
                'active' => true,
                'mobile_phone' => $approveCode->phone_number
            ]);

        return $approveCode;
    }

}