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
		background-size:cover;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/Public/images/max.jpg',sizingMethod='scale');}
</style>


<script type="text/javascript" src="/Public/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/Public/admin/js/spin.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/iosOverlay.js"></script>
<script type="text/javascript" src="/Public/admin/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/admin/js/engine.js"></script>
            <div class="content-wrapper">

<h3>
    数据库清空操作
</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-horizontal">

            <fieldset>
                <div class="form-group">
                    <label class="col-sm-2 control-label">清空数据</label>
                    <div class="col-sm-8">
		<input id="checkcode" name="checkcode" type="text" class="form-control" placeholder="验证码" required="required" />
                    </div>
					<div class="col-xs-2">
		<div class="img-thumbnail" style="width:100%;height: 2.6em;overflow:hidden;">
			<a class="reloadverify" title="换一张" href="javascript:void(0)" onclick="fleshVerify();">
				<img id="verifyImg" class="verifyimg reloadverify" alt="点击切换" style="width:10em;height:2.4em;"
					 src="<?php echo U('/Admin/Daili/builder_verify_img');?>" >
			</a>
		</div>



	</div>
	<br /><br />
	<label class="col-sm-2 control-label">自动生成8层数据</label>
                    <div class="col-sm-6">
		<input id="zidong" name="zidong" type="text" class="form-control" placeholder="默认为1 不自动生成 2为自动生成" required="required" value="1"/>
                    </div>
					 <label class="col-sm-4 control-label">默认为1 不自动生成 2为自动生成</label>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button id="btn_enter" type="button" class="btn btn-primary">确认清空</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<script language="JavaScript">
    function fleshVerify() {
        //重载验证码
        var time = new Date().getTime();
        document.getElementById('verifyImg').src = '/Admin/Daili/builder_verify_img/' + time;
    }
</script>
<script type="text/javascript">
    var pck = {
        submit: function () {

             var checkcode = m.node("#checkcode").value();
          //  if (checkcode.length <= 0) {
          //      engine.news("请输入验证码", 3000);
          //      return;
         //   }
          var zidong = m.node("#zidong").value();

          //  var val = confirm("确定请空数据?");
			
           // if (val == true) {
                //发送请求
                engine.news("正在重置中,请稍后...", 200000);
                var ajax = m.ajax("/Admin/Daili/eliminate_info", null, function (jso) {
                    var jso = m.json.getObject(jso);
                    switch (jso.Error) {
                        case '0':
                            engine.news("成功重置数据",3000);
                            /*setTimeout(function () {
                                m.redirect("/Deal/" + jso.Data + ".html");
                            }, 1000);*/
                            break;
                        case '-10003':
                            engine.news("验证码错误", 3000);
                            break;
                        default:
                            engine.news(jso.Data, 3000);
                            break;
                    }
                });
                ajax.data.add("checkcode", checkcode);
				ajax.data.add("zidong", zidong);
                ajax.send();
          //  }
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