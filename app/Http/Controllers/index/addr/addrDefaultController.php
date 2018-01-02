<?php

namespace App\Http\Controllers\index\addr;

use Illuminate\Http\Request;
use DB;

use App\Models\Addr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class addrDefaultController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $data = OrderList::get();
//         dd(111);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response


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
   // public function update(Request $request, $id)
   //  {

   //  $res = DB::table('addr')->where('status',1)->update('status',0)->get();

   //  $data = DB::table('addr')->where('id',$id)->update(['status'=>1]);

   // // if($res && $ress){
   // //          $data=[
   // //              'status'=> 0,
   // //              'msg'=>'默认修改成功',
   // //          ];
   // //      }else{
   // //          $data=[
   // //              'status'=> 1,
   // //              'msg'=>'默认修改失败',
   // //          ];
   // //      }

   //  return '135';
   //  }



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
        $uid = 10;                                                  //此uid从session中获取用户id。

        $status = DB::table('addr')->where('uid',$uid)->having('status', '=', 1)->get();
        // return $status;
        if( $status ){
            $res = DB::table('addr')->where('uid',$uid)->where('status',1)->update(['status'=>0]);

            $ress = DB::table('addr')->where('id',$id)->update(['status'=>1]);

            if($res && $ress){
                $data=[
                    'status'=> 0,
                    'msg'=>'默认修改成功',
                ];
            }else{
                $data=[
                    'status'=> 1,
                    'msg'=>'默认修改失败',
                ];
            }

            return $data;
        }else{
            $ress = DB::table('addr')->where('id',$id)->update(['status'=>1]);

            if($ress){
                $data=[
                    'status'=> 0,
                    'msg'=>'默认修改成功',
                ];
            }else{
                $data=[
                    'status'=> 1,
                    'msg'=>'默认修改失败',
                ];
            }

            return $data;
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

       //
    }
}
