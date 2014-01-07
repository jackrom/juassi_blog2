<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Link Settings');
	juassi_set_in_admin(true);

	if (!empty($_POST['new_link_category'])) {
		$new_link_x_category = juassi_x_title($_POST['new_link_category']);
		if (!empty($new_link_x_category)) {
			$new_link_category = $_POST['new_link_category'];

			$array['category_name'] = $new_link_category;
			$array['category_x_name'] = $new_link_x_category;

			juassi_add_link_category($array);
		}
	}
	include('include/html-header.php');
	$juassi_link_cat = juassi_get_link_categories();
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n de Enlaces (Links)</h2>
		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<fieldset>
				<legend>Add/Edit Categories</legend>
					<?php foreach ($juassi_link_cat as $juassi_cat) { ?>
					<p><input type="text" name="category-<?php echo juassi_htmlentities($juassi_cat['category_id']); ?>" size="50" value="<?php echo juassi_htmlentities($juassi_cat['description']); ?>" /> <a href="edit-link-category.php?category_id=<?php echo juassi_htmlentities($juassi_cat['category_id']); ?>">Edit</a></p>
					<?php } ?>
				<p>New Category<br /><input type="text" name="new_link_category" size="50"  value="" /></p>
				<p><input type="submit" name="submit" value="Submit" /></p>
			</fieldset>
		</form>
		<form action="edit-link.php" method="post">
			<fieldset>
				<legend>Edit Links within a Category</legend>
					<p><select name="category_id" >
					<?php foreach ($juassi_link_cat as $juassi_cat) { ?>
					<option value="<?php echo juassi_htmlentities($juassi_cat['category_id']); ?>"><?php echo juassi_htmlentities($juassi_cat['description']); ?> - <?php echo juassi_htmlentities($juassi_cat['category_name']); ?></option>
					<?php } ?>
					</select></p>
				<p><input type="submit" name="submit" value="Submit" /></p>
			</fieldset>
		</form>
		<br clear="all" />
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>