jQuery(document).ready(function($) {
	//Fade portfolio
	$(".fade").fadeTo(1, 1);
	$(".fade").hover(
	function () {$(this).fadeTo("fast", 0.45);},
	function () { $(this).fadeTo("slow", 1);}
	);	
	
	//Portfolio Filter Jquery
	$(window).load(function(){
	var $container = $('.pf-box-2col, .pf-box-3col, .pf-box-4col');
	$container.isotope({
		filter: '*',
		animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false,
		}
	});
	$('#pf-filter a').click(function(){
		var selector = $(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false,
			}
		});
	  return false;
	});

	var $optionSets = $('#pf-filter'),
	       $optionLinks = $optionSets.find('a');
	 
	       $optionLinks.click(function(){
	          var $this = $(this);
		  // don't proceed if already selected
		  if ( $this.hasClass('selected') ) {
		      return false;
		  }
	   var $optionSet = $this.parents('#pf-filter');
	   $optionSet.find('.selected').removeClass('selected');
	   $this.addClass('selected'); 
		});
	
	});	
	
	//Tab Jquery
	$(".tab_content").hide(); 
	$("ul.tabs li:first").addClass("active").show(); 
	$(".tab_content:first").show(); 
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active"); 
		$(".tab_content").hide(); 
		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
	});	
	
	//Twitter Jquery
	$("#twitter").twitterSearch({
		userName: "Indoneztheme",
		numTweets: 1,
		loaderText: "Loading tweets...",
		slideIn: true,
		slideDuration: 750
	});
	
	//Fancybox Jquery
	$(".fancybox").fancybox({
		padding: 0,
		openEffect : 'elastic',
		openSpeed  : 250,
		closeEffect : 'elastic',
		closeSpeed  : 250,
		closeClick : true,
		helpers : {
			overlay : {opacity : 0.65},
			media : {}
		}
	});	
	
	//TinyNav Jquery
	$('#menu').tinyNav({
	  active: 'selected'
	});	
	
	//Social Panel
	$(".trigger").click(function(){
		$(".social-panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	});
	

	
	//To top Jquery
	$().UItoTop({ easingType: 'easeOutQuart' });					
	
});	