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

	<title>移动结算平台</title>

	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-switch.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js" ></script>
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
			<a class="navbar-brand"  style="position:absolute;top:3px;margin-left:32px;font-size:1.3em;">移动结算系统</a>
		</div>
	</div>
</nav>
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page"  >
    <style type="text/css">
        .list-group-item .glyphicon{color:#666;margin-right:8px;}
    </style>

<div class="list-group" style="margin-top:0.8em;">
    <!-- <a href="/Deal/deposit" class="list-group-item"><span class="badge">费率：0%</span><span class="glyphicon glyphicon-log-in" style="color:#008fe0;"></span>充值</a> -->
    <a href="/User/Deal/withdraw" class="list-group-item" style="width:250px;"><span class="badge" style="background:red;">费率：<?php echo ($bonus_info["tx_sxf"]); ?>%</span><span class="glyphicon glyphicon-log-out" style="color:#008fe0"></span>提现</a>
	<a href="/User/Deal/withdrawlists" class="list-group-item" style="width:250px;"><span class="glyphicon glyphicon-calendar" style="color:#fdaf5a;"></span>提现明细</a>
	<!--<a href="/User/Deal/transfer" class="list-group-item" style="width:250px;"><span class="badge">费率：0%</span><span class="glyphicon glyphicon-transfer" style="color:#008fe0;"></span>转账</a>-->
    <a href="/User/Deal/lists" class="list-group-item" style="width:250px;"><span class="glyphicon glyphicon-list-alt" style="color:#fdaf5a;"></span>资金明细</a>
    <a href="/User/Deal/recordlists" class="list-group-item" style="width:250px;"><span class="glyphicon glyphicon-calendar" style="color:#fdaf5a;"></span>奖金明细</a>
</div>
<!-- 
<div class="list-group">
    <a class="list-group-item" href="/Mail/send"><span class="glyphicon glyphicon-envelope" style="color:#1d8fe1;"></span>发送消息</a>
    <a class="list-group-item" href="/Mail/sendlists"><span class="glyphicon glyphicon-collapse-down" style="color:#1d8fe1;"></span>发件箱</a>
    <a class="list-group-item" href="/Mail/collectlists"><span class="badge">0</span><span class="glyphicon glyphicon-collapse-up" style="color:#1d8fe1;"></span>收件箱</a>
</div>
 -->
<div class="list-group">
    <a class="list-group-item" href="/User/User/basicedit" style="width:250px;"><span class="glyphicon glyphicon-edit" style="color:#f15a4a;"></span>编辑资料</a>
    <a class="list-group-item" href="/User/User/safeinfo" style="width:250px;"><span class="glyphicon glyphicon-cog" style="color:#f15a4a;"></span>密码修改</a>
    <!--<a class="list-group-item" href="/Member/relationlists"><span class="glyphicon glyphicon-retweet" style="color:#29ab91;"></span>关联帐号</a> -->
    <a class="list-group-item" href="/User/Product/place" style="width:250px;"><span class="glyphicon glyphicon-map-marker" style="color:#29ab91;"></span>收货地址</a>
</div>
<script type="text/javascript">
    var pck = {
        title: "账户设置"
    }
    $('shop').on("pageinit",function(event){
        alert("触发 pageinit 事件！")
    });
</script>
</div>
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
</body>
</html>