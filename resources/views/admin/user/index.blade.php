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
                                            <label>用户名:<input type="text" class="form-control input-sm" name="username" value="{{$params['username'] or ''}}" aria-controls="dataTables-example"></label>
                                            <label>手机号:<input type="text" class="form-control input-sm" name="mobile" value="{{$params['mobile'] or ''}}" aria-controls="dataTables-example"></label>
                                            <button type="submit" class="btn btn-default">提交</button>
                                        </form>
                                    </div>

                                </div>
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">用户名</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">手机号</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">创建时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:250px;">操作</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                    <tr class="gradeA odd">
                                        <td class="sorting_1">{{$v->id}}</td>
                                        <td class=" ">{{$v->username}}</td>
                                        <td class=" ">{{$v->mobile}}</td>
                                        <td class="center ">{{$v->created_at}}</td>
                                        <td class="center ">
                                            <button  class="btn btn-success">查看</button>
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
    </script>
@endsection