@extends('admin.layouts.master')
@section('title', '管理员用户')
@section('page-title', '管理员信息修改')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <!-- <div class="panel-heading"><h3 class="panel-title">{{ $error }}</h3></div> -->
                    @endforeach
                @else
                    @if(session('msg'))
                    <div class="panel-heading"><h3 class="panel-title">{{ session('msg') }}</h3></div>
                    @endif
                @endif
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action='{{ url("admin/user/$userinfo->id") }}' novalidate="novalidate">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-2">用户名 *</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="firstname" name="name" type="text" value="{{ $userinfo->name }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-2">密码  *</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="lastname" name="pwd" type="password" value='{{ $pwd }}'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">角色选择  *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name='status'>
                                        <option value='0' {{ ($userinfo->status) ? '' : 'selected' }}>管理员</option>
                                        <option value='1' {{ ($userinfo->status) ? 'selected' : '' }}>超级管理员</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">修改</button>
                                    <button class="btn btn-default" type="button">重置</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@stop

@section('script')

@stop
