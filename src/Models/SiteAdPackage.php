<?php

namespace Qihucms\SiteAd\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteAdPackage extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'count', 'unit', 'amount', 'currency_type_id', 'status'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'count' => 'integer',
        'unit' => 'integer',
        'amount' => 'decimal:2'
    ];

    /**
     * @return HasMany
     */
    public function site_ad(): HasMany
    {
        return $this->hasMany('Qihucms\SiteAd\Models\SiteAd');
    }

    /**
     * @return BelongsTo
     */
    public function currency_type(): BelongsTo
    {
        return $this->belongsTo('Qihucms\Currency\Models\CurrencyType');
    }
}