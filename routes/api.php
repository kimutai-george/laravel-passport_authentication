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

/**
 * Login and Register Routes
 */
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::resource('products', 'ProductController');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
 
    Route::resource('tasks', 'TaskController');
});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
