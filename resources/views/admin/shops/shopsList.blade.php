@extends('admin.layouts.master')
@section('title', '店铺管理')
@section('page-title', '店铺管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">店铺列表</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form action="{{ url('admin/shops') }}">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="panel-body">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="btn btn-default dropdown-toggle" name="select" style="height:36px;color:#333b4d;font-weight:bold;margin-top:-5px;">
                                                        <option value="0">搜店铺</option>
                                                        <option value="1">搜掌柜</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control" name="search" value="{{ $request->search }}">
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
                                    <th>店铺ID</th>
                                    <th>店铺名</th>
                                    <th>掌柜名</th>
                                    <th>是否营业</th>
                                    <th>店铺收藏数</th>
                                    <th>地址</th>
                                    <th>开店时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $v)
                                    <tr>
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->s_name }}</td>
                                        <td>{{ $v->nickname }}</td>
                                        <td>{{ $v->s_status == 1 ? '正在营业' : '已打烊' }}</td>
                                        <td>{{ $v->s_collect }}</td>
                                        <td>{{ $v->s_addr }}</td>
                                        <td>{{ date('Y-m-d H:i:s', $v->s_time) }}</td>
                                        <td>
                                            <a href="{{ url('admin/shops/'.$v->id) }}" class="btn btn-primary m-b-5">查看详情</a>
                                            <a href="javascript:;" onclick="doSeal({{$v->id }}, {{ $v->s_status }})" class="btn btn-danger m-b-5">{{ $v->s_status == 1 ? '封店' : '解封' }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="float:right;">
                                {!! $data->appends($request->all())->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function doSeal(id, status){
                var statu = (status== 1) ? '封店' : '解封';
                var stu = (status == 1) ? 0 : 1;
                layer.confirm('确认'+ statu +'吗？', {
                    btn: ['确认','取消']
                }, function(){
                    $.ajax({
                        type: 'delete',
                        url: 'shops/'+id,
                        dataType: 'json',
                        data: {'status':stu, '_token':'{{csrf_token()}}'},
                        success: function (data) {
                            let ic = data.status == 200 ? 2 :1;
                            layer.msg(data.message, {icon: ic})
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        },
                        error: function () {
                            layer.msg('服务器错误', {icon: 1})
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        }
                    });

                });
            }
        </script>

@stop

@section('script')

@stop
