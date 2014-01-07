<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Mantenimiento del Website');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>

<div class="contain">
	<script type="text/javascript">
	<!--
	function juassi_confirm() {
		if (confirm("Estas seguro de que deseas hacer esto?")){
			return true;
		}
		else{
			return false;
		}
	}
	//-->
	</script>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Mantenimiento de la website</h2>

	<?php
		if (isset($_POST['submit'])) {
			$moderation_queue = isset($_POST['moderation_queue']) ? 1 : 0;
			$moderation_queue_akismet = isset($_POST['moderation_queue_akismet']) ? 1 : 0;
			$moderation_queue_normal = isset($_POST['moderation_queue_normal']) ? 1 : 0;
			$event_viewer = isset($_POST['event_viewer']) ? 1 : 0;
			$optimise_table = isset($_POST['optimise_table']) ? 1 : 0;
			$repair_database = isset($_POST['repair_database']) ? 1 : 0;
			$non_active_users = isset($_POST['non_active_users']) ? 1 : 0;

			if ($event_viewer) {
				if (juassi_user_can('clear_logs')) {
					$juassi_db->query("DELETE FROM $juassi_tb->events");
					trigger_error('Event Log Cleared', E_USER_NOTICE);
				}
				else {
					trigger_error('No se puede limpiar el registro de eventos, Permisos denegados', E_USER_NOTICE);
				}
			}

			if ($repair_database) {
				juassi_repair_tables();
			}

			if ($moderation_queue) {
				if (juassi_user_can('clear_moderation_queue')) {
					$juassi_db->query("DELETE FROM $juassi_tb->comments WHERE comment_approved = 0");
					trigger_error('Cola de moderaci&oacute;n borrada', E_USER_NOTICE);
				}
			}

			if ($moderation_queue_akismet) {
				if (juassi_user_can('clear_moderation_queue')) {
					$juassi_db->query("DELETE FROM $juassi_tb->comments WHERE comment_approved = 0 AND comment_akismet_spam = 1");
					trigger_error('Cola de moderaci&oacute;n Akismet borrada', E_USER_NOTICE);
				}
			}

			if ($moderation_queue_normal) {
				if (juassi_user_can('clear_moderation_queue')) {
					$juassi_db->query("DELETE FROM $juassi_tb->comments WHERE comment_approved = 0 AND comment_akismet_spam = 0");
					trigger_error('Cola de moderaci&oacute;n Normal borrada', E_USER_NOTICE);
				}
			}

			if ($non_active_users) {
				if (juassi_user_can('delete_users')) {
					$juassi_users->delete_non_active_users();
				}
			}

			if ($optimise_table) {
				juassi_optimise_tables();
			}
		}
	?>
	<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return juassi_confirm(this);">
		<?php if (isset($_POST['submit'])) echo juassi_admin_message('<strong>Please check the <a href="event-viewer.php">Event Viewer</a> for more details.</strong>'); ?>
		<fieldset>
			<legend>Eliminaci&oacute;n</legend>
			<p>Eliminar todos los eventos del Registro de Eventos? <input type="checkbox" name="event_viewer" value="1" /></p>
			<p>Eliminar todos los comentarios en la cola de moderaci&oacute;n? <input type="checkbox" name="moderation_queue" value="1" /></p>
			<p>Eliminar todos los Akismet spam en la cola de moderaci&oacute;n? <input type="checkbox" name="moderation_queue_akismet" value="1" /></p>
			<p>Eliminar todos los spam Normal en la cola de moderaci&oacute;n? <input type="checkbox" name="moderation_queue_normal" value="1" /></p>
			<p>Eliminar todos los usuarios no activos? <input type="checkbox" name="non_active_users" value="1" /></p>
		</fieldset>
		<fieldset>
			<legend>Mantenimiento</legend>
			<p>Reparar Base de Datos? <input type="checkbox" name="repair_database" value="1" /></p>
			<p>Optimizar tablas? <input type="checkbox" name="optimise_table" value="1" /></p>
			<p>Nota: Juassi automaticamente optimiza sus propias tablas una vez al mes.</p>
		</fieldset>
		<br clear="all" />
		<p><input type="submit" name="submit" value="Enviar" /></p>
	</form>
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>