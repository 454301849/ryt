<?php if (!defined('THINK_PATH')) exit();?><div class="panel-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
			<thead>
			<tr>
				<td>序号</td>
				<td>相关编号</td>
				<td>编号</td>
				<td>总金额</td>
				<td>提现</td>
				<td>积分</td>
				<!--<td>爱心基金</td>
				<td>税收</td>-->
				<td>类型</td>
				<td>详情</td>
				<td>时间</td>
				<td>操作</td>
			</tr>
			</thead>
			<tbody>
<?php $jtype = array( '1'=>'层奖', '2'=>'量奖', '3'=>'领导奖', '4'=>'互助奖', '5'=>'分享奖', '6'=>'见点奖', '7'=>'区域管理奖', '8'=>'推荐奖', ); ?>

			<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="pg-deal-list">
					<td class="time"><?php echo ($kk); ?></td>
					<td class="time"><?php echo ($vv["yuser_name"]); ?></td>
					<td class="name"><?php echo ($vv["user_name"]); ?></td>
					<td class="state"><?php echo ($vv["fee"]); ?></td>
					<td class="name"><?php echo ($vv["tx"]); ?></td>
					<td class="name"><?php echo ($vv["jf"]); ?></td>
					<!--<td class="name"><?php echo ($vv["ax"]); ?></td>
					<td class="name"><?php echo ($vv["sh"]); ?></td>-->
					<td class="money">
                   			<?php echo ($jtype[$vv['type']]); ?></td>
					<td class="money"><?php echo ($vv["desc"]); ?></td>
					<td class="money"><?php echo ($vv["bdate"]); ?></td>
					<td class="opera"><a href="<?php echo U('Deal/main_detail',array('record'=>$vv['id']));?>" target="main-frame">查看详情</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
	<center>
		<ul class="pagination" style="margin:0px;">
			<?php echo ($page); ?>
		</ul>
	</center>
</div>