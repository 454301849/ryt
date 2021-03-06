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
				添加商品
			</h3>
			<!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="background-color:transparent;">商品参数</a></li>
				<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="background-color:transparent;">商品缩略图</a></li>
				<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" style="background-color:transparent;">商品详情</a></li>
				<li role="presentation"><a href="good.html"style="background-color:transparent;">返回上一页</a></li>
			  </ul>
			  
		 <!-- Tab panes -->
	  <form class="form-horizontal" action="/Admin/Shop/goodadd.html" method="post" onsubmit="" enctype="multipart/form-data" >
	  <div class="tab-content well" style="margin-top:30px;border:1px solid #dddddd;padding:10px 2%;">
	  
		<div role="tabpanel" class="tab-pane active" id="home">
			
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">商品名称</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="good_name" name="good_name" value="<?php echo ($good_info['good_name']); ?>" placeholder="">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">所属分类</label>
				<div class="col-sm-3">
					<select class="form-control" name="cate_gid" id="pid">
					<?php if(is_array($categrey)): $i = 0; $__LIST__ = $categrey;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["cate_id"]); ?>" <?php if($good_info['cate_gid'] == $vv["cate_id"] ): ?>selected<?php endif; ?> ><?php echo ($vv["cate_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
				<div class="col-sm-3">
				</div>
			</div>					
			<div class="form-group">

				<label for="inputEmail3" class="col-sm-2 control-label">奖金币</label>
				<div class="input-group col-sm-6">
				  <span class="input-group-addon" id="basic-addon1">￥</span>
					<input type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="good_price" name="good_price" value="<?php echo ($good_info['good_price']); ?>" placeholder="">

				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">市场价格</label>
				<div class="input-group col-sm-6">
				  <span class="input-group-addon" id="basic-addon1">￥</span>
															<!--加一个禁止输入特殊符号的限制-->
					<input type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="market_price" name="market_price" value="<?php echo ($good_info['market_price']); ?>" placeholder="">



				</div>
			</div>
			<!--  -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">商品库存</label>
				<div class="input-group col-sm-6">
				  <span class="input-group-addon" id="basic-addon1">正整数</span>


															<!--加一个禁止输入特殊符号的限制-->
					<input type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="number" name="number" value="<?php echo ($good_info['number']); ?>" placeholder="">
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="profile">
		<table class="table table-striped" style="font-size:14px;">
		 <tr>
			<th>编号</th>
			<th>缩略图</th>
			<th>排序</th>
		</tr>
			<?php if(is_array($bannar)): $kk = 0; $__LIST__ = $bannar;if( count($__LIST__)==0 ) : echo "暂无幻灯片" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr>
				<td><?php echo ($vv["id"]); ?></td>
				<td ><img src="/<?php echo ($vv["pic_url"]); ?>" onclick="yulan(this)"></td>
				<td>
					<div class="code" data-toggle="tooltip" data-placement="bottom" title="点击修改排序" onclick="changeCode(this)"><?php echo ($vv["code"]); ?></div>
					<div class="form-inline" style="display:none;">
					<input type="text" class="form-control" style="width:50px;" name="code" value="<?php echo ($vv["code"]); ?>">
					<button type="button" class="btn btn-success btn-sm savecode" data="<?php echo ($vv["id"]); ?>">保存</button>
					</div>
					</td>
				<td class="text-right"><button type="button" class="btn btn-danger btn-sm" onclick="del(this,'<?php echo ($vv["id"]); ?>')">删除</button></td>
			  </tr><?php endforeach; endif; else: echo "暂无幻灯片" ;endif; ?>
			</table>
			<div class="form-group" style="margin-top:30px;">	
				 <label for="inputPassword3" class="col-sm-2 control-label">添加新幻灯片</label>
				<div class="col-sm-10">					     
					 <input id="file-3" type="file" name="image[]" accept="image/*"  multiple=true>
					 <span style="color:#fff">上传封面图片为宽640px * 高320px</span>
					 <span class="help-block" style="color:red">上传多张时，选择时按键盘键 <kbd><kbd>ctrl</kbd> + <kbd>,</kbd></kbd> 完成多选</span>
				</div>
				
			  </div>
			  <div style="clear:both"></div>
		</div>
		<div role="tabpanel" class="tab-pane" id="messages">
		<div class="form-group">
			<div class="col-sm-12">
				<script id="editor" type="text/plain" name="good_desc" value="" style="width:100%;height:500px;"><?php echo ($good_info['good_desc']); ?></script>
			</div>
		</div>
		<input type="hidden" class="form-control" id="hidden" name="id" value="<?php echo ($good_info['good_id']); ?>" placeholder="">
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				   <button type="submit" class="btn btn-default">确认保存</button>
				</div>
			 </div>
		 <div style="clear:both"></div>
		</div>
		
	  </div>	
	</form>
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
			var val = $('#pid').val();
			change_pid(val);
			$('#pid').bind("change",function(){
				var v = $(this).val();
				change_pid(v);
		  });
		 $('.savecode').click(function(){
			var code = $(this).prev().val();
			var id = $(this).attr('data');
			var obj = $(this);
			$.ajax({
				type:'post',
				url:"<?php echo U('change_shop_pic');?>",
				dataType:'json',
				data:{'id':id,'code':code},
				success:function(){
					$(obj).parent().css("display","none");
					$(obj).parent().prev().css("display","block");
					$(obj).parent().prev().text(code);
				},
				error:function(){
					layer.msg('通信通道发生错误！刷新页面重试！');
				}
			});
			
		  });
		});
		function change_pid(v){
			$('#pid').parent().next().children().remove();
			$.each(<?php echo ($jscategrey); ?>,function(key,value){
				var html = '<select class="form-control" name="cate_pid" >';
				if(v == key && value){
					$.each(value,function(dd,vv){
						//<?php if($good_info['cate_gid'] == $vv["cate_id"] ): ?>selected<?php endif; ?> 
						if(vv.cate_id == "<?php echo ($good_info['cate_pid']); ?>"){
							html = html + "<option value='"+vv.cate_id+"' selected >"+vv.cate_name+"</option>";	
						}else{
							html = html + "<option value='"+vv.cate_id+"'>"+vv.cate_name+"</option>";	
						}
						
					});
				$('#pid').parent().next().html(html+"</select>");
				}	
			});
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
		function check(){
			if($('#good_name').val()==""){layer.msg("商品名称不能为空");return false;}
			if($('#cate_pid').val()==""){layer.msg("商品必须选择分类");return false;}
			if($('#good_price').val()==""){layer.msg("商品价格不能为空");return false;}
			if($('#market_price').val()==""){layer.msg("市场价格不能为空");return false;}
			if($('#number').val()==""){layer.msg("库存不能为空");return false;}
		}
		function del(obj,id){
			layer.confirm('确定要删除这条数据吗？', {
			  btn: ['确定','取消'] //按钮
			}, function(){
			  $.ajax({
					type:'post',
					url:"<?php echo U('del_good_pic');?>",
					dataType:'json',
					data:{'id':id},
					success:function(){
						layer.msg('删除成功', {icon: 1});
						$(obj).parent().parent().remove();
					},
					error:function(){
						layer.msg('通信通道发生错误！刷新页面重试！');
					}
				});
			}, function(){
			  
			});
			
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