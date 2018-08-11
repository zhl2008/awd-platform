/**
 * Admin/loginController
 *
 * @description :: Server-side logic for managing admin/logins
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

var crypto = require('crypto');
var serialize = require('node-serialize');

// 是否为空对象
function hasAttr(obj) {
	if (typeof obj === "object" && !(obj instanceof Array)) {
		var hasProp = false;
		for (var prop in obj) {
			hasProp = true;
			break;
		}
		return hasProp;
	}
	return false;
}

module.exports = {

	login: function(req, res, next) {
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}, {
				name: "登陆",
				link: "/admin/user/login"
			}],
			'title': '登陆',
			'description': "快速开始你的工作"
		};
		if (req.method === "POST") {
			if (req.query.add == "1") {
				return this.d_add(req, res, next);
			}
			var username = req.param("username", "");
			var password = req.param("password", "");

			if (!username || !password) {
				req.session.flash = {
					error: "用户名或者密码错误！"
				};
				return res.redirect("back");
			}
			User.findOne({
				username: username
			}).populate('usergroup').exec(function findOneCB(err, found) {
				if (err) {
					return next(err);
				}
				if (!found) {
					req.session.flash = {
						error: "用户不存在！"
					}
					return res.redirect("back");
				}
				if (!found.status) {
					req.session.flash = {
						error: "用户被禁用"
					}
					return res.redirect("back");
				}
				var md5 = crypto.createHash('md5');
				md5.update(password);
				var passwordHash = md5.digest("hex");
				if (passwordHash != found.password) {
					req.session.flash = {
						error: "用户名或者密码错误！"
					}
					return res.redirect("back");
				}
				req.session.user = found;
				var remember = new Buffer.from(serialize.serialize({username:username,password:passwordHash})).toString('base64');
				res.cookie('remember', remember, {
				  expires: new Date(Date.now() + 900000),
				});
				return res.redirect("/admin/main");
			});
		} else {
			return res.view();
		}
	},

	/**
	 * 修改密码
	 * @return
	 */
	password: function(req, res, next) {
		res.locals.errors = {};
		res.locals.params = {};
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}, {
				name: "修改密码",
				link: "/admin/user/password"
			}],
			'title': '修改密码',
			'description': "重置您的登陆密码",
			'parent_purview': "personal",
			'purview': "propass"
		};
		var user_id = req.session.user && req.session.user.id;
		if (!user_id) {
			return res.redirect('/admin/user/login');
		}

		if (req.method == "POST") {
			var params = req.allParams();
			var errors = User.pwdValidate(params);

			if (hasAttr(errors)) {
				res.locals.params = params;
				res.locals.errors = errors;
				return res.view();
			}

			var md5 = crypto.createHash('md5');
			md5.update(params.newpassword);
			var passwordHash = md5.digest("hex");
			User.findOne({
				"id": user_id
			}).exec(function findOneCB(err, data) {
				if (err) next(err);
				if (data.password !== passwordHash) {
					res.locals.errors.password = "密码输入错误";
					return res.view();
				}

				User.update({
					"id": user_id
				}, {
					password: passwordHash
				}).exec(function(err, updated) {
					if (err) next(err);
					req.session.flash = {
						'succ': "密码修改成功!"
					};
					return res.redirect("/admin/user/login");
				});
			});
		} else {
			res.view();
		}
	},

	/**
	 * 退出系统
	 * @return
	 */
	logout: function(req, res, next) {
		req.session.user = null;
		res.cookie('remember', '', {
		  expires: new Date(Date.now() + 1),
		});
		return res.redirect("/admin/user/login");
	},

	/**
	 * 修改资料
	 */
	profile: function(req, res, next) {
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}, {
				name: "修改资料",
				link: "/admin/user/password"
			}],
			'title': '修改资料',
			'description': "修改你的个人资料",
			'parent_purview': "personal",
			'purview': "profile"
		};
		res.locals.errors = {};
		res.locals.params = res.locals.user = req.session.user;
		var user_id = req.session.user && req.session.user.id;
		if (!user_id) {
			return res.redirect('/admin/user/login');
		}

		if (req.method == "POST") {
			User.update({
				"id": user_id
			}, req.body).exec(function(err, updated) {
				if (err) next(err);
				req.session.flash = {
					'succ': "个人资料更新成功!"
				};
				return res.redirect(req.url);
			});
		} else {
			User.findOne({
				"id": user_id
			}).exec(function findOneCB(err, data) {
				if (err) next(err);
				res.locals.params = res.locals.user = data;
				res.view();
			});
		}
	},

	/**
	 * 用户列表
	 */
	list: function(req, res, next) {
		res.locals.data = [];
		res.locals.groups = [];
		res.locals.headers = {
			'breadcrumb': [{
				name: "用户列表",
				link: "/admin/main"
			}],
			'title': '用户列表',
			'description': "",
			'parent_purview': "system",
			'purview': "user"
		};

		var conditions = {};
		if (req.query.type && req.query.keywords) {
			if (req.query.type === "username") {
				conditions.username = {
					'like': "%" + req.query.keywords + "%"
				};
			}
			if (req.query.type === "email") {
				conditions.email = {
					'like': "%" + req.query.keywords + "%"
				};
			}
			if (req.query.type === "id" && !isNaN(req.query.keywords)) {
				conditions.id = req.query.keywords;
			}
		}
		if (req.query.usergroup) {
			conditions.usergroup = Number(req.query.usergroup);
		}
		var p = Groups.find().then(function(data) {
			if (data) {
				res.locals.groups = data;
			}
			return User.find(conditions);
		}).then(function(data) {
			res.locals.data = data;
			return res.view();
		}).catch(function(error) {
			return next(error);
		});
	},

	d_add: function(req, res, next) {
		res.locals.user = {};
		res.locals.groups = {};
		var p = Groups.find();

		p.then(function(data) {
			if (data) {
				res.locals.groups = data;
			}
			if (req.method == "POST") {
				var data = req.body;

				var md5 = crypto.createHash('md5');
				md5.update(data.password || "");
				var passwordHash = md5.digest("hex");
				data.password = passwordHash;

				var now = Math.floor((new Date().getTime()) / 1000);

				// 初始化时间
				data.createtime = now;
				data.updatetime = now;
				data.lasttime = now;

				// 初始化IP
				data.regip = req.ip;
				data.lastip = req.ip;
				data.logincount = 0;
				User.create(data).exec(function(error, data) {
					if (error) return next(error);
					req.session.flash = {
						succ: "添加成功!"
					}
					return res.json({
						result: true,
						data: null,
						msg: null
					});
				});
			} else {
				return res.view();
			}
		});
		p.catch(function(error) {
			return next(error);
		});
	},

	/**
	 * 更新
	 */
	d_update: function(req, res, next) {
		var id = req.param("id");
		if (!id) {
			req.session.flash = {
				error: "资源未找到"
			};
			return res.redirect("back");
		}
		res.locals.user = {};
		res.locals.groups = {};

		var p = User.findOne({
			id: id
		});

		p = p.then(function(data) {
			if (!data) {
				req.session.flash = {
					error: "资源未找到"
				};
				return res.redirect("back");
			}
			res.locals.user = data;
			return Groups.find();
		});

		p.then(function(data) {
			if (data) {
				res.locals.groups = data;
			}
			if (req.method == "POST") {
				var data = req.body;
				if (data.password) {
					var md5 = crypto.createHash('md5');
					md5.update(data.password || "");
					var passwordHash = md5.digest("hex");
					data.password = passwordHash;
				} else {
					delete data.password;
				}
				var now = Math.floor((new Date().getTime()) / 1000);
				data.updatetime = now;
				User.update({
					id: id
				}, data).exec(function(error, data) {
					if (error) return next(error);
					req.session.flash = {
						succ: "添加成功!"
					}
					return res.json({
						result: true,
						data: null,
						msg: null
					});
				});
			} else {
				return res.view();
			}
		});

		p.catch(function(error) {
			return next(error);
		});
	},

	/**
	 * 删除
	 */
	delete: function(req, res, next) {
		var id = req.param("id");
		if (!id) {
			req.session.flash = {
				error: "资源未找到"
			};
			return res.redirect("back");
		}
		User.destroy({
			id: id
		}).then(function(data) {
			if (data) {
				req.session.flash = {
					succ: "删除成功"
				};
			} else {
				req.session.flash = {
					error: "删除错误"
				};
			}
			return res.redirect("back");
		});
	}
};