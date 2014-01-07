<?php
include('includes/common.php');

if (!isset($_SESSION['pass']) || $_SESSION['pass'] == 1) {
	$juassi_page_title = 'Create Config';
	include('includes/header.php');
	?>
	
	<div id="content">
		<div class="container">
			<div class="min-height">
				<p>Por favor inicie el proceso de instalaci&oacute;n desde <a href="index.php">aqu&iacute;</a>.</p>
			</div>
		</div>
	</div>
	<?php
	include('includes/footer.php');
	exit;
}


$filename = '../privado/config.php';

if ($_SESSION['juassi_db_type'] == 'mysql') {
	$config_array['juassi_tb_prefix'] = $_SESSION['juassi_tb_prefix'];
	$config_array['juassi_db_type'] = $_SESSION['juassi_db_type'];
	$config_array['juassi_db_host'] = $_SESSION['juassi_db_host'];
	$config_array['juassi_db_name'] = $_SESSION['juassi_db_name'];
	$config_array['juassi_db_user'] = $_SESSION['juassi_db_user'];
	$config_array['juassi_db_pass'] = $_SESSION['juassi_db_pass'];
	$config_array['juassi_db_charset'] = 'UTF8';
	$config_data = juassi_create_mysql_config($config_array);

}
else {
	$config_array['juassi_tb_prefix'] = $_SESSION['juassi_tb_prefix'];
	$config_array['juassi_db_path_name'] = $_SESSION['juassi_db_path_name'];
	$config_array['juassi_db_type'] = $_SESSION['juassi_db_type'];
	$config_data = juassi_create_sqlite_config($config_array);
}









$juassi_tb_prefix = $_SESSION['juassi_tb_prefix'];

$juassi_db_type = $_SESSION['juassi_db_type'];
$juassi_db_host = $_SESSION['juassi_db_host'];
$juassi_db_name = $_SESSION['juassi_db_name'];
$juassi_db_user = $_SESSION['juassi_db_user'];
$juassi_db_pass = $_SESSION['juassi_db_pass'];
$juassi_rewrite = $_SESSION['juassi_rewrite'];
$juassi_db_path_name = $_SESSION['juassi_db_path_name'];
$juassi_db_charset = 'UTF8';

//start database connection here
if ($_SESSION['juassi_db_type'] == 'mysql' || $_SESSION['juassi_db_type'] == 'postgresql') {
	$juassi_db = new juassi_db($juassi_db_host, $juassi_db_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type, $juassi_db_charset);
}

else {
	$juassi_db = new juassi_db($juassi_db_host, $juassi_db_path_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type, $juassi_db_charset);
}

$juassi_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$juassi_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

$juassi_tb = new tables($juassi_tb_prefix);

/*

*/
function juassi_run_section_ref() {}

switch ($juassi_db_type) {

	case 'postgresql':
	case 'mysql':
		$query = "
		CREATE TABLE {$juassi_tb_prefix}site (
		config_name varchar(255) NOT NULL,
		config_value TEXT NOT NULL,
		PRIMARY KEY  (config_name)
		) DEFAULT CHARSET=utf8;
		";

		try {
		$juassi_db->exec($query);
		}
		catch (Exception $e) {
		juassi_die($e->getMessage());
		}

		$query = "
		CREATE TABLE {$juassi_tb_prefix}users (
		user_id int(11) unsigned NOT NULL auto_increment,
		user_name varchar(255) NOT NULL,
		password varchar(255) NOT NULL,
		active int(1) NOT NULL default 0,
		joined datetime NOT NULL default '0000-00-00 00:00:00',
		display_name varchar(255) NOT NULL,
		email varchar(255) NOT NULL,
		website varchar(255),
		active_key varchar(32),
		contact int(1) NOT NULL default 0,
		gui_editor int(1) NOT NULL default 1,
		group_id int(11) unsigned NOT NULL,
		PRIMARY KEY  (user_id)
		) DEFAULT CHARSET=utf8;
		";

		try {
			$juassi_db->exec($query);
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

$query = "
CREATE TABLE {$juassi_tb_prefix}sessions (
		session_id varchar(32) NOT NULL default '',
		session_start datetime NOT NULL,
		session_start_utc datetime NOT NULL,
		session_expire datetime NOT NULL,
		session_expire_utc datetime NOT NULL,
		session_data TEXT,
		session_active_key varchar(32),
		PRIMARY KEY  (session_id)
) DEFAULT CHARSET=utf8;
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}posts (
post_id int(11) unsigned NOT NULL auto_increment,
user_id int(11) unsigned NOT NULL,
post_date datetime NOT NULL,
post_date_utc datetime NOT NULL,
post_title varchar(255) NOT NULL,
post_body TEXT NOT NULL,
post_type varchar(255) NOT NULL default 'published',
post_x_title varchar(255) NOT NULL,
post_comments int(1) NOT NULL default 1,
post_external_comments int(1) NOT NULL default 1,
KEY post_date_utc (post_date_utc),
KEY post_type (post_type),
PRIMARY KEY  (post_id)
) DEFAULT CHARSET=utf8;
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}


