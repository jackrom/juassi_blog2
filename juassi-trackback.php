<?php
/*
	Juassi 2.0 Trackback Support
	Juan Carlos Reyes C Copyright 2012
*/
include('functions/juassi_common.php');

if (juassi_get_config('trackbacks')) {

	if (isset($_POST['url']) && isset($_POST['title']) && isset($_POST['excerpt']) && isset($_POST['blog_name'])) {

		$juassi_content_identifier = juassi_get_content_identifier();
		$juassi_content_identifier['limit'] = 1;
		$juassi_posts = new juassi_posts();
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

		/*
		echo '<pre>';
		print_r($bt_content_identifier);
		echo '</pre>';
		exit;
		*/
		if (count($juassi_post_array) == 1 && !$juassi_content_identifier['empty']) {
			//print_r($bt_post_array);
			$juassi_post = $juassi_post_array[0];

			//posted stuff from other blog site
			$juassi_trackback_url = $_POST['url'];
			$juassi_trackback_title = $_POST['title'];
			$juassi_trackback_excerpt = $_POST['excerpt'];
			$juassi_trackback_blog_name = $_POST['blog_name'];

			$juassi_comments = new juassi_comments();
			$juassi_spam = new juassi_spam();

			$juassi_comment_post['comment_body'] = $juassi_trackback_excerpt;
			$juassi_comment_post['comment_display_name'] = $juassi_trackback_blog_name;
			$juassi_comment_post['comment_website'] = $juassi_trackback_url;
			$juassi_comment_post['comment_title'] = $juassi_trackback_title;

			$juassi_comment_post['user_id'] = 0;
			$juassi_comment_post['comment_email']  = '';
			$juassi_comment_post['comment_allow_contact_form'] = 0;
			$juassi_comment_post['comment_date'] = juassi_datetime();
			$juassi_comment_post['comment_date_utc'] = juassi_datetime_utc();
			$juassi_comment_post['post_id'] = (int) $juassi_post['post_id'];
			$juassi_comment_post['comment_ip_address'] = juassi_ip_address();
			$juassi_comment_post['comment_approved'] = 1;
			$juassi_comment_post['comment_type'] = 'trackback';

			//spam filtering happens here
			$juassi_spam->set_comment($juassi_comment_post);
			$juassi_processed_comment = $juassi_spam->get_comment();
			//print_r($bt_processed_comment);
			//exit;
			if ($juassi_processed_comment['comment_akismet_spam']) {
				juassi_set_header('Content-Type: text/xml; charset=UTF-8');
				juassi_send_headers();
				echo '<?xml version="1.0" encoding="iso-8859-1"?'.">\n";
				echo "<response>\n";
				echo "<error>1</error>\n";
				echo "<message>Trackback not accepted as it has been detected as spam.</message>\n";
				echo "</response>";
			}
			else {
				//add trackback here
				$juassi_comments->add_comment($juassi_processed_comment);
				juassi_set_header('Content-Type: text/xml; charset=UTF-8');
				juassi_send_headers();
				echo '<?xml version="1.0" encoding="iso-8859-1"?'.">\n";
				echo "<response>\n";
				echo "<error>0</error>\n";
				echo "<message>Trackback accepted.</message>\n";
				echo "</response>";
			}
		}
		else {
			juassi_set_header('Content-Type: text/xml; charset=UTF-8');
			juassi_send_headers();
			echo '<?xml version="1.0" encoding="iso-8859-1"?'.">\n";
			echo "<response>\n";
			echo "<error>1</error>\n";
			echo "<message>Post not found.</message>\n";
			echo "</response>";
		}
	}
	else {
		juassi_set_header('Content-Type: text/xml; charset=UTF-8');
		juassi_send_headers();
		echo '<?xml version="1.0" encoding="iso-8859-1"?'.">\n";
		echo "<response>\n";
		echo "<error>1</error>\n";
		echo "<message>Required Data Not Found</message>\n";
		echo "</response>";
	}
}
else {
	juassi_set_header('Content-Type: text/xml; charset=UTF-8');
	juassi_send_headers();
	echo '<?xml version="1.0" encoding="iso-8859-1"?'.">\n";
	echo "<response>\n";
	echo "<error>1</error>\n";
	echo "<message>Trackbacks Globally Disabled</message>\n";
	echo "</response>";
}


?>