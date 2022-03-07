<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;

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
Route::get('list-category/{category_id}', 'TestController@myFunction');
//Route::resource('post', 'PostController');
/**
 * Route for post
 */
Route::group(['prefix' => 'post'], function (){
    Route::get('/getAll', 'PostController@index');
    Route::get('/show/{id}', 'PostController@show');
    Route::post('/create', 'PostController@store');
    Route::post('/update/{id}', 'PostController@update');
    Route::delete('/delete/{id}', 'PostController@destroy');
    Route::get('/filterByTitle/{title}', 'PostController@filterByTitle');
    Route::get('/filterByTag/{tag_id}', 'PostController@filterByTag');
    Route::get('/searchBySummary/{summary}', 'PostController@searchBySummary');
});
//
///**
// * Route for video
// */
//Route::group(['prefix' => 'video'], function (){
//    Route::get('/getAll', 'VideoController@index');
//    Route::get('/show/{id}', 'VideoController@show');
//    Route::post('/create', 'VideoController@store');
//    Route::post('/update/{id}', 'VideoController@update');
//    Route::delete('/delete/{id}', 'VideoController@destroy');
//    Route::get('/filterByTitle/{title}', 'VideoController@filterByTitle');
//    Route::get('/filterByTag/{tag_id}', 'VideoController@filterByTag');
//    Route::get('/searchByDescription/{description}', 'VideoController@searchByDescription');
//
//});



