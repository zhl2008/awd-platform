<?php
namespace Mapi\Controller;

class LoginController extends CommonController
{
	public function chkUser($username)
	{
		if (!check($username, 'username')) {
			$this->error('用户名格式错误！');
		}

		if (M('User')->where(array('username' => $username))->find()) {
			$this->error('用户名已存在');
		}

		$this->success('ok');
	}

	public function submit($username, $password)
	{
		if (check($username, 'email')) {
			$user = M('User')->where(array('email' => $username))->find();
			$remark = '通过邮箱登录';
		}

		if (!$user && check($username, 'moble')) {
			$user = M('User')->where(array('moble' => $username))->find();
			$remark = '通过手机号登录';
		}

		if (!$user) {
			$user = M('User')->where(array('username' => $username))->find();
			$remark = '通过用户名登录';
		}

		$check_time = 10;
		$check_times = 5;
		$username_msg = md5($username);
		$ltimes = (int) S('LOGIN_ERR_TIMES_' . $username_msg);

		if ($check_times <= $ltimes) {
			$ltime = S('LOGIN_ERR_TIME_' . $username_msg);
			$ltime = time() - $ltime;

			if ($check_time <= $ltime) {
				S('LOGIN_ERR_TIMES_' . $username_msg, 0);
				$this->error('密码错误锁定解除,请再次尝试');
			}

			$min = $check_time - $ltime;
			$this->error('密码错误次数过多,请' . $min . ' s后尝试！');
		}

		if (!$user) {
			$this->error('用户不存在！');
		}

		if (!check($password, 'password')) {
			$this->error('登录密码格式错误！');
		}

		if (md5($password) != $user['password']) {
			S('LOGIN_ERR_TIMES_' . $username_msg, ++$ltimes);
			S('LOGIN_ERR_TIME_' . $username_msg, time());
			$this->error('登录密码错误,还有' . (($check_times - $ltimes) + 1) . ' 次机会');
		}

		if ($user['status'] != 1) {
			$this->error('你的账号已冻结请联系管理员！');
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user write , qq3479015851_user_log write ');
		$rs = array();
		$rs[] = $mo->table('qq3479015851_user')->where(array('id' => $user['id']))->setInc('logins', 1);
		$rs[] = $mo->table('qq3479015851_user_log')->add(array('userid' => $user['id'], 'type' => 'APP登录', 'remark' => $remark, 'addtime' => time(), 'addip' => get_client_ip(), 'addr' => get_city_ip(), 'status' => 1));

		if (check_arr($rs)) {
			if (!$token = $user['token']) {
				$token = md5(md5(rand(0, 10000) . md5(time()), md5(uniqid())));
				M('User')->where(array('id' => $user['id']))->setField('token', $token);
			}

			S('APP_AUTH_ID_' . $user['id'], $token);
			$mo->execute('commit');
			$mo->execute('unlock tables');

			if (!$user['invit']) {
				for (; true; ) {
					$tradeno = tradenoa();

					if (!M('User')->where(array('invit' => $tradeno))->find()) {
						break;
					}
				}

				M('User')->where(array('id' => $user['id']))->setField('invit', $tradeno);
			}

			$this->success(array('ID' => $user['id'], 'TOKEN' => $token, 'msg' => '登录成功！'));
		}
		else {
			$mo->execute('rollback');
			$this->error('登录失败！');
		}
	}

	public function loginout()
	{
		$uid = $this->userid();
		M('User')->where(array('id' => $uid))->setField('token', '');
		S('APP_AUTH_ID_' . $uid, null);
		$this->ajaxShow('退出成功');
	}

	public function findpwd()
	{
		if (IS_POST) {
			$input = I('post.');

			if (!check_verify(strtoupper($input['verify']))) {
				$this->error('图形验证码错误!');
			}

			if (!check($input['username'], 'username')) {
				$this->error('用户名格式错误！');
			}

			if (!check($input['moble'], 'moble')) {
				$this->error('手机号码格式错误！');
			}

			if (!check($input['moble_verify'], 'd')) {
				$this->error('短信验证码格式错误！');
			}

			if ($input['moble_verify'] != session('findpwd_verify')) {
				$this->error('短信验证码错误！');
			}

			$user = M('User')->where(array('username' => $input['username']))->find();

			if (!$user) {
				$this->error('用户名不存在！');
			}

			if ($user['moble'] != $input['moble']) {
				$this->error('用户名或手机号码错误！');
			}

			if (!check($input['password'], 'password')) {
				$this->error('新登录密码格式错误！');
			}

			if ($input['password'] != $input['repassword']) {
				$this->error('确认密码错误！');
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables qq3479015851_user write , qq3479015851_user_log write ');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user')->where(array('id' => $user['id']))->save(array('password' => md5($input['password'])));

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->success('修改成功');
			}
			else {
				$mo->execute('rollback');
				$this->error('修改失败');
			}
		}
		else {
			$this->display();
		}
	}

