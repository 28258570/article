@extends('admin.layout.layout')
@section('content')
<script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<link href="/assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="/assets/js/fileinput.js" type="text/javascript"></script>
<script src="/assets/js/fileinput_locale_zh.js" type="text/javascript"></script>


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
                            	<form enctype="multipart/form-data" id="form_addfishContent">
                            		<div class="form-group"  style="display: block;">
					                    <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
					                </div>
					                <button onclick="aa()"></button>
                            	</form>
                            	
                                <form id="myform" onsubmit="return false" >
					                <div class="form-group"  style="display: block;">
					                    <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1">
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
    <img src="blob:http://www.blog.cn/b7ad76be-cded-45b8-9d51-1031c0fe04b5">
<script>
	function aa(){
		console.log($("#form_addfishContent").serialize())
	}
	
	
	
	$("#file-1").fileinput({
        uploadUrl: '#',
        allowedFileExtensions : ['jpg', 'png' , 'jpeg'],
        overwriteInitial: false,
        maxFileSize: 1000,
//      showUpload : false, //是否显示上传按钮,跟随文本框的那个
        dropZoneEnabled : false,//是否显示拖拽区域，默认不写为true，但是会占用很大区域
        maxFilesNum:5,
        uploadExtraData:function (previewId, index) {
            //向后台传递id作为额外参数，是后台可以根据id修改对应的图片地址。
            var obj = {};
            obj.id = fishId;
            return obj;
        }
    }).on("filebatchuploadsuccess", function(event, data) {
        if(data.response){
            closeModal('fishAddDetail') 关闭模态框。
            $("#bootstraptable_fishcontent").bootstrapTable("refresh");
        }
    }).on('fileerror', function(event, data, msg) {  //一个文件上传失败
        console.log('文件上传失败！'+msg);
    });
        
        
        
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
	initFileInput("file-1", "/User/EditPortrait");
	//初始化fileinput控件（第一次初始化）
	function initFileInput(ctrlName, uploadUrl) {
	    var control = $('#' + ctrlName); 
	    control.fileinput({
	        language: 'zh', //设置语言
	        uploadUrl: uploadUrl, //上传的地址
	        allowedFileExtensions : ['jpg', 'png','jpeg'],//接收的文件后缀
	        showUpload: false, //是否显示上传按钮
	        showCaption: false,//是否显示标题
	        browseClass: "btn btn-primary", //按钮样式
	        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>", 
	    });
	};
	
	
    function confim() {
    	
    	
    	
    	
        var name = $.trim($('#name').val());
        var introduce = $.trim($('#introduce').val());
        var price = $.trim($('#price').val());
        var cover = $('#cover')[0].files[0];

        var formData = new FormData();

        formData.append("cover",cover);
        formData.append("name", name);
        formData.append("introduce", introduce);
        formData.append("price", price);

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
