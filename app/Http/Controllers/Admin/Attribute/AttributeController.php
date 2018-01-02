<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Models\Goods\Goods_attr;
use App\Models\Goods\Goods_attr_val;
use App\Models\goods\Goods_specifications;
use App\Models\Shops\Cate;
use App\Tools\AreaCache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Goods_attr::orderBy('attrid','asc');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('attrName', 'like','%'.$search.'%');
        }
        $data = $query->paginate(2);
        return view('admin.goodsAttribute.attrList', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Cache::flush();
        return view('admin.goodsAttribute.addAttribute');
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
            'attrName.required' => '属性名不能为空！',
            'attrType.required' => '类型不能为空！',
            'attrSort.required' => '排序不能为空！',
            'attrSort.integer' => '排序必须为整数！',
        ];
        $this->validate($request,[
            'attrName'=>'required',
            'attrSort'=>'required|integer',
            'attrType'=>'required',
        ], $messages);

        $data = $request->except('_token');
        $catname = Cate::where('catid', $data['goodsCatId'])->first()->catname;
        $data['catname'] = $catname;

       $res = Goods_attr::insert($data);

       if ($res) {
           return redirect('admin/attribute')->with('message', '添加成功！');
       }
        return back()->with('message', '添加失败！');
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
        $data = Goods_attr::find($id);

        return view('admin.goodsAttribute.editAttribute', compact('data'));
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
        $data = $request->except('_token', '_method');

        $res = Goods_attr::find($id)->update($data);

        if ($res) {
            return redirect('admin/attribute')->with('message', '修改成功!');
        }
        return back()->with('message', '修改失败!');
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
            DB::table('goods_attr')->where('attrid', $id)->delete();

            DB::table('goods_attr_val')->where('attrid', $id)->delete();
        });

       if ($res == null) {
           return response()->json(['status'=> 200 , 'message' => '操作成功！']);
       }

        return response()->json(['status'=> 202 , 'message' => '操作失败！']);
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

    /**
     * 添加属性值页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function value()
    {
        $res = DB::table('goods_attr')->lists('catName', 'goodsCatId');
        $data = array_unique($res);

        return view('admin.goodsAttribute.addValue', compact('data'));
    }


    /**
     * ajax请求属性名
     */
    public function attribute(Request $request)
    {
        $goodsCatId = $request->get('goodsCatId');

        $data = Goods_attr::where('goodsCatId', $goodsCatId)->lists('attrName', 'attrid');

        return response()->json(['data' => $data]);
    }

    /**
     * 添加属性值
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doAttr(Request $request)
    {
        $messages = [
            'attrid.required' => '属性名不能为空！',
            'attrVal.required' => '属性值不能为空！',
        ];
        $this->validate($request,[
            'attrid'=>'required',
            'attrVal'=>'required',
        ], $messages);

        $data = $request->except('_token');

        $res = Goods_attr_val::insert($data);

        if ($res) {
            return redirect('admin/attribute')->with('message', '添加成功！');
        }
        return back()->with('message', '添加失败！');
    }

    /**
     * ajax请求属性值
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function attrValue(Request $request)
    {
        $attrid = $request->get('attrid');
        $data = Goods_attr_val::where('attrid', $attrid)->lists('attrVal');

        return response()->json(['data' => $data]);
    }
}
