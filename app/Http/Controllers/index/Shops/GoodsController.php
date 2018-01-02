<?php

namespace App\Http\Controllers\index\Shops;


use App\Models\Goods\Goods;
use App\Models\Goods\Goods_attr;
use App\Models\Goods\Goods_spec;
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
use Illuminate\Support\Facades\DB;

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

        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

        $data = Shops::where('uid', $uid)->get();

        return view('index.shops.goodsList.release', compact('data'));
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

        // 获取店铺分类
        $nav = S_nav::orderBy('sort','asc')->where('uid',$uid)->get();

        return view('index.shops.goodsList.publish', compact('data', 'res', 'spec', 'nav'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'g_name.required' => '标题不能为空！',
            'color.required' => '颜色不能为空！',
            'spec.required' => '规格不能为空！',
            'g_price.required' => '价格不能为空！',
            'g_discount.required' => '价格不能为空！',
            'g_count.required' => '库存不能为空！',
            'g_cover.required' => '封面图不能为空！',
            'g_count.integer' => '库存必须为整数！',
            'g_cover.integer' => '封面图必须是图片！',
            'g_discount.integer' => '价格必须为数字！',
            'g_price.integer' => '价格必须为数字！',
            'figure.required' => '详情图不能为空！',
            'nav_id.required' => '店铺分类不能为空！',
        ];
        $this->validate($request,[
            'g_name'=>'required',
            'color'=>'required',
            'spec'=>'required',
            'g_discount'=>'required|integer',
            'g_count'=>'required|integer',
            'g_cover'=>'required|image',
            'g_price'=>'required|integer',
            'figure'=>'required',
            'nav_id'=>'required',
        ], $messages);


       $res = DB::transaction(function () use($request) {
            $input = $request->except('_token');

            // 处理商品主表数据
            $goods = [];
            $goods['g_name'] = $input['g_name'];                                             // 商品标题
            $goods['g_status'] = $input['g_status'];                                         // 店铺状态
            $goods['g_uptime'] = time();                                                     // 商品发布时间
            $goods['shelves_time'] = $goods['g_status'] == 1 ? time() : '';                  // 商品上架时间
            $goods['cate_id'] = $input['cate_id'];                                           // 最后一级分类id
            $goods['uid'] = session('indexUser')['id'];                                  // 获取当前用户id
            $goods['sid'] = Shops::where('uid', $goods['uid'])->lists('id')['0'];            // 获取店铺id
            $goods['goods_url'] = '/index/goods/'.$goods['sid'].'/'.time().rand(1000,9999);  // 商品路径
            $goods['nav_id'] = $input['nav_id'];                                             // 店铺分类

            // 处理封面图片
            $g_cover = $request->file('g_cover');                        // 获取上传的封面图
            $path = '/index/upload/';
            $ext = $g_cover->getClientOriginalExtension();
            $fileName = rand(1000,9999).date('YmdHis', time()).'.'.$ext;
            $cover = $path.$fileName;
            $g_cover->move(public_path().$path, $fileName);

            $goods['g_cover'] = $cover;

            // 数据插入商品表
            $res = DB::table('goods')->insert($goods);

            // 如果插入成功继续往下操作
            if ($res) {
                $gid = DB::table('goods')->where('g_uptime', $goods['g_uptime'])->lists('id')['0'];   // 获取商品id

                // 处理商品详情表
                $content = $request->except('_token', 'cate_id', 'g_name', 'color', 'spec', 'g_price', 'g_discount', 'g_count', 'nav_id', 'g_status', 'g_cover', 'figure');
                $goods_details['g_content'] = serialize($content);

                // 处理商品详情图
                $figure = $request->file('figure');

                $g_typepic = [];
                // 遍历处理商品详情图
                foreach ($figure as $v) {
                    $ext = $v->getClientOriginalExtension();
                    $fileName = rand(1000,9999).date('YmdHis', time()).rand(1000,9999).'.'.$ext;
                    $res = $v->move(public_path().$path, $fileName);
                    if ($res) {
                        $g_typepic[] = $path.$fileName;

                    }
                }
                // 序列化详情图存入$goods_details中
                $goods_details['g_typepic'] = serialize($g_typepic);
                // 存入商品id
                $goods_details['gid'] = $gid;

                // 数据插入商品详情表
                $res = DB::table('goods_details')->insert($goods_details);

                // 如果插入成功继续往下操作
                if ($res) {

                    // 处理商品规格表
                    $g_price = $input['g_price'];                            // 商品原价
                    $g_discount = $input['g_discount'];                      // 商品现价
                    $g_count = $input['g_count'];                            // 商品库存
                    $color = $input['color'];                                // 商品颜色
                    $size = $input['spec'] != 'null' ? $input['spec'] : '';  // 商品大小

                    // 循环获取每个规格对应的颜色
                    foreach ($color as $key => $value) {
                        foreach ($size as $k => $v) {
                            // 插入商品规格表
                            DB::table('goods_spec')->insert([
                                'gid' => $gid,
                                'g_price' => $g_price,
                                'g_discount' => $g_discount,
                                'g_count' => $g_count,
                                'color' => $value,
                                'size' => $v,
                            ]);
                        }
                    }
                }
            }
        });
       if ($res == null) {
           return redirect('shops/goods/sellList')->with('message', '发布成功！');
       }
        return back()->with('message', '发布失败！');
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
        $query = Goods::orderBy('g_heat', 1)->orderBy('shelves_time', 'desc');
        if (!empty($search)){
            $query->where('g_name', 'like','%'.$search.'%');
        }

        // 获取搜索分页
        $data = $query->where('uid', $id)->where('g_status', 1)->paginate(2);
        $gid = Goods::lists('id');
        $spec = [];
        foreach ($gid as $v) {
            $spec[] = Goods_spec::where('gid', $v)->first();
        }

        return view('index.shops.goodsList.sellList',compact('data', 'spec'));
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

    /**
     * 热卖商品处理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function heatGoods(Request $request)
    {
        $data = $request->except('_token');
        $id = $data['id'];
        $g_heat = $data['g_heat'];



        if ($g_heat == 0) {
            // 获取登录的用户ID
            $sid = session('indexUser')['id'];
            // 获取该商家的所有热卖商品
            $num = Goods::where('sid', $sid)->where('g_heat', 1)->lists('g_heat');
            if (count($num) < 6) {

                $res = Goods::where('id', $id)->update(['g_heat' => 1]);
            } else {
                return response()->json(['status'=> 202 , 'message' => '热卖商品已满，请取消后添加！']);
            }
        }

        if ($g_heat == 1) {
            $res = Goods::where('id', $id)->update(['g_heat' => 0]);
        }

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '操作成功！']);
        }
        return response()->json(['status'=> 202 , 'message' => '添加失败！']);
    }
}
