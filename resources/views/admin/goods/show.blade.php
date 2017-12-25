<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>商品页面</title>

		
		
		<!-- 规格 -->
		<link type="text/css" href="../css/optstyle.css" rel="stylesheet" />
		<link type="text/css" href="../css/style.css" rel="stylesheet" />

		<script type="text/javascript" src="../basic/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="../basic/js/quick_links.js"></script>

		<script type="text/javascript" src="../AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script type="text/javascript" src="../js/jquery.imagezoom.min.js"></script>
		<script type="text/javascript" src="../js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="../js/list.js"></script>

	</head>

	<body>
	<!--放大镜-->
		
		<div class="clearfixRight">
			<div class="clearfixLeft" id="clearcontent">
			<div class="box">
				<script type="text/javascript">
					$(document).ready(function() {
						$(".jqzoom").imagezoom();
						$("#thumblist li a").click(function() {
							$(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
							$(".jqzoom").attr('src', $(this).find("img").attr("mid"));
							$(".jqzoom").attr('rel', $(this).find("img").attr("big"));
						});
					});
				</script>

				<div class="tb-booth tb-pic tb-s310">
					<a href="../images/01.jpg"><img src="../images/01_mid.jpg" alt="细节展示放大镜特效" rel="../images/01.jpg" class="jqzoom" /></a>
				</div>
				<ul class="tb-thumb" id="thumblist">
					<li class="tb-selected">
						<div class="tb-pic tb-s40">
							<a href="#"><img src="../images/01_small.jpg" mid="../images/01_mid.jpg" big="../images/01.jpg"></a>
						</div>
					</li>
					<li>
						<div class="tb-pic tb-s40">
							<a href="#"><img src="../images/02_small.jpg" mid="../images/02_mid.jpg" big="../images/02.jpg"></a>
						</div>
					</li>
					<li>
						<div class="tb-pic tb-s40">
							<a href="#"><img src="../images/03_small.jpg" mid="../images/03_mid.jpg" big="../images/03.jpg"></a>
						</div>
					</li>
				</ul>
			</div>
		</div>
			<!--规格属性-->
			<!--名称-->
			<div class="tb-detail-hd">
				<h1>良品铺子 手剥松子218g 坚果炒货 巴西松子</h1>
			</div>
			<div class="tb-detail-list">
				<div>
					<!--价格销量-->
					<div class="tm-ind-panel">
						<div class="tm-indcon">
							<span class="tm-label">价格：</span>
							<span  class="tm-count">¥<b>98.00</b></span>
						</div>
						<div class="tm-indcon">
							<span class="tm-label">月销量：</span>
							<span class="tm-count">1015</span>
						</div>
						<div class="tm-indcon">
							<span class="tm-label">累计销量：</span>
							<span class="tm-count">6015</span>
						</div>
					</div>
				</div>
				<!--各种规格-->
				<dl class="iteminfo_parameter sys_item_specpara">
					<div class="theme-popbod dform">
						<div class="theme-signin-left">
							<div class="theme-options">
								<div class="cart-title">口味</div>
								<ul>
									<li class="sku-line">原味<i></i></li>
									<li class="sku-line">奶油<i></i></li>
									<li class="sku-line">炭烧<i></i></li>
									<li class="sku-line">咸香<i></i></li>
								</ul>
							</div>
							<div class="theme-options">
								<div class="cart-title">包装</div>
								<ul>
									<li class="sku-line">手袋单人份<i></i></li>
									<li class="sku-line">礼盒双人份<i></i></li>
									<li class="sku-line">全家福礼包<i></i></li>
								</ul>
							</div>
						</div>
					</div>
				</dl>
			</div>
			<div class="am-tab-panel am-fade am-in am-active">
				<div class="J_Brand">
					<div class="attr-list-hd tm-clear">
						<h4>产品参数：</h4>
					</div>
					<ul id="J_AttrUL">
						<li title="">产品类型:&nbsp;烘炒类</li>
						<li title="">原料产地:&nbsp;巴基斯坦</li>
						<li title="">产地:&nbsp;湖北省武汉市</li>
						<li title="">配料表:&nbsp;进口松子、食用盐</li>
						<li title="">产品规格:&nbsp;210g</li>
						<li title="">保质期:&nbsp;180天</li>
						<li title="">产品标准号:&nbsp;GB/T 22165</li>
						<li title="">生产许可证编号：&nbsp;QS4201 1801 0226</li>
						<li title="">储存方法：&nbsp;请放置于常温、阴凉、通风、干燥处保存 </li>
						<li title="">食用方法：&nbsp;开袋去壳即食</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- introduce-->
		<div class="introduce">
			<div class="introduceMain">
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
		</div>
	</body>
</html>