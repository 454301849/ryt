<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" /><style>
	body{
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
	.table-bordered{
		border-width:0;
	}
	.alert-success{
		background-color:transparent;
	}
</style>

<script src="/Public/admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/laydate/laydate.js"></script>

<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script src="/Public/admin/js/datetonuix.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>

<section>
	<div class="content-wrapper">
		<h3>
			订单管理
		</h3>
		<div class="panel panel-default">
			<div class="alert alert-success" style="padding:5px 10px;margin:15px 0;line-height:30px;">
				<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
					<div class="input-group input-group">
						<span class="input-group-addon" id="sizing-addon1">订单号</span>
						<input type="text" class="form-control" name="order_sn" id="order_sn" placeholder="输入订单号查询" aria-describedby="sizing-addon1">
					</div>
				</div>
				<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
					<div class="input-group input-group">
						<span class="input-group-addon" id="sizing-addon1">支付状态</span>
						<select class="form-control" name="subscribe" id="is_true">
							<option value="">请选择</option>
							<option value="1">已支付</option>
							<option value="0">未支付</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
					<div class="input-group input-group">
						<span class="input-group-addon" id="sizing-addon1">订单状态</span>
						<select class="form-control" name="state" id="state">
							<option value="">请选择</option>
							<option value="0">未发货</option>
							<option value="1">已发货</option>
							<option value="2">已收货</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
					<div class="input-group input-group">
						<span class="input-group-addon" id="sizing-addon1">开始日</span>
						<input type="text" class="form-control" name="" id="start" placeholder="" readonly>
					</div>
				</div>
				<div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
					<div class="input-group input-group">
						<span class="input-group-addon" id="sizing-addon1">结束日</span>
						<input type="text" class="form-control" name="" id="end" placeholder="" readonly>
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
			</div>
		</div>


<script>
laydate.skin('yalan');
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD hh:mm:ss',
    //min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16 23:59:59', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY-MM-DD hh:mm:ss',
    min: laydate.now(),
    max: '2099-06-16 23:59:59',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);
</script>
<script src="/Public/admin/layer/layer.js"></script>
<script>
$(document).ready(function(){
getpage(1);
});

	$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
function getpage(p){
var order_sn = $('#order_sn').val();
var is_true = $('#is_true').val();
var state = $('#state').val();
if($('#start').val() == '' ){
	var start = 0;
}else{
	var start = $.myTime.DateToUnix($('#start').val());
}
var end = $.myTime.DateToUnix($('#end').val());
	$('#list').html('<div style="text-align:center;margin-top:30px;"><img src="/Public/admin/images/loading.gif" width="60px" ></div>');
	$("#list").load(
		"<?php echo U('order_ajax');?>?order_sn="+order_sn+"&p="+p+"&is_true="+is_true+"&state="+state+"&start="+start+"&end="+end,
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
	</div></section>