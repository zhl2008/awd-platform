/**
 * 分页模块
 * @type {Object}
 */
var util = require("util");

module.exports = function(model, page_info, _find_info) {

    return new Promise(function(resolve, reject) {
        var paging = util._extend({
            current_page: 1, // 当前页
            count: 0, // 总页数
            limit: 10, // 每页数量
            skip:0
        }, page_info);

        var find_info = util._extend({
            where: {},
        }, _find_info);

        model.count(find_info.where).then(function(count) {
            paging.count = Math.ceil(count/paging.limit);
            
            find_info.limit = paging.limit;
            find_info.skip = paging.limit*(paging.current_page - 1);
            return model.find(find_info);
        })
        .then(function(records) {
            resolve({data:records, paging:paging});
        }, function(err) {
            reject(err);
        });
    });
};