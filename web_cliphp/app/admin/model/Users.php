<?php
namespace app\admin\model;

use think\Model;

class Users extends Model
{
	protected $name = 'users';
    protected $type       = [
        // 设置addtime为时间戳类型（整型）
        'reg_time' => 'timestamp:Y-m-d H:i:s',
    ];
	// birthday修改器
	protected function setpwdAttr($value){
			return md5($value);
	}

}