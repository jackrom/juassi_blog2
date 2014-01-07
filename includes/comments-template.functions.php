<?php
/*
	Juassi 2.0
	Comment Template Tags
*/

function juassi_comment_body() {
	global $juassi_comment;

	$juassi_comment['comment_body'] = juassi_run_content_filter('comment_body', $juassi_comment['comment_body']);

	return $juassi_comment['comment_body'];

}

function juassi_comment_body_raw() {
	global $juassi_comment;

	return $juassi_comment['comment_body'];
}

function juassi_comment_id() {
	global $juassi_comment;

	return (int)$juassi_comment['comment_id'];

}

function juassi_comment_display_name() {
	global $juassi_comment;

	if (juassi_comment_user()) {
		return juassi_htmlentities($juassi_comment['display_name']);
	}
	elseif (!empty($juassi_comment['comment_display_name'])) {
		return juassi_htmlentities($juassi_comment['comment_display_name']);
	}
	else {
		return 'Anonymous';
	}

}

function juassi_comment_date($user_offset = true) {
	global $juassi_comment;

	//do per user timezone offset

	return $juassi_comment['comment_date'];
}

function juassi_comment_date_utc() {
	global $juassi_comment;

	return $juassi_comment['comment_date_utc'];

}

function juassi_comment_user() {
	global $juassi_comment;

	if (0 == (int) $juassi_comment['user_id']) {
		return false;
	}
	else {
		return true;
	}
}

function juassi_comment_user_id() {
	global $juassi_comment;

	return (int) $juassi_comment['user_id'];

}

function juassi_comment_number($reset = false) {
	static $i;

	if ($reset) {
		$i = 0;
	}
	else {
		if (!isset($i)) {
			$i = 1;
		}
		else {
			$i++;
		}
	}

	return $i;
}

function juassi_comment_spam_block() {

	$key = juassi_uuid();

	$_SESSION['juassi_comment_spamblock'] = $key;

	return $key;

}

function juassi_comment_name_url() {
	global $juassi_comment;
	if (juassi_comment_user()) {
		if (!empty($juassi_comment['website'])) {
			return '<a href="'.juassi_htmlentities($juassi_comment['website']).'">' . juassi_htmlentities($juassi_comment['display_name']) . '</a>';
		}
		else {
			return juassi_htmlentities($juassi_comment['display_name']);
		}
	}
	else {
		if (!empty($juassi_comment['comment_display_name'])) {
			if (!empty($juassi_comment['comment_website'])) {
				return '<a href="'.juassi_htmlentities($juassi_comment['comment_website']).'">' . juassi_htmlentities($juassi_comment['comment_display_name']) . '</a>';
			}
			else {
				return juassi_htmlentities($juassi_comment['comment_display_name']);
			}
		}
		else {
			return 'Anonymous';
		}
	}

}

function juassi_comment_url() {
	global $juassi_comment;

	return juassi_htmlentities($juassi_comment['comment_website']);
}

function juassi_comment_email_address() {
	global $juassi_comment;

	if (!juassi_comment_user()) {
		if (!empty($juassi_comment['comment_email'])) {
			return '<a href="mailto:' . juassi_htmlentities($juassi_comment['comment_email']) . '">' . juassi_htmlentities($juassi_comment['comment_email'])  . '</a>';
		}
	}
	else {
		if (!empty($juassi_comment['email'])) {
			return '<a href="mailto:' . juassi_htmlentities($juassi_comment['email']) . '">' . juassi_htmlentities($juassi_comment['email'])  . '</a>';
		}
	}

	return;
}

function juassi_comment_email() {
	global $juassi_comment;

	if (!juassi_comment_user()) {
		if (!empty($juassi_comment['comment_email'])) {
			return juassi_htmlentities($juassi_comment['comment_email']);
		}
	}
	else {
		if (!empty($juassi_comment['email'])) {
			return juassi_htmlentities($juassi_comment['email']);
		}
	}

	return;
}

function juassi_comment_ip_address() {
	global $juassi_comment;

	return juassi_htmlentities($juassi_comment['comment_ip_address']);
}

function juassi_comment_permalink() {

	echo '<a href="#comments-'. juassi_comment_id() .'" title="Permalink for this comment">Comment Link</a>';
}

