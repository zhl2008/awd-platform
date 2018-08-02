/**
 * 1084	1041
 * 所用到的值都放在a元素中，data形式
 * 
 *	实体参考:
 *	var menu = new Object();
 *	menu.menu_id = 0;
 *	menu.menu_name = DEFAULT_MENU_NAME;
 *	menu.pid = 0;
 *	menu.menu_event_type = 1;
 *	menu.menu_event_url = "";
 *	menu.media_id = 0;
 *	menu.sort = currentIndex;
 */

var MAX_MENU_LENGTH = 3;//一级菜单数量
var MAX_SUB_MENU_LENGTH = 5;//二级菜单数量

var DEFAULT_MENU_NAME = "菜单名称";//默认以及菜单名称（4个汉字，8个字母）
var DEFAULT_SUB_MENU_NAME = "子菜单名称";//默认二级菜单名称（字数不超过8个汉字或16个字母）

var DEFAULT_MENU_TIP = "字数不超过4个汉字或8个字母";//一级菜单名称验证提示
var DEFAULT_SUB_MENU_TIP = "字数不超过8个汉字或16个字母";//二级菜单名称验证提示

var IS_OK = true;//是否可以保存，验证菜单名称和网址输入是否正确

$(function() {

	/**
	 * “你尚未添加任何菜单”
	 * 初次添加微信自定义菜单按钮
	 * 2017年3月31日 10:46:41
	 */
	$(".js_openMenu").click(function() {
		
		$(".js_startMenuBox").hide();//隐藏初始化界面（“你尚未添加任何菜单”）
		$(".js_editBox").show();//编辑菜单窗口显示
		$("#js_rightBox").hide();//第一次还没有菜单，需要隐藏右侧编辑信息
		$("#menuList").addClass("no_menu");//第一次加载，显示“+添加菜单”
		
	});

	/**
	 * 一级菜单添加
	 * 1、每次添加都会有默认值，并且选中当前添加的一级菜单
	 * 2、根据菜单数量动态调整宽度
	 * 3、手机预览对应的也要进行变化
	 * 4、一个菜单以上菜单排序可用
	 * 5、显示底部保存按钮
	 * 2017年3月31日 11:09:36
	 */
	$(".js-addMenuBtn").live("click",function() {

		//删除操作后会显示这个，点击一级菜单添加按钮要隐藏这个“点击左侧菜单进行编辑操作”
		$("#js_none").hide();

		$(".jsMenu").parent().removeClass("current");
		$(".jsSubMenuInner").removeClass("current");
		
		// 没有菜单的情况
		if($("#menuList").hasClass("no_menu")){
			$("#menuList").removeClass("no_menu");
		}
		
		// 没有菜单的情况下，右侧默认是隐藏，显示右侧编辑菜单，只执行一次
		if($("#js_rightBox").is(":hidden")){
			$("#js_rightBox").show();
			$(".js_editBtn").css("visibility","visible");//底部保存按钮
			$(".sort_btn_wrp").show();//显示排序按钮
		}
		
		var menuList = $("#menuList li a[class*='jsMenu']");//菜单集合
		var menuLength = menuList.length;
		var currClassIndex = menuList.length+2;//开始样式为2，【 2 3】，当前样式索引位置，从2开始，索引需要加2
		var classCurrent = "current";//一级菜单选择样式
		var currentIndex = 0;//当前菜单索引位置
		
		//菜单个数大于1个才能进行排序（下边会进行添加）
		if(menuLength>0){
			$("#orderBt").removeClass("dn");
			$("#orderDis").addClass("dn");
		}
		
		//不能用超过菜单数量的样式（例如：当前菜单数量为3，不能用3以后的样式【4、5、6】）
		if(currClassIndex > MAX_MENU_LENGTH){
			currClassIndex = MAX_MENU_LENGTH;
			currentIndex = currClassIndex;
		}else{
			currentIndex = currClassIndex -1;
		}
		
		//清除选中样式，设置宽度
		if(menuList.parent().hasClass("size1of"+currentIndex)){
			menuList.parent().removeClass("size1of"+currentIndex);
			menuList.parent().removeClass(classCurrent);
			menuList.parent().addClass("size1of"+currClassIndex);
			$("div[data-submenulist]").hide();
		}
		
		var html = "";//菜单
		html += '<li class="pre_menu_item size1of'+currClassIndex+' '+classCurrent+'" data-menu-index="'+currentIndex+'">';
		html += '<a href="javascript:void(0);" ondragstart="return false" class="pre_menu_link jsMenu" data-menuid="-1" data-pid="0" data-menu-eventurl="" data-menu-type="1" data-detault-menu-type="1" data-mediaid="0" data-sort="'+currentIndex+'">';
		html += '<span>' + DEFAULT_MENU_NAME + '</span></a>';
		html += '<div class="sub_pre_menu_box" data-subMenuList="'+currentIndex+'">';
		html += '<ul class="sub_pre_menu_list">';
		html += '<li class="jsSubMenu" data-pid="0" data-subIndex="'+currentIndex+'">';
		html += '<a href="javascript:void(0);" title="最多添加'+MAX_SUB_MENU_LENGTH+'个子菜单">';
		html += '<span class="sub_pre_menu_inner">';
		html += '<i class="icon14_menu_add" style="background-position: 0 0;"></i></span></a></li>';
		html += '</ul><i class="arrow arrow_out"></i> <i class="arrow arrow_in" ></i></div>';
		html += '</li>';
		
		//在“加号”按钮前添加菜单代码
		$(this).before(html);
		
		//限制一级菜单添加
		if($("#menuList li a[class*='jsMenu']").length == MAX_MENU_LENGTH){
			$(this).hide();
		}
		
		//更新“+”号按钮样式
		$(this).removeClass("size1of"+currentIndex);
		$(this).addClass("size1of"+currClassIndex);
		$(this).find("span").remove();//删除新增按钮 文本【第一次出现的】

		//手机预览
		var index = $("#viewList>li").length;
		$("#viewList>li").removeClass("size1of"+index);
		$("#viewList>li").addClass("size1of"+currClassIndex);
		
		var mobileHtml = "";//手机预览
		mobileHtml += '<li class="pre_menu_item grid_item size1of'+currentIndex+'" data-mobile-menu-index="'+currClassIndex+'">';
		mobileHtml += '<a href="javascript:void(0);" class="jsView pre_menu_link" title="' +DEFAULT_MENU_NAME+ '">';
		mobileHtml += DEFAULT_MENU_NAME+ '</a>';
		mobileHtml += '<div class="sub_pre_menu_box jsSubViewDiv" data-subIndex="'+currentIndex+'" style="display: none">';
		mobileHtml += '<ul class="sub_pre_menu_list"></ul>';
		mobileHtml += '<i class="arrow arrow_out"></i><i class="arrow arrow_in"></i></div></li>';
		$("#viewList").append(mobileHtml);
		
		$("#urltext").val("");//每次添加都清空链接
		//第一次添加菜单都是默认值
		var menu = new Object();
		menu.menu_id = 0;
		menu.menu_name = DEFAULT_MENU_NAME;
		menu.pid = 0;
		menu.media_id = 0;
		menu.menu_event_type = 1;//默认是跳转链接
		menu.menu_event_url = "";
		menu.sort = currentIndex;

		addWeixinMenu(menu);//传入当前对象，更新添加后的菜单数据
		
	});
	

	/**
	 * 二级菜单
	 */
	$(".jsSubMenu").live("click",function(){
	
		var index = $(this).attr("data-subIndex");//当前
		$(".jsMenu").parent().removeClass("current");
		$(".jsSubMenuInner").removeClass("current");
		var sort = $(this).parent().find("li").length;
		var html = '<li class="current jsSubMenuInner"><a href="javascript:void(0);" data-pid="'+$(this).attr("data-pid")+'" data-menuid="-1" data-mediaid="0" data-menu-eventurl="" data-menu-type="1" data-detault-menu-type="1" data-sort="'+sort+'">';
		html += '<span class="sub_pre_menu_inner">';
		html += DEFAULT_SUB_MENU_NAME+'</span></a></li>';
		$(this).before(html);

		//有二级菜单，一级菜单则要添加一个小图标，标识有二级菜单列表
		if($("li[data-menu-index='"+index+"']>a").find("i").html() == undefined){
			$("li[data-menu-index='"+index+"']>a").find("span").before('<i class="icon_menu_dot js_icon_menu_dot dn"></i>');
		}
		
		//等于最大菜单长度隐藏 “+”
		if(($("div[data-subMenuList="+index+"] ul li").length-1) == MAX_SUB_MENU_LENGTH){
			$(this).hide();
		}
		
		//手机预览
		var mobileHtml = '<li><a href="javascript:void(0);" data-pid="'+$(this).attr("data-pid")+'" data-menuid="-1" class="jsSubView" title="'+DEFAULT_SUB_MENU_NAME+'">'+DEFAULT_SUB_MENU_NAME+'</a></li>';
		var mobileObj = $("li[data-mobile-menu-index='"+index+"'] div ul");
		mobileObj.append(mobileHtml);
		if(!mobileObj.parent().prev().find("i").length){
			mobileObj.parent().prev().prepend('<i class="icon_menu_dot"></i>');
		}

		$("#urltext").val("");//每次添加都清空链接
		//第一次添加都是默认值
		var menu = new Object();
		menu.menu_id = 0;
		menu.media_id = 0;
		menu.menu_name = DEFAULT_SUB_MENU_NAME;
		menu.pid = $(this).attr("data-pid");
		menu.menu_event_type = 1;
		menu.menu_event_url = "";
		menu.sort = sort;
		addWeixinMenu(menu);
		
	});
	
	/**
	 * 记录当前的值，用于判断是否发生过变化
	 */
	$("#urltext,#menuname").click(function(){
		if($(this).attr("data-flag") == 1){
			$(this).attr("data-default-value",$(this).val());
		}
		if($(this).attr("data-flag") == undefined ){
			$(this).attr("data-flag",1); 
		}
	});
	
	// 修改菜单名称
	$("#menuname").blur(function(){
		if(parseInt($(this).attr("data-flag")) == 1){
			var obj = getCurrentMenu();
			var isUpdate = true;//是否更新
			//没有变化，则做不修改操作
			if(obj.find("span").text() == $(this).val()){
				isUpdate = false;
			}
			if(isUpdate){
				updateWeixinMenuName(obj.attr("data-menuid"), $(this).val());
			}
		}
	});
	
	// 修改网址
	$("#urltext").blur(function(){
		if(parseInt($(this).attr("data-flag")) == 1 &&$("#urltext").val().length > 0){
			var obj = getCurrentMenu();
			var isUpdate = true;//是否更新
			//没有变化，则做不修改操作
			if(obj.attr("data-menu-eventurl") == $(this).val()){
				isUpdate = false;
			}
			if(isUpdate){
				updateWeixinMenuUrl(obj.attr("data-menuid"),$(this).val());
			}
		}
	});
	
	/**
	 * 点击一级菜单弹出二级菜单
	 * 隐藏其他二级菜单，显示当前点击的二级菜单
	 * 对应右侧的菜单编辑赋值
	 * 已添加子菜单，仅可设置菜单名称。
	 */
	$(".jsMenu").live("click",function(){
		menuClick(this);
	});
	
	/**
	 * 选择二级菜单
	 */
	$(".jsSubMenuInner").live("click",function(){
		subMenuClick(this);
	});
	
	/**
	 * 菜单名称验证
	 * 2017年3月16日 10:02:05
	 */
	$("#menuname").keyup(function(){
		var val = $(this).val();
		var flag = testMenu($(this).val(),"menu");
		if($(".js_titleNolTips").attr("data-selected") == "submenu"){
			flag = testMenu($(this).val(),"sub_menu");
		}
		if(!flag && val){
            $(".js_titleEorTips").text("字数超过上限");
			$(".js_titleEorTips").fadeIn(500);
			$(".js_titleEorTips").removeClass("dn");
			$(this).attr("data-flag","-1");//错误
			IS_OK = false;
		}else if(!flag && !val) {
            $(".js_titleEorTips").text("请输入菜单名称");
            $(".js_titleEorTips").fadeIn(500);
            $(".js_titleEorTips").removeClass("dn");
            $(this).attr("data-flag","-1");//错误
            IS_OK = false;
        }else{
			$(".js_titleEorTips").fadeOut(500);
			$(".js_titleEorTips").addClass("dn");
			$(this).attr("data-flag","1");//正确
			IS_OK = true;
		}
	});
	
	/**
	 * 排序
	 */
	$("#orderBt").click(function(){
		var arr = new Array();
		$('#menuList>li[data-menu-index]').each(function(){
			arr.push($(this).find("a").attr("data-menuid"));
		})
		$("#hidden_default_sort").val(arr);//记录默认排序
		$(this).addClass("dn");
		$("#finishBt").removeClass("dn");//显示完成按钮
		$("#js_none").show();//请通过拖拽左边的菜单进行排序
		$("#js_rightBox").hide();//右侧编辑
		$(".js_editBtn").css("visibility","hidden");//底部保存按钮
		// 隐藏“+”号，并改变长度
		$(".js-addMenuBtn").hide();
		$("#menuList>li").removeClass("size1of"+$("#menuList>li").length);
		$("#menuList>li").addClass("size1of"+($("#menuList>li").length-1));
		$('#menuList>li').arrangeable();
		
		// 隐藏子菜单“+”号
		$(".sub_pre_menu_list li").arrangeable();
		$(".sub_pre_menu_list li[class='jsSubMenu']").hide();
		setSubMenuDisplay();
	});
	
	/**
	 * 没有子菜单，隐藏
	 */
	function setSubMenuDisplay(){
		var obj = $("#menuList li[class*='current'] .sub_pre_menu_list");
		if(obj.find("li[class*='jsSubMenuInner']").length == 0){
			obj.parent().hide();
		}
	}
	
	/**
	 * 完成排序
	 */
	$("#finishBt").click(function(){
		$(this).addClass("dn");
		$("#orderBt").removeClass("dn");//显示完成按钮
		$("#js_none").hide();//请通过拖拽左边的菜单进行排序
		$("#js_rightBox").show();//右侧编辑
		$(".js_editBtn").css("visibility","visible");//底部保存按钮
		$('#menuList>li').arrangeable("destroy");
		$(".sub_pre_menu_list li").arrangeable("destroy");
		var menu_id_arr = new Array();//一级菜单
		var sub_menu_id_arr = new Array();//二级菜单
		var tempCount = 0;
		var tempCountSub = 0;
		$('#menuList>li[data-menu-index]').each(function(){
			if(!$(this).hasClass("js-addMenuBtn")){
				tempCount++;
				menu_id_arr.push($(this).find("a").attr("data-menuid"));
				$(this).attr("data-menu-index",tempCount)
				$(this).find("a:eq(0)").attr("data-sort",tempCount);
			}
		})
		
		//二级菜单
		$("#menuList>li[class*='current'] .sub_pre_menu_list li[class*='jsSubMenuInner']").each(function(){
			tempCountSub++;
			var obj = $(this).find("a");
			obj.attr("data-sort",tempCountSub);
			sub_menu_id_arr.push(obj.attr("data-menuid"));
		})
		var default_arr = $("#hidden_default_sort").val().split(",");
		var default_sub_arr = $("#hidden_default_sub_sort").val().split(",");
		/**
		 * 重新排序
		 */
		// 隐藏一级菜单的“+”号，并改变长度
		var index = $("#menuList>li").length;
		if($("#menuList>li").length > MAX_MENU_LENGTH){
			index = MAX_MENU_LENGTH;
		}
		if(($("#menuList>li").length-1) < MAX_MENU_LENGTH){
			$(".js-addMenuBtn").show();
		}
		
		$("#menuList>li").removeClass("size1of"+($("#menuList>li").length-1));
		$("#menuList>li").addClass("size1of"+index);
		
		// 隐藏子菜单“+”号
		$(".sub_pre_menu_list li[class='jsSubMenu']").show();
		if(menu_id_arr.toString() != default_arr){
			updateWeixinMenuSort(menu_id_arr,1);
		}else if(sub_menu_id_arr.toString() != default_sub_arr){
			updateWeixinMenuSort(sub_menu_id_arr,2);
		}
	});
	
	/**
	 * 删除菜单
	 */
	$("#jsDelBt").click(function(){
		$("#wxDelDialog").fadeIn();//弹出框
		$("#maskLayer").fadeIn(300);
		var menu_name = $(this).attr("data-menuname");
		$(".dialog_bd p").text("删除后“" +menu_name+ "”菜单下设置的内容将被删除");
	});
	
	/**
	 * 弹出框按钮事件
	 */
	$('.pop_closed').click(function(){
        $("#wxDelDialog").fadeOut();
        $("#maskLayer").fadeOut(300);
	});
	$(".js_btn").click(function(){
		switch($(this).text()){
		case "确定":
			deleteWeixinMenu($("#jsDelBt").attr("data-menuid"));
			break;
		case "取消":
			break;
		}
		$("#wxDelDialog").fadeOut();
		$("#maskLayer").fadeOut(300);
	});
	
	/**
	 * 右侧编辑图文消息单选按钮["发送消息"]
	 */
	$(".js_radio_sendMsg").click(function(){
		$(this).addClass("selected");
		$(".js_radio_url").removeClass("selected");
		$("#edit").show();
		$("#url").hide();
		updateMenuType(2);//图文消息和链接如果都存在，则判断当前选中更新类型
	});
	
	/**
	 * 右侧编辑["跳转网页"]单选按钮
	 */
	$(".js_radio_url").click(function(){
		$(this).addClass("selected");
		$(".js_radio_sendMsg").removeClass("selected");
		$("#edit").hide();
		$("#url").show();
		updateMenuType(1);//图文消息和链接如果都存在，则判断当前选中更新类型
	});
	
	/**
	 * 右侧编辑["发送消息"]选择类型 目前只有一个类型：图文消息
	 */
	$(".js_tab_navs li").click(function(){
		/*$(".tab_content").hide();
		$(".js_tab_navs li").removeClass("selected");
		$(this).addClass("selected");
		var tab = $(this).attr("data-tab");
		$(tab).parent().show();*/
	});
	
	/**
	 * 右侧编辑["发消息"]点击“从素材库中选择”
	 */
	$(".jsMsgSenderPopBt").click(function(){
        $("#dialog_media").fadeIn(500);
        $(".mask_metar").fadeIn(300);
	});
	
	/**
	 * 保存并发布
	 */
	$("#pubBt").click(function(){
		if(validation()){
			$.ajax({
				url : UMTW,
				type : "post",
				success : function(res){
					if(res.code>0){
						showDialog(res.message,1);
					}else{
						showDialog(res.code,0);
					}
				}
			})
		}else{
//			showDialog("请先按要求编辑完当前操作！！！", 0);
		}
	});
	
	/**
	 * 手机预览
	 */
	$("#viewBt").click(function(){
		$("#mobileDiv").fadeIn();
		$("#maskLayer").fadeIn();
	});
	
	/**
	 * 关闭手机预览
	 */
	$("#viewClose").click(function(){
		$("#mobileDiv").fadeOut();
		$("#maskLayer").fadeOut();
	});

	
	/**
	 * 预览模式下的菜单点击时间
	 */
	$(".jsView").live("click",function(){
		if($(this).next().find("ul li").length > 0){
			$(this).next().toggle();
		}
	});
	
	/**
	 * 网址验证，可以为空
	 */
	$("#urltext").keyup(function(){
		if($(this).val().length>0){
			if(!validateDomainName($(this).val())){
				$(this).parent().next().removeClass("dn");
				$(this).parent().next().text("网址不正确");
				$(this).attr("data-flag","-1");
				IS_OK = false;
			}else{
				$(this).parent().next().addClass("dn");
				$(this).attr("data-flag","1");
				IS_OK = true;
			}
		}else{
			$(this).parent().next().addClass("dn");
			$(this).attr("data-flag","1");
		}
	});
	
	
	/**
	 * 删除图文消息
	 */
	$(".jsmsgSenderDelBt").click(function(){
		$("#show_media").hide();
		$(".js_appmsgArea .jsMsgSendTab").show();
		var obj = getCurrentMenu();
		//删除图文消息后，类型改为文本
		updateWeiXinMenuMessage(obj.attr("data-menuid"), 0, 2);
	});

});

