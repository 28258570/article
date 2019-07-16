<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>MCN网红机构后台管理</title>
    <link href="/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="/assets/css/custom-styles.css" rel="stylesheet" />
    <link href="/layui/css/layui.css" rel="stylesheet" />
    <script src="/assets/js/jquery-1.10.2.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.metisMenu.js"></script>
    <script src="/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="/assets/js/morris/morris.js"></script>
    <script src="/assets/js/custom-scripts.js"></script>
    <script src="/layui/layui.js"></script>
    <script src="/layui/layui.all.js"></script>

</head>
<style type="text/css">
	.container{
		padding-top: 100px;
	}
	.form-signin{
		width: 400px;
		margin: 0 auto;
	}
	.form-signin h3{
		margin-bottom: 40px;
	}
	.form-group{
		margin-bottom: 20px;
	}
</style>
<body>
{{ csrf_field() }}
<div class="container">
    <form class="form-signin" method="get" action="" onsubmit="javascript:return false;">
        {{--<div class="logo animated bounceIn" style="height:120px;"><img  style="display:none;" src="{{URL::asset('images/logo.png')}}"/></div>--}}
        <h3>欢迎使用MCN网红机构后台管理系统</h3>
        <div class="form-group">
            <!--[if lt IE 9]><label>用户名</label><![endif]-->
            <input type="text" name="username" class="form-control" placeholder="用户名" required="required" autofocus="autofocus">
        </div>
        <div class="form-group">
            <!--[if lt IE 9]><label>密码</label><![endif]-->
            <input type="password" name="password" class="form-control" placeholder="密码" required="required">
        </div>
        <input type="button" class="btn btn-lg btn-primary btn-block subBtn" id="signInBtn" value="登录" onclick="signIn(this)" />
        <!-- <div class="help"><i class="fa fa-lightbulb-o"></i> 此为静态演示，可以直接<a href="./tpl/"><b>进入后台演示</b></a></div>
        <div class="copyright"><i class="fa fa-copyright"></i><a href="https://github.com/liyu365">liyu</a></div> -->
    </form>
</div>
<script>

    function signIn(obj) {
        $.post('{{url('admin/login/login')}}', {
            _token: $('input[name="_token"]').val(),
            username: $('input[name="username"]').val(),
            password: $('input[name="password"]').val(),
        }, function(res) {
            if (res.status == 0){
                layer.msg(res.msg);
            } else {
                layer.msg(res.msg,{
                    offset:['50%'],
                    time: 1500
                },function(){
                    window.location.href = '/admin/admin';
                });
            }
        }, 'json');
    }
</script>
</body>
</html>