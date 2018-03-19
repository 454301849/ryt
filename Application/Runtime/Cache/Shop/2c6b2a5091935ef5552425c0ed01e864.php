<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>
      直销商城
    </title>
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/public.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/home.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/footer.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/reset.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/common1.css" media="all">
    <!--首页幻灯js-->
    <script type="text/javascript" src="/Public/js/jquery-3.2.0.min.js" ></script>
    <script type="text/javascript" src="/Public/shop/css/zepto.js"></script>
    <script type="text/javascript" src="/Public/shop/css/swipe.js"></script>

    <!--首页幻灯js end-->
  </head>

  <body>
    <!--<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
</script>-->
    <div style="position:fixed;z-index:999;width:100%;height:100%;background:rgba(0,0,0,0.6);display:none;"
    id="none">
    </div>
	<?php if($share_type == 'ok' ): ?><div style="position:fixed;z-index:999999;width:100%;height:100%;background:rgba(0,0,0,0.0);display:block;">
		<a href="<?php echo U('/User/Center/qr_show');?>?from_id=<?php echo ($share_id); ?>">
		<div style="background:rgba(0,0,0,0.8);font-size:16px;color:#fff;padding:5px 10px;">您好！未检测到您的微信信息，暂时无法购物，请点击这里噢~</div>
		</a>
    </div><?php endif; ?>
    <div style="overflow:hidden;">
      <div class="searchnew" id="searchContainer" style="width:100%;padding:10px 0;">
        <div class="products-search-item" style="margin-top:0;">
          <div class="main-nav-search ">
            <form action="<?php echo U('search');?>" method="post">
              <div class="input-group" style="z-index:1000;">
                <input autocomplete="off" id="input-main-nav-search" class="form-control"
                name="keyword" value="" style="width:98%;" title="产品搜索" placeholder="产品搜索：请输入商品关键字"
                type="search">
                <span class="input-group-btn">
                  <button class="btn5 submit" type="submit" id="btnSearch">
                    <i class="search-icon">
                    </i>
                  </button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="banner openwebview">
      <div style="-webkit-transform:translate3d(0,0,0);">
        <div id="banner_box" class="box_swipe">
          <ul style="list-style: none outside none; transition-duration: 500ms;">
            <?php if(is_array($bannar)): $i = 0; $__LIST__ = $bannar;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li>
                <a onClick="return false;">
                  <img src="/<?php echo ($vv["pic_url"]); ?>" alt="2" style="width:100%;">
                </a>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>

        </div>
      </div>
      <script>
        $(function() {
          new Swipe(document.getElementById('banner_box'), {
            speed: 500,
            auto: 3000,
            callback: function() {
              var lis = $(this.element).next("ol").children();
              lis.removeClass("on").eq(this.index).addClass("on");
            }
          });
          $('#input-main-nav-search').click(function() {
            $('#none').css('display', 'block');
          });
          $('#input-main-nav-search').blur(function() {
            $('#none').css('display', 'none');
          });
        });
      </script>
    </div>
    <div class="recommend openwebview">
        <div class="caption">
             <h3 class="caption_life pull-left">
                    商品展示
             </h3>
          </div>
      <div class="wrap">
        <!--广告-->
        <?php if(is_array($ad)): $i = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo ($v["link"]); ?>">
            <div style="padding:5px;background:#fff;">
              <img src="/<?php echo ($v["pic_url"]); ?>" width="100%">
            </div>
          </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </volist>
        <?php if(is_array($good_list)): $k1 = 0; $__LIST__ = $good_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k1 % 2 );++$k1; if($v['info'][0]['good_name'] != '' ): ?><style>
              .recommend .caption_life:after {background-color: #ff6666;}
            </style>
            <div class="item" page_click_button="">
              <a href="<?php echo U('search');?>?gid=<?php echo ($v["gid"]); ?>">
                <div class="caption font-color" style="border-bottom:4px solid #007d43;">
                  <h3 style="color:#007d43;">
                   <?php echo ($k1); ?>F  <?php echo ($v["name"]); ?>
                  </h3>
                  <span class="browse pull-right"  style="color:#007d43;">
                   更多
                  </span>
                </div>
              </a>
              <br/>
              <div class="item_con clearfix" page_click_button="单品">
                <?php if(is_array($v['info'])): $i = 0; $__LIST__ = $v['info'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><dl style="margin-bottom:10px;">
                    <dt>
                      <a href="<?php echo U(good);?>?good_id=<?php echo ($k["good_id"]); ?>" data-url="">
                        <img class="fadeInImg" _src="" src="/<?php echo ($k["pic_url"]); ?>">
                        <?php if($k['best'] == 1 ): ?><span class="special">
                            精品
                          </span>
                          <?php else: ?>
                          <?php if($k['hot'] == 1 ): ?><span class="special">
                              热销
                            </span>
                            <?php else: ?>
                            <?php if($k['new'] == 1 ): ?><span class="special">
                                新品
                              </span><?php endif; endif; endif; ?>
                      </a>
                    </dt>
                    <dd>
                      <p class="txt">
                        <?php echo ($k["good_name"]); ?>
                      </p>
                      <div class="price clearfix">
                        <span class="now_price">
                          <i>
                            ￥
                          </i>
                          <em>
                            <?php echo ($k["good_price"]); ?>
                          </em>
                        </span>
                        <span class="old_price">
                          <i>
                            ￥
                          </i>
                          <em>
                            <?php echo ($k["market_price"]); ?>
                          </em>
                        </span>
                      </div>
                    </dd>
                  </dl><?php endforeach; endif; else: echo "" ;endif; ?>
              </div>
            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
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
  </body>

</html>