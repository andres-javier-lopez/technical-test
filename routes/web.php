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

Route::get('/csrf', function(){
    return csrf_token();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index');
Route::get('/products/{product}', 'ProductController@show');
Route::post('/products/{product}/like/{user}', 'ProductController@like')->middleware('auth:api');
Route::post('/products/{product}/unlike/{user}', 'ProductController@unlike')->middleware('auth:api');
Route::post('/products/new', 'ProductController@insert')->middleware('auth:api', 'admin');
Route::put('/products/{product}', 'ProductController@update')->middleware('auth:api', 'admin');
Route::delete('/products/{product}', 'ProductController@delete')->middleware('auth:api', 'admin');
Route::post('/products/{product}/purchase', 'ProductController@purchase')->middleware('auth:api');

Route::get('/purchase_history', 'HistoryController@purchaseHistory')->middleware('auth:api');
Route::get('/price_history', 'HistoryController@priceHistory')->middleware('auth:api');
