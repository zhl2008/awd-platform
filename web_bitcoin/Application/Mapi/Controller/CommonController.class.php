<?php
namespace Mapi\Controller;

class CommonController extends \Think\Controller
{
	protected function _initialize()
	{
		$config = (APP_DEBUG ? null : S('home_config'));

		if (!$config) {
			$config = M('Config')->where(array('id' => 1))->find();
			S('home_config', $config);
		}

		if (!$config['web_close']) {
			$this->ajaxShow($config['web_close_cause'], '-44');
			exit();
		}

		C($config);
		$coin = (APP_DEBUG ? null : S('home_coin'));

		if (!$coin) {
			$coin = M('Coin')->where(array('status' => 1))->select();
			S('home_coin', $coin);
		}

		$coinList = array();

		foreach ($coin as $k => $v) {
			$coinList['coin'][$v['name']] = $v;

			if ($v['name'] != 'cny') {
				$coinList['coin_list'][$v['name']] = $v;
			}

			if ($v['type'] == 'rmb') {
				$coinList['rmb_list'][$v['name']] = $v;
			}
			else {
				$coinList['xnb_list'][$v['name']] = $v;
			}

			if ($v['type'] == 'rgb') {
				$coinList['rgb_list'][$v['name']] = $v;
			}

			if ($v['type'] == 'qbb') {
				$coinList['qbb_list'][$v['name']] = $v;
			}
		}

		C($coinList);
		$market = (APP_DEBUG ? null : S('home_market'));

		if (!$market) {
			$market = M('Market')->where(array('status' => 1))->select();
			S('home_market', $market);
		}

		foreach ($market as $k => $v) {
			$v['new_price'] = round($v['new_price'], $v['round']);
			$v['buy_price'] = round($v['buy_price'], $v['round']);
			$v['sell_price'] = round($v['sell_price'], $v['round']);
			$v['min_price'] = round($v['min_price'], $v['round']);
			$v['max_price'] = round($v['max_price'], $v['round']);
			$v['xnb'] = explode('_', $v['name'])[0];
			$v['rmb'] = explode('_', $v['name'])[1];
			$v['xnbimg'] = C('coin')[$v['xnb']]['img'];
			$v['rmbimg'] = C('coin')[$v['rmb']]['img'];
			$v['volume'] = $v['volume'] * 1;
			$v['change'] = $v['change'] * 1;
			$v['title'] = C('coin')[$v['xnb']]['title'] . '(' . strtoupper($v['xnb']) . '/' . strtoupper($v['rmb']) . ')';
			$marketList['market'][$v['name']] = $v;
		}

		C($marketList);
	}

	protected function ajaxShow($data, $msg = 1)
	{
		$arr['status'] = $msg;
		$arr['data'] = $data;
		echo json_encode($arr);
		exit();
	}

	protected function error($msg)
	{
		$this->ajaxShow($msg, 0);
	}

	protected function success($msg)
	{
		$this->ajaxShow($msg);
	}

	protected function userid($type = 0)
	{
		if (!$_SERVER['HTTP_ID'] || !$_SERVER['HTTP_TOKEN']) {
			if ($uid = userid()) {
				return $uid;
			}

			if (!$type) {
				$this->ajaxShow('请登录', -99);
			}
			else {
				return null;
			}
		}

		$user_id = intval(trim($_SERVER['HTTP_ID']));

		if (S('APP_AUTH_ID_' . $user_id) == trim($_SERVER['HTTP_TOKEN'])) {
			return $user_id;
		}
		else {
			if ($uid = userid()) {
				return $uid;
			}

			if ($res = M('User')->where(array('id' => $user_id))->field('token')->find()) {
				if ($res['token'] == trim($_SERVER['HTTP_TOKEN'])) {
					S('APP_AUTH_ID_' . $user_id, $res['token']);
					return $user_id;
				}
			}

			if (!$type) {
				$this->ajaxShow('请登录', -99);
			}
			else {
				return null;
			}
		}
	}

	protected function mankRand($min = 1, $max = 100, $n = 2)
	{
		$int_n = rand($min, $max);
		$float_n = rand(0, 9) / pow(10, $n);
		return $int_n + $float_n;
	}

	protected function doNums($arr, $k = 'width')
	{
		if (!is_array($arr)) {
			return false;
		}

		$nums = $sums = 0;

		foreach ($arr as $val) {
			$sums += $val[$k];
			$nums++;
		}

		$pres = (2 * $sums) / $nums;

		foreach ($arr as $key => $val) {
			$arr[$key][$k] = ($pres < $val[$k] ? '100' : intval(($val[$k] * 100) / $pres));
		}

		return $arr;
	}

	protected function dataHash($var)
	{
		if (!is_array($var)) {
			return md5($var);
		}
		else {
			return md5(serialize($var));
		}
	}
}

?>