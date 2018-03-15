<?php if (!defined('THINK_PATH')) exit();?><div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
			<thead>
			<tr>
	<td width="5%">订单号</td>
	<td>下单时间</td>
	<td>会员ID</td>
	<td>收货人</td>
	<td>总金额</td>
	<td>支付状态</td>
	<td>发货状态</td>
				<td>操作</td></tr>
			</thead>
			<tbody>
	<?php if(is_array($order_info)): $kk = 0; $__LIST__ = $order_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr id="<?php echo ($kk); ?>">
		<td width="5%"><?php echo ($vv["order_sn"]); ?></td>
		<td><?php echo ($vv["time"]); ?></td>
		<td><?php echo ($vv["user_id"]); ?></td>
		<td width="30%"><?php echo ($vv["address"]["username"]); ?> Tel:<?php echo ($vv["address"]["telphone"]); ?><br /><?php echo ($vv["address"]["address"]); ?></td>
		<td><?php echo ($vv["total_fee"]); ?></td>
		<td><?php if($vv["is_true"] == 1 ): ?>已支付<?php else: ?> <font color="red">未支付</font><?php endif; ?></td>
		<td><?php if($vv["state"] == 2 ): ?>已收货<?php elseif($vv["state"] == 1 ): ?>已发货<?php else: ?> <font color="red">待发货</font><?php endif; ?></td>
		<td>
		<a href="<?php echo U('order_more');?>?pay_id=<?php echo ($vv["pay_id"]); ?>" target="main-frame"><button class="btn btn-default btn-sm">详情</button></a>
		</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table></div>
		<center>
			<ul class="pagination" style="margin:0px;">
				<?php echo ($page); ?>
			</ul>
		</center>
	</div>