/**
 * Admin/typeController.js
 *
 */

module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '模块分类',
            'description': "例如幻灯片等模块，系统可能存在多个，因此需要先创建分类",
            'parent_purview': "module",
            'purview': "type"
        }
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Type, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

            res.locals.data = rs.data;
            res.locals.paging = rs.paging;
            return res.view();
        }, function(err) {
            return next(err);
        });
    },

    add: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }, {
                name: "模块管理",
                link: "/admin/type"
            }],
            'title': '添加分类',
            'description': "",
            'parent_purview': "module",
            'purview': "type"
        };

        res.locals.type = {};
        if(req.method == "POST"){
            req.body.lang = "zh_cn";
            Type.create(req.body).then(function(records){
                req.session.flash = {
                    succ: "添加成功!"
                };
                return res.redirect("/admin/type/index");
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
    },

    update:function(req,res,next){
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }, {
                name: "模块管理",
                link: "/admin/type"
            }],
            'title': '添加分类',
            'description': "",
            'parent_purview': "module",
            'purview': "type"
        };

        var id = req.param("id");
        if(!id){
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }

        Type.findOne({id:id}).then(function(data){
            res.locals.type = data;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Type.update({id:id},req.body).then(function(records){
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/type/index");
                },function(err){
                    res.locals.flash = {
                        error: "更新失败!"
                    };
                    res.locals.category = req.body;
                    return res.view();
                });
            }else{
                return res.view();
            }
        }, function(err){
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