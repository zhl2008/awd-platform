<?php
namespace Common\Model;

class HuafeiModel extends \Think\Model
{
	protected $key = 'Huafei';

	public function get_type($name = NULL, $status = 1)
	{
		$list = M('HuafeiType')->where(array('status' => $status))->select();

		if (!$list) {
			return null;
		}

		$data = array();

		foreach ($list as $k => $v) {
			$data[$v['name']] = $v['title'];
		}

		if ($name) {
			return $data[$name];
		}
		else {
			return $data;
		}
	}

	public function get_coin($name = NULL, $status = 1)
	{
		$list = (APP_DEBUG ? null : S('get_coin' . $this->keyS . $name . $status));

		if (!$list) {
			$list = M('HuafeiCoin')->where(array('status' => $status))->select();
			S('get_coin' . $this->keyS . $name . $status, $list);
		}

		$data = array();

/* 		foreach ($list as $k => $v) {
			$price = (empty($v['price']) ? D('Market')->get_new_price($v['coinname'] . '_cny') : $v['price']);
			$data[$v['coinname']] = array(D('Coin')->get_title($v['coinname']), Num($price));
		} */
		
		$market_type = array();
		$market = M('Market')->where(array('status' => 1))->select();
		foreach ($market as $k => $v) {
			$keykey= explode('_', $v['name'])[0];
			$market_type[$keykey]=$v['name'];
		}

		
		foreach ($list as $k => $v) {
			$price = (empty($v['price']) ? D('Market')->get_new_price($market_type[$v['coinname']]) : $v['price']);
			$data[$v['coinname']] = array(D('Coin')->get_title($v['coinname']), Num($price));
		}
		
		
		
		
		
		
		
		
		if ($name) {
			return $data[$name];
		}
		else {
			return $data;
		}
	}

	public function setStatus($id = NULL, $type = NULL, $moble = 'Huafei')
	{
		if (empty($id)) {
			return null;
		}

		if (empty($type)) {
			return null;
		}

		if (strpos(',', $id)) {
			$id = implode(',', $id);
		}

		$where['id'] = array('in', $id);

		switch (strtolower($type)) {
		case 'forbid':
			$data = array('status' => 0);
			break;

		case 'resume':
			$data = array('status' => 1);
			break;

		case 'repeal':
			$data = array('status' => 2, 'endtime' => time());
			break;

		case 'delete':
			$data = array('status' => -1);
			break;

		case 'del':
			if (M($moble)->where($where)->delete()) {
				return true;
			}
			else {
				return null;
			}

			break;

		default:
			return null;
		}

		if (M($moble)->where($where)->save($data)) {
			return true;
		}
		else {
			return null;
		}
	}
}

?>