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
    内部转账
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">收款人编号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-sm" id="memberid"style="width:250px;" >
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >转账类型</label>
                    <div class="col-sm-10">
                        <select id="type" class="form-control input-sm" style="width:250px;">
                            <option value="1">奖金币</option>
                            <!-- <option value="2">购物币</option> -->
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">转账金额</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-sm" id="money" placeholder="扣率：0%" style="width:250px;">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-sm" id="remarks" style="width:250px;">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">安全密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control input-sm" id="safeword"style="width:250px;">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button id="btn_enter" type="button" class="btn btn-primary" >确认转账</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pck = {
        submit: function () {
            var memberid = m.node("#memberid").value();
            var type = m.node("#type").value();
            var money = m.node("#money").value();
            var remarks = m.node("#remarks").value();
            var safeword = m.node("#safeword").value();
            if (memberid.length <= 0) {
                engine.news("请输入收款人编号", 3000);
                return;
            }
            if (type <= 0) {
                engine.news("请选择转账类型", 3000);
                return;
            }
            if (money.length <= 0) {
                engine.news("请输入转账金额", 3000);
                return;
            }
            if (safeword.length <= 0) {
                engine.news("请输入安全密码", 3000);
                return;
            }
            var val = confirm("确定向" + memberid + "转账" + money + "?");
            if (val == true) {
                //发送请求
                engine.news("正在提交...", 999999);
                var ajax = m.ajax("/Admin/Deal/api_transfer_submit", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case 0:
                            engine.news("内部转账已成功", 99999, true);
                            /*setTimeout(function () {
                                m.redirect("/Deal/" + jso.Data + ".html");
                            }, 1000);*/
                            break;
                        case -10000:
                            engine.news("转账处理失败", 3000);
                            break;
                        case -10001:
                            engine.news("验证码错误", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("memberid", memberid);
                ajax.data.add("type", type);
                ajax.data.add("money", money);
                ajax.data.add("remarks",ResChinese(remarks));
                ajax.data.add("safeword", safeword);
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
    function ResChinese(obj)
    {
       return encodeURI(obj);
    }
</script>
            </div>
        </section>