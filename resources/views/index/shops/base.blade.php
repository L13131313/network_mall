<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>layout 后台大布局 - Layui</title>
        <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
        {{--layer--}}
        <link href="{{ asset('layui/css/layui.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('layer/jquery-1.8.3.min.js')}}"></script>
        <script src="{{ asset('layer/layer.js')}}"></script>
        <script src="{{ asset('layui/layui.js')}}"></script>
        <style>
            a,a:hover{
                text-decoration: none;
            }
        </style>
    </head>
    <body class="layui-layout-body">

        <div class="layui-layout layui-layout-admin">
            <div class="layui-header">
                <div class="layui-logo" style="font-size:20px;">卖家中心</div>
                <!-- 头部区域（可配合layui已有的水平导航） -->
                <ul class="layui-nav layui-layout-left">
                    <li class="layui-nav-item"><a href="">控制台</a></li>
                    <li class="layui-nav-item"><a href="">商品管理</a></li>
                    <li class="layui-nav-item"><a href="">用户</a></li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">其它系统</a>
                        <dl class="layui-nav-child">
                            <dd><a href="">邮件管理</a></dd>
                            <dd><a href="">消息管理</a></dd>
                            <dd><a href="">授权管理</a></dd>
                        </dl>
                    </li>
                </ul>
                <ul class="layui-nav layui-layout-right">
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                            贤心
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="">基本资料</a></dd>
                            <dd><a href="">安全设置</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item"><a href="">退了</a></li>
                </ul>
            </div>

            <div class="layui-side layui-bg-black">
                <div class="layui-side-scroll">
                    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                        <li class="layui-nav-item layui-nav-itemed">
                            <a class="" href="javascript:;">店铺管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;">店铺配置</a></dd>
                                <dd><a href="javascript:;">修改配置</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">栏目管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;">添加栏目</a></dd>
                                <dd><a href="javascript:;">栏目列表</a></dd>
                                <dd><a href="">修改栏目</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">商品管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="{{ url('shops/goods') }}">发布商品</a></dd>
                                <dd><a href="javascript:;">出售中的商品</a></dd>
                                <dd><a href="">仓库中的商品</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">交易管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;">已出售的商品</a></dd>
                                <dd><a href="javascript:;">评论管理</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item"><a href="">投诉管理</a></li>
                    </ul>
                </div>
            </div>

            <div class="layui-body">
                <!-- 内容主体区域 -->
                <div style="padding: 15px;">
                    @yield('content')
                </div>
            </div>
            <div class="layui-footer">
                <!-- 底部固定区域 -->
                © layui.com - 底部固定区域
            </div>
        </div>
    <script></script>
    <script>
        //JavaScript代码区域
        layui.use('element', function(){
            var element = layui.element;

        });
    </script>
    </body>
</html>
