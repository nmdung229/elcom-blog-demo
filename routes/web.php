<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;


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
});
//
//Route::get('/test/user', 'TestController@user');
//Route::get('/test/tag', 'TestController@tag');
//Route::get('/test/video', 'TestController@video');
//Route::get('/test/comment', 'TestController@comment');
//Route::get('/test/post', 'TestController@post');
//Route::get('/test/collections', 'TestController@collections');
//Route::get('/test/thumbnail', 'TestController@thumbnail');
//
//Route::get('/test/user/showPermission/{id}', 'UserController@showPermission');
//Route::get('/test/user/login', 'UserController@login');
//Route::get('/test/user/logout', 'UserController@logout');
//
//Route::group(['middleware' => ['role:admin']], function () {
//    Route::get('/test/user/testPermission', 'UserController@testPermission');
//});
//
//Route::get('/post/index', 'PostController@index');
//
//Route::get('/post/filter/{title}', 'TestController@filter');
//Route::get('/post/filterByTag/{tag_id}', 'TestController@filterByTag');

Route::get('/testSwagger', 'TestController@testSwagger');
Route::get('/1skSwaggerServer', 'TestController@swagger1SKServer');
Route::get('/1skSwaggerLocal', 'TestController@swagger1SKLocal');

Route::get('/testOneSignal', 'NotificationController@sendNotiToAll');

Route::get('/1skSwagger', 'TestController@swagger1sk');
