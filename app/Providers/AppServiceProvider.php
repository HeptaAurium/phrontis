<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\Stream;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer(
            '*',
            function () {
                $general_settings = GeneralSetting::find(1);
                View::share(['general_settings' => $general_settings]);
            }
            
        );
        Schema::defaultStringLength(191);
    }
}
