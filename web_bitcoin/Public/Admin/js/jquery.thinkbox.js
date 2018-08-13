/**
 +-------------------------------------------------------------------
 * jQuery thinkbox - 弹出层插件 - http://zjzit.cn/thinkbox
 +-------------------------------------------------------------------
 * @version    1.0.0 beta2
 * @since      2013.05.10
 * @author     麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
 * @github     https://github.com/Aoiujz/thinkbox.git
 +-------------------------------------------------------------------
 */
(function($){
var
    /* 当前脚本文件名 */
    __FILE__ = $("script").last().attr("src"),

    /* 弹出层对象 */
    ThinkBox,

    /* 弹出层默认选项 */
    defaults = {
        "style"       : "default", //弹出层样式
        "title"       : null,      // 弹出层标题
        "fixed"       : true,      // 是否使用固定定位(fixed)而不是绝对定位(absolute)，IE6不支持。
        "center"      : true,      // 弹出层是否屏幕中心显示
        "display"     : true,      // 创建后是否立即显示
        "x"           : 0,         // 弹出层 x 坐标。 当 center 属性为 true 时此属性无效
        "y"           : 0,         // 弹出层 y 坐标。 当 center 属性为 true 时此属性无效
        "modal"       : true,      // 弹出层是否设置为模态。设置为 true 将显示遮罩背景
        "modalClose"  : true,      // 点击模态背景是否关闭弹出层
        "resize"      : true,      // 是否在窗口大小改变时重新定位弹出层位置
        "unload"      : false,     // 关闭后是否卸载
        "escHide"     : true,      // 按ESC是否关闭弹出层
        "delayClose"  : 0,         // 延时自动关闭弹出层 0表示不自动关闭
        "drag"        : false,     // 点击标题框是否允许拖动
        "width"       : "",        // 弹出层内容区域宽度 空表示自适应
        "height"      : "",        // 弹出层内容区域高度 空表示自适应
        "dataEle"     : "",        // 弹出层绑定到的元素，设置此属性的弹出层只允许同时存在一个
        "locate"      : ["left", "top"],       //弹出层位置属性
        "show"        : ["fadeIn", "normal"],  //显示效果
        "hide"        : ["fadeOut", "normal"], //关闭效果
        "actions"     : ["minimize", "maximize", "close"], //窗口操作按钮
        "tools"       : false,  //是否创建工具栏
        "buttons"     : {},     //工具栏默认按钮 仅tools为true时有效
        "beforeShow"  : $.noop, //显示前的回调方法
        "afterShow"   : $.noop, //显示后的回调方法
        "afterHide"   : $.noop, //隐藏后的回调方法
        "beforeUnload": $.noop, //卸载前的回调方法
        "afterDrag"   : $.noop  //拖动停止后的回调方法
    },

    /* 弹出层层叠高度 */
    zIndex = 2013,

    /* 弹出层语言包 */
    lang = {},

    /* 弹出层列表 */
    lists = {},

    /* 弹出层容器 */
    wrapper = [
        "<div class=\"thinkbox\" style=\"position:fixed\">",
            //使用表格，可以做到良好的宽高自适应，而且方便低版本浏览器做圆角样式
            "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">",
                "<tr>",
                    "<td class=\"thinkbox-top-left\"></td>",  //左上角
                    "<td class=\"thinkbox-top\"></td>",       //上边
                    "<td class=\"thinkbox-top-right\"></td>", //右上角
                "</tr>",
                "<tr>",
                    "<td class=\"thinkbox-left\"></td>",       //左边
                    "<td class=\"thinkbox-inner\">", //弹出层inner
                        "<div class=\"thinkbox-title\"></div>", //弹出层标题栏
						"<div class=\"thinkbox-body\"></div>", //弹出层body
                        "<div class=\"thinkbox-tools\"></div>", //弹出层工具栏
                    "</td>",
                    "<td class=\"thinkbox-right\"></td>",      //右边
                "</tr>",
                "<tr>",
                    "<td class=\"thinkbox-bottom-left\"></td>",  //左下角
                    "<td class=\"thinkbox-bottom\"></td>",       //下边
                    "<td class=\"thinkbox-bottom-right\"></td>", //右下角
                "</tr>",
            "</table>",
        "</div>"].join(""),

    /* document和window对象分别对应的jQuery对象 */
    _doc = $(document), _win = $(window);

/* 加载指定的CSS文件 */
function includeCss(css, onload){
    var path = __FILE__.slice(0, __FILE__.lastIndexOf("/"));
    if($("link[href='" + path + css + "']").length){
        fire(onload);
        return;
    };

    //加载CSS文件
    $("<link/>")
        .load(function(){fire(onload)})
        .attr({
            "href" : path + css + "?" + Math.random(),
            "type" : "text/css",
            "rel"  : "stylesheet"
        }).appendTo("head");
}

/* 获取屏幕可视区域的大小和位置 */
function viewport(){
    return {
        "width"  : _win.width(),
        "height" : _win.height(),
        "left"   : _win.scrollLeft(),
        "top"    : _win.scrollTop()
    };
}

/* 调用回调函数 */
function fire(event, data){
    if($.isFunction(event))
        return event.call(this, data);
}

/* 删除options中不必要的参数 */
function del(keys, options){
    if($.isArray(keys)){ //删除多个
        for(i in keys){
            _(keys[i]);
        }
    } else { //删除一个
        _(keys);
    }

    //从options中删除一个指定的元素
    function _(key){
        if(key in options) delete options[key];
    }
}

/* 禁止选中文字 */
function unselect(){
    var element = $("body")[0];
    element.onselectstart = function() {return false}; //ie
    element.unselectable = "on"; // ie
    element.style.MozUserSelect = "none"; // firefox
    element.style.WebkitUserSelect = "none"; // chrome
}

/* 允许选中文字 */
function onselect(){
    var element = $("body")[0];
    element.onselectstart = function() {return true}; //ie
    element.unselectable = "off"; // ie
    element.style.MozUserSelect = ""; // firefox
    element.style.WebkitUserSelect = ""; // chrome
}

/* 设置为当前选中的弹出层对象 */
function setCurrent(){
    var options = lists[this.key][0], box = lists[this.key][1];
    if(lists.current != this.key){
        lists.current = this.key;
        options.modal && box.data("ThinkBoxModal").css({"zIndex": zIndex-1})
        box.css({"zIndex": zIndex++});
    }
}

/* 卸载弹出层容器 */
function unload(){
    var options = lists[this.key][0], box = lists[this.key][1];
    fire.call(this, options.beforeUnload); //卸载前的回调方法
    options.modal && box.data("ThinkBoxModal").remove();
    box.remove();
    _win.off("resize." + this.key);
    delete lists[this.key];
    options.dataEle && $(options.dataEle).removeData("ThinkBox");
}

/* 安装模态背景 */
function setupModal(){
    var self    = this,
        options = lists[this.key][0],
        box     = lists[this.key][1],
        modal   = box.data("ThinkBoxModal");

    //存在隐藏的遮罩层则直接显示
    if(modal){
        modal.show();
        return;
    }

    modal = $("<div class=\"thinkbox-modal-blackout-" + options.style + "\"></div>")
        .css({
            "zIndex"   : zIndex++,
            "position" : "fixed",
            "left"     : 0,
            "top"      : 0,
            "right"    : 0,
            "bottom"   : 0
        })
        .click(function(event){
            options.modalClose && lists.current == self.key && self.hide();
            event.stopPropagation();
        })
        .mousedown(function(event){event.stopPropagation()})
        .appendTo($("body"));
    box.data("ThinkBoxModal", modal);
}

/* 安装标题栏 */
function setupTitleBar() {
    var title = $(".thinkbox-title", lists[this.key][1]), options = lists[this.key][0];
    if(options.title){
        //拖动弹出层
        if (options.drag) {
            title.addClass("thinkbox-draging");
            drag.call(this, title);
        }
        this.setTitle(options.title);
        //安装窗口操作按钮
        setupWindowActions.call(this, title);
    } else {
        title.remove();
    }
}

/* 安装弹出层操作按钮 */
function setupWindowActions(title){
    var actions, button, action, options = lists[this.key][0], self = this;
    if(options.actions && $.isArray(options.actions)){
        actions = $("<div/>").addClass("thinkbox-window-actions").appendTo(title)
            .on("click", "button", function(){
                if(!$(this).hasClass("disabled")){
                    switch(this.name){
                        case "minimize": //最小化
                            self.minimize(this);
                            break;
                        case "maximize": //最大化
                            self.maximize(this);
                            break;
                        case "close": //关闭
                            self.hide();
                            break;
                    }
                }
            })
            .on("mousedown mouseup", function(event){event.stopPropagation()});
        for(i in options.actions){
            button = options.actions[i];
            action = $("<button/>").appendTo(actions).addClass("thinkbox-actions-" + button)
                .attr("name", button) //设置名称
                .attr("title", button) //设置title
                .text(lang[button] || button); //设置显示文本
        }
    }
}

/* 拖动弹出层 */
function drag(title){
    var draging = null, self = this, options = lists[this.key][0], box = lists[this.key][1];
    _doc.mousemove(function(event){
        draging &&
        box.css({left: event.pageX - draging[0], top: event.pageY - draging[1]});
    });
    title.mousedown(function(event) {
        var offset = box.offset();
        if(options.fixed){
            offset.left -= _win.scrollLeft();
            offset.top -= _win.scrollTop();
        }
        unselect(); //禁止选中文字
        draging = [event.pageX - offset.left, event.pageY - offset.top];
    }).mouseup(function() {
        draging = null;
        onselect(); //允许选中文字
        fire.call(self, options.afterDrag); //拖动后的回调函数
    });
}

/* 安装工具栏 */
function setupToolsBar() {
    var tools = $(".thinkbox-tools", lists[this.key][1]),
        options = lists[this.key][0], button, self = this;
    if(options.tools){
        if(options.buttons && $.isPlainObject(options.buttons)){
            for(name in options.buttons){
                this.addToolsButton(name, options.buttons[name]);
            }

            /* 绑定按钮点击事件 */
            tools.on("click", "button", function(){
                if(!$(this).hasClass("disabled")){
                    if(false === options.buttons[this.name][2].call(self)){
                        return;
                    }

                    /* 执行默认事件 */
                    switch(this.name){
                        case "close":
                        case "cancel":
                            self.hide(false);
                            break;
                        case "submit":
                            self.find("form").submit();
                            break;
                    }
                }
            });
        }
    } else {
        tools.remove();
    }
}

/**
 * 构造方法，用于实例化一个新的弹出层对象
 +----------------------------------------------------------
 * element 弹出层内容元素
 * options 弹出层选项
 +----------------------------------------------------------
 */
ThinkBox = function(element, options){
    var self = this, options, box, boxLeft; //初始化变量
    options  = $.extend({}, defaults, options || {}); //合并配置选项

    /* 创建弹出层容器 */
    box = $(wrapper).addClass("thinkbox-" + options.style).data("thinkbox", self);

    /* 保存弹出层基本信息到全局变量 */
    this.key = "thinkbox_" + new Date().getTime() + (Math.random() + "").substr(2,12);
    lists[this.key] = [options, box];

    /* 缓存弹出层，防止弹出多个 */
    options.dataEle && $(options.dataEle).data("thinkbox", self);

    /**
     * 给box绑定事件
     * 鼠标按下记录当前弹出层对象
     * 鼠标点击阻止事件冒泡
     */
    box.on("click mousedown", function(event){
        setCurrent.call(self);
        event.stopPropagation();
    });

    /* 设置弹出层位置属性 */
    options.fixed || box.css("position", "absolute");

    /* 安装弹出层相关组件 */
    setupTitleBar.call(self); // 安装标题栏
    setupToolsBar.call(self);// 安装工具栏

    /* 自动加载css文件并显示弹出层 */
    includeCss("/skin/" + options.style + "/style.css", function(){
        box.hide().appendTo("body"); //放入body

        /* 解决拖动出浏览器时左边不显示的BUG */
        boxLeft = $(".thinkbox-left", box).width();
        boxLeft && $(".thinkbox-left", box).append($("<div/>").css("width", boxLeft));

        self.setSize(options.width, options.height);
        self.setContent(element || "<div></div>"); //设置内容
        options.display && self.show();
    });

}; //END ThinkBox

/**
 * 注册ThinkBox开放API接口
 */
ThinkBox.prototype = {
    /* 显示弹出层 */
    "show" : function(){
        var self = this, options = lists[this.key][0], box = lists[this.key][1];
        if(box.is(":visible")) return this;
        options.modal && setupModal.call(this); // 安装模态背景
        fire.call(this, options.beforeShow); //调用显示之前回调函数
        //显示效果
        switch(options.show[0]){
            case "slideDown":
                box.stop(true, true).slideDown(options.show[1], _);
                break;
            case "fadeIn":
                box.stop(true, true).fadeIn(options.show[1], _);
                break;
            default:
                box.show(options.show[1], _);
        }

        //窗口大小改变后重设位置和大小
        options.resize && _win.on("resize." + self.key, function(){
            self.setSize(options.width, options.height);
            self.resetLocate();
        });
        setCurrent.call(this);
        return this;

        function _(){
            options.delayClose &&
            $.isNumeric(options.delayClose) &&
            setTimeout(function(){
                self.hide();
            }, options.delayClose);
            //调用显示后的回调方法
            fire.call(self, options.afterShow);
        }
    },

    /* 关闭弹出层 data 为传递给关闭后回调函数的额外数据 */
    "hide" : function(data){
        var self = this, options = lists[this.key][0], box = lists[this.key][1], modal;
        if(!box.is(":visible")) return this;

        //隐藏遮罩层
        modal = box.data("ThinkBoxModal");
        modal && modal.fadeOut();

        //影藏效果
        switch(options.hide[0]){
            case "slideUp":
                box.stop(true, true).slideUp(options.hide[1], _);
                break;
            case "fadeOut":
                box.stop(true, true).fadeOut(options.hide[1], _);
                break;
            default:
                box.hide(options.hide[1], _);
        }
        return this;

        function _() {
            fire.call(self, options.afterHide, data); //隐藏后的回调方法
            options.unload && unload.call(self);
        }
    },

    /* 显示或隐藏弹出层 */
    "toggle" : function(){
        return lists[this.key][1].is(":visible") ? self.hide() : self.show();
    },

    /* 在弹出层内容中查找 */
    "find" : function(selector){
        var content = $(".thinkbox-body", lists[this.key][1]);
        return selector ? $(selector, content) : content.children();
    },

    /* 获取弹出层内容 */
    "getContent" : function(){
        return $(".thinkbox-body", lists[this.key][1]).html()
    },

    /* 设置弹出层内容 */
    "setContent" : function(content){ //设置弹出层内容
        var options = lists[this.key][0];
        $(".thinkbox-body", lists[this.key][1]).empty().append($(content).show()); // 添加新内容
        this.resetLocate(); //设置弹出层显示位置
        return this;
    },

    /* 设置弹出层内容区域大小 */
    "setSize" : function(width, height){
        var width  = $.isFunction(width)  ? width.call(this)  : width,
            height = $.isFunction(height) ? height.call(this) : height;
        $(".thinkbox-body", lists[this.key][1]).css({"width" : width, "height" : height});
        return this;
    },

    /* 移动弹出层到屏幕中间 */
    "moveToCenter" : function() {
        var size     = this.getSize(),
            view     = viewport(),
            overflow = lists[this.key][1].css("position") == "fixed" ? [0, 0] : [view.left, view.top],
            x        = overflow[0] + view.width / 2,
            y        = overflow[1] + view.height / 2;
        this.moveTo(x - size[0] / 2, y - size[1] / 2);
        return this;
    },

    /* 移动弹出层到指定坐标 */
    "moveTo" : function (x, y) {
        var box = lists[this.key][1], options = lists[this.key][0];
        $.isNumeric(x) &&
            (options.locate[0] == "left" ? box.css({"left" : x}) : box.css({"right" : x}));
        $.isNumeric(y) &&
            (options.locate[1] == "top" ? box.css({"top" : y}) : box.css({"bottom" : y}));
        return this;
    },

    /* 获取弹出层尺寸 */
    "getSize" : function (){
        var size = [0, 0], box = lists[this.key][1];
        if(box.is(":visible")) //获取显示的弹出层尺寸
            size = [box.width(), box.height()];
        else { //获取隐藏的弹出层尺寸
            box.css({"visibility" : "hidden", "display" : "block"});
            size = [box.width(), box.height()];
            box.css({"visibility" : "visible", "display" : "none"});
        }
        return size;
    },

    /* 设置弹出层标题 */
    "setTitle" : function(title){
        $(".thinkbox-title", lists[this.key][1]).empty().append("<span>" + title + "</span>");
        return this;
    },

    /* 重置弹出层位置 */
    "resetLocate" : function(){
        var options = lists[this.key][0];
        options.center ?
        this.moveToCenter() :
        this.moveTo(
            $.isNumeric(options.x) ?
                options.x :
                ($.isFunction(options.x) ? options.x.call($(options.dataEle)) : 0),
            $.isNumeric(options.y) ?
                options.y :
                ($.isFunction(options.y) ? options.y.call($(options.dataEle)) : 0)
        );
        return this;
    },

    /* 设置状态栏信息 */
    "setStatus" : function(content, name){
        var options = lists[this.key][0],
            box     = lists[this.key][1],
            name    = name ? "thinkbox-status-" + name : "", status;
        /* 存在工具栏则显示状态信息 */
        if(options.tools){
            $(".thinkbox-status", box).remove();
            status = $("<div class=\"thinkbox-status\">").addClass(name).html(content);
            $(".thinkbox-tools", box).prepend(status);
        }
        return this;
    },

    /* 添加一个按钮 */
    "addToolsButton" : function(name, config){
        var options = lists[this.key][0],
            box     = lists[this.key][1], button;
        /* 存在工具栏则创建button */
        if(options.tools){
            button = $("<button/>").attr("name", name).text(config[0]);
            config[1] && button.addClass("thinkbox-button-" + config[1]);
            if(!$.isFunction(config[2])){config[2] = $.noop};
            $(".thinkbox-tools", box).append(button);
        }
        return this;
    },

    /* 重置一个按钮 */
    "setToolsButton" : function(oldName, newName, config){
        var options = lists[this.key][0],
            box     = lists[this.key][1], button;
        button = $(".thinkbox-tools", box).find("button[name=" + oldName + "]", box)
            .attr("name", newName).text(config[0]);
        options.buttons[newName] = config;
        config[1] && button.removeClass().addClass("thinkbox-button-" + config[1]);
        if(!$.isFunction(config[2])){config[2] = $.noop};
        return this;
    },

    /* 卸载一个按钮 */
    "removeToolsButton" : function(name){
        $(".thinkbox-tools", lists[this.key][1]).find("button[name='" + name + "']").remove();
        return this;
    },

    /* 禁用一个按钮 */
    "disableToolsButton" : function(name){
        $(".thinkbox-tools", lists[this.key][1]).find("button[name='" + name + "']")
            .addClass("disabled").attr("disabled", "disabled");
        return this;
    },

    /* 启用一个按钮 */
    "enableToolsButton" : function(name){
        $(".thinkbox-tools", lists[this.key][1]).find("button[name='" + name + "']")
            .removeClass("disabled").removeAttr("disabled", "disabled");
        return this;
    },

    /* 最小化弹出层 */
    "minimize" : function(){
        return this;
    },

    /* 最大化弹出层 */
    "maximize" : function(){
        return this;
    }
}

/* 按ESC关闭弹出层 */
_doc.mousedown(function(){lists.current = null})
    .keydown(function(event){
        lists.current
        && lists[lists.current][0].escHide
        && event.keyCode == 27
        && lists[lists.current][1].data("thinkbox").hide();
    });

/**
 * 创建一个新的弹出层对象
 +----------------------------------------------------------
 * element 弹出层内容元素
 * options 弹出层选项
 +----------------------------------------------------------
 */
$.thinkbox = function(element, options){
    if($.isPlainObject(options) && options.dataEle){
        var data = $(options.dataEle).data("thinkbox");
        if(data) return options.display === false ? data : data.show();
    }
    return new ThinkBox(element, options);
}

/**
 +----------------------------------------------------------
 * 弹出层内置扩展
 +----------------------------------------------------------
 */
$.extend($.thinkbox, {
    /**
     * 设置弹出层默认参数
     * @param  {string} name  配置名称
     * @param  {string} value 配置的值
     */
    "defaults" : function(name, value){
        if($.isPlainObject(name)){
            $.extend(defaults, name);
        } else {
            defaults[name] = value;
        }
    },

    // 以一个URL加载内容并以ThinBox弹出层的形式展现
    "load" : function(url, opt){
        var options = {
            "clone"     : false,
            "loading"   : "加载中...",
            "type"      : "GET",
            "dataType"  : "text",
            "cache"     : false,
            "onload"    : undefined
        }, self, ajax, onload, loading, url = url.split(/\s+/);
        $.extend(options, opt || {}); //合并配置项

        //保存一些参数
        onload    = options.onload;
        loading   = options.loading;

        //组装AJAX请求参数
        ajax = {
            "data"     : options.data,
            "type"     : options.type,
            "dataType" : options.dataType,
            "cache"    : options.cache,
            "success"  : function(data) {
                url[1] && (data = $(data).find(url[1]));
                if($.isFunction(onload))
                    data = fire.call(self, onload, data); //调用onload回调函数
                self.setContent(data); //设置内容并显示弹出层
                loading || self.show(); //没有loading状态则直接显示弹出层
            }
        };

        //删除ThinkBox不需要的参数
        del(["data", "type", "cache", "dataType", "onload", "loading"], options);

        self = loading ?
            //显示loading信息
            $.thinkbox("<div class=\"thinkbox-load-loading\">" + loading + "</div>", options) :
            //不显示loading信息则创建后不显示弹出层
            $.thinkbox("<div/>", $.extend({}, options, {"display" : false}));

        $.ajax(url[0], ajax);
        return self;
    },

    // 弹出一个iframe
    "iframe" : function(url, opt){
        var options = {
            "width"     : 500,
            "height"    : 400,
            "scrolling" : "no",
            "onload"    : undefined
        }, self, iframe, onload;
        $.extend(options, opt || {}); //合并配置项
        onload = options.onload; //设置加载完成后的回调方法
        //创建iframe
        iframe = $("<iframe/>").attr({
            "width"       : options.width,
            "height"      : options.height,
            "frameborder" : 0,
            "scrolling"   : options.scrolling,
            "src"         : url})
            .load(function(){fire.call(self, onload)});
        del(["width", "height", "scrolling", "onload"], options);//删除不必要的信息
        self = $.thinkbox(iframe, options);
        return self;
    },

    // 提示框 可以配合ThinkPHP的ajaxReturn
    "tips" : function(msg, type, opt){
        var options = {
            "modalClose" : false,
            "escHide"    : false,
            "unload"     : true,
            "close"      : false,
            "delayClose" : 1000
        }, html;

        //数字type转换为字符串type
        switch(type){
            case 0: type = "error"; break;
            case 1: type = "success"; break;
        }
        html = "<div class=\"thinkbox-tips thinkbox-tips-" + type + "\">" + msg + "</div>";
        $.extend(options, opt || {});
        return $.thinkbox(html, options);
    },

    // 成功提示框
    "success" : function(msg, opt){
        return this.tips(msg, "success", opt);
    },

    // 错误提示框
    "error" : function(msg, opt){
        return this.tips(msg, "error", opt);
    },

    // 数据加载
    "loading" : function(msg, opt){
        var options = opt || {};
        options.delayClose = 0;
        return this.tips(msg, "loading", options);
    },

    //消息框
    "msg" : function(msg, opt){
        var options = {
            "drag"       : false,
            "escHide"    : false,
            "delayClose" : 0,
            "center"     : false,
            "title"      : "消息",
            "x"          : 0,
            "y"          : 0,
            "locate"     : ["right", "bottom"],
            "show"       : ["slideDown", "slow"],
            "hide"       : ["slideUp", "slow"]
        }, html;
        $.extend(options, opt || {});
        html = $("<div/>").addClass("thinkbox-msg").html(msg);
        return $.thinkbox(html, options);
    },

    //提示框
    "alert" : function(msg, opt){
        var options = {
                "title"      : lang.alert || "Alert",
                "modal"      : true,
                "modalClose" : false,
                "unload"     : false,
                "tools"      : true,
                "actions"    : ["close"],
                "buttons"    : {"ok" : [lang.ok || "Ok", "blue", function(){this.hide()}]}
            };

        $.extend(options, opt || {});

        //删除ThinkBox不需要的参数
        del("ok", options);

        var html = $("<div/>").addClass("thinkbox-alert").html(msg);
        return $.thinkbox(html, options);
    },

    //确认框
    "confirm" : function(msg, opt){
        var options = {"title" : "确认", "modal" : false, "modalClose" : false},
            button  = {"ok" : "确定", "cancel" : "取消"};
        $.extend(options, opt || {});
        options.ok && (button.ok = options.ok);
        options.cancel && (button.cancel = options.cancel);

        //删除ThinkBox不需要的参数
        del(["ok", "cancel"], options);

        options.buttons = button;
        var html = $("<div/>").addClass("thinkbox-confirm").html(msg);
        return $.thinkbox(html, options);
    },

    //弹出层内部获取弹出层对象
    "get" : function(selector){
        //TODO:通过弹窗内部元素找
        return $(selector).closest(".thinkbox").data("thinkbox");
    }
});

$.fn.thinkbox = function(opt){
    if(opt == "get") return $(this).data("thinkbox");
    return this.each(function(){
        var self = $(this), box = self.data("thinkbox"), options, event;
        switch(opt){
            case "show":
                box && box.show();
                break;
            case "hide":
                box && box.hide();
                break;
            case "toggle":
                box && box.toggle();
                break;
            default:
                options = {
                    "title"   : self.attr("title"),
                    "dataEle" : this,
                    "fixed"   : false,
                    "center"  : false,
                    "modal"   : false,
                    "drag"    : false
                };
                opt = $.isPlainObject(opt) ? opt : {};
                $.extend(options, {
                    "x" : function(){return $(this).offset().left},
                    "y" : function(){return $(this).offset().top + $(this).outerHeight()}
                }, opt);
                if(options.event){
                    self.on(event, function(){
                        _.call(self, options);
                        return false;
                    });
                } else {
                    _.call(self, options);
                }
        }
    });

    function _(options){
        var href = this.data("href") || this.attr("href");
        if(href.substr(0, 1) == "#"){
            $.thinkbox(href, options);
        } else if(href.substr(0, 7) == "http://" || href.substr(0, 8) == "https://"){
            $.thinkbox.iframe(href, options);
        } else {
            $.thinkbox.load(href, options);
        }
    }
}

})(jQuery);
