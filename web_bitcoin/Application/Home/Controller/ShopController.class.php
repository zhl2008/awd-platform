<?php
namespace Home\Controller;

class ShopController extends HomeController
{
	public function index($name = NULL, $type = NULL, $deal = NULL, $addtime = NULL, $price = NULL, $ls = 20)
	{
		if (C('shop_login')) {
			if (!userid()) {
				redirect('/#login');
			}
		}


		$this->assign('prompt_text', D('Text')->get_content('game_shop'));
		
		
		if ($name) {
			$where['name'] = array('like', '%' . trim($name) . '%');
		}

		$shop_type_list = D('Shop')->shop_type_list();

		if ($type && $shop_type_list[$type]) {
			$where['type'] = trim($type);
		}

		$this->assign('shop_type_list', $shop_type_list);

		if (empty($deal)) {
		}

		if ($deal) {
			$deal_arr = explode('_', $deal);

			if (($deal_arr[1] == 'asc') || ($deal_arr[1] == 'desc')) {
				$order['deal'] = $deal_arr[1];
			}
			else {
				$order['deal'] = 'desc';
			}
		}

		if (empty($addtime)) {
		}

		if ($addtime) {
			$addtime_arr = explode('_', $addtime);

			if (($addtime_arr[1] == 'asc') || ($addtime_arr[1] == 'desc')) {
				$order['addtime'] = $addtime_arr[1];
			}
			else {
				$order['addtime'] = 'desc';
			}
		}

		if (empty($price)) {
		}

		if ($price) {
			$price_arr = explode('_', $price);

			if (($price_arr[1] == 'asc') || ($price_arr[1] == 'desc')) {
				$order['price'] = $price_arr[1];
			}
			else {
				$order['price'] = 'desc';
			}
		}

		$this->assign('name', $name);
		$this->assign('type', $type);
		$this->assign('deal', $deal);
		$this->assign('addtime', $addtime);
		$this->assign('price', $price);
		$where['status'] = 1;
		$shop = M('Shop');
		$count = $shop->where($where)->count();
		$Page = new \Think\Page($count, $ls);
		$Page->parameter .= 'name=' . $name . '&type=' . $type . '&deal=' . $deal . '&addtime=' . $addtime . '&price=' . $price . '&';
		$show = $Page->show();
		$list = $shop->where($where)->order($order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
		

		foreach($list as $k=>$v){
			$list[$k]['buycoin'] = C('coin')[$v['buycoin']]['title'];
		}
		
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function view($id)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_shop_view'));

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$id = intval($id);
		
		$Shop = M('Shop')->where(array('id' => $id))->find();

		if (!$Shop) {
			$this->error('商品错误！');
		}
		else {
			
			
			$Shop['buycoinname'] =  C('coin')[$Shop['buycoin']]['title']; 
			
			$Shop['qq3479015851_awardcoin'] =  C('coin')[$Shop['qq3479015851_awardcoin']]['title']; 
			
			
			
			$errormsg = "";
			if ($Shop['buycoin'] != 'cny') {
				$coin_price = D('Market')->get_new_price($Shop['buycoin'] . '_cny');

				if ((floatval($coin_price)+0)==0) {
					//$this->error('当前币种价格错误！');
					$errormsg = "nodata";
				}
				
			}
			else {
				$coin_price = 1;
			}
			
			
			$this->assign('errormsg',$errormsg);
			$this->assign('coinprice',$coin_price*$Shop['price']."元");
			
			
			$this->assign('data', $Shop);
			//$shop_coin_list = D('Shop')->fangshi($Shop['id']);

			//foreach ($shop_coin_list as $k => $v) {
				//$coin_list[$k]['name'] = D('Coin')->get_title($k);
				//$coin_list[$k]['price'] = Num($v);
			//}

			//$this->assign('coin_list', $coin_list);
		}

		
		$goods_list = D('Shop')->get_goods(userid());
		$this->assign('goods_list', $goods_list);
		$this->display();
	}

	public function log($ls = 15)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_shop_log'));
		$where['status'] = array('egt', 0);
		$where['userid'] = userid();
		$ShopLog = M('ShopLog');
		$count = $ShopLog->where($where)->count();
		$Page = new \Think\Page($count, $ls);
		$show = $Page->show();
		$list = $ShopLog->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		
		foreach($list as $k=>$v){
			$list[$k]['coinname'] = C('coin')[$v['coinname']]['title'];
		}
		
		
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function address()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$ShopAddr = M('ShopAddr')->where(array('userid' => userid()))->find();
		$this->assign('ShopAddr', $ShopAddr);
		$this->display();
	}

