
@extends('admin.layouts.master')
@section('title', '用户列表')
@section('page-title', '轮播图添加')
@section('styles')

@stop

@section('content')
@include('admin.public.error')
   
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">

        <form class="cmxform form-horizontal tasi-form" id="art_form" method="post" action="{{url('admin/lunbo/doUpload')}}" novalidate="novalidate">
            {{ csrf_field() }}
            <div class="form-group ">
                <p for="firstname" class="control-label col-lg-2">图片保存路径</p>
                <div class="col-lg-10">
                    <input readonly type="text" size="50" name="art_thumb" id="art_thumb">
                </div>
            </div>
            <div class="form-group ">
                <p for="lastname" class="control-label col-lg-2">缩略图：</p>
                <div class="col-lg-10">
                     <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <p><img id="img1" alt="上传后显示图片"  style="max-width:350px;max-height:100px;" /></p>
                </div>
            </div>
             <div class="form-group ">
                <p for="firstname" class="control-label col-lg-2">店铺id：</p>
                <div class="col-lg-10">
                    <input type="text" size="50" name="art_editor" id="art_thumb">
                </div>
            </div>


           <!--  <div class="form-group">
                <label class="col-sm-2 control-label">角色选择  *</label>
                <div class="col-sm-10">
                    <select class="form-control" name='status'>
                        <option value='0'>管理员</option>
                        <option value='1'>超级管理员</option>
                    </select>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-success" type="submit">添加</button>
                   <input type="reset" class="btn btn-defoult">
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')

 <script type="text/javascript">
                            $(function () {
                                $("#file_upload").change(function () {
                                    uploadImage();
                                });
                            });

                            function uploadImage() {
//                            判断是否有选择上传文件
                                var imgPath = $("#file_upload").val();
                                if (imgPath == "") {
                                    alert("请选择上传图片！");
                                    return;
                                }
                                //判断上传文件的后缀名
                                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                if (strExtension != 'jpg' && strExtension != 'gif'
                                    && strExtension != 'png' && strExtension != 'bmp'&& strExtension != 'jpeg') {
                                    alert("请选择图片文件");
                                    return;
                                }
//                            var myform = document.getElementById('art_from');
                                var formData = new FormData($('#art_form')[0]);
                                {{--formData.append('_token', '{{csrf_token()}}');--}}
                                {{--console.log(formData);--}}
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/lunbo/upload",
                                    data: formData,
                                    async: true, 
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                     // console.log(data);
                                        alert("上传成功");
                                        $('#img1').attr('src','/'+data);
                                        $('#art_thumb').val(data);

                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                    }
                                });
                            }
                        </script>
@stop
