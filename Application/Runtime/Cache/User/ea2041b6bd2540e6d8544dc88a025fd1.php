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
<!--标题样式-->
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/Deal/withdrawlists" data-external-page="true" tabindex="0" style="min-height: 635.2px;">
<table class="table table-hover table-condensed">
    <tbody>
    <tr>
        <td>编号</td>
        <td>开户姓名</td>
        <td>银行卡号</td>
        <td>开户银行</td>
        <td>开户地址</td>
        <td>提现金额</td>
        <td>到账金额</td>
        <td>状态</td>
        <td>备注</td>
        <td>申请时间</td>
        <td>审核时间</td>
    </tr>
        <?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
            <td><?php echo ($kk); ?></td>
            <td><?php echo ($vv["bankuser"]); ?></td>
            <td><?php echo ($vv["bankno"]); ?></td>
            <td><?php echo ($vv["bank"]); ?></td>
            <td><?php echo ($vv["bankname"]); ?></td>
            <td><?php echo ($vv["money"]); ?></td>
            <td><?php echo ($vv["arrival"]); ?></td>
            <td><?php if(($vv["status"] == 1) ): ?>审核成功
                <?php elseif(($vv["status"] == 2)): ?>审核失败
                <?php else: ?> 待审核<?php endif; ?></td>
            <td><?php echo ($vv["remarks"]); ?></td>
            <td><?php echo (date('Y-m-d H:i:s',$vv["createtime"])); ?></td>
            <td><?php if(($vv["handletime"] == 0) ): else: ?> <?php echo (date('Y-m-d H:i:s',$vv["handletime"])); endif; ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<ul class="pager">
       <?php echo ($page); ?>
</ul>
<!--隐藏域开始-->
<input type="hidden" class="HD_PAGE_C9A6E63997971A2A5AFBAD8D164E02ED" value="0">
<input type="hidden" class="HD_SIZE_C9A6E63997971A2A5AFBAD8D164E02ED" value="20">
<input type="hidden" class="HD_COUNT_C9A6E63997971A2A5AFBAD8D164E02ED" value="84">
<!--隐藏域结束-->
<script type="text/javascript">
    var pck = {
        title: "代理中心",
        page: 0,
        size: 0,
        count: 0,
        //加载页面
        init: function () {
            this.page = mtopt.parse.toInteger(m.node(".HD_PAGE_C9A6E63997971A2A5AFBAD8D164E02ED").value());
            this.size = mtopt.parse.toInteger(m.node(".HD_SIZE_C9A6E63997971A2A5AFBAD8D164E02ED").value());
            this.count = mtopt.parse.toInteger(m.node(".HD_COUNT_C9A6E63997971A2A5AFBAD8D164E02ED").value());
        }
    }
    pck.init()
</script>
</div>
</body>
</html>