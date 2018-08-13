!function(e,t){function n(e){var t=ht[e]={};return K.each(e.split(tt),function(e,n){t[n]=!0}),t}function r(e,n,r){if(r===t&&1===e.nodeType){var i="data-"+n.replace(mt,"-$1").toLowerCase();if(r=e.getAttribute(i),"string"==typeof r){try{r="true"===r?!0:"false"===r?!1:"null"===r?null:+r+""===r?+r:gt.test(r)?K.parseJSON(r):r}catch(o){}K.data(e,n,r)}else r=t}return r}function i(e){var t;for(t in e)if(("data"!==t||!K.isEmptyObject(e[t]))&&"toJSON"!==t)return!1;return!0}function o(){return!1}function a(){return!0}function s(e){return!e||!e.parentNode||11===e.parentNode.nodeType}function u(e,t){do e=e[t];while(e&&1!==e.nodeType);return e}function l(e,t,n){if(t=t||0,K.isFunction(t))return K.grep(e,function(e,r){var i=!!t.call(e,r,e);return i===n});if(t.nodeType)return K.grep(e,function(e){return e===t===n});if("string"==typeof t){var r=K.grep(e,function(e){return 1===e.nodeType});if(Ot.test(t))return K.filter(t,r,!n);t=K.filter(t,r)}return K.grep(e,function(e){return K.inArray(e,t)>=0===n})}function c(e){var t=Rt.split("|"),n=e.createDocumentFragment();if(n.createElement)for(;t.length;)n.createElement(t.pop());return n}function f(e,t){return e.getElementsByTagName(t)[0]||e.appendChild(e.ownerDocument.createElement(t))}function p(e,t){if(1===t.nodeType&&K.hasData(e)){var n,r,i,o=K._data(e),a=K._data(t,o),s=o.events;if(s){delete a.handle,a.events={};for(n in s)for(r=0,i=s[n].length;i>r;r++)K.event.add(t,n,s[n][r])}a.data&&(a.data=K.extend({},a.data))}}function d(e,t){var n;1===t.nodeType&&(t.clearAttributes&&t.clearAttributes(),t.mergeAttributes&&t.mergeAttributes(e),n=t.nodeName.toLowerCase(),"object"===n?(t.parentNode&&(t.outerHTML=e.outerHTML),K.support.html5Clone&&e.innerHTML&&!K.trim(t.innerHTML)&&(t.innerHTML=e.innerHTML)):"input"===n&&Qt.test(e.type)?(t.defaultChecked=t.checked=e.checked,t.value!==e.value&&(t.value=e.value)):"option"===n?t.selected=e.defaultSelected:"input"===n||"textarea"===n?t.defaultValue=e.defaultValue:"script"===n&&t.text!==e.text&&(t.text=e.text),t.removeAttribute(K.expando))}function h(e){return"undefined"!=typeof e.getElementsByTagName?e.getElementsByTagName("*"):"undefined"!=typeof e.querySelectorAll?e.querySelectorAll("*"):[]}function g(e){Qt.test(e.type)&&(e.defaultChecked=e.checked)}function m(e,t){if(t in e)return t;for(var n=t.charAt(0).toUpperCase()+t.slice(1),r=t,i=vn.length;i--;)if(t=vn[i]+n,t in e)return t;return r}function y(e,t){return e=t||e,"none"===K.css(e,"display")||!K.contains(e.ownerDocument,e)}function v(e,t){for(var n,r,i=[],o=0,a=e.length;a>o;o++)n=e[o],n.style&&(i[o]=K._data(n,"olddisplay"),t?(!i[o]&&"none"===n.style.display&&(n.style.display=""),""===n.style.display&&y(n)&&(i[o]=K._data(n,"olddisplay",T(n.nodeName)))):(r=nn(n,"display"),!i[o]&&"none"!==r&&K._data(n,"olddisplay",r)));for(o=0;a>o;o++)n=e[o],n.style&&(t&&"none"!==n.style.display&&""!==n.style.display||(n.style.display=t?i[o]||"":"none"));return e}function b(e,t,n){var r=fn.exec(t);return r?Math.max(0,r[1]-(n||0))+(r[2]||"px"):t}function x(e,t,n,r){for(var i=n===(r?"border":"content")?4:"width"===t?1:0,o=0;4>i;i+=2)"margin"===n&&(o+=K.css(e,n+yn[i],!0)),r?("content"===n&&(o-=parseFloat(nn(e,"padding"+yn[i]))||0),"margin"!==n&&(o-=parseFloat(nn(e,"border"+yn[i]+"Width"))||0)):(o+=parseFloat(nn(e,"padding"+yn[i]))||0,"padding"!==n&&(o+=parseFloat(nn(e,"border"+yn[i]+"Width"))||0));return o}function w(e,t,n){var r="width"===t?e.offsetWidth:e.offsetHeight,i=!0,o=K.support.boxSizing&&"border-box"===K.css(e,"boxSizing");if(0>=r||null==r){if(r=nn(e,t),(0>r||null==r)&&(r=e.style[t]),pn.test(r))return r;i=o&&(K.support.boxSizingReliable||r===e.style[t]),r=parseFloat(r)||0}return r+x(e,t,n||(o?"border":"content"),i)+"px"}function T(e){if(hn[e])return hn[e];var t=K("<"+e+">").appendTo(W.body),n=t.css("display");return t.remove(),("none"===n||""===n)&&(rn=W.body.appendChild(rn||K.extend(W.createElement("iframe"),{frameBorder:0,width:0,height:0})),on&&rn.createElement||(on=(rn.contentWindow||rn.contentDocument).document,on.write("<!doctype html><html><body>"),on.close()),t=on.body.appendChild(on.createElement(e)),n=nn(t,"display"),W.body.removeChild(rn)),hn[e]=n,n}function N(e,t,n,r){var i;if(K.isArray(t))K.each(t,function(t,i){n||wn.test(e)?r(e,i):N(e+"["+("object"==typeof i?t:"")+"]",i,n,r)});else if(n||"object"!==K.type(t))r(e,t);else for(i in t)N(e+"["+i+"]",t[i],n,r)}function C(e){return function(t,n){"string"!=typeof t&&(n=t,t="*");var r,i,o,a=t.toLowerCase().split(tt),s=0,u=a.length;if(K.isFunction(n))for(;u>s;s++)r=a[s],o=/^\+/.test(r),o&&(r=r.substr(1)||"*"),i=e[r]=e[r]||[],i[o?"unshift":"push"](n)}}function k(e,n,r,i,o,a){o=o||n.dataTypes[0],a=a||{},a[o]=!0;for(var s,u=e[o],l=0,c=u?u.length:0,f=e===qn;c>l&&(f||!s);l++)s=u[l](n,r,i),"string"==typeof s&&(!f||a[s]?s=t:(n.dataTypes.unshift(s),s=k(e,n,r,i,s,a)));return(f||!s)&&!a["*"]&&(s=k(e,n,r,i,"*",a)),s}function E(e,n){var r,i,o=K.ajaxSettings.flatOptions||{};for(r in n)n[r]!==t&&((o[r]?e:i||(i={}))[r]=n[r]);i&&K.extend(!0,e,i)}function S(e,n,r){var i,o,a,s,u=e.contents,l=e.dataTypes,c=e.responseFields;for(o in c)o in r&&(n[c[o]]=r[o]);for(;"*"===l[0];)l.shift(),i===t&&(i=e.mimeType||n.getResponseHeader("content-type"));if(i)for(o in u)if(u[o]&&u[o].test(i)){l.unshift(o);break}if(l[0]in r)a=l[0];else{for(o in r){if(!l[0]||e.converters[o+" "+l[0]]){a=o;break}s||(s=o)}a=a||s}return a?(a!==l[0]&&l.unshift(a),r[a]):void 0}function j(e,t){var n,r,i,o,a=e.dataTypes.slice(),s=a[0],u={},l=0;if(e.dataFilter&&(t=e.dataFilter(t,e.dataType)),a[1])for(n in e.converters)u[n.toLowerCase()]=e.converters[n];for(;i=a[++l];)if("*"!==i){if("*"!==s&&s!==i){if(n=u[s+" "+i]||u["* "+i],!n)for(r in u)if(o=r.split(" "),o[1]===i&&(n=u[s+" "+o[0]]||u["* "+o[0]])){n===!0?n=u[r]:u[r]!==!0&&(i=o[0],a.splice(l--,0,i));break}if(n!==!0)if(n&&e["throws"])t=n(t);else try{t=n(t)}catch(c){return{state:"parsererror",error:n?c:"No conversion from "+s+" to "+i}}}s=i}return{state:"success",data:t}}function A(){try{return new e.XMLHttpRequest}catch(t){}}function D(){try{return new e.ActiveXObject("Microsoft.XMLHTTP")}catch(t){}}function L(){return setTimeout(function(){Jn=t},0),Jn=K.now()}function H(e,t){K.each(t,function(t,n){for(var r=(er[t]||[]).concat(er["*"]),i=0,o=r.length;o>i;i++)if(r[i].call(e,t,n))return})}function M(e,t,n){var r,i=0,o=Zn.length,a=K.Deferred().always(function(){delete s.elem}),s=function(){for(var t=Jn||L(),n=Math.max(0,u.startTime+u.duration-t),r=1-(n/u.duration||0),i=0,o=u.tweens.length;o>i;i++)u.tweens[i].run(r);return a.notifyWith(e,[u,r,n]),1>r&&o?n:(a.resolveWith(e,[u]),!1)},u=a.promise({elem:e,props:K.extend({},t),opts:K.extend(!0,{specialEasing:{}},n),originalProperties:t,originalOptions:n,startTime:Jn||L(),duration:n.duration,tweens:[],createTween:function(t,n){var r=K.Tween(e,u.opts,t,n,u.opts.specialEasing[t]||u.opts.easing);return u.tweens.push(r),r},stop:function(t){for(var n=0,r=t?u.tweens.length:0;r>n;n++)u.tweens[n].run(1);return t?a.resolveWith(e,[u,t]):a.rejectWith(e,[u,t]),this}}),l=u.props;for(_(l,u.opts.specialEasing);o>i;i++)if(r=Zn[i].call(u,e,l,u.opts))return r;return H(u,l),K.isFunction(u.opts.start)&&u.opts.start.call(e,u),K.fx.timer(K.extend(s,{anim:u,queue:u.opts.queue,elem:e})),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)}function _(e,t){var n,r,i,o,a;for(n in e)if(r=K.camelCase(n),i=t[r],o=e[n],K.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),a=K.cssHooks[r],a&&"expand"in a){o=a.expand(o),delete e[r];for(n in o)n in e||(e[n]=o[n],t[n]=i)}else t[r]=i}function F(e,t,n){var r,i,o,a,s,u,l,c,f=this,p=e.style,d={},h=[],g=e.nodeType&&y(e);n.queue||(l=K._queueHooks(e,"fx"),null==l.unqueued&&(l.unqueued=0,c=l.empty.fire,l.empty.fire=function(){l.unqueued||c()}),l.unqueued++,f.always(function(){f.always(function(){l.unqueued--,K.queue(e,"fx").length||l.empty.fire()})})),1===e.nodeType&&("height"in t||"width"in t)&&(n.overflow=[p.overflow,p.overflowX,p.overflowY],"inline"===K.css(e,"display")&&"none"===K.css(e,"float")&&(K.support.inlineBlockNeedsLayout&&"inline"!==T(e.nodeName)?p.zoom=1:p.display="inline-block")),n.overflow&&(p.overflow="hidden",K.support.shrinkWrapBlocks||f.done(function(){p.overflow=n.overflow[0],p.overflowX=n.overflow[1],p.overflowY=n.overflow[2]}));for(r in t)if(o=t[r],Vn.exec(o)){if(delete t[r],o===(g?"hide":"show"))continue;h.push(r)}if(a=h.length)for(s=K._data(e,"fxshow")||K._data(e,"fxshow",{}),g?K(e).show():f.done(function(){K(e).hide()}),f.done(function(){var t;K.removeData(e,"fxshow",!0);for(t in d)K.style(e,t,d[t])}),r=0;a>r;r++)i=h[r],u=f.createTween(i,g?s[i]:0),d[i]=s[i]||K.style(e,i),i in s||(s[i]=u.start,g&&(u.end=u.start,u.start="width"===i||"height"===i?1:0))}function O(e,t,n,r,i){return new O.prototype.init(e,t,n,r,i)}function q(e,t){var n,r={height:e},i=0;for(t=t?1:0;4>i;i+=2-t)n=yn[i],r["margin"+n]=r["padding"+n]=e;return t&&(r.opacity=r.width=e),r}function B(e){return K.isWindow(e)?e:9===e.nodeType?e.defaultView||e.parentWindow:!1}var R,P,W=e.document,I=e.location,$=e.navigator,z=e.jQuery,X=e.$,U=Array.prototype.push,Y=Array.prototype.slice,J=Array.prototype.indexOf,Q=Object.prototype.toString,V=Object.prototype.hasOwnProperty,G=String.prototype.trim,K=function(e,t){return new K.fn.init(e,t,R)},Z=/[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,et=/\S/,tt=/\s+/,nt=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,rt=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,it=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,ot=/^[\],:{}\s]*$/,at=/(?:^|:|,)(?:\s*\[)+/g,st=/\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,ut=/"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,lt=/^-ms-/,ct=/-([\da-z])/gi,ft=function(e,t){return(t+"").toUpperCase()},pt=function(){W.addEventListener?(W.removeEventListener("DOMContentLoaded",pt,!1),K.ready()):"complete"===W.readyState&&(W.detachEvent("onreadystatechange",pt),K.ready())},dt={};K.fn=K.prototype={constructor:K,init:function(e,n,r){var i,o,a;if(!e)return this;if(e.nodeType)return this.context=this[0]=e,this.length=1,this;if("string"==typeof e){if(i="<"===e.charAt(0)&&">"===e.charAt(e.length-1)&&e.length>=3?[null,e,null]:rt.exec(e),i&&(i[1]||!n)){if(i[1])return n=n instanceof K?n[0]:n,a=n&&n.nodeType?n.ownerDocument||n:W,e=K.parseHTML(i[1],a,!0),it.test(i[1])&&K.isPlainObject(n)&&this.attr.call(e,n,!0),K.merge(this,e);if(o=W.getElementById(i[2]),o&&o.parentNode){if(o.id!==i[2])return r.find(e);this.length=1,this[0]=o}return this.context=W,this.selector=e,this}return!n||n.jquery?(n||r).find(e):this.constructor(n).find(e)}return K.isFunction(e)?r.ready(e):(e.selector!==t&&(this.selector=e.selector,this.context=e.context),K.makeArray(e,this))},selector:"",jquery:"1.8.1",length:0,size:function(){return this.length},toArray:function(){return Y.call(this)},get:function(e){return null==e?this.toArray():0>e?this[this.length+e]:this[e]},pushStack:function(e,t,n){var r=K.merge(this.constructor(),e);return r.prevObject=this,r.context=this.context,"find"===t?r.selector=this.selector+(this.selector?" ":"")+n:t&&(r.selector=this.selector+"."+t+"("+n+")"),r},each:function(e,t){return K.each(this,e,t)},ready:function(e){return K.ready.promise().done(e),this},eq:function(e){return e=+e,-1===e?this.slice(e):this.slice(e,e+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(Y.apply(this,arguments),"slice",Y.call(arguments).join(","))},map:function(e){return this.pushStack(K.map(this,function(t,n){return e.call(t,n,t)}))},end:function(){return this.prevObject||this.constructor(null)},push:U,sort:[].sort,splice:[].splice},K.fn.init.prototype=K.fn,K.extend=K.fn.extend=function(){var e,n,r,i,o,a,s=arguments[0]||{},u=1,l=arguments.length,c=!1;for("boolean"==typeof s&&(c=s,s=arguments[1]||{},u=2),"object"!=typeof s&&!K.isFunction(s)&&(s={}),l===u&&(s=this,--u);l>u;u++)if(null!=(e=arguments[u]))for(n in e)r=s[n],i=e[n],s!==i&&(c&&i&&(K.isPlainObject(i)||(o=K.isArray(i)))?(o?(o=!1,a=r&&K.isArray(r)?r:[]):a=r&&K.isPlainObject(r)?r:{},s[n]=K.extend(c,a,i)):i!==t&&(s[n]=i));return s},K.extend({noConflict:function(t){return e.$===K&&(e.$=X),t&&e.jQuery===K&&(e.jQuery=z),K},isReady:!1,readyWait:1,holdReady:function(e){e?K.readyWait++:K.ready(!0)},ready:function(e){if(e===!0?!--K.readyWait:!K.isReady){if(!W.body)return setTimeout(K.ready,1);K.isReady=!0,e!==!0&&--K.readyWait>0||(P.resolveWith(W,[K]),K.fn.trigger&&K(W).trigger("ready").off("ready"))}},isFunction:function(e){return"function"===K.type(e)},isArray:Array.isArray||function(e){return"array"===K.type(e)},isWindow:function(e){return null!=e&&e==e.window},isNumeric:function(e){return!isNaN(parseFloat(e))&&isFinite(e)},type:function(e){return null==e?String(e):dt[Q.call(e)]||"object"},isPlainObject:function(e){if(!e||"object"!==K.type(e)||e.nodeType||K.isWindow(e))return!1;try{if(e.constructor&&!V.call(e,"constructor")&&!V.call(e.constructor.prototype,"isPrototypeOf"))return!1}catch(n){return!1}var r;for(r in e);return r===t||V.call(e,r)},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},error:function(e){throw new Error(e)},parseHTML:function(e,t,n){var r;return e&&"string"==typeof e?("boolean"==typeof t&&(n=t,t=0),t=t||W,(r=it.exec(e))?[t.createElement(r[1])]:(r=K.buildFragment([e],t,n?null:[]),K.merge([],(r.cacheable?K.clone(r.fragment):r.fragment).childNodes))):null},parseJSON:function(t){return t&&"string"==typeof t?(t=K.trim(t),e.JSON&&e.JSON.parse?e.JSON.parse(t):ot.test(t.replace(st,"@").replace(ut,"]").replace(at,""))?new Function("return "+t)():(K.error("Invalid JSON: "+t),void 0)):null},parseXML:function(n){var r,i;if(!n||"string"!=typeof n)return null;try{e.DOMParser?(i=new DOMParser,r=i.parseFromString(n,"text/xml")):(r=new ActiveXObject("Microsoft.XMLDOM"),r.async="false",r.loadXML(n))}catch(o){r=t}return(!r||!r.documentElement||r.getElementsByTagName("parsererror").length)&&K.error("Invalid XML: "+n),r},noop:function(){},globalEval:function(t){t&&et.test(t)&&(e.execScript||function(t){e.eval.call(e,t)})(t)},camelCase:function(e){return e.replace(lt,"ms-").replace(ct,ft)},nodeName:function(e,t){return e.nodeName&&e.nodeName.toUpperCase()===t.toUpperCase()},each:function(e,n,r){var i,o=0,a=e.length,s=a===t||K.isFunction(e);if(r)if(s){for(i in e)if(n.apply(e[i],r)===!1)break}else for(;a>o&&n.apply(e[o++],r)!==!1;);else if(s){for(i in e)if(n.call(e[i],i,e[i])===!1)break}else for(;a>o&&n.call(e[o],o,e[o++])!==!1;);return e},trim:G&&!G.call(" ")?function(e){return null==e?"":G.call(e)}:function(e){return null==e?"":e.toString().replace(nt,"")},makeArray:function(e,t){var n,r=t||[];return null!=e&&(n=K.type(e),null==e.length||"string"===n||"function"===n||"regexp"===n||K.isWindow(e)?U.call(r,e):K.merge(r,e)),r},inArray:function(e,t,n){var r;if(t){if(J)return J.call(t,e,n);for(r=t.length,n=n?0>n?Math.max(0,r+n):n:0;r>n;n++)if(n in t&&t[n]===e)return n}return-1},merge:function(e,n){var r=n.length,i=e.length,o=0;if("number"==typeof r)for(;r>o;o++)e[i++]=n[o];else for(;n[o]!==t;)e[i++]=n[o++];return e.length=i,e},grep:function(e,t,n){var r,i=[],o=0,a=e.length;for(n=!!n;a>o;o++)r=!!t(e[o],o),n!==r&&i.push(e[o]);return i},map:function(e,n,r){var i,o,a=[],s=0,u=e.length,l=e instanceof K||u!==t&&"number"==typeof u&&(u>0&&e[0]&&e[u-1]||0===u||K.isArray(e));if(l)for(;u>s;s++)i=n(e[s],s,r),null!=i&&(a[a.length]=i);else for(o in e)i=n(e[o],o,r),null!=i&&(a[a.length]=i);return a.concat.apply([],a)},guid:1,proxy:function(e,n){var r,i,o;return"string"==typeof n&&(r=e[n],n=e,e=r),K.isFunction(e)?(i=Y.call(arguments,2),o=function(){return e.apply(n,i.concat(Y.call(arguments)))},o.guid=e.guid=e.guid||o.guid||K.guid++,o):t},access:function(e,n,r,i,o,a,s){var u,l=null==r,c=0,f=e.length;if(r&&"object"==typeof r){for(c in r)K.access(e,n,c,r[c],1,a,i);o=1}else if(i!==t){if(u=s===t&&K.isFunction(i),l&&(u?(u=n,n=function(e,t,n){return u.call(K(e),n)}):(n.call(e,i),n=null)),n)for(;f>c;c++)n(e[c],r,u?i.call(e[c],c,n(e[c],r)):i,s);o=1}return o?e:l?n.call(e):f?n(e[0],r):a},now:function(){return(new Date).getTime()}}),K.ready.promise=function(t){if(!P)if(P=K.Deferred(),"complete"===W.readyState)setTimeout(K.ready,1);else if(W.addEventListener)W.addEventListener("DOMContentLoaded",pt,!1),e.addEventListener("load",K.ready,!1);else{W.attachEvent("onreadystatechange",pt),e.attachEvent("onload",K.ready);var n=!1;try{n=null==e.frameElement&&W.documentElement}catch(r){}n&&n.doScroll&&function i(){if(!K.isReady){try{n.doScroll("left")}catch(e){return setTimeout(i,50)}K.ready()}}()}return P.promise(t)},K.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(e,t){dt["[object "+t+"]"]=t.toLowerCase()}),R=K(W);var ht={};K.Callbacks=function(e){e="string"==typeof e?ht[e]||n(e):K.extend({},e);var r,i,o,a,s,u,l=[],c=!e.once&&[],f=function(t){for(r=e.memory&&t,i=!0,u=a||0,a=0,s=l.length,o=!0;l&&s>u;u++)if(l[u].apply(t[0],t[1])===!1&&e.stopOnFalse){r=!1;break}o=!1,l&&(c?c.length&&f(c.shift()):r?l=[]:p.disable())},p={add:function(){if(l){var t=l.length;!function n(t){K.each(t,function(t,r){var i=K.type(r);"function"!==i||e.unique&&p.has(r)?r&&r.length&&"string"!==i&&n(r):l.push(r)})}(arguments),o?s=l.length:r&&(a=t,f(r))}return this},remove:function(){return l&&K.each(arguments,function(e,t){for(var n;(n=K.inArray(t,l,n))>-1;)l.splice(n,1),o&&(s>=n&&s--,u>=n&&u--)}),this},has:function(e){return K.inArray(e,l)>-1},empty:function(){return l=[],this},disable:function(){return l=c=r=t,this},disabled:function(){return!l},lock:function(){return c=t,r||p.disable(),this},locked:function(){return!c},fireWith:function(e,t){return t=t||[],t=[e,t.slice?t.slice():t],l&&(!i||c)&&(o?c.push(t):f(t)),this},fire:function(){return p.fireWith(this,arguments),this},fired:function(){return!!i}};return p},K.extend({Deferred:function(e){var t=[["resolve","done",K.Callbacks("once memory"),"resolved"],["reject","fail",K.Callbacks("once memory"),"rejected"],["notify","progress",K.Callbacks("memory")]],n="pending",r={state:function(){return n},always:function(){return i.done(arguments).fail(arguments),this},then:function(){var e=arguments;return K.Deferred(function(n){K.each(t,function(t,r){var o=r[0],a=e[t];i[r[1]](K.isFunction(a)?function(){var e=a.apply(this,arguments);e&&K.isFunction(e.promise)?e.promise().done(n.resolve).fail(n.reject).progress(n.notify):n[o+"With"](this===i?n:this,[e])}:n[o])}),e=null}).promise()},promise:function(e){return"object"==typeof e?K.extend(e,r):r}},i={};return r.pipe=r.then,K.each(t,function(e,o){var a=o[2],s=o[3];r[o[1]]=a.add,s&&a.add(function(){n=s},t[1^e][2].disable,t[2][2].lock),i[o[0]]=a.fire,i[o[0]+"With"]=a.fireWith}),r.promise(i),e&&e.call(i,i),i},when:function(e){var t,n,r,i=0,o=Y.call(arguments),a=o.length,s=1!==a||e&&K.isFunction(e.promise)?a:0,u=1===s?e:K.Deferred(),l=function(e,n,r){return function(i){n[e]=this,r[e]=arguments.length>1?Y.call(arguments):i,r===t?u.notifyWith(n,r):--s||u.resolveWith(n,r)}};if(a>1)for(t=new Array(a),n=new Array(a),r=new Array(a);a>i;i++)o[i]&&K.isFunction(o[i].promise)?o[i].promise().done(l(i,r,o)).fail(u.reject).progress(l(i,n,t)):--s;return s||u.resolveWith(r,o),u.promise()}}),K.support=function(){var t,n,r,i,o,a,s,u,l,c,f,p=W.createElement("div");if(p.setAttribute("className","t"),p.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",n=p.getElementsByTagName("*"),r=p.getElementsByTagName("a")[0],r.style.cssText="top:1px;float:left;opacity:.5",!n||!n.length||!r)return{};i=W.createElement("select"),o=i.appendChild(W.createElement("option")),a=p.getElementsByTagName("input")[0],t={leadingWhitespace:3===p.firstChild.nodeType,tbody:!p.getElementsByTagName("tbody").length,htmlSerialize:!!p.getElementsByTagName("link").length,style:/top/.test(r.getAttribute("style")),hrefNormalized:"/a"===r.getAttribute("href"),opacity:/^0.5/.test(r.style.opacity),cssFloat:!!r.style.cssFloat,checkOn:"on"===a.value,optSelected:o.selected,getSetAttribute:"t"!==p.className,enctype:!!W.createElement("form").enctype,html5Clone:"<:nav></:nav>"!==W.createElement("nav").cloneNode(!0).outerHTML,boxModel:"CSS1Compat"===W.compatMode,submitBubbles:!0,changeBubbles:!0,focusinBubbles:!1,deleteExpando:!0,noCloneEvent:!0,inlineBlockNeedsLayout:!1,shrinkWrapBlocks:!1,reliableMarginRight:!0,boxSizingReliable:!0,pixelPosition:!1},a.checked=!0,t.noCloneChecked=a.cloneNode(!0).checked,i.disabled=!0,t.optDisabled=!o.disabled;try{delete p.test}catch(d){t.deleteExpando=!1}if(!p.addEventListener&&p.attachEvent&&p.fireEvent&&(p.attachEvent("onclick",f=function(){t.noCloneEvent=!1}),p.cloneNode(!0).fireEvent("onclick"),p.detachEvent("onclick",f)),a=W.createElement("input"),a.value="t",a.setAttribute("type","radio"),t.radioValue="t"===a.value,a.setAttribute("checked","checked"),a.setAttribute("name","t"),p.appendChild(a),s=W.createDocumentFragment(),s.appendChild(p.lastChild),t.checkClone=s.cloneNode(!0).cloneNode(!0).lastChild.checked,t.appendChecked=a.checked,s.removeChild(a),s.appendChild(p),p.attachEvent)for(l in{submit:!0,change:!0,focusin:!0})u="on"+l,c=u in p,c||(p.setAttribute(u,"return;"),c="function"==typeof p[u]),t[l+"Bubbles"]=c;return K(function(){var n,r,i,o,a="padding:0;margin:0;border:0;display:block;overflow:hidden;",s=W.getElementsByTagName("body")[0];s&&(n=W.createElement("div"),n.style.cssText="visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px",s.insertBefore(n,s.firstChild),r=W.createElement("div"),n.appendChild(r),r.innerHTML="<table><tr><td></td><td>t</td></tr></table>",i=r.getElementsByTagName("td"),i[0].style.cssText="padding:0;margin:0;border:0;display:none",c=0===i[0].offsetHeight,i[0].style.display="",i[1].style.display="none",t.reliableHiddenOffsets=c&&0===i[0].offsetHeight,r.innerHTML="",r.style.cssText="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;",t.boxSizing=4===r.offsetWidth,t.doesNotIncludeMarginInBodyOffset=1!==s.offsetTop,e.getComputedStyle&&(t.pixelPosition="1%"!==(e.getComputedStyle(r,null)||{}).top,t.boxSizingReliable="4px"===(e.getComputedStyle(r,null)||{width:"4px"}).width,o=W.createElement("div"),o.style.cssText=r.style.cssText=a,o.style.marginRight=o.style.width="0",r.style.width="1px",r.appendChild(o),t.reliableMarginRight=!parseFloat((e.getComputedStyle(o,null)||{}).marginRight)),"undefined"!=typeof r.style.zoom&&(r.innerHTML="",r.style.cssText=a+"width:1px;padding:1px;display:inline;zoom:1",t.inlineBlockNeedsLayout=3===r.offsetWidth,r.style.display="block",r.style.overflow="visible",r.innerHTML="<div></div>",r.firstChild.style.width="5px",t.shrinkWrapBlocks=3!==r.offsetWidth,n.style.zoom=1),s.removeChild(n),n=r=i=o=null)}),s.removeChild(p),n=r=i=o=a=s=p=null,t}();var gt=/(?:\{[\s\S]*\}|\[[\s\S]*\])$/,mt=/([A-Z])/g;K.extend({cache:{},deletedIds:[],uuid:0,expando:"jQuery"+(K.fn.jquery+Math.random()).replace(/\D/g,""),noData:{embed:!0,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:!0},hasData:function(e){return e=e.nodeType?K.cache[e[K.expando]]:e[K.expando],!!e&&!i(e)},data:function(e,n,r,i){if(K.acceptData(e)){var o,a,s=K.expando,u="string"==typeof n,l=e.nodeType,c=l?K.cache:e,f=l?e[s]:e[s]&&s;if(f&&c[f]&&(i||c[f].data)||!u||r!==t)return f||(l?e[s]=f=K.deletedIds.pop()||++K.uuid:f=s),c[f]||(c[f]={},l||(c[f].toJSON=K.noop)),("object"==typeof n||"function"==typeof n)&&(i?c[f]=K.extend(c[f],n):c[f].data=K.extend(c[f].data,n)),o=c[f],i||(o.data||(o.data={}),o=o.data),r!==t&&(o[K.camelCase(n)]=r),u?(a=o[n],null==a&&(a=o[K.camelCase(n)])):a=o,a}},removeData:function(e,t,n){if(K.acceptData(e)){var r,o,a,s=e.nodeType,u=s?K.cache:e,l=s?e[K.expando]:K.expando;if(u[l]){if(t&&(r=n?u[l]:u[l].data)){K.isArray(t)||(t in r?t=[t]:(t=K.camelCase(t),t=t in r?[t]:t.split(" ")));for(o=0,a=t.length;a>o;o++)delete r[t[o]];if(!(n?i:K.isEmptyObject)(r))return}(n||(delete u[l].data,i(u[l])))&&(s?K.cleanData([e],!0):K.support.deleteExpando||u!=u.window?delete u[l]:u[l]=null)}}},_data:function(e,t,n){return K.data(e,t,n,!0)},acceptData:function(e){var t=e.nodeName&&K.noData[e.nodeName.toLowerCase()];return!t||t!==!0&&e.getAttribute("classid")===t}}),K.fn.extend({data:function(e,n){var i,o,a,s,u,l=this[0],c=0,f=null;if(e===t){if(this.length&&(f=K.data(l),1===l.nodeType&&!K._data(l,"parsedAttrs"))){for(a=l.attributes,u=a.length;u>c;c++)s=a[c].name,0===s.indexOf("data-")&&(s=K.camelCase(s.substring(5)),r(l,s,f[s]));K._data(l,"parsedAttrs",!0)}return f}return"object"==typeof e?this.each(function(){K.data(this,e)}):(i=e.split(".",2),i[1]=i[1]?"."+i[1]:"",o=i[1]+"!",K.access(this,function(n){return n===t?(f=this.triggerHandler("getData"+o,[i[0]]),f===t&&l&&(f=K.data(l,e),f=r(l,e,f)),f===t&&i[1]?this.data(i[0]):f):(i[1]=n,this.each(function(){var t=K(this);t.triggerHandler("setData"+o,i),K.data(this,e,n),t.triggerHandler("changeData"+o,i)}),void 0)},null,n,arguments.length>1,null,!1))},removeData:function(e){return this.each(function(){K.removeData(this,e)})}}),K.extend({queue:function(e,t,n){var r;return e?(t=(t||"fx")+"queue",r=K._data(e,t),n&&(!r||K.isArray(n)?r=K._data(e,t,K.makeArray(n)):r.push(n)),r||[]):void 0},dequeue:function(e,t){t=t||"fx";var n=K.queue(e,t),r=n.length,i=n.shift(),o=K._queueHooks(e,t),a=function(){K.dequeue(e,t)};"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,a,o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return K._data(e,n)||K._data(e,n,{empty:K.Callbacks("once memory").add(function(){K.removeData(e,t+"queue",!0),K.removeData(e,n,!0)})})}}),K.fn.extend({queue:function(e,n){var r=2;return"string"!=typeof e&&(n=e,e="fx",r--),arguments.length<r?K.queue(this[0],e):n===t?this:this.each(function(){var t=K.queue(this,e,n);K._queueHooks(this,e),"fx"===e&&"inprogress"!==t[0]&&K.dequeue(this,e)})},dequeue:function(e){return this.each(function(){K.dequeue(this,e)})},delay:function(e,t){return e=K.fx?K.fx.speeds[e]||e:e,t=t||"fx",this.queue(t,function(t,n){var r=setTimeout(t,e);n.stop=function(){clearTimeout(r)}})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,n){var r,i=1,o=K.Deferred(),a=this,s=this.length,u=function(){--i||o.resolveWith(a,[a])};for("string"!=typeof e&&(n=e,e=t),e=e||"fx";s--;)r=K._data(a[s],e+"queueHooks"),r&&r.empty&&(i++,r.empty.add(u));return u(),o.promise(n)}});var yt,vt,bt,xt=/[\t\r\n]/g,wt=/\r/g,Tt=/^(?:button|input)$/i,Nt=/^(?:button|input|object|select|textarea)$/i,Ct=/^a(?:rea|)$/i,kt=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,Et=K.support.getSetAttribute;K.fn.extend({attr:function(e,t){return K.access(this,K.attr,e,t,arguments.length>1)},removeAttr:function(e){return this.each(function(){K.removeAttr(this,e)})},prop:function(e,t){return K.access(this,K.prop,e,t,arguments.length>1)},removeProp:function(e){return e=K.propFix[e]||e,this.each(function(){try{this[e]=t,delete this[e]}catch(n){}})},addClass:function(e){var t,n,r,i,o,a,s;if(K.isFunction(e))return this.each(function(t){K(this).addClass(e.call(this,t,this.className))});if(e&&"string"==typeof e)for(t=e.split(tt),n=0,r=this.length;r>n;n++)if(i=this[n],1===i.nodeType)if(i.className||1!==t.length){for(o=" "+i.className+" ",a=0,s=t.length;s>a;a++)~o.indexOf(" "+t[a]+" ")||(o+=t[a]+" ");i.className=K.trim(o)}else i.className=e;return this},removeClass:function(e){var n,r,i,o,a,s,u;if(K.isFunction(e))return this.each(function(t){K(this).removeClass(e.call(this,t,this.className))});if(e&&"string"==typeof e||e===t)for(n=(e||"").split(tt),s=0,u=this.length;u>s;s++)if(i=this[s],1===i.nodeType&&i.className){for(r=(" "+i.className+" ").replace(xt," "),o=0,a=n.length;a>o;o++)for(;r.indexOf(" "+n[o]+" ")>-1;)r=r.replace(" "+n[o]+" "," ");i.className=e?K.trim(r):""}return this},toggleClass:function(e,t){var n=typeof e,r="boolean"==typeof t;return K.isFunction(e)?this.each(function(n){K(this).toggleClass(e.call(this,n,this.className,t),t)}):this.each(function(){if("string"===n)for(var i,o=0,a=K(this),s=t,u=e.split(tt);i=u[o++];)s=r?s:!a.hasClass(i),a[s?"addClass":"removeClass"](i);else("undefined"===n||"boolean"===n)&&(this.className&&K._data(this,"__className__",this.className),this.className=this.className||e===!1?"":K._data(this,"__className__")||"")})},hasClass:function(e){for(var t=" "+e+" ",n=0,r=this.length;r>n;n++)if(1===this[n].nodeType&&(" "+this[n].className+" ").replace(xt," ").indexOf(t)>-1)return!0;return!1},val:function(e){var n,r,i,o=this[0];{if(arguments.length)return i=K.isFunction(e),this.each(function(r){var o,a=K(this);1===this.nodeType&&(o=i?e.call(this,r,a.val()):e,null==o?o="":"number"==typeof o?o+="":K.isArray(o)&&(o=K.map(o,function(e){return null==e?"":e+""})),n=K.valHooks[this.type]||K.valHooks[this.nodeName.toLowerCase()],n&&"set"in n&&n.set(this,o,"value")!==t||(this.value=o))});if(o)return n=K.valHooks[o.type]||K.valHooks[o.nodeName.toLowerCase()],n&&"get"in n&&(r=n.get(o,"value"))!==t?r:(r=o.value,"string"==typeof r?r.replace(wt,""):null==r?"":r)}}}),K.extend({valHooks:{option:{get:function(e){var t=e.attributes.value;return!t||t.specified?e.value:e.text}},select:{get:function(e){var t,n,r,i,o=e.selectedIndex,a=[],s=e.options,u="select-one"===e.type;if(0>o)return null;for(n=u?o:0,r=u?o+1:s.length;r>n;n++)if(i=s[n],!(!i.selected||(K.support.optDisabled?i.disabled:null!==i.getAttribute("disabled"))||i.parentNode.disabled&&K.nodeName(i.parentNode,"optgroup"))){if(t=K(i).val(),u)return t;a.push(t)}return u&&!a.length&&s.length?K(s[o]).val():a},set:function(e,t){var n=K.makeArray(t);return K(e).find("option").each(function(){this.selected=K.inArray(K(this).val(),n)>=0}),n.length||(e.selectedIndex=-1),n}}},attrFn:{},attr:function(e,n,r,i){var o,a,s,u=e.nodeType;if(e&&3!==u&&8!==u&&2!==u)return i&&K.isFunction(K.fn[n])?K(e)[n](r):"undefined"==typeof e.getAttribute?K.prop(e,n,r):(s=1!==u||!K.isXMLDoc(e),s&&(n=n.toLowerCase(),a=K.attrHooks[n]||(kt.test(n)?vt:yt)),r!==t?null===r?(K.removeAttr(e,n),void 0):a&&"set"in a&&s&&(o=a.set(e,r,n))!==t?o:(e.setAttribute(n,""+r),r):a&&"get"in a&&s&&null!==(o=a.get(e,n))?o:(o=e.getAttribute(n),null===o?t:o))},removeAttr:function(e,t){var n,r,i,o,a=0;if(t&&1===e.nodeType)for(r=t.split(tt);a<r.length;a++)i=r[a],i&&(n=K.propFix[i]||i,o=kt.test(i),o||K.attr(e,i,""),e.removeAttribute(Et?i:n),o&&n in e&&(e[n]=!1))},attrHooks:{type:{set:function(e,t){if(Tt.test(e.nodeName)&&e.parentNode)K.error("type property can't be changed");else if(!K.support.radioValue&&"radio"===t&&K.nodeName(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}},value:{get:function(e,t){return yt&&K.nodeName(e,"button")?yt.get(e,t):t in e?e.value:null},set:function(e,t,n){return yt&&K.nodeName(e,"button")?yt.set(e,t,n):(e.value=t,void 0)}}},propFix:{tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},prop:function(e,n,r){var i,o,a,s=e.nodeType;if(e&&3!==s&&8!==s&&2!==s)return a=1!==s||!K.isXMLDoc(e),a&&(n=K.propFix[n]||n,o=K.propHooks[n]),r!==t?o&&"set"in o&&(i=o.set(e,r,n))!==t?i:e[n]=r:o&&"get"in o&&null!==(i=o.get(e,n))?i:e[n]},propHooks:{tabIndex:{get:function(e){var n=e.getAttributeNode("tabindex");return n&&n.specified?parseInt(n.value,10):Nt.test(e.nodeName)||Ct.test(e.nodeName)&&e.href?0:t}}}}),vt={get:function(e,n){var r,i=K.prop(e,n);return i===!0||"boolean"!=typeof i&&(r=e.getAttributeNode(n))&&r.nodeValue!==!1?n.toLowerCase():t},set:function(e,t,n){var r;return t===!1?K.removeAttr(e,n):(r=K.propFix[n]||n,r in e&&(e[r]=!0),e.setAttribute(n,n.toLowerCase())),n}},Et||(bt={name:!0,id:!0,coords:!0},yt=K.valHooks.button={get:function(e,n){var r;return r=e.getAttributeNode(n),r&&(bt[n]?""!==r.value:r.specified)?r.value:t},set:function(e,t,n){var r=e.getAttributeNode(n);return r||(r=W.createAttribute(n),e.setAttributeNode(r)),r.value=t+""}},K.each(["width","height"],function(e,t){K.attrHooks[t]=K.extend(K.attrHooks[t],{set:function(e,n){return""===n?(e.setAttribute(t,"auto"),n):void 0
}})}),K.attrHooks.contenteditable={get:yt.get,set:function(e,t,n){""===t&&(t="false"),yt.set(e,t,n)}}),K.support.hrefNormalized||K.each(["href","src","width","height"],function(e,n){K.attrHooks[n]=K.extend(K.attrHooks[n],{get:function(e){var r=e.getAttribute(n,2);return null===r?t:r}})}),K.support.style||(K.attrHooks.style={get:function(e){return e.style.cssText.toLowerCase()||t},set:function(e,t){return e.style.cssText=""+t}}),K.support.optSelected||(K.propHooks.selected=K.extend(K.propHooks.selected,{get:function(e){var t=e.parentNode;return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null}})),K.support.enctype||(K.propFix.enctype="encoding"),K.support.checkOn||K.each(["radio","checkbox"],function(){K.valHooks[this]={get:function(e){return null===e.getAttribute("value")?"on":e.value}}}),K.each(["radio","checkbox"],function(){K.valHooks[this]=K.extend(K.valHooks[this],{set:function(e,t){return K.isArray(t)?e.checked=K.inArray(K(e).val(),t)>=0:void 0}})});var St=/^(?:textarea|input|select)$/i,jt=/^([^\.]*|)(?:\.(.+)|)$/,At=/(?:^|\s)hover(\.\S+|)\b/,Dt=/^key/,Lt=/^(?:mouse|contextmenu)|click/,Ht=/^(?:focusinfocus|focusoutblur)$/,Mt=function(e){return K.event.special.hover?e:e.replace(At,"mouseenter$1 mouseleave$1")};K.event={add:function(e,n,r,i,o){var a,s,u,l,c,f,p,d,h,g,m;if(3!==e.nodeType&&8!==e.nodeType&&n&&r&&(a=K._data(e))){for(r.handler&&(h=r,r=h.handler,o=h.selector),r.guid||(r.guid=K.guid++),u=a.events,u||(a.events=u={}),s=a.handle,s||(a.handle=s=function(e){return"undefined"==typeof K||e&&K.event.triggered===e.type?t:K.event.dispatch.apply(s.elem,arguments)},s.elem=e),n=K.trim(Mt(n)).split(" "),l=0;l<n.length;l++)c=jt.exec(n[l])||[],f=c[1],p=(c[2]||"").split(".").sort(),m=K.event.special[f]||{},f=(o?m.delegateType:m.bindType)||f,m=K.event.special[f]||{},d=K.extend({type:f,origType:c[1],data:i,handler:r,guid:r.guid,selector:o,namespace:p.join(".")},h),g=u[f],g||(g=u[f]=[],g.delegateCount=0,m.setup&&m.setup.call(e,i,p,s)!==!1||(e.addEventListener?e.addEventListener(f,s,!1):e.attachEvent&&e.attachEvent("on"+f,s))),m.add&&(m.add.call(e,d),d.handler.guid||(d.handler.guid=r.guid)),o?g.splice(g.delegateCount++,0,d):g.push(d),K.event.global[f]=!0;e=null}},global:{},remove:function(e,t,n,r,i){var o,a,s,u,l,c,f,p,d,h,g,m=K.hasData(e)&&K._data(e);if(m&&(p=m.events)){for(t=K.trim(Mt(t||"")).split(" "),o=0;o<t.length;o++)if(a=jt.exec(t[o])||[],s=u=a[1],l=a[2],s){for(d=K.event.special[s]||{},s=(r?d.delegateType:d.bindType)||s,h=p[s]||[],c=h.length,l=l?new RegExp("(^|\\.)"+l.split(".").sort().join("\\.(?:.*\\.|)")+"(\\.|$)"):null,f=0;f<h.length;f++)g=h[f],!(!i&&u!==g.origType||n&&n.guid!==g.guid||l&&!l.test(g.namespace)||r&&r!==g.selector&&("**"!==r||!g.selector)||(h.splice(f--,1),g.selector&&h.delegateCount--,!d.remove||!d.remove.call(e,g)));0===h.length&&c!==h.length&&((!d.teardown||d.teardown.call(e,l,m.handle)===!1)&&K.removeEvent(e,s,m.handle),delete p[s])}else for(s in p)K.event.remove(e,s+t[o],n,r,!0);K.isEmptyObject(p)&&(delete m.handle,K.removeData(e,"events",!0))}},customEvent:{getData:!0,setData:!0,changeData:!0},trigger:function(n,r,i,o){if(!i||3!==i.nodeType&&8!==i.nodeType){var a,s,u,l,c,f,p,d,h,g,m=n.type||n,y=[];if(Ht.test(m+K.event.triggered))return;if(m.indexOf("!")>=0&&(m=m.slice(0,-1),s=!0),m.indexOf(".")>=0&&(y=m.split("."),m=y.shift(),y.sort()),(!i||K.event.customEvent[m])&&!K.event.global[m])return;if(n="object"==typeof n?n[K.expando]?n:new K.Event(m,n):new K.Event(m),n.type=m,n.isTrigger=!0,n.exclusive=s,n.namespace=y.join("."),n.namespace_re=n.namespace?new RegExp("(^|\\.)"+y.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,f=m.indexOf(":")<0?"on"+m:"",!i){a=K.cache;for(u in a)a[u].events&&a[u].events[m]&&K.event.trigger(n,r,a[u].handle.elem,!0);return}if(n.result=t,n.target||(n.target=i),r=null!=r?K.makeArray(r):[],r.unshift(n),p=K.event.special[m]||{},p.trigger&&p.trigger.apply(i,r)===!1)return;if(h=[[i,p.bindType||m]],!o&&!p.noBubble&&!K.isWindow(i)){for(g=p.delegateType||m,l=Ht.test(g+m)?i:i.parentNode,c=i;l;l=l.parentNode)h.push([l,g]),c=l;c===(i.ownerDocument||W)&&h.push([c.defaultView||c.parentWindow||e,g])}for(u=0;u<h.length&&!n.isPropagationStopped();u++)l=h[u][0],n.type=h[u][1],d=(K._data(l,"events")||{})[n.type]&&K._data(l,"handle"),d&&d.apply(l,r),d=f&&l[f],d&&K.acceptData(l)&&d.apply(l,r)===!1&&n.preventDefault();return n.type=m,!(o||n.isDefaultPrevented()||p._default&&p._default.apply(i.ownerDocument,r)!==!1||"click"===m&&K.nodeName(i,"a")||!K.acceptData(i)||!f||!i[m]||("focus"===m||"blur"===m)&&0===n.target.offsetWidth||K.isWindow(i)||(c=i[f],c&&(i[f]=null),K.event.triggered=m,i[m](),K.event.triggered=t,!c||!(i[f]=c))),n.result}},dispatch:function(n){n=K.event.fix(n||e.event);var r,i,o,a,s,u,l,c,f,p=(K._data(this,"events")||{})[n.type]||[],d=p.delegateCount,h=[].slice.call(arguments),g=!n.exclusive&&!n.namespace,m=K.event.special[n.type]||{},y=[];if(h[0]=n,n.delegateTarget=this,!m.preDispatch||m.preDispatch.call(this,n)!==!1){if(d&&(!n.button||"click"!==n.type))for(o=n.target;o!=this;o=o.parentNode||this)if(o.disabled!==!0||"click"!==n.type){for(s={},l=[],r=0;d>r;r++)c=p[r],f=c.selector,s[f]===t&&(s[f]=K(f,this).index(o)>=0),s[f]&&l.push(c);l.length&&y.push({elem:o,matches:l})}for(p.length>d&&y.push({elem:this,matches:p.slice(d)}),r=0;r<y.length&&!n.isPropagationStopped();r++)for(u=y[r],n.currentTarget=u.elem,i=0;i<u.matches.length&&!n.isImmediatePropagationStopped();i++)c=u.matches[i],(g||!n.namespace&&!c.namespace||n.namespace_re&&n.namespace_re.test(c.namespace))&&(n.data=c.data,n.handleObj=c,a=((K.event.special[c.origType]||{}).handle||c.handler).apply(u.elem,h),a!==t&&(n.result=a,a===!1&&(n.preventDefault(),n.stopPropagation())));return m.postDispatch&&m.postDispatch.call(this,n),n.result}},props:"attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(e,t){return null==e.which&&(e.which=null!=t.charCode?t.charCode:t.keyCode),e}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(e,n){var r,i,o,a=n.button,s=n.fromElement;return null==e.pageX&&null!=n.clientX&&(r=e.target.ownerDocument||W,i=r.documentElement,o=r.body,e.pageX=n.clientX+(i&&i.scrollLeft||o&&o.scrollLeft||0)-(i&&i.clientLeft||o&&o.clientLeft||0),e.pageY=n.clientY+(i&&i.scrollTop||o&&o.scrollTop||0)-(i&&i.clientTop||o&&o.clientTop||0)),!e.relatedTarget&&s&&(e.relatedTarget=s===e.target?n.toElement:s),!e.which&&a!==t&&(e.which=1&a?1:2&a?3:4&a?2:0),e}},fix:function(e){if(e[K.expando])return e;var t,n,r=e,i=K.event.fixHooks[e.type]||{},o=i.props?this.props.concat(i.props):this.props;for(e=K.Event(r),t=o.length;t;)n=o[--t],e[n]=r[n];return e.target||(e.target=r.srcElement||W),3===e.target.nodeType&&(e.target=e.target.parentNode),e.metaKey=!!e.metaKey,i.filter?i.filter(e,r):e},special:{load:{noBubble:!0},focus:{delegateType:"focusin"},blur:{delegateType:"focusout"},beforeunload:{setup:function(e,t,n){K.isWindow(this)&&(this.onbeforeunload=n)},teardown:function(e,t){this.onbeforeunload===t&&(this.onbeforeunload=null)}}},simulate:function(e,t,n,r){var i=K.extend(new K.Event,n,{type:e,isSimulated:!0,originalEvent:{}});r?K.event.trigger(i,null,t):K.event.dispatch.call(t,i),i.isDefaultPrevented()&&n.preventDefault()}},K.event.handle=K.event.dispatch,K.removeEvent=W.removeEventListener?function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n,!1)}:function(e,t,n){var r="on"+t;e.detachEvent&&("undefined"==typeof e[r]&&(e[r]=null),e.detachEvent(r,n))},K.Event=function(e,t){return this instanceof K.Event?(e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||e.returnValue===!1||e.getPreventDefault&&e.getPreventDefault()?a:o):this.type=e,t&&K.extend(this,t),this.timeStamp=e&&e.timeStamp||K.now(),this[K.expando]=!0,void 0):new K.Event(e,t)},K.Event.prototype={preventDefault:function(){this.isDefaultPrevented=a;var e=this.originalEvent;e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},stopPropagation:function(){this.isPropagationStopped=a;var e=this.originalEvent;e&&(e.stopPropagation&&e.stopPropagation(),e.cancelBubble=!0)},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=a,this.stopPropagation()},isDefaultPrevented:o,isPropagationStopped:o,isImmediatePropagationStopped:o},K.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(e,t){K.event.special[e]={delegateType:t,bindType:t,handle:function(e){var n,r=this,i=e.relatedTarget,o=e.handleObj;return o.selector,(!i||i!==r&&!K.contains(r,i))&&(e.type=o.origType,n=o.handler.apply(this,arguments),e.type=t),n}}}),K.support.submitBubbles||(K.event.special.submit={setup:function(){return K.nodeName(this,"form")?!1:(K.event.add(this,"click._submit keypress._submit",function(e){var n=e.target,r=K.nodeName(n,"input")||K.nodeName(n,"button")?n.form:t;r&&!K._data(r,"_submit_attached")&&(K.event.add(r,"submit._submit",function(e){e._submit_bubble=!0}),K._data(r,"_submit_attached",!0))}),void 0)},postDispatch:function(e){e._submit_bubble&&(delete e._submit_bubble,this.parentNode&&!e.isTrigger&&K.event.simulate("submit",this.parentNode,e,!0))},teardown:function(){return K.nodeName(this,"form")?!1:(K.event.remove(this,"._submit"),void 0)}}),K.support.changeBubbles||(K.event.special.change={setup:function(){return St.test(this.nodeName)?(("checkbox"===this.type||"radio"===this.type)&&(K.event.add(this,"propertychange._change",function(e){"checked"===e.originalEvent.propertyName&&(this._just_changed=!0)}),K.event.add(this,"click._change",function(e){this._just_changed&&!e.isTrigger&&(this._just_changed=!1),K.event.simulate("change",this,e,!0)})),!1):(K.event.add(this,"beforeactivate._change",function(e){var t=e.target;St.test(t.nodeName)&&!K._data(t,"_change_attached")&&(K.event.add(t,"change._change",function(e){this.parentNode&&!e.isSimulated&&!e.isTrigger&&K.event.simulate("change",this.parentNode,e,!0)}),K._data(t,"_change_attached",!0))}),void 0)},handle:function(e){var t=e.target;return this!==t||e.isSimulated||e.isTrigger||"radio"!==t.type&&"checkbox"!==t.type?e.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return K.event.remove(this,"._change"),!St.test(this.nodeName)}}),K.support.focusinBubbles||K.each({focus:"focusin",blur:"focusout"},function(e,t){var n=0,r=function(e){K.event.simulate(t,e.target,K.event.fix(e),!0)};K.event.special[t]={setup:function(){0===n++&&W.addEventListener(e,r,!0)},teardown:function(){0===--n&&W.removeEventListener(e,r,!0)}}}),K.fn.extend({on:function(e,n,r,i,a){var s,u;if("object"==typeof e){"string"!=typeof n&&(r=r||n,n=t);for(u in e)this.on(u,n,r,e[u],a);return this}if(null==r&&null==i?(i=n,r=n=t):null==i&&("string"==typeof n?(i=r,r=t):(i=r,r=n,n=t)),i===!1)i=o;else if(!i)return this;return 1===a&&(s=i,i=function(e){return K().off(e),s.apply(this,arguments)},i.guid=s.guid||(s.guid=K.guid++)),this.each(function(){K.event.add(this,e,i,r,n)})},one:function(e,t,n,r){return this.on(e,t,n,r,1)},off:function(e,n,r){var i,a;if(e&&e.preventDefault&&e.handleObj)return i=e.handleObj,K(e.delegateTarget).off(i.namespace?i.origType+"."+i.namespace:i.origType,i.selector,i.handler),this;if("object"==typeof e){for(a in e)this.off(a,n,e[a]);return this}return(n===!1||"function"==typeof n)&&(r=n,n=t),r===!1&&(r=o),this.each(function(){K.event.remove(this,e,r,n)})},bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},live:function(e,t,n){return K(this.context).on(e,this.selector,t,n),this},die:function(e,t){return K(this.context).off(e,this.selector||"**",t),this},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1==arguments.length?this.off(e,"**"):this.off(t,e||"**",n)},trigger:function(e,t){return this.each(function(){K.event.trigger(e,t,this)})},triggerHandler:function(e,t){return this[0]?K.event.trigger(e,t,this[0],!0):void 0},toggle:function(e){var t=arguments,n=e.guid||K.guid++,r=0,i=function(n){var i=(K._data(this,"lastToggle"+e.guid)||0)%r;return K._data(this,"lastToggle"+e.guid,i+1),n.preventDefault(),t[i].apply(this,arguments)||!1};for(i.guid=n;r<t.length;)t[r++].guid=n;return this.click(i)},hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)}}),K.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(e,t){K.fn[t]=function(e,n){return null==n&&(n=e,e=null),arguments.length>0?this.on(t,null,e,n):this.trigger(t)},Dt.test(t)&&(K.event.fixHooks[t]=K.event.keyHooks),Lt.test(t)&&(K.event.fixHooks[t]=K.event.mouseHooks)}),function(e,t){function n(e,t,n,r){n=n||[],t=t||j;var i,o,a,s,u=t.nodeType;if(1!==u&&9!==u)return[];if(!e||"string"!=typeof e)return n;if(a=x(t),!a&&!r&&(i=Q.exec(e)))if(s=i[1]){if(9===u){if(o=t.getElementById(s),!o||!o.parentNode)return n;if(o.id===s)return n.push(o),n}else if(t.ownerDocument&&(o=t.ownerDocument.getElementById(s))&&w(t,o)&&o.id===s)return n.push(o),n}else{if(i[2])return H.apply(n,L.call(t.getElementsByTagName(e),0)),n;if((s=i[3])&&st&&t.getElementsByClassName)return H.apply(n,L.call(t.getElementsByClassName(s),0)),n}return h(e,t,n,r,a)}function r(e){return function(t){var n=t.nodeName.toLowerCase();return"input"===n&&t.type===e}}function i(e){return function(t){var n=t.nodeName.toLowerCase();return("input"===n||"button"===n)&&t.type===e}}function o(e,t,n){if(e===t)return n;for(var r=e.nextSibling;r;){if(r===t)return-1;r=r.nextSibling}return 1}function a(e,t,r,i){var o,a,s,u,l,c,f,p,d,h,g=!r&&t!==j,m=(g?"<s>":"")+e.replace(X,"$1<s>"),y=O[S][m];if(y)return i?0:L.call(y,0);for(l=e,c=[],p=0,d=v.preFilter,h=v.filter;l;){(!o||(a=U.exec(l)))&&(a&&(l=l.slice(a[0].length),s.selector=f),c.push(s=[]),f="",g&&(l=" "+l)),o=!1,(a=Y.exec(l))&&(f+=a[0],l=l.slice(a[0].length),o=s.push({part:a.pop().replace(X," "),string:a[0],captures:a}));for(u in h)(a=nt[u].exec(l))&&(!d[u]||(a=d[u](a,t,r)))&&(f+=a[0],l=l.slice(a[0].length),o=s.push({part:u,string:a.shift(),captures:a}));if(!o)break}return f&&(s.selector=f),i?l.length:l?n.error(e):L.call(O(m,c),0)}function s(e,t,n,r){var i=t.dir,o=D++;return e||(e=function(e){return e===n}),t.first?function(t){for(;t=t[i];)if(1===t.nodeType)return e(t)&&t}:r?function(t){for(;t=t[i];)if(1===t.nodeType&&e(t))return t}:function(t){for(var n,r=o+"."+g,a=r+"."+m;t=t[i];)if(1===t.nodeType){if((n=t[S])===a)return t.sizset;if("string"==typeof n&&0===n.indexOf(r)){if(t.sizset)return t}else{if(t[S]=a,e(t))return t.sizset=!0,t;t.sizset=!1}}}}function u(e,t){return e?function(n){var r=t(n);return r&&e(r===!0?n:r)}:t}function l(e,t,n){for(var r,i,o=0;r=e[o];o++)i=v.relative[r.part]?s(i,v.relative[r.part],t,n):u(i,v.filter[r.part].apply(null,r.captures.concat(t,n)));return i}function c(e){return function(t){for(var n,r=0;n=e[r];r++)if(n(t))return!0;return!1}}function f(e,t,r,i){for(var o=0,a=t.length;a>o;o++)n(e,t[o],r,i)}function p(e,t,r,i,o,a){var s,u=v.setFilters[t.toLowerCase()];return u||n.error(t),(e||!(s=o))&&f(e||"*",i,s=[],o),s.length>0?u(s,r,a):[]}function d(e,r,i,o){for(var a,s,u,l,c,d,h,g,m,y,v,b,x,w=0,T=e.length,N=nt.POS,C=new RegExp("^"+N.source+"(?!"+B+")","i"),k=function(){for(var e=1,n=arguments.length-2;n>e;e++)arguments[e]===t&&(m[e]=t)};T>w;w++){for(a=e[w],s="",g=o,u=0,l=a.length;l>u;u++){if(c=a[u],d=c.string,"PSEUDO"===c.part)for(N.exec(""),h=0;m=N.exec(d);)y=!0,v=N.lastIndex=m.index+m[0].length,v>h&&(s+=d.slice(h,m.index),h=v,b=[r],Y.test(s)&&(g&&(b=g),g=o),(x=G.test(s))&&(s=s.slice(0,-5).replace(Y,"$&*"),h++),m.length>1&&m[0].replace(C,k),g=p(s,m[1],m[2],b,g,x)),s="";y||(s+=d),y=!1}s?Y.test(s)?f(s,g||[r],i,o):n(s,r,i,o?o.concat(g):g):H.apply(i,g)}return 1===T?i:n.uniqueSort(i)}function h(e,t,n,r,i){e=e.replace(X,"$1");var o,s,u,l,c,f,p,h,y,b=a(e,t,i),x=t.nodeType;if(nt.POS.test(e))return d(b,t,n,r);if(r)o=L.call(r,0);else if(1===b.length){if((c=L.call(b[0],0)).length>2&&"ID"===(f=c[0]).part&&9===x&&!i&&v.relative[c[1].part]){if(t=v.find.ID(f.captures[0].replace(tt,""),t,i)[0],!t)return n;e=e.slice(c.shift().string.length)}for(h=(b=V.exec(c[0].string))&&!b.index&&t.parentNode||t,p="",l=c.length-1;l>=0&&(f=c[l],y=f.part,p=f.string+p,!v.relative[y]);l--)if(v.order.test(y)){if(o=v.find[y](f.captures[0].replace(tt,""),h,i),null==o)continue;e=e.slice(0,e.length-p.length)+p.replace(nt[y],""),e||H.apply(n,L.call(o,0));break}}if(e)for(s=T(e,t,i),g=s.dirruns++,null==o&&(o=v.find.TAG("*",V.test(e)&&t.parentNode||t)),l=0;u=o[l];l++)m=s.runs++,s(u)&&n.push(u);return n}var g,m,y,v,b,x,w,T,N,C,k=!0,E="undefined",S=("sizcache"+Math.random()).replace(".",""),j=e.document,A=j.documentElement,D=0,L=[].slice,H=[].push,M=function(e,t){return e[S]=t||!0,e},_=function(){var e={},t=[];return M(function(n,r){return t.push(n)>v.cacheLength&&delete e[t.shift()],e[n]=r},e)},F=_(),O=_(),q=_(),B="[\\x20\\t\\r\\n\\f]",R="(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+",P=R.replace("w","w#"),W="([*^$|!~]?=)",I="\\["+B+"*("+R+")"+B+"*(?:"+W+B+"*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|("+P+")|)|)"+B+"*\\]",$=":("+R+")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:"+I+")|[^:]|\\\\.)*|.*))\\)|)",z=":(nth|eq|gt|lt|first|last|even|odd)(?:\\(((?:-\\d)?\\d*)\\)|)(?=[^-]|$)",X=new RegExp("^"+B+"+|((?:^|[^\\\\])(?:\\\\.)*)"+B+"+$","g"),U=new RegExp("^"+B+"*,"+B+"*"),Y=new RegExp("^"+B+"*([\\x20\\t\\r\\n\\f>+~])"+B+"*"),J=new RegExp($),Q=/^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/,V=/[\x20\t\r\n\f]*[+~]/,G=/:not\($/,Z=/h\d/i,et=/input|select|textarea|button/i,tt=/\\(?!\\)/g,nt={ID:new RegExp("^#("+R+")"),CLASS:new RegExp("^\\.("+R+")"),NAME:new RegExp("^\\[name=['\"]?("+R+")['\"]?\\]"),TAG:new RegExp("^("+R.replace("w","w*")+")"),ATTR:new RegExp("^"+I),PSEUDO:new RegExp("^"+$),CHILD:new RegExp("^:(only|nth|last|first)-child(?:\\("+B+"*(even|odd|(([+-]|)(\\d*)n|)"+B+"*(?:([+-]|)"+B+"*(\\d+)|))"+B+"*\\)|)","i"),POS:new RegExp(z,"ig"),needsContext:new RegExp("^"+B+"*[>+~]|"+z,"i")},rt=function(e){var t=j.createElement("div");try{return e(t)}catch(n){return!1}finally{t=null}},it=rt(function(e){return e.appendChild(j.createComment("")),!e.getElementsByTagName("*").length}),ot=rt(function(e){return e.innerHTML="<a href='#'></a>",e.firstChild&&typeof e.firstChild.getAttribute!==E&&"#"===e.firstChild.getAttribute("href")}),at=rt(function(e){e.innerHTML="<select></select>";var t=typeof e.lastChild.getAttribute("multiple");return"boolean"!==t&&"string"!==t}),st=rt(function(e){return e.innerHTML="<div class='hidden e'></div><div class='hidden'></div>",e.getElementsByClassName&&e.getElementsByClassName("e").length?(e.lastChild.className="e",2===e.getElementsByClassName("e").length):!1}),ut=rt(function(e){e.id=S+0,e.innerHTML="<a name='"+S+"'></a><div name='"+S+"'></div>",A.insertBefore(e,A.firstChild);var t=j.getElementsByName&&j.getElementsByName(S).length===2+j.getElementsByName(S+0).length;return y=!j.getElementById(S),A.removeChild(e),t});try{L.call(A.childNodes,0)[0].nodeType}catch(lt){L=function(e){for(var t,n=[];t=this[e];e++)n.push(t);return n}}n.matches=function(e,t){return n(e,null,null,t)},n.matchesSelector=function(e,t){return n(t,null,null,[e]).length>0},b=n.getText=function(e){var t,n="",r=0,i=e.nodeType;if(i){if(1===i||9===i||11===i){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=b(e)}else if(3===i||4===i)return e.nodeValue}else for(;t=e[r];r++)n+=b(t);return n},x=n.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return t?"HTML"!==t.nodeName:!1},w=n.contains=A.contains?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!!(r&&1===r.nodeType&&n.contains&&n.contains(r))}:A.compareDocumentPosition?function(e,t){return t&&!!(16&e.compareDocumentPosition(t))}:function(e,t){for(;t=t.parentNode;)if(t===e)return!0;return!1},n.attr=function(e,t){var n,r=x(e);return r||(t=t.toLowerCase()),v.attrHandle[t]?v.attrHandle[t](e):at||r?e.getAttribute(t):(n=e.getAttributeNode(t),n?"boolean"==typeof e[t]?e[t]?t:null:n.specified?n.value:null:null)},v=n.selectors={cacheLength:50,createPseudo:M,match:nt,order:new RegExp("ID|TAG"+(ut?"|NAME":"")+(st?"|CLASS":"")),attrHandle:ot?{}:{href:function(e){return e.getAttribute("href",2)},type:function(e){return e.getAttribute("type")}},find:{ID:y?function(e,t,n){if(typeof t.getElementById!==E&&!n){var r=t.getElementById(e);return r&&r.parentNode?[r]:[]}}:function(e,n,r){if(typeof n.getElementById!==E&&!r){var i=n.getElementById(e);return i?i.id===e||typeof i.getAttributeNode!==E&&i.getAttributeNode("id").value===e?[i]:t:[]}},TAG:it?function(e,t){return typeof t.getElementsByTagName!==E?t.getElementsByTagName(e):void 0}:function(e,t){var n=t.getElementsByTagName(e);if("*"===e){for(var r,i=[],o=0;r=n[o];o++)1===r.nodeType&&i.push(r);return i}return n},NAME:function(e,t){return typeof t.getElementsByName!==E?t.getElementsByName(name):void 0},CLASS:function(e,t,n){return typeof t.getElementsByClassName===E||n?void 0:t.getElementsByClassName(e)}},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(tt,""),e[3]=(e[4]||e[5]||"").replace(tt,""),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1]?(e[2]||n.error(e[0]),e[3]=+(e[3]?e[4]+(e[5]||1):2*("even"===e[2]||"odd"===e[2])),e[4]=+(e[6]+e[7]||"odd"===e[2])):e[2]&&n.error(e[0]),e},PSEUDO:function(e,t,n){var r,i;return nt.CHILD.test(e[0])?null:(e[3]?e[2]=e[3]:(r=e[4])&&(J.test(r)&&(i=a(r,t,n,!0))&&(i=r.indexOf(")",r.length-i)-r.length)&&(r=r.slice(0,i),e[0]=e[0].slice(0,i)),e[2]=r),e.slice(0,3))}},filter:{ID:y?function(e){return e=e.replace(tt,""),function(t){return t.getAttribute("id")===e}}:function(e){return e=e.replace(tt,""),function(t){var n=typeof t.getAttributeNode!==E&&t.getAttributeNode("id");return n&&n.value===e}},TAG:function(e){return"*"===e?function(){return!0}:(e=e.replace(tt,"").toLowerCase(),function(t){return t.nodeName&&t.nodeName.toLowerCase()===e})},CLASS:function(e){var t=F[S][e];return t||(t=F(e,new RegExp("(^|"+B+")"+e+"("+B+"|$)"))),function(e){return t.test(e.className||typeof e.getAttribute!==E&&e.getAttribute("class")||"")}},ATTR:function(e,t,r){return t?function(i){var o=n.attr(i,e),a=o+"";if(null==o)return"!="===t;switch(t){case"=":return a===r;case"!=":return a!==r;case"^=":return r&&0===a.indexOf(r);case"*=":return r&&a.indexOf(r)>-1;case"$=":return r&&a.substr(a.length-r.length)===r;case"~=":return(" "+a+" ").indexOf(r)>-1;case"|=":return a===r||a.substr(0,r.length+1)===r+"-"}}:function(t){return null!=n.attr(t,e)}},CHILD:function(e,t,n,r){if("nth"===e){var i=D++;return function(e){var t,o,a=0,s=e;if(1===n&&0===r)return!0;if(t=e.parentNode,t&&(t[S]!==i||!e.sizset)){for(s=t.firstChild;s&&(1!==s.nodeType||(s.sizset=++a,s!==e));s=s.nextSibling);t[S]=i}return o=e.sizset-r,0===n?0===o:0===o%n&&o/n>=0}}return function(t){var n=t;switch(e){case"only":case"first":for(;n=n.previousSibling;)if(1===n.nodeType)return!1;if("first"===e)return!0;n=t;case"last":for(;n=n.nextSibling;)if(1===n.nodeType)return!1;return!0}}},PSEUDO:function(e,t,r,i){var o,a=v.pseudos[e]||v.pseudos[e.toLowerCase()];return a||n.error("unsupported pseudo: "+e),a[S]?a(t,r,i):a.length>1?(o=[e,e,"",t],function(e){return a(e,0,o)}):a}},pseudos:{not:M(function(e,t,n){var r=T(e.replace(X,"$1"),t,n);return function(e){return!r(e)}}),enabled:function(e){return e.disabled===!1},disabled:function(e){return e.disabled===!0},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,e.selected===!0},parent:function(e){return!v.pseudos.empty(e)},empty:function(e){var t;for(e=e.firstChild;e;){if(e.nodeName>"@"||3===(t=e.nodeType)||4===t)return!1;e=e.nextSibling}return!0},contains:M(function(e){return function(t){return(t.textContent||t.innerText||b(t)).indexOf(e)>-1}}),has:M(function(e){return function(t){return n(e,t).length>0}}),header:function(e){return Z.test(e.nodeName)},text:function(e){var t,n;return"input"===e.nodeName.toLowerCase()&&"text"===(t=e.type)&&(null==(n=e.getAttribute("type"))||n.toLowerCase()===t)},radio:r("radio"),checkbox:r("checkbox"),file:r("file"),password:r("password"),image:r("image"),submit:i("submit"),reset:i("reset"),button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},input:function(e){return et.test(e.nodeName)},focus:function(e){var t=e.ownerDocument;return!(e!==t.activeElement||t.hasFocus&&!t.hasFocus()||!e.type&&!e.href)},active:function(e){return e===e.ownerDocument.activeElement}},setFilters:{first:function(e,t,n){return n?e.slice(1):[e[0]]},last:function(e,t,n){var r=e.pop();return n?e:[r]},even:function(e,t,n){for(var r=[],i=n?1:0,o=e.length;o>i;i+=2)r.push(e[i]);return r},odd:function(e,t,n){for(var r=[],i=n?0:1,o=e.length;o>i;i+=2)r.push(e[i]);return r},lt:function(e,t,n){return n?e.slice(+t):e.slice(0,+t)},gt:function(e,t,n){return n?e.slice(0,+t+1):e.slice(+t+1)},eq:function(e,t,n){var r=e.splice(+t,1);return n?e:r}}},N=A.compareDocumentPosition?function(e,t){return e===t?(C=!0,0):(e.compareDocumentPosition&&t.compareDocumentPosition?4&e.compareDocumentPosition(t):e.compareDocumentPosition)?-1:1}:function(e,t){if(e===t)return C=!0,0;if(e.sourceIndex&&t.sourceIndex)return e.sourceIndex-t.sourceIndex;var n,r,i=[],a=[],s=e.parentNode,u=t.parentNode,l=s;if(s===u)return o(e,t);if(!s)return-1;if(!u)return 1;for(;l;)i.unshift(l),l=l.parentNode;for(l=u;l;)a.unshift(l),l=l.parentNode;n=i.length,r=a.length;for(var c=0;n>c&&r>c;c++)if(i[c]!==a[c])return o(i[c],a[c]);return c===n?o(e,a[c],-1):o(i[c],t,1)},[0,0].sort(N),k=!C,n.uniqueSort=function(e){var t,n=1;if(C=k,e.sort(N),C)for(;t=e[n];n++)t===e[n-1]&&e.splice(n--,1);return e},n.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},T=n.compile=function(e,t,n){var r,i,o,s=q[S][e];if(s&&s.context===t)return s;for(r=a(e,t,n),i=0,o=r.length;o>i;i++)r[i]=l(r[i],t,n);return s=q(e,c(r)),s.context=t,s.runs=s.dirruns=0,s},j.querySelectorAll&&function(){var e,t=h,r=/'|\\/g,i=/\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,o=[],s=[":active"],u=A.matchesSelector||A.mozMatchesSelector||A.webkitMatchesSelector||A.oMatchesSelector||A.msMatchesSelector;rt(function(e){e.innerHTML="<select><option selected=''></option></select>",e.querySelectorAll("[selected]").length||o.push("\\["+B+"*(?:checked|disabled|ismap|multiple|readonly|selected|value)"),e.querySelectorAll(":checked").length||o.push(":checked")}),rt(function(e){e.innerHTML="<p test=''></p>",e.querySelectorAll("[test^='']").length&&o.push("[*^$]="+B+"*(?:\"\"|'')"),e.innerHTML="<input type='hidden'/>",e.querySelectorAll(":enabled").length||o.push(":enabled",":disabled")}),o=o.length&&new RegExp(o.join("|")),h=function(e,n,i,s,u){if(!(s||u||o&&o.test(e)))if(9===n.nodeType)try{return H.apply(i,L.call(n.querySelectorAll(e),0)),i}catch(l){}else if(1===n.nodeType&&"object"!==n.nodeName.toLowerCase()){var c,f,p,d=n.getAttribute("id"),h=d||S,g=V.test(e)&&n.parentNode||n;for(d?h=h.replace(r,"\\$&"):n.setAttribute("id",h),c=a(e,n,u),h="[id='"+h+"']",f=0,p=c.length;p>f;f++)c[f]=h+c[f].selector;try{return H.apply(i,L.call(g.querySelectorAll(c.join(",")),0)),i}catch(l){}finally{d||n.removeAttribute("id")}}return t(e,n,i,s,u)},u&&(rt(function(t){e=u.call(t,"div");try{u.call(t,"[test!='']:sizzle"),s.push(nt.PSEUDO.source,nt.POS.source,"!=")}catch(n){}}),s=new RegExp(s.join("|")),n.matchesSelector=function(t,r){if(r=r.replace(i,"='$1']"),!(x(t)||s.test(r)||o&&o.test(r)))try{var a=u.call(t,r);if(a||e||t.document&&11!==t.document.nodeType)return a}catch(l){}return n(r,null,null,[t]).length>0})}(),v.setFilters.nth=v.setFilters.eq,v.filters=v.pseudos,n.attr=K.attr,K.find=n,K.expr=n.selectors,K.expr[":"]=K.expr.pseudos,K.unique=n.uniqueSort,K.text=n.getText,K.isXMLDoc=n.isXML,K.contains=n.contains}(e);var _t=/Until$/,Ft=/^(?:parents|prev(?:Until|All))/,Ot=/^.[^:#\[\.,]*$/,qt=K.expr.match.needsContext,Bt={children:!0,contents:!0,next:!0,prev:!0};K.fn.extend({find:function(e){var t,n,r,i,o,a,s=this;if("string"!=typeof e)return K(e).filter(function(){for(t=0,n=s.length;n>t;t++)if(K.contains(s[t],this))return!0});for(a=this.pushStack("","find",e),t=0,n=this.length;n>t;t++)if(r=a.length,K.find(e,this[t],a),t>0)for(i=r;i<a.length;i++)for(o=0;r>o;o++)if(a[o]===a[i]){a.splice(i--,1);break}return a},has:function(e){var t,n=K(e,this),r=n.length;return this.filter(function(){for(t=0;r>t;t++)if(K.contains(this,n[t]))return!0})},not:function(e){return this.pushStack(l(this,e,!1),"not",e)},filter:function(e){return this.pushStack(l(this,e,!0),"filter",e)},is:function(e){return!!e&&("string"==typeof e?qt.test(e)?K(e,this.context).index(this[0])>=0:K.filter(e,this).length>0:this.filter(e).length>0)},closest:function(e,t){for(var n,r=0,i=this.length,o=[],a=qt.test(e)||"string"!=typeof e?K(e,t||this.context):0;i>r;r++)for(n=this[r];n&&n.ownerDocument&&n!==t&&11!==n.nodeType;){if(a?a.index(n)>-1:K.find.matchesSelector(n,e)){o.push(n);break}n=n.parentNode}return o=o.length>1?K.unique(o):o,this.pushStack(o,"closest",e)},index:function(e){return e?"string"==typeof e?K.inArray(this[0],K(e)):K.inArray(e.jquery?e[0]:e,this):this[0]&&this[0].parentNode?this.prevAll().length:-1},add:function(e,t){var n="string"==typeof e?K(e,t):K.makeArray(e&&e.nodeType?[e]:e),r=K.merge(this.get(),n);return this.pushStack(s(n[0])||s(r[0])?r:K.unique(r))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}}),K.fn.andSelf=K.fn.addBack,K.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return K.dir(e,"parentNode")},parentsUntil:function(e,t,n){return K.dir(e,"parentNode",n)},next:function(e){return u(e,"nextSibling")},prev:function(e){return u(e,"previousSibling")},nextAll:function(e){return K.dir(e,"nextSibling")},prevAll:function(e){return K.dir(e,"previousSibling")},nextUntil:function(e,t,n){return K.dir(e,"nextSibling",n)},prevUntil:function(e,t,n){return K.dir(e,"previousSibling",n)},siblings:function(e){return K.sibling((e.parentNode||{}).firstChild,e)},children:function(e){return K.sibling(e.firstChild)},contents:function(e){return K.nodeName(e,"iframe")?e.contentDocument||e.contentWindow.document:K.merge([],e.childNodes)}},function(e,t){K.fn[e]=function(n,r){var i=K.map(this,t,n);return _t.test(e)||(r=n),r&&"string"==typeof r&&(i=K.filter(r,i)),i=this.length>1&&!Bt[e]?K.unique(i):i,this.length>1&&Ft.test(e)&&(i=i.reverse()),this.pushStack(i,e,Y.call(arguments).join(","))}}),K.extend({filter:function(e,t,n){return n&&(e=":not("+e+")"),1===t.length?K.find.matchesSelector(t[0],e)?[t[0]]:[]:K.find.matches(e,t)},dir:function(e,n,r){for(var i=[],o=e[n];o&&9!==o.nodeType&&(r===t||1!==o.nodeType||!K(o).is(r));)1===o.nodeType&&i.push(o),o=o[n];return i},sibling:function(e,t){for(var n=[];e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n}});var Rt="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",Pt=/ jQuery\d+="(?:null|\d+)"/g,Wt=/^\s+/,It=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,$t=/<([\w:]+)/,zt=/<tbody/i,Xt=/<|&#?\w+;/,Ut=/<(?:script|style|link)/i,Yt=/<(?:script|object|embed|option|style)/i,Jt=new RegExp("<(?:"+Rt+")[\\s/>]","i"),Qt=/^(?:checkbox|radio)$/,Vt=/checked\s*(?:[^=]|=\s*.checked.)/i,Gt=/\/(java|ecma)script/i,Kt=/^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,Zt={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]},en=c(W),tn=en.appendChild(W.createElement("div"));
Zt.optgroup=Zt.option,Zt.tbody=Zt.tfoot=Zt.colgroup=Zt.caption=Zt.thead,Zt.th=Zt.td,K.support.htmlSerialize||(Zt._default=[1,"X<div>","</div>"]),K.fn.extend({text:function(e){return K.access(this,function(e){return e===t?K.text(this):this.empty().append((this[0]&&this[0].ownerDocument||W).createTextNode(e))},null,e,arguments.length)},wrapAll:function(e){if(K.isFunction(e))return this.each(function(t){K(this).wrapAll(e.call(this,t))});if(this[0]){var t=K(e,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){for(var e=this;e.firstChild&&1===e.firstChild.nodeType;)e=e.firstChild;return e}).append(this)}return this},wrapInner:function(e){return K.isFunction(e)?this.each(function(t){K(this).wrapInner(e.call(this,t))}):this.each(function(){var t=K(this),n=t.contents();n.length?n.wrapAll(e):t.append(e)})},wrap:function(e){var t=K.isFunction(e);return this.each(function(n){K(this).wrapAll(t?e.call(this,n):e)})},unwrap:function(){return this.parent().each(function(){K.nodeName(this,"body")||K(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,!0,function(e){(1===this.nodeType||11===this.nodeType)&&this.appendChild(e)})},prepend:function(){return this.domManip(arguments,!0,function(e){(1===this.nodeType||11===this.nodeType)&&this.insertBefore(e,this.firstChild)})},before:function(){if(!s(this[0]))return this.domManip(arguments,!1,function(e){this.parentNode.insertBefore(e,this)});if(arguments.length){var e=K.clean(arguments);return this.pushStack(K.merge(e,this),"before",this.selector)}},after:function(){if(!s(this[0]))return this.domManip(arguments,!1,function(e){this.parentNode.insertBefore(e,this.nextSibling)});if(arguments.length){var e=K.clean(arguments);return this.pushStack(K.merge(this,e),"after",this.selector)}},remove:function(e,t){for(var n,r=0;null!=(n=this[r]);r++)(!e||K.filter(e,[n]).length)&&(!t&&1===n.nodeType&&(K.cleanData(n.getElementsByTagName("*")),K.cleanData([n])),n.parentNode&&n.parentNode.removeChild(n));return this},empty:function(){for(var e,t=0;null!=(e=this[t]);t++)for(1===e.nodeType&&K.cleanData(e.getElementsByTagName("*"));e.firstChild;)e.removeChild(e.firstChild);return this},clone:function(e,t){return e=null==e?!1:e,t=null==t?e:t,this.map(function(){return K.clone(this,e,t)})},html:function(e){return K.access(this,function(e){var n=this[0]||{},r=0,i=this.length;if(e===t)return 1===n.nodeType?n.innerHTML.replace(Pt,""):t;if(!("string"!=typeof e||Ut.test(e)||!K.support.htmlSerialize&&Jt.test(e)||!K.support.leadingWhitespace&&Wt.test(e)||Zt[($t.exec(e)||["",""])[1].toLowerCase()])){e=e.replace(It,"<$1></$2>");try{for(;i>r;r++)n=this[r]||{},1===n.nodeType&&(K.cleanData(n.getElementsByTagName("*")),n.innerHTML=e);n=0}catch(o){}}n&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(e){return s(this[0])?this.length?this.pushStack(K(K.isFunction(e)?e():e),"replaceWith",e):this:K.isFunction(e)?this.each(function(t){var n=K(this),r=n.html();n.replaceWith(e.call(this,t,r))}):("string"!=typeof e&&(e=K(e).detach()),this.each(function(){var t=this.nextSibling,n=this.parentNode;K(this).remove(),t?K(t).before(e):K(n).append(e)}))},detach:function(e){return this.remove(e,!0)},domManip:function(e,n,r){e=[].concat.apply([],e);var i,o,a,s,u=0,l=e[0],c=[],p=this.length;if(!K.support.checkClone&&p>1&&"string"==typeof l&&Vt.test(l))return this.each(function(){K(this).domManip(e,n,r)});if(K.isFunction(l))return this.each(function(i){var o=K(this);e[0]=l.call(this,i,n?o.html():t),o.domManip(e,n,r)});if(this[0]){if(i=K.buildFragment(e,this,c),a=i.fragment,o=a.firstChild,1===a.childNodes.length&&(a=o),o)for(n=n&&K.nodeName(o,"tr"),s=i.cacheable||p-1;p>u;u++)r.call(n&&K.nodeName(this[u],"table")?f(this[u],"tbody"):this[u],u===s?a:K.clone(a,!0,!0));a=o=null,c.length&&K.each(c,function(e,t){t.src?K.ajax?K.ajax({url:t.src,type:"GET",dataType:"script",async:!1,global:!1,"throws":!0}):K.error("no ajax"):K.globalEval((t.text||t.textContent||t.innerHTML||"").replace(Kt,"")),t.parentNode&&t.parentNode.removeChild(t)})}return this}}),K.buildFragment=function(e,n,r){var i,o,a,s=e[0];return n=n||W,n=!n.nodeType&&n[0]||n,n=n.ownerDocument||n,1===e.length&&"string"==typeof s&&s.length<512&&n===W&&"<"===s.charAt(0)&&!Yt.test(s)&&(K.support.checkClone||!Vt.test(s))&&(K.support.html5Clone||!Jt.test(s))&&(o=!0,i=K.fragments[s],a=i!==t),i||(i=n.createDocumentFragment(),K.clean(e,n,i,r),o&&(K.fragments[s]=a&&i)),{fragment:i,cacheable:o}},K.fragments={},K.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,t){K.fn[e]=function(n){var r,i=0,o=[],a=K(n),s=a.length,u=1===this.length&&this[0].parentNode;if((null==u||u&&11===u.nodeType&&1===u.childNodes.length)&&1===s)return a[t](this[0]),this;for(;s>i;i++)r=(i>0?this.clone(!0):this).get(),K(a[i])[t](r),o=o.concat(r);return this.pushStack(o,e,a.selector)}}),K.extend({clone:function(e,t,n){var r,i,o,a;if(K.support.html5Clone||K.isXMLDoc(e)||!Jt.test("<"+e.nodeName+">")?a=e.cloneNode(!0):(tn.innerHTML=e.outerHTML,tn.removeChild(a=tn.firstChild)),!(K.support.noCloneEvent&&K.support.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||K.isXMLDoc(e)))for(d(e,a),r=h(e),i=h(a),o=0;r[o];++o)i[o]&&d(r[o],i[o]);if(t&&(p(e,a),n))for(r=h(e),i=h(a),o=0;r[o];++o)p(r[o],i[o]);return r=i=null,a},clean:function(e,t,n,r){var i,o,a,s,u,l,f,p,d,h,m,y=t===W&&en,v=[];for(t&&"undefined"!=typeof t.createDocumentFragment||(t=W),i=0;null!=(a=e[i]);i++)if("number"==typeof a&&(a+=""),a){if("string"==typeof a)if(Xt.test(a)){for(y=y||c(t),f=t.createElement("div"),y.appendChild(f),a=a.replace(It,"<$1></$2>"),s=($t.exec(a)||["",""])[1].toLowerCase(),u=Zt[s]||Zt._default,l=u[0],f.innerHTML=u[1]+a+u[2];l--;)f=f.lastChild;if(!K.support.tbody)for(p=zt.test(a),d="table"!==s||p?"<table>"!==u[1]||p?[]:f.childNodes:f.firstChild&&f.firstChild.childNodes,o=d.length-1;o>=0;--o)K.nodeName(d[o],"tbody")&&!d[o].childNodes.length&&d[o].parentNode.removeChild(d[o]);!K.support.leadingWhitespace&&Wt.test(a)&&f.insertBefore(t.createTextNode(Wt.exec(a)[0]),f.firstChild),a=f.childNodes,f.parentNode.removeChild(f)}else a=t.createTextNode(a);a.nodeType?v.push(a):K.merge(v,a)}if(f&&(a=f=y=null),!K.support.appendChecked)for(i=0;null!=(a=v[i]);i++)K.nodeName(a,"input")?g(a):"undefined"!=typeof a.getElementsByTagName&&K.grep(a.getElementsByTagName("input"),g);if(n)for(h=function(e){return!e.type||Gt.test(e.type)?r?r.push(e.parentNode?e.parentNode.removeChild(e):e):n.appendChild(e):void 0},i=0;null!=(a=v[i]);i++)K.nodeName(a,"script")&&h(a)||(n.appendChild(a),"undefined"!=typeof a.getElementsByTagName&&(m=K.grep(K.merge([],a.getElementsByTagName("script")),h),v.splice.apply(v,[i+1,0].concat(m)),i+=m.length));return v},cleanData:function(e,t){for(var n,r,i,o,a=0,s=K.expando,u=K.cache,l=K.support.deleteExpando,c=K.event.special;null!=(i=e[a]);a++)if((t||K.acceptData(i))&&(r=i[s],n=r&&u[r])){if(n.events)for(o in n.events)c[o]?K.event.remove(i,o):K.removeEvent(i,o,n.handle);u[r]&&(delete u[r],l?delete i[s]:i.removeAttribute?i.removeAttribute(s):i[s]=null,K.deletedIds.push(r))}}}),function(){var e,t;K.uaMatch=function(e){e=e.toLowerCase();var t=/(chrome)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||e.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)||[];return{browser:t[1]||"",version:t[2]||"0"}},e=K.uaMatch($.userAgent),t={},e.browser&&(t[e.browser]=!0,t.version=e.version),t.chrome?t.webkit=!0:t.webkit&&(t.safari=!0),K.browser=t,K.sub=function(){function e(t,n){return new e.fn.init(t,n)}K.extend(!0,e,this),e.superclass=this,e.fn=e.prototype=this(),e.fn.constructor=e,e.sub=this.sub,e.fn.init=function n(n,r){return r&&r instanceof K&&!(r instanceof e)&&(r=e(r)),K.fn.init.call(this,n,r,t)},e.fn.init.prototype=e.fn;var t=e(W);return e}}();var nn,rn,on,an=/alpha\([^)]*\)/i,sn=/opacity=([^)]*)/,un=/^(top|right|bottom|left)$/,ln=/^(none|table(?!-c[ea]).+)/,cn=/^margin/,fn=new RegExp("^("+Z+")(.*)$","i"),pn=new RegExp("^("+Z+")(?!px)[a-z%]+$","i"),dn=new RegExp("^([-+])=("+Z+")","i"),hn={},gn={position:"absolute",visibility:"hidden",display:"block"},mn={letterSpacing:0,fontWeight:400},yn=["Top","Right","Bottom","Left"],vn=["Webkit","O","Moz","ms"],bn=K.fn.toggle;K.fn.extend({css:function(e,n){return K.access(this,function(e,n,r){return r!==t?K.style(e,n,r):K.css(e,n)},e,n,arguments.length>1)},show:function(){return v(this,!0)},hide:function(){return v(this)},toggle:function(e,t){var n="boolean"==typeof e;return K.isFunction(e)&&K.isFunction(t)?bn.apply(this,arguments):this.each(function(){(n?e:y(this))?K(this).show():K(this).hide()})}}),K.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=nn(e,"opacity");return""===n?"1":n}}}},cssNumber:{fillOpacity:!0,fontWeight:!0,lineHeight:!0,opacity:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":K.support.cssFloat?"cssFloat":"styleFloat"},style:function(e,n,r,i){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var o,a,s,u=K.camelCase(n),l=e.style;if(n=K.cssProps[u]||(K.cssProps[u]=m(l,u)),s=K.cssHooks[n]||K.cssHooks[u],r===t)return s&&"get"in s&&(o=s.get(e,!1,i))!==t?o:l[n];if(a=typeof r,"string"===a&&(o=dn.exec(r))&&(r=(o[1]+1)*o[2]+parseFloat(K.css(e,n)),a="number"),!(null==r||"number"===a&&isNaN(r)||("number"===a&&!K.cssNumber[u]&&(r+="px"),s&&"set"in s&&(r=s.set(e,r,i))===t)))try{l[n]=r}catch(c){}}},css:function(e,n,r,i){var o,a,s,u=K.camelCase(n);return n=K.cssProps[u]||(K.cssProps[u]=m(e.style,u)),s=K.cssHooks[n]||K.cssHooks[u],s&&"get"in s&&(o=s.get(e,!0,i)),o===t&&(o=nn(e,n)),"normal"===o&&n in mn&&(o=mn[n]),r||i!==t?(a=parseFloat(o),r||K.isNumeric(a)?a||0:o):o},swap:function(e,t,n){var r,i,o={};for(i in t)o[i]=e.style[i],e.style[i]=t[i];r=n.call(e);for(i in t)e.style[i]=o[i];return r}}),e.getComputedStyle?nn=function(t,n){var r,i,o,a,s=e.getComputedStyle(t,null),u=t.style;return s&&(r=s[n],""===r&&!K.contains(t.ownerDocument,t)&&(r=K.style(t,n)),pn.test(r)&&cn.test(n)&&(i=u.width,o=u.minWidth,a=u.maxWidth,u.minWidth=u.maxWidth=u.width=r,r=s.width,u.width=i,u.minWidth=o,u.maxWidth=a)),r}:W.documentElement.currentStyle&&(nn=function(e,t){var n,r,i=e.currentStyle&&e.currentStyle[t],o=e.style;return null==i&&o&&o[t]&&(i=o[t]),pn.test(i)&&!un.test(t)&&(n=o.left,r=e.runtimeStyle&&e.runtimeStyle.left,r&&(e.runtimeStyle.left=e.currentStyle.left),o.left="fontSize"===t?"1em":i,i=o.pixelLeft+"px",o.left=n,r&&(e.runtimeStyle.left=r)),""===i?"auto":i}),K.each(["height","width"],function(e,t){K.cssHooks[t]={get:function(e,n,r){return n?0===e.offsetWidth&&ln.test(nn(e,"display"))?K.swap(e,gn,function(){return w(e,t,r)}):w(e,t,r):void 0},set:function(e,n,r){return b(e,n,r?x(e,t,r,K.support.boxSizing&&"border-box"===K.css(e,"boxSizing")):0)}}}),K.support.opacity||(K.cssHooks.opacity={get:function(e,t){return sn.test((t&&e.currentStyle?e.currentStyle.filter:e.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""},set:function(e,t){var n=e.style,r=e.currentStyle,i=K.isNumeric(t)?"alpha(opacity="+100*t+")":"",o=r&&r.filter||n.filter||"";n.zoom=1,t>=1&&""===K.trim(o.replace(an,""))&&n.removeAttribute&&(n.removeAttribute("filter"),r&&!r.filter)||(n.filter=an.test(o)?o.replace(an,i):o+" "+i)}}),K(function(){K.support.reliableMarginRight||(K.cssHooks.marginRight={get:function(e,t){return K.swap(e,{display:"inline-block"},function(){return t?nn(e,"marginRight"):void 0})}}),!K.support.pixelPosition&&K.fn.position&&K.each(["top","left"],function(e,t){K.cssHooks[t]={get:function(e,n){if(n){var r=nn(e,t);return pn.test(r)?K(e).position()[t]+"px":r}}}})}),K.expr&&K.expr.filters&&(K.expr.filters.hidden=function(e){return 0===e.offsetWidth&&0===e.offsetHeight||!K.support.reliableHiddenOffsets&&"none"===(e.style&&e.style.display||nn(e,"display"))},K.expr.filters.visible=function(e){return!K.expr.filters.hidden(e)}),K.each({margin:"",padding:"",border:"Width"},function(e,t){K.cssHooks[e+t]={expand:function(n){var r,i="string"==typeof n?n.split(" "):[n],o={};for(r=0;4>r;r++)o[e+yn[r]+t]=i[r]||i[r-2]||i[0];return o}},cn.test(e)||(K.cssHooks[e+t].set=b)});var xn=/%20/g,wn=/\[\]$/,Tn=/\r?\n/g,Nn=/^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,Cn=/^(?:select|textarea)/i;K.fn.extend({serialize:function(){return K.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?K.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||Cn.test(this.nodeName)||Nn.test(this.type))}).map(function(e,t){var n=K(this).val();return null==n?null:K.isArray(n)?K.map(n,function(e){return{name:t.name,value:e.replace(Tn,"\r\n")}}):{name:t.name,value:n.replace(Tn,"\r\n")}}).get()}}),K.param=function(e,n){var r,i=[],o=function(e,t){t=K.isFunction(t)?t():null==t?"":t,i[i.length]=encodeURIComponent(e)+"="+encodeURIComponent(t)};if(n===t&&(n=K.ajaxSettings&&K.ajaxSettings.traditional),K.isArray(e)||e.jquery&&!K.isPlainObject(e))K.each(e,function(){o(this.name,this.value)});else for(r in e)N(r,e[r],n,o);return i.join("&").replace(xn,"+")};var kn,En,Sn=/#.*$/,jn=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,An=/^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,Dn=/^(?:GET|HEAD)$/,Ln=/^\/\//,Hn=/\?/,Mn=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,_n=/([?&])_=[^&]*/,Fn=/^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,On=K.fn.load,qn={},Bn={},Rn=["*/"]+["*"];try{kn=I.href}catch(Pn){kn=W.createElement("a"),kn.href="",kn=kn.href}En=Fn.exec(kn.toLowerCase())||[],K.fn.load=function(e,n,r){if("string"!=typeof e&&On)return On.apply(this,arguments);if(!this.length)return this;var i,o,a,s=this,u=e.indexOf(" ");return u>=0&&(i=e.slice(u,e.length),e=e.slice(0,u)),K.isFunction(n)?(r=n,n=t):n&&"object"==typeof n&&(o="POST"),K.ajax({url:e,type:o,dataType:"html",data:n,complete:function(e,t){r&&s.each(r,a||[e.responseText,t,e])}}).done(function(e){a=arguments,s.html(i?K("<div>").append(e.replace(Mn,"")).find(i):e)}),this},K.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(e,t){K.fn[t]=function(e){return this.on(t,e)}}),K.each(["get","post"],function(e,n){K[n]=function(e,r,i,o){return K.isFunction(r)&&(o=o||i,i=r,r=t),K.ajax({type:n,url:e,data:r,success:i,dataType:o})}}),K.extend({getScript:function(e,n){return K.get(e,t,n,"script")},getJSON:function(e,t,n){return K.get(e,t,n,"json")},ajaxSetup:function(e,t){return t?E(e,K.ajaxSettings):(t=e,e=K.ajaxSettings),E(e,t),e},ajaxSettings:{url:kn,isLocal:An.test(En[1]),global:!0,type:"GET",contentType:"application/x-www-form-urlencoded; charset=UTF-8",processData:!0,async:!0,accepts:{xml:"application/xml, text/xml",html:"text/html",text:"text/plain",json:"application/json, text/javascript","*":Rn},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText"},converters:{"* text":e.String,"text html":!0,"text json":K.parseJSON,"text xml":K.parseXML},flatOptions:{context:!0,url:!0}},ajaxPrefilter:C(qn),ajaxTransport:C(Bn),ajax:function(e,n){function r(e,n,r,a){var l,f,v,b,w,N=n;2!==x&&(x=2,u&&clearTimeout(u),s=t,o=a||"",T.readyState=e>0?4:0,r&&(b=S(p,T,r)),e>=200&&300>e||304===e?(p.ifModified&&(w=T.getResponseHeader("Last-Modified"),w&&(K.lastModified[i]=w),w=T.getResponseHeader("Etag"),w&&(K.etag[i]=w)),304===e?(N="notmodified",l=!0):(l=j(p,b),N=l.state,f=l.data,v=l.error,l=!v)):(v=N,(!N||e)&&(N="error",0>e&&(e=0))),T.status=e,T.statusText=""+(n||N),l?g.resolveWith(d,[f,N,T]):g.rejectWith(d,[T,N,v]),T.statusCode(y),y=t,c&&h.trigger("ajax"+(l?"Success":"Error"),[T,p,l?f:v]),m.fireWith(d,[T,N]),c&&(h.trigger("ajaxComplete",[T,p]),--K.active||K.event.trigger("ajaxStop")))}"object"==typeof e&&(n=e,e=t),n=n||{};var i,o,a,s,u,l,c,f,p=K.ajaxSetup({},n),d=p.context||p,h=d!==p&&(d.nodeType||d instanceof K)?K(d):K.event,g=K.Deferred(),m=K.Callbacks("once memory"),y=p.statusCode||{},v={},b={},x=0,w="canceled",T={readyState:0,setRequestHeader:function(e,t){if(!x){var n=e.toLowerCase();e=b[n]=b[n]||e,v[e]=t}return this},getAllResponseHeaders:function(){return 2===x?o:null},getResponseHeader:function(e){var n;if(2===x){if(!a)for(a={};n=jn.exec(o);)a[n[1].toLowerCase()]=n[2];n=a[e.toLowerCase()]}return n===t?null:n},overrideMimeType:function(e){return x||(p.mimeType=e),this},abort:function(e){return e=e||w,s&&s.abort(e),r(0,e),this}};if(g.promise(T),T.success=T.done,T.error=T.fail,T.complete=m.add,T.statusCode=function(e){if(e){var t;if(2>x)for(t in e)y[t]=[y[t],e[t]];else t=e[T.status],T.always(t)}return this},p.url=((e||p.url)+"").replace(Sn,"").replace(Ln,En[1]+"//"),p.dataTypes=K.trim(p.dataType||"*").toLowerCase().split(tt),null==p.crossDomain&&(l=Fn.exec(p.url.toLowerCase()),p.crossDomain=!(!l||l[1]==En[1]&&l[2]==En[2]&&(l[3]||("http:"===l[1]?80:443))==(En[3]||("http:"===En[1]?80:443)))),p.data&&p.processData&&"string"!=typeof p.data&&(p.data=K.param(p.data,p.traditional)),k(qn,p,n,T),2===x)return T;if(c=p.global,p.type=p.type.toUpperCase(),p.hasContent=!Dn.test(p.type),c&&0===K.active++&&K.event.trigger("ajaxStart"),!p.hasContent&&(p.data&&(p.url+=(Hn.test(p.url)?"&":"?")+p.data,delete p.data),i=p.url,p.cache===!1)){var N=K.now(),C=p.url.replace(_n,"$1_="+N);p.url=C+(C===p.url?(Hn.test(p.url)?"&":"?")+"_="+N:"")}(p.data&&p.hasContent&&p.contentType!==!1||n.contentType)&&T.setRequestHeader("Content-Type",p.contentType),p.ifModified&&(i=i||p.url,K.lastModified[i]&&T.setRequestHeader("If-Modified-Since",K.lastModified[i]),K.etag[i]&&T.setRequestHeader("If-None-Match",K.etag[i])),T.setRequestHeader("Accept",p.dataTypes[0]&&p.accepts[p.dataTypes[0]]?p.accepts[p.dataTypes[0]]+("*"!==p.dataTypes[0]?", "+Rn+"; q=0.01":""):p.accepts["*"]);for(f in p.headers)T.setRequestHeader(f,p.headers[f]);if(!p.beforeSend||p.beforeSend.call(d,T,p)!==!1&&2!==x){w="abort";for(f in{success:1,error:1,complete:1})T[f](p[f]);if(s=k(Bn,p,n,T)){T.readyState=1,c&&h.trigger("ajaxSend",[T,p]),p.async&&p.timeout>0&&(u=setTimeout(function(){T.abort("timeout")},p.timeout));try{x=1,s.send(v,r)}catch(E){if(!(2>x))throw E;r(-1,E)}}else r(-1,"No Transport");return T}return T.abort()},active:0,lastModified:{},etag:{}});var Wn=[],In=/\?/,$n=/(=)\?(?=&|$)|\?\?/,zn=K.now();K.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=Wn.pop()||K.expando+"_"+zn++;return this[e]=!0,e}}),K.ajaxPrefilter("json jsonp",function(n,r,i){var o,a,s,u=n.data,l=n.url,c=n.jsonp!==!1,f=c&&$n.test(l),p=c&&!f&&"string"==typeof u&&!(n.contentType||"").indexOf("application/x-www-form-urlencoded")&&$n.test(u);return"jsonp"===n.dataTypes[0]||f||p?(o=n.jsonpCallback=K.isFunction(n.jsonpCallback)?n.jsonpCallback():n.jsonpCallback,a=e[o],f?n.url=l.replace($n,"$1"+o):p?n.data=u.replace($n,"$1"+o):c&&(n.url+=(In.test(l)?"&":"?")+n.jsonp+"="+o),n.converters["script json"]=function(){return s||K.error(o+" was not called"),s[0]},n.dataTypes[0]="json",e[o]=function(){s=arguments},i.always(function(){e[o]=a,n[o]&&(n.jsonpCallback=r.jsonpCallback,Wn.push(o)),s&&K.isFunction(a)&&a(s[0]),s=a=t}),"script"):void 0}),K.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/javascript|ecmascript/},converters:{"text script":function(e){return K.globalEval(e),e}}}),K.ajaxPrefilter("script",function(e){e.cache===t&&(e.cache=!1),e.crossDomain&&(e.type="GET",e.global=!1)}),K.ajaxTransport("script",function(e){if(e.crossDomain){var n,r=W.head||W.getElementsByTagName("head")[0]||W.documentElement;return{send:function(i,o){n=W.createElement("script"),n.async="async",e.scriptCharset&&(n.charset=e.scriptCharset),n.src=e.url,n.onload=n.onreadystatechange=function(e,i){(i||!n.readyState||/loaded|complete/.test(n.readyState))&&(n.onload=n.onreadystatechange=null,r&&n.parentNode&&r.removeChild(n),n=t,i||o(200,"success"))},r.insertBefore(n,r.firstChild)},abort:function(){n&&n.onload(0,1)}}}});var Xn,Un=e.ActiveXObject?function(){for(var e in Xn)Xn[e](0,1)}:!1,Yn=0;K.ajaxSettings.xhr=e.ActiveXObject?function(){return!this.isLocal&&A()||D()}:A,function(e){K.extend(K.support,{ajax:!!e,cors:!!e&&"withCredentials"in e})}(K.ajaxSettings.xhr()),K.support.ajax&&K.ajaxTransport(function(n){if(!n.crossDomain||K.support.cors){var r;return{send:function(i,o){var a,s,u=n.xhr();if(n.username?u.open(n.type,n.url,n.async,n.username,n.password):u.open(n.type,n.url,n.async),n.xhrFields)for(s in n.xhrFields)u[s]=n.xhrFields[s];n.mimeType&&u.overrideMimeType&&u.overrideMimeType(n.mimeType),!n.crossDomain&&!i["X-Requested-With"]&&(i["X-Requested-With"]="XMLHttpRequest");try{for(s in i)u.setRequestHeader(s,i[s])}catch(l){}u.send(n.hasContent&&n.data||null),r=function(e,i){var s,l,c,f,p;try{if(r&&(i||4===u.readyState))if(r=t,a&&(u.onreadystatechange=K.noop,Un&&delete Xn[a]),i)4!==u.readyState&&u.abort();else{s=u.status,c=u.getAllResponseHeaders(),f={},p=u.responseXML,p&&p.documentElement&&(f.xml=p);try{f.text=u.responseText}catch(e){}try{l=u.statusText}catch(d){l=""}s||!n.isLocal||n.crossDomain?1223===s&&(s=204):s=f.text?200:404}}catch(h){i||o(-1,h)}f&&o(s,l,f,c)},n.async?4===u.readyState?setTimeout(r,0):(a=++Yn,Un&&(Xn||(Xn={},K(e).unload(Un)),Xn[a]=r),u.onreadystatechange=r):r()},abort:function(){r&&r(0,1)}}}});var Jn,Qn,Vn=/^(?:toggle|show|hide)$/,Gn=new RegExp("^(?:([-+])=|)("+Z+")([a-z%]*)$","i"),Kn=/queueHooks$/,Zn=[F],er={"*":[function(e,t){var n,r,i,o=this.createTween(e,t),a=Gn.exec(t),s=o.cur(),u=+s||0,l=1;if(a){if(n=+a[2],r=a[3]||(K.cssNumber[e]?"":"px"),"px"!==r&&u){u=K.css(o.elem,e,!0)||n||1;do i=l=l||".5",u/=l,K.style(o.elem,e,u+r),l=o.cur()/s;while(1!==l&&l!==i)}o.unit=r,o.start=u,o.end=a[1]?u+(a[1]+1)*n:n}return o}]};K.Animation=K.extend(M,{tweener:function(e,t){K.isFunction(e)?(t=e,e=["*"]):e=e.split(" ");for(var n,r=0,i=e.length;i>r;r++)n=e[r],er[n]=er[n]||[],er[n].unshift(t)},prefilter:function(e,t){t?Zn.unshift(e):Zn.push(e)}}),K.Tween=O,O.prototype={constructor:O,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||"swing",this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(K.cssNumber[n]?"":"px")},cur:function(){var e=O.propHooks[this.prop];return e&&e.get?e.get(this):O.propHooks._default.get(this)},run:function(e){var t,n=O.propHooks[this.prop];return this.pos=t=this.options.duration?K.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):O.propHooks._default.set(this),this}},O.prototype.init.prototype=O.prototype,O.propHooks={_default:{get:function(e){var t;return null==e.elem[e.prop]||e.elem.style&&null!=e.elem.style[e.prop]?(t=K.css(e.elem,e.prop,!1,""),t&&"auto"!==t?t:0):e.elem[e.prop]},set:function(e){K.fx.step[e.prop]?K.fx.step[e.prop](e):e.elem.style&&(null!=e.elem.style[K.cssProps[e.prop]]||K.cssHooks[e.prop])?K.style(e.elem,e.prop,e.now+e.unit):e.elem[e.prop]=e.now}}},O.propHooks.scrollTop=O.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},K.each(["toggle","show","hide"],function(e,t){var n=K.fn[t];K.fn[t]=function(r,i,o){return null==r||"boolean"==typeof r||!e&&K.isFunction(r)&&K.isFunction(i)?n.apply(this,arguments):this.animate(q(t,!0),r,i,o)}}),K.fn.extend({fadeTo:function(e,t,n,r){return this.filter(y).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(e,t,n,r){var i=K.isEmptyObject(e),o=K.speed(t,n,r),a=function(){var t=M(this,K.extend({},e),o);i&&t.stop(!0)};return i||o.queue===!1?this.each(a):this.queue(o.queue,a)},stop:function(e,n,r){var i=function(e){var t=e.stop;delete e.stop,t(r)};return"string"!=typeof e&&(r=n,n=e,e=t),n&&e!==!1&&this.queue(e||"fx",[]),this.each(function(){var t=!0,n=null!=e&&e+"queueHooks",o=K.timers,a=K._data(this);if(n)a[n]&&a[n].stop&&i(a[n]);else for(n in a)a[n]&&a[n].stop&&Kn.test(n)&&i(a[n]);for(n=o.length;n--;)o[n].elem===this&&(null==e||o[n].queue===e)&&(o[n].anim.stop(r),t=!1,o.splice(n,1));(t||!r)&&K.dequeue(this,e)})}}),K.each({slideDown:q("show"),slideUp:q("hide"),slideToggle:q("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,t){K.fn[e]=function(e,n,r){return this.animate(t,e,n,r)}}),K.speed=function(e,t,n){var r=e&&"object"==typeof e?K.extend({},e):{complete:n||!n&&t||K.isFunction(e)&&e,duration:e,easing:n&&t||t&&!K.isFunction(t)&&t};return r.duration=K.fx.off?0:"number"==typeof r.duration?r.duration:r.duration in K.fx.speeds?K.fx.speeds[r.duration]:K.fx.speeds._default,(null==r.queue||r.queue===!0)&&(r.queue="fx"),r.old=r.complete,r.complete=function(){K.isFunction(r.old)&&r.old.call(this),r.queue&&K.dequeue(this,r.queue)},r},K.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2}},K.timers=[],K.fx=O.prototype.init,K.fx.tick=function(){for(var e,t=K.timers,n=0;n<t.length;n++)e=t[n],!e()&&t[n]===e&&t.splice(n--,1);t.length||K.fx.stop()},K.fx.timer=function(e){e()&&K.timers.push(e)&&!Qn&&(Qn=setInterval(K.fx.tick,K.fx.interval))},K.fx.interval=13,K.fx.stop=function(){clearInterval(Qn),Qn=null},K.fx.speeds={slow:600,fast:200,_default:400},K.fx.step={},K.expr&&K.expr.filters&&(K.expr.filters.animated=function(e){return K.grep(K.timers,function(t){return e===t.elem}).length});var tr=/^(?:body|html)$/i;K.fn.offset=function(e){if(arguments.length)return e===t?this:this.each(function(t){K.offset.setOffset(this,e,t)});var n,r,i,o,a,s,u,l,c,f,p=this[0],d=p&&p.ownerDocument;if(d)return(i=d.body)===p?K.offset.bodyOffset(p):(r=d.documentElement,K.contains(r,p)?(n=p.getBoundingClientRect(),o=B(d),a=r.clientTop||i.clientTop||0,s=r.clientLeft||i.clientLeft||0,u=o.pageYOffset||r.scrollTop,l=o.pageXOffset||r.scrollLeft,c=n.top+u-a,f=n.left+l-s,{top:c,left:f}):{top:0,left:0})},K.offset={bodyOffset:function(e){var t=e.offsetTop,n=e.offsetLeft;return K.support.doesNotIncludeMarginInBodyOffset&&(t+=parseFloat(K.css(e,"marginTop"))||0,n+=parseFloat(K.css(e,"marginLeft"))||0),{top:t,left:n}},setOffset:function(e,t,n){var r=K.css(e,"position");"static"===r&&(e.style.position="relative");var i,o,a=K(e),s=a.offset(),u=K.css(e,"top"),l=K.css(e,"left"),c=("absolute"===r||"fixed"===r)&&K.inArray("auto",[u,l])>-1,f={},p={};c?(p=a.position(),i=p.top,o=p.left):(i=parseFloat(u)||0,o=parseFloat(l)||0),K.isFunction(t)&&(t=t.call(e,n,s)),null!=t.top&&(f.top=t.top-s.top+i),null!=t.left&&(f.left=t.left-s.left+o),"using"in t?t.using.call(e,f):a.css(f)}},K.fn.extend({position:function(){if(this[0]){var e=this[0],t=this.offsetParent(),n=this.offset(),r=tr.test(t[0].nodeName)?{top:0,left:0}:t.offset();return n.top-=parseFloat(K.css(e,"marginTop"))||0,n.left-=parseFloat(K.css(e,"marginLeft"))||0,r.top+=parseFloat(K.css(t[0],"borderTopWidth"))||0,r.left+=parseFloat(K.css(t[0],"borderLeftWidth"))||0,{top:n.top-r.top,left:n.left-r.left}}},offsetParent:function(){return this.map(function(){for(var e=this.offsetParent||W.body;e&&!tr.test(e.nodeName)&&"static"===K.css(e,"position");)e=e.offsetParent;return e||W.body})}}),K.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(e,n){var r=/Y/.test(n);K.fn[e]=function(i){return K.access(this,function(e,i,o){var a=B(e);return o===t?a?n in a?a[n]:a.document.documentElement[i]:e[i]:(a?a.scrollTo(r?K(a).scrollLeft():o,r?o:K(a).scrollTop()):e[i]=o,void 0)},e,i,arguments.length,null)}}),K.each({Height:"height",Width:"width"},function(e,n){K.each({padding:"inner"+e,content:n,"":"outer"+e},function(r,i){K.fn[i]=function(i,o){var a=arguments.length&&(r||"boolean"!=typeof i),s=r||(i===!0||o===!0?"margin":"border");return K.access(this,function(n,r,i){var o;return K.isWindow(n)?n.document.documentElement["client"+e]:9===n.nodeType?(o=n.documentElement,Math.max(n.body["scroll"+e],o["scroll"+e],n.body["offset"+e],o["offset"+e],o["client"+e])):i===t?K.css(n,r,i,s):K.style(n,r,i,s)},n,a?i:t,a,null)}})}),e.jQuery=e.$=K,"function"==typeof define&&define.amd&&define.amd.jQuery&&define("jquery",[],function(){return K})}(window),function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)}(function(e){function t(e){return e}function n(e){return decodeURIComponent(e.replace(i," "))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return o.json?JSON.parse(e):e}catch(t){}}var i=/\+/g,o=e.cookie=function(i,a,s){if(void 0!==a){if(s=e.extend({},o.defaults,s),"number"==typeof s.expires){var u=s.expires,l=s.expires=new Date;l.setDate(l.getDate()+u)}return a=o.json?JSON.stringify(a):String(a),document.cookie=[o.raw?i:encodeURIComponent(i),"=",o.raw?a:encodeURIComponent(a),s.expires?"; expires="+s.expires.toUTCString():"",s.path?"; path="+s.path:"",s.domain?"; domain="+s.domain:"",s.secure?"; secure":""].join("")}for(var c=o.raw?t:n,f=document.cookie.split("; "),p=i?void 0:{},d=0,h=f.length;h>d;d++){var g=f[d].split("="),m=c(g.shift()),y=c(g.join("="));if(i&&i===m){p=r(y);break}i||(p[m]=r(y))}return p};o.defaults={},e.removeCookie=function(t,n){return void 0!==e.cookie(t)?(e.cookie(t,"",e.extend({},n,{expires:-1})),!0):!1}}),function(e,t){function n(e,t,n){var r=f[t.type]||{};return null==e?n||!t.def?null:t.def:(e=r.floor?~~e:parseFloat(e),isNaN(e)?t.def:r.mod?(e+r.mod)%r.mod:0>e?0:r.max<e?r.max:e)}function r(t){var n=l(),r=n._rgba=[];return t=t.toLowerCase(),h(u,function(e,i){var o,a=i.re.exec(t),s=a&&i.parse(a),u=i.space||"rgba";return s?(o=n[u](s),n[c[u].cache]=o[c[u].cache],r=n._rgba=o._rgba,!1):void 0}),r.length?("0,0,0,0"===r.join()&&e.extend(r,o.transparent),n):o[t]}function i(e,t,n){return n=(n+1)%1,1>6*n?e+6*(t-e)*n:1>2*n?t:2>3*n?e+6*(t-e)*(2/3-n):e}var o,a="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",s=/^([\-+])=\s*(\d+\.?\d*)/,u=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[e[1],e[2],e[3],e[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[2.55*e[1],2.55*e[2],2.55*e[3],e[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(e){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(e){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(e){return[e[1],e[2]/100,e[3]/100,e[4]]}}],l=e.Color=function(t,n,r,i){return new e.Color.fn.parse(t,n,r,i)},c={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},f={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},p=l.support={},d=e("<p>")[0],h=e.each;d.style.cssText="background-color:rgba(1,1,1,.5)",p.rgba=d.style.backgroundColor.indexOf("rgba")>-1,h(c,function(e,t){t.cache="_"+e,t.props.alpha={idx:3,type:"percent",def:1}}),l.fn=e.extend(l.prototype,{parse:function(i,a,s,u){if(i===t)return this._rgba=[null,null,null,null],this;(i.jquery||i.nodeType)&&(i=e(i).css(a),a=t);var f=this,p=e.type(i),d=this._rgba=[];return a!==t&&(i=[i,a,s,u],p="array"),"string"===p?this.parse(r(i)||o._default):"array"===p?(h(c.rgba.props,function(e,t){d[t.idx]=n(i[t.idx],t)}),this):"object"===p?(i instanceof l?h(c,function(e,t){i[t.cache]&&(f[t.cache]=i[t.cache].slice())}):h(c,function(t,r){var o=r.cache;h(r.props,function(e,t){if(!f[o]&&r.to){if("alpha"===e||null==i[e])return;f[o]=r.to(f._rgba)}f[o][t.idx]=n(i[e],t,!0)}),f[o]&&e.inArray(null,f[o].slice(0,3))<0&&(f[o][3]=1,r.from&&(f._rgba=r.from(f[o])))}),this):void 0},is:function(e){var t=l(e),n=!0,r=this;return h(c,function(e,i){var o,a=t[i.cache];return a&&(o=r[i.cache]||i.to&&i.to(r._rgba)||[],h(i.props,function(e,t){return null!=a[t.idx]?n=a[t.idx]===o[t.idx]:void 0
})),n}),n},_space:function(){var e=[],t=this;return h(c,function(n,r){t[r.cache]&&e.push(n)}),e.pop()},transition:function(e,t){var r=l(e),i=r._space(),o=c[i],a=0===this.alpha()?l("transparent"):this,s=a[o.cache]||o.to(a._rgba),u=s.slice();return r=r[o.cache],h(o.props,function(e,i){var o=i.idx,a=s[o],l=r[o],c=f[i.type]||{};null!==l&&(null===a?u[o]=l:(c.mod&&(l-a>c.mod/2?a+=c.mod:a-l>c.mod/2&&(a-=c.mod)),u[o]=n((l-a)*t+a,i)))}),this[i](u)},blend:function(t){if(1===this._rgba[3])return this;var n=this._rgba.slice(),r=n.pop(),i=l(t)._rgba;return l(e.map(n,function(e,t){return(1-r)*i[t]+r*e}))},toRgbaString:function(){var t="rgba(",n=e.map(this._rgba,function(e,t){return null==e?t>2?1:0:e});return 1===n[3]&&(n.pop(),t="rgb("),t+n.join()+")"},toHslaString:function(){var t="hsla(",n=e.map(this.hsla(),function(e,t){return null==e&&(e=t>2?1:0),t&&3>t&&(e=Math.round(100*e)+"%"),e});return 1===n[3]&&(n.pop(),t="hsl("),t+n.join()+")"},toHexString:function(t){var n=this._rgba.slice(),r=n.pop();return t&&n.push(~~(255*r)),"#"+e.map(n,function(e){return e=(e||0).toString(16),1===e.length?"0"+e:e}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),l.fn.parse.prototype=l.fn,c.hsla.to=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t,n,r=e[0]/255,i=e[1]/255,o=e[2]/255,a=e[3],s=Math.max(r,i,o),u=Math.min(r,i,o),l=s-u,c=s+u,f=.5*c;return t=u===s?0:r===s?60*(i-o)/l+360:i===s?60*(o-r)/l+120:60*(r-i)/l+240,n=0===l?0:.5>=f?l/c:l/(2-c),[Math.round(t)%360,n,f,null==a?1:a]},c.hsla.from=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t=e[0]/360,n=e[1],r=e[2],o=e[3],a=.5>=r?r*(1+n):r+n-r*n,s=2*r-a;return[Math.round(255*i(s,a,t+1/3)),Math.round(255*i(s,a,t)),Math.round(255*i(s,a,t-1/3)),o]},h(c,function(r,i){var o=i.props,a=i.cache,u=i.to,c=i.from;l.fn[r]=function(r){if(u&&!this[a]&&(this[a]=u(this._rgba)),r===t)return this[a].slice();var i,s=e.type(r),f="array"===s||"object"===s?r:arguments,p=this[a].slice();return h(o,function(e,t){var r=f["object"===s?e:t.idx];null==r&&(r=p[t.idx]),p[t.idx]=n(r,t)}),c?(i=l(c(p)),i[a]=p,i):l(p)},h(o,function(t,n){l.fn[t]||(l.fn[t]=function(i){var o,a=e.type(i),u="alpha"===t?this._hsla?"hsla":"rgba":r,l=this[u](),c=l[n.idx];return"undefined"===a?c:("function"===a&&(i=i.call(this,c),a=e.type(i)),null==i&&n.empty?this:("string"===a&&(o=s.exec(i),o&&(i=c+parseFloat(o[2])*("+"===o[1]?1:-1))),l[n.idx]=i,this[u](l)))})})}),l.hook=function(t){var n=t.split(" ");h(n,function(t,n){e.cssHooks[n]={set:function(t,i){var o,a,s="";if("transparent"!==i&&("string"!==e.type(i)||(o=r(i)))){if(i=l(o||i),!p.rgba&&1!==i._rgba[3]){for(a="backgroundColor"===n?t.parentNode:t;(""===s||"transparent"===s)&&a&&a.style;)try{s=e.css(a,"backgroundColor"),a=a.parentNode}catch(u){}i=i.blend(s&&"transparent"!==s?s:"_default")}i=i.toRgbaString()}try{t.style[n]=i}catch(u){}}},e.fx.step[n]=function(t){t.colorInit||(t.start=l(t.elem,n),t.end=l(t.end),t.colorInit=!0),e.cssHooks[n].set(t.elem,t.start.transition(t.end,t.pos))}})},l.hook(a),e.cssHooks.borderColor={expand:function(e){var t={};return h(["Top","Right","Bottom","Left"],function(n,r){t["border"+r+"Color"]=e}),t}},o=e.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(jQuery),function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e:e(jQuery)}(function(e){function t(t){var i,o=t||window.event,a=[].slice.call(arguments,1),s=0,u=0,l=0,c=0,f=0;return t=e.event.fix(o),t.type="mousewheel",o.wheelDelta&&(s=o.wheelDelta),o.detail&&(s=-1*o.detail),o.deltaY&&(l=-1*o.deltaY,s=l),o.deltaX&&(u=o.deltaX,s=-1*u),void 0!==o.wheelDeltaY&&(l=o.wheelDeltaY),void 0!==o.wheelDeltaX&&(u=-1*o.wheelDeltaX),c=Math.abs(s),(!n||n>c)&&(n=c),f=Math.max(Math.abs(l),Math.abs(u)),(!r||r>f)&&(r=f),i=s>0?"floor":"ceil",s=Math[i](s/n),u=Math[i](u/r),l=Math[i](l/r),a.unshift(t,s,u,l),(e.event.dispatch||e.event.handle).apply(this,a)}var n,r,i=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],o="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"];if(e.event.fixHooks)for(var a=i.length;a;)e.event.fixHooks[i[--a]]=e.event.mouseHooks;e.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var e=o.length;e;)this.addEventListener(o[--e],t,!1);else this.onmousewheel=t},teardown:function(){if(this.removeEventListener)for(var e=o.length;e;)this.removeEventListener(o[--e],t,!1);else this.onmousewheel=null}},e.fn.extend({mousewheel:function(e){return e?this.bind("mousewheel",e):this.trigger("mousewheel")},unmousewheel:function(e){return this.unbind("mousewheel",e)}})});
!function() {
    var t = {
        UN: "#gasks div",
        bt: "Volume is disabled for Coinbase.",
        KF: " day",
        Ro: "Highlight Text",
        LQ: "?",
        kb: "&",
        za: ".unit",
        cK: "bid",
        SH: "emas",
        JX: "12小时",
        CI: " max: ",
        oY: "asks",
        fo: "/",
        ee: ".cond_np",
        "in": "href",
        PP: " ",
        vS: "months",
        vx: "",
        sn: "min",
        pZ: "object",
        Hm: "-",
        VH: "Bitstamp",
        fIQY: "rgba(204,0,0,0.6)",
        iK: ":8080/difficulty?market=",
        dL: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec",
        cC: "% ",
        dX: "trades: ",
        MX: "#canvas_shapes",
        xw: "undefined",
        nG: "<div class=ok>",
        bg: "/api.php?method=",
        oz: "A recovery mail has been sent to<br>",
        ir: ", ",
        ZI: "div",
        MI: ":first",
        Ov: "<br/>",
        Lg: "#D58E31",
        pp: "passport_",
        Pr: "#ask",
        Ci: " count: ",
        xb: ".link_logout",
        ml: "gapWidth",
        Yk: "img",
        fm: "</td></tr>",
        ppwy: "<table class=s1>",
        qO: "rgba(0,204,0,0.6)",
        lM: "location",
        tF: "Expires on ",
        VF: ' <span style="color:#666"><small>(',
        mG: "<g>$&</g>",
        OB: " left)</small></span>",
        QG: "Upgrade to premium account.",
        TR: "bitcoin:",
        aU: "?amount=",
        KFPH: "resize",
        Tc: "Colors",
        Ga: ": ",
        ql: " ago",
        aN: "&size=7",
        Sq: "",
        FQ: ".to_cost",
        gRMC: "html",
        zU: ' class_name="',
        Bh: "rgba(10, 10, 10, 0.8)",
        fq: "<div",
        mi: "/>",
        DK: "[",
        uZ: "hour",
        Bp: "] ",
        aX: "",
        qd: "failed, ",
        Vn: ".to",
        Tf: "RUIZCON",
        Ss: "Cross is locked.",
        xs: "#footer_outer",
        xm: "litecoin",
        ZE: "买 <span class=yellow>",
        gv: ".error",
        VW: "dropdown-hover",
        uO: "?label=RUIZTON",
        nO: "#before_trades",
        Tr: "#mode_",
        Ln: " 将得到 <span class=red>",
        qt: "1小时",
        Xe: "花费和收入的平均价为 <span class=grey>",
        CE: "时间: ",
        lT: "Red Fill",
        cM: "高: ",
        Sv: "低: ",
        uC: "收: ",
        KD: ".t",
        Kp: "request failed.",
        gm: "input[type=submit]",
        AYEC: "error",
        Dw: "&nbsp;&nbsp;&nbsp;",
        ek: "11px Consolas, Monospace",
        KG: " asks and ",
        RS: "← ",
        Oc: "input[name=recover_password]",
        sI: "out of orderbook",
        am: "12px Consolas, Monospace",
        wd: ":8080?symbol=",
        nw: "_avg_p",
        xS: "#39A033",
        DS: "Initialize FullSync System",
        ay: "0",
        lh: "加载中...",
        Zt: "logarithmic",
        gR: ".content_logout",
        pO: "#setting_",
        Nr: "return",
        Ie: "kdj",
        eH: "#nav",
        oi: "/</span>",
        Rt: "g",
        WV: "price_mas",
        Ix: "#markets",
        xf: "Buy",
        mF: " depth",
        ez: "realtime active at ",
        SN: "load ",
        nd: "Green Arrow",
        Cj: '</div><div class="p ',
        gnTC: "#FFFFFF",
        pH: "→",
        bn: "get history data from server for ",
        xy: "/Chart/getMarketSpecialtyJson.html",
        pnqk: "grey",
        th: "parse json failed",
        uj: "input[name=",
        qE: "bwsid",
        Qx: "kdj_params",
        yP: "#E31A1C",
        Re: "background-color",
        Wy: "bitcoin",
        QO: "BTCJPY",
        Mz: "loop_until_success:error",
        qFXZ: "bold 12px Consolas, Monospace",
        CF: "<tr><td>",
        tr: "#market_",
        FY: " - RUIZTON",
        Ge: "<div>",
        fG: "#",
        af: " .table",
        PA: "multimap",
        mGEy: "6小时",
        zZ: "_avg",
        NQ: "_reach_p",
        LX: "#FB9A99",
        Iy: "#CC1414",
        qP: "#market",
        cb: "#dlg_",
        ODqa: "fetch depth failed",
        mK: "#realtime_error",
        da: "$1<g>$2</g>",
        aORv: "bad",
        OD: " txes",
        QS: '<div class=text>加载失败, 5秒后重新刷新.</div>',
        Px: "/Chart/depth.html?symbol=",
        aI: "#notify",
        tX: "rgba(255,255,255,0.8)",
        IQ: "http://",
        Jv: "history",
        FB: "wait cycle",
        BY: "量: ",
        xN: "/Chart/getSpecialtyTrades.html",
        Ul: ".content_history",
        Rg: " missed trade",
        uT: " trade",
        wP: "realtime: connect to ",
        zI: "cross",
        VI: "depth bid length ",
        Kw: "C$",
        Pd: "li.period",
        MCXr: "m",
        MO: "rgba(204,204,204,0.6)",
        Xo: "#F80",
        at: "-- STATUS --",
        YV: "ws://",
        oI: "振幅: ",
        ZG: "<span class=eprice>",
        QF: ".content_",
        Sf: ".",
        dLFn: "use PUBNUB",
        DW: "#assist",
        Hg: "ticker: ",
        xp: "涨幅: ",
        inuH: ", first is ",
        tB: "sdepth",
        mO: "#633",
        Dj: "depth cache length ",
        ZtQW: "good",
        ZQ: "<g>",
        dF: "onerror",
        sw: "depth ask length ",
        hM: "stoch_rsi",
        im: ".dropdown-data",
        mT: "10px Consolas, Monospace",
        mv: "li[value=",
        Za: "Sun Mon Tue Wed Thu Fri Sat",
        vO: "30分",
        rw: "#chart_info",
        jD: "#show_qr",
        IfRU: "5分",
        pc: "/kline/sdepth.html?symbol=",
        LA: "bottom",
        Pc: "</table>",
        UP: "rgba(255,255,255,0.4)",
        gT: "stock_rsi_params",
        WdJF: "#change",
        xh: "default",
        GI: "number",
        UJ: "last tid: ",
        AI: "world",
        mg: "hr",
        Gx: "<div class=ok>Logout successful.</div>",
        KB: "theme",
        bz: "<div class=row><span class=price></span> <span class=amount></span></div>",
        Sa: "1分",
        xW: "minute",
        MA: "second",
        YD: "error, history data is empty",
        Nv: "auto",
        Zz: "#0A0A0A",
        rk: ".line_style",
        Wd: ".address",
        nR: "1天",
        ln: "#FF0",
        TD: "#36F",
        Zx: "</g></div><div class=t>",
        gx: "#49C043",
        RW: "function",
        kd: "/qr?data=",
        eO: "warning",
        Je: "remove ",
        hS: "#999",
        DJ: "ws://websocket.mtgox.com?Currency=",
        nM: "#footer",
        Om: "#bid",
        bDnR: "red",
        Vv: "#CCCC00",
        JE: "#A6CEE3",
        jy: " →",
        kN: "ask",
        hr: "开: ",
        XIYd: "compare",
        CD: "margin-top",
        bb: "rgba(64,255,64,0.3)",
        Yj: "rgba(255,64,64,0.3)",
        yM: "Red Stroke",
        ps: " 需要花 <span class=green>",
        Jj: "rgba(255, 255, 255, 0.8)",
        tp: "#000",
        xR: " 价格达到 <span class=red>",
        FJ: ".symbol_",
        Ii: "apply ",
        bzZP: ":visible",
        uFgO: "#666",
        wq: "rgba(51,160,44,0.8)",
        VWdP: "#822B82",
        ym: "</div>",
        Wc: "hide_cursor",
        xH: "from",
        SZ: "A$",
        Vy: "Arrow Text",
        vm: "#trades",
        tb: "rgba(255,64,64,0.2)",
        sl: "_cost_p",
        dd: "ltc",
        uF: "found ",
        kKjb: "to",
        Hk: "Realtime timeout",
        Fn: "home",
        rK: "#slot_hash_rate",
        cP: "<i class=fa-arrow-down>",
        Tn: "#1F78B4",
        Rn: "top",
        gq: "Background Mask",
        aE: "</span>.<br>",
        BhAp: "rgba(0,0,0,0.4)",
        ZL: "http://#{host}:8080/#{path}",
        Gg: "<div class=v>",
        cY: "#pc_to_bw",
        yZ: "_str",
        iF: "mousedown",
        fN: "mouseup",
        yi: "onselectstart",
        EO: "selected",
        pg: "FullSync",
        Mzfh: "change",
        hB: "input:first",
        dG: ".close",
        km: "Border",
        iW: "passport",
        mx: "#363",
        kR: "register",
        oV: "premium",
        TA: "form",
        Ub: "#24B324",
        dT: "class",
        Uv: "MACD",
        CO: "Register",
        aZLI: "Login",
        rj: "row",
        lv: ".content_login",
        AC: "macd",
        my: "mas",
        gD: "trade.BTC",
        qN: "Initialize Depth Digger",
        ak: "center",
        Ts: "#dlg_estimate_trading",
        KR: "#0D86FF",
        nX: "ShapeHint",
        cH: "Shape",
        Er: "\n",
        zb: "Green Area",
        tl: "login",
        TZ: "PPCBTC",
        RR: "t",
        qp: ".premium",
        Zk: "days",
        VG: "depth",
        Vd: "amount",
        TT: ".qr",
        rO: "&sid=",
        bC: ".content_home",
        pn: "J",
        uQ: "_reach",
        zy: "height",
        vH: "rgba(227,26,28,0.8)",
        bD: "passport_logout",
        xB: "<div class=error>",
        dI: "min: ",
        swYM: "assist",
        sQ: "BTCGBP",
        slew: "estimate_trading",
        OG: "#CCC",
        qM: "_cost",
        vg: "#990F0F",
        zv: "#qr",
        NH: "<b>Realtime System only works on IE 10+, chrome, FF</b>",
        Cq: "bids",
        qj: "line_o",
        NF: "&now=",
        tc: "LTCUSD",
        uA: "json",
        jb: "Green Fill",
        tT: "dark",
        Kpzq: "candle_stick_hlc",
        db: "<div class=ok>加载中...</div>",
        xj: "light",
        TAMK: "session",
        CiJy: "#main",
        Ik: "retry after 5 seconds",
        VV: "#header_outer",
        Lb: "text",
        AM: "#leftbar_outer",
        aZ: "Cross is unlocked.",
        Zy: "<br> From ",
        ca: "#date",
        ZC: "passport_recovery_mail",
        hJ: "#periods",
        kK: "Stick Line",
        SV: "simple",
        Wr: ".cond_p",
        BW: "------",
        cg: "remove",
        ux: "macd_params",
        TnKt: "Now",
        wc: "Initialize Real-time System",
        FP: "#asks div",
        Bm: "rgba(64,255,64,0.2)",
        eg: "#bids div",
        ld: "#gbids div",
        dB: "#canvas_main",
        QI: "account_info",
        xmsA: "s",
        yS: "onclose",
        XooO: "string",
        qJ: "Eva",
        cR: "apply sdepth",
        IX: "3分",
        nc: "mousemove",
        GA: "15分",
        RnYc: ".tablist",
        pY: "switch to ",
        xSUF: "2小时",
        Ym: "K",
        pj: "gbids",
        cd: "↗",
        Uu: "src",
        CC: "3天",
        dD: "#slot_estimated",
        HU: "price_ma_cycles",
        Ly: "MA%",
        eI: "volume_ma_cycles",
        Iq: "</td><td>Extend premium",
        dr: "DIF",
        MU: "DEA",
        UZ: "data",
        nU: "#wrapper",
        Op: "green",
        rx: "wss://websocket.mtgox.com?Currency=",
        Rz: "#price",
        Rf: "PPCUSD",
        AY: "switch failed ",
        fl: "BTC",
        GZ: "locked",
        fI: "line",
        yl: "XChange",
        uq: "cached txes length: ",
        Ba: "LTCBTC",
        Ns: "alarm",
        Uw: "NMCBTC",
        FM: ":",
        bB: "POST",
        Xm: "NMCUSD",
        ZJ: "LTCRUR",
        Co: "#canvas_cross",
        IXIY: "BTCUSD",
        xA: "BTCCAD",
        XJ: "BTCEUR",
        ch: "li",
        jR: "ticker_green",
        SX: "Axis Background",
        nW: "Coinbase",
        OM: "Mt.Gox",
        gU: "GET",
        gO: "barWidth",
        zq: "sorted txes length: ",
        ZN: ".dropdown",
        xU: "BTCAUD",
        sD: "#orderbook .orderbook",
        eA: "BTCRUR",
        UwTG: "#now",
        Dk: "<i class=fa-arrow-up>",
        Vg: "r",
        OF: "Axis Text",
        HT: "Cross",
        Kl: "↘",
        jH: "+",
        QX: "#F63",
        Wg: "opened",
        qMvr: "#close_settings",
        sZ: "Main Text",
        MH: "submit",
        Kz: "<h>$&</h>",
        TW: " bids",
        Nt: "Green Stroke",
        ou: "ucp",
        xhvU: " to ",
        xC: "none",
        Vk: "fast",
        fO: "Background",
        hl: "ohlc",
        yF: "candle_stick",
        Pj: "s ago",
        gG: "step",
        na: "Red Area",
        zR: "realtime opened",
        Lx: "...</a>",
        bq: "<div class=text>加载中...</div>",
        sk: "Red Arrow",
        uR: "Minor Arrow",
        Gv: "Show QR Code",
        hp: "<br/>Tx: <a href=//blockchain.info/tx/",
        cu: "卖 <span class=yellow>",
        nF: "left",
        pv: ".inner .text",
        jX: ".inner",
        wO: "#notify .inner",
        XL: "#0088CC",
        Xa: "success",
        RA: "cny",
        cD: "ticker_red",
        Ique: '">',
        XK: "←",
        cKjf: "D",
        kw: "rgba(0,0,0,0.8)",
        Gadz: "BTCCNY",
        sS: ".from",
        vf: "#B2DF8A",
        EQ: ".direct_address",
        WS: "4小时",
        XI: "active",
        fp: ".price",
        mFqN: "#depth",
        qF: "]",
        OH: "mode",
        ao: "#FDBF6F",
        ZF: "#switch_theme",
        To: "#gasks",
        OJ: "#close_ad",
        hP: "XPMBTC",
        ts: ".link_",
        IN: "Hide QR Code",
        qk: "#close_qr",
        ug: "#settings",
        zyHh: "#btn_settings",
        Cibs: "<div class=error>Load history failed></div>",
        pC: " button",
        uN: "#indicator_",
        qdhh: "normal",
        Rk: " 价格达到 <span class=green>",
        wx: "#333",
        aO: "get history trades",
        Wu: "a[mode=",
        KH: "€",
        ndlS: "£",
        ZkFf: "¥",
        et: "#loading",
        jq: "#33A02C",
        KA: "฿",
        KC: "new",
        jZ: "#DF8ADF",
        RT: "http://#{decided_host}:8080/#{path}",
        DI: "gasks",
        Io: "&label=RUIZTON",
        PH: "middle",
        If: "#slot_difficulty",
        Oe: "color",
        BU: "#6C6",
        PJ: "#F66",
        Qo: "inherit",
        Zm: "logout",
        aesP: ".amount",
        Lc: "2d",
        xa: "delete",
        on: "day",
        JN: "$",
        Is: "depth.",
        fn: "</span> ",
        Kx: " is not integer.",
        Fw: "GHSBTC",
        RD: "Cost",
        nr: "right",
        mP: "Receive",
        rU: ".mode",
        fH: "draw",
        lP: ".to_text",
        hI: ".from_text",
        YA: "Sell",
        Kt: "Spend",
        nN: "ToReceive",
        kZ: " target=_blank>",
        Ce: "10px Arial, Sans",
        Uldv: "years",
        LB: ".auto_draw",
        OY: "a.mode",
        fa: "<div class=ok>You don't have any order yet.</div>",
        NV: " %",
        Dh: "keydown",
        Hgvn: "Depth",
        MC: "/kline/ticker.html?sid=",
        Lk: "&p=1",
        ae: "#asks",
        YM: "rgba(255,255,0,0.8)",
        eD: " successfully.</div>",
        Um: "Realtime",
        cz: "user_history",
        JB: "trades",
        Ps: "mtgox.subscribe",
        ldit: "private",
        qMoJ: "#sidebar_outer",
        Lcwk: "%",
        gn: '"',
        rT: "#connection",
        vE: "#help_connection"
    }; !
    function() {
        var n, e, r, o, i, u, a, l, s, c, f, h, d, p, g, m, v, x, y, w, b, k, _, T, F, C, M, S, P, I, O, A, D, R, B, N, q, H, Z, U, K, L, W, z, G, X, Y, j, E, J, V, Q, tn, nn, en, rn, on, un, an, ln, sn, cn, fn, hn, dn, pn, gn, mn, vn, xn, yn, wn, bn, kn, _n, $n, Tn, Fn, Cn, Mn, Sn, Pn, In, On, An, Dn, Rn, Bn, Nn, qn, Hn, Zn, Un, Kn, Ln, Wn, zn, Gn, Xn, Yn, jn, En, Jn, Vn, Qn, te, ne, ee, re, oe, ie, ue, ae, le, se, ce, fe, he, de, pe, ge, me, ve, xe, ye, we, be, ke, _e, $e, Te, Fe, Ce, Me, Se, Pe, Ie, Oe, Ae, De, Re, Be, Ne, qe, He, Ze, Ue, Ke, Le, We, ze, Ge, Xe = {}.hasOwnProperty,
        Ye = [].slice; !
        function() {
            var n, e, r, o, i;
            $(function() {
                function u() {
                    var e, r, o, i, u;
                    return i = $(this),
                    i.addClass(t.VW),
                    e = $(t.im, this),
                    u = .5 * (i.outerWidth() - e.outerWidth()),
                    o = i.offset().left + i.outerWidth() - $(window).width(),
                    o > u && (u = o),
                    r = i.offset().left + i.outerWidth() - e.outerWidth(),
                    u > r && (u = r),
                    e.css(t.nr, u),
                    n = this
                }
                function a() {
                    var e;
                    return $(this).removeClass(t.VW),
                    e = !1,
                    n = null
                }
                function l() {
                    var t = this;
                    return e = !0,
                    n ? (a.call(n), u.call(this), void 0) : this.showing ? void 0 : (this.showing = !0, setTimeout(function() {
                        return e && (n && a.call(n), u.call(t)),
                        t.showing = !1
                    },
                    80))
                }
                function s() {
                    var t = this;
                    return e = !1,
                    this.hiding ? void 0 : (this.hiding = !0, setTimeout(function() {
                        return e || a.call(t),
                        t.hiding = !1
                    },
                    80))
                }
                var c, f, h;
                for (e = !1, n = null, h = $(t.ZN), c = 0, f = h.length; f > c; c++) r = h[c],
                o = function() {
                    var n = this;
                    return $(t.KD, this).click(function() {
                        return $(t.im, n).is(t.bzZP) ? a.call(n) : u.call(n)
                    })
                },
                o.call(r);
                return window.$is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                $is_mobile ? void 0 : (i = !1, $(t.ZN).hover(function() {
                    return l.call(this)
                },
                function() {
                    return s.call(this)
                }))
            })
        } (),
        function() {
            var n, e, r;
            $(function() {
                var o;
                o = function(n, e) {
                    var o, i, u, a, l, s, c, f, h;
                    return u = $(t.pO + e.id),
                    c = null != (f = null != (h = $.cookie(e.id)) ? h.toLowerCase() : void 0) ? f: t.vx,
                    i = !1,
                    o = null,
                    s = function() {
                        var n, s;
                        n = e.options,
                        s = [];
                        for (a in n) Xe.call(n, a) && (l = n[a], s.push(function(n, a) {
                            var l;
                            return l = $(t.mv + a + t.qF, u),
                            l.active = function() {
                                return l.addClass(t.XI),
                                e.value = a
                            },
                            l.click(function() {
                                return $(t.ch, u).removeClass(t.XI),
                                l.active(),
                                $.cookie(e.id, a, {
                                    expires: 3650,
                                    path: "/"
                                }),
                                e.refresh ? window.location.reload() : (r(), world_draw_main())
                            }),
                            a === c && (i = !0, l.active()),
                            a === e[t.xh] && (o = l),
                            l
                        } (a, l)));
                        return s
                    } (),
                    i ? void 0 : e[t.xh] && o ? o.active() : s[0].active()
                };
                for (n in $settings) Xe.call($settings, n) && (e = $settings[n], o(n, e));
                return (r = function() {
                    var n;
                    return (n = $settings.stick_style.value) === t.fI || n === t.qj ? $(t.rk).show() : $(t.rk).hide()
                })(),
                null
            })
        } (),
        Te = Mn = Re = Cn = _e = on = Fn = Se = ge = c = ie = $e = o = f = tn = me = ne = ee = re = xe = null,
        function() {
            var n, e;
            return Cn = function(t, n) {
                var e, r, o;
                return o = !1,
                r = t,
                e = function() {
                    function e() {
                        r > 0 ? Re(16,
                        function() {
                            e(r -= 16)
                        }) : i()
                    }
                    function i() {
                        return n(),
                        o = !1
                    }
                    return r = t,
                    o ? !0 : (o = !0, e(), void 0)
                }
            },
            Cn.statuses = {},
            Te = function() {
                return console.log.apply(console, arguments)
            },
            Mn = function() {
                return console.log.apply(console, [new Date].concat(Ye.call(arguments)))
            },
            Re = function(t, n) {
                return setTimeout(n, t)
            },
            on = function() {
                var n, e, r, o, i, u, a, l;
                for (r = arguments[0], o = 3 <= arguments.length ? Ye.call(arguments, 1, i = arguments.length - 1) : (i = 1, []), e = arguments[i++], l = [], u = 0, a = e.length; a > u; u++) n = e[u],
                typeof n === t.pZ && n.length ? l.push(r.apply(null, Ye.call(o).concat(Ye.call(n)))) : l.push(r.apply(null, Ye.call(o).concat([n])));
                return l
            },
            Se = function(n, e) {
                return null == e && (e = t.AI),
                (typeof console !== t.xw && null !== console ? console.time: void 0) ? (console.time(e), n(), console.timeEnd(e)) : n()
            },
            ge = function(t) {
                return t[t.length - 1]
            },
            me = function(t) {
                var n;
                return null != (n = ge(t)) ? n: {}
            },
            Fn = function(t) {
                var n, e, r;
                if (t.length) return t.slice(0);
                e = {};
                for (n in t) Xe.call(t, n) && (r = t[n], e[n] = r);
                return e
            },
            n = 0,
            c = function(t) {
                var e, r, o;
                for (o = [], e = r = 0; t >= 0 ? t > r: r > t; e = t >= 0 ? ++r: --r) o.push(n++);
                return o
            },
            ie = function() {
                var n, e, r, o, i, u;
                return n = 1 <= arguments.length ? Ye.call(arguments, 0) : [],
                e = n.pop(),
                i = n[0],
                r = n[1],
                null == r && (r = {}),
                i[i.length - 1] !== t.LQ && (r.nonce = Date.now()),
                typeof XDomainRequest !== t.xw && null !== XDomainRequest ? (i = -1 === i.indexOf(t.LQ) ? i + t.LQ + $.param(r) : i + t.kb + $.param(r), u = new XDomainRequest, u.open(t.gU, i), u.onload = function() {
                    return r = $.parseJSON(u.responseText),
                    r ? e(null, r) : e(new Error(t.th), null)
                },
                u.onerror = function() {
                    return e(t.AYEC, null)
                },
                u.ontimeout = function() {},
                u.onprogress = function() {},
                u.timeout = 6e4, u.send(), u) : (o = $.ajax({
                    url: i,
                    type: t.gU,
                    dataType: t.uA,
                    timeout: 6e4,
                    data: r
                }), o.done(function(t) {
                    return e(null, t)
                }), o.fail(function(n, r, o) {
                    var i;
                    return r === t.AYEC && (r = t.vx),
                    i = o || r || t.vx,
                    e(new Error(i), null)
                }))
            },
            $e = function(t) {
                var n;
                return n = function() {
                    function n(n) {
                        return n ? t(o) : r.apply(null, e)
                    }
                    var e, r, o, i, u;
                    i = arguments[0],
                    e = 3 <= arguments.length ? Ye.call(arguments, 1, u = arguments.length - 1) : (u = 1, []),
                    r = arguments[u++],
                    i.apply(null, Ye.call(e).concat([function() {
                        n((o = arguments[0], e = 2 <= arguments.length ? Ye.call(arguments, 1) : [], o))
                    }]))
                }
            },
            o = function() {
                function t() {
                    this.push_cbs = [],
                    this.args = [],
                    this.shift_cbs = []
                }
                var n;
                return t.prototype.push = function() {
                    var t, n, e, r;
                    return t = 2 <= arguments.length ? Ye.call(arguments, 0, r = arguments.length - 1) : (r = 0, []),
                    n = arguments[r++],
                    (e = this.shift_cbs.shift()) ? this.process(t, e, n) : (this.push_cbs.push(n), this.args.push(t))
                },
                t.prototype.unshift = function() {
                    var t, n, e, r;
                    return t = 2 <= arguments.length ? Ye.call(arguments, 0, r = arguments.length - 1) : (r = 0, []),
                    n = arguments[r++],
                    (e = this.shift_cbs.shift()) ? this.process(t, e, n) : (this.push_cbs.unshift(n), this.args.unshift(t))
                },
                t.prototype.shift = function(t) {
                    var n, e;
                    return (e = this.push_cbs.shift()) ? (n = this.args.shift(), this.process(n, t, e)) : this.shift_cbs.push(t)
                },
                n = 0,
                t.prototype.process = function(t, e, r) {
                    function o() {
                        return r(),
                        e.apply(null, t)
                    }
                    100 === ++n ? (n = 0, Re(0,
                    function() {
                        o()
                    })) : o()
                },
                t
            } (),
            e = {},
            ne = function() {
                var t, n, r, o, i;
                return o = arguments[0],
                t = 3 <= arguments.length ? Ye.call(arguments, 1, i = arguments.length - 1) : (i = 1, []),
                n = arguments[i++],
                (r = e[o]) ? r.channel.push(t, n) : void 0
            },
            ee = function() {
                var t, n, r, o, i;
                return o = arguments[0],
                t = 3 <= arguments.length ? Ye.call(arguments, 1, i = arguments.length - 1) : (i = 1, []),
                n = arguments[i++],
                (r = e[o]) ? r.channel.unshift(t, n) : void 0
            },
            re = function(t, n) {
                var r;
                return (r = e[t]) ? r.actions.push(n) : (r = e[t] = {
                    actions: [n],
                    channel: new o,
                    running: !1
                },
                function() {
                    function t() {
                        r.channel.shift(function() {
                            function i() {
                                l++,
                                u()
                            }
                            function u() {
                                s > l ? (n = c[l], n.apply(null, Ye.call(e).concat([function(t) {
                                    i(t)
                                }]))) : a()
                            }
                            function a() {
                                t(o)
                            }
                            var l, s, c;
                            e = arguments[0],
                            c = r.actions,
                            l = 0,
                            s = c.length,
                            u()
                        })
                    }
                    var e, o = this;
                    t()
                } ())
            },
            xe = function() {
                function n() {
                    o(i,
                    function() {
                        return r()
                    })
                }
                var e, r, o, i, u, a;
                return e = 3 <= arguments.length ? Ye.call(arguments, 0, a = arguments.length - 2) : (a = 0, []),
                o = arguments[a++],
                r = arguments[a++],
                u = 2e3,
                i = $e(function(e) {
                    ne(t.Mz, e, u,
                    function() {
                        Re(u,
                        function() {
                            return u += 2e3,
                            u > 2e4 && (u = 2e4),
                            n()
                        })
                    })
                }),
                n()
            },
            f = _e,
            tn = ie,
            Te = Te,
            Mn = Mn,
            Re = Re,
            Cn = Cn,
            _e = _e,
            on = on,
            Fn = Fn,
            Se = Se,
            ge = ge,
            c = c,
            ie = ie,
            $e = $e,
            o = o,
            f = f,
            tn = tn,
            me = me,
            ne = ne,
            ee = ee,
            re = re,
            xe = xe,
            _e = function() {
                var n, e, r, o, i, u;
                if (1 === arguments.length) _e(t.vx, arguments[0]);
                else {
                    if (i = arguments[0], r = arguments[1], u = typeof window !== t.xw && null !== window ? window: global) for (o in r) Xe.call(r, o) && (e = r[o], u[i + o] = e);
                    if (n = typeof module !== t.xw && null !== module ? module.exports: void 0) for (o in r) Xe.call(r, o) && (e = r[o], n[o.replace(/^_/, t.vx)] = e)
                }
                return this
            }
        } (),
        r = n = e = null,
        yn = $n = gn = wn = bn = Tn = un = an = sn = cn = hn = ln = fn = dn = vn = kn = mn = pn = xn = _n = null,
        function() {
            function o(t) {
                var n, e, r, o, i;
                for (null == t && (t = []), e = {},
                r = [], e[R] = [], o = 0, i = t.length; i > o; o++) n = t[o],
                e[R][n] = [];
                return e[A] = [],
                e[D] = [],
                e
            }
            function i(t) {
                var n, e;
                return e = t[R],
                n = e.length,
                e[n] = [],
                [n, e[n]]
            }
            function u(t, n, e) {
                var r;
                return (null != (r = t[A])[n] ? (r = t[A])[n] : r[n] = []).push(e),
                e
            }
            function a(t, n, e) {
                return u(t, n, e),
                t[D][e](0),
                e
            }
            function l(t, n, e) {
                var r, o, i;
                return i = function() {
                    var t;
                    t = [];
                    for (r in e) Xe.call(e, r) && (o = e[r], t.push([r, o]));
                    return t
                } (),
                Z(t, n, i)
            }
            function s(t, n, e) {
                var r, o, i;
                return i = function() {
                    var t;
                    t = [];
                    for (r in e) Xe.call(e, r) && (o = e[r], t.push([r, o]));
                    return t
                } (),
                L(t, n, i)
            }
            function f(t) {
                var n;
                return n = function() {
                    var n, e, r, o, i, u, a, l;
                    if (arguments[2].length ? (r = arguments[0], l = arguments[1], a = arguments[2], o = arguments[3]) : (r = arguments[0], l = arguments[1], n = arguments[2], u = arguments[3], o = arguments[4], a = [[n, u]]), e = function() {
                        var e, o, i, s;
                        for (s = [], e = 0, o = a.length; o > e; e++) i = a[e],
                        n = i[0],
                        u = i[1],
                        t(r, l, n, u),
                        s.push(n);
                        return s
                    } (), i = {},
                    null == o && (o = !0), o) for (n in e) ! i[n] && o && r[A][n] && l >= 0 && h(r, r[A][n], l),
                    i[n] = !0;
                    return e
                }
            }
            function h(n, e, r) {
                var o, i, u, a;
                if (i = n[D], typeof e === t.GI) i[e].call(this, r);
                else for (u = 0, a = e.length; a > u; u++) o = e[u],
                h(n, o, r);
                return this
            }
            function d(n, e) {
                var r, o, i, u, a;
                if (o = n[R], typeof e === t.GI) return o[e];
                for (a = [], i = 0, u = e.length; u > i; i++) r = e[i],
                o[r] || (o[r] = []),
                a.push(o[r]);
                return a
            }
            function p(t, n, e) {
                var r, o, i, u, a, l;
                for (r = mn(t, e), u = {},
                i = a = 0, l = e.length; l > a; i = ++a) o = e[i],
                u[e[i]] = r[i][n];
                return u
            }
            function g(t, n) {
                var e, r, o, u, a;
                return u = t[R],
                o = t[D],
                a = i(t),
                e = a[0],
                r = a[1],
                o[e] = function(e) {
                    return m(t, e,
                    function(t) {
                        return r[t] = n(t)
                    })
                },
                e
            }
            function m(t, n, e) {
                var r, o, i, u;
                for (o = t[R], r = i = n, u = o[0].length; u >= n ? u > i: i > u; r = u >= n ? ++i: --i) e(r);
                return null
            }
            function v(t, n, e) {
                var r, o, u, a, l, s;
                return a = t[R],
                u = t[D],
                s = i(t),
                r = s[0],
                o = s[1],
                l = a[n],
                u[r] = function(t) {
                    var n, r, i, u, a, s, c, f;
                    for (r = l.length, i = l.slice(t - e, t), u = 0, s = 0, f = i.length; f > s; s++) a = i[s],
                    u += a;
                    for (n = c = t; r >= t ? r > c: c > r; n = r >= t ? ++c: --c) a = l[n],
                    i.length >= e && (u -= i.shift()),
                    u += a,
                    i.push(a),
                    o[n] = u / i.length;
                    return this
                },
                r
            }
            function x(t, n, e) {
                var r, o, u, a, l, s;
                return a = t[R],
                u = t[D],
                s = i(t),
                r = s[0],
                o = s[1],
                l = a[n],
                u[r] = function(n) {
                    return m(t, n,
                    function(t) {
                        var n, r, i;
                        return n = l[t],
                        r = null != (i = o[t - 1]) ? i: n,
                        r = (2 * n + (e - 1) * r) / (e + 1),
                        o[t] = r
                    })
                },
                r
            }
            function y(t, n, e, r) {
                var o, u, a, l, s, c;
                return l = t[R],
                a = t[D],
                c = i(t),
                o = c[0],
                u = c[1],
                s = l[n],
                a[o] = function(n) {
                    return m(t, n,
                    function(t) {
                        var n, o, i;
                        return n = s[t],
                        o = null != (i = u[t - 1]) ? i: n,
                        o = (r * n + (e - r) * o) / e,
                        u[t] = o
                    })
                },
                o
            }
            function w(t, n, e) {
                var r, o, u, a, l;
                return a = t[R],
                u = t[D],
                l = i(t),
                r = l[0],
                o = l[1],
                u[r] = function(r) {
                    return m(t, r,
                    function(t) {
                        var r, i;
                        return i = Math.max(t - e, 0),
                        r = t + 1,
                        o[t] = Math.min.apply(Math, a[n].slice(i, r))
                    })
                },
                r
            }
            function b(t, n, e) {
                var r, o, u, a, l;
                return a = t[R],
                u = t[D],
                l = i(t),
                r = l[0],
                o = l[1],
                u[r] = function(r) {
                    return m(t, r,
                    function(t) {
                        var r, i;
                        return i = Math.max(t - e, 0),
                        r = t + 1,
                        o[t] = Math.max.apply(Math, a[n].slice(i, r))
                    })
                },
                r
            }
            function k(t, n, e, r, o) {
                function a(t) {
                    return [t, _[t]]
                }
                var l, s, c, f, d, p, v, y, w, b, k, _, $, T, F, C, M;
                return null == e && (e = 12),
                null == r && (r = 26),
                null == o && (o = 9),
                _ = t[R],
                w = t[D],
                $ = a(x(t, n, e)),
                s = $[0],
                k = $[1],
                T = a(x(t, n, r)),
                l = T[0],
                b = T[1],
                F = a(g(t,
                function(t) {
                    return k[t] - b[t]
                })),
                f = F[0],
                y = F[1],
                C = a(x(t, f, o)),
                c = C[0],
                v = C[1],
                M = i(t),
                d = M[0],
                p = M[1],
                w[d] = function(n) {
                    return h(t, [s, l, f, c], n),
                    m(t, n,
                    function(t) {
                        return p[t] = 2 * (y[t] - v[t])
                    })
                },
                w[d](0),
                u(t, n, d),
                [f, c, d]
            }
            function _(t, n, e, r, o, a) {
                function l(t) {
                    return X.push(t),
                    [t, j[t]]
                }
                var s, c, f, d, p, m, x, k, _, $, T, F, C, M, S, P, I, O, A, B, N, q, H, Z, U, K, L, W, z, G, X, Y, j, E, J, V, Q, tn, nn, en, rn, on, un, an, ln, sn, cn, fn;
                return null == e && (e = 14),
                null == r && (r = 14),
                null == o && (o = 3),
                null == a && (a = 3),
                j = t[R],
                q = t[D],
                X = [],
                A = j[n],
                E = l(g(t,
                function(t) {
                    var n;
                    return null != (n = A[t - 1]) ? n: A[t]
                })),
                k = E[0],
                U = E[1],
                rn = l(g(t,
                function(t) {
                    return Math.max(A[t] - U[t], 0)
                })),
                s = rn[0],
                S = rn[1],
                on = l(g(t,
                function(t) {
                    return Math.abs(A[t] - U[t])
                })),
                f = on[0],
                I = on[1],
                un = l(y(t, s, e, 1)),
                c = un[0],
                P = un[1],
                an = l(y(t, f, e, 1)),
                d = an[0],
                O = an[1],
                ln = l(g(t,
                function(t) {
                    return 0 === O[t] ? 100 : 100 * (P[t] / O[t])
                })),
                M = ln[0],
                Y = ln[1],
                sn = l(w(t, M, r)),
                _ = sn[0],
                K = sn[1],
                cn = l(b(t, M, r)),
                m = cn[0],
                H = cn[1],
                fn = l(g(t,
                function(t) {
                    return Y[t] - K[t]
                })),
                T = fn[0],
                W = fn[1],
                J = l(g(t,
                function(t) {
                    return H[t] - K[t]
                })),
                C = J[0],
                G = J[1],
                V = l(v(t, T, o)),
                $ = V[0],
                L = V[1],
                Q = l(v(t, C, o)),
                F = Q[0],
                z = Q[1],
                tn = l(g(t,
                function(t) {
                    return 0 === z[t] ? 100 : 100 * (L[t] / z[t])
                })),
                x = tn[0],
                Z = tn[1],
                nn = l(v(t, x, a)),
                p = nn[0],
                N = nn[1],
                en = i(t),
                M = en[0],
                B = en[1],
                q[M] = function(n) {
                    return h(t, X, n)
                },
                q[M](0),
                u(t, n, M),
                [x, p]
            }
            function $(t, n, e, r, o) {
                function a(t) {
                    return A.push(t),
                    [t, N[t]]
                }
                var l, s, c, f, d, p, m, v, x, k, _, $, T, F, C, M, S, P, I, O, A, B, N, q, H, Z, U, K, L, W;
                return f = n[0],
                x = n[1],
                l = n[2],
                null == e && (e = 9),
                null == r && (r = 3),
                null == o && (o = 3),
                N = t[R],
                T = t[D],
                A = [],
                O = N[x],
                _ = N[l],
                C = N[f],
                q = a(w(t, x, e)),
                v = q[0],
                I = q[1],
                H = a(b(t, f, e)),
                c = H[0],
                F = H[1],
                Z = a(g(t,
                function(t) {
                    return F[t] - I[t] < 1e-8 ? 100 : 100 * ((_[t] - I[t]) / (F[t] - I[t]))
                })),
                k = Z[0],
                B = Z[1],
                U = a(y(t, k, r, 1)),
                p = U[0],
                S = U[1],
                K = a(y(t, p, o, 1)),
                s = K[0],
                $ = K[1],
                L = a(g(t,
                function(t) {
                    return 3 * S[t] - 2 * $[t]
                })),
                d = L[0],
                M = L[1],
                W = i(t),
                m = W[0],
                P = W[1],
                T[m] = function(n) {
                    return h(t, A, n)
                },
                T[m](0),
                u(t, f, m),
                u(t, x, m),
                u(t, l, m),
                [p, s, d]
            }
            function T(t, n) {
                var e, r, o, a, l, s, c, f, h, d, p, g, v, x;
                for (a = n[0], r = n[1], o = n[2], e = n[3], d = t[R], c = t[D], h = [], v = i(t), l = v[0], s = v[1], c[l] = function(n) {
                    return m(t, n,
                    function(t) {
                        return s[t] = parseFloat(((d[r][t] + d[o][t] + d[e][t]) / 3).toFixed(8)),
                        s[t]
                    })
                },
                c[l](0), x = arguments[1], p = 0, g = x.length; g > p; p++) f = x[p],
                u(t, f, l);
                return [l]
            }
            function F(t, n) {
                var e, r, o, a, l, s, c, f, h, d, p, g, v, x;
                for (a = n[0], r = n[1], o = n[2], e = n[3], d = t[R], c = t[D], h = [], v = i(t), l = v[0], s = v[1], c[l] = function(n) {
                    return m(t, n,
                    function(t) {
                        return s[t] = parseFloat(((d[r][t] + d[o][t]) / 2).toFixed(8)),
                        s[t]
                    })
                },
                c[l](0), x = arguments[1], p = 0, g = x.length; g > p; p++) f = x[p],
                u(t, f, l);
                return [l]
            }
            function C(t, n) {
                return a(t, n, v.apply(null, arguments))
            }
            function M(t, n) {
                return a(t, n, x.apply(null, arguments))
            }
            function S(t, n) {
                var e, r, o, u;
                return o = t[R],
                u = i(t),
                e = u[0],
                r = u[1],
                o[e] = n,
                e
            }
            function P() {
                var n, e, r, o, i, u, a, l;
                for (r = arguments[0], o = 3 <= arguments.length ? Ye.call(arguments, 1, i = arguments.length - 1) : (i = 1, []), e = arguments[i++], l = [], u = 0, a = e.length; a > u; u++) n = e[u],
                typeof n === t.pZ && n.length ? l.push(r.apply(null, Ye.call(o).concat(Ye.call(n)))) : l.push(r.apply(null, Ye.call(o).concat([n])));
                return l
            }
            function I() {
                return P.apply(null, [d].concat(Ye.call(arguments)))
            }
            function O(t, n, e, r) {
                var o;
                return o = d(t, r),
                o.slice(n, +e + 1 || 9e9)
            }
            var A, D, R, B, N, q, H, Z, U, K, L;
            return U = c(3),
            R = U[0],
            A = U[1],
            D = U[2],
            r = R,
            n = A,
            e = D,
            L = f(N = function(t, n, e, r) {
                return t[R][e][n] = r
            }),
            q = f(function(t, n, e) {
                return t[R][e].push(n)
            }),
            Z = f(B = function(t, n, e, r) {
                return t[R][e].splice(n, 0, r)
            }),
            H = f(function(t, n, e) {
                return t[R][e].splice(n, 1)
            }),
            K = L,
            yn = o,
            $n = L,
            gn = H,
            wn = Z,
            bn = l,
            Tn = s,
            un = S,
            an = M,
            sn = C,
            cn = k,
            hn = _,
            ln = $,
            fn = F,
            dn = T,
            vn = p,
            kn = K,
            mn = d,
            pn = P,
            xn = I,
            _n = O
        } (),
        Dn = qn = Nn = An = Rn = On = Sn = Pn = In = Bn = null,
        i = a = u = l = null,
        function() {
            function n(t, n) {
                return t[0] - n[0]
            }
            function e(t) {
                var n;
                return n = {
                    group: t
                },
                r(n),
                n
            }
            function r(t) {
                return t[x] = new Q({
                    compare: n
                }),
                t[w] = new Q({
                    compare: n
                }),
                t[y] = new Q({
                    compare: n
                }),
                t[b] = new Q({
                    compare: n
                }),
                t
            }
            function o(t, n, e) {
                switch (n) {
                case w:
                    return Math.floor(e[k] / t.group) * t.group;
                case x:
                    return Math.ceil(e[k] / t.group) * t.group
                }
            }
            function s(t, n, e) {
                var r, i;
                return t[n].insert(e),
                e[$] ? (e = [o(t, n, e), e[$]], i = n === w ? b: y, (r = t[i].find(e)) ? r[$] += e[$] : (r = e, t[i].insert(r))) : void 0
            }
            function f(n, e, r) {
                var i, u;
                if (r && (n[e][t.xa](r), r[$])) return r = [o(n, e, r), r[$]],
                u = e === w ? b: y,
                i = n[u].find(r),
                i && (i[$] -= r[$], i[$] < 1e-12) ? n[u][t.xa](i) : void 0
            }
            function h(n, e) {
                var r, o, i, u, a, l, c, h, d, p, g;
                if (p = e.type_str, c = e.price_int, h = e.total_volume_int, o = e.now, d = p === t.cK ? w: x, a = n[d], g = parseInt(h), l = parseInt(c), i = [l, g, o], u = a.find([l]), f(n, d, u), g && s(n, d, i), d === w) for (; (r = n[x].get(0)) && r[k] <= l;) f(n, x, r);
                else for (; (r = n[w].get( - 1)) && r[k] >= l;) f(n, w, r);
                return n
            }
            function d(n, e, r) {
                var o, i, u, a, l, c, h, d;
                if (null == r && (r = !0), c = e[0], o = e[1], d = e[2], h = d === t.cK ? w: x, l = n[h], u = [c, o], a = l.find([c]), f(n, h, a), o && s(n, h, u), !r) return n;
                if (h === w) for (; (i = n[x].get(0)) && i[k] <= c;) f(n, x, i);
                else for (; (i = n[w].get( - 1)) && i[k] >= c;) f(n, w, i);
                return n
            }
            function p(n, e) {
                var r, o, i, u, a, l;
                if (u = e.price, r = e.amount, a = e.trade_type, a === t.cK) for (l = x, i = n[l]; r > 1e-12 && (o = n[x].get(0)) && o[0] <= u;) {
                    if (o[1] > r) {
                        f(n, l, o),
                        o[1] = o[1] - r,
                        s(n, l, o);
                        break
                    }
                    f(n, x, o),
                    r -= o[1]
                } else for (l = w; r > 1e-12 && (o = n[w].get( - 1)) && o[0] >= u;) {
                    if (o[1] > r) {
                        f(n, l, o),
                        o[1] = o[1] - r,
                        s(n, l, o);
                        break
                    }
                    f(n, w, o),
                    r -= o[1]
                }
                return n
            }
            function g(t, n) {
                var e, r, o;
                for (e = 0; (o = t[x].get(0)) && o[k] < n;)++e,
                f(t, x, o);
                for (r = 0; (o = t[w].get( - 1)) && o[k] > n;)++r,
                f(t, w, o);
                return [e, r]
            }
            function m(t, n, e, r) {
                var o, i, u, a, l, s;
                for (o = 0, i = 0, l = 0, s = 0, u = 0; (a = t[x].at(u)) && a[k] <= e;) a[_] >= r ? (++u, ++l) : (++o, f(t, x, a));
                for (u = -1; (a = t[w].at(u)) && a[k] >= n;) a[_] >= r ? (--u, ++s) : (++i, f(t, w, a));
                return [o, i, l, s]
            }
            function v(t) {
                var n, e, r, o;
                return n = t[x],
                r = t[w],
                e = n.slice( - 11, -1),
                o = r.slice(0, 10)
            }
            var x, y, w, b, k, _, $, T, F;
            return T = c(4),
            w = T[0],
            x = T[1],
            b = T[2],
            y = T[3],
            F = [0, 1, 2],
            k = F[0],
            $ = F[1],
            _ = F[2],
            Dn = e,
            qn = h,
            Nn = d,
            An = v,
            Rn = s,
            On = f,
            Sn = g,
            Pn = m,
            In = r,
            Bn = p,
            i = x,
            a = w,
            u = y,
            l = b
        } (),
        Jn = Qn = Vn = Xn = Gn = te = En = null,
        Hn = Zn = null,
        Kn = Un = Wn = zn = Ln = Yn = jn = null,
        function() {
            function n(t, n, e, o, i, u) {
                var a, l, s;
                return s = Ue(n, o, i),
                a = s[0],
                l = s[1],
                l > e ? r(t, a, e, u, l - e) : r(t, a, l, u, e - l)
            }
            function e(t, n, e, o, i, u) {
                var a, l, s;
                return a = Ke(n, e),
                l = Le(n, o),
                s = Le(n, i),
                r(t, a, s, u, l - s)
            }
            function r(t, n, e, r, o) {
                return 0 > o && (e += o, o = -o),
                0 === o && (o = 1),
                t.fillStyle === t.strokeStyle ? t.fillRect(n, e, r, o) : o > 1 ? (t.fillRect(n, e, r, o), t.strokeRect(n + .5, e + .5, r - 1, o - 1)) : 1 === o ? (t.beginPath(), t.moveTo(n, e + .5), t.lineTo(n + r, e + .5), t.stroke()) : void 0
            }
            function o(t, n, e, r) {
                var o, i, u, a, l, s, c;
                for (t.beginPath(), u = l = 0, s = e.length; s > l; u = ++l) a = e[u],
                c = Ue(n, u, a),
                o = c[0],
                i = c[1],
                r && (o += r),
                u ? t.lineTo(o, i) : t.moveTo(o, i);
                return t.stroke()
            }
            function i(t, n, e, r, o) {
                return t.beginPath(),
                t.moveTo(n, e),
                t.lineTo(n, e - o),
                t.lineTo(n + .866 * o, e - .5 * o),
                t.fill()
            }
            function u(t, n, e, r, o) {
                return t.beginPath(),
                t.moveTo(n, e),
                t.lineTo(n, e - o),
                t.lineTo(n - .866 * o, e - .5 * o),
                t.fill()
            }
            function a(t, n, e, r, o, i) {
                var u, a, l;
                return u = Ke(n, e),
                a = Le(n, r),
                l = Le(n, o),
                i && (u += i),
                t.beginPath(),
                t.moveTo(u + .5, l),
                t.lineTo(u + .5, a),
                t.stroke()
            }
            function l(t, n, e, r) {
                return t.beginPath(),
                t.moveTo(e, n),
                t.lineTo(r, n),
                t.stroke()
            }
            function s(t, n, e, r) {
                return t.beginPath(),
                t.moveTo(n, e),
                t.lineTo(n, r),
                t.stroke()
            }
            function c(t, n, e) {
                var r, o, i, u, a, s, c, f;
                for (r = Fn(n[nn]), u = Fn(n[en]), n = Ge(r, u), s = e(r, u), c = 0, f = s.length; f > c; c++) a = s[c],
                i = Le(n, a),
                o = r.w,
                t.fillText(a, o - 8, i + .5),
                l(t, i + .5, r.w - 4, r.w);
                return null
            }
            function f(t, n) {
                return c(t, n,
                function(t, n) {
                    var e, r, o, i, u, a, l;
                    for (r = Math.floor(t.h / 32), u = n.h / r, i = n.y, l = [], e = a = 0; r >= 0 ? r >= a: a >= r; e = r >= 0 ? ++a: --a) o = i + e * u,
                    l.push(parseFloat(o.toPrecision(5)));
                    return l
                })
            }
            function h(t, n) {
                return c(t, n,
                function(t, n) {
                    var e, r, o, i, u, a, l, s, c;
                    for (o = Math.abs(t.h / 32), a = n.h / o, c = function() {
                        var t, n, o, i;
                        for (o = [1, 2, 5], i = [], t = 0, n = o.length; n > t; t++) e = o[t],
                        r = a / e,
                        s = Math.ceil(Math.log(r) / Math.log(10)).toFixed(2),
                        s = Math.pow(10, s),
                        s = e * s,
                        i.push(s);
                        return i
                    } (), l = Math.min.apply(Math, c), i = Math.ceil(n.y / l) * l, u = []; i < n.y + n.h;) u.push(parseFloat(i.toPrecision(5))),
                    i += l;
                    return u
                }),
                null
            }
            function d(n, e, r, o) {
                var i, u, a, s, c, f, h, d;
                for (i = Fn(e[nn]), s = Fn(e[en]), e = Ge(i, s, e[rn]), f = o(i, s), n.textAlign = t.ak, h = 0, d = f.length; d > h; h++) c = f[h],
                a = Le(e, c),
                u = i.x,
                r && r !== t.Lb || n.fillText(c, u + 50, a + .5),
                r && r !== t.mg || (l(n, a + .5, u, u + 6), l(n, a + .5, u + i.w - 6, u + i.w));
                return n.textAlign = t.nF,
                null
            }
            function p(t, n) {
                return d(t, n, null,
                function(t, n) {
                    var e, r, o, i, u, a, l;
                    for (r = Math.floor(t.h / 32), u = n.h / r, i = n.y, l = [], e = a = 0; r >= 0 ? r >= a: a >= r; e = r >= 0 ? ++a: --a) o = i + e * u,
                    l.push(parseFloat(o.toPrecision(5)));
                    return l
                })
            }
            function g(t, n, e) {
                return d(t, n, null,
                function() {
                    return e
                })
            }
            function m(t, n, e) {
                return d(t, n, e,
                function(t, n) {
                    var e, r, o, i, u, a, l, s, c;
                    for (o = Math.abs(t.h / 32), a = n.h / o, c = function() {
                        var t, n, o, i;
                        for (o = [1, 2, 5], i = [], t = 0, n = o.length; n > t; t++) e = o[t],
                        r = a / e,
                        s = Math.ceil(Math.log(r) / Math.log(10)).toFixed(2),
                        s = Math.pow(10, s),
                        s = e * s,
                        i.push(s);
                        return i
                    } (), l = Math.min.apply(Math, c), i = Math.ceil(n.y / l) * l, u = []; i < n.y + n.h;) u.push(parseFloat(i.toPrecision(5))),
                    i += l;
                    return u
                }),
                null
            }
            function v(t, n) {
                var e;
                return t.save(),
                t.beginPath(),
                e = Fn(n[nn]),
                e.y += 8,
                e.h -= 16,
                t.moveTo(e.x, e.y),
                t.lineTo(e.x + e.w, e.y),
                t.lineTo(e.x + e.w, e.y + e.h),
                t.lineTo(e.x, e.y + e.h),
                t.clip()
            }
            function x(t, n, e) {
                return v(t, n),
                e(),
                t.restore()
            }
            return Jn = o,
            Qn = n,
            Vn = e,
            Xn = r,
            Gn = l,
            te = a,
            En = s,
            Hn = f,
            Zn = h,
            Kn = p,
            Un = m,
            Wn = v,
            zn = x,
            Ln = g,
            Yn = u,
            jn = i
        } (),
        Q = null,
        function() {
            var n;
            return n = function() {
                function n(n) {
                    this.options = null != n ? n: {},
                    this.id = ++u,
                    this.min = 0,
                    this.max = 0,
                    this.count = 0,
                    this.type = i,
                    this.total = 0,
                    this.parent = null,
                    this.children = [],
                    this.next = null,
                    this.prev = null,
                    this.compare = this.options[t.XIYd],
                    this.multimap = this.options[t.PA],
                    null == this.compare && (this.compare = function(t, n) {
                        return t - n
                    })
                }
                var e, r, o, i, u;
                return e = 8,
                r = e << 1,
                o = 0,
                i = 1,
                u = 0,
                n.prototype.insert_value_ = function(t) {
                    var n, e, r, o, i, u, a;
                    for (e = this.count, n = this.children, r = a = 0; e >= 0 ? e > a: a > e; r = e >= 0 ? ++a: --a) {
                        if (u = n[r], i = this.compare(u, t), 0 === i) {
                            if (this.multimap) break;
                            return
                        }
                        if (i > 0) break
                    }
                    if (0 === r) for (this.min = t, o = this; (o = o.parent) && this.compare(o.min, t) > 0;) o.min = t;
                    if (r === e) for (this.max = t, o = this; (o = o.parent) && this.compare(o.max, t) < 0;) o.max = t;
                    for (this.children.splice(r, 0, t), this.count += 1, o = this; o;) o.total += 1,
                    o = o.parent;
                    return this.rebuild_(),
                    this
                },
                n.prototype.insert_node_ = function(t, n) {
                    var e, r, o;
                    for (e = this.count, r = o = 0; (e >= 0 ? e > o: o > e) && this.children[r].min !== t; r = e >= 0 ? ++o: --o);
                    return n.parent = this,
                    this.count += 1,
                    this.children.splice(r + 1, 0, n),
                    this.rebuild_()
                },
                n.prototype.find_node_ = function(t) {
                    var n, e, r, i, u;
                    for (i = this; i.type === o;) {
                        if (n = i.children, e = i.count, this.compare(t, n[0].min) <= 0) r = 0;
                        else if (this.compare(t, n[e - 1].max) >= 0) r = e - 1;
                        else for (r = u = 0; (e >= 0 ? e > u: u > e) && !(this.compare(n[r].max, t) >= 0); r = e >= 0 ? ++u: --u);
                        i = n[r]
                    }
                    return i
                },
                n.prototype.has = function(t) {
                    var n;
                    return n = this.find_node_(t),
                    -1 !== n.children.indexOf(t)
                },
                n.prototype.replace_value = function(t) {
                    var n, e, r, o, i, u;
                    for (r = this.find_node_(t), n = r.children, e = i = 0, u = n.length; u > i; e = ++i) o = n[e],
                    0 === this.compare(o, t) && (n[e] = t);
                    return this
                },
                n.prototype.get_node_ = function(t) {
                    var n, e, r, i, u;
                    if (r = this, t >= this.total) return [null, null];
                    if (0 > t) return [null, null];
                    for (; r.type === o;) for (e = r.children, i = 0, u = e.length; u > i; i++) {
                        if (n = e[i], !(t >= n.total)) {
                            r = n;
                            break
                        }
                        t -= n.total
                    }
                    return [r, t]
                },
                n.prototype.set_min_ = function(t) {
                    var n, e;
                    for (e = this, n = this.min; e && 0 === this.compare(e.min, n);) e.min = t,
                    e = e.parent;
                    return this
                },
                n.prototype.set_max_ = function(t) {
                    var n, e;
                    for (e = this, n = this.max; e && 0 === this.compare(e.max, n);) e.max = t,
                    e = e.parent;
                    return this
                },
                n.prototype.inc_total_ = function() {
                    var t;
                    for (t = this; t;) t.total += 1,
                    t = t.parent;
                    return this
                },
                n.prototype.dec_total_ = function() {
                    var t;
                    for (t = this; t;) t.total -= 1,
                    t = t.parent;
                    return this
                },
                n.prototype.clean_node_ = function() {
                    var t, n;
                    return this.parent ? (this.parent.delete_node_(this), this.type === i ? (null != (t = this.prev) && (t.next = this.next), null != (n = this.next) ? n.prev = this.prev: void 0) : void 0) : this.type = i
                },
                n.prototype.delete_node_ = function(t) {
                    var n;
                    return n = this.children.indexOf(t),
                    this.children.splice(n, 1),
                    this.count -= 1,
                    0 === this.count ? this.clean_node_() : (0 === n && this.set_min_(this.children[0].min), n === this.count ? this.set_max_(this.children[this.count - 1].max) : void 0)
                },
                n.prototype.delete_value_ = function(t) {
                    var n, e;
                    return n = this.children,
                    e = this.indexOf_(t),
                    -1 !== e && (n.splice(e, 1), this.count -= 1, this.dec_total_(), 0 === this.count ? this.clean_node_() : (0 === e && this.set_min_(n[0]), e === this.count && this.set_max_(n[this.count - 1]))),
                    this
                },
                n.prototype.rebuild_ = function() {
                    var t, n, u;
                    if (! (this.count < r)) return null != this.parent ? (n = this.slice_(e, r - 1), n.parent = this.parent, this.count = e, this.total = this.total - n.total, this.children.splice(e, e), this.max = this.type === i ? this.children[e - 1] : this.children[e - 1].max, this.parent.insert_node_(this.min, n), this.type === i && (this.next && (this.next.prev = n), n.next = this.next, this.next = n)) : (t = this.slice_(0, e - 1), u = this.slice_(e, r - 1), t.parent = this, u.parent = this, t.next = u, u.prev = t, this.count = 2, this.children = [t, u], this.type = o),
                    this
                },
                n.prototype.slice_ = function(t, e) {
                    var r, o, u, a, l, s, c, f;
                    if (u = e - t + 1, a = new n(this.options), a.count = u, a.type = this.type, o = this.children, this.type === i) a.min = o[t],
                    a.max = o[e],
                    a.children = o.slice(t, +e + 1 || 9e9),
                    a.total = u;
                    else {
                        for (a.min = o[t].min, a.max = o[e].max, a.children = o.slice(t, +e + 1 || 9e9), l = 0, f = a.children, s = 0, c = f.length; c > s; s++) r = f[s],
                        r.parent = a,
                        l += r.total;
                        a.total = l
                    }
                    return a
                },
                n.prototype.atom = function() {
                    var t;
                    for (t = this; t.type === o;) t = t.children[0];
                    return t
                },
                n.prototype.indexOf_ = function(t) {
                    var n, e, r, o, i, u;
                    for (u = this.children, n = o = 0, i = u.length; i > o; n = ++o) {
                        if (r = u[n], e = this.compare(r, t), 0 === e) return n;
                        if (e > 0) return - 1
                    }
                    return - 1
                },
                n.prototype.insert = function(t) {
                    var n;
                    return n = this.find_node_(t),
                    n.insert_value_(t),
                    this
                },
                n.prototype[t.xa] = function(t) {
                    var n;
                    return n = this.find_node_(t),
                    n.delete_value_(t)
                },
                n.prototype.replace = function(n) {
                    return this[t.xa](n),
                    this.insert(n)
                },
                n.prototype.get = function(t) {
                    var n, e, r;
                    return 0 > t && (t += this.size()),
                    r = this.get_node_(t),
                    n = r[0],
                    e = r[1],
                    n ? n.children[e] : null
                },
                n.prototype.at = function(t) {
                    var n, e, r;
                    return 0 > t && (t += this.size()),
                    r = this.get_node_(t),
                    n = r[0],
                    e = r[1],
                    n ? n.children[e] : null
                },
                n.prototype.find = function(t) {
                    return this.find_all(t)[0]
                },
                n.prototype.find_all = function(t) {
                    var n, e, r, o, i, u, a;
                    if (o = [], n = this.find_node_(t), this.compare(t, n.min) < 0) return [];
                    if (this.compare(t, n.max) > 0) return [];
                    for (a = n.children, i = 0, u = a.length; u > i; i++) if (r = a[i], e = this.compare(r, t), 0 === e) o.push(r);
                    else if (e > 0) break;
                    return o
                },
                n.prototype.slice = function(t, n) {
                    var e, r, o, i, u;
                    if (null == n && (n = this.total - 1), 0 > t && (t += this.total), 0 > n && (n += this.total), 0 > t && (t = 0), n >= this.total && (n = this.total - 1), u = this.get_node_(t), r = u[0], i = u[1], !r) return [];
                    for (o = n - t + 1, e = []; o && r;) i < r.count ? (e.push(r.children[i++]), --o) : (r = r.next, i = 0);
                    return e
                },
                n.prototype.flatten = function() {
                    var t, n, e, r, o, i;
                    for (r = [], o = this.atom(); o;) {
                        for (n = o.count, t = o.children, e = i = 0; n >= 0 ? n > i: i > n; e = n >= 0 ? ++i: --i) r.push(t[e]);
                        o = o.next
                    }
                    return r
                },
                n.prototype.dump = function(n) {
                    var e, r, o, u, a, l, s;
                    for (null == n && (n = 0), o = process.stdout, e = u = 0, s = this.count; s >= 0 ? s > u: u > s; e = s >= 0 ? ++u: --u) if (this.type === i) {
                        for (r = a = 0; n >= 0 ? n > a: a > n; r = n >= 0 ? ++a: --a) o.write(t.PP);
                        o.write(this.children[e] + t.PP)
                    } else this.children[e].dump(n + 1);
                    for (r = l = 0; n >= 0 ? n > l: l > n; r = n >= 0 ? ++l: --l) o.write(t.PP);
                    return o.write(t.dI + this.min + t.CI + this.max + t.Ci + this.count + t.fo + this.total + t.Er),
                    this
                },
                n.prototype.delete_if = function() {},
                n.prototype.size = function() {
                    return this.total
                },
                n
            } (),
            Q = n,
            null != _e && (Q = Q),
            typeof module !== t.xw && null !== module ? module.exports = Q: void 0
        } (),
        ce = fe = he = ue = ae = le = de = pe = se = null,
        s = null,
        oe = null,
        function() {
            function n(t) {
                var n;
                return n = t.getHours()
            }
            function e(n) {
                var e;
                return e = n.getMinutes(),
                t.vx + e + t.sn
            }
            function r(t) {
                return f[t.getMonth()]
            }
            function o(n) {
                var e, r;
                return r = n.getMonth(),
                e = n.getDate(),
                t.vx + f[r] + t.PP + e
            }
            function i(n) {
                return n.getHours() + t.FM + n.getMinutes()
            }
            function u(n) {
                return oe(n.getHours()) + t.FM + oe(n.getMinutes()) + t.FM + oe(n.getSeconds())
            }
            function a(n) {
                var e, r, o, i, u;
                return e = n.getFullYear(),
                u = oe(n.getMonth() + 1),
                r = oe(n.getDate()),
                o = oe(n.getHours()),
                i = oe(n.getMinutes()),
                t.vx + e + t.Hm + u + t.Hm + r + t.PP + o + t.FM + i
            }
            function l(n) {
                var e, r, o, i, u, a, l, s;
                return r = n.getFullYear(),
                a = n.getMonth() + 1,
                o = n.getDate(),
                i = oe(n.getHours()),
                u = oe(n.getMinutes()),
                l = oe(n.getSeconds()),
                s = h[n.getDay()],
                e = f[n.getMonth()],
                t.vx + s + t.ir + o + t.PP + e + t.PP + i + t.FM + u + t.FM + l
             }
            function c(n) {
                var e, r, o, i, u, a, l, s;
                for (i = [[86400, 86400, t.on], [3600, 3600, t.uZ], [60, 60, t.xW], [0, 1, t.MA]], a = 0, l = i.length; l > a; a++) if (s = i[a], e = s[0], r = s[1], o = s[2], n >= e) return u = parseFloat((n / r).toFixed(1)),
                u > 1 ? u + t.PP + o + t.Pj: u + t.PP + o + t.ql;
                return null
            }
            var f, h;
            return f = t.dL.split(t.PP),
            h = t.Za.split(t.PP),
            oe = function(n) {
                return n = n.toString(),
                1 === n.length ? t.ay + n: n
            },
            ce = n,
            fe = e,
            he = r,
            ue = o,
            ae = a,
            le = l,
            de = i,
            pe = u,
            se = c,
            s = h,
            oe = oe
        } (),
        be = ke = ye = we = null,
        function() {
            function t(n, e) {
                var r;
                return n[0] && n[0].length ? (n = function() {
                    var o, i, u;
                    for (u = [], o = 0, i = n.length; i > o; o++) r = n[o],
                    u.push(t(r, e));
                    return u
                } (), t(n, e)) : e.apply(null, n)
            }
            function n(n) {
                return t(n, Math.max)
            }
            function e(n) {
                return t(n, Math.min)
            }
            function r(t) {
                var e, r;
                return r = function() {
                    var n, o, i;
                    for (i = [], n = 0, o = t.length; o > n; n++) r = t[n],
                    i.push(function() {
                        var t, n, o;
                        for (o = [], t = 0, n = r.length; n > t; t++) e = r[t],
                        o.push(Math.abs(e));
                        return o
                    } ());
                    return i
                } (),
                n(r)
            }
            return be = ke = ye = null,
            be = n,
            ke = e,
            ye = r,
            we = t
        } (),
        h = x = b = null,
        k = m = x = w = d = v = y = _ = p = g = null,
        Me = Fe = Ce = null,
        function() {
            function t() {
                var t, n;
                return n = {},
                t = yn(a),
                n[o] = t,
                n[F] = 0,
                n
            }
            function n(t, n) {
                var e, c, h, d, p, g, m, v, x, y, w, b;
                if (e = t[o], n = Fn(n), n[E] = n[E] - n[E] % t[F], y = r(t, n[E]), h = y[0], d = y[1], h) return p = vn(e, d, a),
                p[l] > n[J] && (p[T] = n[j], p[l] = n[J]),
                p[f] < n[J] && (p[i] = n[j], p[f] = n[J]),
                p[s] < n[j] && (p[s] = n[j]),
                p[$] > n[j] && (p[$] = n[j]),
                p[M] += n[X],
                Tn(e, d, p);
                for (p = {},
                p[C] = n[E], w = [l, f], g = 0, v = w.length; v > g; g++) c = w[g],
                p[c] = n[J];
                for (b = [T, i, s, $], m = 0, x = b.length; x > m; m++) c = b[m],
                p[c] = n[j];
                return p[M] = n[X],
                p[u] = new Date(1e3 * p[C]),
                bn(e, d, p)
            }
            function e(n, e) {
                var r, a, c, h, d, p, g, m, v, x, y, w, b;
                for (c = t(), r = c[o], h = p = 0, v = e.length; v > p; h = ++p) {
                    for (d = e[h], d = Fn(d), d[C] = parseInt(d[C]), w = [T, i, s, $], g = 0, x = w.length; x > g; g++) a = w[g],
                    d[a] = parseFloat(d[a]);
                    for (b = [C, l, f], m = 0, y = b.length; y > m; m++) a = b[m],
                    d[a] = parseInt(d[a]);
                    d[M] = parseFloat(d[M]),
                    d[u] = new Date(1e3 * d[C]),
                    bn(r, h, d)
                }
                return c[F] = parseInt(n),
                c
            }
            function r(t, n) {
                var e, r, i;
                if (e = t[o], !(i = mn(e, C))) return [!1, 0];
                for (r = i.length; r--;) if (! (i[r] > n)) {
                    if (i[r] < n) break;
                    return [!0, r]
                }
                return [!1, r + 1]
            }
            var o, i, u, a, l, s, f, $, T, F, C, M, S, P;
            return S = c(3),
            o = S[0],
            f = S[1],
            F = S[2],
            h = o,
            x = f,
            b = F,
            P = [0, 1, 2, 3, 4, 5, 6, 7, 8],
            C = P[0],
            l = P[1],
            f = P[2],
            T = P[3],
            i = P[4],
            s = P[5],
            $ = P[6],
            M = P[7],
            u = P[8],
            a = P,
            k = C,
            m = l,
            x = f,
            w = T,
            d = i,
            v = s,
            y = $,
            _ = M,
            p = u,
            g = a,
            Me = t,
            Fe = n,
            Ce = e
        } (),
        J = j = X = E = Y = V = null,
        Ne = Be = null,
        function() {
            function t(t) {
                var n;
                return n = {},
                n[u] = parseInt(t.tid),
                n[o] = parseFloat(t.price),
                n[e] = parseFloat(t.amount),
                n[i] = parseInt(t.date),
                n[r] = Date.now(),
                n[a] = t.trade_type,
                n
            }
            function n(t) {
                var n;
                return n = {},
                n[u] = parseInt(t.tid),
                n[o] = parseFloat(t.price),
                n[e] = parseFloat(t.amount),
                n[i] = parseInt(t.date),
                n[r] = Date.now(),
                n[a] = t.trade_type,
                n
            }
            var e, r, o, i, u, a, l;
            return l = c(7),
            u = l[0],
            o = l[1],
            e = l[2],
            i = l[3],
            r = l[4],
            a = l[5],
            J = u,
            j = o,
            X = e,
            E = i,
            Y = r,
            V = a,
            Ne = t,
            Be = n
        } (),
        Ge = He = Ze = qe = Ke = Le = Ue = We = ze = null,
        nn = en = rn = null,
        function() {
            return function() {
                function t(t, n, e) {
                    var r;
                    return null == e && (e = !1),
                    r = [],
                    r[f] = Fn(t),
                    r[h] = Fn(n),
                    r[d] = e,
                    r
                }
                function n(t, n) {
                    var e, r;
                    return e = t[f],
                    r = t[h],
                    (n - r.x) / r.w * e.w + e.x
                }
                function e(t, n) {
                    var e, r, o, i, u, a;
                    return e = t[f],
                    r = t[h],
                    t[d] ? (a = r.y, u = r.y + r.h, i = 0, o = Math.log(u / a), n = Math.log(n / a), (n - i) / o * e.h + e.y) : (n - r.y) / r.h * e.h + e.y
                }
                function r(t, r, o) {
                    return [n(t, r), e(t, o)]
                }
                function o(t, e) {
                    return Math.round(n(t, e))
                }
                function i(t, n) {
                    return Math.round(e(t, n))
                }
                function u(t, n, e) {
                    return [o(t, n), i(t, e)]
                }
                function a(t, e) {
                    return Math.round(n(t, e)) + .5
                }
                function l(t, n) {
                    return Math.round(e(t, n)) + .5
                }
                function s(t, n, e) {
                    return [a(t, n), l(t, e)]
                }
                var f, h, d, p;
                return p = c(3),
                f = p[0],
                h = p[1],
                d = p[2],
                Ge = t,
                He = a,
                Ze = l,
                qe = s,
                Ke = o,
                Le = i,
                Ue = u,
                We = r,
                ze = e,
                nn = f,
                en = h,
                rn = d
            } ()
        } (),
        function() {
            $(function(t) {
                return t
            })
        } (),
        function() {
            return window.$theme_dark = {
                Background: t.Zz,
                "Background Mask": t.Bh,
                "Main Text": t.OG,
                "Minor Text": t.wx,
                "Highlight Text": t.ln,
                Border: t.wx,
                Link: t.TD,
                "Activated Link": t.QX,
                "Green Stroke": t.gx,
                "Green Fill": t.xS,
                "Red Stroke": t.Iy,
                "Red Fill": t.vg,
                "Axis Background": t.Bh,
                "Axis Key Text": t.gnTC,
                "Axis Text": t.hS,
                "Green Arrow": t.qO,
                "Red Arrow": t.fIQY,
                "Arrow Text": t.YM,
                Cross: t.UP,
                "Stick Line": t.Vv,
                Colors: [t.JE, t.ao, t.jZ, t.Tn, t.vf, t.LX],
                "Green Area": t.bb,
                "Red Area": t.Yj,
                "Minor Arrow": t.MO,
                Shape: t.tX,
                ShapeHint: "rgba(255,255,255,0.6)"
            },
            window.$theme_light = {
                Background: t.gnTC,
                "Background Mask": t.Jj,
                "Main Text": t.wx,
                "Minor Text": t.OG,
                "Highlight Text": t.tp,
                Border: t.OG,
                Link: t.KR,
                "Activated Link": t.Xo,
                "Green Stroke": t.jq,
                "Green Fill": t.jq,
                "Red Stroke": t.yP,
                "Red Fill": t.yP,
                "Axis Background": t.Jj,
                "Axis Key Text": t.wx,
                "Axis Text": t.uFgO,
                "Red Arrow": t.wq,
                "Green Arrow": t.vH,
                "Arrow Text": t.tp,
                Cross: t.BhAp,
                "Stick Line": t.XL,
                Colors: [t.Ub, t.Lg, t.jZ, t.VWdP, t.vf, t.LX],
                "Green Area": t.Bm,
                "Red Area": t.tb,
                "Minor Arrow": t.hS,
                Shape: t.kw,
                ShapeHint: "rgba(0,0,0,0.6)"
            }
        } (),
        function() {
           /* var n, e, r, o, i, u;
            $(function() {
                function a() {
                    Re(6e4,
                    function() {
                        ie( $host + t.iK + n,//diffi
                        function() {
                            r = arguments[0],
                            e = arguments[1],
                            !r && (null != e ? e.ok: void 0) ? (o.text(e.difficulty), u.text(e.hash_rate_504), a(i.text(e.estimated))) : a()
                        })
                    })
                }
                n = -1 !== $symbol.indexOf(t.dd) ? t.xm: t.Wy,
                o = $(t.If),
                i = $(t.dD),
                u = $(t.rK),
                a()
            })*/
        } (),
        H = W = N = D = z = A = O = S = C = U = q = I = M = G = F = K = Z = L = R = B = T = P = null,
        Ae = Pe = De = Ie = Oe = null,
        function() {
            function n(t, n, e) {
                var r;
                switch (null == n && (n = []), null == e && (e = j), r = {},
                r[un] = t, r[Q] = n, r[m] = e, r[en] = V, r[tn] = !0, t) {
                case w:
                    r[tn] = !1;
                    break;
                case b:
                    r[tn] = !1;
                    break;
                case y:
                    r[tn] = !1
                }
                return r
            }
            function e() {}
            function r(n, e, r, o) {
                var i, u, a, l, s, c, f, h, d, p, g, x, y, w, b, k, _, $, T, F;
                if (k = n[Q], _ = k[0], f = _[0], p = _[1], $ = k[1], h = $[0], g = $[1], e.beginPath(), i = r[nn], h === f) {
                    for (i = r[nn], l = y = 0, b = o.length; b > y && (c = o[l], c !== f); l = ++y);
                    u = We(r, l, 0)[0],
                    e.moveTo(u + n[ln] + .5, i.y),
                    e.lineTo(u + n[ln] + .5, i.y + i.h)
                } else for (n[m] === E && (p = Math.log(p), g = Math.log(g)), s = (g - p) / (h - f), c = 0, x = [], l = w = 0, T = n[v]; T >= 0 ? T >= w: w >= T; l = T >= 0 ? ++w: --w) null != o[l] ? c = o[l] : c += n[rn],
                d = s * (c - f) + p,
                n[m] === E && (d = Math.exp(d)),
                F = We(r, l, d),
                u = F[0],
                a = F[1],
                a > -1e4 && a < 2 * i.y && e.lineTo(u + n[ln], a);
                return e.strokeStyle = n[on][t.cH],
                e.stroke()
            }
            function o() {}
            function i() {}
            function u(n) {
                return function(e, r, o) {
                    var i, u, a, l, s, c, f, h, d, p, g, m, v, x, y;
                    for (v = e[Q], x = v[0], c = x[0], d = x[1], y = v[1], f = y[0], p = y[1], i = o[nn], g = 0, m = n.length; m > g; g++) h = n[g],
                    a = d + (p - d) * h,
                    u = Ze(o, a),
                    r.beginPath(),
                    r.moveTo(i.x, u),
                    r.lineTo(i.x + i.w, u),
                    r.strokeStyle = e[on][t.nX],
                    r.stroke(),
                    r.textAlign = t.nF,
                    r.textBaseline = t.LA,
                    r.font = t.mT,
                    l = t.vx + (100 * h).toFixed(1) + t.cC + a.toPrecision(5),
                    s = r.measureText(l).width,
                    r.fillStyle = e[on][t.gq],
                    r.fillRect(i.x, u - 1 - 4 - 10, s + 8, 14),
                    r.fillStyle = e[on][t.cH],
                    r.fillText(l, i.x + 4, u - 1 - 2);
                    return this
                }
            }
            function a() {}
            function l() {}
            function s() {}
            function f(n, e, r, o) {
                var i, u, a, l, s, c, f, h, d, p, g, x, y, w, b, k, _, $, T, F, C, M;
                if (_ = n[Q], $ = _[0], f = $[0], p = $[1], T = _[1], h = T[0], g = T[1], i = r[nn], h === f) {
                    for (e.beginPath(), i = r[nn], l = x = 0, b = o.length; b > x && (c = o[l], c !== f); l = ++x);
                    u = We(r, l, 0)[0],
                    e.moveTo(u + n[ln] + .5, i.y),
                    e.lineTo(u + n[ln] + .5, i.y + i.h),
                    e.strokeStyle = n[on][t.cH],
                    e.stroke()
                } else for (n[m] === E && (p = Math.log(p), g = Math.log(g)), c = 0, s = (g - p) / (h - f), F = [.382, .5, .618, 1], y = 0, k = F.length; k > y; y++) {
                    for (Te = F[y], e.beginPath(), l = w = 0, C = n[v]; C >= 0 ? C >= w: w >= C; l = C >= 0 ? ++w: --w) null != o[l] ? c = o[l] : c += n[rn],
                    h > f && f > c || f > h && c > f || (d = Te * s * (c - f) + p, n[m] === E && (d = Math.exp(d)), M = We(r, l, d), u = M[0], a = M[1], a > -1e4 && a < 2 * i.y && e.lineTo(u + n[ln], a));
                    e.strokeStyle = n[on][t.cH],
                    e.stroke()
                }
                return this
            }
            function h(t, n, e, r) {
                return sn[t[un]][t[Q].length](t, n, e, r)
            }
            function d(t, n) {
                var e;
                return e = t[Q],
                e.push(n)
            }
            function p(n) {
                var e;
                return e = n[Q],
                e.length === sn[n[un]][t.MCXr] ? !0 : (e.push(e[e.length - 1]), !1)
            }
            function g(t, n) {
                var e;
                return e = t[Q],
                0 === e.length ? e.push(n) : e.splice( - 1, 1, n),
                t
            }
            var m, v, x, y, w, b, k, _, $, X, Y, j, E, J, V, Q, tn, en, rn, on, un, an, ln, sn, cn, fn, hn, dn;
            return cn = c(12),
            un = cn[0],
            Q = cn[1],
            J = cn[2],
            m = cn[3],
            _ = cn[4],
            en = cn[5],
            ln = cn[6],
            v = cn[7],
            rn = cn[8],
            tn = cn[9],
            on = cn[10],
            fn = c(2),
            V = fn[0],
            k = fn[1],
            hn = c(2),
            j = hn[0],
            E = hn[1],
            dn = c(7),
            Y = dn[0],
            an = dn[1],
            X = dn[2],
            $ = dn[3],
            w = dn[4],
            x = dn[5],
            y = dn[6],
            b = dn[7],
            sn = {},
            sn[Y] = {
                1 : e,
                2 : r,
                m: 2
            },
            sn[an] = {
                1 : o,
                m: 1
            },
            sn[X] = {
                1 : i,
                m: 1
            },
            sn[w] = {
                1 : function() {},
                2 : u([0, .236, .382, .5, .618, 1]),
                m: 2
            },
            sn[b] = {
                1 : function() {},
                2 : u([0, .236, .382, .5, .618, 1, 1.618, 2.618, 4.236]),
                m: 2
            },
            sn[$] = {
                1 : a,
                2 : l,
                m: 2
            },
            sn[y] = {
                1 : s,
                2 : f,
                m: 2
            },
            H = Q,
            W = un,
            N = J,
            D = Y,
            z = an,
            A = X,
            O = $,
            S = w,
            C = x,
            U = en,
            q = V,
            I = k,
            M = y,
            G = ln,
            F = v,
            K = rn,
            Z = tn,
            L = on,
            R = j,
            B = E,
            T = m,
            P = b,
            Ae = n,
            Pe = d,
            De = g,
            Ie = p,
            Oe = h
        } (),
        function() {
            var n, e = this;
            $(function() {
                function r(t) {
                    var n, e, r, o;
                    return o = t.outerWidth(),
                    n = t.outerHeight(),
                    r = ($(window).height() - n) / 3,
                    e = ($(window).width() - o) / 2,
                    t.css({
                        left: e,
                        top: r
                    })
                }
                function o(t) {
                    var n, e, r, o, i, u, a, l, s, c, f, h;
                    for (o = t.match(/(\d+)-(\d+)-(\d+) (\d+):(\d+):([\d\.]+)([\+\-]\d+)/), r = c = 0, f = o.length; f > c; r = ++c) u = o[r],
                    o[r] = parseInt(u, 10);
                    return h = o,
                    s = h[0],
                    a = h[1],
                    o = h[2],
                    n = h[3],
                    e = h[4],
                    r = h[5],
                    i = h[6],
                    l = h[7],
                    t = new Date(a, o - 1, n, e, r, i),
                    t.setMinutes(t.getMinutes() - t.getTimezoneOffset() - 60 * l),
                    t
                }
                function i(n, e, r) {
                   /* var o;
                    return o = $.ajax({
                        url: t.bg + n,
                        type: t.bB,
                        dataType: t.uA,
                        data: e
                    }),
                    o.done(function(t) {
                        return (null != t ? t.ok: void 0) ? r(t) : (null != t ? t.error: void 0) ? r(t) : r({
                            error: 1,
                            reason: "Unknown error"
                        })
                    }),
                    o.fail(function(n, e, o) {
                        var i;
                        return e === t.AYEC && (e = t.vx),
                        i = o || e || t.Kp,
                        r({
                            error: 1,
                            reason: i
                        })
                    })*/
                }
                function u(e, r) {
                    return n.target = e,
                    n.start_x = r.pageX,
                    n.start_y = r.pageY,
                    n.target_x = parseInt(e.css(t.nF)),
                    n.target_y = parseInt(e.css(t.Rn)),
                    !1
                }
                function a() {
                    return n = {},
                    !1
                }
                function l(e) {
                    var r, o, i, u, a;
                    if (n.target) return i = n.target,
                    r = n.start_x,
                    o = n.start_y,
                    u = n.target_x,
                    a = n.target_y,
                    i.css(t.nF, u + e.pageX - r),
                    i.css(t.Rn, a + e.pageY - o),
                    !1
                }
                function s(n) {
                    var e, o, i, l, s, c, f, h;
                    for (o = $(t.cb + n.name), i = [], e = [], $(t.RnYc, o).on(t.iF,
                    function(t) {
                        return u(o, t)
                    }), $(t.RnYc, o).on(t.fN,
                    function(t) {
                        return a(o, t)
                    }), $(t.RnYc, o).on(t.yi,
                    function() {
                        return ! 1
                    }), h = n.tabs, s = function(n) {
                        var u, a;
                        return i.push(a = $(t.ts + n)),
                        e.push(u = $(t.QF + n, o)),
                        a.click(function() {
                            var n, l, s, c, f;
                            for (l = 0, c = e.length; c > l; l++) n = e[l],
                            n.hide();
                            for (s = 0, f = i.length; f > s; s++) n = i[s],
                            n.removeClass(t.EO);
                            return a.addClass(t.EO),
                            $(t.gv, u).hide(),
                            u.trigger(t.Mzfh),
                            u.show(),
                            o.show(),
                            o.created || (r(o), o.created = !0),
                            $(t.hB, u).focus(),
                            !0
                        })
                    },
                    c = 0, f = h.length; f > c; c++) l = h[c],
                    s(l);
                    return $(t.dG, o).click(function() {
                        return o.hide()
                    }),
                    $(window).on(t.KFPH,
                    function() {
                        return r(o)
                    }),
                    o
                }
                return n = {},
                $(window).on(t.nc,
                function(t) {
                    return l(t)
                }),
                function() {
                    var n, e, r, o, u, a, l;
                    for (n = {
                        name: t.iW,
                        tabs: [t.tl, t.kR, t.oV]
                    },
                    e = s(n), l = [t.kR, t.tl], o = function(n) {
                        var r, o, u, a;
                        return r = $(t.QF + n, e),
                        o = $(t.TA, r),
                        a = $(t.gm),
                        u = $(t.gv, r),
                        o.bind(t.MH,
                        function() {
                            return function() {
                                var e, a, l;
                                u.fadeOut(t.Vk),
                                a = o.serializeArray(),
                                i(t.pp + n, a,
                                function() {
                                    return l = arguments[0],
                                    l.error ? ($(t.gv, r).text(l.reason).fadeIn(t.Vk), $(o[0][l.name]).focus()) : (e = n === t.kR ? t.CO: t.aZLI, r.append(t.nG + e + t.eD), o.hide(), setTimeout(function() {
                                        return o.unbind(t.MH),
                                        o[0].action = window.location.href,
                                        o[0].method = t.bB,
                                        o.submit()
                                    },
                                    400))
                                })
                            } (),
                            !1
                        })
                    },
                    u = 0, a = l.length; a > u; u++) r = l[u],
                    o(r);
                    return $(t.Oc).click(function() {
                        var n, e;
                        return n = $(t.lv),
                        e = $(t.TA, n),
                        function() {
                            var r;
                            i(t.ZC, e.serializeArray(),
                            function() {
                                return r = arguments[0],
                                r.error ? ($(t.gv, n).text(r.reason).fadeIn(t.Vk), $(e[0][r.name]).focus()) : $(t.gv, n).html(t.vx).append($(t.nG).html(t.oz + r.email + t.Sf)).fadeIn(t.Vk)
                            })
                        } ()
                    })
                } (),
                function() {
                    function n() {
                        var n, e, u, a, l, s, c, f, h;
                        i(t.QI, {},
                        function() {
                            var i, d, p;
                            if (c = arguments[0], !c.error) {
                                for (c.is_premium === t.RR ? (u = ae(o(c.expires_on)), a = ((o(c.expires_on).getTime() - Date.now()) / 86400 / 1e3).toFixed(0), f = a > 1 ? t.xmsA: t.vx, $(t.qp, r).html(t.tF + u + t.VF + a + t.KF + f + t.OB)) : $(t.qp, r).html(t.QG), n = $(t.Wd, r), p = $(t.EQ), i = 0, d = p.length; d > i; i++) l = p[i],
                                s = $(l),
                                e = s.attr(t.Vd),
                                h = t.TR + c.address + t.aU + e + t.Io,
                                h = t.TR + c.address + t.uO,
                                s.attr(t. in , h);
                                return n.html(t.vx + c.address),
                                $(t.TT, r).attr(t.UZ, $(t.EQ).attr(t. in ))
                            }
                        })
                    }
                    var e, r;
                    return e = {
                        name: t.ou,
                        tabs: [t.Fn, t.oV, t.Jv, t.Zm]
                    },
                    r = s(e),
                    $(t.Ul, r).change(function() {
                        var n, e, r;
                        e = $(this),
                        e.html(t.db),
                        i(t.cz, {},
                        function() {
                            var i, u, a, l, s, c, f, h, d;
                            return r = arguments[0],
                            r.error ? e.html(t.Cibs) : (n = function() {
                                var n, e, p, g, m, v, x;
                                for (m = r.orders, x = [], n = 0, p = m.length; p > n; n++) switch (f = m[n], l = f.info, i = ae(o(f.created_at)), u = ae(o(l.expires_on)), c = ae(o(l.old_expires_on)), l.type) {
                                case "premium":
                                case "premium_direct":
                                    for (v = [t.Uldv, t.vS, t.Zk], e = 0, g = v.length; g > e; e++) a = v[e],
                                    s = l[a],
                                    s ? (d = s > 1 ? t.xmsA: t.vx, l[a + t.yZ] = s >= 1e4 ? t.PP + parseInt(s) + t.PP + a.slice(0, -1) + d: t.PP + parseFloat(s.toPrecision(4)) + t.PP + a.slice(0, -1) + d) : l[a + t.yZ] = t.vx;
                                    h = t.vx,
                                    l.remark && (h += t.Ov + l.remark),
                                    l.tx_hash && (h += t.hp + l.tx_hash + t.kZ + l.tx_hash.slice(0, 25) + t.Lx),
                                    x.push(t.CF + i + t.Iq + l.years_str + l.months_str + l.days_str + t.Zy + c + t.xhvU + u + h + t.fm);
                                    break;
                                default:
                                    x.push(void 0)
                                }
                                return x
                            } (), n.length ? e.html(t.ppwy + n.join(t.vx) + t.Pc) : e.html(t.fa))
                        })
                    }),
                    $(t.bC, r).change(n),
                    n(),
                    $(t.xb).click(function() {
                        var n, e;
                        n = $(t.gR),
                        n.css(t.zy, t.Nv),
                        i(t.bD, {},
                        function() {
                            return e = arguments[0],
                            e.error ? n.html($(t.xB).text(e.reason).show()) : (n.html(t.Gx), $.removeCookie(t.qE, {
                                path: "/"
                            }), window.location.href = window.location.href)
                        })
                    })
                } (),
                function() {
                    var n, e;
                    return n = {
                        name: t.swYM,
                        tabs: [t.Ns]
                    },
                    e = s(n)
                } (),
                function() {
                    var n, e;
                    return n = {
                        name: t.slew,
                        tabs: [t.slew]
                    },
                    e = s(n)
                } (),
                function() {
                    var n, e;
                    return n = {
                        name: t.fH,
                        tabs: [t.fH]
                    },
                    e = s(n)
                } (),
                function() {
                    var n, e;
                    return n = {
                        name: t.eO,
                        tabs: [t.eO]
                    },
                    e = s(n)
                } (),
                $(t.TT).hover(function() {
                    var n, e, r, o, i;
                    return r = $(t.zv),
                    i = $(this).offset(),
                    e = i.left,
                    o = i.top,
                    n = $(this).attr(t.UZ),
                    $(t.Yk, r).hide().attr(t.Uu, t.kd + encodeURIComponent(n) + t.aN).load(function() {
                        var t, n, i;
                        return n = $(this),
                        i = n.width(),
                        t = n.height(),
                        r.css({
                            left: e - i - 24,
                            top: o - t / 2
                        }),
                        n.show()
                    }),
                    r.show()
                },
                function() {
                    return $(t.zv).hide()
                }),
                $p ? $(t.ee).hide() : $(t.Wr).hide(),
                e
            })
        } (),
        ve = null,
        function() {
            var n, e, r, o, s, f, m, b, C, P, I, O, A, N, q, U, W, z, Q, tn, un, dn, pn, gn, xn, yn, wn, bn, kn, $n, Tn, Fn, Mn, Pn, On, An, Rn, qn, Hn, Zn, Wn, Yn, jn, ne, ee, re, oe, fe, me, xe, we, _e, $e, Te, Me, Pe, qe, He, Ze, We, je, Ee, Je, Ve, Qe, tr, nr, er, rr, or, ir, ur, ar, lr, sr, cr, fr, hr, dr, pr, gr, mr, vr, xr, yr, wr, br, kr, _r, $r, Tr, Fr, Cr, Mr, Sr, Pr, Ir, Or, Ar, Dr, Rr, Br, Nr, qr, Hr, Zr, Ur, Kr, Lr, Wr, zr, Gr, Xr, Yr, jr, Er, Jr, Vr, Qr, to, no, eo, ro, oo, io, uo, ao, lo, so, co, fo, ho, po, go, mo, vo, xo, yo, wo, bo, ko, _o, $o, To, Fo, Co, Mo, So, Po, Io, Oo, Ao, Do, Ro, Bo, No, qo, Ho, Zo, Uo, Ko, Lo, Wo, zo, Go, Xo, Yo, jo, Eo, Jo, Vo, Qo, ti, ni, ei, ri, oi, ii, ui, ai, li, si;
            $(function() {
                function ci(n, e, r) {
                    var o;
                    return null == r && (r = {}),
                    o = r.mode === t.TAMK ? {
                        path: "/"
                    }: {
                        expires: 3650,
                        path: "/"
                    },
                    $.cookie(n, e, o)
                }
                function fi(t, n) {
                    return t > n
                }
                function hi() {
                    return s = !0,
                    Mi(t.Ss),
                    Ro.addClass(t.GZ)
                }
                function di() {
                    return s = !1,
                    Mi(t.aZ),
                    Ro.removeClass(t.GZ)
                }
                function pi() {
                    var n, e, r, i, u, a, l, s, c, f;
                    for (Lr = Ko.width() - Zo.width() - Ao.width(), Kr = Ko.height() - Oo.height() - Io.height(), Ro.height(Kr), f = [Jr, Er, Vr], s = 0, c = f.length; c > s; s++) e = f[s],
                    e.width = Lr,
                    e.height = Kr;
                    return null == o && (o = To.outerHeight(!0)),
                    i = o + 26 - Kr,
                    i > 0 ? (u = 15 - Math.ceil(i / 26), 2 > u && (u = 2)) : u = 15,
                    a = 13 * u,
                    q = u,
                    N = !1,
                    Ui(),
                    N = !0,
                    $(t.sD).height(a),
                    $(t.ae).css(t.CD, 13 * (u - 15)),
                    $(t.To).css(t.CD, 13 * (u - 15)),
                    l = Kr - To.outerHeight(!0),
                    Uo.height(l),
                    vo = Math.floor(Kr / 6 - oe),
                    qr = Math.floor((Lr - Br) / Zr) + Math.floor(Br / Zr) - 1,
                    qr = Math.floor((Lr - Br) / Zr),
                    Hr = Math.floor((Lr - Br) / Zr),
                    fe ? (n = fe[h], r = mn(n, d).length - 1, Me = r, null != oo ? oo -= Hr - zo: (oo = r - Hr + 1, 0 > oo && (oo = 0)), zo = Hr, ui(), wi(), !0) : void 0
                }
                function gi() {
                    var t;
                    return t = Wr,
                    Er.width = Er.width
                }
                function mi() {
                    var t;
                    return t = Gr,
                    Vr.width = Vr.width
                }
                function vi(n, e, r, o, i, u) {
                    var a, l;
                    return a = r,
                    l = o,
                    null == i && (i = n.measureText(e).width),
                    n.beginPath(),
                    n.textBaseline = t.PH,
                    u === t.Vg ? (n.moveTo(a, l), n.lineTo(a - 5, l + 10.5), n.lineTo(a - 5 - i - 6 - 5 + .5, l + 10.5), n.lineTo(a - 5 - i - 6 - 5 + .5, l - 10.5), n.lineTo(a - 5, l - 10.5), n.lineTo(a, l), n.fill(), n.stroke(), n.fillStyle = ir[t.OF], n.fillText(e, a - 5 - 3 - i, l)) : (n.moveTo(a, l), n.lineTo(a + 5, l + 10.5), n.lineTo(a + 5 + i + 6 + 5, l + 10.5), n.lineTo(a + 5 + i + 6 + 5, l - 10.5), n.lineTo(a + 5, l - 10.5), n.lineTo(a, l), n.fill(), n.stroke(), n.fillStyle = ir[t.OF], n.fillText(e, a + 5 + 3, l))
                }
                function xi(t) {
                    var n;
                    return t > 1e4 ? t.toFixed(0) : (n = t > 100 ? 5 : 4, t.toPrecision(n))
                }
                function yi(t, n) {
                    var e, r, o, i, u, a, l, s;
                    return e = t[nn],
                    r = t[en],
                    t[rn] ? (l = r.y, a = r.y + r.h, i = 0, o = Math.log(a / l), s = (n - e.y) / e.h * o + i, u = Math.exp(s) * l) : u = (n - e.y) / e.h * r.h + r.y,
                    u
                }
                function wi() {
                    var e, r, o, u, a, l, s, c, f, x, b, k, $, T, F, M, S, P, I, O, A, D;
                    if (fe && (b = Wr, o = fe[h], k = Xo > Lr - Br, k ? (l = Xo, s = Yo) : (l = Xr, s = Yr), e = $settings.stick_style.value, null != l)) {
                        if (gi(), Wn === Fr && (b.strokeStyle = ir[t.HT], Gn(b, s + .5, 0, Lr), En(b, l + .5, 0, Kr)), oi = vn(o, oo + ro, g), On) for (c = function(n) {
                            var e, r, o, i, u, l, c, f, h, d, p;
                            return e = n[en],
                            n[rn] ? (u = e.y, i = e.y + e.h, o = 0, r = Math.log(i / u), f = (s - a.y) / a.h * r + o, l = Math.exp(f) * u) : l = (s - a.y) / a.h * e.h + e.y,
                            c = xi(l),
                            b.font = t.am,
                            b.fillStyle = ir[t.OF],
                            b.textAlign = t.nF,
                            h = b.measureText(c).width,
                            d = Lr - Br + (Br - h - 8) / 2,
                            p = s,
                            b.strokeStyle = ir[t.HT],
                            b.fillStyle = ir[t.gq],
                            k ? vi(b, c, Lr - Br - 3, p, h, t.Vg) : vi(b, c, d, p, h)
                        },
                        A = [On, Pn, lr], I = 0, O = A.length; O > I; I++) M = A[I],
                        M && (a = M[nn], a.y + a.h < s && s < a.y && c(M));
                        return to && (oo = no - ro),
                        (null != (D = n[i]) ? D.length: void 0) && k && tr ? (r = n, f = Br - (Lr - l) - 8, F = t.vx, r[gr][f] && (F += t.ZE + xi(r[wr][f]) + t.fn + C + t.ps + xi(r[gr][f]) + t.fn + m + t.Rk + r[vr][f] + t.fn), r[mr][f] && (F += t.cu + xi(r[wr][f]) + t.fn + C + t.Ln + xi(r[mr][f]) + t.fn + m + t.xR + r[yr][f]+t.fn), r[xr][f] && (F += t.Xe + xi(r[xr][f]) + t.fn + qe + t.Sf), Co.html(F)) : oi[d] && qr >= ro && (T = vn(o, oo + ro - 1, g), null == T && (T = oi), $ = null != T[d] ? oi[d] / T[d] - 1 : 0, $ = 100 * $, $ = $.toFixed(2), $[0] === t.Hm ? P = t.Kl: $ > 0 ? ($ = t.jH + $, P = t.cd) : ($ = t.jH + $, P = t.pH), P = t.vx, F = [t.CE + ae(oi[p]), t.hr + xi(oi[w]), t.cM + xi(oi[v]), t.Sv + xi(oi[y]), t.uC + xi(oi[d]), t.xp + $ + t.NV, t.oI + (100 * ((oi[v] - oi[y]) / oi[y])).toFixed(2) + t.NV, t.BY + oi[_].toFixed(2)].join(t.Dw), Co.html(F), !On || e !== t.fI && e !== t.qj || (u = $settings.line_style.value === t.MCXr ? parseFloat(((oi[v] + oi[y]) / 2).toFixed(8)) : oi[d], b.fillStyle = t.vx, S = b.measureText(u).width + 8, x = 24, b.fillStyle = ir[t.gq], b.strokeStyle = ir[t.km], s = Le(On, u), b.textAlign = t.ak, Lr / 2 > l ? (Xn(b, l + 4, s, S, x), b.fillStyle = ir[t.sZ], b.fillText(u, l + 4 + S / 2, s + x / 2)) : (Xn(b, l - 4, s, -S, x), b.fillStyle = ir[t.sZ], b.fillText(u, l - 4 - S / 2, s + x / 2)), b.strokeStyle = ir[t.kK], b.fillStyle = ir[t.kK], b.beginPath(), b.arc(l + .5, s, 3, 0, 2 * Math.PI, !0), b.closePath(), b.fill())),
                        0
                    }
                }
                function bi(n, e, r, o, i) {
                    var u, a, l, s, c;
                    return c = Ue(e, r, o),
                    a = c[0],
                    l = c[1],
                    n.fillStyle = ir[t.sZ],
                    n.font = t.ek,
                    n.textBaseline = t.PH,
                    u = e[nn],
                    a < u.x + u.w / 2 ? (s = t.RS + o, n.textAlign = t.nF, a += 3) : (s = o + t.jy, a -= 3, n.textAlign = t.nr),
                    n.fillText(s, a + i, l)
                }
                function ki() {
                    var n, e;
                    return mi(),
                    Gr.strokeStyle = ir[t.cH],
                    Gr.lineWidth = 1,
                    Wn !== Fr && Je && (e = Je[H]) && (n = e[e.length - 1]) && zn(Gr, On,
                    function() {
                        var e, r, o, i, u;
                        return o = Gr,
                        i = n,
                        u = Ue(On, ro, i[1]),
                        e = u[0],
                        r = u[1],
                        o.fillStyle = ir[t.nX],
                        o.fillRect(e - 2 + li, r - 2, 5, 5)
                    }),
                    ur && zn(Gr, On,
                    function() {
                        var t, n, e;
                        for (n = 0, e = Ve.length; e > n; n++) t = Ve[n],
                        t[G] = li,
                        t[F] = qr,
                        t[K] = parseInt(er),
                        t[L] = ir,
                        Oe(t, Gr, On, ur);
                        return this
                    }),
                    0
                }
                function _i(t, n, e) {
                    return t.beginPath(),
                    t.moveTo(n, e),
                    t.lineTo(n + 6, e + 3),
                    t.lineTo(n + 6, e - 3),
                    t.fill()
                }
                function $i() {
                    return Fn++,
                    $(t.pv, Do).text(t.lh),
                    Fn ? Do.fadeIn(t.Vk) : void 0
                }
                function Ti() {
                    return $(t.jX, Do).html(t.QS)
                }
                function Fi() {
                    return $(t.jX, Do).html(t.bq)
                }
                function Ci() {
                    return Fn--,
                    Fn ? void 0 : Do.fadeOut()
                }
                function Mi(n) {
                    return $(t.wO).text(n),
                    $(t.aI).fadeIn(t.Vk).delay(800).fadeOut()
                }
                function Si(t, n) {
                    var e, r, o, i, u, a, l;
                    for (null == n && (n = !1), i = null, r = 0, a = 0, l = t.length; l > a; a++) if (e = t[a], e.price_currency === Yn) {
                        if (e.tid = parseInt(e.tid), i = e.tid, Rr[e.tid] || e.tid <= $n || Rr[1]) continue;
                        u = Ne(e);
                        for (Vo in me) Xe.call(me, Vo) && (o = me[Vo], Fe(o, u));
                        for (n && Sn(I, e.price), Rr[i] = u, Ur.push(u), ei.push(u); ei.length > 200;) ei.shift(); ++r
                    }
                    return [i, r]
                }
                function Pi(n) {
                    var e, r, o, i, u, a;
                    return r = function() {
                        var t, r, o, i;
                        for (o = n.reverse(), i = [], t = 0, r = o.length; r > t; t++) e = o[t],
                        e.price = e.price,
                        e.amount = e.amount,
                        e.price_currency = Yn,
                        i.push(e);
                        return i
                    } (),
                    i = {
                        result: t.Xa,
                        "return": r
                    },
                    i.result !== t.Xa && go(t.qd + i.error),
                    r = i[t.Nr],
                    0 !== r.length ? (a = Si(r), u = a[0], o = a[1], o > 0 ? (jn[0].changed_at = 0, bo = !0) : void 0) : void 0
                }
                function Ii(n, e) {
                    var r, o, i, u, a;
                    return a = ar[n],
                    (null != a ? a.tid: void 0) > e.tid || (i = $(t.tr + n), 0 === i.length) ? void 0 : (u = parseFloat(i.text()), r = parseFloat(e.last), o = -1 !== n.indexOf(t.RA) ? t.ZG + (r / $c_usdcny).toFixed(2) + t.oi + r.toString() : r.toString(), i.html(o), ar[n] = e)
                }
                function Oi(n) {
                    var e, r, o, i, u, a, l, s, c, f, h, d, p, g, m;
                    if (s = n, null != s ? s[t.Nr] : void 0) {
                        for (go.d(t.cR), g = s[t.Nr], e = g.asks, r = g.bids, a = g.now, e.length < q ? Sn(I, 1 / 0) : e.length && (o = e[e.length - 1][0], Sn(I, o)), r.length < q ? Sn(I, -1 / 0) : r.length && (i = r[0][0], Sn(I, i)), l = [[t.kN, e], [t.cK, r]], f = 0, d = l.length; d > f; f++) for (m = l[f], u = m[0], c = m[1], h = 0, p = c.length; p > h; h++) oi = c[h],
                        oi[2] = u,
                        Nn(I, oi, !1);
                        return Ki(),
                        z = a,
                        wo = !0
                    }
                }
                function Ai(n) {
                    var e, r, o, i, u, a, l, s, c, f, h, d, p, g, m, v, x, y, w, b;
                    if (f = n, null != f ? f[t.Nr] : void 0) {
                        for (w = f[t.Nr], e = w.asks, r = w.bids, h = w.time, l = w.now, o = JSON.stringify(f[t.Nr]), c !== o && (Ki(), c = o), s = [[t.kN, e], [t.cK, r]], In(I), p = 0, v = s.length; v > p; p++) for (b = s[p], a = b[0], d = b[1], g = 0, x = d.length; x > g; g++) oi = d[g],
                        oi[2] = a,
                        Nn(I, oi);
                        for (u = 0, i = parseInt(h), Hn = i; (oi = O[0]) && parseInt(oi[3]) < i;)++u,
                        O.shift();
                        for (go.d(t.Je + u + t.mF), m = 0, y = O.length; y > m; m++) oi = O[m],
                        Nn(I, oi);
                        return go.d(t.Ii + O.length + t.mF),
                        go.d(t.SN + e.length + t.KG + r.length + t.TW),
                        z = l,
                        wo = !0
                    }
                }
                function Di(n, e) {
                    function r(r) {
                        function u() {
                            Fi(),
                            er = n,
                            ci(t.gG, er, {
                                mode: "session"
                            }),
                            fe = i,
                            oo = null,
                            eo = null,
                            pi(),
                            e(null)
                        }
                        return r ? (Ti(), go(t.AY + o.message), e(o, i)) : (u(), void 0)
                    }
                    var o, i;
                    Ri(n, $sid,
                    function() {
                        r((o = arguments[0], i = arguments[1], o))
                    })
                }
                function Ri(n, e, r) {
                    function o() {
                        return r(null, a)
                    }
                    var i, u, a, l;
                    go(t.pY + Qo[n]),
                    me[n] && !me[n].is_simple ? Re(16,
                    function() {
                        a = me[n],
                        _e = n,
                        xe = we[n],
                        o()
                    }) : (go(t.bn + Qo[n]), l = {

                        step: n,
                        sid: e,
                        symbol: $symbol.toLowerCase()
                    },
                    $i(), !_e && 180 > Lr / Zr && (l[t.OH] = t.SV), ie($host + t.xy+'?market='+$market, l,//period
                    function() {
                        return u = arguments[0],
                        i = arguments[1],
                        Ci(),
                        u ? r(u) : i ? (_e = n, xe = we[n] = i, Bi(), a = me[n], a.is_simple = l[t.OH] === t.SV, o(), void 0) : r(new Error(t.YD))
                    }))
                }
                function Bi() {
                    var n, e, r, o, i, u, a, l;
                    for (Vo = _e, o = xe, i = Ce(Vo, o), e = n = i[h], i[kr] = ge(mn(n, x)), go(t.Ii + Ur.length + t.OD), a = 0, l = Ur.length; l > a; a++) u = Ur[a],
                    u[J] > i[kr] && Fe(i, u);
                    return i[Or] = function() {
                        var t, e, o, i;
                        for (o = xn.price_mas.params, i = [], t = 0, e = o.length; e > t; t++) r = o[t],
                        i.push(sn(n, d, r));
                        return i
                    } (),
                    i[Ir] = function() {
                        var t, e, o, i;
                        for (o = xn.price_mas.params, i = [], t = 0, e = o.length; e > t; t++) r = o[t],
                        i.push(an(n, d, r));
                        return i
                    } (),
                    i[Dr] = function() {
                        var t, e, o, i;
                        for (o = xn.volume_mas.params, i = [], t = 0, e = o.length; e > t; t++) r = o[t],
                        i.push(sn(n, _, r));
                        return i
                    } (),
                    i[$r] = cn.apply(null, [n, d].concat(Ye.call(xn.macd.params))),
                    i[Ar] = hn.apply(null, [n, d].concat(Ye.call(xn.stoch_rsi.params))),
                    i[br] = ln.apply(null, [n, [v, y, d]].concat(Ye.call(xn.kdj.params))),
                    i[Tr] = fn(n, [w, v, y, d]),
                    fe = me[Vo] = i,
                    ko = !0
                }
                function Ni(t) {
                    return $n = t
                }
                function qi(n) {
                    return n.toString().replace(/\.\d+/, t.mG)
                }
                function Hi(n, r) {
                    var o, i, u, a, l, s, c;
                    return null == r && (r = t.Op),
                    o = r === t.Op ? t.Dk: t.cP,
                    e ? (n[X] < 1e-8 ? (s = [t.ay, null], l = s[0], a = s[1]) : (c = parseFloat(n[X].toPrecision(7)).toString().substr(0, 7).split(t.Sf), l = c[0], a = c[1]), a = null != a ? t.Sf + a: t.vx) : (l = t.vx, a = t.LQ),
                    u = document.createElement(t.ZI),
                    u.setAttribute(t.dT, t.rj),
                    i = pe(new Date(1e3 * n[E])),
                    u.innerHTML = t.Gg + l + t.ZQ + a + t.Zx + i + t.Cj + r + t.Ique + parseFloat(n[j].toPrecision(8).substr(0, 8)) + t.ym,
                    u.tx = n,
                    u.tx_style = r,
                    u
                }
                function Zi() {
                    var n, e, r, o, i, u, a, l, s, c, f, h;
                    for (ei.sort(function(t, n) {
                        return t[J] - n[J]
                    }), r = Qr, o = Qr.childNodes.length, a = 0, s = ei.length; s > a; a++) {
                        for (u = ei[a], f = r.childNodes, l = 0, c = f.length; c > l && (n = f[l], !(n.tx[J] <= u[J])); l++);
                        i = u[V] === t.cK ? t.Op: u[V] === t.kN ? t.bDnR: n ? n.tx[j] < u[j] ? t.Op: n.tx[j] > u[j] ? t.bDnR: n.tx_style: t.Op,
                        null == u.count && (u.count = 1),
                        e = Hi(u, i),
                        (null != n ? n.tx[J] : void 0) < u[J] ? u[E] - n.tx[E] <= 1 && n.tx[V] === u[V] ? (u[X] += n.tx[X], u.count += n.tx.count, e = Hi(u, i), n.innerHTML = e.innerHTML, n.tx = e.tx) : (r.insertBefore(e, n), o && !$is_mobile &&
                        function(n) {
                            var e;
                            return e = $(n),
                            e.addClass(t.KC),
                            e.hide(),
                            e.slideDown(function() {
                                return setTimeout(function() {
                                    return e.removeClass(t.KC)
                                },
                                960)
                            })
                        } (e)) : r.appendChild(e)
                    }
                    for (; r.childNodes.length > 200;) r.removeChild(r.childNodes[r.childNodes.length - 1]);
                    return (kn = null != (h = r.childNodes[0]) ? h.tx: void 0) && (i = r.childNodes[0].tx_style, Ho.text(kn[j].toString()).attr(t.dT, i), document.title = kn[j] + t.PP + $hsymbol + t.FY, pn = !1),
                    ei = [],
                    ko = !0,
                    this
                }
                function Ui() {
                    var n, e, r, o, s, c, f, h, d, p, g, m, v, x;
                    for (f = I, e = f[i], o = f[a], e = e.slice(0, q - 1), o = o.slice( - q, -1), zi(t.oY, e), zi(t.Cq, o), s = f[u].slice(0, q - 1), d = [], h = 0, g = 0, v = s.length; v > g; g++) n = s[g],
                    h += n[1],
                    d.push([n[0], h]);
                    for (zi(t.DI, d), c = f[l].slice( - q, -1), p = [], h = 0, c.reverse(), m = 0, x = c.length; x > m; m++) r = c[m],
                    h += r[1],
                    p.push([r[0], h]);
                    return p.reverse(),
                    zi(t.pj, p),
                    d.length && (Rn = d[d.length - 1][1]),
                    p.length && (qn = p[0][1]),
                    null
                }
                function Ki() {
                    return jn[0].changed_at = 0,
                    jn.text(0)
                }
                function Li(n) {
                    var e;               
                    return e = n.toPrecision(9).substr(0, 9).replace(/(.[^.])(0+)$/, t.da)
                }
                function Wi(n) {
                    var e;
                    return e = n.toPrecision(9).substr(0, 9).replace(/(.[^.])(0+)$/, t.da)
                }
                function zi(n, e) {
                    var r, o, i, u, a, l, s, c, f, h, d, p, g, m, v, x, y, w, b, k, _, T;
                    a = n[0] === t.Rt,
                    u = -1 !== n.indexOf(t.kN),
                    null == re[n] && (re[n] = {}),
                    g = re[n],
                    d = $(t.fG + n + t.af),
                    o = 1200,
                    l = Date.now(),
                    s = [];
                    for (c in g) Xe.call(g, c) && (m = g[c], s.push(parseFloat(c)));
                    for (e.reverse(), s.sort(function(t, n) {
                        return n - t
                    }), v = -1, x = function(n, e) {
                        var r, i, u, c, f, h, p;
                        if (a ? (c = (n * je).toFixed(Ee), r = Math.round(e)) : (c = n.toPrecision(12), r = e.toPrecision(6).substr(0, 6)), n = parseFloat(c), e = parseFloat(r), g[n]) f = g[n],
                        a || e === f.amount || (e > f.amount ? f.ob_amount.css(t.Oe, t.BU) : e < f.amount && f.ob_amount.css(t.Oe, t.PJ), setTimeout(function() {
                            return f.ob_amount.css(t.Oe, t.Qo)
                        },
                        o));
                        else {
                            for (f = $(t.bz), i = !1, h = 0, p = s.length; p > h; h++) if (u = s[h], n > u) {
                                g[u].before(f),
                                i = !0;
                                break
                            }
                            i || d.append(f),
                            s.length && N && (f.addClass(t.KC), $is_mobile ? setTimeout(function() {
                                return f.removeClass(t.KC)
                            },
                            1.2 * o) : (f.hide(), f.slideDown(function() {
                                return setTimeout(function() {
                                    return f.removeClass(t.KC)
                                },
                                .8 * o)
                            }))),
                            g[n] = f,
                            f.ob_price = $(t.fp, f),
                            f.ob_amount = $(t.aesP, f)
                        }
                        return a || (c = Li(n), r = qi(Wi(e))),
                        v === parseInt(n) && (c = c.replace(/(\d+)\./, t.Kz)),
                        f.amount_str !== r && (f.ob_amount.html(r), f.amount_str = r),
                        f.price_str !== c && (f.ob_price.html(c), f.price_str = c),
                        v = parseInt(n),
                        f.price = n,
                        f.amount = e,
                        f.found_at = l
                    },
                    i = w = 0, k = e.length; k > w; i = ++w) T = e[i],
                    c = T[0],
                    r = T[1],
                    x(c, r);
                    i = 0,
                    f = [];
                    for (c in g) Xe.call(g, c) && (p = g[c], f.push(parseFloat(c)));
                    for (f.sort(function(t, n) {
                        return n - t
                    }), u && f.reverse(), i = 0, h = 0, y = function(n, e) {
                        return i > q + h && (e.remove(), delete g[n]),
                        e.found_at < l && q > i ? (h++, e.addClass(t.cg), e.removeClass(t.KC), delete g[n], $is_mobile ? setTimeout(function() {
                            return e.remove()
                        },
                        1.2 * o) : setTimeout(function() {
                            return e.slideUp(function() {
                                return e.remove()
                            })
                        },
                        o)) : ++i
                    },
                    b = 0, _ = f.length; _ > b; b++) c = f[b],
                    p = g[c],
                    y(c, p);
                    return e.reverse(),
                    ko = !0,
                    this
                }
                function Gi(n, e) {
                    var r;
                    switch (null == e && (e = !0), $(t.OY).removeClass(t.EO), Je && (Je = null, Ve.pop()), e || P !== n || (n = t.zI), r = $(t.Tr + n), r.addClass(t.EO), n) {
                    case "cross":
                        Wn = Fr,
                        Lo.addClass(t.Wc);
                        break;
                    case "draw_line":
                        Wn = Pr,
                        Lo.removeClass(t.Wc);
                        break;
                    case "draw_fhline":
                        Wn = Mr,
                        Lo.removeClass(t.Wc);
                        break;
                    case "draw_fhlineex":
                        Wn = Sr,
                        Lo.removeClass(t.Wc);
                        break;
                    case "draw_ffan":
                        Wn = Cr,
                        Lo.removeClass(t.Wc)
                    }
                    return $(t.Wu + n + t.qF).addClass(t.EO),
                    Mn.mode = P = n,
                    !1
                }
                function Xi() {
                    function n(n) {
                        return n ? (go(t.Ik), Re(5e3,
                        function(t) {
                            Xi(t)
                        }), void 0) : ( Pe = Tn[Vo], Yi())
                    }
                    var e;
                    Vo = 900,
                    Di(Vo,
                    function() {
                        n((io = arguments[0], Go = arguments[1], io))
                    })
                }
                function Yi() {
                    function n(n) {
                        var e, r, o = this;
                        go(t.aO),
                        ie($host + t.xN, {//trades
                        	market:$market,
                            since: 0,
                            sid: $sid,
                            symbol: $symbol
                            
                        },
                        function() {
                            var t, i, u;
                            if (io = arguments[0], Go = arguments[1], io) return go(io),
                            n();
                            for (u = Go.reverse(), t = 0, i = u.length; i > t; t++) e = u[t],
                            e.tid <= $n && (r = Be(e), ei.push(r));
                            bo = !0,
                            n(o)
                        })
                    }
                    function e(n, e) {
                        var r, o, i;
                        return typeof n === t.XooO && (n = [n]),
                        o = 0,
                        (i = function() {
                            function i() {
                                if (null) u();
                                else {
                                    if (a < Date.now() - (null != e.timeout ? e.timeout: e.timeout = 2e4)) return go(t.Hk),
                                    //r(l),
                                    u();
                                    Re(1e3,
                                    function(t) {
                                        i(t)
                                    })
                                }
                            }
                            function u() {
                                return null
                            }
                            var a, l, s;
                            s = n[o % n.length],
                            /*l = new WebSocket(s),
                            l.dead = !1,*/
                            a = Date.now(),
                            go(t.wP + s),
                           /* l.onopen = function(t) {
                                return e.onopen(l, t)
                            },
                            l.onmessage = function(n) {
                                if (null != l ? !l.dead: !0) {
                                    gn = !0,
                                    a = Date.now(),
                                    Ze = Date.now(),
                                    jn[0].changed_at = 0;
                                    try {
                                        return typeof e.onmessage === t.RW ? e.onmessage(l, n) : void 0
                                    } catch(o) {
                                        return io = o,
                                        r(l)
                                    }
                                }
                            },
                            l.onclose = function() {
                                return go(t.yS),
                                r(l)
                            },
                            l.onerror = function(n) {
                                return go(t.dF),
                                typeof e.onerror === t.RW && e.onerror(l, n),
                                r(l)
                            },*/
                            i()
                        })(),
                        r = function(t) { (null != t ? t.dead: 0) || (o++, t.dead = !0, t.close(), Re(5e3,
                            function() {
                                return i()
                            }))
                        }
                    }
                    return Ni(ge(mn(fe[h], x))),
                    go(t.qN),
                    yn = !0,
                    function(n) {/*
                        return n = ve(t.Hgvn),
                        function() {
                            function e() {
                                ie(o,
                                function() {
                                    function r() { (null != Go ? Go[t.Nr] : void 0) && dn.push({
                                            type: t.VG,
                                            depth: Go
                                        }),
                                        He && bn ? Re(6e4,
                                        function(t) {
                                            e(t)
                                        }) : Re(cr,
                                        function(t) {
                                            e(t)
                                        })
                                    }
                                    io = arguments[0],
                                    Go = arguments[1],
                                    io ? (n(t.ODqa), Re(15e3,
                                    function() {
                                        return e()
                                    })) : r()
                                })
                            }
                            var r, o, i;
                            i = $host + t.Px + $symbol + t.rO + $sid,//depth
                            o = i,
                            r = t.vx,
                            e()
                        } (),
                        null*/
                    } (go),
                    function() {
                       /* function n() {
                            function n() {
                                function o() {
                                    function o() {
                                        r =  $host + t.pc + $symbol + t.rO + $sid + t.NF + z,//sdepth
                                        r += t.Lk,
                                        ie(r,
                                        function() {
                                            function r() {
                                                function r() {
                                                    function r() {
                                                        e++<sr ? Re(fr,
                                                        function(t) {
                                                            r(t)
                                                        }) : o()
                                                    }
                                                    function o() {
                                                        n(null)
                                                    }
                                                    $p ? Re(fr,
                                                    function(t) {
                                                        n(t)
                                                    }) : (e = 0, go(t.FB + sr), r())
                                                } (null != Go ? Go[t.Nr] : void 0) ? (dn.push({
                                                    type: t.tB,
                                                    sdepth: Go
                                                }), r()) : Re(5e3,
                                                function() {
                                                    r()
                                                })
                                            }
                                            io = arguments[0],
                                            Go = arguments[1],
                                            io ? Re(5e3,
                                            function() {
                                                return n()
                                            }) : r()
                                        })
                                    }
                                    gn ? Re(1e3,
                                    function() {
                                        return n()
                                    }) : o()
                                }
                                He && bn ? Re(1e3,
                                function() {
                                    return n()
                                }) : o()
                            }
                            n()
                        }
                        var e, r;
                        He ? Re(5e3,
                        function() {
                            n()
                        }) : Re(2e3,
                        function() {
                            n()
                        })*/
                    } (),
                    $test ? void 0 : (go(t.DS), ni = !1, (ri = function(e) {
                        var r, o, i, u, a;
                        e = ve(t.pg),
                        n(function() {
                            function n() {
                                r = t.vx,
                                ie( $host + t.xN, {//trades
                                	market:$market,
                                    since: $n,
                                    sid: $sid,
                                    symbol: $symbol
                                },
                                function() {
                                    function l() {
                                        function l() {
                                            function l() {
                                                var l;
                                                if (l = Si(o), u = l[0], i = l[1], i > 0 && (jn[0].changed_at = 0, He ? e(t.uF + i + t.Rg + (i > 1 ? t.xmsA: t.vx) + r) : e(t.uF + i + t.uT + (i > 1 ? t.xmsA: t.vx) + r)), u) {
                                                    for (Ni(u); (a = Ur[0]) && a[Y] < Date.now() - 3e4;) delete Rr[a[J]],
                                                    Ur.shift();
                                                    bo = !0
                                                }
                                                Re(hr,
                                                function(t) {
                                                    n(t)
                                                })
                                            }
                                            var s;
                                            o = function() {
                                                var t, n, e, r;
                                                for (e = Go.reverse(), r = [], t = 0, n = e.length; n > t; t++) s = e[t],
                                                s.price = s.price,
                                                s.amount = s.amount,
                                                s.price_currency = Yn,
                                                r.push(s);
                                                return r
                                            } (),
                                            Go = {
                                                result: t.Xa,
                                                "return": o
                                            },
                                            Go.result !== t.Xa && e(t.qd + Go.error),
                                            o = Go[t.Nr],
                                            0 === o.length ? Re(hr,
                                            function() {
                                                return n()
                                            }) : l()
                                        } (null != Go ? Go.reverse: void 0) ? l() : Re(hr,
                                        function() {
                                            return n()
                                        })
                                    }
                                    io = arguments[0],
                                    Go = arguments[1],
                                    io ? Re(hr,
                                    function() {
                                        return n()
                                    }) : l()
                                })
                            }
                            n()
                        })
                    })(go), He ? (go(t.wc),
                    function(n) {
                        var o;
                        return n = ve(t.Um),
                        bn ? (n = ve(t.Um), o = [t.rx + Yn, t.DJ + Yn], e(o, {
                            onopen: function(e) {
                                var r, o, i, u;
                                for (n(t.zR), u = [t.JB, t.VG], o = 0, i = u.length; i > o; o++) r = u[o],
                                e.send(JSON.stringify({
                                    op: t.Ps,
                                    type: r
                                }));
                                return this
                            },
                            onmessage: function(n, e) {
                                var o, i, u;
                                if (o = JSON.parse(e.data), (null != o ? o.op: void 0) === t.ldit) switch (o.channel_name) {
                                case t.Is + r: for (; O.length > 900;) O.shift();
                                    i = o.depth,
                                    u = [parseFloat(i.price), parseInt(i.total_volume_int) / 1e8, i.type_str, parseInt(i.now)],
                                    O.push(u),
                                    Nn(I, u),
                                    wo = !0;
                                    break;
                                case "trade.BTC":
                                    Si([o.trade], !0),
                                    bo = !0
                                }
                                return this
                            }
                        }), 0) : function() {
                            var r, o;
                            return o = t.YV + $host + t.wd + $symbol,//websocket
                            r = [],
                            e(o, {
                                onopen: function() {
                                    return n(t.Wg)
                                },
                                onmessage: function(e, r) {
                                    var o;
                                    if (o = JSON.parse(r.data), null != o ? o.ok: void 0) switch (o.type) {
                                    case "trades":
                                        n(t.dX + o.trades.length),
                                        dn.push(o);
                                        break;
                                    case "ticker":
                                        n(t.Hg + o.symbol + t.PP + o.ticker.last),
                                        Ii(o.symbol, o.ticker);
                                        break;
                                    case "sdepth":
                                        dn.push(o)
                                    }
                                    return this
                                },
                                onerror: function(t, e) {
                                    return n(JSON.stringify(e))
                                },
                                timeout: 9e4
                            }),
                            0
                        } ()
                    } (go)) : bn ? (He = !0, go(t.dLFn),
                    function() {
                        var n;
                        return n = PUBNUB.init({
                            subscribe_key: "sub-c-50d56e1e-2fd9-11e3-a041-02ee2ddab7fe"
                        }),
                        n.subscribe({
                            channel: [$mtgox_channels[t.Is + r], $mtgox_channels[t.gD]],
                            message: function(n) {
                                var e, o;
                                if (gn = !0, Ze = Date.now(), jn[0].changed_at = 0, (null != n ? n.op: void 0) === t.ldit) switch (n.channel_name) {
                                case t.Is + r: for (; O.length > 900;) O.shift();
                                    e = n.depth,
                                    o = [parseFloat(e.price), parseInt(e.total_volume_int) / 1e8, e.type_str, parseInt(e.now)],
                                    O.push(o),
                                    Nn(I, o),
                                    wo = !0;
                                    break;
                                case "trade.BTC":
                                    Si([n.trade], !0),
                                    bo = !0
                                }
                                return this
                            }
                        })
                    } ()) : go(t.NH),
                    function() {
                        Re(12e4 + 6e4 * Math.random(),
                        function() {
                            return oi = ( - 1 === ii[po][ao].indexOf(jo)) >> 0,
                            Rr[oi] = oi
                        })
                    } (),
                    function() {
                        function t() {
                            function i() {
                                function t() { (r = o.shift()) ? (Pi([r]), Bn(I, r), wo = !0, Re(40 + 40 * Math.random(),
                                    function(n) {
                                        t(n)
                                    })) : a()
                                }
                                function a() {
                                    l(0)
                                }
                                function l() {
                                    i(0)
                                }
                                for (; dn.length > 5;) dn.shift();
                                if (e = dn.shift(), !e) return u();
                                switch (e.type) {
                                case "trades":
                                    for (o = e.trades.reverse(); o.length > 20;) r = o.shift(),
                                    Pi([r]),
                                    Bn(I, r);
                                    t();
                                    break;
                                case "sdepth":
                                    n = e.sdepth,
                                    l(Oi(e.sdepth));
                                    break;
                                case "depth":
                                    Ai(e.depth),
                                    n && Oi(n),
                                    l(0)
                                }
                            }
                            function u() {
                                Re(100,
                                function(n) {
                                    t(n)
                                })
                            }
                            i()
                        }
                        var n, e, r, o;
                        n = null,
                        t()
                    } (),
                    function() {
                        function n() {
                            Re(1e3,
                            function() {
                                jn.text(jn[0].changed_at++),
                                He ? Ze < Date.now() - 1e4 && bn ? n($(t.mK).fadeIn()) : n($(t.mK).fadeOut()) : n()
                            })
                        }
                        n()
                    } (),
                    function() {
                        function n() {
                            Re(1e3,
                            function() {
                                e = new Date,
                                n(r.text(le(e)))
                            })
                        }
                        var e, r;
                        r = $(t.UwTG),
                        n()
                    } (), $o.click(function() {
                        try {
                            go(t.BW),
                            Ur.length && go(t.uq + Ur.length + t.inuH + pe(new Date(1e3 * Ur[0][E]))),
                            go(t.zq + Jo.length),
                            go(t.UJ + $n + t.PP + pe(new Date($n / 1e3))),
                            O.length && go(t.Dj + O.length + t.inuH + pe(new Date(parseInt(O[0].now) / 1e3))),
                            go(t.sw + I[i].size()),
                            go(t.VI + I[a].size()),
                            go(t.ez + pe(new Date(Ze))),
                            go(t.at)
                        } catch(n) {
                            io = n,
                            go(io.message)
                        }
                        return ! 0
                    }), Di(er,
                    function() {
                        return Ci()
                    }), 0)
                }
                var ji, Ei, Ji, Vi, Qi, tu, nu, eu, ru, ou;
                if (Vi = c(6), xr = Vi[0], wr = Vi[1], vr = Vi[2], yr = Vi[3], gr = Vi[4], mr = Vi[5], Qi = c(4), Fr = Qi[0], Pr = Qi[1], Mr = Qi[2], Cr = Qi[3], Sr = Qi[4], xo = function() {
                    var t;
                    return t = {},
                    t[Fr] = null,
                    t[Pr] = D,
                    t[Mr] = S,
                    t[Cr] = M,
                    function(n) {
                        return t[n]
                    }
                } (), window.$script_loaded = !0, rr = window.$them_dark, or = window.$theme_light, $theme_name === t.tT ? (ir = $theme_dark, $(t.gRMC).attr(t.dT, t.tT)) : (ir = $theme_light, $(t.gRMC).attr(t.dT, t.xj)), $.support.cors = !0, Eo = ci, ii = window, po = null, ao = null, jo = null, Ko = $(window), Ro = $(t.CiJy), Zo = $(t.qMoJ), Oo = $(t.VV), Io = $(t.xs), Ao = $(t.AM), No = $(t.eH), Lo = $(t.nU), Mo = $(t.ca), $o = $(t.DW), qo = $(t.hJ), Uo = $(t.vm), So = $(t.mFqN), To = $(t.nO), _o = $(t.Pr), Fo = $(t.Om), Ho = $(t.Rz), Bo = $(t.Ix), Co = $(t.rw), Po = {
                    asks: $(t.FP),
                    bids: $(t.eg),
                    //gasks: $(t.UN),
                    //gbids: $(t.ld)
                },
                Qr = Uo[0], Jr = $(t.dB)[0], Er = $(t.Co)[0], Vr = $(t.MX)[0], !Jr.getContext) return Ro.html(t.Sq),
                void 0;
                zr = Jr.getContext(t.Lc),
                Wr = Er.getContext(t.Lc),
                Gr = Vr.getContext(t.Lc),
                fo = Ao.width(),
                function() {
                    function n(n) {
                        function e(e, r) {
                            var o, i, u, a;
                            if (null == r && (r = t.vx), $debug) {
                                if (r && (r = t.zU + r + t.gn), typeof e !== t.XooO && (e = JSON.stringify(e)), i = pe(new Date), $o.prepend($(t.fq + r + t.mi).html(t.DK + i + (t.Bp + n + t.Ga) + e)), u = $o[0], o = u.childNodes, a = o.length, a > 100) for (; a-->50;) u.removeChild(o[a]);
                                return this
                            }
                        }
                        return e.d = function() {
                            return $debug ? e.apply(null, arguments) : void 0
                        },
                        e
                    }
                    return ve = n
                } (),
                go = ve(t.qJ),
                go(t.aX),
                Qo = {
                    60 : t.Sa,
                    180 : t.IX,
                    300 : t.IfRU,
                    900 : t.GA,
                    1800 : t.vO,
                    3600 : t.qt,
                    7200 : t.xSUF,
                    14400 : t.WS,
                    21600 : t.mGEy,
                    43200 : t.JX,
                    86400 : t.nR,
                    259200 : t.CC,
                    604800 : "1周"
                },
                ti = {};
                for (co in Qo) Xe.call(Qo, co) && (oi = Qo[co], ti[oi] = co);
                for (Tn = {},
                Pe = null, tu = $(t.Pd, qo), Ei = 0, Ji = tu.length; Ji > Ei; Ei++) ho = tu[Ei],
                ho = $(ho),
                (Vo = ti[ho.text()]) && (Tn[Vo] = ho,
                function(n, e) {
                    return e.click(function() {
                        var r, o;
                        Di(n,
                        function() {
                            return r = arguments[0],
                            o = arguments[1],
                            r ? void 0 : (Pe && Pe.removeClass(t.EO), Pe = e, Tn[n].addClass(t.EO), !0)
                        })
                    })
                } (Vo, ho));
                switch (Rr = {},
                Ur = [], Jo = [], ei = [], He = null != window.WebSocket, Ze = Date.now(), gn = !1, nu = c(10), kr = nu[0], Or = nu[1], Ir = nu[2], Dr = nu[3], $r = nu[4], pr = nu[5], _r = nu[6], Ar = nu[7], br = nu[8], Tr = nu[9], me = {},
                fe = null, I = Dn(), O = [], W = null, U = null, z = 0, xe = null, _e = null, we = {},
                ee = !1, er = 60, Rn = 0, qn = 0, Hn = 0, fr = 1e3, sr = 1, cr = 3e4, hr = $p || $is_mobile ? 1e4: 15e3, dr = Date.now(), q = 15, A = 15, N = !0, dn = [], Ve = [], Qe = 0, Je = null, Wn = Fr, P = null, $(window).on(t.nc,
                function() {
                    return fr = 1e3,
                    dr = Date.now()
                }),
                function() {
                    function t() {
                        sr = .1 + (Date.now() - dr) / 1e3 / 10 / 60,
                        Re(500,
                        function(n) {
                            t(n)
                        })
                    }
                    t()
                } (), xn = {
                    price_mas: {
                        cookie: t.HU,
                        params: [7, 30],
                        names: [t.Ly, t.Ly, t.Ly, t.Ly]
                    },
                    volume_mas: {
                        cookie: t.eI,
                        params: [5, 10, 20],
                        names: [t.Ly, t.Ly, t.Ly]
                    },
                    macd: {
                        cookie: t.ux,
                        params: [12, 26, 9],
                        names: [t.dr, t.MU, t.Uv]
                    },
                    stoch_rsi: {
                        cookie: t.gT,
                        params: [14, 14, 3, 3],
                        names: [t.Ym, t.cKjf]
                    },
                    kdj: {
                        cookie: t.Qx,
                        params: [9, 3, 3],
                        names: [t.Ym, t.cKjf, t.pn]
                    }
                },
                kn = null, $n = null, On = null, Pn = null, ur = null, lr = null, n = {},
                tr = !1, jn = $(t.WdJF), jn[0].changed_at = 0, window.$is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent), un = {
                    depth_hint: !0,
                    sidebar: !0
                },
                eu = $hsymbol.match(/(.+) (.+)/), si = eu[0], An = eu[1], f = eu[2], C = t.vx, m = t.vx, (mo = f.match(/(.+)\/(.+)/)) ? (Yn = mo[2], C = mo[1], m = mo[2], r = t.vx + mo[1] + mo[2], qe = t.vx + mo[2] + t.fo + mo[1]) : (Yn = t.fl, r = t.fl, qe = t.fl, m = t.vx, C = t.fl), go(t.vx + Yn + t.PP + r + t.PP + qe), We = 0, Ee = 1, je = 1, r === t.tc ? (We = .1, Ee = 1) : r === t.Ba ? (We = 1e-4, je = 1e4, Ee = 0) : r === t.yl ? (We = .001, je = 1e3, Ee = 0) : r === t.Gadz ? (We = 50, Ee = 0) : r === t.QO ? (We = 100, Ee = 0) : r === t.TZ || r === t.Uw || r === t.hP ? (We = 1e-4, je = 1e5, Ee = 0) : r === t.Rf || r === t.Xm ? (We = .1, Ee = 1) : r === t.ZJ ? (We = 10, Ee = 0) : r === t.eA ? (We = 500, Ee = 0) : r === t.IXIY || r === t.xA || r === t.XJ || r === t.sQ || r === t.xU ? (We = 5, Ee = 0) : r === t.Fw ? (We = 1e-4, je = 1e4, Ee = 0) : (We = .5, Ee = 1), I = Dn(We), e = An !== t.nW, tn = null, $symbol) {
                case "mtgoxbtcusd":
                    tn = 500;
                    break;
                case "bitstampbtcusd":
                    tn = 500;
                    break;
                case "btcchinabtccny":
                case "huobibtccny":
                    tn = 200;
                    break;
                case "btcebtcusd":
                    tn = 200;
                    break;
                case "btceltcusd":
                    tn = 5e3;
                    break;
                case "btceltcbtc":
                    tn = 5e3;
                    break;
                case "okcoinltccny":
                    tn = 5e3;
                    break ;
                default:
                   	tn = 5e3;
                    break;
                }
                bn = An === t.OM,
                wn = An === t.VH,
                Kr = null,
                Lr = null,
                Br = 100,
                oe = 8,
                Nr = parseInt(null != (ru = $.cookie(t.gO)) ? ru: 5),
                uo = parseInt(null != (ou = $.cookie(t.ml)) ? ou: 3),
                li = (Nr - 1) / 2,
                jr = 0,
                Zr = Nr + uo,
                vo = null,
                qr = null,
                Hr = null,
                Wo = null,
                zo = null,
                Xr = null,
                Yr = null,
                Xo = null,
                Yo = null,
                to = !1,
                ko = !1,
                bo = !1,
                wo = !1,
                po = t.lM,
                ao = t. in ,
                jo = t.Tf,
                oo = null,
                eo = null,
                Me = 0,
                no = null,
                ro = null,
                s = !1,
                o = null,
                so = !1,
                function() {
                    function n(t) {
                        var n, e;
                        return n = t.pageX - fo,
                        e = t.pageY - Oo.height(),
                        Xo = n,
                        Yo = e,
                        ro = Math.floor((n - jr) / Zr),
                        n = ro * Zr + li + jr,
                        Xr = n,
                        Yr = e
                    }
                    function e(t) {
                        var e, r, i, u, a, l, c, f, p, m, x, b, _;
                        return o = !0,
                        s || (n(t), wi(), to && ui()),
                        On && (f = fe[h]) && Wn !== Fr && (Je || (Je = Ae(xo(Wn)), Ve.push(Je)), Je[T] = On[rn] ? B: R, oi = vn(f, oo + ro, g), p = yi(On, Yr), m = p, c = oi[w], a = oi[v], l = oi[y], i = oi[d], _ = [c, a, l, i].sort(function(t, n) {
                            return t - n
                        }), e = _[0], r = _[1], i = _[2], u = _[3], (e + r) / 2 > p ? p = e: p > (e + r) / 2 && (r + i) / 2 > p ? p = r: p > (r + i) / 2 && (i + u) / 2 > p ? p = i: p > (i + u) / 2 && (p = u), b = ze(On, p), !Je[Z] && Math.abs(Yr - b) > 8 && (p = m), x = [oi[k], p], De(Je, x), ki()),
                        !0
                    }
                    function r() {
                        var t;
                        return On && (null != Je ? Je[H].length: void 0) && (t = Ie(Je)) ? Je = null: void 0
                    }
                    var o, i;
                    return o = !1,
                    Lo.dblclick(function(t) {
                        return 0 === t.button && (s ? di() : hi()),
                        !0
                    }),
                    Lo.bind(t.nc, e),
                    Lo.mouseout(function() {
                        return s || (Xr = null, Xo = null, gi()),
                        !0
                    }),
                    i = !1,
                    Ko.bind(t.fN,
                    function() {
                        return i ? void 0 : (o || Wn === Fr || r(), i = !0, setTimeout(function() {
                            return i = !1
                        },
                        100), to = !1, !0)
                    }),
                    Lo.contextmenu(function() {
                        return ! 1
                    }),
                    Lo.bind(t.iF,
                    function(t) {
                        return 2 === t.button && Wn !== Fr && (Je && (1 === Je[H].length && Ve.pop(), Je = null), Ve.pop(), ki()),
                        0 === t.button && (to = !0, o = !1),
                        n(t),
                        no = oo + ro,
                        !1
                    })
                } (),

                window.world_draw_main = ui = function() {
                    function r(n) {
                        return null == n && (n = oe),
                        g.y = g.y + g.h - n - 1,
                        N.push(g.y),
                        xn.strokeStyle = ir[t.km],
                        Gn(xn, g.y + .5, 0, Lr),
                        g.y -= n
                    }
                    var o, u, l, s, c, f, g, m, x, b, $, T, F, C, M, S, P, O, A, D, R, B, N, q, H, Z, U, K, L, W, z, G, X, Y, E, J, V, Q, un, an, ln, sn, cn, fn, hn, dn, pn, gn, vn, xn, yn, wn, bn, $n, Tn, Fn, Cn, Mn, Sn, In, Dn, Bn, Nn, Hn, Zn, Wn, Xn, Yn, jn, ne, ee, re, ie, ae, le, pe, me, ve, xe, we, _e, $e, Te, Fe, Ce, Se, Pe, Ie, Oe, Ae, De, Re, Be, Ne, qe, He, Ze, We, ze, Xe, Ye, je, Ee, Je, Ve, Qe, nr, rr, or, ar, sr, cr, fr, hr, dr, pr, kr, _r, Fr;
                    if (fe) {
                        for (l = fe[h], o = $settings.stick_style.value, xn = zr, Jr.width = Jr.width, P = mn(l, d).length - 1, P > Me && oo && Me === oo + qr - 1 && (oo += P - Me, Me = P), oo > P && (oo = P), 0 > oo && (oo = 0), eo = oo + qr - 1, eo > P && (eo = P), $settings.main_lines.value === t.my ? (Fn = fe[Or], ne = fe[Dr]) : $settings.main_lines.value === t.SH ? (Fn = fe[Ir], ne = fe[Dr]) : (Fn = [], ne = []), ne = [], $settings.indicator.value === t.AC ? (ln = fe[$r], cr = on(_n, l, oo, eo, ln), C = cr[0], F = cr[1], Q = cr[2], L = [C, F], D = ye([C, F, Q]), W = -D, K = 2 * D) : $settings.indicator.value === t.hM ? (In = fe[Ar], fr = on(_n, l, oo, eo, In), Mn = fr[0], Cn = fr[1], L = [Mn, Cn], W = 0, K = 100) : $settings.indicator.value === t.Ie && (G = fe[br], hr = on(_n, l, oo, eo, G), co = hr[0], $ = hr[1], z = hr[2], L = [co, $, z], fn = be([co, $, z, [100]]), pn = ke([co, $, z, [0]]), W = pn, K = fn - pn), He = on(_n, l, oo, eo, [_, w, d, v, y, p, k]), re = He[0], wn = He[1], f = He[2], B = He[3], J = He[4], T = He[5], Nn = He[6], jn = on(_n, l, oo, eo, ne), Tn = on(_n, l, oo, eo, Fn), ur = Nn, A = Math.floor((Lr - Br) / Zr), Z = B.slice(0, A), U = J.slice(0, A), o !== t.fI && o !== t.qj || $settings.line_style.value !== t.MCXr || (f = on(_n, l, oo, eo, fe[Tr])[0]), m = qr * Zr, jr = Lr - Br - Hr * Zr, g = {
                            x: jr,
                            y: Kr,
                            w: m,
                            h: Kr
                        },
                        M = {
                            x: 0,
                            y: 0,
                            w: qr,
                            h: 0
                        },
                        N = [], g.h = -16, u = Ge(g, M), r(0), g.y -= oe, g.h = -vo, $settings.indicator.value === t.xC ? an = null: (M.y = W, M.h = K, an = Ge(g, M), r()), jn.length ? (M.y = 0, M.h = be([jn, re])) : (M.y = 0, M.h = be([re])), ee = Ge(g, M), Pn = an, lr = ee, r(), Tn.length ? (q = [Tn, B], V = [Tn, J]) : (q = [B], V = [J]), fn = 1.01 * be(q), pn = .99 * ke(V); fn && fn < B[B.length - 1];) fn *= 1.01;
                        for (; pn && pn > J[J.length - 1];) pn *= .99;
                        if (g.h = -g.y + oe + 12, M.y = pn, M.h = fn - pn, cn = Ge(g, M, $settings.scale.value === t.Zt), On = cn, an) if (Wn = an, $settings.indicator.value === t.AC) for (Dn = Le(Wn, 0), $n = Q[0], S = le = 0, ve = Q.length; ve > le; S = ++le) O = Q[S],
                        O > 0 ? (xn.fillStyle = ir[t.jb], xn.strokeStyle = ir[t.Nt]) : (xn.fillStyle = ir[t.lT], xn.strokeStyle = ir[t.yM]),
                        fi(O, $n) && (xn.fillStyle = ir[t.fO]),
                        Qn(xn, Wn, Dn, S, O, Nr),
                        $n = O;
                        else if ((Ze = $settings.indicator.value) === t.hM || Ze === t.Ie) for (We = [20, 80], pe = 0, $e = We.length; $e > pe; pe++) oi = We[pe],
                        Dn = Le(Wn, oi),
                        Gn(xn, Dn + .5, 0, Lr);
                        for (Dn = Le(ee, 0), bn = f[0], S = me = 0, Te = f.length; Te > me; S = ++me) {
                            switch (O = f[S], o) {
                            case "candle_stick_hlc":
                                yn = null != (ze = f[S - 1]) ? ze: wn[S],
                                c = f[S];
                                break;
                            default:
                                yn = wn[S],
                                c = f[S]
                            }
                            if (E = J[S], R = B[S], c > yn ? (xn.fillStyle = ir[t.jb], xn.strokeStyle = ir[t.Nt]) : (xn.fillStyle = ir[t.lT], xn.strokeStyle = ir[t.yM]), fi(c, yn) && (xn.fillStyle = ir[t.fO]), An !== t.nW && Qn(xn, ee, Dn, S, re[S], Nr), o === t.hl || o === t.yF || o === t.Kpzq) switch (te(xn, cn, S, E, R, li), o) {
                            case "ohlc":
                                x = Ke(cn, S),
                                b = Le(cn, yn),
                                Gn(xn, b + .5, x, x + li),
                                b = Le(cn, c),
                                Gn(xn, b + .5, x + li, x + Nr);
                                break;
                            case "candle_stick":
                                Vn(xn, cn, S, yn, c, Nr);
                                break;
                            case "candle_stick_hlc":
                                Vn(xn, cn, S, yn, c, Nr)
                            }
                            bn = O
                        }
                        if (o === t.fI || o === t.qj) {
                            for (xn.beginPath(), xn.fillStyle = ir[t.zb], Xe = Ue(cn, 0, B[0]), x = Xe[0], b = Xe[1], xn.moveTo(x + li, b), S = Ae = 0, Fe = B.length; Fe > Ae; S = ++Ae) O = B[S],
                            Ye = Ue(cn, S, O),
                            x = Ye[0],
                            b = Ye[1],
                            xn.lineTo(x + li, b);
                            for (S = De = je = f.length - 1; 0 >= je ? 0 >= De: De >= 0; S = 0 >= je ? ++De: --De) O = f[S],
                            Ee = Ue(cn, S, O),
                            x = Ee[0],
                            b = Ee[1],
                            xn.lineTo(x + li, b);
                            for (xn.fill(), xn.beginPath(), xn.fillStyle = ir[t.na], Je = Ue(cn, 0, J[0]), x = Je[0], b = Je[1], xn.moveTo(x + li, b), S = Re = 0, Ce = J.length; Ce > Re; S = ++Re) O = J[S],
                            Ve = Ue(cn, S, O),
                            x = Ve[0],
                            b = Ve[1],
                            xn.lineTo(x + li, b);
                            for (S = Be = Qe = f.length - 1; 0 >= Qe ? 0 >= Be: Be >= 0; S = 0 >= Qe ? ++Be: --Be) O = f[S],
                            nr = Ue(cn, S, O),
                            x = nr[0],
                            b = nr[1],
                            xn.lineTo(x + li, b);
                            if (xn.fill(), xn.lineWidth = 2, xn.strokeStyle = ir[t.kK], Jn(xn, cn, f, li + .5), o === t.qj) for (xn.fillStyle = ir[t.fO], xn.strokeStyle = ir[t.kK], S = Ne = 0, Se = f.length; Se > Ne; S = ++Ne) O = f[S],
                            rr = Ue(cn, S, O),
                            x = rr[0],
                            b = rr[1],
                            xn.beginPath(),
                            xn.arc(x + li + .5, b, 2, 0, 2 * Math.PI, !0),
                            xn.closePath(),
                            xn.fill(),
                            xn.stroke();
                            xn.lineWidth = 1,
                            B = f,
                            J = f
                        }
                        for (xn.lineWidth = 1, s = [[cn, Tn, !0], [ee, jn, !0]], an && s.unshift([an, L, !0]), qe = 0, Pe = s.length; Pe > qe; qe++) if (or = s[qe], Wn = or[0], ae = or[1], Sn = or[2], Sn) for (H = dr = 0, Ie = ae.length; Ie > dr; H = ++dr) ie = ae[H],
                        xn.strokeStyle = ir[t.Tc][H],
                        Jn(xn, Wn, ie, li + .5);
                        for (xn.lineWidth = 1, hn = 0, dn = 0, H = pr = 0, Oe = Z.length; Oe > pr; H = ++pr) oi = Z[H],
                        oi > hn && (hn = oi, dn = H);
                        for (gn = 1 / 0, vn = 0, H = kr = 0, xe = U.length; xe > kr; H = ++kr) oi = U[H],
                        gn > oi && (gn = oi, vn = H);
                        for (bi(xn, cn, dn, hn, li), bi(xn, cn, vn, gn, li),
                        function() {
                            function n(t, n) {
                                var e;
                                return e = 60 * t.getTimezoneOffset(),
                                (t.getTime() / 1e3 - e) % n < er
                            }
                            var e, r, o, i, a, s, c, f, h, d, m, v, y, w, b, k, _;
                            if (Vo = er, o = null, i = null, e = null, r = null, f = {
                                60 : {
                                    cond: n,
                                    key_cond: function(t) {
                                        return 0 === t.getMinutes()
                                    },
                                    text: function(t) {
                                        return de(t)
                                    },
                                    key_text: function(t) {
                                        return ce(t)
                                    },
                                    over: function(t) {
                                        return ue(t)
                                    }
                                },
                                3600 : {
                                    cond: n,
                                    key_cond: function(t) {
                                        return 0 === t.getHours() && t.getDate() !== e
                                    },
                                    text: function(t) {
                                        return ce(t)
                                    },
                                    key_text: function(t) {
                                        return e = t.getDate(),
                                        ue(t)
                                    },
                                    over: function(t) {
                                        return ue(t)
                                    }
                                },
                                86400 : {
                                    cond: n,
                                    key_cond: function(t) {
                                        return ! 1
                                    },
                                    text: function(t) {
                                        return ue(t)
                                    },
                                    key_text: function(t) {
                                        return ue(t)
                                    },
                                    over: function(t) {
                                        return t.getFullYear()
                                    }
                                },
                                604800 : {
                                    cond: function(t) {
                                        return t.getDate() < 8 && t.getMonth() !== o
                                    },
                                    key_cond: function(t) {
                                        return 0 === t.getMonth() && t.getFullYear() !== i
                                    },
                                    text: function(t) {
                                        return o = t.getMonth(),
                                        he(t)
                                    },
                                    key_text: function(t) {
                                        return i = t.getFullYear(),
                                        o = t.getMonth(),
                                        t.getFullYear()
                                    },
                                    over: function(t) {
                                        return t.getFullYear()
                                    }
                                }
                            },
                            Vo >= 86400) c = 604800,
                            h = 604800;
                            else for (h = Vo * (80 / Zr), 1800 >= h ? (c = 60, v = [10, 30]) : 28800 >= h ? (c = 3600, v = [1, 2, 3, 6, 8]) : 1296e3 >= h ? (c = 86400, v = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]) : (c = 604800, v = 1), k = 0, w = v.length; w > k; k++) if (H = v[k], c * H > h) {
                                h = c * H;
                                break
                            }
                            if (g = u[nn], s = f[c]) {
                                for (xn.strokeStyle = ir[t.km], xn.textAlign = t.ak, xn.textBaseline = t.PH, T = mn(l, p), m = _ = b = oo - 1; eo >= b ? eo >= _: _ >= eo; m = eo >= b ? ++_: --_)(a = T[m]) && (H = m - oo, s.cond(a, h) && (s.key_cond(a) ? (xn.fillStyle = ir[t.OF], xn.font = t.qFXZ, y = s.key_text(a)) : (xn.fillStyle = ir[t.OF], xn.font = t.ek, y = s.text(a)), x = jr + H * Zr + li + .5, En(xn, x, g.y + g.h, g.y + g.h + 4), xn.fillText(y, x, g.y + g.h + 8.5)));
                                if (T[oo]) return d = s.over(T[oo]),
                                Mo.text(d)
                            }
                        } (), x = Lr - Br, xn.strokeStyle = ir[t.km], xn.textAlign = t.nF, xn.textBaseline = t.PH, xn.font = t.ek, xn.fillStyle = ir[t.SX], xn.fillRect(x, 0, x + Br, Kr), xn.fillStyle = ir[t.OF], Xn = e ? [an, cn, ee] : [an, cn], ar = function() {
                            var t, n, e;
                            for (n = [], e = 0, t = Xn.length; t > e; e++) Wn = Xn[e],
                            Wn ? (Wn = Ge(Wn[nn], Wn[en], Wn[rn]), Wn[nn].w = Br, Wn[nn].x = x, n.push(Wn)) : n.push(void 0);
                            return n
                        } (), un = ar[0], sn = ar[1], Yn = ar[2], _r = 0, we = N.length; we > _r; _r++) b = N[_r],
                        Gn(xn, b + .5, x, x + Br);
                        for (Un(xn, sn, t.mg), Hn = 0, Zn = 0, tr = kn && 3600 > er && Rn && qn, tr && (oi = Ge(sn[nn], sn[en], sn[rn]), oi[nn].x += 8, oi[nn].w -= 8, oi[en].x = 0, oi[en].w = tn ? tn: Math.floor(Math.min(Rn, qn) / 5), Y = oi[en].w, zn(xn, sn,
                        function() {
                            var e, r, o, u, l, s, c, f, h, d, p, m, v, y, w, k, _, $, T, F, C, M, S, P, O, A, D, R, B, N, q, Z, U;
                            for (xn.save(), xn.lineWidth = 2, n = {},
                            Vo = Y / oi[nn].w, v = Br, A = [[i, 0, 500, ir[t.nd], vr], [a, -1, -500, ir[t.sk], yr]], N = 0, O = A.length; O > N; N++) {
                                for (D = A[N], S = D[0], $ = D[1], f = D[2], l = D[3], h = D[4], w = n[S] = [], n[h] = [], H = q = 0; Br >= 0 ? Br >= q: q >= Br; H = Br >= 0 ? ++q: --q) w[H] = 0;
                                for (s = [], F = 0, m = 0, xn.beginPath(), xn.fillStyle = l, xn.strokeStyle = l, p = oi[nn].x, T = 0, _ = 0, k = 0, c = !1, H = Z = $; (f >= $ ? f >= Z: Z >= f) && (o = I[S].at(H)); H = f >= $ ? ++Z: --Z) {
                                    if (P = o[1], y = o[0], F += P, R = Ue(oi, F, y), x = R[0], b = R[1], H === $ && xn.moveTo(oi[nn].x, b), xn.fillRect(p, b - 1, x - p + 1, 2), p = x, F > Y && (P = Y - (F - P), c = !0), Zn += P, Hn += y * P, Vo > _ + P) w[T] += y * P,
                                    n[h][T] = y,
                                    _ += P;
                                    else {
                                        for (w[T] += y * (Vo - _), n[h][T] = y, T++, _ = P + _ - Vo; _ > Vo;) _ -= Vo,
                                        w[T] += y * Vo,
                                        n[h][T] = y,
                                        T++;
                                        w[T] += y * _,
                                        n[h][T] = y
                                    }
                                    if (c) break
                                }
                                v = Math.min(v, T)
                            }
                            for (C = 0, M = 0, xn.beginPath(), xn.lineWidth = 1.5, xn.strokeStyle = ir[t.uR], n[xr] = [], n[wr] = [], n[gr] = [], n[mr] = [], e = 0, r = 0, g = oi[nn], d = U = 0; (v >= 0 ? v > U: U > v) && (C += n[i][d] + n[a][d], e += n[i][d], r += n[a][d], !isNaN(C)); d = v >= 0 ? ++U: --U) M += Vo,
                            u = C / M / 2,
                            n[xr][d] = u,
                            n[wr][d] = M,
                            n[gr][d] = e,
                            n[mr][d] = r,
                            B = Ue(oi, M, u),
                            x = B[0],
                            b = B[1],
                            xn.lineTo(x, b);
                            return xn.stroke(),
                            xn.restore()
                        })), an && ($settings.indicator.value === t.AC ? Kn(xn, un) : Ln(xn, un, [0, 20, 50, 80, 100])), Un(xn, sn, t.Lb), e && Un(xn, Yn), tr && (g = sn[nn],
                        function() {
                            var n, e;
                            n = kn[j],
                            e = n,
                            b = Le(cn, n),
                            x = g.x,
                            xn.strokeStyle = ir[t.Vy],
                            xn.fillStyle = ir[t.Vy],
                            _i(xn, x, b),
                            xn.fillStyle = ir[t.uR],
                            b = Le(cn, Hn / Zn)
                        } (), e && zn(xn, Yn,
                        function() {
                            var n, e;
                            return xn.font = t.ek,
                            n = ge(mn(l, _)),
                            e = Ue(ee, eo - oo + 1, n),
                            x = e[0],
                            b = e[1],
                            mo = xn.measureText(n.toFixed(5)),
                            xn.fillStyle = ir[t.gq],
                            xn.fillRect(g.x + 12, b - 6, mo.width, 12),
                            xn.fillStyle = ir[t.Ro],
                            xn.fillText(t.XK, g.x, b),
                            xn.fillText(n.toFixed(5), g.x + 12, b)
                        })), e || (g = ee[nn], xn.textAlign = t.ak, xn.fillText(t.bt, Lr / 2, g.y + g.h / 2)), g = u[nn], X = eo - oo, ie = [[X, T[eo]]], xn.font = t.Ce, Fr = 0, _e = ie.length; _e > Fr; Fr++) sr = ie[Fr],
                        H = sr[0],
                        $ = sr[1],
                        $ && (0 === H && 120 / Zr > X || (x = g.x + g.w, b = g.y + g.h + 8.5, xn.strokeStyle = ir[t.km], xn.fillStyle = ir[t.km], xn.strokeStyle = ir[t.OF], xn.fillStyle = ir[t.OF], xn.beginPath(), xn.arc(x, b, 2, 0, 2 * Math.PI, !0), xn.closePath(), xn.fillStyle = ir[t.OF], Bn = oo + H === P ? t.TnKt: se(parseInt((ge(T) - $) / 1e3)), xn.textAlign = t.nF, mo = xn.measureText(Bn), xn.fillText(Bn, x + (Br - mo.width) / 2, b)));
                        return ki(),
                        null
                    }
                },
                ai = Cn(150,
                function() {
                    return Se(pi)
                }),
                Do = $(t.et),
                Fn = 1,
                ar = {},
                $(t.FJ + window.$symbol).addClass(t.XI),
                function() {
                    var n;
                    return n = 0,
                    function() {
                        function e() {
                            /*ie(t.IQ + $host + t.MC + $sid,//ticker
                            function() {
                                if (r = arguments[0], a = arguments[1], null != a) {
                                    u = a.now,
                                    n = Date.now();
                                    for (i in a) Xe.call(a, i) && (o = a[i], Ii(i, o), u - o.date > 60 ? $(t.FJ + i).addClass(t.pnqk) : $(t.FJ + i).removeClass(t.pnqk))
                                }
                                Re(2e4,
                                function(t) {
                                    e(t)
                                })
                            })*/
                        }
                        var r, o, i, u, a;
                        e()
                    } (),
                    function() {
                        var e;
                        Re(3e3,
                        function() {
                            function r() {
                                e = Date.now() - n,
                                e > 3e4 ? $(t.cY).attr(t.dT, t.aORv) : e > 15e3 ? $(t.cY).attr(t.dT, t.qdhh) : $(t.cY).attr(t.dT, t.ZtQW),
                                Re(1e3,
                                function(t) {
                                    r(t)
                                })
                            }
                            r()
                        })
                    } (),
                    null
                } (),
                Ko.resize(function() {
                    return s && di(),
                    ai()
                }),
                $o.hover(function() {
                    return $o.height(320)
                },
                function() {
                    return $o.height(32)
                }),
                Lo.mousewheel(function(n, e) {
                    return e > 0 ? Nr += 2 : Nr -= 2,
                    3 > Nr && (Nr = 3),
                    Nr > 27 && (Nr = 27),
                    uo = Math.round(.2 * Nr),
                    3 > uo && (uo = 3),
                    3 === Nr && (uo = 2),
                    Zr = Nr + uo,
                    li = (Nr - 1) / 2,
                    ci(t.gO, Nr),
                    ci(t.ml, uo),
                    pi(),
                    !1
                }),
                $(t.ZF).click(function() {
                    var n;
                    return n = $(this).text(),
                    $.cookie(t.KB, n, {
                        expires: 365,
                        path: "/"
                    }),
                    window.location.reload(),
                    !0
                }),
                $(t.OJ).click(function() {
                    return Ao.hide(),
                    fo = 0,
                    pi(),
                    !0
                }),
                $(t.jD).click(function() {
                    var n;
                    return n = $(t.zv),
                    n.is(t.bzZP) ? ($(this).text(t.Gv), n.hide()) : ($(this).text(t.IN), n.show()),
                    !0
                }),
                $(t.qk).click(function() {
                    return $(t.jD).text(t.Gv),
                    $(t.zv).hide(),
                    !0
                }),
                ne = $(t.ug),
                $(t.zyHh).click(function() {
                    return ne.is(t.bzZP) ? ne.hide() : ne.show(),
                    !0
                }),
                $(t.qMvr).click(function() {
                    return ne.is(t.bzZP) ? ne.hide() : ne.show(),
                    !0
                }),
                ji = function(n, e) {
                    function r() {
                        var t, e, r, o, u, a;
                        for (r = xn[n].params, a = [], t = o = 0, u = i.length; u > o; t = ++o) e = i[t],
                        a.push($(e).val(r[t]));
                        return a
                    }
                    var o, i, u, a;
                    if (e.default_params = e.params, o = e.cookie, i = $(t.uj + n + t.qF), i.change(function() {
                        var e, r, u, a;
                        for (r = [], u = 0, a = i.length; a > u; u++) {
                            if (e = i[u], oi = $(e).val(), !oi.match(/^\d+$/)) {
                                if (n === t.WV && oi === t.vx) continue;
                                return alert(oi + t.Kx),
                                void 0
                            }
                            r.push(parseInt(oi))
                        }
                        return $.cookie(o, JSON.stringify(r), {
                            expires: 3650,
                            path: "/"
                        }),
                        xn[n].params = r,
                        me = {},
                        me[_e] = xe,
                        Bi()
                    }), $(t.uN + n + t.pC).click(function() {
                        return xn[n].params = xn[n].default_params,
                        r(),
                        $(i[0]).change()
                    }), a = $.cookie(o)) try {
                        u = JSON.parse(a),
                        xn[n].params = u
                    } catch(l) {}
                    return r()
                };
                for (yo in xn) Xe.call(xn, yo) && (lo = xn[yo], ji(yo, lo));
                pn = !0,
                b = {
                    USD: t.JN,
                    EUR: t.KH,
                    GBP: t.ndlS,
                    CNY: t.ZkFf,
                    JPY: t.ZkFf,
                    AUD: t.SZ,
                    CAD: t.Kw,
                    BTC: t.KA,
                    LTC: "Ł"
                },
                nr = {},
                $e = {},
                Q = {},
                Zn = null,
                Te = {},
                re = {},
                function() {
                    function t() {
                        ko && (wi(), ui(), ko = !1),
                        Re(80,
                        function(n) {
                            t(n)
                        })
                    }
                    t()
                } (),
                function() {
                    function t() {
                        bo && (Zi(), bo = !1),
                        wo && (Ui(), wo = !1),
                        Re(120,
                        function(n) {
                            t(n)
                        })
                    }
                    t()
                } (),
                function() {
                    return $(t.CiJy).show(),
                    $(t.nM).show()
                } (),
                pi(),
                function() {
                    function n(n) {
                        return n >= 0 ? t.jH + n.toFixed(2) + t.Lcwk: n.toFixed(2) + t.Lcwk
                    }
                    function e(t, n) {
                        return n = n.toString(),
                        t.text() !== n ? t.text(n) : void 0
                    }
                    function o() {
                        var r, o, l, c, h, p, g, m, v, x, y, w, b, k, _, T, F, M, S, P, O, A;
                        for (l = [[t.kKjb, i], [t.xH, a]], F = 0, S = l.length; S > F; F++) {
                            for (O = l[F], T = O[0], o = O[1], x = I[o].flatten(), o === a && x.reverse(), b = parseFloat(s.val()), w = b, _ = 0, k = 0, m = $(t.Sf + T + t.uQ, u), c = $(t.Sf + T + t.zZ, u), v = $(t.Sf + T + t.NQ, u), h = $(t.Sf + T + t.nw, u), p = $(t.Sf + T + t.qM, u), g = $(t.Sf + T + t.sl, u), g.html(f), M = 0, P = x.length; P > M; M++) if (A = x[M], y = A[0], r = A[1], d === C) {
                                if (! (w > r)) {
                                    _ += y * w,
                                    k += w;
                                    break
                                }
                                _ += y * r,
                                k += r,
                                w -= r
                            } else {
                                if (! (w > y * r)) {
                                    _ += w,
                                    k += w / y;
                                    break
                                }
                                _ += y * r,
                                k += r,
                                w -= y * r
                            }
                            kn && y && !isNaN(b) && (d === C && Math.abs(k - b) < 1e-6 || Math.abs(_ - b) < 1e-6) ? (e(m, y), e(v, n(100 * (y / kn[j]) - 100)), e(c, parseFloat((_ / k).toPrecision(6))), e(h, n(100 * (_ / k / kn[j]) - 100)), d === C ? e(p, parseFloat(_.toPrecision(6))) : e(p, parseFloat(k.toPrecision(6)))) : (m.text(t.sI), c.text(t.sI), p.text(t.vx), g.text(t.vx), v.text(t.vx), h.text(t.vx))
                        }
                        return ! 0
                    }
                    var u, l, s, c, f, h, d, p;
                    return u = $(t.Ts),
                    s = $(t.aesP, u),
                    s.keyup(o),
                    -1 !== r.indexOf(t.fl) ? s.val(10) : s.val(100),
                    d = C,
                    f = m,
                    p = $(t.za, u),
                    h = p[0],
                    l = p[1],
                    $(h).text(C),
                    $(l).text(m),
                    $(t.za, u).click(function() {
                        var n;
                        if (!$(this).hasClass(t.EO)) return $(t.za, u).removeClass(t.EO),
                        $(this).addClass(t.EO),
                        d = $(this).text(),
                        n = $(t.FQ, u).text(),
                        n !== t.vx && $(t.aesP).val(parseFloat(parseFloat(n).toPrecision(5))),
                        d === C ? (f = m, $(t.Vn, u).text(t.RD), $(t.sS, u).text(t.mP), $(t.rU, u).text(t.xf), $(t.lP, u).text(t.xf), $(t.hI, u).text(t.YA)) : (f = C, $(t.Vn, u).text(t.mP), $(t.sS, u).text(t.YA), $(t.rU, u).text(t.YA), $(t.lP, u).text(t.Kt), $(t.hI, u).text(t.nN)),
                        o()
                    }),
                    (c = function() {
                        return o(),
                        setTimeout(c, 1e3)
                    })(),
                    0
                } (),
                $(t.rU).click(function() {
                    return Gi($(this).attr(t.OH))
                }),
                $(t.LB).click(function() {}),
                Mn = window.localStorage,
                (null != Mn ? Mn.mode: void 0) ? Gi(Mn.mode) : Gi(t.zI),
                $(document).on(t.Dh,
                function() {
                    return ! 0
                }),
                Xi()
            })
        } (),
        function() {
            return $(t.rT).hover(function() {
                var n, e, r;
                return e = $(this),
                r = e.offset(),
                n = $(t.vE),
                n.css({
                    left: r.left - (n.width() - e.width()) / 2,
                    top: r.top - n.outerHeight()
                }),
                n.show()
            },
            function() {
                var n;
                return n = $(t.vE),
                n.hide()
            })
        } ()
    }.call(this)
}.call(this);