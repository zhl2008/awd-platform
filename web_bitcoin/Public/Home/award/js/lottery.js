///-------------------------------///
$(function(){
	$('.cj').luckDraw({
		width:160, //宽
		height:160, //高
		line:4, //几行
		list:4, //几列
		click:".min_mubox_click" //点击对象
	});
});

$.fn.extend({
	luckDraw:function(data){
		var anc = $(this); //祖父元素
		var list = anc.children("li");
		var click; //点击对象
		var lineNumber; //几行 3
		var	listNumber; //几列 4
		var thisWidth;
		var thisHeight;
		if(data.line==null){return;}else{lineNumber=data.line;}
		if(data.list==null){return;}else{listNumber=data.list;}
		if(data.width==null){return;}else{thisWidth=data.width;}
		if(data.height==null){return;}else{thisHeight=data.height;}
		if(data.click==null){return;}else{click=data.click;}
		var all = 12 //应该有的总数
		if(all>list.length){ //如果实际方块小于应该有的总数
			for(var i=0;i<(all-list.length);i++){
				anc.append("<li>"+all+"</li>");
			}
		}
		list = anc.children("li");
		var ix = 0;
		var speed = 200;
		var Countdown = 1000; //倒计时
		var isRun = false;
		var dgTime = 200;
		
		$(click).click(function(){
			if(isRun){
				return;
			}else{
				$(".lottery_dian span").addClass("hover");
/* 				$.ajax({
					url:'/draw/draw',
					type:'get',
					dataType:'json',
					success:function (d) {
						if(!AJAX.ltcb(d)) return;
						if(d.status){
							drawTitle = d.data.title;
							var stime = parseInt(d.data.index);
							dgTime = stime*10 + 280;
							speedUp();
						}else{
							alert(d.msg);
						}
					}
				}); */
				
						//if(d.status){
							drawTitle = "我是标题";
							var stime = 2;
							dgTime = stime*10 + 280;
							speedUp();
						//}else{
						//	alert(d.msg);
						//}
			}
		});
		function speedUp(){ //加速
			isRun = true;
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			speed -= 50;
			if(speed == 100){
				clearTimeout(stop);
				uniform();
			}else{
				var stop = setTimeout(speedUp,speed);
			}
		}
		function uniform(){ //匀速
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			Countdown -= 50 ;
			if(Countdown == 0){
				clearTimeout(stop);
				speedDown();
			}else{
				var stop = setTimeout(uniform,speed);
			}
		}
		function speedDown(){ //减速
			list.removeClass("adcls");
			list.eq(ix).addClass("adcls");
			ix++;
			init(ix);
			speed += 10;
			if(speed == dgTime+20){
				clearTimeout(stop);
				end();
			}else{
				var stop = setTimeout(speedDown,speed);
			}
		}
		function end(){
			var result=new Array("Iphone7","空气加湿器","VR眼镜","蓝牙耳机","拍立得","体感平衡车","定制U盘","再接再厉","虚拟币","手机支架","行车仪","乐视电视");
			//if(ix==8){
				setTimeout(lottery_no(),5);
			//}else{
				//setTimeout(lottery_get(ix,drawTitle),5);
			//}
			$(".lottery_dian span").removeClass("hover");
		}
		///--归0
		function init(o){
			if(o == all){
				ix = 0;
			}
		}
		///
		function initB(){
			ix = 0;
			dgTime = 200;
			speed = 500;
			Countdown = 1000;
			isRun = false;
		}
	}

});



