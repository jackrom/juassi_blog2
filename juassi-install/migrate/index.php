<?php
set_time_limit(300);
/*
	Juassi 2.0
	Convert a Juassi 1 database to Juassi 2
*/

/*
Juassi 1 database settings
*/
$juassi1_db_host = $_SERVER['HTTP_HOST']; //often localhost
$juassi1_db_name = ''; //the name of your database
$juassi1_db_username = ''; //the username used to log into your database
$juassi1_db_password = ''; //the password used to log into your database
$juassi1_bt_id = 1; //blog id
$juassi1_table_prefix = 'jb1_';
$juassi1_admin_user_id = 1; //the user_id of the user who should be the admin in Bluetrait 2

/*
Juassi-blog 2 database settings
*/
$juassi2_db_host = $_SERVER['HTTP_HOST'];
$juassi2_db_name = '';
$juassi2_db_username = '';
$juassi2_db_password = '';
$juassi2_db_charset = 'UTF8';
$juassi2_table_prefix = 'jb2_';

/*
YOU CAN STOP EDITING HERE :)
*/

function juassi_htmlentities($string) {

	return htmlentities($string, ENT_QUOTES, 'utf-8');
}

/*
Connect to Juassi 1 database
*/
$juassi1_db = mysql_connect($juassi1_db_host, $juassi1_db_username, $juassi1_db_password, TRUE) or die('Cannot connect to Juassi 1 database server.');
mysql_select_db($juassi1_db_name, $juassi1_db) or die('Cannot select Juassi 1 database.');

/*
Connect to Juassi 2 database
*/
$juassi2_db = mysql_connect($juassi2_db_host, $juassi2_db_username, $juassi2_db_password, TRUE) or die('Cannot connect to Juassi 2 database server.');
mysql_select_db($juassi2_db_name, $juassi2_db) or die('Cannot select Juassi 2 database.');

/*
Set Juassi 2 charset
*/
mysql_query("SET NAMES $juassi2_db_charset", $juassi2_db);

/*
Check the Bluetrait 1 tables exist
*/
$query = 'SHOW TABLES';
$result = mysql_query($query, $juassi1_db);

$table_array = array();
while($row = mysql_fetch_array($result)) {
		$table_array[] = $row["Tables_in_{$juassi1_db_name}"];
}

/*
echo '<pre>';
print_r($table_array);
echo '</pre>';
*/

$tables_required = array(
	'comments',
	'content',
	'events',
	'link_categories',
	'links',
	'posts',
	'site',
	'users'
	);
foreach ($tables_required as $index => $value) {
	if (!in_array($juassi1_table_prefix . $value, $table_array)) {
		die('Cannot find all Juassi 1 tables.');
	}
}

/*
Get Juassi 1 site settings
*/

$query = "SELECT config_name, config_value FROM {$juassi1_table_prefix}site WHERE blog_id = $juassi1_id";
$result = mysql_query($query, $juassi1_db);

$juassi1_config = array();

while($row = mysql_fetch_array($result)){
	$juassi1_config[$row['config_name']] = $row['config_value'];
}
//echo '<pre>';
//print_r($bt1_config);
//echo '</pre>';

$supported_versions = array(
			'1.2.5',
			'1.2.6'
			);

if (!in_array($juassi1_config['version'], $supported_versions)) {
	die("You can only migrate a database from Juassi 1.2.5 or higher; you're running " . juassi_htmlentities($juassi1_config['version']) . '. You can get it <a href="http://www.juassi.com/weblog/page/download-archive/">here</a>.');
}

//create the Bluetrait 2 config
$juassi2_config = array();

$juassi2_config['name'] = $juassi1_config['name'];
$juassi2_config['description'] = $juassi1_config['description'];
$juassi2_config['domain'] = $juassi1_config['domain'];
$juassi2_config['script_path'] = $juassi1_config['script_path'];
$juassi2_config['port_number'] = $juassi1_config['port_number'];
$juassi2_config['cookie_name'] = $juassi1_config['cookie_name'];
$juassi2_config['comments'] = $juassi1_config['comments'];
$juassi2_config['rss'] = $juassi1_config['rss'];
$juassi2_config['time_zone'] = $juassi1_config['time_zone'];
$juassi2_config['installed'] = $juassi1_config['installed'];

//0.8
$juassi2_config['limit_posts'] = $juassi1_config['limit_posts'];

//0.18
$juassi2_config['contact_user_id'] = $juassi1_config['contact_user_id'];

