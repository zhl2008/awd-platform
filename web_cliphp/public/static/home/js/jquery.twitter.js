/*!
 * jQuery Twitter Search Plugin
 * Examples and documentation at: http://jquery.malsup.com/twitter/
 * Copyright (c) 2010 M. Alsup
 * Version: 1.04 (15-SEP-2011)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.3.2 or later
 */
 
;(function($) {
	$.fn.twitterSearch = function(options) {
		if (typeof options == 'string')
			options = { term: options };
		return this.each(function() {
			var grabFlag = false,
				grabbing = false,
				$frame = $(this), text, $text, $title, $bird, $cont, height, paused = false,
				opts = $.extend(true, {}, $.fn.twitterSearch.defaults, options || {}, $.metadata ? $frame.metadata() : {});
				
			opts.formatter = opts.formatter || $.fn.twitterSearch.formatter; 
			opts.filter = opts.filter || $.fn.twitterSearch.filter;
			
			if (!opts.applyStyles) { // throw away all style defs
				for (var css in opts.css)
					opts.css[css] = {};
			}
			
			if (opts.title === null) // user can set to '' to suppress title
				opts.title = opts.term;

			opts.title = opts.title || '';
			text = opts.titleLink ? ('<a href="'+ opts.titleLink +'">'+ opts.title + '</a>') : ('<span>' + opts.title + '</span>');
			$text = $(text);
			if (opts.titleLink)
				$text.css(opts.css['titleLink']);
			$title = $('<div class="twitterSearchTitle"></div>').append($text).appendTo($frame).css(opts.css['title']);
			if (opts.bird) {
				$bird = $('<img class="twitterSearchBird" src="'+opts.birdSrc+'" />').appendTo($title).css(opts.css['bird']);
				if (opts.birdLink)
					$bird.wrap('<a href="'+ opts.birdLink +'"></a>');
			}
			$cont = $('<div class="twitterSearchContainter"></div>').appendTo($frame).css(opts.css['container']);
			cont = $cont[0];
			if (opts.colorExterior)
				$title.css('background-color',opts.colorExterior);
			if (opts.colorInterior)
				$cont.css('background-color',opts.colorInterior);
			
			$frame.css(opts.css['frame']);
			if (opts.colorExterior)
				$frame.css('border-color',opts.colorExterior);
			
			height = $frame.innerHeight() - $title.outerHeight();
			$cont.height(height);
			
			if (opts.pause)
				$cont.hover(function(){paused = true;},function(){paused = false;});
			
			$('<div class="twitterSearchLoading">Loading tweets..</div>').css(opts.css['loading']).appendTo($cont);
			
			grabTweets();
			
			function grabTweets() {
				var url = opts.url + opts.term;
				grabFlag = false;
				grabbing = true;
				// grab twitter stream
				$.getJSONP({
					url: url,
					timeout: 30000,
					error: function(xhr, status, e) {
						failWhale(e);
					},
					complete: function() {
						grabbing = false;
						if (opts.refreshSeconds)
							setTimeout(regrab, opts.refreshSeconds * 1000);
					},
					success: function(json) {
						if (json.error) {
							failWhale(json.error);
							return;
						}
						$cont.fadeOut('fast',function() {
							$cont.empty();
							
							// iterate twitter results 
							$.each(json.results, function(i) {
								if (!opts.filter.call(opts, this))
									return; // skip this tweet
								var $img, $text, w,
									tweet = opts.formatter(this, opts), 
									$tweet = $(tweet);
								$tweet.css(opts.css['tweet']);
								$img = $tweet.find('.twitterSearchProfileImg').css(opts.css['img']);
								$tweet.find('.twitterSearchUser').css(opts.css['user']);
								$tweet.find('.twitterSearchTime').css(opts.css['time']);
								$tweet.find('a').css(opts.css['a']);
								$tweet.appendTo($cont);
								$text = $tweet.find('.twitterSearchText').css(opts.css['text']);
								if (opts.avatar) {
									w = $img.outerWidth() + parseInt($tweet.css('paddingLeft'));
									$text.css('paddingLeft', w);
								}
							});
							
							$cont.fadeIn('fast');
						
							if (json.results.length < 2) {
								if (opts.refreshSeconds)
									setTimeout(grabTweets, opts.refreshSeconds * 1000);
								return;
							}

							// stage first animation
							setTimeout(go, opts.timeout);
						});
					}
				});
			};
			
			function regrab() {
				grabFlag = true;
			}
			
			function failWhale(msg) {
				var $fail = $('<div class="twitterSearchFail">' + msg + '</div>').css(opts.css['fail']);
				$cont.empty().append($fail);
			};
			
			function go() {
				if (paused || grabbing) {
					setTimeout(go, 500);
					return;
				}
				var h, $el = $cont.children(':first'), el = $el[0];
				$el.animate(opts.animOut, opts.animOutSpeed, function() {
					h = $el.outerHeight();
					$el.animate({ marginTop: -h }, opts.animInSpeed, function() {
						$el.css({ marginTop: 0,	opacity: 1 });
						/*@cc_on
						try { el.style.removeAttribute('filter'); } // ie cleartype fix
						catch(smother) {}
						@*/
						$el.css(opts.css['tweet']).show().appendTo($cont);
						
						setTimeout(grabFlag ? grabTweets : go, opts.timeout);					
					});
				});
			}
		});
	};
	
	$.fn.twitterSearch.filter = function(tweet) {
		return true;
	};

	$.fn.twitterSearch.formatter = function(json, opts) {
		var str, pretty,
			text = json.text;
		if (opts.anchors) {
			text = json.text.replace(/(http:\/\/\S+)/g, '<a href="$1">$1</a>');
			text = text.replace(/\@(\w+)/g, '<a href="http://twitter.com/$1">@$1</a>');
		}
		str = '<div class="twitterSearchTweet">';
		if (opts.avatar)
			str += '<img class="twitterSearchProfileImg" src="' + json.profile_image_url + '" />';
		str += '<div><span class="twitterSearchUser"><a href="http://www.twitter.com/'+ json.from_user+'/status/'+ json.id_str +'">' 
		  + json.from_user + '</a></span>';
		pretty = prettyDate(json.created_at);
		if (opts.time && pretty)
			str += ' <span class="twitterSearchTime">('+ pretty +')</span>'
		 str += '<div class="twitterSearchText">' + text + '</div></div></div>';
		 return str;
	};
	
	$.fn.twitterSearch.defaults = {
		url: 'http://search.twitter.com/search.json?callback=?&q=',
		anchors: true,				// true or false (enable embedded links in tweets)
		animOutSpeed: 500,			// speed of animation for top tweet when removed
		animInSpeed: 500,			// speed of scroll animation for moving tweets up
		animOut: { opacity: 0 },	// animation of top tweet when it is removed
		applyStyles: true,			// true or false (apply default css styling or not)
		avatar: true,				// true or false (show or hide twitter profile images)
		bird: true,					// true or false (show or hide twitter bird image)
		birdLink: false,			// url that twitter bird image should like to
		birdSrc: 'http://cloud.github.com/downloads/malsup/twitter/tweet.gif', // twitter bird image
		colorExterior: null,        // css override of frame border-color and title background-color
		colorInterior: null,        // css override of container background-color
		filter: null,               // callback fn to filter tweets:  fn(tweetJson) { /* return false to skip tweet */ }
		formatter: null,			// callback fn to build tweet markup
		pause: false,				// true or false (pause on hover)
		refreshSeconds: 0,          // number of seconds to wait before polling for newer tweets
		term: '',					// twitter search term
		time: true,					// true or false (show or hide the time that the tweet was sent)
		timeout: 4000,				// delay betweet tweet scroll
		title: null,				// title text to display when frame option is true (default = 'term' text)
		titleLink: null,			// url for title link
		css: {
			// default styling
			a:     { textDecoration: 'none', color: '#3B5998' },
			bird:  { width: '50px', height: '20px', position: 'absolute', left: '-30px', top: '-20px', border: 'none' },
			container: { overflow: 'hidden', backgroundColor: '#eee', height: '100%' },
			fail:  { background: '#6cc5c3 url(http://cloud.github.com/downloads/malsup/twitter/failwhale.png) no-repeat 50% 50%', height: '100%', padding: '10px' },
			frame: { border: '10px solid #C2CFF1', borderRadius: '10px', '-moz-border-radius': '10px', '-webkit-border-radius': '10px' },
			tweet: { padding: '5px 10px', clear: 'left' },
			img:   { 'float': 'left', margin: '5px', width: '48px', height: '48px' },
			loading: { padding: '20px', textAlign: 'center', color: '#888' },
			text:  {},
			time:  { fontSize: 'smaller', color: '#888' },
			title: { backgroundColor: '#C2CFF1', margin: 0, padding: '0 0 5px 0', textAlign: 'center', fontWeight: 'bold', fontSize: 'large', position: 'relative' },
			titleLink: { textDecoration: 'none', color: '#3B5998' },
			user:  { fontWeight: 'bold' }
		}
	};

    // fn to handle jsonp with timeouts and errors
    // hat tip to Ricardo Tomasi for the timeout logic
    $.getJSONP = function(s) {
        s.dataType = 'jsonp';
        $.ajax(s);

        // figure out what the callback fn is
        var $script = $(document.getElementsByTagName('head')[0].firstChild);
        var url = $script.attr('src') || '';
        var cb = (url.match(/callback=(\w+)/)||[])[1];
        if (!cb)
            return; // bail
        var t = 0, cbFn = window[cb];

        $script[0].onerror = function(e) {
            $script.remove();
            handleError(s, {}, "error", e);
            clearTimeout(t);
        };

        if (!s.timeout)
            return;

        window[cb] = function(json) {
            clearTimeout(t);
            cbFn(json);
            cbFn = null;
        };

        t = setTimeout(function() {
            $script.remove();
            handleError(s, {}, "timeout");
            if (cbFn)
                window[cb] = function(){};
        }, s.timeout);
        
        function handleError(s, xhr, msg, e) {
			s.error && s.error.call(s.context, xhr, msg, e);
			s.global && $.event.trigger("ajaxError", [xhr, s, e || msg]);
			s.complete && s.complete.call(s.context, xhr, e || msg);
        }
    };
	
	/*
	 * JavaScript Pretty Date
	 * Copyright (c) 2008 John Resig (jquery.com)
	 * Licensed under the MIT license.
	 */
	// converts ISO time to casual time
	function prettyDate(time){
		var date = new Date((time || "").replace(/-/g,"/").replace(/TZ/g," ")),
			diff = (((new Date()).getTime() - date.getTime()) / 1000),
			day_diff = Math.floor(diff / 86400);
				
		if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
			return;
		var v = day_diff == 0 && (
				diff < 60 && "just now" ||
				diff < 120 && "1 minute ago" ||
				diff < 3600 && Math.floor( diff / 60 ) + " minutes ago" ||
				diff < 7200 && "1 hour ago" ||
				diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
			day_diff == 1 && "Yesterday" ||
			day_diff < 7 && day_diff + " days ago" ||
			day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
		if (!v)
			window.console && console.log(time);
		return v ? v : '';
	}

})(jQuery);