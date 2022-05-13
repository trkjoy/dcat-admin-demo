<?php

namespace App\SlotApi\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $time = time();
        dump([$request->all(),$time]);
        dump([$request->url(),$time]);
        return response()->json(['name' => 'Abigail', 'state' => 'CA','time'=>$time]);
//        return $content
//            ->header('Dashboard')
//            ->description('Description...')
//            ->body(function (Row $row) {
//                $row->column(6, function (Column $column) {
//                    $column->row(Dashboard::title());
//                    $column->row(new Examples\Tickets());
//                });
//
//                $row->column(6, function (Column $column) {
//                    $column->row(function (Row $row) {
//                        $row->column(6, new Examples\NewUsers());
//                        $row->column(6, new Examples\NewDevices());
//                    });
//
//                    $column->row(new Examples\Sessions());
//                    $column->row(new Examples\ProductOrders());
//                });
//            });
    }
}
