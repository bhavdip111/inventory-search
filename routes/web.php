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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ProductController@index')->name('home');

Route::group([ 'middleware' => ['auth']], function () {
	Route::post('products/search-product', 'ProductController@search');
	Route::get('products/reset', 'ProductController@reset');
	Route::resource('products', 'ProductController');
});

