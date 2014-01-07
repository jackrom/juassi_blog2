<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Add Content');
	juassi_set_in_admin(true);

	include('include/html-header.php');
        
?>
<div class="row-fluid">
    <div class="span12">

<?php
	if (isset($_POST['juassi_submit']))  {

		$juassi_posts = new juassi_posts();

		$post_title = $_POST['juassi_post_title'];
		$post_body = $_POST['juassi_post_body'];

		if (isset($_POST['juassi_version'])) {
			$post_version = $_POST['juassi_version'];

			if ($post_version != 'published_content' && $post_version != 'draft_content' && $post_version != 'private_content') {
				$post_version = 'published_content';
			}
		}
		else {
			$post_version = 'published_content';
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
			$post_array['user_id'] = (int) juassi_get_user_data('user_id');
			$post_array['post_title'] = $post_title;
			$post_array['post_body'] = $post_body;
			$post_array['post_type'] = $post_version;
			$post_array['post_x_title'] = $juassi_posts->return_first_x_name($juassi_post_x_title);

			$post_array['post_comments'] = 0;
			$post_array['post_external_comments'] = 0;

			if (isset($_POST['juassi_post_date']) && !empty($_POST['juassi_post_date']) && juassi_check_datetime($_POST['juassi_post_date'])) {
				$post_array['post_date'] = $_POST['juassi_post_date'];
				$post_array['post_date_utc'] = juassi_datetime_utc_from_datetime($post_array['post_date']);
			}
			else {
				$post_array['post_date'] = juassi_datetime();
				$post_array['post_date_utc'] = juassi_datetime_utc();
			}

			$post_id = $juassi_posts->add_post($post_array);

			$juassi_content_identifier['id']		 = $post_id;
			$juassi_content_identifier['post_type']	 = 'published_content';

			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

			if (isset($juassi_post_array[0])) {
				$juassi_post = $juassi_post_array[0];
				$message = '<strong>Posted. <a href="' . juassi_content_permalink() . '">See Content &raquo;</a></strong>';
				unset($juassi_post);
			}
			else {
				$message = '<strong>Saved.</strong>';
			}
		}
	}

?>

	<h2 class="heading">Agregar Contenido</h2>
	<?php if (isset($message)) echo juassi_admin_message($message); ?>
	<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		<fieldset style="width:55%">
			<legend>Content</legend>
			<p>Content Title<br /> <input name="juassi_post_title" type="text" size="100" /></p>
			<p>Content Body<br /> <?php juassi_run_section('admin_text_editor', array('name' => 'juassi_post_body', 'value' => '')); ?></p>
		</fieldset>
		<fieldset style="width:30%">
		<h3 class="heading">Opciones de Contenido</h3>
		<p>Content Type<br />
			<select name="juassi_version">
				<option value="published_content">Published</option>
				<option value="draft_content">Draft</option>
				<option value="private_content">Private</option>
			</select>
			</p>
			<p>Slug/URL Title (if blank auto generated)<br /> <input name="juassi_x_title" type="text" value="" /></p>
			<p>Post Date (if blank time of submit is used)<br /> <input name="juassi_post_date" type="text" value="" /></p>
		</fieldset>
		<br clear="all" />
		<p><input name="juassi_submit" type="submit" value="Submit" /></p>
	</form>
	</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>