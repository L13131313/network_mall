@extends('layouts.parent')
@section('content') 
<div class="user-info">
	<!--标题 -->
	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
	</div>
	<hr/>

	<!--头像 -->
	<div class="user-infoPic">

		<div class="filePic">
			<form action="{{url('admin/article')}}" method="post" id="art_form" enctype="multipart/form-data">
			{{csrf_field()}}		
				<!-- <input type="file" class="inputPic" id='photo_upload' allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" enctype='multipart/form-data'> -->
				<!-- <img class="am-circle am-img-thumbnail" id='pic' src="{{ asset('index/uploads/default.jpg') }}" alt="" /> -->
				<img src="{{ (session('indexUser')['pic'])?(session('indexUser')['pic']):asset('index/uploads/default.jpg') }}" class="am-circle am-img-thumbnail" id="pic" style="width:80px;cursor: pointer;"/>
                <input type="file" name="photo" id="photo_upload" style="display: none;" />
            </form>
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

			@if (session('errors') > 0)
                @foreach (session('errors') as $error)
					<div class="panel-heading"><h3 class="panel-title">{{ $error }}</h3></div>
                @endforeach
            @endif
	<!--个人信息 -->
	<div class="info-main">
		<form class="am-form am-form-horizontal" action="{{ url('index/upload').'/'.(session('indexUser')['id']) }}" method='post'>
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="am-form-group">
				<label for="user-name2" class="am-form-label">昵称</label>
				<div class="am-form-content">
					<input type="text" id="nickname" placeholder="请输入昵称" name='nickname' value="{{ (session('indexUser')['nickname'])?(session('indexUser')['nickname']):'' }}">
				</div>
			</div>
			<div class="am-form-group">
				<label class="am-form-label">性别</label>
				<div class="am-form-content sex">
					<label class="am-radio-inline">
						<input type="radio" name="sex" value="1" data-am-ucheck {{ ((session('indexUser')['sex']) == 1) ? 'checked' :'' }}> 男
					</label>
					<label class="am-radio-inline">
						<input type="radio" name="sex" value="2" data-am-ucheck {{ ((session('indexUser')['sex']) == 2) ? 'checked' :'' }}> 女
					</label>
					<label class="am-radio-inline">
						<input type="radio" name="sex" value="3" data-am-ucheck {{ ((session('indexUser')['sex']) == 3) ? 'checked' :'' }}> 保密
					</label>
				</div>
			</div>
			<div class="am-form-group">
				<label for="user-birth" class="am-form-label">年龄</label>
				<div class="am-form-content birth">
					<input type="text" id="age" placeholder="请输入年龄" name='age' value="{{ (session('indexUser')['age'])?(session('indexUser')['age']):'' }}">
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
			<div class="info-btn">
				<div class="am-btn am-btn-danger" id='btn'>保存修改</div>
				<!-- <button class="am-btn am-btn-danger">保存修改</button> -->
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
// 这里是Ajax 全局token
// $.ajaxSetup({
//    headers: {
//      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//  });
// 图片上传
$('#pic').on('click', function(){
    $('#photo_upload').trigger('click');
    $('#photo_upload').on('change', function(){
        var obj = this;
        //用整个from表单初始化FormData
        var formData = new FormData($('#art_form')[0]);
        $.ajax({
            url: "{{url('index/upload')}}",
            type: 'post',
            data: formData,
            // 因为data值是FormData对象，不需要对数据做处理
            processData: false,
            contentType: false,
            beforeSend:function(){
                // 菊花转转图
                $('#pic').attr('src', "{{ asset('index/uploads/zhuan.png') }}");
            },
            success: function(data){
                if(data['ServerNo']=='200'){
                    // 如果成功
                    $('#pic').attr('src', '{{ asset("index/uploads") }}'+'/'+data['ResultData']);
                    $('input[name=pic]').val(data);
                    $(obj).off('change');
                }else{
                    // 如果失败
                    alert(data['ResultData']);
                }
                // console.log(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                var number = XMLHttpRequest.status;
                var info = "错误号"+number+"文件上传失败!";
                // 将菊花换成原图
                $('#pic').attr('src', '{{ asset("index/uploads/do.png") }}');
                alert(info);
            },
            async: true
        });
    });
});
$('#btn').click(function(){
	var nickname = $("input:text[name='nickname']").val();
	var sex = $('input:radio[name="sex"]:checked').val();
	var age = $("input:text[name='age']").val();
	var email = $("input[name='email']").val();
	
	var form = new FormData();
		form.append('nickname',nickname);
		form.append('sex',sex);
		form.append('age',age);
		form.append('email',email);
		form.append('_token','{{csrf_token()}}');
		form.append('_method','put');

	$.ajax({
        url: "{{ url('index/upload').'/'.(session('indexUser')['id']) }}",
        type: 'post',
        data: form,
        // 因为data值是FormData对象，不需要对数据做处理
        processData: false,
        contentType: false,
        success: function(data){
        	// location.href = location.href;
            alert(data);
        },
        async: true
    });
});
</script>
@endsection