<?php

function juassi_get_title() {
	global $juassi_page_title;

	if (isset($juassi_page_title) && !empty($juassi_page_title)) {
		return juassi_get_config('name') . ' - ' . $juassi_page_title;
	}
	else {
		return juassi_get_config('name');
	}

}

function juassi_set_title($title) {
	global $juassi_page_title;

	$juassi_page_title = $title;

	return true;

}

function juassi_is_404() {
	global $juassi_404;

	if (isset($juassi_404)) {
		return $juassi_404;
	}
	else {
		return false;
	}

}

function juassi_set_404() {
	global $juassi_404;

	$juassi_404 = true;

	return true;

}

function juassi_unset_404() {
	global $juassi_404;

	$juassi_404 = false;

	return true;

}

function juassi_is_front_page() {
	global $juassi_content_identifier;

	if ($juassi_content_identifier['type'] == 'blog') {
		if (empty($juassi_content_identifier['year']) && empty($juassi_content_identifier['month']) && empty($juassi_content_identifier['day'])
		&& empty($juassi_content_identifier['x_title']) && empty($juassi_content_identifier['id']) && empty($juassi_content_identifier['page'])
		&& empty($juassi_content_identifier['category'])) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

function juassi_get_link_category($category_id) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT * FROM $juassi_tb->link_categories WHERE category_id = :id LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $category_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$cat = $stmt->fetch(PDO::FETCH_ASSOC);

	return $cat;
}

function juassi_get_link_categories() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT * FROM $juassi_tb->link_categories ORDER BY category_id DESC";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$links = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $links;
}

function juassi_get_link($link_id) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT * FROM $juassi_tb->links WHERE $juassi_tb->links.link_id = :link_id LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':link_id', $link_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$link = $stmt->fetch(PDO::FETCH_ASSOC);

	return $link;
}

function juassi_get_links_id($cat_id) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT * FROM $juassi_tb->links WHERE $juassi_tb->links.category_id = :cat_id ORDER BY $juassi_tb->links.link_order";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':cat_id', $cat_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$links = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $links;
}

function juassi_get_links($category, $return_array = FALSE) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT link_url, link_name, text_before_all, text_after_all, text_after FROM $juassi_tb->links, $juassi_tb->link_categories WHERE
	$juassi_tb->links.category_id = $juassi_tb->link_categories.category_id AND $juassi_tb->link_categories.category_name = :category_name ORDER BY $juassi_tb->links.link_order
	";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':category_name', $category);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$links = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($return_array) {
		return $links;
	}
	else {
		if (!empty($links)) {
			$output = '';
			foreach ($links as $link) {
				$output .= $link['text_before_all'] . '<a href="' . juassi_htmlentities($link['link_url']) . '">' . juassi_htmlentities($link['link_name']) . '</a>' .
				$link['text_after'] . $link['text_after_all'];
			}
			return $output;
		}
	}
}

function juassi_get_admin_bar() {
	global $juassi_db, $juassi_tb;

	$return = "

	";

	return $return;
}



?>