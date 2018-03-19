<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<style>
	body{
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
	.alert-success{
		background-color:transparent;
	}
	.btn-default{background:#44b549;color:#fff;}
	.form-group1:hover{background:#fff;}
	.form-group{padding:10px 0;}
	.well{
		color:#fff;
		border:none;
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
		background-color: #05336f;
		color: #fff;
	}
	.nav-tabs > li > a:hover {
		border: 1px solid rgb(221, 230, 233) !important;
	}
</style>

<section>
	<div class="content-wrapper">
		<h3>
			角色管理
		</h3>

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" >
			<li role="presentation" class="active"><a href="<?php echo U('Rbac/index');?>"  role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;">角色管理</a></li>
			<li role="presentation"><a href="<?php echo U('Rbac/roleadd');?>" aria-controls="messages" role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;border:0px;">添加角色</a></li>
		</ul>
		<div class="panel panel-default">
		<!--<form action="<?php echo U('Rbac/listorders');?>" method="post">-->
			<div id="list">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
							<thead>
							<tr>
								<td style="width:50px;">ID</td>
								<td>角色名称</td>
								<td>角色描述</td>
								<td>状态</td>
								<td>操作</td>
							</tr>
							</thead>
							<tbody>

				<?php if(is_array($roles)): foreach($roles as $key=>$vo): ?><tr>
						<td><?php echo ($vo["id"]); ?></td>
						<td><?php echo ($vo["name"]); ?></td>
						<td><?php echo ($vo["remark"]); ?></td>
						<td>
							<?php if($vo['status'] == 1): ?><font color="red">√</font>
								<?php else: ?>
								<font color="red">╳</font><?php endif; ?>
						</td>
						<td>
							<?php if($vo['id'] == 1): ?><font color="#cccccc">权限设置</font>|<!-- <a href="javascript:open_iframe_dialog('<?php echo U('rbac/member',array('id'=>$vo['id']));?>','成员管理');">成员管理</a> | -->
								<font color="#cccccc">编辑</font> | <font color="#cccccc">删除</font>
								<?php else: ?>
								<a href="<?php echo U('Rbac/authorize',array('id'=>$vo['id']));?>">权限设置</a>|
								<a href="<?php echo U('Rbac/roleedit',array('id'=>$vo['id']));?>">编辑</a>|
								<a class="js-ajax-delete" href="<?php echo U('Rbac/roledelete',array('id'=>$vo['id']));?>">删除</a><?php endif; ?>
						</td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
</div>
	</div>
		</div>
		</div>

</section>