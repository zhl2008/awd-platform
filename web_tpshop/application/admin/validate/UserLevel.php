<?php
namespace app\admin\validate;
use think\Validate;
class UserLevel extends Validate
{
    // 验证规则
    protected $rule = [
        ['level_name', 'require|unique:user_level'],
        ['amount','require|number|unique:user_level'],
        ['discount','require|number|unique:user_level'],
    ];
    //错误信息
    protected $message  = [
        'level_name.require'    => '名称必须',
        'level_name.unique'     => '已存在相同等级名称',
        'amount.require'        => '消费额度必须',
        'amount.number'         => '消费额度必须是数字',
        'amount.unique'         => '已存在相同消费额度',
        'discount.require'      => '折扣率必须',
        'discount.number'       => '折扣率必须为数字',
        'discount.unique'       => '已存在相同折扣率',
    ];
    //验证场景
    protected $scene = [
        'edit'  =>  [
            'level_name'    =>'require|unique:user_level,level_name^level_id',
            'amount'        =>'require|number|unique:user_level,amount^level_id',
            'discount'    =>'require|number|unique:user_level,discount^level_id',
        ],
    ];
}