//验证
function validation(){
	if(!IS_OK){
		return false;
	}
	var flag = false;
	var msg = "";
	//验证一级二级菜单数据是否正确
	$("#menuList .jsMenu").each(function(){
		var menu_self = this;
		if($(this).next().find("li.jsSubMenuInner").length){
			//有二级菜单
			$(this).next().find("li.jsSubMenuInner").each(function(){
				if($(this).hasClass("current") && $(".js_radio_sendMsg").hasClass("selected") && ($(this).children("a").attr("data-mediaid") == undefined || $(this).children("a").attr("data-mediaid") == "" || parseInt($(this).children("a").attr("data-mediaid")) == 0)){
					flag = true;
					msg = "请选择图文消息";
					return false;
				}else{
					
					if(parseInt($(this).children("a").attr("data-menu-type")) == 1 && ($(this).children("a").attr("data-menu-eventurl") == undefined || $(this).children("a").attr("data-menu-eventurl") == "")){
						flag = true;
						msg = "跳转网址不能为空";
						menuClick(menu_self);
						subMenuClick(this);
						return false;
					}
				}
			});
			if(flag){
				return false;
			}
		}else{
			if($(this).parent().hasClass("current") && $(".js_radio_sendMsg").hasClass("selected") && ($(this).attr("data-mediaid") == undefined || $(this).attr("data-mediaid") == "" || parseInt($(this).attr("data-mediaid")) == 0)){
				msg = "请选择图文消息";
				flag = true;
				return false;
			}else{
			
				if(parseInt($(this).attr("data-menu-type")) == 1 && ($(this).attr("data-menu-eventurl") == undefined || $(this).attr("data-menu-eventurl") == "")){
					flag = true;
					msg = "跳转网址不能为空";
					menuClick(menu_self);
					return false;
				}
				if(parseInt($(this).attr("data-menu-type")) == 2 && ($(this).attr("data-mediaid") == undefined || $(this).attr("data-mediaid") == "" || parseInt($(this).attr("data-mediaid")) == 0)){
					msg = "请选择图文消息";
					flag = true;
					menuClick(menu_self);
					return false;
				}
				
			}
		}
	});
	
	if(flag){
		showDialog(msg, 0);
		return false;
	}
	return true;
}