/*
New Stuff
*/
$juassi2_config['https'] = 0;
$juassi2_config['database_version'] = 26;
$juassi2_config['program_version'] = '2.0.0';
$juassi2_config['current_theme'] = 'classic';
$juassi2_config['themes'] = 1;
$juassi2_config['migrated'] = 1;
$juassi2_config['migrated_version'] = 'Bluetrait/' . $jb1_config['version'];

//0.13
$juassi2_config['akismet'] = '0';
$juassi2_config['akismet_api_key'] = '';
$juassi2_config['akismet_delete_trackbacks'] = '0';
$juassi2_config['upload_path'] =  '';

//0.15
$juassi2_config['akismet_weighting'] = '75';
$juassi2_config['spam_block_weighting'] = '25';
$juassi2_config['user_commented_before_weighting'] = '75';
$juassi2_config['tag_spam_score'] = '75';
$juassi2_config['max_spam_score'] = '150';

//0.17
$juassi2_config['spam_level'] = '1';

//0.18
$juassi2_config['contact_user_id'] = '0';

//0.19
$juassi2_config['trackbacks'] = '0';

//0.22
$juassi2_config['cf_akismet_delete_spam'] = '0';
$juassi2_config['cf_require_valid_email'] = '0';




if ($juassi1_config['rewrite'] == 1) {
	$juassi2_config['post_permalink_format'] = '/' . $juassi1_config['archive_address'] . '/%year%/%month%/%day%/%x_title%/';
	$juassi2_config['category_permalink_format'] = '/category/%x_title%/';
	//0.10
	$juassi2_config['content_permalink_format'] = '/page/%x_title%/';
}
else {
	$juassi2_config['post_permalink_format'] = '/?juassi_id=%post_id%';
	$juassi2_config['category_permalink_format'] = '/?juassi_category=%x_title%';
	//0.10
	$juassi2_config['content_permalink_format'] = '/?juassi_type=cms&amp;?juassi_x_title=%x_title%';
}

$juassi2_config['plugin_data'] = serialize(array('contact_form'));

$juassi2_config['next_cron_run'] = '0000-00-00 00:00:00';

$juassi2_config['last_update_response'] = '';

$cron_intervals = array(
				array('name' => 'every_hour', 'description' => 'Every Hour', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '3600'),
				array('name' => 'every_day', 'description' => 'Every Day', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '86400'),
				array('name' => 'every_week', 'description' => 'Every Week', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '604800'),
				array('name' => 'every_month', 'description' => 'Every Month', 'next_run' => '0000-00-00 00:00:00', 'frequency' => '2592000'),
				);
$juassi2_config['cron_intervals'] = serialize($cron_intervals);

//echo '<pre>';
//print_r($bt2_config);
//echo '</pre>';

/*
Config
*/

$query = "TRUNCATE TABLE {$juassi2_table_prefix}site";
$result = mysql_query($query, $juassi2_db);

echo '<p><strong>Adding Config.</strong></p>';

foreach($juassi2_config as $config_name => $config_value){
	$config_name = mysql_real_escape_string($config_name);
	$config_value = mysql_real_escape_string($config_value);
	$query = "INSERT INTO {$juassi2_table_prefix}site (config_name, config_value) values ('$config_name' , '$config_value')";
	$config_result = mysql_query($query, $juassi2_db);
}
echo '<p><strong>Added Config.</strong></p>';

/*
Users
*/

$query = "TRUNCATE TABLE {$juassi2_table_prefix}users";
$result = mysql_query($query, $juassi2_db);

$query = "SELECT * FROM {$juassi1_table_prefix}users WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Users.</strong></p>';

