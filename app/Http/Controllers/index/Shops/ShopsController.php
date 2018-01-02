<?php

namespace App\Http\Controllers\index\Shops;


use App\Models\Goods\Goods;
use App\Models\Shops\S_nav;
use App\Models\Shops\Shops;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

        $data = Shops::where('uid', $uid)->get();

        return view('index.shops.shop.index', compact('data'));
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

    /**
     * 店铺页面
     * @param $id
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showShops($id, $url, Request $request)
    {

        // 获取店铺信息
        $data = Shops::find($id);
        // 获取当前店铺内分类
        $nav = S_nav::orderBy('sort', 'asc')->where('uid', $id)->get();
        $path = 'index/shops/'.$id.'/'.$url;
        // 获取该店铺下所有商品
        $goods = Goods::orderBy('shelves_time', 'desc')->where('sid', $id)->with('goods_details')->with('goods_spec')->get();
        // 获取热卖商品
        $heat = Goods::orderBy('shelves_time', 'desc')->where('sid', $id)->where('g_heat', 1)->get();

        if ($data == null || $data->s_status == 0 || $data->s_link != $path) {
            return view('errors.404');
        }
        return view('index.shops.index', compact('data', 'nav', 'goods', 'heat'));
    }

    /**
     * 店铺分类页面
     * @param $sid
     * @param $nav_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCate($sid, $nav_id)
    {
        // 获取店铺信息
        $data = Shops::find($sid);
        // 获取当前店铺内分类
        $nav = S_nav::orderBy('sort', 'asc')->where('uid', $sid)->get();

        // 获取当前分类下商品
        $goods = Goods::orderBy('shelves_time', 'desc')->where('sid', $sid)->where('nav_id', $nav_id)->with('goods_details')->with('goods_spec')->get();

        return view('index.shops.cateGoods', compact('data', 'nav', 'goods'));
    }

}
