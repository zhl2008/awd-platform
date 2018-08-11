/**
 * 根据用户设置的模板分别渲染
 * @param  {[type]} data    [description]
 * @param  {[type]} options [description]
 * @return {[type]}         [description]
 */

var path = require("path");

module.exports = function templet() {
	
	// Get access to `req`, `res`, & `sails`
	var req = this.req;
	var res = this.res;
	var sails = req._sails;
	var themePrifx = ".."+path.sep+"assets" + path.sep + "templates";
	var relPathToView = "";

	if (!res.locals.theme) {
		res.locals.theme = "default";
	}
	if(!res.locals.static_dir){
		res.locals.static_dir = "/templates/"+res.locals.theme;
	}

	themePrifx = themePrifx +  path.sep + res.locals.theme;

	if (!res.locals.view) {
		res.locals.view = (req.options.controller || req.options.model) + '/' + (req.options.action || 'index');
	}

	if (res.locals.view.indexOf(".") == -1) {
		var extName = sails.config.views.engine.ext;
		res.locals.view += ("." + extName);
	}
	
	var view = themePrifx+ path.sep + res.locals.view;
    return res.view(view,{});
};