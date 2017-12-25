@extends('admin.layouts.master')
@section('title', '商品属性列表')
@section('page-title', '商品管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">商品属性列表</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form action="{{ url('admin/attribute') }}">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="panel-body">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="请输入属性名">
                                                <div class="input-group-btn">
                                                <input type="submit" class="btn btn-default dropdown-toggle btn-primary m-b-5" value="搜索" style="height:36px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr align="center">
                                    <th>属性id</th>
                                    <th>所属分类</th>
                                    <th>属性名</th>
                                    <th>属性值</th>
                                    <th>添加类型</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                    <tr>
                                        <td>{{ $v->attrid }}</td>
                                        <td>{{ $v->catName }}</td>
                                        <td>{{ $v->attrName }}</td>
                                        <td><a href="javascript:;" onclick="doVal({{ $v->attrid }})" class="btn btn-icon btn-info m-b-5">查看属性值</a></td>
                                        <td> @if ($v->attrType == 0) 输入框 @elseif ($v->attrType == 1) 多选框 @else 下拉框 @endif</td>
                                        <td>{{ $v->attrSort }}</td>
                                        <td>
                                            <a href='{{ url("admin/attribute/$v->attrid/edit") }}' class="btn btn-primary m-b-5">修改</a>
                                            <button class="btn btn-danger m-b-5" onclick="doDel({{ $v->attrid }})">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="float:right;">
                                {!! $data->appends(\Request::query())->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop

@section('script')
            <script>
                function doVal(attrid) {
                    $.ajax({
                        type: 'post',
                        url: 'attribute/attrvalue',
                        dataType: 'json',
                        data: {'attrid': attrid, '_token': '{{csrf_token()}}'},
                        success: function (data) {
                            if(data.data.length > 0) {
                                var ul = "<ul>";
                                for (var i in data) {
                                    $.each(data[i], function (k, v) {
                                        ul += '<li style="font-size:15px;color:#000;">'+v+'</li>';
                                    });
                                }
                                layer.open({
                                    type: 1,
                                    skin: 'layui-layer-rim', //加上边框
                                    area: ['420px', '240px'], //宽高
                                    content: ul
                                });
                            } else {
                                layer.open({
                                    type: 1,
                                    skin: 'layui-layer-rim', //加上边框
                                    area: ['420px', '240px'], //宽高
                                    content: '<p style="text-align:center;color:red;font-size:20px;">暂无属性值</p>'
                                });
                            }
                        },
                        error: function () {
                            alert('服务器错误，请重新选择！');
                        }
                    });
                }

                function doDel(attrid){
                    layer.confirm('确认删除吗？', {
                        btn: ['确认','取消']
                    }, function(){
                        $.ajax({
                            type: 'delete',
                            url: 'attribute/'+attrid,
                            dataType: 'json',
                            data: {'id':attrid, '_token':'{{csrf_token()}}'},
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
                                },100000);
                            }
                        });

                    });
                }
            </script>
@stop
