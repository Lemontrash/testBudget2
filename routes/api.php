<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/getAllCategories', 'CategoryController@getAllCategories');

Route::post('/getAllActivities', 'ActivityController@getAllActivities');
Route::post('/addActivity', 'ActivityController@addActivity');

Route::post('/getSummaryForLastMonth', 'SummaryController@getSummaryForLastMonth');
Route::post('/getSummaryForLastYear', 'SummaryController@addActivity');//->middleware('auth:api');
Route::post('/getSummaryForSetAmountOfDays', 'SummaryController@getSummaryForSetAmountOfDays');
