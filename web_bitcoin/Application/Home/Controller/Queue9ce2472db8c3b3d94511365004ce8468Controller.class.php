<?php
namespace Home\Controller;

class Queue9ce2472db8c3b3d94511365004ce8468Controller extends HomeController
{

	public function index()
	{
		foreach (C('market') as $k => $v) {
			
		}

		foreach (C('coin_list') as $k => $v) {
			
		}
	}

	public function checkYichang()
	{
		
		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_trade write');
		$Trade = M('Trade')->where('deal > num')->order('id desc')->find();

		if ($Trade) {
			if ($Trade['status'] == 0) {
				$mo->table('qq3479015851_trade')->where(array('id' => $Trade['id']))->save(array('deal' => Num($Trade['num']), 'status' => 1));
			}
			else {
				$mo->table('qq3479015851_trade')->where(array('id' => $Trade['id']))->save(array('deal' => Num($Trade['num'])));
			}

			$mo->execute('commit');
			$mo->execute('unlock tables');
		}
		else {
			$mo->execute('rollback');
			$mo->execute('unlock tables');
		}
	}

	public function checkDapan()
	{
		foreach (C('market') as $k => $v) {
			A('Trade')->matchingTrade($v['name']);
		}
	}

	public function checkUsercoin()
	{
		foreach (C('coin') as $k => $v) {
			
		}
	}

	public function marketandcoinb8c3b3d94512472db8()
	{
		foreach (C('market') as $k => $v) {
			$this->setMarket($v['name']);
		}

		foreach (C('coin_list') as $k => $v) {
			$this->setcoin($v['name']);
		}
	}

