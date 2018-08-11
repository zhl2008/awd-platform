/**
 * Admin/htaccessController
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
            'title': 'htaccess设置',
            'description': "配置你的站点",
            'parent_purview': "seo",
            'purview': "htaccess"
        };
        res.locals.htaccess = {content:""};
        var file = sails.config.paths['public'] + path.sep+".htaccess";


        if(req.method == "POST"){
            fs.writeFile(file,req.body.content,function(err,data){
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
                res.locals.htaccess.content = data;
                res.view();
            });
        }
    }
};