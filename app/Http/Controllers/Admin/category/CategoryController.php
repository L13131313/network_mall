<?php

namespace App\Http\Controllers\Admin\category;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\category\category;
use DB;

class CategoryController extends Controller
{

    public function dopages($offset){

        $record = (new category)->doList();

        $total = ceil(count($record)/5);

        $perlist = array_chunk($record,5);

        $list = $perlist[$offset];

        return view('admin/category/categoryList', ['list'=>$list, 'offset'=>$offset, 'total'=>$total-1]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($offset = 0)
    {

        $record = (new category)->doList();

        $total = ceil(count($record)/5);

        $perlist = array_chunk($record,5);

        $list = $perlist[$offset];

        return view('admin/category/categoryList', ['list'=>$list, 'offset'=>$offset, 'total'=>$total-1]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = (new category)->masterTree();

        return view('admin/category/addCategory', ['list'=>$list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //判断表单是否未填写
        if(trim($request->input('catname1')) == '' && trim($request->input('catname23')) == '' && $request->input('chosed_catid') == ''){
            return redirect('admin/category/create')->with('info','您没有添加分类，请重新添加！');
        }

        //判断是否一次性添加了多级分类
        if(trim($request->input('catname1')) != '' && trim($request->input('catname23')) != ''){
            return redirect('admin/category/create')->with('info','一次只允许添加一种分类，请重新添加！');
        }

        //判断添加的分类名是否与其它分类名重复
        $number = category::select('catname')->count();
        $allname = DB::table('cate')->select('catname')->get();

        for($i = 0;$i < $number;$i++){
            if(trim($request->input('catname1')) == $allname[$i]->catname || trim($request->input('catname23')) == $allname[$i]->catname){

                return redirect('admin/category/create')->with('info','分类名重复，请重新添加！');
            }
        }

        //判断添加数据是否为一级分类
        if(trim($request->input('catname1')) != ''){

            $catname = $request->input('catname1');
            $maxorder = category::select('listorder')->max('listorder');
            $res = category::create(['catname'=>$catname ,'parentid'=>0 ,'arrparentid'=>0 ,'child'=>1 ,'listorder'=>$maxorder+1]);
            if($res){
                return redirect('admin/category')->with('info','添加成功');
            }else{
                return redirect('admin/category/create')->with('info','添加失败');
            }
        }

        //判断添加数据是否为二,三级分类
        if(trim($request->input('catname23')) != ''){

            //判断是否选择了添加二，三级分类在哪个分类下
            if($request->input('chosed_catid') != ''){

                $inputarr = $request->only(['catname23','chosed_catid']);
                $catname = $inputarr['catname23'];
                $pid = $inputarr['chosed_catid'];
                $arrpid = DB::table('cate')->where('catid',$pid)->select('arrparentid')->first();
                $arrpidlength = explode(',' ,$arrpid->arrparentid);
                $maxorder = category::select('listorder')->max('listorder');

                if(count($arrpidlength) == 1){
                    $res = category::create(['catname'=>$catname ,'parentid'=>$pid ,'arrparentid'=>"0,$pid" ,'child'=>1 ,'listorder'=>$maxorder+1]);
                }else{
                    $res = category::create(['catname'=>$catname ,'parentid'=>$pid ,'arrparentid'=>"$arrpid->arrparentid,$pid" ,'child'=>0 ,'listorder'=>$maxorder+1]);
                }

                if($res){
                    return redirect('admin/category')->with('info','添加成功');
                }else{
                    return redirect('admin/category/create')->with('info','添加失败');
                }
            }

            return redirect('admin/category/create')->with('info','您选择了添加二，三级分类，但没有选择下拉框选项，请选择下拉框选项！');
        }

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
        $catdata = DB::table('cate')->where('catid',$id)->first();
        return view('admin/category/editCategory',['catdata'=>$catdata]);
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
        $catname = $request->input('catname');
        $listorder = $request->input('listorder');
        $catdata = DB::table('cate')->where('catid',$id)->first();

        //判断是否为空
        if(trim($catname) == ''){

            return back()->with('info','没有填写分类名,请重新修改!');
        }

        if(trim($listorder) == ''){

            return back()->with('info','没有填写分类排序,请重新修改!');
        }

        $number = category::select('catname')->count();
        $alldata = DB::table('cate')->select('catname','listorder','catid')->get();

        for($i = 0;$i < $number;$i++){

            //自己以外
            if($alldata[$i]->catid == $catdata->catid){
                continue;
            }

            //判断修改的分类名是否与其它分类名重复
            if($catname == $alldata[$i]->catname){

                return back()->with('info','分类名重复,请重新修改!');
            }

            //判断修改的分类排序是否与其它分类排序重复
            if($listorder == $alldata[$i]->listorder){

                return back()->with('info','分类排序重复,请重新修改!');
            }

        }

        $res = category::where('catid',$id)->update(['catname' => $catname ,'listorder' => $listorder]);

        if($res > 0){
            return redirect('admin/category')->with('info','修改成功');
        }else if($res == 0){
            return redirect('admin/category'); //没有做任何修改，直接提交
        }else{
            return back()->with('info','修改失败!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = category::destroy($id);
        if($res > 0){
            return redirect("admin/category")->with('info', '删除成功');
        }else{
            return redirect("admin/category")->with('info', '删除失败');
        }
    }
}
