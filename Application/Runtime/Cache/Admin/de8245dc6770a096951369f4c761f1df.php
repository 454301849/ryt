<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered table-hover" style="font-size:14px;">
<th width="20%">[ID]客户名称</th>
<th width="40%">问题描述</th>
<th width="20%" style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden;font-size:12px;text-decoration:underline;">问题描述</th>
<th width="10%">时间</th>
<th width="10%">操作</th>
<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><tr style="height:25px;font-size:12px;">
	<td width="20%" style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden;">[<?php echo ($vv["user_id"]); ?>]<?php echo ($vv["nickname"]); ?></td>
	<td width="40%" style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden;text-decoration:underline;"><?php echo ($vv["title"]); ?></td>
	<td width="20%" style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden;"><?php echo ($vv["time"]); ?></td>
	<td width="10%" style="white-space: nowrap;text-overflow:ellipsis;overflow:hidden;"><?php if($vv["is_true"] == 1 ): ?>已处理<?php else: ?><span style="color:red">待处理</span><?php endif; ?></td>
	<td><a href="<?php echo U('question_reply');?>?id=<?php echo ($vv["id"]); ?>"><button class="btn btn-success btn-sm">回复</button></a></td>
	
</tr><?php endforeach; endif; else: echo "" ;endif; ?>	
</table>
<div class="pagelist"><?php echo ($page); ?></div>