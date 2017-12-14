<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="img/favicon_1.ico">

    <title>Velonic - Responsive Admin Dashboard Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-reset.css') }}" rel="stylesheet">

    <!--Animation css-->
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="{{ asset('admin/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/material-design-iconic-font.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/helper.css') }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('admin/js/respond.min.js') }}"></script>
    <![endif]-->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-62751496-1', 'auto');
        ga('send', 'pageview');

    </script>

</head>


<body>

<div class="wrapper-page">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="text-center m-t-10"> 注册账号 </h3>
        </div>

        <div class="panel-body">
            <form class="form-horizontal m-t-10 p-20 p-b-0" action="">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Tel">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control " type="text" required="" placeholder="
Verification Code">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control " type="password" required="" placeholder="Password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <label class="cr-styled">
                            <input type="checkbox" checked>
                            <i class="fa"></i>
                            我接受 <strong><a href="#">条款和条件</a></strong>
                        </label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-success w-md" type="submit">注册</button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-12 text-center">
                        <a href="{{ url('login') }}">已经有帐号?</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>




<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('admin/js/jquery.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/pace.min.js') }}"></script>
<script src="{{ asset('admin/js/wow.min.js') }}"></script>
                    <script src="{{ asset('admin/js/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!--common script for all pages-->
<script src="js/jquery.app.js"></script>


</body>
</html>
