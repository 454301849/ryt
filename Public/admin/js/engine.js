/****************************************************************************主框架代码库*/
var engine = {
    base: {
        StateToggler : function() {

            var storageKeyName  = 'jq-toggleState';

            // Helper object to check for words in a phrase //
            var WordChecker = {
                hasWord: function (phrase, word) {
                    return new RegExp('(^|\\s)' + word + '(\\s|$)').test(phrase);
                },
                addWord: function (phrase, word) {
                    if (!this.hasWord(phrase, word)) {
                        return (phrase + (phrase ? ' ' : '') + word);
                    }
                },
                removeWord: function (phrase, word) {
                    if (this.hasWord(phrase, word)) {
                        return phrase.replace(new RegExp('(^|\\s)*' + word + '(\\s|$)*', 'g'), '');
                    }
                }
            };

            // Return service public methods
            return {
                // Add a state to the browser storage to be restored later
                addState: function(classname){
                    var data = m.local.get(storageKeyName);

                    if(!data)  {
                        data = classname;
                    }
                    else {
                        data = WordChecker.addWord(data, classname);
                    }

                    m.local.set(storageKeyName, data);
                },

                // Remove a state from the browser storage
                removeState: function(classname){
                    var data = m.local.get(storageKeyName);
                    // nothing to remove
                    if(!data) return;

                    data = WordChecker.removeWord(data, classname);

                    m.local.set(storageKeyName, data);
                },

                // Load the state string and restore the classlist
                restoreState: function($elem) {
                    var data = m.local.get(storageKeyName);

                    // nothing to restore
                    if(!data) return;
                    $elem.addClass(data);
                }

            };
        },
        sidebarAddBackdrop: function () {
            var $backdrop = $('<div/>', { 'class': 'dropdown-backdrop' });
            $backdrop.insertAfter('.aside').on("click mouseenter", function () {
                engine.base.removeFloatingNav();
            });
        },
        toggleTouchItem: function ($element) {
            $element
                .siblings('li')
                .removeClass('open')
                .end()
                .toggleClass('open');
        },
        toggleMenuItem: function ($listItem) {

            engine.base.removeFloatingNav();

            var ul = $listItem.children('ul');

            if (!ul.length) return $();
            if ($listItem.hasClass('open')) {
                engine.base.toggleTouchItem($listItem);
                return $();
            }

            var $aside = $('.aside');
            var $asideInner = $('.aside-inner'); // for top offset calculation
            // float aside uses extra padding on aside
            var mar = parseInt($asideInner.css('padding-top'), 0) + parseInt($aside.css('padding-top'), 0);

            var subNav = ul.clone().appendTo($aside);

            engine.base.toggleTouchItem($listItem);

            var itemTop = ($listItem.position().top + mar) - $sidebar.scrollTop();
            var vwHeight = $win.height();

            subNav
                .addClass('nav-floating')
                .css({
                    position: engine.base.isFixed() ? 'fixed' : 'absolute',
                    top: itemTop,
                    bottom: (subNav.outerHeight(true) + itemTop > vwHeight) ? 0 : 'auto'
                });

            subNav.on('mouseleave', function () {
                engine.base.toggleTouchItem($listItem);
                subNav.remove();
            });

            return subNav;
        },
        removeFloatingNav: function () {
            $('.sidebar-subnav.nav-floating').remove();
            $('.dropdown-backdrop').remove();
            $('.sidebar li.open').removeClass('open');
        },
        isTouch: function () {
            return $html.hasClass('touch');
        },
        isSidebarCollapsed: function () {
            return $body.hasClass('aside-collapsed');
        },
        isSidebarToggled: function () {
            return $body.hasClass('aside-toggled');
        },
        isMobile: function () {
            return $win.width() < mq.tablet;
        },
        isFixed: function () {
            return $body.hasClass('layout-fixed');
        },
        useAsideHover: function () {
            return $body.hasClass('aside-hover');
        },
        //侧边栏支持
        sidebar: function () {
            $win = $(window);
            $html = $('html');
            $body = $('body');
            $sidebar = $('.sidebar');
            mq = APP_MEDIAQUERY;

            // AUTOCOLLAPSE ITEMS 
            // ----------------------------------- 

            var sidebarCollapse = $sidebar.find('.collapse');
            sidebarCollapse.on('show.bs.collapse', function (event) {

                event.stopPropagation();
                if ($(this).parents('.collapse').length === 0)
                    sidebarCollapse.filter('.in').collapse('hide');

            });

            // SIDEBAR ACTIVE STATE 
            // ----------------------------------- 

            // Find current active item
            var currentItem = $('.sidebar .active').parents('li');

            // hover mode don't try to expand active collapse
            if (!engine.base.useAsideHover())
                currentItem
                    .addClass('active')     // activate the parent
                    .children('.collapse')  // find the collapse
                    .collapse('show');      // and show it

            // remove this if you use only collapsible sidebar items
            $sidebar.find('li > a + ul').on('show.bs.collapse', function (e) {
                if (engine.base.useAsideHover()) e.preventDefault();
            });

            // SIDEBAR COLLAPSED ITEM HANDLER
            // ----------------------------------- 


            var eventName = engine.base.isTouch() ? 'click' : 'mouseenter';
            var subNav = $();
            $sidebar.on(eventName, '.nav > li', function () {

                if (engine.base.isSidebarCollapsed() || engine.base.useAsideHover()) {

                    subNav.trigger('mouseleave');
                    subNav = engine.base.toggleMenuItem($(this));

                    // Used to detect click and touch events outside the sidebar          
                    sidebarAddBackdrop();
                }

            });

            var sidebarAnyclickClose = $sidebar.data('sidebarAnyclickClose');

            // Allows to close
            if (typeof sidebarAnyclickClose !== 'undefined') {

                $('.wrapper').on('click.sidebar', function (e) {
                    // don't check if sidebar not visible
                    if (!$body.hasClass('aside-toggled')) return;

                    var $target = $(e.target);
                    if (!$target.parents('.aside').length && // if not child of sidebar
                        !$target.is('#user-block-toggle') && // user block toggle anchor
                        !$target.parent().is('#user-block-toggle') // user block toggle icon
                    ) {
                        $body.removeClass('aside-toggled');
                    }

                });
            }
        },
        //状态支持
        state: function () {
            var $body = $('body');
            toggle = new engine.base.StateToggler();

            $('[data-toggle-state]')
                .on('click', function (e) {
                    // e.preventDefault();
                    e.stopPropagation();
                    var element = $(this),
                        classname = element.data('toggleState'),
                        target = element.data('target'),
                        noPersist = (element.attr('data-no-persist') !== undefined);

                    // Specify a target selector to toggle classname
                    // use body by default
                    var $target = target ? $(target) : $body;

                    if (classname) {
                        if ($target.hasClass(classname)) {
                            $target.removeClass(classname);
                            if (!noPersist)
                                toggle.removeState(classname);
                        }
                        else {
                            $target.addClass(classname);
                            if (!noPersist)
                                toggle.addState(classname);
                        }

                    }
                    // some elements may need this when toggled class change the content size
                    // e.g. sidebar collapsed mode and jqGrid
                    $(window).resize();

                });
        },
        gaussian: function (open) {
            if (open == true) {
                m.node("#gaussian_warp").addClass("gaussian-blur");
            }
            else {
                m.node("#gaussian_warp").removeClass("gaussian-blur");
            }
        },
    },
    //通用ajax
    ajax: {
        //身份验证
        check: {
            //发送验证码
            sendccode: function (loginname, callback) {
                var ajx = m.ajax("/service/check.asmx/sendccode", null, function (xml) {
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
         [获取产品类型信息-函数]
         参数：
         root      编号
         callback回调函数
         */
        productclassify: function (root, callback) {
            var ajax = m.ajax("/service/common.asmx/productclassify", null, function (xml) {
                var obj = mtopt.parse.xmlToJson(mtopt.parse.toXml(xml));
                var jso = m.json.getObject(obj.HttpResult.data.text);
                callback(jso);
            }, true);
            ajax.data.add("root", root);
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
        membergrant: function (id, callback) {
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
    //退出
    exit: function () {
      //  engine.base.gaussian(true);
        //engine.news("正在退出帐号，请稍候....", 3000, true);
        setTimeout(function () { m.redirect("../User/api_cancel") }, 1500);
    },
    //语言
    language: function (id) {
        m.ajax('/Service/language.ashx?id=' + id, null, function (content) {
            engine.base.gaussian(true);
            engine.news("切换语言中，请稍候....", 3000, true);
            setTimeout(function () { m.reload() }, 1500);
        }).send();
    },
    //皮肤
    skin: function (id) {
        m.ajax('/Service/skin.ashx?id=' + id, null, function (content) {
            engine.base.gaussian(true);
            engine.news("切换界面中，请稍候....", 3000, true);
            setTimeout(function () { m.reload() }, 1500);
        }).send();
    },
    //搜索
    search: function () {
        var text = m.node(".mn-header-search .text").value();
        m.redirect('/store?keyword=' + text);
    },
    news_target: null,
    news: function (text, time) {
        var opts = {
            lines: 13,
            length: 11,
            width: 5,
            radius: 17,
            corners: 1,
            rotate: 0,
            color: '#FFF',
            speed: 1,
            trail: 60,
            shadow: false,
            hwaccel: false,
            className: 'spinner',
            zIndex: 2e9,
            top: 'auto',
            left: 'auto'
        };
        if (this.news_target != null) {
            try {
                this.news_target.overlay.destroy();
            }
            catch (e) { }
            document.body.removeChild(this.news_target);
            this.news_target = null;
        }
        this.news_target = document.createElement("div");
        document.body.appendChild(this.news_target);
        this.news_target.spinner = new Spinner(opts).spin(this.news_target);
        this.news_target.overlay = iosOverlay({
            text: text,
            duration: time,
            spinner: this.news_target.spinner
        });
        return false;
    },
    //加载
    init: function () {
        paceOptions = {
            ajax: false, // disabled
            document: false, // disabled
            eventLag: false, // disabled
            elements: {
                selectors: ['.my-page']
            }
        };
        //程序初始化
        {
            var $body = $('body');
            new engine.base.StateToggler().restoreState($body);
            // enable settings toggle after restore
            $('#chk-fixed').prop('checked', $body.hasClass('layout-fixed'));
            $('#chk-collapsed').prop('checked', $body.hasClass('aside-collapsed'));
            $('#chk-boxed').prop('checked', $body.hasClass('layout-boxed'));
            $('#chk-float').prop('checked', $body.hasClass('aside-float'));
            $('#chk-hover').prop('checked', $body.hasClass('aside-hover'));
            // When ready display the offsidebar
            $('.offsidebar.hide').removeClass('hide');
            //bootstrap
            // POPOVER
            // ----------------------------------- 
            $('[data-toggle="popover"]').popover();
            // TOOLTIP
            // ----------------------------------- 
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
            // DROPDOWN INPUTS
            // ----------------------------------- 
            $('.dropdown input').on('click focus', function (event) {
                event.stopPropagation();
            });
            window.APP_COLORS = {
                'primary': '#5d9cec',
                'success': '#27c24c',
                'info': '#23b7e5',
                'warning': '#ff902b',
                'danger': '#f05050',
                'inverse': '#131e26',
                'green': '#37bc9b',
                'pink': '#f532e5',
                'purple': '#7266ba',
                'dark': '#3a3f51',
                'yellow': '#fad732',
                'gray-darker': '#232735',
                'gray-dark': '#3a3f51',
                'gray': '#dde6e9',
                'gray-light': '#e4eaec',
                'gray-lighter': '#edf1f2'
            };
            window.APP_MEDIAQUERY = {
                'desktopLG': 1200,
                'desktop': 992,
                'tablet': 768,
                'mobile': 480
            };

        }
        //状态支持
        engine.base.state();
        engine.base.sidebar();
    }
}
m.event("ready").add(function () {
    engine.init();
});