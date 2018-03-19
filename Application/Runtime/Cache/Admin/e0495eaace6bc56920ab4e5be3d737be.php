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
</style>
	<section>
		<div class="content-wrapper">
		<h3>
			奖金设置
		</h3>
		 <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist" >
     	    <li role="presentation" class="active"><a href="#shengji" aria-controls="shengji" role="tab" data-toggle="tab" style="background-color:transparent;">奖金设置</a></li>
		    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" style="background-color:transparent;">其它设置</a></li>
		  </ul>
			  
		  <!-- Tab panes -->
		  <div class="tab-content  well"  style="border:none;">
		    <div role="tabpanel" class="tab-pane active" id="shengji">
				<div class="">
					<form class="form-horizontal" action="/Admin/Daili/system.html" method="post" enctype="multipart/form-data"  >

						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">管理奖 设置</h5>
						<!--<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">领导奖上拿一代</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control" id="input4" name="first_ldsn" value="<?php echo ($daili_info[0]['first_ldsn']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div>-->
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">一代管理奖</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control" id="input4" name="first_ldxn" value="<?php echo ($daili_info[0]['first_ldxn']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">二代管理奖</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="second_ldxn" value="<?php echo ($daili_info[0]['second_ldxn']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">三代管理奖</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="third_ldxn" value="<?php echo ($daili_info[0]['third_ldxn']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">分享奖 设置</h5>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">分享奖</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control" id="input4" name="recommend" value="<?php echo ($daili_info[0]['recommend']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">见点奖 设置</h5>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">见点奖</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control" id="input4" name="first_jd" value="<?php echo ($daili_info[0]['first_jd']); ?>" placeholder="">
								<span class="input-group-addon">$</span>
							</div>
						</div>
						<!--<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">互助奖 设置</h5>-->

						<!-- <div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">互助奖上拿</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control" id="input4" name="hz_sn" value="<?php echo ($daili_info[0]['hz_sn']); ?>" placeholder="">
								<span class="input-group-addon">名</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">互助奖下拿</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="hz_xn" value="<?php echo ($daili_info[0]['hz_xn']); ?>" placeholder="">
								<span class="input-group-addon">名</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">量奖收入</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="hz_jq" value="<?php echo ($daili_info[0]['hz_jq']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div> -->
						<input type="hidden" name="daili_id" value="<?php echo ($daili_info[0]['id']); ?>" >
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default" onclick="if (confirm('确定要修改吗？')) return true; else return false;"> 保　存 </button>
					    </div>
					  </div>
					</form>
				</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="messages">
				<div class="">
					<form class="form-horizontal" action="/Admin/Daili/system.html" method="post" enctype="multipart/form-data"  >

						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">会员奖金分配 设置</h5>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">提现积分</label>
							<div class="input-group col-sm-2 ">
								<input type="text"  class="form-control"  id="input4" name="first_tx" value="<?php echo ($daili_info[0]['first_tx']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">购物积分</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="first_gw" value="<?php echo ($daili_info[0]['first_gw']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<!--<label for="inputPassword3" class="col-sm-2 control-label">爱心积分</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="first_axjj" value="<?php echo ($daili_info[0]['first_axjj']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>-->
						</div>
						<!--<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">税收</label>
							<div class="input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="shuishou" value="<?php echo ($daili_info[0]['shuishou']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div>-->
						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">提现设置</h5>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">提现手续费</label>
							<div class=" input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="tx_sxf" value="<?php echo ($daili_info[0]['tx_sxf']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<h5 class="alert alert-success" style="padding:5px 10px;line-height:30px;border-bottom:1px solid #fff;">服务网络设置</h5>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">区域管理奖</label>
							<div class=" input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="buygl" value="<?php echo ($daili_info[0]['buygl']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label">推荐奖</label>
							<div class=" input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="buytj" value="<?php echo ($daili_info[0]['buytj']); ?>" placeholder="">
								<span class="input-group-addon">%</span>
							</div>
							<!--<label for="inputPassword3" class="col-sm-2 control-label">报单费用</label>
							<div class=" input-group col-sm-2">
								<input type="text"  class="form-control" id="input4" name="first_bdxjf" value="<?php echo ($daili_info[0]['first_bdxjf']); ?>" placeholder="">
								<span class="input-group-addon">$</span>
							</div>-->

						</div>
					  <input type="hidden" name="daili_id" value="<?php echo ($daili_info[0]['id']); ?>" >
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
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>

</section>