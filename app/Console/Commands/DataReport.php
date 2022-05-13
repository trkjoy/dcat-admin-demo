<?php

namespace App\Console\Commands;

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


        $this->info("已创建{$number}条数据！");
    }
}
