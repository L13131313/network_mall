<?php

namespace App\Http\Controllers\Admin\lunbo;

use App\Models\lunbo\Lunbo;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
class LunboController extends Controller
{
   
    //文件上传方法
    public function upload(Request $request)
    {

        //获取文件上传对象
        $input = $request->file('file_upload');
        
        //获取上传文件的后缀名
        $ext = $input->getClientOriginalExtension();
        //生成新文件名
        $fileName = md5(time().rand(1000,9999).uniqid()).'.'.$ext;


//        将文件上传对象移动到指定的位置
        $input->move(public_path().'/images/lunbo/', $fileName);

        $data ='/images/lunbo/'.$fileName;
        return  $data;
    }
    public function doUpload()
    {
        $input = input::except('_token');
        // dd($input);
        $lunbo = new Lunbo();
        $lunbo->lbpath = $input['art_thumb'];
        $lunbo->shopid = $input['art_editor'];
        $res = $lunbo->save();
        if ($res) {
            return redirect('admin/lunbo')->with('msg','添加成功');
        }else {
              return back()->with('msg','添加失败');
        }
        // return view('admin.lunbotu.lists');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 查询轮播图数据
        // $lunbo = Lunbo::with('Shops')->paginate(3);
        $input = $request->input('keywords') ? $request->input('keywords') : '';
        $lunbo = Lunbo::where('shopid','like','%'.$input.'%')->paginate(2);
        // dd($lunbo);
        //返回轮播图列表页
        return view('admin.lunbotu.lists',compact('lunbo','input'));
    }

    //轮播图删除
     public function destroy($id)
    {
       // return $id;
        $res = Lunbo::find($id)->delete();
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
// 返回json格式的数据
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示添加轮播图页面
       return view('admin.lunbotu.add');
    }
   
}
