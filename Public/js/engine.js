var engine = {
    host: "http://localhost:8000",
    //通用ajax
    ajax: {
        //身份验证
        check: {
            //发送验证码
            sendccode: function (loginname, callback) {
                var ajx = m.ajax("/check_verify", null, function (xml) {
                    var obj = m.parse.xmlToJson(m.parse.toXml(xml));
                    //比对错误编码
                    callback(m.parse.toInteger(obj.HttpResult.error.text));
                }, true)
                ajx.data.add("loginname", loginname);
                ajx.send();
            }
        },
        /*
         [获取申请类型-函数]
         参数：
         id      编号
         callback回调函数
         */
        flowtype: function (id, callback) {
            var ajax = m.ajax("/service/common.asmx/flowtype", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取地区信息-函数]
         参数：
         id      编号
         callback回调函数
         */
        place: function (root, callback) {
            var ajax = m.ajax("/User/User/place", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("root", root);
            ajax.send();
        },
        /*
         [获取语言信息-函数]
         参数：
         id      编号
         callback回调函数
         */
        language: function (id, callback) {
            var ajax = m.ajax("/service/common.asmx/language", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取行业信息-函数]
         参数：
         id      编号
         callback回调函数
         */
        trade: function (id, callback) {
            var ajax = m.ajax("/service/common.asmx/trade", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取银行信息-函数]
         参数：
         id      编号
         callback回调函数
         */
        bank: function (id, callback) {
            var ajax = m.ajax("/User/User/bank", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取快递信息-函数]
         参数：
         id      编号
         callback回调函数
         */
        express: function (id, callback) {
            var ajax = m.ajax("/User/User/express", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取会员等级-函数]
         参数：
         id      编号
         callback回调函数
         */
        memberlevel: function (id, callback) {
            var ajax = m.ajax("/User/User/memberlevel", null, function (xml) {
                console.log(xml);
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },

        /*
         [获取单类型-函数]
         参数：
         id      编号
         callback回调函数
         */
        membersingle: function (id, callback) {
            var ajax = m.ajax("/User/User/membersingle", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },

        /*
         [获取会员奖金发放-函数]
         参数：
         id      编号
         callback回调函数
         */
        membergrant : function (id, callback) {
            var ajax = m.ajax("/User/User/membergrant", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },


        /*
         [获取会员市场-函数]
         参数：
         id      编号
         callback回调函数
         */
        memberarea: function (id, callback) {
            var ajax = m.ajax("/User/User/memberarea", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        },
        /*
         [获取订单状态-函数]
         参数：
         id      编号
         callback回调函数
         */
        orderstate: function (id, callback) {
            var ajax = m.ajax("/service/common.asmx/orderstate", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("id", id);
            ajax.send();
        }
    },
    //语言
    language: function (id) {
        m.ajax('/Service/language.ashx?id=' + id, null, function (content) {
            engine.news("切换语言中，请稍候....", 3000, true);
            setTimeout(function () { m.redirect("/Home/main"); }, 750);
        }).send();
    },
    //宽度
    width: 0,
    //高度
    height: 0,
    //滚动条插件
    scroll: {},
    news: function (text, sec) {
        $.mobile.loading('show', {
            text: text, //加载器中显示的文字
            textVisible: true, //是否显示文字
            theme: 'a',        //加载器主题样式a-e
            textonly: false,   //是否只显示文字
            html: ""           //要显示的html内容，如图片等
        });
        setTimeout(function () { $.mobile.loading('hide'); }, sec);
    },
    //系统加载时
    init: function () { }
}
$(function () {
    engine.init();
});
$(document).on("pageinit", function (event) {
    if (pck && pck.title) {
        document.title = pck.title;
        m.node("#navbar_title").html(pck.title);
    }
});
