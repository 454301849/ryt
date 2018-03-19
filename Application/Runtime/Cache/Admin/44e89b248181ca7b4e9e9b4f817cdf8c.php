<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/admin/css/base.css">
<link href="/Public/admin/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<style>
	.btn-default{background:#44b549;color:#fff;}
	.form-group{padding:5px 0;}
</style>
<div class="container-fluid main">
	<div class="main-top"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"> </span> 会员注册</div>
	<div class="main-content">
		<div>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">

					<div class="well" style="margin-top:20px;padding-bottom:60px;">
						<h5 class="" style="padding:5px 10px;line-height:30px;"></h5>
						<form class="form-horizontal" action="/Admin/Daili/registes.html" method="post" enctype="multipart/form-data"  onsubmit="return check()">
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">1级代理名称</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="first_name" value="<?php echo ($daili_info[0]['first_name']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">1级代理价格</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="first_fee" value="<?php echo ($daili_info[0]['first_fee']); ?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">2级代理名称</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="second_name" value="<?php echo ($daili_info[0]['second_name']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">2级代理价格</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="second_fee" value="<?php echo ($daili_info[0]['second_fee']); ?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">3级代理名称</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="third_name" value="<?php echo ($daili_info[0]['third_name']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">3级代理价格</label>
								<div class="col-sm-4">
									<input type="text"  class="form-control" id="input4" name="third_fee" value="<?php echo ($daili_info[0]['third_fee']); ?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">1级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="first_hongbao" value="<?php echo ($daili_info[0]['first_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">2级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="second_hongbao" value="<?php echo ($daili_info[0]['second_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">3级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="third_hongbao" value="<?php echo ($daili_info[0]['third_hongbao']); ?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">4级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="four_hongbao" value="<?php echo ($daili_info[0]['four_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">5级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="five_hongbao" value="<?php echo ($daili_info[0]['five_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">6级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="six_hongbao" value="<?php echo ($daili_info[0]['six_hongbao']); ?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">7级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="seven_hongbao" value="<?php echo ($daili_info[0]['seven_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">8级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="eight_hongbao" value="<?php echo ($daili_info[0]['eight_hongbao']); ?>" placeholder="">
								</div>
								<label for="inputPassword3" class="col-sm-2 control-label">9级返红包金额</label>
								<div class="col-sm-2">
									<input type="text"  class="form-control" id="input4" name="nine_hongbao" value="<?php echo ($daili_info[0]['nine_hongbao']); ?>" placeholder="">
								</div>
							</div>
							<?php if(is_array($banner)): $kk = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "还没有上传幻灯片图片" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">幻灯片<?php echo ($kk); ?></label>
									<div class="col-sm-7">
										<input type="text"  class="form-control" name="pic_url[]" value="<?php echo ($vv["pic_url"]); ?>" placeholder="" readonly>
									</div>
									<div class="col-sm-1">
										<button type="button" onclick="yulan(this)"  class="btn btn-success">预览</button>
									</div>
									<div class="col-sm-1">
										<button type="button" onclick="del(this)" data="<?php echo ($vv["id"]); ?>"  class="btn btn-default">删除</button>
									</div>
								</div><?php endforeach; endif; else: echo "还没有上传幻灯片图片" ;endif; ?>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">添加新幻灯片</label>
								<div class="col-sm-10">
									<input id="file-3" type="file" name="image[]" accept="image/*"  multiple=true>
								</div>

							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">代理协议URL地址</label>
								<div class="col-sm-8">
									<input type="text"  class="form-control" id="input4" name="daili_url" value="<?php echo ($daili_info[0]['daili_url']); ?>" placeholder="">
								</div>
							</div>
							<input type="hidden" name="daili_id" value="<?php echo ($daili_info[0]['id']); ?>">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default"> 保　存 </button>
							</div>

						</form>
					</div>
				</div>


			</div>

		</div>

	</div>
</div>
<style>
	.yulan img{width:100%}
</style>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>


<script src="/Public/admin/js/area.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>
<script src="/Public/admin/layer/layer.js"></script>
<script>

    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    function yulan(obj){
        var abc = $(obj).attr("class");
        var url = $(obj).parent().prev().children().val();
        var yulan = layer.open({
            type: 1,
            title: false,
            //area: ['640px', '320px'],
            closeBtn: true,
            maxmin: true,
            shadeClose: true,
            skin: 'yulan',
            content: '<img src="/'+url+'">'
        });	//layer.full(yulan);
    }
    function yulan2(){
        var url = $('#pic_url2').val();
        if(url != '' ){
            layer.open({
                type: 1,
                title: false,
                area: ['320px', '450px'],
                closeBtn: true,
                maxmin: true,
                shadeClose: true,
                skin: 'yulan',
                content: '<img src="/'+url+'">'
            });
        }
    }
    function del(obj){
        layer.confirm('确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var id = $(obj).attr("data");
            $.ajax({
                type: "POST",
                url: "<?php echo U('delbanner');?>",
                dataType: "json",
                data: {"id":id},
                success: function(json){
                    if(json.success==1){
                        $(obj).parent().parent().css("display",'none');
                    }else{
                        layer.msg("处理失败，请重新尝试");
                    }
                },
                error:function(){
                    layer.msg("发生异常！");
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