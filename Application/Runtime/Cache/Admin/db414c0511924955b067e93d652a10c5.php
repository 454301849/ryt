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
    background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images//max.jpg',sizingMethod='scale');}
</style>

<style type="text/css">
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
<body>

<!-- 侧边栏-->
<aside class="aside" style="background: rgba(255,255,255,.25)">
  <div class="aside-inner">
    <nav class="sidebar" style="margin-right:-17px;overflow-y:scroll">
      <ul class="nav">
        <li class="nav-heading">
          <span>欢迎使用</span>
        </li>
        <li class="">
          <a href="<?php echo U('Index/newmain');?>"  target="main-frame">
            <em class="icon-speedometer"></em>
            <span>首页概览</span>
          </a>
        </li>
          <?php if(is_array($result)): foreach($result as $key=>$vo): ?><li class="nav-heading">
            <span><?php echo ($vo["name"]); ?></span>
          </li>
          <?php if(is_array($vo["menu"])): foreach($vo["menu"] as $key=>$vi): ?><li class="">
              <?php $url_action=$vi['model'].'/'.$vi['action']; ?>
              <?php $icon='icon-'.$vi['icon']; ?>
              <a href="<?php echo U("$url_action");?>"  target="main-frame">
                <em class=<?php echo ($icon); ?>></em>
                <span><?php echo ($vi["name"]); ?></span>
              </a>
            </li><?php endforeach; endif; endforeach; endif; ?>
         <li>
          <!--<a href="#deal" title="Layouts" data-toggle="collapse">-->
            <!--<em class="icon-wallet"></em>-->
            <!--<span>财务中心</span>-->
          <!--</a>-->
          <!--<ul id="deal" class="nav sidebar-subnav collapse">-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('Deal/main');?>" target="main-frame">-->
                <!--<span>资金明细</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('Deal/recordlists');?>" target="main-frame">-->
                <!--<span>奖金明细</span>-->
              <!--</a>-->
            <!--</li>-->
			<!---->
            <!--<li class="">-->
              <!--<a href="<?php echo U('Deal/detaillists');?>" target="main-frame">-->
                <!--<span>转账明细</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--&lt;!&ndash;<li class="">-->
              <!--<a href="<?php echo U('Deal/huibenj');?>" target="main-frame">-->
                <!--<span>回本奖发放</span>-->
              <!--</a>-->
            <!--</li>&ndash;&gt;-->
              <!--<li class="">-->
              <!--<a href="<?php echo U('Deal/withdraw');?>" target="main-frame">-->
                <!--<span>提现明细</span>-->
              <!--</a>-->
            <!--</li>-->
              <!--<li class="">-->
              <!--<a href="<?php echo U('Deal/transfer');?>" target="main-frame">-->
                <!--<span>内部转账</span>-->
              <!--</a>-->
            <!--</li>-->
          <!--</ul>-->
        <!--</li>-->
        <!---->
        <!--<li>-->
          <!--<a href="#user" title="Layouts" data-toggle="collapse">-->
            <!--<em class="icon-lock"></em>-->
            <!--<span>我的账户</span>-->
          <!--</a>-->
          <!--<ul id="user" class="nav sidebar-subnav collapse">-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="<?php echo U('User/basicinfo');?>" target="main-frame">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>我的资料</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/User/basicface">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>头像修改</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/User/basicedit">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>资料编辑</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/User/upgrade">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>原点升级</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('User/wordedit');?>" target="main-frame">-->
                <!--<span>修改密码</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('User/recharge');?>" target="main-frame">-->
                <!--<span>账户充值</span>-->
              <!--</a>-->
            <!--</li>-->

          <!--</ul>-->
        <!--</li>-->

        <!--<li>-->
          <!--<a href="#jiangjin" title="Layouts" data-toggle="collapse">-->
            <!--<em class="icon-compass"></em>-->
            <!--<span>奖金管理</span>-->
          <!--</a>-->
          <!--<ul id="jiangjin" class="nav sidebar-subnav collapse">-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('Daili/system');?>" target="main-frame">-->
                <!--<span>奖金设置</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('Daili/memberlevel');?>" target="main-frame">-->

                <!--<span>用户设置</span>-->
              <!--</a>-->
            <!--</li>-->
			<!--<li class="">-->
              <!--<a href="<?php echo U('Daili/eliminate');?>" target="main-frame">-->

                <!--<span>数据清零</span>-->
              <!--</a>-->
            <!--</li>-->
          <!--</ul>-->
        <!--</li>-->


        <!--&lt;!&ndash;<li class="home-main">&ndash;&gt;-->
          <!--&lt;!&ndash;<a onclick="engine.exit()">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-close"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>注销登录</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--<li class="nav-heading">-->
          <!--<span>会员管理</span>-->
        <!--</li>-->
        <!--<li>-->
          <!--<a href="#center" title="Layouts" data-toggle="collapse">-->
            <!--<em class="icon-user-follow"></em>-->
            <!--<span>注册会员</span>-->
          <!--</a>-->
          <!--<ul id="center" class="nav sidebar-subnav collapse">-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('User/register');?>" target="main-frame">-->
                <!--<span>立即注册</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li class="">-->
              <!--<a href="<?php echo U('User/memberlists');?>" target="main-frame">-->
                <!--<span>会员网络图</span>-->
              <!--</a>-->
            <!--</li>-->

            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="<?php echo U('User/centerlists');?>" target="main-frame">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>代理中心</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
          <!--</ul>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('User/sortlists');?>" target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>会员列表</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('User/recmlists');?>" target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>我的推荐</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="/Member/relationlists">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-pin"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>关联账户</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('User/netchart');?>" target="main-frame">-->
            <!--<em class="icon-grid"></em>-->
            <!--<span>会员网络</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Daili/centerlists');?>" target="main-frame">-->
            <!--<em class="icon-pencil"></em>-->
            <!--<span>代理中心</span>-->
          <!--</a>-->
        <!--</li>-->

        <!--<li class="nav-heading">-->
          <!--<span>商城管理</span>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Shop/setting');?>" target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>商城设置</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Shop/categrey');?>"  target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>分类管理</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Shop/good');?>"  target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>商品管理</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--&lt;!&ndash;<li class="nav-heading">&ndash;&gt;-->
          <!--&lt;!&ndash;<span>购物中心</span>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="/Product/main">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-handbag"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>产品列表</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="/Product/report">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-basket"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>结算购物</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Shop/order');?>" target="main-frame">-->
            <!--<em class="icon-tag"></em>-->
            <!--<span>订单管理</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="/Product/place">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-map"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>收货地址</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--<li class="nav-heading">-->
          <!--<span>权限管理</span>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('Rbac/index');?>" target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>角色管理</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--<li class="">-->
          <!--<a href="<?php echo U('User/manage');?>"  target="main-frame">-->
            <!--<em class="icon-layers"></em>-->
            <!--<span>管理员</span>-->
          <!--</a>-->
        <!--</li>-->
        <!--&lt;!&ndash;<li class="nav-heading">&ndash;&gt;-->
          <!--&lt;!&ndash;<span>公告中心</span>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="/Notice/main">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-feed"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>新闻公告</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li>&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="#message" title="Layouts" data-toggle="collapse">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-earphones"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>工单</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
          <!--&lt;!&ndash;<ul id="message" class="nav sidebar-subnav collapse">&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/Mail/message">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>发表工单</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/Mail/messagelists">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>我的工单</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
          <!--&lt;!&ndash;</ul>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li>&ndash;&gt;-->
          <!--&lt;!&ndash;<a href="#mail" title="Layouts" data-toggle="collapse">&ndash;&gt;-->
            <!--&lt;!&ndash;<em class="icon-bubbles"></em>&ndash;&gt;-->
            <!--&lt;!&ndash;<span>内部邮箱</span>&ndash;&gt;-->
          <!--&lt;!&ndash;</a>&ndash;&gt;-->
          <!--&lt;!&ndash;<ul id="mail" class="nav sidebar-subnav collapse">&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/Mail/send">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>发邮件</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/Mail/sendlists">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>发件箱</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li class="">&ndash;&gt;-->
              <!--&lt;!&ndash;<a href="/Mail/collectlists">&ndash;&gt;-->
                <!--&lt;!&ndash;<span>收件箱</span>&ndash;&gt;-->
              <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--&lt;!&ndash;</li>&ndash;&gt;-->
          <!--&lt;!&ndash;</ul>&ndash;&gt;-->
        <!--&lt;!&ndash;</li>&ndash;&gt;-->
      </ul>
    </nav>
  </div>
</aside>
</body>