<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>admin</title>
{{--引入CSS--}}
@include('admin.public.styles')
@yield('styles')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('home/js/html5shiv.js') }}"></script>
    <script src="{{ asset('home/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
{{--引入侧边栏--}}
@include('admin.public.aside')
<!--主内容 -->
<section class="content">
    {{--引入header--}}
    @include('admin.public.header')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">@yield('page-title')</h3>
        </div>
        @yield('content')
    </div>
    {{--引入底部--}}
    @include('admin.public.footer')
</section>
{{--引入JS--}}
@include('admin.public.script')
@yield('script')
</body>
</html>
