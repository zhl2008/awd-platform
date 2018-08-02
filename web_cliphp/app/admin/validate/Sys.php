<?php
namespace app\admin\validate;

use think\Validate;

class Sys extends Validate
{
	protected $rule = [
		['sys_name', 'require', '站点名称不能为空！'],
		['sys_url', 'require', '站点网址不能为空！']
	];
}