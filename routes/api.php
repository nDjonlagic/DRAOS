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

Route::get('meal/types', 'Api\MealsController@categories');
Route::get('meal/types/{type}/{id}', 'Api\MealsController@meals');

Route::post('order/create', 'Api\OrdersController@create');
Route::post('order/add/{id}', 'Api\OrdersController@add');
Route::post('order/remove/{id}', 'Api\OrdersController@remove');
Route::post('order/finish', 'Api\OrdersController@finish');
Route::post('order/quantity/{id}', 'Api\OrdersController@quantity');
Route::post('order/queue', 'Api\OrdersController@queue');
Route::post('order/await', 'Api\OrdersController@await');
Route::post('order/await/payment', 'Api\OrdersController@awaitPayment');
Route::post('order/ready2pay', 'Api\OrdersController@readyToPay');

Route::get('order/list', 'Api\OrdersController@list');
Route::get('order/list/active', 'Api\OrdersController@active');
Route::get('order/list/payment', 'Api\OrdersController@listAwaitingPayment');
Route::get('order/current/{id}', 'Api\OrdersController@current');
Route::get('order/unfinished', 'Api\OrdersController@unfinishedOrders');

Route::post('preparation/take', 'Api\PrepareController@take');
Route::post('preparation/finish', 'Api\PrepareController@finish');