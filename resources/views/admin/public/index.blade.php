@extends('admin.layouts.master')
@section('title', '后台首页')
@section('page-title', '后台首页')
@section('styles')

@stop

@section('content')
@include('admin.public.error')
            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Welcome !</h3> 
                </div>
                <!-- WEATHER -->
                <div class="row">      
                    <div class="col-lg-12">
                        <!-- BEGIN WEATHER WIDGET 1 -->
                        <div class="panel bg-success-alt">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-xs-6 text-center">
                                                <canvas id="partly-cloudy-day" width="115" height="115"></canvas>
                                            </div>
                                            <div class="col-xs-6">
                                                <h2 class="m-t-0 text-white"><b>32°</b></h2>
                                                <p class="text-white">Partly cloudy</p>
                                                <p class="text-white">15km/h - 37%</p>
                                            </div>
                                        </div><!-- End row -->
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SAT</h4>
                                                <canvas id="cloudy" width="35" height="35"></canvas>
                                                <h4 class="text-white">30<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SUN</h4>
                                                <canvas id="wind" width="35" height="35"></canvas>
                                                <h4 class="text-white">28<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">MON</h4>
                                                <canvas id="clear-day" width="35" height="35"></canvas>
                                                <h4 class="text-white">33<i class="wi-degrees"></i></h4>
                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div><!-- end row -->
                            </div><!-- panel-body -->
                        </div><!-- panel-->
                        <!-- END Weather WIDGET 1 -->
                        
                    </div><!-- End col-md-6 -->
                </div> <!-- End row -->  


                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    系统基本信息
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <div class="result_wrap">
                                            <div class="result_content">
                                                <ul>
                                                    <li>
                                                        <label>操作系统</label><span>WINNT</span>
                                                    </li>
                                                    <li>
                                                        <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                                                    </li>

                                                    <li>
                                                        <label>上传附件限制</label><span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
                                                    </li>
                                                    <li>
                                                        <label>北京时间</label><span>{{date('Y-m-d H:i:s',time())}}</span>
                                                    </li>
                                                    <li>
                                                        <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
                                                    </li>
                                                    <li>
                                                        <label>Host</label><span> {{$_SERVER['SERVER_ADDR']}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->
            </div>

@stop

@section('script')

@stop
