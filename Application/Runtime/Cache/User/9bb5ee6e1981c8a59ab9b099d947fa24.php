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

	<title>会员管理系统</title>
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
	<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
</head>
<body>
<!--标题样式-->
<div class="mn-content" data-role="page">
	<style type="text/css">
		.pg-form input,
		.pg-form select{margin-bottom:1em;margin-top:1em;}
		input{width:100px;}
	</style>

	<div class="pg-form">
		<label class="control-label">会员编号</label>
		<input  id="id_" type="text" class="form-control" value="<?php echo ($user_code); ?>" placeholder="请输入会员编号"  disabled   />
		<label class="control-label">推荐人</label>
		<input id="recmid_" type="text" class="form-control input-sm" placeholder="请输入推荐人编号" value="<?php echo ($recmid); ?>" style="width:400px;" />
		<label class="control-label">安置人</label>
		<input id="parentid_" type="text" class="form-control" placeholder="请输入安置人编号" value="<?php echo ($parentid); ?>" style="width:400px;"/>
		<label class="control-label">代理中心</label>
		<input id="centerid_" type="text" class="form-control" placeholder="请输入代理中心编号" value="<?php echo ($centerid); ?>" style="width:400px;" />
		<label class="control-label">安置位置</label>
		<select id="area_" class="form-control" ></select>
		<label class="control-label">单类型</label>
		<select id="single_" class="form-control" ></select>
		<label class="control-label">会员等级</label>
		<select id="level_" class="form-control" value="开户姓名" ></select>
		<label class="control-label">真实姓名</label>
		<input id="username_" type="text" class="form-control" placeholder="请输入会员姓名" />
		<label class="control-label">登录密码</label>
		<input id="password_" type="password" class="form-control" placeholder="请输入登录密码"/>
		<label class="control-label">确认登录密码</label>
		<input id="cpassword_" type="password" class="form-control" placeholder="请输入确认登录密码" />
		<label class="control-label">安全密码</label>
		<input id="safeword_" type="password" class="form-control" placeholder="请输入安全密码" />
		<label class="control-label">确认安全密码</label>
		<input id="csafeword_" type="password" class="form-control" placeholder="请输入确认安全密码" />
		<label class="control-label">身份证</label>											<!--加一个禁止输入特殊符号的限制-->
		<input id="idcard_" type="text" class="form-control" placeholder="请输入会员身份证" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"   />
		<label class="control-label">开户银行</label>
		<select id="bankid_" class="form-control" ></select>
		<label class="control-label">开户卡号</label>			<!--加一个禁止输入特殊符号的限制-->
		<input id="bankno_" type="text" class="form-control"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"  placeholder="请输入开户卡号" />
		<label class="control-label">开户地址</label>
		<input id="bankname_" type="text" class="form-control" placeholder="请输入开户地址"  />
		<label class="control-label">开户姓名</label>
		<input id="bankuser_" type="text" class="form-control" placeholder="请输入开户姓名" />
		<label class="control-label">手机</label>				<!--加一个禁止输入特殊符号的限制-->
		<input id="moblie_" type="text" class="form-control"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"  placeholder="请输入手机号" />
		<label class="control-label">邮箱</label>
		<input id="email_" type="text" class="form-control" placeholder="请输入邮箱" />
		<label class="control-label">邮编</label>
		<input id="zipcode_" type="text" class="form-control" placeholder="请输入邮编" >
		<label class="control-label">地址</label>
		<input id="address_" type="text" class="form-control" placeholder="请输入地址" />
		<label class="control-label">省</label>
		<select id="country_" class="form-control"></select>
		<label class="control-label">市</label>
		<select id="province_" class="form-control"></select>
		<label class="control-label">区/县</label>
		<select id="county_" class="form-control"></select>

		<div class="btn-group btn-group-justified" role="group" aria-label="...">
			<div class="btn-group" role="group">
				<a id="btn_enter_" data-transition="pop" class="btn btn-default btn-danger">新增会员</a>
			</div>
			<div class="btn-group" role="group">
				<a href="/User/Center/index" class="btn btn-default">返回</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
        var pck = {
            title: "注册会员",
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
                var id = m.node("#id_").value();
                var parentid = m.node("#parentid_").value();
                var recmid = m.node("#recmid_").value();
                var centerid = m.node("#centerid_").value();
                var area = m.node("#area_").value();
                var single = m.node("#single_").value();
                var level = m.node("#level_").value();
                var password = m.node("#password_").value();
                var cpassword = m.node("#cpassword_").value();
                var safeword = m.node("#safeword_").value();
                var csafeword = m.node("#csafeword_").value();
                var username = m.node("#username_").value();
                var idcard = m.node("#idcard_").value();
                var bankid = m.node("#bankid_").value();
                var bankno = m.node("#bankno_").value();
                var bankuser = m.node("#bankuser_").value();
                var bankname = m.node("#bankname_").value();
                var moblie = m.node("#moblie_").value();
                var email = m.node("#email_").value();
                var zipcode = m.node("#zipcode_").value();
                var address = m.node("#address_").value();
                var place = m.node("#county_").value();
                //非空判断
                if (id.length <= 0) {
                    engine.news("请输入编号", 1800);
                    return;
                }
                if (recmid.length <= 0) {
                    engine.news("请输入推荐人", 1800);
                    return;
                }
                if (parentid.length <= 0) {
                    engine.news("请输入安置人", 1800);
                    return;
                }
                if (centerid.length <= 0) {
                    engine.news("请输入代理中心", 1800);
                    return;
                }
                if (area == null || area.length <= 0) {
                    engine.news("请选择安置位置", 1800);
                    return;
                }
                if (single == null || single.length <= 0) {
                    engine.news("请选择单类型", 3000);
                    return;
                }
                if (level == null || level.length <= 0) {
                    engine.news("请选择会员等级", 1800);
                    return;
                }
                if(/^[\u4e00-\u9fa5]+$/i.test(password)){
                    engine.news("密码中存在中文,请重新输入", 3000);
                    return;
                }
                if (password.length <= 0) {
                    engine.news("请输入登录密码", 1800);
                    return;
                }
                if (password != cpassword) {
                    engine.news("登录密码输入不一致", 1800);
                    return;
                }
                if(/^[\u4e00-\u9fa5]+$/i.test(safeword)){
                    engine.news("安全密码中存在中文,请重新输入", 3000);
                    return;
                }
                if (safeword.length <= 0) {
                    engine.news("请输入安全密码", 1800);
                    return;
                }
                if (safeword != csafeword) {
                    engine.news("安全密码输入不一致", 1800);
                    return;
                }
                if (username.length <= 0) {
                    engine.news("请输入真实姓名", 1800);
                    return;

                }//修改-身份证只能输入18位
                if (idcard.length <= 17||idcard.length >= 19) {
                    engine.news("请输入18位的身份证", 1800);


                    return;
                }
                if (bankid == null || bankid.length <= 0) {
                    engine.news("请选择开户银行", 1800);
                    return;
                }
                if (bankno.length <= 0) {
                    engine.news("请输入开户卡号", 1800);
                    return;
                }
                if (bankuser.length <= 0) {
                    engine.news("请输入开户姓名", 1800);
                    return;
                }
                if (bankname.length <= 0) {
                    engine.news("请输入开户地址", 1800);
                    return;

                }//修改-手机号只能输入11位
                if (moblie.length <= 10 || moblie.length >= 12) {
                    engine.news("请输入11位的手机号", 1800);

                    return;
                }
                if (place == null || place.length <= 0) {
                    engine.news("请选择地区", 1800);
                    return;
                }
                if (address.length <= 0) {
                    engine.news("请输入地址", 1800);
                    return;
                }
                var place = (place == -1) ? m.node("#province").value() : place;
                engine.news("正在提交...", 999999);
                //发送请求
                var ajax = m.ajax("/User/User/api_register_submit",null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case '0':
                            engine.news("新增会员成功", 3000);
                            setTimeout(function () {
                                $.mobile.changePage("/User/User/netchart", { transition: "slidefade" });
                            },2000);
                            break;
                        case -10002:
                            engine.news("新增会员失败", 1800);
                            break;
                        default:
                            engine.news(jso.Data, 2000);
                            break;
                    }
                });
                ajax.data.add("id", ResChinese(id));
                ajax.data.add("parentid", ResChinese(parentid));
                ajax.data.add("recmid", ResChinese(recmid));
                ajax.data.add("centerid", ResChinese(centerid));
                ajax.data.add("area", area);
                ajax.data.add("single", single);
                ajax.data.add("level", level);
                ajax.data.add("password", ResChinese(password));
                ajax.data.add("safeword", ResChinese(safeword));
                ajax.data.add("username", ResChinese(username));
                ajax.data.add("idcard", ResChinese(idcard));
                ajax.data.add("bankid", ResChinese(bankid));
                ajax.data.add("bankno", ResChinese(bankno));
                ajax.data.add("bankuser", ResChinese(bankuser));
                ajax.data.add("bankname", ResChinese(bankname));
                ajax.data.add("moblie", ResChinese(moblie));
                ajax.data.add("email", ResChinese(email));
                ajax.data.add("zipcode", ResChinese(zipcode));
                ajax.data.add("address", ResChinese(address));
                ajax.data.add("place", place);
                ajax.send();
            },
            init: function () { }
        }
        pck.init();
        //加载完
        $(function () {
        	//获取单类型
            engine.ajax.membersingle(0, function (json) {
                var selt = m.node("#single_");
                selt.html("");
                for (var i in json) {
                    selt.append("<option value='" + json[i].id + "'>" + json[i].name  + "</option>");
               }
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