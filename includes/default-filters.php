<?php
/*
	Juassi 2.0 Default Filters
	Juan Carlos Reyes C Copyright 2012
*/
if (!defined('JUASSI_ROOT')) exit;

juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'post_title', 'juassi_htmlentities');
juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'post_body', 'juassi_filter_kses_html');
juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'post_body', 'juassi_autop');

juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'content_title', 'juassi_htmlentities');
juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'content_body', 'juassi_filter_kses_html');
juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'content_body', 'juassi_autop');

juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'comment_body', 'juassi_filter_kses_html_comments');
juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'comment_body', 'juassi_autop');

juassi_add_content_filter(JUASSI_PLUGIN_NAME, 'event_description', 'juassi_filter_kses_html_events');

?>