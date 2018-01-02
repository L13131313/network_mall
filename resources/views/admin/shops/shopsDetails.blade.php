<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('admin.public.styles')

</head>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">店铺详情</h3>
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
                                <th class="col-md-2">店铺地址</th>
                                <td class="col-md-10"><a href="{{ asset($data['s_link']) }}" class="btn btn-icon btn-info m-b-5">点击查看</a></td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

