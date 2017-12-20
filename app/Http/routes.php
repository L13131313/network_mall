<?php





































































/**
 *  后台
 */
// 登录
Route::get('/login', 'Admin\LoginController@index');
// 提交登录信息
Route::post('/login', 'Admin\LoginController@doLogin');

// 后台路由群主
Route::group(['namespace' => 'Admin','prefix'=>'admin'/*, 'middleware' => 'admin'*/], function () {

    // 后台首页
    Route::resource('index', 'IndexController');
    //
   // Route::get('/list', 'IndexController@list');
    //退出登录
    Route::get('/loginOut', 'LoginController@loginOut');


    //分类管理
    Route::resource('/category', 'category\CategoryController');
    Route::get('/category/pages/{offset}', 'category\CategoryController@dopages');
});
