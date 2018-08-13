<?php
namespace Home\Controller;

class FinanceController extends HomeController
{
	public function index()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$CoinList = M('Coin')->where(array('status' => 1))->select();
		$UserCoin = M('UserCoin')->where(array('userid' => userid()))->find();
		$Market = M('Market')->where(array('status' => 1))->select();

		foreach ($Market as $k => $v) {
			$Market[$v['name']] = $v;
		}

		$cny['zj'] = 0;

/* 		foreach ($CoinList as $k => $v) {
			if ($v['name'] == 'cny') {
				$cny['ky'] = round($UserCoin[$v['name']], 2) * 1;
				$cny['dj'] = round($UserCoin[$v['name'] . 'd'], 2) * 1;
				$cny['zj'] = $cny['zj'] + $cny['ky'] + $cny['dj'];
			}
			else {
				if ($Market[$v['name'] . '_cny']['new_price']) {
					$jia = $Market[$v['name'] . '_cny']['new_price'];
				}
				else {
					$jia = 1;
				}

				$coinList[$v['name']] = array('name' => $v['name'], 'img' => $v['img'], 'title' => $v['title'] . '(' . strtoupper($v['name']) . ')', 'xnb' => round($UserCoin[$v['name']], 6) * 1, 'xnbd' => round($UserCoin[$v['name'] . 'd'], 6) * 1, 'xnbz' => round($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd'], 6), 'jia' => $jia * 1, 'zhehe' => round(($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia, 2));
				$cny['zj'] = round($cny['zj'] + (($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia), 2) * 1;
			}
		} */
		
		//20170514修改按类型统计
		
		
		foreach ($CoinList as $k => $v) {
			
			
			
			if ($v['name'] == 'cny') {
				$cny['ky'] = round($UserCoin[$v['name']], 2) * 1;
				$cny['dj'] = round($UserCoin[$v['name'] . 'd'], 2) * 1;
				$cny['zj'] = $cny['zj'] + $cny['ky'] + $cny['dj'];
			}
			else {
				
				if ($Market[C('market_type')[$v['name']]]['new_price']) {
					$jia = $Market[C('market_type')[$v['name']]]['new_price'];
					//echo $jia;
				}
				else {
					$jia = 1;
				}
				//开启市场时才显示对应的币
				if(in_array($v['name'],C('coin_on'))){
					$coinList[$v['name']] = array('name' => $v['name'], 'img' => $v['img'], 'title' => $v['title'] . '(' . strtoupper($v['name']) . ')', 'xnb' => round($UserCoin[$v['name']], 6) * 1, 'xnbd' => round($UserCoin[$v['name'] . 'd'], 6) * 1, 'xnbz' => round($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd'], 6), 'jia' => $jia * 1, 'zhehe' => round(($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia, 2));
				}
				$cny['zj'] = round($cny['zj'] + (($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia), 2) * 1;
			}
		}
		
		
		

		
		
		
		
		
		
		

		$this->assign('cny', $cny);
		$this->assign('coinList', $coinList);
		$this->assign('prompt_text', D('Text')->get_content('finance_index'));
		$this->display();
	}

	
	
	
	
	public function fhindex()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_fenhong'));
		$coin_list = D('Coin')->get_all_xnb_list_allow();

		foreach ($coin_list as $k => $v) {
			$list[$k]['img'] = D('Coin')->get_img($k);
			$list[$k]['title'] = $v;
			$list[$k]['quanbu'] = D('Coin')->get_sum_coin($k);
			$list[$k]['wodi'] = D('Coin')->get_sum_coin($k, userid());
			$list[$k]['bili'] = round(($list[$k]['wodi'] / $list[$k]['quanbu']) * 100, 2) . '%';
		}

		$this->assign('list', $list);
		$this->display();
	}
	
	
	
	
	public function myfhroebx()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_fenhong_log'));
		$where['userid'] = userid();
		$Model = M('FenhongLog');
		$count = $Model->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = $Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	
	
	
	
	public function bank(){
		if (!userid()) {
			redirect('/#login');
		}

		
		
		$UserBankType = M('UserBankType')->where(array('status' => 1))->order('id desc')->select();
		$this->assign('UserBankType', $UserBankType);
		
		
		//$truename = M('User')->where(array('id' => userid()))->getField('truename');
		$user = M('User')->where(array('id' => userid()))->find();
		
		if($user['idcardauth'] == 0){
			redirect('/user/nameauth');
		}
		
		$truename = $user['truename'];
		$this->assign('truename', $truename);
		//$UserBank = M('UserBank')->where(array('userid' => userid(), 'status' => 1))->order('id desc')->limit(1)->select();
		$UserBank = M('UserBank')->where(array('userid' => userid(), 'status' => 1))->order('id desc')->select();
		
		$this->assign('UserBank', $UserBank);
		$this->assign('prompt_text', D('Text')->get_content('user_bank'));
		$this->display();
	}
	
	
	public function upbank($name, $bank, $bankprov, $bankcity, $bankaddr, $bankcard, $paypassword)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($name, 'a')) {
			$this->error('备注名称格式错误！');
		}

		if (!check($bank, 'a')) {
			$this->error('开户银行格式错误！');
		} 
		
		if (!check($bankprov, 'c')) {
			$this->error('开户省市格式错误！');
		}

