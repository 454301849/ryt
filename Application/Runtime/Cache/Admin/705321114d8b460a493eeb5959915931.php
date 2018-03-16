<?php if (!defined('THINK_PATH')) exit();?> <link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
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
</style>

<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
            <div class="content-wrapper">
                
<h3>
   资金来源详情
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="td-title">相关编号：</td>
                        <td><?php echo ($record_info["yuser_name"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">会员编号：</td>
                        <td><?php echo ($record_info["user_name"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">总奖金：</td>
                        <td><?php echo ($record_info["fee"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">提现：</td>
                        <td><?php echo ($record_info["tx"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">积分：</td>
                        <td><?php echo ($record_info["jf"]); ?></td>
                    </tr>
					<!--
                    <tr>
                        <td class="td-title">爱心积分：</td>
                        <td><?php echo ($record_info["ax"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">税收：</td>
                        <td><?php echo ($record_info["sh"]); ?></td>
                    </tr>
					-->
					<?php $jtype = array( '1'=>'层奖', '2'=>'量奖', '3'=>'领导奖', '4'=>'互助奖', '5'=>'分享奖', '6'=>'见点奖', '7'=>'层奖', '8'=>'报单奖', ); ?>
                    <tr>
                        <td class="td-title">类型：</td>
                        <td><?php echo ($jtype[$record_info['type']]); ?></td>

                    <tr>
                        <td class="td-title">详情：</td>
                        <td><?php echo ($record_info["desc"]); ?></td>
                    </tr>

                    <tr>
                        <td class="td-title">处理时间：</td>
                        <td><?php echo ($record_info["bdate"]); ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
            </div>
        </section>