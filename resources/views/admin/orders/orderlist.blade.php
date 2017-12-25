@extends('admin.layouts.master')
@section('title', '订单管理')
@section('page-title', '订单管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row"/>
        <div class="col-md-12">
            <div class="panel panel-default">

            {{csrf_field()}}

                <div class="panel-heading">
                    <h3 class="panel-title">订单列表</h3>
                </div>
                <div class="panel-body">

                        <form action="{{ url('admin/OrderList') }}">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="panel-body">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <select class="btn btn-default dropdown-toggle" name="select" style="height:36px;color:#333b4d;font-weight:bold;margin-top:-5px;">
                                                        <option value="o_name">订单号</option>
                                                        <option value="g_name">商品名</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control" name="search" value="" placeholder="输入订单号/商品名查找订单" style="width:270px">

                                                <div class="input-group-btn">
                                                  <input type="submit" class="btn btn-default dropdown-toggle btn-primary m-b-5" value="搜索" style="height:36px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table  class="table table-striped table-bordered" style=" table-layout:fixed; word-break:break-all;">
                                <thead>
                                    <tr align="center">
                                        <th align="center">订单日期</th>
                                        <th align="center">订单号</th>

                                        <th align="center">商品图片</th>
                                        <th colspan="2" align="center">商品名称</th>

                                        <th align="center">商品单价</th>
                                        <th align="center">商品数量</th>
                                        <th align="center">商品总价</th>
                                        <th align="center">操&nbsp;&nbsp;&nbsp;作</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach($data as $v)
                                    <tr>
                                        <td align="center">{{ $v->o_mtime }}</td>
                                        <td align="center">{{ $v->o_name }}</td>

                                        <td align="center"><a href="{{ url('admin/OrderList'.'/'.$v->id) }}" width="120px">{{ $v->g_pic }}</a></td>
                                        <td align="center" colspan="2">
                                            <a href="{{ url('admin/OrderList'.'/'.$v->id) }}" width="120px"><strong>{{ $v->g_name }}</strong><br/><br/>
                                            {{ $v->g_spec }}</a>
                                        </td>
                                        <td align="center">{{ $v->g_price }}</td>
                                        <td align="center">{{ $v->o_count }}</td>
                                        <td align="center">{{ $v->o_prices }}</td>
                                        <td align="center">
                                            <a href="{{ url('admin/OrderList'.'/'.$v->id) }}" class="btn btn-danger m-b-5">订单详情</a><br>

                                            <a href="javascript:;" onclick="delOrder({{ $v->id }})" class="btn btn-danger m-b-5">删除订单</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="page_list">
                                {!! $data->appends($request->all())->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="{{asset('admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/style/layer/layer.js')}}"></script>
    <script>

    function delOrder(id){
        layer.confirm('确认删除吗？', {
            btn: ['确认','取消'] //按钮
        }, function(){



        //  $.post('请求的url','请求的参数',请求后的返回结果)
        $.post('{{url('admin/OrderList/')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
            console.log(data);
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

          // layer.msg('删除成功', {icon: 1});




        }, function(){

        });
    }
</script>

@stop

@section('script')

@stop