//每次点击一级菜单后，让右侧的编程内容还原（显示菜单内容，）
function setRightMenuDetail(){
	$(".js_radio_sendMsg").addClass("selected");
	$(".js_radio_url").removeClass("selected");
	$("#edit").show();
	$("#url").hide();
}


/**
 * 获取当前选中的菜单
 */
function getCurrentMenu(){
	var obj = $("#menuList").find("li[class*='current']>a");
	return obj;
}

/**
 * 选中图文素材后的回调函数
 * @param media_id
 */
function getMaterial(media_id){
	getWeixinMediaDetail(media_id,true);
}

/**
 * 设置垂直居中
 */
function setVerticalCenter(obj){
	$(obj).css({'top':($(window).height()-$(obj).outerHeight())/2,"display":"block"});
}

/**
 *显示提示框，两秒后关闭
 * @param flag 0：成功，1：失败
 */
function showDialog(str,flag){
	if(flag == 0){
		$("#wxTips").addClass("error");
		$("#wxTips").removeClass("success");
	}else{
		$("#wxTips").addClass("success");
		$("#wxTips").removeClass("error");
	}
	$("#wxTips").find("div").text(str);
	$("#wxTips").fadeIn();
	setTimeout("$('#wxTips').fadeOut()",2000);
}

/**
 * 设置当前选中的一级菜单是否有子菜单，如果有则仅可设置菜单名称。
 */
