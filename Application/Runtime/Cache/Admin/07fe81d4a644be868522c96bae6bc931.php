<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered table-hover" style="font-size:14px;">
<th>用户ID</th>
<th>用户名</th>
<th>佣金余额</th>
<th>提出金额</th>
<th>总收益</th>
<?php if(is_array($broke_info)): $i = 0; $__LIST__ = $broke_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr>
	<td><?php echo ($vv["user_id"]); ?></td>
	<td><?php echo ($vv["nickname"]); ?></td>
	<td>￥<?php echo ($vv["shop_income"]); ?></td>
	<td>￥<?php echo ($vv["shop_outcome"]); ?></td>
	<td>￥<?php echo ($vv["shop_come"]); ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="pagelist"><?php echo ($page); ?></div>