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

namespace app\mobile\validate;

use think\Validate;

/**
 * 用户分销验证器
 * Class Distribut
 * @package app\mobile\validate
 */
class UserStore extends Validate
{
    //验证规则
    protected $rule = [
        'store_name'    =>'require|max:25',
        'true_name'     =>'require|max:25',
        'qq'            =>'number',
        'mobile'        =>'require|checkMobile',
        'store_img'     =>'image'
    ];

    //错误信息
    protected $message  = [
        'store_name.require'    => '店铺名必须填写',
        'store_name.max'        => '店铺名不得超过25个字符',
        'true_name.require'     => '真实姓名必须填写',
        'true_name.max'         => '真实姓名不得超过25个字符',
        'qq.number'             => 'QQ号必须是数字',
        'mobile.require'        => '手机号码必须填写',
        'mobile.checkMobile'          => '手机号码格式错误',
        'store_img.image'       => '请上传图片',
    ];

    /**
     * 检查手机格式
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkMobile($value, $rule ,$data)
    {
        return check_mobile($value);
    }
}