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
   转款记录
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="td-title col-sm-2 ">流水号：</td>
                        <td><?php echo ($dealid); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">转款人编号：</td>
                        <td><?php echo ($transfer_info["zusername"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">转款人姓名：</td>
                        <td><?php echo ($transfer_info["ztruename"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">收款人编号：</td>
                        <td><?php echo ($transfer_info["susername"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">收款人姓名：</td>
                        <td><?php echo ($transfer_info["struename"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">交易类型：</td>
                        <td>[转账]<?php if(($transfer_info["type"] == 1) ): ?>奖金币
										<?php elseif($transfer_info["type"] == 2): ?>购物币
										<?php else: ?> 其他<?php endif; ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">交易状态：</td>
                        <td>完成</td>
                    </tr>
                    <tr>
                        <td class="td-title">说明：</td>
                        <td>内部转账</td>
                    </tr>
                    <tr>
                        <td class="td-title">备注：</td>
                        <td><?php echo ($transfer_info["remarks"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">交易金额：</td>
                        <td><?php echo ($transfer_info["money"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">实际到帐：</td>
                        <td><?php echo ($transfer_info["money"]); ?></td>
                    </tr>
                    <tr>
                        <td class="td-title">处理时间：</td>
                        <td><?php echo (date("Y-m-d H:i:s",$transfer_info["createtime"])); ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
            </div>
        </section>