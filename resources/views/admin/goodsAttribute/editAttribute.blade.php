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
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action='{{ url("admin/attribute/$data->attrid") }}' novalidate="novalidate">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="row" style="margin-top:50px;">
                                <div class="col-lg-5 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">分类名 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="cate">
                                                            <option value="">{{ $data->catName }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">属性名 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="firstname" name="attrName" type="text" value="{{ $data->attrName }}">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">排 序 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="firstname" name="attrSort" type="text" value="{{ $data->attrSort }}">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">添加类型 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="radio" name="attrType" value="0" @if ($data->attrType == 0) checked @endif>输入框
                                            <input type="radio" name="attrType" value="1" @if ($data->attrType == 1) checked @endif>多选框
                                            <input type="radio" name="attrType" value="2" @if ($data->attrType == 2) checked @endif>下拉框
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
                    </div> <!-- .form -->

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div>
@stop


@section('script')

@stop
