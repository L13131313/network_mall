@extends('layouts.parent')
@section('content')
<link href="{{ asset('index/css/systyle.css') }}" rel="stylesheet" type="text/css">
<div class="wrap-left">
	<div class="wrap-list">
		<div class="m-user">
			<!--个人信息 -->
			<div class="m-bg"></div>
			<div class="m-userinfo">
				<div class="m-baseinfo">
					<a href="information.html">
						<img src="{{ (session('indexUser')['pic'])?(session('indexUser')['pic']):asset('index/uploads/default.jpg') }}">
					</a>
					<em class="s-name">{{ (session('indexUser')['nickname'])?(session('indexUser')['nickname']):(session('indexUser')['tel']) }}<span class="vip1"></em>
					<div class="s-prestige am-btn am-round">
						</span>会员福利</div>
				</div>
				<div class="m-right">
					<div class="m-address">
						<a href="{{ url('index/address') }}" class="i-trigger">我的收货地址</a>
					</div>
				</div>
			</div>
		</div>
		<div class="box-container-bottom"></div>

		<!--订单 -->
		<div class="m-order">
			<div class="s-bar">
				<i class="s-icon"></i>我的订单
				<a class="i-load-more-item-shadow" href="order.html">全部订单</a>
			</div>
			<ul>
				<li><a href="{{ asset('index/order') }}"><i><img src="{{ asset('index/images/pay.png') }}"/></i><span>待付款</span></a></li>
				<li><a href="{{ asset('index/order') }}"><i><img src="{{ asset('index/images/send.png') }}"/></i><span>待发货<em class="m-num">1</em></span></a></li>
				<li><a href="{{ asset('index/order') }}"><i><img src="{{ asset('index/images/receive.png') }}"/></i><span>待收货</span></a></li>
				<li><a href="{{ asset('index/order') }}"><i><img src="{{ asset('index/images/comment.png') }}"/></i><span>待评价<em class="m-num">3</em></span></a></li>
				<li><a href="{{ asset('index/change') }}"><i><img src="{{ asset('index/images/refund.png') }}"/></i><span>退换货</span></a></li>
			</ul>
		</div>
		<!--九宫格-->
		<div class="user-patternIcon">
			<div class="s-bar">
				<i class="s-icon"></i>我的常用
			</div>
			<ul>
				<a href="{{ url('index/shoppingcart') }}"><li class="am-u-sm-4"><i class="am-icon-shopping-basket am-icon-md"></i><img src="{{ asset('index/images/iconbig.png') }}"/><p>购物车</p></li></a>
				<a href="collection.html"><li class="am-u-sm-4"><i class="am-icon-heart am-icon-md"></i><img src="../images/iconsmall1.png"/><p>我的收藏</p></li></a>
				<a href="{{ url('index/home') }}"><li class="am-u-sm-4"><i class="am-icon-gift am-icon-md"></i><img src="{{ asset('index/images/iconsmall0.png') }}"/><p>为你推荐</p></li></a>
				<a href="{{ url('index/foot') }}"><li class="am-u-sm-4"><i class="am-icon-clock-o am-icon-md"></i><img src="{{ asset('index/images/iconsmall2.png') }}"/><p>我的足迹</p></li></a>                                                                        
			</ul>
		</div>
		<!--物流 -->
		<div class="m-logistics">
			<div class="s-bar">
				<i class="s-icon"></i>我的物流
			</div>
			<div class="s-content">
				<ul class="lg-list">

					<li class="lg-item">
						<div class="item-info">
							<a href="#">
								<img src="{{ asset('index/images/65.jpg_120x120xz.jpg') }}" alt="抗严寒冬天保暖隔凉羊毛毡底鞋垫超薄0.35厘米厚吸汗排湿气舒适">
							</a>
						</div>
						<div class="lg-info">
							<p>快件已从 义乌 发出</p>
							<time>2015-12-20 17:58:05</time>
							<div class="lg-detail-wrap">
								<a class="lg-detail i-tip-trigger" href="{{ url('index/logistics') }}">查看物流明细</a>
							</div>
						</div>
						<div class="lg-confirm">
							<a class="i-btn-typical" href="#">确认收货</a>
						</div>
					</li>
					<div class="clear"></div>

					<li class="lg-item">
						<div class="item-info">
							<a href="#">
								<img src="{{ asset('index/images/88.jpg_120x120xz.jpg') }}" alt="礼盒袜子女秋冬 纯棉袜加厚 女式中筒袜子 韩国可爱 女袜 女棉袜">
							</a>

						</div>
						<div class="lg-info">
							<p>已签收,签收人是青年城签收</p>
							<time>2015-12-19 15:35:42</time>
							<div class="lg-detail-wrap">
								<a class="lg-detail i-tip-trigger" href="{{ url('index/logistics') }}">查看物流明细</a>
							</div>

						</div>
						<div class="lg-confirm">
							<a class="i-btn-typical" href="#">确认收货</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="wrap-right">

	<!-- 日历-->
	<div class="day-list">
		<div class="s-bar">
			<a class="i-history-trigger s-icon" href="#"></a>我的日历
			<a class="i-setting-trigger s-icon" href="#"></a>
		</div>
		<div class="s-care s-care-noweather">
			<div class="s-date">
				<em>21</em>
				<span>星期一</span>
				<span>2015.12</span>
			</div>
		</div>
	</div>
	<!--新品 -->
	<div class="new-goods">
		<div class="s-bar">
			<i class="s-icon"></i>今日新品
			<a class="i-load-more-item-shadow">15款新品</a>
		</div>
		<div class="new-goods-info">
			<a class="shop-info" href="#" target="_blank">
				<div class="face-img-panel">
					<img src="{{ asset('index/images/imgsearch1.jpg') }}" alt="">
				</div>
				<span class="new-goods-num ">4</span>
				<span class="shop-title">剥壳松子</span>
			</a>
		</div>
	</div>

	<!--热卖推荐 -->
	<div class="new-goods">
		<div class="s-bar">
			<i class="s-icon"></i>热卖推荐
		</div>
		<div class="new-goods-info">
			<a class="shop-info" href="#" target="_blank">
				<div >
					<img src="{{ asset('index/images/imgsearch1.jpg') }}" alt="">
				</div>
                <span class="one-hot-goods">￥9.20</span>
			</a>
		</div>
	</div>
</div>
@endsection