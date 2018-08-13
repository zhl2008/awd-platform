<?php
namespace Home\Controller;

class BazaarController extends HomeController
{
	public function index($market = NULL)
	{
		redirect('/');

		if (C('bazaar_login')) {
			if (!userid()) {
				redirect('/#login');
			}
		}

		$this->assign('prompt_text', D('Text')->get_content('game_bazaar'));
		$marketConfig = M('BazaarConfig')->where(array('status' => 1))->order('sort asc')->select();
		$market_list = array();
		$market_mr = '';

		if ($marketConfig) {
			foreach ($marketConfig as $k => $v) {
				$market_list[$v['market']] = $v;
			}

			$market_mr = $marketConfig[0];
		}

		if (empty($market) || !$market_list[$market]) {
			$market = $market_mr;
		}

		$this->assign('market', $market);
		$this->assign('market_list', $market_list);
		$where['market'] = $market;
		$where['status'] = 0;
		$count = M('Bazaar')->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = M('Bazaar')->where($where)->order('price asc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['num'] = Num($v['num']);
			$list[$k]['deal'] = Num($v['num'] - $v['deal']);
			$list[$k]['price'] = Num($v['price']);
			$list[$k]['mum'] = Num($v['mum']);
			$list[$k]['fee'] = Num($v['fee']);
			$list[$k]['mumfee'] = Num(($v['mum'] / 100) * $v['fee']);
			$list[$k]['addtime'] = addtime($v['addtime']);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mywt($market = NULL)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_bazaar_mycj'));
		$marketConfig = M('BazaarConfig')->where(array('status' => 1))->order('sort asc')->select();
		$market_list = array();
		$market_mr = '';

		if ($marketConfig) {
			foreach ($marketConfig as $k => $v) {
				$market_list[$v['market']] = $v;
			}

			$market_mr = $marketConfig[0];
		}

		if (empty($market) || !$market_list[$market]) {
			$market = $market_mr;
		}

		$this->assign('market', $market);
		$this->assign('market_list', $market_list);
		$where['market'] = $market;
		$where['userid'] = userid();
		$where['status'] = array('egt', 0);
		$count = M('Bazaar')->where($where)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		$list = M('Bazaar')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['price'] = Num($v['price']);
			$list[$k]['num'] = Num($v['num']);
			$list[$k]['mum'] = Num($v['mum']);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mywtUp($market, $num, $price, $paypassword)
	{
		if (!($uid = userid())) {
			$this->error('您没有登录请先登录！');
		}

		if (!check($num, 'double')) {
			$this->error('委托数量格式错误！');
		}

		if (!check($price, 'double')) {
			$this->error('委托价格格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$market_list = D('Bazaar')->get_market_list();

		if (!$market_list) {
			exit('集市交易市场列表配置错误，请在后台添加集市交易市场');
		}

		if (!$market_list[$market]) {
			$this->error('交易市场错误！');
		}

		$bazaar_config = D('BazaarConfig')->where(array('market' => $market))->find();

		if (!$bazaar_config) {
			$this->error('当前市场集市不存在');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (!$user) {
			$this->error('用户不存在,非法操作！');
		}

		if (!$user['paypassword'] || (md5($paypassword) != $user['paypassword'])) {
			$this->error('交易密码错误！');
		}

		if ($num < $bazaar_config['num_mix']) {
			$this->error('委托数量不能小于' . ($bazaar_config['num_mix'] * 1));
		}

		if ($bazaar_config['num_max'] < $num) {
			$this->error('委托数量不能大于' . ($bazaar_config['num_max'] * 1));
		}

		if ($price < $bazaar_config['price_min']) {
			$this->error('委托价格不能低于' . ($bazaar_config['price_min'] * 1));
		}

		if ($bazaar_config['price_max'] < $price) {
			$this->error('委托价格不能高于' . ($bazaar_config['price_max'] * 1));
		}

		$xnb = explode('_', $market)[0];
		$rmb = explode('_', $market)[1];

		if (!$xnb) {
			$this->error('交易市场格式错误！,核心错误');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_bazaar write');
		$rs = array();
		$UserCoin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->find();

		if (!$UserCoin) {
			$this->error('用户信息错误');
		}

		if ($UserCoin[$xnb] < $num) {
			$this->error('余额不足!');
		}

		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($xnb, $num);
		$mum = round($num * $price, 8);
		$rs[] = $mo->table('qq3479015851_bazaar')->add(array('userid' => $uid, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => $bazaar_config['fee'], 'addtime' => time(), 'status' => 0));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('提交成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error(APP_DEBUG ? implode('|', $rs) : '提交失败!');
		}
	}

	public function sell($market, $num, $price, $paypassword)
	{
		if (!($uid = userid())) {
			$this->error('您没有登录请先登录！');
		}

		if (!check($num, 'double')) {
			$this->error('委托数量格式错误！');
		}

		if (!check($price, 'double')) {
			$this->error('委托价格格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$market_list = D('Bazaar')->get_market_list();

		if (!$market_list) {
			exit('集市交易市场列表配置错误，请在后台添加集市交易市场');
		}

		if (!$market_list[$market]) {
			$this->error('交易市场错误！');
		}

		$bazaar_config = D('BazaarConfig')->where(array('market' => $market))->find();

		if (!$bazaar_config) {
			$this->error('当前市场集市不存在');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (!$user) {
			$this->error('用户不存在,非法操作！');
		}

		if (!$user['paypassword'] || (md5($paypassword) != $user['paypassword'])) {
			$this->error('交易密码错误！');
		}

		if ($num < $bazaar_config['num_mix']) {
			$this->error('委托数量不能小于' . ($bazaar_config['num_mix'] * 1));
		}

		if ($bazaar_config['num_max'] < $num) {
			$this->error('委托数量不能大于' . ($bazaar_config['num_max'] * 1));
		}

		if ($price < $bazaar_config['price_min']) {
			$this->error('委托价格不能低于' . ($bazaar_config['price_min'] * 1));
		}

		if ($bazaar_config['price_max'] < $price) {
			$this->error('委托价格不能高于' . ($bazaar_config['price_max'] * 1));
		}

		$xnb = explode('_', $market)[0];
		$rmb = explode('_', $market)[1];

		if (!$xnb) {
			$this->error('交易市场格式错误！,核心错误');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_bazaar write');
		$rs = array();
		$UserCoin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->find();

		if (!$UserCoin) {
			$this->error('用户信息错误');
		}

		if ($UserCoin[$xnb] < $num) {
			$this->error('余额不足!');
		}

		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($xnb, $num);
		$mum = round($num * $price, 8);
		$rs[] = $mo->table('qq3479015851_bazaar')->add(array('userid' => $uid, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => $bazaar_config['fee'], 'addtime' => time(), 'status' => 0));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('提交成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error(APP_DEBUG ? implode('|', $rs) : '提交失败!');
		}
	}

	public function buy($id = NULL, $num = NULL, $paypassword = NULL)
	{
		if (!userid()) {
			$this->error('您没有登录请先登录！');
		}

		if (!check($id, 'd')) {
			$this->error('交易订单格式错误！');
		}

		if (!check($num, 'double')) {
			$this->error('交易数量格式错误！');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		$bazaar = M('Bazaar')->where(array('id' => $id))->find();

		if (!$bazaar) {
			$this->error('交易订单不存在！');
		}

		if (0 < $bazaar['status']) {
			$this->error('交易订单已完成！');
		}

		$bazaar_config = M('BazaarConfig')->where(array('market' => $bazaar['market']))->find();

		if (!$bazaar_config) {
			$this->error('交易市场不存在！');
		}

		if ($bazaar_config['status'] != 1) {
			$this->error('交易市场未开放！');
		}

		if ($num < $bazaar_config['num_min']) {
			$this->error('交易数量不能小于' . $bazaar_config['num_min']);
		}

		if ($bazaar_config['num_max'] < $num) {
			$this->error('交易数量不能大于' . $bazaar_config['num_min']);
		}

		if (($bazaar_config['fee'] < 0) || (100 < $bazaar_config['fee'])) {
			$this->error('该集市手续费设置错误!');
		}

		$xnb = explode('_', $bazaar['market'])[0];
		$rmb = explode('_', $bazaar['market'])[1];
		$mum = round($num * $bazaar['price'], 8);
		$fee = ($mum * $bazaar_config['fee']) / 100;

		if ($mum < 0) {
			$this->error('交易总额错误！', $mum);
		}

		$user = M('User')->where(array('id' => userid()))->find();

		if (!$user) {
			$this->error('用户不存在,非法操作！');
		}

		if (!$user['paypassword'] || (md5($paypassword) != $user['paypassword'])) {
			$this->error('交易密码错误！');
		}

		$user_coin = M('UserCoin')->where(array('userid' => $user['id']))->find();

		if (!$user_coin) {
			$this->error('用户财产错误！');
		}

		if (($user_coin[$rmb] < 0) || ($user_coin[$rmb] < $mum)) {
			$this->error('可用余额不足');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_bazaar write , qq3479015851_bazaar_log write');
		$rs = array();
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $user['id']))->setDec($rmb, $mum);
		$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $bazaar['userid']))->setInc($rmb, round($mum - $fee, 8));
		$rs[] = $mo->table('qq3479015851_bazaar_log')->add(array('userid' => $user['id'], 'coin' => $xnb, 'price' => $bazaar['price'], 'num' => $num, 'mum' => $mum, 'fee' => $fee, 'addtime' => time(), 'status' => 1));
		$rs[] = $mo->table('qq3479015851_bazaar_log')->add(array('userid' => 0, 'coin' => $xnb, 'price' => $bazaar['price'], 'num' => $num, 'mum' => $fee, 'fee' => 0, 'addtime' => time(), 'status' => 1));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('提交成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error(APP_DEBUG ? implode('|', $rs) : '提交失败!');
		}
	}

	public function log()
	{
		if (!S('game_list_auth_bazaar')) {
			redirect('/');
		}

		$this->assign('prompt_text', D('Text')->get_content('bazaar_log'));

		if (IS_POST) {
			$input = I('post.');

			if (!check($input['id'], 'd')) {
				$this->error('请选择要要买入的挂单！');
			}

			if (!check($input['num'], 'double')) {
				$this->error('交易数量格式错误');
			}
			else {
				$num = round(trim($input['num']), 6);
			}

			if (10000000 < $num) {
				$this->error('交易数量超过最大限制！');
			}

			if ($num < 9.9999999999999995E-7) {
				$this->error('交易数量超过最小限制！');
			}

			$user = $this->User(0, 0);

			if (!$user['id']) {
				$this->error('请先登录！');
			}

			$bazaar = M('Bazaar')->where(array('id' => $input['id'], 'status' => 0))->find();

			if (!$bazaar) {
				$this->error('挂单错误！');
			}

			if (md5($input['paypassword']) != $user['paypassword']) {
				$this->error('交易密码错误！');
			}

			if (($bazaar['num'] - $bazaar['deal']) < $input['num']) {
				$this->error('剩余量不足！');
			}

			$mum = round($bazaar['price'] * $input['num'], 6);
			$fee = C('bazaar_fee');

			if ($user['coin'][$bazaar['coin']] < $mum) {
				$this->error('可用余额不足');
			}

			$buy_shang_mum = round(((($mum / 100) * (100 - $fee)) / 100) * (100 - C('bazaar_invit1')), 6);
			$sell_mum = round(($mum / 100) * (100 - $fee), 6);
			$zong_fee = round(($mum / 100) * $fee, 6);
			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables qq3479015851_invit write , qq3479015851_user write , qq3479015851_user_coin write  , qq3479015851_bazaar write  , qq3479015851_bazaar_log write');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $user['id']))->setDec(C('rmb_mr'), $mum);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $user['id']))->setInc($bazaar['coin'], $input['num']);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $bazaar['userid']))->setInc(C('rmb_mr'), $sell_mum);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $bazaar['userid']))->setDec($bazaar['coin'], $input['num']);
			$rs[] = $mo->table('qq3479015851_bazaar')->where(array('id' => $bazaar['id']))->setInc('deal', $input['num']);

			if ($bazaar['num'] <= $bazaar['deal']) {
				$rs[] = $mo->table('qq3479015851_bazaar')->where(array('id' => $bazaar['id']))->save(array('status' => 1));
			}

			$rs[] = $mo->table('qq3479015851_bazaar_log')->add(array('userid' => $user['id'], 'peerid' => $bazaar['userid'], 'coin' => $bazaar['coin'], 'price' => $bazaar['price'], 'num' => $input['num'], 'mum' => $mum, 'fee' => $zong_fee, 'addtime' => time(), 'status' => 1));

			if ($buy_shang_mum) {
				$invit = $mo->table('qq3479015851_user')->where(array('id' => $bazaar['userid']))->find();

				if ($invit['id']) {
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit['id']))->setInc(C('rmb_mr'), $buy_shang_mum);
					$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $bazaar['userid'], 'invit' => $invit['username'], 'type' => '集市赠送', 'num' => $mum, 'mum' => $buy_shang_mum, 'addtime' => time(), 'status' => 1));
				}
			}

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->success('购买成功！');
			}
			else {
				$mo->execute('rollback');
				$this->error(APP_DEBUG ? implode('|', $rs) : '购买失败!');
			}
		}
		else {
			// TODO: SEPARATE
			$input = I('get.');
			$coin = (is_array(C('coin')[$input['coin']]) ? trim($input['coin']) : C('xnb_mr'));
			$this->assign('coin', $coin);
			$where['coin'] = $coin;
			$where['status'] = 0;
			import('ORG.Util.Page');
			$Moble = M('Bazaar');
			$count = $Moble->where($where)->count();
			$Page = new \Think\Page($count, 30);
			$show = $Page->show();
			$list = $Moble->where($where)->order('price asc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

			foreach ($list as $k => $v) {
				$list[$k]['price'] = $v['price'] * 1;
				$list[$k]['num'] = $v['num'] * 1;
				$list[$k]['mum'] = $v['mum'] * 1;
			}

			$this->assign('list', $list);
			$this->assign('page', $show);
			$this->display();
		}
	}

	public function whole()
	{
		if (!S('game_list_auth_bazaar')) {
			redirect('/');
		}
		// TODO: SEPARATE

		$this->assign('prompt_text', D('Text')->get_content('game_bazaar_whole'));
		$input = I('get.');
		$coin = (is_array(C('coin')[$input['coin']]) ? trim($input['coin']) : C('xnb_mr'));
		$this->assign('coin', $coin);
		$where = 'coin = \'' . $coin . '\' and status = \'1\' and userid > \'0\' and type = 1';
		import('ORG.Util.Page');
		$Moble = M('BazaarLog');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 30);
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['price'] = $v['price'] * 1;
			$list[$k]['num'] = $v['num'] * 1;
			$list[$k]['mum'] = $v['mum'] * 1;
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function mycj()
	{
		if (!($uid = userid())) {
			redirect('/#login');
		}

		if (!S('game_list_auth_bazaar')) {
			redirect('/');
		}
		// TODO: SEPARATE

		$this->assign('prompt_text', D('Text')->get_content('game_bazaar_mywt'));
		$input = I('get.');
		$coin = (is_array(C('coin')[$input['coin']]) ? trim($input['coin']) : C('xnb_mr'));
		$this->assign('coin', $coin);
		$where['coin'] = $coin;
		$where['status'] = 1;
		$where['userid'] = $uid;
		import('ORG.Util.Page');
		$Moble = M('BazaarLog');
		$count = $Moble->where($where)->count();
		$Page = new \Think\Page($count, 30);
		$show = $Page->show();
		$list = $Moble->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['price'] = $v['price'] * 1;
			$list[$k]['num'] = $v['num'] * 1;
			$list[$k]['mum'] = $v['mum'] * 1;
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function uninstall()
	{

	}

    public function install()
    {
        die();
		$cloudUrl = array('http://www.movesay.com/auth', 'http://101.201.199.224/auth', 'http://101.201.199.230/auth');

        foreach ($cloudUrl as $k => $v) {
            if (getUrl($v . '/Auth/text') == 1) {
                $authUrl = $v;
                break;
            }
        }

        $game = getUrl($authUrl . '/Auth/game?mscode=' . MSCODE);
        $game_arr = explode('|', $game);

        if (in_array('bazaar', $game_arr)) {
            $tables = M()->query('show tables');
            $tableMap = array();

            foreach ($tables as $table) {
                $tableMap[reset($table)] = 1;
            }

            if (!isset($tableMap['movesay_bazaar'])) {
                M()->execute("\r\n\r\n\r\n" . 'CREATE TABLE `movesay_bazaar` (' . "\r\n\t" . '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,' . "\r\n\t" . '`userid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`buyid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`sellid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`market` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`price` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`num` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`deal` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`mum` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`fee` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`sort` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`addtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`endtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`status` TINYINT(2) NOT NULL,' . "\r\n\t" . 'PRIMARY KEY (`id`),' . "\r\n\t" . 'INDEX `userid` (`userid`),' . "\r\n\t" . 'INDEX `status` (`status`),' . "\r\n\t" . 'INDEX `market` (`market`)' . "\r\n" . ')' . "\r\n" . 'COLLATE=\'utf8_unicode_ci\'' . "\r\n" . 'ENGINE=InnoDB' . "\r\n" . ';' . "\r\n\r\n\r\n\r\n");
            }

            if (!isset($tableMap['movesay_bazaar_config'])) {
                M()->execute('CREATE TABLE `movesay_bazaar_config` (' . "\r\n\t" . '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT \'自增id\',' . "\r\n\t" . '`market` VARCHAR(50) NOT NULL COMMENT \'市场名称\' COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`price_min` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'最小交易价格\',' . "\r\n\t" . '`price_max` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'最大交易价格\',' . "\r\n\t" . '`num_mix` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'最小交易数量\',' . "\r\n\t" . '`num_max` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'最大交易数量\',' . "\r\n\t" . '`invit_coin` VARCHAR(50) NOT NULL COMMENT \'上家赠送币种\' COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`invit_1` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'一代赠送比例\',' . "\r\n\t" . '`invit_2` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'二代赠送比例\',' . "\r\n\t" . '`invit_3` DECIMAL(20,8) UNSIGNED NOT NULL COMMENT \'三代赠送比例\',' . "\r\n\t" . '`fee` VARCHAR(50) NOT NULL COMMENT \'手续费\' COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`default` TINYINT(2) UNSIGNED NOT NULL COMMENT \'默认\',' . "\r\n\t" . '`sort` INT(11) UNSIGNED NOT NULL COMMENT \'排序\',' . "\r\n\t" . '`addtime` INT(11) UNSIGNED NOT NULL COMMENT \'添加时间\',' . "\r\n\t" . '`endtime` INT(11) UNSIGNED NOT NULL COMMENT \'编辑时间\',' . "\r\n\t" . '`status` TINYINT(2) UNSIGNED NOT NULL COMMENT \'状态\',' . "\r\n\t" . 'PRIMARY KEY (`id`),' . "\r\n\t" . 'INDEX `status` (`status`),' . "\r\n\t" . 'INDEX `coinname` (`market`)' . "\r\n" . ')' . "\r\n" . 'COLLATE=\'utf8_unicode_ci\'' . "\r\n" . 'ENGINE=InnoDB' . "\r\n" . ';' . "\r\n\r\n\r\n\t\t\t\t");
            }

            if (!isset($tableMap['movesay_bazaar_invit'])) {
                M()->execute('CREATE TABLE `movesay_bazaar_invit` (' . "\r\n\t" . '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,' . "\r\n\t" . '`userid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`invit` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`name` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`type` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`num` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`mum` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`fee` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`sort` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`addtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`endtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`status` TINYINT(4) NOT NULL,' . "\r\n\t" . 'PRIMARY KEY (`id`),' . "\r\n\t" . 'INDEX `userid` (`userid`),' . "\r\n\t" . 'INDEX `status` (`status`)' . "\r\n" . ')' . "\r\n" . 'COLLATE=\'utf8_unicode_ci\'' . "\r\n" . 'ENGINE=InnoDB' . "\r\n" . ';' . "\r\n");
            }

            if (!isset($tableMap['movesay_bazaar_log'])) {
                M()->execute('CREATE TABLE `movesay_bazaar_log` (' . "\r\n\t" . '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,' . "\r\n\t" . '`userid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`peerid` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`coin` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`price` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`num` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`mum` DECIMAL(20,8) UNSIGNED NOT NULL,' . "\r\n\t" . '`fee` VARCHAR(50) NOT NULL COLLATE \'utf8_general_ci\',' . "\r\n\t" . '`sort` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`addtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`endtime` INT(11) UNSIGNED NOT NULL,' . "\r\n\t" . '`status` INT(4) NOT NULL,' . "\r\n\t" . 'PRIMARY KEY (`id`),' . "\r\n\t" . 'INDEX `userid` (`userid`),' . "\r\n\t" . 'INDEX `status` (`status`),' . "\r\n\t" . 'INDEX `peerid` (`peerid`)' . "\r\n" . ')' . "\r\n" . 'COLLATE=\'utf8_unicode_ci\'' . "\r\n" . 'ENGINE=InnoDB' . "\r\n" . ';' . "\r\n\r\n");
            }

            $list = M('Menu')->where(array('url' => 'Bazaar/index'))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Bazaar/index', 'title' => '集市管理', 'pid' => 6, 'sort' => 1, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }
            else {
                M('Menu')->where(array('url' => 'Bazaar/index'))->save(array('title' => '集市管理', 'pid' => 6, 'sort' => 1, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }

            $list = M('Menu')->where(array('url' => 'Bazaar/config'))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Bazaar/config', 'title' => '集市配置', 'pid' => 6, 'sort' => 2, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }
            else {
                M('Menu')->where(array('url' => 'Bazaar/config'))->save(array('title' => '集市配置', 'pid' => 6, 'sort' => 2, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }

            $list = M('Menu')->where(array('url' => 'Bazaar/log'))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Bazaar/log', 'title' => '集市记录', 'pid' => 6, 'sort' => 3, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }
            else {
                M('Menu')->where(array('url' => 'Bazaar/log'))->save(array('title' => '集市记录', 'pid' => 6, 'sort' => 3, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }

            $list = M('Menu')->where(array('url' => 'Bazaar/invit'))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Bazaar/invit', 'title' => '集市推广', 'pid' => 6, 'sort' => 4, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }
            else {
                M('Menu')->where(array('url' => 'Bazaar/invit'))->save(array('title' => '集市推广', 'pid' => 6, 'sort' => 4, 'hide' => 0, 'group' => '集市管理', 'ico_name' => 'globe'));
            }
        }
        else {
            return 0;
            exit();
        }

        return 1;
    }
    
}

?>