<?php

namespace App\Http\Controllers\Admin\user;

use App\Model\admin\user\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 用户列表
        // $user = new User();
         $userinfo = User::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('name');
                //如果用户名不为空
                if(!empty($username)) {
                    // $res = User::where('name','admin')->first();
                    // if($res)
                    // {
                        $query->where('name','like','%'.$username.'%');
                    // }
                }
            })
             ->paginate(2);
         return view('admin.user.list', ['userinfo'=>$userinfo, 'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 添加用户页面
        return view('admin/user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 用户添加操作
        $input = input::except('_token');
        // dd($input);
        
        // 表单验证逻辑
        $rule = [
            'name'=>'required|between:4,18|alpha_dash',
            'pwd'=>'required|between:4,18'
        ];

        $mess =[
            'name.required'=>'用户名必须输入',
            'name.between'=>'用户名必须在4-18位之间',
            'name.alpha_dash'=>'用户名只能由数字字母下划线组成',
            'pwd.required'=>'密码必须输入',
            'pwd.between'=>'密码必须在4-18位之间',
        ];
        // dd($input);
        $validator = Validator::make($input, $rule, $mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 插入数据库
        $user = new User();
        $user->name = $input['name'];
        $user->pwd = Crypt::encrypt($input['pwd']); 
        $user->status = $input['status'];
        $res = $user -> save();

        if($res) {
            return redirect('admin/user')->with('msg', '添加用户成功');
        }   else {
            return back()->with('msg', '添加用户失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // return 111111;
        $userinfo = User::find($id);
        // dd($userinfo);
        $pwd = Crypt::decrypt($userinfo->pwd);
        // dd($pwd);
        return view('admin/user/edit', ['userinfo'=>$userinfo,'pwd'=>$pwd]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = input::except('_token', '_method');
        // dd($input);
        
        // 表单验证逻辑
        $rule = [
            'name'=>'required|between:4,18|alpha_dash',
            'pwd'=>'required|between:4,18'
        ];

        $mess =[
            'name.required'=>'用户名必须输入',
            'name.between'=>'用户名必须在4-18位之间',
            'name.alpha_dash'=>'用户名只能由数字字母下划线组成',
            'pwd.required'=>'密码必须输入',
            'pwd.between'=>'密码必须在4-18位之间',
        ];
        // dd($input);
        $validator = Validator::make($input, $rule, $mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // // $res = DB::table('admin_user')->where('id', $id)->update($input);
        $user = User::find($id);
        $user->name = $input['name'];
        $user->pwd = Crypt::encrypt($input['pwd']); 
        $user->status = $input['status'];
        $res = $user -> save();
        if($res) {
            return redirect('admin/user')->with('msg', '修改成功');
        }   else {
            return back()->with('msg', '修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // return 11111111;
        $res = User::find($id)->delete();
        if($res){
            $data=[
                'status'=> 0,
                'msg'=>'删除成功',
            ];
        }else{
            $data=[
                'status'=> 1,
                'msg'=>'删除失败',
            ];
        }
        return $data;
    }
}
