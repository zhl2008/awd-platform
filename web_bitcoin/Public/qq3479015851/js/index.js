var index = function() {
		var b = this;
		this.btn=$("#loginbtn");
		this.loading="<div id='loading'><img src='/Public/Home/images/loading.gif' /></div>";
		this.btn.click(function(){
			b.login();
		});
		document.onkeypress = function(){ 
		if(event.keyCode == 13) {
			b.login();
		}}
		
};
index.prototype = {
	login: function(){
		var b = this;
		$("body").append(b.loading);
		 $.post(_barr.login, $("#loginform").serialize(),function(rs){
		   $("#loading").remove();
					 layer.msg(rs.info);
					 if(rs.status==1){
						 window.location.href="/Safe/index";
					 }else if(rs.status==3){
						$(".captcha").removeClass("hide");
						$(".login").addClass("top3em")
					 }else if(rs.status==6){
						 $(".google").removeClass("hide");
						 $(".login").addClass("top3em")
					 }
		})
	}
};
new index;
$(function() {
//------
$(".homepage-lump .col-sm-2").hover(function(){
	$(this).addClass("current")
	},function(){
		$(this).removeClass("current")
		});
$(".flexslider").flexslider({
		directionNav: true,
		pauseOnAction: false
});
//=========+
$('.for_coin li').click(function(){
	$(this).addClass("selectTag");
	$(this).siblings().removeClass("selectTag");
	var qid=$(this).data("qu");
	$(".coin_list>tbody>tr").addClass('hide');
	$(".coin_list>tbody>."+qid).removeClass('hide');
	});
var tradeDetailed = function(){
var self=this;
self.webCoin();
self.okCoin();
self.poloCoin();
setInterval(function(){
	self.getCoinMarket();
	self.webCoin();
	self.okCoin();
	self.poloCoin();
},10000)
}
var myTemplate = Handlebars.compile($("#table-template").html());
tradeDetailed.prototype = {
	webCoin: function() {
	var self=this;	 
    $("#web_coin>.coin_num").each(function(){
	var coin=$(this).data('mark');
	$.getJSON('https://api.huobi.com/staticmarket/'+coin+'_kline_100_json.js?length=1', function(c) {
	   var level=Math.floor(((c[0][4]-c[0][1])/c[0][4])*10000);
	   $("#web_coin>.coin"+coin+">.change24>a").removeClass();
	   if(level>0){
	   $("#web_coin>.coin"+coin+">.change24>a").addClass('text-red');
	   $("#web_coin>.coin"+coin+">.change24>a").text("+"+level/100+"%");
	   }else{
		  $("#web_coin>.coin"+coin+">.change24>a").addClass('text-green');
		  $("#web_coin>.coin"+coin+">.change24>a").text(level/100+"%"); 
		   }
 	})
		$.getJSON('https://api.huobi.com/staticmarket/detail_'+coin+'_json.js', function(c) {
			$("#web_coin>.coin"+coin+">.new_price>a").removeClass();
			if(c.p_last>c.p_open){
				$("#web_coin>.coin"+coin+">.new_price>a").text(c.p_last+"CNY↑");
				$("#web_coin>.coin"+coin+">.new_price>a").addClass('text-red'); 
				}else{
				$("#web_coin>.coin"+coin+">.new_price>a").addClass('text-green');
				$("#web_coin>.coin"+coin+">.new_price>a").text(c.p_last+"CNY↓");
				}
			$("#web_coin>.coin"+coin+">.num24>a").text(c.amount);
			$("#web_coin>.coin"+coin+">.money24>a").text(c.total.toFixed(2)+" CNY");
		})
	});
	},
	okCoin: function() {
	var self=this;	 
    $("#ok_coin>.coin_num").each(function(){
	var coin=$(this).data('mark');
	var symbol=coin+"_cny";
	/*时间 开 高 低 收 交易量*/
	$.getJSON('/Okcoin/get_kline',{symbol:symbol,type:'1day',size:1}, function(c) {
	   window.level=Math.floor(((c[0][4]-c[0][1])/c[0][4])*10000);
	   $("#ok_coin>.coin"+coin+">.change24>a").removeClass();
	   if(window.level>0){
	   $("#ok_coin>.coin"+coin+">.change24>a").addClass('text-red');
	   $("#ok_coin>.coin"+coin+">.change24>a").text("+"+level/100+"%");
	   }else{
		  $("#ok_coin>.coin"+coin+">.change24>a").addClass('text-green');
		  $("#ok_coin>.coin"+coin+">.change24>a").text(level/100+"%"); 
		   }
	 })
	$.getJSON('/Okcoin/get_ticker',{symbol:symbol}, function(c) {
	  /*0buy1high2last3low4sell5vol*/
	  $("#ok_coin>.coin"+coin+">.new_price>a").removeClass();
	  if(window.level>0){
		  $("#ok_coin>.coin"+coin+">.new_price>a").text(c[2]+"CNY↑");
		  $("#ok_coin>.coin"+coin+">.new_price>a").addClass('text-red'); 
		  }else{
		  $("#ok_coin>.coin"+coin+">.new_price>a").addClass('text-green');
		  $("#ok_coin>.coin"+coin+">.new_price>a").text(c[2]+"CNY↓");
		  }
	  $("#ok_coin>.coin"+coin+">.num24>a").text(c[5]);
	  $("#ok_coin>.coin"+coin+">.money24>a").text((c[5]*c[2]).toFixed(2)+" CNY");
		})
	});
	},
	poloCoin: function() {
	//---Poloniex	
	var self=this;
	$.get(_barr['jsons']+'?call=get_polo_ticker', function(c) {
	if (c=='' || typeof(c)=="undefined" || c==0){ 
	return false;
	}
	$("#polo_coin>.coin_num").each(function(){
		var mark=$(this).data('mark');
		var level=c[mark]['percentChange'];
	  $(this).find(".change24>a").removeClass();
	  $(this).find(".new_price>a").removeClass();
	  $(this).find(".num24>a").text(c[mark]['quoteVolume']);
	  $(this).find(".money24>a").text(c[mark]['total']+" CNY");
	  if(level>0){
	  $(this).find(".change24>a").addClass('text-red');
	  $(this).find(".new_price>a").addClass('text-red');
	  $(this).find(".change24>a").text("+"+level+"%");
	  $(this).find(".new_price>a").text(c[mark]['last']+"CNY↑");
	   }else{
		 $(this).find(".change24>a").addClass('text-green');
		 $(this).find(".new_price>a").addClass('text-green'); 
		 $(this).find(".change24>a").text(level+"%");  
		 $(this).find(".new_price>a").text(c[mark]['last']+"CNY↓");
		   }
	   
		 });
		
	});
	},
	wan: function(num){
		var amount=parseInt(num);	
		if(amount>10000){
			return amount=parseInt(amount/100)/100+"万";
		}else{
			return amount;
			}	
	},
	getCoinMarket:function(){
		$.post(_barr.currency_list,{k:1},function(result){
			if(result==null){
				window.location.reload();
				}
			Handlebars.registerHelper("check",function(index){
                    if (index == null) { return "0.00"; }else{
						return index;}
			});
			 Handlebars.registerHelper("pstatus",function(index){
                    if (index == 1) { return "↑";}else{ return "↓"; }
			});
			 Handlebars.registerHelper("ctype",function(index){
                    if (index >=0||index==null) { 
					return "text-red";
					}else{
					return "text-green";
					}
			});
			Handlebars.registerHelper("tcss",function(index){
                    if (index ==1) { 
					return "text-red";
					}else{
					return "text-green";
					}
			});
			Handlebars.registerHelper("cstatus",function(index){
                    if (index >=0||index==null) { 
					return "+";
					}
			});
			Handlebars.registerHelper("qu",function(index){
				var cur=$('.selectTag').data('qu').replace('qu','');
				if (parseInt(cur) == index) { 
					return "qu"+index;
					}else{
					return "hide qu"+index;	
						}
                    
			});
        	$('#market').html(myTemplate(result));
		})
		}
}
new tradeDetailed; 

});