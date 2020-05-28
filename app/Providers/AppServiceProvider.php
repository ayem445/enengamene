<?php

namespace App\Providers;
use App\Chapitre;
use App\Cour;
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
     //   Route::model('cour_by_id',Cour::Class);
      //  Route::bind('cour_by_id', function($value){

           // return Cour::findOrFail($value);
       // });
    }
}
