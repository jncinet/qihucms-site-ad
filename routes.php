<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'prefix' => config('qihu.site_ad_prefix', 'site-ad'),
    'namespace' => 'Qihucms\SiteAd\Controllers\Api',
    'middleware' => ['api'],
    'as' => 'api.ad.'
], function (Router $router) {
    $router->get('select', 'AdController@selectAd')->name('select');
    $router->apiResource('logs', 'LogController')
        ->only(['index', 'show', 'store'])->middleware('auth:api');
    $router->apiResource('packages', 'PackageController')
        ->only(['index', 'show']);
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