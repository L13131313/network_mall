<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Models\complaint\Complaint;
use App\Models\complaint\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    /**
     * 显示投诉列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $complaint = Complaint::with('Goods','Shops','User')->get();
        $input = $request->input('keywords') ? $request->input('keywords') : '';
        $complaint = Complaint::where('t_content','like','%'.$input.'%')->paginate(2);
        //dd($complaint);
        return view('admin.complaint.complaint',compact('complaint','input'));


    }

    /**
     * 删除投诉信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res = Complaint::find($id)->delete();
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
     * 查看投诉详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = Complaint::with('Goods','Shops','User')->where('id','=',$id)->get();
//        dd($complaint);
        return view('admin.complaint.show',compact('complaint'));
    }

}
