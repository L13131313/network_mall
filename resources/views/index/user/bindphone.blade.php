@extends('layouts.parent')
@section('content')
<div class="am-cf am-padding">
	<div class="am-fl am-cf">
 		@if (count($errors) > 0)
            @foreach (($errors->all()) as $error)
            <strong class="am-text-danger am-text-lg">{{ $error }}</strong><br />				
            @endforeach
        @else
        	<strong class="am-text-danger am-text-lg">绑定手机</strong> / <small>Bind&nbsp;Phone</small>
            @if(session('msg'))
            <strong class="am-text-danger am-text-lg">{{ session('msg') }}</strong>
            @endif
        @endif
	</div>
</div>
<hr/>
<form class="am-form am-form-horizontal" action="{{ url('index/changeTel') }}" method='post'>
	{{ csrf_field() }}
	<div class="am-form-group bind">
		<label for="user-phone" class="am-form-label">验证手机</label>
		<div class="am-form-content">
			<span id="user-phone">{{ $str = substr_replace(session('indexUser')['tel'],'****',3,6) }}</span>
		</div>
	</div>
	<div class="am-form-group code">
		<label for="user-code" class="am-form-label">验证码</label>
		<div class="am-form-content">
			<input type="tel" id="user-code" placeholder="短信验证码" name='code'>
		</div>
		<a class="btn" href="javascript:void(0);" onclick="sendCode();" id="sendMobileCode">
			<div class="am-btn am-btn-danger">验证码</div>
		</a>
	</div>
	<div class="am-form-group">
		<label for="user-new-phone" class="am-form-label">验证手机</label>
		<div class="am-form-content">
			<input type="tel" id="tel" placeholder="绑定新手机号" name='tel'>
		</div>
	</div>
	<div class="am-form-group code">
		<label for="user-new-code" class="am-form-label">验证码</label>
		<div class="am-form-content">
			<input type="tel" id="user-new-code" placeholder="短信验证码" name='ncode'>
		</div>
		<a class="btn" href="javascript:void(0);" onclick="sendMobileCode();" id="sendMobileCode">
			<div class="am-btn am-btn-danger">验证码</div>
		</a>
	</div>
	<div class="info-btn">
		<!-- <div class="am-btn am-btn-danger">保存修改</div> -->
		<button class="am-btn am-btn-danger">保存修改</button>
	</div>
</form>
<script>
	function sendCode()
	{	
		// alert(1111111);
		$.post("{{ url('index/sendCode') }}",{'phone':{{ session('indexUser')['tel'] }},'_token':'{{csrf_token()}}'},function(data) {
			alert(data);
		});
	}

	function sendMobileCode()
	{
		$.post("{{ url('index/rSendCode') }}",{'tel':$('#tel').val(), '_token':'{{csrf_token()}}'}, function(data){
			alert(data);
		});
	}
</script>
@endsection