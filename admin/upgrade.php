<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Upgrade');
	juassi_set_in_admin(true);
	include('include/html-header.php');
	include(JUASSI_ROOT . JUASSI_INCLUDE . '/upgrade.functions.php');
?>

<div class="contain">
	<h1>Upgrade</h1>
	<?php
		if (juassi_get_config('database_version') == $juassi_database_version && juassi_get_config('program_version') == $juassi_program_version) {
			?>
			<p>Your database is currently up to date and does not need upgrading.</p>
			<?php
		}
		elseif (isset($_GET['run']) && $_GET['run'] == 'upgrade') {
			if (juassi_get_config('database_version') < 3) {
				?>
				<p>The version of Juassi you are running is too old to be upgraded.</p>
				<?php
			}
			else {
				juassi_run_section('pre_update_database');

				if (juassi_get_config('database_version') < 4) {
					juassi_upgrade_4();
				}
				if (juassi_get_config('database_version') < 5) {
					juassi_upgrade_5();
				}
				if (juassi_get_config('database_version') < 6) {
					juassi_upgrade_6();
				}
				if (juassi_get_config('database_version') < 7) {
					juassi_upgrade_7();
				}
				if (juassi_get_config('database_version') < 8) {
					juassi_upgrade_8();
				}
				if (juassi_get_config('database_version') < 9) {
					juassi_upgrade_9();
				}
				if (juassi_get_config('database_version') < 10) {
					juassi_upgrade_10();
				}
				if (juassi_get_config('database_version') < 11) {
					juassi_upgrade_11();
				}
				if (juassi_get_config('database_version') < 12) {
					juassi_upgrade_12();
				}
				if (juassi_get_config('database_version') < 13) {
					juassi_upgrade_13();
				}
				if (juassi_get_config('database_version') < 14) {
					juassi_upgrade_14();
				}
				if (juassi_get_config('database_version') < 15) {
					juassi_upgrade_15();
				}
				if (juassi_get_config('database_version') < 16) {
					juassi_upgrade_16();
				}
				if (juassi_get_config('database_version') < 17) {
					juassi_upgrade_17();
				}
				if (juassi_get_config('database_version') < 18) {
					juassi_upgrade_18();
				}
				if (juassi_get_config('database_version') < 19) {
					juassi_upgrade_19();
				}
				if (juassi_get_config('database_version') < 20) {
					juassi_upgrade_20();
				}
				if (juassi_get_config('database_version') < 21) {
					juassi_upgrade_21();
				}
				if (juassi_get_config('database_version') < 22) {
					juassi_upgrade_22();
				}
				if (juassi_get_config('database_version') < 23) {
					juassi_upgrade_23();
				}
				if (juassi_get_config('database_version') < 24) {
					juassi_upgrade_24();
				}
				if (juassi_get_config('database_version') < 25) {
					juassi_upgrade_25();
				}
				if (juassi_get_config('database_version') < 26) {
					juassi_upgrade_26();
				}
				if (juassi_get_config('database_version') < 26) {
					juassi_upgrade_26();
				}
				if (juassi_get_config('database_version') < 27) {
					juassi_upgrade_27();
				}
				if (juassi_get_config('database_version') < 28) {
					juassi_upgrade_28();
				}
				if (juassi_get_config('database_version') < 29) {
					juassi_upgrade_29();
				}
				if (juassi_get_config('database_version') < 30) {
					juassi_upgrade_30();
				}
                                if (juassi_get_config('database_version') < 31) {
					juassi_upgrade_31();
				}
				juassi_run_section('post_update_database');

				trigger_error('Juassi Upgraded (Program Version "' . juassi_htmlentities($juassi_program_version) . '", Database Version "' . juassi_htmlentities($juassi_database_version) .'")', E_USER_NOTICE);
				?>
				<p>Upgrade Complete.</p>
				<?php
			}

		}
		else {
			?>
				<p>Your database needs upgrading, please click <a href="upgrade.php?run=upgrade">here</a> to continue.</p>
			<?php
		}
	?>

</div>
<?php include('include/html-footer.php'); ?>