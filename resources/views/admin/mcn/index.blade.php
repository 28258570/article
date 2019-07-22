@extends('admin.layout.layout')
@section('content')
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
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        MCN机构列表
                    </div>
                    <a style="margin-top: 10px;margin-left: 15px;" href="/admin/mcn/create" class="btn btn-default btn-sm"><i class="layui-icon layui-icon-add-1"></i>添加MCN机构</a>
                    <button style="margin-top: 10px;margin-left: 15px;" class="btn btn-danger btn-sm"><i class="layui-icon layui-icon-delete"></i>批量删除</button>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6">--}}
                                        {{--<form action="" name="search">--}}
                                            {{--<label>手机号:<input type="text" class="form-control input-sm" name="mobile" value="{{$params['mobile'] or ''}}" aria-controls="dataTables-example"></label>--}}
                                            {{--<button type="submit" class="btn btn-default">提交</button>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th style="width: 40px">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">MCN名称</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">封面</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">介绍</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">价格</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">状态</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">创建时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:240px;">操作</th></tr>
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
                                                <a href="/admin/mcn/{{$v->id}}/edit" class="btn btn-info btn-sm">编辑</a>
                                                @if($v->state == 1)
                                                    <button class="btn btn-success btn-sm">上架</button>
                                                @else
                                                    <button class="btn btn-warning btn-sm">下架</button>
                                                @endif
                                                <button onclick="del()" class="btn btn-danger btn-sm">删除</button>
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
            $('.log').removeClass('zoomOut')
            $('.dia,.log').show();
            $('.log').addClass('animated zoomIn')
            $.ajax({
                type:'post',
                url:'/admin/user/order',
                data:{
                    _token: "{{csrf_token()}}",
                    id: id
                },
                dataType:"json",
                async:false,
                success: function (res) {
                    $('#mobile').html(res.data.mobile);
                }
            });
        }
        //关闭
        function closesThis(){
            $('.log').removeClass('zoomIn')
            $('.dia').hide()
            $('.log').addClass('animated zoomOut')
        }

    </script>
@endsection