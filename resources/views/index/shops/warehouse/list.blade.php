@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>仓库中的商品</legend>
    </fieldset>
    <form action="{{ url('shops/warehouse') }}">
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
                <col width="220">
            </colgroup>
            <thead>
            <tr>
                <th>id</th>
                <th>商品名</th>
                <th>封面图</th>
                <th>原价</th>
                <th>折扣价</th>
                <th>库存</th>
                <th>发布时间</th>
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
                    <td>
                        {{ \Carbon\Carbon::createFromTimestamp($v->g_uptime)->toDateTimeString() }}
                    </td>
                    <td>
                        <button class="layui-btn layui-btn-red" onclick="doShelves('{{ $v->id }}')">上架</button>
                        {{--<a href='{{ url("shops/warehouse/$v->id/edit") }}' class="layui-btn layui-btn-normal">修改</a>--}}
                        <button class="layui-btn layui-btn-danger" onclick="doDel('{{ $v->id }}')">删除</button>
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
        function doShelves(id) {
            // 发送ajax请求
            $.ajax({
                type: 'post',
                url: 'warehouse/doShelves',
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

        function doDel(id) {
            layer.confirm('确认删除吗？', {
                btn: ['确认','取消']
            }, function() {

                // 发送ajax请求
                $.ajax({
                    type: 'delete',
                    url: 'warehouse/'+id,
                    dataType: 'json',
                    data: {'_token': '{{csrf_token()}}'},
                    success: function (data) {
                        let ic = data.status == 200 ? 1 : 2;
                        layer.msg(data.message, {icon: ic})
                        setTimeout(function () {
                            location.href = location.href;
                        }, 1000);
                    },
                    error: function () {
                        layer.msg('服务器错误', {icon: 2})
                        setTimeout(function () {
                            location.href = location.href;
                        }, 1000);
                    }
                });
            });
        }
    </script>
@endsection