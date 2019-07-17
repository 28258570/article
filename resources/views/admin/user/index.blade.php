@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    用户管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        用户列表
                    </div>
                    {{--<a style="margin-top: 10px;margin-left: 15px;" href="/admin/admin/create" class="btn btn-default btn-sm"><i class="layui-icon layui-icon-add-1"></i>添加管理员</a>--}}

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <form action="" name="search">
                                            <label>手机号:<input type="text" class="form-control input-sm" name="mobile" value="{{$params['mobile'] or ''}}" aria-controls="dataTables-example"></label>
                                            <button type="submit" class="btn btn-default">提交</button>
                                        </form>
                                    </div>

                                </div>
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">手机号</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">创建时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:250px;">操作</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                    <tr class="gradeA odd">
                                        <td class="sorting_1">{{$v->id}}</td>
                                        <td class=" ">{{$v->mobile}}</td>
                                        <td class="center ">{{$v->created_at}}</td>
                                        <td class="center ">
                                            <button  class="btn btn-success" onclick="watchDetail({{$v->id}})">查看</button>
                                            <button onclick="del({{$v->id}})" class="btn btn-danger">删除</button>
                                        </td></tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                <div class="row">

                                </div>
                                @if (!empty($list))
                                    {{ $list->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{URL::asset('/css/animate.css')}}">
    <style>
    	.dia{
    		position: fixed;
    		top: 0;
    		left: 0;
    		right: 0;
    		bottom: 0;
    		z-index: 9;
    		background-color: #000;
    		opacity: 0.5;
    	}
    	.log{
    		position: fixed;
    		top: 20%;
    		left: 50%;
    		width: 500px;
    		height: 400px;
    		margin-left: -250px;
    		background-color: #fff;
    		z-index: 99;
    		padding: 30px;
    	}
    	.closes{
    		font-size: 40px;
    		position: absolute;
    		top:1px;
    		right: 10px;
    		color: #000;
    		cursor: pointer;
    	}
    	.phones{
    		font-size: 18px;
    		color: #333;
    	}
    	.lists{
    		height: 240px;
    		margin: 15px 0;
    		overflow-y: auto;
    		padding: 0 10px;
    	}
    	.lists>div{
    		margin-bottom: 20px;
    		display: flex;justify-content: space-between;
    	}
    	.yigou>p{
    		margin-top: 20px;
    	}
    	.mediaName{
    		width: 300px;
    		height: 30px;
    		line-height: 30px;
    		text-align: center;
    		border-radius: 5px;
    		display: inline-block;
    		background-color: #d0d0d0;
    	}
    	.deletes{
    		cursor: pointer;
    		width: 74px;
    		height: 30px;
    		text-align: center;
    		line-height: 30px;
    		background-color: red;
    		color: #fff;
    		border-radius: 5px;
    		display: inline-block;
    	}
    	/*美化滚动条*/
		/*定义滚动条高宽及背景 高宽分别对应横竖滚动条的尺寸*/  
		.lists::-webkit-scrollbar  
		{  
		    width: 2px;  /*滚动条宽度*/
		    height: 10px;  /*滚动条高度*/
		}  
		/*定义滚动条轨道 内阴影+圆角*/  
		.lists::-webkit-scrollbar-track  
		{  
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);  
		    border-radius: 10px;  /*滚动条的背景区域的圆角*/
		    background-color: #f5f5f5;/*滚动条的背景颜色*/  
		}  
		/*定义滑块 内阴影+圆角*/  
		.lists::-webkit-scrollbar-thumb  
		{  
		    border-radius: 10px;  /*滚动条的圆角*/
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);  
		    background-color: #f5f5f5;  /*滚动条的背景颜色*/
		} 
		.dialog>div{
			display: none;
		}
    </style>
    
    <div class="dialog">
    	<div class="dia"></div>
    	<div class="log">
    		<span class="closes" onclick="closesThis()">×</span>
    		<div class="phones">
    			手机号: <span>17625520754</span>
    		</div>
    		<div class="yigou">
    			<p>已购买的指南: </p>
    			<div class="lists">
    				
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				<div>
    					<span class="mediaName">YELLOW小视频在线观看</span>
    					<span class="deletes" onclick="deletes({{$v->id}})">删除</span>
    				</div>
    				
    			</div>
    		</div>
    	</div>
    </div>
    
    
    <script>
        function del(id) {
            layer.msg('你确定要删除吗？', {
                time: 0 //不自动关闭
                ,btn: ['是的', '返回']
                ,yes: function(index){
                    layer.close(index);
                    $.ajax({
                        type:'post',
                        url:'/admin/user/'+id,
                        data:{
                            _method:'delete',
                            _token:"{{csrf_token()}}",
                        },
                        dataType:"json",
                        async:false,
                        success: function (res) {
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
            });
        }
        
        //点击查看账户购买数据
        function watchDetail(id){
        	$('.dia,.log').show();
        	$('.log').addClass('animated zoomIn')
        }
        function closesThis(){
        	$('.dia').hide()
			$('.log').addClass('animated zoomOut')
        }
        
    </script>
@endsection