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
 * Author: 当燃
 * 专题管理
 * Date: 2016-03-09
 */

namespace app\admin\controller;

use app\admin\model\FlashSale;
use app\admin\model\Goods;
use app\admin\model\GoodsActivity;
use app\admin\model\GroupBuy;
use app\common\model\PromGoods;
use think\AjaxPage;
use think\Page;
use app\admin\logic\GoodsLogic;
use think\Loader;
use think\Db;

class Promotion extends Base
{

    public function index()
    {
        return $this->fetch();
    }

    /**
     * 商品活动列表
     */
    public function prom_goods_list()
    {
        $PromGoods = new PromGoods();
        $count = $PromGoods->where('')->count();
        $Page = new Page($count, 10);
        $prom_list = $PromGoods->where('')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page',$Page);
        $this->assign('prom_list', $prom_list);
        return $this->fetch();
    }

    public function prom_goods_info()
    {
        $level = M('user_level')->select();
        $this->assign('level', $level);
        $prom_id = I('id');
        $info['start_time'] = date('Y-m-d');
        $info['end_time'] = date('Y-m-d', time() + 3600 * 60 * 24);
        if ($prom_id > 0) {
            $info = M('prom_goods')->where("id=$prom_id")->find();
            $info['start_time'] = date('Y-m-d', $info['start_time']);
            $info['end_time'] = date('Y-m-d', $info['end_time']);
            $Goods = new Goods();
            $prom_goods = $Goods->with('SpecGoodsPrice')->where(['prom_id' => $prom_id, 'prom_type' => 3])->select();
            $this->assign('prom_goods', $prom_goods);
        }
        $coupon_list = M('coupon')->where(['type'=>0,'status'=>1,'use_start_time'=>['lt',time()],'use_end_time'=>['gt',time()]])->select();
        $this->assign('coupon_list',$coupon_list);
        $this->assign('info', $info);
        $this->assign('min_date', date('Y-m-d'));
        $this->initEditor();
        return $this->fetch();
    }

    public function prom_goods_save()
    {
        $prom_id = I('id/d');
        $data = I('post.');
        $title = input('title');
        $promGoods = $data['goods'];
        $promGoodsValidate = Loader::validate('PromGoods');
        if(!$promGoodsValidate->batch()->check($data)){
            $return = ['status' => 0,'msg' =>'操作失败',
                'result'    => $promGoodsValidate->getError(),
                'token'       =>  \think\Request::instance()->token(),
            ];
            $this->ajaxReturn($return);
        }
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
//        $data['group'] = (empty($data['group'])) ? '' : implode(',', $data['group']); //前台暂时不用这个功能，先注释
        $goods_ids = [];
        $item_ids = [];
        foreach ($promGoods as $goodsKey => $goodsVal) {
            if (array_key_exists('goods_id', $goodsVal)) {
                array_push($goods_ids, $goodsVal['goods_id']);
            }
            if (array_key_exists('item_id', $goodsVal)) {
                $item_ids = array_merge($item_ids, $goodsVal['item_id']);
            }
        }
        if ($prom_id) {
            M('prom_goods')->where(['id' => $prom_id])->save($data);
            $last_id = $prom_id;
            adminLog("管理员修改了商品促销 " . $title);
        } else {
            $last_id = M('prom_goods')->add($data);
            adminLog("管理员添加了商品促销 " . $title);
        }
        M("goods")->where(['prom_id' => $prom_id, 'prom_type' => 3])->save(array('prom_id' => 0, 'prom_type' => 0));
        M("goods")->where("goods_id", "in", $goods_ids)->save(array('prom_id' => $last_id, 'prom_type' => 3));
        Db::name('spec_goods_price')->where(['prom_id' => $prom_id, 'prom_type' => 3])->update(['prom_id' => 0, 'prom_type' => 0]);
        Db::name('spec_goods_price')->where('item_id','IN',$item_ids)->update(['prom_id' => $last_id, 'prom_type' => 3]);
        $this->ajaxReturn(['status'=>1,'msg'=>'编辑促销活动成功','result']);
    }

