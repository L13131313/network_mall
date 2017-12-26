<!-- Aside Start-->
<aside class="left-panel">
    <!-- brand -->
    <div class="logo" style="height:59px">
        <a href="{{url('/')}}" class="logo-expanded">
            <i class="ion-social-buffer"></i>
            <span class="nav-label">后台管理</span>
        </a>
    </div>
    <!-- / brand -->
    <!-- Navbar Start -->

    <nav class="navigation">
        <ul class="list-unstyled">
            <li class=""><a href="{{url('admin/index')}}"><i class="zmdi zmdi-view-dashboard"></i> <span
                            class="nav-label">主页</span></a></li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">用户管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ url('admin/user/create') }}">添加用户</a>
                        <a href="{{ url('admin/user') }}">管理员列表</a>
                        <a href="{{ url('admin/publicUserList') }}">用户列表</a>
                        <a href="{{ url('admin/publicList') }}">商家列表</a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">商品管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{url('admin/goods')}}">商品列表</a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">店铺管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ url('admin/shops') }}">店铺列表</a>
                    </li>
                </ul>
            </li>
			
            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">分类管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ url('admin/category') }}">分类列表</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/category/create') }}">添加分类</a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">订单管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ url('admin/OrderList') }}">订单列表</a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">投诉管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{url('admin/complaint')}}">投诉列表</a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#">
                    <i class="zmdi ion-android-contacts"></i>
                    <span class="nav-label">商品属性管理</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{url('admin/attribute/create')}}">添加属性名</a>
                        <a href="{{url('admin/attribute/create/value')}}">添加属性值</a>
                        <a href="{{url('admin/attribute/spec')}}">添加规格</a>
                        <a href="{{url('admin/attribute')}}">属性列表</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</aside>
<!-- Aside Ends-->