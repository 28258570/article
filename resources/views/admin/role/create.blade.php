@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    角色管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加角色
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="myform" onsubmit="return false">
                                    <div class="form-group" >
                                        <label>角色名</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="角色名">
                                    </div>
                                    <div class="form-group">
                                        <label>描述信息</label>
                                        <input type="text" id="description" class="form-control" name="description" placeholder="描述信息">
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
        var data = {};
        $.each($('#myform').serializeArray(), function() {
            data[this.name] = this.value;
        });
        $.post('{{url('admin/role')}}', {
            _token: "{{csrf_token()}}",
            name: data.name,
            description: data.description,
        }, function (res) {
            if (res.status == 1){
                $('#name').val('');
                $('#description').val('');
                layer.msg(res.msg);
            } else {
                layer.msg(res.msg,{
                    offset:['50%'],
                    time: 2000
                },function(){
                    window.location.reload();
                });
            }
        }, 'json');
    }

</script>
@endsection
