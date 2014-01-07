<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Editar Articulo');
	juassi_set_in_admin(true);

	$juassi_post_categories = new juassi_categories($juassi_tb->categories);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">

<?php
	$juassi_posts = new juassi_posts();
	if (isset($_POST['edit_submit']))  {
		$post_id = (int) $_POST['post_id'];

		$juassi_content_identifier['id'] = $post_id;
		if (!juassi_user_can('edit_posts')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		if (empty($juassi_post_array)) {
			$juassi_input_error = 'Art&iacute;culos no encontrados.';
			unset($juassi_post_array);
		}
		else {
			$old_user_id = $juassi_post_array[0]['user_id'];
			unset($juassi_post_array);

			$post_title = $_POST['juassi_post_title'];
			$post_body = $_POST['juassi_post_body'];
			$post_array['post_id'] = $post_id;

			if (isset($_POST['juassi_version'])) {
				$post_version = $_POST['juassi_version'];

				if ($post_version != 'private' && $post_version != 'draft' && $post_version != 'published' && $post_version != 'future') {
					$post_version = 'published';
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
				$message = "<strong>Valores o caracteres no v&aacute;lidos.</strong>";
			}
			else {
				$post_array['user_id'] = (int) $old_user_id;
				$post_array['post_title'] = $post_title;
				$post_array['post_body'] = $post_body;
				$post_array['post_type'] = $post_version;
				$post_array['post_x_title'] = $juassi_post_x_title;

				if (isset($_POST['juassi_comments'])) {
					$post_array['post_comments'] = 1;
				}
				else {
					$post_array['post_comments'] = 0;
				}

				if (isset($_POST['juassi_external_comments'])) {
					$post_array['post_external_comments'] = 1;
				}
				else {
					$post_array['post_external_comments'] = 0;
				}

				if (isset($_POST['juassi_post_date']) && !empty($_POST['juassi_post_date']) && juassi_check_datetime($_POST['juassi_post_date'])) {
					$post_array['post_date'] = $_POST['juassi_post_date'];
					$post_array['post_date_utc'] = juassi_datetime_utc_from_datetime($post_array['post_date']);
				}

				$juassi_posts->edit_post($post_array);

				$juassi_posts->delete_all_categories_from_post($post_id);

				foreach($_POST as $index => $value){
					if(strncasecmp($index, 'category_id-', 12) === 0) {
						$category_index = explode('-', $index);
						if (!empty($value)) {
							$category_id = $category_index[1];
							$juassi_posts->add_category_to_post($post_id, $category_id);
						}
					}
				}
				$juassi_content_identifier['id'] = $post_id;
				$juassi_content_identifier['post_type'] = 'published';
				$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);

				if (isset($juassi_post_array[0])) {
					$juassi_post = $juassi_post_array[0];
					$message = '<strong>Art&iacute;culo editado. <a href="' . juassi_post_permalink() . '">Ver art&iacute;culo &raquo;</a></strong>';
					unset($juassi_post);
				}
				else {
					$message = '<strong>Articulo Guardado Exitosamente.</strong>';
				}
			}
		}
	}
	$juassi_content_identifier['limit'] = 1;
	$juassi_content_identifier['post_type'] = '';
	if (isset($_REQUEST['post_id'])) {
		$juassi_content_identifier['id'] = (int) $_REQUEST['post_id'];
		if (!juassi_user_can('edit_posts')) {
			$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');
		}
		$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
		if (!empty($juassi_post_array)) {
			$juassi_post = $juassi_post_array[0];
			$juassi_post_category_array = $juassi_posts->get_post_category_ids($juassi_content_identifier['id']);
		}
		else {
			$juassi_input_error = 'Art&iacute;culos no encontrados.';
		}
	}
	else {
		$juassi_input_error = 'Art&iacute;culos no encontrados.';
	}

?>

	<h2 class="heading">Editar Art&iacute;culos</h2>
	<?php if (!isset($juassi_input_error)) { ?>
	<?php if (isset($message)) echo juassi_admin_message($message); ?>
		<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		<fieldset style="width:100%">

			<h3 class="heading">Art&iacute;culo</h3>

			<p>Titulo del Art&iacute;culo<br /> <input name="juassi_post_title" type="text" size="500" style="width:99%; font-size:18px; height:30px;" value="<?php echo juassi_post_title_clean(); ?>" /></p>
			<textarea id="editor" name="juassi_post_body" cols="120" rows="15" ><?php echo juassi_post_body_raw(); ?></textarea>
			<!--<p>Post Body<br /> <?php juassi_run_section('admin_text_editor', array('name' => 'juassi_post_body', 'value' => juassi_post_body_raw())); ?></p>-->
		</fieldset>
		<fieldset style="width:100%">
			<h3 class="heading">Categor&iacute;as</h3>
			<?php echo $juassi_post_categories->print_tree_selected(array('name'), $juassi_post_category_array); ?>
		</fieldset>
		<fieldset style="width:100%">
		<h3 class="heading">Opciones del Art&iacute;culo</h3>
		<p>Tipo de Art&iacute;culo<br />
			<select name="juassi_version">
				<option value="published">Publicado</option>
				<option value="draft"<?php if ($juassi_post['post_type'] == 'draft') { echo ' selected="selected"'; } ?>>Borrador</option>
				<option value="private"<?php if ($juassi_post['post_type'] == 'private') { echo ' selected="selected"'; } ?>>Privado</option>
				<option value="future"<?php if ($juassi_post['post_type'] == 'future') { echo ' selected="selected"'; } ?>>Futura publicaci&oacute;n</option>
			</select>
			</p>
			<p>Slug/URL Titulo (si esta en blanco no lo cambie)<br /> <input name="juassi_x_title" type="text" value="<?php echo juassi_post_x_title(); ?>" /></p>
			<p>Fecha del art&iacute;culo (si esta en blanco no lo cambie)<br /> <input name="juassi_post_date" type="text" value="<?php echo juassi_post_date(); ?>" /></p>
			<p>Trackback URL (separados por un espacio en blanco) <br /><input name="juassi_trackbackurl" type="text" value="" /></p>
			<p>Permitir comentarios? <input type="checkbox" name="juassi_comments" value="1" <?php if (juassi_post_allows_comments()) echo 'checked="checked"'; ?>/></p>
			<p>Permitir comentarios externos (trackback)? <input type="checkbox" name="juassi_external_comments" value="1" <?php if (juassi_post_allows_external_comments()) echo 'checked="checked"'; ?>/></p>
			<p>Por favor, recuerde que los comentarios y seguimientos pueden ser globalmente permitidos por el administrador del sitio.</p>
		</fieldset>
		<br clear="all" />
		<input type="hidden" name="post_id" value="<?php echo juassi_post_id(); ?>"/><button class="btn btn-large btn-inverse" name="edit_submit" type="submit" value="" /><i class="splashy-check"></i> Realizar Cambios</button>
	</form>
	<br /><br />
	<script type="text/javascript">
	<!--
	function juassi_confirm() {
		if (confirm("Estas seguro de que desea eliminar este articulo?")){
			return true;
		}
		else{
			return false;
		}
	}
	//-->
	</script>
	<form method="post" action="delete-post.php" onsubmit="return juassi_confirm(this);">
		
			<input type="hidden" name="post_id" value="<?php echo juassi_post_id(); ?>"/>
			<button class="btn btn-large" name="submit" style="position:relative; top:-90px; left:190px;" type="submit" value="" /><i class="splashy-error_small"></i> Eliminar Art&iacute;culo</button>
		
	</form>
		<br clear="all" />
	<?php } else {
		echo juassi_admin_message($juassi_input_error);
	} ?>
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>