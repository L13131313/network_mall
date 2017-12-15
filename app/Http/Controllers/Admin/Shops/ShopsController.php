<?php

namespace App\Http\Controllers\Admin\Shops;

use App\Models\Shops\Shops;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Shops::orderBy('s_time','asc')
            ->where(function($shops) use($request) {
                $select = $request->only('select');
                $search = $request->only('search');
                if ($select == 0) {
                    $shops->where('s_name', 'like', '%' . $search . '%');
                }

                if ($select == 1) {
                    $shops->where('nickname','like','%'.$search.'%');
                }
            })
        ->paginate(2);

        return view('admin.shops.shopsList', ['data' => $data, 'request' => $request]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = Shops::find($id);
        return view('admin.shops.shopsDetails', ['data' => $data]);
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
    public function destroy($id, Request $request)
    {
        $status = $request->get('status');

        $res = Shops::where('id', $id)->update(['s_status' => $status]);

        if ($res) {
            return response()->json(['status'=> 200 , 'message' => '操作成功']);
        }
        return response()->json(['status'=> 202 , 'message' => '操作失败']);
    }

}
