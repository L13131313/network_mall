@extends('admin.layouts.master')
@section('title', '分类管理')
@section('page-title', '分类管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">编辑分类</h3></div>
        <div class="panel-body">
            <form action="{{ url('admin/category/'.$catdata->catid) }}" method="post" role="form" class="p-20" name="addcateform" onsubmit='return doSubmit()'>
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group">
                    <label for="catname"><h4>编辑分类名</h4></label>
                    <input type="text" class="form-control" id="catname" name="catname" value="{{ $catdata->catname }}" >
                </div>
                <div class="form-group">
                    <label for="listorder"><h4>编辑分类排序</h4></label>
                    <input type="text" class="form-control" id="listorder" name="listorder" value="{{ $catdata->listorder }}" >
                </div>
                <button type="submit" class="btn btn-purple">提交</button>
            </form>
        </div>
    </div>
    @if (session('info'))
        <script>
            alert("{{ session('info') }}");
        </script>
    @endif
    <script>
        function doSubmit() {

            if($('#catname').val() == ''){
                alert('请填写分类名');
                return false;
            }

            if($('#listorder').val() == ''){
                alert('请填写分类排序');
                return false;
            }

            return true;
        }
    </script>
@stop


@section('script')

@stop
