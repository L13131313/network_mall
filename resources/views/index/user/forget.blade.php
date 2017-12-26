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
			<form method="post" action="{{ url('index/doForGet') }}" method='post'>
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
				<div class="am-cf">
					<input type="submit" name="" value="修改密码" class="am-btn am-btn-primary am-btn-sm am-fl">
				</div>
			</form>
			<hr>
		</div>
</div>
<script>
	function sendPhone()
	{
		$.post("{{ url('index/doSendPhone') }}",{'phone':$('#phone').val(), '_token':'{{csrf_token()}}'}, function(data){
			alert(data);
		});
	}
</script>
@endsection