<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->group(['middleware'=>['refresh']], function (Router $router) {
        $router->post('/', 'HomeController@index');
        $router->post('/report', 'HomeController@report');
    });
});
