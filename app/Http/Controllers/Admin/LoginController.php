<?php

namespace App\Http\Controllers\Admin;


// use App\Http\Middleware\Admin;
use App\Model\admin\user\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 验证码
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
        return view('admin.login.login');
    }

    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // dd($phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {

       // 1.获取用户提交的数据
          $input = $request->except('_token');
         // dd($input);
//        2. 做数据的表单验证

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

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        // dd(session('code'));

//        3. 验证码是否正确
        if($input['code'] != session('code')){
            return redirect('admin/login')->with('msg','验证码错误');
        }

//        4. 判断是否有此用户
        $user = User::where('name',$input['name'])->first();
        if(empty($user)){
            return redirect('admin/login')->with('msg','用户名不存在');
        }

//        5. 判断密码是否正确
        if(Crypt::decrypt($user->pwd) != $input['pwd'])
        {
            return redirect('admin/login')->with('msg','密码错误');
        }

//        6 将当前登录用户的数据存入session中，
        session(['user' => $user]);
            // dd(session('user')['name']);
//        7 登录成功 就跳转到后台首页，失败就跳转回登录页
        return redirect('admin/index');
    }

    public function loginOut(Request $request)
    {
        $request->session()->flush();
        return redirect('admin/login');
    }
}
