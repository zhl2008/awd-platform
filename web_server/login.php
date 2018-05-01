<?php
define('IN_CMS', true);

//Then start session support.
session_start();

//Include security-enhancements.
require_once ('data/inc/security.php');
//Include functions.
require_once ('data/inc/functions.modules.php');
require_once ('data/inc/functions.all.php');
//Include variables.
require_once ('data/inc/variables.all.php');

//Check if we've installed EasyCMS.
if (!file_exists('data/settings/install.dat')) {
	$titelkop = $lang['install']['not'];
	include_once ('data/inc/header2.php');
	redirect('install.php', 3);
	show_error($lang['install']['not_message'], 1);
	include_once('data/inc/footer.php');
}

//If EasyCMS is installed:
else {
	require_once ('data/settings/pass.php');

	//Check if we're already logged in. First, get the token.
	require_once ('data/settings/token.php');

	if (isset($_SESSION[$token]) && ($_SESSION[$token] == 'EasyCMS_loggedin')) {
		header('Location: admin.php');
		exit;
	}

	//Include header-file.
	$titelkop = $lang['login']['title'];
	include_once ('data/inc/header2.php');

	//If password has been sent, and the bogus input is empty, MD5-encrypt password.
	if (isset($_POST['submit']) && empty($_POST['bogus'])) {
		$pass = hash('sha512', $cont1);

		//Create hash from user-IP, for brute-force protection.
		define('LOGIN_ATTEMPT_FILE', 'data/settings/loginattempt_'.hash('sha512', $_SERVER['REMOTE_ADDR']).'.php');

		//Check if user has tried to login before.
		if (file_exists(LOGIN_ATTEMPT_FILE)) {
			require(LOGIN_ATTEMPT_FILE);
			//Determine the amount of seconds that a user will be blocked (300 = 5 minutes).
			$timestamp = $timestamp + 300;

			//Block access if user has tried 5 times.
			if (($tries == 5)) {
				//Check if time hasn't exceeded yet, then block user.
				if ($timestamp > time())
					$login_error = show_error($lang['login']['too_many_attempts'], 1, true);
				//If time has exceeded, unblock user.
				else
					unlink(LOGIN_ATTEMPT_FILE);
			}
		}

		//If password is correct, save session-cookie.
		if (($pass == $ww) && (!isset($login_error))) {
			$_SESSION[$token] = 'EasyCMS_loggedin';

			//Delete loginattempt file, if it exists.
			if (file_exists(LOGIN_ATTEMPT_FILE))
				unlink(LOGIN_ATTEMPT_FILE);

			//Display success message.
			show_error($lang['login']['correct'], 3);
			if (isset($_SESSION['EasyCMS_before']))
				redirect($_SESSION['EasyCMS_before'], 1);
			else
				redirect('admin.php?action=start', 1);
			include_once ('data/inc/footer.php');
			exit;
		}

		//If password is not correct; display error, and store attempt in loginattempt file for brute-force protection.
		elseif (($pass != $ww) && (!isset($login_error))) {
			$login_error = show_error($lang['login']['incorrect'], 1, true);

			//If a loginattempt file already exists, update tries variable.
			if (file_exists(LOGIN_ATTEMPT_FILE))
				$tries++;
			else
				$tries = 1;

			//Get current timestamp and save file.
			save_file (LOGIN_ATTEMPT_FILE, array('tries' => $tries, 'timestamp' => time()));
		}
	}
	?>
		<span class="kop2"><?php echo $lang['login']['password']; ?></span>
		<form action="" method="post">
			<input name="cont1" size="25" type="password" />
			<input type="text" name="bogus" style="display: none;" />
			<input type="submit" name="submit" value="<?php echo ucfirst($lang['login']['title']); ?>" />
		</form>
	<?php
	if (isset($login_error))
		echo $login_error;

	include_once ('data/inc/footer.php');
}
?>
