<?php
/*
	Juassi 2.0 Post Template Tags
	Juan Carlos Reyes C Copyright 2012
*/

function juassi_post_title() {
	global $juassi_post;

	return juassi_run_content_filter('post_title', $juassi_post['post_title']);

}

function juassi_post_x_title() {
	global $juassi_post;

	return juassi_htmlentities($juassi_post['post_x_title']);

}

function juassi_post_title_clean() {
	global $juassi_post;

	return juassi_htmlentities($juassi_post['post_title']);

}

function juassi_post_body() {
	global $juassi_post;

	return juassi_run_content_filter('post_body', $juassi_post['post_body']);

}

function juassi_post_body_raw() {
	global $juassi_post;

	return $juassi_post['post_body'];

}


function juassi_post_date($user_offset = true) {
	global $juassi_post;

	//do per user timezone offset

	return $juassi_post['post_date'];
}

function juassi_post_date_utc() {
	global $juassi_post;

	return $juassi_post['post_date_utc'];

}

function juassi_post_permalink() {
	global $juassi_post;
	static $permalink_array;

	if (isset($permalink_array[$juassi_post['post_id']])) {
		return $permalink_array[$juassi_post['post_id']]['permalink'];
	}
	else {
		$permalink_format = juassi_get_config('post_permalink_format');

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

function juassi_permalink($post) {
	static $permalink_array;

	if (isset($permalink_array[$post['post_id']])) {
		return $permalink_array[$post['post_id']]['permalink'];
	}
	else {
		$permalink_format = juassi_get_config('post_permalink_format');

		$year = substr($post['post_date'],0,4);
		$month = substr($post['post_date'],5,2);
		$day = substr($post['post_date'],8,2);

		$permalink = str_replace('%year%', $year, $permalink_format);
		$permalink = str_replace('%month%', $month, $permalink);
		$permalink = str_replace('%day%', $day, $permalink);
		$permalink = str_replace('%x_title%', $post['post_x_title'], $permalink);
		$permalink = str_replace('%post_id%', $post['post_id'], $permalink);

		$permalink = juassi_get_config('address') . $permalink;

		$permalink_array[$post['post_id']]['permalink'] = $permalink;

		return $permalink;
	}
}


function juassi_post_author() {
	global $juassi_post;

	return juassi_htmlentities($juassi_post['display_name']);
}

function juassi_post_author_id() {
	global $juassi_post;

	return (int) $juassi_post['user_id'];
}

//notice the s postS, used for rss lastBuildDate
function juassi_posts_date() {
	global $juassi_post_array;

	if (isset($juassi_post_array[0]['post_date'])) {
		return $juassi_post_array[0]['post_date'];
	}
	else {
		return false;
	}
}
function juassi_post_cat_breadcrumb() {
	global $juassi_post, $juassi_posts, $juassi_post_categories;

	$cats = $juassi_posts->get_post_categories($juassi_post['post_id']);
	$return = '';

	foreach ($cats as $cat) {
		$node = $juassi_post_categories->get_node((int)$cat['category_id']);
		$return .= $juassi_post_categories->breadcrumbs_string($node) . '<br />';
	}

	return $return;

}
function juassi_post_cat() {
	global $juassi_post, $juassi_posts;

	$cats = $juassi_posts->get_post_categories($juassi_post['post_id']);

	$return = '';

	$permalink_format = juassi_get_config('category_permalink_format');
	foreach ($cats as $cat) {
		$permalink = str_replace('%x_title%', juassi_htmlentities($cat['x_name']), $permalink_format);
		$permalink = juassi_get_config('address') . $permalink;

		$return .= '<a href="'.$permalink.'">' . juassi_htmlentities($cat['name']) . '</a>' . ', ';
	}
	if(substr($return, -2) == ', ') {
		$return = substr($return, 0, strlen($return) - 2);
	}

	return $return;

}

function juassi_post_comment_form() {
	global $juassi_post, $juassi_posts;

	if (juassi_get_config('comments') && $juassi_post['post_comments'] && $juassi_posts->matches_permalink()) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_post_comment_count() {
	global $juassi_post;
	return (int) $juassi_post['comment_count'];
}

function juassi_post_show_comment_count() {
	global $juassi_post, $juassi_posts;

	if ($juassi_post['post_comments'] && !$juassi_posts->matches_permalink()) {
		return true;
	}
	else {
		return false;
	}

}

function juassi_post_comments() {
	global $juassi_post, $juassi_posts;

	if ($juassi_posts->matches_permalink()) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_post_allowed_comments() {
	global $juassi_post;

	if (juassi_get_config('comments') && $juassi_post['post_comments']) {
		return true;
	}
	else {
		return false;
	}

}

function juassi_post_allows_comments() {
	global $juassi_post;

	if ($juassi_post['post_comments']) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_post_allows_external_comments() {
	global $juassi_post;

	if ($juassi_post['post_external_comments']) {
		return true;
	}
	else {
		return false;
	}
}


function juassi_post_id() {
	global $juassi_post;

	return (int) $juassi_post['post_id'];

}

function juassi_post_all_cat() {
	global $juassi_post_categories;

	return $juassi_post_categories->print_tree(array('name'));

}

function juassi_post_all_clouds_cat() {
	global $juassi_post_categories;

	return $juassi_post_categories->print_clouds(array('name'));

}

function juassi_post_all_cat_breadcrumb() {


}

function juassi_post_comments_setup() {
	global $juassi_comment_array, $juassi_post, $juassi_content_identifier;

	$juassi_comments = new juassi_comments();

	$juassi_content_identifier['id'] = juassi_post_id();
	$juassi_content_identifier['limit'] = '';

	$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
}

function juassi_posts_next_page() {
	global $juassi_content_identifier;

	if (empty($juassi_content_identifier['category'])) {
		$permalink_format = juassi_get_config('post_permalink_format');

		$permalink = str_replace('%year%', '', $permalink_format);
		$permalink = str_replace('%month%', '', $permalink);
		$permalink = str_replace('%day%', '', $permalink);
		$permalink = str_replace('%x_title%', '', $permalink);
		$permalink = str_replace('%post_id%', '', $permalink);
		if ((int)$juassi_content_identifier['page'] == 0) {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] + 2) . '/';
		}
		else {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] + 1) . '/';
		}

		$permalink = juassi_get_config('address') . $permalink;

		return $permalink;
	}
	else {
		$permalink_format = juassi_get_config('category_permalink_format');
		$permalink = str_replace('%x_title%', $juassi_content_identifier['category'], $permalink_format);

		if ((int)$juassi_content_identifier['page'] == 0) {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] + 2) . '/';
		}
		else {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] + 1) . '/';
		}

		$permalink = juassi_get_config('address') . $permalink;

		return $permalink;
	}
}