while($row = mysql_fetch_array($result)){
	$user_id = mysql_real_escape_string($row['user_id']);
	$user_name = mysql_real_escape_string($row['user_name']);
	$password = mysql_real_escape_string($row['password']);
	$active = mysql_real_escape_string($row['active']);
	$joined = mysql_real_escape_string($row['joined']);
	$display_name = mysql_real_escape_string($row['display_name']);
	$email = mysql_real_escape_string($row['email']);
	$website = mysql_real_escape_string($row['website']);
	$active_key = mysql_real_escape_string($row['active_key']);
	$contact = mysql_real_escape_string($row['contact']);
	$gui_editor = mysql_real_escape_string($row['gui_editor']);
	if ($user_id == $bt1_admin_user_id) {
		$group_id = 1;
	}
	else {
		$group_id = 0;
	}


	$query = "INSERT INTO {$juassi2_table_prefix}users
	(user_id, user_name, password, active, joined, display_name, email, website, active_key, contact, gui_editor, group_id)
	VALUES
	('$user_id', '$user_name', '$password', '$active', '$joined', '$display_name', '$email', '$website', '$active_key', '$contact', '$gui_editor', '$group_id')";
	$user_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Users.</strong></p>';

/*
Posts
*/

$query = "TRUNCATE TABLE {$juassi2_table_prefix}posts";
$result = mysql_query($query, $juassi2_db);

$query = "SELECT * FROM {$juassi1_table_prefix}posts WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, juassit1_db);

echo '<p><strong>Adding Posts.</strong></p>';

while($row = mysql_fetch_array($result)){
	$user_id = mysql_real_escape_string($row['user_id']);
	$post_id = mysql_real_escape_string($row['post_id']);
	$post_date = mysql_real_escape_string($row['post_date']);
	$post_body = mysql_real_escape_string($row['body']);
	$post_title = mysql_real_escape_string($row['title']);
	$post_x_title = mysql_real_escape_string($row['x_title']);
	$post_type = mysql_real_escape_string($row['version']);
	$post_comments = mysql_real_escape_string($row['comments']);
	$post_external_comments = mysql_real_escape_string($row['external_comments']);


	$query = "INSERT INTO {$juassi2_table_prefix}posts
	(post_id, user_id, post_date, post_title, post_x_title, post_body, post_type, post_comments, post_external_comments)
	VALUES
	('$post_id', '$user_id', '$post_date', '$post_title', '$post_x_title', '$post_body', '$post_type', '$post_comments', '$post_external_comments')";
	$post_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Posts.</strong></p>';

/*
Content
*/

$query = "SELECT * FROM {$juassi1_table_prefix}content WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Content.</strong></p>';

while($row = mysql_fetch_array($result)){
	$user_id = mysql_real_escape_string($row['user_id']);
	$post_date = mysql_real_escape_string($row['content_date']);
	$post_body = mysql_real_escape_string($row['content_body']);
	$post_title = mysql_real_escape_string($row['title']);
	$post_x_title = mysql_real_escape_string($row['x_title']);
	$post_type = mysql_real_escape_string($row['version']);

	switch ($post_type) {
		case 'draft':
			$post_type = 'draft_content';
		break;
		case 'published':
			$post_type = 'published_content';
		break;
		case 'private':
			$post_type = 'private_content';
		break;
	}


	$query = "INSERT INTO {$juassi2_table_prefix}posts
	(user_id, post_date, post_title, post_x_title, post_body, post_type, post_comments, post_external_comments)
	VALUES
	('$user_id', '$post_date', '$post_title', '$post_x_title', '$post_body', '$post_type', '0', '0')";
	$post_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Content.</strong></p>';

/*
Comments
*/

$query = "TRUNCATE TABLE {$juassi2_table_prefix}comments";
$result = mysql_query($query, $juassi2_db);

$query = "SELECT * FROM {$juassi1_table_prefix}comments WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Comments.</strong></p>';

while($row = mysql_fetch_array($result)){
	$comment_id = mysql_real_escape_string($row['comment_id']);
	$comment_name = mysql_real_escape_string($row['name']);
	$comment_email = mysql_real_escape_string($row['email']);
	$post_id = mysql_real_escape_string($row['post_id']);
	$comment_ip_address = mysql_real_escape_string($row['ip_address']);
	$comment_date = mysql_real_escape_string($row['comment_date']);
	$comment_trackback = mysql_real_escape_string($row['trackback']);
	$comment_pingback = mysql_real_escape_string($row['pingback']);
	$comment_website = mysql_real_escape_string($row['www']);
	$comment_title = mysql_real_escape_string($row['title']);
	$comment_body = mysql_real_escape_string($row['body']);
	$comment_active_key = mysql_real_escape_string($row['active_key']);
	$comment_approved = mysql_real_escape_string($row['comment_approved']);
	$comment_notify = mysql_real_escape_string($row['notify']);
	$user_id = mysql_real_escape_string($row['user_id']);
	$comment_contact = mysql_real_escape_string($row['contact']);
	$comment_parent = mysql_real_escape_string($row['comment_parent']);
	$comment_akismet_spam = mysql_real_escape_string($row['akismet_spam']);
	$comment_spam_score = mysql_real_escape_string($row['spam_score']);

	$query = "INSERT INTO {$juassi2_table_prefix}comments
	(comment_id, comment_display_name, comment_email, post_id, comment_ip_address, comment_date, comment_trackback, comment_pingback, comment_website,
	comment_title, comment_body, comment_active_key, comment_approved, comment_notify, user_id, comment_allow_contact_form, comment_parent, comment_akismet_spam,
	comment_spam_score)
	VALUES
	('$comment_id', '$comment_name', '$comment_email', '$post_id', '$comment_ip_address', '$comment_date', '$comment_trackback', '$comment_pingback',
	'$comment_website', '$comment_title', '$comment_body', '$comment_active_key', '$comment_approved', '$comment_notify', '$user_id', '$comment_contact',
	'$comment_parent', '$comment_akismet_spam', '$comment_spam_score')";
	$comment_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Comments.</strong></p>';

/*
Events
*/

$query = "TRUNCATE TABLE {$juassi2_table_prefix}events";
$result = mysql_query($query, $juassi2_db);

$query = "SELECT * FROM {$juassi1_table_prefix}events WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Events.</strong></p>';

while($row = mysql_fetch_array($result)){
	$type = mysql_real_escape_string($row['type']);
	$date = mysql_real_escape_string($row['date']);
	$source = mysql_real_escape_string($row['source']);
	$user_id = mysql_real_escape_string($row['user_id']);
	$ip_address = mysql_real_escape_string($row['ip_address']);
	$event_id = mysql_real_escape_string($row['event_id']);
	$event_no = mysql_real_escape_string($row['event_no']);
	$description = mysql_real_escape_string(bt_htmlentities($row['description']));


	$query = "INSERT INTO {$juassi2_table_prefix}events
	(event_id, user_id, event_date, file, type, ip_address, event_no, description)
	VALUES
	('$event_id', '$user_id', '$date', '$source', '$type', '$ip_address', '$event_no', '$description')";
	$event_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Events.</strong></p>';

/*
empty posts_to_categories
*/
$query = "TRUNCATE TABLE {$juassi2_table_prefix}posts_to_categories";
$result = mysql_query($query, $juassi2_db);

echo '<p><strong>Emptied posts_to_categories.</strong></p>';

$query = "TRUNCATE TABLE {$juassi2_table_prefix}categories";
$result = mysql_query($query, $juassi2_db);

echo '<p><strong>Emptied categories.</strong></p>';

/*
empty link_categories
*/
$query = "TRUNCATE TABLE {$juassi2_table_prefix}link_categories";
$result = mysql_query($query, $juassi2_db);

echo '<p><strong>Emptied link_categories.</strong></p>';

$query = "TRUNCATE TABLE {$juassi2_table_prefix}links";
$result = mysql_query($query, $juassi2_db);

echo '<p><strong>Emptied links.</strong></p>';

/*
Copy link Categories
*/
$query = "SELECT * FROM {$juassi1_table_prefix}link_categories WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Link Categories.</strong></p>';

while($row = mysql_fetch_array($result)){
	$category_id = mysql_real_escape_string($row['category_id']);
	$description = mysql_real_escape_string($row['description']);
	$text_before_all = mysql_real_escape_string($row['text_before_all']);
	$text_after_all = mysql_real_escape_string($row['text_after_all']);
	$text_after = mysql_real_escape_string($row['text_after']);
	$category_name = mysql_real_escape_string($row['category_name']);

	$query = "INSERT INTO {$juassi2_table_prefix}link_categories
	(category_id, description, text_before_all, text_after_all, text_after, category_name)
	VALUES
	('$category_id', '$description', '$text_before_all', '$text_after_all', '$text_after', '$category_name')";
	$event_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Link Categories.</strong></p>';

/*
Copy links
*/
$query = "SELECT * FROM {$juassi1_table_prefix}links WHERE blog_id = $juassi1_bt_id";
$result = mysql_query($query, $juassi1_db);

echo '<p><strong>Adding Links.</strong></p>';

while($row = mysql_fetch_array($result)){
	$url = mysql_real_escape_string($row['url']);
	$name = mysql_real_escape_string($row['name']);
	$category = mysql_real_escape_string($row['category']);
	$link_id = mysql_real_escape_string($row['link_id']);
	$order = mysql_real_escape_string($row['order']);



	$query = "INSERT INTO {$juassi2_table_prefix}links
	(link_url, link_name, category_id, link_id, link_order)
	VALUES
	('$url', '$name', '$category', '$link_id', '$order')";
	$event_result = mysql_query($query, $juassi2_db);
}

echo '<p><strong>Added Links.</strong></p>';



echo '<p><strong>Migrate Finished.</strong></p>';

?>