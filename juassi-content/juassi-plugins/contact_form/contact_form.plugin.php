<?php
	/*
	Juassi 2.0 Contact Form (Plugin)
	This plugin adds a contact form to the website through the use of the 'other_content' task.
	Juan Carlos Reyes C Copyright 2012
	*/

	//stops the plugin file from being accessed directly
	if (!defined('JUASSI_ROOT')) exit;

	//hook into other_content_
	juassi_add_task('contact_form', 'other_content_contact_form', 'cf_add_contact_form_type');

	//hook into theme_type_
	juassi_add_task('contact_form', 'theme_type_contact_form', 'cf_theme_handle');

	//hook into the admin spam settings page
	juassi_add_task('contact_form', 'spam_settings_body', 'cf_html_spam_settings');

	//hook into the submitting of spam settings page
	juassi_add_task('contact_form', 'update_spam_settings', 'cf_update_spam_settings');

	//hook into the database upgrade and upgrade the system
	//juassi_add_task('contact_form', 'pre_update_database', '');

	function cf_add_contact_form_type($juassi_content_identifier) {
		global $juassi_post_categories, $juassi_input_error, $juassi_mailer, $juassi_tb;
		//we need to let Bluetrait know that we've taken the content so it doesn't throw a 404
		juassi_unset_404();
		//categories are used in the default theme, so we need them
		$juassi_post_categories = new juassi_categories($juassi_tb->categories);
		//our custom content type style
		$juassi_content_identifier['theme_type'] = 'contact_form';
		/*
		We can get the POSTed data here.
		*/
		if (isset($_POST['cf_submit'])) {
			$juassi_users = new juassi_users();
			$user_array = $juassi_users->get_user(juassi_get_config('contact_user_id'));
			if (!empty($_POST['cf_message']) && !empty($user_array) && $user_array['contact'] == 1) {
				/*
				This is where we'll be able to send messages to other users
				*/
				if (juassi_get_config('cf_akismet_delete_spam')) {
					$juassi_spam = new juassi_spam();

					$juassi_contact_form['comment_body'] = $_POST['cf_message'];
					$juassi_contact_form['comment_display_name'] = $_POST['cf_from_name'];
					$juassi_contact_form['user_id'] = 0;
					$juassi_contact_form['comment_email']  = $_POST['cf_from_email'];
					$juassi_contact_form['comment_allow_contact_form'] = 0;
					$juassi_contact_form['comment_date'] = juassi_datetime();
					$juassi_contact_form['comment_date_utc'] = juassi_datetime_utc();
					$juassi_contact_form['comment_ip_address'] = juassi_ip_address();
					$juassi_contact_form['comment_approved'] = 1;
					$juassi_contact_form['comment_type'] = 'comment';

					$juassi_spam->set_comment($juassi_contact_form);
					$juassi_processed_contact_form = $juassi_spam->get_comment();
				}
				else {
					$juassi_processed_contact_form['comment_akismet_spam'] = 0;
				}

				$juassi_mailer->create($user_array['email'], $user_array['display_name'], $_POST['cf_from_email'], $_POST['cf_from_name'], juassi_get_config('name') . ' Contact Form: ' . $_POST['cf_subject'], $_POST['cf_message']);
				if (juassi_get_config('cf_require_valid_email') && !juassi_check_email_address($_POST['cf_from_email'])) {
					$juassi_input_error = '<p style="background-color:red;color:white; padding:10px; margin-bottom:20px;"><strong>Please make sure you enter a valid email address</strong></p>';
				}
				elseif ($juassi_processed_contact_form['comment_akismet_spam'] == 1) {
					$juassi_input_error = '<p style="background-color:red;color:white; padding:10px; margin-bottom:20px;"><strong>Your message was unable to be sent as it was detected as spam.</strong></p>';
				}
				elseif ($juassi_mailer->send()) {
					$juassi_input_error = '<p style="background-color:green;color:white; padding:10px; margin-bottom:20px;"><strong>Your message was sent.</strong></p>';
				}
				else {
					$juassi_input_error = '<p style="background-color:red;color:white; padding:10px; margin-bottom:20px;"><strong>Your message was unable to be sent at this time, please contact the webmaster if this continues to happen.</strong></p>';
				}
			}
			else {
				$juassi_input_error = '<p style="background-color:red;color:white; padding:10px; margin-bottom:20px;"><strong>Your message cannot be empty.</strong></p>';
			}
		}
		return true;
	}

	//HTML for contact form is here. You could also put it in another file and include it from here
	function cf_theme_handle() {
		global $juassi_post_array, $juassi_db, $juassi_tb, $juassi_error, $juassi_post, $juassi_comment_array, $juassi_input_error, $juassi_comment;

		
		//Please use:
		if (!defined('JUASSI_ROOT')) exit;
                /*
		if HTML is in a separate file
		*/

		//get the default contact user here
		$juassi_users = new juassi_users();
		$user_array = $juassi_users->get_user(juassi_get_config('contact_user_id'));

		//set the html title here
		juassi_set_title('Contact Form');

		include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/header.php'); ?>
		<?php juassi_run_section('cf_html_top'); ?>
		<div class="news">
			<h2 style="border-bottom:1px solid #999;">Contact Form</h2>
			<?php if (!empty($user_array) && $user_array['contact'] == 1) { ?>
			<p>The following form allows you to send an email to <strong><?php echo juassi_htmlentities($user_array['display_name']); ?></strong>.</p>
			<form action="<?php echo juassi_htmlentities($_SERVER['REQUEST_URI']); ?>" method="post" id="commentform" style="padding-top:30px;">
					<?php
					if(!empty($juassi_input_error)) {
						echo $juassi_input_error;
					}
					?>
                    <div style="display:block; float:left;">
					<p style="font-size:13px;color: #525252;padding-right:8px;">Name</p><input name="cf_from_name" type="text" style="border:1px solid #e0e0e0;margin-top:8px;width:630px;font:13px 'PT Sans';color:#626363;padding:5px 10px;" />
					<p style="font-size:13px;color:#525252;padding-right:8px;">Email <?php if (juassi_get_config('cf_require_valid_email')) { ?><sub style="color:red;float:left;display:inline;">*</sub><?php } ?></p><input name="cf_from_email" type="text" style="border:1px solid #e0e0e0;margin-top:8px;width:630px;font:13px 'PT Sans';color:#626363;padding:5px 10px;" />
					<p style="font-size:13px;color:#525252;padding-right:8px;">Subject</p><input name="cf_subject" type="text" style="border:1px solid #e0e0e0;margin-top:8px;width:630px;font:13px 'PT Sans';color:#626363;padding:5px 10px;" />
					<p style="font-size:13px;color:#525252;padding-right:8px;">Message</p>
					</div><div style="display:block; float:left;">
                    <p style="font-size:13px;color:#525252;padding-right:8px;"><textarea name="cf_message" id="comment" cols="8" rows="12" style="border:1px solid #e0e0e0;margin-top:8px;width:630px;font:13px 'PT Sans';color:#626363;padding:5px 10px;height:150px;"></textarea></p>
					<p><input type="submit" name="cf_submit" value="Send" style="font-weight:bold;font-style:italic;color:#525252;width:113px;height:42px;padding:0;border:none;" /></p>
                    </div>
			</form>
			<?php } else { ?>
				<p>This person has decided not to let you contact them via this form, or the user cannot be found.</p>
			<?php } ?>
		</div>
		<?php juassi_run_section('cf_html_bottom'); 
        if(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/sidebar.php')
        	 include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/sidebar.php');
		include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/footer.php');
	}

	function cf_html_spam_settings() {
	?>
		<fieldset>
			<legend>Contact Form</legend>
			<p>Delete contact form messages that Akismet thinks are spam? <input name="cf_akismet_delete_spam" type="checkbox" value="1"<?php if (juassi_get_config('cf_akismet_delete_spam')) echo ' checked="checked"'; ?> /></p>
			<p>Require the senders email address to be in a valid format? <input name="cf_require_valid_email" type="checkbox" value="1"<?php if (juassi_get_config('cf_require_valid_email')) echo ' checked="checked"'; ?> /></p>
		</fieldset>
	<?php
	}

	function cf_update_spam_settings() {
		juassi_set_config('cf_akismet_delete_spam', (int) $_POST['cf_akismet_delete_spam']);
		juassi_set_config('cf_require_valid_email', (int) $_POST['cf_require_valid_email']);
	}
?>