<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>

<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit">
  <meta property="qc:admins" content="1051105554536547046375" />
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
  <meta name="keywords" content="会员结算系统">
  <meta name="description" content="会员结算系统">

  <title>会员管理系统</title>
  <link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
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

  <frameset rows="55,*" framespacing="0" border="0">
    <frame src="<?php echo U('newtop');?>" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
    <frameset cols="210,  *" framespacing="0" border="0" id="frame-body" >
      <frame src="<?php echo U('Admin/Index/newleft');?>" id="menu-frame" name="menu-frame" frameborder="no" scrolling="no">
      <frame src="<?php echo U('Admin/Index/newmain');?>" id="main-frame" name="main-frame" frameborder="no" scrolling="yes">
    </frameset>
  </frameset><noframes></noframes>
</head>