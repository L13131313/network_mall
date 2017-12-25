@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '管理员列表')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <form action="{{url('admin/user')}}" method="get">
                <div class="input-group">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" id="example-input1-group2" name="name" class="form-control" placeholder="Search">
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(session('msg'))
                    <h3 class="panel-title">{{ session('msg') }}</h3>
                    @endif
                </div>
                <form action="" method="post" name='myform' style='display:none'>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }} 
                </form>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>管理员ID</th>
                                    <th>名称</th>
                                    <th>权限</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @forelse($userinfo as $v)
                                        <tr>
                                            <td>{{ $v->id }}</td>
                                            <td>{{ $v->name }}</td>
                                            <td>{{ ($v->status) ? '超级管理员' : '管理员'}}</td>
                                            <td>
                                                <a href='{{ url("admin/user/$v->id/edit") }}' class="btn btn-primary m-b-5">修改</a> ||
                                                <a href="javascript:;" onclick="delUser({{$v->id}})" class="btn btn-danger m-b-5">删除</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="page_list">
                                {!! $userinfo->appends($request->all())->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function delUser(id){

        layer.confirm('确认删除吗？', {
            btn: ['确认','取消']
        }, function(){
            //ajax请求
            $.post('{{ url("admin/user") }}'+'/'+id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data) {
                // console.log(data);
                if (data['status'] == 0) {
                    layer.msg('删除成功!', {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },1000);
                } else {
                    layer.msg('删除失败!', {icon: 5});
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
