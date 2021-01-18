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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::post('/admin/product/store', 'HomeController@storeProduct')->name('storeProduct');


Route::get('/product/{productId}', 'MainController@show')->name('single');
Route::get('/', 'MainController@index')->name('main');
Route::post('/product/comment/store', 'MainController@storeComment')->name('storeComment');
Route::post('/product/like', 'MainController@likeProduct')->name('likeProduct');
Route::post('/product/unlike', 'MainController@unlikeProduct')->name('unlikeProduct');

