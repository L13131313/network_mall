<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test');
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
        $file = $request->file('photo');
        // dd($file);
        // 验证
        $check = $this->checkFile($file);
        if(!$check['status']){
            return response()->json(['ServerNo' => '400','ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path('/index/uploads/');
        // return $path;
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        $fileName = md5(time().rand(0,10000)).'.'.$postfix;
        // 移动
        if(!$file->move($path,$fileName)){
            return response()->json(['ServerNo' => '400','ResultData' => '文件保存失败']);
        }
        // 这里处理 数据库逻辑
        /**
        *Store::uploadFile(['fileName'=>$fileName]);
        **/
        return response()->json(['ServerNo' => '200','ResultData' => $fileName]);
    }

    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }
        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }
        return ['status' => true];
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
}
