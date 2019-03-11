<?php

namespace App\Events;

class LogEvent extends Event
{

    /**
     * @var number
     */
    protected $userId;

    /**
     * @var array
     */
    protected $model;

    /**
     * @param number                $userId
     * @param array               $model
     */
    public function __construct($userId,  $model)
    {
        $this->userId = $userId;
        $this->model = $model;
    }

    /**
     * @return number
     */

    public function getUserId()
    {
        return $this->userId;
    }
    /**
     * @return array
     */

    public function getModel()
    {
        return $this->model;
    }
}
