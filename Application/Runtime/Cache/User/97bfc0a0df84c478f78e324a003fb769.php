<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta name="renderer" content="webkit">
	<meta property="qc:admins" content="1051105554536547046375" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="keywords" content="会员结算系统">
	<meta name="description" content="会员结算系统">

	<title>移动结算平台</title>
	<link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
	<link href="/Public/bootstrap/css/bootstrap.min.css"  rel="stylesheet" />
	<link href="/Public/css/engine.css"  rel="stylesheet" />

	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.3.min.js" ></script>
	<script type="text/javascript">
        $.browser = $.browser || {};
        $.browser.msie = false;
        $(document).on("mobileinit", function () {
            $.support.cors = true;
            $.mobile.allowCrossDomainPages = true;
            $.mobile.pushStateEnabled = false;
            $.mobile.defaultPageTransition = "slidefade";
            $.mobile.pageLoadErrorMessage = "页面加载出错";
            $.mobile.loader.prototype.options.theme = "c";
            $.mobile.buttonMarkup.hoverDelay = "false";
        });
	</script>
	<style type="text/css">
		body{background:#BDE3FA;}
		.container{padding-top:2em;}
		.form-title{font-size:2.7em;text-align:center;height:110px;margin-top:120px;}
		.form-title img{width:200px;}
		.form-control{margin-bottom:1.8em;height:2.8em;}
	</style>
	<script type="text/javascript" src="/Public/js/jquery.mobile.custom.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/Public/js/engine.js" ></script>
</head>
<body>
<!--标题样式-->
<div class="mn-content" data-role="page">
	<style type="text/css">
		.pg-form input,
		.pg-form select{margin-bottom:1em;margin-top:1em;}
	</style>
    <div class="list-group" style="margin-top:6px">
      <a class="list-group-item">会员编号：<?php echo ($user_info["user_name"]); ?></a>
      <a class="list-group-item">奖金币：<?php echo ($user_info["jjb"]); ?></a>
      <a class="list-group-item">购物币：<?php echo ($user_info["gwb"]); ?></a>
    </div>
	<div class="pg-form">
		<label class="control-label">收款人编号</label>
		<input id="suserid_" type="text" class="form-control" value="<?php echo ($user_code); ?>" placeholder="请输入收款人编号" />
		<label class="control-label">转账类型</label>
		<select id="type_" class="form-control" >
		      <option value='1'>奖金币</option>
		      <!-- <option value='2'>购物币</option> -->
		</select>
		<label class="control-label">转账金额</label>
		<input id="money_" type="text" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" placeholder="请输入转账金额" />
		<label class="control-label">备注</label>
		<input id="remarks_" type="text" class="form-control" placeholder="请输入备注信息" />
		<label class="control-label">二级密码</label>
		<input id="safeword_" type="password" class="form-control" placeholder="请输入二级密码" />	
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<a id="btn_enter_" data-transition="pop" class="btn btn-default btn-danger">确认转账</a>
			</div>
			<div class="btn-group" role="group">
				<a href="/User/Center/index"  class="btn btn-default">返回</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
        var pck = {
            title: "内部转账",
            //设置地址
            setplace: function (selt, root, callback) {
                if (root < 0) { return; }
                engine.ajax.place(root, function (json) {
                    selt.html("");
                    selt.append("<option value=''>请选择</option>");
                    for (var i in json) {
                        selt.append("<option value='" + json[i].id + "'>" + json[i].name + "</option>");
                    }
                    //是否调用回调
                    if (callback) { callback(); }
                });
            },
            submit: function () {
                var suserid = m.node("#suserid_").value();
                var type = m.node("#type_").value();
                var money = m.node("#money_").value();
                var remarks = m.node("#remarks_").value();
                var safeword = m.node("#safeword_").value();
                //非空判断
                if (suserid.length <= 0) {
                    engine.news("请输入收款人编号", 1800);
                    return;
                }
                if (type == null || type.length <= 0) {
                    engine.news("请选择转账类型", 1800);
                    return;
                }
                if (money.length <= 0) {
                    engine.news("请输入转账金额", 1800);
                    return;
                }
                if (remarks.length <= 0) {
                    engine.news("请输入备注", 1800);
                    return;
                }
                if (safeword.length <= 0) {
                    engine.news("请输入二级密码", 1800);
                    return;
                }
                
                engine.news("正在提交...", 999999);
                //发送请求
                var ajax = m.ajax("/User/Deal/api_transfer_submit",null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case '0':
                            engine.news("转账成功", 3000);
                            setTimeout(function () {
                                $.mobile.changePage("/User/Center/index", { transition: "slidefade" });
                                m.reload();
                            },2000);
                            break;
                        case -10002:
                            engine.news("转账失败", 1800);
                            break;
                       
                        default:
                            engine.news(jso.Data, 2000);
                            break;
                    }
                });
                ajax.data.add("suserid", suserid);
                ajax.data.add("type", type);
                ajax.data.add("money", money);
                ajax.data.add("remarks", ResChinese(remarks));
                ajax.data.add("safeword", safeword);
                ajax.send();
            },
            init: function () { }
        }
        pck.init();
        //加载完
        $(function () {
            //获取等级
            engine.ajax.memberlevel(0, function (json) {
                var selt = m.node("#level_");
                selt.html("");
                for (var i in json) {
                    selt.append("<option value='" + json[i].id + "'>" + json[i].name + "</option>");
                }
                //获取位置
                engine.ajax.memberarea(0, function (json) {
                    var selt = m.node("#area_");
                    selt.html("");
                    for (var i in json) {
                        selt.append("<option value='" + json[i].id + "'>" + json[i].name + "</option>");
                    }
                    //获取银行
                    engine.ajax.bank(0, function (json) {
                        var selt = m.node("#bankid_");
                        selt.html("");
                        for (var i in json) {
                            selt.append("<option value='" + json[i].id + "'>" + json[i].name + "</option>");
                        }
                        //获取地区
                        engine.ajax.place('1', function (json) {
                            var lt = m.node("#country_");
                            lt.on("change", function () {
                                pck.setplace(m.node("#province_"), m.node("#country_").value());
                            });
                            var ltpv = m.node("#province_");
                            ltpv.on("change", function () {
                                pck.setplace(m.node("#county_"), m.node("#province_").value());
                            });
                            //填充初始数据
                            lt.append("<option value=''>请选择</option>");
                            for (var i in json) {
                                lt.append("<option value='" + json[i].id + "'>" + json[i].name + "</option>");
                            }
                        });
                    });
                });
            });
            m.node("#btn_enter_").click(pck.submit);
        });
        function ResChinese(obj)
        {
           return encodeURI(obj);
        }

</script>
</body>
</html>