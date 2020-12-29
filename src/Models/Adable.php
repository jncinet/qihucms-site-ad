<?php

namespace Qihucms\SiteAd\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Adable
{
    public function site_ad(): MorphOne
    {
        return $this->morphOne('Qihucms\SiteAd\Models\SiteAd', 'moduleable');
    }
}