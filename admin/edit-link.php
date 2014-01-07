<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Edit Links');
	$juassi_ln->add_lower_link($juassi_ln->presentation, 'Edit Link', 'edit-link.php');
	juassi_set_in_admin(true);
	if (isset($_REQUEST['category_id'])) {
		$category_id	= (int) $_REQUEST['category_id'];
	}
	else {
		$category_id	= 0;
	}
	if (isset($_POST['delete_link'])) {
		juassi_delete_link($_POST['link_id']);
	}
	elseif (isset($_POST['submit'])) {
		if (isset($_POST['link_id'])) {
			$link_set_array['link_id']		= $_POST['link_id'];
			$link_set_array['link_url'] 	= $_POST['link_url'];
			$link_set_array['link_name'] 	= $_POST['link_name'];

			juassi_set_link($link_set_array);
		}

		if (!empty($_POST['link_name_new']) && !empty($_POST['link_url_new'])) {
			//add new link
			$link_add_array['category_id']		= $category_id;
			$link_add_array['link_url'] 		= $_POST['link_url_new'];
			$link_add_array['link_name'] 		= $_POST['link_name_new'];

			juassi_add_link($link_add_array);
		}
	}
	if ($category_id != 0) {
		$link_array 	= juassi_get_links_id($category_id);
		$cat_array		= juassi_get_link_category($category_id);
	}
	else {
		$link_array		= '';
	}
	if (isset($_REQUEST['link_id'])) {
		$link_single_array = juassi_get_link($_REQUEST['link_id']);
	}
	else {
		$link_single_array = '';
	}
	if (empty($link_array) && empty($cat_array)) {
		header('Location: link-settings.php');
		exit;
	}
	include('include/html-header.php');
?>
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-resources/javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-resources/javascript/interface.js"></script>
<script type="text/javascript">
	$(document).ready(
		function() {
			$("#sortme").Sortable({
				accept : 'sortitem',
				onchange : function (sorted) {
				serial = $.SortSerialize('sortme');
					$.ajax({
						url: "order-links.php",
						type: "POST",
						data: serial.hash
					});
				}
			});
		}
	);
</script>
<div class="contain">
	<h1>Edit Links</h1>
		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<fieldset>
				<legend>Link Order</legend>
				<ol class="list" id="sortme">
					<?php $i = 0; foreach ($link_array as $link) { ?>
						<li class="sortitem<?php if ($i % 2 == 1 ) { echo ' odd'; }?>" id="<?php echo (int) $link['link_id']; ?>">
						<?php echo juassi_htmlentities($link['link_name']); ?> <a href="edit-link.php?link_id=<?php echo (int) $link['link_id']; ?>&amp;category_id=<?php echo (int) $category_id; ?>">(Edit)</a>
						</li>
					<?php $i++; } ?>
				</ol>
				<p>Note: Simply drag the links to place them in the order you want.</p>
			</fieldset>
			<fieldset>
				<legend>Add Link</legend>
				<p>Link Name<br /><input type="text" name="link_name_new" value="" size="35" /></p>
				<p>Link URL<br /><input type="text" name="link_url_new" value="" size="35" />
			</fieldset>
			<?php if (!empty($link_single_array)) { ?>
			<fieldset>
				<legend>Edit Link</legend>
				<p>Link Name<br /><input type="text" name="link_name" value="<?php echo juassi_htmlentities($link_single_array['link_name']); ?>" size="35" /></p>
				<p>Link URL<br /><input type="text" name="link_url" value="<?php echo juassi_htmlentities($link_single_array['link_url']); ?>" size="35" />
				<input type="hidden" name="link_id" value="<?php echo juassi_htmlentities($link_single_array['link_id']); ?>"/>
				</p>
				<p><input type="submit" name="delete_link" value="Delete" /></p>
			</fieldset>
			<?php } ?>
			<br clear="all" />
			<p><input type="submit" name="submit" value="Submit" /><input type="hidden" name="category_id" value="<?php echo (int) $category_id; ?>"/></p>
		</form>
</div>
<?php
	include('include/html-footer.php');
?>