<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('logout', 'Api\AuthController@logout')->middleware('auth:api');

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('product', 'Api\ProductController@index');
    Route::get('product/{id}', 'Api\ProductController@show');
    Route::post('product', 'Api\ProductController@store');
    Route::put('product/{id}', 'Api\ProductController@update');
    Route::delete('product/{id}', 'Api\ProductController@destroy');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('customer', 'Api\CustomerController@index');
    Route::get('customer/{id}', 'Api\CustomerController@show');
    Route::post('customer', 'Api\CustomerController@store');
    Route::put('customer/{id}', 'Api\CustomerController@update');
    Route::delete('customer/{id}', 'Api\CustomerController@destroy');
});

Route::middleware(['auth:api', 'request.log'])->get('/logout', function (Request $request) {
    $request->user()->token()->revoke();
});
