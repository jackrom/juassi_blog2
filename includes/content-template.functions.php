<?php
/*
	Juassi 2.0 Content Template Tags
	Juan Carlos Reyes C Copyright 2012
*/
function juassi_content_permalink() {
	global $juassi_post;
	static $permalink_array;

	if (isset($permalink_array[$juassi_post['post_id']])) {
		return $permalink_array[$juassi_post['post_id']]['permalink'];
	}
	else {
		$permalink_format = juassi_get_config('content_permalink_format');

		$year = substr($juassi_post['post_date'],0,4);
		$month = substr($juassi_post['post_date'],5,2);
		$day = substr($juassi_post['post_date'],8,2);

		$permalink = str_replace('%year%', $year, $permalink_format);
		$permalink = str_replace('%month%', $month, $permalink);
		$permalink = str_replace('%day%', $day, $permalink);
		$permalink = str_replace('%x_title%', $juassi_post['post_x_title'], $permalink);
		$permalink = str_replace('%post_id%', $juassi_post['post_id'], $permalink);

		$permalink = juassi_get_config('address') . $permalink;

		$permalink_array[$juassi_post['post_id']]['permalink'] = $permalink;

		return $permalink;
	}
}

function juassi_content_id() {
	return juassi_post_id();
}
function juassi_content_author_id() {
	return juassi_post_author_id();
}

function juassi_content_author() {
	return juassi_post_author();
}

function juassi_content_title() {
	global $juassi_post;

	return juassi_run_content_filter('content_title', $juassi_post['post_title']);
}
function juassi_content_body() {
	global $juassi_post;

	return juassi_run_content_filter('content_body', $juassi_post['post_body']);
}
function juassi_content_date($user_offset = true) {
	return juassi_post_date($user_offset);
}
?>