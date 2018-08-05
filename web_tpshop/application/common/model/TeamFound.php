<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */
namespace app\common\model;

use think\Model;
use think\Db;

class TeamFound extends Model
{
    public function initialize()
    {
        $team_found_num = Db::name('team_found')->where('found_end_time', '<', time())->where('status', 1)->count();
        if ($team_found_num > 0) {
            Db::name('team_found')->where('found_end_time', '<', time())->where('status', 1)->update(['status' => 3]);
        }
    }

    public function teamActivity()
    {
        return $this->hasOne('TeamActivity', 'team_id', 'team_id')->bind('time_limit');
    }

    public function teamFollow()
    {
        return $this->hasMany('TeamFollow', 'found_id', 'found_id');
    }

    public function order()
    {
        return $this->hasOne('Order', 'order_id', 'order_id')->bind('address_region');
    }

    public function orderGoods()
    {
        return $this->hasOne('OrderGoods', 'order_id', 'order_id');
    }
    //拼单节省多少钱
    public function getCutPriceAttr($value, $data)
    {
        return $data['goods_price'] - $data['price'];
    }

    //剩余多少名额
    public function getSurplusAttr($value, $data)
    {
        return $data['need'] - $data['join'];
    }

    //状态描述
    public function getStatusDescAttr($value, $data)
    {
        $status = config('TEAM_FOUND_STATUS');
        return $status[$data['status']];
    }
}
