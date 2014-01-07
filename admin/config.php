<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Configuration');
	juassi_set_in_admin(true);
	$juassi_ln->add_lower_link($juassi_ln->settings, 'Configuration', 'config.php');
	include('include/html-header.php');
?>

<div class="contain">
	<h1>Configuration</h1>
	<p><?php echo juassi_admin_url_back('general-settings.php'); ?></p>
	<fieldset>
		<legend>Configuration</legend>
		<form method="post" action="">
<?php
	$juassi_configuration = '';
	foreach($juassi_config as $index => $value) {
		if ($index == 'akismet_api_key') {
			$juassi_configuration .= $index . ' => ' . 'XXXXXXXXXXXX' . "\n";
		}
		else if ($index == 'smtp_password') {
			$juassi_configuration .= $index . ' => ' . 'XXXXXXXXXXXX' . "\n";
		}
		else {
			$juassi_configuration .= $index . ' => ' . $value . "\n";
		}
	}
	$juassi_configuration .= "====Fixed Values====\n";
	$juassi_configuration .= 'JUASSI_ID => ' . JUASSI_ID . "\n";
	$juassi_configuration .= 'juassi_db_host => ' . $juassi_db_host . "\n";
	$juassi_configuration .= 'juassi_db_name => ' . $juassi_db_name . "\n";
	$juassi_configuration .= 'juassi_db_type => ' . $juassi_db_type . "\n";
	$juassi_configuration .= 'juassi_db_charset => ' . $juassi_db_charset . "\n";
	$juassi_configuration .= 'juassi_tb_prefix => ' . $juassi_tb_prefix . "\n";
	if (JUASSI_DEBUG) {
		$JUASSI_DEBUG = 'TRUE';
	}
	else {
		$JUASSI_DEBUG = 'FALSE';
	}
	if (JUASSI_LOG_ALL) {
		$JUASSI_LOG_ALL = 'TRUE';
	}
	else {
		$JUASSI_LOG_ALL = 'FALSE';
	}
	$JUASSI_MASTER = (int) JUASSI_MASTER;
	if (JUASSI_MULTI_BLOG) {
		$JUASSI_MULTI_BLOG = 'TRUE';
	}
	else {
		$JUASSI_MULTI_BLOG = 'FALSE';
	}
	if (JUASSI_LOAD_PLUGINS) {
		$JUASSI_LOAD_PLUGINS = 'TRUE';
	}
	else {
		$JUASSI_LOAD_PLUGINS = 'FALSE';
	}
	if (JUASSI_MAIL_NOTIFY) {
		$JUASSI_MAIL_NOTIFY = 'TRUE';
	}
	else {
		$JUASSI_MAIL_NOTIFY = 'FALSE';
	}
	if (JUASSI_OUTPUT_BUFFERING) {
		$JUASSI_OUTPUT_BUFFERING = 'TRUE';
	}
	else {
		$JUASSI_OUTPUT_BUFFERING = 'FALSE';
	}
	$juassi_configuration .= 'JUASSI_DEBUG => ' . $JUASSI_DEBUG . "\n";
	$juassi_configuration .= 'JUASSI_LOG_ALL => ' . $JUASSI_LOG_ALL . "\n";
	$juassi_configuration .= 'JUASSI_MASTER => ' . $JUASSI_MASTER . "\n";
	$juassi_configuration .= 'JUASSI_MULTI_BLOG => ' . $JUASSI_MULTI_BLOG . "\n";
	$juassi_configuration .= 'JUASSI_LOAD_PLUGINS => ' . $JUASSI_LOAD_PLUGINS  . "\n";
	$juassi_configuration .= 'JUASSI_MAIL_NOTIFY => ' . $JUASSI_MAIL_NOTIFY  . "\n";
	$juassi_configuration .= 'JUASSI_OUTPUT_BUFFERING => ' . $JUASSI_OUTPUT_BUFFERING  . "\n";
	$juassi_configuration .= 'JUASSI_ROOT => ' . JUASSI_ROOT  . "\n";
	$juassi_configuration .= 'JUASSI_REL_ROOT => ' . JUASSI_REL_ROOT  . "\n";
	$juassi_configuration .= 'juassi_database_version => ' . $juassi_database_version  . "\n";
	$juassi_configuration .= 'juassi_program_version => ' . $juassi_program_version  . "\n";

?>
<p><textarea name="configuration" rows="20" style="width: 100%">
<?php echo juassi_htmlentities($juassi_configuration); ?>
</textarea></p>
		 </form>
	</fieldset>
	<br clear="all" />
</div>
<?php
	include('include/html-footer.php');
?>