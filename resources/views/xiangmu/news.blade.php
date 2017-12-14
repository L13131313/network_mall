@extends('xiangmu.parent')
@section('content')
<link href="{{ asset('xiangmu/css/newstyle.css') }}" rel="stylesheet" type="text/css">
<div class="user-news">
	<!--标题 -->
	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的消息</strong> / <small>News</small></div>
	</div>
	<hr/>

	<div class="am-tabs am-tabs-d2" data-am-tabs>
		<ul class="am-avg-sm-3 am-tabs-nav am-nav am-nav-tabs">
			<li class="am-active"><a href="#tab1">物流助手</a></li>
		</ul>

		<div class="am-tabs-bd">
			<div class="am-tab-panel am-fade am-in am-active" id="tab1">
				<!--消息 -->
					<div class="s-msg-item s-msg-temp i-msg-downup">
						<h6 class="s-msg-bar"><span class="s-name">订单已签收</span></h6>
						<div class="s-msg-content i-msg-downup-wrap">
							<div class="i-msg-downup-con">
								<a class="i-markRead" target="_blank" href="{{ url('index/logistics') }}">
								<div class="m-item">	
									<div class="item-pic">															
												<img src="../images/kouhong.jpg_80x80.jpg" class="itempic J_ItemImg">
									</div>
									<div class="item-info">
										您购买的美康粉黛醉美唇膏已签收，
										快递单号:373269427868
									</div>
																						
                                </div>	

								<p class="s-row s-main-content">
										查看详情 <i class="am-icon-angle-right"></i>
								</p>
								</a>
							</div>
						</div>
						<a class="i-btn-forkout" href="#"><i class="am-icon-close am-icon-fw"></i></a>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection