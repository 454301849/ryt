<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>直销商城</title>
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/public.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/home.css">
	<link rel="stylesheet" type="text/css" href="/Public/shop/css/footer.css">
	
	
	<link rel="stylesheet" type="text/css" href="/Public/shop/css/reset.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/common1.css" media="all">
<style>.recommend .caption_life:after {background-color: #ff6666;}</style>
<!--首页幻灯js-->
<script type="text/javascript" src="/Public/shop/css/zepto.js"></script>
<script type="text/javascript" src="/Public/shop/css/swipe.js"></script>
<!--首页幻灯js end-->
</head>
<body><script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
	<div style="overflow:hidden;">
       <div class="searchnew" id="searchContainer" style="width:100%;padding:10px 0;">
			<div class="products-search-item" style="margin-top:0;">
				<div class="main-nav-search ">
				<form action="/Shop/Index/search.html?gid=2" method="post">
					<div class="input-group">
						<input autocomplete="off" id="input-main-nav-search" class="form-control" name="keyword" value="<?php echo ($keyword); ?>" style="width:98%;" title="产品搜索" placeholder="产品搜索" type="search">
						<span class="input-group-btn"><button class="btn5 submit" type="submit" id="btnSearch"><i class="search-icon"></i></button></span>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	
    
    <div class="recommend openwebview">
<div class="wrap">
	
	
	
	<div class="item" page_click_button="">
		<div class="caption">
			<h3 class="caption_life"><a href="">您要查看的商品是</a></h3>
			<!-- <span class="browse">(3.6万人正在浏览)</span> -->
		</div>
		
		<div class="item_con clearfix" page_click_button="单品">
			<?php if(is_array($good_list)): $i = 0; $__LIST__ = $good_list;if( count($__LIST__)==0 ) : echo "未找到您查找的商品" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><dl style="margin-bottom:10px;">
			<dt>
			<a href="<?php echo U(good);?>?good_id=<?php echo ($k["good_id"]); ?>" data-url="">
			<img class="fadeInImg" _src="" src="/<?php echo ($k["pic_url"]); ?>">
			<?php if($k['best'] == 1 ): ?><span class="special">精品</span>
			<?php else: ?>
			<?php if($k['hot'] == 1 ): ?><span class="special">热销</span>
			<?php else: ?>
			<?php if($k['new'] == 1 ): ?><span class="special">新品</span><?php endif; endif; endif; ?>
			
			</a>
			</dt>
			<dd>
			<p class="txt"><?php echo ($k["good_name"]); ?></p>
			<div class="price clearfix">
			<span class="now_price"><i>￥</i><em><?php echo ($k["good_price"]); ?></em></span>
			<span class="old_price"><i>￥</i><em><?php echo ($k["market_price"]); ?></em></span>
			</div>
			</dd>
			</dl><?php endforeach; endif; else: echo "未找到您查找的商品" ;endif; ?>
		</div>
		
	</div>

</div>
    </div>
	
    <div style="display: block;" class="footer_bar openwebview">
        <ul class="warp clearfix">
            <li><!--<li class="on">-->
                <a href="<?php echo U('index');?>" page_click_button="底部_首页">
                    <i class="new_icon"></i>
                    <span>首页</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('catelist');?>" page_click_button="底部_品牌">
                    <i class="new_icon"></i>
                    <span>分类</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('/User/center');?>" data-url="" page_click_button="底部_我的" class="to_personalcenter personalcenternum">
                    <i class="new_icon"><strong style="display: none;"></strong></i>
                    <span>我的</span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('categrey');?>" data-url="" page_click_button="底部_购物车" class="new_car_center">
                  <i class="new_icon"><strong <?php if($num == 0): ?>style="display:none"<?php endif; ?> ><?php echo ($num); ?></strong></i>
                    <span>购物车</span>
                </a>
            </li>
        </ul>
    </div>



</body>

</html>