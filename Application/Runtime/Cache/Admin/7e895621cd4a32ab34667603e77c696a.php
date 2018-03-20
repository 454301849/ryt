<?php if (!defined('THINK_PATH')) exit();?><div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
				<thead>
				<tr>
					<td style="width:50px;">序号</td>
					<td>会员编号</td>
					<td>姓名</td>
					<td>级别</td>
					<td>推荐人</td>
					<td>安置人</td>
					<td>注册日期</td>
					<td>状态</td>
					<td>操作</td>
					<td>详情</td>
				</tr>
				</thead>
				<tbody>
				<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="form-item">
						<td><?php echo ($kk); ?></td>
						<td><?php echo ($vv["user_name"]); ?></td>
						<td><?php echo ($vv["truename"]); ?></td>
						<td><?php echo ($vv["name"]); ?></td>
						<td><?php echo ($vv["rusername"]); ?></td>
						<td><?php echo ($vv["pusername"]); ?></td>
						<td><?php echo (date("Y-m-d",$vv["reg_time"])); ?></td>
						 <?php if($vv['register'] == '1'): ?><td style="color:green;">已激活</td>
							<?php else: ?>
							<td style="color:red;">未激活</td><?php endif; ?> <?php if($vv['register'] == '1'): ?><td>已激活</td>
							<?php else: ?>
							<td>
								<a id="user_name<?php echo ($vv["id"]); ?>"  class="button"  onclick="pckzs.activate('<?php echo ($vv["user_name"]); ?>')">去激活</a>
							</td><?php endif; ?>
						<td><a href="<?php echo U('User/recmlist_detail',array('user_name'=>$vv['user_name']));?>" target="main-frame">查看详情</a></td>
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