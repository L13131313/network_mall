<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>购物车页面</title>

    <link href="{{ asset('home/css/amazeui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/demo.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/cartstyle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/optstyle.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{ asset('home/js/jquery.js') }}"></script>

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
            <div class="menu-hd"><a id="mc-menu-hd" href="{{ url('index/shoppingcart') }}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
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

<form action="{{ url('index/shoppingcart/account') }}" name="account">
    <input type="hidden" name="orderData" id="orderData" value="">
</form>

<!--购物车 -->
<div class="concent">
    <div id="cartTable">
        <div class="cart-table-th">
            <div class="wp">
                <div class="th th-chk">
                    <div id="J_SelectAll1" class="select-all J_SelectAll">

                    </div>
                </div>
                <div class="th th-item">
                    <div class="td-inner">商品信息</div>
                </div>
                <div class="th th-price">
                    <div class="td-inner">单价</div>
                </div>
                <div class="th th-amount">
                    <div class="td-inner">数量</div>
                </div>
                <div class="th th-sum">
                    <div class="td-inner">金额</div>
                </div>
                <div class="th th-op">
                    <div class="td-inner">操作</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        @foreach($list as $v)
        <tr class="item-list">
            <div class="bundle  bundle-last ">
                <div class="bundle-hd">
                    <div class="bd-promos">
                        <div class="act-promo">
                            <a href="{{ $v->s_link }}" target="_blank">店铺：{{ $v->s_name }}<span class="gt">&gt;&gt;</span></a>
                        </div>
                    </div>
                </div>
                <div class="bundle-main">
                    <ul class="item-content clearfix">
                        <li class="td td-chk">
                            <div class="cart-checkbox ">
                                <input class="gid" type="hidden" value="{{ $v->gid }}">
                                <input class="g_specid" type="hidden" value="{{ $v->g_specid }}">
                                <input class="check" name="items[]" value="170769542747" type="checkbox">
                            </div>
                        </li>

                        <li class="td td-item">
                            <div class="item-pic">
                                <a href="{{ $v->g_link }}" target="_blank" class="J_MakePoint" >
                                    <img src="{{ asset("$v->g_pic") }}"  title="{{ $v->g_name }}" style="width: 105px" class="itempic J_ItemImg">
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="item-basic-info">
                                    <a href="{{ $v->g_link }}" target="_blank" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $v->g_name }}</a>
                                </div>
                            </div>
                        </li>
                        <li class="td td-info">
                            <div class="item-props item-props-can">
                                <span class="sku-line">颜色:{{ $v->color }}</span>
                                <span class="sku-line">大小:{{ $v->size }}</span>
                                <span tabindex="0" class="btn-edit-sku theme-login"><a href="{{ $v->g_link }}" target="_blank">修改</a></span>
                            </div>
                        </li>
                        <li class="td td-price">
                            <div class="item-price price-promo-promo">
                                <div class="price-content">
                                    <div class="price-line">
                                        <em class="price-original">{{ $v->g_price }}</em>
                                    </div>
                                    <div class="price-line nowP">
                                        <em class="J_Price price-now" tabindex="0">{{ $v->g_discount }}</em>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="td td-amount">
                            <div class="amount-wrapper ">
                                <div class="item-amount ">
                                    <div class="sl">
                                        <input class="min am-btn" name="" type="button" value="-" />
                                        <input disabled class="text_box" name="" type="text" value="{{ $v->count }}" style="width:30px;text-align: center" />
                                        <input class="add am-btn" name="" type="button" value="+" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="td td-sum">
                            <div class="td-inner">
                                <em tabindex="0" class="J_ItemSum number">{{ $v->g_discount }}</em>
                            </div>
                        </li>
                        <li class="td td-op">
                            <div class="td-inner">
                                <a href="javascript:del({{ $v->gid }});" data-point-url="#" class="delete">
                                    删除</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </tr>
        @endforeach
    </div>
    <div class="clear"></div>


    <div class="float-bar-wrapper">
        <div id="J_SelectAll2" class="select-all J_SelectAll">
            <div class="cart-checkbox">
                <input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
                <label for="J_SelectAllCbx2"></label>
            </div>
            <span>全选</span>
        </div>
        <div class="operations">
            <a href="javascript:empty()" hidefocus="true" class="deleteAll">清空购物车</a>
        </div>
        <div class="float-bar-right">
            <div class="amount-sum">
                <span class="txt">已选商品</span>
                <em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
                <div class="arrow-box">
                    <span class="selected-items-arrow"></span>
                    <span class="arrow"></span>
                </div>
            </div>
            <div class="price-sum">
                <span class="txt">合计:</span>
                <strong class="price">¥<em id="J_Total">0.00</em></strong>
            </div>
            <div class="btn-area">
                <a href="javascript:account()" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
                    <span>结&nbsp;算</span>
                </a>
            </div>
        </div>

    </div>
