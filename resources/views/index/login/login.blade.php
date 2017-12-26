@extends('layouts.loginParent')
@section('content')
<div class="login-box">
	@if (count($errors) > 0)
        @foreach (($errors->all()) as $error)
			<h3 class="title">{{ $error }}</h3>
        @endforeach
    @else
    	<h3 class="title">登录商城</h3>
        @if(session('msg'))
        <h3 class="title">{{ session('msg') }}</h3>
        @endif
    @endif
	
		<div class="clear"></div>						
		<div class="login-form">
			<form action="{{ url('index/login') }}" method='post' class='myform'>
				{{ csrf_field() }}
				<div class="user-name">
					<label for="user"><i class="am-icon-user"></i></label>
					<input type="text" name="tel" id="user" placeholder="手机/用户名">
				</div>
				<div class="user-pass">
					<label for="password"><i class="am-icon-lock"></i></label>
					<input type="password" name="pwd" id="password" placeholder="请输入密码">
				</div>
			  </form>
		</div>
        <div class="login-links">
            <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
				<a href="{{ url('index/forget') }}" class="am-fr">忘记密码</a>
				<a href="{{ url('index/register') }}" class="zcnext am-fr am-btn-default">注册</a>
				<br />
        </div>
		<div class="am-cf">
			<input type="submit" name="" value="登 录" id='submit' class="am-btn am-btn-primary am-btn-sm">
		</div>
		<div class="partner">		
			<h3>合作账号</h3>
			<div class="am-btn-group">
				<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
				<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span></a></li>
				<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span></a></li>
			</div>
		</div>
</div>
<script>
	$('#submit').click(function(){
		$('.myform').submit();
	});
</script>
@endsection