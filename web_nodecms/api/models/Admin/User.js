/**
 * Admin/login.js
 */
module.exports = {
	tableName: 'user',
	autoCreatedAt: false,
	autoUpdatedAt: false,
	attributes: {
		id: {
			type: 'integer',
			unique: true,
			primaryKey: true,
			columnName: 'id'
		},
		usergroup: {
			type: 'integer',
			columnName: 'usergroup',
            model: 'Groups'
		},
		username: {
			unique: true,
			type: 'string',
			columnName: 'username'
		},
		password: {
			type: 'string',
			columnName: 'password'
		},
		email: {
			type: 'email',
			columnName: 'email'
		},
		realname: {
			type: 'string',
			columnName: 'realname'
		},
		sex: {
			type: 'integer',
			columnName: 'sex'
		},
		tel: {
			type: 'string',
			columnName: 'tel'
		},
		mobile: {
			type: 'string',
			columnName: 'mobile'
		},
		fax: {
			type: 'string',
			columnName: 'fax'
		},
		address: {
			type: 'string',
			columnName: 'address'
		},
		createtime: {
			type: 'integer',
			columnName: 'createtime'
		},
		updatetime: {
			type: 'integer',
			columnName: 'updatetime'
		},
		lasttime: {
			type: 'integer',
			columnName: 'lasttime'
		},
		regip: {
			type: 'string',
			columnName: 'regip'
		},
		lastip: {
			type: 'string',
			columnName: 'lastip'
		},
		logincount: {
			type: 'integer',
			columnName: 'logincount'
		},
		status: {
			type: 'integer',
			columnName: 'status'
		}
	},

	/**
	 * 密码修改验证
	 * @return {[type]} [description]
	 */
	pwdValidate: function(inputs) {
		var validationErrors = {};
		if (!inputs.password) {
			validationErrors.password = "不能为空!";
		}
		if (inputs.password.length > 20) {
			validationErrors.password = "长度不能超过20!";
		}

		if (!inputs.newpassword) {
			validationErrors.newpassword = "不能为空!";
		}
		if (inputs.newpassword.length > 20) {
			validationErrors.newpassword = "长度不能超过20!";
		}

		if (!inputs.repeat_newpassword) {
			validationErrors.repeat_newpassword = "不能为空!";
		}
		if (inputs.repeat_newpassword.length > 20) {
			validationErrors.repeat_newpassword = "长度不能超过20!";
		}
		if (inputs.repeat_newpassword !== inputs.newpassword) {
			validationErrors.repeat_newpassword = "两次输入的新密码不一致!";
		}
		return validationErrors;
	}
};