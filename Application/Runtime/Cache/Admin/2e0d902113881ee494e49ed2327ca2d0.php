<?php if (!defined('THINK_PATH')) exit();?><link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<style>
    body{background-image:url('/Public/images/max.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Images/background/001/max.jpg',sizingMethod='scale');}
</style>

<style type="text/css">
    .bg-glass{background-color:none;}
    .modal-footer{
        padding: 9px;
    }
    .modal-backdrop.in{
        opacity:0;
    }
    .modal-dialog{
        margin: 1px auto;
    }
    .modal.in .modal-dialog {
        transform: translate(0px, 0px);
    }
    .modal-open .modal {
        overflow-x: hidden;
        overflow-y:hidden;
    }
    .list-group-item,.list-group-item:hover,.list-group-item:focus{background-color:transparent !important;color:#fff !important;border:none}
</style>
<script src="/Public/admin/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
<script type="text/javascript" src="/Public/admin/js/modernizr.custom.js"></script>

<!-- 顶部菜单<img src="/Public/admin/images/logo.png" alt="App Logo" class="img-responsive" /> -->
<header class="topnavbar-wrapper  navbar-fixed-top">
    <nav class="navbar topnavbar" style="height:3.6em;">
        <!-- 图标控制-->
        <div class="navbar-header">
            <a href="#/" class="navbar-brand">
                <div class="brand-logo">
                   <h4>会员管理系统</h4> 
                </div>
            </a>
        </div>
        <!-- 菜单按钮-->
        <div class="nav-wrapper" >
            <ul class="nav navbar-nav" style="float: left">
                <!--<li>-->
                    <!--<a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">-->
                        <!--<em class="fa fa-navicon"></em>-->
                    <!--</a>-->
                    <!--<a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">-->
                        <!--<em class="fa fa-navicon"></em>-->
                    <!--</a>-->
                <!--</li>-->
            </ul>
            <ul class="nav navbar-nav" style="float: right">
                <a onclick="if (confirm('确定要退出吗？')) return engine.exit(); else return false;"  target="_top" target="main-frame">
                <!--<a onclick="logout();" target="main-frame">-->
                    <div class="top_close" style="padding-top:18px;padding-right: 40px;"><i class="icon-power medium-icons"></i> 退出</div>
                </a>
            </ul>
        </div>

    </nav>

</header>
<script language="javascript">
    function logout(){
        var a=confirm("郭杨和小代是好朋友吗？");
        if(a==true)
        {
            alert("恭喜你答对了！");
        }
        else
        {
            alert("你真是猪，这么简单的问题都答不对！");
        }
    }
</script>