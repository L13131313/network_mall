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
// 前台用户模块
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
	Route::get('status', 'index\IndexController@status');
});

Route::get('index/login', 'index\IndexController@login');
Route::resource('index/register', 'index\UserController');



































/**
 *  后台
 */
// 登录
Route::get('admin/login', 'Admin\LoginController@index');
// 提交登录信息
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
Route::post('admin/login', 'Admin\LoginController@doLogin');

// 后台路由群主
Route::group(['namespace' => 'Admin','prefix'=>'admin', 'middleware' => 'login'], function () {

    // 后台首页
    Route::resource('index', 'IndexController@index');
    //
    Route::resource('user', 'user\UserController');
   // Route::get('/list', 'IndexController@list');
    //退出登录
    Route::get('/loginOut', 'LoginController@loginOut');
});





