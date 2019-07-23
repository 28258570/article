@extends('admin.layout.layout')
@section('content')
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
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        MCN机构套餐列表
                    </div>
                    <a style="margin-top: 10px;margin-left: 15px;" href="/admin/mcnMeal/create" class="btn btn-default btn-sm"><i class="layui-icon layui-icon-add-1"></i>添加MCN机构套餐</a>
                    <button style="margin-top: 10px;margin-left: 15px;" onclick="batchDel()" class="btn btn-danger btn-sm"><i class="layui-icon layui-icon-delete"></i>批量删除</button>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th style="width: 40px">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">MCN套餐名称</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">套餐封面</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">套餐介绍</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">价格</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">状态</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">创建时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:200px;">操作</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                        <tr class="gradeA odd">
                                            <td class="sorting_1">
                                                <input type="checkbox" class="checkbox" value="{{$v->id}}">
                                            </td>
                                            <td class="">{{$v->id}}</td>
                                            <td class=" ">{{$v->name}}</td>
                                            <td class=" "><img style="width: 30px" src="{{url($v->cover)}}"></td>
                                            <td class=" ">{{$v->introduce}}</td>
                                            <td class=" ">{{$v->price}}</td>
                                            <td class=" ">
                                                @if($v->state == 1)
                                                    下架
                                                @else
                                                    上架
                                                @endif
                                            </td>
                                            <td class=" ">{{$v->created_at}}</td>
                                            <td class="center ">
                                                <a href="/admin/mcnMeal/{{$v->id}}/edit" class="btn btn-info btn-sm">编辑</a>
                                                @if($v->state == 1)
                                                    <button class="btn btn-success btn-sm" onclick="change({{$v->id}},{{$v->state}})">上架</button>
                                                @else
                                                    <button class="btn btn-warning btn-sm" onclick="change({{$v->id}},{{$v->state}})">下架</button>
                                                @endif
                                                <button onclick="del({{$v->id}})" class="btn btn-danger btn-sm">删除</button>
                                            </td></tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    @if (!empty($list))
                                        {{ $list->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

    <script>
        //删除
        function del(id) {
            layer.msg('你确定要删除吗？', {
                time: 0 //不自动关闭
                ,btn: ['是的', '返回']
                ,yes: function(index){
                    layer.close(index);
                    $.ajax({
                        type:'post',
                        url:'/admin/mcnMeal/'+id,
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

        //关闭
        function closesThis(){
            $('.log').removeClass('zoomIn')
            $('.dia').hide()
            $('.log').addClass('animated zoomOut')
        }

        //改变状态
        function change(id,state) {
            $.ajax({
                type:'post',
                url:'/admin/mcnMeal/change',
                data:{
                    _token: "{{csrf_token()}}",
                    id: id,
                    state: state
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

        //批量删除
        function batchDel() {
            var id = '';
            $(".checkbox:checkbox").each(function() {
                if($(this).is(":checked")) {
                    id += $(this).attr("value")+",";
                }
            });
            id=id.substring(0,id.length-1);
            if (id == ''){
                layer.msg('请选中要删除的数据')
            } else {
                $.ajax({
                    type:'post',
                    url:'/admin/mcnMeal/batchDel',
                    data:{
                        _token:"{{csrf_token()}}",
                        id:id
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
        }
        
    </script>
@endsection