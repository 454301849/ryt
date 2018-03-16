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
	<table class="table table-hover table-condensed">
		<tr>
			<td>编号</td>
			<td>等级</td>
			<td>业绩</td>
			<td style="width:80px;">操作</td>
		</tr>
		<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
			<td><?php echo ($vv["user_name"]); ?></td>
			<td><?php echo ($vv["name"]); ?></td>
			<td><?php echo ($vv['area1'] + $vv['area2']); ?></td>
			<td>
				<a href="/User/User/detail?id=<?php echo ($vv["user_id"]); ?>" class="btn btn-danger btn-xs">会员详情</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<ul class="pager"><?php echo ($page); ?></ul>
	<!--隐藏域开始-->
	<input type="hidden" class="HD_PAGE_7F04C52DCA1AD7EE4FFD1E1555E39273" value="0" />
	<input type="hidden" class="HD_SIZE_7F04C52DCA1AD7EE4FFD1E1555E39273" value="15" />
	<input type="hidden" class="HD_COUNT_7F04C52DCA1AD7EE4FFD1E1555E39273" value="5" />
	<!--隐藏域结束-->
	<script type="text/javascript">
        var pck = {
            title: "我的推荐",
            page: 0,
            size: 0,
            count: 0,
            //加载页面
            init: function () {
                this.page = mtopt.parse.toInteger(m.node(".HD_PAGE_7F04C52DCA1AD7EE4FFD1E1555E39273").value());
                this.size = mtopt.parse.toInteger(m.node(".HD_SIZE_7F04C52DCA1AD7EE4FFD1E1555E39273").value());
                this.count = mtopt.parse.toInteger(m.node(".HD_COUNT_7F04C52DCA1AD7EE4FFD1E1555E39273").value());
            }
        }
        pck.init()
	</script>
</div>
</body>
</html>