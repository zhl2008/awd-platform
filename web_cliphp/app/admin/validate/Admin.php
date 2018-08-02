<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        ['username', 'require|min:5', '用户名不能为空|用户名不能短于5个字符'],
    ];
}