function setCurrentChildMenuDisplay(){
	var elementLength = $("#menuList li[class*='current'] a").next().find("ul li[class*='jsSubMenuInner']").length;
	if(elementLength == 0){
		$("#js_innerNone").hide();
		$(".js_setGraphic").show();
	}else{
		$("#js_innerNone").show();//已添加子菜单，仅可设置菜单名称。
		$(".js_setGraphic").hide();
	}
}

/**
 * 设置图文消息列表是否显示,没有则清空图文消息
 * @param mediaid
 */
function setMediaDisplay(mediaid){
	if(mediaid !=undefined && parseInt(mediaid) != 0){
		getWeixinMediaDetail(mediaid);
		$(".js_appmsgArea .jsMsgSendTab").hide();
		$("#show_media").show();
	}else{
		clearMediaMessage();//清空图文消息
		$(".js_appmsgArea .jsMsgSendTab").show();
		$("#show_media").hide();
	}
}

/**
 * 清空图文消息
 */
function clearMediaMessage(){
	$("#show_media .appmsg_date").text("");
	$("#show_media .js-media-title a").text("");
	$("#show_media .appmsg_thumb_wrp").attr("style","");
	$("#show_media .appmsg_item.has_cover").remove();
}

function updateInfoNew(menu){
	setCurrentChildMenuDisplay();//设置当前选中的一级菜单是否有子菜单，如果有则仅可设置菜单名称。
	setMediaDisplay(menu.media_id);//设置图文消息列表是否显示,没有则清空图文消息
	
	var mobileObj = null;//手机预览
	if(menu.pid == 0){
		//一级菜单
		$("#jsDelBt").text("删除菜单");
		$(".js_titleNolTips").text(DEFAULT_MENU_TIP);
		$(".js_titleNolTips").attr("data-selected","menu");//标识当前选中的是一级菜单
		//手机预览
		mobileObj = $("#viewList>li>a[data-menuid='"+menu.menu_id+"']");
	}else{
		//二级菜单
		$("#jsDelBt").text("删除子菜单");
		$(".js_titleNolTips").text(DEFAULT_SUB_MENU_TIP);
		$(".js_titleNolTips").attr("data-selected","submenu");//标识当前选中的是二级菜单
		//手机预览
		mobileObj = $("#viewList>li>div a[data-menuid='"+menu.menu_id+"']");
	}
	//手机预览
	mobileObj.text(menu.menu_name);
	mobileObj.attr("title",menu.menu_name);
	
	
	//更新右侧边栏数据
	$(".js_second_title_bar h4").text(menu.menu_name);//右侧标题
	$("#jsDelBt").attr("data-menuid",menu.menu_id);//删除按钮
	$("#jsDelBt").attr("data-menuname",menu.menu_name);//记录当初操作后的菜单名称，用于删除提示
	$("#menuname").val(menu.menu_name);//右侧标题菜单名称输入框	
	
	
	var obj = getCurrentMenu();//当前选中的菜单，更新数据
	obj.children("span").text(menu.menu_name);
	obj.attr("data-menuid",menu.menu_id);
	obj.attr("data-pid",menu.pid);
	obj.attr("data-menu-eventurl",menu.menu_event_url);
	obj.attr("data-menu-type",menu.menu_event_type);
	obj.attr("data-detault-menu-type",menu.menu_event_type);
	obj.attr('data-mediaid',menu.media_id);//当前选中菜单的图文消息
	obj.attr("data-sort",menu.sort);
	//如果是一级菜单，则给它下边的所有二级菜单更新父id(data-pid)
	if(menu.pid == 0){
		obj.next().find("ul li").attr("data-pid",menu.menu_id);
	}else{
		//如果当前选择的是二级菜单，则将一级菜单的data-menu-type设置为1，data-mediaid设置为0。
		if(parseInt($("a[data-menuid='"+menu.pid+"']").attr("data-menu-type"))!= 1){
			$("a[data-menuid='"+menu.pid+"']").attr("data-menu-type",1);
			$("a[data-menuid='"+menu.pid+"']").attr('data-mediaid',0);//当前选中菜单的图文消息
			updateWeiXinMenuMessage(menu.pid, 0, 2);
		}
	}
}

