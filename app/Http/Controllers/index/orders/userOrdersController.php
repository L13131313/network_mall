<?php

namespace App\Http\Controllers\Index\orders;

use Illuminate\Http\Request;

use DB;

use App\Models\OrderList;
use App\Models\Shops\Shops;
use App\Models\Addr;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class userOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         //通过当前登录用户获取用户id
          $id = 1;
          // $id = session('indexUser')['id'];
        // dd($shopInfo);
        //
        $addr = DB::table('addr')->where('uid',$id)->get();
        // dd($addr);
        // $data = DB::table('OrderList')->where('uid',$id)->orderBy('id', 'desc')->paginate(3);
        // dd($data);
        return view('index.orders.userOrders',['addr'=>$addr]);

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
        //
    }
}
