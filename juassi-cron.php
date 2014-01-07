<?php
/*
	Juassi 2.0 Cron Support
	Juan Carlos Reyes C Copyright 2012
*/

//stop from running over and over again :)
define('JUASSI_RUNNING_CRON', TRUE);
ignore_user_abort(TRUE);

include('functions/juassi_common.php');

$cron_intervals = juassi_get_config('cron_intervals');

if (!is_array($cron_intervals)) exit;

foreach ($cron_intervals as &$cron_interval) {
	if ($cron_interval['next_run'] <= juassi_datetime()) {
		$cron_interval['next_run'] = juassi_datetime($cron_interval['frequency']);
		juassi_run_section('cron_' . $cron_interval['name']);
		//too noisy
		//trigger_error('Cron ('.$cron_interval['description'].') Successful', E_USER_NOTICE);
	}
}

juassi_set_config('cron_intervals', $cron_intervals);
?>