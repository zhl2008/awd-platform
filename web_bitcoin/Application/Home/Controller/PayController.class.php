<?php
namespace Home\Controller;

class PayController extends HomeController
{
	public function index()
	{
		if (IS_POST) {
			if (isset($_POST['alipay'])) {
				$arr = explode('--', $_POST['alipay']);

				if (md5('qq3479015851') != $arr[2]) {
					echo -1;
					exit();
				}

				if (!strstr($arr[0], 'Pay')) {
				}

				$arr[0] = trim(str_replace(PHP_EOL, '', $arr[0]));
				$arr[1] = trim(str_replace(PHP_EOL, '', $arr[1]));

				if (strstr($arr[0], '付款-')) {
					$arr[0] = str_replace('付款-', '', $arr[0]);
				}

				$mycz = M('Mycz')->where(array('tradeno' => $arr[0]))->find();

				if (!$mycz) {
					echo -3;
					exit();
				}

				if (($mycz['status'] != 0) && ($mycz['status'] != 3)) {
					echo -4;
					exit();
				}

				if ($mycz['num'] != $arr[1]) {
					echo -5;
					exit();
				}

				$mo = M();
				$mo->execute('set autocommit=0');
				$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_mycz write,qq3479015851_finance write');
				$rs = array();
				$finance = $mo->table('qq3479015851_finance')->where(array('userid' => $mycz['userid']))->order('id desc')->find();
				$finance_num_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mycz['userid']))->find();
				$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mycz['userid']))->setInc('cny', $mycz['num']);
				$rs[] = $mo->table('qq3479015851_mycz')->where(array('id' => $mycz['id']))->save(array('status' => 1, 'mum' => $mycz['num'], 'endtime' => time()));
				$finance_mum_user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mycz['userid']))->find();
				$finance_hash = md5($mycz['userid'] . $finance_num_user_coin['cny'] . $finance_num_user_coin['cnyd'] . $mycz['num'] . $finance_mum_user_coin['cny'] . $finance_mum_user_coin['cnyd'] . MSCODE . 'auth.qq3479015851.com');
				$finance_num = $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'];

				if ($finance['mum'] < $finance_num) {
					$finance_status = (1 < ($finance_num - $finance['mum']) ? 0 : 1);
				}
				else {
					$finance_status = (1 < ($finance['mum'] - $finance_num) ? 0 : 1);
				}

				$rs[] = $mo->table('qq3479015851_finance')->add(array('userid' => $mycz['userid'], 'coinname' => 'cny', 'num_a' => $finance_num_user_coin['cny'], 'num_b' => $finance_num_user_coin['cnyd'], 'num' => $finance_num_user_coin['cny'] + $finance_num_user_coin['cnyd'], 'fee' => $mycz['num'], 'type' => 1, 'name' => 'mycz', 'nameid' => $mycz['id'], 'remark' => '人民币充值-人工到账', 'mum_a' => $finance_mum_user_coin['cny'], 'mum_b' => $finance_mum_user_coin['cnyd'], 'mum' => $finance_mum_user_coin['cny'] + $finance_mum_user_coin['cnyd'], 'move' => $finance_hash, 'addtime' => time(), 'status' => $finance_status));

				if (check_arr($rs)) {
					$mo->execute('commit');
					$mo->execute('unlock tables');
					echo 1;
					exit();
				}
				else {
					$mo->execute('rollback');
					$mo->query('rollback');
					echo -6;
					exit();
				}
			}
		}
	}

	public function movepay()
	{
		if (IS_POST) {
			$movepay = $_POST['movepay'];
			$tradeno = $_POST['tradeno'];
			$num = $_POST['num'];
			$status = $_POST['status'];

			if (md5('qq3479015851') != $movepay) {
				echo -1;
				exit();
			}

			$mycz = M('Mycz')->where(array('tradeno' => $tradeno))->find();

			if (!$mycz) {
				echo -2;
				exit();
			}

			if ($mycz['status']) {
				echo -3;
				exit();
			}

			if ($mycz['num'] != $num) {
				echo -4;
				exit();
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables qq3479015851_user_coin write,qq3479015851_mycz write');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => $mycz['userid']))->setInc('cny', $mycz['num']);
			$rs[] = $mo->table('qq3479015851_mycz')->where(array('id' => $mycz['id']))->save(array('status' => 1, 'mum' => $mycz['num'], 'endtime' => time()));

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->redirect('Mycz/log');
				exit();
			}
			else {
				$mo->execute('rollback');
				$mo->query('rollback');
				echo -5;
				exit();
			}
		}
	}

	public function mycz($id = NULL)
	{
		if (check($id, 'd')) {
			$mycz = M('Mycz')->where(array('id' => $id))->find();

			if (!$mycz) {
				$this->redirect('Finance/mycz');
			}

			$myczType = M('MyczType')->where(array('name' => $mycz['type']))->find();

			if ($mycz['type'] == 'bank') {
				$UserBankType = M('UserBankType')->where(array('status' => 1))->order('id desc')->select();
				$this->assign('UserBankType', $UserBankType);
			}

			$this->assign('myczType', $myczType);
			$this->assign('mycz', $mycz);
			$this->display($mycz['type']);
		}
		else {
			$this->redirect('Finance/mycz');
		}
	}

	public function ecpss($id = NULL)
	{
		if (!userid()) {
			$this->error('请先登录！');
		}

		if (empty($id)) {
			$this->error('参数错误！');
		}

		$mycz = M('Mycz')->where(array('id' => $id))->find();

		if (!$mycz) {
			$this->error('订单不存在！');
		}

		if ($mycz['userid'] != userid()) {
			$this->error('参数非法！');
		}

		$this->error('订单不存在！');
	}
}

?>