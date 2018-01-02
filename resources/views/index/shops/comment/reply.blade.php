<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('index/css/layui/css/layui.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('index/css/layer/jquery.js')}}"></script>
    <script src="{{ asset('index/css/layer/layer.js')}}"></script>
    <script src="{{ asset('index/css/layui/layui.js')}}"></script>
</head>
<body>
    <form class="layui-form" action="{{ url('shops/commentList/reply') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $id }}">
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label" style="width:100px;margin-left:33px;color:blue;">回复内容</label>
            <div class="layui-input-block">
                <textarea name="e_reply" style="margin-left:-18px;" required lay-verify="required" placeholder="请输入回复内容" class="layui-textarea" autocomplete="off"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" style="float:right;margin-right:18px;">回复</button>
            </div>
        </div>
    </form>
</body>
</html>

<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;

    });
</script>