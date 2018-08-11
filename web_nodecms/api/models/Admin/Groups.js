/**
 * Admin/groups.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/#!documentation/models
 */

module.exports = {
	tableName: 'usergroup',
	autoCreatedAt: false,
	autoUpdatedAt: false,
	attributes: {
		"id": {
			type: 'integer',
			unique: true,
			primaryKey: true,
			columnName: 'id'
		},
		"varname": {
			type: 'string',
			columnName: 'varname'
		},
		"listorder": {
			type: 'integer',
			columnName: 'listorder'
		},
		"purview": {
			type: 'string',
			columnName: 'purview'
		},
		"isupdate": {
			type: 'integer',
			columnName: 'isupdate'
		},
		"status": {
			type: 'integer',
			columnName: 'status'
		}
	}
};