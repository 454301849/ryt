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
			申请历史记录
		</h3>

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<td>序号</td>
							<td>类型</td>
							<!--<td>报单费</td>-->
							<td>标题</td>
							<td>备注</td>
							<td>申请日期</td>
							<td>审核日期</td>
							<td >状态</td>
							<td >编辑</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($datail)): $kk = 0; $__LIST__ = $datail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="form-item">
							<td><?php echo ($kk); ?></td>
							<td>申请
							<?php if($vv['type'] == '1'): ?>品鉴店
								<?php else: ?>
								旗舰店<?php endif; ?>
							</td>
							<!--<td><?php echo ($vv["reward"]); ?>%</td>-->
							<td><?php echo ($vv["title"]); ?></td>
							<td><?php echo ($vv["content"]); ?></td>
							<td><?php echo (date("Y-m-d H:i:s",$vv["tj_time"])); ?></td>
							<?php if($vv['genre'] == '0'): ?><td>---</td>
								<?php else: ?>
								<td>
									<?php echo (date("Y-m-d H:i:s",$vv["sh_time"])); ?>
								</td><?php endif; ?>
							<td><?php echo ($vv['genre'] > 1?($vv['genre']> 2?'审核失败':'审核通过'):'提交中'); ?></td>
							<td><a href="<?php echo U('Daili/center_audit',array('id'=>$vv['id']));?>" target="main-frame">编辑</a></td>
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
		<input type="hidden" class="HD_COUNT" value="3" />
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