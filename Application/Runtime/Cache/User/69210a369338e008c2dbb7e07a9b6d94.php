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
	<link href="/Public/bootstrap/css/bootstrap-switch.min.css"  rel="stylesheet" />
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
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top mn-navbar-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-close glyphicon glyphicon-log-out" data-ajax="false" href="/User/Center/api_cancel" style="color:#fff !important;border:0px none"></a>
			<img style="width:35px;height:35px;margin-right:6px;position:absolute;left:10px;top:10px" src="/Public/images/wap_logo.png" />
			<a class="navbar-brand" style="position:absolute;top:3px;margin-left:32px;font-size:1.3em;" href="/User/Center/index">移动结算系统</a>
		</div>
	</div>
</nav>

<div class="mn-content" data-role="page" >

<div class="tree well">
	<ul style="margin:0px;padding:0px;">
			<li>
				<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_user['user_name']?$info_user['user_name']:'0'));?>" ><?php echo ($info_user['user_name']); ?> <?php echo ($info_user['truename']); ?>  [级别：<?php echo ($info_user['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_user['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_user['area1']+$info_user['area2']); ?></a></span>
				<ul>
					<?php if($info_luser['user_id'] != ''): ?><li>
						<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_luser['user_name']));?>"  ><?php echo ($info_luser['user_name']); ?> <?php echo ($info_luser['truename']); ?>  [级别：<?php echo ($info_luser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_luser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_luser['area1']+$info_luser['area2']); ?></a></span>
						<ul>
							<?php if($info_lluser['user_id'] != ''): ?><li>
								<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_lluser['user_name']));?>"  ><?php echo ($info_lluser['user_name']); ?> <?php echo ($info_lluser['truename']); ?>  [级别：<?php echo ($info_lluser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_lluser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_lluser['area1']+$info_lluser['area2']); ?></a></span>
							</li>
								<?php else: ?>
								<li>
									<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_luser['user_name'],'area'=>'1'));?>">点此立刻注册会员[安置位置：A区]</a></span>
								</li><?php endif; ?>
							<?php if($info_lruser['user_id'] != ''): ?><li>
								<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_lruser['user_name']));?>"  ><?php echo ($info_lruser['user_name']); ?>  <?php echo ($info_lruser['truename']); ?>  [级别：<?php echo ($info_lruser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_lruser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_lruser['area1']+$info_lruser['area2']); ?></a></span>
							</li>
								<?php else: ?>
								<li>
									<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_luser['user_name'],'area'=>'2'));?>">点此立刻注册会员[安置位置：B区]</a></span>
								</li><?php endif; ?>
						</ul>
					</li>
						<?php else: ?>
						<li>
							<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_user['user_name'],'area'=>'1'));?>">点此立刻注册会员[安置位置：A区]</a></span>
						</li><?php endif; ?>
					<?php if($info_ruser['user_id'] != ''): ?><li>
						<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_ruser['user_name']));?>"  ><?php echo ($info_ruser['user_name']); ?>  <?php echo ($info_ruser['truename']); ?>   [级别：<?php echo ($info_ruser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_ruser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_ruser['area1']+$info_ruser['area2']); ?></a></span>
						<ul>
							<?php if($info_rluser['user_id'] != ''): ?><li>
								<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_rluser['user_name']));?>"  ><?php echo ($info_rluser['user_name']); ?>  <?php echo ($info_rluser['truename']); ?>   [级别：<?php echo ($info_rluser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_rluser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_rluser['area1']+$info_rluser['area2']); ?></a></span>
							</li>
							<?php else: ?>
							<li>
								<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_ruser['user_name'],'area'=>'1'));?>">点此立刻注册会员[安置位置：A区]</a></span>
							</li><?php endif; ?>

							<?php if($info_rruser['user_id'] != ''): ?><li>
								<span><i class="icon-user"></i><a href="<?php echo U('User/netchart',array('rootid'=>$info_rruser['user_name']));?>"  ><?php echo ($info_rruser['user_name']); ?> <?php echo ($info_rruser['truename']); ?>   [级别：<?php echo ($info_rruser['name']); ?>]&nbsp;&nbsp; 层数：<?php echo ($info_rruser['plevel']); ?>&nbsp;&nbsp;业绩：<?php echo ($info_rruser['area1']+$info_rruser['area2']); ?></a></span>
							</li>
								<?php else: ?>
								<li>
									<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_ruser['user_name'],'area'=>'2'));?>">点此立刻注册会员[安置位置：B区]</a></span>
								</li><?php endif; ?>

						</ul>
					</li>
						<?php else: ?>
						<li>
							<span><i class="icon-user"></i><a href="<?php echo U('User/register',array('rootid'=>$info_user['user_name'],'area'=>'2'));?>">点此立刻注册会员[安置位置：B区]</a></span>
						</li><?php endif; ?>
					</if>
				</ul>
			</li>
		</ul>
</div>
<script type="text/javascript">
    var pck = {
        title: "移动结算平台"
    }
    $(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
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
<input type="hidden" class="HF_IPADDRESS" value="39.82.44.192" />
<script type="text/javascript">

    $("#shop").click(function(){
        $.getScript( "/Public/js/jquery-3.2.0.min.js" );

        window.location.href ="/Shop/index/index";
//        $.mobile.changePage("/Shop/index/index","pop", false, false);
    });
</script>
</body>
</html>