<?php

namespace App\Listeners;

use App\Events\IReportedEvent;
use App\Libraries\IHttpCurl;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendGameReportData implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';

//    /**
//     * The time (seconds) before the job should be processed.
//     *
//     * @var int
//     */
//    public $delay = 0;
    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Handle the event.
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof IReportedEvent){
            $config = config('services.report');
            if (isset($config['model'])){
                $httpClient = app($config['model']);
                if ($httpClient instanceof IHttpCurl){
                    //格式化數據并且上報上報
                    $info = $event->format();
                    $result = $httpClient->submit($info);
                    if ($result['code'] == 200){
                        Log::info(__METHOD__.":success",$result);
                    }else{
                        Log::info(__METHOD__.":error",$result);
                    }
                    return;
                }
            }
        }
        Log::info(__METHOD__.":error",$event);
        return;
    }
}
