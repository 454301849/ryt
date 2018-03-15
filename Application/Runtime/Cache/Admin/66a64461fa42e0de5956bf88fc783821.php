<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/css/weui.min.css">
<link rel="stylesheet" href="/Public/admin/css/base.css">
<link href="/Public/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

<style>
.btn-default{background:#44b549;color:#fff;}
.form-group1:hover{background:#fff;}
body {
	background-image:url('/Public/images/max.jpg');
	background-repeat:no-repeat;background-attachment:fixed;
	background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
</style>
	
<section>
	<section>
		<div class="content-wrapper">

			<h3>
				添加分类
			</h3>
			<!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="background-color:transparent;">新分类信息</a></li>
			<li role="presentation"><a href="javascript:void(0);" onclick="history.go(-1);" style="background-color:transparent;">返回上一页</a></li>
		  </ul>
			  
		 <!-- Tab panes -->
				  <div class="tab-content" style="margin-top:30px;border:1px solid #dddddd;padding:10px 2%;color:#fff;">
				  
					<div role="tabpanel" class="tab-pane active" id="home">
<<<<<<< HEAD
					<form class="form-horizontal" action="/Admin/Shop/categreyadd.html?cate_id=3" method="post" onsubmit="return check();" enctype="multipart/form-data" >
=======
					<form class="form-horizontal" action="/Admin/Shop/categreyadd.html" method="post" onsubmit="return check();" enctype="multipart/form-data" >
>>>>>>> 0ca8b1786fe97b8790c8bf6865c940e58038204b
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="cate_name" name="cate_name" value="<?php echo ($cate_info['cate_name']); ?>" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">顶级分类</label>
							<div class="col-sm-3">
								<select class="form-control" name="pid">
								
								<?php if($cate_info['pid'] == '0' ): ?><option value="0">顶级分类</option>
								<?php else: ?>
								<option value="0">作为顶级分类</option>
								<?php if(is_array($cate_pid)): $i = 0; $__LIST__ = $cate_pid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if($cate_info['pid'] != '' ): ?><option value="<?php echo ($vv["cate_id"]); ?>" <?php if($cate_info['pid'] == $vv["cate_id"] ): ?>selected<?php endif; ?> ><?php echo ($vv["cate_name"]); ?></option><?php endif; ?>
								 <?php if($cate_info['pid'] == '' ): ?><option value="<?php echo ($vv["cate_id"]); ?>" <?php if($cate_info['pid'] == $vv["cate_id"] ): ?>selected<?php endif; ?> ><?php echo ($vv["cate_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
								
								</select>
							</div>
						</div>
						<?php if($cate_info['pid'] != '' ): ?><div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">幻灯片<?php echo ($kk); ?></label>
							<div class="col-sm-7">
							  <input type="text"  class="form-control" name="pic_url" value="<?php echo ($cate_info["pic_url"]); ?>" placeholder="" readonly>				  
							</div>
							<div class="col-sm-1">
								<button type="button" onclick="yulan(this)"  class="btn btn-success">预览</button>		  
							</div>					    
						</div><?php endif; ?>
						<div class="form-group">	
							<label for="inputPassword3" class="col-sm-2 control-label">分类图标</label>
							<div class="col-sm-10">					     
								 <input id="file-3" type="file" name="image" accept="image/*"  multiple=true>
								 <span style="color:#fff">分类图片建议宽150px * 高150px</span>
							</div>	
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">排序</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="code" name="code" value="<?php echo ($cate_info['code']); ?>" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">首页显示</label>
							<div class="col-sm-3">
								<select class="form-control" name="is_show">
								<option value="0" <?php if($cate_info['is_show'] == 0 ): ?>selected<?php endif; ?> >不显示</option>
								<option value="1" <?php if($cate_info['is_show'] == 1 ): ?>selected<?php endif; ?> >显示</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">隐藏该类</label>
							<div class="col-sm-3">
								<select class="form-control" name="hidden" id="pid">
								
								<option value="1" <?php if($cate_info['hidden'] == 1 ): ?>selected<?php endif; ?> >隐藏</option>
								<option value="0" <?php if($cate_info['hidden'] == 0 ): ?>selected<?php endif; ?> >不隐藏</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="type" value="<?php echo ($cate_info["cate_id"]); ?>">
						<div class="form-group">
							<div class="col-sm-5 text-center">
								<button type="submit" class="btn btn-default">保存信息</button>
							</div>
						</div>
						
						</form>
						  <div style="clear:both"></div>
					</div>
						
				</div>
			</div>

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/admin/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
		    <!-- 编辑器源码文件 -->
		<script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
		<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>
		<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>
		<script src="/Public/admin/layer/layer.js"></script>
		<script src="/Public/admin/js/ajaxfileupload.js"></script>
		<script>
		$(document).ready(function(){
		
		});
		function check(){
			if($('#cate_name').val()==""){layer.msg("商品名称不能为空");return false;}
		}
		function yulan(obj){
			var abc = $(obj).attr("class");
		 var url = $(obj).parent().prev().children().val();
			var yulan = layer.open({
				type: 1,
				title: false,
//				area: ['640px', '320px'],
				closeBtn: true,
				maxmin: true,
				shadeClose: true,
				skin: 'yulan',
				content: '<img src="/'+url+'" >'
			});	//layer.full(yulan);
		}	
			$("#file-3").fileinput({
					showUpload: false,
					showCaption: false,
					browseClass: "btn btn-default",
					fileType: "any",
			        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
				});
			$("#file-4").fileinput({
					showUpload: false,
					showCaption: false,
					browseClass: "btn btn-default",
					fileType: "any",
			        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
				});
		
		</script>
	</section>
</section>