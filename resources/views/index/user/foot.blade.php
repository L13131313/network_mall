@extends('layouts.parent')
@section('content')
<div class="user-foot">
	<!--标题 -->
	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的足迹</strong> / <small>Browser&nbsp;History</small></div>
		<br><hr>
		<div>
			<a class="btn" href="javascript:void(0);" onclick="doDel()"><i class="am-icon-trash"></i></a>
		</div>
	</div>
	<hr/>
	<form action="" method="get" name='myform' style='display:none'> 
    </form>
	<!--足迹列表 -->
	@foreach($data as $v)
	<div class="goods">
		<div class="goods-box first-box">
			<div class="goods-pic">
				<div class="goods-pic-box">
					<a class="goods-pic-link" target="_blank" href="#" title="{{ $v->g_name }}">
						<img src='{{ asset("index$v->g_cover") }}' class="goods-img"></a>
				</div>
			</div>

			<div class="goods-attr">
				<div class="good-title">
					<a class="title" href="#" target="_blank">{{ $v->g_name }}</a>
				</div>
				@foreach($v->goods_spec as $n)
				<div class="goods-price">
					<span class="g_price">                                    
                    <span>¥</span><strong>{{ $n->g_price }}</strong>
					</span>
				</div>
				@endforeach
				<div class="clear"></div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="clear"></div>
</div>
<script>
	function doDel(){
		if(confirm('你确定要删除吗？')){
			var form = document.myform;
			form.action = "{{ url('index/delFoot') }}";
			form.submit();
		}
    }
</script>
@endsection