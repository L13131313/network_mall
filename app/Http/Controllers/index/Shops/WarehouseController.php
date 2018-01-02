<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\Goods\Goods;
use App\Models\Goods\Goods_attr;
use App\Models\Goods\Goods_details;
use App\Models\Goods\Goods_spec;
use App\Models\goods\Goods_specifications;
use App\Models\Shops\S_nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $gid = Goods::lists('id');
        $spec = [];
        foreach ($gid as $v) {
            $spec[] = Goods_spec::where('gid', $v)->first();
        }
        return view('index.shops.warehouse.list', compact('data', 'spec'));
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
        $data = Goods::where('id', $id)->with('goods_spec')->with('goods_details')->get();
        $goodsCatId = $data['0']->cate_id;
        // 获取商品属性
        $res = Goods_attr::orderBy('attrSort')->where('goodsCatId', $goodsCatId)->with('attr_val')->get();
        // 获取商品规格
        $spec = Goods_specifications::orderBy('specName')->where('goodsCatId', $goodsCatId)->get();

        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

        // 获取店铺分类
        $nav = S_nav::orderBy('sort','asc')->where('uid',$uid)->get();


        return view('index.shops.warehouse.edit', compact('data', 'spec', 'res', 'nav'));
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
        $res = DB::transaction(function () use($id) {

            // 删除封面图
            $g_cover = Goods::where('id', $id)->lists('g_cover');
            unlink($_SERVER['DOCUMENT_ROOT'].$g_cover['0']);
            Goods::where('id', $id)->delete();

            // 删除商品规格
            Goods_spec::where('gid', $id)->delete();

            // 删除详情图
            $photoAll = Goods_details::where('gid', $id)->lists('g_typepic');
            $g_typepic = unserialize($photoAll['0']);

            foreach ($g_typepic as $v) {
                unlink($_SERVER['DOCUMENT_ROOT'].$v);
            }
            Goods_details::where('gid', $id)->delete();

        });

        if ($res == null) {
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
