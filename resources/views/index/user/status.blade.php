@extends('layouts.parent')
@section('content')
<div class="user-info">
	<!--标题 -->
	<div class="am-cf am-padding">
		@if (count($errors) > 0)
            @foreach (($errors->all()) as $error)
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">{{ $error }}</strong></div><br />
            @endforeach
        @else
        	<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div><br />
            @if(session('msg'))
            	<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">{{ session('msg') }}</strong></div>
            @endif
        @endif
		
	</div>
	<hr/>
	<!--头像 -->
	<div class="user-infoPic">
		<div class="filePic">
			<img class="am-circle am-img-thumbnail" src="{{ (session('indexUser')['pic'])?(session('indexUser')['pic']):asset('index/uploads/default.jpg') }}" alt="" />
		</div>
		<p class="am-form-help">头像</p>
		<div class="info-m">
			<div><b>用户名：<i>{{ (session('indexUser')['nickname'])?(session('indexUser')['nickname']):(session('indexUser')['tel']) }}</i></b></div>
			<div class="u-level">
				<span class="rank r2">
		             <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
	            </span>
			</div>
			<div class="u-safety">
				<a href="{{ url('index/safety') }}">
				 账户安全
				<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
				</a>
			</div>
		</div>
	</div>

	<!--个人信息 -->
	<div class="info-main">
		<form class="am-form am-form-horizontal" action="{{ url('index/seller') }}" method='post'>
			{{ csrf_field() }}
			<div class="am-form-group">
				<label for="user-name" class="am-form-label">姓名</label>
				<div class="am-form-content">
					<input type="text" id="user-name2" placeholder="name" name='name' value="{{ session('indexUser')['name']?session('indexUser')['name']:'' }}">
				</div>
			</div>
			<div class="am-form-group">
				<label for="user-phone" class="am-form-label">身份证</label>
				<div class="am-form-content">
					<input id="user-id" placeholder="ID" type="tel" name='idCard' value="{{ session('indexUser')['idcard']?session('indexUser')['idcard']:'' }}"><span ></span>
				</div>
			</div>
			<div class="am-form-group address">
				<label for="user-address" class="am-form-label">收货地址</label>
				<div class="am-form-content address">
					<a href="address.html">
						<p class="new-mu_l2cw">
							<span class="province">湖北</span>省
							<span class="city">武汉</span>市
							<span class="dist">洪山</span>区
							<span class="street">雄楚大道666号(中南财经政法大学)</span>
							<span class="am-icon-angle-right"></span>
						</p>
					</a>
				</div>
			</div>
			<div class="am-form-group safety">
				<label for="user-safety" class="am-form-label">账号安全</label>
				<div class="am-form-content safety">
					<a href="safety.html">
						<span class="am-icon-angle-right"></span>
					</a>
				</div>
			</div>
			<div class="info-btn">
				<!-- <div class="am-btn am-btn-danger">保存修改</div> -->
				<button class="am-btn am-btn-danger">保存修改</button>
			</div>
		</form>
	</div>
</div>
<script>
	$('#user-id').blur(function(){
		var id = $('#user-id').val();
		$.post("{{ url('index/idCard') }}",{'id':id,'_token':'{{ csrf_token() }}'}, function(data){
			if(data == 2)
			{
				$('#user-id').next().html("请填写正确的身份证！");
			}
		});
	})
	$('#user-id').focus(function(){
		$('#user-id').next().html('');
	});
</script>
@endsection