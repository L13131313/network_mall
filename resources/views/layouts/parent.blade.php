<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人中心</title>

		<link href="{{ asset('index/assets/css/admin.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/assets/css/amazeui.css') }}" rel="stylesheet" type="text/css">

		<link href="{{ asset('index/css/personal.css') }}" rel="stylesheet" type="text/css">

		<link href="{{ asset('index/css/stepstyle.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/css/infstyle.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/css/addstyle.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/css/stepstyle.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/css/colstyle.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('index/css/footstyle.css') }}" rel="stylesheet" type="text/css">

		<script src="{{ asset('index/assets/js/jquery.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('index/assets/js/amazeui.js') }}" type="text/javascript"></script>

	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									@if(!session('indexUser'))
										<a href="{{ url('index/login') }}" target="_top" class="h">亲，请登录</a>
										<a href="{{ url('index/register') }}" target="_top">免费注册</a>
									@else
										<a href="{{ url('index/logOut') }}" target="_top">退出登录</a>
									@endif
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="{{ url('index/home') }}" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="{{ url('index/user') }}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								@if(session('indexUser')['status'] == 1)
									<div class="menu-hd MyShangcheng"><a href="{{ url('shops/index') }}" target="_top"><i class="am-icon-user am-icon-fw"></i>卖家中心</a></div>
								@else
									<div class="menu-hd MyShangcheng"><a href="{{ url('index/status') }}" target="_top"><i class="am-icon-user am-icon-fw"></i>卖家中心</a></div>
								@endif
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
						</ul>
					</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="{{ asset('index/images/logobig.png') }}" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
			   <div class="long-title"><span class="all-goods">全部分类</span></div>
			   <div class="nav-cont">
					<ul>
						<li class="index"><a href="{{ url('index/home') }}">首页</a></li>
                        <li class="qc"><a href="{{ url('index/user') }}">个人中心</a></li>
					</ul>
				    <div class="nav-extra">
				    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
				    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
				    </div>
				</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					@yield('content')
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
						</p>
					</div>
				</div>

			</div>

			<aside class="menu">
				<ul>
					<li class="person active">
						<a href="{{ url('index/user') }}">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="{{ url('index/information') }}">个人信息</a></li>
							<li> <a href="{{ url('index/safety') }}">安全设置</a></li>
							<li> <a href="{{ url('index/address') }}">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="{{ url('index/order') }}">订单管理</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="{{ url('index/foot') }}">足迹</a></li>
							<li> <a href="{{ url('index/comment') }}">评价</a></li>
						</ul>
					</li>
					
					<li class="person">
						<a href="#">成为商家</a>
						<ul>
							<li> <a href="{{ url('index/status') }}">资料补充</a></li>
						</ul>
					</li>
				</ul>
			</aside>
		</div>
		<!--引导 -->
		<!-- <div class="navCir">
			<li><a href="../home/home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="../home/sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="../home/shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li class="active"><a href="index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div> -->
	</body>
</html>