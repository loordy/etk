<?php

namespace App\Events;

class ContractCreated extends Event
{

    /**
     * @var array
     */
    protected $individ;

    /**
     * @var string
     */
    protected $pin;

    /**
     * @param array                $individ
     * @param string               $pin
     */
    public function __construct(array $individ,string $pin)
    {
        $this->individ = $individ;
        $this->pin = $pin;

    }

    public function getIndivid(){
        return $this->individ;
    }

    public function getPin(){
        return $this->pin;
    }


}
