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

Route::get('/product', 'ProductController@index')->name('product');
Route::get('/product/fetch', 'ProductController@fetch')->name('product.fetch');
Route::get('/product/{product_id}/edit', 'ProductController@edit')->name('product.edit');
Route::get('/product/{product_id}/destroy', 'ProductController@destroy')->name('product.destroy');

Route::get('/profile/{user}', 'ProfileController@index')->name('profile');

Route::get('/cours/{cour}', 'FrontendController@cour')->name('cours');
Route::get('/coursall', 'FrontendController@coursall')->name('cours.all');
Route::get('/coursgetall', 'FrontendController@coursgetall')->name('cours.getall');

Route::get('/watch-cours/{cour}', 'WatchCoursController@index')->name('cours.learning');
Route::get('/chapitre/{chapitre}/session/{session}', 'WatchCoursController@showSession')->name('cours.watch');
Route::get('/fincours/{cour}', 'WatchCoursController@showFinCours')->name('cours.fin');
Route::post('/chapitre/terminer-session/{session}', 'WatchCoursController@terminerSession');

Route::get('/doquiz/{quiz_by_id}', 'DoQuizController@showQuiz')->name('quizs.do');
Route::post('/doquiz/{quiz_by_id}', 'DoQuizController@saveQuiz')->name('quizs.dosave');

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
    Route::get('/quizsessions/{session_by_id}/create','QuizController@createsession')->name('quizsessions.create');
    Route::post('/quizsessions/{session_by_id}/store','QuizController@storesession')->name('quizsessions.store');
    Route::post('/quizsessions/{session_by_id}/destroy','QuizController@destroysession')->name('quizsessions.destroy');

    Route::get('/quizchapitres/{chapitre_by_id}/create','QuizController@createchapitre')->name('quizchapitres.create');
    Route::post('/quizchapitres/{chapitre_by_id}/store','QuizController@storechapitre')->name('quizchapitres.store');
    Route::post('/quizchapitres/{chapitre_by_id}/destroy','QuizController@destroychapitre')->name('quizchapitres.destroy');

    Route::get('/quizcours/{cour_by_id}/create','QuizController@createcour')->name('quizcours.create');
    Route::post('/quizcours/{cour_by_id}/store','QuizController@storecour')->name('quizcours.store');
    Route::post('/quizcours/{cour_by_id}/destroy','QuizController@destroycour')->name('quizcours.destroy');

    //Route::resource('quizquestions','QuizQuestionController');
    Route::resource('{quiz_by_id}/quizquestions','QuizQuestionController');
    Route::resource('{quizquestion_by_id}/quizreponses','QuizReponseController');
    //Route::resource('taxonomy/{term}','QuizReponseController', ['parameters' => ['{term}' => 'your_name']]);
});
