<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

$stylesheet = "
	<style type='text/css'>
		body {background: #f2f2f2}
		.email_container {width: 700px; margin: 20px auto 0; background: #fff}
		.email_content {width: 100%; border: #ddd 1px solid; padding: 5px 15px 5px; background: #fff}
		.logo {padding-top:6px}
	</style>
";

$header = "
	<body>
	<div class='email_container'>
		<div class='email_content'>
			<img src='".IMAGES."email_logo.png' class='logo' />
			<p />
";

$footer = "";

class Email{
	
	public function send_email($to, $from, $subject, $message) {
 		$headers = 'From: '.$from."\r\n".
		// Uncomment below line to have all emails Blind Caron Coppied to the site owners email address. (Warning: Site owner will recieve every email sent from the site including emails containing unencrypted passwords.)
		// 'Bcc: '.SITE_OWNER."\r\n" .
		"Content-Type: text/html; charset=ISO-8859-1\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		//send email
		mail($to, $subject, $message, $headers);
		
	}

	public function email_template($template_name, $plain_password="", $username="", $email="", $hash="", $message="") {
		global $stylesheet;
		global $header;
		global $footer;
		
		if ($template_name == "registration_success") {
			// registration success template.
			$message = "
			{$stylesheet}
			{$header}
					<p>Your account at <a href='".WWW."'>".SITE_NAME."</a> has been successfully created.</p>
					<p>Username: {$username}
					<br />
					Password: {$plain_password} (Encrypted in our database.)</p>
			{$footer}";
			return $message;
		} else if ($template_name == "registration_activation") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>Your account at <a href='".WWW."'>".SITE_NAME."</a> has been successfully created.</p>
					<p>Username: {$username}
					<br />
					Password: {$plain_password} (Encrypted in our database.)</p>
					<p>However, you still need to activate your account, which you can do by clicking the following link: <br />
					<a href='".WWW."activate.php?email={$email}&hash={$hash}'>Activate Account</a></p>
					<p>If you are unable to click the above link you can still activate your account below.</p>
					<p>URL: ".WWW."activate.php <br />
					Confirm Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "resend_activation_code") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>You can activate your account by clicking on the following link: <br />
					<a href='".WWW."activate.php?email={$email}&hash={$hash}'>Activate Account</a></p>
					<p>If you are unable to click the above link you can still activate your account below.</p>
					<p>URL: ".WWW."activate.php <br />
					Confirm Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "update_all_account_settings") {
			// all account settings updated.
			$message = "
			{$stylesheet}
			{$header}
					<p>Your account settings have been changed.</p>
					<p>Password: {$plain_password} (Encrypted in our database.)</p>
			{$footer}";
			return $message;
		} else if ($template_name == "update_account_settings") {
			// all account settings apart from new password updated.
			$message = "
			{$stylesheet}
			{$header}
					<p>Your account settings have been changed.</p>
			{$footer}";
			return $message;
		} else if ($template_name == "reset_password") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>A new password has been requested for your account at <a href='".WWW."'>".SITE_NAME."</a>.</p>
					<p>However you will need to confirm this action by clicking the following link: <br />
					<a href='".WWW."reset_password.php?email={$email}&hash={$hash}'>Reset Password</a></p>
					<p>If you are unable to click the above link you can still request a new password.</p>
					<p>URL: ".WWW."reset_password.php <br />
					Confirm Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "new_password") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>Your new account password is: {$plain_password}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "resend_password_reset_code") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>URL: ".WWW."reset_password.php <br />
					Confirm Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "account_lock") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>As requested your account settings have been locked.<p />
					Unlock Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "resend_unlock_code") {
			// template asking the user to activate their account.
			$message = "
			{$stylesheet}
			{$header}
					<p>Unlock Code: {$hash}</p>
			{$footer}";
			return $message;
		} else if ($template_name == "custom_email") {
			// custom email template for email_user.php.
			$message = "
			{$stylesheet}
			{$header}
					{$message}
			{$footer}";
			return $message;
		}
		
	} // Email_Template end.

} // Class end.