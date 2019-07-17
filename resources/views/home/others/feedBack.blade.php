@extends('layout.header')
@section('content')
<link rel="stylesheet" href="/css/feedBack.css" />
<div id="content">
	<div class="containers">
		<p class="explain">尊敬的MCN网红机构用户: </p>
		<p class="explain" style="margin: 20px;">您在MCN网红机构遇到产品使用的问题，请在这里告诉我们，我们工作人员会及时处理，多谢您的宝贵意见。</p>
		<p class="fankui">反馈内容<span class="notBlank">(不能为空)</span></p>
		<div>
			<textarea class="values" placeholder="请输入反馈内容"></textarea>
			<p style="text-align: right;width: 940px;">1300字</p>
		</div>
		<p class="fankui">联系方式<span class="notBlank">(请正确填写信息，以便收到我们的反馈)</span></p>
		<div class="email">
			<div>
				<span>邮箱</span>
				<span><img src="/img/jian.png" alt="" /></span>
			</div>
			<div>
				<input type="text" placeholder="请正确填写邮箱" class="emailValue"/>
			</div>
		</div>
		<p class="confirm">
			<span class="submission">马上提交</span>
		</p>
	</div>
</div>
<script>
	$('.submission').on('click' , function(){
		var values = $('.values').val();//反馈内容
		var emailValue = $('.emailValue').val();//邮箱号
		if( values == "" || emailValue == ""){
			showMsg('请输入相关信息', 'center');
		}else{//非空时请求
//			$.ajax({
//              type:'post',
//              url:'',
//              data:{
//                  _token:"{{csrf_token()}}",
//              },
//              dataType:"json",
//              async:false,
//              success: function (res) {
//                  if (res.status == 0){
//                      
//                  } else {
//                      
//                  }
//              }
//          });
		}
		
		
	})
</script>

@endsection 