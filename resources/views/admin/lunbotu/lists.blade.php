
@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '轮播图列表')
@section('styles')

@stop

@section('content')
@include('admin.public.error')
    <script src="/admin/js/jquery.js"></script>
    <script src="/admin/js/layer.js"></script>
    <style>
     
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
           <div class="search_wrap" style="margin:20px;">
              <form action="{{url('admin/lunbo')}}" method="get">
                  <table class="search_tab">
                      <tr>
                          <th width="70">关键字:</th>
                          <td><input type="text" name="keywords" value="" placeholder="输入商店id"></td>
                          <td><input type="submit"  value="查询"></td>
                      </tr>
                  </table>
              </form>
            </div>
            <section class="panel">
                
                <table class="table table-striped border-top" id="sample_1">
                    <thead>
                        <tr>
                            <th class="hidden-phone">ID</th>
                            <th class="hidden-phone">轮播图</th>
                            <th class="hidden-phone">商店ID</th>
                            <th class="hidden-phone">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($lunbo as $v)
                        <tr class="odd gradeX">
                          <td style="line-height:61px">{{ $v->id }}</td>
                          <td><img src="{{ url($v->lbpath) }}" width="100px" height="60" alt=""></td>
                          <td class="hidden-phone" style="line-height:61px">{{ $v->Shops->s_name }}</td>
                          
                          
                          <td class="hidden-phone">
                               
                              
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
          {!! $lunbo->appends(['keywords'=>$input])->render() !!}
        </div>
         
<!--   </section> -->
 
<script>
   
    function delGoods(id){
      layer.confirm('确认删除吗？', {
        btn: ['确认','取消'] //按钮
      }, function(){
// . $.post('请求的url','请求的参数',请求后的返回结果)
        $.post('{{url('admin/lunbo/')}}/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
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
