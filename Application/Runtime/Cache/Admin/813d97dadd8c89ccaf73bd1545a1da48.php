<?php if (!defined('THINK_PATH')) exit();?>
<div class="panel-body">
            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
            <thead>
                <tr>
                    <td>序号</td>
                    <td>编号</td>
                    <td>手机号</td>
                    
                    <td>开户名</td>
                    <td>开户银行</td>
                    <td>卡号</td>
                    <td>开户地址</td>
                    
                    <td>金额</td>
                    <td>审核时间</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                  
                    <?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="pg-deal-list">
                        <td class="time"><?php echo ($kk); ?></td>
                        <td class="time"><?php echo ($vv["user_name"]); ?></td>
                         <td class="money"><?php echo ($vv["moblie"]); ?></td>
                         
                         <td class="money"><?php echo ($vv["bankuser"]); ?></td>
                         <td class="money"><?php echo ($vv["bank"]); ?></td>
                         <td class="money"><?php echo ($vv["bankno"]); ?></td>
                         <td class="money"><?php echo ($vv["bankname"]); ?></td>
                         
                         <td class="money"><?php echo ($vv["arrival"]); ?></td>
                        <td class="time">
                            <?php if(($vv["handletime"] == 0) ): else: ?> <?php echo (date('Y-m-d H:i:s',$vv["handletime"])); endif; ?>
                        </td>
                        <td class="state"><?php if(($vv["status"] == 1) ): ?>审核成功
                                    <?php elseif(($vv["status"] == 2)): ?>审核失败
						<?php else: ?> 待审核<?php endif; ?>
			            </td>
                          <td class="opera"><a href="<?php echo U('Deal/check',array('checkid'=>$vv['id']));?>">审核</a></td>
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