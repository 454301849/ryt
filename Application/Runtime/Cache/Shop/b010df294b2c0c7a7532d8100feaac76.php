<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta name="baidu-site-verification" content="t7oDT96Amk">
    <title>
      直销商城
    </title>
    <link rel="stylesheet" href="/Public/shop/css/c3e09ac36d.css">
    <link rel="stylesheet" href="/Public/shop/css/86fe49ca90.css">
    <link rel="stylesheet" href="/Public/layer-mobile/need/layer.css">
    <link rel="stylesheet" type="text/css" href="/Public/shop/css/footer.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/weui.min.css">
    <style type="text/css">
      .u-footer{display:none;}
    </style>
  </head>
  
  <body style="padding-bottom:70px;">
    <header id="header" class="u-header clearfix">
      <div class="u-hd-left f-left">
        <a href="javascript:void(0)" onclick="history.go(-1);" mars_sead="brand-detail-back_btn"
        class="J_backToPrev">
          <span class="u-icon i-hd-back">
          </span>
        </a>
      </div>
      <span class="u-hd-tit">
        购物车
      </span>
      <div class="u-hd-right f-right">
        <a href="<?php echo U('index');?>" mars_sead="nav_home_btn">
          <span class="u-icon i-hd-home">
          </span>
        </a>
      </div>
    </header>
    <style>
      .aaa:hover{background:#f1f1f1}
    </style>
    <?php if($temp[0]['good_id'] == true ): ?><div id="cart_list">
        <!--特卖会订单-->
        
        <div class="space10">
        </div>
        <div class="cartdiv aaa" style="background:#fff url(/Public/images/address-bg.jpg) repeat-x;background-size: 36px;">
          <h2 class="order_sendby clearfix">
            <span>
              收货信息[点击修改]
            </span>
          </h2>
          <div class="cart_orderlist_info" style="margin-left:20px;width:80%;">
            <a href="<?php echo U('Address/index');?>">
              <p class="cart_g_name" style="word-wrap: break-word;word-break: normal;">
                <?php echo ($address_info["username"]); ?> 　　<?php echo ($address_info["telphone"]); ?>
              </p>
              <p class="cart_b_name">
                <span id="address"><?php echo ($address_info["address"]); ?></span>
                <input id="address_id" value="<?php echo ($address_info['address_id']); ?>" type="hidden">
              </p>
            </a>
          </div>
        </div>
        <div class="cartdiv">
          <div class="cartlist clearfix">
            <?php if(is_array($temp)): $k = 0; $__LIST__ = $temp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($k % 2 );++$k;?><div id="good<?php echo ($k); ?>">
                <div class="space10">
                </div>
                <div class="cartlistinner clearfix">
                  <a href="<?php echo U('good');?>?good_id=<?php echo ($vv["info"]["good_id"]); ?>" class="cart_orderlist_i">
                    <img style="display: inline;" src="/<?php echo ($vv["info"]["pic_url"]); ?>" data-original=""
                    data-onerror="" data-brandlazy="true" height="70" width="70">
                  </a>
                  <div class="cart_orderlist_info">
                    <a href="<?php echo U('good');?>?good_id=<?php echo ($vv["info"]["good_id"]); ?>">
                      <p class="cart_g_name" style="word-wrap: break-word;word-break: normal;">
                        <?php echo ($vv["info"]["good_name"]); ?>
                      </p>

                      <br />
                    </a>
                    <div class="amount-confirm-box">
                      <a href="javascript:;" class="amount-action amount-action-min <?php if( $vv["good_num"] == 1 ): ?>disabled<?php endif; ?> " onclick="change_min(this,'<?php echo ($k); ?>','<?php echo ($vv["order_id"]); ?>')">
                        -
                      </a>
                      <span class="amount-text" id="num<?php echo ($k); ?>">
                        <?php echo ($vv["good_num"]); ?>
                      </span>
                      <a href="javascript:;" class="amount-action amount-action-max" onclick="change_max(this,'<?php echo ($k); ?>','<?php echo ($vv["order_id"]); ?>')">
                        +
                      </a>
                    </div>
                  </div>
                  <a class="cart_orderlist_p" alt="<?php echo ($k); ?>" href="javascript:void(0)" style="display:block">
                    <span class="c_price">
                      ¥
                      <em class="price">
                        <?php echo ($vv["info"]["good_price"]); ?>
                      </em>
                    </span>
                    <span class="fontstyle">
                      ¥
                      <em class="market">
                        <?php echo ($vv["info"]["market_price"]); ?>
                      </em>
                    </span>
                  </a>
                  <span class="delete">
                    <a href="javascript:;" onclick="del('<?php echo ($k); ?>','<?php echo ($vv["order_id"]); ?>')" data-usecoupon="0"
                    mars_sead="cart_delect_btn" data_mars="prd_id:43280703">
                      <img src="/Public/shop/images/74ff20009b.png" height="22" width="22">
                    </a>
                  </span>
                </div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <!-- <div class="orderaction clearfix">
          <p class="fl">本单已免运费</p>
          <div class="clear"></div>
          <div class="use_bouns clearfix">
          <div class="use_bouns">如需使用优惠券请</div>
          </div>
          </div> -->
        </div>
        <!--固定在页面底部浮动的购买按钮-->
        <div class="navbar navbar-default navbar-fixed-bottom" style="z-index:3;">
          <!--<div class="saveguid"><span></span>100%正品保证</div>-->
          <div class="container nav-current-box checkout-box">
            <div class="navbar-header">
              <p class="totle">
                    <?php if($discount == 0 ): ?>总金额：
					<?php else: ?>
					二次购买总金额:<?php endif; ?>
                <span class="price">
                  ¥
                  <em class="total-fee">
                  </em>
                </span>
              </p>
              <span>
                为您节省：¥
                <em class="total-market">
                </em>
              </span>
            </div>
            <div class="navbar-brand">
            <input name="discount" value="<?php echo ($discount); ?>" id="discount" type="hidden">
              <a class="btn btn-large btn-purple" mars_sead="first-check_btn" href="javascript:;"
              onclick="pay(this)">
                去结算
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
      <div style="text-align:center;padding-top:35%;">
        <div class="icon-shopping-cart icon-5x" style="color:#ff6666">
        </div>
        <Br />
        <br />
        <div style="font-size:16px;color:#ff6666;">
          购物车空空如也，去
          <a href="<?php echo U('index');?>">
            首页
          </a>
          逛逛~
        </div>
      </div><?php endif; ?>
    <div class="space10">
    </div>
    <a href="#top" class="u-backtop" mars_sead="home_foot_top_btn">
    </a>
    <!--以下是浮于显示屏左下角的购物袋-->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="/Public/js/base.js">
    </script>
    <script src="/Public/layer-mobile/layer.js">
    </script>
    <script>
      $(document).ready(function() {

		if('<?php echo ($address_info["address"]); ?>' == '' ){loading('请添加收获地址');location.href="<?php echo U('Address/index');?>";}
        change_totalfee();
      });
      function pay(obj) {
		if($('#address').text() == ''){
			layer.open({
			  content: '收货地址为空！请添加',
			  time: 3
			});
			return;
		}
		var address_id = $('#address_id').val();

        $(obj).attr("onclick", '');
        loading('正在提交订单');
        $.ajax({
          type: "POST",
          url: "<?php echo U('order_sure');?>",
          dataType: "json",
          data: {
              "address_id": address_id
          },
          success: function(json) {
            location.href = "/Shop/Index/order_pay?pay_id=" + json.pay_id;
          },
          error: function() {

             }
        });
      }
      function del(id, order_id) {
        layer.open({
          content: '您确认要从购物车移除该商品吗？',
          btn: ['确认', '取消'],
          shadeClose: false,
          yes: function() {
            layer.closeAll();
            layer.open({
              type: 2,
              shadeClose: false
            });
            $.ajax({
              type: "POST",
              url: "<?php echo U(del_categrey);?>",
              dataType: "json",
              data: {
                "order_id": order_id
              },
              success: function(data) {
                if (data.success == 1) {
                  $('#good' + id).remove();
                  change_totalfee();
                }
                var a = $('.cartlist').text();
                if (a.length == '14') {
                  location.reload();
                  exit;
                }
                layer.closeAll();
              },
              error: function() {
                layer.closeAll();
                layer.open({
                  content: '发生通信错误，请稍候重试',
                  time: 3
                });
              }
            });

          },
          no: function() {

        }
        });
      }
      function change_min(obj, id, order_id) {
        var num = $('#num' + id).text();
        if (num != 1) {
          $.ajax({
            type: "POST",
            url: "<?php echo U(change_categrey);?>",
            dataType: "json",
            data: {
              "order_id": order_id,
              'type': 'min'
            },
            success: function(data) {
              if (data.success == 1) {
                var savenum = num * 1 - 1 * 1;
                $('#num' + id).text(savenum);
                change_totalfee();
                if (savenum == 1) {
                  $(obj).addClass('disabled');
                }
              }
            },
            error: function() {
              layer.open({
                content: '发生通信错误，请稍候重试',
                time: 3
              });
            }
          });
        }
      }
      function change_max(obj, id, order_id) {

        var num = $('#num' + id).text();
        $.ajax({
          type: "POST",
          url: "<?php echo U(change_categrey);?>",
          dataType: "json",
          data: {
            "order_id": order_id,
            'type': 'max'
          },
          success: function(data) {
            if (data.success == 1) {
              var savenum = num * 1 + 1 * 1;
              $('#num' + id).text(savenum);
              $(obj).prev().prev().removeClass('disabled');
              change_totalfee();
            }
          },
          error: function() {
            layer.open({
              content: '发生通信错误，请稍候重试',
              time: 3
            });
          }
        });

      }
      /*
<a class="cart_orderlist_p" href="javascript:void(0)" target="_blank" style="display:block">
			  <span class="c_price">¥<?php echo ($vv["info"]["good_price"]); ?></span>
			  <span class="fontstyle">¥<?php echo ($vv["info"]["market_price"]); ?></span>
			</a>
*/
      function change_totalfee() {
        var price = 0;
        var market = 0;
		var discount = parseInt($('#discount').val());
		if(discount !=0 ){
			discount = discount *0.01;
		}else{
			discount=1;
		}
        $('.cart_orderlist_p').each(function() {
          var k = $(this).attr('alt');
          var num = $('#num' + k).text();
          var c = $(this).find('.price').text();
          var d = $(this).find('.market').text();
		 
          price = price * 1  + c * 1 * num;
          market = market * 1 + d * 1 * num;
        });

        $('.total-fee').text(price*discount);
        $('.total-market').text(market * 1 - price * 1 * discount);
      }
    </script>
  </body>

</html>