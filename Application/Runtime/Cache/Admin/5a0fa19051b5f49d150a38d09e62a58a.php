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
	.td-title{
		text-align: right;
	}
	.addradio {
		margin-top: 0px;
		margin-left: 25px;
	}
	.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
		background-color: #05336f;
		color: #fff;
	}
	.nav-tabs > li > a:hover {
		border: 1px solid rgb(221, 230, 233) !important;
	}
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
			角色管理
		</h3>
		<ul class="nav nav-tabs" role="tablist" >
			<li role="presentation" class="active"><a href="<?php echo U('Rbac/roleadd');?>" aria-controls="messages" role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;">添加角色</a></li>
		</ul>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" style="margin-top: 25px;">
						<thead>
						<tr >
							<td class="td-title col-sm-2 ">角色名称：</td>
							<td><div class="controls">
								<input type="text"  class="form-control"  id="rolename" name="name" maxlength="20" placeholder="" style="width: 30%;">
							</div></td>
						</tr>
						<tr >
							<td class="td-title col-sm-2 ">角色描述：</td>
							<td><div class="controls">
								<textarea name="remark" rows="2" cols="20" id="remark" class="form-control" maxlength="100"  style="height: 100px; width: 500px;"></textarea>
							</div></td>
						</tr>
						<tr>
							<td class="td-title">状态：</td>
							<td>
								<div class="controls">
									<label class="radio inline addradio" for="active_true"><input type="radio" name="status" value="1" checked id="active_true" />开启</label>
									<label class="radio inline addradio" for="active_false"><input type="radio" name="status" value="0" id="active_false">禁用</label>
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<br />
								<div class="col-sm-12 col-sm-offset-12">
									<button id="btn_enter" class="btn btn-primary" type="button">添加</button>
									<a class="btn" href="javascript:history.back(-1);" style="background-color:#DDDDDD;">返回</a>

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
				var name = m.node("#rolename").value();
				if (name.length <= 0) {
					engine.news("角色名称不能为空", 3000);
					return;
				}
				var remark = m.node("#remark").value();
				var status = $('input:radio:checked').val();
				engine.news("正在提交...", 99999, true);

				var ajax = m.ajax("<?php echo U('Admin/Rbac/roleadd_post');?>", null, function (jso) {
					var jso = m.json.getObject(jso);
					switch (jso.Error) {
						case 0:
							engine.news("添加角色成功", 3000);
							setTimeout(function () {
								m.redirect('/Admin/Rbac/index');
							}, 1500);
							break;
						default:
							engine.news(jso.Data, 3000);
							break;
					}
				});
				ajax.data.add("name", ResChinese(name));
				ajax.data.add("remark", ResChinese(remark));
				ajax.data.add("status", status);
				ajax.send();
			},
			init: function () { }
		}
		pck.init();
		$(function () {
			m.node("#btn_enter").click(pck.submit);
		});
		function ResChinese(obj)
		{
			return encodeURI(obj);
		}
	</script>
</section>