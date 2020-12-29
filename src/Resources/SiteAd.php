<?php

namespace Qihucms\SiteAd\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteAd extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'site_ad_package' => new SiteAdPackage($this->site_ad_package),
            'user_id' => $this->user_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'uv' => $this->uv,
            'pv' => $this->pv,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
