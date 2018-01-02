<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->s_name }}</title>

    <link href="{{ asset('index/css/shops_admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('index/css/shops_amazeui.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('index/css/shops_seastyle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('index/css/shops_demo.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('index/css/layui/css/layui.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('index/css/layer/jquery.js')}}"></script>
    <script src="{{ asset('index/css/layer/layer.js')}}"></script>
    <script src="{{ asset('index/css/layui/layui.js')}}"></script>

</head>

<body>

<!--顶部导航条 -->
<div class="am-container header">
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <a href="#" target="_top" class="h">亲，请登录</a>
                <a href="#" target="_top">免费注册</a>
            </div>
        </div>
    </ul>
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
    </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="{{ asset('shops/one/images/logo.png') }}"" /></div>

    <div class="logoBig" style="margin-left:-60px;">
        <li><img src="{{ asset('shops/one/images/logobig.png') }}"" /></li>
    </div>
    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form>
            <input id="searchInput" name="search" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜本店" index="1" type="submit">
            <input id="an-topsearch" class="submit am-btn" value="搜全站" index="1" type="submit">
        </form>
    </div>
</div>

        <img src="{{ asset($data->s_log) }}" alt="" width="100%">

<ul class="layui-nav" lay-filter="" style="background:#075991;">
    <div style="width:1170px;margin:0 auto;">
        <li class="layui-nav-item layui-this"><a href="{{ asset($data->s_link) }}">店铺首页</a></li>
        @foreach($nav as $v)
            <li class="layui-nav-item"><a href="{{ url('index/shops/cate/'.$data->id.'/'.$v->id) }}">{{ $v->nav_name }}</a></li>
        @endforeach
    </div>
</ul>
@if ($heat->toArray() != [])
    <div class="layui-carousel" id="test1">
        <div carousel-item>
            @foreach($heat as $v)
                <a href="{{ $v->goods_url }}"><img src="{{ $v->g_cover }}" height="280" alt=""></a>
            @endforeach
        </div>
    </div>
@endif
<!-- 条目中可以是任意内容，如：<img src=""> -->

<div class="search">
    <div class="search-list">


        <div class="am-g am-g-fixed">
            <div class="am-u-sm-12 am-u-md-12">
                <div class="search-content">
                    <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                        @foreach($goods as $v)
                        <li>
                            <div class="i-pic limit">
                                <a href="{{ asset($v->goods_url) }}"><img src="{{ asset($v->g_cover) }}" width="218" height="218" /></a>
                                <a href="{{ asset($v->goods_url) }}"><p class="title fl">{{ $v->g_name }}</p></a>
                                @if(!empty($v->goods_spec['0']))
                                <p class="price fl">
                                    <b>¥</b>
                                    <strong>{{ $v->goods_spec['0']['g_discount'] }}</strong>
                                </p>
                                @endif
                                @if(!empty($v->goods_details['0']))
                                <p class="number fl">
                                    销量<span>{{$v->goods_details['0']['g_sales_volume']}}</span>
                                </p>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="search-side">
                    <li>
                        <div class="i-pic check">
                            <p class="check-title" style="color:#ff9229;">认证商家</p>
                            <p style="text-align:center;">店铺： <span>{{ $data->s_name }}</span></p><br>
                            <p style="text-align:center;">掌柜： <span>{{ $data->nickname }}</span></p><br>
                            <table width="150" style="margin-left:45px;">
                                <tr >
                                    <td><span style="color:#f99847;">描述</span></td>
                                    <td><span style="color:#f99847;">描述</span></td>
                                    <td><span style="color:#f99847;">描述</span></td>
                                </tr>
                                <tr>
                                    <td><span style="color:red;font-weight:bold;margin-left:3px;">{{ $data->des_score }}</span></td>
                                    <td><span style="color:red;font-weight:bold;margin-left:3px;">{{ $data->service_score }}</span></td>
                                    <td><span style="color:red;font-weight:bold;margin-left:3px;">{{ $data->logistics_score }}</span></td>
                            </table>
                            <p style="text-align:center;margin-top:15px;padding-bottom:60px;"><a href="{{ asset($data->s_link) }}" style="background:#333;width:70px;height:30px;display:block;line-height:30px;border:1px solid #000;color:#fff;float:left;margin-left:30px;">进入店铺</a><a href="" style="background:#333;width:70px;height:30px;display:block;line-height:30px;border:1px solid #000;color:#fff;float:left;margin-left:15px;">收藏店铺</a></p>
                        </div>
                    </li>

                </div>
                <div class="clear"></div>

            </div>
        </div>
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
                </p>
            </div>
        </div>
    </div>

