<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace app\common\logic;

use think\Model;

/**
 *活动抽象类
 * Class CatsLogic
 * @package common\Logic
 */
abstract class Prom extends Model
{
    abstract protected function getPromModel();//获取活动模型
    abstract protected function checkActivityIsAble();//活动是否正在进行
    abstract protected function checkActivityIsEnd();//检查活动是否结束
    abstract protected function getGoodsInfo();//获取商品详细
    abstract protected function IsAble();//活动是否已经失效
    abstract protected function getActivityGoodsInfo();//获取商品转换活动商品的数据
}