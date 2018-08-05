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

namespace app\common\logic;

use think\model;

/**
 * Class UserAddressModel
 * @package Home\Model
 */
class UserAddressLogic extends model
{
    protected $tableName = 'user_address';

    /**
     * 获取用户自提点
     * @time 2016/08/23
     * @author
     * @param $user_id
     * @return mixed
     */
    public function getUserPickup($user_id)
    {
        $user_pickup_where = array(
            'ua.user_id' => $user_id,
            'ua.is_pickup' => 1
        );
        $user_pickup_list = M('user_address')
            ->alias('ua')
            ->field('ua.*,r1.name AS province_name,r2.name AS city_name,r3.name AS district_name')
            ->join('__REGION__ r1','r1.id = ua.province','LEFT')
            ->join('__REGION__ r2','r2.id = ua.city','LEFT')
            ->join('__REGION__ r3', 'r3.id = ua.district','LEFT')
            ->where($user_pickup_where)
            ->find();
        return $user_pickup_list;
    }

}