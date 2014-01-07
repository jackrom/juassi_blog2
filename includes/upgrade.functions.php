<?php
/*
	Juassi 2.0 Upgrade Functions
	Juan Carlos Reyes C Copyright 2012
*/

function juassi_upgrade_4() {

	$juassi_group_admin = 1;

	$juassi_file_link_settings = juassi_add_permitted_file('link-settings.php');
	$juassi_file_theme_settings = juassi_add_permitted_file('theme-settings.php');
	$juassi_file_group_admin = juassi_add_permitted_file('group-admin.php');

	juassi_add_file_to_group($juassi_file_link_settings, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_theme_settings, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_group_admin, $juassi_group_admin);

	juassi_set_config('database_version', '4');
}

function juassi_upgrade_5() {

	juassi_set_config('program_version', '2.0.0-alpha-1');
	juassi_set_config('database_version', '5');
}

function juassi_upgrade_6() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {

		case 'mysql':

			$query = "ALTER TABLE $juassi_tb->users MODIFY active_key varchar(32)";
			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		break;

		case 'sqlite':


			//SQLite sucks
			/*
			$query = "ALTER TABLE $bt_tb->users DROP COLUMN active_key";
			try {
				$bt_db->query($query);
			}
			catch (Exception $e) {
				bt_die($e->getMessage());
			}

			$query = "ALTER TABLE $bt_tb->users ADD active_key varchar(32)";
			try {
				$bt_db->query($query);
			}
			catch (Exception $e) {
				bt_die($e->getMessage());
			}
			*/

		break;

	}

	$juassi_group_admin = 1;
        
        

	$juassi_file_user_profile = juassi_add_permitted_file('user-profile.php');

	juassi_add_file_to_group($juassi_file_user_profile, $juassi_group_admin);

	juassi_set_config('database_version', '6');
}

function juassi_upgrade_7() {

	$juassi_group_admin = 1;

	$juassi_task_clear_logs = juassi_add_permitted_task('clear_logs');

	juassi_add_task_to_group($juassi_task_clear_logs, $juassi_group_admin);

	juassi_set_config('database_version', '7');
}

function juassi_upgrade_8() {


	juassi_add_config('description', '');
	juassi_add_config('limit_posts', '10');

	juassi_set_config('program_version', '2.0.0-alpha-2');
	juassi_set_config('database_version', '8');

}

function juassi_upgrade_9() {

	$juassi_group_admin = 1;

	$juassi_file_delete_post = bt_add_permitted_file('delete-post.php');

	juassi_add_file_to_group($bt_file_delete_post, $bt_group_admin);

	juassi_set_config('database_version', '9');

}
function juassi_upgrade_10() {

	juassi_add_config('content_permalink_format', '/page/%x_title%/');
	juassi_set_config('database_version', '10');

}
function juassi_upgrade_11() {

	$juassi_group_admin = 1;

	$juassi_file_edit_content_page = juassi_add_permitted_file('edit-content-page.php');
	juassi_add_file_to_group($juassi_file_edit_content_page, $juassi_group_admin);

	$juassi_file_delete_content = juassi_add_permitted_file('delete-content.php');
	juassi_add_file_to_group($juassi_file_delete_content, $juassi_group_admin);

	juassi_set_config('database_version', '11');

}

function juassi_upgrade_12() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {

		case 'mysql':

			$query = "ALTER TABLE $juassi_tb->users MODIFY website varchar(255)";
			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		break;

	}
	juassi_set_config('database_version', '12');
}


function juassi_upgrade_13() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	$juassi_group_admin = 1;

	$juassi_file_edit_comment = juassi_add_permitted_file('edit-comment.php');
	juassi_add_file_to_group($juassi_file_edit_comment, $juassi_group_admin);

	$juassi_file_permalink_settings = juassi_add_permitted_file('permalink-settings.php');
	juassi_add_file_to_group($juassi_file_permalink_settings, $juassi_group_admin);

	juassi_add_config('akismet', '0');
	juassi_add_config('akismet_api_key', '');
	juassi_add_config('akismet_delete_trackbacks', '0');
	juassi_add_config('upload_path', '');

	juassi_set_config('database_version', '13');
}

