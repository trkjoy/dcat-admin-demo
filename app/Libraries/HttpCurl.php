<?php

namespace App\Libraries;

/**
 * 發送http 請求
 */
class HttpCurl implements IHttpCurl
{
    private $sign = null;
    private $url = null;
    private $data = null;
    private $timestamp = null;

    public function verify(array $data): bool
    {
        return true;
    }

    public function sign(): bool
    {
        return true;
    }

    public function submit(array $data): array
    {
        // TODO: Implement submit() method.
        return [];
    }
}
