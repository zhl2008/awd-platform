/**
* @author Alexander Farkas
* v. 1.22
*/
(function ($)
{
    if (!document.defaultView || !document.defaultView.getComputedStyle)
    { // IE6-IE8
        var oldCurCSS = $.curCSS;
        $.curCSS = function (elem, name, force)
        {
            if (name === 'background-position')
            {
                name = 'backgroundPosition';
            }
            if (name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[name])
            {
                return oldCurCSS.apply(this, arguments);
            }
            var style = elem.style;
            if (!force && style && style[name])
            {
                return style[name];
            }
            return oldCurCSS(elem, 'backgroundPositionX', force) + ' ' + oldCurCSS(elem, 'backgroundPositionY', force);
        };
    }

    var oldAnim = $.fn.animate;
    $.fn.animate = function (prop)
    {
        if ('background-position' in prop)
        {
            prop.backgroundPosition = prop['background-position'];
            delete prop['background-position'];
        }
        if ('backgroundPosition' in prop)
        {
            prop.backgroundPosition = '(' + prop.backgroundPosition;
        }
        return oldAnim.apply(this, arguments);
    };

    function toArray(strg)
    {
        strg = strg.replace(/left|top/g, '0px');
        strg = strg.replace(/right|bottom/g, '100%');
        strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g, "$1px$2");
        var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
        return [parseFloat(res[1], 10), res[2], parseFloat(res[3], 10), res[3]];
    }

    $.fx.step.backgroundPosition = function (fx)
    {
        if (!fx.bgPosReady)
        {
            var start = $.curCSS(fx.elem, 'backgroundPosition');
            if (!start)
            {//FF2 no inline-style fallback
                start = '0px 0px';
            }

            start = toArray(start);
            fx.start = [start[0], start[2]];
            var end = toArray(fx.end);
            fx.end = [end[0], end[2]];

            fx.unit = [end[1], end[3]];
            fx.bgPosReady = true;
        }
        //return;
        var nowPosX = [];
        nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
        nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];
        fx.elem.style.backgroundPosition = nowPosX[0] + ' ' + nowPosX[1];

    };
})(jQuery);



/*
tlrkSlider
  
  example usage:
 
    $("#slider").tlrkSlider({
      autoStart: false,
      elements: {
        "img": {delay: 10},
        "h2": {delay: 500},
        ".copy": {delay: 800},
        ".button": {delay: 1000}
      }
    });

  to go to a specific frame:
    $("#slider").tlrkSlider("go", position);
    "position" can have one of the following values:
    "next", "prev", "first", "last", "+1", "-1" or a numeric value
  
  to start/stop the automatic loop:
    $("#slider").tlrkSlider("start");
    $("#slider").tlrkSlider("stop");
  
  to change the delay between automatic transitions:
    $("#slider").tlrkSlider("option", "delayAnimation", 1000);
 
  to change any option:
    $("#slider").tlrkSlider("option", option_name, option_value);
    
  Changing the "elements" object is not tested.
  
  Changing the following options: "navigation", "navigationClass", "framesSelector", "autoStart" won't have any effect for now.
  They are used only during the initialization.
  
  $("#slider").data("tlrkSlider") will return the plugin instance and the methods/properties can be accessed from there.
  
  The plugin contructor defaults are accessable through TlrkSlider.defaults
  
  The function that actually sweep the elements in/out can be overriden from
    TlrkSlider.prototype._animationIn and TlrkSlider.prototype._animationOut
   
    See sweepIn/sweepOut 
  
 */



