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
<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
	<div class="content-wrapper">

		<h3>
			基础信息
		</h3>
		<a href="#" onclick="history.back(-1)"><button class="btn btn-success btn-sm savecode">返回</button></a>
		<!--<div style="text-align:right;">-->
			<!--<a class="btn btn-primary mb-lg" href="<?php echo U('User/sortlist_upgrade_detail',array('user_name'=>$info['user_name']));?>" target="main-frame">查看升级记录</a>-->
		<!--</div>-->
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<td class="col-lg-3">编号：</td>
							<td class="col-lg-3"><?php echo ($info["user_name"]); ?></td>
							<td class="col-lg-3">真实姓名：</td>
							<td class="col-lg-3"><?php echo ($info["truename"]); ?></td>
						</tr>
						<tr>
							<td class="col-lg-3">手机：</td>
							<td class="col-lg-3"><?php echo ($info["moblie"]); ?></td>
							<td class="col-lg-3">身份证：</td>
							<td class="col-lg-3"><?php echo ($info["idcard"]); ?></td>
						</tr>
						<tr>
							<td class="col-lg-3">邮箱：</td>
							<td class="col-lg-3"><?php echo ($info["email"]); ?></td>
							<td class="col-lg-3">邮编：</td>
							<td class="col-lg-3"><?php echo ($info["zipcode"]); ?></td>
						</tr>
						<tr>
							<td class="col-lg-3">地址：</td>
							<td class="col-lg-3"><?php echo ($info["address"]); ?></td>
						</tr>

						<tr>
							<td class="col-lg-3">所属安置位置：</td>
							<td>
								<!--<?php if($info["area"] == 1 ): ?>A区-->
									<!--<?php else: ?> B区-->
								<!--<?php endif; ?>-->
								<?php echo ($info["area_name"]); ?>
								<!--<select id="area" class="form-control">-->
							       <!--<option value="1"  <?php if($info["area"] == 1): ?>selected<?php endif; ?>  >A区</option>-->
                                    <!--<option value="2" <?php if($info["area"] == 2): ?>selected<?php endif; ?>>B区</option>-->
                                    <!--</select>-->
							</td>
							<td class="col-lg-3">成员等级：</td>
							<td>
								<!--<select id="level" class="form-control">-->
									<!--<?php if(is_array($levelinfo)): $i = 0; $__LIST__ = $levelinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
										<!--<?php if($vo['id'] == $info['level']): ?>-->
										<!--<option  value="<?php echo ($vo["id"]); ?>" selected /><?php echo ($vo["name"]); ?> [价格:<?php echo ($vo["money"]); ?>]</option>-->
											<!--<?php else: ?>-->
											<!--<option  value="<?php echo ($vo["id"]); ?>" /><?php echo ($vo["name"]); ?> [价格:<?php echo ($vo["money"]); ?>]</option>-->
										<!--<?php endif; ?>-->
									<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
								<!--</select>-->
								<!--<input id="ylevel" value="<?php echo ($info['level']); ?>" type="hidden"/>-->
							</td>
						</tr>
						<tr>
							<td class="col-lg-3">推荐人：</td>
							<td><?php echo ($info["rusername"]); ?></td>
							<!--<td><input type="text"  id="recmid"  value="<?php echo ($info["rusername"]); ?>"  style="color:#666;"/></td>-->
							<td class="col-lg-3">安置人：</td>
							<!--<td><input type="text"  id="parentid"  value="<?php echo ($info["pusername"]); ?>"  style="color:#666;"/></td>-->
							<td><?php echo ($info["pusername"]); ?></td>
						</tr>
						<tr>
							<td class="col-lg-3">代理中心：</td>
							<td><?php echo ($info["centername"]); ?></td>
							<!--<td class="col-lg-3">单类型：</td>-->
							<!--<td>-->
							<!--<select id="single" class="form-control"></select>-->
							<!---->
							<!--</td>-->
							<td class="col-lg-3">奖金是否发放：</td>
							<td>
								<select id="single" class="form-control"></select>

							</td>
						</tr>
						<tr>
							<td class="col-lg-3">创建时间：</td>
							<td><?php echo (date("Y-m-d H:i:s",$info["reg_time"])); ?></td>
							<td class="col-lg-3">编辑时间：</td>
							<td><?php echo (date("Y-m-d H:i:s",$info["after_time"])); ?></td>
						</tr>
						<tr>
							<td>
								<br>
								<div class="col-sm-3 col-sm-offset-2" style="display: none;">
									<input id="id" name="id" value="<?php echo ($info["user_id"]); ?>" type="hidden">
									<button id="btn_enter" class="btn btn-primary" type="button">升级</button>
								</div>
								<?php if($info["user_id"] != 1): ?><div class="col-sm-4">
									<button  id="btn_reset" class="btn btn-primary"  onclick="reset();"  type="button">重置密码</button>
								</div>

								<div class="col-sm-3 ">
									<button  id="btn_update" class="btn btn-primary"  onclick="update();"  type="button">修改</button>
								</div><?php endif; ?>
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
                var newlevel = m.node("#level").value();
                var level = m.node("#ylevel").value();

                if (level == newlevel) {
                    engine.news("两次所选等级一样,升级失败", 3000);
                    return;
                }

                if (newlevel < level) {
                    engine.news("等级比原来等级低,升级失败", 3000);
                    return;
                }


                engine.news("正在提交...", 99999, true);
                var ajax = m.ajax("<?php echo U('Admin/User/api_sortlist_upgrade');?>", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case 0:
                            engine.news("升级成功", 3000);
                            m.reload(true);
                            break;
                        case -10000:
                            engine.news("升级失败", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("user_id", id);
                ajax.data.add("level", level);
                ajax.data.add("newlevel", newlevel);
                ajax.send();
            },
            init: function () { }
        }
        pck.init();
        $(function () {
        	engine.ajax.membergrant(0, function (json) {
                var selt = m.node("#single");
                selt.html("");
                for (var i in json) {
                    selt.append("<option value='" + json[i].id + "'>" + json[i].name  + "</option>");
                }
                m.node("#single").value("<?php echo $info['grant']; ?>");
        	});
            m.node("#btn_enter").click(pck.submit);
        });
        
        function reset(){
        	var id = $('#id').val();
        	var val =  confirm('确定重置密码?');
        	if(val){
        		engine.news("正在重置...", 99999, true);
        		 $.post("/Admin/User/reset_password",{user_id:id},function(str){
        			    result = eval('(' + str + ')');
        			  //  alert(result.Data);
        			    engine.news(result.Data, 3000);
        			  });
        	}
        }
        
        function update(){
        	var id = $('#id').val();
//        	var area  = $('#area').val();
//        	var recmid = $('#recmid').val();
//        	var parentid = $('#parentid').val();
        	var single = $('#single').val();
//        	var val =  confirm('确定修改?');
//        	if(val){
        		engine.news("正在修改...", 99999, true);
//        		 $.post("/Admin/User/api_update_grant_submit",{'id':id,'area':area,'recmid':recmid,'parentid':parentid,'single':single},function(str){
        		 $.post("/Admin/User/api_update_grant_submit",{'id':id,'single':single},function(str){
        			    result = eval('(' + str + ')');
        			  //  alert(result.Data);
        			    engine.news(result.Data, 3000);
        			  });
//        	}
        }
	</script>
</section>