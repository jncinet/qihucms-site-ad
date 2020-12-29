<?php

namespace Qihucms\SiteAd\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\SiteAd\Jobs\IpToCityJob;
use Qihucms\SiteAd\Models\SiteAdLog;
use Qihucms\SiteAd\Resources\SiteAdLog as SiteAdLogResource;
use Qihucms\SiteAd\Resources\SiteAdLogCollection;

class LogController extends ApiController
{
    /**
     * 广告点击列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|SiteAdLogCollection
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        $site_ad_id = (int)$request->get('id');
        if ($site_ad_id) {
            $items = SiteAdLog::where('site_ad_id', $site_ad_id)->orderBy('id', 'desc')->paginate($limit);

            return new SiteAdLogCollection($items);
        }

        return $this->jsonResponse(['参数错误'], '', 422);
    }

    /**
     * 详细 IpToCityJob::dispatch($log);
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|SiteAdLogResource
     */
    public function show($id)
    {
        $item = SiteAdLog::find($id);

        if ($item && $item->site_ad->user_id == \Auth::id()) {
            return new SiteAdLogResource($item);
        }

        return $this->jsonResponse(['参数错误'], '', 422);
    }
}