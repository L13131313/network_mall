<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>layout 后台大布局 - Layui</title>
        <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
        {{--layer--}}
        <link href="{{ asset('layui/css/layui.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('layer/jquery.js')}}"></script>
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
            <div class="layui-header" style="background-color:#4A708B;">
                <div class="layui-logo" style="font-size:20px;color:#fff;">卖家中心</div>
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
                            <img src="" class="layui-nav-img">
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

            <div class="layui-side" style="background-color:#4A708B;">
                <div class="layui-side-scroll">
                    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                    <ul class="layui-nav layui-nav-tree"  lay-filter="test" style="background-color:#4A708B;">
                        <li class="layui-nav-item layui-nav-itemed">
                            <a class="" href="javascript:;">我的店铺</a>
                            <dl class="layui-nav-child">
                                <dd><a href="{{ url('shops/shopadmin/create') }}">进入店铺</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a class="" href="javascript:;">店铺管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="{{ url('shops/shopadmin') }}">店铺信息</a></dd>
                                <dd><a href="{{ url('shops/shopadmin/create') }}">装修店铺</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">分类管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="{{ url('shops/cate/create') }}">添加分类</a></dd>
                                <dd><a href="{{ url('shops/cate') }}">分类列表</a></dd>
                            </dl>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;">商品管理</a>
                            <dl class="layui-nav-child">
                                <dd><a href="{{ url('shops/goods') }}">发布商品</a></dd>
                                <dd><a href="{{ url('shops/goods/sellList') }}">出售中的商品</a></dd>
                                <dd><a href="{{ url('shops/warehouse') }}">仓库中的商品</a></dd>
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
