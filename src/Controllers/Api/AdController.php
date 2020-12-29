<?php

namespace Qihucms\SiteAd\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Qihucms\SiteAd\Models\SiteAd;

/**
 * 广告订单通过一对一多态关联模型在对应模块创建
 *
 * Class AdController
 * @package Qihucms\SiteAd\Controllers\Api
 */
class AdController extends Controller
{
    /**
     * 后台选择广告订单
     *
     * @param Request $request
     * @return mixed
     */
    public function selectAd(Request $request)
    {
        $q = $request->query('q');
        return SiteAd::where('id', $q)
            ->select('id', 'moduleable_type as text')
            ->paginate();
    }
}