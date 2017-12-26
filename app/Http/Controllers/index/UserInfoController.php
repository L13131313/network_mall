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
class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('photo');
        // dd($file);
        // 验证
        $check = $this->checkFile($file);
        if(!$check['status']){
            return response()->json(['ServerNo' => '400','ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path('/index/uploads/');
        // return $path;
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        $fileName = md5(time().rand(0,10000)).'.'.$postfix;
        // 移动
        if(!$file->move($path,$fileName)){
            return response()->json(['ServerNo' => '400','ResultData' => '文件保存失败']);
        }
        // 这里处理 数据库逻辑
        /**
        *Store::uploadFile(['fileName'=>$fileName]);
        **/
        $id = session('indexUser')['id'];
        $user = User::find($id);        
        $user->pic = asset('index/uploads').'/'.$fileName;
        $user->save();
        session('indexUser')['pic'] = asset('index/uploads').'/'.$fileName;

        return response()->json(['ServerNo' => '200','ResultData' => $fileName]);
    }

    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }
        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }
        return ['status' => true];
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
        // return 11111111;
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
        $input = $request->except('_token','_method');
        
        $rule = [
            'nickname'=>'required|string',
            'age'=>'required|integer|max:100',
            'sex'=>'required'
        ];

        $mess =[
            'nickname.required'=>'您没有输入昵称',
            'nickname.alpha_dash'=>'昵称格式错误',
            'age.required'=>'您没有输入年龄',
            'age.integer'=>'请输入正确的年龄',
            'age.max'=>'请输入正确的年龄',
            'sex.required'=>'您没有选择性别'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            session()->flash('errors', $error);
            return '修改失败';
        }
        $user = User::find($id);
        $user->nickname = $input['nickname'];
        $user->age = $input['age'];
        $user->sex = $input['sex'];

        $user->save();

        session('indexUser')['nickname'] = $input['nickname'];
        session('indexUser')['age'] = $input['age'];
        session('indexUser')['sex'] = $input['sex'];
        return '修改成功';
    }

    // 修改密码
    public function password(Request $request)
    {
        $input = $request->except('_token');
        // dd($input);
          $rule = [
            'pwd'=>'required',
            'npwd'=>'required|alpha_dash|between:4,18',
            'rnpwd'=>'required|same:npwd'
        ];

        $mess =[
            'pwd.required'=>'请输入密码',
            'npwd.required'=>'请输入新密码',
            'npwd.between'=>'密码必须在4-18位之间',
            'npwd.alpha_dash'=>'密码由数字字母和下划线组成',
            'rnpwd.required'=>'请再次输入密码',
            'rnpwd.same'=>'密码不一致'
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = session('indexUser')['id'];
        $user = User::find($id)->first();
        if(Crypt::decrypt($user['pwd']) !== $input['pwd']) {
            return back()->with('msg','原密码错误');
        }
        // dd(Crypt::encrypt($input['npwd']));
        $res = $user->update(['pwd'=>Crypt::encrypt(trim($input['npwd']))]);
        if($res) {
            return back()->with('msg','修改密码成功');
        }   else {
            return back()->with('msg', '修改密码失败');
        }
    }

    // 验证新手机
   public function sendCode(Request $request)
    {
        $phone = $request->input('phone');
        // return $phone;
        $exists = Redis::exists($phone);
        // return $exists;
        if($exists) {
            return '不能重复获取验证码，请60秒后重试！';
        }   else {
            Redis::setex('phone', 60, $phone);
        }
        $num = rand(1000,9999);
        Redis::setex('code', 60, $num);
        $code = Redis::get('code');
        return $code;
        $this->sendTemplateSMS($phone,[$num, '1'],"1");
    }

    // 验证新手机
   public function rSendCode(Request $request)
    {
        $tel = $request->input('tel');
        // return $tel;
        $exists = Redis::exists($tel);
        // return $exists;
        if($exists) {
            return '不能重复获取验证码，请60秒后重试！';
        }   else {
            $res = DB::table('user')->where('tel',$tel)->first();
            if($res) {
                return '该用户已存在!';
            }   else {
                Redis::setex('tel', 60, $tel);        
            }
        }
        $num = rand(1000,9999);
        Redis::setex('rcode', 60, $num);
        $code = Redis::get('rcode');
        return $code;
        // $this->sendTemplateSMS($tel,[$num, '1'],"1");
    }

    public function changeTel(Request $request)
    {
        $input = $request->except('_token');
        // dd($input);   
        $rule = [
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
        ];
        $mess =[
            'tel.required'=>'请输入手机号',
            'tel.regex'=>'手机号码错误',
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $code = Redis::get('code');
        $rcode = Redis::get('rcode');
        if($code != $rcode) {
            return back()->with('msg', '验证码错误');
        }

        $res = User::update(['tel'=>$input['tel']]);

        if($res) {
            return back()->with('msg', '修改成功');
        }   else {
            return back()->with('msg', '修改失败');
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
