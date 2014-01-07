<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Moderaci&oacute;n de comentarios');
	juassi_set_in_admin(true);
	juassi_set_header('Location: comments.php');

	juassi_comment_mass_moderate();

	function juassi_comment_mass_moderate() {
		global $juassi_db, $juassi_tb, $juassi_comment;

		$juassi_comments = new juassi_comments();
		if (juassi_get_config('akismet')) {
			$akismet = new Akismet(juassi_get_config('address'), juassi_get_config('akismet_api_key'), juassi_get_config('program_version'));
		}

		foreach($_POST as $index => $moderate_type){
			$moderate_type = (int) $moderate_type;

			if(strncasecmp($index, 'comment_id-', 11) === 0) {
				$index = explode('-', $index);
				$comment_id = (int) $index[1];

				switch($moderate_type) {

					case 0:
						/*
						Delete
						*/

						//this function will make us a good citizen as it helps Akismet to learn from its mistakes
						//Mark comments as spam
						if (juassi_get_config('akismet')) {

							$juassi_content_identifier['comment_id'] = $comment_id;
							$juassi_content_identifier['all_comments'] = 1;
							$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
							$juassi_comment = $juassi_comment_array[0];

							$akismet->setCommentAuthor(juassi_comment_display_name());
							$akismet->setCommentAuthorEmail(juassi_comment_email_address());
							$akismet->setCommentAuthorURL(juassi_comment_url());
							$akismet->setCommentContent(juassi_comment_body());
							$akismet->setUserIP(juassi_comment_ip_address());
							$akismet->submitSpam();
						}
						//delete
						$juassi_comments->delete_comment($comment_id);
					break;

					case 1:
						/*
						Approve
						*/
						//this function will make us a good citizen as it helps Akismet to learn from its mistakes
						//Mark comments as ham
						if (juassi_get_config('akismet')) {

							$juassi_content_identifier['comment_id'] = $comment_id;
							$juassi_content_identifier['all_comments'] = 1;
							$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
							$juassi_comment = $juassi_comment_array[0];

							$akismet->setCommentAuthor(juassi_comment_display_name());
							$akismet->setCommentAuthorEmail(juassi_comment_email_address());
							$akismet->setCommentAuthorURL(juassi_comment_url());
							$akismet->setCommentContent(juassi_comment_body());
							$akismet->setUserIP(juassi_comment_ip_address());
							$akismet->submitHam();
						}

						//approve
						$juassi_comments->approve_comment($comment_id);

					break;

				}
			}
		}
	}

	juassi_send_headers();
?>