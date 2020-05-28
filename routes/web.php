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

Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::get('/logout', function() { auth()->logout(); return redirect('/'); });
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::post('/chapitre/terminer-session/{session}', 'WatchCoursController@terminerSession');
    Route::get('/watch-cours/{cour}', 'WatchCoursController@index')->name('cours.learning');
    Route::get('/chapitre/{chapitre}/session/{session}', 'WatchCoursController@showSession')->name('cours.watch');
});

Route::middleware('admin')->prefix('admin')->group(function(){
    Route::resource('cours','CourController');
    Route::resource('{chapitre_by_id}/sessions','SessionController');
});
