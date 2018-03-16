<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/engine.css" rel="stylesheet" />
<link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/css/weui.min.css">
<link rel="stylesheet" href="/Public/admin/css/base.css">
<link href="/Public/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<style>
.btn-default{background:#44b549;color:#fff;}
.form-group1:hover{background:#fff;}
.form-group{padding:10px 0;}
body {
	background-image:url('/Public/images/max.jpg');
	background-repeat:no-repeat;background-attachment:fixed;
	background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
	.well{
	color:#fff;
	border:none;
	background-image:url('/Public/images/max.jpg');
	background-repeat:no-repeat;
	background-size:cover;
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
	background-color: #05336f;
	color: #fff;
}
	.yangshi{
		margin-top: 5px;
		margin-left: -16px;
	}
	.yangshi1{
	margin-top: 5px;
}
</style>
	<section>
		<div class="content-wrapper">
		<h3>
			用户设置
		</h3>

		  <!-- Tab panes -->
		  <div class="tab-content  well" >
		    <div role="tabpanel" class="tab-pane active" id="shengji">
				<div class="" >
					<form class="form-horizontal" action="/Admin/Daili/memberlevel.html" method="post" enctype="multipart/form-data"  >

						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;width:250px;l">用户级别 设置</h5>
						<?php if(is_array($memberlevel_info)): $kk = 0; $__LIST__ = $memberlevel_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><div class="form-group" >
							<label for="inputPassword3" class=" control-label"  style="float:left;margin-left:28px;">名称</label>
							<div class="input-group col-sm-2 " >
								<input type="text"  class="form-control" id="input4" name="name<?php echo ($kk); ?>" value="<?php echo ($vv['name']); ?>" placeholder="">
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label">注册金额</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="money<?php echo ($kk); ?>" value="<?php echo ($vv['money']); ?>" placeholder="">
								<span class="input-group-addon">￥</span>
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label">二次购买</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="discount<?php echo ($kk); ?>" value="<?php echo ($vv['discount']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label">见点奖</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="jdlayer<?php echo ($kk); ?>" value="<?php echo ($vv['jd_layer']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">层</span>
							</div>
							<!--
							<label for="inputPassword3" class="col-sm-1 control-label">量奖%比</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="reward<?php echo ($kk); ?>" value="<?php echo ($vv['reward']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>-->
							<label for="inputPassword3" class="col-sm-1 control-label " style="margin-left:-20px;">分享封顶</label>
							<div class="input-group col-sm-2 yangshi">
								<input type="text"  class="form-control" id="input4" name="capmoney<?php echo ($kk); ?>" value="<?php echo ($vv['capdaymoney']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">￥</span>
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label" >一代管理</label>
							<div class="input-group col-sm-2 yangshi1">
								<input type="text"  class="form-control" id="input4" name="yi_glj<?php echo ($kk); ?>" value="<?php echo ($vv['yi_glj']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label ">二代管理</label>
							<div class="input-group col-sm-2 yangshi1">
								<input type="text"  class="form-control" id="input4" name="er_glj<?php echo ($kk); ?>" value="<?php echo ($vv['er_glj']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-1 control-label" >三代管理</label>
							<div class="input-group col-sm-2 yangshi1">
								<input type="text"  class="form-control" id="input4" name="san_glj<?php echo ($kk); ?>" value="<?php echo ($vv['san_glj']); ?>" placeholder="">
								<input type="hidden"  class="form-control" id="input4" name="id<?php echo ($kk); ?>"  value="<?php echo ($vv['id']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default" onclick="if (confirm('确定要修改吗？')) return true; else return false;"> 保　存 </button>
					    </div>
					  </div>
					</form>
				</div>
		    </div>
		 </div>
	</div>
</section>