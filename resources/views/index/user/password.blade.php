@extends('layouts.parent')
@section('content')
<div class="am-cf am-padding">
	<div class="am-fl am-cf">
 		@if (count($errors) > 0)
            @foreach (($errors->all()) as $error)
            <strong class="am-text-danger am-text-lg">{{ $error }}</strong><br />				
            @endforeach
        @else
        	<strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small><br />
            @if(session('msg'))
            <strong class="am-text-danger am-text-lg">{{ session('msg') }}</strong>
            @endif
        @endif
	</div>
</div>
<hr/>
<form class="am-form am-form-horizontal" method='post' action="{{ url('index/password') }}">
	{{ csrf_field() }}
	<div class="am-form-group">
		<label for="user-old-password" class="am-form-label">原密码</label>
		<div class="am-form-content">
			<input type="password" id="user-old-password" name='pwd' placeholder="请输入原登录密码">
		</div>
	</div>
	<div class="am-form-group">
		<label for="user-new-password" class="am-form-label">新密码</label>
		<div class="am-form-content">
			<input type="password" id="user-new-password" name='npwd' placeholder="由数字、字母组合">
		</div>
	</div>
	<div class="am-form-group">
		<label for="user-confirm-password" class="am-form-label">确认密码</label>
		<div class="am-form-content">
			<input type="password" id="user-confirm-password" name='rnpwd' placeholder="请再次输入上面的密码">
		</div>
	</div>
	<div class="info-btn">
		<!-- <div class="am-btn am-btn-danger">保存修改</div> -->
		<button class="am-btn am-btn-danger">保存修改</button>
	</div>
</form>
@endsection