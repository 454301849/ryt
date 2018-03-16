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
    账户充值
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-horizontal">

            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">充值奖金币</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-sm" id="money" placeholder="请输入充值金额" style="width:250px;">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button id="btn_enter" type="button" class="btn btn-primary">确认充值</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        submit: function () {

            var money = m.node("#money").value();

            if (money.length <= 0) {
                engine.news("请输入充值金额", 3000);
                return;
            }

            var val = confirm("确定充值" + money + "?");
            if (val == true) {
                //发送请求
                engine.news("正在提交...", 60000);
                var ajax = m.ajax("/Admin/User/api_recharge_submit", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case '0':
                            engine.news("充值成功",3000);
                            /*setTimeout(function () {
                                m.redirect("/Deal/" + jso.Data + ".html");
                            }, 1000);*/
                            break;
                        case '-10000':
                            engine.news("充值失败", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("money", money);
                ajax.send();
            }
        },
        init: function () { }
    }
    pck.init();
    //载入时
    m.event("ready").add(function () {
        m.node("#btn_enter").click(pck.submit);
    });

</script>
            </div>
        </section>