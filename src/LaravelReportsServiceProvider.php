<?php

namespace Bernadev\LaravelReports;

use Illuminate\Support\ServiceProvider;

class LaravelReportsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateReport::class
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bernadev');
    }
}
