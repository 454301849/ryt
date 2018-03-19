<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered table-hover" style="font-size:14px;margin-top:10px;">
<th>购买人信息</th>
<th>接包人信息</th>
<th>支付订单号</th>
<th>红包金额</th>
<th>领取状态</th>
<th>生成时间</th>
<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr id="<?php echo ($kk); ?>" style="font-size:13px;">
	<td>【<?php echo ($vv["from_user_id"]); ?>】<?php echo ($vv["fromnickname"]); ?></td>
	<td>【<?php echo ($vv["user_id"]); ?>】<?php echo ($vv["tonickname"]); ?></td>
	<td><?php echo ($vv["order_sn"]); ?></td>
	<td><?php echo ($vv["hongbao_fee"]); ?></td>
	<td>已发放<?php if($vv["is_true"] == 1): ?>已领取<?php else: ?><font color="red">未领取</font><?php endif; ?></td>
	<td><?php echo ($vv["time"]); ?></td>
</tr><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
</table>
<div class="pagelist"><?php echo ($page); ?></div>