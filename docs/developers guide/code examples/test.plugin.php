<?php
/*
	Bluetrait 2.0 Plugin Example
	Michael Dale Copyright 2007
*/

//stops people from directly trying to run the plugin. Please add this at the top of any plugin you write, thanks. :)
if (!defined('BT_ROOT')) exit;


/*
This is a basic example of a content filter. 
*/
bt_add_content_filter('test', 'post_body', 'test_function');

function test_function($bt_content) {

	$content = $bt_content . ' hello!';
	
	return $content;

}

/*
This is another example of a content filter. 
*/
bt_add_content_filter('test', 'post_title', 'test_post_title');

function test_post_title($post_title) {

	$post_title = '<sub>' . $post_title . '</sub>';
	
	return $post_title;

}

/*
This is an example of how to remove default tasks (this in case kses)
*/
bt_add_task('test', 'common_loaded', 'test_kses', 9);

function test_kses() {
	bt_remove_task('common_loaded', 'bt_load_kses');
	bt_remove_content_filter('post_body', 'bt_filter_kses_html');
	bt_remove_content_filter('comment_body', 'bt_filter_kses_html_comments');
	bt_remove_content_filter('event_description', 'bt_filter_kses_html_events');
}

/*
This is an example of how to hook into set_config
*/
bt_add_task('test', 'set_config', 'test_config'); 

function test_config($config) {

	trigger_error('Config "' . $config['config_name'] . '" has changed values from "' . bt_get_config($config['config_name']) . '" to "' . $config['config_value'] . '"');
	
}

/*
This is an example of how to setup a cron task.

The plugin hooks for the intervals are as follows:
cron_every_hour
cron_every_day
cron_every_week
cron_every_month

*/
bt_add_task('test', 'cron_every_minute', 'test_every_minute');

function test_every_minute() {
	trigger_error('test_every_minute has run', E_USER_NOTICE);
}

?>