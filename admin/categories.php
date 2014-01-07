<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Categor&iacute;as');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Categor&iacute;as</h2>
	<?php
		//print_r($_POST);
		$juassi_post_categories = new juassi_categories($juassi_tb->categories);
		if (isset($_POST['juassi_submit'])) {
			if (!empty($_POST['juassi_category'])) {
				if(!empty($_POST['category_id'])) {
					$category_id = (int) $_POST['category_id'];
					$juassi_post_categories->new_first_child($juassi_post_categories->get_node($category_id), $_POST['juassi_category']);
				}
				else {
					$juassi_post_categories->new_first_child($juassi_post_categories->root(), $_POST['juassi_category']);
				}
				echo juassi_admin_message('<strong>Categor&iacute;a agregada.</strong>');
			}
			else {
				echo juassi_admin_message('<strong>Por favor ingrese el nombre de la categor&iacute;a.</strong>');
			}
		}
		else if (isset($_POST['juassi_edit'])) {
			if (isset($_POST['category_id'])) {
				$category_id = (int) $_POST['category_id'];

				$juassi_cat_array = $juassi_post_categories->get_category($category_id);

				if (!empty($juassi_cat_array)) {
					$juassi_in_cat_edit = true;
				}
			}
		}
		else if (isset($_POST['juassi_edit_submit'])) {
			$category_array['id'] = $_POST['juassi_edit_category_id'];
			$category_array['name'] = $_POST['juassi_edit_category_name'];
			$category_array['x_name'] = $_POST['juassi_edit_category_name_x'];
			$juassi_post_categories->edit_category($category_array);
		}
	?>
	<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
	<fieldset style="width:100%">
		<legend>Categor&iacute;as</legend>
		<?php echo $juassi_post_categories->print_tree_radio(array('name')); ?>
		<p>Nota: Para agregar una subcategor&iacute;a simplemente seleccione el bot&oacute;n radial de la categor&iacute;a que quieres crearle parentela.</p>
		<p>Nota: Solo se puede tener una categor&iacute;a ra&iacute;z .</p>
		<p><button class="btn btn-large btn-warning" name="juassi_edit" type="submit" value=""><i class="splashy-pencil"></i> Editar</button></p>
		</fieldset><br/><br/><br/>
	<fieldset style="width:25%; float:left; display:inline;">
		<legend>Agregar nueva categor&iacute;a</legend>
		<p>Nombre de la categor&iacute;a<br /> <input name="juassi_category" type="text" value="" size="35" style="height:30px; font-size:18px;"/></p>
		<p><button class="btn btn-large btn-inverse" name="juassi_submit" type="submit" value=""><i class="splashy-check"></i> Agregar</button></p>
	</fieldset>
	<?php if (isset($juassi_in_cat_edit) && ($juassi_in_cat_edit == true)) { ?>
	<fieldset style="width:25%;float:left; display:inline;">
		<legend>Editar Categor&iacute;a</legend>
		<p>Nombre de la categor&iacute;a<br /> <input name="juassi_edit_category_name" type="text" value="<?php echo juassi_htmlentities($juassi_cat_array['name']); ?>" size="35" style="height:30px; font-size:18px;" /></p>
		<p>Nombre de la URL para la categor&iacute;a<br /> <input name="juassi_edit_category_name_x" type="text" value="<?php echo juassi_htmlentities($juassi_cat_array['x_name']); ?>" size="35" style="height:30px; font-size:18px;" /></p>

		<p>
			<input name="juassi_edit_category_id" type="hidden" value="<?php echo (int) $juassi_cat_array['category_id']; ?>" />
			<button class="btn btn-large btn-warning" name="juassi_edit_submit" type="submit" value=""><i class="splashy-pencil"></i> Editar</button>
		</p>
	</fieldset>
	<?php } ?>
	</form>
	<?php if (isset($juassi_in_cat_edit) && ($juassi_in_cat_edit == true)) { ?>
	<script type="text/javascript">
	<!--
	function juassi_confirm() {
		if (confirm("Estas seguro de querer eliminar esta categor&iacute;a?")){
			return true;
		}
		else{
			return false;
		}
	}
	//-->
	</script>
	<form method="post" action="delete-category.php" onsubmit="return juassi_confirm(this);">
	<fieldset style="width:25%; float:left; display:inline; position:relative; top:-18px;">
		<legend>Eliminar Categor&iacute;a</legend>
			<p>Categor&iacute;a "<?php echo juassi_htmlentities($juassi_cat_array['name']); ?>"</p>
			<p><input type="hidden" name="category_id" value="<?php echo (int) $juassi_cat_array['category_id']; ?>"/>
			
			<button class="btn btn-large btn-danger" name="submit" type="submit" value="">Eliminar</button></p>
			
			<p>Nota: Las subcategor&iacute;as tambien pueden ser eliminadas.</p>
			<p>Los art&iacute;culos dentro de estas categor&iacute;as seran movidas a la categor&iacute;a principal.</p>
	</fieldset>
	</form>
	<?php } ?>
</div>


<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>