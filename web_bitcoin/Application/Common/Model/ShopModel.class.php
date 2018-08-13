<?php
namespace Common\Model;

class ShopModel extends \Think\Model
{
	protected $keyS = 'Shop';

	public function check_coin()
	{
		$check_coin = (APP_DEBUG ? null : S('check_coin' . $this->keyS));

		if (!$check_coin) {
			$coin_list = C('coin');

			if (is_array($coin_list)) {
				foreach ($coin_list as $k => $v) {
					$coin_arr[$v['name']] = $v['title'];
				}

				unset($k);
				unset($v);
			}
			else {
				$coin_arr = null;
			}

			if ($coin_arr) {
				$Shop_Coin_DbFields = M('ShopCoin')->getDbFields();

				foreach ($coin_arr as $k => $v) {
					if (!in_array($k, $Shop_Coin_DbFields)) {
						M()->execute('ALTER TABLE `qq3479015851_shop_coin` ADD COLUMN `' . $k . '` VARCHAR(50) NOT NULL  COMMENT \'' . $v . '\' AFTER `shopid`;');
					}
				}
			}

			S('check_coin' . $this->keyS, 1);
		}
	}

	public function shop_type_list()
	{
		$shop_type_list = (APP_DEBUG ? null : S('shop_type_list' . $this->keyS));

		if (!$shop_type_list) {
			$list = M('ShopType')->where(array('status' => 1))->select();

			if ($list) {
				foreach ($list as $k => $v) {
					$shop_type_list[$v['name']] = $v['title'];
				}
			}
			else {
				$shop_type_list = null;
			}

			S('shop_type_list' . $this->keyS, $shop_type_list);
		}

		return $shop_type_list;
	}

	public function getShopName($id = NULL)
	{
		if (empty($id)) {
			return null;
		}

		$shop_getShopName = (APP_DEBUG ? null : S('shop_getShopName' . $id . $this->keyS));

		if (!$shop_getShopName) {
			$shop_getShopName = M('Shop')->where(array('id' => $id))->getField('name');
			S('shop_getShopName' . $id . $this->keyS, $shop_getShopName);
		}

		return $shop_getShopName;
	}

	public function getShopId($name = NULL)
	{
		if (empty($name)) {
			return null;
		}

		$shop_getShopId = (APP_DEBUG ? null : S('shop_getShopId' . $this->keyS));

		if (!$shop_getShopId) {
			$shop_getShopId = M('Shop')->where(array(
				'name' => array('like', '%' . $name . '%')
				))->getField('id');
			S('shop_getShopId' . $this->keyS, $shop_getShopId);
		}

		return $shop_getShopId;
	}

	public function tongbu()
	{
		$shop_tongbu = (APP_DEBUG ? null : S('shop_tongbu' . $this->keyS));

		if (!$shop_tongbu) {
			$shop_list = M('Shop')->select();
			$shop_coin_list = M('ShopCoin')->select();

			if (is_array($shop_coin_list)) {
				foreach ($shop_coin_list as $k => $v) {
					$shop_coin_arr[$v['shopid']] = $v['id'];
				}
			}

			if (is_array($shop_list)) {
				foreach ($shop_list as $k => $v) {
					$shop_list_arr[$v['id']] = $v;

					if (!$shop_coin_arr[$v['id']]) {
						M('ShopCoin')->add(array('shopid' => $v['id']));
					}
				}
			}

			if (is_array($shop_coin_list) && is_array($shop_list)) {
				foreach ($shop_coin_list as $k => $v) {
					$shop_coin_arr[$v['shopid']] = $v['id'];

					if (!$shop_list_arr[$v['shopid']]) {
						M('ShopCoin')->where(array('id' => $v['id']))->delete();
					}
				}
			}

			S('shop_tongbu' . $this->keyS, 1);
		}
	}

	public function fangshi($shopid = NULL)
	{
		if (empty($shopid)) {
			return null;
		}

		$shop_fangshi = (APP_DEBUG ? null : S('shop_fangshi' . $this->keyS . $shopid));

		if (!$shop_fangshi) {
			$list = M('ShopCoin')->where(array('shopid' => $shopid))->find();

			foreach ($list as $k => $v) {
				if (($k != 'id') && ($k != 'shopid')) {
					if ($v) {
						if ($k == 'cny') {
							$shop_fangshi[$k] = 1;
						}
						else {
							$new_price = D('Market')->get_new_price($k . '_cny');

							if ($new_price) {
								$shop_fangshi[$k] = $new_price;
							}
							else {
								$shop_fangshi[$k] = 1;
							}
						}
					}
				}
			}

			S('shop_fangshi' . $this->keyS . $shopid, $shop_fangshi);
		}

		return $shop_fangshi;
	}

	public function get_goods($userid = NULL)
	{
		if (empty($userid)) {
			return null;
		}

		$shop_get_goods = (APP_DEBUG ? null : S('shop_get_goods' . $this->keyS . $userid));

		if (!$shop_get_goods) {
			$list = M('UserGoods')->where(array('userid' => $userid))->select();

			foreach ($list as $k => $v) {
				$shop_get_goods[$v['id']] = $v['name'];
			}

			S('shop_get_goods' . $this->keyS . $userid, $shop_get_goods);
		}

		return $shop_get_goods;
	}

	public function setStatus($id = NULL, $type = NULL, $moble = 'Shop')
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