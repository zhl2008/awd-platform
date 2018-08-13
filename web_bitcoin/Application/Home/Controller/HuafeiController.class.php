<?php
namespace Home\Controller;

class HuafeiController extends HomeController
{
	public function index()
	{
		if (empty($_POST)) {
			if (!userid()) {
				redirect('/#login');
			}

			$this->assign('prompt_text', D('Text')->get_content('game_huafei'));
			$user_coin = M('UserCoin')->where(array('userid' => userid()))->find();
			$user_coin['cny'] = round($user_coin['cny'], 2);
			$this->assign('user_coin', $user_coin);
			$this->assign('huafei_num', D('Huafei')->get_type());
			$this->assign('huafei_type', D('Huafei')->get_coin());
			$where['userid'] = userid();
			$where['status'] = array('neq', -1);
			$count = M('Huafei')->where($where)->count();
			$Page = new \Think\Page($count, 10);
			$show = $Page->show();
			$list = M('Huafei')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

			foreach ($list as $k => $v) {
				$list[$k]['type'] = C('coin')[$v['type']]['title'];
			}

			$this->assign('list', $list);
			$this->assign('page', $show);
			$this->display();
		}
		else {
			$moble = $_POST['moble'];
			$num = $_POST['num'];
			$type = $_POST['type'];
			$paypassword = $_POST['paypassword'];

			if (!check($moble, 'moble')) {
				$this->error('手机号码格式错误!');
			}

			if (!check($num, 'd')) {
				$this->error('充值金额格式错误!');
			}

			if (!check($type, 'n')) {
				$this->error('充值方式格式错误!');
			}

			if (!check($paypassword, 'password')) {
				$this->error('交易密码格式错误!');
			}

			if (!D('Huafei')->get_type($num)) {
				$this->error('充值金额不存在!');
			}

			$huafei_type = D('Huafei')->get_coin();

			if (!$huafei_type[$type]) {
				$this->error('充值方式不存在!');
			}

			if (!userid()) {
				$this->error('请先登录!');
			}

			$user = M('User')->where(array('id' => userid()))->find();

			if (!$user) {
				$this->error('用户不存在!');
			}

			if (!$user['status']) {
				session(null);
				$this->error('用户已冻结!');
			}

			if ($user['paypassword'] != md5($paypassword)) {
				$this->error('交易密码错误!');
			}

			$mum = round($num / $huafei_type[$type][1], 8);

			if ($mum < 0) {
				$this->error('付款金额错误!');
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables  qq3479015851_user_coin write  , qq3479015851_huafei write ');
			$rs = array();
			$user_coin = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->find();

			if (!$user_coin) {
				session(null);
				$this->error('用户财产错误,请重新登录!');
			}

			if ($user_coin[$type] < $mum) {
				$this->error('可用' . $huafei_type[$type][0] . '余额不足,总共需要支付' . $mum . ' ' . $huafei_type[$type][0]);
			}

			$rs[] = $mo->table('qq3479015851_user_coin')->where(array('userid' => userid()))->setDec($type, $mum);
			$rs[] = $huafei_id = $mo->table('qq3479015851_huafei')->add(array('userid' => userid(), 'moble' => $moble, 'num' => $num, 'type' => $type, 'mum' => $mum, 'addtime' => time(), 'status' => 0));

			if (C('huafei_zidong')) {
				if (huafei($moble, $num, md5($huafei_id))) {
					$rs[] = $mo->table('qq3479015851_huafei')->where(array('id' => $huafei_id))->save(array('endtime' => time(), 'status' => 1));
				}
			}

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->success('操作成功！');
			}
			else {
				$mo->execute('rollback');
				$this->error('操作失败!');
			}
		}
	}

	public function uninstall()
	{

	}
    
}

?>