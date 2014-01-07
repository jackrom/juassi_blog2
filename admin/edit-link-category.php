<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Edit Link Category');
	$juassi_ln->add_lower_link($juassi_ln->presentation, 'Edit Link Category', 'edit-link-category.php');
	juassi_set_in_admin(true);
	if (isset($_REQUEST['category_id'])) {
		$category_id	= (int) $_REQUEST['category_id'];
	}
	else {
		$category_id	= 0;
	}

	if (isset($_POST['submit'])) {
		//edit
		$cat_array['category_id'] 		= $category_id;
		$cat_array['category_x_name'] 	= $_POST['category_name'];
		$cat_array['category_name'] = $_POST['description'];
		$cat_array['text_before_each'] = $_POST['text_before_all'];
		$cat_array['text_after_each'] = $_POST['text_after_all'];

		if (juassi_edit_link_category($cat_array)) {
			$message = '<strong>Link Category Edited</strong>';
		}
	}

	if ($category_id != 0) {
		$array		= juassi_get_link_category($category_id);
	}
	else {
		$array		= '';
	}

	if (empty($array)) {
		header('Location: link-settings.php');
		exit;
	}
	include('include/html-header.php');
?>
<div class="contain">
	<h1>Edit Link Category</h1>
		<?php if (!empty($message)) echo juassi_admin_message($message); ?>
		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<fieldset>
				<legend>Category Details</legend>
					<p>Category Slug/URL Title <br /><input type="text" name="category_name" size="50" value="<?php echo juassi_htmlentities($array['category_name']); ?>" /><br /></p>
					<p>Description <br /><input type="text" name="description" size="50" value="<?php echo juassi_htmlentities($array['description']); ?>" /><br /></p>
					<p>Text Before Each Link <br /><input type="text" name="text_before_all" size="50" value="<?php echo juassi_htmlentities($array['text_before_all']); ?>" /><br /></p>
					<p>Text After Each Link <br /><input type="text" name="text_after_all" size="50" value="<?php echo juassi_htmlentities($array['text_after_all']); ?>" /><br /></p>
			</fieldset>
			<br clear="all" />
			<p><input type="submit" name="submit" value="Submit" /><input type="hidden" name="category_id" value="<?php echo (int) $category_id; ?>"/></p>
		</form>
		<br /><br />
		<script type="text/javascript">
		<!--
		function juassi_confirm() {
			if (confirm("Are you sure you wish to delete this link category?")){
				return true;
			}
			else{
				return false;
			}
		}
		//-->
		</script>
		<form method="post" action="delete-link-category.php" onsubmit="return juassi_confirm(this);">
			<p><input type="hidden" name="category_id" value="<?php echo (int) $category_id; ?>"/><input name="submit" type="submit" value="Delete" /></p>
		</form>
		<br clear="all" />
</div>
<?php
	include('include/html-footer.php');
?>