<?php
/*
	File based permissions
*/
function juassi_has_permissions() {

	$juassi_current_file = juassi_current_file();
	$permitted_files = juassi_get_permitted_files();

	if (in_array($juassi_current_file, $permitted_files)) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_get_permitted_files($group_id = '') {
	global $juassi_db, $juassi_tb;
	static $permitted_files_array;

	if (empty($group_id)) {
		$group_id = juassi_get_user_data('group_id');
	}
	else {
		$group_id = (int) $group_id;
	}

	if (isset($permitted_files_array[$group_id])) {
		return $permitted_files_array[$group_id];
	}
	else {
		$query = "
		SELECT $juassi_tb->file_permissions.file_name
		FROM $juassi_tb->file_permissions INNER JOIN $juassi_tb->files_to_groups
		ON $juassi_tb->files_to_groups.file_id = $juassi_tb->file_permissions.file_id
		WHERE $juassi_tb->files_to_groups.group_id = :group_id";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':group_id', $group_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$juassi_permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$file_list = array();
		foreach ($juassi_permissions as $index => $value) {
			$file_list[] = $value['file_name'];
		}

		$permitted_files_array[$group_id] = $file_list;

		return $file_list;
	}
}

function juassi_get_available_files($all_files = TRUE, $group_id = NULL) {
	global $juassi_db, $juassi_tb;

	if ($all_files) {
		$query = "SELECT $juassi_tb->file_permissions.file_name, $juassi_tb->file_permissions.file_id FROM $juassi_tb->file_permissions ORDER BY $juassi_tb->file_permissions.file_name";
	}
	else {
		$query = "
			SELECT $juassi_tb->file_permissions.file_name, $juassi_tb->file_permissions.file_id
			FROM $juassi_tb->file_permissions
			WHERE $juassi_tb->file_permissions.file_id NOT IN (SELECT file_id FROM $juassi_tb->files_to_groups WHERE $juassi_tb->files_to_groups.group_id = :group_id)
			ORDER BY $juassi_tb->file_permissions.file_name";
	}

	$stmt = $juassi_db->prepare($query);

	if (!$all_files) {
		$stmt->bindParam(':group_id', $group_id);
	}

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$files = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $files;
}

function juassi_add_permitted_file($file_name) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->file_permissions WHERE file_name = ? LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(1, $file_name);

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
		$query = "INSERT INTO $juassi_tb->file_permissions (file_name) VALUES (?)";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $file_name);
		try {
			$stmt->execute();
			return $juassi_db->lastInsertId();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}
}

function juassi_add_file_to_group($file_id, $group_id) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->files_to_groups WHERE file_id = :file_id AND group_id = :group_id LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':file_id', $file_id);
	$stmt->bindParam(':group_id', $group_id);

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
		$query = "INSERT INTO $juassi_tb->files_to_groups (file_id, group_id) VALUES (:file_id, :group_id)";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(':file_id', $file_id);
		$stmt->bindParam(':group_id', $group_id);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$file_id = $juassi_db->lastInsertId();
		//trigger_error('Filed added to group "' . juassi_htmlentities(juassi_get_group_name($group_id)) . '"', E_USER_NOTICE);
		return $file_id;
	}

}

function juassi_remove_file_from_group($file_id, $group_id) {
	global $juassi_db, $juassi_tb;

	$query = "DELETE FROM $juassi_tb->files_to_groups WHERE file_id = :file_id AND group_id = :group_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':file_id', $file_id);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;
}

function juassi_get_permitted_file_list($group_id = '') {
	global $juassi_db, $juassi_tb;

	if (empty($group_id)) {
		$group_id = juassi_get_user_data('group_id');
	}
	else {
		$group_id = (int) $group_id;
	}

	$query = "
	SELECT $juassi_tb->file_permissions.file_name, $juassi_tb->file_permissions.file_id
	FROM $juassi_tb->file_permissions INNER JOIN $juassi_tb->files_to_groups
	ON $juassi_tb->files_to_groups.file_id = $juassi_tb->file_permissions.file_id
	WHERE $juassi_tb->files_to_groups.group_id = :group_id ORDER BY $juassi_tb->file_permissions.file_name";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':group_id', $group_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$juassi_permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($juassi_permissions) {
		return $juassi_permissions;
	}
	else {
		return false;
	}

}

function juassi_get_permitted_task_list($group_id = '') {
	global $juassi_db, $juassi_tb;

	if (empty($group_id)) {
		$group_id = juassi_get_user_data('group_id');
	}
	else {
		$group_id = (int) $group_id;
	}

	$query = "
		SELECT $juassi_tb->task_permissions.task_name, $juassi_tb->task_permissions.task_id
		FROM $juassi_tb->task_permissions INNER JOIN $juassi_tb->tasks_to_groups
		ON $juassi_tb->tasks_to_groups.task_id = $juassi_tb->task_permissions.task_id
		WHERE $juassi_tb->tasks_to_groups.group_id = :group_id ORDER BY $juassi_tb->task_permissions.task_name";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':group_id', $group_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$juassi_permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($juassi_permissions) {
		return $juassi_permissions;
	}
	else {
		return false;
	}

}