function juassi_posts_previous_page() {
	global $juassi_content_identifier;

	if (empty($juassi_content_identifier['category'])) {
		$permalink_format = juassi_get_config('post_permalink_format');

		$permalink = str_replace('%year%', '', $permalink_format);
		$permalink = str_replace('%month%', '', $permalink);
		$permalink = str_replace('%day%', '', $permalink);
		$permalink = str_replace('%x_title%', '', $permalink);
		$permalink = str_replace('%post_id%', '', $permalink);
		if ((int) $juassi_content_identifier['page'] > 1) {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] - 1) . '/';
		}
		else {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page']) . '/';
		}

		$permalink = juassi_get_config('address') . $permalink;

		return $permalink;
	}
	else {
		$permalink_format = juassi_get_config('category_permalink_format');
		$permalink = str_replace('%x_title%', $juassi_content_identifier['category'], $permalink_format);

		if ((int) $juassi_content_identifier['page'] > 1) {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] - 1) . '/';
		}
		else {
			$permalink .= 'page/' . ((int)$juassi_content_identifier['page']) . '/';
		}
		$permalink = juassi_get_config('address') . $permalink;

		return $permalink;
	}
}

function juassi_post_allowed_trackbacks() {
	global $juassi_post;

	if (juassi_get_config('trackbacks') && $juassi_post['post_external_comments']) {
		return true;
	}
	else {
		return false;
	}

}

function juassi_post_allows_trackbacks() {
	global $juassi_post;

	if ($juassi_post['post_external_comments']) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_post_trackback_link() {
	$trackback_url = juassi_get_config('address') . '/juassi-trackback.php?juassi_id=' . juassi_post_id();

	return $trackback_url;
}

function changeDate($fecha){
    
    $dateHuman = explode(' ',$fecha);
    $dayLetter = $dateHuman[0];
    $dayNumber = $dateHuman[1];
    $month = $dateHuman[2];
    $year = $dateHuman[3];
    $hour = $dateHuman[4];
    $seconds = $dateHuman[5];
    
    if(isset($month)){
        switch ($month){
            case 'Jan': $month = 'Ene';
                break;
            case 'Feb': $month = 'Feb';
                break;
            case 'Mar': $month = 'Mar';
                break;
            case 'Apr': $month = 'Abr';
                break;
            case 'May': $month = 'May';
                break;
            case 'Jun': $month = 'Jun';
                break;
            case 'Jul': $month = 'Jul';
                break;
            case 'Aug': $month = 'Ago';
                break;
            case 'Sep': $month = 'Sep';
                break;
            case 'Oct': $month = 'Oct';
                break;
            case 'Nov': $month = 'Nov';
                break;
            case 'Dec': $month = 'Dic';
                break;
            default : $month = 'null';
        }
    }
    if(isset($dayLetter)){
        switch($dayLetter){
            case 'Sun,': $dayLetter = 'Dom';
                break;
            case 'Mon,': $dayLetter = 'Lun';
                break;
            case 'Tue,': $dayLetter = 'Mar';
                break;
            case 'Wed,': $dayLetter = 'Mie';
                break;
            case 'Thu,': $dayLetter = 'Jue';
                break;
            case 'Fri,': $dayLetter = 'Vie';
                break;
            case 'Sat,': $dayLetter = 'Sab';
                break;
            default : $dayLetter = 'null';
        }
    }
    
    return $dayLetter.' '.$dayNumber.' '.$month.' '.$year.' '.$hour.' '.$seconds;
}

?>