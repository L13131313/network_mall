@extends('admin.layouts.master')
@section('title', '添加属性值')
@section('page-title', '添加属性值')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action="{{ url('admin/attribute/create/doAttr') }}" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="row" style="margin-top:50px;">
                                <div class="col-lg-5 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">属性名 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="cate">
                                                        <option value="---请选择---">---请选择---</option>
                                                        @foreach($data as $k => $v)
                                                            <option value="{{ $k }}">{{ $v }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="attr" name="attrid">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-2">属性值 <span style="color:red;">*</span></label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="firstname" name="attrVal" type="text">
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
        $('#cate').on('change', function() {
            // 发生改变清空三级分类
            $('#attr').empty();
            // 发生改变禁用提交按钮
            $('#submit').attr('disabled', 'disabled');
            var goodsCatId = $(this).val();
            if (goodsCatId != '---请选择---') {
                $.ajax({
                    type: 'post',
                    url: 'attribute',
                    dataType: 'json',
                    data: {'goodsCatId': goodsCatId, '_token': '{{csrf_token()}}'},
                    success: function (data) {
                        for (var i in data) {
                            $.each(data[i], function (k, v) {
                                $('#attr').append(`<option value=${k}>${v}</option>`);
                            });
                        }
                        $('#submit').removeAttr('disabled');
                    },
                    error: function () {
                        alert('服务器错误，请重新选择！');
                    }
                });
            }
        });
    </script>
@stop
