function pwdLevel(value) {
    var pattern_1 = /^.*([\W_])+.*$/i;
    var pattern_2 = /^.*([a-zA-Z])+.*$/i;
    var pattern_3 = /^.*([0-9])+.*$/i;
    var level = 0;
    if (value.length > 10) {
        level++;
    }
    if (pattern_1.test(value)) {
        level++;
    }
    if (pattern_2.test(value)) {
        level++;
    }
    if (pattern_3.test(value)) {
        level++;
    }
    if (level > 3) {
        level = 3;
    }
    return level;
}
// 休眠
function sleepm(numberMillis) {
    var now = new Date();
    var exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime) return;
    }
}
var weakPwdArray = ["123456", "123456789", "111111", "5201314", "12345678", "123123", "password", "1314520", "123321", "7758521", "1234567", "5211314", "666666", "520520", "woaini", "520131", "11111111", "888888", "hotmail.com", "112233", "123654", "654321", "1234567890", "a123456", "88888888", "163.com", "000000", "yahoo.com.cn", "sohu.com", "yahoo.cn", "111222tianya", "163.COM", "tom.com", "139.com", "wangyut2", "pp.com", "yahoo.com", "147258369", "123123123", "147258", "987654321", "100200", "zxcvbnm", "123456a", "521521", "7758258", "111222", "110110", "1314521", "11111111", "12345678", "a321654", "111111", "123123", "5201314", "00000000", "q123456", "123123123", "aaaaaa", "a123456789", "qq123456", "11112222", "woaini1314", "a123123", "a111111", "123321", "a5201314", "z123456", "liuchang", "a000000", "1314520", "asd123", "88888888", "1234567890", "7758521", "1234567", "woaini520", "147258369", "123456789a", "woaini123", "q1q1q1q1", "a12345678", "qwe123", "123456q", "121212", "asdasd", "999999", "1111111", "123698745", "137900", "159357", "iloveyou", "222222", "31415926", "123456", "111111", "123456789", "123123", "9958123", "woaini521", "5201314", "18n28n24a5", "abc123", "password", "123qwe", "123456789", "12345678", "11111111", "dearbook", "00000000", "123123123", "1234567890", "88888888", "111111111", "147258369", "987654321", "aaaaaaaa", "1111111111", "66666666", "a123456789", "11223344", "1qaz2wsx", "xiazhili", "789456123", "password", "87654321", "qqqqqqqq", "000000000", "qwertyuiop", "qq123456", "iloveyou", "31415926", "12344321", "0000000000", "asdfghjkl", "1q2w3e4r", "123456abc", "0123456789", "123654789", "12121212", "qazwsxedc", "abcd1234", "12341234", "110110110", "asdasdasd", "123456", "22222222", "123321123", "abc123456", "a12345678", "123456123", "a1234567", "1234qwer", "qwertyui", "123456789a", "qq.com", "369369", "163.com", "ohwe1zvq", "xiekai1121", "19860210", "1984130", "81251310", "502058", "162534", "690929", "601445", "1814325", "as1230", "zz123456", "280213676", "198773", "4861111", "328658", "19890608", "198428", "880126", "6516415", "111213", "195561", "780525", "6586123", "caonima99", "168816", "123654987", "qq776491", "hahabaobao", "198541", "540707", "leqing123", "5403693", "123456", "123456789", "111111", "5201314", "123123", "12345678", "1314520", "123321", "7758521", "1234567", "5211314", "520520", "woaini", "520131", "666666", "RAND#a#8", "hotmail.com", "112233", "123654", "888888", "654321", "1234567890", "a123456"];

function verc() {
    $("#JD_Verification1").click();
}
function verc2() {
    $("#JD_Verification2").click();
}
var validateRegExp = {
    decmal: "^([+-]?)\\d*\\.\\d+$",
    // 浮点数
    decmal1: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$",
    // 正浮点数
    decmal2: "^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$",
    // 负浮点数
    decmal3: "^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$",
    // 浮点数
    decmal4: "^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$",
    // 非负浮点数（正浮点数 + 0）
    decmal5: "^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$",
    // 非正浮点数（负浮点数 +
    // 0）
    intege: "^-?[1-9]\\d*$",
    // 整数
    intege1: "^[1-9]\\d*$",
    // 正整数
    intege2: "^-[1-9]\\d*$",
    // 负整数
    num: "^([+-]?)\\d*\\.?\\d+$",
    // 数字
    num1: "^[1-9]\\d*|0$",
    // 正数（正整数 + 0）
    num2: "^-[1-9]\\d*|0$",
    // 负数（负整数 + 0）
    ascii: "^[\\x00-\\xFF]+$",
    // 仅ACSII字符
    chinese: "^[\\u4e00-\\u9fa5]+$",
    // 仅中文
    color: "^[a-fA-F0-9]{6}$",
    // 颜色
    date: "^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",
    // 日期
    email: "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$",
    // 邮件
    idcard: "^[1-9]([0-9]{14}|[0-9]{17})$",
    // 身份证
    ip4: "^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$",
    // ip地址
    letter: "^[A-Za-z]+$",
    // 字母
    letter_l: "^[a-z]+$",
    // 小写字母
    letter_u: "^[A-Z]+$",
    // 大写字母
    mobile: "^0?(13|15|18|14|17)[0-9]{9}$",
    // 手机
    notempty: "^\\S+$",
    // 非空
    password: "^.*[A-Za-z0-9\\w_-]+.*$",
    // 密码
    fullNumber: "^[0-9]+$",
    // 数字
    picture: "(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",
    // 图片
    qq: "^[1-9]*[1-9][0-9]*$",
    // QQ号码
    rar: "(.*)\\.(rar|zip|7zip|tgz)$",
    // 压缩文件
    tel: "^[0-9\-()（）]{7,18}$",
    // 电话号码的函数(包括验证国内区号,国际区号,分机号)
    url: "^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$",
    // url
    username: "^[A-Za-z0-9_\\-\\u4e00-\\u9fa5]+$",
    // 户名
    deptname: "^[A-Za-z0-9_()（）\\-\\u4e00-\\u9fa5]+$",
    // 单位名
    zipcode: "^\\d{6}$",
    // 邮编
    realname: "^[A-Za-z\\u4e00-\\u9fa5]+$",
    // 真实姓名
    companyname: "^[A-Za-z0-9_()（）\\-\\u4e00-\\u9fa5]+$",
    companyaddr: "^[A-Za-z0-9_()（）\\#\\-\\u4e00-\\u9fa5]+$",
    companysite: "^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&#=]*)?$"
};
// 主函数
(function($) {
    $.fn.jdValidate = function(option, callback, def) {
        var ele = this;
        var id = ele.attr("id");
        var type = ele.attr("type");
        var rel = ele.attr("rel");
        var _onFocus = $("#" + id + validateSettings.onFocus.container);
        var _succeed = $("#" + id + validateSettings.succeed.container);
        var _isNull = $("#" + id + validateSettings.isNull.container);
        var _error = $("#" + id + validateSettings.error.container);
        if (def == true) {
            var str = ele.val();
            var tag = ele.attr("sta");
            if (str == "" || str == "-1") {
                validateSettings.isNull.run({
                    prompts: option,
                    element: ele,
                    isNullEle: _isNull,
                    succeedEle: _succeed
                },
                option.isNull);
            } else if (tag == 1 || tag == 2) {
                return;
            } else {
                callback({
                    prompts: option,
                    element: ele,
                    value: str,
                    errorEle: _error,
                    succeedEle: _succeed
                });
            }
        } else {
            if (typeof def == "string") {
                ele.val(def);
            }
            if (type == "checkbox" || type == "radio") {
                if (ele.attr("checked") == true) {
                    ele.attr("sta", validateSettings.succeed.state);
                }
            }
            switch (type) {
            case "text":
            case "password":
                ele.bind("focus",
                function() {
                    var str = ele.val();
                    if (str == def) {
                        ele.val("");
                    }
                    validateSettings.onFocus.run({
                        prompts: option,
                        element: ele,
                        value: str,
                        onFocusEle: _onFocus,
                        succeedEle: _succeed
                    },
                    option.onFocus, option.onFocusExpand);
                }).bind("blur",
                function() {
                    var str = ele.val();
                    if (str == "") {
                        ele.val(def);
                    }
                    if (validateRules.isNull(str)) {
                        validateSettings.isNull.run({
                            prompts: option,
                            element: ele,
                            value: str,
                            isNullEle: _isNull,
                            succeedEle: _succeed
                        },
                        "");
                    } else {
                        callback({
                            prompts: option,
                            element: ele,
                            value: str,
                            errorEle: _error,
                            isNullEle: _isNull,
                            succeedEle: _succeed
                        });
                    }
                });
                break;
            default:
                if (rel && rel == "select") {
                    ele.bind("change",
                    function() {
                        var str = ele.val();
                        callback({
                            prompts: option,
                            element: ele,
                            value: str,
                            errorEle: _error,
                            isNullEle: _isNull,
                            succeedEle: _succeed
                        });
                    })
                } else {
                    ele.bind("click",
                    function() {
                        callback({
                            prompts: option,
                            element: ele,
                            errorEle: _error,
                            isNullEle: _isNull,
                            succeedEle: _succeed
                        });
                    })
                }
                break;
            }
        }
    }
})(jQuery);

