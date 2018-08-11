/**
 * Admin/slideController.js
 *
 */

module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '幻灯管理',
            'description': "添加你的幻灯图片",
            'parent_purview': "module",
            'purview': "slide"
        }
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Slide, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

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
            'title': '添加幻灯',
            'description': "",
            'parent_purview': "module",
            'purview': "slide"
        };

        var current_page = req.query['p'] || req.query['page'] || 1;
        res.locals.slide = {};

        Type.find({"class":"slide"}).then(function(types){
            res.locals.types = types;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Slide.create(req.body).then(function(records){
                    req.session.flash = {
                        succ: "添加成功!"
                    };
                    return res.redirect("/admin/slide/index");
                },function(err){
                    res.locals.flash = {
                        error: "添加失败!"
                    };
                    res.locals.slide = req.body;
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
            'title': '编辑幻灯',
            'description': "",
            'parent_purview': "module",
            'purview': "slide"
        };

        var id = req.param("id");
        if(!id){
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }

        Type.find({"class":"slide"}).then(function(types){
            res.locals.types = types;
            return Slide.findOne({id:id});
        })
        .then(function(data){
            res.locals.slide = data;
            if(req.method == "POST"){
                req.body.lang = "zh_cn";
                Slide.update({id:id},req.body).then(function(records){
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/slide/index");
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
        Slide.destroy({
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