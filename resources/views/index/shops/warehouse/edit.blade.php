@extends('index.shops.base')
@section('content')
    <style>
        .doCheckbox{width:14px;height:14px;margin:30px;}
        .doSelect{width:212px;height:38px;border-color:#e6e6e6;}
        .layui-form-label{  width:100px;  }
        .label{  color:#212121;  font-size:14px;  font-weight: inherit;}
        table tr td{width:95px;height:28px;}
    </style>
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li style="font-size: 20px;">修改商品</li>
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
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form class="" action="{{ url('shops/goods') }}" method="post" style="padding-top: 25px;" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color:red;font-size:18px;">*</span> 商品标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="g_name" autocomplete="off" class="layui-input" value="{{ $data['0']->g_name }}">
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
                                        <input type="text" name="{{ $val->attrName }}" autocomplete="off" value="{{ $data['0']->g_name }}" class="layui-input" style="width:212px;">
                                    @elseif ($val->attrType == 1)
                                        @foreach($val->attr_val as $v)
                                            <label><input type="checkbox" name="{{ $val->attrName }}[]" lay-skin="primary" class="doCheckbox">{{$v->attrVal}}</label>
                                        @endforeach
                                    @else
                                        <select name="{{ $val->attrName }}" class="doSelect" id="">
                                            @foreach($val->attr_val as $v)
                                                <option value="{{$v->attrVal}}" >{{$v->attrVal}}</option>
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
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="黑色" title="黑色"> 黑色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="白色" title="白色"> 白色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="蓝色" title="蓝色"> 蓝色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="红色" title="红色"> 红色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="黄色" title="黄色"> 黄色</label></td>
                        </tr>
                        <tr>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="灰色" title="灰色"> 灰色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="米色" title="米色"> 米色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="褐色" title="褐色"> 褐色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="咖啡" title="咖啡"> 咖啡</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="紫色" title="紫色"> 紫色</label></td>
                        </tr>
                        <tr>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="青色" title="青色"> 青色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="绿色" title="绿色"> 绿色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="浅灰色" title="浅灰色"> 浅灰色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="天蓝色" title="天蓝色"> 天蓝色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="粉红色" title="粉红色"> 粉红色</label></td>
                        </tr>
                        <tr>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="军绿色" title="军绿色"> 军绿色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="藏青色" title="藏青色"> 藏青色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="暗灰色" title="暗灰色"> 暗灰色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="深蓝色" title="深蓝色"> 深蓝色</label></td>
                            <td><label class="label"><input type="checkbox" name="color[]" class="doCheckbox" lay-skin="primary" value="卡其色" title="卡其色"> 卡其色</label></td>
                        </tr>
                    </table>
                    <a href="jaxascript:;" onclick="doYes()" class="layui-btn layui-btn-sm layui-btn-normal" style="margin-left:400px;margin-top:30px;">确定</a>
                </div>
                <br><br>
                <p>商品尺码</p>
                <br>
                @if ($spec->toArray() == [])
                    <input type="checkbox" name="spec[]" class="doCheckbox" lay-skin="primary" checked value="null" hidden>
                @else
                    @foreach($spec as $n)
                        <label class="label"><input type="checkbox" name="spec[]" class="doCheckbox" lay-skin="primary" value="{{ $n->specName }}" title="{{ $n->specName }}"> {{ $n->specName }}</label>
                    @endforeach
                @endif
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
                                <input type="text" name="g_price" value="{{ $data['0']->g_name }}" style="border:1px solid #ddd;border-top:none;height:35px;text-align:center;">
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
                    <label class="layui-form-label" style="margin-top:-7px;border:1px solid #e6e6e6;">店铺分类</label>
                    <div class="layui-input-block">
                        @if ($nav->toArray() == [])
                            <input type="checkbox" name="s_nav[]" class="doCheckbox" lay-skin="primary" checked value="null" hidden>
                        @else
                            @foreach($nav as $v)
                                <label class="label"><input type="checkbox" name="nav_id[]" class="doCheckbox" lay-skin="primary" value="{{ $v->id }}"> {{ $v->nav_name }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label" style="margin-top:-7px;border:1px solid #e6e6e6;">是否上架</label>
                    <div class="layui-input-block">
                        <label class="label"><input type="radio" name="g_status" value="1" title="立刻上架" checked=""> 立刻上架</label>
                        <label class="label"><input type="radio" name="g_status" value="0" title="放入仓库"> 放入仓库</label>
                    </div>
                </div>
                <div class="layui-form-item" style="text-align:center;">
                    <button class="layui-btn" id="submit" lay-submit="" lay-filter="demo2">跳转式提交</button>
                </div>
            </form>
        </div>
    </div>
    <script>
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