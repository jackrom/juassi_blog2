<?php
/*
Juassi 2.0

Please create a juassi-settings.php file to override these settings
i.e.
define('JUASSI_DEBUG', TRUE);

You can hard override any config setting also.
i.e.
juassi_hard_set_config('plugin_data', array());

hard config settings are not saved in the database. So if you remove the hard_set line the bt_config value goes back to the value in the database
*/


//debugging settings
if (!defined('JUASSI_DEBUG')) define('JUASSI_DEBUG', FALSE);
if (!defined('JUASSI_LOG_ALL')) define('JUASSI_LOG_ALL', FALSE);

//multi blog settings
if (!defined('JUASSI_MASTER')) define('JUASSI_MASTER', 1);
if (!defined('JUASSI_MULTI_BLOG')) define('JUASSI_MULTI_BLOG', FALSE);

//plugin settings
if (!defined('JUASSI_LOAD_PLUGINS')) define('JUASSI_LOAD_PLUGINS', TRUE);

//mail notify settings (i.e. for error messages that cannot be logged to the database)
if (!defined('JUASSI_MAIL_NOTIFY')) define('JUASSI_MAIL_NOTIFY', TRUE);
if (!defined('JUASSI_MAIL_NOTIFY_EMAIL')) define('JUASSI_MAIL_NOTIFY_EMAIL', 'jcarlosreyesc@juassi.com');
if (!defined('JUASSI_MAIL_NOTIFY_SUBJECT')) define('JUASSI_MAIL_NOTIFY_SUBJECT', 'Juassi :: Error');

//root folder settings
if (!defined('JUASSI_ADMIN')) define('JUASSI_ADMIN', '/admin');
if (!defined('JUASSI_CONTENT')) define('JUASSI_CONTENT', '/juassi-content');
if (!defined('JUASSI_LIBRARIES')) define('JUASSI_LIBRARIES', '/juassi-libraries');

//sub folder settings
if (!defined('JUASSI_THEMES')) define('JUASSI_THEMES', '/juassi-themes');

//output buffering
if (!defined('JUASSI_OUTPUT_BUFFERING')) define('JUASSI_OUTPUT_BUFFERING', TRUE);

//define what html is allowed in your posts
if (!isset($juassi_allowed_html)) {
	$juassi_allowed_html = array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'rel' => array()
					),

					'b' => array(),
					'div' =>  array(
						'class' => array()
					),

					'blockquote' => array(
						'cite' => array()
					),

					'img' => array(
						'align' => array(),
						'alt' => array(),
						'style' => array(),
						'src' => array(),
						'width' => array(),
						'vspace' => array(),
						'hspace' => array(),
						'height' => array(),
						'border' => array(),
						'class' => array()
					),

					'object' => array(
						'type' => array(),
						'data' => array(),
						'align' => array(),
						'alt' => array(),
						'style' => array(),
						'src' => array(),
						'width' => array(),
						'vspace' => array(),
						'hspace' => array(),
						'height' => array(),
						'border' => array(),
						'class' => array()
					),

					'param' => array(
						'name' => array(),
						'value' => array()
					),


					'em' => array(),

					'br' => array(),

					'table' => array(
						'width' => array()
					),
					'td' => array(
						'colspan' => array(),
						'rowspan' => array()
					),
					'th' => array(
						'colspan' => array(),
						'rowspan' => array()
					),
					'tr' => array(),
					'caption' => array(),
					'thead' => array(),
					'tbody' => array(),
					'tfoot' => array(),
					'i' => array(),

					'p' => array(),

					'strike' => array(),

					'strong' => array(),

					'li' => array(),

					'ol' => array(),

					'sub' => array(),
					'sup' => array(),

					'pre' => array(),

					'ul' => array()

	);
}


//define what html is allowed in comments
if (!isset($juassi_allowed_html_comments)) {
	$juassi_allowed_html_comments = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'rel' => array()
				),

				'b' => array(),

				'blockquote' => array(
					'cite' => array()
				),

				'em' => array(),

				'i' => array(),

				'strike' => array(),

				'strong' => array(),

				'li' => array(),

				'pre' => array(),

				'ol' => array(),

				'code' => array(),

				'ul' => array()

	);
}

//define what html is allowed in the event viewer
if (!isset($juassi_allowed_html_event_viewer)) {
	$juassi_allowed_html_event_viewer = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'rel' => array()
				),

				'b' => array(),

				'br' => array(),

				'strike' => array(),

				'strong' => array(),

				'pre' => array()
	);
}
?>