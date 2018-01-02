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
            <form class="layui-form" action="{{ url('shops/shopadmin/shopsinfo') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @foreach($data as $v)
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺名</label>
                        <div class="layui-input-block">
                            <input type="text" @if($v->s_name == null) name="s_name" placeholder="店铺名添加后不能修改，请慎重考虑" @else value="{{ $v->s_name }}" readonly @endif required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">掌柜名</label>
                        <div class="layui-input-block">
                            <input type="text" @if($v->nickname == null) name="nickname" placeholder="掌柜名添加后不能修改，请慎重考虑" @else value="{{ $v->nickname }}" readonly @endif required  lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" pane="">
                        <label class="layui-form-label" style="width:100px;">店铺状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="s_status" value="1" title="营业中" @if($v->s_status == 1) checked @endif>
                            <input type="radio" name="s_status" value="0" title="已关闭" @if($v->s_status == 0) checked @endif>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">log图<span style="color:red;font-size:18px;">*</span></label>
                        <div class="layui-input-block">
                                <input type="file" name="s_log" style="opacity:0;width:80px;height:80px;">
                                <img src="{{ asset($v->s_log) }}" alt="" height="80" width="80" style="margin-top:-98px;"><div style="color:red;margin-top:-50px;margin-left:100px;font-size:12px;">点击图片更换log图</div><div style="color:#999;margin-top:10px;margin-left:100px;font-size:12px;">建议上传图片宽度大于1440px</div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:100px;">店铺地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="s_addr" value="{{ $v->s_addr }}" required  lay-verify="required" autocomplete="off" class="layui-input">
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
                            <input type="text" name="s_script" value="{{ $v->s_script }}" required  lay-verify="required" autocomplete="off" class="layui-input" style="width:800px;">
                        </div>
                    </div>
                @endforeach
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="formDemo">确定修改</button>
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