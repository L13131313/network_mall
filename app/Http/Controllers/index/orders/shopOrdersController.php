<?php

namespace App\Http\Controllers\Index\orders;

use Illuminate\Http\Request;
use DB;

use App\Models\OrderList;
use App\Models\Shops\Shops;
use App\Models\Addr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class shopOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //通过当前登录用户获取用户id
          $id = 1;
          // $id = session('indexUser')['id'];
          // 通过用户id获取该用户下所有的店铺id；
        $shopInfo = DB::table('shops')->where('id',$id)->first();
        // dd($shopInfo);

        $data = DB::table('OrderList')
                ->where('sid',$shopInfo->id)

                ->where(function($query) use($request){

                if(!empty($request->input('search'))) {
                    $query->where($request->select,'like','%'.$request->input('search').'%');
                }
            })
                 ->orderBy('id', 'desc')->paginate(3);
        // dd($data);
        return view('index.orders.orderInfo',['data' => $data,'request'=> $request]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $info = DB::select("select * from OrderList where id = {$id}");

        return view('index.orders.orderGet',['info' => $info]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $res = OrderList::find($id)->delete();
//          $res = DB::table('users')->where('id', '=', $id)->delete();
//          // dd($);
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

// //        返回json格式的数据

        return $data;
    }

    public function updt(Request $request){
        
        $addr = $request->input('addr');
        $id = $request->input('id');
        OrderList::where('id',$id)->update(['addr'=>$addr]);
        
    }

    public function changeStatus(Request $request){
        $id = $request->input('id');
        $choose = $request->input('chs');
        OrderList::where('id',$id)->update(['o_status'=>$choose]);
    }

}
