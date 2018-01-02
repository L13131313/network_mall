@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>店铺信息</legend>
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
            <form class="layui-form" action="" method="post">
                @foreach($data as $v)
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺名</label>
                        <div class="layui-input-block">
                            <input type="text" name="s_name" value="{{ $v->s_name }}" readonly required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">掌柜名</label>
                        <div class="layui-input-block">
                            <input type="text" value="{{ $v->nickname }}" readonly required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺状态</label>
                        <div class="layui-input-block">
                            <input type="text" name="s_status" readonly value="@if($v->s_status == 1) 营业中 @else 已打烊 @endif " required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">log图<span style="color:red;font-size:18px;">*</span></label>
                        <div class="layui-input-block">
                            <img src="{{ asset($v->s_log) }}" alt="" height="80">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="s_addr" value="{{ $v->s_addr }}" readonly required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">开店时间</label>
                        <div class="layui-input-block">
                            <input type="text" value="{{ date('Y-m-d H-i-s', $v->s_time) }}" readonly required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="s_script" value="{{ $v->s_script }}" readonly required  lay-verify="required" autocomplete="off" class="layui-input" style="width:800px;">
                        </div>
                    </div>
                @endforeach
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