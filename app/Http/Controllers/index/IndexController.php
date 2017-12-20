<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 前台用户父类
    public function parent()
    {
        return view('layouts/parent');
    }

    // 用户首页
    public function index()
    {
        return view('index/user/index');
    }

    // 用户详情
    public function information()
    {
        return view('index/user/information');
    }

    // 用户修改密码
    public function password()
    {
        return view('index/user/password');
    }

    // 用户修改电话
    public function bindphone()
    {
        return view('index/user/bindphone');
    }

    // 用户修改Email
    public function email()
    {
        return view('index/user/email');
    }

    // 用户安全设置页面
    public function safety()
    {
        return view('index/user/safety');
    }

    // 用户地址管理
    public function address()
    {
        return view('index/user/address');
    }

    // 用户订单管理
    public function order()
    {
        return view('index/user/order');
    }

    // 用户退款页面
    public function change()
    {
        return view('index/user/change');
    }

    // 用户退款详情
    public function record()
    {
        return view('index/user/record');
    }

    // 用户收藏页面
    public function collection()
    {
        return view('index/user/collection');
    }

    // 用户访问页面
    public function foot()
    {
        return view('index/user/foot');
    }

    // 用户评价页面
    public function comment()
    {
        return view('index/user/comment');
    }

    // 用户评价页面
    public function commentlist()
    {
        return view('index/user/commentlist');
    }

    // 用户消息页面
    public function news()
    {
        return view('index/user/news');
    }

    // 用户物流信息
    public function logistics()
    {
        return view('index/user/logistics');
    }

    // 用户物流信息
    public function status()
    {
        return view('index/user/status');
    }
}
