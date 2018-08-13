<?php
namespace Mapi\Controller;

class ChartController extends CommonController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'Chart ok';
	}

	public function getChart($marketid = NULL)
	{
		if (!$marketid) {
			$this->ajaxShow(array('marketid 不能为空'), -1);
		}

		$marketid = intval($marketid);

		if (!($marketData = M('Market')->where(array('id' => $marketid))->find())) {
			$this->ajaxShow(array('marketid 不存在'), -1);
		}

		if (!($ret = S('APP_getChart_ID_' . $marketid))) {
			$timearr = array(1, 5, 30, 60, 10080);

			foreach ($timearr as $val) {
				$key = '5m';

				switch ($val) {
				case 1:
					$key = '1m';
					break;

				case 5:
					$key = '5m';
					break;

				case 30:
					$key = '30m';
					break;

				case 60:
					$key = '1h';
					break;

				case 10080:
					$key = '8h';
				}

				$tradeJson[$key] = M('TradeJson')->where(array(
					'market' => $marketData['name'],
					'type'   => $val,
					'data'   => array('neq', '')
					))->order('id asc')->limit('300')->select();
			}

			$ret = array();
			$ret['symbol'] = 'LKC_CNY';
			$ret['symbol_view'] = 'LKC/CNY';
			$ret['ask'] = 1.2;

			foreach ($tradeJson as $k => $v) {
				foreach ($v as $k2 => $val2) {
					$val2['data'] = json_decode($val2['data'], true);
					$val2['data'][0] = floatval($val2['data'][0] . '000');
					$val2['data'][1] = floatval($val2['data'][1]) + rand(0, 10);
					$val2['data'][1] = floatval($val2['data'][3]) + rand(0, 10);
					$val2['data'][1] = floatval($val2['data'][4]) + rand(0, 10);
					$ret['time_line'][$k][] = $val2['data'];
				}
			}

			unset($tradeJson);
			S('APP_getChart_ID_' . $marketid, $ret, 10);
		}

		$this->ajaxShow($ret);
	}

	public function depth($marketid)
	{
		if (!$marketid) {
			$this->ajaxShow(array('marketid 不能为空'), -1);
		}

		$marketid = intval($marketid);

		if (!($marketData = M('Market')->where(array('id' => $marketid))->find())) {
			$this->ajaxShow(array('marketid 不存在'), -1);
		}

		$market = $marketData['name'];
		$mo = M();
		$buy = $mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=1 and market =\'' . $market . '\' group by price order by price desc limit 100;');
		$sell = $mo->query('select id,price,sum(num-deal)as nums from qq3479015851_trade where status=0 and type=2 and market =\'' . $market . '\' group by price order by price asc limit 100;');

		if ($buy) {
			$sun = 0;

			foreach ($buy as $k => $v) {
				$sun += $v['nums'];
				$data['depth']['buy'][$k] = array(floatval($v['price'] * 1), floatval($sun * 1), floatval($v['nums'] * 1));
			}
		}
		else {
			$data['depth']['buy'] = '';
		}

		if ($sell) {
			$sun = 0;

			foreach ($sell as $k => $v) {
				$sun += $v['nums'];
				$data['depth']['sell'][$k] = array(floatval($v['price'] * 1), floatval($sun * 1), floatval($v['nums'] * 1));
			}
		}
		else {
			$data['depth']['sell'] = '';
		}

		$this->ajaxShow(array($data['depth']['buy'], $data['depth']['sell']));
	}

	public function showP()
	{
		$market_id = intval(I('market_id'));
		$i = 0;

		for (; $i < 10; $i++) {
			$value = rand(1, 200) + $market_id;
			$value_y[] = $value;
		}

		$this->line_stats_pic($value_y, 100, 30, 1, 1);
	}

	protected function line_stats_pic($value_y, $width, $high, $strong = 1, $fix = 0)
	{
		function line_point_y($num, $width, $high, $max_num_add, $min_num_add, $y_pxdensity)
		{
			$return = $high - floor((($num - $min_num_add) + $y_pxdensity) / ($max_num_add - $min_num_add) / $high);
			return $return;
		}

		$allnum = sizeof($value_y);
		$max_num = max($value_y);
		$min_num = min($value_y);
		$limit_m = $max_num - $min_num;
		$max_num_add = $max_num + ($limit_m * 0.10000000000000001);
		$min_num_add = $min_num - ($limit_m * 0.10000000000000001);
		$limit = $max_num_add - $min_num_add;
		$y_pxdensity = ($max_num_add - $min_num_add) / $high;
		$x_pxdensity = floor($width / $allnum);
		reset($value_y);
		$i = 0;

		foreach ($value_y as $val) {
			$point_y[$i] = line_point_y($val, $width, $high, $max_num_add, $min_num_add, $y_pxdensity);
			$i++;
		}

		$zero_y = line_point_y(0, $width, $high, $max_num_add, $min_num_add, $y_pxdensity);
		$empty_size_x = 0;
		header('Content-type:image/png');
		$pic = imagecreate($width + $empty_size_x + 10, $high + 13);
		imagecolorallocatealpha($pic, 0, 0, 0, 127);
		$color_1 = imagecolorallocate($pic, 229, 86, 0);
		$point_x = 0;
		$j = 0;
		imagesetthickness($pic, $strong);

		while (($j + 1) < $allnum) {
			imageline($pic, $point_x + 2 + $empty_size_x, $point_y[$j], $point_x + $x_pxdensity + 2 + $empty_size_x, $point_y[$j + 1], $color_1);
			$point_x += $x_pxdensity;
			$j++;
		}

		imagepng($pic);
		imagedestroy($pic);
	}
}

?>