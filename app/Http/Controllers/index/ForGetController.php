<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 前台用户模型
use App\Model\index\user;

// 表单验证
use Illuminate\Support\Facades\Validator;

// redis 缓存
use Redis;

use DB;

// 密码加密
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

// 云通讯
use App\Org\REST;
class ForGetController extends Controller
{
    // 忘记密码页面
    public function forget()
    {
        return view('index/user/forget');
    }

    // 验证手机
   public function doSendPhone(Request $request)
    {
        $phone = $request->input('phone');
        // return $phone;
        $exists = Redis::exists($phone);
        // return $exists;
        if($exists) {
            return '不能重复获取验证码，请60秒后重试！';
        }   else {
            $user = User::where('tel',$phone)->first();
            if($user) {
                Redis::setex('phone', 60, $phone);
                $num = rand(1000,9999);
                Redis::setex('code', 60, $num);
                // $code = Redis::get('code');
                // return $code;
                $this->sendTemplateSMS($phone,[$num, '1'],"1");                
            }   else {
                return '请输入正确的手机号';
            }
        }
    }

    // 修改密码判断
    public function doForGet(Request $request)
    {
        $input = $request->except('_token');
        // dd($input['tel']);
        $user = User::where('tel',$input['tel'])->first();
        $uid = $user['id'];
        $code = Redis::get('code');
        if($code == $input['code']){
            return view('index.user.changePassword',compact('uid'));
        }   else {
            return back()->with('msg','验证码错误');
        }
    }

    public function changePassword(Request $request)
    {
        $input = $request->except('_token');
        $uid = $input['uid'];
        $rule = [
            'pwd'=>'required|alpha_dash|between:4,18',
            'upwd'=>'required|same:pwd'
        ];

        $mess =[
            'pwd.required'=>'请输入密码',
            'pwd.between'=>'密码必须在4-18位之间',
            'pwd.alpha_dash'=>'密码由数字字母和下划线组成',
            'upwd.required'=>'请再次输入密码',
            'upwd.same'=>'密码不一致'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($uid);
        $res = $user->update(['pwd'=>Crypt::encrypt(trim($input['pwd']))]);
        if($res) {
            return redirect('index/login')->with('msg','请登录');
        }   else {
            return redirect('index/forget')->with('msg', '请重新修改密码');
        }
    }

    // 发送验证码
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
             echo "error code :" . $result->statusCode . "<br>";
             echo "error msg :" . $result->statusMsg . "<br>";
             //TODO 添加错误处理逻辑
         }else{
             echo "验证码已发送!<br/>";
             // 获取返回信息
             $smsmessage = $result->TemplateSMS;
             // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
             // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
             //TODO 添加成功处理逻辑
         }
    }
}
