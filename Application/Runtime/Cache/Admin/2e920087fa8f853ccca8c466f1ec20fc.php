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
<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
	<div class="content-wrapper">

		<h3>
			代理中心审核
		</h3>
		<a href="#" onclick="history.back(-1)"><button class="btn btn-success btn-sm savecode">返回</button></a>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr >
							<td class="td-title col-sm-2 ">编号：</td>
							<td><?php echo ($audit["user_name"]); ?></td>
						</tr>
						<tr >
							<td class="td-title col-sm-2 ">类型：</td>
							<td>申请
							<?php if($audit['type'] == '1'): ?>品鉴店
								<?php else: ?>
								旗舰店<?php endif; ?></td>
						</tr>
						
						<tr>
							<td class="td-title">真实姓名：</td>
							<td><?php echo ($audit["truename"]); ?></td>
						</tr>
						<!--
						<tr>
							<td class="td-title">报单费：</td>
							<td><input name="reward" id="reward"  value="<?php echo ($audit["reward"]); ?>" style="color:#000" /></td>
						</tr>-->
						<tr>
							<td class="td-title">标题：</td>
							<td><?php echo ($audit["title"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">备注：</td>
							<td><?php echo ($audit["content"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">状态：</td>
							<td>
								<select id="genre" class="form-control">
								<option value="1" <?php if($audit['genre'] == '1'): ?>selected<?php endif; ?>>提交中</option>
								<option value="2" <?php if($audit['genre'] == '2'): ?>selected<?php endif; ?>>审核通过</option>
								<option value="3" <?php if($audit['genre'] == '3'): ?>selected<?php endif; ?>>审核失败</option>
							</select></td>
						</tr>
						<tr>
							<td class="td-title">创建时间：</td>
							<td><?php echo (date("Y-m-d",$audit["tj_time"])); ?></td>
						</tr>
						<tr>
							<td>
								<br />
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" id="id" name="id" value="<?php echo ($audit["id"]); ?>">
									<button id="btn_enter" class="btn btn-primary" type="button">修改</button>
								</div>
							</td>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
        var pck = {
            submit: function () {
                var id = m.node("#id").value();
                var genre = m.node("#genre").value();
                var reward = m.node("#reward").value();
                engine.news("正在提交...", 99999, true);
                var ajax = m.ajax("<?php echo U('Admin/Daili/api_centerlists_audit');?>", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case 0:
                            engine.news("审核成功", 3000);
                            m.reload();
                            break;
                        case -10000:
                            engine.news("审核失败", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("center_id", id);
                ajax.data.add("genre", genre);
                ajax.data.add("reward", reward);
                ajax.send();
            },
            init: function () { }
        }
        pck.init();
        $(function () {
            m.node("#btn_enter").click(pck.submit);
        });
	</script>
</section>