		if (!check($bankcity, 'c')) {
			$this->error('开户省市格式错误2！');
		}

		if (!check($bankaddr, 'a')) {
			$this->error('开户行地址格式错误！');
		}

		if (!check($bankcard, 'd')) {
			$this->error('银行账号格式错误！');
		}
		
		if(strlen($bankcard) < 16 || strlen($bankcard) > 19){
			
			$this->error('银行账号格式错误！');
			
		}
		
		

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$user_paypassword = M('User')->where(array('id' => userid()))->getField('paypassword');

		if (md5($paypassword) != $user_paypassword) {
			$this->error('交易密码错误！');
		}

 		if (!M('UserBankType')->where(array('title' => $bank))->find()) {
			$this->error('开户银行错误！');
		} 

		$userBank = M('UserBank')->where(array('userid' => userid()))->select();

 		foreach ($userBank as $k => $v) {
			if ($v['name'] == $name) {
				$this->error('请不要使用相同的备注名称！');
			}

			if ($v['bankcard'] == $bankcard) {
				$this->error('银行卡号已存在！');
			}
		} 

		if (10 <= count($userBank)) {
			$this->error('每个用户最多只能添加10个银行卡账户！');
		}

		if (M('UserBank')->add(array('userid' => userid(), 'name' => $name, 'bank' => $bank, 'bankprov' => $bankprov, 'bankcity' => $bankcity, 'bankaddr' => $bankaddr, 'bankcard' => $bankcard, 'addtime' => time(), 'status' => 1))) {
			$this->success('银行添加成功！');
		}
		else {
			$this->error('银行添加失败！');
		}
	}

	public function delbank($id, $paypassword)
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

		if (!M('UserBank')->where(array('userid' => userid(), 'id' => $id))->find()) {
			$this->error('非法访问！');
		}
		else if (M('UserBank')->where(array('userid' => userid(), 'id' => $id))->delete()) {
			$this->cairo_surface_create_similar(surface, content, width, height)s('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}
	
	
	
	
	
	
	
	public function mycz($status = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mycz'));
		$myczType = M('MyczType')->where(array('status' => 1))->select();

		foreach ($myczType as $k => $v) {
			$myczTypeList[$v['name']] = $v['title'];
		}

		$this->assign('myczTypeList', $myczTypeList);
		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
		$user_coin['cny'] = round($user_coin['cny'], 2);
		$user_coin['cnyd'] = round($user_coin['cnyd'], 2);
		$this->assign('user_coin', $user_coin);

		if (($status == 1) || ($status == 2) || ($status == 3) || ($status == 4)) {
			$where['status'] = $status - 1;
		}

		$this->assign('status', $status);
		$where['userid'] = userid();
		$count = M('Mycz')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Mycz')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['type'] = M('MyczType')->where(array('name' => $v['type']))->getField('title');
			$list[$k]['typeEn'] = $v['type'];
			$list[$k]['num'] = (Num($v['num']) ? Num($v['num']) : '');
			$list[$k]['mum'] = (Num($v['mum']) ? Num($v['mum']) : '');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function myczHuikuan($id = NULL)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$mycz = M('Mycz')->where(array('id' => $id))->find();

		if (!$mycz) {
			$this->error('充值订单不存在！');
		}

		if ($mycz['userid'] != userid()) {
			$this->error('非法操作！');
		}

		if ($mycz['status'] != 0) {
			$this->error('订单已经处理过！');
		}

		$rs = M('Mycz')->where(array('id' => $id))->save(array('status' => 3));

		if ($rs) {
			$this->success('操作成功');
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function myczChakan($id = NULL)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$mycz = M('Mycz')->where(array('id' => $id))->find();

		if (!$mycz) {
			$this->error('充值订单不存在！');
		}

		if ($mycz['userid'] != userid()) {
			$this->error('非法操作！');
		}

		if ($mycz['status'] != 0) {
			$this->error('订单已经处理过！');
		}

		$rs = M('Mycz')->where(array('id' => $id))->save(array('status' => 3));

		if ($rs) {
			$this->success('', array('id' => $id));
		}
		else {
			$this->error('操作失败！');
		}
	}

	public function myczUp($type, $num)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($type, 'n')) {
			$this->error('充值方式格式错误！');
		}

		if (!check($num, 'cny')) {
			$this->error('充值金额格式错误！');
		}

		$myczType = M('MyczType')->where(array('name' => $type))->find();

		if (!$myczType) {
			$this->error('充值方式不存在！');
		}

		if ($myczType['status'] != 1) {
			$this->error('充值方式没有开通！');
		}

		$mycz_min = ($myczType['min'] ? $myczType['min'] : 1);
		$mycz_max = ($myczType['max'] ? $myczType['max'] : 100000);

		if ($num < $mycz_min) {
			$this->error('充值金额不能小于' . $mycz_min . '元！');
		}

		if ($mycz_max < $num) {
			$this->error('充值金额不能大于' . $mycz_max . '元！');
		}

		for (; true; ) {
			$tradeno = tradeno();

			if (!M('Mycz')->where(array('tradeno' => $tradeno))->find()) {
				break;
			}
		}

		$mycz = M('Mycz')->add(array('userid' => userid(), 'num' => $num, 'type' => $type, 'tradeno' => $tradeno, 'addtime' => time(), 'status' => 0));

		if ($mycz) {
			$this->success('充值订单创建成功！', array('id' => $mycz));
		}
		else {
			$this->error('提现订单创建失败！');
		}
	}

	
	
	public function outlog($status = NULL){
		
		if (!userid()) {
			redirect('/#login');
		}
		
		$this->assign('prompt_text', D('Text')->get_content('finance_mytx'));
		
		
		if (($status == 1) || ($status == 2) || ($status == 3) || ($status == 4)) {
			$where['status'] = $status - 1;
		}
		$where['userid'] = userid();
		$count = M('Mytx')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Mytx')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['num'] = (Num($v['num']) ? Num($v['num']) : '');
			$list[$k]['fee'] = (Num($v['fee']) ? Num($v['fee']) : '');
			$list[$k]['mum'] = (Num($v['mum']) ? Num($v['mum']) : '');
		}
		$this->assign('status', $status);
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
		
	}
	
	
	
	
	
	
	
	
	
	
	public function mytx($status = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mytx'));
		$moble = M('User')->where(array('id' => userid()))->getField('moble');

		if ($moble) {
			$moble = substr_replace($moble, '****', 3, 4);
		}
		else {
			$this->error('请先认证手机！');
		}

		$this->assign('moble', $moble);
		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
		$user_coin['cny'] = round($user_coin['cny'], 2);
		$user_coin['cnyd'] = round($user_coin['cnyd'], 2);
		$this->assign('user_coin', $user_coin);
		$userBankList = M('UserBank')->where(array('userid' => userid(), 'status' => 1))->order('id desc')->limit(1)->select();
		$this->assign('userBankList', $userBankList);

		if (($status == 1) || ($status == 2) || ($status == 3) || ($status == 4)) {
			$where['status'] = $status - 1;
		}

		$this->assign('status', $status);
		$where['userid'] = userid();
		$count = M('Mytx')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('Mytx')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['num'] = (Num($v['num']) ? Num($v['num']) : '');
			$list[$k]['fee'] = (Num($v['fee']) ? Num($v['fee']) : '');
			$list[$k]['mum'] = (Num($v['mum']) ? Num($v['mum']) : '');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mytxUp($moble_verify, $num, $paypassword, $type)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($moble_verify, 'd')) {
			$this->error('短信验证码格式错误！');
		}

		if (!check($num, 'd')) {
			$this->error('提现金额格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		if (!check($type, 'd')) {
			$this->error('提现方式格式错误！');
		}

		if ($moble_verify != session('mytx_verify')) {
			$this->error('短信验证码错误！');
		} 

		$userCoin = M('UserCoin')->where(array('userid' => userid()))->find();

		if ($userCoin['cny'] < $num) {
			$this->error('可用人民币余额不足！');
		}

		$user = M('User')->where(array('id' => userid()))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}

		$userBank = M('UserBank')->where(array('id' => $type))->find();

		if (!$userBank) {
			$this->error('提现地址错误！');
		}

		$mytx_min = (C('mytx_min') ? C('mytx_min') : 1);
		$mytx_max = (C('mytx_max') ? C('mytx_max') : 1000000);
		$mytx_bei = C('mytx_bei');
		$mytx_fee = C('mytx_fee');

		if ($num < $mytx_min) {
			$this->error('每次提现金额不能小于' . $mytx_min . '元！');
		}

		if ($mytx_max < $num) {
			$this->error('每次提现金额不能大于' . $mytx_max . '元！');
		}

		if ($mytx_bei) {
			if ($num % $mytx_bei != 0) {
				$this->error('每次提现金额必须是' . $mytx_bei . '的整倍数！');
			}
		}

		$fee = round(($num / 100) * $mytx_fee, 2);
		$mum = round(($num / 100) * (100 - $mytx_fee), 2);
		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_mytx write , qq3479015851_user_coin write ,qq3479015851_finance write');
		$rs = array();
		$finance = $mo->table('qq3479015851_finance')->where(array('userid' => userid()))->order('id desc')->find();
		$finance_num_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec('cny', $num);
		$rs[] = $finance_nameid = $mo->table('qq3479015851_mytx')->add(array('userid' => userid(), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'name' => $userBank['name'], 'truename' => $user['truename'], 'bank' => $userBank['bank'], 'bankprov' => $userBank['bankprov'], 'bankcity' => $userBank['bankcity'], 'bankaddr' => $userBank['bankaddr'], 'bankcard' => $userBank['bankcard'], 'addtime' => time(), 'status' => 0));
		$finance_mum_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();
		$finance_hash = md5(userid() . $finance_num_user_coin['cny'] . $finance_num_user_coin['cnyd'] . $mum . $finance_mum_user_coin['cny'] . $finance_mum_user_coin['cnyd'] . MSCODE . 'auth.qq3479015851.com');
		$finance_num = $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'];

		if ($finance['mum'] < $finance_num) {
			$finance_status = (1 < ($finance_num - $finance['mum']) ? 0 : 1);
		}
		else {
			$finance_status = (1 < ($finance['mum'] - $finance_num) ? 0 : 1);
		}

		$rs[] = $mo->table('qq3479015851_finance')->add(array('userid' => userid(), 'coinname' => 'cny', 'num_a' => $finance_num_user_coin['cny'], 'num_b' => $finance_num_user_coin['cnyd'], 'num' => $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'], 'fee' => $num, 'type' => 2, 'name' => 'mytx', 'nameid' => $finance_nameid, 'remark' => '人民币提现-申请提现', 'mum_a' => $finance_mum_user_coin['cny'], 'mum_b' => $finance_mum_user_coin['cnyd'], 'mum' => $finance_mum_user_coin['cny'] + $finance_mum_user_coin['cnyd'], 'move' => $finance_hash, 'addtime' => time(), 'status' => $finance_status));

		if (check_arr($rs)) {
			session('mytx_verify', null);
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('提现订单创建成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('提现订单创建失败！');
		}
	}

	public function mytxChexiao($id)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$mytx = M('Mytx')->where(array('id' => $id))->find();

		if (!$mytx) {
			$this->error('提现订单不存在！');
		}

		if ($mytx['userid'] != userid()) {
			$this->error('非法操作！');
		}

		if ($mytx['status'] != 0) {
			$this->error('订单不能撤销！');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_mytx write,qq3479015851_finance write');
		$rs = array();
		$finance = $mo->table('qq3479015851_finance')->where(array('userid' => $mytx['userid']))->order('id desc')->find();
		$finance_num_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mytx['userid']))->find();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mytx['userid']))->setInc('cny', $mytx['num']);
		$rs[] = $mo->table('qq3479015851_mytx')->where(array('id' => $mytx['id']))->setField('status', 2);
		$finance_mum_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mytx['userid']))->find();
		$finance_hash = md5($mytx['userid'] . $finance_num_user_coin['cny'] . $finance_num_user_coin['cnyd'] . $mytx['num'] . $finance_mum_user_coin['cny'] . $finance_mum_user_coin['cnyd'] . MSCODE . 'auth.qq3479015851.com');
		$finance_num = $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'];

		if ($finance['mum'] < $finance_num) {
			$finance_status = (1 < ($finance_num - $finance['mum']) ? 0 : 1);
		}
		else {
			$finance_status = (1 < ($finance['mum'] - $finance_num) ? 0 : 1);
		}

		$rs[] = $mo->table('qq3479015851_finance')->add(array('userid' => $mytx['userid'], 'coinname' => 'cny', 'num_a' => $finance_num_user_coin['cny'], 'num_b' => $finance_num_user_coin['cnyd'], 'num' => $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'], 'fee' => $mytx['num'], 'type' => 1, 'name' => 'mytx', 'nameid' => $mytx['id'], 'remark' => '人民币提现-撤销提现', 'mum_a' => $finance_mum_user_coin['cny'], 'mum_b' => $finance_mum_user_coin['cnyd'], 'mum' => $finance_mum_user_coin['cny'] + $finance_mum_user_coin['cnyd'], 'move' => $finance_hash, 'addtime' => time(), 'status' => $finance_status));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('操作成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('操作失败！');
		}
	}

	//apply for cz_addr
	public function apply_cz_addr($coin = NULL){
		if (!userid()) {
			redirect('/#login');
		}
		// $userid = userid();
		if(IS_POST){
			if($coin){
				$UserCoin = M('UserCoin');
				$column = $coin.'_addr_cz';
				//check exit or not
				$u = $UserCoin->where(array('userid' => userid()))->find();
				if($u && !$u[$column]){
					$column = $coin.'_addr_cz';
					//$UserCoin = M('UserCoin');
					$data[$column] = '987654321';
					$line =$UserCoin->where(array('userid' => userid()))->save($data);
					if($line == 1){
						$reuslt['status'] = 1;
						$reuslt['address'] = '987654321';
						exit(json_encode($result));
					}else{
						$result['status'] = 0;
						exit(json_encode($result));
					}	
				}			
			}else{
				$result['status'] = 0;
				exit(json_encode($result));
			}
		}else{
			return;
		}
	}


	public function myzr($coin = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_myzr'));

		if (C('coin')[$coin]) {
			$coin = trim($coin);
		}
		else {
				//???
				$coin = C('xnb_mr');
		}

		$this->assign('xnb',	 $coin);	//tell me what coin 

		$Coin = M('Coin')->where(array(
			'status' => 1,
			'name'   => array('neq', 'cny')
			))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);


		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
		$user_coin[$coin] = round($user_coin[$coin], 6);//check
		$this->assign('user_coin', $user_coin);

		//cz address
		$this->assign('cz_addr',$coin.'_addr_cz');


		$Coin = M('Coin')->where(array('name' => $coin))->find();
		$this->assign('zr_jz', $Coin['zr_jz']);

		
		$qq3479015851_getCoreConfig = qq3479015851_getCoreConfig();
		if(!$qq3479015851_getCoreConfig){
			$this->error('核心配置有误');
		}

		$this->assign("qq3479015851_opencoin",$qq3479015851_getCoreConfig['qq3479015851_opencoin']);
		

		//pass
		if($qq3479015851_getCoreConfig['qq3479015851_opencoin'] == 1)
		{		
		
				if (!$Coin['zr_jz']) {
					$qianbao = '当前币种禁止转入！';
				}
				else {
					$qbdz = $coin . 'b';

					if (!$user_coin[$qbdz]) {
						if ($Coin['type'] == 'rgb') {
							$qianbao = md5(username() . $coin);
							$rs = M('UserCoin')->where(array('userid' => userid()))->save(array($qbdz => $qianbao));

							if (!$rs) {
								$this->error('生成钱包地址出错！');
							}
						}

						if ($Coin['type'] == 'qbb') {
							$dj_username = $Coin['dj_yh'];
							$dj_password = $Coin['dj_mm'];
							$dj_address = $Coin['dj_zj'];
							$dj_port = $Coin['dj_dk'];
							$CoinClient = CoinClient($dj_username, $dj_password, $dj_address, $dj_port, 5, array(), 1);
							$json = $CoinClient->getinfo();

							if (!isset($json['version']) || !$json['version']) {
								$this->error('钱包链接失败！');
							}

							$qianbao_addr = $CoinClient->getaddressesbyaccount(username());

							if (!is_array($qianbao_addr)) {
								$qianbao_ad = $CoinClient->getnewaddress(username());

								if (!$qianbao_ad) {
									$this->error('生成钱包地址出错1！');
								}
								else {
									$qianbao = $qianbao_ad;
								}
							}
							else {
								$qianbao = $qianbao_addr[0];
							}

							if (!$qianbao) {
								$this->error('生成钱包地址出错2！');
							}

							$rs = M('UserCoin')->where(array('userid' => userid()))->save(array($qbdz => $qianbao));

							if (!$rs) {
								$this->error('钱包地址添加出错3！');
							}
						}
					}
					else {
						$qianbao = $user_coin[$coin . 'b'];
					}
				}
		}else{
			
				if (!$Coin['zr_jz']) {
					$qianbao = '当前币种禁止转入！';
				}
				else {
					$qianbao = $Coin['qq3479015851_coinaddress'];
					
					$moble = M('User')->where(array('id' => userid()))->getField('moble');

					if ($moble) {
						$moble = substr_replace($moble, '****', 3, 4);
					}
					else {
						redirect(U('Home/User/moble'));
						exit();
					}

					$this->assign('moble', $moble);
					
					
					
				}
			
		}
		
		
		
		
		
		

		$this->assign('qianbao', $qianbao);
		$where['userid'] = userid();
		$where['coinname'] = $coin;
		$Moble = M('Myzr');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	
	
	public function qianbao($coin = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$Coin = M('Coin')->where(array(
			'status' => 1,
			'name'   => array('neq', 'cny')
			))->select();

		if (!$coin) {
			$coin = "";
		}

		$this->assign('xnb', $coin);

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);
		
		$where['userid'] = userid();
		$where['status'] = 1;
		if(!empty($coin)){
			$where['coinname'] = $coin;
		}
		
		
		$count = M('UserQianbao')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();

		$userQianbaoList = M('UserQianbao')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		$this->assign('page',$show);
		$this->assign('userQianbaoList', $userQianbaoList);
		$this->assign('prompt_text', D('Text')->get_content('user_qianbao'));
		$this->display();
	}

	public function upqianbao($coin, $name, $addr, $paypassword)
	{
		if (!userid()) {
			redirect('/#login');
		}

		if (!check($name, 'a')) {
			$this->error('备注名称格式错误！');
		}

		if (!check($addr, 'dw')) {
			$this->error('钱包地址格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$user_paypassword = M('User')->where(array('id' => userid()))->getField('paypassword');

		if (md5($paypassword) != $user_paypassword) {
			$this->error('交易密码错误！');
		}

		if (!M('Coin')->where(array('name' => $coin))->find()) {
			$this->error('币种错误！');
		}

		$userQianbao = M('UserQianbao')->where(array('userid' => userid(), 'coinname' => $coin))->select();

		foreach ($userQianbao as $k => $v) {
			if ($v['name'] == $name) {
				$this->error('请不要使用相同的钱包标识！');
			}

			if ($v['addr'] == $addr) {
				$this->error('钱包地址已存在！');
			}
		}

		if (10 <= count($userQianbao)) {
			$this->error('每个人最多只能添加10个地址！');
		}

		if (M('UserQianbao')->add(array('userid' => userid(), 'name' => $name, 'addr' => $addr, 'coinname' => $coin, 'addtime' => time(), 'status' => 1))) {
			$this->success('添加成功！');
		}
		else {
			$this->error('添加失败！');
		}
	}

	public function delqianbao($id, $paypassword)
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

		if (!M('UserQianbao')->where(array('userid' => userid(), 'id' => $id))->find()) {
			$this->error('非法访问！');
		}
		else if (M('UserQianbao')->where(array('userid' => userid(), 'id' => $id))->delete()) {
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}
	
	
	public function coinoutLog($coin = NULL){
		
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_myzc'));
		
		if (C('coin')[$coin]) {
			$coin = trim($coin);
		}
		else {
			$coin = C('xnb_mr');
		}

		$this->assign('xnb', $coin);
		$Coin = M('Coin')->where(array(
			'status' => 1,
			'name'   => array('neq', 'cny')
			))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);
		
		$where['userid'] = userid();
		$where['coinname'] = $coin;
		$Moble = M('Myzc');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
		
		
	}
	
	

	public function myzc($coin = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_myzc'));

		if (C('coin')[$coin]) {
			$coin = trim($coin);
		}
		else {
			$coin = C('xnb_mr');
		}

		$this->assign('xnb', $coin);
		$Coin = M('Coin')->where(array(
			'status' => 1,
			'name'   => array('neq', 'cny')
			))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);
		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
		$user_coin[$coin] = round($user_coin[$coin], 6);
		$this->assign('user_coin', $user_coin);

		if (!$coin_list[$coin]['zc_jz']) {
			$this->assign('zc_jz', '当前币种禁止转出！');
		}
		else {
			$userQianbaoList = M('UserQianbao')->where(array('userid' => userid(), 'status' => 1, 'coinname' => $coin))->order('id desc')->select();
			$this->assign('userQianbaoList', $userQianbaoList);
			$moble = M('User')->where(array('id' => userid()))->getField('moble');

			if ($moble) {
				$moble = substr_replace($moble, '****', 3, 4);
			}
			else {
				redirect(U('Home/User/moble'));
				exit();
			}

			$this->assign('moble', $moble);
		}

		$where['userid'] = userid();
		$where['coinname'] = $coin;
		$Moble = M('Myzc');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function upmyzc($coin, $num, $addr, $paypassword, $moble_verify)
	{
		if (!userid()) {
			$this->error('您没有登录请先登录！');
		}

		if (!check($moble_verify, 'd')) {
			$this->error('短信验证码格式错误！');
		}

		if ($moble_verify != session('myzc_verify')) {
			$this->error('短信验证码错误！');
		}

		$num = abs($num);

		if (!check($num, 'currency')) {
			$this->error('数量格式错误！');
		}

		if (!check($addr, 'dw')) {
			$this->error('钱包地址格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		if (!check($coin, 'n')) {
			$this->error('币种格式错误！');
		}

		if (!C('coin')[$coin]) {
			$this->error('币种错误！');
		}

		//this coin current info
		$Coin = M('Coin')->where(array('name' => $coin))->find();

		if (!$Coin) {
			$thisis->error('币种错误！');
		}

		//zc min max
		$myzc_min = ($Coin['zc_min'] ? abs($Coin['zc_min']) : 0.0001);
		$myzc_max = ($Coin['zc_max'] ? abs($Coin['zc_max']) : 10000000);

		if ($num < $myzc_min) {
			$this->error('转出数量超过系统最小限制！');
		}

		if ($myzc_max < $num) {
			$this->error('转出数量超过系统最大限制！');
		}

		//user info
		$user = M('User')->where(array('id' => userid()))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}

		//user's coin info
		$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();

		if ($user_coin[$coin] < $num) {
			$this->error('可用余额不足');
		}

		//what field ??
		$qbdz = $coin . 'b';

		//?? fee address
		$fee_user = M('UserCoin')->where(array($qbdz => $Coin['zc_user']))->find();

		if ($fee_user) {
			debug('手续费地址: ' . $Coin['zc_user'] . ' 存在,有手续费');
			$fee = round(($num / 100) * $Coin['zc_fee'], 8);
			$mum = round($num - $fee, 8);

			if ($mum < 0) {
				$this->error('转出手续费错误！');
			}

			if ($fee < 0) {
				$this->error('转出手续费设置错误！');
			}
		}
		else {
			debug('手续费地址: ' . $Coin['zc_user'] . ' 不存在,无手续费');
			$fee = 0;
			$mum = $num;
		}
		

		if ($Coin['type'] == 'rgb') {
			debug($Coin, '开始认购币转出');
			$peer = M('UserCoin')->where(array($qbdz => $addr))->find();

			if (!$peer) {
				$this->error('转出认购币地址不存在！');
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_myzc write  , qq3479015851_myzr write , qq3479015851_myzc_fee write');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($coin, $num);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $peer['userid']))->setInc($coin, $mum);

			if ($fee) {
				if ($mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->find()) {
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->setInc($coin, $fee);
					debug(array('msg' => '转出收取手续费' . $fee), 'fee');
				}
				else {
					$rs[] = $mo->table('qq3479015851_user_coin')->add(array($qbdz => $Coin['zc_user'], $coin => $fee));
					debug(array('msg' => '转出收取手续费' . $fee), 'fee');
				}
			}

			$rs[] = $mo->table('qq3479015851_myzc')->add(array('userid' => userid(), 'username' => $addr, 'coinname' => $coin, 'txid' => md5($addr . $user_coin[$coin . 'b'] . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
			$rs[] = $mo->table('qq3479015851_myzr')->add(array('userid' => $peer['userid'], 'username' => $user_coin[$coin . 'b'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $addr . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));

			if ($fee_user) {
				$rs[] = $mo->table('qq3479015851_myzc_fee')->add(array('userid' => $fee_user['userid'], 'username' => $Coin['zc_user'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $Coin['zc_user'] . time()), 'num' => $num, 'fee' => $fee, 'type' => 1, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
			}

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				session('myzc_verify', null);
				$this->success('转账成功！');
			}
			else {
				$mo->execute('rollback');
				$this->error('转账失败!');
			}
		}

		if ($Coin['type'] == 'qbb') {
				$mo = M();

			if ($mo->table('qq3479015851_user_coin')->where(array($qbdz => $addr))->find()) {
				$peer = M('UserCoin')->where(array($qbdz => $addr))->find();

				if (!$peer) {
					$this->error('转出地址不存在！');
				}

				$mo = M();
				$mo->execute('set autocommit=0');
				$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_myzc write  , qq3479015851_myzr write , qq3479015851_myzc_fee write');
				$rs = array();
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($coin, $num);
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $peer['userid']))->setInc($coin, $mum);

				if ($fee) {
					if ($mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->find()) {
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->setInc($coin, $fee);
					}
					else {
						$rs[] = $mo->table('qq3479015851_user_coin')->add(array($qbdz => $Coin['zc_user'], $coin => $fee));
					}
				}

				$rs[] = $mo->table('qq3479015851_myzc')->add(array('userid' => userid(), 'username' => $addr, 'coinname' => $coin, 'txid' => md5($addr . $user_coin[$coin . 'b'] . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
				$rs[] = $mo->table('qq3479015851_myzr')->add(array('userid' => $peer['userid'], 'username' => $user_coin[$coin . 'b'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $addr . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));

				if ($fee_user) {
					$rs[] = $mo->table('qq3479015851_myzc_fee')->add(array('userid' => $fee_user['userid'], 'username' => $Coin['zc_user'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $Coin['zc_user'] . time()), 'num' => $num, 'fee' => $fee, 'type' => 1, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
				}

				if (check_arr($rs)) {
					$mo->execute('commit');
					$mo->execute('unlock tables');
					session('myzc_verify', null);
					$this->success('转账成功！');
				}
				else {
					$mo->execute('rollback');
					$this->error('转账失败!');
				}
			}
			else {
				$dj_username = $Coin['dj_yh'];
				$dj_password = $Coin['dj_mm'];
				$dj_address = $Coin['dj_zj'];
				$dj_port = $Coin['dj_dk'];
				$CoinClient = CoinClient($dj_username, $dj_password, $dj_address, $dj_port, 5, array(), 1);
				$json = $CoinClient->getinfo();

				if (!isset($json['version']) || !$json['version']) {
					$this->error('钱包链接失败！');
				}

				$valid_res = $CoinClient->validateaddress($addr);

				if (!$valid_res['isvalid']) {
					$this->error($addr . '不是一个有效的钱包地址！');
				}

				$auto_status = ($Coin['zc_zd'] && ($num < $Coin['zc_zd']) ? 1 : 0);

				if ($json['balance'] < $num) {
					$this->error('钱包余额不足');
				}

				$mo = M();
				$mo->execute('set autocommit=0');
				$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_myzc write ,qq3479015851_myzr write, qq3479015851_myzc_fee write');
				$rs = array();
				$rs[] = $r = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($coin, $num);
				$rs[] = $aid = $mo->table('qq3479015851_myzc')->add(array('userid' => userid(), 'username' => $addr, 'coinname' => $coin, 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => $auto_status));

				if ($fee && $auto_status) {
					$rs[] = $mo->table('qq3479015851_myzc_fee')->add(array('userid' => $fee_user['userid'], 'username' => $Coin['zc_user'], 'coinname' => $coin, 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'type' => 2, 'addtime' => time(), 'status' => 1));

					if ($mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->find()) {
						$rs[] = $r = $mo->table('qq3479015851_user_coin')->where(array($qbdz => $Coin['zc_user']))->setInc($coin, $fee);
						debug(array('res' => $r, 'lastsql' => $mo->table('qq3479015851_user_coin')->getLastSql()), '新增费用');
					}
					else {
						$rs[] = $r = $mo->table('qq3479015851_user_coin')->add(array($qbdz => $Coin['zc_user'], $coin => $fee));
					}
				}

				if (check_arr($rs)) {
					if ($auto_status) {
						$mo->execute('commit');
						$mo->execute('unlock tables');
						$sendrs = $CoinClient->sendtoaddress($addr, floatval($mum));

						if ($sendrs) {
							$flag = 1;
							$arr = json_decode($sendrs, true);

							if (isset($arr['status']) && ($arr['status'] == 0)) {
								$flag = 0;
							}
						}
						else {
							$flag = 0;
						}

						if (!$flag) {
							$this->error('钱包服务器转出币失败,请手动转出');
						}
						else {
							$this->success('转出成功!');
						}
					}

					if ($auto_status) {
						$mo->execute('commit');
						$mo->execute('unlock tables');
						session('myzc_verify', null);
						$this->success('转出成功!');
					}
					else {
						$mo->execute('commit');
						$mo->execute('unlock tables');
						session('myzc_verify', null);
						$this->success('转出申请成功,请等待审核！');
					}
				}
				else {
					$mo->execute('rollback');
					$this->error('转出失败!');
				}
			}
		}
	}
	
	
	
	
	
	
	public function upmyzr($coin,$qq3479015851_dzbz,$num, $paypassword, $moble_verify)
	{
		if (!userid()) {
			$this->error('您没有登录请先登录！');
		}

		if (!check($moble_verify, 'd')) {
			$this->error('短信验证码格式错误！');
		}

		if ($moble_verify != session('myzr_verify')) {
			$this->error('短信验证码错误！');
		}

		$num = abs($num);

		if (!check($num, 'currency')) {
			$this->error('数量格式错误！');
		}

		

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		if (!check($coin, 'n')) {
			$this->error('币种格式错误！');
		}

		if (!C('coin')[$coin]) {
			$this->error('币种错误！');
		}

		$Coin = M('Coin')->where(array('name' => $coin))->find();

		if (!$Coin) {
			$this->error('币种错误！');
		}


		$user = M('User')->where(array('id' => userid()))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}
		
		$qq3479015851_zrcoinaddress = $Coin['qq3479015851_coinaddress'];

		if ($Coin['type'] == 'rgb') {

			M('myzr')->add(array('userid' => userid(), 'username'=>$qq3479015851_dzbz,'txid'=>$qq3479015851_zrcoinaddress,'coinname' => $coin, 'num' => $num, 'mum' =>0, 'addtime' => time(), 'status' =>0));

			$this->success('转入申请成功,等待客服处理！');

		}else{
			$this->error("钱包币不允许该操作!");
		}

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	public function mywt($market = NULL, $type = NULL, $status = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mywt'));
		check_server();
		$Coin = M('Coin')->where(array('status' => 1))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);
		$Market = M('Market')->where(array('status' => 1))->select();

		foreach ($Market as $k => $v) {
			$v['xnb'] = explode('_', $v['name'])[0];
			$v['rmb'] = explode('_', $v['name'])[1];
			$market_list[$v['name']] = $v;
		}

		$this->assign('market_list', $market_list);

		if (!$market_list[$market]) {
			$market = $Market[0]['name'];
		}

		$where['market'] = $market;

		if (($type == 1) || ($type == 2)) {
			$where['type'] = $type;
		}

		if (($status == 1) || ($status == 2) || ($status == 3)) {
			$where['status'] = $status - 1;
		}

		$where['userid'] = userid();
		$this->assign('market', $market);
		$this->assign('type', $type);
		$this->assign('status', $status);
		$Moble = M('Trade');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$Page->parameter .= 'type=' . $type . '&status=' . $status . '&market=' . $market . '&';
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['num'] = $v['num'] * 1;
			$list[$k]['price'] = $v['price'] * 1;
			$list[$k]['deal'] = $v['deal'] * 1;
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mycj($market = NULL, $type = NULL)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mycj'));
		check_server();
		$Coin = M('Coin')->where(array('status' => 1))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$this->assign('coin_list', $coin_list);
		$Market = M('Market')->where(array('status' => 1))->select();

		foreach ($Market as $k => $v) {
			$v['xnb'] = explode('_', $v['name'])[0];
			$v['rmb'] = explode('_', $v['name'])[1];
			$market_list[$v['name']] = $v;
		}

		$this->assign('market_list', $market_list);

		if (!$market_list[$market]) {
			$market = $Market[0]['name'];
		}

		if ($type == 1) {
			$where = 'userid=' . userid() . ' && market=\'' . $market . '\'';
		}
		else if ($type == 2) {
			$where = 'peerid=' . userid() . ' && market=\'' . $market . '\'';
		}
		else {
			$where = '((userid=' . userid() . ') || (peerid=' . userid() . ')) && market=\'' . $market . '\'';
		}

		$this->assign('market', $market);
		$this->assign('type', $type);
		$this->assign('userid', userid());
		$Moble = M('TradeLog');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$Page->parameter .= 'type=' . $type . '&market=' . $market . '&';
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['num'] = $v['num'] * 1;
			$list[$k]['price'] = $v['price'] * 1;
			$list[$k]['mum'] = $v['mum'] * 1;
			$list[$k]['fee_buy'] = $v['fee_buy'] * 1;
			$list[$k]['fee_sell'] = $v['fee_sell'] * 1;
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mytj()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mytj'));
		check_server();
		$user = M('User')->where(array('id' => userid()))->find();

		if (!$user['invit']) {
			for (; true; ) {
				$tradeno = tradenoa();

				if (!M('User')->where(array('invit' => $tradeno))->find()) {
					break;
				}
			}

			M('User')->where(array('id' => userid()))->save(array('invit' => $tradeno));
			$user = M('User')->where(array('id' => userid()))->find();
		}

		$this->assign('user', $user);
		$this->display();
	}

	public function mywd()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_mywd'));
		check_server();
		$where['invit_1'] = userid();
		$Model = M('User');
		$count = $Model->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Model->where($where)->order('id asc')->field('id,username,moble,addtime,invit_1')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		
		foreach ($list as $k => $v) {
			$list[$k]['invits'] = M('User')->where(array('invit_1' => $v['id']))->order('id asc')->field('id,username,moble,addtime,invit_1')->select();
			$list[$k]['invitss'] = count($list[$k]['invits']);

			foreach ($list[$k]['invits'] as $kk => $vv) {
				$list[$k]['invits'][$kk]['invits'] = M('User')->where(array('invit_1' => $vv['id']))->order('id asc')->field('id,username,moble,addtime,invit_1')->select();
				$list[$k]['invits'][$kk]['invitss'] = count($list[$k]['invits'][$kk]['invits']);
			}
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function myjp()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_myjp'));
		check_server();
		$where['userid'] = userid();
		$Model = M('Invit');
		$count = $Model->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['invit'] = M('User')->where(array('id' => $v['invit']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	
	public function myaward()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('finance_myaward'));
		//check_server();
		$where['userid'] = userid();
		$Model = M('UserAward');
		$count = $Model->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = $Model->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	

}

?>