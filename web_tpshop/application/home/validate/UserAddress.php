<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用TP5助手函数可实现单字母函数M D U等,也可db::name方式,可双向兼容
 * ============================================================================
 * Author: dyr
 * Date: 2016-08-23
 */

namespace app\home\validate;

use think\Validate;

/**
 * 用户地址验证器
 * Class UserAddress
 * @package app\home\validate
 */
class UserAddress extends Validate
{
    protected $rule = [
        'user_id'               =>  'require|number',
        'consignee'             =>  'require|max:25',
        'email'                 =>  'email',
        'province'              =>  'require|number',
        'city'                  =>  'require|number',
        'district'              =>  'require|number',
        'address'               =>  'require|max:100',
        'mobile'                =>  ['regex'=>'/^1[3|4|5|8][0-9]\d{4,8}$/'],
    ];

    protected $msg = [
        'user_id.require'       =>  '用户id必须',
        'user_id.number'        =>  '用户id必须为数字',
        'consignee.require'     =>  '收货人必须填写',
        'consignee.max'         =>  '收货人名称最多不能超过25个字符',
        'email'                 =>  'email格式错误',
        'province.require'      =>  '省份必须选择',
        'province.number'       =>  '省份iD必须为数字',
        'city.require'          =>  '市必须选择',
        'city.number'           =>  '市iD必须为数字',
        'district.require'      =>  '镇区必须选择',
        'district.number'       =>  '镇区iD必须为数字',
        'address.require'       =>  '地址必须填写',
        'address.max'           =>  '地址民称最多不能超过100个字符',
        'mobile.regex'          =>  '手机号码格式错误'
    ];

}