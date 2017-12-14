<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });





























// 项目文件
Route::group(['prefix' => 'index'], function () {
	Route::get('parent', 'index\IndexController@parent');
	Route::get('user', 'index\IndexController@index');
	Route::get('information', 'index\IndexController@information');
	Route::get('safety', 'index\IndexController@safety');
	Route::get('address', 'index\IndexController@address');
	Route::get('password', 'index\IndexController@password');
	Route::get('email', 'index\IndexController@email');
	Route::get('bindphone', 'index\IndexController@bindphone');
	Route::get('order', 'index\IndexController@order');
	Route::get('change', 'index\IndexController@change');
	Route::get('record', 'index\IndexController@record');
	Route::get('collection', 'index\IndexController@collection');
	Route::get('foot', 'index\IndexController@foot');
	Route::get('comment', 'index\IndexController@comment');
	Route::get('commentlist', 'index\IndexController@commentlist');
	Route::get('news', 'index\IndexController@news');
	Route::get('logistics', 'index\IndexController@logistics');
});