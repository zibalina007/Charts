<?php

namespace ConsoleTVs\Charts;

use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'charts');

        $this->publishes([
            __DIR__.'/../config/charts.php' => config_path('charts.php'),
        ], 'charts_config');

        $this->publishes([
            __DIR__.'/Assets' => public_path('vendor/consoletvs/charts'),
        ], 'charts_assets');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/consoletvs/charts'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/charts.php', 'charts');

        $this->app->singleton(Builder::class, function ($app) {
            return new Builder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Builder::class];
    }
}
