<?php
namespace Mapi\Controller;

class UserController extends CommonController
{
	public function userinfo()
	{
		$ret = array();
		$uid = $this->userid();
		$ret['baseinfo'] = M('User')->where(array('id' => $uid))->find();
		$CoinList = M('Coin')->where(array('status' => 1))->select();
		$UserCoin = M('UserCoin')->where(array('userid' => $uid))->find();
		$Market = M('Market')->where(array('status' => 1))->select();

		$market_type = array();	
		foreach ($Market as $k => $v) {
			$Market[$v['name']] = $v;
			$keykey = explode('_', $v['name'])[0];
			$market_type[$keykey]=$v['name'];
		}

		$cny['zj'] = 0;

		foreach ($CoinList as $k => $v) {
			if ($v['name'] == 'cny') {
				$cny['ky'] = $UserCoin[$v['name']] * 1;
				$cny['dj'] = $UserCoin[$v['name'] . 'd'] * 1;
				$cny['zj'] = $cny['zj'] + $cny['ky'] + $cny['dj'];
			}
			else {
				
				$curMarketType = $market_type[$v['name']];
				
				if (isset($Market[$curMarketType])) {
					$jia = $Market[$curMarketType]['new_price'];
					$marketid = $Market[$curMarketType]['id'];
				}
				else {
					$jia = 1;
					$marketid = 0;
				}

				$coinList[] = array('id' => $marketid, 'name' => $v['name'], 'ico' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/Upload/coin/' . $v['img'], 'title' => $v['title'] . '(' . strtoupper($v['name']) . ')', 'xnb' => round($UserCoin[$v['name']] * 1, 4), 'xnbd' => round($UserCoin[$v['name'] . 'd'] * 1, 4), 'xnbz' => round($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd'], 4), 'jia' => $jia * 1, 'zhehe' => round(($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia, 4));
				$cny['zj'] = $cny['zj'] + (round(($UserCoin[$v['name']] + $UserCoin[$v['name'] . 'd']) * $jia, 4) * 1);
			}
		}

