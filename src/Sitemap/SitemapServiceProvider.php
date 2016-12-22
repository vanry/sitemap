<?php

namespace Vanry\Sitemap;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('sitemap', function ($app) {
            return new Sitemap;
        });

        $this->app->alias('sitemap', Sitemap::class);
    }
}
