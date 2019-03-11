<?php

namespace App\Listeners;

use App\Events\BaseEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class RepositoryEntityCacheFlush
{
    /**
     * @var string
     */
    protected $secondtin = null;
    /**
     * @var string
     */
    protected $pin = null;
    /**
     * @var string
     */
    protected $tin = null;
    /**
     * @var string
     */
    protected $class = null;
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
     * @param  BaseEvent  $event
     * @return void
     */
    public function handle(BaseEvent $event)
    {

        $this->tin = $event->getTin();
        $this->pin = $event->getPin();
        $this->secondtin = $event->getSecondtin();
        $this->class = $event->getClass();
        if($this->tin){
            Cache::tags([$this->tin,$this->class])->flush();
        }
        if($this->pin){
            Cache::tags([$this->pin,$this->class])->flush();
        }
        if($this->secondtin){
            Cache::tags([$this->secondtin,$this->class])->flush();
        }

    }
}
