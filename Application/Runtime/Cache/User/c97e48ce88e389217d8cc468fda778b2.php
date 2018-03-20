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
<div class="mn-content ui-page ui-page-theme-a ui-page-active" data-role="page" data-url="/User/Product/orderdetail?id=<?php echo ($info["order_id"]); ?>" data-external-page="true" tabindex="0" style="min-height: 510.2px;">
    <style type="text/css">
        .list-group-item{position:relative;}
        .list-group-item-icon{height:auto;position:absolute;width:65px;left:2px;top:2px;}
        .list-group-item-div{margin-left:15%;}
    </style>
<?php $kuaidi = array( 'ems'=>'邮政', 'huitongkuaidi'=>'百世汇通', 'youzhengguonei'=>'包裹/平邮/挂号信', 'debangwuliu'=>'德邦物流', 'huitongkuaidi'=>'汇通快运', 'guotongkuaidi'=>'国通快递', 'jiajiwuliu'=>'佳吉物流', 'shunfeng'=>'顺丰', 'shenghuiwuliu'=>'盛辉物流', 'tiantian'=>'天天快递', 'yuantong'=>'圆通速递', 'yunda'=>'韵达快运', 'zhongtong'=>'中通速递', 'zhaijisong'=>'宅急送', ); ?>
<div class="list-group" style="margin-top:6px;">
    <a class="list-group-item">订单号：<?php echo ($info["order_sn"]); ?></a>
   <!-- <a class="list-group-item">交易号：<?php echo ($info["prepay_id"]); ?></a>-->
    <a class="list-group-item">状态：
	<?php if(($info["state"] == 2) ): ?>已收货
<?php elseif(($info["state"] == 1)): ?>已发货
<?php else: ?> 等待发货<?php endif; ?></a>
    <a class="list-group-item">快递公司：<?php if(($info["state"] > 0) ): echo ($kuaidi[$info['serve_name']]); ?>
	<?php else: ?>-<?php endif; ?></a>
    <a class="list-group-item">快递单号：<?php if(($info["state"] > 0) ): echo ($info["serve_id"]); else: ?>-<?php endif; ?></a>
    <a class="list-group-item">总价：<?php echo ($info["total_fee"]); ?></a>
    <a class="list-group-item">创建时间：<?php echo (date('Y-m-d H:i:s',$info["time"])); ?></a>
    <a class="list-group-item">变更时间：<?php echo (date('Y-m-d H:i:s',$info["pay_time"])); ?></a>
</div>
<div class="panel panel-default">
    <div class="panel-heading">说明</div>
    <div class="panel-body">
        
    </div>
</div>
   <?php if(is_array($detail)): $kk = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><div class="list-group">
        <a href="" class="list-group-item" data-transition="pop">
            <img class="list-group-item-icon" alt="" src="/<?php echo ($vv["pic_url"]); ?>">
            <div class="list-group-item-div" >
                <h4 class="list-group-item-heading"><?php echo ($vv["good_name"]); ?></h4>
                <p class="list-group-item-text">
                    价格：<?php echo ($vv["good_price"]); ?>
                    &nbsp;&nbsp;&nbsp;
                    数量：<?php echo ($vv["good_num"]); ?>
            </p>
            </div>
        </a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if(($info["state"] == 1) ): ?><input type="hidden" id="order_id" value="<?php echo ($info["order_sn"]); ?>"/>
<a id="btn_enter_"  class="btn btn-default btn-block" type="button">确认收货</a><?php endif; ?>
<a href="/User/Product/order" class="btn btn-default btn-block" type="button">返回列表</a>
<script type="text/javascript">

	    var pck = {
        
        submit: function () {

			$("#btn_enter_").hide()
            var order_id = m.node("#order_id").value();

            if (order_id.length <= 0) {
                engine.news("支付订单有误", 1800);
                return;
            }

            //提交购买请求
			 engine.news("正在提交...", 999999);
            var ajax = m.ajax("/User/Product/api_confirm_recipient", null, function (obj) {
                var json = m.parse.toJson(obj);
                if (json.Success) {
                    engine.news("已收货", 2000);
					location.reload();
					return false;
                }
                else { engine.news(json.Data, 2000); }
            });
            ajax.data.add("order_id", order_id);
            ajax.send();
        },
        init: function () {

        }
    }
    pck.init();
    //载入时
    $(function () {
        m.node("#btn_enter_").click(pck.submit);
    });
</script>

</div>
</body>
</html>