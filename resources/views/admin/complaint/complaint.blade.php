@extends('admin.layouts.master')
@section('title', '投诉列表')
@section('page-title', '投诉列表')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <script src="/admin/js/jquery.js"></script>
    <script src="/admin/js/layer.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="search_wrap" style="margin:20px;">
                    <form action="{{url('complaint')}}" method="get">
                        <table class="search_tab">
                            <tr>
                                <th width="70">关键字:</th>
                                <td><input type="text" name="keywords" value="" placeholder="内容 关键字"></td>
                                <td><input type="submit"  value="查询"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <table class="table table-striped border-top" id="sample_1">
                    <thead>
                    <tr>
                        <th>商品名称</th>
                        <th>店铺名称</th>
                        <th class="hidden-phone">投诉内容</th>
                        <th class="hidden-phone">投诉人</th>
                        <th class="hidden-phone">投诉时间</th>
                        <th class="hidden-phone">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complaint as $v)
                    <tr class="odd gradeX">
                        <td>{{$v->Goods->g_name}}</td>
                        <td class="hidden-phone">{{$v->Shops->s_name}}</td>
                        <td class="hidden-phone">{{$v->t_content}}</td>
                        <td class="hidden-phone">{{$v->User->nickname}}</td>
                        <td class="center hidden-phone">{{date('Y-m-d H:i:s',$v->t_time)}}</td>
                        <td class="hidden-phone">
                            <a href="{{url("admin/complaint/{$v->id}")}}" class="btn btn-primary m-b-5">查看详情</a>
                            <a href="javascript:;" class="btn btn-danger m-b-5" onclick="delComplaint({{$v->id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <!-- page end-->
    {{--分页--}}
    <div class="page_list">
        {!! $complaint->appends(['keywords'=>$input])->render() !!}
    </div>
    <!--main content end-->
    </section>


    <style>
        .table{
            table-layout:fixed;
            text-align: center;
        }
        .table td{
            width:100%;
            word-break:break-all;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }
        .table th{
            text-align: center;
        }
    </style>

    <script>
        function delComplaint(id){
            layer.confirm('确认删除吗？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                //$.post('请求的url','请求的参数',请求后的返回结果)
                $.post('{{url('admin/complaint')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
//                    console.log(data);
                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = location.href;
                        },2000);

                    }else{
                        layer.msg(data.msg, {icon: 5});
                        setTimeout(function(){
                            location.href = location.href;
                        },2000);
                    }
                });
            }, function(){

            });
        }
    </script>
@stop

@section('script')

@stop
