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
 * Author: 当燃
 * Date: 2015-09-09
 */

/**
 * 管理员操作记录
 * @param $log_url 操作URL
 * @param $log_info 记录信息
 */
function adminLog($log_info){
    $add['log_time'] = time();
    $add['admin_id'] = session('admin_id');
    $add['log_info'] = $log_info;
    $add['log_ip'] = request()->ip();
    $add['log_url'] = request()->baseUrl() ;
    M('admin_log')->add($add);
}


/**
 * 平台支出记录
 * @param $log_id 支出业务关联id
 * @param $money 支出金额
 * @param $type 支出类别
 * @param $user_id or $store_id 涉及申请用户ID或商家ID
 */
function expenseLog($data){
	$data['addtime'] = time();
	$data['admin_id'] = session('admin_id');
	M('expense_log')->add($data);
}


//订单商品售后退款
function updateRefundGoods($rec_id,$refund_type=0){
	$order_goods = M('order_goods')->where(array('rec_id'=>$rec_id))->find();
	$return_goods = M('return_goods')->where(array('rec_id'=>$rec_id))->find();
	$updata = array('refund_type'=>$refund_type,'refund_time'=>time(),'status'=>3);
	//使用积分或者余额抵扣部分原路退还
	if(($return_goods['refund_deposit']>0 || $return_goods['refund_integral']>0)){
		accountLog($return_goods['user_id'],$return_goods['refund_deposit'],$return_goods['refund_integral'],'用户申请商品退款',0,$return_goods['order_id'],$return_goods['order_sn']);
	}
	//在线支付金额退到余额去
	if($refund_type==1 && $return_goods['refund_money']>0){
		accountLog($return_goods['user_id'],$return_goods['refund_money'],0,'用户申请商品退款',0,$return_goods['order_id'],$return_goods['order_sn']);
	}
	M('return_goods')->where(array('rec_id'=>$rec_id))->save($updata);//更新退款申请状态
	M('order_goods')->where(array('rec_id'=>$rec_id))->save(array('is_send'=>3));//修改订单商品状态
	if($return_goods['is_receive'] == 1){
		//赠送积分追回
		if($order_goods['give_integral']>0){
			$user = get_user_info($return_goods['user_id']);
			if($order_goods['give_integral']<$user['pay_points']){
				accountLog($return_goods['user_id'],0,-$order_goods['give_integral'],'退货积分追回',0,$return_goods['order_id'],$return_goods['order_sn']);
			}
		}
		//追回订单商品赠送的优惠券
		$coupon_info = M('coupon_list')->where(array('uid'=>$return_goods['user_id'],'get_order_id'=>$return_goods['order_id']))->find();
		if(!empty($coupon_info)){
			if($coupon_info['status'] == 1) { //如果优惠券被使用,那么从退款里扣
				$coupon = M('coupon')->where(array('id' => $coupon_info['cid']))->find();
				if ($return_goods['refund_money'] > $coupon['money']) {
					//退款金额大于优惠券金额直接扣
					$return_goods['refund_money'] = $return_goods['refund_money'] - $coupon['money'];//更新实际退款金额
					M('return_goods')->where(['id' => $return_goods['id']])->save(['refund_money' => $return_goods['refund_money']]);
				}else{
					//否则从退还余额里扣
					$return_goods['refund_deposit'] = $return_goods['refund_deposit'] - $coupon['money'];//更新实际退还余额
					M('return_goods')->where(['id' => $return_goods['id']])->save(['refund_deposit' => $return_goods['refund_deposit']]);
				}
			}else {
				M('coupon_list')->where(array('id' => $coupon_info['id']))->delete();
				M('coupon')->where(array('id' => $coupon_info['cid']))->setDec('send_num');//优惠券追回
			}
		}
	}
	//退还使用的优惠券
	$order_goods_count =  M('order_goods')->where(array('order_id'=>$return_goods['order_id']))->sum('goods_num');
	$return_goods_count = M('return_goods')->where(array('order_id'=>$return_goods['order_id']))->sum('goods_num');
	if($order_goods_count == $return_goods_count){
		$coupon_list = M('coupon_list')->where(['uid'=>$return_goods['user_id'],'order_id'=>$return_goods['order_id']])->find();
		if(!empty($coupon_list)){
			$update_coupon_data = ['status'=>0,'use_time'=>0,'order_id'=>0];
			M('coupon_list')->where(['id'=>$coupon_list['id'],'status'=>1])->save($update_coupon_data);//符合条件的，优惠券就退给他
		}
	}
	$expense_data = array('money'=>$return_goods['refund_money']+$return_goods['refund_deposit'],'log_type_id'=>$rec_id,'type'=>3,'user_id'=>$return_goods['user_id']);
	expenseLog($expense_data);//退款记录日志
}


