<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\Goods\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取登录的用户ID
        $id = session('indexUser')['id'];

        // 获取当前卖家仓库中的商品
        $search = $request->get('search');
        $query = Goods::orderBy('g_uptime','desc');
        if (!empty($search)){
            $query->where('g_name', 'like','%'.$search.'%');
        }

        // 获取搜索分页
        $data = $query->where('uid', $id)->where('g_status', 0)->paginate(2);

        return view('index.shops.warehouse.list', compact('data'));
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
        $res = Goods::where('id', $id)->delete();

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '删除成功！']);
        }

        return response()->json(['status'=> 202 , 'message' => '删除失败！']);
    }

    /**
     * 仓库中的商品上架操作
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doShelves(Request $request)
    {
        $id = $request->get('id');
        $time = time();
        $res = Goods::where('id', $id)->update(['g_status' => 1, 'shelves_time' => $time]);

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '操作成功！']);
        }

        return response()->json(['status'=> 202 , 'message' => '操作失败！']);
    }
}
