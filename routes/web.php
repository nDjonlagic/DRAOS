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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@dashboard');

Route::get('/staff', 'HomeController@staff');
Route::get('/order', 'HomeController@order');
Route::get('/preparation', 'HomeController@preparation');
Route::get('/payments', 'HomeController@payments');
