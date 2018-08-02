<?php
namespace app\admin\validate;

use think\Validate;

class Member extends Validate
{
	protected $rule = [
		['group_id', 'require', '会员所属用户组必须选择'],
		['username', 'require', '用户名不能为空'],
		['pwd', 'require|length:6,25', '登录密码不能为空|登录密码位数不能少于6位或者大于15位'],
		['petname', 'require', '昵称不能为空'],
		['tel', 'checkName:tel|unique:member', '手机号码格式不正确|该手机已注册'],
		['email', 'email|unique:member', '邮箱格式不正确|该邮箱已注册'],
	];
	// 自定义验证规则
	protected function checkName($value,$rule,$data){
		if(is_mobile_phone($value)){
			return true;
		}else{
			return '手机号码格式不正确';
		}
	}
}