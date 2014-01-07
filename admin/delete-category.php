<?php
	include('include/admin-header.php');
	juassi_set_in_admin(true);
	juassi_set_header('Location: categories.php');
	
	if (isset($_POST['category_id'])) {
		$category_id = (int) $_POST['category_id'];
	}
	else {
		$category_id = 0;
	}
	
	if (juassi_user_can('delete_categories')) {
		$juassi_posts 				= new juassi_posts();
		$juassi_post_categories 	= new juassi_categories($juassi_tb->categories);
		
		$node_to_delete 		= $juassi_post_categories->get_node($category_id);
		
		$parent 				= $juassi_post_categories->ancestor($node_to_delete);

		$new_cat_id 			= (int) $parent['category_id'];
		
		$all_post_ids			= $juassi_posts->get_category_post_ids_hier($node_to_delete['x_name']);

		$cat_ids				= $juassi_posts->get_category_ids_hier($node_to_delete['x_name']);

		if (!empty($cat_ids)) {
		
			//move posts to new cat.
			if (!empty($all_post_ids)) {
				$return = 'post_id = ';
				foreach ($all_post_ids as $post_id) {
					$return .= (int)$post_id . ' OR post_id = ';
				}
				if(substr($return, -14) == ' OR post_id = ') {	
					$return = substr($return, 0, strlen($return) - 14);
				}
			}
			
			$cat_return = 'category_id = ';
			
			foreach ($cat_ids as $cat_id) {
				$cat_return .= (int)$cat_id . ' OR category_id = ';
			}
			if(substr($cat_return, -18) == ' OR category_id = ') {	
				$cat_return = substr($cat_return, 0, strlen($cat_return) - 18);
			}
			
			$query = "DELETE FROM $juassi_tb->posts_to_categories WHERE (".$cat_return.")";
			
			if (!empty($all_post_ids)) {
				$query .= "AND (" . $return . ")";
			}
			
			try {
				$stmt = $juassi_db->prepare($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			
			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			
			//delete old category
			$juassi_post_categories->delete($node_to_delete);
			
			if ($new_cat_id !== 0) {
			
				//add categories to parent
				foreach ($all_post_ids as $post_id) {
					$juassi_posts->add_category_to_post($post_id, $new_cat_id);
				}
			}
		}

	}
	
	juassi_send_headers();
?>