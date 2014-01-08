<?php
	include('functions/juassi_common.php');

	if (juassi_get_config('comments') && isset($_POST['juassi_submit'])) {
		if (isset($_POST['juassi_id'])) $juassi_content_identifier['id'] = (int) $_POST['juassi_id'];

		$juassi_posts = new juassi_posts();
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

		if (count($juassi_post_array) == 1) {
			$juassi_post = $juassi_post_array[0];
			if ($juassi_post['post_comments']) {
				if (isset($_POST['juassi_comment_body']) && !empty($_POST['juassi_comment_body'])) {

					$juassi_comments = new juassi_comments();
					$juassi_spam = new juassi_spam();

					/*
					Post comment here
					*/
					$juassi_comment_post = array();

					if (juassi_is_logged_in()) {
						$juassi_comment_post['user_id'] = (int) juassi_get_user_data('user_id');

						//needed for akismet
						$juassi_comment_post['comment_display_name'] = juassi_get_user_data('display_name');
						$juassi_comment_post['comment_email'] = juassi_get_user_data('email');
						$juassi_comment_post['comment_website'] = juassi_get_user_data('website');
						$juassi_comment_post['comment_allow_contact_form'] = 0;
					}
					else {
						if (isset($_POST['juassi_comment_display_name'])) {
							$juassi_comment_post['comment_display_name'] = $_POST['juassi_comment_display_name'];
						}
						else {
							$juassi_comment_post['comment_display_name']  = '';
						}
						if (isset($_POST['juassi_comment_email'])) {
							$juassi_comment_post['comment_email'] = $_POST['juassi_comment_email'];
						}
						else {
							$juassi_comment_post['comment_email']  = '';
						}
						if (isset($_POST['juassi_comment_website'])) {
							$juassi_comment_post['comment_website'] = $_POST['juassi_comment_website'];
						}
						else {
							$juassi_comment_post['comment_website'] = '';
						}
						if (isset($_POST['juassi_comment_contact_form'])) {
							$juassi_comment_post['comment_allow_contact_form'] = 1;
						}
						else {
							$juassi_comment_post['comment_allow_contact_form'] = 0;
						}
						$juassi_comment_post['user_id'] = 0;

						if (isset($_POST['juassi_comment_remember_details'])) {
							$juassi_comment_post['juassi_comment_remember_details'] = 1;
						}
						else {
							$juassi_comment_post['juassi_comment_remember_details'] = 0;
						}

						if ($juassi_comment_post['juassi_comment_remember_details']) {
							$juassi_cookie_array = juassi_get_cookie_array();

							$juassi_cookie_array['comment_website'] = juassi_htmlentities($juassi_comment_post['comment_website']);
							$juassi_cookie_array['comment_display_name'] = juassi_htmlentities($juassi_comment_post['comment_display_name']);
							$juassi_cookie_array['comment_email'] =	juassi_htmlentities($juassi_comment_post['comment_email']);
							$juassi_cookie_array['comment_allow_contact_form'] = (int) $juassi_comment_post['comment_allow_contact_form'];
							$juassi_cookie_array['comment_remember_details'] = (int) $juassi_comment_post['juassi_comment_remember_details'];

							juassi_set_cookie_array($juassi_cookie_array);
						}
						else {
							$juassi_cookie_array = juassi_get_cookie_array();

							if (isset($juassi_cookie_array['comment_remember_details']) && $juassi_cookie_array['comment_remember_details']) {

								unset($juassi_cookie_array['comment_website']);
								unset($juassi_cookie_array['comment_display_name']);
								unset($juassi_cookie_array['comment_email']);
								unset($juassi_cookie_array['comment_allow_contact_form']);
								unset($juassi_cookie_array['comment_remember_details']);

								juassi_set_cookie_array($juassi_cookie_array);
							}
						}
					}

					$juassi_comment_post['comment_body'] = $_POST['juassi_comment_body'];
					$juassi_comment_post['comment_date'] = juassi_datetime();
					$juassi_comment_post['comment_date_utc'] = juassi_datetime_utc();
					$juassi_comment_post['post_id'] = (int) $juassi_post['post_id'];
					$juassi_comment_post['comment_ip_address'] = juassi_ip_address();
					$juassi_comment_post['comment_approved'] = 1;
					$juassi_comment_post['comment_type'] = 'comment';

					//spam filtering happens here
					$juassi_spam->set_comment($juassi_comment_post);
					$juassi_processed_comment = $juassi_spam->get_comment();

					//echo '<pre>';
					//print_r($juassi_processed_comment);
					//echo '</pre>';

					if ($juassi_processed_comment['comment_approved'] == 0) {
						$juassi_input_error = '<strong>Tu mensaje ha sido enviado a la cola de moderaci&oacute;.</strong>';
						$_SESSION['juassi_input_error'] = $juassi_input_error;
					}

					$juassi_comments->add_comment($juassi_processed_comment);

					juassi_set_header('Location: ' . juassi_post_permalink() . '#posted');
				}
				else {
					$juassi_input_error = '<strong>Tu comentario no puede estar vac&iacute;o.</strong>';
					$_SESSION['juassi_input_error'] = $juassi_input_error;
					juassi_set_header('Location: ' . juassi_post_permalink() . '#posted');
				}

			}
			else {
				$juassi_input_error = '<strong>Los comentarios no estan habilitados para este art&iacute;culo.</strong>';
				$_SESSION['juassi_input_error'] = $juassi_input_error;
				juassi_set_header('Location: ' . juassi_post_permalink() . '#posted');
			}
		}
		else {
			juassi_set_header('Location: ' . juassi_get_config('address') . '/');
		}

	}
	else {
		juassi_set_header('Location: ' . juassi_get_config('address')  . '/');
	}
	juassi_send_headers();
?>