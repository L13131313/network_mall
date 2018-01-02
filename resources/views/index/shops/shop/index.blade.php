@extends('index.shops.base')
@section('content')
    @foreach($data as $v)
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend><span style="color:;font-weight:bold;">{{ $v->nickname }}</span><span style="font-size:18px;margin-left:50px;">您已成为卖家 <strong>{{ floor((time() - $v->s_time) / (24*60*60)) }}</strong> 天</span></legend>
        </fieldset>
        <a href="{{ asset($v->s_link) }}" target="_black" class="layui-btn layui-btn-lg layui-btn-normal" style="margin-left:30px;">我的店铺</a>
        <div class="row" style="margin-top:15px;">
            <div class="col-lg-12 col-md-offset-0">
                <div class="col-lg-5">
                    <table class="layui-table" lay-size="lg" style="margin-top:0px;">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr style="background:#fff;height:60px;">
                            <th style="font-weight:bold;">店铺名</th>
                            <th style="font-weight:bold;">店铺状态</th>
                            <th style="font-weight:bold;">店铺收藏</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="height:100px;color:#ff9229;">
                            <td style="font-size:20px;">{{ $v->s_name }}</td>
                            <td style="font-size:20px;">@if($v->s_status == 1) 营业中 @else 已打烊 @endif</td>
                            <td style="font-size:20px;">{{ $v->s_collect }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="layui-table" lay-size="lg" style="margin-top:30px;">
                        <colgroup>
                            <col width="150">
                            <col width="150">
                            <col width="150">
                        </colgroup>
                        <thead>
                        <tr style="background:#fff;">
                            <th style="font-weight:bold;">描述评分</th>
                            <th style="font-weight:bold;">服务评分</th>
                            <th style="font-weight:bold;">物流评分</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $v->des_score }}</td>
                            <td>{{ $v->service_score }}</td>
                            <td>{{ $v->logistics_score }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-5">
                    <span id="testView"></span>
                    <div id="test2"></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-offset-0">
                <div class="col-lg-5" style="border:1px solid #e6e6e6;">
                    <ul>
                        <li style="height:35px;line-height:50px;font-size:16px;"><strong>卖家规则</strong></li>
                        <li style="height:35px;line-height:50px;border-bottom:1px dotted #ddd;"><strong>第一条</strong><span style="font-size:12px;margin-left:20px;">请遵守卖家条款，严禁恶意提升店铺排名，一经发现封店处理!</span></li>
                        <li style="height:35px;line-height:50px;border-bottom:1px dotted #ddd;"><strong>第二条</strong><span style="font-size:12px;margin-left:20px;">请遵守商品条款，发布信息不真实会使商品下架！</span></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        //直接嵌套显示
        layui.use('laydate', function(){
            var laydate = layui.laydate;

            laydate.render({
                elem: '#test2'
                , position: 'static'
                , change: function (value, date) { //监听日期被切换
                }
            });
        });
    </script>
@endsection
