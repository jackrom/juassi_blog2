<?php
	include('include/admin-header.php');
	juassi_set_admin_title('User Profile');
	juassi_set_in_admin(true);
	$juassi_ln->add_lower_link($juassi_ln->user_admin, 'User Profile', 'user-profile.php');
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Perfil del Usuario</h2>
		<?php
			if (isset($_REQUEST['user_id'])) {
				$user_id = (int) $_REQUEST['user_id'];
			}
			else {
				$user_id = 0;
			}

			if ($user_id != juassi_get_user_data('user_id')) {
				if (isset($_POST['submit'])) {
					$user_array['display_name'] = $_POST['juassi_display_name'];
					$user_array['website'] = $_POST['juassi_website'];
					$user_array['contact'] = (int) $_POST['juassi_contact_form'];
					$user_array['gui_editor'] = (int) $_POST['juassi_gui_editor'];
					$user_array['group_id'] = (int) $_POST['juassi_group_id'];
					$user_array['active'] = (int) $_POST['juassi_user_active'];
					$user_array['id'] = $user_id;
					if (!empty($_POST['juassi_new_password'])) {
						if ($_POST['juassi_new_password'] == $_POST['juassi_new_password2']) {
							$user_array['password'] = md5($_POST['juassi_new_password']);
						}
						else {
							echo juassi_admin_message('<strong>New Passwords Do Not Match</strong>');
						}
					}

					if (juassi_check_email_address($_POST['juassi_email']) && !bt_check_email_address_taken($user_id, $_POST['juassi_email'])) {
						$user_array['email'] = $_POST['juassi_email'];
					}
					else {
						echo juassi_admin_message('<strong>Email address invalid or taken.</strong>');
					}


					$juassi_users->edit_user($user_array);

					echo juassi_admin_message('<strong>User Settings Updated</strong>');
				}

				$user = $juassi_users->get_user($user_id);

				if (empty($user)) {
					echo juassi_admin_message('<strong>User not found.</strong>');
				}

				$group_id = (int) $user['group_id'];
				$group_name = juassi_get_group_name($group_id);
				$groups = juassi_get_groups();
			}
			else {
				echo juassi_admin_message('<strong>You can not edit your own profile from this page, please visit your <a href="personal-settings.php">Personal Settings</a> page.</strong>');
			}
		?>
		<?php if (!empty($user)) { ?>
		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		<fieldset>
		<legend>Personal Details</legend>
			<p>Username (editing disabled) <br /><input name="juassi_user_name" size="30" type="text" disabled="disabled" value="<?php echo juassi_htmlentities($user['user_name']); ?>" /></p>
			<p>Display Name <br /><input name="juassi_display_name" size="30"  type="text" value="<?php echo juassi_htmlentities($user['display_name']); ?>" /></p>
			<p>Email Address <br /><input name="juassi_email" size="30"  type="text" value="<?php echo juassi_htmlentities($user['email']); ?>" /></p>
			<p>Website <br /><input name="juassi_website" size="30"  type="text" value="<?php echo juassi_htmlentities($user['website']); ?>" /></p>
			<p>User Group <br /><select name="juassi_group_id">
			<optgroup label="Current Group">
			<option value="<?php echo juassi_htmlentities($group_id); ?>"><?php echo juassi_htmlentities($group_name); ?></option>
			</optgroup>
			<optgroup label="Available Groups">
			<?php foreach ($groups as $group) { ?>
			<option value="<?php echo juassi_htmlentities($group['group_id']); ?>"><?php echo juassi_htmlentities($group['group_name']); ?></option>
			<?php } ?>
			</optgroup>
			</select></p>
			<p>Joined <br /><input name="juassi_joined" size="30" type="text" disabled="disabled" value="<?php echo juassi_htmlentities($user['joined']); ?>" /></p>
		</fieldset>

		<fieldset>
		<legend>Personal Options</legend>
			<p>Allow contact form<br />
			<select name="juassi_contact_form">
			<option value="0">Off</option>
			<option value="1"<?php if ($user['contact']) { echo ' selected="selected" '; } ?>>On</option>
			</select></p>
			<p>Use WYSIWYG editor for input<br />
			<select name="juassi_gui_editor">
			<option value="0">Off</option>
			<option value="1"<?php if ($user['gui_editor']) { echo ' selected="selected" '; } ?>>On</option>
			</select></p>
			<p>User Active<br />
			<select name="juassi_user_active">
			<option value="0">No</option>
			<option value="1"<?php if ($user['active']) { echo ' selected="selected" '; } ?>>Yes</option>
			</select></p>
		</fieldset>
		<fieldset>
		<legend>Change Password</legend>
			<p>You can leave this blank if you're not changing the password.</p>
			<p>New Password <br /><input name="juassi_new_password" size="30"  type="password" value="" /></p>
			<p>Retype New Password <br /><input name="juassi_new_password2" size="30"  type="password" value="" /></p>
		</fieldset>
		<fieldset>
			<legend>User Activity</legend>
				<p>Number of Posts<br />
				<?php echo (int) juassi_user_post_count($user_id); ?>
				</p>
				<p>Number of Comments<br />
				<?php echo (int) juassi_user_comment_count($user_id); ?>
				</p>
		</fieldset>
		<br clear="all" />
		<p><input type="hidden" name="user_id" value="<?php echo (int) $user_id; ?>" />
		<input type="submit" name="submit" value="Submit" /></p>
		</form>
		<br />
		<script type="text/javascript">
		<!--
		function juassi_confirm() {
			if (confirm("Are you sure you wish to delete this user?")){
				return true;
			}
			else{
				return false;
			}
		}
		//-->
		</script>
		<form action="user-admin.php" method="post" onsubmit="return juassi_confirm(this);">
			<input type="hidden" name="delete_user" value="<?php echo (int) $user_id; ?>" />
			<input type="submit" name="delete_user_submit" value="Delete" /></p>
		</form>
		<?php } ?>
	</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>