	public function findpaypwd()
	{
		if (IS_POST) {
			$input = I('post.');

			if (!check($input['username'], 'username')) {
				$this->error('用户名格式错误！');
			}

			if (!check($input['moble'], 'moble')) {
				$this->error('手机号码格式错误！');
			}

			if (!check($input['moble_verify'], 'd')) {
				$this->error('短信验证码格式错误！');
			}

			if ($input['moble_verify'] != session('findpaypwd_verify')) {
				$this->error('短信验证码错误！');
			}

			$user = M('User')->where(array('username' => $input['username']))->find();

			if (!$user) {
				$this->error('用户名不存在！');
			}

			if ($user['moble'] != $input['moble']) {
				$this->error('用户名或手机号码错误！');
			}

			if (!check($input['password'], 'password')) {
				$this->error('新交易密码格式错误！');
			}

			if ($input['password'] != $input['repassword']) {
				$this->error('确认密码错误！');
			}

			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables qq3479015851_user write , qq3479015851_user_log write ');
			$rs = array();
			$rs[] = $mo->table('qq3479015851_user')->where(array('id' => $user['id']))->save(array('paypassword' => md5($input['password'])));

			if (check_arr($rs)) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
				$this->success('修改成功');
			}
			else {
				$mo->execute('rollback');
				$this->error('修改失败' . $mo->table('qq3479015851_user')->getLastSql());
			}
		}
		else {
			$this->display();
		}
	}

	public function check_reg($username, $mobile, $password, $verify, $invit)
	{
		if (!check($username, 'username')) {
			$this->error('用户名格式错误！');
		}

		if (!check($mobile, 'moble')) {
			$this->error('手机号格式错误！');
		}

		if (!check($password, 'password')) {
			$this->error('登录密码格式错误！');
		}

		$code = S('sendMobile_code_' . $mobile);

		if ($verify != $code) {
			$this->error('短信验证码错误！');
		}

		if ($invit && !check($invit, 'username')) {
			$this->error('邀请码格式错误！');
		}

		if (M('User')->where(array('username' => $username))->find()) {
			$this->error('用户名已存在');
		}

		if (M('User')->where(array('moble' => $mobile))->find()) {
			$this->error('手机号已存在');
		}

		$reg_code = md5(round(0, 100) . time());
		S($reg_code, $reg_code);
		$this->ajaxShow(array('reg_code' => $reg_code), 11);
	}

	public function reg($username, $mobile, $password, $invit, $truename, $idcard, $paypassword, $reg_code)
	{
		if (!check($username, 'username')) {
			$this->ajaxShow('用户名格式错误！', -5);
		}

		if (!check($mobile, 'moble')) {
			$this->ajaxShow('手机号格式错误！', -5);
		}

		if (!check($password, 'password')) {
			$this->ajaxShow('登录密码格式错误！', -5);
		}

		if ($reg_code != S($reg_code)) {
			$this->ajaxShow('注册超时...', -5);
		}

		if ($invit && !check($invit, 'username')) {
			$this->error('邀请码格式错误！', -5);
		}

		if (M('User')->where(array('username' => $username))->find()) {
			$this->error('用户名已存在');
		}

		if (M('User')->where(array('moble' => $mobile))->find()) {
			$this->error('手机号已存在');
		}

		if (!check($paypassword, 'password')) {
			$this->error('交易密码格式错误！');
		}

		if (!check($truename, 'truename')) {
			$this->error('真实姓名格式不对！');
		}

		if (!check($idcard, 'idcard')) {
			$this->error('身份证格式不对！');
		}

		if (!$invit) {
			$invit = session('invit');
		}

		$invituser = M('User')->where(array('invit' => $invit))->find();

		if (!$invituser) {
			$invituser = M('User')->where(array('id' => $invit))->find();
		}

		if (!$invituser) {
			$invituser = M('User')->where(array('username' => $invit))->find();
		}

		if (!$invituser) {
			$invituser = M('User')->where(array('moble' => $invit))->find();
		}

		if ($invituser) {
			$invit_1 = $invituser['id'];
			$invit_2 = $invituser['invit_1'];
			$invit_3 = $invituser['invit_2'];
		}
		else {
			$invit_1 = 0;
			$invit_2 = 0;
			$invit_3 = 0;
		}

		for (; true; ) {
			$tradeno = tradenoa();

			if (!M('User')->where(array('invit' => $tradeno))->find()) {
				break;
			}
		}

		$mo = M();
		$mo->execute('set autocommit=0');
		$mo->execute('lock tables qq3479015851_user write , qq3479015851_user_coin write ');
		$rs = array();
		$rs[] = $mo->table('qq3479015851_user')->add(array('username' => $username, 'password' => md5($password), 'invit' => $tradeno, 'idcard' => $idcard, 'moble' => $mobile, 'truename' => $truename, 'paypassword' => $paypassword, 'tpwdsetting' => 1, 'invit_1' => $invit_1, 'invit_2' => $invit_2, 'invit_3' => $invit_3, 'addip' => get_client_ip(), 'addr' => get_city_ip(), 'addtime' => time(), 'status' => 1));
		$rs[] = $mo->table('qq3479015851_user_coin')->add(array('userid' => $rs[0]));

		if (check_arr($rs)) {
			$mo->execute('commit');
			$mo->execute('unlock tables');
			$this->success('注册成功');
		}
		else {
			$this->error('注册失败！');
		}
	}

	public function sendMoble($moble)
	{
		if (!check($moble, 'moble')) {
			$this->ajaxShow('手机号码格式错误！', -1);
		}

		if (M('User')->where(array('moble' => $moble))->find()) {
			$this->error('手机号已存在');
		}

		$reg_session_id = md5(round(0, 1000) . time());
		$code = rand(1000, 9999);
		S('sendMobile_code_' . $moble, $code);
		$this->ajaxShow(array('session_id' => $reg_session_id, 'msg' => '验证码已发送到:' . $moble . '(' . $code . ')'));
	}

	public function sendForgetCode($moble)
	{
		if (!check($moble, 'moble')) {
			$this->ajaxShow('手机号码格式错误！', -1);
		}

		if (!M('User')->where(array('moble' => $moble))->find()) {
			$this->ajaxShow('当前手机号未注册！', -1);
		}

		$code = rand(1000, 9999);
		S('sendForgetMoble_' . $moble, $moble);
		S('sendForgetCode_' . $moble, $code);
		$this->ajaxShow('验证码已发送到:' . $moble . '(' . $code . ')');
	}

	public function forgetSave($moble, $verify_code, $password, $paypassword)
	{
		$v_moble = S('sendForgetMoble_' . $moble);
		$v_code = S('sendForgetCode_' . $moble);

		if (($moble != $v_moble) || ($verify_code != $v_code)) {
			$this->ajaxShow('验证码错误！', -1);
		}
		else {
			S('sendForgetMoble_' . $moble, null);
			S('sendForgetCode_' . $moble, null);
		}

		$user = M('User')->where(array('moble' => $moble))->find();

		if ($user['password'] == md5(trim($password))) {
			$this->ajaxShow('新登录密码和旧的一样！', -1);
		}

		if ($user['paypassword'] == md5(trim($paypassword))) {
			$this->ajaxShow('新交易密码和旧的一样！', -1);
		}

		$user['password'] = md5(trim($password));
		$user['paypassword'] = md5(trim($paypassword));

		if (M('user')->save($user)) {
			$this->ajaxShow('修改成功,前往登陆');
		}
		else {
			$this->ajaxShow('修改失败', -1);
		}
	}
}

?>