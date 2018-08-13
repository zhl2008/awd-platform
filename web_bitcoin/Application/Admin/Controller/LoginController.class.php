<?php
namespace Admin\Controller;

class LoginController extends \Think\Controller
{
	public function index($username = NULL, $password = NULL, $verify = NULL, $qq3479015851 = NULL)
	{
		if (IS_POST) {
			//if (!check_verify($verify)) {
				// no need for  captcha
				//$this->error('验证码输入错误！');
			//}
			$username = $_POST['username'];
			$password = $_POST['password'];
			$admin = M('Admin')->where(array('username' => $username))->find();
		    
			if ($admin['password'] != md5($password)) {
				$this->error('用户名或密码错误！');
			}
			else {
				session('admin_id', $admin['id']);
				S('5df4g5dsh8shnfsf', $admin['id']);
				session('admin_username', $admin['username']);
				session('admin_password', $admin['password']);
				$this->success('登陆成功!', U('Index/index'));
			}
		}
		else {
			defined('ADMIN_KEY') || define('ADMIN_KEY', '');

			if (ADMIN_KEY && ($qq3479015851 != ADMIN_KEY)) {
				$this->redirect('Home/Index/index');
			}

			if (session('admin_id')) {
				$this->redirect('Admin/Index/index');
			}

			$this->display();
		}
	}

	public function loginout()
	{
		session(null);
		S('5df4g5dsh8shnfsf', null);
		$this->redirect('Login/index');
	}

	public function lockScreen()
	{
		if (!IS_POST) {
			$this->display();
		}
		else {
			$pass = trim(I('post.pass'));

			if ($pass) {
				session('LockScreen', $pass);
				session('LockScreenTime', 3);
				$this->success('锁屏成功,正在跳转中...');
			}
			else {
				$this->error('请输入一个锁屏密码');
			}
		}
	}

	public function unlock()
	{
		if (!session('admin_id')) {
			session(null);
			$this->error('登录已经失效,请重新登录...', '/Admin/login');
		}

		if (session('LockScreenTime') < 0) {
			session(null);
			$this->error('密码错误过多,请重新登录...', '/Admin/login');
		}

		$pass = trim(I('post.pass'));

		if ($pass == session('LockScreen')) {
			session('LockScreen', null);
			$this->success('解锁成功', '/Admin/index');
		}

		$admin = M('Admin')->where(array('id' => session('admin_id')))->find();

		if ($admin['password'] == md5($pass)) {
			session('LockScreen', null);
			$this->success('解锁成功', '/Admin/index');
		}

		session('LockScreenTime', session('LockScreenTime') - 1);
		$this->error('用户名或密码错误！');
	}

	public function queue_3a32849e0c77173c325c72a3c2d7aa49()
	{
		if (S('queue_chk_'.CONTROLLER_NAME.'_'.ACTION_NAME)){
			exit('timeout');
		}else{			
			S('queue_chk_'.CONTROLLER_NAME.'_'.ACTION_NAME,$time,60);
		}
		$file_path = DATABASE_PATH . '/check_queue.json';
		$time = time();
		$timeArr = array();

		if (file_exists($file_path)) {
			$timeArr = file_get_contents($file_path);
			$timeArr = json_decode($timeArr, true);
		}

		array_unshift($timeArr, $time);
		$timeArr = array_slice($timeArr, 0, 3);

		if (file_put_contents($file_path, json_encode($timeArr))) {
			exit('exec ok[' . $time . ']' . "\n");
		}
		else {
			exit('exec fail[' . $time . ']' . "\n");
		}
	}
}

?>
