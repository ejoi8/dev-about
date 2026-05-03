<?php

namespace Ejoi8\DevAbout;

use Illuminate\Support\ServiceProvider;

class DevAboutServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->environment('local')) {
            return;
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dev-about');
    }
}