// 配置
var validateSettings = {
    onFocus: {
        state: null,
        container: "_error",
        style: "focus",
        run: function(option, str, expands) {
            if (!validateRules.checkType(option.element)) {
                option.element.removeClass(validateSettings.INPUT_style2).addClass(validateSettings.INPUT_style1);
            }
            option.succeedEle.removeClass(validateSettings.succeed.style);
            option.onFocusEle.removeClass().addClass(validateSettings.onFocus.style).html(str);
            if (expands) {
                expands();
            }
        }
    },
    isNull: {
        state: 0,
        container: "_error",
        style: "null",
        run: function(option, str) {
            option.element.attr("sta", 0);
            if (!validateRules.checkType(option.element)) {
                if (str == "") {
                    option.element.removeClass(validateSettings.INPUT_style2).removeClass(validateSettings.INPUT_style1);
                } else {
                    option.element.removeClass(validateSettings.INPUT_style1).addClass(validateSettings.INPUT_style2);
                }
            }

            option.succeedEle.removeClass(validateSettings.succeed.style);
            if (str == "") {
                option.isNullEle.removeClass().addClass(validateSettings.isNull.style).html(str);
            } else {
                option.isNullEle.removeClass().addClass(validateSettings.error.style).html(str);
            }
        }
    },
    error: {
        state: 1,
        container: "_error",
        style: "error",
        run: function(option, str) {
            option.element.attr("sta", 1);
            if (!validateRules.checkType(option.element)) {
                option.element.removeClass(validateSettings.INPUT_style1).addClass(validateSettings.INPUT_style2);
            }

            option.succeedEle.removeClass(validateSettings.succeed.style);
            option.errorEle.removeClass().addClass(validateSettings.error.style).html(str);
        }
    },
    succeed: {
        state: 2,
        container: "_succeed",
        style: "succeed",
        run: function(option) {
            option.element.attr("sta", 2);
            option.errorEle.empty();
            if (!validateRules.checkType(option.element)) {
                option.element.removeClass(validateSettings.INPUT_style1).removeClass(validateSettings.INPUT_style2);
            }

            option.succeedEle.addClass(validateSettings.succeed.style);
            option.errorEle.removeClass();
        }
    },
    INPUT_style1: "highlight1",
    INPUT_style2: "highlight2"
}

// 验证规则
var validateRules = {
    isNull: function(str) {
        return (str == "" || typeof str != "string");
    },
    betweenLength: function(str, _min, _max) {
        return (str.length >= _min && str.length <= _max);
    },
    isUid: function(str) {
        return new RegExp(validateRegExp.username).test(str);
    },
    fullNumberName: function(str) {
        return new RegExp(validateRegExp.fullNumber).test(str);
    },
    isPwd: function(str) {
        return /^.*([\W_a-zA-z0-9-])+.*$/i.test(str);
    },
    isPwdRepeat: function(str1, str2) {
        return (str1 == str2);
    },
    isEmail: function(str) {
        return new RegExp(validateRegExp.email).test(str);
    },
    isTel: function(str) {
        return new RegExp(validateRegExp.tel).test(str);
    },
    isMobile: function(str) {
        return new RegExp(validateRegExp.mobile).test(str);
    },
    checkType: function(element) {
        return (element.attr("type") == "checkbox" || element.attr("type") == "radio" || element.attr("rel") == "select");
    },
    isRealName: function(str) {
        return new RegExp(validateRegExp.realname).test(str);
    },
    isCompanyname: function(str) {
        return new RegExp(validateRegExp.companyname).test(str);
    },
    isCompanyaddr: function(str) {
        return new RegExp(validateRegExp.companyaddr).test(str);
    },
    isCompanysite: function(str) {
        return new RegExp(validateRegExp.companysite).test(str);
    },
    simplePwd: function(str) {
        // var pin = $("#regName").val();
        // if (pin.length > 0) {
        // pin = strTrim(pin);
        // if (pin == str) {
        // return true;
        // }
        // }
        return pwdLevel(str) == 1;
    },
    weakPwd: function(str) {
        for (var i = 0; i < weakPwdArray.length; i++) {
            if (weakPwdArray[i] == str) {
                return true;
            }
        }
        return false;
    }
};
// 验证文本
var validatePrompt = {
    regName: {
        //onFocus: "4-20位字符，支持中英文、数字及\"-\"、\"_\"组合",
        onFocus:"4-20位字符,支持汉字、字母、数字及\"-\"、\"_\"组合",
        succeed: "",
        isNull: "请输入用户名",
        error: {
            beUsed: "该用户名已被使用，请重新输入。如果您是该用户，请立刻<a href='https://passport.jd.com/uc/login' class='flk13'>登录</a>",
            badLength: "用户名长度只能在4-20位字符之间",
            badFormat: "用户名只能由中文、英文、数字及\"-\"、\"_\"组成",
            fullNumberName: "用户名不能是纯数字，请重新输入"
        },
        onFocusExpand: function() {
            $("#morePinDiv").removeClass().addClass("intelligent-error hide");
        }
    },

    pwd: {
        onFocus: "<span>6-20位字符，建议由字母，数字和符号两种以上组合</span>",
        succeed: "",
        isNull: "请输入密码",
        error: {
            badLength: "密码长度只能在6-20位字符之间",
            badFormat: "密码只能由英文、数字及标点符号组成",
            simplePwd: "<span>该密码比较简单，有被盗风险，建议您更改为复杂密码，如字母+数字的组合</span>",
            weakPwd: "<span>该密码比较简单，有被盗风险，建议您更改为复杂密码</span>"
        },
        onFocusExpand: function() {
            $("#pwdstrength").hide();
        }
    },
    pwdRepeat: {
        onFocus: "请再次输入密码",
        succeed: "",
        isNull: "请确认密码",
        error: {
            badLength: "密码长度只能在6-20位字符之间",
            badFormat2: "两次输入密码不一致",
            badFormat1: "密码只能由英文、数字及标点符号组成"
        }
    },
    phone: {
        onFocus: "请输入手机号码",
        succeed: "",
        isNull: "请输入手机号码",
        error: ""
    },
    protocol: {
        onFocus: "",
        succeed: "",
        isNull: "请先阅读并同意《京东用户注册协议》",
        error: ""
    },
    empty: {
        onFocus: "",
        succeed: "",
        isNull: "",
        error: ""
    }
};

var nameold, morePinOld, emailResult;
var namestate = false;
// 回调函数
var validateFunction = {
    regName: function(option) {
        $("#intelligent-regName").empty().hide();
        var regName = option.value;
        if (validateRules.isNull(regName) || regName == '') {
            option.element.removeClass(validateSettings.INPUT_style2).removeClass(validateSettings.INPUT_style1);
            $("#regName_error").removeClass().empty();
            return;
        }
        $("#authcodeDiv").show();
        checkPin(option);
    },

    pwd: function(option) {
        var str1 = option.value;
        var regName = $("#regName").val();
        if ((validateRules.isNull(regName) == false) && (regName != '') && regName == str1) {
            $("#pwdstrength").hide();
            validateSettings.error.run(option, "<span>您的密码与账户信息太重合，有被盗风险，请换一个密码</span>");
            return;
        }

        //var str2 = $("#pwdRepeat").val();
        $("#pwdRepeat").blur();
        var format = validateRules.isPwd(option.value);
        var length = validateRules.betweenLength(option.value, 6, 20);

        $("#pwdstrength").hide();
        if (!length && format) {
            validateSettings.error.run(option, option.prompts.error.badLength);
        } else if (!length && !format) {
            validateSettings.error.run(option, option.prompts.error.badFormat);
        } else if (length && !format) {
            validateSettings.error.run(option, option.prompts.error.badFormat);
        } else if (validateRules.weakPwd(str1)) {
            validateSettings.error.run(option, option.prompts.error.weakPwd);
        } else {

            validateSettings.succeed.run(option);
            validateFunction.pwdstrength();
            if (validateRules.simplePwd(str1)) {
                $("#pwd_error").removeClass().addClass("focus");
                $("#pwd_error").empty().html(option.prompts.error.simplePwd);
                return;
            }
        }
        //		if (str2 == str1) {
        //			$("#pwdRepeat").focus();
        //		}
    },
    pwdRepeat: function(option) {
        var str1 = option.value;
        var str2 = $("#pwd").val();
        var length = validateRules.betweenLength(option.value, 6, 20);
        var format2 = validateRules.isPwdRepeat(str1, str2);
        var format1 = validateRules.isPwd(str1);
        if (!length) {
            validateSettings.error.run(option, option.prompts.error.badLength);
        } else {
            if (!format1) {
                validateSettings.error.run(option, option.prompts.error.badFormat1);
            } else {
                if (!format2) {
                    validateSettings.error.run(option, option.prompts.error.badFormat2);
                } else {
                    validateSettings.succeed.run(option);
                }
            }
        }
    },
    // mobileCode: function(option) {
    // var bool = validateRules.isNull(option.value);
    // if (bool) {
    // validateSettings.error.run(option, option.prompts.error);
    // return;
    // } else {
    // validateSettings.succeed.run(option);
    // }
    // },
    protocol: function(option) {
        if (option.element.attr("checked") == true) {
            option.element.attr("sta", validateSettings.succeed.state);
            option.errorEle.html("");
        } else {
            option.element.attr("sta", validateSettings.isNull.state);
            option.succeedEle.removeClass(validateSettings.succeed.style);
        }
    },
    pwdstrength: function() {
        var element = $("#pwdstrength");
        var value = $("#pwd").val();
        if (value.length >= 6 && validateRules.isPwd(value)) {
            $("#pwd_error").removeClass('focus');
            $("#pwd_error").empty();
            element.show();
            var level = pwdLevel(value);
            switch (level) {
            case 1:
                element.removeClass().addClass("strengthA");
                break;
            case 2:
                element.removeClass().addClass("strengthB");
                break;
            case 3:
                element.removeClass().addClass("strengthC");
                break;
            default:
                break;
            }
        } else {
            element.hide();
        }
    },
    checkGroup: function(elements) {
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].checked) {
                return true;
            }
        }
        return false;
    },
    checkSelectGroup: function(elements) {
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].value == -1) {
                return false;
            }
        }
        return true;
    },

    FORM_submit: function(elements) {
        var bool = true;
        for (var i = 0; i < elements.length; i++) {
            if ($(elements[i]).attr("sta") == 2) {
                bool = true;
            } else {
                bool = false;
                break;
            }
        }

        return bool;
    }
};

