<?php
namespace Home\Controller;

class MoneyController extends HomeController
{
	public function index()
	{
		if (IS_POST) {
			$id = $_POST['id'];
			$num = $_POST['num'];
			$paypassword = $_POST['paypassword'];

			if (!check($id, 'd')) {
				$this->error('编号格式错误！');
			}

			if (!check($num, 'd')) {
				$this->error('理财数量格式错误！');
			}

			if (!check($paypassword, 'password')) {
				$this->error('交易密码格式错误！');
			}

			$money_min = (C('money_min') ? C('money_min') : 10);
			$money_max = (C('money_max') ? C('money_max') : 10000000);
			$money_bei = (C('money_bei') ? C('money_bei') : 10);

			if ($num < $money_min) {
				$this->error('理财数量超过系统最小限制10！');
			}

			if ($money_max < $num) {
				$this->error('理财数量超过系统最大限制！');
			}

			if ($num % $money_bei != 0) {
				$this->error('每次理财数量必须是' . $money_bei . '的整倍数！');
			}

			if (!userid()) {
				$this->error('请先登录！');
			}

			$user = M('User')->where(array('id' => userid()))->find();

			if (md5($paypassword) != $user['paypassword']) {
				$this->error('交易密码错误！');
			}

			$money = M('Money')->where(array('id' => $id))->find();

			if (!$money) {
				$this->error('当前理财错误！');
			}

			if (!$money['status']) {
				$this->error('当前理财已经禁用！');
			}

			if (($money['num'] - $money['deal']) < $num) {
				$this->error('系统剩余量不足！');
			}

			$userCoin = M('UserCoin')->where(array('userid' => userid()))->find();

			if (!$userCoin || !isset($userCoin[$money['coinname']])) {
				$this->error('当前币种错误!');
			}

			if ($userCoin[$money['coinname']] < $num) {
				$this->error('可用余额不足,当前账户余额:' . $userCoin[$money['coinname']]);
			}

			$money_log_num = M('MoneyLog')->where(array('userid' => userid(), 'moneyid' => $money['id']))->sum('num');

			if ($money['max'] < ($money_log_num + $num)) {
				$this->error('当前理财最大可购买' . $money['max'] . ',您已经购买:' . $money_log_num);
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_money_log  write , qq3479015851_money  write');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($money['coinname'], $num);
			$rs[] = $mo->table('qq3479015851_money_log')->add(array('userid' => userid(), 'moneyid' => $money['id'], 'name' => $money['name'], 'num' => $num, 'tian' => $money['tian'], 'fee' => $money['fee'], 'feecoin' => $money['feecoin'], 'addtime' => time(), 'status' => 0));
			$rs[] = $mo->table('qq3479015851_money')->where(array('id' => $id))->setInc('deal', $num);

			if ($money['num'] <= $money['deal']) {
				$rs[] = $mo->table('qq3479015851_money')->where(array('id' => $id))->setField('status', 0);
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
			if (!userid()) {
				redirect('/#login');
			}

			$this->assign('prompt_text', D('Text')->get_content('game_money'));
			$where['status'] = 1;
			$count = M('Money')->where($where)->count();
			$Page = new \Think\Page($count, 5);
			$show = $Page->show();
			$list = M('Money')->where($where)->order('sort desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

			foreach ($list as $k => $v) {
				$list[$k]['fee'] = Num($v['fee']);
				$list[$k]['addtime'] = addtime($v['addtime']);
				$list[$k]['bili'] = round($v['deal'] / $v['num'], 2) * 100;
				$list[$k]['times'] = M('MoneyLog')->where(array('moneyid' => $v['id']))->count();
				$list[$k]['shen'] = round($v['num'] - $v['deal'], 2);
			}

			$this->assign('list', $list);
			$this->assign('page', $show);
			$this->display();
		}
	}

	public function queue()
	{
		$br = (IS_CLI ? "\n" : '<br>');
		echo IS_CLI ? '' : '<pre>';
		echo 'start money queue:' . $br;
		$MoneyList = M('Money')->where(array('status' => 1))->select();
		debug($MoneyList, 'MoneyList');

		foreach ($MoneyList as $money) {
			debug($money, 'money');

			if ($money['endtime'] < $money['lasttime']) {
				echo 'end ok ' . $br;
				$MoneyLogList = D('MoneyLog')->where(array('money_id' => $money['id'], 'status' => 1))->select();

				if ($MoneyLogList) {
					$mo = M();

					foreach ($MoneyLogList as $user_money_list) {
						if (!$user_money_list['status']) {
							continue;
						}

						$mo->execute('set autocommit=0');
						$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_money_log  write,qq3479015851_money_dlog  write');
						$rs = array();
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $user_money_list['userid']))->setInc($money['coinname'], $user_money_list['num']);
						$rs[] = $mo->table('qq3479015851_money_log')->save(array('id' => $user_money_list['id'], 'status' => 0));
						$rs[] = $mo->table('qq3479015851_money_dlog')->add(array('userid' => $user_money_list['userid'], 'money_id' => $money['id'], 'type' => 1, 'num' => $user_money_list['num'], 'addtime' => time(), 'content' => '理财结束,退回本金:' . $user_money_list['num'] . '个'));

						if (check_arr($rs)) {
							$mo->execute('commit');
							$mo->execute('unlock tables');
							echo 'commit ok ' . $br;
						}
						else {
							$mo->execute('rollback');
							echo 'rollback ' . $br;
						}
					}
				}
				else {
					D('Money')->save(array('id' => $money['id'], 'status' => 0));
					D('MoneyLog')->save(array('money_id' => $money['id'], 'status' => 0));
					continue;
				}
			}

			echo (($money['lasttime'] + $money['step']) - time()) . ' s' . $br;
			debug(array('lasttime' => $money['lasttime'], 'step' => $money['step'], 'time()' => time()), 'check time');

			if (!$money['lasttime'] || (($money['lasttime'] + $money['step']) < time())) {
				echo 'start ' . $money['name'] . '#:' . $br;
				$mo = M();
				debug('A');
				$MoneyLogList = M('MoneyLog')->where(array('money_id' => $money['id'], 'status' => 1))->select();
				debug('B');
				debug($MoneyLogList, 'MoneyLogList');

				foreach ($MoneyLogList as $MoneyLog) {
					debug('C');
					debug(array($MoneyLog, $money), 'chktime');

					if ($MoneyLog['chktime'] == $money['lasttime']) {
						continue;
					}

					$mo->execute('set autocommit=0');
					$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_money_log  write,qq3479015851_money_dlog  write');
					$rs = array();
					$fee = round(($money['fee'] * $MoneyLog['num']) / 100, 8);
					echo 'update ' . $MoneyLog['userid'] . ' coin ' . $br;
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $MoneyLog['userid']))->setInc($money['feecoin'], $fee);
					echo 'update ' . $MoneyLog['userid'] . ' log ' . $br;
					$MoneyLog['allfee'] = round($MoneyLog['allfee'] + $fee, 8);
					$MoneyLog['times'] = $MoneyLog['times'] + 1;
					$MoneyLog['chktime'] = $money['lasttime'];
					$rs[] = $mo->table('qq3479015851_money_log')->save($MoneyLog);
					echo 'add ' . $MoneyLog['userid'] . ' dlog ' . $br;
					$rs[] = $mo->table('qq3479015851_money_dlog')->add(array('userid' => $MoneyLog['userid'], 'money_id' => $money['id'], 'type' => 1, 'num' => $fee, 'addtime' => time(), 'content' => '本金:' . $money['coinname'] . ' :' . $MoneyLog['num'] . '个,获取理财利息' . $money['feecoin'] . ' ' . $fee . '个'));

					if (check_arr($rs)) {
						$mo->execute('commit');
						$mo->execute('unlock tables');
						echo 'commit ok ' . $br;
					}
					else {
						$mo->execute('rollback');
						echo 'rollback ' . $br;
					}
				}

				if (D('Money')->where(array('id' => $money['id']))->setField('lasttime', time())) {
					echo 'update money last time ok' . $br;
				}
				else {
					echo 'update money last time fail!!!!!!!!!!!!!!!!!!!!!! ' . $br;
				}
			}
			else {
				echo '时间未到';
			}
		}
	}

	public function log()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$this->assign('prompt_text', D('Text')->get_content('game_money_log'));
		$where['userid'] = userid();
		$count = M('MoneyLog')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('MoneyLog')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['fee'] = Num($v['fee']);
			$list[$k]['addtime'] = addtime($v['addtime']);
			$list[$k]['endtime'] = addtime($v['endtime']);
			$list[$k]['leiji'] = Num($v['leiji']);
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function fee()
	{
		if (!userid()) {
			redirect('/#login');
		}

		$id = $_GET['id'];

		if (!check($id, 'd')) {
			$this->error('参数错误!');
		}

		$where['moneylogid'] = $id;
		$where['userid'] = userid();
		$count = M('MoneyFee')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('MoneyFee')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}

	public function beforeGet($id)
	{
		if (!userid()) {
			redirect('/#login');
		}

		$id = intval($id);
		$MoneyLog = M('MoneyLog')->where(array('userid' => userid(), 'id' => $id, 'status' => 1))->find();

		if (!$MoneyLog) {
			$this->error('参数错误');
		}

		$Money = M('Money')->where(array('id' => $MoneyLog['money_id']))->find();

		if (!$Money) {
			$this->error('参数错误');
		}

		$num = $MoneyLog['num'];
		$fee = ($Money['outfee'] ? round(($MoneyLog['num'] * $Money['outfee']) / 100, 8) : 0);
		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user_coin write  , qq3479015851_money_log  write,qq3479015851_money_dlog  write');
		$rs = array();

		if ($Money['coinname'] != $Money['feecoin']) {
			$user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();

			if (!isset($user_coin[$Money['feecoin']])) {
				$this->error('利息币种不存在,请联系管理员');
			}

			if ($user_coin[$Money['feecoin']] < $fee) {
				$this->error('您的' . $Money['feecoin'] . '不够取现手续费(' . $fee . ')');
			}

			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($Money['feecoin'], $fee);
			debug($mo->table('qq3479015851_user_coin')->getLastSql(), 'qq3479015851_user_coin_sql0');
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setInc($Money['coinname'], $num);
			debug($mo->table('qq3479015851_user_coin')->getLastSql(), 'qq3479015851_user_coin_sql1');
		}
		else {
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setInc($Money['coinname'], round($num - $fee, 8));
			debug($mo->table('qq3479015851_user_coin')->getLastSql(), 'qq3479015851_user_coin_sql2');
		}

		$rs[] = $mo->table('qq3479015851_money_log')->where(array('id' => $MoneyLog['id']))->setField('status', 0);
		debug($mo->table('qq3479015851_money_log')->getLastSql(), 'qq3479015851_money_log_sql');
		$rs[] = $mo->table('qq3479015851_money_dlog')->add(array('userid' => userid(), 'money_id' => $Money['id'], 'type' => 2, 'num' => $fee, 'addtime' => time(), 'content' => '提前抽取' . $Money['title'] . ' 理财本金' . $Money['coinname'] . ' ' . $MoneyLog['num'] . '个,扣除利息' . $Money['feecoin'] . ': ' . $fee . '个'));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('操作成功！');
		}
		else {
			$mo->execute('rollback');
			$this->error(APP_DEBUG ? implode('|', $rs) : '操作失败!');
		}
	}

	private function danweitostr($danwei)
	{
		switch ($danwei) {
		case 'y':
			return '年';
			break;

		case 'm':
			return '月';
			break;

		case 'd':
			return '天';
			break;

		case 'h':
			return '小时';
			break;

		default:

		case 'i':
			return '分钟';
			break;
		}
	}

	public function uninstall()
	{
	}
}

?>