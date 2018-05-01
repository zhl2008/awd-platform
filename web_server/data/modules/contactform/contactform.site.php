<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

function contactform_theme_main() {
	global $lang;

	//Define some variables.
	if (isset($_POST['contactform_name']))
		$name = $_POST['contactform_name'];
	if (isset($_POST['contactform_sender']))
		$sender = $_POST['contactform_sender'];
	if (isset($_POST['contactform_message']))
		$message = $_POST['contactform_message'];

	//If the the contactform was submitted.
	if (isset($_POST['submit'])) {
		//Check if all fields were filled.
		if ($name && $sender && $message) {
			//Sanitize the fields and set extra headers.
			//N.B. strstr would be neater, but needs PHP >= 5.3 for $before_needle param
			if(strpos($name, "\r\n"))
				$name = substr($name, 0, strpos($name, "\r\n"));
			if(strpos($sender, "\r\n"))
				$sender = substr($sender, 0, strpos($sender, "\r\n"));
			//Set email headers.
			$extra_headers = 'From: =?utf-8?B?'.base64_encode($name).'?= <'.$sender.'>'."\r\n";
			$extra_headers .= "X-Originating-IP: [".$_SERVER['REMOTE_ADDR']."]\r\n";
			$extra_headers .= "MIME-Version: 1.0\r\n";
			$extra_headers .= "Content-type: text/plain; charset=utf-8\r\n";
			$extra_headers .= "Content-Transfer-Encoding: 8bit\r\n";
			//Check if we can set envelope sender.
			if(isset($_SERVER['SERVER_ADMIN'])) {
				$mail_user = $_SERVER['SERVER_ADMIN'];
				$extra_headers .= "Sender: $mail_user\r\n";
				$sendmail_params = "-f$mail_user";
			}
			else
				$sendmail_params = NULL;

			//Now we're going to send our email.
			if (mail(EMAIL, '=?utf-8?B?'.base64_encode($lang['contactform']['email_title'].' '.$name).'?=', $message, $extra_headers, $sendmail_params))
				echo '<p class="error">'.$lang['contactform']['been_send'].'</p>';
			//If email couldn't be sent.
			else
				echo '<p class="error">'.$lang['contactform']['not_send'].'</p>';
		}
		//If not all fields were filled.
		else
			echo '<p class="error">'.$lang['contactform']['fields'].'</p>';
	}

	//Then show the contactform.
	?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" id="contactform">
			<div>
				<label for="contactform_name"><?php echo $lang['general']['name']; ?></label>
				<br />
				<input name="contactform_name" id="contactform_name" type="text" />
				<br />
				<label for="contactform_sender"><?php echo $lang['general']['email']; ?></label>
				<br />
				<input name="contactform_sender" id="contactform_sender" type="text" />
				<br />
				<label for="contactform_message"><?php echo $lang['general']['message']; ?></label>
				<br />
				<textarea name="contactform_message" id="contactform_message" rows="7" cols="45"></textarea>
				<br />
				<input type="submit" name="submit" value="<?php echo $lang['general']['send']; ?>" />
			</div>
		</form>
	<?php
}
?>
