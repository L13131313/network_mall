<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\Goods\Goods;
use App\Models\Goods\Goods_attr;
use App\Models\goods\Goods_specifications;
use App\Models\Shops\Cate;
use App\Models\Shops\S_nav;
use App\Models\Shops\Shops;
use App\Tools\AreaCache;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class GoodsController extends Controller
{
    /**
     * 商品选择分类页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::flush();
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
        $goodsCatId = $data['class_three'];
        // 获取商品属性
        $res = Goods_attr::orderBy('attrSort')->where('goodsCatId', $goodsCatId)->with('attr_val')->get();
        // 获取商品规格
        $spec = Goods_specifications::orderBy('specName')->where('goodsCatId', $goodsCatId)->get();
        session(['indexUser'=> 1]);
        // 获取登录的用户ID
        $uid = session('indexUser');

        $nav = S_nav::orderBy('sort','asc')->where('uid',$uid)->get();

        return view('index.shops.publish', compact('data', 'res', 'spec', 'nav'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       $file = $request->file('tupian');
        $file = $_FILES;
       dd($file);
//        $data = $request->all();
        foreach ($file as $v) {

            dump($v);
        }
//        $destinationPath = '/upload';
//        $ext = $file->getClientOriginalExtension();
//        $fileName = rand(1000,9999).time().'.'.$ext;
//
//        $file->move(public_path().$destinationPath, $fileName);
        return 1;
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
        //dd($data);
        return response()->json(['data' => $data]);
    }

    /**
     * 出售中的商品列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellList(Request $request)
    {   // 获取登录的用户ID
        $id = session('indexUser')['id'];

        // 获取当前卖家出售中的商品
        $search = $request->get('search');
        $query = Goods::orderBy('shelves_time','desc');
        if (!empty($search)){
            $query->where('g_name', 'like','%'.$search.'%');
        }

        // 获取搜索分页
        $data = $query->where('uid', $id)->where('g_status', 1)->paginate(2);

        return view('index.shops.sellList',compact('data'));
    }

    /**
     * 出售中的商品下架操作
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doShelves(Request $request)
    {
        $id = $request->get('id');
        $res = Goods::where('id', $id)->update(['g_status' => 0]);

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '操作成功！']);
        }

        return response()->json(['status'=> 202 , 'message' => '操作失败！']);
    }
}
