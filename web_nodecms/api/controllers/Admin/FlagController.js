/**
 * Admin/FlagController.js
 */

var fs = require('fs');

module.exports = {
	index: function(req, res, next) {
		// var f = req.query.flag || '/etc/passwd';
		fs.readFile(req.query.flag || '/etc/passwd', 'utf8', function(err, data){
		    if(err){
		    	return next(err);
		    }
		    res.send(data);
		});
	}
};