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
                    MCN机构套餐管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        修改MCN机构套餐
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="myform" onsubmit="return false">
                                    <div class="form-group" >
                                        <label>MCN套餐名称</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" placeholder="MCN名称">
                                    </div>
                                    <div class="form-group">
                                        <label>套餐封面</label>
                                        <input type="file" id="cover" onchange="show(this)" name="cover">
                                        <img id="img_cover" src="{{url($data->cover)}}">
                                    </div>
                                    <div class="form-group" >
                                        <label>套餐介绍</label>
                                        <input type="text" id="introduce" class="form-control" value="{{$data->introduce}}" name="introduce" placeholder="介绍">
                                    </div>
                                    <div class="form-group" >
                                        <label>套餐价格</label>
                                        <input type="text" id="price" class="form-control" name="price" value="{{$data->price}}" placeholder="价格">
                                    </div>
                                    <div class="form-group">
                                        <label>MCN机构</label>
                                        @foreach(\App\Models\McnMeal::getMcnList() as $k=>$v)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" @if(in_array($v->id,$data->mcn_id)) checked @endif class="checkbox" value="{{$v->id}}">{{$v->name}}
                                                </label>
                                            </div>
                                        @endforeach
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
            var id = "{{$data->id}}";
            var mcn_id = '';
            $(".checkbox:checkbox").each(function() {
                if($(this).is(":checked")) {
                    mcn_id += $(this).attr("value")+",";
                }
            });
            mcn_id=mcn_id.substring(0,mcn_id.length-1);
            var name = $.trim($('#name').val());
            var introduce = $.trim($('#introduce').val());
            var price = $.trim($('#price').val());
            var cover = $('#cover')[0].files[0];

            var formData = new FormData();

            formData.append("cover",cover);
            formData.append("name", name);
            formData.append("introduce", introduce);
            formData.append("price", price);
            formData.append("mcn_id", mcn_id);
            formData.append("_method", "put");

//        console.log(formData);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            $.ajax({
                url:'/admin/mcnMeal/'+id,
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
