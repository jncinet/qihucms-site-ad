<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'prefix' => 'site-ad',
    'namespace' => 'Qihucms\SiteAd\Controllers\Api',
    'middleware' => ['api'],
    'as' => 'api.ad.'
], function (Router $router) {
//    $router->get('site-ads/{uri}', 'CarouselController@index')->name('api.carousel.index');
});

// 后台管理
Route::group([
    'prefix' => config('admin.route.prefix') . '/site-ad',
    'namespace' => 'Qihucms\SiteAd\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('packages', 'PackageController');
    $router->resource('ads', 'AdController');
    $router->resource('logs', 'LogController');
});