function juassi_upgrade_14() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	$juassi_group_admin = 1;

	$juassi_task_edit_comments = juassi_add_permitted_task('edit_comments');
	juassi_add_task_to_group($juassi_task_edit_comments, $juassi_group_admin);

	juassi_set_config('database_version', '14');
}

function juassi_upgrade_15() {

	juassi_add_config('akismet_weighting', '75');
	juassi_add_config('spam_block_weighting', '25');
	juassi_add_config('user_commented_before_weighting', '75');
	juassi_add_config('tag_spam_score', '75');
	juassi_add_config('max_spam_score', '150');

	juassi_set_config('program_version', '2.0.0-alpha-3');
	juassi_set_config('database_version', '15');

}

function juassi_upgrade_16() {

	$juassi_group_admin = 1;

	$juassi_file_delete_comment = juassi_add_permitted_file('delete-comment.php');
	juassi_add_file_to_group($juassi_file_delete_comment, $juassi_group_admin);

	$juassi_file_approve_comment = juassi_add_permitted_file('approve-comment.php');
	juassi_add_file_to_group($juassi_file_approve_comment, $juassi_group_admin);

	juassi_set_config('program_version', '2.0.0-alpha-4');
	juassi_set_config('database_version', '16');

}
function juassi_upgrade_17() {

	juassi_add_config('spam_level', '1');
	juassi_set_config('database_version', '17');

}

function juassi_upgrade_18() {
	juassi_add_config('contact_user_id', '0');
	juassi_set_config('database_version', '18');
}
function juassi_upgrade_19() {
	juassi_add_config('trackbacks', '0');
	juassi_set_config('database_version', '19');
}

function juassi_upgrade_20() {

	$juassi_group_admin = 1;

	$juassi_task_edit_content = juassi_add_permitted_task('edit_content');
	juassi_add_task_to_group($juassi_task_edit_content, $juassi_group_admin);

	juassi_set_config('database_version', '20');
}

function juassi_upgrade_21() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {

		case 'mysql':
			$query = "
			CREATE TABLE $juassi_tb->link_categories (
			  category_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			  description TEXT NOT NULL,
			  text_before_all varchar(255) NOT NULL default '',
			  text_after_all varchar(255) NOT NULL default '',
			  text_after varchar(255) NOT NULL default '',
			  category_name varchar(255) NOT NULL default '',
			  PRIMARY KEY  (category_id)
			) DEFAULT CHARSET=utf8;
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->links (
			  link_url TEXT NOT NULL,
			  link_name varchar(255) NOT NULL default '',
			  category_id INT(11) UNSIGNED NOT NULL default '0',
			  link_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			  link_order INT(11) NOT NULL DEFAULT '0',
			  PRIMARY KEY  (link_id)
			) DEFAULT CHARSET=utf8;
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		break;

		case 'sqlite':

			$query = "
			CREATE TABLE $juassi_tb->link_categories (
			  category_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			  description TEXT NOT NULL,
			  text_before_all varchar(255) NOT NULL default '',
			  text_after_all varchar(255) NOT NULL default '',
			  text_after varchar(255) NOT NULL default '',
			  category_name varchar(255) NOT NULL default '',
			);
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->links (
			  link_url TEXT NOT NULL,
			  link_name varchar(255) NOT NULL default '',
			  category_id INTEGER UNSIGNED NOT NULL default '0',
			  link_id INT INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			  link_order INTEGER NOT NULL DEFAULT '0',
			);
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

		break;
	}

	juassi_set_config('program_version', '2.0.0-beta-1');
	juassi_set_config('database_version', '21');
}
function juassi_upgrade_22() {
	juassi_add_config('cf_akismet_delete_spam', '0');
	juassi_add_config('cf_require_valid_email', '0');
	juassi_set_config('database_version', '22');
}
function juassi_upgrade_23() {

	$juassi_group_admin = 1;

	$juassi_file_edit_link = juassi_add_permitted_file('edit-link.php');
	juassi_add_file_to_group($juassi_file_edit_link, $juassi_group_admin);

	$juassi_file_maintenance = juassi_add_permitted_file('maintenance.php');
	juassi_add_file_to_group($juassi_file_maintenance, $juassi_group_admin);

	juassi_set_config('database_version', '23');
}
function juassi_upgrade_24() {

	$juassi_group_admin = 1;

	$juassi_file_order_links = juassi_add_permitted_file('order-links.php');
	juassi_add_file_to_group($juassi_file_order_links, $juassi_group_admin);

	$juassi_task_delete_users = juassi_add_permitted_task('delete_users');
	juassi_add_task_to_group($juassi_task_delete_users, $juassi_group_admin);

	$juassi_task_clear = juassi_add_permitted_task('clear_moderation_queue');
	juassi_add_task_to_group($juassi_task_clear, $juassi_group_admin);

	juassi_set_config('program_version', '2.0.0-beta-2');
	juassi_set_config('database_version', '24');

}
function juassi_upgrade_25() {
	$juassi_group_admin = 1;

	$juassi_file = bt_add_permitted_file('edit-link-category.php');
	juassi_add_file_to_group($juassi_file, $juassi_group_admin);

	$juassi_file_2 = juassi_add_permitted_file('delete-link-category.php');
	juassi_add_file_to_group($juassi_file_2, $juassi_group_admin);

	$juassi_task = juassi_add_permitted_task('delete_link_categories');
	juassi_add_task_to_group($juassi_task, $juassi_group_admin);

	juassi_set_config('database_version', '25');
}

