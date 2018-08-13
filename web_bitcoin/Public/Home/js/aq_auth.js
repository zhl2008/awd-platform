(function(b,g){
	var f=function(){
		var d="http:"===document.location.protocol?"http://":"https://";
		this.authTypeMap={realname:"实名验证",personal:"个人验证",business:"行业验证",official:"官网验证",enterprise:"企业验证"};
		this.authStarMap={personal:0,realname:1,enterprise:1,business:2,official:4};
		this._AQ_outer=d+"outer.anquan.org";
		this._AQ_domain=d+"www.anquan.org";
		this._AQ_static=d+"static.anquan.org";
		this._AQ_certificate_url="http://www.anquan.org/authenticate/cert/";
		this._AQ_profile_url="http://www.anquan.org/s/";
		this._AQ_credit_url="http://v.anquan.org"
	};
	var a=b,e=g;
	f.prototype={
		constructor:f,
		getById:function(d){
			return e.getElementById(d)
		},
		filter:function(i){
			var d=/[<>&"'\x00]/g;
			var h={"<":"&lt;",">":"&gt;","&":"&amp;",'"':"&quot;","'":"&#39;"};
			i=i||"";
			return i.replace(d,function(j){
				return h[j]||""
			})
		},
		transtyle:function(n){
			var m=Array.isArray||function(i){
				return Object.prototype.toString.call(i)==="[object Array]"
			};
			var s="prop:style;";
			var q="selector{rule}";
			var p=function(i){
				if(i.selector){
					return q.replace("selector",i.selector).replace("rule",i.rule)
				}
				if(i.prop){
					return s.replace("prop",i.prop).replace("style",i.style)
				}
			};
			var l="";
			for( var jinn){
				var o="";
				var r=n[j];
				for( var hinr){
					var d=r[h];
					if(m(d)){
						for(var k=0;k<d.length;k++){
							o+=p({prop:h,style:d[k]})
						}
					}else{
						o+=p({prop:h,style:d})
					}
				}
				l+=p({selector:j,rule:o})
			}
			return l
		},
		listen_to:function(i,h,d){
			if(i.addEventListener){
				i.addEventListener(h,d,false)
			}else{
				if(i.attachEvent){
					i.attachEvent("on"+h,function(j){
						j||(j=a.event);
						if(!j.target){
							j.target=j.srcElement
						}
						d(j)
					},false)
				}
			}
		},
		ready:function(d){
			var j=false;
			var k=[];
			var l;
			ready=function(m){
				if(j){
					m.call(document)
				}else{
					k.push(function(){
						return m.call(this)
					})
				}
				return this
			};
			var h=function(){
				for(var m=0;m<k.length;m++){
					k[m].apply(document)
				}
				k=null
			};
			var i=function(m){
				if(j){
					return
				}
				j=true;
				h.call(window);
				if(document.removeEventListener){
					document.removeEventListener("DOMContentLoaded",i,false)
				}else{
					if(document.attachEvent){
						document.detachEvent("onreadystatechange",i);
						if(window==window.top){
							clearInterval(l);
							l=null
						}
					}
				}
			};
			if(document.addEventListener){
				document.addEventListener("DOMContentLoaded",i,false)
			}else{
				if(document.attachEvent){
					document.attachEvent("onreadystatechange",function(){
						if((/loaded|complete/).test(document.readyState)){
							i()
						}
					});
					if(window==window.top){
						l=setInterval(function(){
							try{
								j||document.documentElement.doScroll("left")
							}catch(m){
								return
							}
							i()
						},5)
					}
				}
			}
			ready(d)
		},
		getElementsByClassName:function(m,k,l){
			var h=m.getElementsByTagName(k);
			var d=[];
			for(var j=0;j<h.length;j++){
				if(h[j].className==l){
					d[d.length]=h[j]
				}
			}
			return d
		},
		script_onload:function(d,i,j){
			var h=e.createElement("script");
			if(h.readyState){
				h.onreadystatechange=function(){
					if(h.readyState=="loaded"||h.readyState=="complete"){
						h.onreadystatechange=null;
						j()
					}
				}
			}else{
				h.onload=function(){
					j()
				}
			}
			h.src=i;
			h.type="text/javascript";
			h.setAttribute("async","true");
			d.appendChild(h)
		},
		getElByAttr:function(h,p){
			var m=[],k=e.getElementsByTagName(p||"*");
			for(var n=0,o=k.length;n<o;n++){
				var q=k[n],d=true;
				for(var l=0;l<h.length;l++){
					if(!q.getAttribute(h[l])){
						d=false;
						break
					}
				}
				if(d){
					m.push(q)
				}
			}
			return m
		},
		getRealWarpNode:function(k,h){
			var d,h=h||0;
			var i=k.parentNode;
			var j=function(l){
				return (l.getAttribute("logo_type")&&l.getAttribute("logo_size"))||(l.getAttribute("logo_style")==="fixed")
			};
			if(!!j(i)){
				d=i
			}else{
				d=this.getElByAttr(["logo_size","logo_type"],"a")[h]||this.getElByAttr(["logo_style","href"],"a")[0]
			}
			return d
		},
		insertStyle:function(h){
			h=this.transtyle(h);
			var d=document.head||document.getElementsByTagName("head")[0];
			var i=document.createElement("style");
			i.type="text/css";
			if(i.styleSheet){
				i.styleSheet.cssText=h
			}else{
				i.appendChild(document.createTextNode(h))
			}
			d.appendChild(i)
		},
		fixedSymbol:function(k,t){
			var o=this;
			o.insertStyle({".AQ__auth-fixed":{position:"fixed",_position:"absolute",right:"0",top:"40%","line-height":"1.5","font-size":"12px","z-index":"2147483646"},".AQ__auth-wrap":{position:"relative"},".AQ__auth-icon":{background:"url("+o._AQ_static+"/static/outer/image/fixed-bg.png) -36px 0 no-repeat",height:"176px",width:"35px",position:"absolute",top:"0",right:"-6px","z-index":"2"},".AQ__auth-icon.active":{"background-position":"0 0",right:"0"},".AQ__auth-info":{position:"absolute",padding:"3px 0",height:"153px",_width:"230px","min-width":"230px",background:"#fff",top:"6px",right:"23px",display:"none",border:"1px solid #ddd"},".AQ__auth-info-hd":{padding:"0px 10px 2px","border-bottom":"1px solid #ddd","font-size":"14px","line-height":"30px",overflow:"hidden"},
				".AQ__auth-info-icon":{"float":"left",background:"url("+o._AQ_static+"/static/outer/image/fixed-bg.png) -70px 2px no-repeat",height:"30px",width:"30px"},".AQ__auth-info-title":{"font-size":"14px",color:"#b48b33","margin-right":"3px","float":"left"},".AQ__auth-info-star":{"float":"left","margin-top":"7px",background:"url("+o._AQ_static+"/static/outer/image/fixed-bg.png) -77px -30px no-repeat",height:"16px",width:"12px"},".AQ__auth-info-bd":{padding:"12px 10px 2px",background:"#f9f9f9","border-bottom":"1px solid #ddd","font-size":"12px"},".AQ__auth-info-bd p":{margin:"0 0 8px 0","white-space":"nowrap",_overflow:"hidden"},".AQ__auth-info-ft":{padding:"5px 10px"},".AQ__auth-info-ft a":{color:"#b48b33","font-size":"12px","margin-right":"14px","text-decoration":"underline"},
				".AQ__auth-info-ft a:hover":{color:"#CF9F39"}});
			var r=['<div class="AQ__auth-wrap">','<a class="AQ__auth-icon AQ__js-auth-icon" href="javascript:;"></a>','<div class="AQ__auth-info">','<div class="AQ__auth-info-hd">','<i class="AQ__auth-info-icon"></i><span class="AQ__auth-info-title">{{auth_type}}</span>{{star}}',"</div>",'<div class="AQ__auth-info-bd">','<p title="{{name}}">{{name}}</p>','<p style="color: #737373;">单位类型：{{type}}</p>','<p style="color: #737373;">信用累计：<span style="color: #b48b33">{{year}}</span></p>',"</div>",'<div class="AQ__auth-info-ft">','<a href="{{certificate_url}}" target="_blank">诚信档案</a>','<a href="{{profile_url}}" target="_blank">用户评论</a><a href="{{credit_url}}" target="_blank">防伪查询</a>',"</div>","</div>","</div>"];
			var p=e.createElement("div");
			p.className="AQ__auth-fixed";
			p.id="AQ__js-auth-fixed";
			o.listen_to(p,"click",function(v){
				var i=v.target;
				var d=i.className;
				if(/AQ__js-auth-icon/.test(d)){
					if(/active/.test(d)){
						i.className=d.replace("active","");
						i.nextSibling.style.display="none"
					}else{
						i.className=d+" active";
						i.nextSibling.style.display="block"
					}
				}
			});
			var l="",n=o.authStarMap[t]||0;
			for(var m=0;m<n;m++){
				l+='<i class="AQ__auth-info-star"></i>'
			}
			var j=t==="realname"?"id":t;
			var s={auth_type:o.authTypeMap[t],star:l,name:k.org_name,type:k.site_type,year:"第"+k[j+"_verify_year"]+"年",profile_url:o._AQ_profile_url+k.domain+"?tab=comment",credit_url:o._AQ_credit_url+"?domain="+k.domain,certificate_url:o._AQ_certificate_url+"?site="+k.domain+"&at="+t};
			var u=r.join("");
			for( var qins){
				var h=new RegExp("\\{\\{"+q+"\\}\\}","g");
				u=u.replace(h,s[q])
			}
			p.innerHTML=u;
			e.getElementsByTagName("body")[0].appendChild(p)
		},isMatchedAuth:function(i,h){
			var d=false;
			if(i.is_match){
				if(h){
					return h
				}
				switch(true){
				case i.personal_auth&&i.type==="personal":
					d="personal";
					break;
				case i.realname_auth&&i.type==="realname":
					d="realname";
					break;
				case i.business_auth&&i.type==="business":
					d="business";
					break;
				case i.official_auth&&i.type==="official":
					d="official";
					break;
				case i.enterprise_auth&&i.type==="enterprise":
					d="enterprise";
					break
				}
			}
			return d
		},init:function(){
			var i=this;
			var h="AQ_fn_aq_auth_callback";
			a.LOGO__aq_num__=a.LOGO__aq_num__||1;
			var d="AQ_logo_span_init_"+a.LOGO__aq_num__;
			a[h]=function(n,s,o){
				try{
					if(!(ninstanceofObject)){
						return false
					}
				}catch(r){
				}
				var t=i.getRealWarpNode(i.getById("AQ_logo_span_init_1"));
				s&&(t=i.getRealWarpNode(s,o));
				a.LOGO__aq_callback_data__=n;
				var l=i.filter(t.getAttribute("logo_style"));
				var j={is_match:/true/.test(n.is_match.toLowerCase()),personal_auth:/successful/.test(n.personal_status.toLowerCase()),realname_auth:/successful/.test(n.realname_status.toLowerCase()),official_auth:/successful/.test(n.official_status.toLowerCase()),business_auth:/successful/.test(n.business_status.toLowerCase()),enterprise_auth:/successful/.test(n.enterprise_status.toLowerCase()),identify_data:n.identify_data};
				if(l==="fixed"){
					if(j.official_auth){
						j.type="official"
					}else{
						if(j.business_auth){
							j.type="business"
						}else{
							if(j.realname_auth){
								j.type="realname"
							}else{
								if(j.enterprise_auth){
									j.type="enterprise"
								}else{
									if(j.personal_auth){
										j.type="personal"
									}else{
										j.type=false
									}
								}
							}
						}
					}
					var u=i.isMatchedAuth(j,j.type);
					if(i.getById("AQ__js-auth-fixed")||!u){
						return
					}
					i.fixedSymbol(j.identify_data,u)
				}else{
					j.size=i.filter(t.getAttribute("logo_size").toLowerCase());
					j.type=i.filter(t.getAttribute("logo_type"));
					var m=e.createElement("img"),p=j.size.toLowerCase(),q,k;
					switch(j.type){
					case "personal":
						k="gr_";
						break;
					case "realname":
						k="sm_";
						break;
					case "business":
						k="hy_";
						break;
					case "official":
						k="gw_";
						break;
					case "enterprise":
						k="qy_";
						break;
					default:
						k=void 0
					}
					if((j.size!="124x47"&&j.size!="83x30")||k===void 0){
						return false
					}
					q=i.isMatchedAuth(j)?".png":"_gray.png";
					m.src=i._AQ_static+"/static/outer/image/"+k+p+q;
					m.style.border="none";
					m.setAttribute("alt","安全联盟认证");
					m.width=parseInt(j.size.split(/x/)[0]);
					m.height=parseInt(j.size.split(/x/)[1]);
					t.appendChild(m)
				}
			};
			e.write("<span style='display:none;' class='LOGO_aq_jsonp_wrap_' id='"+d+"'></span>");
			a.LOGO__aq_num__++;
			i.ready(function(){
				if(a.LOGO__aq_callback_flag__){
					return false
				}
				var k=i.getElementsByClassName(document,"span","LOGO_aq_jsonp_wrap_");
				var s="";
				for(var n=0;n<k.length;n++){
					var p=k[n];
					var r=i.getRealWarpNode(p);
					var j=r.getAttribute("logo_type");
					var l=r.getAttribute("logo_style");
					if("fixed"===l){
						for(typeini.authTypeMap){
							if(-1!==s.indexOf(type)){
								continue
							}
							s+="&logo_type="+type
						}
					}else{
						if(-1!==s.indexOf(j)){
							continue
						}
						s+="&logo_type="+j
					}
				}
				var m=k[0],r=i.getRealWarpNode(m),q=top.location.href.split("#")[0].split("?")[0],q=q.replace(/(https?:\/\/)([^\.]+\.[^\.\/]+\/)/,"$1www.$2/$3"),o=i._AQ_outer+"/query_auth_status/?callback="+h+"&url="+q+s;
				i.script_onload(m,o,function(){
					for(var x=0;x<k.length;x++){
						var v=i.getRealWarpNode(k[x]);
						var w=i.filter(v.getAttribute("logo_type"));
						v.href=i._AQ_domain.replace("https://","http://")+"/authenticate/cert/?site="+e.domain+"&at="+w;
						v.target="_blank";
						if(x<1){
							continue
						}
						var u=a[h],t=a.LOGO__aq_callback_data__;
						u(t,k[x],x)
					}
					a.LOGO__aq_callback_flag__=null;
					a.LOGO__aq_callback_data__=null;
					a.LOGO__aq_num__=null
				});
				a.LOGO__aq_callback_flag__=!!1
			})
		}};
	var c=new f();
	c.init()
})(window,document);
