<?php

namespace Qihucms\SiteAd;

use Illuminate\Support\ServiceProvider;

class SiteAdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'site-ad');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/site-ad'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
