@extends('index.shops.base')
@section('content')
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li style="font-size: 20px;">{{ \App\Tools\AreaCache::getOneId($data['class_one'])->catname }}</li>
            <li style="font-size: 15px;">{{ \App\Tools\AreaCache::getOneId($data['class_two'])->catname }}</li>
            <li style="font-size: 12px;">{{ \App\Tools\AreaCache::getOneId($data['class_three'])->catname }}</li>
            {{--<li class="layui-this" style="font-size:14px;font-weight:bold;color:#fff;background:#000;">发布商品</li>--}}
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-offset-2" style="border:1px solid #3e5ea2;margin-top: 25px;">
            <form class="layui-form layui-form-pane" action="" style="padding-top: 25px;">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color:red;font-size:18px;">*</span> 商品标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <p>商品属性 <span style="color:#666;font-size:12px;margin-left:20px;">错误填写商品属性，可能会引起商品下架或搜索流量减少，影响您的正常销售，请认真准确填写！</span></p>
                <br>
                <div class="row">
                    <div class="col-lg-10 col-md-offset-1"">
                        <div class="col-lg-6">
                            <div class="layui-inline">
                                <label class="layui-form-label">
                                    <input type="text" placeholder="请输入属性名" style="width:110px;height:40px;margin-left:-16px;margin-top:-10px;">
                                </label>
                                <div class="layui-input-inline">
                                    <input type="tel" name="phone" lay-verify="required|phone" placeholder="请输入属性值" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                </fieldset>
                <p>商品图片 <span style="color:#666;font-size:12px;margin-left:20px;">商品主图大小不能超过2MB；700*700 以上图片上传后商品详情页自动提供放大镜功能！</span></p>
                <br>
                <div class="layui-upload-drag layui-upload-file_chaxun" id="test10" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">封面图</i>
                </div>
                <div class="layui-upload-drag layui-upload-file_chaxun" id="test10" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i>上传图片</i>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                </fieldset>
                <div class="layui-form">
                    <table>
                        <colgroup>
                        </colgroup>
                        <thead>
                        <tr class="layui-table">
                            <th style="text-align:center;"><span style="color:red;">*</span> 价格（元）</th>
                            <th style="text-align:center;"><span style="color:red;">*</span> 总数量（件）</th>
                            <th style="text-align:center;">商家编码</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" style="border:1px solid #ddd;border-top:none;height:35px;text-align:center;">
                            </td>
                            <td>
                                <input type="text" style="border:1px solid #ddd;border-top:none;border-left:none;height:35px;text-align:center;">
                            </td>
                            <td>
                                <input type="text" style="border:1px solid #ddd;border-top:none;border-left:none;height:35px;text-align:center;">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="layui-form-item">
                    <label class="layui-form-label">店铺分类</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="like[]" title="写作">
                        <input type="checkbox" name="like[]" title="阅读">
                        <input type="checkbox" name="like[]" title="游戏">
                    </div>
                </div>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">上架时间</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="立刻上架" title="立刻上架" checked="">
                        <input type="radio" name="sex" value="放入仓库" title="放入仓库">
                    </div>
                </div>
                <div class="layui-form-item" style="text-align:center;">
                    <button class="layui-btn" lay-submit="" lay-filter="demo2">跳转式提交</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate;

            //日期
            laydate.render({
                elem: '#date'
            });
            laydate.render({
                elem: '#date1'
            });

            //创建一个编辑器
            var editIndex = layedit.build('LAY_demo_editor');

            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value.length < 5){
                        return '标题至少得5个字符啊';
                    }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,content: function(value){
                    layedit.sync(editIndex);
                }
            });

            //监听指定开关
            form.on('switch(switchTest)', function(data){
                layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
                    offset: '6px'
                });
                layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
            });

            //监听提交
            form.on('submit(demo1)', function(data){
                layer.alert(JSON.stringify(data.field), {
                    title: '最终的提交信息'
                })
                return false;
            });
        });

        layui.use('upload', function() {
            var $ = layui.jquery
                , upload = layui.upload;

            //拖拽上传
            upload.render({
                elem: '.layui-upload-file_chaxun'
                ,url: '/upload/'
                ,multiple: true
                ,number: 10
                ,done: function(res){
                    console.log(res)
                }
            });

        });
    </script>
@endsection