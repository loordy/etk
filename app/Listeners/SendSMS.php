<?php

namespace App\Listeners;

use App\Events\SendNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\SendSMSJob;
use Illuminate\Support\Facades\Queue;
use Carbon\Carbon;

class SendSMS
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendNotification  $event
     * @return void
     */
    public function handle(SendNotification $event)
    {

        Queue::pushOn('sms', (new SendSMSJob($event)));

    }
}