    public function prom_goods_del()
    {
        $prom_id = I('id');
        $order_goods = M('order_goods')->where("prom_type = 3 and prom_id = $prom_id")->find();
        if (!empty($order_goods)) {
            $this->error("该活动有订单参与不能删除!");
        }
        M("goods")->where("prom_id=$prom_id and prom_type=3")->save(array('prom_id' => 0, 'prom_type' => 0));
        M('prom_goods')->where("id=$prom_id")->delete();
        $this->success('删除活动成功', U('Promotion/prom_goods_list'));
    }


    /**
     * 活动列表
     */
    public function prom_order_list()
    {
        $parse_type = array('0' => '满额打折', '1' => '满额优惠金额', '2' => '满额送积分', '3' => '满额送优惠券');
        $level = M('user_level')->select();
        if ($level) {
            foreach ($level as $v) {
                $lv[$v['level_id']] = $v['level_name'];
            }
        }
        $count = M('prom_order')->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $prom_list = M('prom_order')->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        if ($res) {  //获得适用范围（用户等级）
//            foreach ($res as $val) {
//                if (!empty($val['group']) && !empty($lv)) {
//                    $val['group'] = explode(',', $val['group']);
//                    foreach ($val['group'] as $v) {
//                        $val['group_name'] .= $lv[$v] . ',';
//                    }
//                }
//                $prom_list[] = $val;
//            }
//        }
        $this->assign('pager', $Page);// 赋值分页输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign("parse_type", $parse_type);
        $this->assign('prom_list', $prom_list);
        return $this->fetch();
    }

    public function prom_order_info()
    {
        $this->assign('min_date', date('Y-m-d'));
        $level = M('user_level')->select();
        $this->assign('level', $level);
        $prom_id = I('id');
        $info['start_time'] = date('Y-m-d');
        $info['end_time'] = date('Y-m-d', time() + 3600 * 24 * 60);
        if ($prom_id > 0) {
            $info = M('prom_order')->where("id=$prom_id")->find();
            $info['start_time'] = date('Y-m-d', $info['start_time']);
            $info['end_time'] = date('Y-m-d', $info['end_time']);
        }
        $this->assign('info', $info);
        $this->assign('min_date', date('Y-m-d'));
        $this->initEditor();
        return $this->fetch();
    }

    public function prom_order_save()
    {
        $prom_id = I('id');
        $data = I('post.');
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        $data['group'] = $data['group'] ? implode(',', $data['group']) : '';
        if ($prom_id) {
            M('prom_order')->where("id=$prom_id")->save($data);
            adminLog("管理员修改了商品促销 " . I('name'));
        } else {
            M('prom_order')->add($data);
            adminLog("管理员添加了商品促销 " . I('name'));
        }
        $this->success('编辑促销活动成功', U('Promotion/prom_order_list'));
    }

    public function prom_order_del()
    {
        $prom_id = I('id');
        $order = M('order')->where("order_prom_id = $prom_id")->find();
        if (!empty($order)) {
            $this->error("该活动有订单参与不能删除!");
        }

        M('prom_order')->where("id=$prom_id")->delete();
        $this->success('删除活动成功', U('Promotion/prom_order_list'));
    }

    public function group_buy_list()
    {
        $GroupBuy = new GroupBuy();
        $count = $GroupBuy->where('')->count();
        $Page = new Page($count, 10);
        $list = $GroupBuy->where('')->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $Page);
        return $this->fetch();
    }

    public function group_buy()
    {
        $act = I('GET.act', 'add');
        $groupbuy_id = I('get.id/d');
        $group_info = array();
        $group_info['start_time'] = date('Y-m-d');
        $group_info['end_time'] = date('Y-m-d', time() + 3600 * 365);
        if ($groupbuy_id) {
            $GroupBy = new GroupBuy();
            $group_info = $GroupBy->with('specGoodsPrice,goods')->find($groupbuy_id);
            $group_info['start_time'] = date('Y-m-d H:i', $group_info['start_time']);
            $group_info['end_time'] = date('Y-m-d H:i', $group_info['end_time']);
            $act = 'edit';
        }
        $this->assign('min_date', date('Y-m-d'));
        $this->assign('info', $group_info);
        $this->assign('act', $act);
        return $this->fetch();
    }

