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
			管理员管理
		</h3>
		<ul class="nav nav-tabs" role="tablist" >
			<li role="presentation" class="active"><a  role="tab" data-toggle="tab" style="background-color:transparent;border-radius:3px;">添加管理员</a></li>
		</ul>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" style="margin-top: 25px;">
						<thead>
						<tr >
							<td class="td-title col-sm-2 ">用户名：</td>
							<td><div class="controls">
								<input type="text"  class="form-control"  id="username" name="username" maxlength="20" placeholder="" value="" style="width: 30%;">
							</div></td>
						</tr>
						<tr >
							<td class="td-title col-sm-2 ">密码：</td>
							<td><div class="controls">
								<input type="password"  class="form-control"  id="password" name="password" maxlength="20" placeholder="*******" value="" style="width: 30%;">
							</div></td>
						</tr>
						<tr >
							<td class="td-title col-sm-2 ">邮箱：</td>
							<td><div class="controls">
								<input type="text"  class="form-control"  id="email" name="email" maxlength="20" placeholder="" value="" style="width: 30%;">
							</div></td>
						</tr>

						<tr>
							<td class="td-title">角色：</td>
							<td>
								<div class="controls">
									<?php if(is_array($roles)): foreach($roles as $key=>$vo): ?><label class="checkbox inline" style="padding-left: 30px;">
											<input value="<?php echo ($vo["id"]); ?>" type="checkbox" name="role_id[]" <?php if( $vo['id'] == 1): ?>disabled="true"<?php endif; ?>><?php echo ($vo["name"]); ?>
										</label><?php endforeach; endif; ?>
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
				var username = m.node("#username").value();
				if (username.length <= 0) {
					engine.news("用户名称不能为空", 3000);
					return;
				}
				var password = m.node("#password").value();
				if(password.length <= 0 ){
					engine.news("密码不能为空", 3000);
					return;
				}
				var email = m.node('#email').value();
				var role_id = '';
				$("input[name='role_id[]']").each(
						function(){
							if($(this).prop('checked')==true) {
								role_id += $(this).val() + ",";
							}
						}
				);
				role_id = role_id.substring(0, role_id.lastIndexOf(','));
				if(role_id.length <= 0 ){
					engine.news("请为此用户指定角色", 3000);
					return;
				}

				engine.news("正在提交...", 99999, true);

				var ajax = m.ajax("<?php echo U('Admin/User/add_post');?>", null, function (jso) {
					var jso = m.json.getObject(jso);
					switch (jso.Error) {
						case 0:
							engine.news("添加管理员成功", 3000);
							setTimeout(function () {
								m.redirect('/Admin/User/manage');
							}, 1500);
							break;
						default:
							engine.news(jso.Data, 3000);
							break;
					}
				});
				ajax.data.add("username", ResChinese(username));
				ajax.data.add("password", ResChinese(password));
				ajax.data.add("email", email);
				ajax.data.add("role_id", role_id);
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