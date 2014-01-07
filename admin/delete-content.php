<?php
	include('include/admin-header.php');
	juassi_set_in_admin(true);
	juassi_set_header('Location: edit-content.php');

	if (isset($_POST['content_id'])) {
		$content_id = (int) $_POST['content_id'];
	}
	else {
		$content_id = 0;
	}

	$juassi_posts = new juassi_posts();
	$juassi_content_identifier['id'] = $content_id;
	if (!juassi_user_can('edit_content')) {
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
	}

	$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

	if (!empty($juassi_post_array)) {
		$juassi_post = $juassi_post_array[0];
		$juassi_posts->delete_content(juassi_content_id());
	}

	juassi_send_headers();
?>