<?php

namespace App\Events;
interface IReportedEvent
{
    //上報參數驗證
    public function verify(array $params) : bool;
    //上報數據格式化
    public function format(): array;
}
