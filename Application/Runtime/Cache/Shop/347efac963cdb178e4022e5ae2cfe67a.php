<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <title>
      新增收货地址
    </title>
    <!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link href="/Public/css/jquery.mobile.custom.structure.min.css"  rel="stylesheet" />
    <link href="/Public/bootstrap/css/bootstrap.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/weui.min.css">
    <link href="/Public/css/engine.css"  rel="stylesheet" />
	<script type="text/javascript" src="/Public/js/mtopt-3.0-min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery-2.1.3.min.js" ></script>
	<script type="text/javascript" src="/Public/js/jquery.mobile.custom.js" ></script>
	<script type="text/javascript" src="/Public/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="/Public/js/engine.js" ></script>
	<script src="/Public/layer-mobile/layer.js"></script>
  </head>
  
  <body style="background:#efedf1">
    <div class="container-fulid" style="background:;padding-bottom:20px;">
      <div class="bd">
        <div class="weui_panel weui_panel_access" style="background:#;">
          <div class="weui_panel_hd" style="color:#555">
            新增收货地址<a href="javascript:" onclick="self.location=document.referrer;" style="float:right;color:#555;">返回</a>
          </div>
          <div class="weui_panel_hd" style="color:#555">
          <div class="pg-form">
			    <label class="control-label">收货人</label>
			    <input id="name_" type="text" class="form-control" placeholder="收货人">
			    <label class="control-label">邮箱</label>
			    <input id="email_" type="text" class="form-control" placeholder="邮箱">
			    <label class="control-label">手机</label>
			    <input id="moblie_" type="text" class="form-control" placeholder="手机">
			    <label class="control-label">地址</label>
			    <input id="address_" type="text" class="form-control" placeholder="地址">
			    <label class="control-label">是否默认</label>
			    <select id="state_" class="form-control">
			         <option value="0">否</option>
			        <option value="1">是</option>
			    </select>
			    <br/>
			    <div class="btn-group btn-group-justified" role="group" aria-label="...">
			        <div class="btn-group" role="group">
			            <a id="btn_enter_" data-transition="pop" class="btn btn-danger">添加</a>
			        </div>
			    </div>
			</div>
			</div>
        </div>
      </div>
    </div>
	   <script type="text/javascript">
	    var pck = {
	        title: "新增地址",
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
	            var name = m.node("#name_").value();
	            var moblie = m.node("#moblie_").value();
	            var email = m.node("#email_").value();
	            var address = m.node("#address_").value();
	            var state = m.node("#state_").value();
	            
	            //非空判断
	            if (name.length <= 0) {
	                engine.news("请输入姓名", 1800);
	                return;
	            }
	      //      if (email.length <= 0) {
	       //         engine.news("请输入邮箱", 1800);
	        //        return;
	        //    }
	            if (moblie.length <= 0) {
	                engine.news("请输入手机", 1800);
	                return;
	            }
	            if (address.length <= 0) {
	                engine.news("请输入地址", 1800);
	                return;
	            }
	            if (state == null || state.length <= 0) {
	                engine.news("请选择是否默认", 1800);
	                return;
	            }
	            engine.news("正在提交...", 999999);
	            //发送请求
	            var ajax = m.ajax("/Shop/Address/api_address_add", null, function (jso) {
	                var jso = m.json.getObject(jso);
	                switch (jso.Error) {
	                    case '0':
	                        engine.news("新增地址成功.", 1800);
	                        setTimeout(function(){
		                        m.redirect('/Shop/Address/index');
		                    });
	                      history.go(-1); location.reload(); 
	                        break;
	                    case -10000:
	                        engine.news("新增地址失败", 1800);
	                        break;
	                    default:
	                        engine.news(jso.Data, 2000);
	                        break;
	                }
	            });
	            ajax.data.add("name", ResChinese(name));
	            ajax.data.add("moblie", ResChinese(moblie));
	            ajax.data.add("email", ResChinese(email));
	            ajax.data.add("address", ResChinese(address));
	            ajax.data.add("state", ResChinese(state));
	            ajax.send();
	        },
	        init: function () {
	        }
	    }
	    pck.init();
	    $(function () {
	        m.node("#btn_enter_").click(pck.submit);
	    });
	    function ResChinese(obj)
	    {
	       return encodeURI(obj);
	    }
	</script>
  </body>
</html>