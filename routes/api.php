<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => 'auth:api'],function ()
{
    // users
    Route::get('/users', 'UserController@index');
    Route::get('/users/{id}', 'UserController@show');
    Route::post('/users', 'UserController@store');
    Route::put('/users/{id}', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@destroy');

    // product

    Route::get('/products', 'ProductController@index');
    Route::get('/products/{id}', 'ProductController@show');
    Route::post('/products', 'ProductController@store');
    Route::put('/products/{id}', 'ProductController@update');
    Route::delete('/products/{id}', 'ProductController@destroy');

    //order

    Route::get('/orders', 'OrderController@index');
    Route::get('/orders/{id}', 'OrderController@show');
    Route::post('/orders', 'OrderController@store');
    Route::put('/orders/{id}', 'OrderController@update');
    Route::delete('/orders/{id}', 'OrderController@destroy');
    Route::post('/orders/status/{id}','OrderController@statusOrder');

 // orderLog

    Route::get('/order-logs', 'OrderLogController@index');
    Route::delete('/order-logs', 'OrderLogController@delete');


});
