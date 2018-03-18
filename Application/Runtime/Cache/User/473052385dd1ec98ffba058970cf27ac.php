<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="renderer" content="webkit">
	<meta property="qc:admins" content="1051105554536547046375" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="keywords" content="会员结算系统">
	<meta name="description" content="会员结算系统">

	<title>新闻公告</title>
	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-3.3.4.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-switch.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-3.2.0.min.js" ></script>

	<script type="text/javascript">
        $.browser = $.browser || {};
        $.browser.msie = false;
        $(document).on("mobileinit", function () {
            //$.mobile.ajaxEnabled = false;//如果需要开启设为true，但可能导致部分终端页面闪跳，无法退回BUG
            $.support.cors = true;
            $.mobile.allowCrossDomainPages = true;
            $.mobile.pushStateEnabled = false;
            $.mobile.defaultPageTransition = "slidedown";
            $.mobile.pageLoadErrorMessage = "页面加载出错";
            $.mobile.loader.prototype.options.theme = "c";
            $.mobile.buttonMarkup.hoverDelay = "false";
            $.mobile.defaultDialogTransition = "fade";
        });
	</script>
	<script type="text/javascript" src="/Public/js/jquery.mobile.custom.js" ></script>

	<script type="text/javascript" src="/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/Public/bootstrap/js/bootstrap-switch.min.js" ></script>
	<script type="text/javascript" src="/Public/js/engine.js" ></script>

</head>
<body>    <!--标题样式-->
<nav class="navbar navbar-default navbar-fixed-top mn-navbar-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-close glyphicon glyphicon-log-out" data-ajax="false" href="/User/Center/api_cancel" style="color:#fff !important;border:0px none"></a>
			<img style="width:35px;height:35px;margin-right:6px;position:absolute;left:10px;top:10px" src="/Public/images/wap_logo.png" />
			<a class="navbar-brand" style="position:absolute;top:3px;margin-left:32px;font-size:1.3em;" href="/User/Center/index">移动结算系统</a>
		</div>
	</div>
</nav>
<div class="mn-content" data-role="page">
	<div class="list-group">
		<a href="#" class="list-group-item" style="font-weight:bold;width:300px;">
			暂无
		</a>
		<!--<a href="/Notice/list?classify=101" class="list-group-item">购物流程</a>-->
		<!--<a href="/Notice/list?classify=102" class="list-group-item">常见问题</a>-->

	</div>
	<!--<div class="list-group">-->
		<!--<a href="/Notice/list?classify=20" class="list-group-item" style="font-weight:bold;">-->
			<!--配送方式-->
		<!--</a>-->

	<!--</div>-->
	<!--<div class="list-group">-->
		<!--<a href="/Notice/list?classify=30" class="list-group-item" style="font-weight:bold;">-->
			<!--售后服务-->
		<!--</a>-->

	<!--</div>-->
	<!--<div class="list-group">-->
		<!--<a href="/Notice/list?classify=40" class="list-group-item" style="font-weight:bold;">-->
			<!--特色服务-->
		<!--</a>-->

	<!--</div>-->

</div>    <!--按钮样式-->
<div class="navbar navbar-default navbar-fixed-bottom mn-navbar-bottom">
	<div class="row">
		<div class="col-xs-3">
			<a href="/User/Center/index" data-transition="slidefade">
				<span class="glyphicon glyphicon-th-large"></span>
				<p>首页</p>
			</a>
		</div>
		<div class="col-xs-3">
			<a href="/User/Notice/main" data-transition="slidefade">
				<span class="glyphicon glyphicon-bell"></span>
				<p>公告</p>
			</a>
		</div>
		<div class="col-xs-3">
			<a href=""  id="shop" data-transition="slidefade">
				<span class="glyphicon glyphicon-globe"></span>
				<p>商城</p>
			</a>
		</div>
		<div class="col-xs-3">
			<a href="/User/User/main" data-transition="slidefade">
				<span class="glyphicon glyphicon-cog"></span>
				<p>设置</p>
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">

    $("#shop").click(function(){
        $.getScript( "/Public/js/jquery-3.2.0.min.js" );

        window.location.href ="/Shop/index/index";
//        $.mobile.changePage("/Shop/index/index","pop", false, false);
    });
</script>
<input type="hidden" class="HF_IPADDRESS" value="39.82.44.192" />
</body></html>