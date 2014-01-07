<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Edit Content');
	juassi_set_in_admin(true);

	include('include/html-header.php');
?>
	<div class="contain">
<?php
	$juassi_posts = new juassi_posts();
	if (isset($_POST['edit_submit']))  {
		$content_id = (int) $_POST['content_id'];

		$juassi_content_identifier['id'] = $content_id;
		if (!juassi_user_can('edit_posts')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		if (empty($juassi_post_array)) {
			$juassi_input_error = 'Content Not Found.';
			unset($juassi_post_array);
		}
		else {
			$old_user_id = $juassi_post_array[0]['user_id'];
			unset($juassi_post_array);

			$post_title = $_POST['juassi_post_title'];
			$post_body = $_POST['juassi_post_body'];
			$post_array['post_id'] = $content_id;

			if (isset($_POST['juassi_version'])) {
				$post_version = $_POST['juassi_version'];

				if ($post_version != 'published_content' && $post_version != 'draft_content' && $post_version != 'private_content') {
					$post_version = 'published_content';
				}
			}
			else {
				$post_version = 'published';
			}

			if (isset($_POST['juassi_x_title']) && !empty($_POST['juassi_x_title'])) {
				$juassi_post_x_title = juassi_x_title($_POST['juassi_x_title']);
			}
			else {
				$juassi_post_x_title = juassi_x_title($post_title);
			}

			if (empty($juassi_post_x_title)) {
				$message = "<strong>No title and/or Slug/URL Title does not contain any valid characters.</strong>";
			}
			else {
				$post_array['user_id'] = (int) $old_user_id;
				$post_array['post_title'] = $post_title;
				$post_array['post_body'] = $post_body;
				$post_array['post_type'] = $post_version;
				$post_array['post_x_title'] = $juassi_post_x_title;

				$post_array['post_comments'] = 0;
				$post_array['post_external_comments'] = 0;

				if (isset($_POST['juassi_post_date']) && !empty($_POST['juassi_post_date']) && bt_check_datetime($_POST['juassi_post_date'])) {
					$post_array['post_date'] = $_POST['juassi_post_date'];
					$post_array['post_date_utc'] = juassi_datetime_utc_from_datetime($post_array['post_date']);
				}

				$juassi_posts->edit_post($post_array);

				$juassi_content_identifier['id'] = $content_id;
				$juassi_content_identifier['post_type'] = 'published_content';
				$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

				if (isset($juassi_post_array[0])) {
					$juassi_post = $juassi_post_array[0];
					$message = '<strong>Content Edited. <a href="' . juassi_content_permalink() . '">See Content &raquo;</a></strong>';
					unset($bt_post);
				}
				else {
					$message = '<strong>Content Saved.</strong>';
				}
			}
		}
	}
	$juassi_content_identifier['limit'] = 1;
	$juassi_content_identifier['post_type'] = '';
	if (isset($_REQUEST['content_id'])) {
		$juassi_content_identifier['id'] = (int) $_REQUEST['content_id'];
		if (!juassi_user_can('edit_posts')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		if (!empty($juassi_post_array)) {
			$juassi_post = $juassi_post_array[0];
		}
		else {
			$juassi_input_error = 'Content Not Found.';
		}
	}
	else {
		$juassi_input_error = 'Content Not Found.';
	}

?>

	<h1>Edit Content</h1>
	<?php if (!isset($juassi_input_error)) { ?>
	<?php if (isset($message)) echo juassi_admin_message($message); ?>
		<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		<fieldset style="width:55%">
			<legend>Content</legend>
			<p>Content Title<br /> <input name="juassi_post_title" type="text" size="50" value="<?php echo juassi_post_title_clean(); ?>" /></p>
			<p>Content Body<br /> <?php juassi_run_section('admin_text_editor', array('name' => 'juassi_post_body', 'value' => juassi_post_body_raw())); ?></p>
		</fieldset>
		<fieldset style="width:30%">
		<legend>Content Options</legend>
		<p>Content Type<br />
			<select name="juassi_version">
				<option value="published_content">Published</option>
				<option value="draft_content"<?php if ($juassi_post['post_type'] == 'draft_content') { echo ' selected="selected"'; } ?>>Draft</option>
				<option value="private_content"<?php if ($juassi_post['post_type'] == 'private_content') { echo ' selected="selected"'; } ?>>Private</option>
			</select>
			</p>
			<p>Slug/URL Title (if blank not changed)<br /> <input name="juassi_x_title" type="text" value="<?php echo juassi_post_x_title(); ?>" /></p>
			<p>Post Date (if blank not changed)<br /> <input name="juassi_post_date" type="text" value="<?php echo juassi_post_date(); ?>" /></p>
		</fieldset>
		<br clear="all" />
		<p><input type="hidden" name="content_id" value="<?php echo juassi_content_id(); ?>"/><input name="edit_submit" type="submit" value="Submit" /></p>
	</form>
	<br /><br />
	<script type="text/javascript">
	<!--
	function juassi_confirm() {
		if (confirm("Are you sure you wish to delete this content?")){
			return true;
		}
		else{
			return false;
		}
	}
	//-->
	</script>
	<form method="post" action="delete-content.php" onsubmit="return juassi_confirm(this);">
		<p><input type="hidden" name="content_id" value="<?php echo juassi_content_id(); ?>"/><input name="submit" type="submit" value="Delete" /></p>
	</form>
		<br clear="all" />
	<?php } else {
		echo juassi_admin_message($juassi_input_error);
	} ?>
</div>
<?php
	include('include/html-footer.php');
?>