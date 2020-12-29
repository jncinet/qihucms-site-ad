<?php

namespace Qihucms\SiteAd\Resources;

use App\Http\Resources\User\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteAdLog extends JsonResource
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
            'site_ad_id' => $this->site_ad_id,
            'user_id' => $this->user_id ? new User($this->user) : null,
            'ip' => $this->ip,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'device' => $this->device,
            'browse' => $this->browse,
            'system' => $this->system,
            'net_type' => $this->net_type,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