		$ret['coin']['cny'] = $cny;
		$ret['coin']['coinList'] = $coinList;
		$this->ajaxShow($ret);
	}

	public function bank()
	{
		$uid = $this->userid();
		$truename = M('User')->where(array('id' => $uid))->getField('truename');
		$UserBank = M('UserBank')->where(array('userid' => $uid, 'status' => 1))->order('id desc')->select();

		foreach ($UserBank as $key => $val) {
			$UserBank[$key]['truename'] = $truename . rand(0, 100);
			$UserBank[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($UserBank);
	}

	public function upbank($name, $bank, $bankprov, $bankcity, $bankaddr, $bankcard)
	{
		$uid = $this->userid();

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

		if (!M('UserBankType')->where(array('title' => $bank))->find()) {
			$this->error('开户银行错误！');
		}

		$userBank = M('UserBank')->where(array('userid' => $uid))->select();

		foreach ($userBank as $k => $v) {
			if ($v['name'] == $name) {
				$this->error('请不要使用相同的备注名称！');
			}

			if ($v['bankcard'] == $bankcard) {
				$this->error('银行卡号已存在！');
			}
		}

		if (10 <= count($userBank)) {
			$this->error('每个用户最多只能添加10个地址！');
		}

		if (M('UserBank')->add(array('userid' => $uid, 'name' => $name, 'bank' => $bank, 'bankprov' => $bankprov, 'bankcity' => $bankcity, 'bankaddr' => $bankaddr, 'bankcard' => $bankcard, 'addtime' => time(), 'status' => 1))) {
			$this->success('银行添加成功！');
		}
		else {
			$this->error('银行添加失败！');
		}
	}

	public function delbank($id)
	{
		$uid = $this->userid();

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		$Bank = M('UserBank')->where(array('userid' => $uid, 'id' => $id))->find();

		if (!$Bank) {
			$this->error('非法访问！');
		}
		else if (M('UserBank')->where(array('id' => $id))->delete()) {
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}

	public function mybank()
	{
		$ret = array();
		$uid = $this->userid();
		$ret['id'] = $uid;
		$user = M('User')->where(array('id' => $uid))->field('moble')->find();
		$ret['moble'] = $user['moble'];
		$user_coin = M('UserCoin')->where(array('userid' => $uid))->field('cny')->find();
		$ret['cny'] = $user_coin['cny'] * 1;
		$userBankList = M('UserBank')->where(array('userid' => $uid, 'status' => 1))->order('id desc')->select();

		foreach ($userBankList as $key => $val) {
			$userBankList[$key]['show'] = $val['name'] . '(尾号:' . substr($val['bankcard'], -4) . ')';
		}

		$ret['userBankList'] = $userBankList;
		$this->ajaxShow($ret);
	}

	public function sendMoble()
	{
		$uid = $this->userid();
		$user = M('User')->where(array('id' => $uid))->field('moble')->find();
		$ret['moble'] = $user['moble'];
		$code = rand(1000, 9999);
		S('sendMobile_code_' . $ret['moble'], $code);
		S('sendMobile_moble_' . $ret['moble'], $ret['moble']);
		$this->success('验证码已发送到:' . $ret['moble'] . '(' . $code . ')');
	}

	public function upmytx($moble_verify, $num, $paypassword, $type)
	{
		$uid = $this->userid();
		$user = M('User')->where(array('id' => $uid))->field('moble')->find();
		$code = S('sendMobile_code_' . $user['moble']);

		if ($moble_verify != $code) {
			$this->error('短信验证码错误！');
		}
		else {
			S('sendMobile_code_' . $user['moble'], null);
		}

		if (!check($num, 'd')) {
			$this->error('提现金额格式错误！');
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

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$userBank = M('UserBank')->where(array('id' => $type))->find();

		if (!$userBank) {
			$this->error('提现地址错误！');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}

		$cny = M('UserCoin')->where(array('userid' => $uid))->getField('cny');

		if ($cny < $num) {
			$this->error('可用人民币余额不足！');
		}

		$fee = round(($num / 100) * $mytx_fee, 2);
		$mum = round(($num / 100) * (100 - $mytx_fee), 2);
		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_mytx write , qq3479015851_user_coin  write ');
		$rs = array();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec('cny', $num);
		$rs[] = $mo->table('qq3479015851_mytx')->add(array('userid' => $uid, 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'name' => $userBank['name'], 'truename' => $user['truename'], 'bank' => $userBank['bank'], 'bankprov' => $userBank['bankprov'], 'bankcity' => $userBank['bankcity'], 'bankaddr' => $userBank['bankaddr'], 'bankcard' => $userBank['bankcard'], 'addtime' => time(), 'status' => 0));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('提现订单创建成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('提现订单创建失败！');
		}
	}

	public function mytx_log()
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$limit = 5;
		$id = $this->userid();
		$list = M('Mytx')->where(array('userid = ' . $id))->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			$this->ajaxShow('没有更多了', 0);
		}

		foreach ($list as $key => $val) {
			$list[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($list);
	}

	public function upmycz($type, $num)
	{
		$id = $this->userid();

		if (!check($type, 'n')) {
			$this->error('充值方式格式错误！');
		}

		$myczType = M('MyczType')->where(array('status' => 1))->select();

		foreach ($myczType as $k => $v) {
			$myczTypeList[$v['name']] = $v['title'];
		}

		if (!$myczTypeList[$type]) {
			$this->error('充值方式错误！');
		}

		if (!check($num, 'cny')) {
			$this->error('充值金额格式错误！');
		}

		$mycz_min = (C('mycz_min') ? C('mycz_min') : 1);
		$mycz_max = (C('mycz_max') ? C('mycz_max') : 100000);

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

		$time = time();
		$mycz = M('Mycz')->add(array('userid' => $id, 'num' => $num, 'type' => $type, 'tradeno' => $tradeno, 'addtime' => $time, 'status' => 0));

		if ($mycz) {
			$this->success(array('time' => addtime($time), 'data' => '充值订单创建成功！', 'tradeno' => $tradeno, 'type' => $type, 'num' => $num));
		}
		else {
			$this->error('提现订单创建失败！');
		}
	}

	public function mycz_log()
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$limit = 5;
		$id = $this->userid();
		$list = M('Mycz')->where(array('userid = ' . $id))->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			if ($pid == 1) {
				$this->ajaxShow('没有记录', 0);
			}
			else {
				$this->ajaxShow('没有更多了', 0);
			}
		}

		foreach ($list as $key => $val) {
			$list[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($list);
	}

	public function myzr($coin_id)
	{
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$uid = $this->userid();
		$user_coin = M('UserCoin')->where(array('userid' => $uid))->find();
		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$coin = $CoinArr['name'];

		if (!$CoinArr['zr_jz']) {
			$this->error('当前币种禁止转入！');
		}
		else {
			$qbdz = $coin . 'b';

			if (!$user_coin[$qbdz]) {
				if ($CoinArr['type'] == 'rgb') {
					$qianbao = md5(md5(rand(0, 10000)) . $coin);
					$rs = M('UserCoin')->where(array('userid' => $uid))->save(array($qbdz => $qianbao));

					if (!$rs) {
						$this->error('生成钱包地址出错！');
					}
				}

				if ($CoinArr['type'] == 'qbb') {
					$dj_username = $CoinArr['dj_yh'];
					$dj_password = $CoinArr['dj_mm'];
					$dj_address = $CoinArr['dj_zj'];
					$dj_port = $CoinArr['dj_dk'];
					$CoinArrClient = CoinClient($dj_username, $dj_password, $dj_address, $dj_port, 5, array(), 1);
					$json = $CoinArrClient->getinfo();

					if (!isset($json['version']) || !$json['version']) {
						$this->error('钱包链接失败！');
					}

					$qianbao_addr = $CoinArrClient->getaddressesbyaccount(username());

					if (!is_array($qianbao_addr)) {
						$qianbao_ad = $CoinArrClient->getnewaddress(username());

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

					$rs = M('UserCoin')->where(array('userid' => $uid))->save(array($qbdz => $qianbao));

					if (!$rs) {
						$this->error('钱包地址添加出错3！');
					}
				}
			}
			else {
				$qianbao = $user_coin[$coin . 'b'];
			}
		}

		$this->ajaxShow(array(
			'type'    => $CoinArr['type'] == 'rgb' ? '认购币' : '钱包币',
			'confirm' => (int) $CoinArr['zr_dz'],
			'coin'    => array('num' => NumToStr($user_coin[$coin]), 'fnum' => NumToStr($user_coin[$coin . 'd'])),
			'addr'    => $qianbao
			));
	}

	public function myzr_log($coin_id)
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$limit = 5;
		$id = $this->userid();
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$list = M('Myzr')->where(array('userid = ' . $id . ' and coinname = \'' . $CoinArr['name'] . '\''))->order('id desc')->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			if ($pid == 1) {
				$this->ajaxShow('没有记录', 0);
			}
			else {
				$this->ajaxShow('没有更多了', 0);
			}
		}

		$ret = array();

		foreach ($list as $key => $val) {
			$ret[$key]['id'] = $val['id'];
			$ret[$key]['addr'] = $val['username'];
			$ret[$key]['txid'] = $val['txid'];
			$ret[$key]['num'] = NumToStr($val['num']);
			$ret[$key]['mum'] = NumToStr($val['mum']);
			$ret[$key]['fee'] = NumToStr($val['fee']);
			$ret[$key]['status'] = $val['status'];
			$ret[$key]['status_str'] = ($val['status'] == 1 ? '转入成功' : '还需' . abs($val['status']) . '确认');
			$ret[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($ret);
	}

	public function myzc($coin_id)
	{
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$uid = $this->userid();
		$user_coin = M('UserCoin')->where(array('userid' => $uid))->find();
		$Coin = M('Coin')->where(array(
			'status' => 1,
			'name'   => array('neq', 'cny')
			))->select();

		foreach ($Coin as $k => $v) {
			$coin_list[$v['name']] = $v;
		}

		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$coin = $CoinArr['name'];

		if (!$coin_list[$coin]['zc_jz']) {
			$this->assign('zc_jz', '当前币种禁止转出！');
		}
		else {
			$userQianbaoList = M('UserQianbao')->where(array('userid' => $uid, 'status' => 1, 'coinname' => $coin))->order('id desc')->select();
			$moble = M('User')->where(array('id' => $uid))->getField('moble');

			if ($moble) {
				$moble = substr_replace($moble, '****', 3, 4);
			}
			else {
				$moble = '';
			}
		}

		$this->ajaxShow(array(
			'coin'  => array('num' => NumToStr($user_coin[$coin]), 'fnum' => NumToStr($user_coin[$coin . 'd'])),
			'addr'  => $userQianbaoList,
			'moble' => $moble
			));
	}

	public function upmyzc($coin_id, $moble_verify, $num, $paypassword, $addr)
	{
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$coin = $CoinArr['name'];
		$uid = $this->userid();
		$user = M('User')->where(array('id' => $uid))->field('moble')->find();
		$code = S('sendMobile_code_' . $user['moble']);

		if ($moble_verify != $code) {
			$this->error('短信验证码错误！');
		}
		else {
			S('sendMobile_code_' . $user['moble'], null);
		}

		$num = abs($num);

		if (!check($num, 'currency')) {
			$this->error('数量格式错误！');
		}

		if (!check($addr, 'dw')) {
			$this->error('钱包选择错误！');
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

		$myzc_min = ($Coin['zc_min'] ? abs($Coin['zc_min']) : 0.0001);
		$myzc_max = ($Coin['zc_max'] ? abs($Coin['zc_max']) : 10000000);

		if ($num < $myzc_min) {
			$this->error('转出数量超过系统最小限制！');
		}

		if ($myzc_max < $num) {
			$this->error('转出数量超过系统最大限制！');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}

		$user_coin = M('UserCoin')->where(array('userid' => $uid))->find();

		if ($user_coin[$coin] < $num) {
			$this->error('可用余额不足');
		}

		$qbdz = $coin . 'b';
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
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($coin, $num);
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

			$rs[] = $mo->table('qq3479015851_myzc')->add(array('userid' => $uid, 'username' => $addr, 'coinname' => $coin, 'txid' => md5($addr . $user_coin[$coin . 'b'] . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
			$rs[] = $mo->table('qq3479015851_myzr')->add(array('userid' => $peer['userid'], 'username' => $user_coin[$coin . 'b'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $addr . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));

			if ($fee_user) {
				$rs[] = $mo->table('qq3479015851_myzc_fee')->add(array('userid' => $fee_user['userid'], 'username' => $Coin['zc_user'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $Coin['zc_user'] . time()), 'num' => $num, 'fee' => $fee, 'type' => 1, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
			}

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->success('转账成功！');
			}
			else {
				$mo->execute('rollback');
				debug(implode('|', $rs), '失败');
				$this->error('转账失败!');
			}
		}

		if ($Coin['type'] == 'qbb') {
			$mo = M();

			if ($mo->table('qq3479015851_user_coin')->where(array($qbdz => $addr))->find()) {
				debug($Coin, '开始钱包币站内转出');
				$peer = M('UserCoin')->where(array($qbdz => $addr))->find();

				if (!$peer) {
					$this->error('转出地址不存在！');
				}

				$mo = M();
				$mo->execute('set autocommit=0');
				$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_myzc write  , qq3479015851_myzr write , qq3479015851_myzc_fee write');
				$rs = array();
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($coin, $num);
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

				$rs[] = $mo->table('qq3479015851_myzc')->add(array('userid' => $uid, 'username' => $addr, 'coinname' => $coin, 'txid' => md5($addr . $user_coin[$coin . 'b'] . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
				$rs[] = $mo->table('qq3479015851_myzr')->add(array('userid' => $peer['userid'], 'username' => $user_coin[$coin . 'b'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $addr . time()), 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => 1));

				if ($fee_user) {
					$rs[] = $mo->table('qq3479015851_myzc_fee')->add(array('userid' => $fee_user['userid'], 'username' => $Coin['zc_user'], 'coinname' => $coin, 'txid' => md5($user_coin[$coin . 'b'] . $Coin['zc_user'] . time()), 'num' => $num, 'fee' => $fee, 'type' => 1, 'mum' => $mum, 'addtime' => time(), 'status' => 1));
				}

				if (check_arr($rs)) {
					$mo->execute('commit');
					$mo->execute('unlock tables');
					$this->success('转账成功！');
				}
				else {
					$mo->execute('rollback');
					debug(implode('|', $rs), '失败');
					$this->error('转账失败!');
				}
			}
			else {
				debug($Coin, '开始钱包币站外转出');
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
				debug(array('zc_zd' => $Coin['zc_zd'], 'mum' => $mum, 'auto_status' => $auto_status), '是否需要审核');

				if ($json['balance'] < $num) {
					$this->error('钱包余额不足');
				}

				$mo = M();
				$mo->execute('set autocommit=0');
				$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_myzc write ,qq3479015851_myzr write, qq3479015851_myzc_fee write');
				$rs = array();
				$rs[] = $r = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($coin, $num);
				debug(array('res' => $r, 'lastsql' => $mo->table('qq3479015851_user_coin')->getLastSql()), '更新用户人民币');
				$rs[] = $aid = $mo->table('qq3479015851_myzc')->add(array('userid' => $uid, 'username' => $addr, 'coinname' => $coin, 'num' => $num, 'fee' => $fee, 'mum' => $mum, 'addtime' => time(), 'status' => $auto_status));

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

				debug(array('res' => $r, 'lastsql' => $mo->table('qq3479015851_myzc')->getLastSql()), '转出记录');

				if (check_arr($rs)) {
					if ($auto_status) {
						$sendrs = $CoinClient->sendtoaddress($addr, $mum);

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
							$mo->execute('rollback');
							$mo->execute('unlock tables');
							$this->error('钱包服务器转出币失败!');
						}
					}

					if ($auto_status) {
						$mo->execute('commit');
						$mo->execute('unlock tables');
						$this->success('转出成功!');
					}
					else {
						$mo->execute('commit');
						$mo->execute('unlock tables');
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

	public function myzc_log($coin_id)
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$limit = 5;
		$uid = $this->userid();
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$list = M('Myzc')->where(array('userid = ' . $uid . ' and coinname = \'' . $CoinArr['name'] . '\''))->order('id desc')->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			if ($pid == 1) {
				$this->ajaxShow('没有记录', 0);
			}
			else {
				$this->ajaxShow('没有更多了', 0);
			}
		}

		$ret = array();

		foreach ($list as $key => $val) {
			$ret[$key]['id'] = $val['id'];
			$ret[$key]['addr'] = $val['username'];
			$ret[$key]['txid'] = $val['txid'];
			$ret[$key]['num'] = NumToStr($val['num']);
			$ret[$key]['mum'] = NumToStr($val['mum']);
			$ret[$key]['fee'] = NumToStr($val['fee']);
			$ret[$key]['status'] = $val['status'];
			$ret[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($ret);
	}

	public function qianbao_addr($coin_id)
	{
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$id = $this->userid();
		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$userQianbaoList = M('UserQianbao')->where(array('userid' => $id, 'status' => 1, 'coinname' => $CoinArr['name']))->order('id desc')->select();

		foreach ($userQianbaoList as $key => $val) {
			$userQianbaoList[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($userQianbaoList);
	}

	public function upqianbao($coin_id, $name, $addr, $paypassword)
	{
		$coin_id = (int) $coin_id;

		if (!$coin_id) {
			$this->error('coin_id 错误');
		}

		$uid = $this->userid();
		$CoinArr = M('Coin')->where(array('id' => $coin_id))->find();
		$coin = $CoinArr['name'];

		if (!check($name, 'a')) {
			$this->error('备注名称格式错误！');
		}

		if (!check($addr, 'dw')) {
			$this->error('钱包地址格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$user_paypassword = M('User')->where(array('id' => $uid))->getField('paypassword');

		if (md5($paypassword) != $user_paypassword) {
			$this->error('交易密码错误！');
		}

		if (!M('Coin')->where(array('name' => $coin))->find()) {
			$this->error('币种错误！');
		}

		$userQianbao = M('UserQianbao')->where(array('userid' => $uid, 'coinname' => $coin))->select();

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

		if (M('UserQianbao')->add(array('userid' => $uid, 'name' => $name, 'addr' => $addr, 'coinname' => $coin, 'addtime' => time(), 'status' => 1))) {
			$this->success('添加成功！');
		}
		else {
			$this->error('添加失败！');
		}
	}

	public function delqianbao($id)
	{
		$uid = $this->userid();

		if (!check($id, 'd')) {
			$this->error('参数错误！');
		}

		if (!M('UserQianbao')->where(array('userid' => $uid, 'id' => $id))->find()) {
			$this->error('非法访问！');
		}
		else if (M('UserQianbao')->where(array('userid' => $uid, 'id' => $id))->delete()) {
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}

	public function mywt($market_id)
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$uid = $this->userid();
		$market_id = (int) $market_id;

		if (!$market_id) {
			$this->error('market_id 错误');
		}

		$marketArr = M('Market')->where(array('id' => $market_id))->find();
		$limit = 5;
		$list = M('Trade')->where(array('userid = ' . $uid . ' and market = \'' . $marketArr['name'] . '\''))->order('id desc')->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			if ($pid == 1) {
				$this->ajaxShow('没有记录', 0);
			}
			else {
				$this->ajaxShow('没有更多了', 0);
			}
		}

		foreach ($list as $key => $val) {
			$list[$key]['num'] = NumToStr($val['num']) * 1;
			$list[$key]['mum'] = NumToStr($val['mum']) * 1;
			$list[$key]['fee'] = NumToStr($val['fee']) * 1;
			$list[$key]['price'] = NumToStr($val['price']) * 1;
			$list[$key]['deal'] = NumToStr($val['deal']) * 1;
			$list[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($list);
	}

	public function cancel_mywt($id)
	{
		$uid = $this->userid();

		if (!check($id, 'd')) {
			$this->error('请选择要撤销的委托！');
		}

		$trade = M('Trade')->where(array('id' => $id, 'userid' => $uid, 'status' => 0))->find();

		if (!$trade) {
			$this->error('撤销委托参数错误！');
		}

		$market = $trade['market'];
		$xnb = explode('_', $market)[0];
		$rmb = explode('_', $market)[1];

		if ($trade['type'] == 1) {
			$trade_fee = C('market')[$trade['market']]['fee_buy'];
		}
		else if ($trade['type'] == 2) {
			$trade_fee = C('market')[$trade['market']]['fee_sell'];
		}
		else {
			$this->error('交易类型错误');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_trade write ');
		$rs = array();

		if ($trade['type'] == 1) {
			$mun = round(((($trade['num'] - $trade['deal']) * $trade['price']) / 100) * (100 + $trade_fee), 8);
			$user_buy = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->find();

			if ($mun <= round($user_buy[$rmb . 'd'], 8)) {
				$save_buy_rmb = $mun;
			}
			else if ($mun <= round($user_buy[$rmb . 'd'], 8) + 1) {
				$save_buy_rmb = $user_buy[$rmb . 'd'];
			}
			else {
				$mo->execute('rollback');
				$mo->execute('unlock tables');
				M('Trade')->where(array('id' => $id))->setField('status', 1);
				$this->error('撤销失败!');
			}

			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setInc($rmb, $save_buy_rmb);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setDec($rmb . 'd', $save_buy_rmb);
			$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $trade['id']))->setField('status', 2);
			$you_buy = $mo->table('qq3479015851_trade')->where(array(
				'market' => array('like', '%' . $rmb . '%'),
				'status' => 0,
				'userid' => $trade['userid']
				))->find();

			if (!$you_buy) {
				$you_user_buy = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->find();

				if (0 < $you_user_buy[$rmb . 'd']) {
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setField($rmb . 'd', 0);
				}
			}
		}
		else if ($trade['type'] == 2) {
			$mun = round($trade['num'] - $trade['deal'], 8);
			$user_sell = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->find();

			if ($mun <= round($user_sell[$xnb . 'd'], 8)) {
				$save_sell_xnb = $mun;
			}
			else if ($mun <= round($user_sell[$xnb . 'd'], 8) + 1) {
				$save_sell_xnb = $user_sell[$xnb . 'd'];
			}
			else {
				$mo->execute('rollback');
				M('Trade')->where(array('id' => $id))->setField('status', 1);
				$this->error('撤销失败!');
			}

			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setInc($xnb, $save_sell_xnb);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setDec($xnb . 'd', $save_sell_xnb);
			$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $trade['id']))->setField('status', 2);
			$you_sell = $mo->table('qq3479015851_trade')->where(array(
				'market' => array('like', '%' . $xnb . '%'),
				'status' => 0,
				'userid' => $trade['userid']
				))->find();

			if (!$you_sell) {
				$you_user_sell = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->find();

				if (0 < $you_user_sell[$xnb . 'd']) {
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $trade['userid']))->setField($xnb . 'd', 0);
				}
			}
		}
		else {
			$mo->execute('rollback');
			$this->error('撤销委托参数错误！');
		}

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('撤销成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error('撤销失败!');
		}
	}

	public function mycj($market_id)
	{
		$pid = (isset($_GET['pid']) ? abs(intval($_GET['pid'])) : 1);
		$uid = $this->userid();
		$market_id = (int) $market_id;

		if (!$market_id) {
			$this->error('market_id 错误');
		}

		$marketArr = M('Market')->where(array('id' => $market_id))->find();
		$limit = 5;
		$list = M('TradeLog')->where(array('userid = ' . $uid . ' and market = \'' . $marketArr['name'] . '\''))->order('id desc')->limit(($pid - 1) * $limit, $limit)->select();

		if (!$list) {
			if ($pid == 1) {
				$this->ajaxShow('没有记录', 0);
			}
			else {
				$this->ajaxShow('没有更多了', 0);
			}
		}

		foreach ($list as $key => $val) {
			$list[$key]['num'] = NumToStr($val['num']) * 1;
			$list[$key]['mum'] = NumToStr($val['mum']) * 1;
			$list[$key]['fee_buy'] = NumToStr($val['fee_buy']) * 1;
			$list[$key]['fee_sell'] = NumToStr($val['fee_sell']) * 1;
			$list[$key]['price'] = NumToStr($val['price']) * 1;
			$list[$key]['addtime'] = addtime($val['addtime']);
		}

		$this->ajaxShow($list);
	}

	public function auth_check()
	{
		$uid = $this->userid();
		$res = M('User')->where(array('id' => $uid))->find();
		$res['idcard'] = mb_substr($res['idcard'], 0, 6) . '******' . mb_substr($res['idcard'], -4);
		$res['addtime'] = addtime($res['addtime']);
		$this->ajaxShow($res);
	}

	public function uppassword($oldpassword, $newpassword)
	{
		$uid = $this->userid();

		if (!check($oldpassword, 'password')) {
			$this->error('旧登录密码格式错误！');
		}

		if (!check($newpassword, 'password')) {
			$this->error('新登录密码格式错误！');
		}

		$password = M('User')->where(array('id' => $uid))->getField('password');

		if (md5($oldpassword) != $password) {
			$this->error('旧登录密码错误！');
		}

		$rs = M('User')->where(array('id' => $uid))->save(array('password' => md5($newpassword)));

		if ($rs) {
			$this->success('修改成功');
		}
		else {
			$this->error('修改失败');
		}
	}

	public function uppaypassword($oldpaypassword, $newpaypassword)
	{
		$uid = $this->userid();

		if (!check($oldpaypassword, 'password')) {
			$this->error('旧交易密码格式错误！');
		}

		if (!check($newpaypassword, 'password')) {
			$this->error('新交易密码格式错误！');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (md5($oldpaypassword) != $user['paypassword']) {
			$this->error('旧交易密码错误！');
		}

		$rs = M('User')->where(array('id' => $uid))->save(array('paypassword' => md5($newpaypassword)));

		if ($rs) {
			$this->success('修改成功');
		}
		else {
			$this->error('修改失败');
		}
	}

	public function sendnewMoble($new_moble)
	{
		$this->userid();
		$code = rand(1000, 9999);
		S('sendnewMobile_code_' . $new_moble, $code);
		S('sendnewMobile_moble_' . $new_moble, $new_moble);
		$this->success('验证码已发送到:' . $new_moble . '(' . $code . ')');
	}

	public function altermoble($new_moble, $moble_verify)
	{
		$code = S('sendnewMobile_code_' . $new_moble);
		$v_moble = S('sendnewMobile_moble_' . $new_moble);

		if (($moble_verify != $code) || ($v_moble != $new_moble)) {
			$this->error('短信验证码错误！' . $moble_verify . '|' . $code . '#' . $v_moble . '|' . $new_moble);
		}
		else {
			S('sendMobile_code_' . $new_moble, null);
		}

		if (!check($new_moble, 'moble')) {
			$this->error('新手机号码格式错误！');
		}

		$uid = $this->userid();
		$res = M('User')->where(array('id' => $uid))->save(array('moble' => $new_moble));

		if ($res) {
			$this->ajaxShow('更新成功');
		}
		else {
			$this->ajaxShow('更新失败', -1);
		}
	}
}

?>