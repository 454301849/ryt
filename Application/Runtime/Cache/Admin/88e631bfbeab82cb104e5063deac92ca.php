<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/admin/css/base.css">
<link href="/Public/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<div class="container-fluid main">
	<div class="main-top"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>代理管理</div>
	<div class="main-content">

		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">会员列表</a></li>		    
		  </ul>
		  
		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home">
				
				<div class="alert alert-success" style="padding:5px 10px;margin:15px 0;line-height:30px;">
					<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
						<div class="input-group input-group">
						  <span class="input-group-addon" id="sizing-addon1">会员名</span>
						  <input type="text" class="form-control" name="nickname" id="nickname" placeholder="输入会员名查询" aria-describedby="sizing-addon1">
						</div>
					</div>
					<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
						<div class="input-group input-group">
						  <span class="input-group-addon" id="sizing-addon1">会员ID</span>
						  <input type="text" class="form-control" name="user_id" id="user_id" placeholder="输入会员ID查询" aria-describedby="sizing-addon1">
						</div>
					</div>
					<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
						<div class="input-group input-group">
						  <span class="input-group-addon" id="sizing-addon1">关注状态</span>
						  <select class="form-control" name="subscribe" id="subscribe">
						  <option value="1">关注</option>
						  <option value="0">取消关注</option>
						  </select>
						</div>
					</div>
					<div class="col-lg-2 col-md-2" style="padding:0;margin:3px;">
						<div class="input-group input-group">
						  <input class="btn btn-default" type="submit" value="搜索" onclick="getpage(1)">
						</div>
					</div>
					 <div class="clearfix visible-xs-block"></div><div style="clear:both"></div>
				</div>
				<div id="list">
				<table class="table table-bordered table-hover" style="font-size:14px;">
					<th>昵称</th>
					<th>用户ID</th>
					<th>头像</th>
					<th>地区</th>
					<th>代理级别</th>
					<th>关注时间</th>
					<th>关注状态</th>
					<th>操作</th>
					<?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr id="<?php echo ($kk); ?>" style="font-size:13px;">
						<td><?php echo ($vv["nickname"]); ?></td>
						<td><?php echo ($vv["user_id"]); ?></td>
						<td><img src="<?php echo ($vv["headimgurl"]); ?>" width="30px"></td>
						<td><?php echo ($vv["country"]); ?>.<?php echo ($vv["province"]); ?>.<?php echo ($vv["city"]); ?></td>
						<td><?php echo ($vv["agent"]); ?></td>
						<td><?php echo ($vv["subscribe_time"]); ?></td>
						<td><?php if($vv["subscribe"] == 1 ): ?>关注<?php else: ?>取消关注<?php endif; ?></td>
						<td>
						<a href="<?php echo U('contact');?>?user_id=<?php echo ($vv["user_id"]); ?>"><button class="btn btn-default">族谱</button></a>
						<button class="btn btn-default" onclick="del(this,<?php echo ($vv["user_id"]); ?>)">删除</button>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
				<div class="pagelist"></div>
				</div>
		    </div>
		
		  </div>
		</div>
		
	</div>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>

<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>
<script src="/Public/admin/layer/layer.js"></script>
<script>
	$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
function getpage(p){
var nickname = $('#nickname').val();//alert(sn);
var user_id = $('#user_id').val();//alert(sn);
var subscribe = $('#subscribe').val();
	$('#list').html('<div style="text-align:center;margin-top:30px;"><img src="/Public/admin/images/loading.gif" width="60px" ></div>');
	$("#list").load(
		"<?php echo U('users_ajax');?>?nickname="+nickname+"&p="+p+"&user_id="+user_id+"&subscribe="+subscribe,
		function() {}
	);
}
function del(obj,id){
	//alert(id);
	layer.confirm('删除后无法恢复，确认删除吗', {
		btn: ['确认','取消'] //按钮
	}, function(){
		$.ajax({
			type: "POST",
			url: "<?php echo U('del');?>?time="+new Date(),
			dataType: "json",
			data: {
				"id":id,
			},
			success: function(json){
				layer.msg("删除成功");
				var td = $(obj).parent();//alert(a);
				td.parent().css("display","none");	
			},
			error:function(){	
			}
		});
	}, function(){
		
	});
	
	
}

</script>