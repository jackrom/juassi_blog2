<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Edit Site');
	juassi_set_in_admin(true);
	$juassi_ln->add_lower_link($juassi_ln->connector, 'Edit Site', 'soap-edit-site.php');

	if (isset($_POST['submit'])) {
		if ($_POST['submit'] == 'Delete') {
			$soap_client_id = (int) $_POST['id'];
			juassi_soap_delete_site($soap_client_id);
		}
		else {
			$array['site_id']			= $_POST['local_site_id'];
			$array['soap_client_id']	= (int)$_REQUEST['id'];
			$array['nickname'] 			= $_POST['nickname'];

			$array['site_soap_url'] 	= $_POST['site_soap_url'];
			$array['remote_site_id'] 	= $_POST['remote_site_id'];

			juassi_soap_update_server($array);

			unset($array);
		}
	}

	$juassi_site	= juassi_get_soap_site((int)$_REQUEST['id']);

	if (!empty($juassi_site)) {
		$juassi_soap_site = new juassi_soap_client($juassi_site['soap_client_id']);
	}
	else {
		header('Location: soap-server-settings.php');
	}
	include('include/html-header.php');
?>
<script type="text/javascript">
<!--
function juassi_confirm() {
	if (confirm("Are you sure you wish to delete this site?")){
		return true;
	}
	else{
		return false;
	}
}
//-->
</script>
<div class="contain">
	<h1>Edit Site</h1>
	<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		<fieldset>
			<legend>Site Common Details</legend>
			<?php
				if ($juassi_soap_site->is_connected() == true) {
					$common = $juassi_soap_site->get_common();
					$juassi_soap_site->cache_common();
				}
				else {
					$common = juassi_get_sites_common($juassi_site['soap_client_id']);
					if ($juassi_site['registered'] == 1 && !empty($juassi_site['remote_site_id'])) {
						echo juassi_admin_message('<strong>Unable to connect to remote site, using cached details.</strong>');
					}
					else {
						echo juassi_admin_message('<strong>You do not have remote access to the client.</strong>');
					}
				}
			?>
			<ul>
				<li>Site Name : <strong><?php echo juassi_htmlentities($common['site_name']); ?></strong></li>
				<li>Site Address : <strong><?php echo juassi_htmlentities($common['site_address']); ?></strong></li>
				<li>Site Type: <strong><?php echo juassi_htmlentities($common['site_type']); ?></strong></li>
				<li>Site Version : <strong><?php echo juassi_htmlentities($common['site_program_version']); ?></strong></li>
				<li>API Version : <strong><?php echo juassi_htmlentities($common['site_api_version']); ?></strong></li>
			</ul>
		</fieldset>

		<fieldset>
			<legend>Site Settings</legend>
			<p>Site Nickname<br /><input type="text" name="nickname" value="<?php echo juassi_htmlentities($juassi_site['nickname']); ?>" size="20" /></p>
			<p>Local Site ID<br /><input type="text" name="local_site_id" value="<?php echo juassi_htmlentities($juassi_site['local_site_id']); ?>" size="40" /></p>
			<hr />
			<p>The follow settings are required if you want to directly connect to the site.</p>
			<p>Remote Site ID<br /><input type="text" name="remote_site_id" value="<?php echo juassi_htmlentities($juassi_site['remote_site_id']); ?>" size="40" /></p>
			<p>Remote Connector URL<br /><input type="text" name="site_soap_url" value="<?php echo juassi_htmlentities($juassi_site['site_soap_url']); ?>" size="40" /></p>
		</fieldset>


		<?php if ($common['site_api_version'] >= '1.1') { ?>
		<fieldset>
			<legend>Site Supported Features</legend>
			<?php print_r(unserialize($common['supported_features'])); ?>
		</fieldset>
		<?php }	?>

		<!--
		<?php if ($juassi_site['registered'] == 1 && !empty($juassi_site['remote_site_id'])) { ?>
		<fieldset>
			<legend>Data Pull Settings</legend>
			<p>Events<br />
				<select name="juassi_contact_form">
					<option value="0">Off</option>
					<option value="1"<?php if (true) { echo ' selected="selected" '; } ?>>On</option>
			</select></p>
		</fieldset>
		<fieldset>
			<legend>Data Push Settings</legend>

		</fieldset>
		<?php } else { ?>
		<fieldset>
			<legend>Data Settings</legend>
				<p>You do not have remote access to the client.</p>
		</fieldset>
		<?php } ?>
		-->
		<br style="clear:both" />
		<br />
		<input type="hidden" name="id" value="<?php echo (int) $juassi_site['soap_client_id']; ?>" />
		<input type="submit" name="submit" value="Submit"/>
	</form>
	<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return juassi_confirm(this);">
		<p><input type="hidden" name="id" value="<?php echo (int) $juassi_site['soap_client_id']; ?>"/><input name="submit" type="submit" value="Delete" /></p>
	</form>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>