	public function shopaddr()
	{
		exit();

		if (!userid()) {
			redirect('/#login');
		}

		$this->display();
	}

	public function buyShop($id, $num, $paypassword, $goods)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		if (!check($num, 'd')) {
			$this->error('购买数量格式错误！');
		}

		if (!check($goods, 'd')) {
			$this->error('收货地址格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

/* 		if (!check($type, 'w')) {
			$this->error('付款方式格式错误！');
		} */

		$User = M('User')->where(array('id' => userid()))->find();

		if (!$User['paypassword']) {
			$this->error('交易密码非法！');
		}

		if (md5($paypassword) != $User['paypassword']) {
			$this->error('交易密码错误！');
		}

		$Shop = M('Shop')->where(array('id' => $id))->find();

		$type = $Shop['buycoin'];//获取付款类型

		
		if (!$Shop) {
			$this->error('商品错误！');
		}

		$my_goods = M('UserGoods')->where(array('id' => $goods))->find();

		if (!$my_goods) {
			$this->error('收货地址错误！');
		}

		if ($my_goods['userid'] != userid()) {
			$this->error('收货地址非法！');
		}

		if (!$Shop['status']) {
			$this->error('当前商品没有上架！');
		}

		if ($Shop['num'] <= $Shop['deal']) {
			$this->error('当前商品已经卖完！');
		}

		$shop_min = 1;
		$shop_max = 100000000;

		if ($num < $shop_min) {
			$this->error('购买数量超过系统最小限制！');
		}

		if ($shop_max < $num) {
			$this->error('购买数量超过系统最大限制！');
		}

		if (($Shop['num'] - $Shop['deal']) < $num) {
			$this->error('购买数量超过当前剩余量！');
		}
 
		if ($type != 'cny') {
			$coin_price = D('Market')->get_new_price($type . '_cny');

			if ((floatval($coin_price)+0)==0) {
				$this->error('支付币种暂无交易数据！');
			}
		}
		else {
			$coin_price = 1;
		} 

		$mum = round($Shop['price'] * $coin_price * $num, 8);

		$qq3479015851_awardcoinnum  = $Shop['qq3479015851_awardcoinnum'];
		if($qq3479015851_awardcoinnum>0){
			$qq3479015851_awardcoinnum = $qq3479015851_awardcoinnum * $num;
		}
		$qq3479015851_awardcointype = $Shop['qq3479015851_awardcoin'];
		
		
		
		if (!$mum) {
			$this->error('购买总额错误');
		}

		//$xuyao = round($mum / $coin_price, 8);
		
		$xuyao = round($mum, 8);

		if (!$xuyao) {
			$this->error('付款总额错误');
		}

		//$usercoin = M('UserCoin')->where(array('userid' => userid()))->getField($type);
		$usercoin = M('UserCoin')->where(array('userid' => userid()))->getField("cny");

		if ($usercoin < $xuyao) {
			//$this->error('可用' . C('coin')[$type]['title'] . '余额'.$usercoin.'不足,总共需要支付' . $xuyao . ' ' . C('coin')[$type]['title']);
			$this->error('可用' . C('coin')['cny']['title'] . '余额'.$usercoin.'不足,总共需要支付' . $xuyao . ' ' . C('coin')['cny']['title']);
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_shop write,qq3479015851_shop_log write');
		$rs = array();
		//$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($type, $xuyao);
		
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec("cny", $xuyao);
		
		if($qq3479015851_awardcoinnum>0){
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setInc($qq3479015851_awardcointype,$qq3479015851_awardcoinnum);
		}
		
		$rs[] = $mo->table('qq3479015851_shop')->where(array('id' => $Shop['id']))->save(array(
			'deal' => array('exp', 'deal+' . $num),
			'num'  => array('exp', 'num-' . $num)
			));

		if ($Shop['num'] - $num <= 0) {
			$rs[] = $mo->table('qq3479015851_shop')->where(array('id' => $Shop['id']))->save(array('status' => 0));
		}

		$rs[] = $mo->table('qq3479015851_shop_log')->add(array('userid' => userid(), 'shopid' => $Shop['id'], 'price' => $Shop['price'], 'coinname' => $type, 'xuyao' => $xuyao, 'num' => $num, 'mum' => $mum, 'addr' => $my_goods['truename'] . '|' . $my_goods['moble'] . '|' . $my_goods['addr'], 'addtime' => time(), 'status' => 0));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('购买成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('购买失败！');
		}
	}

	public function shouhuo($id = NULL)
	{
		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$shoplog = M('ShopLog')->where(array('id' => $id))->find();

		if (!$shoplog) {
			$this->error('操作失败1！');
		}

		if ($shoplog['userid'] != userid()) {
			$this->error('非法操作！');
		}

		$rs = M('ShopLog')->where(array('id' => $id))->save(array('status' => 1));

		if ($rs) {
			$this->success('操作成功！');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function setaddress($truename, $moble, $name)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($truename, 'truename')) {
			$this->error('收货人姓名格式错误');
		}

		if (!check($moble, 'moble')) {
			$this->error('收货人电话格式错误');
		}

		if (!check($name, 'a')) {
			$this->error('收货地址格式错误');
		}

		$ShopAddr = M('ShopAddr')->where(array('userid' => userid()))->find();

		if ($ShopAddr) {
			$rs = M('ShopAddr')->where(array('userid' => userid()))->save(array('truename' => $truename, 'moble' => $moble, 'name' => $name));
		}
		else {
			$rs = M('ShopAddr')->add(array('userid' => userid(), 'truename' => $truename, 'moble' => $moble, 'name' => $name));
		}

		if ($rs) {
			$this->success('提交成功');
		}
		else {
			$this->error('提交失败');
		}
	}

	public function goods()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_shop_goods'));
		$userGoodsList = M('UserGoods')->where(array('userid' => userid(), 'status' => 1))->order('id desc')->select();

		foreach ($userGoodsList as $k => $v) {
			$userGoodsList[$k]['moble'] = substr_replace($v['moble'], '****', 3, 4);
			$userGoodsList[$k]['idcard'] = substr_replace($v['idcard'], '********', 6, 8);
		}

		$this->assign('userGoodsList', $userGoodsList);
		$this->display();
	}

	public function upgoods($name, $truename, $idcard, $moble, $addr, $paypassword)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($name, 'a')) {
			$this->error('备注名称格式错误！');
		}

