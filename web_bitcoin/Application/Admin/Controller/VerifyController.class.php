<?php
namespace Admin\Controller;

class VerifyController extends \Think\Controller
{
	public function code()
	{
        ob_clean();
        $config['useNoise'] = false;
		$config['length'] = 4;
		$config['codeSet'] = '0123456789';
		$verify = new \Think\Verify($config);
		$verify->entry(1);
	}

	public function mobile()
	{
		if (IS_POST) {
			if (check($_POST['mobile'], 'mobile')) {
				$mobile = $_POST['mobile'];
			}
			else {
				$this->error('手机号码格式错误!');
			}

			if (empty($_POST['type'])) {
				$this->error('短信模版名称错误!');
			}

			$Configmobile = D('ConfigMobile')->where(array('id' => $_POST['type']))->find();

			if ($Configmobile) {
				$code = rand(111111, 999999);
				session('mobilecode', $code);
				$content = str_replace('[url]', $code, $Configmobile['content']);
			}
			else {
				$this->error('短信模版错误!');
			}

			C('MOBILE_URL', $_POST['mobile_url']);
			C('MOBILE_USER', $_POST['mobile_user']);
			C('MOBILE_PASS', $_POST['mobile_pass']);
		}

		if (0 < send_moble($mobile, $content)) {
			$this->success('短信发送成功!');
		}
		else {
			$this->error('短信发送失败!');
		}
	}

	public function email()
	{
		if (IS_POST) {
			if (check($_POST['email'], 'email')) {
				$email = $_POST['email'];
			}
			else {
				$this->error('邮件格式错误!');
			}

			if (empty($_POST['type'])) {
				$this->error('邮件模版名称错误!');
			}

			$Configemail = D('ConfigEmail')->where(array('id' => $_POST['type']))->find();

			if ($Configemail) {
				$code = rand(111111, 999999);
				session('emailcode', $code);
				$content = str_replace('[url]', $code, $Configemail['content']);
				$title = $Configemail['title'];
			}
			else {
				$this->error('邮件模版错误!');
			}

			C('SMTP_HOST', $_POST['smtp_host']);
			C('SMTP_PORT', $_POST['smtp_port']);
			C('SMTP_USER', $_POST['smtp_user']);
			C('SMTP_PASS', $_POST['smtp_pass']);
			C('SMTP_NAME', $_POST['smtp_name']);
			C('SMTP_EMAIL', $_POST['smtp_email']);
		}

		if (send_email($email, $title, $content)) {
			$this->success('邮件发送成功!');
		}
		else {
			$this->error('邮件发送失败!');
		}
	}
}

?>