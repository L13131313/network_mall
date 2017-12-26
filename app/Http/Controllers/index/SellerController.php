<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// 表单验证
use Illuminate\Support\Facades\Validator;

// 前台用户模型
use App\Model\index\user;
class SellerController extends Controller
{
    // 注册卖家
    public function register(Request $request)
    {
        $input = $request->except('_token');
        
        if(session('indexUser')['name'] && session('indexUser')['idcard'])
        {
            return back()->with('msg', '请勿重复注册');
        }
        $rule = [
            'name'=>'required|string',
            'idCard'=>'required'
        ];
        $mess =[
            'name.required'=>'姓名必须输入',
            'name.string'=>'姓名错误',
            'idCard.required'=>'身份证必须输入',
        ];

        $validator = Validator::make($input, $rule,$mess);
        //如果验证失败
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $id = session('indexUser')['id'];
        $user = User::find($id);
        $user->name = $input['name'];
        $user->idcard = $input['idCard'];
        $user->update(['status'=>1]);
        $user->save();

        return back()->with('msg','注册成功');
    }

    // 验证身份证号
    public function idCard(Request $request)
    {   
        $input = $request->except('_token');
        $id = $input['id'];
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/"; 
        $arr_split = array(); 
        if(!preg_match($regx, $id)) { 
            return 2; 
        } 
        if(15==strlen($id)) {  //检查15位 
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/"; 
            @preg_match($regx, $id, $arr_split); 
            //检查生日日期是否正确 
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 

            if(!strtotime($dtm_birth)) { 
                return 2; 
            }   else { 
                return 1; 
            } 
        }   else { //检查18位

            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/"; 
            @preg_match($regx, $id, $arr_split); 
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 

            if(!strtotime($dtm_birth)) {  //检查生日日期是否正确
                return 2; 
            }   else { 
                //检验18位身份证的校验码是否正确。 
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。 
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); 
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); 
                $sign = 0; 
                for ( $i = 0; $i < 17; $i++ ) { 
                    $b = (int) $id{$i}; 
                    $w = $arr_int[$i]; 
                    $sign += $b * $w; 
                } 
                $n = $sign % 11; 
                $val_num = $arr_ch[$n]; 
                if ($val_num != substr($id,17, 1)) { 
                    return 2; 
                }   else { //phpfensi.com  
                    return 1; 
                } 
            } 
        } 
    }
}
