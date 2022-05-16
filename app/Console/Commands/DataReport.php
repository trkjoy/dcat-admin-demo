<?php

namespace App\Console\Commands;

use App\Events\GameReportedEvent;
use Illuminate\Console\Command;

//数据上报
class DataReport extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'report:game';
    protected $description = '统一游戏相关的各指标上报';
    /**
     * @return void
     */
    public function handle()
    {
        $number = 5000;
        $this->line('开始');
        $report = [
            [
                "unique_id"=>"12345",
                "channel_id"=>"12345",
                "device_id"=>"12345",
                "app_id"=>"10010",
                "app_ver"=>"1.0.1",
                "network_type"=>"4G",
                "timestamp"=>1575939600,
                "events"=>[
                    "event"=>"view_login",
                    "timestamp"=>1575939600,
                    "properties"=>[]
                ],
            ],
            [
                "unique_id"=>"12345",
                "channel_id"=>"12345",
                "device_id"=>"12345",
                "app_id"=>"10010",
                "app_ver"=>"1.0.1",
                "network_type"=>"4G",
                "timestamp"=>1575939600,
                "events"=>[
                    "event"=>"sys.activate",
                    "timestamp"=>1575939600,
                    "properties"=>[
                        "sim"=>"", // sim 卡标示
                        "manufacturer"=>"Apple", // 客户端设备制造商
                        "model"=>"iPhone 5", // 客户端设备型号
                        "os"=>"iOS", // 客户端操作系统(ios, android, windows)
                        "os_ver"=>"7.0", // 客户端系统版本
                        "screen"=>"320*640", // 客户端屏幕宽度与高度（width*height）
                        "carrier"=>"电信" // 客户端网络运营商
                    ]
                ],
            ],
            [
                "unique_id"=>"123453",
                "channel_id"=>"12345",
                "device_id"=>"12345",
                "app_id"=>"10010",
                "app_ver"=>"1.0.1",
                "network_type"=>"4G",
                "timestamp"=>1575939600,
                "events"=>[
                    "event"=>"sys.activate",
                    "timestamp"=>1575939600,
                    "properties"=>[
                        "sim"=>"", // sim 卡标示
                        "manufacturer"=>"Apple", // 客户端设备制造商
                        "model"=>"iPhone 5", // 客户端设备型号
                        "os"=>"iOS", // 客户端操作系统(ios, android, windows)
                        "os_ver"=>"7.0", // 客户端系统版本
                        "screen"=>"320*640", // 客户端屏幕宽度与高度（width*height）
                        "carrier"=>"电信" // 客户端网络运营商
                    ]
                ],
            ],
        ];
        GameReportedEvent::dispatch($report);
//        event(new GameReportedEvent($report));
        $this->info("已创建{$number}条数据！");
    }
}
