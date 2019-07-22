@extends('admin.layout.layout')
@section('content')
    <style>
        .small-right{
            position: relative;
            left: 10px;
            color: #8d8888;
        }
    </style>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    MCN机构管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加MCN机构
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="myform" onsubmit="return false">
                                    <div class="form-group" >
                                        <label>MCN名称</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="MCN名称">
                                    </div>
                                    <div class="form-group">
                                        <label>封面</label>
                                        <input type="file" id="cover" onchange="show(this)" name="cover">
                                        <img id="img_cover" src="">
                                    </div>
                                    <div class="form-group" >
                                        <label>介绍</label>
                                        <input type="text" id="introduce" class="form-control" name="introduce" placeholder="介绍">
                                    </div>
                                    <div class="form-group" >
                                        <label>价格</label>
                                        <input type="text" id="price" class="form-control" name="price" placeholder="价格">
                                    </div>
                                    <div class="form-group">
                                        <label>内容</label>

                                    </div>
                                    <button class="btn btn-default" onclick="confim()">确认</button>
                                    <button type="reset" class="btn btn-default" onclick="javascript:history.go(-1);">返回</button>
                                </form>
                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
<script>

    function confim() {
        var name = $.trim($('#name').val());
        var introduce = $.trim($('#introduce').val());
        var price = $.trim($('#price').val());
        var content = ue.getContent();
        var cover = $('#cover')[0].files[0];

        var formData = new FormData();

        formData.append("cover",cover);
        formData.append("name", name);
        formData.append("introduce", introduce);
        formData.append("price", price);
        formData.append("content", content);

//        console.log(formData);
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        $.ajax({
            url:'/admin/mcn',
            dataType:'json',
            type:'POST',
            async: false,
            data: formData,
            processData : false, //使数据不做处理
            contentType : false, //不要设置Content-Type请求头
            success: function(res){
                if (res.status == 0){
                    layer.msg(res.msg);
                } else {
                    layer.msg(res.msg,{
                        offset:['50%'],
                        time: 2000
                    },function(){
                        window.location.reload();
                    });
                }
            }
        });
    }

    //上传展示图片
    function show(file){
        var reader = new FileReader();	// 实例化一个FileReader对象，用于读取文件
        var img = document.getElementById('img_cover'); 	// 获取要显示图片的标签

        //读取File对象的数据
        reader.onload = function(evt){
            img.width  =  "80";
            img.height =  "80";
            img.src = evt.target.result;
        };
        reader.readAsDataURL(file.files[0]);
    }

</script>
@endsection
