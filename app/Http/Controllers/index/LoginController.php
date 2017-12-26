<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 前台用户模型
use App\Model\index\user;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

// 表单验证
use Illuminate\Support\Facades\Validator;

// 密码加密
use Illuminate\Support\Facades\Crypt;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index/login/login');
    }

    public function doLogin(Request $request)
    {
        $input = $request->except('_token');
        //dd($input);
        
        $rule = [
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'pwd'=>'required|alpha_dash|between:4,18'
        ];

        $mess =[
            'tel.required'=>'请输入手机号',
            'tel.regex'=>'手机号码错误',
            'pwd.required'=>'请输入密码',
            'pwd.alpha_dash'=>'密码由数字字母和下划线组成',
            'pwd.between'=>'请输入4-18位之间的密码'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('index/login')
                ->withErrors($validator)
                ->withInput();
        }

//        4. 判断是否有此用户
        $user = User::where('tel',$input['tel'])->first();
        if(empty($user)){
            return redirect('index/login')->with('msg','账号不存在');
        }

//        5. 判断密码是否正确
        if(Crypt::decrypt($user->pwd) != $input['pwd'])
        {
            return redirect('index/login')->with('msg','密码错误');
        }

//        6 将当前登录用户的数据存入session中，
        session(['indexUser' => $user]);
        // dd(session('indexUser'))    ;
//        7 登录成功 就跳转到前台首页，失败就跳转回登录页
        return redirect('index/user');
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('index/login');
    }
}
