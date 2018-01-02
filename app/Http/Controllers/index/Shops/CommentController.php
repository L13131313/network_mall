<?php

namespace App\Http\Controllers\index\Shops;

use App\Models\complaint\Complaint;
use App\Models\Evaluate;
use App\Models\Goods\Goods;
use App\Models\Goods\Goods_spec;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * 卖家中心回复管理
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function commentList(Request $request)
    {
        // 获取登录的用户ID
        $id = session('indexUser')['id'];

        $search = $request->get('search');

        // 获取评论内容
        $comment = Evaluate::orderBy('e_reply', 'asc')->orderBy('e_time', 'desc')->with('goods')->get();

        // 获取当前卖家所有的商品id
        $gid = Goods::where('uid', $id)->lists('id');

        $data = [];
        foreach ($comment as $v) {
            foreach ($gid as $n) {
                if ($v->gid == $n) {
                    $data[] = $v;
                }
            }
        }

        return view('index.shops.comment.comment', compact('data'));
    }

    /**
     * 评论回复页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reply($id)
    {
        return view('index.shops.comment.reply', compact('id'));
    }

    /**
     * 评论回复操作
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doReply(Request $request)
    {
        $messages = [
            'e_reply.required' => '回复不能为空！',
        ];
        $this->validate($request,[
            'e_reply'=>'required',
        ], $messages);

        $data = $request->except('_token');

        $res = Evaluate::where('id', $data['id'])->update('e_reply', $data['e_reply']);

        if ($res) {
            return redirect('shops/commentList')->with('message', '回复成功！');
        }
        return redirect('shops/commentList')->with('message', '回复失败！');
    }

    public function complaint()
    {
        // 获取登录的用户ID
        $id = session('indexUser')['id'];

        $data = Complaint::orderBy('t_time', 'desc')->where('sid', $id)->with('Goods')->with('User')->paginate(2);

        return view('index.shops.comment.complaintList', compact('data'));
    }
}
