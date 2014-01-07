<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Servidor Connector');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="contain">
	<h1>Configuraci&oacute;n Soap</h1>
	<?php
		if (isset($_POST['submit'])) {
			juassi_run_section('update_soap_settings');
			juassi_set_config('soap_server', $_POST['soap_server'] ? 1 : 0);
		}
	?>
	<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		<fieldset>
			<legend>Servidor Soap</legend>
				<p>Permitir? <input name="soap_server" type="checkbox" value="1"<?php if (juassi_get_config('soap_server')) echo ' checked="checked" '; ?>/></p>
		</fieldset>
		<br style="clear:both" />
		<p><input type="submit" name="submit" value="Submit"/></p>
	</form>	
	<div class="tablecontain">
		<h2>Sitios Configurados</h2>
		<table data-msg_rowlink="a" class="table table_vam mbox_table dTableR" id="dt_inbox">
			<thead>
				<tr>
					<th>Registrado</th>
					<th>&Uacute;ltima conexi&oacute;n</th>
					<th>Tipo de Sitio</th>
					<th>Due&ntilde;o</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$array['server'] = 0;
				$sites = juassi_get_soap_sites($array);
				$i = 0;
				foreach ($sites as $site) { 
				?>
				<tr <?php if ($i % 2 == 0 ) echo 'class="negative"'; ?>>
					<td><?php if ($site['registered'] == 1) { echo 'S&iacute;'; } else { echo 'No'; } ?></td>
					<td><?php echo juassi_htmlentities($site['last_connected']); ?></td>
					<td><?php echo juassi_htmlentities($site['site_type']); ?></td>
					<td><?php echo juassi_htmlentities($site['user_id']); ?></td>
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
		<p style="float:right;"><a href="soap-add-site.php">Click aqu&iacute; para crear un nuevo Sitio</a></p>
		<br style="clear:both" />
	</div>
	<br />
	
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