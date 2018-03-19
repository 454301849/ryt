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

  <title>首页概览</title>
  <link href="/Public/admin/css/engine.css" rel="stylesheet" />
  <link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />

  <link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
  <link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
  <link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
  <link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />

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

</head>
<body>

<div id="gaussian_warp" class="wrapper">
  <!-- 顶部菜单 -->
  <header class="topnavbar-wrapper  navbar-fixed-top">
    <nav class="navbar topnavbar" style="height:3.6em;background:">
      <!-- 图标控制-->
      <div class="navbar-header">
        <a href="#/" class="navbar-brand">
          <div class="brand-logo">
            <img src="/Public/admin/images/logo.png" alt="App Logo" class="img-responsive" />
          </div>
        </a>
      </div>
      <!-- 菜单按钮-->
      <div class="nav-wrapper">
        <ul class="nav navbar-nav" style="float: left">
          <li>
            <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
              <em class="fa fa-navicon"></em>
            </a>
            <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
              <em class="fa fa-navicon"></em>
            </a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- 侧边栏-->
  <aside class="aside">
    <div class="aside-inner">
      <nav class="sidebar">
        <ul class="nav">
          <li class="nav-heading">
            <span>欢迎使用</span>
          </li>
          <li class="active">
            <a href="#">
              <em class="icon-speedometer"></em>
              <span>首页概览</span>
            </a>
          </li>
          <li>
            <a href="#deal" title="Layouts" data-toggle="collapse">
              <em class="icon-wallet"></em>
              <span>财务中心</span>
            </a>
            <ul id="deal" class="nav sidebar-subnav collapse">
              <li class="">
                <a href="/Deal/main">
                  <span>资金明细</span>
                </a>
              </li>
              <li class="">
                <a href="/Deal/recordlists">
                  <span>奖金明细</span>
                </a>
              </li>
              <li class="">
                <a href="/Deal/deposit">
                  <span>充值</span>
                </a>
              </li>
              <li class="">
                <a href="/Deal/withdraw">
                  <span>提现</span>
                </a>
              </li>
              <li class="">
                <a href="/Deal/transfer">
                  <span>内部转账</span>
                </a>
              </li>
              <li class="">
                <a href="/Deal/convert">
                  <span>币种转换</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#user" title="Layouts" data-toggle="collapse">
              <em class="icon-lock"></em>
              <span>我的账户</span>
            </a>
            <ul id="user" class="nav sidebar-subnav collapse">
              <li class="">
                <a href="/User/basicinfo">
                  <span>我的资料</span>
                </a>
              </li>
              <li class="">
                <a href="/User/basicface">
                  <span>头像修改</span>
                </a>
              </li>
              <li class="">
                <a href="/User/basicedit">
                  <span>资料编辑</span>
                </a>
              </li>
              <li class="">
                <a href="/User/upgrade">
                  <span>原点升级</span>
                </a>
              </li>
              <li class="">
                <a href="/User/wordedit">
                  <span>修改登录密码</span>
                </a>
              </li>
              <li class="">
                <a href="/User/safeedit">
                  <span>修改安全密码</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="">
            <a href="/User/skin">
              <em class="icon-compass"></em>
              <span>设置皮肤</span>
            </a>
          </li>
          <li class="home-main">
            <a onclick="engine.exit()">
              <em class="icon-close"></em>
              <span>注销登录</span>
            </a>
          </li>
          <li class="nav-heading">
            <span>会员管理</span>
          </li>
          <li>
            <a href="#center" title="Layouts" data-toggle="collapse">
              <em class="icon-user-follow"></em>
              <span>注册会员</span>
            </a>
            <ul id="center" class="nav sidebar-subnav collapse">
              <li class="">
                <a href="/Center/register" >
                  <span>立即注册</span>
                </a>
              </li>
              <li class="">
                <a href="/Center/centerlists">
                  <span>代理中心</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="">
            <a href="/Member/recmlists">
              <em class="icon-layers"></em>
              <span>我的推荐</span>
            </a>
          </li>
          <li class="">
            <a href="/Member/relationlists">
              <em class="icon-pin"></em>
              <span>关联账户</span>
            </a>
          </li>
          <li class="">
            <a href="/Member/netchart">
              <em class="icon-grid"></em>
              <span>会员网络</span>
            </a>
          </li>
          <li class="">
            <a href="/Member/apply">
              <em class="icon-pencil"></em>
              <span>提交申请</span>
            </a>
          </li>
          <li class="nav-heading">
            <span>大盘中心</span>
          </li>
          <li class="">
            <a href="/Security/main">
              <em class="icon-globe"></em>
              <span>交易大盘</span>
            </a>
          </li>

          <li class="nav-heading">
            <span>商城管理</span>
          </li>
          <li class="">
            <a href="<?php echo U('Shop/setting');?>" target="menu-frame">
              <em class="icon-layers"></em>
              <span>商城设置</span>
            </a>
          </li>
          <li class="">
            <a href="/Admin/Shop/categrey">
              <em class="icon-layers"></em>
              <span>分类管理</span>
            </a>
          </li>
          <li class="">
            <a href="/Admin/Shop/good">
              <em class="icon-layers"></em>
              <span>商品管理</span>
            </a>
          </li>
          <li class="nav-heading">
            <span>购物中心</span>
          </li>
          <li class="">
            <a href="/Product/main">
              <em class="icon-handbag"></em>
              <span>产品列表</span>
            </a>
          </li>
          <li class="">
            <a href="/Product/report">
              <em class="icon-basket"></em>
              <span>结算购物</span>
            </a>
          </li>
          <li class="">
            <a href="/Product/order">
              <em class="icon-tag"></em>
              <span>我的订单</span>
            </a>
          </li>
          <li class="">
            <a href="/Product/place">
              <em class="icon-map"></em>
              <span>收货地址</span>
            </a>
          </li>
          <li class="nav-heading">
            <span>公告中心</span>
          </li>
          <li class="">
            <a href="/Notice/main">
              <em class="icon-feed"></em>
              <span>新闻公告</span>
            </a>
          </li>
          <li>
            <a href="#message" title="Layouts" data-toggle="collapse">
              <em class="icon-earphones"></em>
              <span>工单</span>
            </a>
            <ul id="message" class="nav sidebar-subnav collapse">
              <li class="">
                <a href="/Mail/message">
                  <span>发表工单</span>
                </a>
              </li>
              <li class="">
                <a href="/Mail/messagelists">
                  <span>我的工单</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#mail" title="Layouts" data-toggle="collapse">
              <em class="icon-bubbles"></em>
              <span>内部邮箱</span>
            </a>
            <ul id="mail" class="nav sidebar-subnav collapse">
              <li class="">
                <a href="/Mail/send">
                  <span>发邮件</span>
                </a>
              </li>
              <li class="">
                <a href="/Mail/sendlists">
                  <span>发件箱</span>
                </a>
              </li>
              <li class="">
                <a href="/Mail/collectlists">
                  <span>收件箱</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <section>
    <div class="content-wrapper" id="menu-frame" name="menu-frame">
      <div class="content-heading">
        首页概览
      </div>
      <div class="col-lg-8 col-sm-8">
        <div class="row">
          <div class="col-lg-6 col-sm-6">
            <div class="panel widget bg-glass">
              <div class="row row-table">
                <div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
                  <em class="icon-wallet fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                  <div class="h2 mt0">10.00</div>
                  <div class="text-uppercase">提现</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6">
            <div class="panel widget bg-glass">
              <div class="row row-table">
                <div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
                  <em class="icon-star fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                  <div class="h2 mt0">2901.00</div>
                  <div class="text-uppercase">升级币</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
          <div class="panel widget bg-glass">
          <div class="row row-table">
          <div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
          <em class="icon-present fa-3x"></em>
          </div>
          <div class="col-xs-8 pv-lg">
          <div class="h2 mt0">0.00</div>
          <div class="text-uppercase">购物积分</div>
          </div>
          </div>
          </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="panel widget bg-glass">
              <div class="row row-table">
                <div class="col-xs-4 text-center bg-glass pv-lg" style="background:none">
                  <em class="icon-trophy fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                  <div class="h2 mt0">0.00</div>
                  <div class="text-uppercase">累计奖金</div>
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
                  <div class="panel-body">
                    <div class="chart-spline flot-chart" style="height:290px;background:rgba(255,255,255,0.3);"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-4 col-sm-4" >
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
                        <td style="font-weight:normal;text-align:left;width:45%;">级别：会员1</td>
                        <td style="font-weight:normal;text-align:left">注册日：16/01/01</td>
                      </tr>
                    </table>
                    </p>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
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
              </div>
              <div class="list-group-item">
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
              <div class="list-group-item">
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


      <script type="text/javascript">
          var pck = {
              init: function () {

              }
          }
          m.event("ready").add(function () {
              var data = [{
                  "label": "奖金收入",
                  "color": "#5d9cec",
                  "data": [['02-26', 0.00],['02-27', 0.00],['02-28', 0.00],['03-01', 0.00],['03-02', 0.00],['03-03', 0.00],['03-04', 0.00],['03-05', 0.00],['03-06', 0.00],['03-07', 0.00],['03-08', 0.00],['03-09', 0.00],['03-10', 0.00],['03-11', 0.00],['03-12', 0.00],['03-13', 0.00]]
              }];
              var chart = $('.chart-spline');
              $.plot(chart, data, {
                  series: {
                      lines: {
                          show: false
                      },
                      points: {
                          show: true,
                          radius: 4
                      },
                      splines: {
                          show: true,
                          tension: 0.4,
                          lineWidth: 1,
                          fill: 0.5
                      }
                  },
                  grid: {
                      borderColor: 'transparent',
                      borderWidth: 1,
                      hoverable: true,
                      color: '#444'
                  },
                  tooltip: true,
                  tooltipOpts: {
                      content: function (label, x, y) { return x + ' : ' + y; }
                  },
                  xaxis: {
                      tickColor: 'transparent',
                      mode: 'categories',
                      color: '#fff'
                  },
                  yaxis: {
                      min: 0,
                      max:100,
                      tickColor: '#ccc',
                      color: '#fff',
                      tickFormatter: function (v) {
                          return v;
                      }
                  },
                  shadowSize: 0
              });
          });
      </script>
    </div>
  </section>
</div>
<input type="hidden" class="HD_SKEY" value="10000:118917082BC164D9DFDD766414A32818" />
<input type="hidden" class="HD_IPADDRESS" value="39.82.44.192" />
</body>
</html>