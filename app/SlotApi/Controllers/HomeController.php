<?php

namespace App\SlotApi\Controllers;

use App\Events\ClientReportedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return $this->success();
    }

    /**
     * 游戏数据上报
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function report(Request $request): JsonResponse
    {
        $input = $this->validate($request,
            [
                'sourcetype' => 'required',
                'event' => 'required',
            ],
            [
                'required' => trans('admin.report.required'),
            ]
        );
        $report = ['sourcetype' => $input['sourcetype']];
        $input['event'] = explode(',', $input['event']);
        array_walk($input['event'], function ($value) use (&$report) {
            list($key, $value) = explode('=', $value);
            $report[$key] = $value;
        });
        //異步上報數據
        ClientReportedEvent::dispatch($report);
        return $this->success();
    }
}
