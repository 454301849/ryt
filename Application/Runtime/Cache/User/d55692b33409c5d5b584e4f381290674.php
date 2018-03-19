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
        .pg-head{height:12em;background:url(/Public/images/head.jpg);background-size:cover;color:#fff;position:relative;overflow:hidden;margin:0px -1em;margin-top:-0.6em;}
        .pg-head-icon{width:6em;height:6em;position:absolute;left:1.8em;top:1em;border-radius:6em !important;border:3px solid #fff;}
        .pg-head-info{position:absolute;left:9em;top:1em;text-shadow: 0 0 3px #333;}
        .pg-head-info h5{margin:0px;padding:0px;}
        .pg-head-info div{font-size:0.95em;margin-bottom:0.5em;}

        .pg-head-menu{list-style:none;position:absolute;margin:0px;padding:0px;bottom:0px;left:0px;width:100%;background:rgba(0,0,0,0.38);height:3.3em;}
        .pg-head-menu li{margin-left:1%;text-align:center;font-size:0.9em;float:left;width:24%;border-left:1px solid #555;height:2.7em;margin-top:0.4em;font-weight:bold;}
        .pg-head-menu li div{margin-top:0.2em;font-size:0.9em;}
        .pg-head-menu li:first-child{border-left:0px none;}

        .pg-menu{margin:0;margin-top:1.5em;padding:0;list-style:none}
        .pg-menu li{float:left;margin-bottom:1em;width:25%;text-align:center}
        .pg-menu li a{position:relative;display:inline-block;width:2.8em;height:2.8em;border-radius:1.4em}
        .pg-menu li a img{position:absolute;top:.7em;left:.7em;width:1.4em;height:1.4em}
        .pg-menu li p{margin-top:.5em;color:#666;font-size:0.9em;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
    </style>
	<script type="text/javascript" src="/Public/js/jquery.mobile.custom.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/Public/js/engine.js" ></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top mn-navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-close glyphicon glyphicon-log-out" data-ajax="false" href="/User/Center/api_cancel" style="color:#fff !important;border:0px none"></a>
            <img style="width:35px;height:35px;margin-right:6px;position:absolute;left:10px;top:10px" src="/Public/images/wap_logo.png" />
            <a class="navbar-brand"  style="position:absolute;top:3px;margin-left:32px;font-size:1.3em;">移动结算系统</a>
        </div>
    </div>
</nav>
<!--标题样式-->
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/Product/order" data-external-page="true" tabindex="0" style="min-height: 510.2px;">
    <style type="text/css">
        .pg-form input,
        .pg-form select{margin-bottom:1em;margin-top:1em;}
    </style>

<div class="pg-form">
    <table class="table table-hover table-condensed">
        <tbody><tr>
            <td>单号</td>
            <td>状态</td>
            <td>总额</td>
            <td>操作</td>
        </tr>
            <?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
                <td><?php echo ($vv["order_sn"]); ?></td>


                <td>
				<!--<?php if(($vv["state"] == 2) ): ?>已发货<?php else: ?>等待发货<?php endif; ?>-->
				<?php if(($vv["state"] == 1) OR ($name > 100) ): ?>已发货
				 <?php elseif($vv["state"] == 2): ?>已收货
				 <?php else: ?> 等待发货<?php endif; ?>
				</td>


                <td><?php echo ($vv["total_fee"]); ?></td>
                <td>
                    <a class="btn btn-danger btn-xs" href="/User/Product/orderdetail?id=<?php echo ($vv["order_id"]); ?>">详情</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody></table>
    <ul class="pager">
            <?php echo ($page); ?>
    </ul>
</div>
<!--隐藏域开始-->
<input type="hidden" class="HD_PAGE_E0467FB7C928E85F78096D5F04DC22E9" value="0">
<input type="hidden" class="HD_SIZE_E0467FB7C928E85F78096D5F04DC22E9" value="20">
<input type="hidden" class="HD_COUNT_E0467FB7C928E85F78096D5F04DC22E9" value="7">
<input type="hidden" class="HD_STATE_E0467FB7C928E85F78096D5F04DC22E9" value="0">
<!--隐藏域结束-->
<script type="text/javascript">
    var pck = {
        title: "订单管理",
        page: 0,
        size: 0,
        count: 0,
        state: 0,
        //确认收货
        receiving: function (elm, orderid) {
            var ajax = m.ajax("/Product/api_order_receiving", null, function (jso) {
                var jso = m.json.getObject(jso);
                switch (jso.Error) {
                    case 0:
                        engine.news("确认收货成功", 1800);
                        m.node(elm).remove();
                        break;
                    case -10000:
                        engine.news("确认失败", 1800);
                        break;
                    default:
                        engine.news(jso.Error, 2000);
                        break;
                }
            });
            ajax.data.add("orderid", orderid);
            ajax.send();
        },
        //加载页面
        init: function () {
            this.page = mtopt.parse.toInteger(m.node(".HD_PAGE_E0467FB7C928E85F78096D5F04DC22E9").value());
            this.size = mtopt.parse.toInteger(m.node(".HD_SIZE_E0467FB7C928E85F78096D5F04DC22E9").value());
            this.count = mtopt.parse.toInteger(m.node(".HD_COUNT_E0467FB7C928E85F78096D5F04DC22E9").value());
            this.state = mtopt.parse.toInteger(m.node(".HD_STATE_E0467FB7C928E85F78096D5F04DC22E9").value());
        }
    }
    pck.init();
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
</body>
</html>