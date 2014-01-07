<?php

function juassi_get_admin_title() {
	global $juassi_admin_page_title;

	if (isset($juassi_admin_page_title) && !empty($juassi_admin_page_title)) {
		return 'Juassi :: ' . $juassi_admin_page_title;
	}
	else {
		return 'Juassi :: Admin';
	}

}

function juassi_set_admin_title($title) {
	global $juassi_admin_page_title;

	$juassi_admin_page_title = $title;

	return true;

}

function juassi_in_admin() {
	global $juassi_in_admin;

	return $juassi_in_admin;

}

function juassi_set_in_admin($value) {
	global $juassi_in_admin;

	if ($value) {
		$juassi_in_admin = true;
	}
	else {
		$juassi_in_admin = true;
	}

	return true;
}

function juassi_user_post_count($user_id = '') {
	global $juassi_db, $juassi_tb;

	if (empty($user_id)) $user_id = juassi_get_user_data('user_id');

	$user_id = (int) $user_id;

	$query = "SELECT count(*) as `count` FROM $juassi_tb->posts WHERE user_id = :user_id AND post_type = 'published'";

	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':user_id', $user_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return $count['count'];
}

function juassi_user_comment_count($user_id = '') {
	global $juassi_db, $juassi_tb;

	if (empty($user_id)) $user_id = juassi_get_user_data('user_id');

	$user_id = (int) $user_id;

	$query = "SELECT count(*) as `count` FROM $juassi_tb->comments WHERE user_id = :user_id AND comment_approved = 1";

	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':user_id', $user_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return $count['count'];
}



?>