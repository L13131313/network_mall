@extends('admin.layouts.master')
@section('title', '投诉详情')
@section('page-title', '投诉信息详情')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <script src="/admin/js/jquery.js"></script>
    <script src="/admin/js/layer.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <table class="table table-striped border-top" id="sample_1">
                    @foreach($complaint as $v)
                    <thead>
                        <tr class="odd gradeX">
                            <td>商品名称</td>
                            <td class="hidden-phone">{{$v->Goods->g_name}}</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <td style="padding:45px">商品图片</td>
                            <td class="hidden-phone"><img src="{{$v->Goods->g_cover}}" height="85px"></td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>店铺名称</td>
                            <td class="hidden-phone">{{$v->Shops->s_name}}</td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>店主</td>
                            <td class="hidden-phone">{{$v->Shops->nickname}}</td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>投诉内容</td>
                            <td class="hidden-phone">{{$v->t_content}}</td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX" >
                            <td>投诉人</td>
                            <td class="hidden-phone">{{$v->User->nickname}}</td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>投诉时间</td>
                            <td class="hidden-phone">{{date('Y-m-d H:i:s',$v->t_time)}}</td>
                            <td></td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                操作
                            </td>
                            <td class="hidden-phone">
                                <a href="javascript:history.go(-1)" class="btn btn-primary m-b-5">返回列表</a>
                                <a href="javascript:;" class="btn btn-danger m-b-5" onclick="delComplaint({{$v->id}})">删除</a>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </section>
        </div>
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
                            window.history.go(-2);
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