	public function setMarket($market = NULL)
	{
		if (!$market) {
			return null;
		}

		$market_json = M('Market_json')->where(array('name' => $market))->order('id desc')->find();

		if ($market_json) {
			$addtime = $market_json['addtime'] + 60;
		}
		else {
			$addtime = M('TradeLog')->where(array('market' => $market))->order('addtime asc')->find()['addtime'];
		}

		$t = $addtime;
		$start = mktime(0, 0, 0, date('m', $t), date('d', $t), date('Y', $t));
		$end = mktime(23, 59, 59, date('m', $t), date('d', $t), date('Y', $t));
		$trade_num = M('TradeLog')->where(array(
			'market'  => $market,
			'addtime' => array(
				array('egt', $start),
				array('elt', $end)
				)
			))->sum('num');

		if ($trade_num) {
			$trade_mum = M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum('mum');
			$trade_fee_buy = M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum('fee_buy');
			$trade_fee_sell = M('TradeLog')->where(array(
				'market'  => $market,
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum('fee_sell');
			$d = array($trade_num, $trade_mum, $trade_fee_buy, $trade_fee_sell);

			if (M('Market_json')->where(array('name' => $market, 'addtime' => $end))->find()) {
				M('Market_json')->where(array('name' => $market, 'addtime' => $end))->save(array('data' => json_encode($d)));
			}
			else {
				M('Market_json')->add(array('name' => $market, 'data' => json_encode($d), 'addtime' => $end));
			}
		}
		else {
			$d = null;

			if (M('Market_json')->where(array('name' => $market, 'data' => ''))->find()) {
				M('Market_json')->where(array('name' => $market, 'data' => ''))->save(array('addtime' => $end));
			}
			else {
				M('Market_json')->add(array('name' => $market, 'data' => '', 'addtime' => $end));
			}
		}
	}

	public function setcoin($coinname = NULL)
	{
		if (!$coinname) {
			return null;
		}

		if (C('coin')[$coinname]['type'] == 'qbb') {
			$dj_username = C('coin')[$coinname]['dj_yh'];
			$dj_password = C('coin')[$coinname]['dj_mm'];
			$dj_address = C('coin')[$coinname]['dj_zj'];
			$dj_port = C('coin')[$coinname]['dj_dk'];
			$CoinClient = CoinClient($dj_username, $dj_password, $dj_address, $dj_port, 5, array(), 1);
			$json = $CoinClient->getinfo();

			if (!isset($json['version']) || !$json['version']) {
				return null;
			}

			$data['trance_mum'] = $json['balance'];
		}
		else {
			$data['trance_mum'] = 0;
		}

		$market_json = M('CoinJson')->where(array('name' => $coinname))->order('id desc')->find();

		if ($market_json) {
			$addtime = $market_json['addtime'] + 60;
		}
		else {
			$addtime = M('Myzr')->where(array('name' => $coinname))->order('id asc')->find()['addtime'];
		}

		$t = $addtime;
		$start = mktime(0, 0, 0, date('m', $t), date('d', $t), date('Y', $t));
		$end = mktime(23, 59, 59, date('m', $t), date('d', $t), date('Y', $t));

		if ($addtime) {
			if ((time() + (60 * 60 * 24)) < $addtime) {
				return null;
			}

			$trade_num = M('UserCoin')->where(array(
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum($coinname);
			$trade_mum = M('UserCoin')->where(array(
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum($coinname . 'd');
			$aa = $trade_num + $trade_mum;

			if (C($coinname)['type'] == 'qbb') {
				$bb = $json['balance'];
			}
			else {
				$bb = 0;
			}

			$trade_fee_buy = M('Myzr')->where(array(
				'name'    => $coinname,
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum('fee');
			$trade_fee_sell = M('Myzc')->where(array(
				'name'    => $coinname,
				'addtime' => array(
					array('egt', $start),
					array('elt', $end)
					)
				))->sum('fee');
			$d = array($aa, $bb, $trade_fee_buy, $trade_fee_sell);

			if (M('CoinJson')->where(array('name' => $coinname, 'addtime' => $end))->find()) {
				M('CoinJson')->where(array('name' => $coinname, 'addtime' => $end))->save(array('data' => json_encode($d)));
			}
			else {
				M('CoinJson')->add(array('name' => $coinname, 'data' => json_encode($d), 'addtime' => $end));
			}
		}
	}

	public function paicuo()
	{

	}

	public function houpriceb8c3b3d94512472db8()
	{
		foreach (C('market') as $k => $v) {
			if (!$v['hou_price'] || (date('H', time()) == '00')) {
				$t = time();
				$start = mktime(0, 0, 0, date('m', $t), date('d', $t), date('Y', $t));
				$hou_price = M('TradeLog')->where(array(
					'market'  => $v['name'],
					'addtime' => array('lt', $start)
					))->order('id desc')->getField('price');

				if (!$hou_price) {
					$hou_price = M('TradeLog')->where(array('market' => $v['name']))->order('id asc')->getField('price');
				}

				M('Market')->where(array('name' => $v['name']))->setField('hou_price', $hou_price);
				S('home_market', null);
			}
		}
	}

	public function qianbaob8c3b3d94512472db8()
	{
		$coinList = M('Coin')->where(array('status' => 1))->select();

		foreach ($coinList as $k => $v) {
			if ($v['type'] != 'qbb') {
				continue;
			}

			$coin = $v['name'];

			if (!$coin) {
				echo 'MM';
				continue;
			}

			$dj_username = C('coin')[$coin]['dj_yh'];
			$dj_password = C('coin')[$coin]['dj_mm'];
			$dj_address = C('coin')[$coin]['dj_zj'];
			$dj_port = C('coin')[$coin]['dj_dk'];
			echo 'start ' . $coin . "\n";
			$CoinClient = CoinClient($dj_username, $dj_password, $dj_address, $dj_port, 5, array(), 1);
			$json = $CoinClient->getinfo();

			if (!isset($json['version']) || !$json['version']) {
				echo '###ERR#####***** ' . $coin . ' connect fail***** ####ERR####>' . "\n";
				continue;
			}

			echo 'Cmplx ' . $coin . ' start,connect ' . (empty($CoinClient) ? 'fail' : 'ok') . ' :' . "\n";
			$listtransactions = $CoinClient->listtransactions('*', 100, 0);
			echo 'listtransactions:' . count($listtransactions) . "\n";
			krsort($listtransactions);

			foreach ($listtransactions as $trans) {
				if (!$trans['account']) {
					echo 'empty account continue' . "\n";
					continue;
				}

				if (!($user = M('User')->where(array('username' => $trans['account']))->find())) {
					echo 'no account find continue' . "\n";
					continue;
				}

				if (M('Myzr')->where(array('txid' => $trans['txid'], 'status' => '1'))->find()) {
					echo 'txid had found continue' . "\n";
					continue;
				}

				echo 'all check ok ' . "\n";

				if ($trans['category'] == 'receive') {
					print_r($trans);
					echo 'start receive do:' . "\n";
					$sfee = 0;
					$true_amount = $trans['amount'];

					if (C('coin')[$coin]['zr_zs']) {
						$song = round(($trans['amount'] / 100) * C('coin')[$coin]['zr_zs'], 8);

						if ($song) {
							$sfee = $song;
							$trans['amount'] = $trans['amount'] + $song;
						}
					}

					if ($trans['confirmations'] < C('coin')[$coin]['zr_dz']) {
						echo $trans['account'] . ' confirmations ' . $trans['confirmations'] . ' not elengh ' . C('coin')[$coin]['zr_dz'] . ' continue ' . "\n";
						echo 'confirmations <  c_zr_dz continue' . "\n";

						if ($res = M('myzr')->where(array('txid' => $trans['txid']))->find()) {
							M('myzr')->save(array('id' => $res['id'], 'addtime' => time(), 'status' => intval($trans['confirmations'] - C('coin')[$coin]['zr_dz'])));
						}
						else {
							M('myzr')->add(array('userid' => $user['id'], 'username' => $trans['address'], 'coinname' => $coin, 'fee' => $sfee, 'txid' => $trans['txid'], 'num' => $true_amount, 'mum' => $trans['amount'], 'addtime' => time(), 'status' => intval($trans['confirmations'] - C('coin')[$coin]['zr_dz'])));
						}

						continue;
					}
					else {
						echo 'confirmations full' . "\n";
					}

					$mo = M();
					$mo->execute('set autocommit=0');
					$mo->execute('lock tables  qq3479015851_user_coin write , qq3479015851_myzr  write ');
					$rs = array();
					$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $user['id']))->setInc($coin, $trans['amount']);

					if ($res = $mo->table('qq3479015851_myzr')->where(array('txid' => $trans['txid']))->find()) {
						echo 'qq3479015851_myzr find and set status 1';
						$rs[] = $mo->table('qq3479015851_myzr')->save(array('id' => $res['id'], 'addtime' => time(), 'status' => 1));
					}
					else {
						echo 'qq3479015851_myzr not find and add a new qq3479015851_myzr' . "\n";
						$rs[] = $mo->table('qq3479015851_myzr')->add(array('userid' => $user['id'], 'username' => $trans['address'], 'coinname' => $coin, 'fee' => $sfee, 'txid' => $trans['txid'], 'num' => $true_amount, 'mum' => $trans['amount'], 'addtime' => time(), 'status' => 1));
					}

					if (check_arr($rs)) {
						$mo->execute('commit');
						echo $trans['amount'] . ' receive ok ' . $coin . ' ' . $trans['amount'];
						$mo->execute('unlock tables');
						echo 'commit ok' . "\n";
					}
					else {
						echo $trans['amount'] . 'receive fail ' . $coin . ' ' . $trans['amount'];
						echo var_export($rs, true);
						$mo->execute('rollback');
						$mo->execute('unlock tables');
						print_r($rs);
						echo 'rollback ok' . "\n";
					}
				}
			}

			if ($trans['category'] == 'send') {
				echo 'start send do:' . "\n";

				if (3 <= $trans['confirmations']) {
					$myzc = M('Myzc')->where(array('txid' => $trans['txid']))->find();

					if ($myzc) {
						if ($myzc['status'] == 0) {
							M('Myzc')->where(array('txid' => $trans['txid']))->save(array('status' => 1));
							echo $trans['amount'] . '成功转出' . $coin . ' 币确定';
						}
					}
				}
			}
		}
	}

	public function syn_qianbao()
	{
	}

	public function tendencyb8c3b3d94512472db8()
	{
		foreach (C('market') as $k => $v) {
			echo '----计算趋势----' . $v['name'] . '------------';
			$tendency_time = 4;
			$t = time();
			$tendency_str = $t - (24 * 60 * 60 * 3);
			$x = 0;

			for (; $x <= 18; $x++) {
				$na = $tendency_str + (60 * 60 * $tendency_time * $x);
				$nb = $tendency_str + (60 * 60 * $tendency_time * ($x + 1));
				$b = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $v['name'] . '\'')->max('price');

				if (!$b) {
					$b = 0;
				}

				$rs[] = array($na, $b);
			}

			M('Market')->where(array('name' => $v['name']))->setField('tendency', json_encode($rs));
			unset($rs);
			echo '计算成功!';
			echo "\n";
		}

		echo '趋势计算0k ' . "\n";
	}

	public function chartb8c3b3d94512472db8()
	{
		foreach (C('market') as $k => $v) {
			$this->setTradeJson($v['name']);
		}

		echo '计算行情0k ' . "\n";
	}

	public function setTradeJson($market)
	{
		$timearr = array(1, 3, 5, 10, 15, 30, 60, 120, 240, 360, 720, 1440, 10080);

		foreach ($timearr as $k => $v) {
			$tradeJson = M('TradeJson')->where(array('market' => $market, 'type' => $v))->order('id desc')->find();

			if ($tradeJson) {
				$addtime = $tradeJson['addtime'];
			}
			else {
				$addtime = M('TradeLog')->where(array('market' => $market))->order('id asc')->getField('addtime');
			}

			if ($addtime) {
				$youtradelog = M('TradeLog')->where('addtime >=' . $addtime . '  and market =\'' . $market . '\'')->sum('num');
			}

			if ($youtradelog) {
				if ($v == 1) {
					$start_time = $addtime;
				}
				else {
					$start_time = mktime(date('H', $addtime), floor(date('i', $addtime) / $v) * $v, 0, date('m', $addtime), date('d', $addtime), date('Y', $addtime));
				}

				$x = 0;

				for (; $x <= 20; $x++) {
					$na = $start_time + (60 * $v * $x);
					$nb = $start_time + (60 * $v * ($x + 1));

					if (time() < $na) {
						break;
					}

					$sum = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $market . '\'')->sum('num');

					if ($sum) {
						$sta = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $market . '\'')->order('id asc')->getField('price');
						$max = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $market . '\'')->max('price');
						$min = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $market . '\'')->min('price');
						$end = M('TradeLog')->where('addtime >=' . $na . ' and addtime <' . $nb . ' and market =\'' . $market . '\'')->order('id desc')->getField('price');
						$d = array($na, $sum, $sta, $max, $min, $end);

						if (M('TradeJson')->where(array('market' => $market, 'addtime' => $na, 'type' => $v))->find()) {
							M('TradeJson')->where(array('market' => $market, 'addtime' => $na, 'type' => $v))->save(array('data' => json_encode($d)));
						}
						else {
							$aa = M('TradeJson')->add(array('market' => $market, 'data' => json_encode($d), 'addtime' => $na, 'type' => $v));
							M('TradeJson')->execute('commit');
							M('TradeJson')->where(array('market' => $market, 'data' => '', 'type' => $v))->delete();
							M('TradeJson')->execute('commit');
						}
					}
					else {
						M('TradeJson')->add(array('market' => $market, 'data' => '', 'addtime' => $na, 'type' => $v));
						M('TradeJson')->execute('commit');
					}
				}
			}
		}

		return '计算成功!';
	}
	
	
	public function upTrade_qq3479015851_8a201aa602cd9448($market = NULL)
	{

		$type = rand(1, 2);
		
		if (!$market) {
			$market = C('market_mr');
		}
		
		if (!C('market')[$market]) {
			echo '交易市场错误';
			die();
		}
		else {
			$xnb = explode('_', $market)[0];
			$rmb = explode('_', $market)[1];
		}
		
		$url = 'http://www.jubi.com/api/v1/ticker/?coin='.$xnb;
		$content = file_get_contents($url);
		$content = json_decode($content, true);
		
		$wei = 1000;
		
		if(floatval($content['buy'])<10){
			$wei = 100000;
		}
		
		if(floatval($content['sell'])<10){
			$wei = 100000;
		}

		$min_price = floatval($content['buy'])*$wei;
		$max_price = floatval($content['sell'])*$wei;
		
		
		if($xnb == "doge"){
			$min_price = 22001;
			$max_price = 22999;
			$price = round(rand($min_price, $max_price)/1000000, 6);
			
		}else{
			
		
			if($max_price<$min_price){
				$temps = $min_price;
				$min_price = $max_price;
				$max_price = $temps;
			}
			
			
			
			$price = round(rand($min_price, $max_price)/$wei, 6);
			
		}
		

		
		
		if($xnb == "btc"){
			$max_num = round(10.9999 * 10000, 6);
			$min_num = round(0.9999 * 10000, 6);
			$num = round(rand($min_num, $max_num) / 10000,6);
		}elseif($xnb == "doge"){
			$max_num = round(100000.999999, 6);
			$min_num = round(80000.999999, 6);
			$num = round(rand($min_num, $max_num),6);
		}else{
			$max_num = round(99.9999 * 10000, 6);
			$min_num = round(1.9999 * 10000, 6);
			$num = round(rand($min_num, $max_num) / 10000,6);
		}
		
		
		
		
		if (!$price) {
			echo '交易价格格式错误';
			die();
		}

		if (!check($num, 'double')) {
			echo '交易数量格式错误';
			die();
		}

		if (($type != 1) && ($type != 2)) {
			echo '交易类型格式错误';
			die();
		}

		// TODO: SEPARATE

		$price = round(floatval($price), 6);

		if (!$price) {
			echo '交易价格错误';
			die();
		}

		$num = round(trim($num), 6);

		if (!check($num, 'double')) {
			echo '交易数量错误';
			die();
		}

		$mum = round($num * $price, 6);

		if (!$rmb) {
			echo '数据错误1';
			die();
		}

		if (!$xnb) {
			echo '数据错误2';
			die();
		}

		if (!$market) {
			echo '数据错误3';
			die();
		}

		if (!$price) {
			echo '数据错误4';
			die();
		}

		if (!$num) {
			echo '数据错误5';
			die();
		}

		if (!$mum) {
			echo '数据错误6';
			die();
		}

		if (!$type) {
			echo '数据错误7';
			die();
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_trade write ');
		$rs = array();

		if ($type == 1) {
			$rs[] = $mo->table('qq3479015851_trade')->add(array('userid' => 0, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => 0, 'type' => 1, 'addtime' => time(), 'status' => 0));
		}
		else if ($type == 2) {
			$rs[] = $mo->table('qq3479015851_trade')->add(array('userid' => 0, 'market' => $market, 'price' => $price, 'num' => $num, 'mum' => $mum, 'fee' => 0, 'type' => 2, 'addtime' => time(), 'status' => 0));
		}
		else {
			$mo->execute('rollback');
			$mo->execute('unlock tables');
			echo '交易类型错误';
			die();
		}

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			A('Trade')->matchingAutoTrade($market);
			echo '交易成功！';
		}
		else {
			$mo->execute('rollback');
			$mo->execute('unlock tables');
			echo  '交易失败！';
		}
	}
}

?>
