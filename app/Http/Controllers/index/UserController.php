<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 前台用户模型
use App\Model\index\user;

use DB;
// 表单验证
use Illuminate\Support\Facades\Validator;

// redis 缓存
use Redis;

// 密码加密
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

// aliyun
// use iscms\Alisms\SendsmsPusher as Sms;

// 云通讯
use App\Org\REST;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index/login/register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function phone(Request $request)
    {
        $phone = $request->input('phone');
        // return $phone;
        $exists = Redis::exists($phone);
        // return $exists;
        if($exists) {
            return '不能重复获取验证码，请60秒后重试！';
        }   else {
            // return 11111;
            $res = DB::table('user')->where('tel',$phone)->first();
            // return $res;
            if($res) {
                return '该用户已被注册!';
            }   else {
                Redis::setex('phone', 60, $phone);        
            }
        }
        $num = rand(1000,9999);
        Redis::setex('code', 60, $num);
        $this->sendTemplateSMS($phone,[$num, '1'],"1");
    }

    public function sendTemplateSMS($to,$datas,$tempId)
    {
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        $accountSid= '8aaf0708605841b50160685cac01041d';

        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        $accountToken= '9509740096274710bf610b562a1b6eb9';

        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        $appId='8aaf0708605841b50160685cac560423';

        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        $serverIP='app.cloopen.com';


        //请求端口，生产环境和沙盒环境一致
        $serverPort='8883';

        //REST版本号，在官网文档REST介绍中获得。
        $softVersion='2013-12-26';


         $rest = new REST($serverIP,$serverPort,$softVersion);
         $rest->setAccount($accountSid,$accountToken);
         $rest->setAppId($appId);
        
         // 发送模板短信
         echo "Sending TemplateSMS to $to <br/>";
         $result = $rest->sendTemplateSMS($to,$datas,$tempId);
         if($result == NULL ) {
             echo "result error!";
             die;
         }
         if($result->statusCode!=0) {
             echo "error code :" . $result->statusCode;
             echo "error msg :" . $result->statusMsg;
             //TODO 添加错误处理逻辑
         }else{
             echo "验证码已发送!";
             // 获取返回信息
             $smsmessage = $result->TemplateSMS;
             // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
             // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
             //TODO 添加成功处理逻辑
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->except('_token');
         
         $rule = [
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'pwd'=>'required|alpha_dash|between:4,18',
            'upwd'=>'required|same:pwd'
        ];

        $mess =[
            'tel.required'=>'请输入手机号',
            'tel.regex'=>'手机号码错误',
            'pwd.required'=>'请输入密码密码',
            'pwd.alpha_dash'=>'密码由数字字母和下划线组成',
            'pwd.between'=>'密码必须在4-18位之间',
            'upwd.required'=>'请再次输入密码',
            'upwd.same'=>'密码不一致'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('index/register')
                ->withErrors($validator)
                ->withInput();
        }

        $code = Redis::get('code');
        // dd($code);
        if($input['code'] != $code){
            return redirect('index/register')->with('msg','验证码错误');
        }

        $user = new User();
        $user->tel = $input['tel'];
        $user->pwd = Crypt::encrypt($input['pwd']);
        $res = $user -> save();
        // session::('adminUser'=>$user);
//        7 登录成功 就跳转到后台首页，失败就跳转回登录页
        return redirect('index/login');
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
    }
}