/**
 * 找到当前选中的菜单如果链接和图文消息都有，则判断选择那个
 * 如果图文消息和跳转链接都存在数据，那么就要给每个菜单记录，选中那个用那个。类型对应的要变；1、2。
 */
function updateMenuType(type){
	var obj = getCurrentMenu();
	updateWeixinMenuEventType(obj.attr("data-menuid"),type);
//	alert(obj.attr("data-detault-menu-type"));
//	if(obj.attr("data-mediaid") != 0 && (obj.attr("data-menu-eventurl") != null && obj.attr("data-menu-eventurl") != "")){
//		if($(".js_radio_url").hasClass("selected")){
//			updateWeixinMenuEventType(obj.attr("data-menuid"),1);
//		}else{
//			updateWeixinMenuEventType(obj.attr("data-menuid"),obj.attr("data-detault-menu-type"));
//		}
//	}
}

/**
 * 修改菜单类型，1：文本，2：单图文，3：多图文
 * @param menu_id
 * @param menu_event_type
 */
function updateWeixinMenuEventType(menu_id,menu_event_type){
	$.ajax({
		url : UWMET,
		type : "post",
		async : false,
		data : { "menu_id" : menu_id, "menu_event_type" : menu_event_type},
		success : function(res){;
			if(res>0){
				var obj = getCurrentMenu();
				obj.attr("data-menu-type",menu_event_type);
//				showDialog("修改成功", 1);
			}else{
				showDialog("修改失败", 0);
			}
		}
	})
}

