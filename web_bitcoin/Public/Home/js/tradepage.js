// 重置输入框效果
inputFB = function (){};
function tm_hide(type){$('#tm-'+type).fadeOut()}
function tm_show(type, d){
	$('#tm-'+type).html(d.status == 1? '<i></i>' + d.msg: '<i style="background-position: -84px 0;"></i><span style="color:#e65e10;">'+d.msg+'</span>');
	$('#tm-'+type).show();setTimeout("tm_hide('"+type+"')",3000);
}
$('body').click(function(){tm_hide('buy');tm_hide('sell')});
function maxbuy(i){
	if(!FINANCE || FINANCE == 1 || !parseFloat($('#buy-price').val()))return;
	var max = formatfloat(FINANCE.data['cny_balance']/parseFloat($('#buy-price').val()), 3, 0);
	if(i) $('#buy-number').val(max);
	$('#buy-max').html(max);
}
function buytotal(){
	$('#buy-total').html(formatfloat($('#buy-price').val() * $('#buy-number').val(), 4, 0));
	$('#sell-total').html(formatfloat($('#sell-price').val() * $('#sell-number').val(), 4, 0));
	if(typeof FINANCE == 'object') {
		$('#sell-max').html(formatfloat(FINANCE.data[CONF.coin + '_balance'], 4, 0));
	}
}
function coin_cb (d,allcoin){ ALLCOIN = d;
	allcoin = typeof allcoin == 'object' ? allcoin : d;
	var html = '';
	for(var c in allcoin) {
		if(typeof COINSTOP[c] == 'object') continue;
		html+='<li><a href="/coin/'+c+'/"><i class="price_i_'+c+'"></i><div class="all_coin_name"><p>'+d[c][0]+'('+ c.toUpperCase()+')</p><span>￥'+d[c][1]+'</span></div></a></li>';
	}
	$('#all_coin').html(html);
}
AJAX.finance_cb = function(){
	if(!parseInt($.cookie('kline'))) {
		$('.zcxx').html('<div class="right_table"><table width="290" border="0" cellspacing="0" cellpadding="0">'+
		'<tr><th>可用'+COIN[CONF.coin]+'</th><td><font>'+FINANCE.data[CONF.coin + '_balance']+'</font></td></tr>'+
		'<tr><th>冻结'+COIN[CONF.coin]+'</th><td><span>'+FINANCE.data[CONF.coin + '_lock']+'</span></td></tr>'+
		'<tr><th>折合人民币</th><td class="zc-c2c">loading...</td></tr>'+
			'<tr><th>可用人民币</th><td><font>￥'+formatfloat(FINANCE.data['cny_balance'], 2, 0)+'</font></td></tr>'+
		'<tr><th>冻结人民币</th><td><font style="color:#e55600;">￥'+formatfloat(FINANCE.data['cny_lock'], 2, 0)+'</font></td></tr></table></div>');
		$('.zcxx').show();
	}else{
		$('#uinfo').html('<div style="width:100%;height:46px;background:#3d3d3d;">' +
		'<div class="autobox">' +
		'<ul class="available-info">' +
		'<li style="color:#80C000;">可用'+ COIN[CONF.coin] +'：<span style="color:#80C000;">'+ FINANCE.data[CONF.coin + '_balance'] + '</span></li>' +
		'<li style="color:#f95919;">冻结'+ COIN[CONF.coin] +'：<span style="color:#f95919;">'+ FINANCE.data[CONF.coin + '_lock'] +'</span></li>' +
		'<li>折合人民币：<span class="zc-c2c">loading...</span></li><li>可用人民币：<span>￥'+ formatfloat(FINANCE.data['cny_balance'], 2, 0) +'</span></li></ul></div></div>');
	}
	//AJAX.finance_coin(['','fz_12','top30',1],coin_cb);
};
AJAX.usercb=function(){AJAX.opentrades();AJAX.finance()};
AJAX.listcb=function(d){AJAX.opentrades_cb(d);if(d.data.datas.length)$('#user-trades').show()};

$(function(){
	NavMenu(['','fz_12','top30',1]);
	$('.all_coin_price').hover(function(){$('.all_coin_list').show()},function(){$('.all_coin_list').hide()});
	//币种菜单
	//if(!USER) AJAX.allcoin(coin_cb);
	AJAX.alltrade(); AJAX.allorder();
	setInterval("buytotal()", 200);
	if (!USER || (USER[6] != 0)) { $('.pwdtrade').show();}else{$('.pwdtrade').hide();}
	
});