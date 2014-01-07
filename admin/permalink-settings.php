<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Configuraci&oacute;n Permalink');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n Permalink</h2>

	<?php
		if (isset($_POST['submit'])) {
			juassi_set_config('post_permalink_format', $_POST['juassi_post_permalink_format']);
			juassi_set_config('category_permalink_format', $_POST['juassi_category_permalink_format']);
			juassi_set_config('content_permalink_format', $_POST['juassi_content_permalink_format']);
			echo juassi_admin_message('<strong>Configuraci&oacute;n Permalink actualizado</strong>');
			trigger_error('Configuraci&oacute;n Permalink actualizado.', E_USER_NOTICE);
		}
	?>
	<form action="" method="post">
		<fieldset>
			<legend>Configuraci&oacute;n Permalink</legend>
			<p>Formato Permalink para los art&iacute;culos<br /><input name="juassi_post_permalink_format" size="50"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('post_permalink_format')); ?>" /></p>
			<p>Formato Permalink para los Categor&iacute;as<br /><input name="juassi_category_permalink_format" size="50"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('category_permalink_format')); ?>" /></p>
			<p>Formato Permalink para los Contenidos<br /><input name="juassi_content_permalink_format" size="50"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('content_permalink_format')); ?>" /></p>
			<p>Nota: Por favor recuerda actualizar tu archivo .htaccess si tu modificas esta configuraci&oacute;n.</p>
		</fieldset>
		<fieldset>
			<legend>Opciones Permalink</legend>
			<p>Formato Permalink para los art&iacute;culos</p>
			<?php if (juassi_get_config('database_type') == 'mysql') { ?>
				<ul>
					<li>%year%</li>
					<li>%month%</li>
					<li>%day%</li>
					<li>%x_title%</li>
					<li>%post_id%</li>
				</ul>
				<p>Formato Permalink para los Categor&iacute;as</p>
				<ul>
					<li>%x_title%</li>
				</ul>
				<p>Formato Permalink para los Contenidos<p>
				<ul>
					<li>%year%</li>
					<li>%month%</li>
					<li>%day%</li>
					<li>%x_title%</li>
					<li>%post_id%</li>
				</ul>
			<?php } else { ?>
				<ul>
					<li>%x_title%</li>
					<li>%post_id%</li>
				</ul>
				<p>Formato Permalink para los Categor&iacute;as</p>
				<ul>
					<li>%x_title%</li>
				</ul>
				<p>Formato Permalink para los Contenidos</p>
				<ul>
					<li>%x_title%</li>
					<li>%post_id%</li>
				</ul>
			<?php } ?>
			<?php if (juassi_get_config('database_type') == 'sqlite') echo juassi_admin_message('Nota: La versi—n SQLite de Juassi tiene un conjunto reducido de opciones.'); ?>
		</fieldset>
		<br style="clear:both;" />
		<br />
		<p><input type="submit" name="submit" value="Enviar"/></p>
	</form>

</div>
</div>
  </div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>