<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Cour;
use App\Quiz;
use App\Chapitre;
use App\QuizReponse;
use App\QuizQuestion;
use App\Session;
use App\Product;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::model('cour_by_id', Cour::class);
        Route::bind('cour_by_id', function($value){
            return Cour::findOrFail($value);
         });

        Route::model('chapitre_by_id', Chapitre::class);
        Route::bind('chapitre_by_id', function($value){
            return Chapitre::findOrFail($value);
        });

        Route::model('session_by_id', Session::class);
        Route::bind('session_by_id', function($value){
            return Session::findOrFail($value);
        });

        Route::model('quiz_by_id', Quiz::class);
        Route::bind('quiz_by_id', function($value){
            return Quiz::findOrFail($value);
        });

        Route::model('quizquestion_by_id', QuizQuestion::class);
        Route::bind('quizquestion_by_id', function($value){
            return QuizQuestion::findOrFail($value);
        });

        Route::model('quizreponse_by_id', QuizReponse::class);
        Route::bind('quizreponse_by_id', function($value){
            return QuizReponse::findOrFail($value);
        });

        Route::patterns(['product_id' => '[0-9]+']);
        Route::model('product_id', Product::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
