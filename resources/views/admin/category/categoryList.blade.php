@extends('admin.layouts.master')
@section('title', '')
@section('page-title', '')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')

    <form name="myform" action='' method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">分类列表</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-md-1">分类排序</th>
                                    <th class="col-md-1">分类id</th>
                                    <th class="col-md-8">分类名</th>
                                    <th class="col-md-2">操作</th>
                                </tr>
                                </thead>

                                <tbody>
                                @for($i = 0;$i < count($list);$i++)
                                    <tr>
                                        <td style="text-align: center;line-height: 35px">{{ $list[$i][0] }}</td>
                                        <td style="text-align: center;line-height: 35px">{{ $list[$i][1] }}</td>
                                        <td>{{ $list[$i][2] }}</td>
                                        <td>
                                            &nbsp;
                                            <a class="btn btn-icon btn-info m-b-5" href='{{ url("admin/category/".$list[$i][1]."/edit") }}'>修改</a>
                                            <button class="btn btn-icon btn-danger m-b-5" onclick='del("{{ $list[$i][1] }}","{{ $list[$i][3] }}")'>删除</button>
                                            &nbsp;
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #pagesfield{
            width: 400px;
            margin:0px auto;
        }
        .pages{
            margin-right: 22px;
        }
    </style>
    <div id="pagesfield">
        <a class="pages btn btn-inverse btn-rounded m-b-5" href="{{ url('admin/category/pages/0') }}">首页</a>
        <a id="prepage" class="pages btn btn-inverse btn-rounded m-b-5" href="{{ url('admin/category/pages/'.($offset-1)) }}">上一页</a>
        <a id="afterpage" class="pages btn btn-inverse btn-rounded m-b-5" href="{{ url('admin/category/pages/'.($offset+1)) }}">下一页</a>
        <a class="pages btn btn-inverse btn-rounded m-b-5" href="{{ url('admin/category/pages/'.$total) }}">尾页</a>
    </div>
    @if (session('info'))
        <script>
            alert("{{ session('info') }}");
        </script>
    @endif
    <script src='{{ asset('admin/js/jquery.js') }}'></script>
    <script>
            $('#prepage').click(function () {

                if("{{ $offset }}" == '0'){
                    $(this).attr('href',"{{ url('admin/category/pages/0') }}");
                }
            });

            $('#afterpage').click(function () {

                if("{{ $offset }}" == "{{ $total }}"){
                    $(this).attr('href',"{{ url('admin/category/pages/'.$total) }}");
                }
            });

            function del(cid,child) {
                if(child>0){
                    alert('此分类下有子类，请先删除子类');
                } else {
                    if(confirm('是否确定删除')){
                        $myform = document.myform;
                        $myform.action = "{{ url('admin/category') }}"+'/'+cid;
                        $myform.submit();
                    }
                 }
            }
    </script>
@stop


@section('script')

@stop
