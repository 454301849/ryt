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
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
    .alert-success{
        background-color:transparent;
    }
</style>

<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
	<section>
		<div class="content-wrapper">

			<h3>
				会员列表
			</h3>
			<div class="panel panel-default">
    <div class="alert alert-success" style="padding:5px 10px;margin:15px 0;line-height:30px;">
                <div class="col-lg-2 col-md-2" style="padding:0;margin:3px;">
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-addon1">编号</span>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="输入编号查询" aria-describedby="sizing-addon1">
                    </div>
                </div>
                <div class="col-lg-2 col-md-2" style="padding:0;margin:3px;">
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-addon1">真实姓名</span>
                        <input type="text" class="form-control" name="truename" id="truename" placeholder="输入真实姓名查询" aria-describedby="sizing-addon1">
                    </div>
                </div>

                <div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-addon1">开始时间</span>
                        <input type="text" class="form-control" name="" id="start" placeholder="" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3" style="padding:0;margin:3px;">
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-addon1">结束时间</span>
                        <input type="text" class="form-control" name="" id="end" placeholder="" readonly>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1" style="padding:0;margin:3px;">
                    <div class="input-group input-group">
                        <input class="btn btn-default" type="submit" value="搜索" onclick="getpage(1)">
                    </div>
                </div>
                <div class="clearfix visible-xs-block"></div><div style="clear:both"></div>
            </div>
            <div id="list">
            </div>
    
</div>

<script src="/Public/admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/admin/js/bootstrap.min.js"></script>
<script src="/Public/laydate/laydate.js"></script>
<script src="/Public/admin/js/datetonuix.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput.js" type="text/javascript"></script>
<script src="/Public/admin/js/fileinput_locale_zh.js" type="text/javascript"></script>
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
        var user_name = $('#user_name').val();
        var type = $('#type').val();
        var truename = $('#truename').val();
        if($('#start').val() == '' ){
            var start = 0;
        }else{
            var start = $.myTime.DateToUnix($('#start').val());
        }
        if($('#end').val() == '' ){
            var end = 0;
        }else{
            var end = $.myTime.DateToUnix($('#end').val());
        }

        $('#list').html('<div style="text-align:center;margin-top:30px;"><img src="/Public/admin/images/loading.gif" width="60px" ></div>');
        $("#list").load(
            "<?php echo U('sortlists_ajax');?>?user_name="+user_name+"&p="+p+"&truename="+truename+"&start="+start+"&end="+end,
            function() {}
        );
    }



</script>
		</div>
	</section>