<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
  <title>系统管理后台</title>
  <link rel="stylesheet" href="/Public/admin/css/bootstrap.css">
   <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<script src="/Public/admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/Public/admin/css/base.css">
  <style>
  body{margin:0;padding:0;

	  background-image:url('/Public/images/max1.jpg');
	  background-repeat:no-repeat;
	  background-attachment:fixed;
	  background-size:cover;
	  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Images/background/001/max.jpg',sizingMethod='scale');}
.login{background:url(/Public/images/form.png) no-repeat;
	background-size:100%;position:absolute;
	left:50%;top:40%;width:640px;
	height:320px;margin-left:-320px;margin-top:-160px;
	padding:60px 0px;-webkit-animation: login 3s ease-in-out 1s 1 alternate forwards;}

h2{ -webkit-animation: h2 2s ease 0s infinite alternate;}
@-webkit-keyframes h2 /* Safari 和 Chrome */
{
from{color:#fff;}
to{color:green;}
}

  .footer{position:absolute;bottom:20%;color:green;font-size:16px;width:100%;}
  </style>
</head>

<body >
 <div class="container"> 
	<div class="login" style="">
		<form class="form-inline" style="margin-left:10px;" onsubmit="return checked()"  action="/Admin/User/index.html" method="post">
			<div class="col-sm-12 text-center" style="margin-bottom:55px">
			 <h2 style="color:#182d6c">直销管理后台</h2>
			</div>

			<div style="clear:both"></div>
			<div class="col-sm-12 text-center">
		  <div class="form-group">
			<div class="input-group">
			  <div class="input-group-addon" style="background:#fff;"><span class="glyphicon glyphicon-user" style="color:#44b549"></span></div>
			  <input type="text" class="form-control" name="username" value="" id="input1" placeholder="用户名">
			</div>
		  </div>
		  <div class="form-group">
			<div class="input-group">
			  <div class="input-group-addon" style="background:#fff;"><span class="icon-lock" style="color:#44b549"></span></div>
			   <input type="password" class="form-control" name="password" value="" id="input2" placeholder="密码">
			</div>
		  </div>
		  <div class="form-group" style="margin-left:15px">
			
			  <button type="button" class="btn btn-success" data-loading-text="请稍候..." style="background:#fff;color:#44b549">立即登录</button>
		   
		  </div>
		  </div>
		</form>

	</div>
</div>
	<script src="/Public/admin/layer/layer.js"></script>
<script>
	//if (window.top!=window.self){
	//	console.log('333');
	//	window.top.location="index.html"; //这是重要的！
	//}else{
	//	console.log('eeeeeeeeeeee');
	//}


	$('.btn-success').click(function(){
	var $btn = $(this).button('loading');
	var username = $('#input1').val();if(username == ''){layer.closeAll();layer.msg("请输入用户名");$btn.button('reset');exit;}
	var password = $('#input2').val();if(password == ''){layer.closeAll();layer.msg("请输入用户密码");$btn.button('reset');exit;}
	$.ajax({
			type: "POST",
			url: "<?php echo U('index');?>?time="+new Date(),
			dataType: "json",
			data: {
				"username":username,
				"password":password,
			},
			success: function(json){
			    if(json.success == 1){
					layer.msg("登录成功，正在跳转到管理台");
					setTimeout(function(){
						location.href="<?php echo U('Index/index');?>";
					},2000);
				}else{
					layer.msg("帐号密码有误！");$btn.button('reset');
				}
			},
			error:function(json){
				layer.msg("帐号密码有误！");$btn.button('reset');
			}
		});
})


</script>
</body>
</html>