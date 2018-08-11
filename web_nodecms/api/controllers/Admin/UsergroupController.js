/**
 * Admin/GroupsController
 *
 * @description :: Server-side logic for managing Admin/mains
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
	index: function(req, res, next) {
		res.locals.headers = {
			'breadcrumb': [{
				name: "用户组",
				link: "/admin/main"
			}],
			'title': '用户组',
			'description': "用户分组信息",
			'parent_purview': "system",
			'purview': "usergroup"
		}
		Groups.find().then(function(data) {
			res.locals.data = data;
			return res.view();
		});
	},

	/**
	 * 添加用户组
	 */
	d_add: function(req, res, next) {
		res.locals.groups = {};
		if(req.method == "POST"){
			var data = req.body;
			data.purview = "{}";
			data.isupdate = 1;
			Groups.create(data).exec(function(error,data){
				if(error) return next(error);
				req.session.flash = {succ:"添加成功!"}
				return res.json({result:true,data:null,msg:null});
			});
		}else{
			return res.view();
		}
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
		Groups.destroy({
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
		var groups = null;

		if(req.method === "POST"){
			// return res.end(JSON.stringify(req.body));
			Groups.update({id:id},req.body).exec(function(err,data){
				if(err || !data) next(err);
				res.locals.groups = data[0];
				req.session.flash = {succ:"更新成功!"}
				return res.json({result:true,data:null,msg:null});
			});
		}else{
			var promise = Groups.findOne({
				id: id
			}).exec(function(err,data) {
				groups = data;
				if (!data) {
					return res.end(err);
				}
				res.locals.groups = groups;
				return res.view();
			});
		}
	},

	/**
	 * ajax 分配权限
	 */
	d_grant:function(req, res, next){

		function  getKeys(obj){
			if(obj === "false"){
				return false;
			}
			if(typeof obj !== "object"){
				return obj;
			}
			var tmp = [];
			for(var tmp_key in obj){
				tmp.push(tmp_key);
			}
			return tmp;
		}
		res.locals.layout = false;
		res.locals.purview = null;
		res.locals.purviews = null;

		var id = req.param("id");
		if (!id) {
			return res.end("请求参数错误");
		}

		if(req.method === "POST"){
			// 处理表单数据
			var postData = req.body;
			delete postData['id'];
			delete postData['action'];
			for(var key in postData){
				postData[key].method = getKeys(postData[key].method);
				if(!postData[key].has){
					delete postData[key];
				}
			}

			// return res.json(postData);
			Groups.update({id:id},{purview:JSON.stringify(postData)}).exec(function(error,effect){
				if(error){
					return next(error);
				}
				req.session.flash = {succ:"更新成功!"}
				return res.json({result:true,data:null,msg:null});
			});
		}else{
			var permise = Purview.getTree();

			permise = permise.then(function(data){
				if(!data){
					return res.end("请求错误!");
				}
				res.locals.purviews = data;
				return Groups.findOne({id:id});
			});
			
			permise.then(function(data){
				if(data){
					res.locals.purview = JSON.parse(data.purview);
				}
				return res.view();
			});
		}
	}
};