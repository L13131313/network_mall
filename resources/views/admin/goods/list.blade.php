
@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '商品列表')
@section('styles')

@stop

@section('content')
@include('admin.public.error')
    <script src="/admin/js/jquery.js"></script>
    <script src="/admin/js/layer.js"></script>
    <style>
      /*  .col-lg-12{
            position: absolute;
        }*/ 
        .detail-box{
            width: 900px; 
            height:600px; 
            background:yellow;
            z-index: 1001;
            display: none;
        }
        .li-close{
            width: 900px;
            text-align: right;
            padding-top: 5px;
            padding-right: 5px;
            color: red;
        }
        .li-close span{
            cursor: pointer;
            font-weight: bold;
        }
        .li-ifream{
            width: 900px;
            height:600px; 
        }
        .table{
              table-layout:fixed;
              text-align: center;
        }
        .table th{
            table-layout:fixed;
            text-align: center;
        }
        .table td{
            width:100%;
            height: 50px;  
        }
    </style>
    <div class="row">

        <div class="col-lg-12">
            <div class="detail-box">
                <div class="li-close">
                    <span class="li-x">关闭</span>
                </div>
                  <div>
                    <iframe class="li-ifream" scrolling="yes" src="{{url('admin/goods/show')}}/"+id ></iframe>
                </div>
            </div>
            <section class="panel">
                <div class="search_wrap" style="margin:20px;">
                    <form action="{{url('admin/goods')}}" method="get">
                        <table class="search_tab">
                            <tr>
                                <th width="70">关键字:</th>
                                <td><input type="text" name="keywords" value="" placeholder="商品名关键字"></td>
                                <td><input type="submit"  value="查询"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <table class="table table-striped border-top" id="sample_1">
                    <thead>
                        <tr>
                            <th>商品ID</th>
                            <th>商品图片</th>
                            <th class="hidden-phone">商品名称</th>
                            <th class="hidden-phone">价格</th>
                            <th class="hidden-phone">库存</th>
                            <th class="hidden-phone">上架时间</th>
                            <th class="hidden-phone">状态</th>
                            <th class="hidden-phone">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($goods as $v)
                   
                        <tr class="odd gradeX">
                          <td style="line-height:61px">{{ $v->id}}</td>
                          <td><img src="{{$v->g_cover}}" width="100px" height="60" alt=""></td>
                          <td class="hidden-phone" style="line-height:61px">{{ $v->g_name}}</td>
                          <td class="hidden-phone" style="line-height:61px">{{ $v->g_price}}</td>
                          <td class="hidden-phone" style="line-height:61px">{{ $v->g_count}}</td>
                          <td class="center hidden-phone" style="line-height:61px">{{ $v->g_uptime}}</td>
                          <td class="hidden-phone" style="line-height:61px">
                         @if( $v->g_status == 1)
                                    新品
                                @elseif($v->g_status == 2)
                                    上架
                                @elseif($v->g_status == 3)
                                    下架
                                @endif
                          </td>
                          <td class="hidden-phone">
                              <!-- <a href="{{ url('admin/goods/'.$v->id) }}" target="_blank" class="btn btn-primary m-b-5">详情</a> -->
                              <a href="javascript:;" cur-id="{{$v->id}}" class="btn btn-primary m-b-5">详情</a>
                              <a href="javascript:;" class="btn btn-danger m-b-5" onclick="delGoods({{$v->id}})">删除</a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                  
                </table>

            </section>
        </div>

    </div>
    <!-- page end-->
     <!-- 带条件分页 -->
        <div class="page_list">
          {!! $goods->appends(['keywords'=>$input])->render() !!}
        </div>
        
  </section>
  
    <!--script for this page only-->
    <!-- // <script src="js/dynamic-table.js"></script> -->
  <script>
    $(".btn").click(function(){
        $(".detail-box").css('display', 'block');
        $(".panel").css('display', 'none');
        $(".page_list").css('display', 'none');
        var id = $(this).attr('cur-id');
        // alert(id);
        
    });
    $(".li-x").click(function(){
        $(".detail-box").css('display', 'none');
        $(".panel").css('display', 'block');
        $(".page_list").css('display', 'block');
    });
    function delGoods(id){
        layer.confirm('确认删除吗？', {
            btn: ['确认','取消'] //按钮
        }, function(){
// . $.post('请求的url','请求的参数',请求后的返回结果)
            $.post('{{url('admin/goods/')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
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
        }, function(){

        });
    }
</script>


@stop

@section('script')

@stop
