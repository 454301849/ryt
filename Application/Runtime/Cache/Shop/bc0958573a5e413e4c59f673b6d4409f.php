<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta name="baidu-site-verification" content="t7oDT96Amk">
    <title>
      收货地址
    </title>
    <script src="/Public/shop/js/jquery.min.js"></script>
    <script src="/Public/layer-mobile/layer.js"></script>
    <!--  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/weui.min.css">
   <script src="/Public/admin/js/jquery-1.11.3.min.js"></script>
 <link rel="stylesheet" href="/Public/layer-mobile/need/layer.css">
  </head>
  
  <body style="background:#efedf1">
    <div class="container-fulid" style="background:;padding-bottom:20px;">
      <div class="bd">
        <div class="weui_panel weui_panel_access" style="background:#;">
          <div class="weui_panel_hd" style="color:#555">
            选择收货地址[<span style="color:#f00;">☆为默认地址</span>]
            <a href="/Shop/Address/create"><span style="float:right;color:#555;">新增地址</span></a>
          </div>
          <?php if(is_array($address_info)): $kk = 0; $__LIST__ = $address_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><div class="weui_panel_hd" style="color:#555">
           <a href="/Shop/Index/categrey?id=<?php echo ($vv["address_id"]); ?>;location.reload() ">
              <p class="cart_g_name" style="word-wrap: break-word;word-break: normal;margin:10px  20px;">
               <?php echo ($kk); ?>  <?php echo ($vv["address"]); ?>  <?php echo ($vv["username"]); ?> <?php if($vv['state'] == 1): ?><span style="color:#f00;">☆</span><?php endif; ?><a href="/Shop/Address/update?id=<?php echo ($vv["address_id"]); ?>"  style="float:right;color:#555;">修改</a>
              </p>
            </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>  
        </div>
      </div>
    </div>
    <!-- <i class="icon-spinner icon-spin"></i> Spinner icon when loading content... -->
  </body>
  <script>
  $(document).ready(function() {
	  /*location.reload();
      exit;*/
  });
  </script>

</html>