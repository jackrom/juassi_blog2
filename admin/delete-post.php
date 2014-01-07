<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Comments Moderation');
	juassi_set_in_admin(true);
	juassi_set_header('Location: edit.php');

	if (isset($_POST['post_id'])) {
		$post_id = (int) $_POST['post_id'];
	}
	else {
		$post_id = 0;
	}

	$juassi_posts = new juassi_posts();
	$juassi_content_identifier['id'] = $post_id;
	if (!juassi_user_can('edit_posts')) {
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
	}

	$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

	if (!empty($juassi_post_array)) {
		$juassi_post = $juassi_post_array[0];
		$juassi_posts->delete_post(juassi_post_id());
	}

	juassi_send_headers();
?>