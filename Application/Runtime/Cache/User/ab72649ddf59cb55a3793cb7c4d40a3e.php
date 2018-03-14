<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="renderer" content="webkit">
	<meta property="qc:admins" content="1051105554536547046375" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="keywords" content="会员结算系统">
	<meta name="description" content="会员结算系统">

	<title>移动结算平台</title>
	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.3.min.js" ></script>
	<script type="text/javascript">
        $.browser = $.browser || {};
        $.browser.msie = false;
        $(document).on("mobileinit", function () {
            $.support.cors = true;
            $.mobile.allowCrossDomainPages = true;
            $.mobile.pushStateEnabled = false;
            $.mobile.defaultPageTransition = "slidefade";
            $.mobile.pageLoadErrorMessage = "页面加载出错";
            $.mobile.loader.prototype.options.theme = "c";
            $.mobile.buttonMarkup.hoverDelay = "false";
        });
	</script>
	<style type="text/css">
		body{background:#BDE3FA;}
		.container{padding-top:2em;}
		.form-title{font-size:2.7em;text-align:center;height:110px;margin-top:120px;}
		.form-title img{width:200px;}
		.form-control{margin-bottom:1.8em;height:2.8em;}
	</style>
	<script type="text/javascript" src="/Public/js/jquery.mobile.custom.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/Public/js/engine.js" ></script>
</head>
<body>
<div class="mn-content" data-role="page">
	<div class="list-group">
		<a class="list-group-item">编号：<?php echo ($info["user_name"]); ?></a>
		<a class="list-group-item">等级：<?php echo ($info["name"]); ?></a>
		<a class="list-group-item">安置位置：<?php echo ($info["area_name"]); ?></a>
		<a class="list-group-item">姓名：<?php echo ($info["truename"]); ?></a>
		<a class="list-group-item">身份证：<?php echo ($info["idcard"]); ?></a>
		<a class="list-group-item">推荐人：<?php echo ($info["rusername"]); ?></a>
		<a class="list-group-item">安置人：<?php echo ($info["pusername"]); ?></a>
		<a class="list-group-item">代理中心：<?php echo ($info["centername"]); ?></a>
		<a class="list-group-item">团队累计：<?php echo ($info['area1'] + $info['area2']); ?></a>
	</div>
	<div class="list-group" style="margin-top:6px;">
		<a class="list-group-item">创建时间：<?php echo (date("Y-m-d H:i:s",$info["reg_time"])); ?></a>
		<a class="list-group-item">编辑时间：<?php echo (date("Y-m-d H:i:s",$info["after_time"])); ?></a>
	</div>

<a href="javascript:history.go(-1);"" class="btn btn-default btn-block" type="button">返回列表</a>

	<script type="text/javascript">
        var pck = {
            title: "基础信息"
        }
	</script>
</div>
</body>
</html>