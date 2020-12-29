<?php

namespace Qihucms\SiteAd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteAdLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'site_ad_id', 'user_id', 'ip', 'province', 'city', 'district', 'device', 'browse', 'system', 'net_type'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return BelongsTo
     */
    public function site_ad(): BelongsTo
    {
        return $this->belongsTo('Qihucms\SiteAd\Models\SiteAd');
    }
}