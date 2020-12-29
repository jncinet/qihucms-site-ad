<?php

namespace Qihucms\SiteAd\Resources;

use App\Http\Resources\User\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Qihucms\Currency\Resources\Type\Type;

class SiteAdPackage extends JsonResource
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
            'name' => $this->name,
            'desc' => $this->desc,
            'count' => $this->count,
            'unit' => __('site-ad::package.unit_value.' . $this->unit),
            'amount' => $this->amount,
            'currency_type' => new Type($this->currency_type),
        ];
    }
}
