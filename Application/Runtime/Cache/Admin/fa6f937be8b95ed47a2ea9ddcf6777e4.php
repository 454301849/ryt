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
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');
	}
	.td-title{
		width:12em;
	}
</style>

<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
	<div class="content-wrapper">

		<h3>
			基础信息
		</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<td class="td-title">真实姓名：</td>
							<td><?php echo ($info["truename"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">身份证：</td>
							<td><?php echo ($info["idcard"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">手机：</td>
							<td><?php echo ($info["moblie"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">邮箱：</td>
							<td><?php echo ($info["email"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">邮编：</td>
							<td><?php echo ($info["zipcode"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">地址：</td>
							<td><?php echo ($info["address"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">所属安置位置：</td>
							<td><?php echo ($info["area_name"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">成员等级：</td>
							<td><?php echo ($info["level"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">推荐人：</td>
							<td><?php echo ($info["rusername"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">安置人：</td>
							<td><?php echo ($info["pusername"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">代理中心：</td>
							<td><?php echo ($info["centername"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">创建时间：</td>
							<td><?php echo (date("Y-m-d H:i:s",$info["reg_time"])); ?></td>
						</tr>
						<tr>
							<td class="td-title">编辑时间：</td>
							<td><?php echo (date("Y-m-d H:i:s",$info["after_time"])); ?></td>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>