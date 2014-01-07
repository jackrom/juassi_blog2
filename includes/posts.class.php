<?php
/*
	Juassi 2.0 Posts Support
	Juan Carlos Reyes C Copyright 2012
*/
if (!defined('JUASSI_ROOT')) exit;

class juassi_posts extends juassi_common_content {

	function juassi_posts() {
		global $juassi_tb;

		parent::set_x_name_table($juassi_tb->posts);
		parent::set_x_name_column('post_x_title');

	}

	/*
		Returns an array of posts
	*/
	public function get_posts($juassi_content_identifier) {
		global $juassi_db, $juassi_tb, $juassi_post_categories, $juassi_db_type;

		//$post = array();
		if (!empty($juassi_content_identifier['comment_count'])) {
			$query = "SELECT $juassi_tb->posts.*, $juassi_tb->users.display_name AS display_name, $juassi_tb->users.user_name AS user_name, count($juassi_tb->comments.comment_id) as comment_count FROM $juassi_tb->posts
			LEFT JOIN $juassi_tb->users
			ON $juassi_tb->posts.user_id = $juassi_tb->users.user_id
			LEFT JOIN $juassi_tb->comments
			ON $juassi_tb->posts.post_id = $juassi_tb->comments.post_id AND $juassi_tb->comments.comment_approved = 1
			WHERE 1 = 1";
		}
		else {

			$query = "SELECT $juassi_tb->posts.*, $juassi_tb->users.display_name AS display_name, $juassi_tb->users.user_name AS user_name FROM $juassi_tb->posts
			LEFT JOIN $juassi_tb->users
			ON $juassi_tb->posts.user_id = $juassi_tb->users.user_id
			WHERE 1 = 1";

		}

		if (!empty($juassi_content_identifier['post_type'])) {
			$query .= " AND $juassi_tb->posts.post_type = :post_type";
		}

		$page_title = '';

		if (!empty($juassi_content_identifier['category'])) {
			$cat_ids = $this->get_category_ids_hier($juassi_content_identifier['category']);

			if (!empty($cat_ids)) {
				$page_title .= juassi_htmlentities($juassi_post_categories->node_attribute($juassi_post_categories->get_node((int)$cat_ids[0]['category_id']), 'name'));

				$return = '';
				foreach ($cat_ids as $cat_id) {
					$return .= (int)$cat_id . ' OR category_id = ';
				}
				if(substr($return, -18) == ' OR category_id = ') {
					$return = substr($return, 0, strlen($return) - 18);
				}
				$query .= " AND $juassi_tb->posts.post_id IN (SELECT $juassi_tb->posts_to_categories.post_id FROM $juassi_tb->posts_to_categories WHERE category_id = $return)";
			}
			else {
				juassi_set_404();
				return array();
			}
		}
		switch ($juassi_db_type) {

			case 'mysql':
				if (!empty($juassi_content_identifier['year'])) {
					$query .= ' AND YEAR(post_date) = :year ';
					$page_title .= $juassi_content_identifier['year'];
				}
				if (!empty($juassi_content_identifier['month'])) {
					$query .= ' AND MONTH(post_date) = :month ';
					$page_title .= ' &raquo; ' . $juassi_content_identifier['month'];
				}
				if (!empty($juassi_content_identifier['day'])) {
					$query .= ' AND DAYOFMONTH(post_date) = :day ';
					$page_title .= ' &raquo; ' . $juassi_content_identifier['day'];
				}

			break;

			case 'sqlite':
				if (!empty($juassi_content_identifier['year'])) {
					//$query .= ' AND YEAR(post_date) = :year ';
					//$query = ' AND post_date'
					$page_title .= $juassi_content_identifier['year'];
				}
				if (!empty($bt_content_identifier['month'])) {
					//$query .= ' AND MONTH(post_date) = :month ';
					$page_title .= ' &raquo; ' . $juassi_content_identifier['month'];
				}
				if (!empty($juassi_content_identifier['day'])) {
					//$query .= ' AND DAYOFMONTH(post_date) = :day ';
					$page_title .= ' &raquo; ' . $juassi_content_identifier['day'];
				}
				//need to do sqlite date stuff here

			break;


		}

		if (!empty($juassi_content_identifier['x_title'])) {
			$query .= ' AND post_x_title = :x_title ';
		}
		if (!empty($juassi_content_identifier['id']) || $juassi_content_identifier['id'] === 0) {
			$query .= " AND $juassi_tb->posts.post_id = :post_id ";
		}
		if (!empty($juassi_content_identifier['user_id'])) {
			$query .= " AND $juassi_tb->posts.user_id = :user_id ";
		}

		$query .= " GROUP BY $juassi_tb->posts.post_id ";

		$query .= ' ORDER BY post_date DESC ';


		if (!empty($juassi_content_identifier['limit'])) {
			$query .= ' LIMIT ' . (int) $juassi_content_identifier['limit'];
			if (!empty($juassi_content_identifier['offset'])) {
				$query .= ' OFFSET ' . (int) $juassi_content_identifier['offset'];
			}
		}

		try {
			$stmt = $juassi_db->prepare($query);
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		switch ($juassi_db_type) {

			case 'mysql':
				if (!empty($juassi_content_identifier['year'])) {
					$stmt->bindParam(':year', $juassi_content_identifier['year']);
				}
				if (!empty($juassi_content_identifier['month'])) {
					$stmt->bindParam(':month', $juassi_content_identifier['month']);
				}
				if (!empty($juassi_content_identifier['day'])) {
					$stmt->bindParam(':day', $juassi_content_identifier['day']);
				}
			break;

			case 'sqlite':

			break;
		}
		if (!empty($juassi_content_identifier['x_title'])) {
			$stmt->bindParam(':x_title', $juassi_content_identifier['x_title']);
		}
		if (!empty($juassi_content_identifier['id']) || $juassi_content_identifier['id'] === 0) {
			$stmt->bindParam(':post_id', $juassi_content_identifier['id']);
		}
		if (!empty($juassi_content_identifier['user_id'])) {
			$stmt->bindParam(':user_id', $juassi_content_identifier['user_id']);
		}
		if (!empty($juassi_content_identifier['post_type'])) {
			$stmt->bindParam(':post_type', $juassi_content_identifier['post_type']);
		}

		if (!empty($page_title)) juassi_set_title($page_title);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (empty($juassi_content_identifier['category']) && empty($posts)) {
			juassi_set_404();
		}

		juassi_run_section_ref('posts', $posts);

		return $posts;
	}

	/*
		Returns a single post
	*/
	public function get_post() {

	}

	public function add_post($post_array) {
		global $juassi_db, $juassi_tb;

		/*
		Should change this to act like edit_post (i.e. not all array values need to be set)
		*/
		juassi_run_section_ref('add_post', $post_array);

		$query = "INSERT INTO $juassi_tb->posts
		(user_id, post_date, post_date_utc, post_title, post_body, post_type, post_x_title, post_comments, post_external_comments)
		VALUES
		(:user_id, :post_date, :post_date_utc, :post_title, :post_body, :post_type, :post_x_title, :post_comments, :post_external_comments)
		";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':user_id', $post_array['user_id']);
		$stmt->bindParam(':post_date', $post_array['post_date']);
		$stmt->bindParam(':post_date_utc', $post_array['post_date_utc']);
		$stmt->bindParam(':post_title', $post_array['post_title']);
		$stmt->bindParam(':post_body', $post_array['post_body']);
		$stmt->bindParam(':post_type', $post_array['post_type']);
		$stmt->bindParam(':post_x_title', $post_array['post_x_title']);
		$stmt->bindParam(':post_comments', $post_array['post_comments']);
		$stmt->bindParam(':post_external_comments', $post_array['post_external_comments']);

		try {
			$stmt->execute();
			return $juassi_db->lastInsertId();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

	}

	public function edit_post($post_array) {
		global $juassi_db, $juassi_tb;

		juassi_run_section_ref('edit_post', $post_array);

		$query = "UPDATE $juassi_tb->posts SET user_id = :user_id ";

		if (!empty($post_array['post_date'])) {
			$query .= ', post_date = :post_date';
		}
		if (!empty($post_array['post_date_utc'])) {
			$query .=  ', post_date_utc = :post_date_utc';
		}
		if (!empty($post_array['post_x_title'])) {
			$query .=  ', post_x_title = :post_x_title';
		}
		if (!empty($post_array['post_external_comments']) || $post_array['post_external_comments'] === 0) {
			$query .=  ', post_external_comments = :post_external_comments';
		}

		$query .= ", post_title = :post_title, post_body = :post_body, post_type = :post_type, post_comments = :post_comments
		WHERE post_id = :post_id
		";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':user_id', $post_array['user_id']);

		if (!empty($post_array['post_date'])) {
			$stmt->bindParam(':post_date', $post_array['post_date']);
		}

		if (!empty($post_array['post_date_utc'])) {
			$stmt->bindParam(':post_date_utc', $post_array['post_date_utc']);
		}
		if (!empty($post_array['post_x_title'])) {
			$stmt->bindParam(':post_x_title', $post_array['post_x_title']);
		}
		if (!empty($post_array['post_external_comments']) || $post_array['post_external_comments'] === 0) {
			$stmt->bindParam(':post_external_comments', $post_array['post_external_comments']);
		}

		$stmt->bindParam(':post_title', $post_array['post_title']);
		$stmt->bindParam(':post_body', $post_array['post_body']);
		$stmt->bindParam(':post_type', $post_array['post_type']);
		$stmt->bindParam(':post_x_title', $post_array['post_x_title']);
		$stmt->bindParam(':post_comments', $post_array['post_comments']);
		$stmt->bindParam(':post_id', $post_array['post_id']);

		try {
			$stmt->execute();
			return true;
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

	}

	//deletes a post (and categories/comments both inclusives)
	public function delete_post($post_id, $delete_comments = TRUE) {
		global $juassi_db, $juassi_tb;

		juassi_run_section_ref('delete_post', $post_id);

		//delete post
		$query = "DELETE FROM $juassi_tb->posts WHERE post_id = ?";

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $post_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		//delete categories for the post
		$query = "DELETE FROM $juassi_tb->posts_to_categories WHERE post_id = ?";

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $post_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		//delete comments for the post
		if ($delete_comments) {

			$query = "DELETE FROM $juassi_tb->comments WHERE post_id = ?";

			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(1, $post_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		}

		return true;


	}

	public function delete_content($content_id) {
		global $juassi_db, $juassi_tb;

		juassi_run_section_ref('delete_content', $content_id);

		//delete post
		$query = "DELETE FROM $juassi_tb->posts WHERE post_id = ?";

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $content_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		return true;


	}

	//adds a category to a post
	public function add_category_to_post($post_id, $category_id) {
		global $juassi_db, $juassi_tb;

		$post_id = (int) $post_id;
		$category_id = (int) $category_id;

		$query = "SELECT count(*) FROM $juassi_tb->posts_to_categories WHERE post_id = ? AND category_id = ? LIMIT 1";
		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(1, $post_id);
		$stmt->bindParam(2, $category_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$count = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($count['count(*)'] <> 0) {
			//already in list
			return false;
		}
		else {

			$query = "INSERT INTO $juassi_tb->posts_to_categories (post_id, category_id) Values (?, ?)";

			$stmt = $juassi_db->prepare($query);

			$stmt->bindParam(1, $post_id);
			$stmt->bindParam(2, $category_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}
	}

	//delete categories for a post
	function delete_all_categories_from_post($post_id) {
		global $juassi_db, $juassi_tb;

		$query = "DELETE FROM $juassi_tb->posts_to_categories WHERE post_id = ?";

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $post_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		return true;

	}

	//get all categories for a post
	public function get_post_categories($post_id) {
		global $juassi_db, $juassi_tb;

		$query = "
		SELECT $juassi_tb->categories.name, $juassi_tb->categories.x_name, $juassi_tb->categories.category_id
		FROM $juassi_tb->categories INNER JOIN $juassi_tb->posts_to_categories
		ON $juassi_tb->categories.category_id = $juassi_tb->posts_to_categories.category_id
		WHERE $juassi_tb->posts_to_categories.post_id = ?";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(1, $post_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$post_cat = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $post_cat;
	}

	public function get_post_category_ids($post_id) {
		global $juassi_db, $juassi_tb;

		$query = "SELECT $juassi_tb->posts_to_categories.category_id FROM $juassi_tb->posts_to_categories WHERE post_id = ?";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(1, $post_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$category_ids = array();
		while ($category_id = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$category_ids[] = $category_id['category_id'];
		}

		return $category_ids;

	}

	//gets all post ids for a category (single cat)
	public function get_category_post_ids($category) {
		global $juassi_db, $juassi_tb;

		$query = "
		SELECT $juassi_tb->posts.post_id FROM $juassi_tb->posts WHERE post_id IN
		(SELECT $juassi_tb->posts_to_categories.post_id FROM $juassi_tb->posts_to_categories
		INNER JOIN $juassi_tb->categories
		ON $juassi_tb->categories.category_id = $juassi_tb->posts_to_categories.category_id
		WHERE $juassi_tb->categories.x_name = ?)
		";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(1, $category);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$post_ids = array();
		while ($post_id = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$post_ids[] = $post_id['post_id'];
		}

		return $post_ids;

	}

	public function get_category_ids_hier($category) {
		global $juassi_db, $juassi_tb, $juassi_post_categories;

		$node['left'] = 0;
		$node['right'] = 0;

		$query = "SELECT * FROM $juassi_tb->categories WHERE x_name = ?";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $category);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$array = array();

		if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$node['left'] = $row['lft'];
			$node['right'] = $row['rgt'];
			$stmt = NULL;
			$attributes = array("category_id");
			$wlk = $juassi_post_categories->walk_preorder($node);

			while ($curr = $juassi_post_categories->walk_next($wlk)) {
				$array[] = $wlk['row']['category_id'];
			}
		}

		return $array;
	}

	//gets the category id when given the name of the category
	public function get_category_id($value, $type = '') {
		global $juassi_db, $juassi_tb;

		switch($type) {
			case 'name':
				$query = "SELECT category_id FROM $juassi_tb->categories WHERE name = ? LIMIT 1";
			break;

			default:
				$query = "SELECT category_id FROM $juassi_tb->categories WHERE x_name = ? LIMIT 1";
		}

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $value);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		return $array['category_id'];

	}

	//get all post ids for a category and all children
	public function get_category_post_ids_hier($category) {
		global $juassi_db, $juassi_tb, $juassi_post_categories;

		$cat_ids = $this->get_category_ids_hier($category);
		$post_ids = array();

		if (!empty($cat_ids)) {
			$return = '';
			foreach ($cat_ids as $cat_id) {
				$return .= (int)$cat_id . ' OR category_id = ';
			}
			if(substr($return, -18) == ' OR category_id = ') {
				$return = substr($return, 0, strlen($return) - 18);
			}

			$query = "SELECT post_id FROM $juassi_tb->posts WHERE post_id IN (SELECT $juassi_tb->posts_to_categories.post_id FROM $juassi_tb->posts_to_categories WHERE category_id = $return)";

			$stmt = $juassi_db->prepare($query);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			while ($post_id = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$post_ids[] = $post_id['post_id'];
			}
		}

		return $post_ids;

	}

	//checks if url visited by user is the same as the permalink for a post
	public function matches_permalink() {
		$internal = juassi_post_permalink();

		if(substr($internal, 0, 7) == 'http://') {
			$internal = substr($internal, 7, strlen($internal));
		}
		else if(substr($internal, 0, 8) == 'https://') {
			$internal = substr($internal, 8, strlen($internal));
		}
		$external = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if ($internal == $external) {
			return true;
		}
		else {
			return false;
		}
	}

		//checks if url visited by user is the same as the permalink for content
	public function matches_permalink_content() {
		$internal = juassi_content_permalink();

		if(substr($internal, 0, 7) == 'http://') {
			$internal = substr($internal, 7, strlen($internal));
		}
		else if(substr($internal, 0, 8) == 'https://') {
			$internal = substr($internal, 8, strlen($internal));
		}
		$external = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if ($internal == $external) {
			return true;
		}
		else {
			return false;
		}
	}

}

?>