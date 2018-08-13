<?php
namespace Mapi\Controller;

class TradeController extends CommonController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getTradedata($marketid = NULL)
	{
		if (!$marketid) {
			$this->ajaxShow(array('marketid 不能为空'), -1);
		}

		$marketid = intval($marketid);

		if (!($marketData = M('Market')->where(array('id' => $marketid))->find())) {
			$this->ajaxShow(array('marketid 不存在'), -1);
		}

		$buy_info = array('new_price' => NumToStr(floatval($marketData['new_price']), 8) * 1, 'buy_price' => NumToStr(floatval($marketData['buy_price']), 8) * 1, 'sell_price' => NumToStr(floatval($marketData['sell_price']), 8) * 1);
		$market = $marketData['name'];

		if ($uid = $this->userid(1)) {
			$userCoin = M('UserCoin')->where(array('userid' => $uid))->find();

			if ($userCoin) {
				$xnb = explode('_', $market)[0];
				$rmb = explode('_', $market)[1];

				if (!($rmbinfo = S('getTradedata_coin_' . $rmb))) {
					$rmbinfo = M('Coin')->where(array('name' => $rmb))->field('title,name')->find();
					S('getTradedata_coin_' . $rmb, $rmbinfo);
				}

				if (!($xnbinfo = S('getTradedata_coin_' . $xnb))) {
					$xnbinfo = M('Coin')->where(array('name' => $xnb))->field('title,name')->find();
					S('getTradedata_coin_' . $xnb, $xnbinfo);
				}

				$user_buy_name = $rmbinfo['title'];
				$user_buy_ename = $rmbinfo['name'];
				$user_buy_num = NumToStr(floatval($userCoin[$rmb]), 8) * 1;
				$user_buy_numd = NumToStr(floatval($userCoin[$rmb . 'd']), 8) * 1;
				$user_sell_name = $xnbinfo['title'];
				$user_sell_ename = $xnbinfo['name'];
				$user_sell_num = NumToStr(floatval($userCoin[$xnb]), 8) * 1;
				$user_sell_numd = NumToStr(floatval($userCoin[$xnb . 'd']), 8) * 1;
				$userData = array(
					'login' => 1,
					'data'  => array(
						'user_buy'  => array('name' => $user_buy_name, 'ename' => $user_buy_ename, 'num' => $user_buy_num, 'fnum' => $user_buy_numd),
						'user_sell' => array('name' => $user_sell_name, 'ename' => $user_sell_ename, 'num' => $user_sell_num, 'fnum' => $user_sell_numd)
						)
					);
			}
			else {
				$userData = array('login' => 0);
			}
		}
		else {
			$userData = array('login' => 0);
		}

		$wt = M('Trade')->where(array('status' => 0, 'market' => $market, 'userid' => $uid))->field('id,price,num,deal,mum,type,fee,status,addtime')->order('id desc')->limit(10)->select();

		if ($wt) {
			foreach ($wt as $k => $v) {
				$data['entrust'][$k]['addtime'] = date('H:i', $v['addtime']);
				$data['entrust'][$k]['type'] = $v['type'];
				$data['entrust'][$k]['price'] = $v['price'] * 1;
				$data['entrust'][$k]['num'] = round($v['num'], 6);
				$data['entrust'][$k]['deal'] = round($v['deal'], 6);
				$data['entrust'][$k]['id'] = round($v['id']);
			}
		}
		else {
			$data['entrust'] = null;
		}

		$mo = M();
		$buy = $mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=1 and market =\'' . $market . '\' group by price order by price desc limit 5;');
		$sell = array_reverse($mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=2 and market =\'' . $market . '\' group by price order by price asc limit 5;'));

		if ($buy) {
			foreach ($buy as $k => $v) {
				$data['depth']['buy'][$k] = array(floatval($v['price'] * 1), floatval($v['nums'] * 1));
			}
		}
		else {
			$data['depth']['buy'] = '';
		}

		if ($sell) {
			foreach ($sell as $k => $v) {
				$data['depth']['sell'][$k] = array(floatval($v['price'] * 1), floatval($v['nums'] * 1));
			}
		}
		else {
			$data['depth']['sell'] = '';
		}

		$data['info'] = $buy_info;
		$data['user'] = $userData;
		$this->ajaxShow($data);
	}

	public function upTrade($paypassword = NULL, $marketid = NULL, $price, $num, $type)
	{
		if (!($uid = $this->userid())) {
			$this->error('请先登录！');
		}

		if (!check($price, 'double')) {
			$this->error('交易价格格式错误');
		}

		if (!check($num, 'double')) {
			$this->error('交易数量格式错误');
		}

		if (($type != 1) && ($type != 2)) {
			$this->error('交易类型格式错误');
		}

		$user = M('User')->where(array('id' => $uid))->find();

		if (md5($paypassword) != $user['paypassword']) {
			$this->error('交易密码错误！');
		}

		if (!$marketid) {
			$this->ajaxShow(array('marketid 不能为空'), -1);
		}

		$marketid = intval($marketid);

		if (!($marketData = M('Market')->where(array('id' => $marketid))->find())) {
			$this->ajaxShow(array('marketid 不存在'), -1);
		}

		$market = $marketData['name'];

		if (!C('market')[$market]) {
			$this->error('交易市场错误');
		}
		else {
			$xnb = explode('_', $market)[0];
			$rmb = explode('_', $market)[1];
		}

		if (!C('market')[$market]['trade']) {
			$this->error('当前市场禁止交易');
		}
		// TODO: SEPARATE

		$price = round(floatval($price), C('market')[$market]['round']);

		if (!$price) {
			$this->error('交易价格错误11' . $price);
		}

		$num = round($num, 8 - C('market')[$market]['round']);

		if (!check($num, 'double')) {
			$this->error('交易数量错误');
		}

		if ($type == 1) {
			$min_price = (C('market')[$market]['buy_min'] ? C('market')[$market]['buy_min'] : 1.0E-8);
			$max_price = (C('market')[$market]['buy_max'] ? C('market')[$market]['buy_max'] : 10000000);
		}
		else if ($type == 2) {
			$min_price = (C('market')[$market]['sell_min'] ? C('market')[$market]['sell_min'] : 1.0E-8);
			$max_price = (C('market')[$market]['sell_max'] ? C('market')[$market]['sell_max'] : 10000000);
		}
		else {
			$this->error('交易类型错误');
		}

		if ($max_price < $price) {
			$this->error('交易价格超过最大限制！');
		}

		if ($price < $min_price) {
			$this->error('交易价格超过最小限制！');
		}

		$hou_price = C('market')[$market]['hou_price'];

		if ($hou_price) {
			if (C('market')[$market]['zhang']) {
				// TODO: SEPARATE
				$zhang_price = round(($hou_price / 100) * (100 + C('market')[$market]['zhang']), C('market')[$market]['round']);

				if ($zhang_price < $price) {
					$this->error('交易价格超过今日涨幅限制！');
				}
			}

			if (C('market')[$market]['die']) {
				// TODO: SEPARATE
				$die_price = round(($hou_price / 100) * (100 - C('market')[$market]['die']), C('market')[$market]['round']);

				if ($price < $die_price) {
					$this->error('交易价格超过今日跌幅限制！');
				}
			}
		}

		$user_coin = M('UserCoin')->where(array('userid' => $uid))->find();

		if ($type == 1) {
			$trade_fee = C('market')[$market]['fee_buy'];

			if ($trade_fee) {
				$fee = round((($num * $price) / 100) * $trade_fee, 8);
				$mum = round((($num * $price) / 100) * (100 + $trade_fee), 8);
			}
			else {
				$fee = 0;
				$mum = round($num * $price, 8);
			}

			if ($user_coin[$rmb] < $mum) {
				debug(array($user_coin[$rmb], $mum), '余额检查');
				$this->error(C('coin')[$rmb]['title'] . '余额不足！');
			}
		}
		else if ($type == 2) {
			$trade_fee = C('market')[$market]['fee_sell'];

			if ($trade_fee) {
				$fee = round((($num * $price) / 100) * $trade_fee, 8);
				$mum = round((($num * $price) / 100) * (100 - $trade_fee), 8);
			}
			else {
				$fee = 0;
				$mum = round($num * $price, 8);
			}

			if ($user_coin[$xnb] < $num) {
				$this->error(C('coin')[$xnb]['title'] . '余额不足2！');
			}
		}
		else {
			$this->error('交易类型错误');
		}

		if (C('coin')[$xnb]['fee_bili']) {
			if ($type == 2) {
				// TODO: SEPARATE
				$bili_user = round($user_coin[$xnb] + $user_coin[$xnb . 'd'], C('market')[$market]['round']);

				if ($bili_user) {
					// TODO: SEPARATE
					$bili_keyi = round(($bili_user / 100) * C('coin')[$xnb]['fee_bili'], C('market')[$market]['round']);

					if ($bili_keyi) {
						$bili_zheng = M()->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where userid=' . $uid . ' and status=0 and type=2 and market like \'%' . $xnb . '%\' ;');

						if (!$bili_zheng[0]['nums']) {
							$bili_zheng[0]['nums'] = 0;
						}

						$bili_kegua = $bili_keyi - $bili_zheng[0]['nums'];

						if ($bili_kegua < 0) {
							$bili_kegua = 0;
						}

						if ($bili_kegua < $num) {
							$this->error('您的挂单总数量超过系统限制，您当前持有' . C('coin')[$xnb]['title'] . $bili_user . '个，已经挂单' . $bili_zheng[0]['nums'] . '个，还可以挂单' . $bili_kegua . '个', '', 5);
						}
					}
					else {
						$this->error('可交易量错误');
					}
				}
			}
		}

		if (C('coin')[$xnb]['fee_meitian']) {
		}

		if (C('market')[$market]['trade_min']) {
			if ($mum < C('market')[$market]['trade_min']) {
				$this->error('交易总额不能小于' . C('market')[$market]['trade_min']);
			}
		}

		if (C('market')[$market]['trade_max']) {
			if (C('market')[$market]['trade_max'] < $mum) {
				$this->error('交易总额不能大于' . C('market')[$market]['trade_max']);
			}
		}

		if (!$rmb) {
			$this->error('数据错误1');
		}

		if (!$xnb) {
			$this->error('数据错误2');
		}

		if (!$market) {
			$this->error('数据错误3');
		}

		if (!$price) {
			$this->error('数据错误4');
		}

		if (!$num) {
			$this->error('数据错误5');
		}

		if (!$mum) {
			$this->error('数据错误6');
		}

		if (!$type) {
			$this->error('数据错误7');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_trade write ,qq3479015851_user_coin write');
		$rs = array();

		if ($type == 1) {
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($rmb, $mum);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setInc($rmb . 'd', $mum);
			$rs[] = $mo->table('qq3479015851_trade')->add(array('userid' => $uid, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => $fee, 'type' => 1, 'addtime' => time(), 'status' => 0));
		}
		else if ($type == 2) {
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setDec($xnb, $num);
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $uid))->setInc($xnb . 'd', $num);
			$rs[] = $mo->table('qq3479015851_trade')->add(array('userid' => $uid, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => $fee, 'type' => 2, 'addtime' => time(), 'status' => 0));
		}
		else {
			$mo->execute('rollback');
			$mo->execute('unlock tables');
			$this->error('交易类型错误');
		}

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->matchingTrade($market);
			$this->success('交易成功！');
		}
		else {
			$mo->execute('rollback');
			$mo->execute('unlock tables');
			$this->error('交易失败！');
		}
	}

	public function matchingTrade($market = NULL)
	{
		if (!$market) {
			return false;
		}
		else {
			$xnb = explode('_', $market)[0];
			$rmb = explode('_', $market)[1];
		}

		$fee_buy = C('market')[$market]['fee_buy'];
		$fee_sell = C('market')[$market]['fee_sell'];
		$invit_buy = C('market')[$market]['invit_buy'];
		$invit_sell = C('market')[$market]['invit_sell'];
		$invit_1 = C('market')[$market]['invit_1'];
		$invit_2 = C('market')[$market]['invit_2'];
		$invit_3 = C('market')[$market]['invit_3'];
		$mo = M();
		$mo->table('qq3479015851_trade')->where('num<deal')->setField('status', 1);
		$new_trade_qq3479015851 = 0;

		for (; true; ) {
			$buy = $mo->table('qq3479015851_trade')->where(array('market' => $market, 'type' => 1, 'status' => 0))->order('price desc,id asc')->find();
			$sell = $mo->table('qq3479015851_trade')->where(array('market' => $market, 'type' => 2, 'status' => 0))->order('price asc,id asc')->find();

			if ($sell['id'] < $buy['id']) {
				$type = 1;
			}
			else {
				$type = 2;
			}

			if ($buy && $sell && (0 <= floatval($buy['price']) - floatval($sell['price']))) {
				$rs = array();

				if ($buy['num'] <= $buy['deal']) {
				}

				if ($sell['num'] <= $sell['deal']) {
				}

				$amount = min(round($buy['num'] - $buy['deal'], 8 - C('market')[$market]['round']), round($sell['num'] - $sell['deal'], 8 - C('market')[$market]['round']));
				$amount = round($amount, 8 - C('market')[$market]['round']);

				if ($amount <= 0) {
					$log = '错误1交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . "\n";
					$log .= 'ERR: 成交数量出错，数量是' . $amount;
					Log::write($log);
					M('Trade')->where(array('id' => $buy['id']))->setField('status', 1);
					M('Trade')->where(array('id' => $sell['id']))->setField('status', 1);
					break;
				}

				if ($type == 1) {
					$price = $sell['price'];
				}
				else if ($type == 2) {
					$price = $buy['price'];
				}
				else {
					break;
				}

				if (!$price) {
					$log = '错误2交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . "\n";
					$log .= 'ERR: 成交价格出错，价格是' . $price;
					Log::write($log);
					break;
				}
				else {
					// TODO: SEPARATE
					$price = round($price, C('market')[$market]['round']);
				}

				$mum = round($price * $amount, 8);

				if (!$mum) {
					$log = '错误3交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . "\n";
					$log .= 'ERR: 成交总额出错，总额是' . $mum;
					Log::write($log);
					break;
				}
				else {
					$mum = round($mum, 8);
				}

				if ($fee_buy) {
					$buy_fee = round(($mum / 100) * $fee_buy, 8);
					$buy_save = round(($mum / 100) * (100 + $fee_buy), 8);
				}
				else {
					$buy_fee = 0;
					$buy_save = $mum;
				}

				if (!$buy_save) {
					$log = '错误4交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家更新数量出错，更新数量是' . $buy_save;
					Log::write($log);
					break;
				}

				if ($fee_sell) {
					$sell_fee = round(($mum / 100) * $fee_sell, 8);
					$sell_save = round(($mum / 100) * (100 - $fee_sell), 8);
				}
				else {
					$sell_fee = 0;
					$sell_save = $mum;
				}

				if (!$sell_save) {
					$log = '错误5交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 卖家更新数量出错，更新数量是' . $sell_save;
					Log::write($log);
					break;
				}

				$user_buy = M('UserCoin')->where(array('userid' => $buy['userid']))->find();

				if (!$user_buy[$rmb . 'd']) {
					$log = '错误6交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家财产错误，冻结财产是' . $user_buy[$rmb . 'd'];
					Log::write($log);
					break;
				}

				$user_sell = M('UserCoin')->where(array('userid' => $sell['userid']))->find();

				if (!$user_sell[$xnb . 'd']) {
					$log = '错误7交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 卖家财产错误，冻结财产是' . $user_sell[$xnb . 'd'];
					Log::write($log);
					break;
				}

				if ($user_buy[$rmb . 'd'] < 1.0E-8) {
					$log = '错误88交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家更新冻结人民币出现错误,应该更新' . $buy_save . '账号余额' . $user_buy[$rmb . 'd'] . '进行错误处理';
					Log::write($log);
					M('Trade')->where(array('id' => $buy['id']))->setField('status', 1);
					break;
				}

				if ($buy_save <= round($user_buy[$rmb . 'd'], 8)) {
					$save_buy_rmb = $buy_save;
				}
				else if ($buy_save <= round($user_buy[$rmb . 'd'], 8) + 1) {
					$save_buy_rmb = $user_buy[$rmb . 'd'];
					$log = '错误8交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家更新冻结人民币出现误差,应该更新' . $buy_save . '账号余额' . $user_buy[$rmb . 'd'] . '实际更新' . $save_buy_rmb;
					Log::write($log);
				}
				else {
					$log = '错误9交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家更新冻结人民币出现错误,应该更新' . $buy_save . '账号余额' . $user_buy[$rmb . 'd'] . '进行错误处理';
					Log::write($log);
					M('Trade')->where(array('id' => $buy['id']))->setField('status', 1);
					break;
				}
				// TODO: SEPARATE

				if ($amount <= round($user_sell[$xnb . 'd'], C('market')[$market]['round'])) {
					$save_sell_xnb = $amount;
				}
				else {
					// TODO: SEPARATE

					if ($amount <= round($user_sell[$xnb . 'd'], C('market')[$market]['round']) + 1) {
						$save_sell_xnb = $user_sell[$xnb . 'd'];
						$log = '错误10交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
						$log .= 'ERR: 卖家更新冻结虚拟币出现误差,应该更新' . $amount . '账号余额' . $user_sell[$xnb . 'd'] . '实际更新' . $save_sell_xnb;
						Log::write($log);
					}
					else {
						$log = '错误11交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
						$log .= 'ERR: 卖家更新冻结虚拟币出现错误,应该更新' . $amount . '账号余额' . $user_sell[$xnb . 'd'] . '进行错误处理';
						Log::write($log);
						M('Trade')->where(array('id' => $sell['id']))->setField('status', 1);
						break;
					}
				}

				if (!$save_buy_rmb) {
					$log = '错误12交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 买家更新数量出错错误,更新数量是' . $save_buy_rmb;
					Log::write($log);
					M('Trade')->where(array('id' => $buy['id']))->setField('status', 1);
					break;
				}

				if (!$save_sell_xnb) {
					$log = '错误13交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount . '成交价格' . $price . '成交总额' . $mum . "\n";
					$log .= 'ERR: 卖家更新数量出错错误,更新数量是' . $save_sell_xnb;
					Log::write($log);
					M('Trade')->where(array('id' => $sell['id']))->setField('status', 1);
					break;
				}

				$mo->execute('set autocommit=0');
				$mo->execute('lock tables qq3479015851_trade write ,qq3479015851_trade_log write ,qq3479015851_user write,qq3479015851_user_coin write,qq3479015851_invit write');
				$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $buy['id']))->setInc('deal', $amount);
				$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $sell['id']))->setInc('deal', $amount);
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setInc($xnb, $amount);
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setDec($rmb . 'd', $save_buy_rmb);
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $sell['userid']))->setInc($rmb, $sell_save);
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $sell['userid']))->setDec($xnb . 'd', $save_sell_xnb);
				$rs[] = $mo->table('qq3479015851_trade_log')->add(array('userid' => $buy['userid'], 'peerid' => $sell['userid'], 'market' => $market, 'price' => $price, 'num' => $amount, 'mum' => $mum, 'type' => $type, 'fee_buy' => $buy_fee, 'fee_sell' => $sell_fee, 'addtime' => time(), 'status' => 1));
				$buy_list = $mo->table('qq3479015851_trade')->where(array('id' => $buy['id'], 'status' => 0))->find();

				if ($buy_list) {
					if ($buy_list['num'] <= $buy_list['deal']) {
						$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $buy['id']))->setField('status', 1);
					}
				}

				$sell_list = $mo->table('qq3479015851_trade')->where(array('id' => $sell['id'], 'status' => 0))->find();

				if ($sell_list) {
					if ($sell_list['num'] <= $sell_list['deal']) {
						$rs[] = $mo->table('qq3479015851_trade')->where(array('id' => $sell['id']))->setField('status', 1);
					}
				}

				if ($price < $buy['price']) {
					$chajia_dong = round((($amount * $buy['price']) / 100) * (100 + $fee_buy), 8);
					$chajia_shiji = round((($amount * $price) / 100) * (100 + $fee_buy), 8);
					$chajia = round($chajia_dong - $chajia_shiji, 8);

					if ($chajia) {
						$chajia_user_buy = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->find();

						if ($chajia <= round($chajia_user_buy[$rmb . 'd'], 8)) {
							$chajia_save_buy_rmb = $chajia;
						}
						else if ($chajia <= round($chajia_user_buy[$rmb . 'd'], 8) + 1) {
							$chajia_save_buy_rmb = $chajia_user_buy[$rmb . 'd'];
							Log::write('错误91交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount, '成交价格' . $price . '成交总额' . $mum . "\n");
							Log::write('交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '成交数量' . $amount . '交易方式：' . $type . '卖家更新冻结虚拟币出现误差,应该更新' . $chajia . '账号余额' . $chajia_user_buy[$rmb . 'd'] . '实际更新' . $chajia_save_buy_rmb);
						}
						else {
							Log::write('错误92交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '交易方式：' . $type . '成交数量' . $amount, '成交价格' . $price . '成交总额' . $mum . "\n");
							Log::write('交易市场' . $market . '出错：买入订单:' . $buy['id'] . '卖出订单：' . $sell['id'] . '成交数量' . $amount . '交易方式：' . $type . '卖家更新冻结虚拟币出现错误,应该更新' . $chajia . '账号余额' . $chajia_user_buy[$rmb . 'd'] . '进行错误处理');
							$mo->execute('rollback');
							$mo->execute('unlock tables');
							M('Trade')->where(array('id' => $buy['id']))->setField('status', 1);
							M('Trade')->execute('commit');
							break;
						}

						if ($chajia_save_buy_rmb) {
							$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setDec($rmb . 'd', $chajia_save_buy_rmb);
							$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setInc($rmb, $chajia_save_buy_rmb);
						}
					}
				}

				$you_buy = $mo->table('qq3479015851_trade')->where(array(
					'market' => array('like', '%' . $rmb . '%'),
					'status' => 0,
					'userid' => $buy['userid']
					))->find();
				$you_sell = $mo->table('qq3479015851_trade')->where(array(
					'market' => array('like', '%' . $xnb . '%'),
					'status' => 0,
					'userid' => $sell['userid']
					))->find();

				if (!$you_buy) {
					$you_user_buy = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->find();

					if (0 < $you_user_buy[$rmb . 'd']) {
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setField($rmb . 'd', 0);
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $buy['userid']))->setInc($rmb, $you_user_buy[$rmb . 'd']);
					}
				}

				if (!$you_sell) {
					$you_user_sell = $mo->table('qq3479015851_user_coin')->where(array('userid' => $sell['userid']))->find();

					if (0 < $you_user_sell[$xnb . 'd']) {
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $sell['userid']))->setField($xnb . 'd', 0);
						$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $sell['userid']))->setInc($rmb, $you_user_sell[$xnb . 'd']);
					}
				}

				$invit_buy_user = $mo->table('qq3479015851_user')->where(array('id' => $buy['userid']))->find();
				$invit_sell_user = $mo->table('qq3479015851_user')->where(array('id' => $sell['userid']))->find();

				if ($invit_buy) {
					if ($invit_1) {
						if ($buy_fee) {
							if ($invit_buy_user['invit_1']) {
								$invit_buy_save_1 = round(($buy_fee / 100) * $invit_1, 6);

								if ($invit_buy_save_1) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_buy_user['invit_1']))->setInc($rmb, $invit_buy_save_1);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_buy_user['invit_1'], 'invit' => $buy['userid'], 'name' => '一代买入赠送', 'type' => $market . '买入交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_buy_save_1, 'addtime' => time(), 'status' => 1));
								}
							}

							if ($invit_buy_user['invit_2']) {
								$invit_buy_save_2 = round(($buy_fee / 100) * $invit_2, 6);

								if ($invit_buy_save_2) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_buy_user['invit_2']))->setInc($rmb, $invit_buy_save_2);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_buy_user['invit_2'], 'invit' => $buy['userid'], 'name' => '二代买入赠送', 'type' => $market . '买入交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_buy_save_2, 'addtime' => time(), 'status' => 1));
								}
							}

							if ($invit_buy_user['invit_3']) {
								$invit_buy_save_3 = round(($buy_fee / 100) * $invit_3, 6);

								if ($invit_buy_save_3) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_buy_user['invit_3']))->setInc($rmb, $invit_buy_save_3);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_buy_user['invit_3'], 'invit' => $buy['userid'], 'name' => '三代买入赠送', 'type' => $market . '买入交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_buy_save_3, 'addtime' => time(), 'status' => 1));
								}
							}
						}
					}

					if ($invit_sell) {
						if ($sell_fee) {
							if ($invit_sell_user['invit_1']) {
								$invit_sell_save_1 = round(($sell_fee / 100) * $invit_1, 6);

								if ($invit_sell_save_1) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_sell_user['invit_1']))->setInc($rmb, $invit_sell_save_1);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_sell_user['invit_1'], 'invit' => $sell['userid'], 'name' => '一代卖出赠送', 'type' => $market . '卖出交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_sell_save_1, 'addtime' => time(), 'status' => 1));
								}
							}

							if ($invit_sell_user['invit_2']) {
								$invit_sell_save_2 = round(($sell_fee / 100) * $invit_2, 6);

								if ($invit_sell_save_2) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_sell_user['invit_2']))->setInc($rmb, $invit_sell_save_2);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_sell_user['invit_2'], 'invit' => $sell['userid'], 'name' => '二代卖出赠送', 'type' => $market . '卖出交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_sell_save_2, 'addtime' => time(), 'status' => 1));
								}
							}

							if ($invit_sell_user['invit_3']) {
								$invit_sell_save_3 = round(($sell_fee / 100) * $invit_3, 6);

								if ($invit_sell_save_3) {
									$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $invit_sell_user['invit_3']))->setInc($rmb, $invit_sell_save_3);
									$rs[] = $mo->table('qq3479015851_invit')->add(array('userid' => $invit_sell_user['invit_3'], 'invit' => $sell['userid'], 'name' => '三代卖出赠送', 'type' => $market . '卖出交易赠送', 'num' => $amount, 'mum' => $mum, 'fee' => $invit_sell_save_3, 'addtime' => time(), 'status' => 1));
								}
							}
						}
					}
				}

				if (check_arr($rs)) {
					$mo->execute('commit');
					$mo->execute('unlock tables');
					$new_trade_qq3479015851 = 1;
					$coin = $xnb;
					S('allsum', null);
					S('getJsonTop' . $market, null);
					S('getTradelog' . $market, null);
					S('getDepth' . $market . '1', null);
					S('getDepth' . $market . '3', null);
					S('getDepth' . $market . '4', null);
					S('ChartgetJsonData' . $market, null);
					S('allcoin', null);
					S('trends', null);
				}
				else {
					$mo->execute('rollback');
					$mo->execute('unlock tables');
				}
			}
			else {
				break;
			}

			unset($rs);
		}

		if ($new_trade_qq3479015851) {
			$new_price = round(M('TradeLog')->where(array('market' => $market, 'status' => 1))->order('id desc')->getField('price'), 6);
			$buy_price = round(M('Trade')->where(array('type' => 1, 'market' => $market, 'status' => 0))->max('price'), 6);
			$sell_price = round(M('Trade')->where(array('type' => 2, 'market' => $market, 'status' => 0))->min('price'), 6);
			$min_price = round(M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array('gt', time() - (60 * 60 * 24))
				))->min('price'), 6);
			$max_price = round(M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array('gt', time() - (60 * 60 * 24))
				))->max('price'), 6);
			$volume = round(M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array('gt', time() - (60 * 60 * 24))
				))->sum('num'), 6);
			$sta_price = round(M('TradeLog')->where(array(
				'market'  => $market,
				'status'  => 1,
				'addtime' => array('gt', time() - (60 * 60 * 24))
				))->order('id asc')->getField('price'), 6);
			$Cmarket = M('Market')->where(array('name' => $market))->find();

			if ($Cmarket['new_price'] != $new_price) {
				$upCoinData['new_price'] = $new_price;
			}

			if ($Cmarket['buy_price'] != $buy_price) {
				$upCoinData['buy_price'] = $buy_price;
			}

			if ($Cmarket['sell_price'] != $sell_price) {
				$upCoinData['sell_price'] = $sell_price;
			}

			if ($Cmarket['min_price'] != $min_price) {
				$upCoinData['min_price'] = $min_price;
			}

			if ($Cmarket['max_price'] != $max_price) {
				$upCoinData['max_price'] = $max_price;
			}

			if ($Cmarket['volume'] != $volume) {
				$upCoinData['volume'] = $volume;
			}

			$change = round((($new_price - $Cmarket['hou_price']) / $Cmarket['hou_price']) * 100, 4);
			$upCoinData['change'] = $change;

			if ($upCoinData) {
				M('Market')->where(array('name' => $market))->save($upCoinData);
				M('Market')->execute('commit');
				S('home_market', null);
			}
		}
	}

	public function mywt($id)
	{
		if (!($uid = $this->userid())) {
			$this->error('请先登录！');
		}

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
}

?>