// 检查用户名
var checkpin = -10;
function checkPin(option) {
    var pin = option.value;
    if (!validateRules.betweenLength(pin.replace(/[^\x00-\xff]/g, "**"), 4, 20)) {
        validateSettings.error.run(option, option.prompts.error.badLength);
        return false;
    }

    if (!validateRules.isUid(pin)) {
        validateSettings.error.run(option, option.prompts.error.badFormat);
        return;
    }
    if (validateRules.fullNumberName(pin)) {
        validateSettings.error.run(option, option.prompts.error.fullNumberName);
        return;
    }
    if (!namestate || nameold != pin) {
        if (nameold != pin) {
            nameold = pin;
            option.errorEle.html("<em style='color:#999'>检验中……</em>");
            $.getJSON("../validateuser/isPinEngaged?pin=" + escape(pin) + "&r=" + Math.random(),
            function(date) {
                checkpin = date.success;
                if (date.success == 0) {
                    validateSettings.succeed.run(option);
                    namestate = true;
                } else if (date.success == 2) {
                    validateSettings.error.run(option, "用户名包含了非法词");
                    namestate = false;
                } else {
                    validateSettings.error.run(option, "<span>" + option.prompts.error.beUsed.replace("{1}", option.value) + "</span>");
                    namestate = false;
                    morePinOld = date.morePin;
                    if (date.morePin != null && date.morePin.length > 0) {
                        var html = ""
                        for (var i = 0; i < date.morePin.length; i++) {
                            html += "<div class='item-fore'><input name='morePinRadio' onclick='selectMe(this);' type='radio' class='radio' value='" + date.morePin[i] + "'/><label>" + date.morePin[i] + "</label></div>"
                        }
                        $("#morePinGroom").empty();
                        $("#morePinGroom").html(html);
                        $("#morePinDiv").removeClass().addClass("intelligent-error");
                    }
                }
            });
        } else {

            if (checkpin == 2) {
                validateSettings.error.run(option, "用户名包含了非法词");
            } else {
                validateSettings.error.run(option, "<span>" + option.prompts.error.beUsed.replace("{1}", option.value) + "</span>");
                if (morePinOld != null && morePinOld.length > 0) {
                    $("#morePinDiv").removeClass().addClass("intelligent-error");
                }
            }
            namestate = false;
        }
    } else {
        validateSettings.succeed.run(option);
    }
}

function selectMe(option) {
    $("#morePinDiv").removeClass().addClass("intelligent-error hide");
    $("#regName").val(option.value);
    $("#regName").blur();
}
// 主流程发送手机验证码
function sendMobileCode() {
    if ($("#sendMobileCode").attr("disabled")) {
        return;
    }
    mobileCodeHide();
    var mobile = $("#phone").val();
    if (validateRules.isNull(mobile)) {
        $("#phone_error").removeClass().addClass("error").html("请输入手机号");
        $("#phone_error").show();
        return;
    }
    if (!validateRules.isMobile(mobile)) {
        $("#phone_error").removeClass().addClass("error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone_error").show();
        return;
    }
    $('#mobileCode').removeClass("highlight2");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {
        if (result.success == 0) {
            $('#phone').removeClass().addClass("text");
            $("#phone_error").html("");
            $("#phone_error").hide();
            $("#phone_succeed").removeClass().addClass("blank succeed");
            mobileFlags = true;
            sendmCode();
        }

        if (result.success == 1) {
            $('#phone').removeClass().addClass('text highlight3');
            $("#phone_error").html("手机号已注册，继续注册将与原账号解绑");
            $("#phone_error").removeClass().addClass("cue");
            $("#phone_error").show();
            $("#phone_succeed").removeClass().addClass("blank cue-ico");
            mobileFlags = false;
            var state = $("#state").val();
            if (state == "unbind") {
                sendmCode();
            } else {
                mobileEngagedStyle();
            }
        }

        if (result.success == 2) {
            $('#phone').removeClass().addClass('text highlight2');
            $("#phone_error").html("该手机号已被其它账户绑定，"+result.ub+"天内不可改绑");
            $("#phone_error").removeClass().addClass("error");
            $("#phone_error").show();
            $("#phone_succeed").removeClass().addClass("");
            mobileFlags = false;
        }
    });

}
// 手机注册发送验证码target
function sendmCode() {
    if ($("#sendMobileCode").attr("disabled") || delayFlag == false) {
        return;
    }
    var state = $("#state").val();
    if (state != "unbind") {
        $("#rebind").remove();
        $("#mobileCodeDiv").show();
    }
    $("#sendMobileCode").attr("disabled", "disabled");
    jQuery.ajax({
        type: "get",
        url: "../notifyuser/mobileCode?state=" + state + "&mobile=" + $("#phone").val() + "&r=" + Math.random(),
        success: function(result) {
            if (result) {
                var obj = eval(result);
                if (obj.rs == 1 || obj.remain) {
                    $("#mobileCode_error").addClass("hide");
                    $("#dyMobileButton").html("120秒后重新获取");
                    if (obj.remain) {
                        $("#mobileCodeSucMessage").empty().html(obj.remain);
                    } else {
                        if (state == "unbind") {
                            $("#mobileCode_error").removeClass().addClass("cue").empty().html("校验码已发送,注册成功后手机号将与原帐号解绑");
                            $("#mobileCode_error").show();
                        } else {
                            $("#mobileCode_error").removeClass().empty().html("验证码已发送，请查收短信。");
                            $("#mobileCode_error").show();
                        }
                    }

                    setTimeout(countDown, 1000);
                    $("#sendMobileCode").removeClass().addClass("btn btn-15").attr("disabled", "disabled");
                    $("#mobileCode").removeAttr("disabled");
                }
                if (obj.rs == -1) {
                    mobileCodeError("网络繁忙，请稍后重新获取验证码");
                }
                if (obj.info) {
                    if (obj.info == "该手机号已被使用，请更换号码") {
                        mobileEngagedStyle();
                    } else {
                        mobileCodeError(obj.info);
                    }

                }

                if (obj.rs == -2) {
                    mobileCodeError("网络繁忙，请稍后重新获取验证码");
                }
            }
        }
    });
}
// 邮箱验证发送验证码target
function sendmCode1() {
    if ($("#sendMobileCode1").attr("disabled") || delayFlag1 == false) {
        return;
    }
    $("#rebind1").remove();
    $("#mobileCodeDiv1").show();
    $("#sendMobileCode1").attr("disabled", "disabled");
    var state = $("#state").val();
    jQuery.ajax({
        type: "get",
        url: "../notifyuser/mobileCode?state=" + state + "&mobile=" + $("#phone1").val() + "&r=" + Math.random(),
        success: function(result) {
            if (result) {
                var obj = eval(result);
                if (obj.rs == 1 || obj.remain) {
                    $("#mobileCode1_error").addClass("hide");
                    $("#dyMobileButton1").html("120秒后重新获取");
                    if (obj.remain) {
                        $("#mobileCodeSucMessage1").empty().html(obj.remain);
                    } else {
                        if (state == "unbind") {
                            $("#mobileCodeSucMessage1").removeClass().addClass("cue").empty().html("校验码已发送,注册成功后手机号将与原帐号解绑");
                        } else {
                            $("#mobileCodeSucMessage1").empty().html("验证码已发送，请查收短信。");
                        }
                    }

                    setTimeout(countDown1, 1000);
                    $("#sendMobileCode1").removeClass().addClass("btn btn-15").attr("disabled", "disabled");
                    $("#mobileCode1").removeAttr("disabled");
                }
                if (obj.rs == -1) {
                    $("#mobileCode1_error").html("网络繁忙，请稍后重新获取验证码");
                    $("#mobileCode1_error").removeClass().addClass("error");
                    $("#mobileCode1_error").show();
                    $("#sendMobileCode1").removeClass().addClass("btn").removeAttr("disabled");
                }
                if (obj.info) {
                    if (obj.info == "该手机号已被使用，请更换号码") {
                        mobileEngagedStyle1();
                    } else {
                        $("#mobileCode1_error").html(obj.info);
                        $("#mobileCode1_error").removeClass().addClass("error");
                        $("#mobileCode1_error").show();
                        $("#sendMobileCode1").removeClass().addClass("btn").removeAttr("disabled");
                    }
                }

                if (obj.rs == -2) {
                    $("#mobileCode1_error").html("网络繁忙，请稍后重新获取验证码");
                    $("#mobileCode1_error").removeClass().addClass("error");
                    $("#mobileCode1_error").show();
                    $("#sendMobileCode1").removeClass().addClass("btn").removeAttr("disabled");
                }
            }
        }
    });
}
// 次流程发送手机验证码
function sendMobileCode1() {
    if ($("#sendMobileCode1").attr("disabled")) {
        return;
    }
    var mobile = $("#phone1").val();
    if (validateRules.isNull(mobile)) {
        $('#phone1').addClass('highlight2');
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        $("#phone1_error").removeClass().addClass("error").html("请输入手机号");
        $("#phone1_error").show();
        return;
    }
    if (!validateRules.isMobile(mobile)) {
        $("#phone1_error").removeClass().addClass("error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone1_error").show();
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        return;
    }

    var mobile = $("#phone1").val();
    if (mobile == "") {
        $('#phone1').removeClass().addClass("text");
        $("#phone1_error").hide();
        $('#phone1_succeed').removeClass('error-ico');
        mobileFlag = false;
        return;
    }
    if (!validateRules.isMobile(mobile)) {
        $("#phone1_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone1_error").removeClass().addClass("error");
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        $("#phone1_error").show();
        $('#phone1').removeClass("highlight1").addClass('highlight2');
        mobileFlag = false;
        return;
    }
    $("#mobileCode1_error").removeClass().empty();
    $("#mobileCode1_error").hide();
    $('#mobileCode1').removeClass("highlight2");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {
        if (result.success == 0) {
            $('#phone1').removeClass().addClass("text");
            $("#phone1_error").html("");
            $("#phone1_error").hide();
            $("#phone1_succeed").removeClass().addClass("blank succeed");
            mobileFlags = true;
            sendmCode1();
            return;
        }
        if (result.success == 1) {
            $('#phone1').removeClass().addClass('text highlight3');
            $("#phone1_error").html("手机号已注册，继续注册将与原账号解绑");
            $("#phone1_error").removeClass().addClass("cue");
            $("#phone1_error").show();
            $("#phone1_succeed").removeClass().addClass("blank cue-ico");
            mobileFlags = false;
            var state = $("#state").val();
            if (state == "unbind") {
                sendmCode1();
            } else {
                mobileEngagedStyle1();
            }
            return;
        }
        if (result.success == 2) {
            $('#phone1').removeClass().addClass('text highlight2');
            $("#phone_error").html("该手机号已被其它账户绑定，"+result.ub+"天内不可改绑");
            $("#phone1_error").removeClass().addClass("error");
            $("#phone1_error").show();
            $("#phone1_succeed").removeClass().addClass("blank error-ico");
            // $("#sendMobileCode1").attr("disabled", "disabled");
            mobileFlags = false;
        }
    });
}

