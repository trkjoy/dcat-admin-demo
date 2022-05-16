<?php

namespace App\Libraries;

/**
 * 發送http 請求
 */
interface IHttpCurl
{
    public function verify(array $data): bool;
    //簽名
    public function sign(): bool;
    //
    public function submit(array $data): array;
}
