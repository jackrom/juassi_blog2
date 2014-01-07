<?php

	class juassi_comments {

		//need to finish this
		public function add_comment($comment_array) {
			global $juassi_db, $juassi_tb;

			juassi_run_section_ref('add_comment', $comment_array);

			$query = "
				INSERT INTO $juassi_tb->comments
				(user_id, comment_display_name, comment_email, comment_website,
				comment_body, comment_allow_contact_form, post_id, comment_spam_score, comment_akismet_spam,
				comment_approved, comment_date, comment_date_utc, comment_ip_address";
			if (isset($comment_array['comment_type']) && $comment_array['comment_type'] == 'trackback') {
				$query .= ", comment_trackback";
			}
			if (isset($comment_array['comment_title']) && !empty($comment_array['comment_title'])) {
				$query .= ", comment_title";
			}

			$query .= ") VALUES (:user_id, :comment_display_name, :comment_email, :comment_website,
				:comment_body, :allow_contact_form, :post_id, :spam_score, :akismet_spam,
				:approved, :comment_date, :comment_date_utc, :ip_address
			";

			if (isset($comment_array['comment_type']) && $comment_array['comment_type'] == 'trackback') {
				$query .= ", :comment_trackback";
			}
			if (isset($comment_array['comment_title']) && !empty($comment_array['comment_title'])) {
				$query .= ", :comment_title";
			}

			$query .= ")";

			$stmt = $juassi_db->prepare($query);

			$stmt->bindParam(':user_id', $comment_array['user_id']);
			$stmt->bindParam(':comment_display_name', $comment_array['comment_display_name']);
			$stmt->bindParam(':comment_email', $comment_array['comment_email']);
			$stmt->bindParam(':comment_website', $comment_array['comment_website']);
			$stmt->bindParam(':comment_body', $comment_array['comment_body']);
			$stmt->bindParam(':allow_contact_form', $comment_array['comment_allow_contact_form']);
			$stmt->bindParam(':post_id', $comment_array['post_id']);
			$stmt->bindParam(':spam_score', $comment_array['comment_spam_score']);
			$stmt->bindParam(':akismet_spam', $comment_array['comment_akismet_spam']);
			$stmt->bindParam(':approved', $comment_array['comment_approved']);
			$stmt->bindParam(':comment_date', $comment_array['comment_date']);
			$stmt->bindParam(':comment_date_utc', $comment_array['comment_date_utc']);
			$stmt->bindParam(':ip_address', $comment_array['comment_ip_address']);
			if (isset($comment_array['comment_type']) && $comment_array['comment_type'] == 'trackback') {
				$trackback = '1';
				$stmt->bindParam(':comment_trackback', $trackback);
			}
			if (isset($comment_array['comment_title']) && !empty($comment_array['comment_title'])) {
				$stmt->bindParam(':comment_title', $comment_array['comment_title']);
			}

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		}

		//get comments for a post
		public function get_comments($juassi_content_identifier) {
			global $juassi_db, $juassi_tb;

			if (isset($juassi_content_identifier['get_posts']) && $juassi_content_identifier['get_posts'] == true) {
				$query = "SELECT $juassi_tb->comments.*, $juassi_tb->users.display_name, $juassi_tb->users.website, $juassi_tb->users.email,
				$juassi_tb->posts.post_title, $juassi_tb->posts.post_x_title, $juassi_tb->posts.post_date, $juassi_tb->posts.post_date_utc
				FROM $juassi_tb->posts, $juassi_tb->comments
				LEFT JOIN $juassi_tb->users
				ON $juassi_tb->comments.user_id = $juassi_tb->users.user_id
				WHERE $juassi_tb->posts.post_id = $juassi_tb->comments.post_id";
				$and = true;
			}
			else {
				$query = "SELECT $juassi_tb->comments.*, $juassi_tb->users.display_name, $juassi_tb->users.website, $juassi_tb->users.email
				FROM $juassi_tb->comments
				LEFT JOIN $juassi_tb->users
				ON $juassi_tb->comments.user_id = $juassi_tb->users.user_id";
				$and = false;
			}
			if (isset($juassi_content_identifier['all_comments']) && $juassi_content_identifier['all_comments'] == 1) {
				if ($and) {
					$query .= " AND ($juassi_tb->comments.comment_approved = 0 OR $juassi_tb->comments.comment_approved = 1)";
				}
				else {
					$query .= " WHERE ($juassi_tb->comments.comment_approved = 0 OR $juassi_tb->comments.comment_approved = 1)";
				}
			}
			else {
				if (isset($juassi_content_identifier['comment_approved']) && $juassi_content_identifier['comment_approved'] == 0) {
						if ($and) {
							$query .= " AND $juassi_tb->comments.comment_approved = 0";
						}
						else {
							$query .= " WHERE $juassi_tb->comments.comment_approved = 0";
						}

				}
				else {
					if ($and) {
						$query .= " AND $juassi_tb->comments.comment_approved = 1";
					}
					else {
						$query .= " WHERE $juassi_tb->comments.comment_approved = 1";
					}
				}
			}

			if (!empty($juassi_content_identifier['id'])) {
				$query .= " AND $juassi_tb->comments.post_id = :post_id ";
			}

			if (!empty($juassi_content_identifier['comment_id'])) {
				$query .= " AND $juassi_tb->comments.comment_id = :comment_id ";
			}

			if (!empty($juassi_content_identifier['user_id'])) {
				$query .= " AND $juassi_tb->comments.user_id = :user_id ";
			}

			if (isset($juassi_content_identifier['only_akismet_spam']) && $juassi_content_identifier['only_akismet_spam'] == 1)  {
				$query .= " AND $juassi_tb->comments.comment_akismet_spam = 1 ";
			}

			if (isset($juassi_content_identifier['only_normal_spam']) && $juassi_content_identifier['only_normal_spam'] == 1)  {
				$query .= " AND $juassi_tb->comments.comment_akismet_spam = 0 ";
			}

			if (empty($juassi_content_identifier['order'])) {
				$query .= " ORDER BY $juassi_tb->comments.comment_date ";
			}
			else {
				$query .= " ORDER BY $juassi_tb->comments.comment_date DESC";
			}

			if (!empty($juassi_content_identifier['limit'])) {
				$query .= ' LIMIT ' . (int) $juassi_content_identifier['limit'];
				if (!empty($juassi_content_identifier['offset'])) {
					$query .= ' OFFSET ' . (int) $juassi_content_identifier['offset'];
				}
			}

			$stmt = $juassi_db->prepare($query);

			if (!empty($juassi_content_identifier['id'])) {
				$stmt->bindParam(':post_id', $juassi_content_identifier['id']);
			}

			if (!empty($juassi_content_identifier['comment_id'])) {
				$stmt->bindParam(':comment_id', $juassi_content_identifier['comment_id']);
			}
			if (!empty($juassi_content_identifier['user_id'])) {
				$stmt->bindParam(':user_id', $juassi_content_identifier['user_id']);
			}

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

			juassi_run_section_ref('comments', $comments);

			return $comments;

		}

		function delete_comment($comment_id) {
			global $juassi_db, $juassi_tb;

			$comment_id = (int) $comment_id;

			juassi_run_section('delete_comment', $comment_id);

			$query = "DELETE FROM $juassi_tb->comments WHERE comment_id = :comment_id";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':comment_id', $comment_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;

		}

		function approve_comment($comment_id) {
			global $juassi_db, $juassi_tb;

			$comment_id = (int) $comment_id;

			juassi_run_section('approve_comment', $comment_id);

			$query = "UPDATE $juassi_tb->comments SET comment_approved = 1 WHERE comment_id = :comment_id";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':comment_id', $comment_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}

		function disapprove_comment($comment_id) {
			global $juassi_db, $juassi_tb;

			$comment_id = (int) $comment_id;

			juassi_run_section('disapprove_comment', $comment_id);

			$query = "UPDATE $bt_tb->comments SET comment_approved = 0 WHERE comment_id = :comment_id";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':comment_id', $comment_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}

		function edit_comment($comment_array) {
			global $juassi_db, $juassi_tb;

			juassi_run_section_ref('edit_comment', $comment_array);

			$query = "UPDATE $juassi_tb->comments SET comment_body = :comment_body";

			if (!empty($comment_array['comment_display_name'])) {
				$query .= ', comment_display_name = :comment_display_name';
			}
			if (!empty($comment_array['comment_email'])) {
				$query .= ', comment_email = :comment_email';
			}
			if (!empty($comment_array['comment_website'])) {
				$query .= ', comment_website = :comment_website';
			}
			if (isset($comment_array['comment_title']) && !empty($comment_array['comment_title'])) {
				$query .= ', comment_title = :comment_title';
			}

			$query .= " WHERE comment_id = :comment_id";

			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':comment_id', $comment_array['comment_id']);
			$stmt->bindParam(':comment_body', $comment_array['comment_body']);

			if (!empty($comment_array['comment_display_name'])) {
				$stmt->bindParam(':comment_display_name', $comment_array['comment_display_name']);
			}
			if (!empty($comment_array['comment_email'])) {
				$stmt->bindParam(':comment_email', $comment_array['comment_email']);
			}
			if (!empty($comment_array['comment_website'])) {
				$stmt->bindParam(':comment_website', $comment_array['comment_website']);
			}
			if (isset($comment_array['comment_title']) && !empty($comment_array['comment_title'])) {
				$stmt->bindParam(':comment_title', $comment_array['comment_title']);
			}

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;
		}

	}
?>