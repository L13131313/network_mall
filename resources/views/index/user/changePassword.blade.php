@extends('layouts.loginParent')
@section('content')
<div class="login-box">
	@if (count($errors) > 0)
        @foreach (($errors->all()) as $error)
			<h3 class="title">{{ $error }}</h3>
        @endforeach
    @else
    	<h3 class="title">忘记密码</h3>
        @if(session('msg'))
        <h3 class="title">{{ session('msg') }}</h3>
        @endif
    @endif
	
		<div class="clear"></div>						
		<div class="am-tab-panel">
			<form method="post" action="{{ url('index/changePassword') }}" method='post'>
				<input type="hidden" name="uid" value="{{$uid}}">
				{{ csrf_field() }}
				<div class="user-pass">
						<label for="password"><i class="am-icon-lock"></i></label>
						<input type="password" name="pwd" id="password" placeholder="设置密码">
					</div>										
					<div class="user-pass">
						<label for="passwordRepeat"><i class="am-icon-lock"></i></label>
						<input type="password" name="upwd" id="passwordRepeat" placeholder="确认密码">
					</div>
				<div class="am-cf">
					<input type="submit" name="" value="修改密码" class="am-btn am-btn-primary am-btn-sm am-fl">
				</div>
			</form>
			<hr>
		</div>
</div>
@endsection