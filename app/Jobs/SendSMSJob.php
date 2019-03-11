<?php

namespace App\Jobs;

use App\Services\v2\ExternalSendSMSAPIService;

class SendSMSJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

 //       $this->fail(new \Exception('Failed'));
//        $job = $this->job;
//        $this->job->markAsFailed();



        $id = ExternalSendSMSAPIService::SendSMS($this->event);

        if(!$id){
            $this->fail(new \Exception('Failed Sended SMS'));
        }else{
            return;
        }


    }

}
