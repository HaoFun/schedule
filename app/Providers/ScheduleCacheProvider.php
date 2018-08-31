<?php

namespace App\Providers;

use App\Handlers\ScheduleCache;
use Illuminate\Support\ServiceProvider;

class ScheduleCacheProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('ScheduleCache', function () {
            return new ScheduleCache();
        });
    }
}
