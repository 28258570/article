@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    管理员管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加管理员
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="myform" onsubmit="return false">
                                    <div class="form-group" >
                                        <label>用户名</label>
                                        <input type="text" class="form-control" name="username" placeholder="用户名">
                                    </div>
                                    <div class="form-group">
                                        <label>密码</label>
                                        <input type="password" id="password" class="form-control" name="password" placeholder="密码最少为6位">
                                    </div>
                                    <div class="form-group">
                                        <label>确认密码</label>
                                        <input type="password" id="re_password" class="form-control" name="re_password" placeholder="确认密码需和密码一致">
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
        $.post('{{url('admin')}}', {
            _token: "{{csrf_token()}}",
            username: data.username,
            password: data.password,
            re_password: data.re_password,
        }, function (res) {
            if (res.status == 1){
                $('#password').val('');
                $('#re_password').val('');
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
