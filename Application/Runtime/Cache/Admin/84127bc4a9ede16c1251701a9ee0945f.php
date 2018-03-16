<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<title>系统管理后台</title>
	<link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
	<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
	<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
	<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
	<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/Public/admin/css/engine.css" rel="stylesheet" />
	<style>
		body{background-image:url('/Public/images/max.jpg');
			background-repeat:no-repeat;
			background-attachment:fixed;
			background-size:cover;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Images/background/001/max.jpg',sizingMethod='scale');}
	</style>

	<style type="text/css">
		canvas { display: block; }
		.bg-glass{background-color:none;}
		.list-group-item,.list-group-item:hover,.list-group-item:focus{background-color:transparent !important;color:#fff !important;border:none}
	</style>
	<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/admin/js/pace.js"></script>
	<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
	<script type="text/javascript" src="/Public/admin/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.pie.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.resize.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.categories.js"></script>
	<script type="text/javascript" src="/Public/admin/js/flot/jquery.flot.spline.min.js"></script>
	<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
	<script src="/Public/js/Chart.js"></script>

<body >

<section>
	<div class="content-wrapper" >
		<div class="content-heading">
			首页概览
		</div>
		<?php if($admin_id == 1): ?><div class="col-lg-12 col-sm-12" >
			<div class="row" id="top_border">
				<div class="col-lg-6 col-sm-6">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-wallet fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($userinfo['jjb']?$userinfo['jjb']:0); ?></div>
								<div class="text-uppercase">提现</div>
							</div>
						</div>
					</div>
				</div>
				<!--
				<div class="col-lg-4 col-sm-4">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-star fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($userinfo['dzb']); ?></div>
								<div class="text-uppercase">升级币</div>
							</div>
						</div>
					</div>
				</div>-->
				<div class="col-lg-6 col-md-6">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-present fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($userinfo['gwb']?$userinfo['gwb']:0); ?></div>
<<<<<<< HEAD
								<div class="text-uppercase">购物积分</div>
=======
								<div class="text-uppercase">购物金币</div>
>>>>>>> 90ab59d2dd998b13d77950c4b00abf31d7c60712
							</div>
						</div>
					</div>
				</div>
				<!--
				<div class="col-lg-4 col-md-4">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-trophy fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($userinfo['sh']); ?></div>
								<div class="text-uppercase">税收</div>
							</div>
						</div>
					</div>
				</div>-->
				<div class="col-lg-6 col-md-6">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-chart fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($bobi['days']); ?></div>
								<div class="text-uppercase">今日拨比</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="panel widget bg-glass">
						<div class="row row-table">
							<div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
								<em class="icon-chart fa-3x"></em>
							</div>
							<div class="col-xs-8 pv-lg">
								<div class="h2 mt0"><?php echo ($bobi['zong']); ?></div>
								<div class="text-uppercase">总拨比</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-12">
							<div id="panelChart9" class="panel panel-default panel-demo">
								<div class="panel-heading">
									<div class="panel-title">收益动态</div>
								</div>
								<div class="panel-body" >
									<div id="canvas-holder">

									</div>
								</div>
								<!--<div class="panel-body">-->
								<!--<div class="chart-spline flot-chart" style="height:290px;background:rgba(255,255,255,0.3);"></div>-->
								<!--</div>-->
							</div>
						</div>
					</div>
				</div>

			</div>

		</div><?php endif; ?>
		<div class="col-lg-4 col-sm-4" style="display: none;" >
			<aside class="col-lg-12"  >
				<div class="panel panel-default"  style="height: 597px;">
					<div class="panel-heading">
						<div class="panel-title">信息资讯</div>
					</div>
					<div class="list-group">
						<div class="list-group-item">
							<div class="media-box">
								<div class="pull-left">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x text-light text-primary"></em>
                                <em class="fa fa-exclamation fa-stack-1x fa-inverse text-white"></em>
                            </span>
								</div>
								<div class="media-box-body clearfix">
									<small class="text-muted pull-right ml">10000[总部]</small>
									<div class="media-box-heading">
										<a href="#" class="m0">个人信息</a>
									</div>
									<p class="m0 row">
									<table cellpadding="0" cellspacing="0" style="width:100%;">
										<tr>
											<td style="font-weight:normal;text-align:left;width:45%;">级别：管理员</td>
											<td style="font-weight:normal;text-align:left">注册日：16/01/01</td>
										</tr>
									</table>
									</p>
								</div>
							</div>
						</div>
						<!--<div class="list-group-item">
							<div class="media-box">
								<div class="pull-left">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x text-light text-primary"></em>
                                <em class="fa fa-clock-o fa-stack-1x fa-inverse text-white"></em>
                            </span>
								</div>
								 <div class="media-box-body clearfix">
									<div class="media-box-heading">
										<a href="/Member/netchart">我的团队</a>
									</div>
									<p class="m0 row">
									<table cellpadding="0" cellspacing="0" style="width:100%;">
										<tr>
											<td style="font-weight:normal;text-align:left;width:33%;">直推：5</td>
											<td style="font-weight:normal;text-align:left;width:33%;">市场：2</td>
											<td style="font-weight:normal;text-align:left">团队：6</td>
										</tr>
									</table>
									</p>
								</div> 
							</div>
						</div>-->
						<div class="list-group-item" style="display: none;">
							<div class="media-box">
								<div class="pull-left">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x text-primary"></em>
                                <em class="fa fa-cloud-upload fa-stack-1x fa-inverse text-white"></em>
                            </span>
								</div>
								<div class="media-box-body clearfix">
									<small class="text-muted pull-right ml">0 条新消息</small>
									<div class="media-box-heading">
										<a href="/Mail/collectlists">我的收件箱</a>
									</div>
									<p class="m0">
										<small>
											<label style="font-weight:normal;">-</label>
										</small>
									</p>
								</div>
							</div>
						</div>
						<div class="list-group-item" style="display: none;">
							<div class="media-box">
								<div class="pull-left">
                            <span class="fa-stack">
                                <em class="fa fa-circle fa-stack-2x text-primary"></em>
                                <em class="fa fa-file-text-o fa-stack-1x fa-inverse text-white"></em>
                            </span>
								</div>
								<div class="media-box-body clearfix">
									<small class="text-muted pull-right ml">共1 条新闻</small>
									<div class="media-box-heading">
										<a href="/Notice/main">公告栏</a>
									</div>
									<p class="m0">
										<small>
											<label style="font-weight:normal;">人生所缺乏的不是才干而是志向，不...</label>
										</small>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer clearfix">

					</div>
				</div>
			</aside>
		</div>
	</div>
</section>

<script>

    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
        labels : ['<?php echo ($user_line["16"]["day"]); ?>', '<?php echo ($user_line["15"]["day"]); ?>',
            '<?php echo ($user_line["14"]["day"]); ?>', '<?php echo ($user_line["13"]["day"]); ?>',
            '<?php echo ($user_line["12"]["day"]); ?>', '<?php echo ($user_line["11"]["day"]); ?>',
            '<?php echo ($user_line["10"]["day"]); ?>', '<?php echo ($user_line["9"]["day"]); ?>',
            '<?php echo ($user_line["8"]["day"]); ?>', "<?php echo ($user_line["7"]["day"]); ?>",
            "<?php echo ($user_line["6"]["day"]); ?>","<?php echo ($user_line["5"]["day"]); ?>",
            "<?php echo ($user_line["4"]["day"]); ?>","<?php echo ($user_line["3"]["day"]); ?>",
            "<?php echo ($user_line["2"]["day"]); ?>","<?php echo ($user_line["1"]["day"]); ?>"],
        datasets : [
            {
                label: "会员增长",
                fillColor : "rgba(255,255,255,0.3)",
                strokeColor : "green",
                pointColor : "#44b549",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data : [
                    <?php echo ($user_line["16"]["num"]); ?>,<?php echo ($user_line["15"]["num"]); ?>,
                    <?php echo ($user_line["14"]["num"]); ?>,<?php echo ($user_line["13"]["num"]); ?>,
                    <?php echo ($user_line["12"]["num"]); ?>,<?php echo ($user_line["11"]["num"]); ?>,
                    <?php echo ($user_line["10"]["num"]); ?>,<?php echo ($user_line["9"]["num"]); ?>,
                    <?php echo ($user_line["8"]["num"]); ?>,<?php echo ($user_line["7"]["num"]); ?>,
                    <?php echo ($user_line["6"]["num"]); ?>,<?php echo ($user_line["5"]["num"]); ?>,
                    <?php echo ($user_line["4"]["num"]); ?>,<?php echo ($user_line["3"]["num"]); ?>,
                    <?php echo ($user_line["2"]["num"]); ?>,<?php echo ($user_line["1"]["num"]); ?>
                ]
            }
        ]

    }

    //定义图表的参数
    var defaults = {
        scaleStartValue :null,     // Y 轴的起始值
        scaleLineColor : "rgba(0,0,0,.1)",    // Y/X轴的颜色
        scaleLineWidth : 1,        // X,Y轴的宽度
        scaleShowLabels : true,    // 刻度是否显示标签, 即Y轴上是否显示文字
        scaleLabel : "<%=value%>", // Y轴上的刻度,即文字
        scaleFontFamily : "'Arial'",  // 字体
        scaleFontSize : 12,        // 文字大小
        scaleFontStyle : "normal",  // 文字样式
        scaleFontColor : "#fff",    // 文字颜色
        scaleShowGridLines : false,   // 是否显示网格
        scaleGridLineColor : "rgba(0,0,0,.05)",   // 网格颜色
        scaleGridLineWidth : 2,      // 网格宽度
        bezierCurve : true,         // 是否使用贝塞尔曲线? 即:线条是否弯曲
        pointDot : true,             // 是否显示点数
        pointDotRadius : 4,          // 圆点的大小
        pointDotStrokeWidth : 1,     // 圆点的笔触宽度, 即:圆点外层边框大小
        datasetStroke : true,        // 数据集行程
        datasetStrokeWidth : 2,      // 线条的宽度, 即:数据集
        datasetFill : false,         // 是否填充数据集
        animation : true,            // 是否执行动画
        animationSteps : 60,          // 动画的时间

        response:true, //自适应
        animationEasing : "easeOutQuart",    // 动画的特效
        onAnimationComplete : null    // 动画完成时的执行函数
    }

    window.onload = function(){
        var call = '';
        var testdiv = document.getElementById("canvas-holder");
        var top_border = screen.availHeight - $('#top_border').height() -337; //浏览器当前窗口可视区域高度

        testdiv.innerHTML="<canvas id='canvas' width='" + testdiv.clientWidth + "px' height='"+ top_border + "px'></vanvas>";

        var ctx = document.getElementById("canvas").getContext("2d");
        var canvas = document.querySelector("canvas");
        window.myLine = new Chart(ctx).Line(lineChartData,defaults);

    };
</script>
</body></html>