/**
 * 添加微信自定义菜单
 * @param menu 菜单信息
 * @param obj 当前对象
 */
function addWeixinMenu(menu){
	$.ajax({
		url : AWM,
		type : "post",
		async : false,
		data : { "menu" : JSON.stringify(menu) },
		success : function(menu_id){
			if(menu_id>0){
				//每次添加菜单默认类型是，跳转链接
				$(".js_radio_url").addClass("selected");
				$(".js_radio_sendMsg").removeClass("selected");
				$("#edit").hide();//编辑图文消息
				$("#url").show();//跳转链接输入框
				
				menu.menu_id = menu_id;//设置添加菜单后的id
				//更新手机预览的菜单id
				$("#viewList li a[data-menuid=-1]").attr("data-menuid",menu_id);
				updateInfoNew(menu);
				showDialog("“"+menu.menu_name+"”添加成功",1);
			}else{
				showDialog("“"+menu.menu_name+"”添加失败",0);
			}
		}
	})
}

/**
 * 修改菜单名称
 * @param menu_id
 * @param menu_name
 */
function updateWeixinMenuName(menu_id, menu_name){
	$.ajax({
		url : UWMN,
		type : "post",
		async : false,
		data : { "menu_id" : menu_id, "menu_name" : menu_name},
		success : function(res){;
			if(res>0){
				var obj = getCurrentMenu();
				var menu = new Object();
				menu.menu_name = menu_name;
				menu.media_id = obj.attr("data-mediaid");
				menu.menu_id = obj.attr("data-menuid");
				menu.pid = obj.attr("data-pid");
				menu.menu_event_url = obj.attr("data-menu-eventurl");
				menu.menu_event_type = obj.attr("data-menu-type");
				updateInfoNew(menu);
				showDialog("修改“"+menu_name+"”成功", 1);
			}else{
				showDialog("修改“"+menu_name+"”失败", 0);
			}
		}
	})
}

/**
 * 修改跳转链接地址
 * @param menu_id
 * @param menu_event_url
 */
function updateWeixinMenuUrl(menu_id,menu_event_url){
	$.ajax({
		url : UWMU,
		type : "post",
		async : false,
		data : { "menu_id" : menu_id, "menu_event_url" : menu_event_url},
		success : function(res){;
			if(res>0){
				var obj = getCurrentMenu();
				obj.attr("data-menu-eventurl",menu_event_url);
				showDialog("修改成功", 1);
			}else{
				showDialog("修改失败", 0);
			}
		}
	})
}

/**
 * 删除微信自定义菜单
 * @param menuid 菜单id
 */
