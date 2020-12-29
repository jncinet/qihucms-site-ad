<?php

namespace Qihucms\SiteAd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Qihucms\SiteAd\Events\SiteAdUpdated;

class SiteAd extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'site_ad_package_id', 'user_id', 'start_time', 'end_time', 'uv', 'pv'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'uv' => 'integer',
        'pv' => 'integer'
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => SiteAdUpdated::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function moduleable()
    {
        return $this->morphTo();
    }

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
    public function site_ad_package(): BelongsTo
    {
        return $this->belongsTo('Qihucms\SiteAd\Models\SiteAdPackage');
    }
}