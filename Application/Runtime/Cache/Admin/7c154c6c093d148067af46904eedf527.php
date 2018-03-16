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
</style>

<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
            <div class="content-wrapper">
                
<h3>
    奖金记录
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
                <thead>
                    <tr>
                        <td>总奖金</td>
                        <td>提现</td>
                        <td>积分</td>
                        <!--<td>爱心基金</td>
                        <td>税收</td>-->
                        <td>分享奖</td>
                        <td>见点奖</td>
                        <td>领导奖</td>
                        <td>区域管理奖</td> 
                        <td>推荐奖</td>
                        <td style="width:120px;">日期</td>
                    </tr>
                </thead>
                <tbody>
                     <?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="form-item">
                                <td><?php echo ($vv["b0"]); ?></td>
                                <td><?php echo ($vv["tx"]); ?></td>
                                <td><?php echo ($vv["jf"]); ?></td>
                               <!-- <td><?php echo ($vv["ax"]); ?></td>
                                <td><?php echo ($vv["sh"]); ?></td>-->
                                <td><?php echo ($vv["b5"]); ?></td>
                                <td><?php echo ($vv["b6"]); ?></td>
                                <td><?php echo ($vv["b3"]); ?></td>
                                <td><?php echo ($vv["b7"]); ?></td>
                                <td><?php echo ($vv["b8"]); ?></td>
                                <td><a href="/Admin/Deal/recorddetail?date=<?php echo ($vv["days"]); ?>"><?php echo ($vv["days"]); ?></a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <center>
         <ul class="pagination" style="margin:0px;">
					<?php echo ($page); ?>
				</ul>
    </center>

<!--隐藏域开始-->
<input type="hidden" class="HD_PAGE" value="0" />
<input type="hidden" class="HD_SIZE" value="20" />
<input type="hidden" class="HD_COUNT" value="77" />
<!--隐藏域结束-->
<script type="text/javascript">
    var pck = {
        page: 0,
        size: 0,
        count: 0,
        //����ҳ��
        init: function () {
            this.page = mtopt.parse.toInteger(m.node(".HD_PAGE").value());
            this.size = mtopt.parse.toInteger(m.node(".HD_SIZE").value());
            this.count = mtopt.parse.toInteger(m.node(".HD_COUNT").value());
        }
    }
    pck.init();
</script>
            </div>
        </section>