function deleteWeixinMenu(menu_id){
	var flag = true;//判断当前删除的菜单是否是子菜单
	if($("#menuList li[class*='current'] a").attr("data-pid") != 0){
		flag = false;//当前删除的是子菜单
	}
	var length = $("#menuList>li[data-menu-index]").length;//长度包含“+”号
	var pid = $(".jsSubMenuInner a[data-menuid='"+menu_id+"']").attr("data-pid");
	$("#menuList li[class*='current'] a").parent().remove();//删除选中的菜单
	$("#js_none").show();
	$("#js_none").text("点击左侧菜单进行编辑操作");
	$("#js_rightBox").hide();
	if(flag){
		//一级菜单删除操作
		var classIndex = $(".js-addMenuBtn").attr("data-class-index");
		$("#menuList>li").removeClass("size1of"+classIndex);
		$("#menuList>li").addClass("size1of"+length);
		if(length == 2){
			//长度等于2，代表一个菜单和一个“+”号按钮
			$("#orderDis").removeClass("dn");
			$("#orderBt").addClass("dn");
		}else if(length == 1){
			$("#menuList").addClass("no_menu");
			$(".js-addMenuBtn a").append("<span>添加菜单</span>");
			$("#orderDis").addClass("dn");
		}
		$(".js-addMenuBtn").attr("data-class-index",length);
		$(".js-addMenuBtn").show();
		$(".jsMenu").next("div[class='sub_pre_menu_box']").hide();//隐藏其他二级菜单
		
		//删除手机预览，一级菜单下的全部
		$("#viewList>li a[data-menuid='"+menu_id+"']").parent().remove();
		//调整宽度
		$("#viewList>li").removeClass("size1of"+length);
		$("#viewList>li").addClass("size1of"+(length-1));
		
	}else{
		$(".jsSubMenu[data-pid='"+pid+"']").show();
		//删除手机预览
		if($("#viewList .sub_pre_menu_list li").length==1){
			$("#viewList .sub_pre_menu_list li a[data-menuid='"+menu_id+"']").parent().parent().parent().prev().find("i").remove();
		}
		$("#viewList .sub_pre_menu_list li a[data-menuid='"+menu_id+"']").parent().parent().parent().hide();
		$("#viewList .sub_pre_menu_list li a[data-menuid='"+menu_id+"']").parent().parent().remove();
	}
	$.ajax({
		url : DWM,
		type : "post",
		async : false,
		data : { "menu_id" : menu_id },
		success : function(res){
			if(res>0){
				showDialog("删除成功",1);
			}else{
				showDialog("删除失败",0);
			}
		}
	})
}

/**
 * 修改图文消息
 * @param $menu_id
 * @param $media_id
 * @param $menu_event_type
 */
function updateWeiXinMenuMessage(menu_id, media_id, menu_event_type){
	$.ajax({
		url : UWMM,
		type : "post",
		async : false,
		data : { "menu_id" : menu_id, "media_id" : media_id, "menu_event_type" : menu_event_type},
		success : function(res){
			if(res>0){
				var obj = getCurrentMenu();
				obj.attr("data-menu-type",menu_event_type);
				obj.attr("data-mediaid",media_id);
				showDialog("操作成功", 1);
			}else{
				showDialog("操作失败", 0);
			}
		}
	})
}

/**
 * 获取图文素材，并更新菜单信息
 * @param media_id
 */
function getWeixinMediaDetail(media_id,flag){
	$.ajax({
		url : GWMD,
		type : "post",
		async : false,
		data : { "media_id" : media_id },
		success : function(mediaObj){
			setMediaDetail(mediaObj);//加载图文消息代码
			if(flag){
				var obj = getCurrentMenu();
				updateWeiXinMenuMessage(obj.attr("data-menuid"), media_id, 2);
			}
		}
	})
}

/**
 * 设置图文消息
 */
function setMediaDetail(mediaObj){
	$(".js_appmsgArea .jsMsgSendTab").hide();
	$("#show_media").show();
	var html = "";
	//图文消息 2 3

	if(mediaObj.type == 2 || mediaObj.type == 3){
		var list = mediaObj.item_list;
		for(var i=0;i<list.length;i++){
			if(i == 0){
				//封面
				var firstObj = $(".cover_appmsg_item"); 
				firstObj.find(".js-media-title a").text(list[i]["title"]);
				var style = "background-image:url('" + PUBLIC+list[i]["cover"] + "')";
				$(".cover_appmsg_item>div").attr("style",style);
				$(".cover_appmsg_item>div").text("");
			}else{
				html += '<div class="appmsg_item has_cover">';
				html += '<div class="appmsg_thumb_wrp" style="background-image:url(' + PUBLIC+list[i]["cover"] + ');"></div>';
				html += '<h4 class="appmsg_title js_title"><a href="' + list[i]["content_source_url"] + '" target="_blank">' + list[i]["title"] + '</a></h4>';
				html += '</div>';
			}
		}	
	}else{
		//单文本
		$(".js-media-title").find("a").text(mediaObj.title);//主标题
		$(".cover_appmsg_item>div").attr("style","");
		$(".cover_appmsg_item>div").text(mediaObj.title);
	}
	$(".appmsg_date").text(mediaObj.create_time);//发布时间
	$(".cover_appmsg_item").nextAll().remove();
	$(".cover_appmsg_item").parent().append(html);
}

/**
 * 修改排序
 * @param flag ：1 默认一级排序，2 默认二级排序
 */
function updateWeixinMenuSort(menu_id_arr,flag){
	$.ajax({
		url : UWMS,
		type : "post",
		async : false,
		data : { "menu_id_arr" : menu_id_arr.toString() },
		success : function(res){
			if(res>0){
				if(flag == 1){
					$("#hidden_default_sort").val(menu_id_arr);
				}else if(flag == 2){
					$("#hidden_default_sub_sort").val(menu_id_arr);
				}
				showDialog("操作成功",1);
			}else{
				showDialog("操作失败",0);
			}
		}
	})
}

/**
 * 一级菜单点击事件
 * 2017年8月1日 10:33:58
 * @param obj 当前点击对象
 */