/**
 * 取消订单退还余额，优惠券等
 * @param $order
 * @return bool
 */
function updateRefundOrder($order,$type=0){
    //使用积分或者余额抵扣部分一一退还
    if ($order['user_money'] > 0 || $order['integral'] > 0) {
        $update_money_res = accountLog($order['user_id'], $order['user_money'], $order['integral'], '用户申请订单退款', 0, $order['order_id'], $order['order_sn']);
        if(!$update_money_res){
            return false;
        }
    }
    
    //在线支付金额退到余额
    if($order['order_amount']>0 && $type == 1){
    	//改方法已经是退回余额, 不需要判断原路退回还是退还到余额
    	accountLog($order['user_id'],$order['order_amount'],0,'用户取消订单退款',0,$order['order_id'],$order['order_sn']);
    }
    //符合条件的，该笔订单使用的优惠券就退还
    $coupon_list = M('coupon_list')->where(['uid'=>$order['user_id'],'order_id'=>$order['order_id']])->find();
    if(!empty($coupon_list)){
        $update_coupon_data = ['status'=>0,'use_time'=>0,'order_id'=>0];
        M('coupon_list')->where(['id'=>$coupon_list['id'],'status'=>1])->save($update_coupon_data);
    }
    M('order')->where(array('order_id'=>$order['order_id']))->save(array('pay_status'=>3)); //更改订单状态
    $orderLogic = new app\common\logic\OrderLogic();
    $orderLogic->alterReturnGoodsInventory($order);//取消订单后改变库存
    $expense_data = [
        'money'         => $order['user_money'],
        'log_type_id'   => $order['order_id'],
        'type'          => 2,
        'user_id'       => $order['user_id'],
    ];
    expenseLog($expense_data);//平台支出记录
    return true;
}

function getAdminInfo($admin_id){
	return D('admin')->where("admin_id", $admin_id)->find();
}

function tpversion()
{     
   //在线升级系统
    if(!empty($_SESSION['isset_push']))
        return false;    
    $_SESSION['isset_push'] = 1;    
    error_reporting(0);//关闭所有错误报告
    $app_path = dirname($_SERVER['SCRIPT_FILENAME']).'/';
    $version_txt_path = $app_path.'/application/admin/conf/version.php';
    $curent_version = file_get_contents($version_txt_path);
    
    $vaules = array(            
            'domain'=>$_SERVER['HTTP_HOST'], 
            'last_domain'=>$_SERVER['HTTP_HOST'], 
            'key_num'=>$curent_version, 
            'install_time'=>INSTALL_DATE, 
            'cpu'=>'0001',
            'mac'=>'0002',
            'serial_number'=>SERIALNUMBER,
            );     
     $url = "http://service.tp-shop.cn/index.php?m=Home&c=Index&a=user_push&".http_build_query($vaules);
     stream_context_set_default(array('http' => array('timeout' => 3)));
     file_get_contents($url);       
}
 
/**
 * 面包屑导航  用于后台管理
 * 根据当前的控制器名称 和 action 方法
 */
function navigate_admin()
{            
    $navigate = include APP_PATH.'admin/conf/navigate.php';
    $location = strtolower('Admin/'.CONTROLLER_NAME);
    $arr = array(
        '后台首页'=>'javascript:void();',
        $navigate[$location]['name']=>'javascript:void();',
        $navigate[$location]['action'][ACTION_NAME]=>'javascript:void();',
    );
    return $arr;
}

/**
 * 导出excel
 * @param $strTable	表格内容
 * @param $filename 文件名
 */
function downloadExcel($strTable,$filename)
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=".$filename."_".date('Y-m-d').".xls");
	header('Expires:0');
	header('Pragma:public');
	echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$strTable.'</html>';
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 根据id获取地区名字
 * @param $regionId id
 */
function getRegionName($regionId){
    $data = M('region')->where(array('id'=>$regionId))->field('name')->find();
    return $data['name'];
}

function getMenuList($act_list){
	//根据角色权限过滤菜单
	$menu_list = getAllMenu();
	if($act_list != 'all'){
		$right = M('system_menu')->where("id", "in", $act_list)->cache(true)->getField('right',true);
		foreach ($right as $val){
			$role_right .= $val.',';
		}
		$role_right = explode(',', $role_right);		
		foreach($menu_list as $k=>$mrr){
			foreach ($mrr['sub_menu'] as $j=>$v){
				if(!in_array($v['control'].'@'.$v['act'], $role_right)){
					unset($menu_list[$k]['sub_menu'][$j]);//过滤菜单
				}
			}
		}
	}
	return $menu_list;
}