//领取奖品弹窗
//今日奖品已抢完
function lottery_over(){
	var html = '';
	html += '<div class="ui-dialog" id="lottery_over" style="width: 600px;background: none; box-shadow:none;"> ' +
		'<div class="lottery_tan po_re">' +
		'<div class="lottery_tan_cha po_ab" onclick="$(\'#lottery_over\').hide() && $(\'.ui-mask\').hide();"><img src="/Public/Home/award/images/lot_tan_cha.png" width="20"></div> ' +
		'<div class="lottery_tan_over"> ' +
		'<img src="/images/lot/lot_tanimg_over.png" width="400" alt="今日奖品已抢完">' +
		'</div>' +
		'</div>' +
		'</div>';
	$('body').prepend(html);
	showDialog('lottery_over');
}
//再接再厉
function lottery_no(){
	var html = '';
	html += '<div class="ui-dialog" id="lottery_no" style="width: 600px;background: none; box-shadow:none;">' +
		'<div class="lottery_tan po_re">' +
		'<div class="lottery_tan_cha po_ab" onclick="window.location.reload()"><img src="/Public/Home/award/images/lot_tan_cha.png" width="20"></div> ' +
		'<div class="lottery_tan_no">' +
		'<img src="/Public/Home/award/images/lot_tanwen_no.png" width="192" class="lot_tanwen_no"> ' +
		'<img src="/Public/Home/award/images/lot_tanimg_no.png" width="176" class="lot_tanimg_no"> ' +
		'</div>' +
		'</div>' +
		'</div>';
	$('body').prepend(html);
	showDialog('lottery_no');
}
function lottery_get(id,txt){
	var html = '';
	var cs = '<p class="lottery_get_tishi"></p>';
	var imgUrl='';
	if(id == 9){
		if(txt.indexOf('红贝壳')>-1){
			imgUrl = '/images/lot/lot_get_img'+id+'-1.png';
		}else if(txt.indexOf('阿希币')>-1){
			imgUrl = '/images/lot/lot_get_img'+id+'-2.png';
		}else {
			imgUrl = '/images/lot/lot_get_img'+id+'.png';
		}
	}else{
		cs = '<p class="lottery_get_tishi">温馨提示：实物奖品，请主动<a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODAyNDczN18xNjMyMjVfNDAwNjU3ODg4MF8yXw">联系客服</a>提供收货地址。</p>';
		imgUrl = '/images/lot/lot_get_img'+id+'.png';
	}
	html += '<div class="ui-dialog" id="lottery_get" style="width: 600px;background: none; box-shadow:none;">' +
		'<div class="lottery_tan po_re">' +
		'<div class="lottery_tan_cha po_ab" onclick="window.location.reload()"><img src="/Public/Home/award/images/lot_tan_cha.png" width="20"></div> ' +
		'<div class="lottery_tan_get">' +
		'<img src="/Public/Home/award/images/lot_tanwen_get.png" width="167" class="lot_tanwen_get">' +
		'<div class="lottery_get">' +
		'<img src="'+imgUrl+'" width="224">' +
		'<p>' + txt + '</p>' +
		'<a href="/finance/prize.html"><img src="/Public/Home/award/images/lot_tanimg_click.png" width="136" alt="查看详情"> </a>' +
		'</div>' + cs +
		'</div>' +
		'</div>' +
		'</div>';
	$('#lottery_get').remove();
	$('body').prepend(html);
	showDialog('lottery_get');
}

function Dom(id){
	return $("#"+id);
}

//弹出层
function showDialog(id,maskclick) {
    // 遮罩
    $('#'+id).removeClass('modal-out').addClass('styled-pane');
    var dialog = Dom(id);
    dialog.style.display = 'block';
    if (Dom('mask') == null) {
        $('body').prepend('<div class="ui-mask" id="mask" onselectstart="return false"></div>');
        if(!maskclick)
            $('#mask').bind('click',function(){hideDialog(id)})
    }
    var mask = Dom('mask');
    mask.style.display = 'inline-block';
    mask.style.width =  document.body.offsetWidth  + 'px';
    mask.style.height = document.body.scrollHeight + 'px';
    //居中
    var bodyW = document.documentElement.clientWidth;
    var bodyH = document.documentElement.clientHeight;
    var elW = dialog.offsetWidth;
    var elH = dialog.offsetHeight;
    dialog.style.left = (bodyW - elW) / 2 + 'px';
    dialog.style.top = (bodyH - elH) / 2 + 'px';
    dialog.style.position = 'fixed';
}
// 关闭弹出框
function hideDialog(id, fn) {
    $('#'+id).removeClass('styled-pane').addClass('modal-out');
    $('#mask').addClass('out');
    setTimeout(function(){$('#'+id).hide();$('#mask').remove();},300);
    if (typeof fn == 'function') fn();
}




