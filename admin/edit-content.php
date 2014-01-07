<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Edit Content');
	juassi_set_in_admin(true);

	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Editar Contenido</h2>
		<?php
		if (isset($_GET['run']) && ($_GET['run'] == 'show_all')) {
			$juassi_posts = new juassi_posts();
			$juassi_content_identifier['id'] = '';
			$juassi_content_identifier['post_type'] = 'published_content';
			if (!juassi_user_can('edit_content')) {
				$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
			}

			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

			?>
			<form method="post" action="edit-content-page.php">
			<p><select name="content_id">
			<?php foreach ($juassi_post_array as $juassi_post) { ?>
			<option value="<?php echo juassi_content_id(); ?>"><?php echo juassi_content_title(); ?> - <?php echo juassi_content_date(); ?></option>
			<?php } ?>
			</select></p>
			<p><input name="submit" type="submit" value="Submit" /></p>
			</form>
			<p><a href="edit-content.php">&laquo; Hide</a></p>
		<?php } else { ?>
			<p><a href="edit-content.php?run=show_all">Show all content &raquo;</a></p>
		<?php } ?>
		<h3 class="heading">Last 10 Published Content Pages</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = 10;
		$juassi_content_identifier['post_type'] = 'published_content';
		if (!juassi_user_can('edit_content')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span11">
		<table class="table table-striped" data-rowlink="a">

				<thead>
					<tr>
						<th>Edit</th>
						<th>Date/Time</th>
						<th>Title</th>
						<th>Author</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-content-page.php?content_id=<?php echo juassi_content_id(); ?>">Edit</a></td>
						<td><?php echo juassi_content_date(); ?></td>
						<td><a href="<?php echo juassi_content_permalink() ;?>"><?php echo juassi_content_title(); ?></a></td>
						<td><a href="user-profile.php?user_id=<?php echo juassi_content_author_id(); ?>"><?php echo juassi_content_author(); ?></a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
		</div>
		<h3 class="heading">Tus Borradores</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = '';
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		$juassi_content_identifier['post_type'] = 'draft_content';

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span11">
		<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Edit</th>
						<th>Date/Time</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-content-page.php?content_id=<?php echo juassi_content_id(); ?>">Edit</a></td>
						<td><?php echo juassi_content_date(); ?></td>
						<td><?php echo juassi_content_title(); ?></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
			</div>
		</div>
<div class="row-fluid">
    <div class="span12">
		<h3 class="heading">Tus contenidos privados</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = '';
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		$juassi_content_identifier['post_type'] = 'private_content';

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span11">
		<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Edit</th>
						<th>Date/Time</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-content-page.php?content_id=<?php echo juassi_content_id(); ?>">Edit</a></td>
						<td><?php echo juassi_content_date(); ?></td>
						<td><?php echo juassi_content_title(); ?></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>