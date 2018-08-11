/**
 * Admin/login.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/#!documentation/models
 */

var util = require('util');


/**
 * 递归获取子树
 * @param  {int} parent_id 父ID
 * @param  {array} records   需要寻找的数组
 * @return {数组}           
 */
function getsubTree(parent_id, records) {
	var rs = [];
	records.forEach(function(one, key) {
		if (one.parent === parent_id) {
			rs.push(one);
			delete records[key];
		}
	});
	for (var i = rs.length - 1; i >= 0; i--) {
		rs[i].children = getsubTree(parent_id + 1, records);
	}
	return rs;
}

module.exports = {
	tableName: 'purview',
	autoCreatedAt: false,
	autoUpdatedAt: false,
	attributes: {
		"id": {
			type: 'integer',
			unique: true,
			primaryKey: true,
			columnName: 'id'
		},
		"parent": {
			type: 'integer',
			columnName: 'parent'
		},
		"class": {
			type: 'string',
			columnName: 'class'
		},
		"method": {
			type: 'string',
			columnName: 'method'
		},
		"listorder": {
			type: 'integer',
			columnName: 'listorder'
		},
		"status": {
			type: 'integer',
			columnName: 'status'
		}
	},

	/**
	 * 获取tree结构的数据
	 */
	getTree: function() {
		return this.find().then(function(data) {
			if (data && util.isArray(data)) {
				var rs = [];
				data.forEach(function(one, key) {
					if (one.parent === 0) {
						rs.push(one);
						delete data[key];
					}
				});
				for (var i = rs.length - 1; i >= 0; i--) {
					rs[i].children = getsubTree(rs[i].id, data);
				}
				return rs;
			}
		});
	}
};