var oldEmail, emailCheckResult;
// 邮箱验证信息填写
function sendRegMail() {
    var mail = $("#mail").val();
    var authcode1 = $("#authcode1").val();
    if (mail == "") {
        $("#mail_error").removeClass().addClass("error").html("请输入邮箱");
        $("#mail_error").show();
        $('#mail_succeed').addClass('error-ico');
        $('#mail').addClass('highlight2');
        return;
    }
    var email = strTrim(mail);
    var format = validateRules.isEmail(email);
    var format2 = validateRules.betweenLength(email, 0, 50);
    if (!format) {
        $("#mail_error").html("邮箱地址不正确，请重新输入");
        $('#mail_succeed').addClass('error-ico');
        $('#mail').addClass('highlight2');
        return;
    } else {
        if (!format2) {
            $('#mail_error').removeClass().addClass("error");
            $("#mail_error").html("邮箱地址长度应在4-50个字符之间");
            $('#mail_succeed').addClass('error-ico');
            $('#mail').removeClass("highlight1").addClass('highlight2');
            return;
        } else {
            // if (oldEmail == email) {
            // if (emailCheckResult == 1) {
            // emailEngagedStyle();
            // return;
            // }
            // if (emailCheckResult == 2) {
            // emailFormatErrorStyle();
            // return;
            // }
            // return;
            // }
            // oldEmail = email;
            $.getJSON("../validateuser/isEmailEngaged?email=" + escape(email) + "&r=" + Math.random(),
            function(result) {
                emailResult = result.success;
                emailCheckResult = emailResult;
                // 邮箱未被验证 可注册
                if (emailResult == 0) {
                    $("#emailMg").val(email);
                    $("#authcodeMg").val(authcode1);
                    jdThickBoxclose();
                    $("#dyMobileButton1").html("获取短信验证码");
                    jQuery.jdThickBox({
                        type: "text",
                        width: 500,
                        height: 260,
                        source: $('#box01').html(),
                        title: "验证手机",
                        _close_val: "×",
                        _con: "opinioncon",
                        _titleOn: true
                    });
                }
                if (emailResult == 1) {
                    emailEngagedStyle();
                    return;
                }
                if (emailResult == 2) {
                    emailFormatErrorStyle();
                    return;
                }
            });

        }
    }
}

function emailEngagedStyle() {
    $('#mail_succeed').addClass('error-ico');
    $('#mail_error').removeClass().addClass("error");
    $("#mail_error").html("该邮箱已被使用，请更换其它邮箱");
}

function emailFormatErrorStyle() {
    $('#mail_succeed').addClass('error-ico');
    $('#mail_error').removeClass().addClass("error");
    $("#mail_error").html("邮箱地址不正确，请重新输入");
}

