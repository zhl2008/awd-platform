/**
 * view helper 助手
 */
module.exports = function(req, res, next) {

	/**
	 * 时间格式化
	 * @param  int unix unix 时间戳（秒）
	 */
	res.locals.dateFormat = function(unix) {
		var now = new Date(parseInt(unix) * 1000);
		return now.toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
	}

    res.locals.spaceX = function(x){
        var space = "";
        for(var i = 0;i < x; i++){
            space += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        }
        return space;
    }

	next();
};