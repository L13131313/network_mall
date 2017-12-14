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

Route::get('/', function () {
    return view('welcome');
});

/**
 *  后台
 */
// 登录
Route::get('/register', 'Admin\RegisterController@index');
Route::get('/login', 'Admin\LoginController@index');
Route::post('/login', 'Admin\LoginController@doLogin');

Route::group(['namespace' => 'Admin','prefix'=>'admin', 'middleware' => 'admin'], function () {
    // 后台首页
    Route::resource('/index', 'IndexController');
    Route::get('/list', 'IndexController@list');
    Route::get('/loginOut', 'LoginController@loginOut');
});
