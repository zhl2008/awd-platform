/**
 * Admin/robotsController
 */

var fs = require("fs");
var path = require("path");

module.exports = {
    index: function(req, res, next) {
        res.locals.config = {};
        res.locals.headers = {
            'breadcrumb': [{
                name: "后台首页",
                link: "/admin/main"
            }],
            'title': 'robots设置',
            'description': "配置你的站点",
            'parent_purview': "seo",
            'purview': "robots"
        };
        res.locals.robots = {content:""};
        var file = sails.config.paths['public'] + path.sep+"robots.txt";


        if(req.method == "POST"){
            fs.writeFile(file,req.body.content,function(err,data){
                console.log(30,req.body.content);
                if(err){
                    return next(err);
                }
                req.session.flash = {
                    succ: "更新成功!"
                };
                res.redirect(req.url);
            });
        }else{
            fs.readFile(file,function(err,data){
                if(err){
                    return next(err);
                }
                res.locals.robots.content = data;
                res.view();
            });
        }
    }
};