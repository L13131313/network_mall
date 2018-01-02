@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '用户列表')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <form action="{{url('admin/publicUserList')}}" method="get">
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
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>用户ID</th>
                                    <th>手机</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                            @foreach($userinfo as $v)
                                <tbody>
                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->tel }}</td>
                                    <td id='openId{{ $v->id }}'>{{ ($v->open == 1) ? '关闭' : '开启'}}</td>
                                    <td>
                                        <a href="javascript:;" onclick="delUser({{$v->id}})" id="doOpen{{$v->id}}" class="btn btn-danger m-b-5">{{ ($v->open==1)?"账号解封":'违规封号' }}</a>    
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
<script>
    function delUser(id){
        var o = '#openId'+id;
        var openid = $(o).html();
        // alert(openid);
        switch(openid){
            case '开启':
                openid = 0;
            break;
            case '关闭':
                openid = 1;
            break;
        }
        // alert(openid);
        var uid = '#doOpen'+id;
        // alert($id);
        var doopen = $(uid).html();
        // alert($doopen);
        switch(doopen)
        {
            case '违规封号':
                layer.confirm('确认封号吗？', {
                    btn: ['确认','取消']
                }, function(){
                    //ajax请求
                    $.get('{{ url("admin/doOpen") }}',{'openid':openid,'id':id} ,function(data) {
                        // alert(data);
                        if (data['status'] == 0) {
                            layer.msg('封号成功!', {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        } else {
                            layer.msg('封号失败!', {icon: 5});
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        }
                    });
                });
            break;
            case '账号解封':
                layer.confirm('确认解封吗？', {
                    btn: ['确认','取消']
                }, function(){
                    //ajax请求
                    $.get('{{ url("admin/doOpen") }}',{'openid':openid,'id':id} ,function(data) {
                        // alert(data);
                        if (data['status'] == 0) {
                            layer.msg('解封成功!', {icon: 6});
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        } else {
                            layer.msg('解封失败!', {icon: 5});
                            setTimeout(function(){
                                location.href = location.href;
                            },1000);
                        }
                    });
                });
            break;
        }
    }
</script>
@stop

@section('script')

@stop



                                