		if (!check($truename, 'truename')) {
			$this->error('联系姓名格式错误！');
		}

		if (!check($idcard, 'idcard')) {
			$this->error('身份证号格式错误！');
		}

		if (!check($moble, 'moble')) {
			$this->error('联系电话格式错误！');
		}

		if (!check($addr, 'a')) {
			$this->error('联系地址格式错误！');
		}

		$user_paypassword = M('User')->where(array('id' => userid()))->getField('paypassword');

		if (md5($paypassword) != $user_paypassword) {
			$this->error('交易密码错误！');
		}

		$userGoods = M('UserGoods')->where(array('userid' => userid()))->select();

		foreach ($userGoods as $k => $v) {
			if ($v['name'] == $name) {
				$this->error('请不要使用相同的地址标识！');
			}
		}

		if (10 <= count($userGoods)) {
			$this->error('每个人最多只能添加10个地址！');
		}

		if (M('UserGoods')->add(array('userid' => userid(), 'name' => $name, 'addr' => $addr, 'idcard' => $idcard, 'truename' => $truename, 'moble' => $moble, 'addtime' => time(), 'status' => 1))) {
			$this->success('添加成功！');
		}
		else {
			$this->error('添加失败！');
		}
	}

	public function delgoods($id, $paypassword)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$user_paypassword = M('User')->where(array('id' => userid()))->getField('paypassword');

		if (md5($paypassword) != $user_paypassword) {
			$this->error('交易密码错误！');
		}

		if (!M('UserGoods')->where(array('userid' => userid(), 'id' => $id))->find()) {
			$this->error('非法访问！');
		}
		else if (M('UserGoods')->where(array('userid' => userid(), 'id' => $id))->delete()) {
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}

	public function uninstall()
	{
	}
    
}

?>