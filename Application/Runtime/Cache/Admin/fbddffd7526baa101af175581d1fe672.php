<?php if (!defined('THINK_PATH')) exit();?> <link href="/Public/admin/css/bootstrap.css" rel="stylesheet" />
<link href="/Public/admin/css/iosOverlay.css" rel="stylesheet" />
<link href="/Public/admin/css/simple-line-icons.css" rel="stylesheet" />
<link href="/Public/admin/css/animate.min.css" rel="stylesheet" />
<link href="/Public/admin/css/font-awesome.min.css" rel="stylesheet" />
<link href="/Public/admin/css/engine.css" rel="stylesheet" />
<style>
	body{
		background-image:url('/Public/images/max.jpg');
		background-repeat:no-repeat;background-attachment:fixed;
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
</style>




<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
<section>
            <div class="content-wrapper">
                
<h3>
    登录密码修改
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-horizontal">
            <fieldset>
                <legend>可改信息</legend>
                <div class="form-group"    >
                    <label class="col-sm-2 control-label"     >原密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="safeword"style="width:250px;" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新登录密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="npassword" style="width:250px;"/>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">确认新登录密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="cnpassword" style="width:250px;" />
                    </div>
                </div>
            </fieldset>
            
                <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">新安全密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="nsafeword" style="width:250px;" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label ">确认新安全密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="cnsafeword"style="width:250px;" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button id="btn_enter" type="button" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        submit: function () {
            var safeword = m.node("#safeword").value();
            var npassword = m.node("#npassword").value();
            var cnpassword = m.node("#cnpassword").value();
            var nsafeword = m.node("#nsafeword").value();
            var cnsafeword = m.node("#cnsafeword").value();

            if (safeword.length <= 0) {
                engine.news("请输入原密码", 2000);
                return;
            }
            if (npassword.length <= 0) {
                engine.news("请输入新登录密码", 2000);
                return;
            }
            if (npassword != cnpassword) {
                engine.news("新登录密码输入不一致", 2000);
                return;
            }
            if (nsafeword.length <= 0) {
                engine.news("请输入新安全密码", 1800);
                return;
            }
            if (nsafeword != cnsafeword) {
                engine.news("新安全密码输入不一致", 1800);
                return;
            }
            engine.news("正在提交...", 999999);
            //发送请求
            var ajax = m.ajax("<?php echo U('Index/SetPassword');?>", null, function (jso) {
                var jso = m.json.getObject(jso);
                switch (jso.success) {
                    case 1:
                        engine.news("修改成功", 3000, true);
                        break;
                    case 2:
                        engine.news("原密码与新密码一致", 2000);
                        break;
                    default:
                        engine.news("服务器忙碌", 2000);
                        break;
                }
            });
            ajax.data.add("ypassword", safeword);
            ajax.data.add("password", npassword);
            ajax.data.add("nsafeword", nsafeword);
            ajax.send();
        },
        init: function () { }
    }
    pck.init();
    //载入时
    $(function () {
        m.node("#btn_enter").click(pck.submit);
    });
</script>
            </div>
        </section>