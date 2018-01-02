@extends('index.shops.base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>投诉管理</legend>
    </fieldset>
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="100">
                <col width="250">
                <col width="120">
                <col width="260">
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>商品id</th>
                <th>商品名</th>
                <th>投诉人</th>
                <th>投诉内容</th>
                <th>投诉时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>{{ $v->Goods->id }}</td>
                    <td>{{ $v->Goods->g_name }}</td>
                    <td>{{ $v->User->nickname }}</td>
                    <td>{{ $v->t_content }}</td>
                    <td>{{ date('Y-m-d H:i:s', $v->t_time) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="float:right;">
            {!! $data->appends(\Request::query())->render() !!}
        </div>
    </div>
@endsection