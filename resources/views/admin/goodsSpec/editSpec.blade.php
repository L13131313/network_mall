@extends('admin.layouts.master')
@section('title', '修改属性')
@section('page-title', '修改属性')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class=" form">
                        @foreach($data as $v)
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action='{{ url("admin/spec/$v->id") }}' novalidate="novalidate">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="row" style="margin-top:50px;">
                                <div class="col-lg-5 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-2">分类名 <span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="firstname" readonly type="text" value="{{ $v->cate->catname }}">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="firstname" class="control-label col-lg-2">规格名 <span style="color:red;">*</span></label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="firstname" name="specName" type="text" value="{{ $v->specName }}">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button id="submit" class="btn btn-success" type="submit">修改</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div> <!-- .form -->

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@stop


@section('script')

@stop
