<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

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
        Blade::if('aDemarreLeCours', function($cour) {
            return auth()->user()->aDemarreLeCours($cour);
        });
        Blade::if('admin', function() {
            return auth()->user()->isAdmin();
        });
    }
}