function menuClick(obj){
	var element = "div[class='sub_pre_menu_box']";
	$(".jsMenu").parent().find(element).hide();//隐藏其他二级菜单
	$(".js_titleEorTips").hide();
	$(".jsMenu").parent().removeClass("current");//清除一级菜单中的选中
	$(".jsSubMenuInner").removeClass("current");//清除二级菜单选中
	$(obj).parent().find(element).show();//显示二级菜单
	$(obj).parent().addClass("current");

	var sub_arr = new Array();
	$(obj).next().find(".sub_pre_menu_list li[class*='jsSubMenuInner']").each(function(){
		sub_arr.push($(obj).find("a").attr("data-menuid"));
	})
	$("#hidden_default_sub_sort").val(sub_arr);
	
	//完成按钮显示的情况下，不能操作
	if(!$("#finishBt").is(":hidden")){
		$("#js_none").show();
		$("#js_rightBox").hide();
		setSubMenuDisplay();
		return;
	}else{
		$("#js_none").hide();
		$("#js_rightBox").show();
	}
	setCurrentChildMenuDisplay();//设置当前选中的一级菜单是否有子菜单，如果有则仅可设置菜单名称。
	setRightMenuDetail();//每次点击一级菜单后，让右侧的编程内容还原（显示菜单内容，）
	/**
	 * 当前菜单是否有图文消息
	 */
	setMediaDisplay($(obj).attr("data-mediaid"));//设置图文消息列表是否显示,没有则清空图文消息

	//单图文、多图文消息
	if(parseInt($(obj).attr("data-menu-type")) == 2 || parseInt($(obj).attr("data-menu-type")) == 3){
		$(".js_radio_sendMsg").addClass("selected");
		$(".js_radio_url").removeClass("selected");
		$("#edit").show();
		$("#url").hide();
	}else{
		//跳转链接
		$(".js_radio_url").addClass("selected");
		$(".js_radio_sendMsg").removeClass("selected");
		$("#edit").hide();//编辑图文消息
		$("#url").show();//跳转链接输入框
	}
	//右侧编辑头部标题
	var menuname = $.trim($(obj).find("span").text());
	var menuid = $(obj).attr("data-menuid");
	var menu_event_url = menu_event_url = $(obj).attr("data-menu-eventurl");//菜单url
	$(".js_titleNolTips").text(DEFAULT_MENU_TIP);//字数不超过4个汉字或8个字母
	$(".js_titleNolTips").attr("data-selected","menu");
	$(".js_second_title_bar h4").text(menuname);
	$("#menuname").val(menuname);
	$("#jsDelBt").text("删除菜单");
	$("#jsDelBt").attr("data-menuid",menuid);
	$("#jsDelBt").attr("data-menuname",menuname);
	$("#urltext").val(menu_event_url);
}

/**
 * 二级菜单点击事件
 * 2017年8月1日 10:38:31
 * @param obj 当前点击对象
 */
function subMenuClick(obj){
	$("#js_innerNone").hide();
	$(".js_setGraphic").show();//显示编辑
	$(".js_titleEorTips").hide();
	$(".jsMenu").parent().removeClass("current");
	$(".jsSubMenuInner").removeClass("current");
	$(obj).addClass("current");

	//完成按钮显示的情况下，不能操作
	if(!$("#finishBt").is(":hidden")){
		$("#js_none").show();
		$("#js_rightBox").hide();
		setSubMenuDisplay();
		return;
	}else{
		$("#js_none").hide();
		$("#js_rightBox").show();
	}

	/**
	 * 当前菜单是否有图文消息
	 */
	setMediaDisplay($(obj).find("a").attr("data-mediaid"));
	setRightMenuDetail();//每次点击一级菜单后，让右侧的编程内容还原（显示菜单内容，）

	//单图文、多图文消息
	if(parseInt($(obj).find("a").attr("data-menu-type")) == 2 || parseInt($(obj).find("a").attr("data-menu-type")) == 3){
		$(".js_radio_sendMsg").addClass("selected");
		$(".js_radio_url").removeClass("selected");
		$("#edit").show();
		$("#url").hide();
	}else{
		//跳转链接
		$(".js_radio_url").addClass("selected");
		$(".js_radio_sendMsg").removeClass("selected");
		$("#edit").hide();//编辑图文消息
		$("#url").show();//跳转链接输入框
	}
	//右侧编辑头部标题
	var menuname = $.trim($(obj).find("span").text());
	var menuid = $(obj).find("a").attr("data-menuid");
	var menu_event_url = $(obj).find("a").attr("data-menu-eventurl");//菜单url
	$(".js_titleNolTips").text(DEFAULT_SUB_MENU_TIP);//汉字或16个字母
	$(".js_titleNolTips").attr("data-selected","submenu");
	$(".js_second_title_bar h4").text(menuname);
	$("#menuname").val(menuname);
	$("#jsDelBt").text("删除子菜单");
	$("#jsDelBt").attr("data-menuid",menuid);
	$("#jsDelBt").attr("data-menuname",menuname);
	$("#urltext").val(menu_event_url);
}

/**
 * aa:一个汉字占2个字节
 * 修改时间：2017年8月4日 18:41:02
 * 王永杰
 */
function testMenu(str,type) {
	if(type == "menu"){
		return /^[a-zA-Z-0-9]{1,8}$/.test((str + '').replace(/[\u4e00-\u9fa5]/g, 'aa'));
	}else if(type == "sub_menu"){
		return /^[a-zA-Z-0-9]{1,16}$/.test((str + '').replace(/[\u4e00-\u9fa5]/g, 'aa'));
	}
}


/**
 * 验证域名
 * 创建时间：2017年7月31日 19:47:09
 * 更新时间：2017年8月4日 20:49:55
 * @param str
 * @returns boolean
 */
function validateDomainName(str){
	if(str.indexOf("http") != -1 || str.indexOf("https") != -1){
		return true;
	}
	return false;
}