@extends('layouts.parent')
@section('content')
    <link href="{{ asset('index/css/orstyle.css') }}" rel="stylesheet" type="text/css">
    <div class="user-order">
        <!--标题 -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的投诉</strong> / <small>Complaint</small></div>
        </div>
        <hr/>

        <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                    <div class="order-top">
                        <div class="th th-change th-changebuttom">
                            <td class="td-inner">商品</td>
                        </div>
                        <div class="th th-change th-changebuttom">
                            <td class="td-inner">店铺</td>
                        </div>
                        <div class="th th-change th-changebuttom">
                            <td class="td-inner">投诉时间</td>
                        </div>
                        <div class="th th-orderprice th-price">
                            <td class="td-inner">状态</td>
                        </div>
                    </div>
                    <div class="order-main">
                        
                        <div class="order-content">
                            <div class="order-left">
                                <ul class="item-list">
                                    <li class="td td-moneystatus td-status" style="width: 298.8px;">
                                        <div class="item-status">
                                            <p class="Mystatus">阿萨德</p>
                                        </div>
                                    </li>
                                    <li class="td td-moneystatus td-status" style="width: 298.8px;">
                                        <div class="item-status">
                                            <p class="Mystatus">请问</p>
                                        </div>
                                    </li>
                                    <div class="clear"></div>
                                </ul>

                                <div class="change move-right">
                                    <li class="td td-moneystatus td-status" style="width: 298.8px;">
                                        <div class="item-status">
                                            <p class="Mystatus">123</p>
                                        </div>
                                    </li>
                                </div>
                                <li class="td td-change td-changebutton" style="width: 99.6px;">
                                    <div class="am-btn am-btn-danger anniu">未处理</div>
                                </li>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection