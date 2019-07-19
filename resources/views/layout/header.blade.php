<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>MCN网红机构后台管理</title>
</head>
<link rel="stylesheet" href="/css/reset.css" />
<link rel="stylesheet" href="/css/header.css" />

<script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script>
	function showMsg(text,position){
		var show = $('.show_msg').length
		if(show>0){
			
		}else{
			var	div	= $('<div></div>');
				div.addClass('show_msg');
			var span = $('<span></span>');
				span.addClass('show_span');
				span.appendTo(div);
				span.text(text);
			$('body').append(div);
		}
		$(".show_span").text(text);
		
		if(position=='bottom'){
			$(".show_msg").css('bottom','5%');
		}else if(position=='center'){
			$(".show_msg").css('top','');
			$(".show_msg").css('bottom','50%');
		}else{
			$(".show_msg").css('bottom','95%');
		}
		$('.show_msg').hide();
		$('.show_msg').fadeIn(500);
		$('.show_msg').fadeOut(2500);
	}

</script>


<body>
	<div id="bodys">
		
		<div id="headItem">
			<div>
				<div class="header">
					<div>
						<div class="fmName">
							<span><img src="/img/logo.png" alt="" /></span>
							<span>MCN网红机构</span>
						</div>
						<div class="fmName">
							<a href="">手机号快捷登录</a>
						</div>
					</div>
				</div>
				<div class="headSearch">
					<div class="searchItem">
						<div class="logo">
							<span><img src="/img/logo.png" alt="" /></span>
							<span>MCN网红机构</span>
						</div>
						<div class="search">
							<input type="text"  class="searchInp" placeholder="请输入查找内容"/>
							<span class="searchBtn">搜索</span>
						</div>
					</div>
					<span class="bgImg">
						<img src="/img/topBG.png">
					</span>
				</div>
				<div class="headClassification">
					<div class="classification">
						<ul class="menuLists">
							<li><a href="http://www.blog.cn">首页</a></li><li>
								<a href="http://www.blog.cn/home/index/mcnList">mcn机构</a></li><li>
								<a href="http://www.blog.cn/home/index/zimei">自媒体攻略</a></li><li>
								<a href="http://www.blog.cn/home/index/xinmei">新媒体攻略</a></li><li>
								<a href="http://www.blog.cn/home/others/feedBack">意见反馈</a></li><li>
								<a href="http://www.blog.cn/home/index/joinIn">加盟合作</a></li><li>
								<a href="http://www.blog.cn/home/index/links">友情链接</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		@yield('content')
	</div>
	
	
	<script>
		//对菜单的状态附加
		$(document).ready(function(){
		    $(".menuLists  li a").each(function(){
		        $this = $(this);  
		        if($this[0].href==String(window.location)){
		            $this.addClass("active"); 
		        }  
		    });  
		}); 
	</script>
</body>
</html>