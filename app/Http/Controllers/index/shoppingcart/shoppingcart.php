<?php

namespace App\Http\Controllers\index\shoppingcart;

use App\Models\shoppingCart\sp_cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class shoppingcart extends Controller
{
    //展示购物车
    public function showList(){

        $uid = session('indexUser')['id'];
        $list = DB::table('sp_cart')
                    ->where('sp_cart.uid',$uid)
                    ->join('goods_spec','sp_cart.g_specid','=','goods_spec.id')
                    ->get();
                    
        return view('index/shoppingcart/shoppingcart', ['list'=>$list]);
    }

    //添加购物车
    public function addgoods($gid,$g_specid,$count){

        //购物车已存在此商品
        $isExist = DB::table('sp_cart')->where('gid',$gid)->first();
        if($isExist){
            return 2;
        }

        $uid = session('indexUser')['id'];
        $goodsinfo = DB::table('goods')
                    ->select('goods.g_name','goods.g_link','shops.s_name','shops.s_link','goods.g_cover')
                    ->where('goods.id',$gid)
                    ->where('goods_spec.id',$g_specid)
                    ->join('goods_spec','goods_spec.gid','=','goods.id')
                    ->join('shops','shops.id','=','goods.sid')
                    ->first();

        $res = DB::table('sp_cart')->insert(['uid'=>$uid,'gid'=>$gid,'count'=>$count,'g_specid'=>$g_specid,'g_name'=>$goodsinfo->g_name,'g_pic'=>$goodsinfo->g_cover,'g_link'=>$goodsinfo->g_link,'s_name'=>$goodsinfo->s_name,'s_link'=>$goodsinfo->s_link]);
        if($res){
           return 1;    //加入购物车成功
        }
    }

    //删除商品
    public function destroy(Request $request)
    {
        $gid = $request->input('gid');

        $res = sp_cart::where('gid',$gid)->delete();

        return $res;
    }

    //清空购物车
    public function flush(){

        $res = DB::table('sp_cart')->truncate();

        return $res;
        
    }

    //结算购物车
    public function account(Request $request){
        
        $orderData = $request->input('orderData');
        $data = explode(',',$orderData);
        for($i = 0;$i < count($data)-1;$i++){
            if($i%4 == 0){
              $gid = $data[$i];
              sp_cart::where('gid',$gid)->delete();
            }
        }

        $id = session('indexUser')['id'];

        $addr = DB::table('addr')->where('uid',$id)->get();

        return view('index.orders.userOrders',['data'=>$data,'addr'=>$addr]);
         
    }

}
