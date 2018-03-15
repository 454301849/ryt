<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<title>系统管理后台</title>

	<link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
	<link href="/Public/admin/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/Public/admin/css/engine.css" rel="stylesheet" />
	<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />

	<style>
		body{background-image:url('/Public/images/max.jpg');
			background-repeat:no-repeat;
			background-attachment:fixed;
			background-size:cover;
			/*-webkit-touch-callout: none;*/
			/*-webkit-user-select: none;*/
			/*-khtml-user-select: none;*/
			/*-moz-user-select: none;*/
			/*-ms-user-select: none;*/
			/*user-select: none;*/
			line-height:19px;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Images/background/001/max.jpg',sizingMethod='scale');}
	</style>

	<style type="text/css">
		.bg-glass{background-color:none;}
		.list-group-item,.list-group-item:hover,.list-group-item:focus{background-color:transparent !important;color:#fff !important;border:none}
		.table-newbordered{
			-moz-border-bottom-colors: none;
			-moz-border-left-colors: none;
			-moz-border-right-colors: none;
			-moz-border-top-colors: none;
			border-collapse: separate;
			border-color: #ddd #ddd #ddd -moz-use-text-color;
			border-image: none;
			border-radius: 4px;
			border-style: solid solid solid none;
			border-width: 1px 1px 1px 0;
		}
		.table-newbordered th, .table-newbordered td {
			border-left: 1px solid #ddd;
		}
		.table th, .table td {
			padding: 8px;
			text-align: center;
		}
		img{
			height:30px;
		}
		.tablebcolor{
			background: #0B7EBF;
			/*color: ;*/
		}
		.tablebcolor1{
			background: firebrick;
		}
		.tablebcolor2{
			background: #0bb20c;
		}
		.tablebcolor3{
			background: #8c3900;
		}
		.tablebcolor4{
			background: darkmagenta;
		}
		.tablebcolor5{
			background: #1006F1;
		}
		ul{ width: 100%; margin: 0; padding: 0; overflow: auto;}
		ul li{ float: right;width:4%;text-align: center;color: #fff;}
		@media screen and (max-width:1200px) {
			#one{
				width: 50%;
			}
		}
	</style>
	<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
	<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<body >

<section>
	<div class="content-wrapper">

		<h3>
			会员网络图
		</h3>
		<div class="panel panel-default" style="margin-bottom:12px;">
			<div class="input-group">
				<input type="text" class="form-control" id="search_id" style="height:35px;" value="<?php echo ($info["user_name"]); ?>" placeholder="请输入会员编号">
				<span class="input-group-btn">
            <button class="btn btn-default" onclick="pck.search()" style="margin-left: 2px;z-index: 2;border-radius:4px;height: 35px;" type="button">查询数据</button>
        </span>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<ul style="list-style: none;" id="one">
					<li class="tablebcolor" >未激活</li>
					<li class="tablebcolor1">普卡会员</li>
					<li class="tablebcolor2">金卡会员</li>
					<li class="tablebcolor3">钻卡会员</li>
					<!--<li class="tablebcolor4">金钻会员</li>-->
					<!--<li class="tablebcolor5">省代理</li>-->
				</ul>
				<div class="table-responsive">
					<table  width="100%" height="500" cellpadding="3" cellspacing="1" border="0" align="center" >
						<td  height="120" colspan="6" align="center">
							<table   title="<?php echo ($info['name']); ?>" class="tablebcolor<?php echo ($info['register'] == 1 ?$info['level']:''); ?>" width="120"  cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1" >
								<tr>
									<td  colspan="2" align="center">
										<font color="#fff"><?php echo ($info['user_name']?$info['user_name']:'--'); ?></font>
									</td>
								</tr>
								<tr>
									<td  colspan="2" align="center"><?php echo ($info['truename']?$info['truename']:'--'); ?></td>
								</tr>
								<tr>
									<?php if($info['reg_time'] == '0' or $ainfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
										<?php else: ?>
									<td  colspan="2" align="center"><?php echo (date("Y-m-d",$info["reg_time"])); ?></td><?php endif; ?>

								</tr>
								<tr>
									<td colspan="2" align="center"><font color="#000"><?php echo ($info['recount']?$info['recount']:'0'); ?></font></td>
								</tr>
								<tr>
									<td align="center" ><font color="#000"><?php echo ($info['area1']?$info['area1']:'0'); ?></font></td>
									<td align="center" ><font color="#000"><?php echo ($info['area2']?$info['area2']:"0"); ?></font></td>
								</tr>
								<tr>
									<td colspan="2" align="center" ><font color="#000"><?php echo ($info['plevel']?$info['plevel']:'0'); ?>层</font></td>
								</tr>
							</table></td>
						</tr>
						<tr>
							<td height="36" colspan="6" align="center" style="padding: 6px;">
								<img src="/Public/admin/images/t_tree_bottom_l.png"  height="30">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30"  style="margin-left: -0.7%">
								<img src="/Public/admin/images/t_tree_top.png"  height="30"  style="margin-left: -0.7%;margin-right: -0.7%">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30"  style="margin-right: -0.7%">
								<img src="/Public/admin/images/t_tree_bottom_r.png" height="30"></td>
						</tr>
						<tr>
							<td width="50%" height="103" colspan="2"  align="center">
								<table title="<?php echo ($ainfo['name']); ?>" class="tablebcolor<?php echo ($ainfo['register'] == 1 ?$ainfo['level']:''); ?>" width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($info['user_id'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($ainfo['user_name'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$info['user_name'],'area'=>'1'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$ainfo['user_name']));?>" target="main-frame"><?php echo ($ainfo['user_name']); ?></a>
												</td><?php endif; endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><?php echo ($ainfo['truename']?$ainfo['truename']:'--'); ?></td>
									</tr>
									<tr>
										<?php if($ainfo['reg_time'] == '0' or $ainfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$ainfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><font color="#000"><?php echo ($ainfo['recount']?$ainfo['recount']:'0'); ?></font></td>
									</tr>
									<tr>
										<td  align="center" ><font color="#000"><?php echo ($ainfo['area1']?$ainfo['area1']:'0'); ?></font></td>
										<td  align="center" ><font color="#000"><?php echo ($ainfo['area2']?$ainfo['area2']:"0"); ?></font></td>
									</tr>
									<tr>
										<td colspan="2" align="center" ><font color="#000"><?php echo ($ainfo['plevel']?$ainfo['plevel']:'0'); ?>层</font></td>
									</tr>
								</table></td>
							<td width="50%" colspan="4" align="center">
								<table title="<?php echo ($binfo['name']); ?>" class="tablebcolor<?php echo ($binfo['register'] == 1 ?$binfo['level']:''); ?>"  width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($info['user_id'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($binfo['user_name'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$info['user_name'],'area'=>'2'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$binfo['user_name']));?>" target="main-frame"><?php echo ($binfo['user_name']); ?></a>
												</td><?php endif; endif; ?>
									</tr>
									<tr>
										<td style="" colspan="2" align="center"><?php echo ($binfo['truename']?$binfo['truename']:'--'); ?></td>
									</tr>
									<tr>
										<?php if($binfo['reg_time'] == '0' or $binfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$binfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><font color="#000"><?php echo ($binfo['recount']?$binfo['recount']:'0'); ?></font></td>
									</tr>
									<tr>
										<td  align="center" ><font color="#000"><?php echo ($binfo['area1']?$binfo['area1']:'0'); ?></font></td>
										<td  align="center" ><font color="#000"><?php echo ($binfo['area2']?$binfo['area2']:"0"); ?></font></td>
									</tr>
									<tr>
										<td  colspan="2" align="center" ><font color="#000"><?php echo ($binfo['plevel']?$binfo['plevel']:'0'); ?>层</font></td>
									</tr>

								</table></td>
						</tr>
						<tr>
							<td height="36" colspan="2" align="center" style="padding: 6px;">
								<img src="/Public/admin/images/t_tree_bottom_l.png" alt=""  height="30">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30" style="margin-left: -1%">
								<img src="/Public/admin/images/t_tree_top.png" alt=""  height="30" style="margin-left: -1%;margin-right: -1%">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30" style="margin-right: -1%">
								<img src="/Public/admin/images/t_tree_bottom_r.png" alt="" height="30"></td>
							<td colspan="4" align="center">
								<img src="/Public/admin/images/t_tree_bottom_l.png" alt=""  height="30">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30" style="margin-left: -1%">
								<img src="/Public/admin/images/t_tree_top.png" alt=""  height="30" style="margin-left: -1%;margin-right: -1%">
								<img src="/Public/admin/images/t_tree_line.png" alt=""  width="25%" height="30" style="margin-right: -1%">
								<img src="/Public/admin/images/t_tree_bottom_r.png" alt="" height="30"></td>
						</tr>
						<tr>
							<td align="center" valign="top">
					<table title="<?php echo ($alinfo['name']); ?>"  class="tablebcolor<?php echo ($alinfo['register'] == 1 ?$alinfo['level']:''); ?>" width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($ainfo['user_id'] == ''): ?><td style=" font-color:black;" colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($alinfo['user_name'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$ainfo['user_name'],'area'=>'1'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td style=" font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$alinfo['user_name']));?>" target="main-frame"><?php echo ($alinfo['user_name']); ?></a>
												</td><?php endif; endif; ?>
									</tr>
									<tr>
										<td colspan="2" align="center"><?php echo ($alinfo['truename']?$alinfo['truename']:'--'); ?></td>
									</tr>
									<tr>
										<?php if($alinfo['reg_time'] == '0' or $alinfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$alinfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><font color="#000"><?php echo ($alinfo['recount']?$alinfo['recount']:'0'); ?></font></td>
									</tr>
									<tr>
										<td  align="center" ><font color="#000"><?php echo ($alinfo['area1']?$alinfo['area1']:'0'); ?></font></td>
										<td  align="center" ><font color="#000"><?php echo ($alinfo['area2']?$alinfo['area2']:"0"); ?></font></td>
									</tr>
									<tr>
										<td colspan="2" align="center" ><font color="#000"><?php echo ($alinfo['plevel']?$alinfo['plevel']:'0'); ?>层</font></td>
									</tr>

								</table></td>
							<td align="center" valign="top">
								<table title="<?php echo ($arinfo['name']); ?>" class="tablebcolor<?php echo ($arinfo['register'] == 1 ?$arinfo['level']:''); ?>" width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($ainfo['user_id'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($arinfo['user_name'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$ainfo['user_name'],'area'=>'2'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$arinfo['user_name']));?>" target="main-frame"><?php echo ($arinfo['user_name']); ?></a>
												</td><?php endif; endif; ?>

									</tr>
									<tr>
										<td  colspan="2" align="center"><?php echo ($arinfo['truename']?$arinfo['truename']:'--'); ?></td>									</tr>
									</tr>
									<tr>
										<?php if($arinfo['reg_time'] == '0' or $arinfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$arinfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><font color="#000"><?php echo ($arinfo['recount']?$arinfo['recount']:'0'); ?></font></td>
									</tr>
									<tr>
										<td  align="center" ><font color="#000"><?php echo ($arinfo['area1']?$arinfo['area1']:'0'); ?></font></td>
										<td  align="center" ><font color="#000"><?php echo ($arinfo['area2']?$arinfo['area2']:"0"); ?></font></td>
									</tr>
									<tr>
										<td  colspan="2" align="center" ><font color="#000"><?php echo ($arinfo['plevel']?$arinfo['plevel']:'0'); ?>层</font></td>
									</tr>

								</table></td>
							<td align="center" valign="top">
								<table title="<?php echo ($blinfo['name']); ?>" class="tablebcolor<?php echo ($blinfo['register'] == 1 ?$blinfo['level']:''); ?>" width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($binfo['user_id'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($blinfo['user_name'] == ''): ?><td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$binfo['user_name'],'area'=>'1'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td style="font-color:black;" colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$blinfo['user_name']));?>" target="main-frame"><?php echo ($blinfo['user_name']); ?></a>
												</td><?php endif; endif; ?>

									</tr>
									<tr>
										<td colspan="2" align="center"><?php echo ($blinfo['truename']?$blinfo['truename']:'--'); ?></td>									</tr>
									</tr>
									<tr>
										<?php if($blinfo['reg_time'] == '0' or $blinfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$blinfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><font color="#000"><?php echo ($blinfo['recount']?$blinfo['recount']:'0'); ?></font></td>
									</tr>
									<tr>
										<td   align="center" ><font color="#000"><?php echo ($blinfo['area1']?$blinfo['area1']:'0'); ?></font></td>
										<td   align="center" ><font color="#000"><?php echo ($blinfo['area2']?$blinfo['area2']:"0"); ?></font></td>
									</tr>
									<tr>
										<td style="" colspan="2" align="center" ><font color="#000"><?php echo ($blinfo['plevel']?$blinfo['plevel']:'0'); ?>层</font></td>
									</tr>
								</table></td>
							<td colspan="3" align="center" valign="top">
								<table title="<?php echo ($brinfo['name']); ?>" class="tablebcolor<?php echo ($brinfo['register'] == 1 ?$brinfo['level']:''); ?>"  width="120" cellpadding="3" cellspacing="1" border="1px solid red;" align="center" class="table1">
									<tr>
										<?php if($binfo['user_id'] == ''): ?><td colspan="2" align="center">
												--
											</td>
											<?php else: ?>
											<?php if($brinfo['user_name'] == ''): ?><td colspan="2" align="center">
													<a href="<?php echo U('User/register',array('user_name'=>$binfo['user_name'],'area'=>'2'));?>" target="main-frame">注册</a>
												</td>
												<?php else: ?>
												<td  colspan="2" align="center">
													<a href="<?php echo U('User/memberlists',array('user_name'=>$brinfo['user_name']));?>" target="main-frame"><?php echo ($brinfo['user_name']); ?></a>
												</td><?php endif; endif; ?>

									</tr>
									<tr>
										<td  colspan="2" align="center"><?php echo ($brinfo['truename']?$brinfo['truename']:'--'); ?></td>
									</tr>
									<tr>
										<?php if($brinfo['reg_time'] == '0' or $brinfo['reg_time'] == ''): ?><td  colspan="2" align="center">--</td>
											<?php else: ?>
											<td  colspan="2" align="center"><?php echo (date("Y-m-d",$brinfo["reg_time"])); ?></td><?php endif; ?>
									</tr>
									<tr>
										<td  colspan="2" align="center"><?php echo ($brinfo['recount']?$brinfo['recount']:'0'); ?></td>
									</tr>
									<tr>
										<td  align="center" ><?php echo ($brinfo['area1']?$brinfo['area1']:'0'); ?></td>
										<td  align="center" ><?php echo ($brinfo['area2']?$brinfo['area2']:"0"); ?></td>
									</tr>
									<tr>
										<td  colspan="2" align="center" ><?php echo ($brinfo['plevel']?$brinfo['plevel']:'0'); ?>层</td>
									</tr>

								</table></td>
						</tr>
					</table>

				</div>
			</div>
		</div>

	</div>
</section>
<script type="text/javascript">
    var pck = {
        search: function () {
            var rootid = m.node("#search_id").value();
            //非空判断
			console.log(rootid);
            if (rootid.length <= 0) {
                engine.news("请输入要查询的编号", 3000);
                return;
            }
            m.redirect("../User/memberlists?user_name=" + rootid);
        },
        init: function () {
            m.node("#btn_enter").click(pck.search);
        }
    }
    pck.init();
</script>

</body></html>