<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MCN网红机构后台管理</title>
    <!-- Bootstrap Styles-->
    <link href="/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="/assets/css/custom-styles.css" rel="stylesheet" />
    <link href="/layui/css/layui.css" rel="stylesheet" />
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
</head>

<body>
<div id="wrapper">
    <nav class="navbar navbar-default top-navbar" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/HT">MCN网红机构</a>
        </div>

        <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-user fa-fw"></i>{{session('username')}} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="/admin/login/logout"><i class="fa fa-sign-out fa-fw"></i> 退出登录</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </nav>
    <!--/. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                @foreach(\App\Models\Menu::getMenu() as $k=>$v)
                <li>
                    <a class="" href="{{$v->menu_url}}"><i class="fa fa-dashboard"></i> {{$v->menu_name}}</a>
                </li>
                @endforeach
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">

    @yield('content')
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="/assets/js/jquery-1.10.2.js"></script>
<script>
	//对菜单的状态附加
	$(document).ready(function(){
	    $("#main-menu  a").each(function(){
	        $this = $(this);  
	        if($this[0].href==String(window.location)){
	            $this.addClass("active-menu"); 
	        }  
	    });  
	}); 
</script>
<!-- Bootstrap Js -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery-2.0.0.min.js"></script>
<!-- Metis Menu Js -->
<script src="/assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="/assets/js/morris/raphael-2.1.0.min.js"></script>
{{--<script src="/assets/js/morris/morris.js"></script>--}}
<!-- Custom Js -->
{{--<script src="/assets/js/custom-scripts.js"></script>--}}
<script src="/layui/layui.js"></script>
<script src="/layui/layui.all.js"></script>

</body>

</html>