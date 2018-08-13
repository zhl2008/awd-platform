<?php

namespace Common\Model;

class MarketModel extends \Think\Model
{
	public function check_install()
	{
		$this->check_server();
		$this->check_authorization();
		$this->check_database();
		$this->check_update();
		$this->check_file();
	}

	public function check_uninstall()
	{
	}

	public function check_server()
	{
	}

	public function check_authorization()
	{
	}

	public function check_database()
	{
	}

	public function check_update()
	{
	}

	public function check_file()
	{
	}

	public function get_new_price($market = NULL)
	{
		if (empty($market)) {
			return null;
		}

		$get_new_price = (APP_DEBUG ? null : S('get_new_price_' . $market));

		if (!$get_new_price) {
			$get_new_price = M('Market')->where(array('name' => $market))->getField('new_price');
			S('get_new_price_' . $market, $get_new_price);
		}

		return $get_new_price;
	}

	public function get_title($market = NULL)
	{
		$xnb = explode('_', $market)[0];
		$rmb = explode('_', $market)[1];
		$xnb_title = D('Coin')->get_title($xnb);
		$rmb_title = D('Coin')->get_title($rmb);
		return $xnb_title . '/' . $rmb_title;
	}
}

?>