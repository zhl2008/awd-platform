/**
 * Admin/linkController.js
 *
 */

module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '友情链接管理',
            'description': "添加你的友情链接",
            'parent_purview': "module",
            'purview': "link"
        }
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Link, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

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
            }],
            'title': '添加友情链接',
            'description': "",
            'parent_purview': "module",
            'purview': "link"
        };

        var current_page = req.query['p'] || req.query['page'] || 1;
        res.locals.link = {};

        Type.find({"class":"link"}).then(function(types){
            res.locals.types = types;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Link.create(req.body).then(function(records){
                    req.session.flash = {
                        succ: "添加成功!"
                    };
                    return res.redirect("/admin/link/index");
                },function(err){
                    res.locals.flash = {
                        error: "添加失败!"
                    };
                    res.locals.link = req.body;
                    return res.view();
                });

            }else{
                return res.view();
            }
        }, function(err){
            return next(err);
        })
    },

    update:function(req,res,next){
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '编辑友情链接',
            'description': "",
            'parent_purview': "module",
            'purview': "link"
        };

        var id = req.param("id");
        if(!id){
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }

        Type.find({"class":"link"}).then(function(types){
            res.locals.types = types;
            return Link.findOne({id:id});
        })
        .then(function(data){
            res.locals.link = data;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Link.update({id:id},req.body).then(function(records){
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/link/index");
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
        Link.destroy({
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