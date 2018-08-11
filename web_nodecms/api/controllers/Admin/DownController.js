/**
 * Admin/downController
 *
 */
module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '下载列表',
            'description': "发布的下载信息",
            'parent_purview': "content",
            'purview': "down"
        };
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Down, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

            res.locals.data = rs.data;
            res.locals.paging = rs.paging;
            // return res.json(rs.paging);

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
            'title': '添加下载',
            'description': "",
            'parent_purview': "content",
            'purview': "down"
        };
        res.locals.down = {};
        Category.getTree({
            model: "down",
            lang: "zh_cn"
        }).then(function(data) {
            res.locals.categorys = data;

            if (req.method == "POST") {
                req.body.lang = "zh_cn";
                req.body.puttime = Util.unix(req.body.puttime);


                Down.create(req.body).then(function(records) {
                    req.session.flash = {
                        succ: "添加成功!"
                    };
                    return res.redirect("/admin/down/index");
                }, function(err) {
                    res.locals.flash = {
                        error: "添加失败!"
                    };
                    res.locals.down = req.body;
                    return res.view();
                });
            } else {
                return res.view();
            }
        });
    },
    
    update: function(req, res, next) {
        var id = req.param("id");
        if (!id) {
            req.session.flash = {
                error: "资源未找到"
            };
            return res.redirect("back");
        }

        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '编辑下载',
            'description': "",
            'parent_purview': "content",
            'purview': "down"
        };
        res.locals.down = {};
        Category.getTree({
            model: "down",
            lang: "zh_cn"
        })
        .then(function(data){
            res.locals.categorys = data;

            return Down.findOne({id:id});
        })
        .then(function(down) {
            res.locals.down = down;

            if (req.method == "POST") {
                req.body.lang = "zh_cn";
                req.body.puttime = Util.unix(req.body.puttime);

                Down.update({id:id},req.body).then(function(records) {
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/down/index");
                }, function(err) {
                    res.locals.flash = {
                        error: "更新失败!"
                    };
                    res.locals.down = req.body;
                    return res.view();
                });
            } else {
                return res.view();
            }
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
        Down.destroy({
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
        },function(err){
            return next(err);
        });
    }
};