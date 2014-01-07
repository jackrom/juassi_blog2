<?php
	include('include/admin-header.php');
	juassi_set_admin_title('File Upload');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Subidas de Archivos <span>(file upload)</</span></h2>

	<?php
		if (isset($_POST['submit'])) {
			$message = juassi_upload_script();
			if (!empty($message)) {
				echo juassi_admin_message('<strong>' . juassi_htmlentities($message[0]) . '</strong>');
			}
			else {
				echo juassi_admin_message('<strong>File(s) Uploaded.</strong>');
			}
		}
	?>

 	<form method="post" enctype="multipart/form-data" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		<p>Current upload path: <?php echo juassi_htmlentities(juassi_get_upload_path()); ?></p>

		<div class="file_upload">
			<p><strong>File Upload</strong><br /></p>
			<p><input type="file" id="first_file_element" /></p>

			<div class="files_list" id="files_list">
				<strong>Files (maximum 5):</strong>
			</div>

			<p><script src="<?php echo juassi_get_config('address') . '/juassi-resources/javascript/multifile.js'; ?>"></script></p>
		</div>

		<p>Note: You can change the Upload Path from the <a href="general-settings.php">General Settings</a> page.</p>
		<p><input name="submit" type="submit" value="Upload" /></p>
	</form>
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>