
function go(url){
    window.location = url;
}
/**
 * 格式化数字
 * @param num 数字
 * @param ext 保留多少位小数
 * @returns {*}
 */
function number_format(num, ext){
    if(ext < 0){
        return num;
    }
    num = Number(num);
    if(isNaN(num)){
        num = 0;
    }
    var _str = num.toString();
    var _arr = _str.split('.');
    var _int = _arr[0];
    var _flt = _arr[1];
    if(_str.indexOf('.') == -1){
        /* 找不到小数点，则添加 */
        if(ext == 0){
            return _str;
        }
        var _tmp = '';
        for(var i = 0; i < ext; i++){
            _tmp += '0';
        }
        _str = _str + '.' + _tmp;
    }else{
        if(_flt.length == ext){
            return _str;
        }
        /* 找得到小数点，则截取 */
        if(_flt.length > ext){
            _str = _str.substr(0, _str.length - (_flt.length - ext));
            if(ext == 0){
                _str = _int;
            }
        }else{
            for(var i = 0; i < ext - _flt.length; i++){
                _str += '0';
            }
        }
    }

    return _str;
}
/**
 * 设置用户输入数字合法性
 * @param name 表单name
 * @param min 范围最小值
 * @param max 范围最大值
 * @param keep 保留多少位小数 可不填
 * @param def   不在范围返回的默认值 可不填
 */
function checkInputNum(name,min,max,keep,def){
    var input = $('input[name='+name+']');
    var inputVal = parseInt(input.val());
    var a = parseInt(arguments[3]) ? parseInt(arguments[3]) : 0;//设置第四个参数的默认值
    var b = parseInt(arguments[4]) ? parseInt(arguments[4]) : '';//设置第四个参数的默认值
    if(isNaN(inputVal)){
        input.val('');
    }else{
        if(inputVal < min || inputVal > max){
            if(a > 0){
                input.val(number_format(b,a));
            }else{
                input.val(b);
            }
        }else{
            if(a > 0){
                input.val(number_format(inputVal, a));
            }else{
                input.val(inputVal);
            }
        }
    }
}

//图片垂直水平缩放裁切显示
(function($){
    $.fn.VMiddleImg = function(options) {
        var defaults={
            "width":null,
"height":null
        };
        var opts = $.extend({},defaults,options);
        return $(this).each(function() {
            var $this = $(this);
            var objHeight = $this.height(); //图片高度
            var objWidth = $this.width(); //图片宽度
            var parentHeight = opts.height||$this.parent().height(); //图片父容器高度
            var parentWidth = opts.width||$this.parent().width(); //图片父容器宽度
            var ratio = objHeight / objWidth;
            if (objHeight > parentHeight && objWidth > parentWidth) {
                if (objHeight > objWidth) { //赋值宽高
                    $this.width(parentWidth);
                    $this.height(parentWidth * ratio);
                } else {
                    $this.height(parentHeight);
                    $this.width(parentHeight / ratio);
                }
                objHeight = $this.height(); //重新获取宽高
                objWidth = $this.width();
                if (objHeight > objWidth) {
                    $this.css("top", (parentHeight - objHeight) / 2);
                    //定义top属性
                } else {
                    //定义left属性
                    $this.css("left", (parentWidth - objWidth) / 2);
                }
            }
            else {
                if (objWidth > parentWidth) {
                    $this.css("left", (parentWidth - objWidth) / 2);
                }
                $this.css("top", (parentHeight - objHeight) / 2);
            }
        });
    };
})(jQuery);

