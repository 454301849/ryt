<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0030)//classify.html -->
<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>
      直销商城
    </title>
    <link rel="stylesheet" href="/Public/shop/css/3c30a65871.layout.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/footer.css">
    <script>
      __STAT.add('head_load');
    </script>
    <script src="/Public/shop/css/562a4c0e89.jquery-2.1.0.min.js">
    </script>
  </head>
  
  <body class=" hAndroid hPC">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
wx.config({
	debug: false,
	appId: '<?php echo $signPackage["appId"];?>',
	timestamp: <?php echo $signPackage["timestamp"];?>,
	nonceStr: '<?php echo $signPackage["nonceStr"];?>',
	signature: '<?php echo $signPackage["signature"];?>',
	jsApiList: [
		// 所有要调用的 API 都要加到这个列表中
		'checkJsApi',
		'addCard',
		'chooseCard',
		'openCard',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'showOptionMenu',
		'showAllNonBaseMenuItem',
		//'hideMenuItems',
		'hideAllNonBaseMenuItem',
		'menuItem:profile'
	  ]
});
wx.ready(function(){
	if('<?php echo ($_SESSION['user_info']['agent']); ?>' > '0'){
		wx.showAllNonBaseMenuItem();
	}else{
		wx.hideAllNonBaseMenuItem();
	}
	wx.onMenuShareTimeline({
		title: "<?php echo ($app_info[0]['wxname']); ?>商城--来自<?php echo ($_SESSION['user_info']['nickname']); ?>的分享", // 分享标题
		link: "<?php echo ($share_url); echo U('/Shop/Index/index');?>", // 分享链接
		imgUrl: '<?php echo ($_SESSION['user_info']['headimgurl']); ?>', // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
	});
	wx.onMenuShareAppMessage({
		title: "<?php echo ($app_info[0]['wxname']); ?>商城", // 分享标题
		desc: '来自<?php echo ($_SESSION['user_info']['nickname']); ?>的分享', // 分享描述
		link: "<?php echo ($share_url); echo U('/Shop/Index/index');?>?from_id=<?php echo ($_SESSION['user_info']['user_id']); ?>", // 分享链接
		imgUrl: '<?php echo ($_SESSION['user_info']['headimgurl']); ?>', // 分享图标
		type: '', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
			// 用户确认分享后执行的回调函数
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
	});
});
</script>
    <!-- 地理位置 -->
    <script>
      var downloadAppConfig = {
        cls: 'KexSirug',
        url: '//service-download.html',
        page: 'classify'
      }
    </script>
    <header id="header" class="u-header clearfix">
      <div class="u-hd-left f-left">
        <a href="javascript:void(0)" onclick="history.go(-1);" class="J_backToPrev">
          <span class="u-icon i-hd-back">
          </span>
        </a>
      </div>
      <span class="u-hd-tit">
        商品分类
      </span>
      <div class="u-hd-right f-right">
        <a href="<?php echo U('index');?>" mars_sead="nav_home_btn">
          <span class="u-icon i-hd-home">
          </span>
        </a>
      </div>
    </header>
    <ul class="search_category_list">
      <?php if(is_array($categrey)): $i = 0; $__LIST__ = $categrey;if( count($__LIST__)==0 ) : echo "无商品分类" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li>
          <div class="hd">
            <h2 style="color:#007d43;">
              <?php echo ($vv["cate_name"]); ?>
            </h2>
          </div>
          <div class="bd">
            <ul class="sub_category_list clearfix">
              <?php if(is_array($vv['arr'])): $i = 0; $__LIST__ = $vv['arr'];if( count($__LIST__)==0 ) : echo "暂无下级分类" ;else: foreach($__LIST__ as $key=>$kk): $mod = ($i % 2 );++$i;?><li>
                  <a href="<?php echo U('search');?>?pid=<?php echo ($kk["cate_id"]); ?>" mars_sead="classify-19626-19627_btn">
                    <div class="pic">
                      <img src="/<?php echo ($kk["pic_url"]); ?>" alt="">
                    </div>
                    <p class="name">
                      <?php echo ($kk["cate_name"]); ?>
                    </p>
                  </a>
                </li><?php endforeach; endif; else: echo "无商品分类" ;endif; ?>
            </ul>
          </div>
        </li><?php endforeach; endif; else: echo "暂无下级分类" ;endif; ?>
    </ul>
    <!--以下是底部样式-->
    <div style="display: block;" class="footer_bar openwebview">
      <ul class="warp clearfix">
        <li>
          <!--<li class="on">-->
          <a href="<?php echo U('index');?>" page_click_button="底部_首页">
            <i class="new_icon">
            </i>
            <span>
              首页
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo U('catelist');?>" page_click_button="底部_品牌">
            <i class="new_icon">
            </i>
            <span>
              分类
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo U('/User/center');?>" data-url="" page_click_button="底部_我的" class="to_personalcenter personalcenternum">
            <i class="new_icon">
              <strong style="display: none;">
              </strong>
            </i>
            <span>
              我的
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo U('categrey');?>" data-url="" page_click_button="底部_购物车" class="new_car_center">
            <i class="new_icon">
              <strong <?php if($num == 0): ?>style="display:none"<?php endif; ?>
                ><?php echo ($num); ?>
              </strong>
            </i>
            <span>
              购物车
            </span>
          </a>
        </li>
      </ul>
    </div>
    <a href="" class="u-backtop" mars_sead="home_foot_top_btn">
    </a>
    <!--以下是浮于显示屏左下角的购物袋-->
    <script src="/Public/shop/css/c6d4147a04.page.classify.top.min.js">
    </script>
  </body>

</html>