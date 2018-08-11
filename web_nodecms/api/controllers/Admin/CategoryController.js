/**
 * Admin/CategoryController
 */
module.exports = {
	index: function(req, res, next) {
		res.locals.config = {};
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}],
			'title': '栏目管理',
			'description': "目前暂时支持2级栏目",
			'parent_purview': "content",
			'purview': "category"
		};

		res.locals.data = [];
		Category.getTree({}).then(function(data) {
			res.locals.data = data;
			return res.view();
		});
	},

	add: function(req, res, next) {
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}, {
				name: "栏目管理",
				link: "/admin/category"
			}],
			'title': '添加栏目',
			'description': "",
			'parent_purview': "content",
			'purview': "category"
		};
		res.locals.category = {};
		// 获取模型列表
		Models
		.find({status: 1})
		.sort("listorder ASC")
		.then(function(data) {
			res.locals.models = data;
			return Category.getTree({});
		})
		.then(function(categorys) {
			res.locals.categorys = categorys;

			if(req.method == "POST"){

				req.body.lang = "zh_cn";
				Category.create(req.body).then(function(records){
					req.session.flash = {
						succ: "添加成功!"
					};
					return res.redirect("/admin/category/index");
				},function(err){
					res.locals.flash = {
						error: "添加失败!"
					};
					res.locals.category = req.body;
					return res.view();
				});
			}else{
				return res.view();
			}
		}, function(err) {
			return next(err);
		});
	},

	update:function(req,res,next){
		res.locals.headers = {
			'breadcrumb': [{
				name: "后台首页",
				link: "/admin/main"
			}, {
				name: "栏目管理",
				link: "/admin/category"
			}],
			'title': '编辑栏目',
			'description': "",
			'parent_purview': "content",
			'purview': "category"
		};

		var id = req.param("id");
		if(!id){
			req.session.flash = {
				error: "资源未找到"
			};
			return res.redirect("back");
		}




		Category.findOne({id:id}).then(function(category){
			res.locals.category = category;

			return Models.find({status: 1}).sort("listorder ASC");
		})
		.then(function(models){
			res.locals.models = models;

			return Category.getTree({id:{"!":id}});
		})
		.then(function(categorys){
			res.locals.categorys = categorys;
			if(req.method == "POST"){
				req.body.lang = "zh_cn";
				Category.update({id:id},req.body).then(function(records){
					req.session.flash = {
						succ: "修改成功!"
					};
					return res.redirect("/admin/category/index");
				},function(err){
					res.locals.flash = {
						error: "修改失败!"
					};
					res.locals.category = req.body;
					return res.view();
				});
			}else{
				return res.view();
			}
		},function(err){
			return next(err);
		});
	},
	
    delete: function(req, res, next) {
        var id = req.param("id");
        if (!id) {
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }
        Category.destroy({
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