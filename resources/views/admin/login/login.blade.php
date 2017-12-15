<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>后台登录</title>
@include('admin.public.styles')
    <!--[if lt IE 9]>
    <script src="{{ asset('admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('admin/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper-page">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="text-center m-t-10">后台登录</h3>
        </div>
        <div class="panel-body">
            @include('admin.public.error')
            @if (count($errors) > 0)
                @foreach (($errors->all()) as $error)
                    <!-- <div class="panel-heading"><h3 class="panel-title">{{ $error }}</h3></div> -->
                @endforeach
            @else
                @if(session('msg'))
                <div class="panel-heading"><h3 class="panel-title">{{ session('msg') }}</h3></div>
                @endif
            @endif
            <form class="form-horizontal m-t-10 p-20 p-b-0" action="{{ url('admin/login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="name" type="text" placeholder="管理员账号"
                               value="">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="pwd" type="password" placeholder="密码">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-7">
                        <input class="form-control" name="code" type="text" placeholder="验证码">
                    </div class="col-xs-5">
                    <div>
                        <a onclick="javascript:re_captcha();">
                            <img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">
                        </a>
                    </div>
                </div>                    
                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-success w-md" type="submit">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.public.script')
</body>
<script type="text/javascript">  
function re_captcha() {  
    $url = "{{ URL('/code/captcha') }}";
    $url = $url + "/" + Math.random();
        document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
    }

    // var h=/^[\u4e00-\u9fa5]{0,}$/;
    // // var d=/^1[3|4|5|8][0-9]\d{4,8}$/;
    // // var y=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
    // $("input").focus(function() {
    //     $(this).prev().css("color","#008DE8");
    // });
    // $("[name='name']").blur(function() {
    //     var v=$(this).val();
    //     if (v=='') {
    //         $("[name='name']").next().html("用户名不能为空！");
    //         $(this).prev().css("color","#f00");
    //     }else if(!v.match(h)){
    //         $("[name='name']").next().html("用户名不合法！");
    //         $("[name='name']").prev().css("color","#f00");
    //     }else{
    //         $(this).prev().css("color","#0EA74A");
    //         $("[name='name']").next().html("");
    //     } 
    // });
    // $("[name='pwd']").blur(function() {
    //     var v=$(this).val();
    //     if (v=='') {
    //         $("[name='pwd']").next().html("密码不能为空！");
    //         $(this).prev().css("color","#f00");
    //     }else if(!v.match(d)){
    //         $("[name='pwd']").next().html("密码不正确！");
    //         $("[name='pwd']").prev().css("color","#f00");
    //     }else{
    //         $(this).prev().css("color","#0EA74A");
    //         $("[name='pwd']").next().html("");
    //     } 
    // });
    // $('.button').click(function(){
    // var name=$("[name='name']").val();
    // var pwd=$("[name='pwd']").val();
    // if (name=="") {
    //     $("[name='name']").next().html("用户名不能为空！");
    //     return;
    // }else if(!name.match(h)){
    //     $("[name='name']").next().html("用户名不合法！");
    //     $("[name='name']").prev().css("color","#f00");
    //     return;
    // }
    // if (pwd=='') {
    //     $("[name='pwd']").next().html("密码不能为空！");
    //     return;
    // }else if(!pwd.match(d)){
    //     $("[name='pwd']").next().html("请填写正确的密码！");
    //     $("[name='pwd']").prev().css("color","#f00");
    //     return;
    // }
</script> 
</html>
