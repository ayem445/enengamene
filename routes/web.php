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

Route::get('/', function () {
    return view('welcome');
    // $user = App\User::find(1);
    // return new App\Mail\ConfirmYourEmail($user);
});

Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::get('/about', function () {
    return "About me";
});

Auth::routes();
Route::get('/logout', function() { auth()->logout(); return redirect('/'); });

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->group(function(){
    Route::resource('cours','CourController');
});
