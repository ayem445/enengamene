<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/redis', function(){
//   // key: value // string
//   //Redis::set('friend', 'momo');
//   dd(Redis::get('friend'));
//   // key: value // list
//   // key: value // set
// });

Auth::routes();

Route::get('/', 'FrontendController@welcome');
Route::get('/profile/{user}', 'ProfileController@index')->name('profile');
Route::get('/cours/{cour}', 'FrontendController@cour')->name('cours');
Route::get('/watch-cours/{cour}', 'WatchCoursController@index')->name('cours.learning');
Route::get('/chapitre/{chapitre}/session/{session}', 'WatchCoursController@showSession')->name('cours.watch');
Route::post('/chapitre/terminer-session/{session}', 'WatchCoursController@terminerSession');

Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::get('/logout', function() { auth()->logout(); return redirect('/'); });
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('admin')->prefix('admin')->group(function(){
    Route::resource('cours','CourController');
    Route::resource('quizs','QuizController');
    Route::resource('{chapitre_by_id}/sessions','SessionController');
    Route::resource('{cour_by_id}/chapitres','ChapitreController');
    //Route::resource('{cour_by_id}/chapitres/{chapitre_by_id}','ChapitreController');

    // Route::resource('{cour_by_id}/quizcours','QuizCourController');
    // Route::resource('{chapitre_by_id}/quizchapitres','QuizChapitreController');
    // Route::resource('{session_by_id}/quizsessions','QuizSessionController');
    //
    Route::get('/quizsessions/create/{session_by_id}','QuizController@createsession')->name('quizsessions.create');
    Route::post('/quizsessions/store/{session_by_id}','QuizController@storesession')->name('quizsessions.store');

    Route::get('/quizchapitres/create/{chapitre_by_id}','QuizController@createchapitre')->name('quizchapitres.create');
    Route::post('/quizchapitres/store/{chapitre_by_id}','QuizController@storechapitre')->name('quizchapitres.store');

    Route::get('/quizcours/create/{cour_by_id}','QuizController@createcour')->name('quizcours.create');
    Route::post('/quizcours/store/{cour_by_id}','QuizController@storecour')->name('quizcours.store');

    //Route::resource('quizquestions','QuizQuestionController');
    Route::resource('{quiz_by_id}/quizquestions','QuizQuestionController');
    Route::resource('{quizquestion_by_id}/quizreponses','QuizReponseController');
    //Route::resource('taxonomy/{term}','QuizReponseController', ['parameters' => ['{term}' => 'your_name']]);
});
