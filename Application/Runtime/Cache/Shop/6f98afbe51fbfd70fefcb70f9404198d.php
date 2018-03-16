<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<title>直销商城</title>
<script src="/Public/shop/css/alog.mobile.min.js"></script>
<link rel="stylesheet" href="/Public/css/weui.min.css">
<link rel="stylesheet" href="/Public/shop/css/3c30a65871.layout.min.css">
<link rel="stylesheet" href="/Public/shop/css/86fe49ca90.common.min.css">
<link rel="stylesheet" type="text/css" href="/Public/shop/css/footer.css">
</head>
<body class=" hAndroid hPC" style="padding-bottom: 45px;">
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

<script src="/Public/shop/css/562a4c0e89.jquery-2.1.0.min.js"></script>
<!--首页幻灯js-->
<script type="text/javascript" src="/Public/shop/css/zepto.js"></script>
<script type="text/javascript" src="/Public/shop/css/swipe.js"></script>
<!--首页幻灯js end-->
<!--加入购物车动画效果-->
<style>
.addcategrey{width:100%;position:fixed;top:0px;z-index:2;text-align:center;display:none;}
.catemove{
	-webkit-animation:mymove 1s 1 forwards;
	}
@-webkit-keyframes mymove
	{
	from {top:0px;width:100%;}
	to {top:100%;width:10%;left:10%;}
	}
</style>
<div id="catemove" class="addcategrey">
	<img src="/<?php echo ($pic_url[0]['pic_url']); ?>" width="80%">
</div>
<header id="header" class="u-header clearfix">
	<div class="u-hd-left f-left">
		<a href="javascript:void(0)" onclick="history.go(-1);" mars_sead="brand-detail-back_btn" class="J_backToPrev"><span class="u-icon i-hd-back"></span></a>
	</div>
	<div class="u-hd-tit"><span><?php echo ($good_info["good_name"]); ?></span></div>
	<div class="u-hd-right f-right"><a href="<?php echo U('index');?>" mars_sead="nav_home_btn"><span class="u-icon i-hd-home"></span></a></div>
</header>
	
<div class="space10"></div>
<!--产品详细页的图片及介绍-->
<div class="container goods_detail_wrapper">
  <div id="goods_detail" class="aposition">
	<div class="banner openwebview" >
	    <div style="-webkit-transform:translate3d(0,0,0);">
		<div id="banner_box" class="box_swipe">
			<ul style="list-style: none outside none; transition-duration: 500ms;">
				<?php if(is_array($pic_url)): $k = 0; $__LIST__ = $pic_url;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li>
					<a onClick="return false;">
						<img src="/<?php echo ($v["pic_url"]); ?>" alt="2" style="width:100%;">
					</a>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>   
			</ul>
		</div>
		</div>
		<script>
		$(function(){
			new Swipe(document.getElementById('banner_box'), {
				speed:300,
				auto:3000,
				callback: function(){
					var lis = $(this.element).next("ol").children();
					lis.removeClass("on").eq(this.index).addClass("on");
				}
			});
		});
		</script>
	</div>
    <div class="goods_info">
        <h1><?php echo ($good_info["good_name"]); ?></h1>
         <p class="new_pricediv clearfix">
		<span class="g_d_price">¥<?php echo ($good_info["good_price"]); ?></span>
        <span class="fontstyle prf05">¥<?php echo ($good_info["market_price"]); ?></span>
        <span class="discount"><?php echo round($good_info['good_price']/$good_info['market_price'],2);?>折</span>     
        </p>
		<p class="space5"></p>
        <p class="clear"></p>
        <div class="dashline3"></div>
        
    </div>
  </div>
  <!---点击按钮加载更多 <a href="javascript:;" data-getdetail="more" data-merchandise="normal" class="up_more" style="display: none;"><span class="icon_up_more"></span><p>上拉加载更多商品详情哦</p></a> -->


  <!-- 详情 -->
  <div class="product_detail"><!-- data-GetDetail="more"-->
    <div class="tab_content pro_detail_info">
		<div class="M_detail" style="width:1000px">
			<div class="M_detailCon">
				
				<p class="dc_tit" id="J_proParam_scroll">商品详情<i class="far">Detail</i></p>
				<?php echo ($good_info["good_desc"]); ?>
				<div class="dc_info clearfix"></div>
			</div>
		</div>
	</div>
	<div class="space10"></div>
  </div>


