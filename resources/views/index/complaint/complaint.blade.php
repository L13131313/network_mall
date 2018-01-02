@extends('layouts.parent')
@section('content')
    <div class="user-address">
        <!--例子-->
        <div class="am-modal am-modal-no-btn" id="doc-modal-1">

            <div class="add-dress">

                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">投诉</strong> / <small>complaint</small></div>
                </div>
                <hr/>
                @if(session('msg'))
                    <h1 style="font-size: 30px;margin-left: 240px;">{{session('msg')}}</h1>
                @endif
                <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                    @foreach($order as $v)
                    <form class="am-form am-form-horizontal" action="{{url('index/complaint')}}" method="post">
                        {{csrf_field()}}
                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label"> 投诉人</label>
                            <div class="am-form-content">
                                <input type="text" value="{{$v->User->nickname}}" readonly>
                                <input type="hidden" name="uid" value="{{$v->uid}}">
                                <input type="hidden" name="id" value="{{$v->id}}">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-form-label">投诉店铺</label>
                            <div class="am-form-content">
                                <input type="text" value="{{$v->Shops->s_name}}" readonly>
                                <input type="hidden" name="sid" value="{{$v->solder_id}}">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-address" class="am-form-label">投诉商品</label>
                            <div class="am-form-content">
                                <input type="text" value="{{$v->Goods->g_name}}" readonly>
                                <input type="hidden" name="gid" value="{{$v->gid}}">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-form-label">投诉原因</label>
                            <div class="am-form-content">
                                <textarea name="t_content" rows="5" id="user-intro" maxlength="300" placeholder="输入投诉理由,不多于150字..."></textarea>
                            </div>
                            <input type="hidden" name="t_time" value="{{time()}}">
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <br><br><br>
                                <input type="submit" class="am-btn am-btn-danger" style="margin-left: 90px;">
                                <input type="button" class="am-btn am-btn-danger" style="margin-left: 60px;" onclick="history.go(-1)" value="返回">
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".new-option-r").click(function() {
                $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
            });

            var $ww = $(window).width();
            if($ww>640) {
                $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
            }

        })


    </script>

    <div class="clear"></div>
@endsection