// 邮箱验证 验证手机 提交注册
function mobileReg() {
    var mail = $("#emailMg").val();
    var authcode = $("#authcodeMg").val();
    var email = strTrim(mail);
    var format = validateRules.isEmail(email);
    var format2 = validateRules.betweenLength(email, 0, 50);
    if (!format) {
        $("#mail_error").html("邮箱地址不正确，请重新输入");
        return;
    } else if (!format2) {
        $("#mail_error").html("邮箱地址长度应在4-50个字符之间");
        return;
    }

    var mobile = $("#phone1").val();
    var phonevalue = $("#phone").val();
    var mobileCode = $("#mobileCode1").val();
    if (mobile == "") {
        $('#phone1').addClass('highlight2');
        $("#phone1_error").removeClass().addClass("error").html("请输入手机号");
        $("#phone1_error").show();
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
    }

    if (mobileCode == "") {
        $('#mobileCode1').addClass('highlight2');
        $("#mobileCodeSucMessage1").empty();
        $("#mobileCodeSucMessage1").removeClass();
        $("#mobileCode1_error").html("请输入短信验证码");
        $("#mobileCode1_error").removeClass().addClass("error");
        $("#mobileCode1_error").show();
        return;
    }
    if (mobile == "") {
        $('#phone1').addClass('highlight2');
        $("#phone1_error").removeClass().addClass("error").html("请输入手机号");
        $("#phone1_error").show();
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        return;
    } else if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $("#phone1_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone1_error").removeClass().addClass("error");
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        $("#phone1_error").show();
        $('#phone1').removeClass().addClass('text highlight2');
        $("#mobileCodeDiv1").show();
        mobileFlag = false;
        return;
    }
    var state = $("#state").val();
    if (state == "unbind") {
        mobileFlag = true;
    }
    if (mobileFlag) {
        var paramList = $("#personRegForm").serialize() + "&email=" + email;
        var temp = paramList.replace("phone=" + phonevalue, "phone=" + mobile);
        var params = temp.replace("mobileCode=", "mobileCode=" + mobileCode);
        params = params.replace("authcode=", "authcode=" + authcode);
        $.ajax({
            type: "POST",
            url: "../register/sendRegEmail?r=" + Math.random() + "&" + location.search.substring(1),
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            data: params,
            success: function(result) {
                var obj = eval(result);
                var emailResult = obj.success;
                var key = obj.k;
                if (emailResult == 0) {
                    jdThickBoxclose();
                    jQuery.jdThickBox({
                        type: "text",
                        width: 510,
                        height: 280,
                        source: '<div class="thickbox-tip fz14">' + '<div class="icon-box">' + '<span class="succ-icon m-icon"></span>' + '<div class="item-fore">' + '<div class="ftx-02 info-succ">账户更安全购物更放心</div>' + '</div>' + '</div>' + '<div class="msg-txt">' + '系统已向您的邮箱&nbsp;<strong class="ftx-01">' + $("#emailMg").val() + '</strong>&nbsp;发送了一封验证邮件，请您登录邮箱，点击邮件中的链接完成邮箱验证。如果超过2分钟未收到邮件，您可以<a href="#none" onclick="reSendEmail(\'' + $("#emailMg").val() + '\',\'' + key + '\');" class="ftx-05">重新发送</a>' + '</div>' + '<div class="mt10 ftx-01"> <span id="reSendEmailSuccess"></span></div>' + '<div class="mt20">' + '<a href="#" id="emailLogin" class="btn-red">登录邮箱</a>'
                        // +'<a href="#none"
                        // onclick="changeEmail();"
                        // class="ftx-05 fr">返回邮箱修改</a>'
                        + '<span class="clr"></span>' + '</div>' + '</div>',
                        title: "温馨提示",
                        _close_val: "×",
                        _con: "opinioncon",
                        _titleOn: true
                    });

                    initEmailLoginUrl(email);
                } else {
                    $("#mobileCodeSucMessage1").removeClass().empty();
                    $("#mobileCode1_error").html(obj.info);
                    $("#mobileCode1_error").removeClass().addClass("error");
                    $("#mobileCode1_error").show();
                    $("#sendMobileCode1").removeClass().addClass("btn").removeAttr("disabled");
                }
            }
        });
    }
}
function mobileCodeError(content) {
    $("#mobileCode_error").html(content);
    $("#mobileCode_error").removeClass().addClass("error");
    $("#mobileCode_error").show();
    $("#sendMobileCode").removeClass().addClass("btn").removeAttr("disabled");
}
function mobileCodeHide() {
    $("#mobileCode_error").html("");
    $("#mobileCode_error").removeClass().addClass("error");
    $("#mobileCode_error").hide();
}
var delayTime = 120;
var delayFlag = true;
function countDown() {
    delayTime--;
    $("#sendMobileCode").attr("disabled", "disabled");
    $("#dyMobileButton").html(delayTime + '秒后重新获取');
    if (delayTime == 1) {
        delayTime = 120;
        $("#mobileCodeSucMessage").removeClass().empty();
        $("#dyMobileButton").html("获取短信验证码");
        $("#mobileCode_error").addClass("hide");
        $("#sendMobileCode").removeClass().addClass("btn").removeAttr("disabled");
        delayFlag = true;
    } else {
        delayFlag = false;
        setTimeout(countDown, 1000);
    }
}
var delayTime1 = 120;
var delayFlag1 = true;
function countDown1() {
    delayTime1--;
    $("#sendMobileCode1").attr("disabled", "disabled");
    $("#dyMobileButton1").html(delayTime1 + '秒后重新获取');
    if (delayTime1 == 1) {
        delayTime1 = 120;
        $("#mobileCodeSucMessage1").removeClass().empty();
        $("#dyMobileButton1").html("获取短信验证码");
        $("#mobileCode1_error").removeClass().empty();
        $("#mobileCode1_error").hide();
        $("#sendMobileCode1").removeClass().addClass("btn").removeAttr("disabled");
        delayFlag1 = true;
    } else {
        delayFlag1 = false;
        countDown1.timer = setTimeout(countDown1, 1000);
    }
}
countDown1.timer = '';
function strTrim(str) {
    return str.replace(/(^\s*)|(\s*$)/g, "");
}

$("#regName").blur(function() {
    setTimeout(function() {
        if ($("#schoolid").val() == "") {
            $("#schoolinput").val("");
            $("#hnschool").val("-1");
            $("#hnschool").attr("sta", 0);
            $("#schoolinput_succeed").removeClass("succeed");
        } else {
            $("#hnschool").val("1");
            $("#hnschool").attr("sta", 2);
            $("#schoolinput_error").html("");
            $("#schoolinput_succeed").addClass("succeed");
        }
        $('#intelligent-school').hide().empty();
        $("#hnseli").val("-1");
    },
    200)
})

function showHideProtocol() {
    var protocolNode = $('.protocol-box');
    if (!protocolNode.is(':hidden')) {
        protocolNode.hide();
    } else {
        protocolNode.show();
    }
    return false;
}

function validateRegName() {
    var loginName = $("#regName").val();
    if (validateRules.isNull(loginName) || loginName == '') {
        $("#regName").val("");
        $("#regName").attr({
            "class": "text highlight2"
        });
        $("#regName_error").html("请输入用户名").show().attr({
            "class": "error"
        });
        return false;
    }
    return true;
}
$("#regist .tab li").hover(function() {
    if ($(this).hasClass("curr")) {} else {
        $(this).addClass("new");
    }
},
function() {
    if ($(this).hasClass("curr")) {} else {
        $(this).removeClass("new");
    }
})

$("#registsubmit").hover(function() {
    $(this).addClass("hover-btn")
},
function() {

    $(this).removeClass("hover-btn")
})

// 主流程手机获得焦点事件
function phoneFocus() {
    var mobile = $("#phone").val();
    if (oldMobile == mobile && mobile != "") {
        return;
    }
    $("#phone_succeed").removeClass("blank succeed");
    $('#phone').removeClass().addClass('text highlight1');
    $("#phone_error").removeClass().addClass("focus").html("完成验证后，您可以用该手机号登录和找回密码");
    $("#phone_error").show();
    $('#phone_succeed').removeClass('error-ico');
}
//主流程手机获得焦点事件
function phoneOtherFocus() {
    var mobile = $("#phone").val();
    if (oldMobile == mobile && mobile != "") {
        return;
    }
    $("#phone_succeed").removeClass("blank succeed");
    $('#phone').removeClass().addClass('text highlight1');
    $("#phone_error").removeClass().addClass("focus").html("请输入手机号码");
    $("#phone_error").show();
    $('#phone_succeed').removeClass('error-ico');
}
// 次流程手机获得焦点事件
function phone1Focus() {
    var mobile1 = $("#phone1").val();
    if (oldMobile1 == mobile1 && mobile1 != "") {
        return;
    }
    $("#phone1_succeed").removeClass();
    $('#phone1').removeClass().addClass('text highlight1');
    $("#phone1_error").removeClass().addClass("focus").html("完成验证后，您可以用该手机号登录和找回密码");
    $("#phone1_error").show();
    $('#phone1_succeed').removeClass('error-ico');
}

var oldMobile, mobileResult;
// 主流程检查手机
function phoneBlur() {
    var mobile = $("#phone").val();

    if (mobile == "") {
        $('#phone').removeClass().addClass('text');
        $("#phone_error").removeClass().html("");
        $("#phone_error").hide();
        $("#rebind").remove();
        $("#mobileCodeDiv").show();
        $("#phone_succeed").removeClass().addClass("");
        oldMobile = mobile;
        mobileFlags = false;
        return;
    }
    if (oldMobile == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult(mobileResult);
        return;
    }
    oldMobile = mobile;
    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $('#phone').removeClass().addClass('text highlight2');
        $("#phone_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone_error").removeClass().addClass("error");
        $("#phone_error").show();
        $("#phone_succeed").removeClass().addClass("");
        $("#rebind").remove();
        $("#mobileCodeDiv").show();
        mobileFlags = false;
        return;
    }
    $("#mobileCodeSucMessage").removeClass().empty();
    $("#mobileCode_error").html("");
    $("#mobileCode_error").hide();
    $("#state").val("");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {

        mobileResult = result.success;
        // if (mobileResult != 2) {
        // if ($("#sendMobileCode").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode").removeAttr("disabled");
        // }
        $("#sendMobileCode").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle();
        }

        if (result.success == 1) {
            mobileEngagedStyle();
        }

        if (result.success == 2) {
            mobileBindedStyle(result.ub);
            // $("#sendMobileCode").attr("disabled", "disabled");
        }
    });
}
//主流程检查手机
function phoneKeyup() {
    var mobile = $("#phone").val();
    var mobileLength=mobile.length;
    if(mobileLength != 11)
    {
    	return;
    }
    if (mobile == "") {
        $('#phone').removeClass().addClass('text');
        $("#phone_error").removeClass().html("");
        $("#phone_error").hide();
        $("#rebind").remove();
        $("#mobileCodeDiv").show();
        $("#phone_succeed").removeClass().addClass("");
        oldMobile = mobile;
        mobileFlags = false;
        return;
    }
    if (oldMobile == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult(mobileResult);
        return;
    }
    oldMobile = mobile;
    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $('#phone').removeClass().addClass('text highlight2');
        $("#phone_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone_error").removeClass().addClass("error");
        $("#phone_error").show();
        $("#phone_succeed").removeClass().addClass("");
        $("#rebind").remove();
        $("#mobileCodeDiv").show();
        mobileFlags = false;
        return;
    }
    $("#mobileCodeSucMessage").removeClass().empty();
    $("#mobileCode_error").html("");
    $("#mobileCode_error").hide();
    $("#state").val("");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {

        mobileResult = result.success;
        // if (mobileResult != 2) {
        // if ($("#sendMobileCode").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode").removeAttr("disabled");
        // }
        $("#sendMobileCode").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle();
        }

        if (result.success == 1) {
            mobileEngagedStyle();
        }

        if (result.success == 2) {
            mobileBindedStyle(result.ub);
            // $("#sendMobileCode").attr("disabled", "disabled");
        }
    });
}

