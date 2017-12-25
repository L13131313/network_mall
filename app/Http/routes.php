<?php



/*<
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
Route::group(['prefix' => 'index'/*, 'middleware' => 'index'*/], function () {
	// 个人中心父模板
	Route::get('parent', 'index\IndexController@parent');
	// 个人中心首页
	Route::get('user', 'index\IndexController@index');
	// 用户详情
	Route::get('information', 'index\IndexController@information');
	// 安全设置
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

	// 用户退出




































































});
// 登录页面
Route::get('index/login', 'index\LoginController@index');
// 登录操作
Route::post('index/login', 'index\LoginController@doLogin');

// 用户注册
Route::resource('index/register', 'index\UserController');
// 验证码类
Route::post('index/phone', 'index\UserController@phone');































/**
 *  后台
 */
// 登录
Route::get('admin/login', 'Admin\LoginController@index');

// 提交登录信息
Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');
Route::post('admin/login', 'Admin\LoginController@doLogin');

// 后台路由群主
Route::group(['namespace' => 'Admin','prefix'=>'admin'/*, 'middleware' => 'admin'*/], function () {
    // 后台首页
    Route::resource('index', 'IndexController@index');
    // 店铺列表页面
    Route::resource('shops', 'Shops\ShopsController');
    // 用户管理
    Route::resource('user', 'user\UserController');
    // 退出登录
    Route::get('/loginOut', 'LoginController@loginOut');

    //分类管理
    Route::resource('category', 'category\CategoryController');
    Route::get('category/pages/{offset}', 'category\CategoryController@dopages');

    // 订单显示页面
    Route::resource('/OrderList', 'OrderListController');

    // 商品属性

    Route::post('attribute/classification', 'Attribute\AttributeController@classification');    // 处理分类ajax请求
    Route::get('attribute/create/value', 'Attribute\AttributeController@value');                // 添加属性值
    Route::post('attribute/create/attribute', 'Attribute\AttributeController@attribute');       // ajax请求属性名
    Route::post('attribute/create/doAttr', 'Attribute\AttributeController@doAttr');             // 添加属性值
    Route::post('attribute/attrvalue', 'Attribute\AttributeController@attrValue');              // ajax请求属性值
    Route::get('attribute/spec', 'Attribute\AttributeController@spec');                         // 添加规格页面
    Route::post('attribute/dospec', 'Attribute\AttributeController@doSpec');                    // 添加规格逻辑
    Route::resource('attribute', 'Attribute\AttributeController');

});

/*李天君*/
//后台商品管理路由
Route::resource('admin/goods', 'Admin\Goods\GoodsController');
Route::get('admin/goods/show', 'Admin\Goods\GoodsController@show');
//前台首页商品展示
Route::resource('index/goods', 'Index\Goods\GoodsController');

//后台投诉管理
Route::resource('admin/complaint','Admin\Complaint\ComplaintController');


/**
 * 前台卖家中心
 */
Route::group(['namespace' => 'index\Shops','prefix'=>'shops'/*, 'middleware' => 'shops'*/], function () {
    Route::get('index', 'ShopsController@index');

    // 前台卖家商品管理
    Route::get('goods/sellList', 'GoodsController@sellList');                   // 出售中商品列表
    Route::post('goods/doShelves', 'GoodsController@doShelves');                // 出售中的商品下架操作
    Route::resource('goods', 'GoodsController');                                // 商品选择分类页面
    Route::post('goods/classification', 'GoodsController@classification');      // 处理分类ajax请求
    Route::post('warehouse/doShelves', 'WarehouseController@doShelves');        // 仓库中的商品上架操作
    Route::resource('warehouse', 'WarehouseController');                        // 仓库中的商品

});

