@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加分类</legend>
    </fieldset>
    <div class="row">
        <div class="col-lg-5 col-md-offset-2" style="margin-top:30px;">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            <form class="layui-form" action="{{ url('shops/cate/'.$data['id']) }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('put') }}
                <div class="layui-form-item">
                    <label class="layui-form-label">分类名<span style="color:red;font-size:18px;">*</span></label>
                    <div class="layui-input-block">
                        <input type="text" name="nav_name" required  lay-verify="required" value="{{ $data['nav_name'] }}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">排序号<span style="color:red;font-size:18px;">*</span></label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" required  lay-verify="required" value="{{ $data['sort'] }}" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;

        });
    </script>
@endsection