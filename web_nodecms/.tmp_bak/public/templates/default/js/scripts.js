$(document).ready(function() {



// Slider  	
	if (jQuery().flexslider) {
	   $('.flexslider').flexslider({
			smoothHeight: true, 
			controlNav: false,           
			directionNav: true,  
			prevText: "&larr;",
			nextText: "&rarr;",
			selector: ".slides > .slide"
	    });
	};
    
    
    
// Smooth scrolling - css-tricks.com
	function filterPath(string){return string.replace(/^\//,'').replace(/(index|default).[a-zA-Z]{3,4}$/,'').replace(/\/$/,'');}var locationPath=filterPath(location.pathname);var scrollElem=scrollableElement('html','body');$('a[href*=#nav]').each(function(){var thisPath=filterPath(this.pathname)||locationPath;if(locationPath==thisPath&&(location.hostname==this.hostname||!this.hostname)&&this.hash.replace(/#/,'')){var $target=$(this.hash),target=this.hash;if(target){var targetOffset=$target.offset().top;$(this).click(function(event){event.preventDefault();$(scrollElem).animate({scrollTop:targetOffset},'slow',function(){location.hash=target;});});}}});function scrollableElement(els){for(var i=0,argLength=arguments.length;i<argLength;i++){var el=arguments[i],$scrollElement=$(el);if($scrollElement.scrollTop()>0){return el;}else{$scrollElement.scrollTop(1);var isScrollable=$scrollElement.scrollTop()>0;$scrollElement.scrollTop(0);if(isScrollable){return el;}}}return[];}



// TOGGLES
	$('.toggle-view li').click(function () {
	    var text = $(this).children('.toggle');
	    
	    if (text.is(':hidden')) {
	        text.slideDown('fast');
	        $(this).children('.toggle-title').addClass('tactive');      
	    } else {
	        text.slideUp('fast');
	        $(this).children('.toggle-title').removeClass('tactive');       
	    }       
	});
	
	
		
//TABS
	var tabContents = $(".tab_content").hide(), 
	    tabs = $("ul.tabs li");
	
	tabs.first().addClass("active").show();
	tabContents.first().show();
	
	tabs.click(function() {
	    var $this = $(this), 
	        activeTab = $this.find('a').attr('href');
	    
	    if(!$this.hasClass('active')){
	        $this.addClass('active').siblings().removeClass('active');
	        tabContents.hide().filter(activeTab).fadeIn();
	    }
	    return false;
	});	
	
	
	
// OPACITY
	$(".zoom").css({"opacity":0});
	$(".zoom").hover(
		function(){$(this).stop().animate({ "opacity": 0.9 }, 'slow');
		$(this).siblings('img').stop().animate({ "opacity": 0.7 }, 'fast');},
		
		function(){$(this).stop().animate({ "opacity": 0 }, 'fast');
		$(this).siblings('img').stop().animate({ "opacity": 1 }, 'fast');});



// PORTFOLIO sorting	
	// NAV 
	$('.works-page aside menu a').click(function(){
		$(this).addClass("buttonactive").siblings().removeClass("buttonactive")
	});
	// SELECTION
	$("#work_1").click(function() {
	  $(".works figure").not(".work_1").stop().fadeTo("normal",0.1);
	  $(".work_1").stop().fadeTo("normal",1);
	});
	
	$("#work_2").click(function() {
	  $(".works figure").not(".work_2").stop().fadeTo("normal",0.1);
	  $(".work_2").stop().fadeTo("normal",1);
	});
	
	$("#work_3").click(function() {
	  $(".works figure").not(".work_3").stop().fadeTo("normal",0.1);
	  $(".work_3").stop().fadeTo("normal",1);
	});
	
	$("#work_all").click(function() {
	  $(".works figure").stop().fadeTo("normal",1);
	});


	
// CONTACT form validation 	
	if (jQuery().validate) {
	    	$("#contact_form").validate();	 
	};   
	
	
	
// END
});