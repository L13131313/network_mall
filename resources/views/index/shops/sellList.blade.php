@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>出售中的商品</legend>
    </fieldset>
    <form action="{{ url('shops/goods/sellList') }}">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="">
                        <div class="input-group-btn">
                            <input type="submit" class="btn btn-default dropdown-toggle btn-primary m-b-5" value="搜索商品">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="200">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th>id</th>
                <th>商品名</th>
                <th>封面图</th>
                <th>原价</th>
                <th>折扣价</th>
                <th>库存</th>
                <th>上架时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->g_name }}</td>
                    <td><img src="{{ asset($v->g_cover) }}" width="50" height="50"></td>
                    <td>{{ $v->g_price }}</td>
                    <td>{{ $v->g_discount }}</td>
                    <td>{{ $v->g_count }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp($v->shelves_time)->toDateTimeString() }}</td>
                    <td><button class="layui-btn layui-btn-danger" onclick="doShelves('{{ $v->id }}')">下架</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="float:right;">
            {!! $data->appends(\Request::query())->render() !!}
        </div>
    </div>
    <script>
        function doShelves(id) {
            // 发送ajax请求
            $.ajax({
                type: 'post',
                url: 'doShelves',
                dataType: 'json',
                data: {'id': id, '_token': '{{csrf_token()}}'},
                success: function (data) {
                    let ic = data.status == 200 ? 1 : 2;
                    layer.msg(data.message, {icon: ic})
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);
                },
                error: function () {
                    layer.msg('服务器错误', {icon: 2})
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);
                }
            });
        }
    </script>
@endsection