function juassi_add_group($group_name) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->groups WHERE group_name = :group_name LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':group_name', $group_name);

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
		$query = "INSERT INTO $juassi_tb->groups (group_name) VALUES (:group_name)";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(':group_name', $group_name);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$group_id = $juassi_db->lastInsertId();
		//trigger_error('Group "<a href="group-admin.php?group_id='.juassi_htmlentities($group_id).'">' . juassi_htmlentities($group_name) . '</a>" added.', E_USER_NOTICE);

		return $group_id;
	}

}

function juassi_delete_group($group_id) {
	global $juassi_db, $juassi_tb;

	$group_name = juassi_get_group_name((int) $_POST['delete_group']);

	/*
		Delete Tasks
	*/
	$query = "DELETE FROM $juassi_tb->tasks_to_groups WHERE group_id = :group_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	/*
		Delete Files
	*/
	$query = "DELETE FROM $juassi_tb->files_to_groups WHERE group_id = :group_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}


	$query = "DELETE FROM $juassi_tb->groups WHERE group_id = :group_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
	trigger_error('Group "' . juassi_htmlentities($group_name) . '" Deleted', E_USER_NOTICE);


	return true;
}
/*
	Task based permission
*/

function juassi_user_can($task, $group_id = '') {

	$permitted_tasks = juassi_get_permitted_tasks($group_id);

	if (in_array($task, $permitted_tasks)) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_get_permitted_tasks($group_id = '') {
	global $juassi_db, $juassi_tb;
	static $permitted_task_array;

	if (empty($group_id)) {
		$group_id = juassi_get_user_data('group_id');
	}
	else {
		$group_id = (int) $group_id;
	}

	if (isset($permitted_task_array[$group_id])) {
		return $permitted_task_array[$group_id];
	}
	else {
		$query = "
		SELECT $juassi_tb->task_permissions.task_name
		FROM $juassi_tb->task_permissions INNER JOIN $juassi_tb->tasks_to_groups
		ON $juassi_tb->tasks_to_groups.task_id = $juassi_tb->task_permissions.task_id
		WHERE $juassi_tb->tasks_to_groups.group_id = :group_id";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':group_id', $group_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$juassi_permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$task_list = array();
		foreach ($juassi_permissions as $index => $value) {
			$task_list[] = $value['task_name'];
		}

		$permitted_task_array[$group_id] = $task_list;

		return $task_list;
	}

}

function juassi_get_available_tasks($all_tasks = TRUE, $group_id = NULL) {
	global $juassi_db, $juassi_tb;

	if ($all_tasks) {
		$query = "SELECT $juassi_tb->task_permissions.task_name, $juassi_tb->task_permissions.task_id FROM $juassi_tb->task_permissions ORDER BY $juassi_tb->task_permissions.task_name";	}
	else {
		$query = "
			SELECT $juassi_tb->task_permissions.task_name, $juassi_tb->task_permissions.task_id
			FROM $juassi_tb->task_permissions
			WHERE $juassi_tb->task_permissions.task_id NOT IN (SELECT task_id FROM $juassi_tb->tasks_to_groups WHERE $juassi_tb->tasks_to_groups.group_id = :group_id)
			ORDER BY $juassi_tb->task_permissions.task_name";
	}

	$stmt = $juassi_db->prepare($query);

	if (!$all_tasks) {
		$stmt->bindParam(':group_id', $group_id);
	}

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $tasks;
}

function juassi_add_permitted_task($task_name) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->task_permissions WHERE task_name = ? LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(1, $task_name);

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
		$query = "INSERT INTO $juassi_tb->task_permissions (task_name) VALUES (?)";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $task_name);
		try {
			$stmt->execute();
			return $juassi_db->lastInsertId();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}
}

function juassi_remove_task_from_group($task_id, $group_id) {
	global $juassi_db, $juassi_tb;

	$query = "DELETE FROM $juassi_tb->tasks_to_groups WHERE task_id = :task_id AND group_id = :group_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':task_id', $task_id);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;
}

function juassi_add_task_to_group($task_id, $group_id) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->tasks_to_groups WHERE task_id = :task_id AND group_id = :group_id LIMIT 1";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':task_id', $task_id);
	$stmt->bindParam(':group_id', $group_id);

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
		$query = "INSERT INTO $juassi_tb->tasks_to_groups (task_id, group_id) VALUES (:task_id, :group_id)";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(':task_id', $task_id);
		$stmt->bindParam(':group_id', $group_id);
		try {
			$stmt->execute();
			return $juassi_db->lastInsertId();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}

}

function juassi_get_group_name($group_id) {
	global $juassi_db, $juassi_tb;

	$group_id = (int) $group_id;

	$query = "SELECT $juassi_tb->groups.group_name FROM $juassi_tb->groups WHERE group_id = :group_id LIMIT 1";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':group_id', $group_id);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$group = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($group) {
		return $group['group_name'];
	}
	else {
		return false;
	}

}

function juassi_get_groups() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT * FROM $juassi_tb->groups";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $groups;
}

?>