;(function( $, window, document, undefined ){
  
  // utility function that generates the "dots" navigation
  function generateNavigation($el, count, config) {
    var i, html = "",
        width = count * 24;
    
    html += "<ol class='" + config.navigationClass + "' style='margin-left: -" + width/2 + "px; width: " + width + "px'>";
    for (i = 0; i < count; i++) {
      html += "<li><a " + (i === 0 ? "class='selected'" : "" ) + " href='#" + (i) + "'>slide</a></li>";
    }
    html += "</ol>";
    
    $el.append(html);
  }
  
  function sweepOut($el, windowWidth) {
    var dfr = $.Deferred(),
        pos = $el.position(),
        width = $el.width(),
        delta, final,
        options = $el.data("tlrkAnimOptions");
    
    windowWidth = windowWidth || $(window).width(); // check if the windowWidth is passed, if not - get it
    
    delta = windowWidth - pos.left;
    final = -(delta);
    
    setTimeout(function(){
      $el.animate({left: final, opacity: "toggle"}, options.speed, options.easing, function(){
        dfr.resolve();
      });
    }, options.delay);
    
    return dfr.promise();
  }
  
  function sweepIn($el, windowWidth, frameLeft) {
    var dfr = $.Deferred(),
        options = $el.data("tlrkAnimOptions"),
        positionData = $el.data("tlrkOriginalPos"),
        final = positionData.position.left,
        rightEdge;
    
    windowWidth = windowWidth || $(window).width(); // check if the windowWidth is passed, if not - get it
    
    $el.css({opacity: 0, display: "block"}); // move it outside the right edge of the screen
    $el.css("left", function(current){
      return current + windowWidth - frameLeft;
    });
    
    setTimeout(function(){
      $el.animate({left: final, opacity: 1}, options.speed, options.easing, function(){
        dfr.resolve();
      });
    }, options.delay);
    
    return dfr.promise();
  }
  
  
  // two pass function that first iterates all the elements and gets their position/width/height
  // and then sets their position to absolute
  function absolutize($elements) {
    
    // todo - move it to separate function and do it just once
    // gather the original position/dimension data for all elements
    $elements.each(function(){
      var $t = $(this);
      
      if ($t.data("tlrkOriginalPos")) return
      
      $t.data("tlrkOriginalPos", {
        position: $t.position(),
        width: $t.width(),
        height: $t.height(),
        css_pos: $t.css("position"),
        css_left: $t.css("left"),
        css_top: $t.css("top"),
        css_width: $t.css("width") || "auto",
        css_height: $t.css("height") || "auto"
      });
      
    });
    
    // set the absolute position
    $elements.each(function(){
      var $t = $(this),
          opos = $t.data("tlrkOriginalPos");
         
      $t.css({
        position: "absolute",
        left: opos.position.left,
        top: opos.position.top,
        width: opos.width,
        height: opos.height
      });
    });
  }
  
  function restoreFrameElements($elements) {
    $elements.each(function(){
      var $t = $(this),
          opos = $t.data("tlrkOriginalPos");
          
      if (!opos) return
          
      $t.css({
        position: opos.css_pos,
        left: opos.css_left,
        top: opos.css_top,
        width: opos.css_width,
        height: opos.css_height
      });
    });
    
  }

  var TlrkSlider = function( elem, options ){
      this.elem = elem;
      this.$elem = $(elem);
      this.options = options;
    };

  // the plugin prototype
  TlrkSlider.prototype = {
    defaults: {


      defaultElementOptions: {
        speed: 1200,
        easing: "easeInOutBack",
        // interval before the element starts moving when the fadeIn/Out functions are called
        // it's a good idea to give different delays for the different elements
        // if all have the same delay they'll start moving all together
        delay: 100 
      },
      
      // dispose elements are these that are not included in the elements object
      // but affect the document flow and will be fadedIn/Out
      disposeDelay: 100, // delay for the dispose elements
      disposeSpeed: 1000, // how quickly they'll fadeOut/In
      
      delayBetweenTransition: 1000, // time between starting fadeOut and fadeIn
      delayAnimation: 7000, // time between auto changing the current frame
      
      loop: true, // if true when clicking next on the last frame the slider jumps to the first one
      
      autoStart: true, // start the automatic looping through the frames on init
      
      framesSelector: "section", // selector for the frames inside the slider
      
      elements: {
        "p": {delay: 100, speed: 1000, easing: "easeInOutBack"}
      },
      
      navigation: true, // the dots navigation on the bottom
      navigationClass: "slider-nav",
     
      // callbacks
      // another way to "catch" these events is with
      // $(-slider-element-).bind("animationStart")
      animationStart: null,
      animationEnd: null
    },

    init: function() {
      var c, e, element, $element,
          that = this,
          $firstFrame;
      
      c = this.config = $.extend({}, this.defaults, this.options);
      
      this.elem.style.position = "relative"; // make the wrapping element relative
      
      // basics
      this.$frames = this.$elem.find(c.framesSelector);
      this.framesCount = this.$frames.length;
      this.currentFrame = 0;
      this.queue = [];
      
      this._$elementsByFrame = {};
      this._$disposeElementsByFrame = {};
      
      for (i = 0; i < this.framesCount; i++) {
        this._$elementsByFrame[i] = this._getFrameElements(i); // cache the $elements by frame
        this._$disposeElementsByFrame[i] = this._getDisposeFrameElements(i); // cache the rest of the tree for each frame
      }
      
      if (c.navigation) {
        generateNavigation(this.$elem, this.framesCount, c);
        this.$navigation = this.$elem.find("."+c.navigationClass);
      }
      
      // bindings
      this.$elem.find(".slider-nav").delegate("a", "click", function(e){
        var frame = this.getAttribute("href").split("#")[1];
        that.go.call(that, frame);
        return false;
      });
      
      this.$elem // internal bindings for the callbacks
        .bind("animationStart", function(){
          if ($.isFunction(c.animationStart)) {c.animationStart.apply(that, arguments);}
        })
        .bind("animationEnd", function(){
          if ($.isFunction(c.animationEnd)) {c.animationEnd.apply(that, arguments);}
        })
      ;
      
      // start animation?
      if (c.autoStart) {
        this.start();
      } else {
        this.running = false;
      }

      return this;
    },
    
    start: function(instant) {
      var that = this;
      
      if (this.timer) { // we'll clear the current timer
        window.clearTimeout(this.timer);
      }
      
      this.running = true;
      
      if (instant) {
        that.nextFrame();
      } else {
        this.timer = window.setTimeout(function(){ that.nextFrame.call(that) }, that.config.delayAnimation);
      }
    },
    
    stop: function() {
      if (!this.running) return; // we are not running
      
      this.running = false;
      window.clearTimeout(this.timer);
    },

    // main function for changing frames
    selectFrame: function(frame, dfr) {
      var c = this.config, // shorthand for the config
          that = this,
          dfr = dfr || $.Deferred(),
          dFadeIn = $.Deferred(),
          dFadeOut = $.Deferred();
          
      if (isNaN(frame) || frame < 0 || frame > this.framesCount || frame === this.currentFrame) {
        dfr.reject();
        return dfr.promise();
      }

      // clear the animation loop interval if the animation is running
      if (this.running && this.timer) { 
        window.clearTimeout(this.timer);
      }

      // check if we are currenly running an animation.
      if (this.animated && this.queue.length > 0) {
        // wait for the last item in the queue to finish
        this.queue[this.queue.length-1].done(function(){
          that.selectFrame(frame, dfr); // and call again the selectFrame
        })
        return dfr.promise();
      }
      
      this.animated = true;
      this.$elem.trigger("animationStart", [this, frame]);
      
      this.queue.push(dfr);
      
      // fade the frames
      dFadeOut = this._fadeOutFrame(this.currentFrame);
      
      // hide the fadetout frame
      dFadeOut.done(function(){
        that.$frames.eq(that.currentFrame).hide();
      });
      
      window.setTimeout(function(){ // then wait delayBetweenTransition and fadeIn the new frame
        dFadeIn = that._fadeInFrame.call(that, frame).done(function(){
          // when both the fadeIn and fadeOut are done we'll resolve the selectFrame promise
          $.when(dFadeOut, dFadeIn).done(function(){
            that.animated = false;
            that.queue.shift();
            that.$elem.trigger("animationEnd", [that]);
            that.currentFrame = frame;
            dfr.resolve();
          });
        });
      }, c.delayBetweenTransition);
      
      // navigation html change
      if (this.config.navigation) {
        this.$navigation.find(".selected").removeClass("selected").end()
          .find("a").eq(frame).addClass("selected");
      }
        
      dfr.done(function(){ // we'll resume the loop animation after the transitions are done
        if (that.running) {
          that.start();
        }
      });
      
      return dfr.promise();
    },
    
    _fadeFrame: function(frame, callback, direction) {
      var dfr = $.Deferred(),
          $frame = this.$frames.eq(frame),
          $elements = this._$elementsByFrame[frame],
          windowWidth = $(window).width(), // cache it before the animations, so we don't have to check it for each element 
          i, len,
          that = this,
          elementAnimations = [],
          $disposeElements = this._$disposeElementsByFrame[frame],
          $affectedElements,
          frameLeft = $frame.offset().left;
          
      direction = direction || "out";
          
      if (!$.isFunction(callback)) return; // do nothing if there's no callback passed
      
      $affectedElements = $elements.add($disposeElements);
      
      // position absolute the animation and dispose elements
      absolutize($affectedElements);
      
      // toggle the dispose elements
      if ($disposeElements.length > 0) {
        window.setTimeout(function(){
          $disposeElements[direction === "out" ? "fadeOut" : "fadeIn"](that.config.disposeSpeed);
        }, this.config.disposeDelay);
      }
      
      // invoke the callback for each element
      // the callback must return a promise
      $elements.each(function(){
        elementAnimations.push( callback.call(that, $(this), windowWidth, frameLeft) );
      });
      
      // wait for all the elements to finish their animation
      $.when.apply(this, elementAnimations).done(function(){
        //restoreFrameElements($affectedElements); // and restore the elements' position
        dfr.resolve(); // resolve the fade function
      });
      
      return dfr.promise();
    },

    _fadeOutFrame: function(frame) {
      var dfr = $.Deferred(),
          $frame = this.$frames.eq(frame),
          $disposeElements = this._$disposeElementsByFrame[frame];
      
      this._fadeFrame(frame, this._animationOut, "out").done(function(){
        dfr.resolve();
      })
      
      return dfr.promise();
    },
    
    _fadeInFrame: function(frame) {
      var dfr = $.Deferred(),
          $frame = this.$frames.eq(frame),
          $elements = this._$elementsByFrame[frame];
      
      this._restoreFrame(frame);
      
      $frame.show();
      
      this._fadeFrame(frame, this._animationIn, "in").done(function(){
        dfr.resolve();
      });
      
      return dfr.promise();
    },
    
    _restoreFrame: function(frame){
      if (!frame) return
      restoreFrameElements( this._$elementsByFrame[frame].add(this._$disposeElementsByFrame[frame]) );
    },
    
    nextFrame: function() {
      var frame = this.currentFrame+1,
          dfr = $.Deferred();
          
      if (frame > this.framesCount-1) {
        if (this.config.loop) {
          frame = 0;
        } else {
          dfr.reject();
        }
      };
      
      this.selectFrame(frame).done(function(){
        dfr.resolve();
      });
      
      return dfr.promise();
    },
    
    prevFrame: function() {
      var frame = this.currentFrame-1,
          dfr = $.Deferred();
          
      if (frame < 0) {
        if (this.config.loop) {
          frame = this.framesCount-1;
        } else {
          dfr.reject();
          return dfr.promise();
        }
      }
      
      this.selectFrame(frame).done(function(){
        dfr.resolve();
      });
      
      return dfr.promise();
    },
    
    go: function(str) { // shorthand
      switch (str) {
        case "next":
        case "+1":
          this.nextFrame();
          break;

        case "prev":
        case "-1":
          this.prevFrame();
          break;
        
        case "first":
          this.selectFrame(0);
          break;
        
        case "last":
          this.selectFrame(this.framesCount-1);
          break;
        
        default:
          if (isNaN(str)) return;
          this.selectFrame(Number(str));
      }
    },
    
    // returns jquery collection of animation elements
    _getFrameElements: function(frame) { 
      var $frame = this.$frames.eq(frame),
          elements = this.config.elements,
          e, elementOptions,
          $found, $frameElements = $([]);
          
      for (e in elements) {
        elementOptions = elements[e];
        $found = $frame.find(e);
        $found.addClass("t-frame-element").data("tlrkAnimOptions", $.extend({}, this.defaults.defaultElementOptions, elementOptions ));
        $frameElements = $frameElements.add($found);
      }
      
      return $frameElements;
    },

    // returns jquery collection of elements that have to be faded out
    // i.e. elements on the same level as the animation elements
    // that doesn't contain other animation elements
    _getDisposeFrameElements: function(frame) {
      var $disposeElements = $([]),
          $frame = this.$frames.eq(frame),
          $elements = this._$elementsByFrame[frame];

      $elements.each(function(){
        var $t = $(this),
            $siblings = $t.siblings().not(".t-frame-element");
        
        $siblings.each(function(){
          var $t = $(this);
          // check if the node is not already marked and doesn't contains other frame elements
          if (!$t.hasClass("t-frame-dispose") && $t.find(".t-frame-element").length === 0) {
            $t.addClass("t-frame-dispose");
            $disposeElements = $disposeElements.add($t);
          }
        });
        
      });
      return $disposeElements;
    },
    
    
    // expose the internal animationIn/Out functions that are called for each element in the frame
    // two arguments are passed - the $element which have to be animated and the window width
    _animationIn: sweepIn,
    _animationOut: sweepOut
    
  }

  TlrkSlider.defaults = TlrkSlider.prototype.defaults;

  $.fn.tlrkSlider = function(options) {
    var otherArgs = Array.prototype.slice.call(arguments, 1);
        
    return this.each(function() {
      var $el = $(this),
          pluginData = $el.data("tlrkSlider");
      
      if (!pluginData) { // check if the slider is already attached
        pluginData = new TlrkSlider(this, options).init();
        $el.data("tlrkSlider", pluginData);
        return;
      }
      
      //change the options or call a method
      if (typeof options === "string") {
        
        // setting / getting option(s)
        if (options === "option") {
          
          if (typeof otherArgs[0] === "string" && typeof otherArgs[1] !== "undefined") { // set an option value
            pluginData.config[otherArgs[0]] = otherArgs[1]; 
          }
          
          if (typeof otherArgs[0] === "object") { // extend the config with new options
            pluginData.config = $.extend(pluginData.config, otherArgs[0]);
          }
          
        } else { // call a method?
          try {
            pluginData[options].apply(pluginData, otherArgs);
          } catch(ex) {
            throw "Error calling a plugin method (" + ex + ")";
          }
        }
      }
    });
  };

  window.TlrkSlider = TlrkSlider;

})( jQuery, window , document );