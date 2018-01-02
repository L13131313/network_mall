@extends('admin.layouts.master')
@section('title', '商品规格列表')
@section('page-title', '商品管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">商品规格列表</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form action="{{ url('admin/spec') }}">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="panel-body">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="请输入规格名">
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
                                    <th>规格id</th>
                                    <th>所属分类</th>
                                    <th>规格名</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->cate->catname }}</td>
                                        <td>{{ $v->specName }}</td>
                                        <td>
                                            <a href='{{ url("admin/spec/$v->id/edit") }}' class="btn btn-primary m-b-5">修改</a>
                                            <button class="btn btn-danger m-b-5" onclick="doDel({{ $v->id }})">删除</button>
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
                function doDel(id){
                    layer.confirm('确认删除吗？', {
                        btn: ['确认','取消']
                    }, function(){
                        $.ajax({
                            type: 'delete',
                            url: 'spec/'+id,
                            dataType: 'json',
                            data: {'id':id, '_token':'{{csrf_token()}}'},
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
