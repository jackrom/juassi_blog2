<?php
	include('include/admin-header.php');
	//primeramente mostramos el titulo de la pagina
	juassi_set_admin_title('Agregar Articulo');
	//mostramos el menu de opciones
	juassi_set_in_admin(true);
	//creamos el objeto que llamara a las categorias que pudiesen agregarse al post
	$juassi_post_categories = new juassi_categories($juassi_tb->categories);
	include('include/html-header.php');
?>
<div class="contain">
	<?php
	if (isset($_POST['juassi_submit']))  {

		$juassi_posts = new juassi_posts();

		$post_title = $_POST['juassi_post_title'];
		$post_body = $_POST['juassi_post_body'];

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
			$message = "<strong>No title and/or Slug/URL Title does not contain any valid characters.</strong>";
		}
		else {
			$post_array['user_id'] = (int) juassi_get_user_data('user_id');
			$post_array['post_title'] = $post_title;
			$post_array['post_body'] = $post_body;
			$post_array['post_type'] = $post_version;
			$post_array['post_x_title'] = $juassi_posts->return_first_x_name($juassi_post_x_title);

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
			else {
				$post_array['post_date'] = juassi_datetime();
				$post_array['post_date_utc'] = juassi_datetime_utc();
			}

			$post_id = $juassi_posts->add_post($post_array);

			foreach($_POST as $index => $value){
				if(strncasecmp($index, 'category_id-', 12) === 0) {
					$category_index = explode('-', $index);
					if (!empty($value)) {
						$category_id = $category_index[1];
						$juassi_posts->add_category_to_post($post_id, $category_id);
					}
				}
			}
			$juassi_content_identifier['id'] 			= $post_id;
			$juassi_content_identifier['post_type']		= 'publicado';
			$juassi_post_array 							= $juassi_posts->get_posts($juassi_content_identifier);

			if (isset($juassi_post_array[0])) {
				$juassi_post = $juassi_post_array[0];
				$message = '<strong>Publicado. <a href="' . juassi_post_permalink() . '">Ver Art&iacute;culo &raquo;</a></strong>';

				if (!empty($_POST['juassi_trackbackurl'])) {
					//trackback here
					$excerpt 							= strip_tags(juassi_post_title());
					$trackback_array['post_excerpt'] 	= (strlen($excerpt) > 255) ? substr($excerpt, 0, 252).'...' : $excerpt;
					$trackback_array['post_url']		= juassi_post_permalink();
					$trackback_array['post_title']		= juassi_post_title();
					$trackback_array['trackback_url']	= $_POST['juassi_trackbackurl'];

					juassi_send_trackback($trackback_array);
				}

				unset($juassi_post);
			}
			else {
				$message = '<strong>Salvado.</strong>';
			}
		}
	}
	?>
	<?php if (isset($message)) echo juassi_admin_message($message); ?>
<div class="row-fluid">
	<div class="span12">
		<h2 class="heading">Agregar Art&iacute;culo</h2>


<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
<div class="formSep">
	<label>T&iacute;tulo del Art&iacute;culo</label>
	<input name="juassi_post_title" type="text" style="width:99%; font-size:18px; height:30px;"/>
</div>

<label>Editor de texto | para crear los articulos</label>
<textarea id="editor" name="juassi_post_body" cols="120" rows="10" ></textarea>


<div class="formSep">
	<legend>Categor&iacute;as</legend>
	<div class="row-fluid">
		<div class="span12">
			<label class="radio">
			<?php echo $juassi_post_categories->print_tree_select(array('name')); ?>
			</label>
			<span class="help-block"><p>Haz Click <a href="categories.php">aqu&iacute;</a> para agregar/editar categorias.</p></span>
		</div>
	</div>
</div>

<legend>Opciones del Art&iacute;culo</legend>
<label>Tipo de Art&iacute;culo</label>
<div class="span5">
	<select class="span6">
		<option value="published">Publico</option>
		<option value="draft">Borrador</option>
		<option value="private">Privado</option>
		<option value="future">Futura Publicaci&oacute;n</option>
	</select>
</div>
<div class="span5">
	<p>Slug/URL del t&iacute;tulo (si se deja en blanco ser&aacute; autogenerado)<br /> <input name="juassi_x_title" type="text" value="" /></p>
	<p>Fecha del Art&iacute;culo (si se deja en blanco ser&aacute; usada la fecha de publicaci&oacute;n)<br /> <input name="juassi_post_date" type="text" value="" /></p>
	<p>Trackback URL (separados por un espacio) <br /><input name="juassi_trackbackurl" type="text" value="" /></p>
	<p>Permitir Comentarios? <input type="checkbox" name="juassi_comments" value="1" checked="checked" /></p>
	<p>Permitir comentarios externos (trackback)? <input type="checkbox" name="juassi_external_comments" value="1" checked="checked" /></p>
	<p>Nota: Por favor los comentarios y las pistas que se reciban despues de publicado, pueden ser globalmente borrados por el administrador en cualquier momento.</p>
</div>
<div class="span5">
	<br clear="all" />
	<p><button class="btn btn-large btn-inverse" name="juassi_submit" type="submit" value="" /><i class="splashy-check"></i> Publicar Art&iacute;culo</button></p>
</div>
</form>
		</div>
	</div>
</div>





</div>
<?php
include('include/sidebar.php');
include('include/html-footer.php');
?>