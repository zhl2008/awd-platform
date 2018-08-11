/**
 * Admin/tagsController.js
 *
 */
module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '聚合标签管理',
            'description': "添加你的聚合标签",
            'parent_purview': "seo",
            'purview': "tags"
        };
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Tags, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

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
            'title': '添加聚合标签',
            'description': "",
            'parent_purview': "seo",
            'purview': "tags"
        };

        var current_page = req.query['p'] || req.query['page'] || 1;
        res.locals.tags = {};

        if(req.method == "POST"){
            req.body.lang = "zh_cn";
            Tags.create(req.body).then(function(records){
                req.session.flash = {
                    succ: "添加成功!"
                };
                return res.redirect("/admin/tags/index");
            },function(err){
                res.locals.flash = {
                    error: "添加失败!"
                };
                res.locals.tags = req.body;
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
            }],
            'title': '编辑聚合标签',
            'description': "",
            'parent_purview': "seo",
            'purview': "tags"
        };

        var id = req.param("id");
        if(!id){
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }
        
        Tags.findOne({id:id}).then(function(data){
            res.locals.tags = data;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Tags.update({id:id},req.body).then(function(records){
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/tags/index");
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
        Tags.destroy({
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