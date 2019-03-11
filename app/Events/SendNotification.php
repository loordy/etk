<?php

namespace App\Events;

class SendNotification extends Event
{

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string                $number
     * @param string               $message
     */
    public function __construct($number, $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    public function getNumber(){
        return $this->number;
    }

    public function getMessage(){
        return $this->message;
    }

}
