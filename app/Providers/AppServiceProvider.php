<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Validator::extend('finish_time_after_start_time', 'App\Validators\FinishTimeAfterStartTimeValidator@validate');
        // Validator::extend('event_id_correct', 'App\Validators\EventIdCorrectValidator@validate');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    
}
