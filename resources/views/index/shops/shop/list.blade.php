@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>店铺配置列表</legend>
    </fieldset>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ url('shops/cate') }}">
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
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th>id</th>
                <th>店铺名</th>
                <th>掌柜名</th>
                <th>店铺log</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href='' class="layui-btn layui-btn-normal">修改</a>
                        <button class="layui-btn layui-btn-danger" onclick="doDel('{{ $v->id }}')">删除</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="float:right;">
            {!! $data->appends(\Request::query())->render() !!}
        </div>
    </div>
    <script>
        function doDel(id) {
            layer.confirm('确认删除吗？', {
                btn: ['确认','取消']
            }, function() {

                // 发送ajax请求
                $.ajax({
                    type: 'delete',
                    url: 'cate/'+id,
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