<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameReportedEvent implements IReportedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $params = [];
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * 驗證數據格式
     * @param array $params
     * @return bool
     */
    public function verify(array $params):bool
    {
        //TODO 驗證數據格式是否正常
        return true;
    }

    /**
     * 格式化數據
     * @return array
     */
    public function format():array
    {
        //TODO 格式化數據
       if ($this->verify($this->params)){
           return $this->params;
       }
       return [];
    }

//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return \Illuminate\Broadcasting\Channel|array
//     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }

}
