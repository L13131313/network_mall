<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>登录</title>
@include('admin.public.styles')
    <!--[if lt IE 9]>
    <script src="{{ asset('admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('admin/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper-page">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="text-center m-t-10">登录</h3>
        </div>
        <div class="panel-body">
            @include('admin.public.error')
            @if(!is_string($errors) &&  count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            @else
                @if(!empty($error))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $error }}</p>
                    </div>
                @endif
            @endif

            <form class="form-horizontal m-t-10 p-20 p-b-0" action="{{ url('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="name" type="text" placeholder="手机号"
                               value="">
                    </div>
                </div>
                <div class="form-group ">

                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" placeholder="密码">
                    </div>
                </div>

                <div class="form-group text-right">
                    <div class="col-xs-12">
                        <button class="btn btn-success w-md" type="submit">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.public.script')
</body>
</html>
