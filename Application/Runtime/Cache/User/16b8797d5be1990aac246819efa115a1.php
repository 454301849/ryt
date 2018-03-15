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
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/Deal/convertinside" data-external-page="true" tabindex="0">
    <style type="text/css">
        .pg-form input,
        .pg-form select {
            margin-bottom: 1em;
            margin-top: 1em;
        }
    </style>

<div class="list-group" style="margin-top:6px;">
    <a class="list-group-item">会员编号：<?php echo ($user_info["user_name"]); ?></a>
    <a class="list-group-item">奖金积分：<?php echo ($user_info["jjb"]); ?></a>
    <a class="list-group-item">购物积分：<?php echo ($user_info["gwb"]); ?></a>
    <a class="list-group-item">转换比例：100%</a>
    <a class="list-group-item">可转数量：<?php echo ($user_info["jjb"]); ?></a>
</div>
<div class="pg-form">
    <label class="control-label">转换金额</label>
    <input id="number_" type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" placeholder="转换金额">
    <label class="control-label">二级密码</label>
    <input id="safeword_" type="password" class="form-control" placeholder="二级密码">

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a id="btn_enter_" data-transition="pop" class="btn btn-default btn-danger">确认转换</a>
        </div>
        <div class="btn-group" role="group">
            <a href="/User/Deal/convert" class="btn btn-default">返回</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        title: "奖金币转换注册币",
        submit: function () {
            var safeword = m.node("#safeword_").value();
            var number = m.node("#number_").value();
            //非空判断
            if (number.length <= 0) {
                engine.news("请输入转换数量", 1800);
                return;
            }
            if (safeword.length <= 0) {
                engine.news("请输入二级密码", 1800);
                return;
            }
            engine.news("正在提交...", 999999);
            //发送请求
            var ajax = m.ajax("/User/Deal/api_convertinside_submit", null, function (jso) {
                var jso = m.json.getObject(jso);
                switch (jso.Error) {
                    case '0':
                    	engine.news("转换成功", 3000);
                        setTimeout(function () {
                            m.reload();
                        },1000);
                        break;
                    case -10002:
                        engine.news("转换失败", 1800);
                        break;
                    case -10001:
                        engine.news("验证码错误", 1800);
                        break;
                    default:
                        engine.news(jso.Data, 3000);
                        break;
                }
            });
            ajax.data.add("number", number);
            ajax.data.add("safeword", safeword);
            ajax.send();
        },
        //加载页面
        init: function () { }
    }
    pck.init();
    $(function () {
        m.node("#btn_enter_").click(pck.submit);
    });
</script>
</div>
</body>
</html>