<?php

namespace Qihucms\SiteAd\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Qihucms\SiteAd\Jobs\IpToCityJob;
use Qihucms\SiteAd\Models\SiteAdLog;
use Qihucms\SiteAd\Requests\StoreAdLogRequest;
use Qihucms\SiteAd\Resources\SiteAdLog as SiteAdLogResource;
use Qihucms\SiteAd\Resources\SiteAdLogCollection;

class LogController extends Controller
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

        return $this->jsonResponse([__('site-ad::message.params_error')], '', 422);
    }

    /**
     * 广告订单日志详细
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|SiteAdLogResource
     */
    public function show($id)
    {
        $item = SiteAdLog::find($id);

        if ($item && $item->site_ad->user_id == Auth::id()) {
            return new SiteAdLogResource($item);
        }

        return $this->jsonResponse([__('site-ad::message.params_error')], '', 422);
    }

    /**
     * 创建点击日志
     *
     * @param StoreAdLogRequest $request
     * @return \Illuminate\Http\JsonResponse|SiteAdLogResource
     */
    public function store(StoreAdLogRequest $request)
    {
        $data = $request->only(['site_ad_id', 'province', 'city', 'district', 'device', 'browse', 'system', 'net_type']);
        $data['ip'] = $request->ip();
        $data['user_id'] = Auth::id();

        if ($result = SiteAdLog::create($data)) {
            if (!empty($result->ip) && empty($result->province) && empty($result->city)) {
                IpToCityJob::dispatch($result);
            }

            return new SiteAdLogResource($result);
        }

        return $this->jsonResponse([__('site-ad::message.params_error')], '', 422);
    }
}