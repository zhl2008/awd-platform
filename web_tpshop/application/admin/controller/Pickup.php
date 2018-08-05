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
 * Date: 2016-08-19
 */

namespace app\admin\controller;

use think\Page;
use think\AjaxPage;
use think\Db;

class Pickup extends Base {

    public function index(){
		$p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
		$this->assign('province',$p);
        return $this->fetch();
    }

	public function ajaxPickupList(){
		$province_id = I('post.province_id');
		$city_id = I('post.city_id');
		$district_id = I('post.district_id');
		$order_by_field = I('post.order_by_field','pickup_id');
		$order_by_mode = I('post.order_by_mode','desc');
		$key_word = I('post.key_word');
		$pickup_where = array();
		if(!empty($province_id)){
			$pickup_where['p.province_id'] = $province_id;
		}
		if(!empty($city_id)){
			$pickup_where['p.city_id'] = $city_id;
		}
		if(!empty($district_id)){
			$pickup_where['p.district_id'] = $district_id;
		}
		if(!empty($key_word)){
			$pickup_where['p.pickup_name'] = array('like',$key_word);
		}

		$count = DB::name('pick_up')->alias('p')->where($pickup_where)->count();
		$Page  = new AjaxPage($count,10);
		$show = $Page->show();

		$pickupList = DB::name('pick_up')
				->alias('p')
				->field('p.*,r1.name as province_name,r2.name as city_name,r3.name as district_name,s.suppliers_name')
				->join('__REGION__ r1','r1.id = p.province_id','LEFT')
				->join('__REGION__ r2','r2.id = p.city_id','LEFT')
				->join('__REGION__ r3','r3.id = p.district_id','LEFT')
				->join('__SUPPLIERS__ s','s.suppliers_id = p.suppliersid','LEFT')
				->where($pickup_where)
				->order($order_by_field.' '.$order_by_mode)
				->limit($Page->firstRow.','.$Page->listRows)
				->select();
		$this->assign('pickupList',$pickupList);
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('pager',$Page);
		return $this->fetch();
	}

	public function add()
	{
		if (IS_POST) {
			$data = I('post.');
			$pickup_id = I('post.pickup_id');
			$model = M('pick_up');
			if (empty($pickup_id)) {
				//添加
				unset($pickup_id);
				$add_res = $model->add($data);
				if ($add_res === false) {
					$this->error('添加失败', U('Admin/Pickup/add'));
				} else {
					$this->error('添加成功', U('Admin/Pickup/index'));
				}
			} else {
				//修改
				$update_res = $model->where(array('pickup_id' => $pickup_id))->save($data);
				if ($update_res === false) {
					$this->error('更新失败', U('Admin/Pickup/edit_address', array('pickup_id' => $pickup_id)));
				} else {
					$this->success('更新成功', U('Admin/Pickup/index'));
				}
			}
		}
		$suppliers = M('suppliers')->where(array('is_check' => 1))->select();
		$p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
		$this->assign('province', $p);
		$this->assign('suppliers', $suppliers);
		return $this->fetch();
	}

	/**
    * 地址编辑
    */
	public function edit_address(){
		$id = I('get.pickup_id');
		$pickup = M('pick_up')->where(array('pickup_id'=>$id))->find();
		//获取省份
		$p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
		$c = M('region')->where(array('parent_id'=>$pickup['province_id'],'level'=> 2))->select();
		$d = M('region')->where(array('parent_id'=>$pickup['city_id'],'level'=> 3))->select();

		$suppliers = M('suppliers')->where(array('is_check'=>1))->select();

		$this->assign('province',$p);
		$this->assign('city',$c);
		$this->assign('district',$d);
		$this->assign('suppliers',$suppliers);
		$this->assign('pickup',$pickup);
		return $this->fetch('add');
	}

	public function del()
	{
		$id = I('get.pickup_id');
		M('pick_up')->where(array('pickup_id' => $id))->delete();
		$return_arr = array('status' => 1, 'msg' => '操作成功', 'data' => '',);
		$this->ajaxReturn($return_arr);
	}
}