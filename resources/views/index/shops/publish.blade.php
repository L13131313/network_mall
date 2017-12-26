@extends('index.shops.base')
@section('content')
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li style="font-size: 20px;">{{ !empty($data['class_one']) ? \App\Tools\AreaCache::getOneId($data['class_one'])->catname : '' }}</li>
            <li style="font-size: 15px;">{{ !empty($data['class_two']) ? \App\Tools\AreaCache::getOneId($data['class_two'])->catname : '' }}</li>
            <li style="font-size: 12px;">{{ !empty($data['class_three']) ? \App\Tools\AreaCache::getOneId($data['class_three'])->catname : '' }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-offset-2" style="border:1px solid #3e5ea2;margin-top: 25px;">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="" action="{{ url('shops/goods') }}" method="post" style="padding-top: 25px;" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="cate_id" value="{{ $data['class_three'] }}">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color:red;font-size:18px;">*</span> 商品标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="g_name" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <p>商品属性 <span style="color:#666;font-size:12px;margin-left:20px;">错误填写商品属性，可能会引起商品下架或搜索流量减少，影响您的正常销售，请认真准确填写！</span></p>
                <br>
                <div class="row">
                    <div class="col-lg-10 col-md-offset-1">
                        @foreach($res as $val)
                            <div class="layui-inline col-lg-6">
                                <label class="layui-form-label">{{ $val->attrName }} <span style="color:red;font-size:18px;">*</span></label>
                                <div class="layui-input-inline">
                                    @if ($val->attrType == 0)
                                        <input type="text" name="{{ $val->attrName }}" autocomplete="off" class="layui-input" style="width:212px;">
                                    @elseif ($val->attrType == 1)
                                        @foreach($val->attr_val as $v)
                                            <input type="checkbox" name="{{ $val->attrName }}[]" lay-skin="primary">{{$v->attrVal}}
                                        @endforeach
                                    @else
                                        <select name="{{ $val->attrName }}" id="">
                                            @foreach($val->attr_val as $v)
                                                <option value="{{$v->attrVal}}">{{$v->attrVal}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                </fieldset>
                <p>商品封面图 <span style="color:#666;font-size:12px;margin-left:20px;">商品主图大小不能超过2MB；700*700 以上图片上传后商品详情页自动提供放大镜功能！</span></p>
                <br>
                <div class="layui-upload-drag layui-upload-file_chaxun" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">封面图</i>
                    <input type="file" name="g_cover" id="" style="width:120px;height:120px; margin:-30px;margin-top:-90px;opacity:0;">
                </div>
                <p>商品详情图</p>
                <br>
                <div class="figure layui-upload-drag layui-upload-file_chaxun" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">详情图</i>
                    <input type="file" name="figure[]" multiple id="" style="width:120px;height:120px; margin:-30px;margin-top:-90px;opacity:0;">
                </div>
                <div class="figure layui-upload-drag layui-upload-file_chaxun" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">详情图</i>
                    <input type="file" name="figure[]" multiple id="" style="width:120px;height:120px; margin:-30px;margin-top:-90px;opacity:0;">
                </div>
                <div class="figure layui-upload-drag layui-upload-file_chaxun" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">详情图</i>
                    <input type="file" name="figure[]" multiple id="" style="width:120px;height:120px; margin:-30px;margin-top:-90px;opacity:0;">
                </div>
                <div class="figure layui-upload-drag layui-upload-file_chaxun" style="border:1px solid #ddd;background:#f6f6f6;height:120px;width:120px;line-height:60px;">
                    <i style="font-size:17px;">详情图</i>
                    <input type="file" name="figure[]" multiple id="" style="width:120px;height:120px; margin:-30px;margin-top:-90px;opacity:0;">
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                </fieldset>
                <p>商品规格</p>
                <br>
                <div class="layui-input-inline" style="width:520px;">
                    <input type="text" autocomplete="off" class="doColor layui-input" placeholder="请选择颜色" readonly>
                </div>
                <div id="isColor" style="width:520px;height:200px;background-color:#f1f1f1;" hidden>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="黑色" title="黑色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="白色" title="白色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="蓝色" title="蓝色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="红色" title="红色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="黄色" title="黄色"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="灰色" title="灰色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="米色" title="米色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="褐色" title="褐色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="咖啡" title="咖啡"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="紫色" title="紫色"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="青色" title="青色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="绿色" title="绿色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="浅灰色" title="浅灰色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="浅蓝色" title="浅蓝色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="粉红色" title="粉红色"></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="军绿色" title="军绿色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="藏青色" title="藏青色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="暗灰色" title="暗灰色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="深蓝色" title="深蓝色"></td>
                            <td><input type="checkbox" name="color[]" class="doChoice" lay-skin="primary" value="卡其色" title="卡其色"></td>
                        </tr>
                    </table>
                    <a href="jaxascript:;" onclick="doYes()" class="layui-btn layui-btn-sm layui-btn-normal" style="margin-left:400px;margin-top:30px;">确定</a>
                </div>
                <br><br>
                <p>商品尺码</p>
                <br>
                @foreach($spec as $n)
                    <input type="checkbox" name="spec[]" lay-skin="primary" value="{{ $n->specName }}" title="{{ $n->specName }}">
                @endforeach
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                </fieldset>
                <div class="layui-form">
                    <table>
                        <colgroup>
                        </colgroup>
                        <thead>
                        <tr class="layui-table">
                            <th style="text-align:center;"><span style="color:red;">*</span> 商品原格（元）</th>
                            <th style="text-align:center;"><span style="color:red;">*</span> 商品折扣价格（元）</th>
                            <th style="text-align:center;"><span style="color:red;">*</span> 总数量（件）</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" name="g_price" style="border:1px solid #ddd;border-top:none;height:35px;text-align:center;">
                            </td>
                            <td>
                                <input type="text" name="g_discount" style="border:1px solid #ddd;border-top:none;border-left:none;height:35px;text-align:center;">
                            </td>
                            <td>
                                <input type="text" name="g_count" style="border:1px solid #ddd;border-top:none;border-left:none;height:35px;text-align:center;">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="layui-form-item">
                    <label class="layui-form-label">店铺分类</label>
                    <div class="layui-input-block">
                        @if ($nav->toArray() == [])
                            <input type="checkbox" name="s_nav[]" checked value="null" hidden>
                        @else
                            @foreach($nav as $v)
                                <input type="checkbox" name="s_nav[]" value="{{ $v->id }}">{{ $v->nav_name }}
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否上架</label>
                    <div class="layui-input-block">
                        <input type="radio" name="g_status" value="1" title="立刻上架" checked="">立刻上架
                        <input type="radio" name="g_status" value="0" title="放入仓库">放入仓库
                    </div>
                </div>
                <div class="layui-form-item" style="text-align:center;">
                    <button class="layui-btn" id="submit" lay-submit="" lay-filter="demo2">跳转式提交</button>
                </div>
            </form>
        </div>
    </div>
    <script>
//        layui.use('form', function(){
//           // var form = layui.form;
//
//
//        });
        {{--layui.use(['form', 'layedit', 'laydate'], function(){--}}
            {{--var form = layui.form--}}
{{--//                ,layer = layui.layer--}}
                {{--,layedit = layui.layedit--}}
                {{--,laydate = layui.laydate;--}}


            {{--//监听提交--}}
            {{--form.on('submit(formDemo)', function(data){--}}
                {{--layer.msg(JSON.stringify(data.field));--}}
                {{--return false;--}}
            {{--});--}}

            {{--layui.use('upload', function(){--}}
                {{--var $ = layui.jquery--}}
                    {{--,upload = layui.upload;--}}

                {{--upload.render({--}}
                    {{--elem: '.figure'--}}
                    {{--,url: '/shops/goods'--}}
                    {{--,data: {'_token':'{{csrf_token()}}'}--}}
                    {{--,method: 'post'--}}
                    {{--,field: 'figure'--}}
                    {{--,multiple: true--}}
                    {{--,done: function(res){--}}
                        {{--console.log(res)--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}

            {{--layui.use('upload', function(){--}}
                {{--var $ = layui.jquery--}}
                    {{--,upload = layui.upload;--}}


                {{--//拖拽上传--}}
                {{--upload.render({--}}
                    {{--elem: '#cover'--}}
                    {{--,url: '/shops/goods'--}}
                    {{--,data: {'_token':'{{csrf_token()}}'}--}}
                    {{--,method: 'post'--}}
                    {{--,field: 'cover'--}}
                    {{--,auto: false--}}
                    {{--,bindAction: '#submit'--}}
                    {{--,size: 2048--}}

                {{--});--}}


            {{--});--}}
        {{--});--}}


        // 隐藏显示颜色
        $(".doColor").focus(function() {
            $('#isColor').removeAttr('hidden');
        }).click(function() {
            $('#isColor').removeAttr('hidden');
        });

        function doYes() {
            $('.doColor').val('');
            var str = '';
            $('input[name="color[]"]:checked').each(function(){
                str += $(this).val()+" ";
                $('.doColor').val(str);
                $('#isColor').attr('hidden', 'hidden');
            })
        }

        $("#isColor").hover(function (){
            $(this).removeAttr('hidden');
        },function (){
            $(this).attr('hidden', 'hidden');
        });

    </script>
@endsection