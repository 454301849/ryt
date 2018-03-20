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
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/Deal/classify" data-external-page="true" tabindex="0" style="">
    <style type="text/css">
        .list-group-item .glyphicon{color:#666;margin-right:8px;}
    </style>

<div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a href="/User/Deal/lists" class="btn btn-default">列表</a>
    </div>
    <div class="btn-group" role="group">
        <a href="/User/Deal/classify" class="btn btn-danger">筛选</a>
    </div>
</div>
<div id="type_group_3DE195FA4A9E9D74E39339A068D6D62E" class="list-group" style="margin-top:12px;">
    <a onclick="pck.setType(this, -1)" class="list-group-item"><span class="glyphicon glyphicon-th-list"></span>不限分类</a>
        <a onclick="pck.setType(this, 5)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>分享奖</a>
        <a onclick="pck.setType(this, 6)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>见点奖</a>
        <a onclick="pck.setType(this, 3)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>领导奖</a>
		<a onclick="pck.setType(this, 7)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>区域管理奖</a>
		 <a onclick="pck.setType(this, 8)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>推荐奖</a>
	    <!--<a onclick="pck.setType(this, 5)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>回本奖</a>
        <a onclick="pck.setType(this, 8)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>报单奖</a>-->

</div>
<!--<div id="state_group_3DE195FA4A9E9D74E39339A068D6D62E" class="list-group">-->
    <!--<a onclick="pck.setState(this, -1)" class="list-group-item"><span class="glyphicon glyphicon-th-list"></span>不限分类</a>-->
        <!--<a onclick="pck.setState(this, 1)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>完成</a>-->
        <!--<a onclick="pck.setState(this, 2)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>待结算</a>-->
        <!--<a onclick="pck.setState(this, 3)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>待处理</a>-->
        <!--<a onclick="pck.setState(this, 4)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>取消</a>-->
        <!--<a onclick="pck.setState(this, 5)" class="list-group-item"><span class="glyphicon glyphicon-triangle-right"></span>失败</a>-->
<!--</div>-->
<div class="btn-group btn-group-justified" role="group" aria-label="...">
    <div class="btn-group" role="group">
        <a id="btn_enter" class="btn btn-default btn-danger">确定筛选</a>
    </div>
    <div class="btn-group" role="group">
        <a id="btn_clear" class="btn btn-default">清空</a>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        title: "交易分类",
        state: -1,
        type: -1,
        //设置类型
        setType: function (elm, type) {
            m.node("a", elm.parentNode).removeClass("active");
            m.node(elm).addClass("active");
            pck.type = type;
        },
        //设置状态
        setState: function (elm, state) {
            m.node("a", elm.parentNode).removeClass("active");
            m.node(elm).addClass("active");
            pck.state = state;
        },
        //重新搜索
        search: function () {
            $.mobile.changePage('/User/Deal/lists?type=' + pck.type, { transition: "slidefade" });
//            $.mobile.changePage('/Deal/list?state=' + pck.state + "&type=" + pck.type, { transition: "slidefade" });
        },
        //清空选择
        clear: function () {
            pck.pricemin = 0;
            pck.pricemax = 999999;
            pck.classify = -1;
            m.node("#type_group_3DE195FA4A9E9D74E39339A068D6D62E a").removeClass("active");
            m.node("#state_group_3DE195FA4A9E9D74E39339A068D6D62E a").removeClass("active");
        },
        //加载页面
        init: function () {
        }
    }
    pck.init();
    $(function () {
        m.node("#btn_enter").click(pck.search);
        m.node("#btn_clear").click(pck.clear);
    });
</script>

</div>
</body>
</html>