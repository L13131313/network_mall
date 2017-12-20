@extends('admin.layouts.master')
@section('title', '')
@section('page-title', '')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">添加分类</h3></div>
        <div class="panel-body">
            <form action="{{ url('admin/category') }}" method="post" role="form" class="p-20" name="addcateform" onsubmit='return doSubmit()'>
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="level1"><h4>添加一级分类</h4></label>
                        <input class="form-control" id="level1" name="catname1" placeholder="请输入一级分类名" style="width: 210px" type="text">
                    </div>
                    <div class="form-group">
                        <h4>请选择要添加的二级，三级分类的父类</h4>
                        <select id="cateid" name="chosed_catid" class="form-control" size="5" style="width: 210px;font-size: 16px">
                            @for($i = 0;$i < count($list);$i++)
                                <option style="height: 25px" value="{{ $list[$i]->catid }}">{{ $list[$i]->catname }}</option>
                                @for($j = 0;$j < count($list[$i]->child);$j++)
                                    <option style="height: 25px" value="{{ ($list[$i]->child)[$j]->catid }}">|---{{ ($list[$i]->child)[$j]->catname }}</option>
                                @endfor
                            @endfor
                        </select>
                        <label for="level23"><h4>添加二级，三级分类</h4></label>
                        <input class="form-control" id="level23" name="catname23" placeholder="请输入二级，三级分类名" style="width: 210px" type="text">
                    </div>
                <button type="submit" class="btn btn-purple">添加</button>
            </form>
        </div><!-- panel-body -->
    </div>
    @if (session('info'))
        <script>
            alert("{{ session('info') }}");
        </script>
    @endif
    <script src='{{ asset('admin/js/jquery.js') }}'></script>
    <script>
        // 当添加了一级分类就不能添加二，三级分类
        $('#level1').blur(function () {
            if($('#level1').val() != ''){
                $('#level23').attr('disabled',true);
            }else{
                $('#level23').attr('disabled',false);
            }
        });

        //当添加了级二，三级分类就不能添加一级分类
        $('#level23').blur(function () {
            if($('#level23').val() != '' ){
                $('#level1').attr('disabled',true);
            }else{
                $('#level1').attr('disabled',false);
            }
        });

        function doSubmit() {

            if($('#level23').val() != ''){
                if(!($('#cateid').val() > 0)){
                    alert('您选择添加二，三级分类，请选择下拉框选项！'); //选择二，三级分类时，必须选择添加到哪个父类下
                    return false;
                }
            }

            return true;
        }

    </script>

@stop


@section('script')

@stop