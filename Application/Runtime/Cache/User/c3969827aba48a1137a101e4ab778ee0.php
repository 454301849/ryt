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
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/User/apply" data-external-page="true" tabindex="0">
    <style type="text/css">
        .pg-form input,
        .pg-form select,
        .pg-form textarea {
            margin-bottom: 1em;
            margin-top: 1em;
        }
    </style>

<div class="pg-form">
    <label class="control-label">我要提交申请</label>
    <select id="type_" class="form-control">
	<option value="1">品荐店</option>
	<option value="2">旗舰店</option>
	</select>
    <label class="control-label">标题</label>
    <input id="title_" type="text" class="form-control" placeholder="标题">
    <label class="control-label">内容</label>
    <textarea id="content_" class="form-control" placeholder="内容" style="height:150px;"></textarea>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a id="btn_enter_" data-transition="pop" class="btn btn-default btn-danger">提交</a>
        </div>
        <div class="btn-group" role="group">
            <a href="/User/User/applylists" class="btn btn-default">返回列表</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        title: "我要提交申请",
        submit: function () {
            var type = m.node("#type_").value();
            var title = m.node("#title_").value();
            var content = m.node("#content_").value();
            if (type <= 0) {
                engine.news("请选择申请类型", 1800);
                return;
            }
            if (title.length <= 0) {
                engine.news("请输入标题", 1800);
                return;
            }
            if (content.length <= 0) {
                engine.news("请输入内容", 1800);
                return;
            }
            engine.news("正在提交...", 999999);
            //发送请求
            var ajax = m.ajax("/User/User/api_apply_submit", null, function (jso) {
                var jso = m.json.getObject(jso);
                switch (jso.Error) {
                    case '0':
                        engine.news("提交申请成功正在跳转...", 99999);
                        setTimeout(function () {
                            $.mobile.changePage("/User/User/applylists", { transition: "slidefade" });
                        });
                        break;
                    case -10000:
                        engine.news("提交申请失败", 1800);
                        break;
                    default:
                        engine.news(jso.Data, 2000);
                        break;
                }
            });
            ajax.data.add("type", type);
            ajax.data.add("title", ResChinese(title));
            ajax.data.add("content", ResChinese(content));
            ajax.send();
        },
        init: function () { }
        
    }
    pck.init();
    $(function(){
    	m.node("#btn_enter_").click(pck.submit);
    });

    function ResChinese(obj)
    {
       return encodeURI(obj);
    }
</script>
</div>
</body>
</html>