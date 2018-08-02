$(document).ready(function(){
	$('.nav_right').find('li').hover(function(){
		$(this).find('p').slideDown('fast');
	},function(){
		$(this).find('p').slideUp('fast');
	});	
	
	$('.c_icon').click(function(){
		$(this).parent().next('dd').toggle();
		$(this).toggleClass('j');
	});
	
	$('#key').click(function(){			 	
		$(this).attr('value','');	
	});
});