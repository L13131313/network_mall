@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '用户列表')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Form validations</h3></div>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="get" action="#" novalidate="novalidate">
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-2">用户名 *</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="firstname" name="firstname" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-2">密码  *</label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="lastname" name="lastname" type="password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="username" class="control-label col-lg-2">Username *</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="username" name="username" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="control-label col-lg-2">Password *</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="password" name="password" type="password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="confirm_password" class="control-label col-lg-2">Confirm Password *</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="confirm_password" name="confirm_password" type="password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="email" class="control-label col-lg-2">Email *</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="email" name="email" type="email">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our Policy *</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input type="checkbox" style="width: 16px" class="checkbox form-control" id="agree" name="agree">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="newsletter" class="control-label col-lg-2 col-sm-3">Receive the Newsletter</label>
                                <div class="col-lg-10 col-sm-9">
                                    <input type="checkbox" style="width: 16px" class="checkbox form-control" id="newsletter" name="newsletter">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit">登录</button>
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
