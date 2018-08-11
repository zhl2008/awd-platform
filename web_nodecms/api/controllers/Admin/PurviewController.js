/**
 * Admin/PurviewController
 * 权限控制器
 */
module.exports = {
	index: function(req, res, next) {
		res.locals.headers = {
			'breadcrumb': [{
				name: "系统管理",
				link: "#"
			}, {
				name: "权限菜单",
				link: "/admin/purview"
			}],
			'title': '权限菜单',
			'description': "权限列表展示及编辑",
			'parent_purview': "system",
			'purview': "purview"
		};
		res.locals.data = [];
		Purview.getTree().then(function(data) {
			res.locals.data = data;
			return res.view();
			// return res.end(JSON.stringify(data));
		});
	},

	/**
	 * 删除权限
	 */
	delete: function(req, res, next) {
		var id = req.param("id");
		if (!id) {
			req.session.flash = {
				error: "资源未找到"
			};
			return res.redirect("back");
		}
		Purview.destroy({
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
	},

	/**
	 * ajax 更新表单
	 */
	d_update: function(req, res, next) {
		res.locals.layout = false;
		var id = req.param("id");
		if (!id) {
			return res.end("请求参数错误");
		}
		var purview = null;

		if(req.method === "POST"){
			// return res.end(JSON.stringify(req.body));
			Purview.update({id:id},req.body).exec(function(err,data){
				if(err || !data) next(err);
				res.locals.purview = data[0];
				req.session.flash = {succ:"更新成功!"}
				return res.json({result:true,data:null,msg:null});
			});
		}else{
			var promise = Purview.findOne({
				id: id
			}).then(function(data) {
				purview = data;
				if (!data) {
					return res.end(err);
				}
				res.locals.purview = purview;
				return res.view();
			});
		}
	}
};