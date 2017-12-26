<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\Shops\Cate;
use App\Tools\AreaCache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /**
     * 商品选择分类页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.shops.release');
    }

    /**
     * 发布商品页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        //dd($data['class_one']);
//        $res = AreaCache::getOneId($data['class_three'])->catname;
//        dd($res);
        return view('index.shops.publish', compact('data'));
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
    public function update(Request $request)
    {

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
     * 处理分类ajax请求
     *
     * @return \Illuminate\Http\Response
     */
    public function classification(Request $request)
    {
        $catid = $request->get('catid');
        $data = AreaCache::getCateId($catid);

        return response()->json(['data' => $data]);
    }

}
