/**
 * Admin/Config.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/#!documentation/models
 */
module.exports = {
	tableName: 'config',
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
		"title": {
			type: 'string',
			columnName: 'title'
		},
		"category": {
			type: 'string',
			columnName: 'category'
		},
		"value": {
			type: 'string',
			columnName: 'value'
		},
		"issystem": {
			type: 'integer',
			columnName: 'issystem'
		},
		"lang": {
			type: 'string',
			columnName: 'lang'
		}
	}
};