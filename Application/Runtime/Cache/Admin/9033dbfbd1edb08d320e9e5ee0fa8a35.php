<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<link rel="stylesheet" href="/Public/css/weui.min.css"/>
<style type="text/css">
*,body{margin: 0;padding: 0;font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;}
.system-message{ padding:2px;margin:150px auto;width:400px;border:1px solid #ccc;background:#fff;border-radius:10px;}
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #999;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 20px ;text-align: center;}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://get.kabob.cc/kabobs/kabob.js/bqQVWUPLF24G7aFMXl8b9g"></script>
</head>
<body style="background:#e7e8eb;">


<div class="system-message">
<div style="padding:30px 10px ;border:1px solid #ccc;border-radius:10px;background:#fff;">	
		<?php if(isset($message)): ?><div class="weui_icon_msg weui_icon_success" style="margin:10px auto;text-align:center;"></div>	
		<div class="success"><span><?php echo($message); ?></span></div>
		<?php else: ?>		
		<div class="weui_icon_msg weui_icon_warn" style="margin:10px auto;text-align:center;"></div>
		<div class="error"><span style="padding-top:0px;"><?php echo($error); ?></div><?php endif; ?>
<div class="jump" style="text-align:right;margin-top:20px;color:#999;">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</div>
<div sytle="clear:both"></div>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait');
var href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>