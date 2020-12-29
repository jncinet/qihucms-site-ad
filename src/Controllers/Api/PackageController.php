<?php

namespace Qihucms\SiteAd\Controllers\Api;

use App\Http\Controllers\Controller;
use Qihucms\SiteAd\Models\SiteAdPackage;
use Qihucms\SiteAd\Resources\SiteAdPackage as SiteAdPackageResource;
use Qihucms\SiteAd\Resources\SiteAdPackageCollection;

class PackageController extends Controller
{
    /**
     * 套餐列表
     *
     * @return SiteAdPackageCollection
     */
    public function index()
    {
        $items = SiteAdPackage::where('status', 1)->latest()->get();

        return new SiteAdPackageCollection($items);
    }

    /**
     * 套餐详细
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|SiteAdPackageResource
     */
    public function show($id)
    {
        $item = SiteAdPackage::where('status', 1)->where('id', $id)->first();

        if ($item) {
            return new SiteAdPackageResource($item);
        }

        return $this->jsonResponse(['套餐不存在'], '', 422);
    }
}