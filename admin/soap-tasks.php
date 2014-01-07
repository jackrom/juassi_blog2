<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Site Tasks');
	juassi_set_in_admin(true);

	include('include/html-header.php');
?>
<div class="contain">
	<h1>Tareas del Sitio</h1>
	<div class="tablecontain">
		<h2>Conectar Sitios</h2>
		<form name="juassi_soap_sites" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<!--
			<p>Task<br />
				<select name="juassi_soap_tasl">
					<option value="">Update</option>
				</select>
				<input type="submit" name="enable_selected" value="Do Task"/>
			</p>-->
		<table class="table table-striped" data-rowlink="a">
			<thead>
				<tr>
					<th>Nombre del Sitio</th>
					<th>Version del programa del sitio</th>
					<th>Version Base de Datos del Sitio</th>
					<th>Direcci&oacute;n del Sitio</th>
					<th>Tipo de Sitio</th>
					<th>API Version del Sitio</th>
					<!--<th><a href="#" onclick="juassi_select_sites()">Toggle All</a></th>-->
				</tr>
			</thead>
			<tbody>
				<?php
					$array['server'] = 0;
					$sites = juassi_get_soap_sites($array);
					$i = 0;
					foreach ($sites as $site) {
					$site_common = juassi_get_sites_common($site['soap_client_id']);
				?>
				<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
					<?php if (empty($site_common)) { ?>
					<td colspan="7"><strong>No Cacheado a&uacute;n</strong></td>
					<?php } else { ?>
					<td><?php echo juassi_htmlentities($site_common['site_name']); ?></td>
					<td><?php echo juassi_htmlentities($site_common['site_program_version']); ?></td>
					<td><?php echo juassi_htmlentities($site_common['site_database_version']); ?></td>
					<td><?php echo juassi_htmlentities($site_common['site_address']); ?></td>
					<td><?php echo juassi_htmlentities($site_common['site_type']); ?></td>
					<td><?php echo juassi_htmlentities($site_common['site_api_version']); ?></td>
					<!--<td><input type="checkbox" name="site_<?php echo juassi_htmlentities($site['soap_client_id']); ?>" value="1" /></td>-->
					<?php } ?>
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
		</form>

		<br style="clear:both" />
	</div>
</div>
<?php
	include('include/sidebar.php');
	//include('include/html-footer.php');
?>

<script src="../juassi-resources/js/jquery.min.js"></script>
			<!-- smart resize event -->
			<script src="../juassi-resources/js/jquery.debouncedresize.min.js"></script>
			<!-- hidden elements width/height -->
			<script src="../juassi-resources/js/jquery.actual.min.js"></script>
			<!-- js cookie plugin -->
			<script src="../juassi-resources/js/jquery.cookie.min.js"></script>
			<!-- main bootstrap js -->
			<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
			<!-- tooltips -->
			<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>
			<!-- jBreadcrumbs -->
			<script src="../juassi-resources/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="../juassi-resources/js/ios-orientationchange-fix.js"></script>
            <!-- scroll -->
			<script src="../juassi-resources/lib/antiscroll/antiscroll.js"></script>
			<script src="../juassi-resources/lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- common functions -->
			<script src="../juassi-resources/js/gebo_common.js"></script>
			
			<script src="../juassi-resources/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="../juassi-resources/js/forms/jquery.ui.touch-punch.min.js"></script>
			<!-- colorbox -->
			<script src="../juassi-resources/lib/colorbox/jquery.colorbox.min.js"></script>
			<!-- datatable (inbox,outbox) -->
			<script src="../juassi-resources/lib/datatables/jquery.dataTables.min.js"></script>
			<!-- additional sorting for datatables -->
			<script src="../juassi-resources/lib/datatables/jquery.dataTables.sorting.js"></script>
			<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/plupload.full.js"></script>
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
			<!-- autosize textareas (new message) -->
			<script src="../juassi-resources/js/forms/jquery.autosize.min.js"></script>
			<!-- tag handler (recipients) -->
			<script src="../juassi-resources/lib/tag_handler/jquery.taghandler.min.js"></script>
			<!-- mailbox functions -->
			<script src="../juassi-resources/js/gebo_mailbox.js"></script>
			
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div>
	</body>
</html>