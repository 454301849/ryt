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
				管理员管理
			</h3>
			<ul class="nav nav-tabs" role="tablist" >
			<li role="presentation" class="active"><a href="<?php echo U('User/manage');?>"  role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;">管理员列表</a></li>
			<li role="presentation" ><a href="<?php echo U('User/add');?>" aria-controls="messages" role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;border:0px;">添加管理员</a></li>
		</ul>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
							<thead>
							<tr>
								<td style="width:50px;">序号</td>
								<td>用户名</td>
								<td>最后ip</td>
								<td>最后登录时间</td>
								<td>注册时间</td>
								<td>邮箱</td>
								<!--<td>状态</td>-->
								<td>操作</td>
							</tr>
							</thead>
							<tbody>
							<?php if(is_array($users)): foreach($users as $key=>$vo): ?><tr>
									<td><?php echo ($vo["id"]); ?></td>
									<td><?php echo ($vo["username"]); ?></td>
									<td>
										<!--<?php echo (date("$_SERVER[REMOTE_ADDR]",$vo["ip"])); ?>-->
										<?php if($vo['ip'] ==''): ?>该用户还没有登录过
											<?php else: ?>
											<?php echo ($vo["ip"]); endif; ?>
									</td>
									<td>
										<?php if($vo['last_time'] == 0): ?>该用户还没有登录过
											<?php else: ?>
											<!--<?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?>-->
											<?php echo ($vo["last_time"]); endif; ?>
									</td>
									<td><?php echo ($vo["register_time"]); ?></td>
									<td><?php echo ($vo["email"]); ?></td>
									<!--<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>-->
									<td>
										<?php if($vo['id'] == 1): ?><font color="#cccccc">编辑</font> | <font color="#cccccc">删除</font>
											<?php else: ?>
											<a href='<?php echo U("user/edit",array("id"=>$vo["id"]));?>'>编辑</a> |
											<a class="js-ajax-delete" href="<?php echo U('user/delete',array('id'=>$vo['id']));?>">删除</a><?php endif; ?>
									</td>
								</tr><?php endforeach; endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<!--隐藏域开始-->
			<input type="hidden" class="HD_PAGE" value="0" />
			<input type="hidden" class="HD_SIZE" value="20" />
			<input type="hidden" class="HD_COUNT" value="5" />

			<!--隐藏域结束-->
			<script type="text/javascript">
                var pck = {
                    page: 0,
                    size: 0,
                    count: 0,
                    //加载页面
                    init: function () {
                        this.page = mtopt.parse.toInteger(m.node(".HD_PAGE").value());
                        this.size = mtopt.parse.toInteger(m.node(".HD_SIZE").value());
                        this.count = mtopt.parse.toInteger(m.node(".HD_COUNT").value());
                    }
                }
                pck.init();
			</script>
		</div>
	</section>