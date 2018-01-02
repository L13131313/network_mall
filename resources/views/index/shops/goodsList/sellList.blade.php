@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>出售中的商品</legend>
    </fieldset>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ url('shops/goods/sellList') }}">
        <div class="row">
            <div class="col-lg-5">
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
                <col width="60">
                <col width="250">
                <col width="100">
                <col width="80">
                <col width="80">
                <col width="80">
                <col width="180">
                <col width="120">
                <col width="240">
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
                <th>商品地址</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->g_name }}</td>
                    <td><img src="{{ asset($v->g_cover) }}" width="50" height="50"></td>
                    @foreach($spec as $n)
                        @if($n['gid'] == $v->id)
                            <td>{{ $n['g_price'] }}</td>
                            <td>{{ $n['g_discount'] }}</td>
                            <td>{{ $n['g_count'] }}</td>
                        @endif
                    @endforeach
                    <td>{{ \Carbon\Carbon::createFromTimestamp($v->shelves_time)->toDateTimeString() }}</td>
                    <td><a href="{{ asset($v->goods_url) }}" class="layui-btn layui-btn-normal">点击进入</a></td>
                    <td>
                        <button class="layui-btn layui-bg-orange" onclick="recommend({{ $v->id }}, {{ $v->g_heat }})">@if($v->g_heat == 1) 取消热卖 @else 添加热卖 @endif</button>
                        <button class="layui-btn layui-btn-danger" onclick="doShelves({{ $v->id }}, {{ $v->g_heat }})">下架</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="float:right;">
            {!! $data->appends(\Request::query())->render() !!}
        </div>
    </div>
    <script>
        // 下架操作
        function doShelves(id, g_heat) {
            if (g_heat == 1) {
                layer.msg('亲，此商品为热卖商品！不能进行此操作！');
            } else {
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
        }

        // 热卖商品操作
        function recommend(id, heat){
            var heats = (heat == 1) ? '取消热卖' : '添加为热卖商品';
            layer.confirm('热卖商品会在店铺首页以轮播图显示，最多可添加6件热卖商品！'+ '<p style="color:red;">确认'+ heats +'吗？</p>', {
                btn: ['确认','取消']
            }, function(){
                $.ajax({
                    type: 'post',
                    url: 'heatGoods',
                    dataType: 'json',
                    data: {'id':id, 'g_heat':heat, '_token':'{{csrf_token()}}'},
                    success: function (data) {
                        var ic = data.status == 200 ? 1 : 2;
                        layer.msg(data.message, {icon: ic})
                        setTimeout(function(){
                            location.href = location.href;
                        },1000);
                    },
                    error: function () {
                        layer.msg('服务器错误，请重新尝试！', {icon: 2})
                        setTimeout(function(){
                            location.href = location.href;
                        },100000);
                    }
                });

            });
        }
    </script>
@endsection