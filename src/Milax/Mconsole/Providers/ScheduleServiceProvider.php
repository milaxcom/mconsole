<?php

namespace Milax\Mconsole\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('queue:work database')->everyMinute();
        // });
    }
    
    public function register()
    {
        //
    }
}
