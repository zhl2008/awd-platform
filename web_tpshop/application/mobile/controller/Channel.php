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
 * $Author: 当燃 2016-01-09
 */ 
namespace app\mobile\controller;
use think\db;
class Channel extends MobileBase {
	
	public function index(){
		$cat_id = I('cat_id/d',1);
		$channel_cate = $this->cateTrre[$cat_id]['tmenu'];
		$sub_id = ''; $sub_goods = array();
		foreach ($channel_cate as $k=>$val){
			foreach ($val['sub_menu'] as $v){
				$sub_id .= $v['id'].',';//三级分类ID集
			}
			$second_str .= $val['id'].',';
		}
		
		$all_cat_id = trim(($second_str.$sub_id),',');
		
		//查询所有此频道三级分类商品
		$sub_id_str = '('.trim($sub_id,',').')';
		$sql = "select goods_id,cat_id,goods_name,shop_price,market_price from __PREFIX__goods where is_on_sale=1 and cat_id in $sub_id_str ";
		$sub_goods_arr = DB::query($sql);
		if($sub_goods_arr){
			foreach ($sub_goods_arr as $val){
				$sub_goods[$val['cat_id']][] = $val;//商品按分类分组
			}
			//商品归属到三级分类下sub_goods项
			foreach ($channel_cate as $kk=>$vv){
				foreach ($vv['sub_menu'] as $mk=>$vo){
					$channel_cate[$kk]['sub_menu'][$mk]['sub_goods'] = empty($sub_goods[$vo['id']]) ? array() : $sub_goods[$vo['id']];
				}
			}
		}	
		//echo '<pre>';
		//print_r($channel_cate);
		//exit;
		$this->assign('parent_name', $this->cateTrre[$cat_id]['name']);
		$this->assign('channel_cate',$channel_cate);
		return $this->fetch();
	}
}