//主流程检查手机
function phoneOtherBlur() {
    var mobile = $("#phone").val();

    if (mobile == "") {
        $('#phone').removeClass().addClass('text');
        $("#phone_error").removeClass().html("");
        $("#phone_error").hide();
        $("#phone_succeed").removeClass().addClass("");
        oldMobile = mobile;
        mobileFlags = false;
        return;
    }
    if (oldMobile == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult(mobileResult);
        return;
    }
    oldMobile = mobile;
    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $('#phone').removeClass().addClass('text highlight2');
        $("#phone_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone_error").removeClass().addClass("error");
        $("#phone_error").show();
        $("#phone_succeed").removeClass().addClass("");
        mobileFlags = false;
        return;
    }
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {

        mobileResult = result.success;
        // if (mobileResult != 2) {
        // if ($("#sendMobileCode").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode").removeAttr("disabled");
        // }
        $("#sendMobileCode").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle();
        }

        if (result.success == 1 || result.success == 2) {
        	 $('#phone').removeClass().addClass('text highlight2');
             $("#phone_error").html("该手机号已被绑定，请更换手机号");
             $("#phone_error").removeClass().addClass("error");
             $("#phone_error").show();
             $("#phone_succeed").removeClass().addClass("");
        	 mobileFlags = false;
        }

    });
}
//主流程检查手机
function phoneOtherKeyup() {
    var mobile = $("#phone").val();
    var mobileLength=mobile.length;
    if(mobileLength != 11)
    {
    	return;
    }
    if (mobile == "") {
        $('#phone').removeClass().addClass('text');
        $("#phone_error").removeClass().html("");
        $("#phone_error").hide();
        $("#phone_succeed").removeClass().addClass("");
        oldMobile = mobile;
        mobileFlags = false;
        return;
    }
    if (oldMobile == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult(mobileResult);
        return;
    }
    oldMobile = mobile;
    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $('#phone').removeClass().addClass('text highlight2');
        $("#phone_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone_error").removeClass().addClass("error");
        $("#phone_error").show();
        $("#phone_succeed").removeClass().addClass("");
        mobileFlags = false;
        return;
    }
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {

        mobileResult = result.success;
        // if (mobileResult != 2) {
        // if ($("#sendMobileCode").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode").removeAttr("disabled");
        // }
        $("#sendMobileCode").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle();
        }

        if (result.success == 1 || result.success == 2) {
         	 $('#phone').removeClass().addClass('text highlight2');
             $("#phone_error").html("该手机号已被绑定，请更换手机号");
             $("#phone_error").removeClass().addClass("error");
             $("#phone_error").show();
             $("#phone_succeed").removeClass().addClass("");
       	    mobileFlags = false;
       }
    });
}
function showMobileCheckResult(result) {
    if (result == 0) {
        mobileOkStyle();
    }
    if (result == 1) {
        mobileEngagedStyle();
    }
    if (result == 2) {
        mobileBindedStyle();
    }
}

function mobileOkStyle() {
    $('#phone').removeClass().addClass("text");
    $("#phone_error").html("");
    $("#phone_error").hide();
    $("#phone_succeed").removeClass().addClass("blank succeed");
    $("#mobileCode_error").removeClass().empty();
    $("#mobileCodeDiv").show();
    $("#rebind").remove();
    $("#mobileCodeDiv").show();
    mobileFlags = true;
}

function mobileBindedStyle(ub) {
    $('#phone').removeClass().addClass('text highlight2');
    $("#phone_error").html("该手机号已被其它账户绑定，"+ub+"天内不可改绑");
    $("#phone_error").removeClass().addClass("error");
    $("#phone_error").show();
    $("#phone_succeed").removeClass().addClass("");
    $("#rebind").remove();
    $("#mobileCodeDiv").show();
    mobileFlags = false;
}

function mobileEngagedStyle() {
    $('#phone').removeClass().addClass('text highlight3');
    $("#phone_error").html("手机号已注册，继续注册将与原账号解绑");
    $("#phone_error").removeClass().addClass("cue");
    $("#phone_error").show();
    $("#phone_succeed").removeClass().addClass("blank cue-ico");
    $("#rebind").remove();
    $('#dphone').after('<div class="item" id="rebind"> <span class="label">&nbsp;</span><div class="fl item-ifo item-ifo-extra"> <a href="javascript:;" onclick="unbind();" class="btn-comm"><span>继续注册</span></a> </div> </div>');
    $("#mobileCodeDiv").hide();
    mobileFlags = false;
}
function showMobileCheckResult1(result) {
    if (result == 0) {
        mobileOkStyle1();
    }
    if (result == 1) {
        mobileEngagedStyle1();
    }
    if (result == 2) {
        mobileBindedStyle1();
    }
}
function mobileOkStyle1() {
    $('#phone1').removeClass().addClass("text");
    $("#phone1_error").removeClass().addClass("success");
    $("#phone1_error").html("此手机号可用");
    $("#phone1_succeed").removeClass().addClass("blank succeed");
    $("#mobileCodeDiv1").show();
    $("#dmcode1").show();
    $("#rebind1").remove();
    mobileFlag = true;
    return;
}

function mobileBindedStyle1(ub) {
    $('#phone1').removeClass().addClass('text highlight2');
    $("#phone1_error").html("该手机号已被其它账户绑定，"+ub+"天内不可改绑");
    $("#phone1_error").removeClass().addClass("error");
    $("#phone1_succeed").removeClass().addClass("blank error-ico");
    $("#phone1_error").show();
    $('#phone1').removeClass("highlight1").addClass('highlight2');
    $("#sendMobileCode1").attr("disabled", "disabled");
    $("#mobileCodeDiv1").show();
    $("#rebind1").remove();
    mobileFlag = false;
    return;
}

