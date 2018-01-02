<?php

namespace App\Http\Controllers\index\Shops;

use App\Model\index\User;
use App\Models\Shops\Shops;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopAdminController extends Controller
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

        return view('index.shops.shop.shopsInfo', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * 修改店铺信息
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shopsInfo(Request $request)
    {
        // 获取登录的用户ID
        $uid = session('indexUser')['id'];

        $data = $request->except('_token', 's_log');

        // 处理log图
        $s_log = $request->file('s_log');
        if ($s_log) {
            $path = '/index/upload/';
            $ext = $s_log->getClientOriginalExtension();
            $fileName = rand(1000,9999).date('YmdHis', time()).'.'.$ext;
            $new_log = $path.$fileName;
            $data['s_log'] = $new_log;
            $s_log->move(public_path().$path, $fileName);
        }

        $result = Shops::where('uid', $uid)->update($data);

        if ($result) {
            return back()->with('message', '操作成功！');
        }
        return back()->with('message', '操作失败！');
    }
}
