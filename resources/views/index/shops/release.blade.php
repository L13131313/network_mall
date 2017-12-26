@extends('index.shops.base')
    @section('content')
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li style="font-size: 18px;">选择您要发布的商品</li>
            </ul>
        </div>

        @include('admin.public.error')
        <form class="layui-form" action="{{ url('shops/goods/create') }}" style="padding-top: 25px;">
            <div class="row">
                <div class="col-lg-6 col-md-offset-3">
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" value="">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-default dropdown-toggle btn-primary m-b-5" value="快速找到栏目">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 45px;">
                <div class="col-lg-8 col-md-offset-2">
                    <div class="col-lg-4" class="select">
                        <select name="class_one" id="class_one" lay-filter="myselect">
                            @foreach(\App\Tools\AreaCache::getCateId(0) as $v)
                                <option value="{{ $v->catid }}">{{ $v->catname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4" class="select">
                        <select name="class_two" id="class_two" lay-filter="myselect2">
                        </select>
                    </div>
                    <div class="col-lg-4" class="select">
                        <select name="class_three" id="class_three" lay-filter="myselect3">
                        </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-offset-4">
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input id="submit" type="submit" disabled class="layui-btn layui-btn-disabled" lay-submit lay-filter="formDemo" value="马上发布">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function renderForm(){
                layui.use('form', function(){
                    var form = layui.form;
                    form.render();
                });
            }

            // layer表单监听
            layui.use(['form', 'layedit', 'laydate'], function() {
                var form = layui.form;
                //监听提交
                form.on('submit(demo1)', function (data) {
                    layer.alert(JSON.stringify(data.field), {
                        title: '最终的提交信息'
                    });
                    return false;
                });

                // 获取二级分类
                form.on('select(myselect)', function (data) {

                    // 发生改变清空二级、三级分类
                    $('#class_two').empty();
                    $('#class_three').empty();
                    //发生改变禁用提交按钮
                    $('#submit').attr({
                        'class': 'layui-btn layui-btn-disabled',
                        'disabled': 'disabled'
                    });
                    // 获取选择商品id
                    var catid = data.value;
                    // 发生ajax请求
                    $.ajax({
                        type: 'post',
                        url: 'goods/classification',
                        dataType: 'json',
                        data: {'catid': catid, '_token': '{{csrf_token()}}'},
                        success: function (data) {
                            for (var i in data) {
                                $.each(data[i], function (index, item) {
                                    $('#class_two').append(`<option value=${item.catid} label=${item.parentid}>${item.catname}</option>`);
                                    // 重新渲染数据至模板
                                    renderForm();

                                });
                            }
                        },
                        error: function () {
                            alert('服务器错误，请重新选择！');
                        }
                    });

                    // 获取三级分类
                    form.on('select(myselect2)', function (data) {
                        // 发生改变清空三级分类
                        $('#class_three').empty();
                        // 获取选择商品id
                        var catid = data.value;
                        //发生改变启用提交按钮
                        $('#submit').removeAttr('disabled');
                        $('#submit').attr('class', 'layui-btn');

                        // 发生ajax请求
                        $.ajax({
                            type: 'post',
                            url: 'goods/classification',
                            dataType: 'json',
                            data: {'catid': catid, '_token': '{{csrf_token()}}'},
                            success: function (data) {
                                for (var i in data) {
                                    $.each(data[i], function (index, item) {
                                        $('#class_three').append(`<option value=${item.catid} label=${item.parentid}>${item.catname}</option>`);
                                        // 重新渲染数据至模板
                                        renderForm();

                                    });
                                }
                            },
                            error: function () {
                                alert('服务器错误，请重新选择！');
                            }
                        });

                    });
                });
            });
        </script>
    @endsection