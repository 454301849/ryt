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

	<title>会员管理系统</title>

	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-3.3.4.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-switch.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.3.min.js" ></script>
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
<nav class="navbar navbar-default navbar-fixed-top mn-navbar-top" style="background:red;">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-close glyphicon glyphicon-log-out" data-ajax="false" href="/User/Center/api_cancel" style="color:#fff !important;border:0px none"></a>
			<a class="navbar-brand" style="position:absolute;top:3px;margin-left:5px;font-size:1.3em;" href="/User/Center/index">会员管理系统</a>
		</div>
	</div>
</nav>
<div class="mn-content" data-role="page" data-url="/User/Center/index" data-external-page="true" tabindex="0">
	<style type="text/css">
		.pg-head{height:12em;background:url(/Public/images/head.jpg);background-size:cover;color:#fff;position:relative;overflow:hidden;margin:0px -1em;margin-top:-0.6em;}
		.pg-head-icon{width:6em;height:6em;position:absolute;left:1.8em;top:1em;border-radius:6em !important;border:3px solid #fff;}
		.pg-head-info{position:absolute;left:9em;top:1em;text-shadow: 0 0 3px #333;}
		.pg-head-info h5{margin:0px;padding:0px;}
		.pg-head-info div{font-size:0.95em;margin-bottom:0.5em;}

		.pg-head-menu{list-style:none;position:absolute;margin:0px;padding:0px;bottom:0px;left:0px;width:100%;background:rgba(0,0,0,0.38);height:3.3em;}
		.pg-head-menu li{margin-left:1%;text-align:center;font-size:0.9em;float:left;width:49%;border-left:1px solid #555;height:2.7em;margin-top:0.4em;font-weight:bold;}
		.pg-head-menu li div{margin-top:0.2em;font-size:0.9em;}
		.pg-head-menu li:first-child{border-left:0px none;}

		.pg-menu{margin:0;margin-top:1.5em;padding:0;list-style:none}
		.pg-menu li{float:left;margin-bottom:1em;width:25%;text-align:center}
		.pg-menu li a{position:relative;display:inline-block;width:2.8em;height:2.8em;border-radius:1.4em}
		.pg-menu li a img{position:absolute;top:.7em;left:.7em;width:1.4em;height:1.4em}
		.pg-menu li p{margin-top:.5em;color:#666;font-size:0.9em;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
	</style>
	<style type="text/css">
		.tree {
			min-height: 25px;
			background: 0 0;
			border: 0 none;
			box-shadow: none;
			padding: 0;
			margin: 0;
		}

		.tree li {
			list-style-type: none;
			margin: 0;
			padding: 10px 6px 0 5px;
			position: relative;
		}

		.tree li::after, .tree li::before {
			content: '';
			left: -20px;
			position: absolute;
			right: auto;
		}

		.tree li::before {
			border-left: 1px solid #999;
			bottom: 50px;
			height: 100%;
			top: 0;
			width: 1px;
		}

		.tree li::after {
			border-top: 1px solid #999;
			height: 20px;
			top: 25px;
			width: 25px;
		}

		.tree li span {
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			border: 1px solid #999;
			border-radius: 5px;
			display: inline-block;
			padding: 3px 8px;
			text-decoration: none;
		}

		.tree li.parent_li > span {
			cursor: pointer;
		}

		.tree > ul > li::after, .tree > ul > li::before {
			border: 0;
		}

		.tree li:last-child::before {
			height: 30px;
		}

		.tree li.parent_li > span:hover, .tree li.parent_li > span:hover + ul li span {
			background: #eee;
			border: 1px solid #94a0b4;
			color: #000;
		}
	</style>

	<!--页头-->
	<div class="pg-head">
		<?php if($userinfo['headimgurl'] != ''): ?><img class="pg-head-icon" src="<?php echo ($userinfo['headimgurl']); ?>" alt="">
			<?php else: ?>
			<img class="pg-head-icon" src="/Public/images/userhead.jpg" alt=""><?php endif; ?>
		<div class="pg-head-info">
			<h5><?php echo ($userinfo["nickname"]); ?></h5>
			<div>编号：<?php echo ($userinfo["user_name"]); ?></div>
			<div>等级：<?php echo ($levelinfo["name"]); ?></div>
			<div>推荐人：<?php echo ($userinfo['rusername']?$userinfo['rusername']:'-'); ?></div>
		</div>
		<ul class="pg-head-menu">
			<li>
				<span><?php echo ($userinfo["jjb"]); ?></span>
				<div>奖金币</div>
			</li>
			<li>
				<span><?php echo ($userinfo["gwb"]); ?></span>
				<div>购物币</div>
			</li>
			<!--
			<li>
				<span><?php echo ($userinfo["axjj"]); ?></span>
				<div>爱心基金</div>
			</li>
			<li>
				<span><?php echo ($userinfo["sh"]); ?></span>
				<div>税收</div>
			</li>-->
		</ul>
	</div>

	<ul class="pg-menu">
		<li>
			<a href="/User/User/basicinfo" style="background:#ee4b47;"><img src="/Public/images/icon/info.png" /></a>
			<p>基本信息</p>
		</li>
		
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#fcae14;"><img src="/Public/images/icon/reg.png" /></a>
			<p>注册会员</p>
			<?php else: ?>
				<a href="/User/User/register" style="background:#fcae14;"><img src="/Public/images/icon/reg.png" /></a>
			<p>注册会员</p><?php endif; ?>
		</li>
		
		<?php if($userinfo['shoptype'] > '0'): ?><li>
			<a href="/User/Center/centerlists" style="background:#83cc2b;"><img src="/Public/images/icon/cenlist.png" /></a>
			<p>代理中心</p>
		</li><?php endif; ?>

		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#ee4b47;"><img src="/Public/images/icon/net.png" /></a>
			<p>会员网络</p>
			<?php else: ?>
			<a href="/User/User/netchart" style="background:#ee4b47;"><img src="/Public/images/icon/net.png" /></a>
			<p>会员网络</p><?php endif; ?>
		</li>
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#4a8dfc;"><img src="/Public/images/icon/recmlists.png" /></a>
			<p>我的推荐</p>
			<?php else: ?>
			<a href="/User/User/recmlists" style="background:#4a8dfc;"><img src="/Public/images/icon/recmlists.png" /></a>
			<p>我的推荐</p><?php endif; ?>
		</li>
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#4a8dfc;"><img src="/Public/images/icon/conv.png" /></a>
			<p>币种转换</p>
			<?php else: ?>
			<a href="/User/Deal/convert" style="background:#4a8dfc;"><img src="/Public/images/icon/conv.png" /></a>
			<p>币种转换</p><?php endif; ?>
		</li>
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#f38043;"><img src="/Public/images/icon/transfer.png" /></a>
			<p>内部转账</p>
			<?php else: ?>
			<a href="/User/Deal/transfer" style="background:#f38043;"><img src="/Public/images/icon/transfer.png" /></a>
			<p>内部转账</p><?php endif; ?>
		</li>
		<!-- <li>
			<a href="/Product/report" style="background:#ee4b47;"><img src="/Public/images/icon/box.png" /></a>
			<p>我的购物车</p>
		</li> -->
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#f54e91;"><img src="/Public/images/icon/order.png" /></a>
			<p>我的订单</p>
			<?php else: ?>
			<a href="/User/Product/order" style="background:#f54e91;"><img src="/Public/images/icon/order.png" /></a>
			<p>我的订单</p><?php endif; ?>
		</li>
		<li>
			<?php if($_SESSION['user_info']['jjb'] <= '0'): ?><a href="javascript:pdjjb();" style="background:#f54e91;"><img src="/Public/images/icon/penlists.png" /></a>
			<p>保单中心申请</p>
			<?php else: ?>
			<a href="/User/User/applylists" style="background:#f54e91;"><img src="/Public/images/icon/penlists.png" /></a>
			<p>保单中心申请</p><?php endif; ?>
		</li>
		<!--<li>-->
		<!--<a href="#" onclick="engine.language(4)" style="background:#fcae14;"><img src="/Public/images/icon/lag.png" /></a>-->
		<!--<p>切换语言</p>-->
		<!--</li>-->
	</ul>
	<script type="text/javascript">
        var pck = {
            title: "移动结算平台"
        };

	</script>


</div>

<!--按钮样式-->
<div class="navbar navbar-default navbar-fixed-bottom mn-navbar-bottom" style="background:red;">
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
<!--<script type="text/javascript" src="/Public/js/jquery-3.2.0.min.js" ></script>-->
<script type="text/javascript">

    $("#shop").click(function(){
        $.getScript( "/Public/js/jquery-3.2.0.min.js" );

        window.location.href ="/Shop/index/index";
//        $.mobile.changePage("/Shop/index/index","pop", false, false);
    });
</script>
<script type="text/javascript">
	function pdjjb(){
		alert('您的账户余额不足，无法进行此操作');
	}
</script>

<input type="hidden" class="HF_IPADDRESS" value="39.82.44.192" />
</body></html>