function mobileEngagedStyle1() {
    $('#phone1').removeClass().addClass('text highlight3');
    $("#phone1_error").html("手机号已注册，继续注册将与原账号解绑");
    $("#phone1_error").removeClass().addClass("cue");
    $("#phone1_succeed").removeClass().addClass("blank cue-ico");
    $("#phone1_error").show();
    $("#rebind1").remove();
    $('#dphone1').after('<div class="item"  id="rebind1"><span class="label">&nbsp;</span><div class="fl item-ifo"><a href="javascript:void(0);" onclick="unbind1();"  class="btn btn-comm"><span>继续注册</span></a></div></div>');
    $("#mobileCodeDiv1").hide();
    mobileFlag = false;
    return;
}
// 次流程手机失去焦点事件
var mobileFlag = false;
var oldMobile1, mobileResult1;
function phone1Blur() {
    var mobile = $("#phone1").val();
    if (mobile == "") {
        $('#phone1').removeClass().addClass("text");
        $("#phone1_error").hide();
        $('#phone1_succeed').removeClass();
        $("#rebind1").remove();
        $("#dmcode1").show();
        $("#mobileCodeDiv1").show();
        oldMobile1 = mobile;
        mobileFlag = false;
        return;
    }
    if (oldMobile1 == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult1(mobileResult1);
        return;
    }
    oldMobile1 = mobile;

    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $("#phone1_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone1_error").removeClass().addClass("error");
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        $("#phone1_error").show();
        $('#phone1').removeClass().addClass('text highlight2');
        $("#mobileCodeDiv1").show();
        $("#rebind1").remove();
        $("#dmcode1").show();
        mobileFlag = false;
        return;
    }
    $("#state").val("");
    $("#mobileCodeSucMessage1").removeClass().empty();
    $("#mobileCode1_error").removeClass().empty();
    $("#mobileCode1_error").hide();
    $('#mobileCode1').removeClass("highlight2");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {
        // mobileResult1 = result.success;
        // if (mobileResult1 != 2) {
        // if ($("#sendMobileCode1").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode1").removeAttr("disabled");
        // }
        $("#sendMobileCode1").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle1();
        }

        if (result.success == 1) {
            mobileEngagedStyle1();
        }

        if (result.success == 2) {
            mobileBindedStyle1(result.ub);
            // $("#sendMobileCode1").attr("disabled", "disabled");
        }
    });
}
function phone1Keyup() {
    var mobile = $("#phone1").val();
    var mobileLength=mobile.length;
    if(mobileLength != 11)
    {
    	return;
    }
    if (mobile == "") {
        $('#phone1').removeClass().addClass("text");
        $("#phone1_error").hide();
        $('#phone1_succeed').removeClass();
        $("#rebind1").remove();
        $("#dmcode1").show();
        $("#mobileCodeDiv1").show();
        oldMobile1 = mobile;
        mobileFlag = false;
        return;
    }
    if (oldMobile1 == mobile && mobile != "") {
        // 未修改手机号
        // showMobileCheckResult1(mobileResult1);
        return;
    }
    oldMobile1 = mobile;

    if (validateRules.isNull(mobile) || !validateRules.isMobile(mobile)) {
        $("#phone1_error").html("手机号码格式有误，请输入正确的手机号");
        $("#phone1_error").removeClass().addClass("error");
        $("#phone1_succeed").removeClass().addClass("blank error-ico");
        $("#phone1_error").show();
        $('#phone1').removeClass().addClass('text highlight2');
        $("#mobileCodeDiv1").show();
        $("#rebind1").remove();
        $("#dmcode1").show();
        mobileFlag = false;
        return;
    }
    $("#state").val("");
    $("#mobileCodeSucMessage1").removeClass().empty();
    $("#mobileCode1_error").removeClass().empty();
    $("#mobileCode1_error").hide();
    $('#mobileCode1').removeClass("highlight2");
    // 检测手机号码是否存在
    $.getJSON("../validateuser/isMobileEngaged?mobile=" + mobile + "&r=" + Math.random(),
    function(result) {
        // mobileResult1 = result.success;
        // if (mobileResult1 != 2) {
        // if ($("#sendMobileCode1").attr("disabled")) {
        // return;
        // }
        // $("#sendMobileCode1").removeAttr("disabled");
        // }
        $("#sendMobileCode1").removeAttr("disabled");
        if (result.success == 0) {
            mobileOkStyle1();
        }

        if (result.success == 1) {
            mobileEngagedStyle1();
        }

        if (result.success == 2) {
            mobileBindedStyle1(result.ub);
            // $("#sendMobileCode1").attr("disabled", "disabled");
        }
    });
}
// 次流程短信验证码获得焦点事件
function mobileCodeFocus() {
    $('#mobileCode').removeClass().addClass('text text-1 highlight1');
    $("#mobileCode_error").hide();
}
// 次流程短信验证码获得失去事件
function mobileCodeBlur() {
    $('#mobileCode').removeClass().addClass("text text-1");
    $("#mobileCode_error").hide();
}
// 次流程短信验证码获得焦点事件
function mobileCode1Focus() {
    $('#mobileCode1').removeClass().addClass('text text-1 highlight1');
    $("#mobileCode1_error").hide();
}
// 次流程短信验证码获得失去事件
function mobileCode1Blur() {
    $('#mobileCode1').removeClass().addClass("text text-1");
    $("#mobileCode1_error").hide();
    $('#mobileCode1_succeed').removeClass('error-ico');
}
// 解绑按钮事件
function unbind() {
    $("#state").val("unbind");
    $("#mobileCodeDiv").show();
    $("#rebind").remove();
    // sendmCode();
    sendMobileCode();
}
// 次流程解绑按钮事件
function unbind1() {
    $("#state").val("unbind");
    $("#mobileCodeDiv1").show();
    $("#rebind1").remove();
    sendMobileCode1();
}
// 用户协议
$(function() {
    $('#protocol').click(function() {
        jQuery.jdThickBox({
            type: "text",
            title: "京东用户注册协议",
            width: 922,
            height: 450,
            source: "<div class=\" regist-2013\">" + "<div class=\"regist-bor\">" + "<div class=\"mc\">" + "<div id=\"protocol-con\">" + " <h4>京东用户注册协议</h4>" +

            "    <p>" + "        本协议是您与京东网站（简称\"本站\"，网址：www.jd.com）所有者（以下简称为\"京东\"）之间就京东网站服务等相关事宜所订立的契约，请您仔细阅读本注册协议，您点击\"同意并继续\"按钮后，本协议即构成对双方有约束力的法律文件。</p>" + "    <h5> 第1条 本站服务条款的确认和接纳</h5>" +

            "    <p>" + "        <strong>1.1</strong>本站的各项电子服务的所有权和运作权归京东所有。用户同意所有注册协议条款并完成注册程序，才能成为本站的正式用户。用户确认：本协议条款是处理双方权利义务的契约，始终有效，法律另有强制性规定或双方另有特别约定的，依其规定。" + "    </p>" +

            "    <p>" + "        <strong>1.2</strong>用户点击同意本协议的，即视为用户确认自己具有享受本站服务、下单购物等相应的权利能力和行为能力，能够独立承担法律责任。</p>" +

            "    <p>" + "        <strong>1.3</strong>如果您在18周岁以下，您只能在父母或监护人的监护参与下才能使用本站。</p>" +

            "    <p>" + "        <strong>1.4</strong>京东保留在中华人民共和国大陆地区法施行之法律允许的范围内独自决定拒绝服务、关闭用户账户、清除或编辑内容或取消订单的权利。</p>" + "    <h5> 第2条 本站服务</h5>" +

            "    <p>" + "        <strong>2.1</strong>京东通过互联网依法为用户提供互联网信息等服务，用户在完全同意本协议及本站规定的情况下，方有权使用本站的相关服务。</p>" +

            "    <p>" + "        <strong>2.2</strong>用户必须自行准备如下设备和承担如下开支：（1）上网设备，包括并不限于电脑或者其他上网终端、调制解调器及其他必备的上网装置；（2）上网开支，包括并不限于网络接入费、上网设备租用费、手机流量费等。" + "    </p>" + "    <h5> 第3条 用户信息</h5>" +

            "    <p>" + "        <strong>3.1</strong>用户应自行诚信向本站提供注册资料，用户同意其提供的注册资料真实、准确、完整、合法有效，用户注册资料如有变动的，应及时更新其注册资料。如果用户提供的注册资料不合法、不真实、不准确、不详尽的，用户需承担因此引起的相应责任及后果，并且京东保留终止用户使用京东各项服务的权利。" + "    </p>" +

            "    <p>" + "        <strong>3.2</strong>用户在本站进行浏览、下单购物等活动时，涉及用户真实姓名/名称、通信地址、联系电话、电子邮箱等隐私信息的，本站将予以严格保密，除非得到用户的授权或法律另有规定，本站不会向外界披露用户隐私信息。" + "    </p>" +

            "    <p>" + "        <strong>3.3</strong>用户注册成功后，将产生用户名和密码等账户信息，您可以根据本站规定改变您的密码。用户应谨慎合理的保存、使用其用户名和密码。用户若发现任何非法使用用户账号或存在安全漏洞的情况，请立即通知本站并向公安机关报案。" + "    </p>" +

            "    <p>" + "        <strong>3.4</strong><strong>用户同意，京东拥有通过邮件、短信电话等形式，向在本站注册、购物用户、收货人发送订单信息、促销活动等告知信息的权利。</strong></p>" +

            "    <p>" + "        <strong>3.5</strong><strong>用户不得将在本站注册获得的账户借给他人使用，否则用户应承担由此产生的全部责任，并与实际使用人承担连带责任。</strong></p>" +

            "    <p>" + "        <strong>3.6</strong><strong>用户同意，京东有权使用用户的注册信息、用户名、密码等信息，登录进入用户的注册账户，进行证据保全，包括但不限于公证、见证等。</strong></p>" + "    <h5> 第4条 用户依法言行义务</h5>" +

            "    <p> 本协议依据国家相关法律法规规章制定，用户同意严格遵守以下义务：</p>" +

            "    <p>" + "        <strong>（1）</strong>不得传输或发表：煽动抗拒、破坏宪法和法律、行政法规实施的言论，煽动颠覆国家政权，推翻社会主义制度的言论，煽动分裂国家、破坏国家统一的的言论，煽动民族仇恨、民族歧视、破坏民族团结的言论；" + "    </p>" +

            "    <p>" + "        <strong>（2）</strong>从中国大陆向境外传输资料信息时必须符合中国有关法规；</p>" +

            "    <p>" + "        <strong>（3）</strong>不得利用本站从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动；" + "    </p>" +

            "    <p>" + "        <strong>（4）</strong>不得干扰本站的正常运转，不得侵入本站及国家计算机信息系统；</p>" +

            "    <p>" + "        <strong>（5）</strong>不得传输或发表任何违法犯罪的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的，淫秽的、不文明的等信息资料；</p>" +

            "    <p>" + "        <strong>（6）</strong>不得传输或发表损害国家社会公共利益和涉及国家安全的信息资料或言论；</p>" +

            "    <p>" + "        <strong>（7）</strong>不得教唆他人从事本条所禁止的行为；</p>" +

            "    <p>" + "        <strong>（8）</strong>不得利用在本站注册的账户进行牟利性经营活动；</p>" +

            "    <p>" + "        <strong>（9）</strong>不得发布任何侵犯他人著作权、商标权等知识产权或合法权利的内容；</p>" +

            "    <p>" + "        用户应不时关注并遵守本站不时公布或修改的各类合法规则规定。</p>" +

            "    <p>" + "        <strong>本站保有删除站内各类不符合法律政策或不真实的信息内容而无须通知用户的权利。</strong></p>" +

            "    <p>" + "        <strong>若用户未遵守以上规定的，本站有权作出独立判断并采取暂停或关闭用户帐号等措施。</strong>用户须对自己在网上的言论和行为承担法律责任。</p>" + "    <h5> 第5条 商品信息</h5>" +

            "    <p>" + "        本站上的商品价格、数量、是否有货等商品信息随时都有可能发生变动，本站不作特别通知。由于网站上商品信息的数量极其庞大，虽然本站会尽最大努力保证您所浏览商品信息的准确性，但由于众所周知的互联网技术因素等客观原因存在，本站网页显示的信息可能会有一定的滞后性或差错，对此情形您知悉并理解；京东欢迎纠错，并会视情况给予纠错者一定的奖励。</p>" +

            "    <p> 为表述便利，商品和服务简称为\"商品\"或\"货物\"。</p>" + "    <h5> 第6条 订单</h5>" +

            "    <p>" + "        <strong>6.1</strong>在您下订单时，请您仔细确认所购商品的名称、价格、数量、型号、规格、尺寸、联系地址、电话、收货人等信息。<span>收货人与用户本人不一致的，收货人的行为和意思表示视为用户的行为和意思表示，用户应对收货人的行为及意思表示的法律后果承担连带责任。</span>" + "    </p>" +

            "    <p>" + "        <strong>6.2</strong><strong>除法律另有强制性规定外，双方约定如下：本站上销售方展示的商品和价格等信息仅仅是交易信息的发布，您下单时须填写您希望购买的商品数量、价款及支付方式、收货人、联系方式、收货地址等内容；系统生成的订单信息是计算机信息系统根据您填写的内容自动生成的数据，仅是您向销售方发出的交易诉求；销售方收到您的订单信息后，只有在销售方将您在订单中订购的商品从仓库实际直接向您发出时（ 以商品出库为标志），方视为您与销售方之间就实际直接向您发出的商品建立了交易关系；如果您在一份订单里订购了多种商品并且销售方只给您发出了部分商品时，您与销售方之间仅就实际直接向您发出的商品建立了交易关系；只有在销售方实际直接向您发出了订单中订购的其他商品时，您和销售方之间就订单中该其他已实际直接向您发出的商品才成立交易关系。您可以随时登录您在本站注册的账户，查询您的订单状态。</strong>" + "    </p>" +

            "    <p>" + "        <strong>6.3</strong><strong>由于市场变化及各种以合理商业努力难以控制的因素的影响，本站无法保证您提交的订单信息中希望购买的商品都会有货；如您拟购买的商品，发生缺货，您有权取消订单。</strong>" + "    </p>" + "    <h5> 第7条 配送</h5>" +

            "    <p>" + "        <strong>7.1</strong>销售方将会把商品（货物）送到您所指定的收货地址，所有在本站上列出的送货时间为参考时间，参考时间的计算是根据库存状况、正常的处理过程和送货时间、送货地点的基础上估计得出的。</p>" + "" + "    <p>" + "        <strong>7.2</strong>因如下情况造成订单延迟或无法配送等，销售方不承担延迟配送的责任：</p>" +

            "    <p>" + "        <strong>（1）</strong>用户提供的信息错误、地址不详细等原因导致的；" + "    </p>" +

            "    <p>" + "        <strong>（2）</strong>货物送达后无人签收，导致无法配送或延迟配送的；</p>" +

            "    <p>" + "        <strong>（3）</strong>情势变更因素导致的；</p>" +

            "    <p>" + "        <strong>（4）</strong>不可抗力因素导致的，例如：自然灾害、交通戒严、突发战争等。</p>" + "    <h5> 第8条 所有权及知识产权条款</h5>" +

            "    <p>" + "        <strong>8.1</strong><strong>用户一旦接受本协议，即表明该用户主动将其在任何时间段在本站发表的任何形式的信息内容（包括但不限于客户评价、客户咨询、各类话题文章等信息内容）的财产性权利等任何可转让的权利，如著作权财产权（包括并不限于：复制权、发行权、出租权、展览权、表演权、放映权、广播权、信息网络传播权、摄制权、改编权、翻译权、汇编权以及应当由著作权人享有的其他可转让权利），全部独家且不可撤销地转让给京东所有，用户同意京东有权就任何主体侵权而单独提起诉讼。</strong>" + "    </p>" +

            "    <p>" + "        <strong>8.2</strong><strong>本协议已经构成《中华人民共和国著作权法》第二十五条（条文序号依照2011年版著作权法确定）及相关法律规定的著作财产权等权利转让书面协议，其效力及于用户在京东网站上发布的任何受著作权法保护的作品内容，无论该等内容形成于本协议订立前还是本协议订立后。</strong>" + "    </p>" +

            "    <p>" + "        <strong>8.3</strong><strong>用户同意并已充分了解本协议的条款，承诺不将已发表于本站的信息，以任何形式发布或授权其它主体以任何方式使用（包括但不限于在各类网站、媒体上使用）。</strong></p>" +

            "    <p>" + "        <strong>8.4</strong><strong>京东是本站的制作者,拥有此网站内容及资源的著作权等合法权利,受国家法律保护,有权不时地对本协议及本站的内容进行修改，并在本站张贴，无须另行通知用户。在法律允许的最大限度范围内，京东对本协议及本站内容拥有解释权。</strong>" + "    </p>" +

            "    <p>" + "        <strong>8.5</strong><strong>除法律另有强制性规定外，未经京东明确的特别书面许可,任何单位或个人不得以任何方式非法地全部或部分复制、转载、引用、链接、抓取或以其他方式使用本站的信息内容，否则，京东有权追究其法律责任。</strong>" + "    </p>" + "    <p>" + "        <strong>8.6</strong>本站所刊登的资料信息（诸如文字、图表、标识、按钮图标、图像、声音文件片段、数字下载、数据编辑和软件），均是京东或其内容提供者的财产，受中国和国际版权法的保护。本站上所有内容的汇编是京东的排他财产，受中国和国际版权法的保护。本站上所有软件都是京东或其关联公司或其软件供应商的财产，受中国和国际版权法的保护。" + "    </p>" + "    <h5> 第9条 责任限制及不承诺担保</h5>" + "    <p>" + "        <strong>除非另有明确的书面说明,本站及其所包含的或以其它方式通过本站提供给您的全部信息、内容、材料、产品（包括软件）和服务，均是在\"按现状\"和\"按现有\"的基础上提供的。</strong></p>" +

            "    <p>" + "        <strong>除非另有明确的书面说明,京东不对本站的运营及其包含在本网站上的信息、内容、材料、产品（包括软件）或服务作任何形式的、明示或默示的声明或担保（根据中华人民共和国法律另有规定的以外）。</strong>" + "    </p>" + "    <p>" + "        <strong>京东不担保本站所包含的或以其它方式通过本站提供给您的全部信息、内容、材料、产品（包括软件）和服务、其服务器或从本站发出的电子信件、信息没有病毒或其他有害成分。</strong></p>" + "    <p>" + "        <strong>如因不可抗力或其它本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，京东会合理地尽力协助处理善后事宜。</strong></p>" + "    <h5> 第10条 协议更新及用户关注义务</h5>" + "    根据国家法律法规变化及网站运营需要，京东有权对本协议条款不时地进行修改，修改后的协议一旦被张贴在本站上即生效，并代替原来的协议。用户可随时登录查阅最新协议；<strong><em>用户有义务不时关注并阅读最新版的协议及网站公告。如用户不同意更新后的协议，可以且应立即停止接受京东网站依据本协议提供的服务；如用户继续使用本网站提供的服务的，即视为同意更新后的协议。京东建议您在使用本站之前阅读本协议及本站的公告。</em></strong>" + "    如果本协议中任何一条被视为废止、无效或因任何理由不可执行，该条应视为可分的且并不影响任何其余条款的有效性和可执行性。" + "    <h5> 第11条 法律管辖和适用</h5>" + "    本协议的订立、执行和解释及争议的解决均应适用在中华人民共和国大陆地区适用之有效法律（但不包括其冲突法规则）。 如发生本协议与适用之法律相抵触时，则这些条款将完全按法律规定重新解释，而其它有效条款继续有效。" + "    如缔约方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向有管辖权的中华人民共和国大陆地区法院提起诉讼。" + "    <h5> 第12条 其他 </h5>" + "    <p>" + "        <strong>12.1</strong>京东网站所有者是指在政府部门依法许可或备案的京东网站经营主体。</p>" +

            "    <p>" + "        <strong>12.2</strong>京东尊重用户和消费者的合法权利，本协议及本网站上发布的各类规则、声明等其他内容，均是为了更好的、更加便利的为用户和消费者提供服务。本站欢迎用户和社会各界提出意见和建议，京东将虚心接受并适时修改本协议及本站上的各类规则。" + "    </p>" +

            "    <p>" + "        <strong>12.3</strong><span>本协议内容中以黑体、加粗、下划线、斜体等方式显著标识的条款，请用户着重阅读。</span></p>" + "    <p>" + "        <strong>12.4</strong><span>您点击本协议下方的\"同意并继续\"按钮即视为您完全接受本协议，在点击之前请您再次确认已知悉并完全理解本协议的全部内容。</span></p>" + "</div>" + "      <div class=\"btnt\">" + "         <input  class=\"btn-img\"  type=\''button\" value='同意并继续' onclick='protocolReg();'/>" + "     </div>" + "</div>" + "</div>" + "</div>",
            _autoReposi: true
        });
    });
});