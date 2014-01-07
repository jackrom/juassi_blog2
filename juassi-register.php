<?php

include('functions/juassi_common.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-admin-template.functions.php');

if (juassi_is_logged_in()) {
	juassi_set_header('Location: ' . $_SESSION['juassi_page']);
	juassi_send_headers();
	exit;
}
juassi_set_admin_title('Register');
include(JUASSI_ROOT . JUASSI_ADMIN . '/include/html-header.php');

if (juassi_get_config('allow_register')) { ?>
<div class="contain" style="width:30%;">
	<h1>Registration</h1>
		<form action="<?php echo juassi_htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<?php $website = isset($_POST['website']) ? juassi_htmlspecialchars($_POST['website']) : 'http://'; ?>
		<p>User Name <br /><input name="user_name" size="30" type="text" value="<?php if (isset($_POST['user_name'])) echo juassi_htmlspecialchars($_POST['user_name']); ?>" /> (allowed characters include: a-z, 0-9, _ and -)</p>
		<p>Display Name <br /><input name="display_name" size="30"  type="text" value="<?php if (isset($_POST['display_name'])) echo juassi_htmlspecialchars($_POST['display_name']); ?>" /></p>
		<p>Email Address <br /><input name="email" size="30"  type="text" value="<?php if (isset($_POST['email'])) echo juassi_htmlspecialchars($_POST['email']); ?>" /></p>
		<p>Website <br /><input name="website" size="30"  type="text" value="<?php echo $website; ?>" /></p>
		<p>Password <br /><input name="password" size="30" type="password" value="" /></p>
		<p>Password Again <br /><input name="password2" size="30"  type="password" value="" /></p>
		<p>Email details to self? <input type="checkbox" name="email_user" value="1" <?php if(isset($_POST['email_user'])) echo 'checked="checked"'; ?> /></p>
		<p>
		<input type="submit" name="submit" value="Submit"/>
		</p>
		</form>
</div>
<?php } else { ?>
<div class="contain" style="width:30%;">
	<h1 style="text-align:center;">Registration Closed</h1>
</div>
<?php } ?>
<?php
include(JUASSI_ROOT . JUASSI_ADMIN . '/include/html-footer.php');
?>