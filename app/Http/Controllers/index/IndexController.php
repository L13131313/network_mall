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
        return view('xiangmu/parent');
    }

    // 用户首页
    public function index()
    {
        return view('xiangmu/index');
    }

    // 用户详情
    public function information()
    {
        return view('xiangmu/information');
    }

    // 用户修改密码
    public function password()
    {
        return view('xiangmu/password');
    }

    // 用户修改电话
    public function bindphone()
    {
        return view('xiangmu/bindphone');
    }

    // 用户修改Email
    public function email()
    {
        return view('xiangmu/email');
    }

    // 用户安全设置页面
    public function safety()
    {
        return view('xiangmu/safety');
    }

    // 用户地址管理
    public function address()
    {
        return view('xiangmu/address');
    }

    // 用户订单管理
    public function order()
    {
        return view('xiangmu/order');
    }

    // 用户退款页面
    public function change()
    {
        return view('xiangmu/change');
    }

    // 用户退款详情
    public function record()
    {
        return view('xiangmu/record');
    }

    // 用户收藏页面
    public function collection()
    {
        return view('xiangmu/collection');
    }

    // 用户访问页面
    public function foot()
    {
        return view('xiangmu/foot');
    }

    // 用户评价页面
    public function comment()
    {
        return view('xiangmu/comment');
    }

    // 用户评价页面
    public function commentlist()
    {
        return view('xiangmu/commentlist');
    }

    // 用户消息页面
    public function news()
    {
        return view('xiangmu/news');
    }

    // 用户物流信息
    public function logistics()
    {
        return view('xiangmu/logistics');
    }
}
