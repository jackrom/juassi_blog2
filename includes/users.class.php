<?php
	/*
		Juassi 2.0
		Juan Carlos Reyes C Copyright 2012
		jcarlosreyesc@juassi.com
	*/

	class juassi_users {

		public function add_user($user_array) {
			global $juassi_db, $juassi_tb;

			juassi_run_section_ref('add_user', $user_array);

			$query = "INSERT INTO $juassi_tb->users (user_name, password";

			if (!empty($user_array['active']) || $user_array['active'] == 0) {
				$query .= ', active';
			}
			if (!empty($user_array['joined'])) {
				$query .= ', joined';
			}
			if (!empty($user_array['display_name'])) {
				$query .= ', display_name';
			}
			if (!empty($user_array['email'])) {
				$query .= ', email';
			}
			if (!empty($user_array['website'])) {
				$query .= ', website';
			}
			if (!empty($user_array['active_key'])) {
				$query .= ', active_key';
			}
			if (!empty($user_array['contact'])) {
				$query .= ', contact';
			}
			if (!empty($user_array['gui_editor'])) {
				$query .= ', gui_editor';
			}
			if (!empty($user_array['group_id'])) {
				$query .= ', group_id';
			}

			$query .= ") VALUES (:user_name, :password";

			if (!empty($user_array['active']) || $user_array['active'] == 0) {
				$query .= ', :active';
			}
			if (!empty($user_array['joined'])) {
				$query .= ', :joined';
			}
			if (!empty($user_array['display_name'])) {
				$query .= ', :display_name';
			}
			if (!empty($user_array['email'])) {
				$query .= ', :email';
			}
			if (!empty($user_array['website'])) {
				$query .= ', :website';
			}
			if (!empty($user_array['active_key'])) {
				$query .= ', :active_key';
			}
			if (!empty($user_array['contact'])) {
				$query .= ', :contact';
			}
			if (!empty($user_array['gui_editor'])) {
				$query .= ', :gui_editor';
			}
			if (!empty($user_array['group_id'])) {
				$query .= ', :group_id';
			}

			$query .= ");";

			try {
				$stmt = $juassi_db->prepare($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$stmt->bindParam(':user_name', $user_array['user_name']);
			$stmt->bindParam(':password', $user_array['password']);

			if (!empty($user_array['active']) || $user_array['active'] == 0) {
				$stmt->bindParam(':active', $user_array['active']);
			}
			if (!empty($user_array['joined'])) {
				$stmt->bindParam(':joined', $user_array['joined']);
			}
			if (!empty($user_array['display_name'])) {
				$stmt->bindParam(':display_name', $user_array['display_name']);
			}
			if (!empty($user_array['email'])) {
				$stmt->bindParam(':email', $user_array['email']);
			}
			if (!empty($user_array['website'])) {
				$stmt->bindParam(':website', $user_array['website']);
			}
			if (!empty($user_array['active_key'])) {
				$stmt->bindParam(':active_key', $user_array['active_key']);
			}
			if (!empty($user_array['contact'])) {
				$stmt->bindParam(':contact', $user_array['contact']);
			}
			if (!empty($user_array['gui_editor'])) {
				$stmt->bindParam(':gui_editor', $user_array['gui_editor']);
			}
			if (!empty($user_array['group_id'])) {
				$stmt->bindParam(':group_id', $user_array['group_id']);
			}

			try {
				$stmt->execute();
				$user_id = $juassi_db->lastInsertId();
				//trigger_error('User "<a href="user-profile.php?user_id=' . $user_id . '">' . juassi_htmlentities($user_array['user_name']) . '</a>" Added', E_USER_NOTICE);
				return $user_id;
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

		}

		public function get_users($user_array = '') {
			global $juassi_db, $juassi_tb;

			$query = "SELECT * FROM $juassi_tb->users";

			$stmt = $juassi_db->prepare($query);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $users;
		}

		public function get_user($user_id) {
			global $juassi_db, $juassi_tb;

			$user_id = (int) $user_id;
			$query = "SELECT * FROM $juassi_tb->users WHERE user_id = :user_id LIMIT 1";

			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':user_id', $user_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (!empty($users))  {
				return $users[0];
			}
			else {
				return false;
			}

		}

		public function edit_user($user_array) {
			global $juassi_db, $juassi_tb;

			juassi_run_section_ref('edit_user', $user_array);

			$current_details = $this->get_user($user_array['id']);

			$query = "UPDATE $juassi_tb->users SET";

			if (!empty($user_array['active']) || $user_array['active'] == 0) {
				$query .= ' active = :active';
			}
			if (!empty($user_array['joined'])) {
				$query .= ', joined = :joined';
			}
			if (!empty($user_array['display_name'])) {
				$query .= ', display_name = :display_name';
			}
			if (!empty($user_array['email'])) {
				$query .= ', email = :email';
			}
			if (!empty($user_array['website'])) {
				$query .= ', website = :website';
			}
			if (!empty($user_array['active_key'])) {
				$query .= ', active_key = :active_key';
			}
			if (!empty($user_array['contact'])) {
				$query .= ', contact = :contact';
			}
			if (!empty($user_array['gui_editor'])) {
				$query .= ', gui_editor = :gui_editor';
			}
			if (!empty($user_array['group_id'])) {
				$query .= ', group_id = :group_id';
			}
			if (!empty($user_array['password'])) {
				$query .= ', password = :password';
			}

			$query .= " WHERE user_id = :user_id";

			try {
				$stmt = $juassi_db->prepare($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$stmt->bindParam(':user_id', $user_array['id']);

			if (!empty($user_array['active']) || $user_array['active'] == 0) {
				$stmt->bindParam(':active', $user_array['active']);
			}
			if (!empty($user_array['joined'])) {
				$stmt->bindParam(':joined', $user_array['joined']);
			}
			if (!empty($user_array['display_name'])) {
				$stmt->bindParam(':display_name', $user_array['display_name']);
			}
			if (!empty($user_array['email'])) {
				$stmt->bindParam(':email', $user_array['email']);
			}
			if (!empty($user_array['website'])) {
				$stmt->bindParam(':website', $user_array['website']);
			}
			if (!empty($user_array['active_key'])) {
				$stmt->bindParam(':active_key', $user_array['active_key']);
			}
			if (!empty($user_array['contact'])) {
				$stmt->bindParam(':contact', $user_array['contact']);
			}
			if (!empty($user_array['gui_editor'])) {
				$stmt->bindParam(':gui_editor', $user_array['gui_editor']);
			}
			if (!empty($user_array['group_id'])) {
				$stmt->bindParam(':group_id', $user_array['group_id']);
			}
			if (!empty($user_array['password'])) {
				$stmt->bindParam(':password', $user_array['password']);
			}

			try {
				$stmt->execute();
				trigger_error('User "<a href="user-profile.php?user_id=' . (int) $user_array['id'] . '">' . juassi_htmlentities($current_details['user_name']) . '</a>" Edited', E_USER_NOTICE);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		}

		//delete comments, posts etc?
		public function delete_user($user_id) {
			global $juassi_db, $juassi_tb;

			$user_id = (int) $user_id;

			$current_details = $this->get_user($user_id);

			$query = "DELETE FROM $juassi_tb->users WHERE user_id = :user_id";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':user_id', $user_id);

			try {
				trigger_error('User "' . juassi_htmlentities($current_details['user_name']) . '" Deleted', E_USER_NOTICE);
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			return true;

		}

		public function delete_non_active_users() {
			global $juassi_db, $juassi_tb;

			$query = "DELETE FROM $juassi_tb->users WHERE active = 0";
			$stmt = $juassi_db->prepare($query);

			try {
				trigger_error('Non-active Users Deleted', E_USER_NOTICE);
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		}

		public function is_user($user_name) {
			global $juassi_db, $juassi_tb;

			$query = "SELECT count(*) as `count` FROM $juassi_tb->users WHERE user_name = :user_name";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':user_name', $user_name);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			$users = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($users['count'] == 0) {
				return false;
			}
			else {
				return true;
			}
		}

	}
?>
