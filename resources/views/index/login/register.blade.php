@extends('layouts.loginParent')
@section('content')
<div class="login-box">
	<div class="am-tabs" id="doc-my-tabs">
			<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
            @if (count($errors) > 0)
                @foreach (($errors->all()) as $error)
					<li><a href="">{{ $error }}</a></li>
                @endforeach
            @else
            	<li><a href="">手机号注册</a></li>
                @if(session('msg'))
                <div class="panel-heading"><h3 class="panel-title">{{ session('msg') }}</h3></div>
                @endif
            @endif
            </ul>
		
		
			<div class="am-tab-panel">
				<form method="post" action="{{ url('index/register') }}">
					{{ csrf_field() }}
					<div class="user-phone">
						<label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
						<input type="tel" name="tel" id="phone" placeholder="请输入手机号">
						<!-- <span style='position:absolute;right: 0;bottom:-37px;font-size:13px;color: #f00;'></span> -->
					</div>																			
					<div class="verification">
						<label for="code"><i class="am-icon-code-fork"></i></label>
						<input type="text" name="code" id="code" placeholder="请输入验证码">
						<a class="btn" href="javascript:void(0);" onclick="sendPhone();" id="sendMobileCode">
						<span id="dyMobileButton">获取</span></a>
					</div>
					<div class="user-pass">
						<label for="password"><i class="am-icon-lock"></i></label>
						<input type="password" name="pwd" id="password" placeholder="设置密码">
					</div>										
					<div class="user-pass">
						<label for="passwordRepeat"><i class="am-icon-lock"></i></label>
						<input type="password" name="upwd" id="passwordRepeat" placeholder="确认密码">
					</div>
					<!-- <div class="login-links">
						<label for="reader-me">
							<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
						</label>
					</div> -->
					<div class="am-cf">
						<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
					</div>
				</form>
				<hr>
			</div>
		</div>
	</div>
</div>
<script>
	// $(function() {
	// 	$('#doc-my-tabs').tabs();
	// })

	function sendPhone()
	{
		$.post("{{ url('index/phone') }}",{'phone':$('#phone').val(), '_token':'{{csrf_token()}}'}, function(data){
			alert(data);
		});
	}
</script>
@endsection