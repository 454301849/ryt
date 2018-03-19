<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<title>系统管理后台</title>
	<link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
	<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
	<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
	<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
	<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/Public/admin/css/engine.css" rel="stylesheet" />
	<style>
		body{background-image:url('/Public/images/max.jpg');
			background-repeat:no-repeat;
			background-attachment:fixed;
			background-size:cover;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Images/background/001/max.jpg',sizingMethod='scale');}
	</style>

	<style type="text/css">
		.bg-glass{background-color:none;}
		.list-group-item,.list-group-item:hover,.list-group-item:focus{background-color:transparent !important;color:#fff !important;border:none}
	</style>
	<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/admin/js/pace.js"></script>
	<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
	<script type="text/javascript" src="/Public/admin/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.pie.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.resize.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.categories.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.spline.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<body >

<section>
	<div class="content-wrapper">

		<h3>
			代理中心
		</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<td style="width:50px;">序号</td>
							<td>会员编号</td>
							<td>姓名</td>
							<td>级别</td>
							<td>推荐人</td>
							<td>安置人</td>
							<td>注册日期</td>
							<td>登录日期</td>
							<td>状态</td>
							<td>详情</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="form-item">
							<td><?php echo ($kk); ?></td>
							<td><a href="<?php echo U('Daili/center_detail',array('user_name'=>$vv['user_name']));?>" target="main-frame"><?php echo ($vv["user_name"]); ?></a></td>
							<td><?php echo ($vv["truename"]); ?></td>
							<td><?php echo ($vv["name"]); ?></td>
							<td><?php echo ($vv['rusername']?$vv['rusername']:'--'); ?></td>
							<td><?php echo ($vv['pusername']?$vv['pusername']:'--'); ?></td>
							<td><?php echo (date("Y-m-d",$vv["reg_time"])); ?></td>
							<td><?php echo (date("Y-m-d",$vv["last_time"])); ?></td>
							<td><?php echo ($vv['type']); ?></td>
							<td><a href="<?php echo U('Daili/center_info',array('user_name'=>$vv['user_name']));?>" target="main-frame">下线会员</a>
							        <a  href="<?php echo U('Daili/center_detail',array('user_name'=>$vv['user_name']));?>" target="main-frame">查看申请历史</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<center>
			<ul class="pagination" style="margin:0px;">
				<?php echo ($page); ?>
			</ul>
		</center>

		<!--隐藏域开始-->
		<input type="hidden" class="HD_PAGE" value="0" />
		<input type="hidden" class="HD_SIZE" value="20" />
		<input type="hidden" class="HD_COUNT" value="6" />

	</div>
</section>


</body></html>