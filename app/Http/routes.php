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
Route::group(['prefix' => 'index', 'middleware' => 'index'], function () {
	// 个人中心父模板
	Route::get('parent', 'index\IndexController@parent');
	// 个人中心首页
	Route::get('user', 'index\IndexController@index');
	// 用户详情
	Route::get('information', 'index\IndexController@information');
	// 用户头像上传
	Route::resource('upload', 'index\UserInfoController');
	// 安全设置
	Route::get('safety', 'index\IndexController@safety');
	// 地址管理
	Route::get('address', 'index\IndexController@address');
	// 修改密码
	Route::get('password', 'index\IndexController@password');
	Route::post('password', 'index\UserInfoController@password');
	// 修改手机号
	Route::get('bindphone', 'index\IndexController@bindphone');
	Route::post('sendCode', 'index\UserInfoController@sendCode');
	Route::post('rSendCode', 'index\UserInfoController@rSendCode');
	Route::post('changeTel', 'index\UserInfoController@changeTel');

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

	// 成为卖家
	Route::post('seller', 'index\SellerController@register');
	// 验证身份证
	Route::post('idCard', 'index\SellerController@idCard');

	// 用户退出
	Route::get('logOut', 'index\LoginController@logOut');
});
// 登录页面
Route::get('index/login', 'index\LoginController@index');
// 登录操作
Route::post('index/login', 'index\LoginController@doLogin');

// 用户注册
Route::resource('index/register', 'index\UserController');
// 手机验证码类
Route::post('index/phone', 'index\UserController@phone');
// 忘记密码
Route::get('index/forget', 'index\ForGetController@forget');
Route::post('index/doForGet', 'index\ForGetController@doForGet');
Route::post('index/doSendPhone', 'index\ForGetController@doSendPhone');
Route::post('index/changePassword', 'index\ForGetController@changePassword');

// 测试
Route::resource('/upload','PhotoController');





































/**
 *  后台
 */
// 登录
Route::get('admin/login', 'Admin\LoginController@index');

// 提交登录信息
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
Route::post('admin/login', 'Admin\LoginController@doLogin');

// 后台路由群主
Route::group(['namespace' => 'Admin','prefix'=>'admin', 'middleware' => 'admin'], function () {
    // 后台首页
    Route::resource('index', 'IndexController@index');
    // 店铺列表页面
    Route::resource('shops', 'Shops\ShopsController');
    // 用户管理
    Route::resource('user', 'user\UserController');
    Route::get('publicUserList','user\publicUserController@publicUserList');
    Route::get('publicList','user\publicUserController@publicList');
    // 退出登录
    Route::get('/loginOut', 'LoginController@loginOut');
});

// 前台卖家中心
Route::group(['namespace' => 'index\Shops','prefix'=>'shops'/*, 'middleware' => 'shops'*/], function () {
    Route::get('index', 'ShopsController@index');

    // 前台卖家商品管理
    // 商品选择分类页面
    Route::resource('goods', 'GoodsController');
    // 处理分类ajax请求
    Route::post('goods/classification', 'GoodsController@classification');

});

