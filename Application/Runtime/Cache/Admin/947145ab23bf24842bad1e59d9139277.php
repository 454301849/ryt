<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<link rel="stylesheet" href="/Public/admin/css/bootstrap.min.css">
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
	.well{
	color:#fff;
	background-image:url('/Public/images/max.jpg');
	background-repeat:no-repeat;background-attachment:fixed;
	background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
	table th{
	color:#fff;
	background-image:url('/Public/images/max.jpg');
	background-repeat:no-repeat;background-attachment:fixed;
	background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
</style>
	
<section>
	<section>
		<div class="content-wrapper">

			<h3>
				商城设置
			</h3>
			<!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="background-color:transparent;">商城幻灯片</a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="background-color:transparent;">首页广告位</a></li>
			  </ul>
			  
		   <div class="tab-content well" style="margin-top:30px;border:1px solid #dddddd;padding:10px 2%;">
		   <div role="tabpanel" class="tab-pane active" id="home">
			
			<table class="table" style="font-size:14px;color:#fff;">
			<th>编号</th>
			<th>缩略图</th>
			<th>排序</th>
			<div style="clear:both"></div>
			<?php if(is_array($bannar)): $kk = 0; $__LIST__ = $bannar;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
				<td><?php echo ($kk); ?></td>
				<td ><img src="/<?php echo ($vv["pic_url"]); ?>" onclick="yulan(this)"></td>
				<td>
					<div class="code" data-toggle="tooltip" data-placement="bottom" title="点击修改排序" onclick="changeCode(this)"><?php echo ($vv["code"]); ?></div>
					<div class="form-inline" style="display:none;">
					<input type="text" class="form-control" style="width:50px;" name="code" value="<?php echo ($vv["code"]); ?>">
<<<<<<< HEAD
					<button class="btn btn-success btn-sm savecode" data="<?php echo ($vv["id"]); ?>" alt="bannar">保存</button>
=======
					<button class="btn btn-success btn-sm savecode" onclick="update(this,'<?php echo ($vv["id"]); ?>','bannar')" data="<?php echo ($vv["id"]); ?>" alt="bannar">保存</button>
>>>>>>> 0ca8b1786fe97b8790c8bf6865c940e58038204b
					</div>
					</td>
				<td class="text-right"><button class="btn btn-danger btn-sm" onclick="del(this,'<?php echo ($vv["id"]); ?>','bannar')">删除</button></td>
			  </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
			</table>
			<form action="/Admin/Shop/setting.html" method="post"  enctype="multipart/form-data">
			
			  <div class="form-group" style="margin-top:30px;">	
				 <label for="inputPassword3" class="col-sm-2 control-label" >添加新幻灯片</label>
				<div class="col-sm-10">					     
					 <input id="file-3" type="file" name="image[]" accept="image/*"  multiple=true>
					 <span style="color:#fff">上传封面图片为宽640px * 高320px</span>
					 <span class="help-block" style="color:red">上传多张时，选择时按键盘键 <kbd><kbd>ctrl</kbd> + <kbd>,</kbd></kbd> 完成多选</span>
				</div>
				<input type="hidden" name="uplode" value="1" >
			  </div>
			   <button type="submit" class="btn btn-default">保存</button>
			  </form>
			  <div style="clear:both"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="profile">
		
		<table class="table table-striped" style="font-size:14px;table-layout:fixed">
			<th>编号</th>
			<th>缩略图</th>
			<th style="width:40%;">广告地址</th>
			<th>排序</th>
			<div style="clear:both"></div>
			<?php if(is_array($ad)): $kk = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
				<td><?php echo ($vv["id"]); ?></td>
				<td ><img src="/<?php echo ($vv["pic_url"]); ?>" onclick="yulan(this)"></td>
				<td style="white-space: normal;text-overflow:ellipsis;overflow:hidden;font-size:12px;text-decoration:underline;width:40%;"><?php echo ($vv["link"]); ?></td>
				<td>
					<div class="code" data-toggle="tooltip" data-placement="bottom" title="点击修改排序" onclick="changeCode(this)"><?php echo ($vv["code"]); ?></div>
					<div class="form-inline" style="display:none;">
					<input type="text" class="form-control" style="width:50px;" name="code" value="<?php echo ($vv["code"]); ?>">
					<button class="btn btn-success btn-sm savecode" data="<?php echo ($vv["id"]); ?>" alt="ad">保存</button>
					</div>
					</td>
				<td class="text-right">
				<button class="btn btn-danger btn-sm" onclick="edit('<?php echo ($vv["id"]); ?>','<?php echo ($vv["link"]); ?>')">修改</button>
				<button class="btn btn-danger btn-sm" onclick="del(this,'<?php echo ($vv["id"]); ?>','ad')">删除</button>
				</td>
			  </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
			</table>
			 <div class="col-sm-12 text-center" id="ad-notice" style="margin-top:30px;border-top:2px solid #f6f6f6;line-height:50px;display:none;">
			 <button class="btn btn-link">修改下方信息后，点击保存完成修改流程，如果不更换广告图片无需重复上传图片</button>
			 </div>
			<form class="form-horizontal" action="/Admin/Shop/setting.html" method="post"  enctype="multipart/form-data">
			  <div class="form-group" style="margin-top:30px;">	
				 <label for="inputPassword3" class="col-sm-2 control-label">添加广告</label>
				<div class="col-sm-10">					     
					 <input id="file-4" type="file" class="form-control" name="image" accept="image/*"  multiple=true>
					 <span style="color:#fff">上传封面图片为宽640px * 高320px，</span>
				</div>
			  </div>
			  <div class="form-group" style="margin-top:30px;">	
				 <label for="inputPassword3" class="col-sm-2 control-label">广告链接地址</label>
				<div class="col-sm-10">					     
					 <input type="text" class="form-control" id="ad-link" name="link" value="" >
				</div>
			  </div>
			  <input type="hidden" name="ad" value="1" >
			  <input type="hidden" name="id" id="ad-edit" value="" >
<<<<<<< HEAD
			   <button type="submit" class="btn btn-default">保存</button>
=======
			  <button type="submit" class="btn btn-default">保存</button>
>>>>>>> 0ca8b1786fe97b8790c8bf6865c940e58038204b
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
			/*
			layer.open({
			    type: 1,
			    skin: 'layui-layer-demo', //样式类名
			    closeBtn: 0, //不显示关闭按钮
			    shift: 2,
			    shadeClose: true, //开启遮罩关闭
			    content: '内容'
			});*/
			$('.icon-large').click(function(){
				var id = $(this).attr('alt');
				var type = $(this).attr('data');
				var obj = $(this);
				var data = $(this).attr('data_id');//alert(data);
				$.ajax({
					type:'post',
					url:"<?php echo U('change_categrey_type');?>",
					dataType:'json',
					data:{'id':id,"type":type,'data':data},
					success:function(json){
						if(json.state == 1){
							$(obj).removeClass("icon-check-empty");$(obj).addClass("icon-check");
						}else{
							$(obj).removeClass("icon-check");$(obj).addClass("icon-check-empty");
						}
						$(obj).attr('data_id',json.state);
						layer.msg('更改状态成功', {icon: 1});
					},
					error:function(){
						layer.msg('通信通道发生错误！刷新页面重试！');
					}
				});
				
			});
			});
			function edit(id,link){
				$('#ad-notice').css("display","block");
				$('#ad-link').val(link);
				$('#ad-edit').val(id);
			}
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
			function changeCode(obj){
				$(obj).css("display","none");
				$(obj).next().next().css("display","block");
			}
			 var ue = UE.getEditor('editor');
			  imagePathFormat: "/images/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}";
			  /*
			  ["good_name"] => string(12) "的淡淡的"
			  ["cate_pid"] => string(1) "1"
			  ["code"] => string(1) "3"
			  ["id"] => string(0) ""
			  ["good_desc"]
			  */
			function del(obj,id,type){
				layer.confirm('确定要删除这条数据吗？', {
				  btn: ['确定','取消'] //按钮
				}, function(){
				  $.ajax({
						type:'post',
						url:"<?php echo U('del_shop_bannar');?>",
						dataType:'json',
						data:{'id':id,'type':type},
						success:function(){
							layer.msg('删除成功', {icon: 1});
							$(obj).parent().parent().remove();
						},
						error:function(){
							layer.msg('通信通道发生错误！刷新页面重试！');
						}
					});
				}, function(){
<<<<<<< HEAD
=======
				});
				
			}
			function update(obj,id,type,code){
				layer.confirm('确定要修改这条数据吗？', {
				  btn: ['确定','取消'] //按钮
				}, function(){
				  $.ajax({
						type:'post',
						url:"<?php echo U('change_shop_bannar');?>",
						dataType:'json',
						data:{'id':id,'type':type,'code':code},
						success:function(){
							layer.msg('修改成功', {icon: 1});
							$(obj).parent().parent().remove();
						},
						error:function(){
							layer.msg('通信通道发生错误！刷新页面重试！');
						}
					});
				}, function(){
>>>>>>> 0ca8b1786fe97b8790c8bf6865c940e58038204b
				  
				});
				
			}
			function check(){
				if($('#good_name').val()==""){layer.msg("商品名称不能为空");return false;}
				if($('#cate_pid').val()==""){layer.msg("商品必须选择分类");return false;}
				if($('#good_price').val()==""){layer.msg("商品价格不能为空");return false;}
				if($('#market_price').val()==""){layer.msg("市场价格不能为空");return false;}
				if($('#number').val()==""){layer.msg("库存不能为空");return false;}
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