</div>
<div class="space10"></div>
<!--固定在页面底部浮动的购买按钮-->
<div class="navbar navbar-default navbar-fixed-bottom">
  <div class="container nav-current-box detail-box">
    <!--<div class="navbar-header">
      <a href="//cart.html?rbc=service">
        <i class="num-cart hide"></i>
        <i class="i-icon-cart-black"></i>
        <i class="num-cunt" data-carttime="-1" data-ctime="true"></i>
      </a>
    </div>-->

    <div class="navbar-brand" style="width:100%;">
	        <a class="btn btn-large btn-purple" style="width:30%" id="addcategrey">加入购物车</a>
            <a class="btn btn-large btn-purple" style="width:30%" id="buynow">立即购买</a>
     </div>
  </div>
</div>


<!--以下是底部样式-->
      <a href="" class="u-backtop" mars_sead="home_foot_top_btn" style="right: 10px; bottom: 68px;"></a>
    <!--以下是浮于显示屏左下角的购物袋-->
  
<div class="u-shopbag" data-shopcart="true">
<a mars_sead="floating-cart_btn" href="<?php echo U('categrey');?>">
<span class="u-icon i-flow-carticon"></span>
<span class="u-flow-cartnum" id="cate_num" <?php if($num == 0 ): ?>style="display:none"<?php endif; ?> ><?php echo ($num); ?></span>
<span class="u-flow-carttime hide"></span>
</a>
</div>



<!--<script src="/Public/shop/css/e76e972aa6.all.min.js"></script>-->
<script src="/Public/layer-mobile/layer.js"></script>
<script type="text/javascript">
var good_id = "<?php echo ($good_info["good_id"]); ?>";
var isLogin     = 0;
var cartSource = '';
var isSoldout = parseInt('0'), isStockUpdate = true;
function saveProValue(){
	return {product_id: '42992701',brand_id: '327514', filterSize: '0', is_old: '0'}
};
$('#addcategrey').click(function(){
$(this).css('background','#999');
	$.ajax({
		type:"POST",
		url:"<?php echo U('addcategrey');?>",
		dataType:"json",
		data:{'good_id':good_id},
		success:function(json){
			if(json.success == 1){
				$('#catemove').css("display",'block');
				$('#catemove').addClass("catemove");
				//增加购物车数字
				var num = $('#cate_num').text();
				var newnum = num*1 + 1*1;
				$('#cate_num').css("display","block");
				$('#cate_num').text(newnum);
				
			}else{
				layer.open({content: '发生通信错误，请稍候重试', time: 3});
			}
			setTimeout(function(){$('#catemove').css("display",'none');$('#catemove').removeClass("catemove");$('#addcategrey').css('background','');},1000);
		},
		error:function(){
			layer.open({content: '发生通信错误，请稍候重试', time: 3});
		}
	});
	
});
$('#buynow').click(function(){
	$(this).text("正在前往");
	$(this).attr("id",'');
	$(this).css("background",'#999');
	$.ajax({
		type:"POST",
		url:"<?php echo U('addcategrey');?>",
		dataType:"json",
		data:{'good_id':good_id},
		success:function(json){
			if(json.success == 1){
				location.href="<?php echo U('categrey');?>";
			}else{
				layer.open({content: '发生通信错误，请稍候重试', time: 3});
			}
			
		},
		error:function(){
			layer.open({content: '发生通信错误，请稍候重试', time: 3});
		}
	});
});
</script>

<script src="/Public/shop/css/7fae035d74.swipe.min.js"></script>
<script src="/Public/shop/css/f9ed050a6c.page.item.index.min.js"></script>



</body></html>