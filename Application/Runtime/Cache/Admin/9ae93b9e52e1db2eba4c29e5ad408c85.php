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
</style>

<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>

	<section>
		<div class="content-wrapper">

			<h3>
				我的推荐
			</h3>
			<div class="panel panel-default">
				<div class="panel-body">
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
									<td><a href="<?php echo U('User/recmlist_detail',array('user_name'=>$vv['user_name']));?>" target="main-frame">查看详情</a></td>
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