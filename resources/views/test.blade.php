@extends('layouts.parent')
@section('content')
	<form action="{{url('admin/article')}}" method="post" id="art_form" enctype="multipart/form-data">
            <table class="add_tab">
                {{csrf_field()}}
                <tbody>
                <tr>
                    <th><i class="require">*</i>缩略图：</th>
                    <td>
                        <img src="{{asset('index/uploads/default.jpg')}}" id="pic" style="width:80px;cursor: pointer;"/>
                        <input type="file" name="photo" id="photo_upload" style="display: none;" />
                    </td>
                </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
<script type="text/javascript">
// 这里是Ajax 全局token
// $.ajaxSetup({
//    headers: {
//      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//  });
// 图片上传
$('#pic').on('click', function(){
    $('#photo_upload').trigger('click');
    $('#photo_upload').on('change', function(){
        var obj = this;
        //用整个from表单初始化FormData
        var formData = new FormData($('#art_form')[0]);
        $.ajax({
            url: '/upload',
            type: 'post',
            data: formData,
            // 因为data值是FormData对象，不需要对数据做处理
            processData: false,
            contentType: false,
            beforeSend:function(){
                // 菊花转转图
                $('#pic').attr('src', "{{ asset('index/uploads/zhuan.png') }}");
            },
            success: function(data){
                if(data['ServerNo']=='200'){
                    // 如果成功
                    $('#pic').attr('src', '{{ asset("index/uploads") }}'+'/'+data['ResultData']);
                    $('input[name=pic]').val(data);
                    $(obj).off('change');
                }else{
                    // 如果失败
                    alert(data['ResultData']);
                }
                // console.log(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                var number = XMLHttpRequest.status;
                var info = "错误号"+number+"文件上传失败!";
                // 将菊花换成原图
                $('#pic').attr('src', '{{ asset("index/uploads/do.png") }}');
                alert(info);
            },
            async: true
        });
    });
});
</script>
@endsection