function juassi_comment_view_post(){
	$output = '<a href="'.juassi_post_permalink().'">Ver Art&iacute;culo</a>';
	return $output;
}

function juassi_comment_action(){
	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'delete') {
		$output = ' <a href="delete-comment.php?comment_id=' .  juassi_comment_id() . '">Eliminar</a>';
	}
	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'edit') {
		$output .= ' <a href="edit-comment.php?comment_id=' . juassi_comment_id() . '">Editar</a>';
	}
	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'approve') {
		$output .= ' <a href="approve-comment.php?comment_id=' . juassi_comment_id() . '">Aprobar</a>';
	}
	return $output;
}

function juassi_comment_ip(){
	$output = '<a href="http://services.juassi/lookup/?type=rdns&amp;ip_address='.juassi_comment_ip_address().'">'.juassi_comment_ip_address().'</a>';
	return $output;
}


function juassi_comment_admin_bottom() {

	$output = '<strong>'.juassi_comment_number().'</strong>: ';
	$output .= '<a href="'.juassi_post_permalink().'">View Post</a>: ';
	$output .= juassi_comment_email_address();

	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'delete') {
		$output .= ': <a href="delete-comment.php?comment_id=' .  juassi_comment_id() . '">Delete</a>';
	}
	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'edit') {
		$output .= ': <a href="edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>';
	}
	if (!isset($_REQUEST['run']) || $_REQUEST['run'] != 'approve') {
		$output .= ': <a href="approve-comment.php?comment_id=' . juassi_comment_id() . '">Approve</a>';
	}
	$output .= ': <a href="http://services.juassi/lookup/?type=rdns&amp;ip_address='.juassi_comment_ip_address().'">'.juassi_comment_ip_address().'</a>';

	if (!isset($_REQUEST['run'])) {
		$output .= ' <strong>Mass Moderate</strong>
		Delete<input type="radio" name="comment_id-' . juassi_comment_id() . '" value="0" />
		Approve<input type="radio" name="comment_id-' . juassi_comment_id() . '" value="1" />
		Leave<input type="radio" name="comment_id-' . juassi_comment_id() . '" value="2" />';
	}

	return $output;
}

function juassi_comment_guest_display_name() {
	$juassi_cookie_array = juassi_get_cookie_array();

	if (isset($juassi_cookie_array['comment_display_name'])) {
		return juassi_htmlentities($juassi_cookie_array['comment_display_name']);
	}
	else {
		return false;
	}
}

function juassi_comment_guest_email() {
	$juassi_cookie_array = juassi_get_cookie_array();

	if (isset($juassi_cookie_array['comment_email'])) {
		return juassi_htmlentities($juassi_cookie_array['comment_email']);
	}
	else {
		return false;
	}
}

function juassi_comment_guest_website() {
	$juassi_cookie_array = juassi_get_cookie_array();

	if (isset($juassi_cookie_array['comment_website'])) {
		return juassi_htmlentities($juassi_cookie_array['comment_website']);
	}
	else {
		return false;
	}
}

function juassi_comment_allow_contact_form() {
	$juassi_cookie_array = juassi_get_cookie_array();

	if (isset($juassi_cookie_array['comment_allow_contact_form'])) {
		return (int) $juassi_cookie_array['comment_allow_contact_form'];
	}
	else {
		return false;
	}

}

function juassi_comment_remember_details() {
	$juassi_cookie_array = juassi_get_cookie_array();

	if (isset($juassi_cookie_array['comment_remember_details'])) {
		return (int) $juassi_cookie_array['comment_remember_details'];
	}
	else {
		return false;
	}

}

function juassi_comment_akismet_spam() {
	global $juassi_comment;

	return (int) $juassi_comment['comment_akismet_spam'];
}

function juassi_comment_spam_score() {
	global $juassi_comment;

	return (int) $juassi_comment['comment_spam_score'];

}

function juassi_comment_trackback() {
	global $juassi_comment;

	if (1 == (int) $juassi_comment['comment_trackback']) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_comment_trackback_title() {
	global $juassi_comment;

	return juassi_htmlentities($juassi_comment['comment_title']);
}

?>