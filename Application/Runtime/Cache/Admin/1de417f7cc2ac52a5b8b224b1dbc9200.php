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
			<?php echo ($withdraw_info['user_name']); ?> 提现审核
		</h3>
		<a href="#" onclick="history.back(-1)"><button class="btn btn-success btn-sm savecode">返回</button></a>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr >
							<td class="td-title col-sm-2 ">编号：</td>
							<td><?php echo ($withdraw_info["user_name"]); ?></td>
						</tr>
						
						<tr >
							<td class="td-title col-sm-2 ">手机号：</td>
							<td><?php echo ($user["moblie"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">开户名：</td>
							<td><?php echo ($withdraw_info["bankuser"]); ?></td>
						</tr>
						
							<tr>
							<td class="td-title">开户银行：</td>
							<td>
							  <?php echo ($bank["name"]); ?>
							</td>
						</tr>
							<tr>
							<td class="td-title">卡号：</td>
							<td><?php echo ($withdraw_info["bankno"]); ?></td>
						</tr>
							
						<tr>
							<td class="td-title">开户地址：</td>
							<td><?php echo ($withdraw_info["bankname"]); ?></td>
						</tr>
						
						<tr>
							<td class="td-title">提现金额：</td>
							<td><?php echo ($withdraw_info["money"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">手续费：</td>
							<td><?php echo ($withdraw_info["poundage"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">实际到账：</td>
							<td><?php echo ($withdraw_info["arrival"]); ?></td>
						</tr>
						<tr>
							<td class="td-title">申请时间：</td>
							<td><?php echo (date('Y-m-d H:i:s',$withdraw_info["createtime"])); ?></td>
						</tr>

						<tr>
							<td class="td-title">状态：</td>
							<td>
								<select id="status" class="form-control">
									<option value="0" <?php if(($withdraw_info["status"] == 0)): ?>selected<?php endif; ?>>待审核</option>
									<option value="1" <?php if(($withdraw_info["status"] == 1)): ?>selected<?php endif; ?>>审核通过</option>
									<option value="2" <?php if(($withdraw_info["status"] == 2)): ?>selected<?php endif; ?>>审核失败</option>
								</select>
							</td>
						</tr>
						<?php if(($withdraw_info["handletime"] != 0) ): ?><tr>
							<td class="td-title">审核时间：</td>
							<td><?php echo (date('Y-m-d H:i:s',$withdraw_info["handletime"])); ?></td>
						</tr><?php endif; ?>
						<tr>
							<td>
								<br />
								<div class="col-sm-4 col-sm-offset-2">
								    <input type="hidden" id="id" name="id" value="<?php echo ($withdraw_info["id"]); ?>">
									<button id="btn_enter" class="btn btn-primary" type="button">立即提交</button>
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
                var status = m.node("#status").value();
                if (status == null || status.length <= 0) {
                    engine.news("请选择状态", 3000);
                    return;
                }
                engine.news("正在提交...", 99999, true);
                var ajax = m.ajax("<?php echo U('Admin/Deal/api_check_submit');?>", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case 0:
                            engine.news("审核成功", 3000);
                            m.reload();
                            break;
                        case -10002:
                            engine.news("审核失败", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("id", id);
                ajax.data.add("status", status);
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