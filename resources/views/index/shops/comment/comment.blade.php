@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>评论管理</legend>
    </fieldset>
    {{--<form action="{{ url('shops/warehouse') }}">--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-5">--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="input-group">--}}
                        {{--<input type="text" class="form-control" name="search" value="">--}}
                        {{--<div class="input-group-btn">--}}
                            {{--<input type="submit" class="btn btn-default dropdown-toggle btn-primary m-b-5" value="搜索商品">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="100">
                <col width="250">
                <col width="100">
                <col width="200">
                <col width="80">
                <col width="180">
                <col width="220">
            </colgroup>
            <thead>
            <tr>
                <th>商品id</th>
                <th>商品名</th>
                <th>评论人</th>
                <th>评论内容</th>
                <th>是否好评</th>
                <th>评论时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{ $v->goods->id }}</td>
                    <td>{{ $v->goods->g_name }}</td>
                    <td>@if($v->anonymous == 1) {{ $v->username }} @else 匿名（**）@endif</td>
                    <td>{{ $v->e_content }}</td>
                    <td>@if($v->e_status == 1) 好评 @elseif($v->e_status == 2) 中评 @else 差评 @endif</td>
                    <td>{{ date('Y-m-d H:i:s', $v->e_time) }}</td>
                    <td>
                        @if($v->e_reply == null)
                            <button class="layui-btn layui-btn-red" onclick="doReply('{{ $v->id }}')">回复</button>
                        @else
                            <button class="layui-btn layui-btn-red" onclick="seeReply('{{ $v->e_reply }}')">查看回复</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="float:right;">
            {{--{!! $data->appends(\Request::query())->render() !!}--}}
        </div>
    </div>
    <script>
        function doReply(id) {
            layer.open({
                type: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['420px', '260px'], //宽高
                content: 'commentList/reply/'+id
            });
        }

        function seeReply(e_reply) {
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['420px', '240px'], //宽高
                content: `<div class="layui-form-item layui-form-text">
                            <label class="layui-form-label" style="width:100px;margin-left:33px;color:blue;">回复内容</label>
                            <div class="layui-input-block">
                                <textarea name="e_reply" style="margin-left:-18px;" readonly class="layui-textarea">`+e_reply+`</textarea>
                            </div>
                         </div>`
            });
        }
    </script>
@endsection