    public function groupbuyHandle()
    {
        $data = I('post.');
        $data['groupbuy_intro'] = htmlspecialchars(stripslashes($this->request->param('groupbuy_intro')));
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        if ($data['act'] == 'del') {

            $spec_goods = Db::name('spec_goods_price')->where(['prom_type' => 2, 'prom_id' => $data['id']])->find();
            //有活动商品规格
            if($spec_goods){
                Db::name('spec_goods_price')->where(['prom_type' => 2, 'prom_id' => $data['id']])->save(array('prom_id' => 0, 'prom_type' => 0));
                //商品下的规格是否都没有活动
                $goods_spec_num = Db::name('spec_goods_price')->where(['prom_type' => 2, 'goods_id' => $spec_goods['goods_id']])->find();
                if(empty($goods_spec_num)){
                    //商品下的规格都没有活动,把商品回复普通商品
                    Db::name('goods')->where(['goods_id' => $spec_goods['goods_id']])->save(array('prom_id' => 0, 'prom_type' => 0));
                }
            }else{
                //没有商品规格
                Db::name('goods')->where(['prom_type' => 2, 'prom_id' => $data['id']])->save(array('prom_id' => 0, 'prom_type' => 0));
            }
            $r = D('group_buy')->where(['id' => $data['id']])->delete();
            if ($r) exit(json_encode(1));
        }
        $groupBuyValidate = Loader::validate('GroupBuy');
        if($data['item_id'] > 0){
            $spec_goods_price = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->find();
            $data['goods_price'] = $spec_goods_price['price'];
            $data['store_count'] = $spec_goods_price['store_count'];
        }else{
            $goods = Db::name("goods")->where(['goods_id'=>$data['goods_id']])->find();
            $data['goods_price'] = $goods['shop_price'];
            $data['store_count'] = $goods['store_count'];
        }
        if(!$groupBuyValidate->batch()->check($data)){
            $return = ['status' => 0,'msg' =>'操作失败','result' => $groupBuyValidate->getError() ];
            $this->ajaxReturn($return);
        }
        $data['rebate'] = number_format($data['price'] / $data['goods_price'] * 10, 1);
        if ($data['act'] == 'add') {
            $r = Db::name('group_buy')->insertGetId($data);
            if($data['item_id'] > 0){
                //设置商品一种规格为活动
                Db::name('spec_goods_price')->where('item_id',$data['item_id'])->update(['prom_id' => $r, 'prom_type' => 2]);
                Db::name('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => 0, 'prom_type' => 2));
            }else{
                Db::name('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => $r, 'prom_type' => 2));
            }
        }
        if ($data['act'] == 'edit') {
            $r = Db::name('group_buy')->where(['id' => $data['id']])->update($data);
            if($data['item_id'] > 0){
                //设置商品一种规格为活动
                Db::name('spec_goods_price')->where(['prom_type' => 2, 'prom_id' => $data['id']])->update(['prom_id' => 0, 'prom_type' => 0]);
                Db::name('spec_goods_price')->where('item_id', $data['item_id'])->update(['prom_id' => $data['id'], 'prom_type' => 2]);
                M('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => 0, 'prom_type' => 2));
            }else{
                M('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => $data['id'], 'prom_type' => 2));
            }
        }
        if ($r !== false) {
            $this->ajaxReturn(['status' => 1,'msg' =>'操作成功','result' => '']);
        } else {
            $this->ajaxReturn(['status' => 0,'msg' =>'操作失败','result' =>'']);
        }
    }

    public function get_goods()
    {
        $prom_id = I('id/d');
        $Goods = new Goods();
        $prom_where = ['prom_id' => $prom_id, 'prom_type' => 3];
        $count = $Goods->where($prom_where)->count('goods_id');
        $Page = new Page($count, 10);
        $goodsList = $Goods->with('specGoodsPrice')->where($prom_where)->order('goods_id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show();
        $this->assign('page', $show);
        $this->assign('goodsList', $goodsList);
        return $this->fetch();
    }

    public function search_goods()
    {
        $goods_id = input('goods_id');
        $intro = input('intro');
        $cat_id = input('cat_id');
        $brand_id = input('brand_id');
        $keywords = input('keywords');
        $prom_id = input('prom_id');
        $tpl = input('tpl', 'search_goods');
        $where = ['is_on_sale' => 1, 'store_count' => ['gt', 0],'is_virtual'=>0,'exchange_integral'=>0];
        $prom_type = input('prom_type/d');
        if($goods_id){
            $where['goods_id'] = ['<>',$goods_id];
        }
        if($intro){
            $where[$intro] = 1;
        }
        if($cat_id){
            $grandson_ids = getCatGrandson($cat_id);
            $where['cat_id'] = ['in',implode(',', $grandson_ids)];
        }
        if ($brand_id) {
            $where['brand_id'] = $brand_id;
        }
        if($keywords){
            $where['goods_name|keywords'] = ['like','%'.$keywords.'%'];
        }
        $Goods = new Goods();
        $count = $Goods->where($where)->where(function ($query) use ($prom_type, $prom_id) {
            if($prom_type == 3){
                //优惠促销
                if ($prom_id) {
                    $query->where(['prom_id' => $prom_id, 'prom_type' => 3])->whereor('prom_type', 0);
                } else {
                    $query->where('prom_type', 0);
                }
            }else if(in_array($prom_type,[1,2,6])){
                //抢购，团购
                $query->where('prom_type','in' ,[0,$prom_type])->where('prom_type',0);
            }else{
                $query->where('prom_type',0);
            }
        })->count();
        $Page = new Page($count, 10);
        $goodsList = $Goods->with('specGoodsPrice')->where($where)->where(function ($query) use ($prom_type, $prom_id) {
            if($prom_type == 3){
                //优惠促销
                if ($prom_id) {
                    $query->where(['prom_id' => $prom_id, 'prom_type' => 3])->whereor('prom_type', 0);
                } else {
                    $query->where('prom_type', 0);
                }
            }else if(in_array($prom_type,[1,2,6])){
                //抢购，团购
                $query->where('prom_type','in' ,[0,$prom_type]);
            }else{
                $query->where('prom_type',0);
            }
        })->order('goods_id DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $GoodsLogic = new GoodsLogic;
        $brandList = $GoodsLogic->getSortBrands();
        $categoryList = $GoodsLogic->getSortCategory();
        $this->assign('brandList', $brandList);
        $this->assign('categoryList', $categoryList);
        $this->assign('page', $Page);
        $this->assign('goodsList', $goodsList);
        return $this->fetch($tpl);
    }

    //限时抢购
    public function flash_sale()
    {
        $condition = array();
        $FlashSale = new FlashSale();
        $count = $FlashSale->where($condition)->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $prom_list = $FlashSale->append(['status_desc'])->where($condition)->order("id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('prom_list', $prom_list);
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('pager', $Page);
        return $this->fetch();
    }

    public function flash_sale_info()
    {
        if (IS_POST) {
            $data = I('post.');
            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            $flashSaleValidate = Loader::validate('FlashSale');
            if (!$flashSaleValidate->batch()->check($data)) {
                $return = ['status' => 0, 'msg' => '操作失败', 'result' => $flashSaleValidate->getError()];
                $this->ajaxReturn($return);
            }
            if (empty($data['id'])) {
                $flashSaleInsertId = Db::name('flash_sale')->insertGetId($data);
                if($data['item_id'] > 0){
                    //设置商品一种规格为活动
                    Db::name('spec_goods_price')->where('item_id',$data['item_id'])->update(['prom_id' => $flashSaleInsertId, 'prom_type' => 1]);
                    Db::name('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id'=>0,'prom_type' => 1));
                }else{
                    Db::name('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => $flashSaleInsertId, 'prom_type' => 1));
                }
                adminLog("管理员添加抢购活动 " . $data['name']);
                if ($flashSaleInsertId !== false) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '添加抢购活动成功', 'result' => '']);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '添加抢购活动失败', 'result' => '']);
                }
            } else {
                $r = M('flash_sale')->where("id=" . $data['id'])->save($data);
                M('goods')->where(['prom_type' => 1, 'prom_id' => $data['id']])->save(array('prom_id' => 0, 'prom_type' => 0));
                if($data['item_id'] > 0){
                    //设置商品一种规格为活动
                    Db::name('spec_goods_price')->where(['prom_type' => 1, 'prom_id' => $data['item_id']])->update(['prom_id' => 0, 'prom_type' => 0]);
                    Db::name('spec_goods_price')->where('item_id', $data['item_id'])->update(['prom_id' => $data['id'], 'prom_type' => 1]);
                    M('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => 0, 'prom_type' => 1));
                }else{
                    M('goods')->where("goods_id", $data['goods_id'])->save(array('prom_id' => $data['id'], 'prom_type' => 1));
                }
                if ($r !== false) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '编辑抢购活动成功', 'result' => '']);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '编辑抢购活动失败', 'result' => '']);
                }
            }
        }
        $id = I('id');
        $now_time = date('H');
        if ($now_time % 2 == 0) {
            $flash_now_time = $now_time;
        } else {
            $flash_now_time = $now_time - 1;
        }
        $flash_sale_time = strtotime(date('Y-m-d') . " " . $flash_now_time . ":00:00");
        $info['start_time'] = date("Y-m-d H:i:s", $flash_sale_time);
        $info['end_time'] = date("Y-m-d H:i:s", $flash_sale_time + 7200);
        if ($id > 0) {
            $FlashSale = new FlashSale();
            $info = $FlashSale->with('specGoodsPrice,goods')->find($id);
            $info['start_time'] = date('Y-m-d H:i', $info['start_time']);
            $info['end_time'] = date('Y-m-d H:i', $info['end_time']);
        }
        $this->assign('info', $info);
        $this->assign('min_date', date('Y-m-d'));
        return $this->fetch();
    }

    public function flash_sale_del()
    {
        $id = I('del_id/d');
        if ($id) {
            $spec_goods = Db::name('spec_goods_price')->where(['prom_type' => 1, 'prom_id' => $id])->find();
            //有活动商品规格
            if($spec_goods){
                Db::name('spec_goods_price')->where(['prom_type' => 1, 'prom_id' => $id])->save(array('prom_id' => 0, 'prom_type' => 0));
                //商品下的规格是否都没有活动
                $goods_spec_num = Db::name('spec_goods_price')->where(['prom_type' => 1, 'goods_id' => $spec_goods['goods_id']])->find();
                if(empty($goods_spec_num)){
                    //商品下的规格都没有活动,把商品回复普通商品
                    Db::name('goods')->where(['goods_id' => $spec_goods['goods_id']])->save(array('prom_id' => 0, 'prom_type' => 0));
                }
            }else{
                //没有商品规格
                Db::name('goods')->where(['prom_type' => 1, 'prom_id' => $id])->save(array('prom_id' => 0, 'prom_type' => 0));
            }
            M('flash_sale')->where(['id' => $id])->delete();
            exit(json_encode(1));
        } else {
            exit(json_encode(0));
        }
    }


    private function initEditor()
    {
        $this->assign("URL_upload", U('Admin/Ueditor/imageUp', array('savepath' => 'promotion')));
        $this->assign("URL_fileUp", U('Admin/Ueditor/fileUp', array('savepath' => 'promotion')));
        $this->assign("URL_scrawlUp", U('Admin/Ueditor/scrawlUp', array('savepath' => 'promotion')));
        $this->assign("URL_getRemoteImage", U('Admin/Ueditor/getRemoteImage', array('savepath' => 'promotion')));
        $this->assign("URL_imageManager", U('Admin/Ueditor/imageManager', array('savepath' => 'promotion')));
        $this->assign("URL_imageUp", U('Admin/Ueditor/imageUp', array('savepath' => 'promotion')));
        $this->assign("URL_getMovie", U('Admin/Ueditor/getMovie', array('savepath' => 'promotion')));
        $this->assign("URL_Home", "");
    }

    /**
     * 商品预售列表
     *
     */
    public function pre_sell_list()
    {
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
    }

    /**
     * 预售商品商品详情页
     */
    public function pre_sell_info()
    {
    header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");	
    }

    /**
     * 预售商品删除处理
     */
    public function pre_sell_del()
    {
        header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }

    /**
     * 预售活动成功
     */
    public function pre_sell_success()
    {
        header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }

    /**
     * 预售活动失败
     */
    public function pre_sell_fail()
    {
        header("Content-type: text/html; charset=utf-8");
exit("请联系TPshop官网客服购买高级版支持此功能");
    }

}