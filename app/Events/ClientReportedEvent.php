<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientReportedEvent implements IReportedEvent
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
        $tmp = [];
        foreach ($params as $key=>$value) {
            $key = $this->replace($key);
            if ($key == 'event'){
                $tmp['events'][$key] = $value;
            }else{
                $tmp[$key] = $value;
            }
        }
        $this->params = $tmp;
        return true;
    }

    /**
     * 格式化數據
     * @return array
     */
    public function format():array
    {
       if ($this->verify($this->params)){
           return $this->params;
       }
       return [];
    }

    /**
     * 字段 map 替換
     * @param $field
     * @return string
     */
    public function replace($field): string
    {
        $replace = [
            "id"=>"unique_id",
            "step"=>"event",
            "p"=>"channel_id",
            "uuid"=>"device_id",
            "rt"=>"register_time",
        ];
        if (isset($replace[$field])){
            return $replace[$field];
        }
        return $field;
    }
}