function juassi_upgrade_26() {
	juassi_set_config('program_version', '2.0.0');
	juassi_set_config('database_version', '26');
}
//Juassi 2.1
function juassi_upgrade_27() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {

		case 'mysql':

			$query = "DROP TABLE $juassi_tb->events";

			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$table_create =	"
			CREATE TABLE `$juassi_tb->events` (
				`event_id` int(11) unsigned NOT NULL auto_increment COMMENT 'Event Primary Key',
				`event_number` int(11) NOT NULL COMMENT '',
				`user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
				`server_id` int(11) unsigned DEFAULT NULL COMMENT 'The ID of the remote log client',
				`remote_id` int(11) unsigned DEFAULT NULL COMMENT 'The Event Primary Key from the remote client',
				`event_date` datetime NOT NULL COMMENT 'Event Datetime in local timezone',
				`event_date_utc` datetime NOT NULL COMMENT 'Event Datetime in UTC timezone',
				`event_type` varchar(255) NOT NULL COMMENT 'The type of event',
				`event_source` varchar(255) NOT NULL COMMENT 'Text description of the source of the event',
				`event_severity` varchar(255) NOT NULL COMMENT 'Notice, Warning etc',
				`event_file` text NOT NULL COMMENT 'The full file location of the source of the event',
				`event_file_line` int(11) NOT NULL COMMENT 'The line in the file that triggered the event',
				`event_ip_address` varchar(255) NOT NULL COMMENT 'IP Address of the user that triggered the event',
				`event_summary` varchar(255) NULL COMMENT 'A summary of the description',
				`event_description` text NOT NULL COMMENT 'Full description of the event',
				`event_trace` text NULL COMMENT 'Full PHP trace',
				`event_synced` int(1) unsigned DEFAULT 0,
				PRIMARY KEY (`event_id`)
				) DEFAULT CHARSET=utf8;
			";
			try {
				$juassi_db->exec($table_create);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			$query = "
				CREATE TABLE `$juassi_tb->soap_clients` (
				  `soap_client_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				  `local_site_id` varchar(255) NOT NULL,
				  `remote_site_id` varchar(255) DEFAULT NULL,
				  `site_type` varchar(255) NOT NULL,
				  `site_soap_url` varchar(255) DEFAULT NULL,
				  `user_id` INT(11) UNSIGNED NOT NULL,
				  `last_connected` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  `registered` INT(1) NOT NULL DEFAULT '0',
				  `server` INT(1) NOT NULL DEFAULT '0',
				  `nickname` varchar(255) NOT NULL,
				  PRIMARY KEY (`soap_client_id`),
				  UNIQUE KEY `local_site_id` (`local_site_id`)
				) DEFAULT CHARSET=utf8;
				";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE `$juassi_tb->sites` (
				`soap_client_id` int(11) unsigned NOT NULL,
				`config_type` varchar(255) NOT NULL,
				`config_name` varchar(255) NOT NULL,
				`config_value` text NOT NULL,
				PRIMARY KEY (`soap_client_id`,`config_name`)
			) DEFAULT CHARSET=utf8;
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
		break;

		case 'sqlite':

			$query = "DROP TABLE $juassi_tb->events";

			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->soap_clients (
			  `soap_client_id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
			  `local_site_id` varchar(255) UNIQUE NOT NULL,
			  `remote_site_id` varchar(255) NULL,
			  `site_type` varchar(255) NULL,
			  `site_soap_url` varchar(255) NULL,
			  `user_id` INTEGER NOT NULL,
			  `last_connected` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  `registered` INTEGER NOT NULL DEFAULT '0',
			  `server` INTEGER NOT NULL DEFAULT '0',
			  `nickname` varchar(255) NOT NULL
			  )
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE `$juassi_tb->sites` (
				`soap_client_id` INTEGER NOT NULL,
				`config_type` varchar(255) NOT NULL,
				`config_name` varchar(255) NOT NULL,
				`config_value` text NOT NULL,
				PRIMARY KEY (`soap_client_id`,`config_name`)
			)
			";

			try {
				$juassi_db->exec($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$table_create =	"
			CREATE TABLE `$juassi_tb->events` (
				`event_id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
				`event_number` INTEGER NOT NULL,
				`user_id` INTEGER NOT NULL,
				`server_id` INTEGER DEFAULT NULL,
				`remote_id` INTEGER DEFAULT NULL,
				`event_date` datetime NOT NULL,
				`event_date_utc` datetime NOT NULL,
				`event_type` varchar(255) NOT NULL,
				`event_source` varchar(255) NOT NULL,
				`event_severity` varchar(255) NOT NULL,
				`event_file` text NOT NULL,
				`event_file_line` INTEGER NOT NULL,
				`event_ip_address` varchar(255) NOT NULL,
				`event_summary` varchar(255) NULL,
				`event_description` text NOT NULL,
				`event_trace` text NULL,
				`event_synced` INTEGER NOT NULL DEFAULT 0
				)
			";
			try {
				$juassi_db->exec($table_create);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

		break;

	}

	juassi_add_config('soap_server', '0');
	juassi_add_config('soap_server_id', '');
	juassi_add_config('allow_register', '0');
	juassi_add_config('default_group_id', '0');
	juassi_add_config('user_activation', '0');
        

	$juassi_group_admin = 1;

	//0.27
	$juassi_file_soap_server_settings = juassi_add_permitted_file('soap-server-settings.php');
	$juassi_file_soap_client_settings = juassi_add_permitted_file('soap-client-settings.php');
	$juassi_file_soap_add_site = juassi_add_permitted_file('soap-add-site.php');
	$juassi_file_soap_edit_site = juassi_add_permitted_file('soap-edit-site.php');
	$juassi_file_soap_task = juassi_add_permitted_file('soap-tasks.php');

	juassi_add_file_to_group($juassi_file_soap_server_settings, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_soap_client_settings, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_soap_add_site, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_soap_edit_site, $juassi_group_admin);
	juassi_add_file_to_group($juassi_file_soap_task, $juassi_group_admin);

	$juassi_task_send_remote_events = juassi_add_permitted_task('send_remote_events');
	juassi_add_task_to_group($juassi_task_send_remote_events, $juassi_group_admin);

	juassi_set_config('program_version', '2.1.0-beta-1');
	juassi_set_config('database_version', '27');
}
function juassi_upgrade_28() {

	juassi_add_config('default_content_type', 'blog');
	juassi_add_config('default_content_id', '');

	juassi_add_task_to_group(juassi_add_permitted_task('delete_categories'), 1);
	juassi_add_file_to_group(juassi_add_permitted_file('delete-category.php'), 1);

	juassi_set_config('program_version', '2.1.0-beta-2');
	juassi_set_config('database_version', '28');
}