</div>
<script>
    var sum = 0;

    $('.add').click(function () {

        $(this).prevAll('.min').attr('disabled',false);
        goodsNum = parseInt($(this).parent().children('.text_box').val())+1;
        goodsPrice = parseFloat($(this).parents('.td-amount').prev().children().children().children('.nowP').children().html());
        goodsOneSum = goodsNum*goodsPrice;
        $(this).parents('.td-amount').next().children().children('.J_ItemSum').text(goodsOneSum);

        if($(this).parents('.item-content').children('li.td-chk').children().children('.check').attr('checked')){
            sum += goodsPrice;
            $('#J_Total').text(sum);
        }

    });

    $('.min').click(function () {

            goodsNum = parseInt($(this).parent().children('.text_box').val()) - 1;
            goodsPrice = parseFloat($(this).parents('.td-amount').prev().children().children().children('.nowP').children().html());
            goodsOneSum = goodsNum * goodsPrice;
            $(this).parents('.td-amount').next().children().children('.J_ItemSum').text(goodsOneSum);

            if(goodsNum <= 1){
                $(this).attr('disabled',true);
            }

            if($(this).parents('.item-content').children('li.td-chk').children().children('.check').attr('checked')){
                sum -= goodsPrice;
                $('#J_Total').text(sum);
            }

    });

    $(".text_box").each(function(){

        if($(this).val() == '1'){
            $(this).attr('disabled',true);
        }

        goodsNum = $(this).val();
        goodsPrice = $(this).parents('.td-amount').prev().children().children().children('.nowP').children().html();
        goodsOneSum = goodsNum*goodsPrice;
        $(this).parents('.td-amount').next().children().children('.J_ItemSum').text(goodsOneSum);

    });


    //刷新浏览器，默认所有多选按钮都不选中(即：没有选择商品)
    $("input[class = 'check']").each(function () {
        $(this).attr('checked',false);
    });

    $('#J_SelectAllCbx2').attr('checked',false);



    $("input[class = 'check']").click(function () {

        $goodsprice = parseFloat($(this).parents(".item-content").children('.td-sum').children().children().html());

        if($(this).attr('checked')){

           sum += $goodsprice;
           $('#J_Total').text(sum);
           num = parseInt($('#J_SelectedItemsCount').text())+1;
           $('#J_SelectedItemsCount').text(num);
        }else{

            sum -= $goodsprice;
            $('#J_Total').text(sum);
            num = parseInt($('#J_SelectedItemsCount').text())-1;
            $('#J_SelectedItemsCount').text(num);
        }

    });

    $('#J_SelectAllCbx2').click(function () {
        if($(this).attr('checked')){                            //全选商品
            sum = 0;
            num = 0;
            $("input[class = 'check']").attr('checked',true);
            $('.J_ItemSum').each(function () {
               goodsOneSum = parseFloat($(this).text());
               sum += goodsOneSum;
                $('#J_Total').text(sum);
                num++;
            });
            $('#J_SelectedItemsCount').text(num);

        }else{                                                  //全不选商品
            $("input[class = 'check']").attr('checked',false);
            sum = 0;
            $('#J_Total').text(0);
            num = 0;
            $('#J_SelectedItemsCount').text(num);
        }
    });

    //删除
    function del(gid) {
        $.ajax({
            url:'{{ url('index/shoppingcart/deletegoods') }}',				//请求地址
            async:true,					                                    //是否异步
            data:{ gid:gid },				                                //发送的数据
            type:'get',				                                        //请求方式
            success:function(data)		                                    //ajax请求成功调用的函数
            {
                if(data){
                    location.href = location.href;
                }else{
                    alert('异常，删除失败');
                }
            },
            error:function()			                                    //ajax请求失败调用的函数
            {
                alert('ajax请求失败');
            }
        });
    }

    //清空
    function empty() {

        $.ajax({
            url:'{{ url('index/shoppingcart/empty') }}',				//请求地址
            async:true,					                                //是否异步//发送的数据
            type:'get',				                                    //请求方式
            success:function(data)		                                //ajax请求成功调用的函数
            {
                if(data == ''){
                    location.href = location.href;
                }else{
                    alert('异常，清空失败');
                }
            },
            error:function()			                                //ajax请求失败调用的函数
            {
                alert('ajax请求失败');
            }
        });

    }

    //结算
    function account() {

        var account = null;
        $("input[class = 'check']").each(function () {
            if($(this).attr('checked')){
                account = 1;
            }
        });
        if(account == null){
            alert('您还没有选择商品，请选择商品');
        }else{

            //保存所有选中的商品
            var arr = [], allLength = 0;
            $("input[class = 'check']").each(function () {

                var onegoods = [], length = 0;
                if($(this).attr('checked')){
                   onegoods[length++] = $(this).parents('.cart-checkbox').children('.gid').val();           //规格id
                   onegoods[length++] = $(this).parents('.cart-checkbox').children('.g_specid').val();    //商品id
                   onegoods[length++] = $(this).parents('.item-content').children('.td-amount').children().children().children().children('.text_box').val();   //商品数量
                   onegoods[length] = '@';
                   arr[allLength] = onegoods;
                   allLength++;
                }
            });

            arr[allLength] = $('#J_Total').text();
            $('#orderData').val(arr);
            document.account.submit();

        }
    }
    
</script>

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
            <em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.css') }}moban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.css') }}moban.com/" title="网页模板" target="_blank">网页模板</a></em>
        </p>
    </div>
</div>

</body>

</html>
