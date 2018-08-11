/**
 * 工具模块
 * @type {Object}
 */
var util = require("util");
var moment = require("moment");

module.exports = {
    unix: function(str) {
        return moment(str).unix();
    },
    format: function(time) {
        return moment.unix(time).format("YYYY MM DD hh:mm:ss");
    },
    firstUper:function(str) {
        str = str.toLowerCase();
        return str.replace(/\b(\w)|\s(\w)/g, function(m) {
            return m.toUpperCase();
        });
    }
};