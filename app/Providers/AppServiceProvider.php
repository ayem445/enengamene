<?php

namespace App\Providers;

use App\Chapitre;
use App\Cour;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

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

        JsonResource::withoutWrapping();
    }
}