$query = "
CREATE TABLE {$juassi_tb_prefix}categories (
category_id int(11) unsigned NOT NULL auto_increment,
x_name varchar(255) NOT NULL,
name varchar(255) NOT NULL,
lft int(11) NOT NULL,
rgt int(11) NOT NULL,
PRIMARY KEY  (category_id),
KEY lft (lft),
KEY rgt (rgt)
) DEFAULT CHARSET=utf8;
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}posts_to_categories (
posts_to_categories_id int(11) unsigned NOT NULL auto_increment,
category_id int(11) unsigned NOT NULL,
post_id int(11) unsigned NOT NULL,
PRIMARY KEY  (posts_to_categories_id),
KEY category_id (category_id),
KEY post_id (post_id)
) DEFAULT CHARSET=utf8;
";
try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}comments (
comment_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
user_id INT(11) UNSIGNED,
comment_date datetime NOT NULL,
comment_date_utc datetime NOT NULL,
comment_display_name VARCHAR( 255 ) NOT NULL,
comment_email VARCHAR(255) NOT NULL,
comment_website VARCHAR(255) NOT NULL,
comment_title VARCHAR(255),
comment_body TEXT NOT NULL,
comment_allow_contact_form INT(1) NOT NULL,
post_id INT(11) UNSIGNED NOT NULL,
comment_spam_score INT NOT NULL,
comment_akismet_spam INT NOT NULL,
comment_approved INT(1) NOT NULL DEFAULT '0',
comment_ip_address varchar(39) NOT NULL default '',
comment_trackback INT(1) NOT NULL DEFAULT '0',
comment_pingback INT(1) NOT NULL DEFAULT '0',
comment_active_key VARCHAR(32),
comment_notify INT(1) NOT NULL DEFAULT '0',
comment_parent INT(11) UNSIGNED,
PRIMARY KEY  (comment_id)
) DEFAULT CHARSET=utf8;
";
try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}groups (
group_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
group_name varchar(255) NOT NULL,
PRIMARY KEY  (group_id)
) DEFAULT CHARSET=utf8;
";

try {
	$juassi_db->exec($query);
}
catch (Exception $e) {
	juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}file_permissions (
file_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
file_name varchar(255) NOT NULL,
PRIMARY KEY  (file_id)
) DEFAULT CHARSET=utf8;
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}files_to_groups (
		group_file_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		group_id INT(11) UNSIGNED NOT NULL,
		file_id INT(11) UNSIGNED NOT NULL,
		PRIMARY KEY  (group_file_id)
		) DEFAULT CHARSET=utf8;
		";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}task_permissions (
