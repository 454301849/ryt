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
</head>
<body>   
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/User/applylists" data-external-page="true" tabindex="0" style="min-height: 242.2px;">
<div class="pg-form">
    <table class="table table-hover table-condensed">
        <tbody><tr>
            <td>标题</td>
            <td>类型</td>
            <td>时间</td>
            <td style="width:95px;">状态</td>
        </tr>
           <?php $status = '0'; ?>
           <?php if(is_array($centerlists_info)): $kk = 0; $__LIST__ = $centerlists_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
                <td><?php echo ($vv["title"]); ?></td>
                <td><?php if(($vv["type"] == 1) ): ?>品鉴店<?php else: ?>旗舰店<?php endif; ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$vv["tj_time"])); ?></td>
                <td><?php if(($vv["genre"] == 1) ): ?>提交中<?php elseif(($vv["genre"] == 2) ): ?>审核通过 <?php $status = '1'; else: ?>审核失败<?php endif; ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody></table>
    <ul class="pager">
            <?php echo ($page); ?>
    </ul>
    <a href="/User/User/apply" class="btn btn-block btn-danger" >提交申请</a>
	    <!--<?php if(($status != 1) ): ?>-->
    <!--<?php endif; ?>-->
</div>
<!--隐藏域开始-->
<input type="hidden" class="HD_PAGE_4CB265985D9B4F7FEDC9428A3983D283" value="0">
<input type="hidden" class="HD_SIZE_4CB265985D9B4F7FEDC9428A3983D283" value="20">
<input type="hidden" class="HD_COUNT_4CB265985D9B4F7FEDC9428A3983D283" value="3">
<!--隐藏域结束-->
<script type="text/javascript">
    var pck = {
        title: "会员申请列表",
        page: 0,
        size: 0,
        count: 0,
        //加载页面
        init: function () {
            this.page = mtopt.parse.toInteger(m.node(".HD_PAGE_4CB265985D9B4F7FEDC9428A3983D283").value());
            this.size = mtopt.parse.toInteger(m.node(".HD_SIZE_4CB265985D9B4F7FEDC9428A3983D283").value());
            this.count = mtopt.parse.toInteger(m.node(".HD_COUNT_4CB265985D9B4F7FEDC9428A3983D283").value());
        }
    }
    pck.init();
</script>
</div>
</body>
</html>