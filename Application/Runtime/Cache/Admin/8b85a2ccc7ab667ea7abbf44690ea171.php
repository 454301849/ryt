<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/css/weui.min.css">
<link rel="stylesheet" href="/Public/admin/css/base.css">
<link href="/Public/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

<style>
	.bg-success{
		color:#3c763d;
		background-color:#DFF0D8;
		border-radius:4px;
	}
	body{
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
	.btn-default{background:#44b549;color:#fff;}
	.form-group1:hover{background:#fff;}
	.well{
		color:#fff;
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
	table th{
		color:#fff;
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}

</style>
<section>
	<div class="content-wrapper">

		<h3>
			订单详情
		</h3>

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">订单详情</a></li>
			<li role="presentation"><a href="javascript:void(0);" onclick="history.go(-1);">返回上一页</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content" style="margin-top:30px;border:1px solid #dddddd;padding:10px 2%;">
			<div role="tabpanel" class="tab-pane active" id="home">
				<div class="bg-success" style="padding:10px;margin:5px 0;"><span style="color:#3c763d">基本信息</span></div>
				<div class="col-sm-6"><span>订单号：</span><?php echo ($order_info[0]['order_sn']); ?></div>
				<div class="col-sm-6"><span>订单状态：</span><?php echo ($order['is_true']); ?></div>
				<div class="col-sm-6"><span>购买人ID：</span>[<?php echo ($order_info[0]['user_name']); ?>]</div>
				<div class="col-sm-6"><span>下单时间：</span><?php echo ($order['time']); ?></div>
				<div class="col-sm-6"><span>支付方式：</span><?php echo ($order['pay_name']); ?></div>
				<div class="col-sm-6"><span>付款时间：</span><?php echo ($order['pay_time']); ?></div>
				<div style="clear:both;"></div>
					<div class="bg-success" style="padding:10px;margin:5px 0;"><span style="color:#3c763d">发货单号</span></div>
					<div class="col-sm-12" style="margin: 8px 0;">
						<div class="col-sm-6" style="float: left;">
							<select id="serve_name" class="col-sm-6 form-control " style=""></select>
							<input type="hidden" name="serve_m" id="serve_m" value="<?php echo ($order['serve_name']); ?>">
						</div>
										

						<div class="col-sm-6" style="float: right;">
							<input type="text" name="serve_id" id="serve_id" value="<?php echo ($order['serve_id']); ?>" style="height:35px"   placeholder="输入订单号">
							<?php if($order["state"] != 2 and $order["pay_time"] != 0): ?><a href="order.html"><button type="submit" class="btn btn-primary btn-sm" id="serve_sure" style="height:35px;margin-left: 10%;margin-top: -10px;" data-loading-text="请稍候...">确认物流信息</button></a><?php endif; ?>
						</div>
						
						</div>
					
				
				<div style="clear:both;"></div>
				<div class="bg-success" style="padding:10px;margin:5px 0;"><span style="color:#3c763d">收货人信息</span></div>
				<div class="col-sm-6"><span>姓名：</span><?php echo ($user_address['username']); ?></div>
				<div class="col-sm-6"><span>手机号：</span><?php echo ($user_address['telphone']); ?></div>
				<div class="col-sm-6"><span>通讯地址：</span><?php echo ($user_address['address']); ?></div>
				<div style="clear:both;"></div>
				<div class="bg-success" style="padding:10px;margin:5px 0"><span style="color:#3c763d">商品信息</span></div>
				<table class="table table-striped" style="font-size:14px;">
					<thead>
					<td>商品ID</td>
					<td>商品名称</td>
					<td>缩略图</td>
					<td>单价</td>
					<td>数量</td>
					<td>金额</td>
					</thead>
					<tbody>
					<?php if(is_array($order_info)): $i = 0; $__LIST__ = $order_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
							<td width="20px;"><?php echo ($v["good_id"]); ?></td>
							<td><?php echo ($v["good_name"]); ?></td>
							<td><img src="/<?php echo ($v["pic_url"]); ?>" width="30px"></td>
							<td>￥<?php echo ($v["good_price"]); ?></td>
							<td><?php echo ($v["good_num"]); ?></td>
							<td>￥<?php echo ($v["good_fee"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<div style="background-color:transparent;color:red">订单总金额 ￥<?php echo ($order["total_fee"]); ?></div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>

<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>

<script>
    $(function () {
        var serve_name = $('#serve_m').val();
        //获取快递
        engine.ajax.express('', function (json) {
            var selt = m.node("#serve_name");
            selt.html("");
            if(!serve_name){
                selt.append("<option value=''>请选择</option>");
			}
            for (var i in json) {
                selt.append("<option value='" + json[i].id + "'>" + json[i].name  + "</option>");
            }

            //设置默认值
            m.node("#serve_name").value(serve_name);
	})

    })
$('#serve_sure').click(function(){
	var $btn = $(this).button('loading');
	var id = "<?php echo ($order['order_id']); ?>";
	var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
	var serve_name = $('#serve_name').val();if(serve_name == ''){layer.closeAll();layer.msg("请输入快递公司编号代码");$btn.button('reset');exit;}
	var serve_id = $('#serve_id').val();if(serve_id == ''){layer.closeAll();layer.msg("请输入快递单号");$btn.button('reset');exit;}
	$.ajax({
			type: "POST",
			url: "<?php echo U('order_serve');?>?time="+new Date(),
			dataType: "json",
			data: {
				"id":id,
				"name":serve_name,
				"serve_id":serve_id,
			},
			success: function(json){
                layer.closeAll();
				layer.msg('发货成功');
				return;
			},
			error:function(){
                layer.closeAll();
				layer.msg("error");
                return;

			}
		});
});
</script>
<script src="/Public/admin/layer/layer.js"></script>
<script>
	$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
function getpage(p){
var nickname = $('#nickname').val();//alert(sn);
var user_id = $('#user_id').val();//alert(sn);
var subscribe = $('#subscribe').val();
	$('#list').html('<div style="text-align:center;margin-top:30px;"><img src="/Public/admin/images/loading.gif" width="60px" ></div>');
	$("#list").load(
		"<?php echo U('users_ajax');?>?nickname="+nickname+"&p="+p+"&user_id="+user_id+"&subscribe="+subscribe,
		function() {}
	);
}
function del(obj,id){
	//alert(id);
	layer.confirm('删除后无法恢复，确认删除吗', {
		btn: ['确认','取消'] //按钮
	}, function(){
		$.ajax({
			type: "POST",
			url: "<?php echo U('del');?>?time="+new Date(),
			dataType: "json",
			data: {
				"id":id,
			},
			success: function(json){
				layer.msg("删除成功");
				var td = $(obj).parent();//alert(a);
				td.parent().css("display","none");	
			},
			error:function(){	
			}
		});
	}, function(){
		
	});
	
	
}

</script>