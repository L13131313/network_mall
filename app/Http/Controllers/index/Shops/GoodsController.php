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
        //dd($spec);

        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

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

        $input = $request->except('_token');
        $messages = [
            'g_name.required' => '标题不能为空！',
            'color.required' => '颜色不能为空！',
            'spec.required' => '规格不能为空！',
            'g_price.required' => '价格不能为空！',
            'g_discount.required' => '价格不能为空！',
            'g_count.required' => '库存不能为空！',
            'cover.required' => '封面图不能为空！',
            'g_count.integer' => '库存必须为整数！',
            'cover.integer' => '封面图必须是图片！',
            'g_discount.integer' => '价格必须为数字！',
            'g_price.integer' => '价格必须为数字！',
        ];
        $this->validate($request,[
            'g_name'=>'required',
            'color'=>'required',
            'spec'=>'required',
            'g_discount'=>'required|numeric',
            'g_count'=>'required|integer',
            'cover'=>'required',
            'g_price'=>'required|numeric',
            'cover'=>'image',
        ], $messages);

        // 处理商品主表数据
        $goods = [];
        $goods['g_name'] = $input['g_name'];                             // 商品标题
        $goods['g_status'] = $input['g_status'];                         // 店铺状态
        $goods['g_uptime'] = time();                                     // 商品发布时间
        $goods['shelves_time'] = $goods['g_status'] == 1 ? time() : '';  // 商品上架时间
        $goods['uid'] = session('indexUser')['id'];                  // 获取当前用户id
        // 店铺分类
        $goods['s_nav'] = $input['s_nav'] != 'null' ? implode(',', $input['s_nav']) : '';

        // 处理封面图片
        $g_cover = $request->file('g_cover');                       // 获取上传的封面图
        $path = '/upload/';
        $ext = $g_cover->getClientOriginalExtension();
        $fileName = rand(1000,9999).date('YmdHis', time()).'.'.$ext;
        $res = $g_cover->move(public_path().$path, $fileName);
        if ($res) {
            $cover = $path.$fileName;

        }
        $goods['g_cover'] = $cover;
        dd($goods);

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