function trim(str) {
    return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

/* 显示Ajax表单 */
function ajax_form(id, title, url, width, model)
{
    if (!width)	width = 480;
    if (!model) model = 1;
    var d = DialogManager.create(id);
    d.setTitle(title);
    d.setContents('ajax', url);
    d.setWidth(width);
    d.show('center',model);
    return d;
}
//显示一个内容为自定义HTML内容的消息
function html_form(id, title, _html, width, model) {
    if (!width)	width = 480;
    if (!model) model = 0;
    var d = DialogManager.create(id);
    d.setTitle(title);
    d.setContents(_html);
    d.setWidth(width);
    d.show('center',model);
    return d;
}


/*
 * 为低版本IE添加placeholder效果
 *
 * 使用范例：
 * [html]
 * <input id="captcha" name="captcha" type="text" placeholder="验证码" value="" >
 * [javascrpt]
 * $("#captcha").nc_placeholder();
 *
 * 生效后提交表单时，placeholder的内容会被提交到服务器，提交前需要把值清空
 * 范例：
 * $('[data-placeholder="placeholder"]').val("");
 * $("#form").submit();
 *
 */
(function($) {
    $.fn.nc_placeholder = function() {
        var isPlaceholder = 'placeholder' in document.createElement('input');
        return this.each(function() {
            if(!isPlaceholder) {
                $el = $(this);
                $el.focus(function() {
                    if($el.attr("placeholder") === $el.val()) {
                        $el.val("");
                        $el.attr("data-placeholder", "");
                    }
                }).blur(function() {
                    if($el.val() === "") {
                        $el.val($el.attr("placeholder"));
                        $el.attr("data-placeholder", "placeholder");
                    }
                }).blur();
            }
        });
    };
})(jQuery);

/*
 * 弹出窗口
 */
(function($) {
    $.fn.nc_show_dialog = function(options) {

        var that = $(this);
        var settings = $.extend({}, {width: 480, title: '', close_callback: function() {}}, options);

        var init_dialog = function(title) {
            var _div = that;
            that.addClass("dialog_wrapper");
            that.wrapInner(function(){
                return '<div class="dialog_content">';
            });
            that.wrapInner(function(){
                return '<div class="dialog_body" style="position: relative;">';
            });
            that.find('.dialog_body').prepend('<h3 class="dialog_head" style="cursor: move;"><span class="dialog_title"><span class="dialog_title_icon">'+settings.title+'</span></span><span class="dialog_close_button">X</span></h3>');
            that.append('<div style="clear:both;"></div>');

            $(".dialog_close_button").click(function(){
                settings.close_callback();
                _div.hide();
            });

            that.draggable({handle: ".dialog_head"});
        };

        if(!$(this).hasClass("dialog_wrapper")) {
            init_dialog(settings.title);
        }
        settings.left = $(window).scrollLeft() + ($(window).width() - settings.width) / 2;
        settings.top  = ($(window).height() - $(this).height()) / 2;
        $(this).attr("style","display:none; z-index: 1100; position: fixed; width: "+settings.width+"px; left: "+settings.left+"px; top: "+settings.top+"px;");
        $(this).show();

    };
})(jQuery);

/**
 * Membership card
 *
 *
 * Example:
 *
 * HTML part
 * <a href="javascript" nctype="mcard" data-param="{'id':5}"></a>
 *
 * JAVASCRIPT part
 * <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.js"></script>
 * <link href="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
 * $('a[nctype="mcard"]').membershipCard();
 */
(function($){
	$.fn.membershipCard = function(options){
		var defaults = {
				type:''			// params  shop/circle/cms/micorshop
			};
		options = $.extend(defaults,options);
		return this.each(function(){
			var $this = $(this);
			var data_str = $(this).attr('data-param');eval('data_str = '+data_str);
			var _uri = SITEURL+'/index.php?act=member_card&callback=?&uid='+data_str.id+'&from='+options.type;
			var _dl = '';
			$this.qtip({
	            content: {
	                text: 'Loading...',
	                ajax: {
	                    url: _uri,
		                type: 'GET',
		                dataType: 'jsonp',
		                success: function(data) {
		                	if(data){
		                		_dl = $('<dl></dl>');
		                		// member name
		                		_dttmp = $('<dt class="member-id"></dt>');
		                		_dttmp.append('<i class="sex'+data.sex+'"></i>')
	                			.append('<a href="'+SHOP_SITE_URL+'/index.php?act=member_snshome&mid='+data.id+'" target="_blank">'+data.name+'</a>'+(data.truename != ''?'('+data.truename+')':''));
		                		//show membergrade
		                		if(options.type == 'shop'){
		                			_dttmp.append(((data.level_name)?'&nbsp;<div class="nc-grade-mini">'+data.level_name+'</div>':''));
		                		}
		                		_dttmp.appendTo(_dl);
		                		
		                		// avatar
		                		$('<dd class="avatar"><a href="'+SHOP_SITE_URL+'/index.php?act=member_snshome&mid='+data.id+'" target="_blank"><img src="'+data.avatar+'" /></a><dd>')
		                			.appendTo(_dl);
		                		// info
		                		var _info = '';
		                		if(typeof connect !== 'undefined' && connect === 1 && data.follow != 2){
		                			var class_html = 'chat_offline';
		                			var text_html = '离线';
		                			if (typeof user_list[data.id] !== 'undefined' && user_list[data.id]['online'] > 0 ) {
		                				class_html = 'chat_online';
		                				text_html = '在线';
		                			}
		                			_info += '<a class="chat '+class_html+'" title="点击这里给我发消息" href="JavaScript:chat('+data.id+');">'+text_html+'</a>';
		                		}
		                		if(data.qq != ''){
		                			_info += '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+data.qq+'&site=qq&menu=yes" title="QQ: '+data.qq+'"><img border="0" src="http://wpa.qq.com/pa?p=2:'+data.qq+':52" style=" vertical-align: middle;"/></a>';
		                		}
		                		if(data.ww != ''){
		                			_info += '<a target="_blank" href="http://amos.im.alisoft.com/msg.aw?v=2&amp;uid='+data.ww+'&site=cntaobao&s=1&charset='+_CHARSET+'" ><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid='+data.ww+'&site=cntaobao&s=2&charset='+_CHARSET+'" alt="点击这里给我发消息" style=" vertical-align: middle;"/></a>';
		                		}
		                		if(_info == ''){
		                			_info = '--';
		                		}
		                		var _ul = $('<ul></ul>').append('<li>城市：'+((data.areainfo != null)?data.areainfo:'--')+'</li>')
		                			.append('<li>生日：'+((data.birthday != null)?data.birthday:'--')+'</li>')
		                			.append('<li>联系：'+_info+'</li>').appendTo('<dd class="info"></dd>').parent().appendTo(_dl);
		                		// ajax info
		                		if(data.url != ''){
			                		$.getJSON(data.url+'/index.php?act=member_card&op=mcard_info&uid='+data.id, function(d){
			                			if(d){
			                				eval('var msg = '+options.type+'_function(d);');
			                				msg.appendTo(_dl);
			                			}
			                		});
			                		data.url = '';
			                	}

		                		// bottom
		                		var _bottom;
		                		if(data.follow != 2){
			                		_bottom = $('<div class="bottom"></div>');
		                			var _a;
		                			if(data.follow == 1){
		                				$('<div class="follow-handle" nctype="follow-handle'+data.id+'" data-param="{\'mid\':'+data.id+'}"></div>')
		                					.append('<a href="javascript:void(0);" >已关注</a>')
		                					.append('<a href="javascript:void(0);" nctype="nofollow">取消关注</a>').find('a[nctype="nofollow"]').click(function(){
		                						onfollow($(this));
		                					}).end().appendTo(_bottom);
		                			}else{
		                				$('<div class="follow-handle" nctype="follow-handle'+data.id+'" data-param="{\'mid\':'+data.id+'}"></div>')
		                					.append('<a href="javascript:void(0);" nctype="follow">加关注</a>').find('a[nctype="follow"]').click(function(){
		                						follow($(this));
		                					}).end().appendTo(_bottom);
		                			}
		                			$('<div class="send-msg"> <a href="'+MEMBER_SITE_URL+'/index.php?act=member_message&op=sendmsg&member_id='+data.id+'" target="_blank"><i></i>站内信</a> </div>').appendTo(_bottom);
		                		}

		                		var _content = $('<div class="member-card"></div>').append(_dl).append(_bottom);
			                    this.set('content.text', ' ');this.set('content.text', _content);
		                	}
		                }
	                }
	            },
	            position: {
	                viewport: $(window)
	            },
	            hide: {
					fixed: true,
					delay: 300
				},
	            style: 'qtip-wiki'
	         });
		});
		function follow(o){
			var data_str = o.parent().attr('data-param');
			eval( "data_str = "+data_str);
			$.getJSON(MEMBER_SITE_URL+'/index.php?act=member_snsfriend&op=addfollow&callback=?&mid='+data_str.mid, function(data){
				if(data){
					$('[nctype="follow-handle'+data_str.mid+'"]').html('<a href="javascript:void(0);" >已关注</a> <a href="javascript:void(0);" nctype="nofollow">取消关注</a>').find('a[nctype="nofollow"]').click(function(){
						onfollow($(this));
					});
				}
			});
		}
		function onfollow(o){
			var data_str = o.parent().attr('data-param');
			eval( "data_str = "+data_str);
			$.getJSON(MEMBER_SITE_URL+'/index.php?act=member_snsfriend&op=delfollow&callback=?&mid='+data_str.mid, function(data){
				if(data){
					$('[nctype="follow-handle'+data_str.mid+'"]').html('<a href="javascript:void(0);" nctype="follow">加关注</a>').find('a[nctype="follow"]').click(function(){
						follow($(this));
					});
				}
			});
		}
		function shop_function(d){
			return ;
		}
		function circle_function(d){
			var rs = $('<dd class="ajax-info"></dd>');
			$.each(d,function(i, n){
				rs.append('<div class="rank-div" title="'+n.circle_name+'圈等级'+n.cm_level+'，经验值'+n.cm_exp+'"><a href="'+CIRCLE_SITE_URL+'/index.php?act=group&c_id='+n.circle_id+'" target="_blank">'+n.circle_name+'</a><i></i><em class="rank-em rank-'+n.cm_level+'">'+n.cm_level+'</em></div>');
			});
			return rs;
		}
		function microshop_function(d){
			var rs = $('<dd class="ajax-info"></dd>');
            rs.append('<span class="ajax-info-microshop">随心看：' + d.goods_count + '</span>');
            rs.append('<span class="ajax-info-microshop">个人秀：' + d.personal_count + '</span>');
			return rs;
		}
	};
})(jQuery);


function setCookie(name,value,days){
        var exp=new Date();
        exp.setTime(exp.getTime() + days*24*60*60*1000);
        var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        document.cookie=name+"="+escape(value)+";expires="+exp.toGMTString() +"path=/";
}
function getCookie(name){
        var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
        if(arr!=null){
                return unescape(arr[2]);
                return null;
        }
}
function delCookie(name){
        var exp=new Date();
        exp.setTime(exp.getTime()-1);
        var cval=getCookie(name);
        if(cval!=null){
                document.cookie=name+"="+cval+";expires="+exp.toGMTString() +"path=/";
        }
}

$(function(){
	$.getUrlParam = function(name){
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if (r!=null) return unescape(r[2]); return null;}
	var act = $.getUrlParam('act');
	if (act == "store_list"){
		$('#search ul.tab li span').eq(0).html('店铺');
		$('#search ul.tab li span').eq(1).html('商品');
		$('#search ul.tab li').eq(0).attr('act','store_list');
		$('#search_act').attr("value","store_list");
		}
	$('#search').hover(function(){
		$('#search ul.tab li').eq(1).show();
		$('#search ul.tab li i').addClass('over').removeClass('arrow');
	},function(){
		$('#search ul.tab li').eq(1).hide();
		$('#search ul.tab li i').addClass('arrow').removeClass('over');
	});
	$('#search ul.tab li').eq(1).click(function(){
		$(this).hide();
		if($(this).find('span').html() == '店铺') {
			$('#keyword').attr("placeholder","请输入您要搜索的店铺关键字");
			$('#search ul.tab li span').eq(0).html('店铺');
			$('#search ul.tab li span').eq(1).html('商品');
			$('#search_act').attr("value",'store_list');
		} else {
			$('#keyword').attr('placeholder','请输入您要搜索的商品关键字');
			$('#search ul.tab li span').eq(0).html('商品');
			$('#search ul.tab li span').eq(1).html('店铺');
			$('#search_act').attr("value",'search');
		}
		$("#keyword").focus();
	});
});