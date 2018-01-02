<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// redis缓存
use Redis;

// 商品表
use App\Models\Goods\Goods;
class FootController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Redis::lpush('goods',1);
        // Redis::lpush('goods',2);
        // Redis::lpush('goods',3);
        // Redis::lpush('goods',4);
        // Redis::lpush('goods',5);
        $data = [];
        $res = Redis::lrange('goods',0,-1);
        foreach($res as $v) {
            $data[] = Goods::with('goods_spec')->where('id',$v)->first();
        }
        // dd($data);
        return view('index/user/foot',['data'=>$data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del()
    {
        // return 11111111;
        $res = Redis::del('goods');
        if($res){
            return back();
        }   else {
            return back();
        }
    }
}
