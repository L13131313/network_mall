<?php

namespace App\Http\Controllers\Admin\Spec;

use App\Models\goods\Goods_specifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Goods_specifications::orderBy('id','asc');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('specName', 'like','%'.$search.'%');
        }
        $data = $query->with('cate')->paginate(2);

        return view('admin.goodsSpec.specList', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goodsSpec.spec');
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
            'specName.required' => '规格不能为空！',
            'goodsCatId.required' => '分类不能为空！',
        ];
        $this->validate($request,[
            'specName'=>'required',
            'goodsCatId'=>'required',
        ], $messages);
        $data = $request->except('_token');

        $res = Goods_specifications::insert($data);
        if ($res) {
            return redirect('admin/spec')->with('message', '添加成功！');
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

        $data = Goods_specifications::where('id', $id)->with('cate')->get();

        return view('admin.goodsSpec.editSpec', compact('data'));
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
            'specName.required' => '规格不能为空！',
        ];
        $this->validate($request,[
            'specName'=>'required',
        ], $messages);

        $data = $request->only('specName');

        $res = Goods_specifications::where('id', $id)->update($data);

        if ($res) {
            return redirect('admin/spec')->with('message', '修改成功！');
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
        $res = Goods_specifications::where('id', $id)->delete();

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '删除成功！']);
        }
        return response()->json(['status'=> 202 , 'message' => '删除失败！']);
    }
}