function juassi_upgrade_29() {

	juassi_add_config('soap_server_ssl_only', '0');

	juassi_set_config('database_version', '29');
}

function juassi_upgrade_30() {

	juassi_add_config('smtp_client', '0');
	juassi_add_config('smtp_auth', '0');
	juassi_add_config('smtp_username', '');
	juassi_add_config('smtp_password', '');
	juassi_add_config('smtp_server', '');

	juassi_set_config('database_version', '30');

}

function juassi_upgrade_31() {
        switch ($juassi_db_type) {

		case 'mysql':

			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->Attachments' (
                                    AttachmentId int(11) NOT NULL auto_increment,
                                    MessageId int(11) NOT NULL default '0',
                                    Filename text NOT NULL,
                                    ContentType text NOT NULL,
                                    Size int(11) NOT NULL default '0',
                                    Data longtext NOT NULL,
                                    PRIMARY KEY  (AttachmentId)
                                  )";
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->Folders' (
                                    FolderId int(11) NOT NULL auto_increment,
                                    Name text NOT NULL,
                                    PRIMARY KEY  (FolderId)
                                  )";
                        
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->Messages' (
                                    MessageId int(11) NOT NULL auto_increment,
                                    `To` text NOT NULL,
                                    CC text NOT NULL,
                                    BCC text NOT NULL,
                                    `From` text NOT NULL,
                                    Subject text NOT NULL,
                                    Date bigint(20) default NULL,
                                    Message text NOT NULL,
                                    HasAttachments tinyint(1) NOT NULL default '0',
                                    Unread tinyint(1) NOT NULL default '1',
                                    FolderId int(11) NOT NULL default '0',
                                    PRIMARY KEY  (MessageId)
                                  )";
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->admin' (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `username` varchar(50) NOT NULL,
                                    `password` varchar(50) NOT NULL,
                                    `email` varchar(100) NOT NULL,
                                    `events_per_page` int(11) NOT NULL DEFAULT '10',
                                    `status` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2" ;
                                  
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->eventer' (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `start_date` varchar(10) NOT NULL,
                                    `end_date` varchar(10) NOT NULL,
                                    `start_time` varchar(25) NOT NULL,
                                    `end_time` varchar(25) NOT NULL,
                                    `title` varchar(255) NOT NULL,
                                    `description` text,
                                    `venue` varchar(100) NOT NULL,
                                    `link` varchar(255) NOT NULL,
                                    `icon` varchar(100) NOT NULL,
                                    `image` varchar(100) NOT NULL,
                                    `image_alignment` varchar(6) NOT NULL DEFAULT 'left',
                                    `status` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`)
                                  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2" ;
                              
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->images' (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `path` varchar(255) NOT NULL,
                                    `name` varchar(100) NOT NULL,
                                    PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2" ;
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE '$juassi_tb->options' (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `display_mode` varchar(11) NOT NULL DEFAULT 'interactive',
                                    `tech_mode` varchar(4) NOT NULL DEFAULT 'ajax',
                                    `color_theme` varchar(5) NOT NULL DEFAULT 'Light',
                                    `date_box_width` int(11) NOT NULL DEFAULT '136',
                                    `date_box_height` int(11) NOT NULL DEFAULT '91',
                                    `date_box_horizontal_space` int(3) NOT NULL DEFAULT '1',
                                    `date_box_vertical_space` int(3) NOT NULL DEFAULT '1',
                                    `date_box_corner_radius` int(3) NOT NULL DEFAULT '5',
                                    `date_box_bg_color` varchar(6) NOT NULL DEFAULT 'FFFFFF',
                                    `empty_date_box_alpha` int(3) NOT NULL DEFAULT '50',
                                    `today_date_box_bg_color` varchar(6) NOT NULL DEFAULT 'FFFFFF',
                                    `date_format` varchar(3) NOT NULL DEFAULT 'USA',
                                    `starting_week_day` int(1) NOT NULL DEFAULT '0',
                                    `week_day_names_short` varchar(255) NOT NULL DEFAULT 'Mon,Tue,Wed,Thu,Fri,Sat,Sun',
                                    `week_day_names_long` varchar(255) NOT NULL DEFAULT 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                                    `week_day_names_format` varchar(5) NOT NULL DEFAULT 'short',
                                    `month_names_short` varchar(255) NOT NULL DEFAULT 'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
                                    `month_names_long` varchar(255) NOT NULL DEFAULT 'January,February,March,April,May,June,July,August,September,October,November,December',
                                    `month_names_format` varchar(5) NOT NULL DEFAULT 'long',
                                    `show_months_navigation` tinyint(4) NOT NULL DEFAULT '1',
                                    `calendar_padding` int(3) NOT NULL DEFAULT '10',
                                    `calendar_background_width` varchar(5) NOT NULL DEFAULT '100%',
                                    `repeat_events` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`)
                                  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2" ;
                        
                        
               case 'sqlite':

			try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->Folders (
                                    FolderId int(11) NOT NULL auto_increment,
                                    Name text NOT NULL,
                                    PRIMARY KEY  (FolderId)
			  )
			";
                        
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->Attachments (
                                    AttachmentId int(11) NOT NULL auto_increment,
                                    MessageId int(11) NOT NULL default '0',
                                    Filename text NOT NULL,
                                    ContentType text NOT NULL,
                                    Size int(11) NOT NULL default '0',
                                    Data longtext NOT NULL,
                                    PRIMARY KEY  (AttachmentId)
			  )
			";
                        
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->Messages (
                                    MessageId int(11) NOT NULL auto_increment,
                                    `To` text NOT NULL,
                                    CC text NOT NULL,
                                    BCC text NOT NULL,
                                    `From` text NOT NULL,
                                    Subject text NOT NULL,
                                    Date bigint(20) default NULL,
                                    Message text NOT NULL,
                                    HasAttachments tinyint(1) NOT NULL default '0',
                                    Unread tinyint(1) NOT NULL default '1',
                                    FolderId int(11) NOT NULL default '0',
                                    PRIMARY KEY  (MessageId)
			  )
			";
                        
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->admin (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `username` varchar(50) NOT NULL,
                                    `password` varchar(50) NOT NULL,
                                    `email` varchar(100) NOT NULL,
                                    `events_per_page` int(11) NOT NULL DEFAULT '10',
                                    `status` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`))
			";
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->eventer (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `start_date` varchar(10) NOT NULL,
                                    `end_date` varchar(10) NOT NULL,
                                    `start_time` varchar(25) NOT NULL,
                                    `end_time` varchar(25) NOT NULL,
                                    `title` varchar(255) NOT NULL,
                                    `description` text,
                                    `venue` varchar(100) NOT NULL,
                                    `link` varchar(255) NOT NULL,
                                    `icon` varchar(100) NOT NULL,
                                    `image` varchar(100) NOT NULL,
                                    `image_alignment` varchar(6) NOT NULL DEFAULT 'left',
                                    `status` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`))
			";
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->images (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `path` varchar(255) NOT NULL,
                                    `name` varchar(100) NOT NULL,
                                    PRIMARY KEY (`id`))
			";
                        
                        try {
				$juassi_db->query($query);
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}

			$query = "
			CREATE TABLE $juassi_tb->options (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `display_mode` varchar(11) NOT NULL DEFAULT 'interactive',
                                    `tech_mode` varchar(4) NOT NULL DEFAULT 'ajax',
                                    `color_theme` varchar(5) NOT NULL DEFAULT 'Light',
                                    `date_box_width` int(11) NOT NULL DEFAULT '136',
                                    `date_box_height` int(11) NOT NULL DEFAULT '91',
                                    `date_box_horizontal_space` int(3) NOT NULL DEFAULT '1',
                                    `date_box_vertical_space` int(3) NOT NULL DEFAULT '1',
                                    `date_box_corner_radius` int(3) NOT NULL DEFAULT '5',
                                    `date_box_bg_color` varchar(6) NOT NULL DEFAULT 'FFFFFF',
                                    `empty_date_box_alpha` int(3) NOT NULL DEFAULT '50',
                                    `today_date_box_bg_color` varchar(6) NOT NULL DEFAULT 'FFFFFF',
                                    `date_format` varchar(3) NOT NULL DEFAULT 'USA',
                                    `starting_week_day` int(1) NOT NULL DEFAULT '0',
                                    `week_day_names_short` varchar(255) NOT NULL DEFAULT 'Mon,Tue,Wed,Thu,Fri,Sat,Sun',
                                    `week_day_names_long` varchar(255) NOT NULL DEFAULT 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                                    `week_day_names_format` varchar(5) NOT NULL DEFAULT 'short',
                                    `month_names_short` varchar(255) NOT NULL DEFAULT 'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
                                    `month_names_long` varchar(255) NOT NULL DEFAULT 'January,February,March,April,May,June,July,August,September,October,November,December',
                                    `month_names_format` varchar(5) NOT NULL DEFAULT 'long',
                                    `show_months_navigation` tinyint(4) NOT NULL DEFAULT '1',
                                    `calendar_padding` int(3) NOT NULL DEFAULT '10',
                                    `calendar_background_width` varchar(5) NOT NULL DEFAULT '100%',
                                    `repeat_events` tinyint(4) NOT NULL DEFAULT '1',
                                    PRIMARY KEY (`id`))";
              break;
        }
        
        
        
        juassi_add_config('mail', '0');
        $juassi_group_admin = 1;

	//0.31
	$juassi_file_mail_inbox = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_trash = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_empty_trash = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_new_mail = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_view_mail = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_send_mail = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_reply_mail = juassi_add_permitted_file('mailSystem.php');
        $juassi_file_mail_cancel_mail = juassi_add_permitted_file('mailSystem.php');
        
        $juassi_file_eventer_list = juassi_add_permitted_file('events.php');
        $juassi_file_eventer_images = juassi_add_permitted_file('images.php');
        $juassi_file_eventer_add_event = juassi_add_permitted_file('event-add.php');
        $juassi_file_eventer_options = juassi_add_permitted_file('options.php');
        $juassi_file_eventer_setting = juassi_add_permitted_file('admin.php');
        $juassi_file_eventer_edit_event = juassi_add_permitted_file('event-edit.php');
        $juassi_file_eventer_get_event = juassi_add_permitted_file('event-get.php');
        $juassi_file_eventer_config_event = juassi_add_permitted_file('event-config.php');
        $juassi_file_eventer_images_upload = juassi_add_permitted_file('uploader.php');
        $juassi_file_eventer_images_add = juassi_add_permitted_file('images-add.php');
        $juassi_file_eventer_images_edit = juassi_add_permitted_file('images-edit.php');
        $juassi_file_eventer_images_timthumb = juassi_add_permitted_file('timthumb.php');
        
        juassi_add_file_to_group($juassi_file_mail_inbox, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_trash, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_empty_trash, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_new_mail, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_view_mail, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_send_mail, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_reply_mail, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_mail_cancel_mail, $juassi_group_admin);
        
        juassi_add_file_to_group($juassi_file_eventer_list, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_images, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_add_event, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_options, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_setting, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_edit_event, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_get_event, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_config_event , $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_images_upload, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_images_add, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_images_edit, $juassi_group_admin);
        juassi_add_file_to_group($juassi_file_eventer_images_timthumb, $juassi_group_admin);
        
        $juassi_task_add_calendar_event = juassi_add_permitted_task('add_calendar_event');
        $juassi_task_edit_calendar_event = juassi_add_permitted_task('edit_calendar_event');
        
        juassi_add_task_to_group($juassi_task_add_calendar_event, $juassi_group_admin);
        juassi_add_task_to_group($juassi_task_edit_calendar_event, $juassi_group_admin);
        
        
        juassi_set_config('program_version', '2.2.1');
	juassi_set_config('database_version', '31');

}

function juassi_upgrade_version($new) {
	juassi_set_config('program_version', $new);
}

?>