<?php

namespace App\SlotApi\Controllers;

use App\Events\ClientReportedEvent;
use App\Http\Controllers\Controller;
use Dcat\Admin\Traits\HasFormResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use HasFormResponse;

    public function index(Request $request): JsonResponse
    {
        return $this->success();
    }

    /**
     * 游戏数据上报
     * @param Request $request
     * @return JsonResponse
     */
    public function report(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input,
            [
                'sourcetype' => 'required',
                'event' => 'required',
            ],
            [
                'required' => trans('admin.report.required'),
            ]
        );
        if ($validator->fails()) {
            return $this->error(-201, 'validator error', $validator->errors()->messages());
        }
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