</div>

<!--引导 -->
<div class="navCir">
    <li><a href="home2.html"><i class="am-icon-home "></i>首页</a></li>
    <li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
    <li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
    <li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>
</div>

<!--菜单 -->
<div class=tip>
    <div id="sidebar">
        <div id="wrap">
            <div id="prof" class="item">
                <a href="#">
                    <span class="setting"></span>
                </a>
                <div class="ibar_login_box status_login">
                    <div class="avatar_box">
                        <p class="avatar_imgbox"><img src="../images/no-img_mid_.jpg" /></p>
                        <ul class="user_info">
                            <li>用户名：sl1903</li>
                            <li>级&nbsp;别：普通会员</li>
                        </ul>
                    </div>
                    <div class="login_btnbox">
                        <a href="#" class="login_order">我的订单</a>
                        <a href="#" class="login_favorite">我的收藏</a>
                    </div>
                    <i class="icon_arrow_white"></i>
                </div>

            </div>
            <div id="shopCart" class="item">
                <a href="#">
                    <span class="message"></span>
                </a>
                <p>
                    购物车
                </p>
                <p class="cart_num">0</p>
            </div>
            <div id="asset" class="item">
                <a href="#">
                    <span class="view"></span>
                </a>
                <div class="mp_tooltip">
                    我的资产
                    <i class="icon_arrow_right_black"></i>
                </div>
            </div>

            <div id="foot" class="item">
                <a href="#">
                    <span class="zuji"></span>
                </a>
                <div class="mp_tooltip">
                    我的足迹
                    <i class="icon_arrow_right_black"></i>
                </div>
            </div>

            <div id="brand" class="item">
                <a href="#">
                    <span class="wdsc"><img src="../images/wdsc.png" /></span>
                </a>
                <div class="mp_tooltip">
                    我的收藏
                    <i class="icon_arrow_right_black"></i>
                </div>
            </div>

            <div id="broadcast" class="item">
                <a href="#">
                    <span class="chongzhi"><img src="../images/chongzhi.png" /></span>
                </a>
                <div class="mp_tooltip">
                    我要充值
                    <i class="icon_arrow_right_black"></i>
                </div>
            </div>

            <div class="quick_toggle">
                <li class="qtitem">
                    <a href="#"><span class="kfzx"></span></a>
                    <div class="mp_tooltip">客服中心<i class="icon_arrow_right_black"></i></div>
                </li>
                <!--二维码 -->
                <li class="qtitem">
                    <a href="#none"><span class="mpbtn_qrcode"></span></a>
                    <div class="mp_qrcode" style="display:none;"><img src="../images/weixin_code_145.png" /><i class="icon_arrow_white"></i></div>
                </li>
                <li class="qtitem">
                    <a href="#top" class="return_top"><span class="top"></span></a>
                </li>
            </div>

            <!--回到顶部 -->
            <div id="quick_links_pop" class="quick_links_pop hide"></div>

        </div>

    </div>
    <div id="prof-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            我
        </div>
    </div>
    <div id="shopCart-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            购物车
        </div>
    </div>
    <div id="asset-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            资产
        </div>

        <div class="ia-head-list">
            <a href="#" target="_blank" class="pl">
                <div class="num">0</div>
                <div class="text">优惠券</div>
            </a>
            <a href="#" target="_blank" class="pl">
                <div class="num">0</div>
                <div class="text">红包</div>
            </a>
            <a href="#" target="_blank" class="pl money">
                <div class="num">￥0</div>
                <div class="text">余额</div>
            </a>
        </div>

    </div>
    <div id="foot-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            足迹
        </div>
    </div>
    <div id="brand-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            收藏
        </div>
    </div>
    <div id="broadcast-content" class="nav-content">
        <div class="nav-con-close">
            <i class="am-icon-angle-right am-icon-fw"></i>
        </div>
        <div>
            充值
        </div>
    </div>
</div>

<script type="text/javascript" src="../basic/js/quick_links.js"></script>

<div class="theme-popover-mask"></div>

</body>

</html>
<script>
    layui.use('element', function(){
        var element = layui.element;

        //…
    });

    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
    });

</script>