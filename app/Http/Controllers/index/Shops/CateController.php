<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\Shops\S_nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

        // 获取当前卖家仓库中的商品
        $search = $request->get('search');
        $query = S_nav::orderBy('sort','asc');
        if (!empty($search)){
            $query->where('nav_name', 'like','%'.$search.'%');
        }

        // 获取搜索分页
        $data = $query->where('uid', $uid)->paginate(2);

        return view('index.shops.cate.cateList', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index.shops.cate.addCate');
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
            'nav_name.required' => '分类名不能为空！',
            'sort.required' => '排序不能为空！',
            'sort.integer' => '排序必须为整数！',
        ];
        $this->validate($request,[
            'nav_name'=>'required',
            'sort'=>'required|integer',
        ], $messages);

        $data = $request->except('_token');
        // 获取登录的用户ID
        $uid = session('indexUser')['id'];
        $data['uid'] = $uid;
        $res = S_nav::insert($data);
        if ($res) {
            return redirect('shops/cate')->with('message', '发布成功！');
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
       $data = S_nav::where('id', $id)->first();

       return view('index.shops.cate.editCate', compact('data'));
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
        $messages = [
            'nav_name.required' => '分类名不能为空！',
            'sort.required' => '排序不能为空！',
            'sort.integer' => '排序必须为整数！',
        ];
        $this->validate($request,[
            'nav_name'=>'required',
            'sort'=>'required|integer',
        ], $messages);

        $data = $request->except('_token', '_method');

        $res = S_nav::where('id', $id)->update($data);
        if ($res) {
            return redirect('shops/cate')->with('message', '修改成功！');
        }
        return back()->with('message', '修改失败！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = S_nav::where('id', $id)->delete();

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '删除成功！']);
        }

        return response()->json(['status'=> 202 , 'message' => '删除失败！']);
    }
}
