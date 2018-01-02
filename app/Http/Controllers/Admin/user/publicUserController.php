<?php

namespace App\Http\Controllers\Admin\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 前台用户模型
use App\Model\index\user;

use DB;
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
    public function publicList(Request $request)
    {
        $userinfo = User::orderBy('id','asc')
            ->where('status',1)
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
         return view('admin.user.publicList', ['userinfo'=>$userinfo, 'request'=>$request]);
    }

    public function doOpen(Request $request)
    {
        $input = $request->all();
        if($input['openid'] == 1) {
            $openid = 0;
        }   else {
            $openid = 1;
        }
        
        // return ($openid);
        $id = $input['id'];
        // return $id;
        $res = DB::table('user')->where('id',$id)->update(['open'=>$openid]);

        if($res){
            $data=[
                'status'=> 0,
            ];
        }else{
            $data=[
                'status'=> 1,
            ];
        }
        return $data;
    }
}
