@extends('admin.layouts.master')
@section('title', '添加属性')
@section('page-title', '添加属性')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action="{{ url('admin/attribute') }}" novalidate="novalidate">
                            {{ csrf_field() }}
                            <b style="font-size:18px;color:#d62728;">请选择分类</b>
                            <div class="row" style="margin-top:15px;">
                                <div class="col-lg-6">
                                    <div class="form-group col-lg-4">
                                        <div class="col-sm-12">
                                            <select class="form-control" id="class_one">
                                                <option>---请选择---</option>
                                                @foreach(\App\Tools\AreaCache::getCateId(0) as $v)
                                                    <option value="{{ $v->catid }}">{{ $v->catname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <div class="col-sm-12">
                                            <select class="form-control" id="class_two">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <div class="col-sm-12">
                                            <select class="form-control" id="class_three" name='goodsCatId'>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:50px;">
                                <div class="col-lg-5 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">属性名 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="firstname" name="attrName" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">排 序 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="firstname" name="attrSort" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">添加类型</label>
                                        <div class="col-lg-10">
                                            <input type="radio" name="attrType" value="0">输入框
                                            <input type="radio" name="attrType" value="1">多选框
                                            <input type="radio" name="attrType" value="2" checked>下拉框
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button id="submit" class="btn btn-success" disabled type="submit">添加</button>
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
    <script>
        $('#class_one').on('change', function() {
            // 发生改变清空二级、三级分类
            $('#class_two').empty();
            $('#class_three').empty();
            // 发生改变禁用提交按钮
            $('#submit').attr('disabled', 'disabled');
            var catid = $(this).val();
            if (catid != '---请选择---') {
                $.ajax({
                    type: 'post',
                    url: 'classification',
                    dataType: 'json',
                    data: {'catid': catid, '_token': '{{csrf_token()}}'},
                    success: function (data) {
                        if (data.data.length > 0) {
                            for (var i in data) {
                                $.each(data[i], function (index, item) {
                                    $('#class_two').append(`<option value=${item.catid} child=${item.child}>${item.catname}</option>`);
                                });
                            }
                        }
                    },
                    error: function () {
                        alert('服务器错误，请重新选择！');
                    }
                });
            }
        });

        $('#class_two').on('change', function() {
            // 发生改变清空三级分类
            $('#class_three').empty();
            // 发生改变禁用提交按钮
            $('#submit').attr('disabled', 'disabled');
            var catid = $(this).val();
            $.ajax({
                type: 'post',
                url: 'classification',
                dataType: 'json',
                data: {'catid': catid, '_token': '{{csrf_token()}}'},
                success: function (data) {
                    if (data.data.length > 0) {
                        for (var i in data) {
                            $.each(data[i], function (index, item) {
                                $('#class_three').append(`<option value=${item.catid} child=${item.child}>${item.catname}</option>`);
                            });
                        }
                    }
                    var two_child = $('#class_two').find("option:selected").attr('child');
                    var three_child = $('#class_three').find("option:selected").attr('child');
                    if (two_child == 0 || three_child == 0) {
                        $('#submit').removeAttr('disabled');
                    }
                },
                error: function () {
                    alert('服务器错误，请重新选择！');
                }
            });
        });
    </script>
@stop
