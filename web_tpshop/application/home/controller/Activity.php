<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用TP5助手函数可实现单字母函数M D U等,也可db::name方式,可双向兼容
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 */
namespace app\home\controller;

use app\common\logic\GoodsActivityLogic;
use app\common\logic\ActivityLogic;
use app\common\logic\GoodsLogic;
use app\common\model\FlashSale;
use app\common\model\GroupBuy;
use think\AjaxPage;
use think\Controller;
use think\Page;
use think\Db;

class Activity extends Base
{
    /**
     * 团购活动列表
     */
    public function group_list()
    {
        $GroupBuy = new GroupBuy();
        $where = array(
            'gb.start_time'        =>array('elt',time()),
            'gb.end_time'          =>array('egt',time()),
            'gb.is_end'            =>0,
            'g.is_on_sale'         =>1
        );
        $count = $GroupBuy->alias('gb')->join('__GOODS__ g', 'g.goods_id = gb.goods_id')->alias('gb')->where($where)->count('gb.goods_id');// 查询满足要求的总记录数
        $Page = new Page($count, 20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $list = $GroupBuy
            ->alias('gb')
            ->with(['goods','specGoodsPrice'])
            ->join('__GOODS__ g', 'g.goods_id = gb.goods_id')
            ->where($where)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 预售列表页
     */
    public function pre_sell_list()
    {
        $goodsActivityLogic = new GoodsActivityLogic();
        $pre_sell_list = Db::name('goods_activity')->where(array('act_type' => 1, 'is_finished' => 0))->select();
        foreach ($pre_sell_list as $key => $val) {
            $pre_sell_list[$key] = array_merge($pre_sell_list[$key], unserialize($pre_sell_list[$key]['ext_info']));
            $pre_sell_list[$key]['act_status'] = $goodsActivityLogic->getPreStatusAttr($pre_sell_list[$key]);
            $pre_count_info = $goodsActivityLogic->getPreCountInfo($pre_sell_list[$key]['act_id'], $pre_sell_list[$key]['goods_id']);
            $pre_sell_list[$key] = array_merge($pre_sell_list[$key], $pre_count_info);
            $pre_sell_list[$key]['price'] = $goodsActivityLogic->getPrePrice($pre_sell_list[$key]['total_goods'], $pre_sell_list[$key]['price_ladder']);
        }
        $this->assign('pre_sell_list', $pre_sell_list);
        return $this->fetch();
    }

    /**
     *   预售详情页
     */
    public function pre_sell()
    {
        $id = I('id/d', 0);
        $pre_sell_info = M('goods_activity')->where(array('act_id' => $id, 'act_type' => 1))->find();
        if (empty($pre_sell_info)) {
            $this->error('对不起，该预售商品不存在或者已经下架了', U('Home/Activity/pre_sell_list'));
            exit();
        }
        $goods = M('goods')->where(array('goods_id' => $pre_sell_info['goods_id']))->find();
        if (empty($goods)) {
            $this->error('对不起，该预售商品不存在或者已经下架了', U('Home/Activity/pre_sell_list'));
            exit();
        }
        $pre_sell_info = array_merge($pre_sell_info, unserialize($pre_sell_info['ext_info']));
        $goodsActivityLogic = new GoodsActivityLogic();
        $pre_count_info = $goodsActivityLogic->getPreCountInfo($pre_sell_info['act_id'], $pre_sell_info['goods_id']);//预售商品的订购数量和订单数量
        $pre_sell_info['price'] = $goodsActivityLogic->getPrePrice($pre_count_info['total_goods'], $pre_sell_info['price_ladder']);//预售商品价格
        $pre_sell_info['amount'] = $goodsActivityLogic->getPreAmount($pre_count_info['total_goods'], $pre_sell_info['price_ladder']);//预售商品数额ing
        if ($goods['brand_id']) {
            $brand = M('brand')->where(array('id' => $goods['brand_id']))->find();
            $goods['brand_name'] = $brand['name'];
        }
        $goods_images_list = M('GoodsImages')->where(array('goods_id' => $goods['goods_id']))->select(); // 商品 图册
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where(array('goods_id' => $goods['goods_id']))->select(); // 查询商品属性表
        $goodsLogic = new GoodsLogic();
        $commentStatistics = $goodsLogic->commentStatistics($goods['goods_id']);// 获取某个商品的评论统计
        $this->assign('pre_count_info', $pre_count_info);//预售商品的订购数量和订单数量
        $this->assign('commentStatistics', $commentStatistics);//评论概览
        $this->assign('goods_attribute', $goods_attribute);//属性值
        $this->assign('goods_attr_list', $goods_attr_list);//属性列表
        $this->assign('goods_images_list', $goods_images_list);//商品缩略图
        $this->assign('pre_sell_info', $pre_sell_info);
        $this->assign('look_see',$goodsLogic->get_look_see($goods));//看了又看
        $this->assign('goods', $goods);
        return $this->fetch();
    }
    
    

    // 促销活动页面
    public function promoteList()
    {
        $goods_where['p.start_time']  = array('lt',time());
        $goods_where['p.end_time']  = array('gt',time());
        $goods_where['p.is_end']  = 0;
        $goods_where['g.prom_type']  = 3;
        $goods_where['g.is_on_sale']  = 1;
        $goodsList = Db::name('goods')
            ->field('g.*,p.end_time,s.item_id')
            ->alias('g')
            ->join('__PROM_GOODS__ p', 'g.prom_id = p.id')
            ->join('__SPEC_GOODS_PRICE__ s','g.prom_id = s.prom_id AND s.goods_id = g.goods_id','LEFT')
            ->group('g.goods_id')
            ->where($goods_where)
            ->cache(true,5)
            ->select();
        $brandList = M('brand')->cache(true)->getField("id,name,logo");
        $this->assign('brandList',$brandList);
        $this->assign('goodsList',$goodsList);
        return $this->fetch();
         
    }
    /**
     * 抢购活动列表
     */
    public function flash_sale_list()
    {
        $time_space = flash_sale_time_space();
        $this->assign('time_space', $time_space);
        return $this->fetch();
    }
    /**
     * 抢购活动列表ajax
     */
    public function ajax_flash_sale()
    {
        $p = I('p',1);
        $start_time = I('start_time');
        $end_time = I('end_time');
        $where = array(
            'fl.start_time'=>array('egt',$start_time),
            'fl.end_time'=>array('elt',$end_time),
            'g.is_on_sale'=>1
        );
        $FlashSale = new FlashSale();
        $flash_sale_goods = $FlashSale->alias('fl')->join('__GOODS__ g', 'g.goods_id = fl.goods_id')->with(['specGoodsPrice','goods'])
            ->field('*,100*(FORMAT(buy_num/goods_num,2)) as percent')
            ->where($where)
            ->page($p,10)
            ->select();
        $this->assign('flash_sale_goods',$flash_sale_goods);
        $this->assign('now',time());
        return $this->fetch();
    }

    public function coupon_list()
    {
        $atype = I('atype', 1);
        $user = session('user');
        $p = I('p', '');

        $activityLogic = new ActivityLogic();
        $result = $activityLogic->getCouponList($atype, $user['user_id'], $p);
        $this->assign('coupon_list', $result);
        if (request()->isAjax()) {
            return $this->fetch('ajax_coupon_list');
        }
        return $this->fetch();
    }

    /**
     * 领券
     */
    public function get_coupon()
    {
        $id = I('coupon_id/d');
        if (empty($id)){
            $this->error('参数错误');
        }
        $user = session('user');
        if ($user) {
            $activityLogic = new ActivityLogic();
            $result = $activityLogic->get_coupon($id, $user['user_id']);
        } else {
            $this->redirect(U('User/login'));
        }
        $this->assign('res',$result);
        return $this->fetch();
    }
}
