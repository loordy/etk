<?php

namespace App\Events;

/**
 * Class BaseEvent
 * @package App\Events
 */
class BaseEvent extends Event
{
    /**
 * @var string
 */
    protected $pin;

    /**
     * @var string
     */
    protected $tin;

    /**
     * @var string
     */
    protected $second_tin;

    /**
     * @var string
     */
    protected $class;


    /**
     * BaseEvent constructor.
     * @param $pin
     * @param $tin
     * @param $second_tin
     * @param $class
     */
    public function __construct($pin, $tin, $second_tin, $class)
    {
        $this->pin = $pin;
        $this->tin = $tin;
        $this->second_tin = $second_tin;
        $this->class = $class;
    }
    /**
     * @return string
     */
    public function getTin()
    {
        return $this->tin;
    }

    /**
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @return string
     */
    public function getSecondTin()
    {
        return $this->second_tin;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
