<?php if (!defined('THINK_PATH')) exit();?>    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
                <thead>
                    <tr>
                       <td>序号</td>
                       <td>编号</td>
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
                        <td >日期</td>
                    </tr>
                </thead>
                <tbody>
                     <?php if(is_array($record)): $kk = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="form-item">
                            <td><?php echo ($kk); ?></td>
                                <td><?php echo ($vv["user_name"]); ?></td>
                                <td><?php echo ($vv["b0"]); ?></td>
                                <td><?php echo ($vv["tx"]); ?></td>
                                <td><?php echo ($vv["jf"]); ?></td>
                                <!--<td><?php echo ($vv["ax"]); ?></td>
                                <td><?php echo ($vv["sh"]); ?></td>-->
                                <td><?php echo ($vv["b5"]); ?></td>
                                <td><?php echo ($vv["b6"]); ?></td>
                                <td><?php echo ($vv["b3"]); ?></td>
                                <td><?php echo ($vv["b7"]); ?></td>
								 <td><?php echo ($vv["b8"]); ?></td>
                                <td><?php echo ($vv["bdate"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <center>
         <ul class="pagination" style="margin:0px;">
					<?php echo ($page); ?>
				</ul>
    </center>
    </div>