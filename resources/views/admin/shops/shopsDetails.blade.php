@extends('admin.layouts.master')
@section('title', '店铺管理')
@section('page-title', '店铺管理')
@section('styles')

@stop

@section('content')
    @include('admin.public.error')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">店铺详情列表</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered" border="0">
                                <tbody>
                                <tr>
                                    <th class="col-md-2">店铺id</th>
                                    <td class="col-md-10">{{ $data['id'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">店铺名</th>
                                    <td class="col-md-10">{{ $data['s_name'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">掌柜名</th>
                                    <td class="col-md-10">{{ $data['nickname'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">是否营业</th>
                                    <td>{{ $data['s_status'] == 1 ? '正在营业' : '已打烊' }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">店铺收藏数</th>
                                    <td class="col-md-10">{{ $data['s_collect'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">店铺地址</th>
                                    <td class="col-md-10">{{ $data['s_addr'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">店铺描述</th>
                                    <td class="col-md-10">{{ $data['s_script'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">开店时间</th>
                                    <td class="col-md-10">{{ date('Y-m-d H:i:s', $data['s_time']) }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">描述评分</th>
                                    <td class="col-md-10">{{ $data['des_score'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">服务评分</th>
                                    <td class="col-md-10">{{ $data['service_score'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">物流评分</th>
                                    <td class="col-md-10">{{ $data['logistics_score'] }}</td>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <th class="col-md-2">操作</th>
                                    <td class="col-md-10">
                                        <a href="{{ url('admin/shops') }}" class="btn btn-primary m-b-5">返回列表</a>
                                    </td>
                                </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('script')

@stop
