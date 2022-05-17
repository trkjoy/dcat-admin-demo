<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 正常返回json数据格式
     * @param array $data
     * @param int $code
     * @param string $msg
     * @return JsonResponse
     */
    public function success(array $data = [], int $code = 200, string $msg = 'success'): JsonResponse
    {
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => empty($data) ? (object)[] : $data,
            'timestamp' => time(),
        ];
        return response()->json($data);
    }

    /**
     * 异常返回json数据格式
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return JsonResponse
     */
    public function error(int $code = 201, string $msg = 'error response', array $data = []): JsonResponse
    {
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => empty($data) ? (object)[] : $data,
            'timestamp' => time(),
        ];
        return response()->json($data);
    }
}
