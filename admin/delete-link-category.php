<?php
	include('include/admin-header.php');
	juassi_set_in_admin(true);
	juassi_set_header('Location: edit-link-category.php');

	if (isset($_POST['category_id'])) {
		$category_id = (int) $_POST['category_id'];
	}
	else {
		$category_id = 0;
	}

	if (juassi_user_can('delete_link_categories')) {
		juassi_delete_link_cateory($category_id);
	}

	juassi_send_headers();
?>