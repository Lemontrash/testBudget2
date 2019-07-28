<?php

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
// use App\Htpp\Middleware\LoggedIn;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/getCurrentUser', 'UserController@getCurrentUser')->middleware('loggedIn');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('loggedIn');

Route::post('/getAllCategories', 'CategoryController@getAllCategories')->middleware('loggedIn');

Route::post('/getAllActivities', 'ActivityController@getAllActivities')->middleware('loggedIn');
Route::post('/addActivity', 'ActivityController@addActivity')->middleware('loggedIn');
Route::post('/deleteActivity', 'ActivityController@deleteActivity')->middleware('loggedIn');

Route::post('/getSummaryForLastMonth', 'SummaryController@getSummaryForLastMonth')->middleware('loggedIn');
Route::post('/getSummaryForLastYear', 'SummaryController@addActivity')->middleware('loggedIn');
Route::post('/getSummaryForSetAmountOfDays', 'SummaryController@getSummaryForSetAmountOfDays')->middleware('loggedIn');
