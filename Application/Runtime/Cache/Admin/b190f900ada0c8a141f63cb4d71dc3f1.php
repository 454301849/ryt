<?php if (!defined('THINK_PATH')) exit();?><div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
            <thead>
                <tr>
                    <td>序号</td>
                    <td>转款人编号</td>
                    <td>转款人姓名</td>
                    <td>收款人编号</td>
                    <td>收款人姓名</td>
                    <td>详情</td>
                    <td>金额</td>
                    <td>状态</td>
                    <td>处理时间</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                  
                    <?php if(is_array($info)): $kk = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><tr class="pg-deal-list">

                        <td class="time"><?php echo ($kk); ?></td>
                        <td class="time"><?php echo ($vv["zusername"]); ?></td>
                        <td class="time"><?php echo ($vv["ztruename"]); ?></td>
                        <td class="time"><?php echo ($vv["susername"]); ?></td>
                        <td class="time"><?php echo ($vv["struename"]); ?></td>
                        <td class="name">
                            [转账]<?php if(($vv["type"] == 1) ): ?>奖金币
						<?php elseif($vv["type"] == 2): ?>购物币
						<?php else: ?> 其他<?php endif; ?>
                                <label>- 内部转账</label>
                        </td>
                                <td class="money"><?php echo ($vv["money"]); ?></td>
                        <td class="state">完成</td>
                        <td class="time"><?php echo (date('Y-m-d H:i:s',$vv["createtime"])); ?></td>
                        <td class="opera"><a href="<?php echo U('Deal/detail',array('dealid'=>$vv['id']));?>">查看详情</a></td>
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


<!--隐藏域开始-->
<input type="hidden" class="HD_PAGE" value="0" />
<input type="hidden" class="HD_SIZE" value="20" />
<input type="hidden" class="HD_COUNT" value="20" />
<!--隐藏域结束-->
<script type="text/javascript">
   var pck = {
       page: 0,
       size: 0,
       count: 0,
       //加载页面
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