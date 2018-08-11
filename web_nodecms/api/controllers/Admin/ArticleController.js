/**
 * Admin/ArticleController
 *
 */

module.exports = {
    index: function(req, res, next) {
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': '文章列表',
            'description': "发布的文章信息",
            'parent_purview': "content",
            'purview': "article"
        };
        var current_page = req.query['p'] || req.query['page'] || 1;
        Pagination(Article, {current_page: current_page},{sort:"id DESC"}).then(function(rs) {

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
            'title': '添加文章',
            'description': "",
            'parent_purview': "content",
            'purview': "article"
        };
        res.locals.article = {};
        Category.getTree({
            model: "article",
            lang: "zh_cn"
        }).then(function(data) {
            res.locals.categorys = data;

            if (req.method == "POST") {
                req.body.lang = "zh_cn";
                req.body.puttime = Util.unix(req.body.puttime);
                
                Article.create(req.body).then(function(records) {
                    req.session.flash = {
                        succ: "添加成功!"
                    };
                    return res.redirect("/admin/article/index");
                }, function(err) {
                    res.locals.flash = {
                        error: "添加失败!"
                    };
                    res.locals.article = req.body;
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
            'title': '编辑文章',
            'description': "",
            'parent_purview': "content",
            'purview': "article"
        };
        res.locals.article = {};
        Category.getTree({
            model: "article",
            lang: "zh_cn"
        })
        .then(function(data){
            res.locals.categorys = data;

            return Article.findOne({id:id});
        })
        .then(function(article) {
            res.locals.article = article;

            if (req.method == "POST") {
                req.body.lang = "zh_cn";
                req.body.puttime = Util.unix(req.body.puttime);

                Article.update({id:id},req.body).then(function(records) {
                    req.session.flash = {
                        succ: "更新成功!"
                    };
                    return res.redirect("/admin/article/index");
                }, function(err) {
                    res.locals.flash = {
                        error: "更新失败!"
                    };
                    res.locals.article = req.body;
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
        Article.destroy({
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