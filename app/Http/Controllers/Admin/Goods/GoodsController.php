<?php

namespace App\Http\Controllers\Admin\Goods;
use App\Models\Goods\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
    /**
     * xia
     * 商品控制器
     * 2017-10-9
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// 商品查询
    public function index(Request $request)
    {   
        //查询所有的商品信息
         $goods = Goods::get();
         // dd($goods);
       //表明商品状态
        $goods->g_status = [1=>'新品','上架','下架'];

        $input = $request->input('keywords') ? $request->input('keywords') : '';
        $goods = Goods::where('g_name','like','%'.$input.'%')->paginate(3);

        return view('admin.goods.list',compact('goods','input'));
    }
// 商品删除
     public function destroy($id)
    {
       // return $id;
        $res = Goods::find($id)->delete();
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
// 商品详情查询
    public function show($id)
    {
      
       $goods = Goods::find($id);

     
        return view('admin.goods.show',compact('goods'));
    }
   
}
