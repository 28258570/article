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
                                        <label>上传</label><small class="small-right">仅支持DOCX格式，点击上传文档将自动生成至内容框内</small>
                                        <input type="file" id="article" onchange="upload(this)">
                                        {{--<button class="layui-btn layui-btn-sm" onclick="upload()" style="position:relative;top: 10px;">上传</button>--}}
                                    </div>
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
                                        <!-- 加载编辑器的容器 -->
                                        <script id="container" name="content" type="text/plain"></script>
                                        <!-- 配置文件 -->
                                        <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
                                        <!-- 编辑器源码文件 -->
                                        <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
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
    //实例化编辑器
    var ue = UE.getEditor('container');

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

        console.log(formData);
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
            success: function(data){
//                console.log(data);
//                if (data.status == 'ok') {
//                    alert('上传成功！');
//                }

            },
            error:function(response){
//                console.log(response);
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

    //上传文件
    function upload(input) {
        var formData = new FormData();
        formData.append("file",input.files[0]);
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        $.ajax({
            url:'/admin/mcn/upload',
            dataType:'json',
            type:'POST',
            async: false,
            data: formData,
            processData : false, // 使数据不做处理
            contentType : false, // 不要设置Content-Type请求头
            success: function(res){
                if (res.status == 0){
                    layer.msg('解析失败');
                } else {
                    ue.setContent(res.data);
                }
            }
        });
    }

</script>
@endsection
