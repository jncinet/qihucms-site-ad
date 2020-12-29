<?php

namespace Qihucms\SiteAd\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\SiteAd\Models\SiteAd;

class AdController extends ApiController
{
    public function __construct()
    {
        
    }
    /**
     * 后台选择任务
     *
     * @param Request $request
     * @return mixed
     */
    public function findSiteAdByQ(Request $request)
    {
        $q = $request->query('q');
        return SiteAd::where('name', 'like', '%' . $q . '%')->select('id', 'title as text')->paginate();
    }
}