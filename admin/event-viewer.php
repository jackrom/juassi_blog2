<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Event Viewer');
	juassi_set_in_admin(true);
	if (isset($_POST['submit']) && juassi_user_can('clear_logs')) {
		if (isset($_POST['server_id_clear'])) {
			$juassi_log->clear((int) $_POST['server_id_clear']);
		}
		else {
			$juassi_log->clear();
		}
		
		$event['event_file'] = __FILE__;
		$event['event_file_line'] = __LINE__;
		$event['event_type'] = 'logging';
		$event['event_number'] = E_USER_WARNING;
		$event['event_source'] = 'log';
		$event['event_severity'] = 'warning';
		if (isset($_POST['server_id_clear'])) {
			$event['event_description'] = 'Client Event Log Cache Cleared';
		}
		
		$juassi_log->add($event);
	}
	
	?>
<?php
	include('include/html-header.php');
?>
<?php
		if (isset($_GET['page']) && (int) $_GET['page'] != 0) {
			$page = (int) $_GET['page'];
		}
		else {
			$page = 1;
		}
		
		$offset = (int) $page * 100 - 100;
		
		if ($offset < 0) {
			$offset = 0;
		}
		
		$offset = (int) $offset;
		
		$next_page = $page + 1;
		$previous_page = $page - 1;
		if ($previous_page < 1) {
			$previous_page = 1;
		}
		if ($next_page < 1) {
			$next_page = 1;
		}

		$event_array['limit'] = 100;
		$event_array['offset'] = $offset;
		
		if (isset($_REQUEST['server_id']) && !empty($_REQUEST['server_id'])) {
			$event_array['server_id'] = (int) $_REQUEST['server_id'];
		}
		
		if (isset($_GET['filter'])) {
			$event_array['event_severity'] = $_GET['filter'];
		}
		if (isset($_GET['sort'])) {
			switch($_GET['sort']) {
				case 'event_ip_address':
				case 'user_id':
				case 'event_file':
				case 'event_description':
				case 'event_date':
				break;
				
				default:
					$_GET['sort'] = '';
			}
			$event_array['order'] = $_GET['sort'];
		}
		
		$events = $juassi_log->get($event_array);
		
		$event_page_num = count($events);
		
		if ($event_page_num != 100) {
			$next_page = 1;		
			$link_text = 'Primera p&aacute;gina';
		}
		else {
			$link_text = 'Siguiente p&aacute;gina';
		}
		
		if (!empty($_GET['filter'])) {
			$page_filter = '&amp;filter=' . juassi_htmlentities($_GET['filter']);
		}
		else {
			$page_filter = '';
		}
		
		if (!empty($sort)) {
			$page_sort = '&amp;sort=' . $sort;
		}
		else {
			$page_sort = '';
		}

		if (isset($event_array['server_id'])) {
			$page_server = '&amp;server_id=' . juassi_htmlentities($event_array['server_id']);
			$page_all_server = '?server_id=' . juassi_htmlentities($event_array['server_id']);
		}
		else {
			$page_server = '';
			$page_all_server = '';
		}
		
		$next_page_url 		= $previous_page . $page_filter . $page_sort . $page_server;
		$previous_page_url 	= $next_page 	 . $page_filter . $page_sort . $page_server; 
		
		?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Visor de Eventos</h2>
	<?php
	if (isset($_POST['submit']) && juassi_user_can('clear_logs')) {
		echo juassi_admin_message('<strong>Registro de eventos limpiado.</strong>');
	}
	?>
				<p><sub><a href="event-viewer.php">Todo este sitio</a> : <a href="event-viewer.php<?php echo $page_all_server; ?>">Mostrar todo</a> : <a href="event-viewer.php?filter=notice<?php echo $page_server; ?>">Mostrar Notices</a> : <a href="event-viewer.php?filter=warning<?php echo $page_server; ?>">Mostrar Warnings</a> : <a href="event-viewer.php?filter=error<?php echo $page_server; ?>">Mostrar Errors</a> : <a href="event-viewer.php?filter=debug">Mostrar Debug</a></sub></p>
				<div class="tablecontain">
					<h3 class="heading">&Uacute;ltimos 100 eventos</h3>
					<p><a href="event-viewer.php?page=<?php echo $previous_page_url; ?>">&laquo; p&aacute;gina anterior</a> <a href="event-viewer.php?page=<?php echo $next_page_url; ?>"><?php echo $link_text; ?> &raquo;</a></p>
				<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
					<p>Eventos desde <br /><select name="server_id">
						<option value="">Este sitio</option>
						<?php
						$array['server'] = 0;
						$sites = juassi_get_soap_sites($array);
						foreach ($sites as $site) { ?>
						<option value="<?php echo juassi_htmlentities($site['soap_client_id']); ?>"<?php if (isset($event_array['server_id']) && $event_array['server_id'] == $site['soap_client_id']) echo ' selected="selected"';?>>
						<?php echo juassi_htmlentities($site['nickname']); ?></option>
						<?php } ?>
						</select>
						<input type="submit" value="Select" name="server_submit" />
						</p>
				</form>
					<div class="span11">
                                            <table class="table table-striped" data-rowlink="a">
						<thead>
							<tr>
								<th>ID</th>
								<th>Fecha/Hora</th>
								<th>Tipo</th>
								<th>Archivo</th>
								<th>Usuario</th>
								<th>IP</th>
								<th>Descripci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i = 0;
							foreach ($events as $event) { 
							$event_description = juassi_run_content_filter('event_description', $event['event_description']);
							?>
							<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
								<td><a href="event.php?event_id=<?php echo juassi_htmlentities($event['event_id']); ?>"><?php echo juassi_htmlentities($event['event_id']); ?></a></td>
								<td><?php echo juassi_htmlentities($event['event_date']); ?></td>
								<td><?php echo juassi_htmlentities(strtoupper($event['event_severity'])); ?></td>
								<td><?php echo juassi_htmlentities($event['event_file']); ?></td>
								<td><a href="user-profile.php?user_id=<?php echo juassi_htmlentities($event['user_id']); ?>"><?php echo juassi_htmlentities($event['user_id']); ?></a></td>
								<td><a href="http://services.bluetrait.org/lookup/?type=rdns&amp;ip_address=<?php echo juassi_htmlentities($event['event_ip_address']); ?>"><?php echo juassi_htmlentities($event['event_ip_address']); ?></a></td>
								<td><?php echo $event_description; ?></td>
							</tr>
							<?php $i++; } ?>
						</tbody>
					</table>
                                            
                                         
					<p><a href="event-viewer.php?page=<?php echo $previous_page_url; ?>">&laquo; p&aacute;gina anterior</a> <a href="event-viewer.php?page=<?php echo $next_page_url; ?>"><?php echo $link_text; ?> &raquo;</a></p>
				</div>
                                </div>       
				<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
				<?php if (juassi_user_can('clear_logs')) { ?>
					<p><input type="submit" name="submit" value="Clear Logs" />
					<?php if (isset($event_array['server_id'])) { ?>
					<input type="hidden" name="server_id_clear" value="<?php echo (int) $event_array['server_id']; ?>" />
					<?php } ?>
					</p>
				<?php } ?>
				</form>
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