task_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
task_name varchar(255) NOT NULL,
task_description TEXT,
PRIMARY KEY  (task_id)
) DEFAULT CHARSET=utf8;
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}tasks_to_groups (
		group_task_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		group_id INT(11) UNSIGNED NOT NULL,
		task_id INT(11) UNSIGNED NOT NULL,
		PRIMARY KEY  (group_task_id)
		) DEFAULT CHARSET=utf8;
		";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}link_categories (
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
		CREATE TABLE {$juassi_tb_prefix}links (
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

$query = "
	CREATE TABLE {$juassi_tb_prefix}soap_clients (
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
CREATE TABLE `{$juassi_tb_prefix}sites` (
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

$table_create =	"
CREATE TABLE `{$juassi_tb_prefix}events` (
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
break;

case 'sqlite':

$query = "
CREATE TABLE {$juassi_tb_prefix}site (
config_name varchar(255) NOT NULL,
config_value varchar(255) NOT NULL,
PRIMARY KEY  (config_name)
);";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}


$query = "
CREATE TABLE {$juassi_tb_prefix}users (
user_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
user_name varchar(255) NOT NULL,
password varchar(255) NOT NULL,
active INTEGER NOT NULL default 0,
joined datetime NOT NULL default '0000-00-00 00:00:00',
display_name varchar(255) NOT NULL,
		email varchar(255) NOT NULL,
		website varchar(255),
		active_key varchar(32),
		contact INTEGER NOT NULL default 0,
		gui_editor INTEGER NOT NULL default 1,
		group_id INTEGER NOT NULL
		);
		";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}sessions (
		session_id varchar(32) PRIMARY KEY NOT NULL default '',
		session_start datetime NOT NULL,
		session_start_utc datetime NOT NULL,
		session_expire datetime NOT NULL,
		session_expire_utc datetime NOT NULL,
		session_data TEXT,
		session_active_key varchar(32)
		);
		";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}
$query = "
CREATE TABLE {$juassi_tb_prefix}posts (
post_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
user_id int(11) NOT NULL,
post_date DATETIME NOT NULL,
post_date_utc DATETIME NOT NULL,
post_title varchar(255) NOT NULL,
post_body TEXT NOT NULL,
post_type varchar(255) NOT NULL default 'published',
			post_x_title varchar(255) NOT NULL,
			post_comments int(1) NOT NULL default 1,
			post_external_comments int(1) NOT NULL default 1
			);
			";

			try {
			$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}categories (
category_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
x_name varchar(255) NOT NULL,
name varchar(255) NOT NULL,
lft INTEGER NOT NULL,
rgt INTEGER NOT NULL
		);
		";

		try {
		$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}posts_to_categories (
posts_to_categories_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
category_id INTEGER NOT NULL,
post_id INTEGER NOT NULL
);
";
try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}comments (
comment_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
user_id INTEGER UNSIGNED,
comment_date datetime NOT NULL,
comment_date_utc datetime NOT NULL,
comment_display_name VARCHAR( 255 ) NOT NULL,
		comment_email VARCHAR(255) NOT NULL,
		comment_website VARCHAR(255) NOT NULL,
		comment_title VARCHAR(255),
		comment_body TEXT NOT NULL,
		comment_allow_contact_form SMALLINT UNSIGNED NOT NULL,
		post_id INTEGER UNSIGNED NOT NULL,
		comment_spam_score SMALLINT UNSIGNED NOT NULL,
		comment_akismet_spam SMALLINT UNSIGNED NOT NULL,
		comment_approved SMALLINT UNSIGNED NOT NULL DEFAULT '0',
		comment_trackback SMALLINT UNSIGNED NOT NULL DEFAULT '0',
		comment_pingback SMALLINT UNSIGNED NOT NULL DEFAULT '0',
		comment_notify SMALLINT UNSIGNED NOT NULL DEFAULT '0',
		comment_parent INTEGER UNSIGNED,
		comment_active_key VARCHAR(32),
		comment_ip_address varchar(39) NOT NULL
);
";
try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}groups (
group_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
group_name varchar(255) NOT NULL
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}file_permissions (
file_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
file_name varchar(255) NOT NULL
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}files_to_groups (
group_file_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
group_id INTEGER UNSIGNED NOT NULL,
file_id INTEGER UNSIGNED NOT NULL
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}task_permissions (
task_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
task_name varchar(255) NOT NULL,
	task_description TEXT
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}tasks_to_groups (
group_task_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
group_id INTEGER UNSIGNED NOT NULL,
task_id INTEGER UNSIGNED NOT NULL
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}link_categories (
category_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
description TEXT NOT NULL,
text_before_all varchar(255) NOT NULL default '',
text_after_all varchar(255) NOT NULL default '',
text_after varchar(255) NOT NULL default '',
category_name varchar(255) NOT NULL default ''
);
";

try {
$juassi_db->exec($query);
}
catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
	CREATE TABLE {$juassi_tb_prefix}links (
			link_url TEXT NOT NULL,
			link_name varchar(255) NOT NULL default '',
			category_id INTEGER UNSIGNED NOT NULL default '0',
			link_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
			link_order INTEGER NOT NULL DEFAULT '0'
	);
	";

	try {
	$juassi_db->exec($query);
	}
	catch (Exception $e) {
juassi_die($e->getMessage());
}

$query = "
CREATE TABLE {$juassi_tb_prefix}soap_clients (
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
CREATE TABLE `{$juassi_tb_prefix}sites` (
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
CREATE TABLE `{$juassi_tb_prefix}events` (
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

default:
juassi_die();
}

//post_type enum('published', 'draft', 'future', 'static') NOT NULL default 'published',

juassi_add_config('port_number', $_SESSION['juassi_site_port']);
juassi_add_config('https', 0);
juassi_add_config('domain', $_SESSION['juassi_site_domain']);
juassi_add_config('cookie_name', 'juassi_cookie');
juassi_add_config('database_version', 30);
juassi_add_config('program_version', '2.0');
juassi_add_config('script_path', $_SESSION['juassi_site_script_path']);
juassi_add_config('current_theme', 'classic');
juassi_add_config('name', $_SESSION['juassi_site_name']);
juassi_add_config('comments', 1);

//you can ignore the rewrite comments as it is now already taken care of in the installer
if ($juassi_rewrite) {

if ($juassi_db_type == 'mysql') {
/*
Use this line instead of the one below if you don't have mod_rewrite
bt_add_config('post_permalink_format', '/?bt_id=%post_id%');
If you're an IIS user you'll need to use the following
bt_add_config('post_permalink_format', '/index.php?bt_id=%post_id%');
*/
juassi_add_config('post_permalink_format', '/archive/%year%/%month%/%day%/%x_title%/');

/*
Use this line instead of the one below if you don't have mod_rewrite
bt_add_config('category_permalink_format', '/?bt_category=%x_title%');
*/
juassi_add_config('category_permalink_format', '/category/%x_title%/');

/*
Use this line instead of the one below if you don't have mod_rewrite
bt_add_config('content_permalink_format', '/?bt_type=cms&amp;?bt_x_title=%x_title%');
		*/
		juassi_add_config('content_permalink_format', '/page/%x_title%/');
}
else {
juassi_add_config('post_permalink_format', '/archive/%post_id%/%x_title%/');
		juassi_add_config('category_permalink_format', '/category/%x_title%/');
		juassi_add_config('content_permalink_format', '/page/%x_title%/');
	}
}
else {
juassi_add_config('post_permalink_format', '/?juassi_id=%post_id%');
	juassi_add_config('category_permalink_format', '/?juassi_category=%x_title%');
	juassi_add_config('content_permalink_format', '/?juassi_type=cms&amp;?juassi_x_title=%x_title%');
}
juassi_add_config('plugin_data', array('contact_form'));
juassi_add_config('plugin_update_data', array(''));
	juassi_add_config('rss', '0');
juassi_add_config('themes', '1');
juassi_add_config('time_zone', '+10');
juassi_add_config('next_cron_run', '0000-00-00 00:00:00');
juassi_add_config('last_update_response', '');
	juassi_add_config('installed', juassi_datetime());
juassi_add_config('description', $_SESSION['juassi_site_description']);
	juassi_add_config('limit_posts', '10');

$cron_intervals = array(
	array('name' => 'every_hour', 'description' => 'Every Hour', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '3600'),
			array('name' => 'every_day', 'description' => 'Every Day', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '86400'),
array('name' => 'every_week', 'description' => 'Every Week', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '604800'),
				array('name' => 'every_month', 'description' => 'Every Month', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '2592000'),
				);

juassi_add_config('cron_intervals', $cron_intervals);
//0.13
juassi_add_config('akismet', '0');
juassi_add_config('akismet_api_key', '');
juassi_add_config('akismet_delete_trackbacks', '0');
juassi_add_config('upload_path', '');

//0.15
juassi_add_config('akismet_weighting', '75');
juassi_add_config('spam_block_weighting', '25');
juassi_add_config('user_commented_before_weighting', '75');
juassi_add_config('tag_spam_score', '75');
juassi_add_config('max_spam_score', '150');

//0.17
juassi_add_config('spam_level', '1');

//0.18
juassi_add_config('contact_user_id', '0');

//0.19
juassi_add_config('trackbacks', '0');

//0.22 (need a way for plugins to easily do database upgrades etc)
	juassi_add_config('cf_akismet_delete_spam', '0');
	juassi_add_config('cf_require_valid_email', '0');

//0.27
juassi_add_config('soap_server', '0');
juassi_add_config('soap_server_id', '0');
juassi_add_config('allow_register', '0');
juassi_add_config('default_group_id', '0');
juassi_add_config('user_activation', '0');

//0.28
juassi_add_config('default_content_type', 'blog');
juassi_add_config('default_content_id', '');

//0.29
juassi_add_config('soap_server_ssl_only', '0');

//0.30
juassi_add_config('smtp_client', '0');
juassi_add_config('smtp_auth', '0');
juassi_add_config('smtp_username', '');
juassi_add_config('smtp_password', '');
juassi_add_config('smtp_server', '');

//
$juassi_log = new juassi_log();
/*
Setup some new categories
*/
/*
$juassi_post_categories = new juassi_categories($juassi_tb_prefix . 'categories');
$root = $juassi_post_categories->new_root('Posts');
$juassi_post_categories->new_first_child($root, 'Uncategorised');
$juassi_post_categories->new_first_child($root, 'General');
$juassi_post_categories->new_first_child($juassi_post_categories->root(), 'Empty');
$juassi_post_categories->new_first_child($juassi_post_categories->get_node('General', 'name'), 'News');
$juassi_post_categories->new_first_child($juassi_post_categories->get_node('News', 'name'), 'World');
$juassi_post_categories->new_first_child($juassi_post_categories->get_node('News', 'name'), 'Australia');
$juassi_post_categories->new_first_child($juassi_post_categories->get_node('News', 'name'), 'New Zealand');
*/

//create event here

//add groups
$juassi_group_admin = juassi_add_group('Admin');
$juassi_group_guest = juassi_add_group('Guest');
$juassi_group_subscriber = juassi_add_group('Subscriber');

/*
		File based permissions
		*/

//add files
$juassi_file_event_viewer = juassi_add_permitted_file('event-viewer.php');
$juassi_file_index = juassi_add_permitted_file('index.php');
$juassi_file_post = juassi_add_permitted_file('post.php');
$juassi_file_plugins = juassi_add_permitted_file('plugins.php');
$juassi_file_event = juassi_add_permitted_file('event.php');
$juassi_file_edit = juassi_add_permitted_file('edit.php');
$juassi_file_comments = juassi_add_permitted_file('comments.php');
$juassi_file_your_comments = juassi_add_permitted_file('your-comments.php');
$juassi_file_personal_settings = juassi_add_permitted_file('personal-settings.php');
$juassi_file_general_settings = juassi_add_permitted_file('general-settings.php');
$juassi_file_config = juassi_add_permitted_file('config.php');
$juassi_file_file_upload = juassi_add_permitted_file('file-upload.php');
$juassi_file_plugin = juassi_add_permitted_file('plugin.php');
$juassi_file_spam_settings = juassi_add_permitted_file('spam-settings.php');
$juassi_file_user_admin = juassi_add_permitted_file('user-admin.php');
$juassi_file_categories = juassi_add_permitted_file('categories.php');
$juassi_file_comments_moderation = juassi_add_permitted_file('comments-moderation.php');
$juassi_file_upgrade = juassi_add_permitted_file('upgrade.php');
$juassi_file_edit_post = juassi_add_permitted_file('edit-post.php');
$juassi_file_add_content = juassi_add_permitted_file('add-content.php');
$juassi_file_edit_content = juassi_add_permitted_file('edit-content.php');

//0.4
$juassi_file_link_settings = juassi_add_permitted_file('link-settings.php');
$juassi_file_theme_settings = juassi_add_permitted_file('theme-settings.php');
$juassi_file_group_admin = juassi_add_permitted_file('group-admin.php');

//0.6
$juassi_file_user_profile = juassi_add_permitted_file('user-profile.php');
juassi_add_file_to_group($juassi_file_user_profile, $juassi_group_admin);

//0.9
$juassi_file_delete_post = juassi_add_permitted_file('delete-post.php');

//0.11
$juassi_file_edit_content_page = juassi_add_permitted_file('edit-content-page.php');
$juassi_file_delete_content = juassi_add_permitted_file('delete-content.php');

//0.13
$juassi_file_edit_comment = juassi_add_permitted_file('edit-comment.php');
$juassi_file_permalink_settings = juassi_add_permitted_file('permalink-settings.php');

//0.16
$juassi_file_delete_comment = juassi_add_permitted_file('delete-comment.php');
$juassi_file_approve_comment = juassi_add_permitted_file('approve-comment.php');

//0.23
$juassi_file_edit_link = juassi_add_permitted_file('edit-link.php');
$juassi_file_maintenance = juassi_add_permitted_file('maintenance.php');

//0.24
$juassi_file_order_links = juassi_add_permitted_file('order-links.php');

//0.25
$juassi_file_edit_link_category = juassi_add_permitted_file('edit-link-category.php');
$juassi_file_delete_link_category = juassi_add_permitted_file('delete-link-category.php');

//0.27
$juassi_file_soap_server_settings = juassi_add_permitted_file('soap-server-settings.php');
$juassi_file_soap_client_settings = juassi_add_permitted_file('soap-client-settings.php');
$juassi_file_soap_add_site = juassi_add_permitted_file('soap-add-site.php');
$juassi_file_soap_edit_site = juassi_add_permitted_file('soap-edit-site.php');
$juassi_file_soap_task = juassi_add_permitted_file('soap-tasks.php');

//0.28
$juassi_file_delete_category = juassi_add_permitted_file('delete-category.php');


//admin files
juassi_add_file_to_group($juassi_file_event_viewer, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_index, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_post, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_plugins, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_event, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_edit, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_comments, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_your_comments, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_personal_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_general_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_config, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_file_upload, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_plugin, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_spam_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_user_admin, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_categories, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_comments_moderation, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_upgrade, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_edit_post, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_add_content, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_edit_content, $juassi_group_admin);

//0.4
juassi_add_file_to_group($juassi_file_link_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_theme_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_group_admin, $juassi_group_admin);

//0.6
juassi_add_file_to_group($juassi_file_user_profile, $juassi_group_admin);

//0.9
juassi_add_file_to_group($juassi_file_delete_post, $juassi_group_admin);

//0.11
juassi_add_file_to_group($juassi_file_edit_content_page, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_delete_content, $juassi_group_admin);

//0.13
juassi_add_file_to_group($juassi_file_edit_comment, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_permalink_settings, $juassi_group_admin);

//0.16
juassi_add_file_to_group($juassi_file_delete_comment, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_approve_comment, $juassi_group_admin);

//0.23
juassi_add_file_to_group($juassi_file_edit_link, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_maintenance, $juassi_group_admin);

//0.24
juassi_add_file_to_group($juassi_file_order_links, $juassi_group_admin);

//0.25
juassi_add_file_to_group($juassi_file_edit_link_category, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_delete_link_category, $juassi_group_admin);

//0.27
juassi_add_file_to_group($juassi_file_soap_server_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_soap_client_settings, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_soap_add_site, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_soap_edit_site, $juassi_group_admin);
juassi_add_file_to_group($juassi_file_soap_task, $juassi_group_admin);

//0.28
juassi_add_file_to_group($juassi_file_delete_category, $juassi_group_admin);

//guest files
//juassi_add_file_to_group($juassi_file_index, $juassi_group_guest);

//subscriber files
juassi_add_file_to_group($juassi_file_index, $juassi_group_subscriber);
juassi_add_file_to_group($juassi_file_personal_settings, $juassi_group_subscriber);
juassi_add_file_to_group($juassi_file_your_comments, $juassi_group_subscriber);

/*
Task based permissions
*/

//add tasks
$juassi_task_recent_events = juassi_add_permitted_task('recent_events');
$juassi_task_edit_posts = juassi_add_permitted_task('edit_posts');
$juassi_task_clear_logs = juassi_add_permitted_task('clear_logs');

//0.14
$juassi_task_edit_comments = juassi_add_permitted_task('edit_comments');

//0.20
$juassi_task_edit_content = juassi_add_permitted_task('edit_content');

//0.24
$juassi_task_delete_users = juassi_add_permitted_task('delete_users');
$juassi_task_clear = juassi_add_permitted_task('clear_moderation_queue');

//0.25
$juassi_delete_link_categories = juassi_add_permitted_task('delete_link_categories');

//0.27
$juassi_task_send_remote_events = juassi_add_permitted_task('send_remote_events');

//0.28
$juassi_task_delete_categories = juassi_add_permitted_task('delete_categories');

//admin tasks
juassi_add_task_to_group($juassi_task_recent_events, $juassi_group_admin);
juassi_add_task_to_group($juassi_task_edit_posts, $juassi_group_admin);
juassi_add_task_to_group($juassi_task_clear_logs, $juassi_group_admin);

//0.14
juassi_add_task_to_group($juassi_task_edit_comments, $juassi_group_admin);

//0.20
juassi_add_task_to_group($juassi_task_edit_content, $juassi_group_admin);

//0.24
juassi_add_task_to_group($juassi_task_clear, $juassi_group_admin);
juassi_add_task_to_group($juassi_task_delete_users, $juassi_group_admin);

//0.25
juassi_add_task_to_group($juassi_delete_link_categories, $juassi_group_admin);

//0.27
juassi_add_task_to_group($juassi_task_send_remote_events, $juassi_group_admin);

//0.28
juassi_add_task_to_group($juassi_task_delete_categories, $juassi_group_admin);

/*
Add User (Admin)
*/
$juassi_users = new juassi_users();

$user_array['user_name'] = $_SESSION['user_name'];
$user_array['password'] = $_SESSION['password'];
$user_array['active'] = '1';
$user_array['joined'] = juassi_datetime();
$user_array['display_name'] = $_SESSION['display_name'];
$user_array['email'] = $_SESSION['email'];
$user_array['gui_editor'] = '1';
$user_array['group_id'] = '1';
$user_array['website'] = '';
$user_array['active_key'] = '1';

$juassi_users->add_user($user_array);

/*
Add First Post
*/
$juassi_posts = new juassi_posts();

$post_title = 'Juassi 2';
$post_body = 'Welcome to Juassi 2.<br />Please read the readme.txt for the latest information and help.';

$post_array['user_id'] = 1;
$post_array['post_date'] = juassi_datetime();
$post_array['post_date_utc'] = juassi_datetime_utc();
$post_array['post_title'] = $post_title;
$post_array['post_body'] = $post_body;
$post_array['post_type'] = 'published';
$post_array['post_x_title'] = juassi_x_title($post_title);
$post_array['post_comments'] = 0;
$post_array['post_external_comments'] = 0;

$post_id = $juassi_posts->add_post($post_array);
$category_id = $juassi_posts->get_category_id('General', 'name');
$juassi_posts->add_category_to_post($post_id, $category_id);
//trigger_error('Juassi ' . juassi_get_config('program_version') . ' Instalaci&oacute;n exitosa.', E_USER_NOTICE);
//









if (juassi_write_config($filename, $config_data)) {
include 'includes/header.php';	
?>
<!-- 
<div id="teaser">
	<div class="container">
		<h1>
			Asistente para la instalaci&oacute;n  
		</h1>
		<div id="progress-bar">
			<div class="configuration">
				<div class="finish">
					<p>progreso</p>
				</div>
				<div class="bar-steps-text">
					<p class="configuration"> Y eso es todo!</p>
				</div>
				<div class="bar-steps-count"></div>
			</div>
		</div>
	</div>
</div>
 -->
<div id="teaser">
	<div class="container">
		<h1>
			Asistente para la instalaci&oacute;n  
		</h1>
		<div id="progress-bar">
			<div class="configuration">
				<div class="bar-label">
					<p>progreso</p>
					<div class="arrow"></div>
				</div>
				<div class="bar-steps-text">
					<p class="finish"> Y eso es todo!</p>
				</div>
				<div class="bar-steps-count"></div>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="span4">
				<h3>Registros de instalaci&oacute;n</h3>
						<p>Tu puedes tambien descargar el contenido de este archivo. Puedes verlo ahora en la caja de texto abajo haciendo
					<a href="javascript:void(0);" onclick="if (document.getElementById('file_content').style.display=='block') { document.getElementById('file_content').style.display='none';} else {document.getElementById('file_content').style.display='block'}">click aqu&iacute;</a>.</p>
						<p><strong>Muchas gracias por seleccionar juassi-Blog.</strong></p>
			</div>
			<div class="span8">
				<div class="well">
					<div>
						<h4>Instalaci&oacute;n Base de Datos</h4>
						<div class="alert alert-success">OK</div>
					</div>
					<div>
						<h4>Archivo de configuraci&oacute;n</h4>
					<div class="alert alert-success"><?php echo juassi_admin_message('El archivo de configuraci&oacute;n ha sido creado.');?></div>
						<form>
							<textarea style="width: 100%; height: 200px;"><?php echo $config_data; ?></textarea>
							<input type="hidden" value="<?php echo $config_data; ?>" name="config_content" />
							<button type="submit" class="btn btn-success btn-plain"><i class="icon-download-alt icon-white"></i> Descargar archivo config</button>
						</form>
					</div>
					<div>
						<h4>Carpeta de instalaci&oacute;n</h4>
						<div class="alert alert-message">Para propositos de seguridad, le recomendamos que una vez terminada la instalaci&oacute;n remueva el directorio<em style="white-space: nowrap;">/juassi-install</em>.</div>
					</div>
				</div>
			</div>
		</div>

		<div style="display: none; 'margin: auto; border: 1px solid #777; background-color: #ededed; padding:10px;overflow:auto;width:650px;" id="file_content" class="well">
			<code><span style="color: #000000">
				<span style="color: #0000BB">&lt;?php<br /></span><span style="color: #FF8000">/*<br />&nbsp;*&nbsp;Juassi&nbsp;Open&nbsp;Source&nbsp;Blog&nbsp;2.0<br />&nbsp;*&nbsp;Config&nbsp;file&nbsp;generated&nbsp;on&nbsp;18&nbsp;July&nbsp;2013&nbsp;05:32:23<br />&nbsp;*/<br /><br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_CONNECT'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'mysql'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBHOST'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'localhost'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBNAME'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'tickets'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBUSER'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'tickets'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBPASS'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'6662115JcRc'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBPORT'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'3306'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DBPREFIX'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'cb2_'</span><span style="color: #007700">);<br /><br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_MYSQLVER'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'41'</span><span style="color: #007700">);<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_SALT'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">'#B8471764F2'</span><span style="color: #007700">);<br /><br /></span><span style="color: #FF8000">//&nbsp;debug&nbsp;mode:&nbsp;0&nbsp;-&nbsp;disabled,&nbsp;1&nbsp;-&nbsp;enabled<br /></span><span style="color: #0000BB">define</span><span style="color: #007700">(</span><span style="color: #DD0000">'JUASSI_DEBUG'</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">0</span><span style="color: #007700">);</span>
				</span>
			</code>
		</div>

<div class="form-actions">
<a href="admin-account.php" class="btn btn-large"><i class="icon-arrow-left"></i> Atr&aacute;s</a>
<a href="#" class="btn btn-large btn-info"><i class="icon-download icon-white"></i> Instalar Plugins</a>
<a href="../admin" class="btn btn-large btn-primary"><i class="icon-cog icon-white"></i> al Admin</a>
<a href="../" class="btn btn-large btn-primary"><i class="icon-home icon-white"></i> al Inicio</a>
</div>
</div>
</div>
<?php 
}
include 'includes/footer.php';
?>
