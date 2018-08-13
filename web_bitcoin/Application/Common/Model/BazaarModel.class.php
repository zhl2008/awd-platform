<?php
namespace Common\Model;

class BazaarModel extends \Think\Model
{
	protected $keyS = 'Bazaar';

	public function get_market_mr()
	{
		$get_market_mr = M('BazaarConfig')->where(array('default' => 1))->getField('market');

		if (!$get_market_mr) {
			$get_market_mr = M('BazaarConfig')->where(array('status' => 1))->order('id asc')->getField('market');
		}

		return $get_market_mr;
	}

	public function get_market_list()
	{
		$get_market_list = M('BazaarConfig')->where(array('status' => 1))->order('sort asc')->select();

		foreach ($get_market_list as $k => $v) {
			$get_market_list_data[$v['market']] = D('Market')->get_title($v['market']);
		}

		return $get_market_list_data;
	}
}

?>