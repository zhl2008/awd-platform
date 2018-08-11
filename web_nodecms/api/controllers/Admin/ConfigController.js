/**
 * Admin/ConfigController.js
 */
module.exports = {
	index: function(req, res, next) {
		res.locals.config = {};
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}],
			'title': '系统设置',
			'description': "配置你的站点",
			'parent_purview': "system",
			'purview': "config"
		}

		Config.find({category:"base",lang:"zh_cn"}).then(function(data){
			if(data){
				var tmp = {};
				data.forEach(function(one,key){
					tmp[one.varname] = one;
				});
				res.locals.config = tmp;
			}
			if(req.method === "POST"){
				var post_data = req.body;
				var updates = [];
				var p = Promise.resolve();

				for(var key in post_data){
					updates.push(
						{contions:{varname:key,lang:"zh_cn"},values:{value:post_data[key]}
					});
				}
				for (var i = updates.length - 1; i >= 0; i--) {
					p = p.then(function(){
						var one = updates.pop();
						console.log(one);
						return Config.update(one.contions,one.values);
					});
				};
				p.then(function(effected){
					req.session.flash = {
						'succ': "保存成功!"
					};
					return res.redirect("back");
				});

				p.catch(function(error){
					return next(error);
				});
			}else{
				return res.view();
			}
		}).catch(function(error){
			return next(error);
		});
	},
	mail:function(req, res, next){
		res.locals.config = {};
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}],
			'title': '系统设置',
			'description': "配置你的站点",
			'parent_purview': "system",
			'purview': "config"
		}

		Config.find({category:"mail"}).then(function(data){
			if(data){
				var tmp = {};
				data.forEach(function(one,key){
					tmp[one.varname] = one;
				});
				res.locals.config = tmp;
			}
			return res.view();
		}).catch(function(error){
			return next(error);
		});
	},
	lang:function(req, res, next){
		res.locals.config = {};
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}],
			'title': '系统设置',
			'description': "配置你的站点",
			'parent_purview': "system",
			'purview': "config"
		}

		Config.find({category:"lang"}).then(function(data){
			if(data){
				var tmp = {};
				data.forEach(function(one,key){
					tmp[one.varname] = one;
				});
				res.locals.config = tmp;
			}
			return res.view();
		}).catch(function(error){
			return next(error);
		});
	},
	
	// 通用保存操作
	update:function(req, res, next){
		if(req.method === "POST"){
			var post_data = req.body;
			var updates = [];
			var p = Promise.resolve();

			for(var key in post_data){
				updates.push(
					{contions:{varname:key},values:{value:post_data[key]}
				});
			}
			for (var i = updates.length - 1; i >= 0; i--) {
				p = p.then(function(){
					var one = updates.pop();
					console.log(one);
					return Config.update(one.contions,one.values);
				});
			};
			p.then(function(effected){
				req.session.flash = {
					'succ': "保存成功!"
				};
				return res.redirect("back");
			});

			p.catch(function(error){
				return next(error);
			});
		}else{
			return res.view("404");
		}
	}
};