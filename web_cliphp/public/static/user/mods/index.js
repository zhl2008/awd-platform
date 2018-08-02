/**

 @Name: Fly社区主入口

 */


layui.define(['layer', 'laytpl', 'form', 'upload', 'util'], function (exports) {
    var $ = layui.jquery
        , layer = layui.layer
        , laytpl = layui.laytpl
        , form = layui.form
        , util = layui.util
        , device = layui.device;

    //阻止IE7以下访问
    if (device.ie && device.ie < 8) {
        layer.alert('如果您非得使用ie浏览Fly社区，那么请使用ie8+');
    }

    layui.focusInsert = function (obj, str) {
        var result, val = obj.value;
        obj.focus();
        if (document.selection) { //ie
            result = document.selection.createRange();
            document.selection.empty();
            result.text = str;
        } else {
            result = [val.substring(0, obj.selectionStart), str, val.substr(obj.selectionEnd)];
            obj.focus();
            obj.value = result.join('');
        }
    };

    var gather = {
        //Ajax
        json: function (url, data, success, options) {
            var that = this;
            options = options || {};
            data = data || {};
            return $.ajax({
                type: options.type || 'post',
                dataType: options.dataType || 'json',
                data: data,
                url: url,
                success: function (res) {
                    if (res.status === 1) {
                        success && success(res);
                    } else {
                        layer.msg(res.msg || res.code, {icon: 2});
                    }
                }, error: function (e) {
                    options.error || layer.msg('请求异常，请重试', {shift: 6});
                }
            });
        }
        //将普通对象按某个key排序
        , sort: function (data, key, asc) {
            var obj = JSON.parse(JSON.stringify(data));
            var compare = function (obj1, obj2) {
                var value1 = obj1[key];
                var value2 = obj2[key];
                if (value2 < value1) {
                    return -1;
                } else if (value2 > value1) {
                    return 1;
                } else {
                    return 0;
                }
            };
            obj.sort(compare);
            if (asc) obj.reverse();
            return obj;
        }
        , form: {}
    };
    //表单提交
    form.on('submit(*)', function (data) {
        var action = $(data.form).attr('action'), button = $(data.elem);
        gather.json(action, data.field, function (res) {
            var end = function () {
                if (res.action) {
                    layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                        location.href = res.action;
                    });
                } else {
                    gather.form[action || button.attr('key')](data.field, data.form);
                }
            };
            if (res.status === 1) {
                button.attr('alert') ? layer.alert(res.msg, {icon: 1, time: 1000, end: end}) : end();
            }
        });
        return false;
    });

    //加载特定模块
    if (layui.cache.page && layui.cache.page !== 'index') {
        var extend = {};
        extend[layui.cache.page] = layui.cache.page;
        layui.extend(extend);
        layui.use(layui.cache.page);
    }


    //手机设备的简单适配
    var treeMobile = $('.site-tree-mobile')
        , shadeMobile = $('.site-mobile-shade')

    treeMobile.on('click', function () {
        $('body').addClass('site-mobile');
    });

    shadeMobile.on('click', function () {
        $('body').removeClass('site-mobile');
    });
    exports('fly', gather);

});

