<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 前台用户模型
use App\Model\index\user;

class publicUserController extends Controller
{
    // 普遍用户列表
    public function publicUserList(Request $request)
    {
         $userinfo = User::orderBy('id','asc')
            ->where('status',0)
            ->where(function($query) use($request){
            //检测关键字
            $tel = $request->input('tel');
            //如果用户名不为空
            if(!empty($username)) {
                $res = User::where('tel','13520113452')->first();
                if($res)
                {
                    $query->where('tel','like','%'.$tel.'%');
                }
            }
        })
             ->paginate(2);
         return view('admin.user.publicUserList', ['userinfo'=>$userinfo, 'request'=>$request]);
    }

    // 卖家列表
    public function publicList()
    {
        return view('admin.user.publicList');
    }
}
