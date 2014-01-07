<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Editar articulo');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Editar Art&iacute;culos</h2>


	<?php
		if (isset($_GET['run']) && ($_GET['run'] == 'show_all')) {
			$juassi_posts = new juassi_posts();
			$juassi_content_identifier['id'] = '';
			if (!juassi_user_can('edit_posts')) {
				$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
			}

			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

			?>
			<form method="post" action="edit-post.php">
			<p><select name="post_id">
			<?php foreach ($juassi_post_array as $juassi_post) { ?>
			<option value="<?php echo juassi_post_id(); ?>"><?php echo juassi_post_title(); ?> - <?php echo juassi_post_date(); ?></option>
			<?php } ?>
			</select></p>
			<p><input name="submit" type="submit" value="Submit" /></p>
			</form>
			<p><a href="edit.php">&laquo; Esconder</a></p>
		<?php } else { ?>
			<p><a href="edit.php?run=show_all">Mostrar todos los art&iacute;culos &raquo;</a></p>
		<?php } ?>
		<h3 class="heading">&Uacute;ltimos 10 Art&iacute;culos Publicados</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = 10;
		$juassi_content_identifier['post_type'] = 'published';
		if (!juassi_user_can('edit_posts')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span10">
			<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Fecha</th>
						<th>T&iacute;tulo</th>
						<th>Categor&iacute;as</th>
						<th>Autor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-post.php?post_id=<?php echo juassi_post_id(); ?>">Editar</a></td>
						<td><?php echo juassi_post_date(); ?></td>
						<td><a href="<?php echo juassi_post_permalink() ;?>"><?php echo juassi_post_title(); ?></a></td>
						<td><?php echo juassi_post_cat(); ?></td>
						<td><a href="user-profile.php?user_id=<?php echo juassi_post_author_id(); ?>"><?php echo juassi_post_author(); ?></a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row-fluid">
    <div class="span12">
		<h3 class="heading">Tus Borradores</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = '';
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		$juassi_content_identifier['post_type'] = 'draft';

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span10">
			<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Fecha</th>
						<th>T&iacute;tulo</th>
						<th>Categor&iacute;as</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-post.php?post_id=<?php echo juassi_post_id(); ?>">Editar</a></td>
						<td><?php echo juassi_post_date(); ?></td>
						<td><?php echo juassi_post_title(); ?></td>
						<td><?php echo juassi_post_cat(); ?></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row-fluid">
    <div class="span12">
		<h3 class="heading">Tus Pr&oacute;ximos (Futuros) Art&iacute;culos</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = '';
		$juassi_content_identifier['post_type'] = 'future';

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span10">
			<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Fecha</th>
						<th>T&iacute;tulo</th>
						<th>Categor&iacute;as</th>
						<th>Autor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-post.php?post_id=<?php echo juassi_post_id(); ?>">Editar</a></td>
						<td><?php echo juassi_post_date(); ?></td>
						<td><?php echo juassi_post_title(); ?></td>
						<td><?php echo juassi_post_cat(); ?></td>
						<td><a href="user-profile.php?user_id=<?php echo juassi_post_author_id(); ?>"><?php echo juassi_post_author(); ?></a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row-fluid">
    <div class="span12">
		<h3 class="heading">Tus Art&iacute;culos Privados</h3>
		<?php
		$juassi_posts = new juassi_posts();
		$juassi_content_identifier['id'] = '';
		$juassi_content_identifier['limit'] = '';
		$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		$juassi_content_identifier['post_type'] = 'private';

		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		?>
		<div class="span10">
			<table class="table table-striped" data-rowlink="a">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Fecha</th>
						<th>T&iacute;tulo</th>
						<th>Categor&iacute;as</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($juassi_post_array as $juassi_post) {
					?>
					<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
						<td><a href="edit-post.php?post_id=<?php echo juassi_post_id(); ?>">Editar</a></td>
						<td><?php echo juassi_post_date(); ?></td>
						<td><?php echo juassi_post_title(); ?></td>
						<td><?php echo juassi_post_cat(); ?></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="../juassi-resources/javascript/gebo_dashboard.js"></script>
<script src="../juassi-resources/javascript/jquery.min.js"></script>
<!-- smart resize event -->
<script src="../juassi-resources/javascript/jquery.debouncedresize.min.js"></script>
<!-- hidden elements width/height -->
<script src="../juassi-resources/javascript/jquery.actual.min.js"></script>
<!-- js cookie plugin -->
<script src="../juassi-resources/javascript/jquery.cookie.min.js"></script>
<!-- main bootstrap js -->
<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
<!-- tooltips -->
<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>

<?php
	include('include/sidebar.php');
	//include('include/html-footer.php');
?>