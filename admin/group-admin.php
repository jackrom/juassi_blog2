<?php
include('include/admin-header.php');
juassi_set_admin_title('Group Administration');
juassi_set_in_admin(true);
$juassi_ln->add_lower_link($juassi_ln->user_admin, 'Group Administration', 'group-admin.php');
if (isset($_POST['add_group']) && !empty($_POST['group_name'])) {
	$group_id = juassi_add_group($_POST['group_name']);
}

include('include/html-header.php');
?>
<div class="contain">
	<?php
	$group_error = false;
	if (isset($_REQUEST['group_id'])) {
		$group_id = (int) $_REQUEST['group_id'];
	}
	elseif (isset($group_id) && $group_id ==! false) {
		echo juassi_admin_message('<strong>Group "' . juassi_htmlentities($_POST['group_name']) . '" Added</strong>');
	}
	elseif (isset($group_id) && $group_id == false) {
		$group_error = true;
		$group_id = 0;
	}
	else {
		$group_id = 0;
	}

	if (!juassi_get_group_name($group_id)) {
		?>
		<h1>Group Administration</h1>
		<?php if ($group_error) {
			echo juassi_admin_message('<strong>Group "' . juassi_htmlentities($_POST['group_name']) . '" not added (already exists).</strong>');
		} else {
			echo juassi_admin_message('<strong>Group not found.</strong>');
		}
	}
	else {
		?>
		<h1>Group Administration - <?php echo juassi_htmlentities(juassi_get_group_name($group_id)); ?></h1>
		<?php
		$message = false;
		if (isset($_POST['add_files']) || isset($_POST['delete_files'])) {
			foreach($_POST as $index => $value){
				if(strncasecmp($index, 'file_id-', 8) === 0) {
					$file_index = explode('-', $index);
					if (!empty($value)) {
						$file_id = (int) $file_index[1];
						if (isset($_POST['add_files'])) {
							juassi_add_file_to_group($file_id, $group_id);
						}
						elseif (isset($_POST['delete_files'])) {
							juassi_remove_file_from_group($file_id, $group_id);
						}
					}
				}
			}
			$message = true;
		}
		elseif (isset($_POST['add_tasks']) || isset($_POST['delete_tasks'])) {
			foreach($_POST as $index => $value){
				if(strncasecmp($index, 'task_id-', 8) === 0) {
					$task_index = explode('-', $index);
					if (!empty($value)) {
						$task_id = (int) $task_index[1];
						if (isset($_POST['add_tasks'])) {
							juassi_add_task_to_group($task_id, $group_id);
						}
						elseif (isset($_POST['delete_tasks'])) {
							juassi_remove_task_from_group($task_id, $group_id);
						}
					}
				}
			}
			$message = true;
		}
		if ($message) echo juassi_admin_message('<strong>Permissions Updated.</strong>');
		if ($message) trigger_error('Permissions updated for group "' . juassi_htmlentities(juassi_get_group_name($group_id)) . '"', E_USER_NOTICE);
		?>
		<h2>File Permissions</h2>
		<form method="post" action="">
		<fieldset>
		<legend>Permitted Admin Files</legend>
		<?php
		$file_list = juassi_get_permitted_file_list($group_id);
		if (!empty($file_list)) {
			foreach($file_list as $file) {
				?>
				<input type="checkbox" name="file_id-<?php echo (int) $file['file_id']; ?>" value="1" />
				<?php echo juassi_htmlentities($file['file_name']); ?><br />
				<?php
			}
		}
		?>
		<p><input type="hidden" name="group_id" value="<?php echo (int) $group_id; ?>"/><input type="submit" name="delete_files" value="Delete Selected"/></p>
		</fieldset>
		<fieldset>
		<legend>Available Admin Files</legend>
		<?php
		$file_list = juassi_get_available_files(FALSE, $group_id);
			foreach($file_list as $file) {
				?>
				<input type="checkbox" name="file_id-<?php echo (int) $file['file_id']; ?>" value="1" />
				<?php echo juassi_htmlentities($file['file_name']); ?><br />
				<?php
			}
			?>
		<p><input type="hidden" name="group_id" value="<?php echo (int) $group_id; ?>"/><input type="submit" name="add_files" value="Add Selected"/></p>
		</fieldset>
		</form>
		<br clear="all" />
		<br />
		<h2>Task Permissions</h2>
		<form method="post" action="">
		<fieldset>
		<legend>Permitted Tasks</legend>
		<?php
		$task_list = juassi_get_permitted_task_list($group_id);
		if (!empty($task_list)) {
			foreach($task_list as $task) {
				?>
				<input type="checkbox" name="task_id-<?php echo (int) $task['task_id']; ?>" value="1" />
				<?php echo juassi_htmlentities($task['task_name']); ?><br />
				<?php
			}
		}
		?>
		<p><input type="hidden" name="group_id" value="<?php echo (int) $group_id; ?>"/><input type="submit" name="delete_tasks" value="Delete Selected"/></p>
		</fieldset>
		<fieldset>
		<legend>Available Tasks</legend>
		<?php
		$task_list = juassi_get_available_tasks(FALSE, $group_id);
		foreach($task_list as $task) {
			?>
			<input type="checkbox" name="task_id-<?php echo (int) $task['task_id']; ?>" value="1" />
			<?php echo juassi_htmlentities($task['task_name']); ?><br />
			<?php
		}
		?>
		<p><input type="hidden" name="group_id" value="<?php echo (int) $group_id; ?>"/><input type="submit" name="add_tasks" value="Add Selected"/></p>
		</fieldset>
		</form>
		<br clear="all" />
		<script type="text/javascript">
		<!--
		function juassi_confirm() {
			if (confirm("Are you sure you wish to delete this group?")){
				return true;
			}
			else{
				return false;
			}
		}
		//-->
		</script>
		<?php if ($group_id == 1) { ?>
			<p>Note: You cannot delete this group.</p>
		<?php } else { ?>
			<form action="user-admin.php" method="post" onsubmit="return juassi_confirm(this);">
			<p><input type="hidden" name="delete_group" value="<?php echo (int) $group_id; ?>"/><input type="submit" name="delete_group_submit" value="Delete Group"/></p>
			</form>
		<?php } ?>
	<?php } ?>
</div>
<?php
include('include/html-footer.php');
?>