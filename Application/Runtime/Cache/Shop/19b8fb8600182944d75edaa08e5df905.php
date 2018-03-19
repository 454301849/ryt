<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>订单支付</title>
	<link rel="stylesheet" href="/Public/css/weui.min.css">
	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap-switch.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.3.min.js" ></script>

	<style type="text/css">
		.panel-body{padding:10px;}
		.pg-form input,
		.pg-form select{margin-bottom:1em;margin-top:1em;}
	</style>
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
<body style="">
<div class="bd">
	<div class="weui_panel weui_panel_access">
		<div class="weui_panel_hd">订单商品详情</div>
		<div class="weui_panel_bd">
			<?php if(is_array($order_info)): $i = 0; $__LIST__ = $order_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" class="weui_media_box weui_media_appmsg" style="padding-top:5px;padding-bottom:5px;">
				<div class="weui_media_hd">
					<img class="weui_media_appmsg_thumb" src="/<?php echo ($vv["pic_url"]); ?>" alt="">
				</div>
				<div class="weui_media_bd">
					<h4 class="weui_media_title" style="font-size:16px;"><?php echo ($vv["good_name"]); ?></h4>
					<p class="weui_media_desc">商品数量：<?php echo ($vv["good_num"]); ?></p>
				</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<a class="weui_panel_ft" href="javascript:void(0);">订单总金额：￥<?php echo ($total_fee); ?>元</a>
		</div>
	</div>
	<br />
	<div class="pg-form" style="margin: 5px 5px;">
		<label class="control-label">安全密码</label>
		<input id="safeword_29A73021CFF703CD563AFDA73AE4E68E" type="password" class="form-control" placeholder="安全密码" />
	</div>
	<div class="list-group" style="margin: 5px 5px;">
		<a class="list-group-item">购物可用积分：<?php echo ($keyong); ?></a>
		<a class="list-group-item">购物不可用积分：<?php echo ($bukeyong); ?></a>
		</div>
		<input type="hidden" id="pay_id" value="<?php echo ($pay_id); ?>">
	<br />
	<?php if($keyong >= $total_fee): ?><div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
			<a id="btn_enter_8246F278BC097379F4E7F59601E5B040" class="weui_btn weui_btn_primary" style="width:80%;" data-transition="pop">立即付款</a>
		</div>

	</div>
	<?php else: ?>
	<a id="" class="weui_btn weui_btn_warn" style="width:80%;" data-transition="pop">购物币不足</a><?php endif; ?>
</div>
</body>

<script type="text/javascript">
    var pck = {

        //结算订单
        submit: function () {

            var safeword = m.node("#safeword_29A73021CFF703CD563AFDA73AE4E68E").value();
            var pay_id = m.node("#pay_id").value();

            if (safeword.length <= 0) {
                engine.news("请输入安全密码", 1800);
                return;
            }

            if (pay_id.length <= 0) {
                engine.news("支付订单有误", 1800);
                return;
            }

            //提交购买请求
            var ajax = m.ajax("/Shop/Index/api_report_submit", null, function (obj) {
                var json = m.parse.toJson(obj);
                if (json.Success) {
                    engine.news("购买成功正在跳转...", 99999);
                    setTimeout(function () {
                        window.location.href = "/User/Product/order";
//                        $.mobile.changePage("/User/Product/order","pop", false, false);
                    }, 1000);
                }
                else { engine.news(json.Data, 2000); }
            });
            ajax.data.add("safeword", safeword);
            ajax.data.add("pay_id", pay_id);
            ajax.send();
        },
        init: function () {

        }
    }
    pck.init();
    //载入时
    $(function () {
        m.node("#btn_enter_8246F278BC097379F4E7F59601E5B040").click(pck.submit);
    });
</script>
</html>