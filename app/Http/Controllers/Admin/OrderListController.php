<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderList;
use App\Models\Addr;
use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $data = OrderList::get();
//         dd(111);
        $data = DB::table('OrderList')

                ->where(function($query) use($request){

                if(!empty($request->input('search'))) {
                    $query->where($request->select,'like','%'.$request->input('search').'%');
                }
            })
                 ->orderBy('id', 'desc')->paginate(3);


        // $t = date('mdHis',time());
        // $t = $t.rand(10,99);
        // return $t;
      return view('admin.orders.orderlist',['data' => $data,'request'=> $request]);
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

        return view('admin.orders.orderDetail',['info' => $info]);

       // $addr = Addr::find();
       // dd ($addr);
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
        //
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


    /*
    *分页搜索订单
    *
    *
    *
     */
}