function getAllMenu(){
	return	array(
			'system' => array('name'=>'系统设置','icon'=>'fa-cog','sub_menu'=>array(
					array('name'=>'网站设置','act'=>'index','control'=>'System'),
					array('name'=>'友情链接','act'=>'linkList','control'=>'Article'),
					array('name'=>'自定义导航','act'=>'navigationList','control'=>'System'),
					array('name'=>'区域管理','act'=>'region','control'=>'Tools'),
					array('name'=>'短信模板','act'=>'index','control'=>'SmsTemplate'),
					
			)),
			'access' => array('name' => '权限管理', 'icon'=>'fa-gears', 'sub_menu' => array(
					array('name'=>'权限资源列表','act'=>'right_list','control'=>'System'),
					array('name' => '管理员列表', 'act'=>'index', 'control'=>'Admin'),
					array('name' => '角色管理', 'act'=>'role', 'control'=>'Admin'),
					array('name' => '供应商管理', 'act'=>'supplier', 'control'=>'Admin'),
					array('name' => '管理员日志', 'act'=>'log', 'control'=>'Admin'),
			)),
			'member' => array('name'=>'会员管理','icon'=>'fa-user','sub_menu'=>array(
					array('name'=>'会员列表','act'=>'index','control'=>'User'),
					array('name'=>'会员等级','act'=>'levelList','control'=>'User'),
					array('name'=>'充值记录','act'=>'recharge','control'=>'User'),
					array('name' => '提现申请', 'act'=>'withdrawals', 'control'=>'User'),
					array('name' => '汇款记录', 'act'=>'remittance', 'control'=>'User'),
					//array('name'=>'会员整合','act'=>'integrate','control'=>'User'),
			)),
			'goods' => array('name' => '商品管理', 'icon'=>'fa-book', 'sub_menu' => array(
					array('name' => '商品分类', 'act'=>'categoryList', 'control'=>'Goods'),
					array('name' => '商品列表', 'act'=>'goodsList', 'control'=>'Goods'),
					array('name' => '商品模型', 'act'=>'goodsTypeList', 'control'=>'Goods'),
					array('name' => '商品规格', 'act' =>'specList', 'control' => 'Goods'),
					array('name' => '商品属性', 'act'=>'goodsAttributeList', 'control'=>'Goods'),
					array('name' => '品牌列表', 'act'=>'brandList', 'control'=>'Goods'),
					array('name' => '商品评论','act'=>'index','control'=>'Comment'),
					array('name' => '商品咨询','act'=>'ask_list','control'=>'Comment'),
			)),
			'order' => array('name' => '订单管理', 'icon'=>'fa-money', 'sub_menu' => array(
					array('name' => '订单列表', 'act'=>'index', 'control'=>'Order'),
					array('name' => '发货单', 'act'=>'delivery_list', 'control'=>'Order'),
					//array('name' => '快递单', 'act'=>'express_list', 'control'=>'Order'),
					array('name' => '退货单', 'act'=>'return_list', 'control'=>'Order'),
					array('name' => '添加订单', 'act'=>'add_order', 'control'=>'Order'),
					array('name' => '订单日志', 'act'=>'order_log', 'control'=>'Order'),
			)),
			'promotion' => array('name' => '促销管理', 'icon'=>'fa-bell', 'sub_menu' => array(
					array('name' => '抢购管理', 'act'=>'flash_sale', 'control'=>'Promotion'),
					array('name' => '团购管理', 'act'=>'group_buy_list', 'control'=>'Promotion'),
					array('name' => '商品促销', 'act'=>'prom_goods_list', 'control'=>'Promotion'),
					array('name' => '订单促销', 'act'=>'prom_order_list', 'control'=>'Promotion'),
					array('name' => '代金券管理','act'=>'index', 'control'=>'Coupon'),
					array('name' => '预售管理','act'=>'pre_sell_list', 'control'=>'Promotion'),
			)),
			'Ad' => array('name' => '广告管理', 'icon'=>'fa-flag', 'sub_menu' => array(
					array('name' => '广告列表', 'act'=>'adList', 'control'=>'Ad'),
					array('name' => '广告位置', 'act'=>'positionList', 'control'=>'Ad'),
			)),
			'content' => array('name' => '内容管理', 'icon'=>'fa-comments', 'sub_menu' => array(
					array('name' => '文章列表', 'act'=>'articleList', 'control'=>'Article'),
					array('name' => '文章分类', 'act'=>'categoryList', 'control'=>'Article'),
					//array('name' => '帮助管理', 'act'=>'help_list', 'control'=>'Article'),
					//array('name' => '公告管理', 'act'=>'notice_list', 'control'=>'Article'),
					array('name' => '专题列表', 'act'=>'topicList', 'control'=>'Topic'),
			)),
			'weixin' => array('name' => '微信管理', 'icon'=>'fa-weixin', 'sub_menu' => array(
					array('name' => '公众号管理', 'act'=>'index', 'control'=>'Wechat'),
					array('name' => '微信菜单管理', 'act'=>'menu', 'control'=>'Wechat'),
					array('name' => '文本回复', 'act'=>'text', 'control'=>'Wechat'),
					array('name' => '图文回复', 'act'=>'img', 'control'=>'Wechat'),
					//array('name' => '组合回复', 'act'=>'nes', 'control'=>'Wechat'),
					//array('name' => '消息推送', 'act'=>'news', 'control'=>'Wechat'),
			)),
			'theme' => array('name' => '模板管理', 'icon'=>'fa-adjust', 'sub_menu' => array(
					array('name' => 'PC端模板', 'act'=>'templateList?t=pc', 'control'=>'Template'),
					array('name' => '手机端模板', 'act'=>'templateList?t=mobile', 'control'=>'Template'),
			)),
 
			'distribut' => array('name' => '分销管理', 'icon'=>'fa-cubes', 'sub_menu' => array(
					array('name' => '分销商品列表', 'act'=>'goods_list', 'control'=>'Distribut'),
					array('name' => '分销商列表', 'act'=>'distributor_list', 'control'=>'Distribut'),
					array('name' => '分销关系', 'act'=>'tree', 'control'=>'Distribut'),
					array('name' => '分销设置', 'act'=>'set', 'control'=>'Distribut'),
					array('name' => '分成日志', 'act'=>'rebate_log', 'control'=>'Distribut'),
			)),

			'tools' => array('name' => '插件工具', 'icon'=>'fa-plug', 'sub_menu' => array(
					array('name' => '插件列表', 'act'=>'index', 'control'=>'Plugin'),
					array('name' => '数据备份', 'act'=>'index', 'control'=>'Tools'),
					array('name' => '数据还原', 'act'=>'restore', 'control'=>'Tools'),
			)),
			'count' => array('name' => '统计报表', 'icon'=>'fa-signal', 'sub_menu' => array(
					array('name' => '销售概况', 'act'=>'index', 'control'=>'Report'),
					array('name' => '销售排行', 'act'=>'saleTop', 'control'=>'Report'),
					array('name' => '会员排行', 'act'=>'userTop', 'control'=>'Report'),
					array('name' => '销售明细', 'act'=>'saleList', 'control'=>'Report'),
					array('name' => '会员统计', 'act'=>'user', 'control'=>'Report'),
					array('name' => '财务统计', 'act'=>'finance', 'control'=>'Report'),
			)),
			'pickup' => array('name' => '自提点管理', 'icon'=>'fa-anchor', 'sub_menu' => array(
					array('name' => '自提点列表', 'act'=>'index', 'control'=>'Pickup'),
					array('name' => '添加自提点', 'act'=>'add', 'control'=>'Pickup'),
			))
	);
}

function getMenuArr(){
	$menuArr = include APP_PATH.'admin/conf/menu.php';
	$act_list = session('act_list');
	if($act_list != 'all' && !empty($act_list)){
		$right = M('system_menu')->where("id in ($act_list)")->cache(true)->getField('right',true);
		foreach ($right as $val){
			$role_right .= $val.',';
		}
		foreach($menuArr as $k=>$val){
			foreach ($val['child'] as $j=>$v){
				foreach ($v['child'] as $s=>$son){
					if(strpos($role_right,$son['op'].'@'.$son['act']) === false){
						unset($menuArr[$k]['child'][$j]['child'][$s]);//过滤菜单
					}
				}
			}
		}
		foreach ($menuArr as $mk=>$mr){
			foreach ($mr['child'] as $nk=>$nrr){
				if(empty($nrr['child'])){
					unset($menuArr[$mk]['child'][$nk]);
				}
			}
		}
	}
	return $menuArr;
}


function respose($res){
	exit(json_encode($res));
}