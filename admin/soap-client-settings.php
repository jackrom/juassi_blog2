<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Connector Client');
	juassi_set_in_admin(true);

	include('include/html-header.php');
?>
<div class="contain">
	<h1>Connector Client</h1>
	<?php
		if (isset($_POST['juassi_soap_remove'])) {
			$juassi_soap	= new juassi_soap_client();
			if ($juassi_soap->call('juassi_soap_unregister_site') == 1) {
				juassi_soap_unregister_server(juassi_get_config('soap_server_id'));
				echo juassi_admin_message('<strong>Successfully removed connection</strong>');
			}
			else if (isset($_POST['juassi_soap_force_remove']) && ($_POST['juassi_soap_force_remove'] == 1)) {
				juassi_soap_unregister_server(juassi_get_config('soap_server_id'));
				echo juassi_admin_message('<strong>Forcefully removed connection</strong>');
			}
			else {
				echo juassi_admin_message('<strong>Failed to remove connection.</strong>');
			}
			unset($juassi_soap);
		}
		elseif (isset($_POST['submit'])) {
			$user = $juassi_users->get_user((int) $_POST['juassi_soap_user_id']);
			$connect_array['username'] 	= $user['user_name'];
			$connect_array['password'] 	= $_POST['juassi_soap_password'];
			$connect_array['site_id']	= $_POST['juassi_soap_site_id'];
			$connect_array['site_type']	= 'juassi_blog';
			$connect_array['url'] 		= $_POST['juassi_soap_server_url'];

			$result = juassi_soap_register_client_site($connect_array);

			if ($result['success'] == 1) {
				echo juassi_admin_message('<strong>Successfully connected to server</strong>');

				$server_details['user_id'] 			= (int) $_POST['juassi_soap_user_id'];
				$server_details['site_id']			= $_POST['juassi_soap_site_id'];
				$server_details['site_type'] 		= $result['site_type'];
				$server_details['site_soap_url'] 	= $connect_array['url'];

				juassi_soap_register_server($server_details);

				if (isset($_POST['juassi_soap_server_manage']) && ($_POST['juassi_soap_server_manage'] == 1)) {
					$juassi_soap	= new juassi_soap_client();
					$juassi_soap->setup_server_access();
				}

			}
			elseif (isset($result['message']) && !empty($result['message'])) {
				echo juassi_admin_message('<strong>Failed to connect to server</strong>');
				echo juassi_admin_message('<strong>Server said "' . juassi_htmlentities($result['message']) . '"</strong>');
			}
			else {
				echo juassi_admin_message('<strong>Failed to connect to server</strong>');
				//echo juassi_admin_message('<strong>Client said "' . juassi_htmlentities($register_client->getError()) . '"</strong>');
			}
		}
		elseif (isset($_POST['soap_push_events'])) {
			$result = juassi_soap_push_events();

			if ($result['success'] == 1) {
				echo juassi_admin_message('<strong>Events Pushed.</strong>');
			}
			else {
				echo juassi_admin_message('<strong>Failed to Push Events.</strong>');
			}
		}
	?>
	<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		<fieldset>
			<legend>Connect to Server</legend>
				<?php if (juassi_get_config('soap_server_id') == '' || juassi_get_config('soap_server_id') == 0) { ?>
					<p>Local user for permissions<br />
					<select name="juassi_soap_user_id">
					<?php
					$users = $juassi_users->get_users();
					foreach($users as $user) {
						?>
						<option value="<?php echo juassi_htmlentities($user['user_id']); ?>"><?php echo juassi_htmlentities($user['user_name']); ?></option>
						<?php
					} ?>
					</select>
					</p>
					<p>Remote Password <br /><input name="juassi_soap_password" size="35"  type="password" value="" /></p>
					<p>Site ID <br /><input name="juassi_soap_site_id" size="35"  type="text" value="" /></p>
					<p>Server Connector URL <br /><input name="juassi_soap_server_url" size="35"  type="text" value="<?php
						if (isset($_POST['juassi_soap_server_url'])) {
							echo juassi_htmlentities($_POST['juassi_soap_server_url']);
						} ?>" /></p>
					<p>Allow server to connect to this site? <input name="juassi_soap_server_manage" type="checkbox" value="1" /></p>
					<p>Note: Usernames must be the same on both server and client, passwords do not.</p>
					<p>Note: For the server to be able to connect back to this site the local Connector Server must be enabled.</p>
					<p>Note: Events are pushed once an hour.</p>
				<?php } else {
						$details_server_id		= juassi_get_config('soap_server_id');
						$server_info			= juassi_get_soap_site($details_server_id);
					?>
					<p>Connected To Server: <?php echo juassi_htmlentities($server_info['site_soap_url']); ?></p>
					<?php if (isset($server_info['local_site_id']) && !empty($server_info['local_site_id'])) { ?>
					<p>The server has permissions to access this site.</p>
					<?php } ?>
					<input type="submit" name="juassi_soap_remove" value="Remove Connection"/>
					<p>Forcefully remove connection if server rejects attempt? <input name="juassi_soap_force_remove" type="checkbox" value="1" /></p>

				<?php } ?>
		</fieldset>
		<?php if ((juassi_get_config('soap_server_id') !== '') && (juassi_get_config('soap_server_id') !== '0')) { ?>
		<fieldset>
			<legend>Test Connection</legend>
			<?php if (isset($_POST['soap_test_submit'])) {
				$juassi_soap_connection		= new juassi_soap_client();
				$soap_result 			= $juassi_soap_connection->get_common();
				$test_connection		= true;
			} else {
				$test_connection		= false;
			}?>
			<?php if ($test_connection) { ?>
				<?php if (isset($soap_result['site_type']) && (!empty($soap_result['site_type']))) { ?>
					<p>The following details were retrived from the server.</p>
					<ul>
						<li>Site Name : <strong><?php echo juassi_htmlentities($soap_result['site_name']); ?></strong></li>
						<li>Site Address : <strong><?php echo juassi_htmlentities($soap_result['site_address']); ?></strong></li>
						<li>Site Type: <strong><?php echo juassi_htmlentities($soap_result['site_type']); ?></strong></li>
						<li>Site Version : <strong><?php echo juassi_htmlentities($soap_result['site_program_version']); ?></strong></li>
						<li>API Version : <strong><?php echo juassi_htmlentities($soap_result['site_api_version']); ?></strong></li>
					</ul>
					<p>If this information is correct you're ready to go.</p>
				<?php } else {
				?>
					<p>There was a problem getting the server details. Please check your connector details.</p>
					<p>Error: <?php echo juassi_htmlentities($juassi_soap_connection->getError()); ?>
				<?php } ?>
			<?php } else { ?>
				<p>You can click the "test" button to test the connection to the server.</p>
			<?php } ?>
			<p><input type="submit" name="soap_test_submit" value="Test" /></p>
		</fieldset>
		<fieldset>
			<legend>Push Data</legend>
			<p><input type="submit" name="soap_push_events" value="Push Events" /></p>

			<p>Note: Events are pushed once an hour.</p>
		</fieldset>
		<?php } ?>
		<br style="clear:both" />
		<br />
		<input type="submit" name="submit" value="Submit"/>
	</form>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>