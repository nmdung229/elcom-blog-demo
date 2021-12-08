<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/product', function (Request $request) {
    return $request->user();
});

//Route::post('/product')
Route::group(['prefix' => 'product'], function (){
   Route::post('/create', 'ProductController@store');
   Route::get('/{id}', 'ProductController@show');
//   Route::post('/update/{id}', 'ProductController@update');
   Route::match(['put', 'patch'], '/update/{id}', 'ProductController@update');
   Route::delete('/delete/{id}', 'ProductController@destroy');
});
