<?php
/******************************************************************************
 *
 *	 COMPANY: Intelliants LLC
 *	 PROJECT: Subrion Content Management System
 *	 VERSION: 2.3.7
 *	 LICENSE: http://www.subrion.com/license.html
 *	 http://www.subrion.com/
 *
 *	 This program is an open source php content management system.
 *
 *	 Link to Subrion.com may not be removed from the software pages
 *	 without permission of Subrion CMS respective owners. Copyright
 *	 link may be removed for the paid versions only.
 *
 *	 PHP code copyright notice may not be removed from source code
 *	 in any case.
 *
 *	 Copyright 2009-2013 Intelliants LLC
 *	 http://www.intelliants.com/
 *
 ******************************************************************************/


define('JUASSI_VERSION', '2.0');
define('JUASSI_VER', '20');

$error = false;
$message = '';

$builtinPlugins = array('kcaptcha', 'prettyphoto');

$Output->layout()->title = 'Juassi Installer';

switch ($step)
{
	case 'check':
		$checks = array(
			'server' => array()
		);
		$sections = array(
				'server' => array(
				'title' => 'Server Configuration',
				'desc' => 'If any of these items are highlighted in red then please take actions to correct them. Failure to do so could lead to your installation not functioning correctly.',
			),
			'recommended' => array(
				'title' => 'Recommended Settings',
				'desc' => 'These settings are recommended for PHP in order to ensure full compatibility with Subrion CMS. However, Subrion CMS will still operate if your settings do not quite match the recommended.',
			),
			'directory' => array(
				'title' => 'Directory &amp; File Permissions',
				'desc' => 'In order for Subrion CMS to function correctly it needs to be able to access or write to certain files or directories. If you see "Unwriteable" you need to change the permissions on the file or directory to allow Subrion CMS to write to it.',
			),
		);

		$checks['server']['mysql_version'] = array(
			'required' => function_exists('mysql_connect'),
			'class' => true,
			'name' => 'Mysql version',
			'value' => function_exists('mysql_connect')
				? '<td class="success">' . mysql_get_client_info() . '</td>'
				: '<td class="important">MySQL 4.x or upper required</td>'
		);
		$checks['server']['php_version'] = array(
			'required' => version_compare('5.0', PHP_VERSION, '<'),
			'class' => true,
			'name' => 'PHP version',
			'value' => version_compare('5.0', PHP_VERSION, '<')
				? '<td class="success">' . PHP_VERSION . '</td>'
				: '<td class="important">PHP version is not compatible. PHP 5.x needed. (Current version ' . PHP_VERSION . ')</td>'
		);
		$checks['server']['remote'] = array(
			'name' => 'Remote files access support',
			'value' => Helper::hasAccessToRemote()
				? '<td class="success">Available</td>'
				: '<td class="important">Unavailable (highly recommended to enable "CURL" extension or "allow_url_fopen")</td>'
		);
		$checks['server']['xml'] = array(
			'name' => 'XML support',
			'value' => extension_loaded('xml')
				? '<td class="success">Available</td>'
				: '<td class="important">Unavailable (recommended)</td>'
		);
		$checks['server']['mysql_support'] = array(
			'name' => 'MySQL support',
			'value' => function_exists('mysql_connect')
				? '<td class="success">Available</td>'
				: '<td class="important">Unavailable (required)</td>'
		);
		$checks['server']['gd'] = array(
			'name' => 'GD extension',
			'value' => extension_loaded('gd')
				? '<td class="success">Available</td>'
				: '<td class="important">Unavailable (highly recommended)</td>'
		);
		$checks['server']['mbstring'] = array(
			'name' => 'Mbstring extension',
			'value' => extension_loaded('mbstring')
				? '<td class="success">Available</td>'
				: '<td class="important">Unavailable (not required) </td>'
		);

		$recommendedSettings = array(
			array ('File Uploads', 'file_uploads', 'ON'),
			array ('Magic Quotes GPC', 'magic_quotes_gpc', 'OFF'),
			array ('Register Globals', 'register_globals', 'OFF')
		);
		foreach ($recommendedSettings as $item)
		{
			$checks['recommended'][$item[1]] = array(
				'name' => $item[0] . ':</td><td>' . $item[2] . '',
				'value' => (Helper::getIniSetting($item[1]) == $item[2] ? '<td class="success">' : '<td class="important">' ) . Helper::getIniSetting($item[1]) . '</td>',
			);
		}

		$directory = array(
			array('tmp' . JUASSI_DS, '', true),
			array('archive' . JUASSI_DS, '', true),
			array('juassi-backup' . JUASSI_DS, ' (optional)', false),
			array('juassi-content/juassi-plugins' . JUASSI_DS, ' (optional)', false),
			array('privado' . JUASSI_DS . 'config.php', ' (optional)', false),
		);

		foreach ($directory as $item)
		{
			$text = '';
			$isWritable = false;
			if (file_exists(JUASSI_HOME .'/'. $item[0]))
			{
				$text = is_writable(JUASSI_HOME.JUASSI_DS . $item[0]) ? '<td class="success">Writable</td>' : '<td class="' . (empty($item[1]) ? 'important' : 'optional') . '">Unwritable ' . $item[1] . '</td>';
				$isWritable = is_writable(JUASSI_HOME.JUASSI_DS . $item[0]);
			}
			else
			{
				if ($item[0] == 'privado' . JUASSI_DS . 'config.php')
				{
					if (!is_writable(JUASSI_HOME.JUASSI_DS . 'privado' . JUASSI_DS))
					{
						$text = '<td class="important">Does not exist and cannot be created' . $item[1] . '</td>';
					}
					else
					{
						$text = '<td class="success">Does not exist but it can be created' . $item[1] . '</td>';
					}
				}
				else
				{
					$text = '<td class="important">Does not exist' . $item[1] . '</td>';
				}
			}
			$checks['directory'][$item[0]] = array(
				'class' => true,
				'name' => $item[0],
				'value' => $text
			);

			if ($item[2])
			{
				$checks['directory'][$item[0]]['required'] = $isWritable;
			}
		}

		$nextButtonEnabled = true;
		foreach ($sections as $section => $items)
		{
			foreach ($checks[$section] as $key => $check)
			{
				if (isset($check['required']) && !$check['required'])
				{
					$nextButtonEnabled = false;
					break 2;
				}
			}
		}

		$Output->nextButton = $nextButtonEnabled;
		$Output->sections = $sections;
		$Output->checks = $checks;

		break;

	case 'license':
		// EULA step. do nothing
		break;

	case 'configuration':
	case 'finish':
		$step = 'configuration';
		$errorList = array();
		$template = 'default';
		$templates = array();

		$templatesFolder = JUASSI_INSTALL . 'templates/';
		$directory = opendir($templatesFolder);
		while ($file = readdir($directory))
		{
			if (substr($file, 0, 1) != '.' && 'common' != $file)
			{
				if (is_dir($templatesFolder . $file))
				{
					$templates[] = $file;
				}
			}
		}
		closedir($directory);
		sort($templates);

		if (isset($_POST['db_action']))
		{
			$requiredFields = array('dbhost', 'dbuser', 'dbname', 'prefix', 'tmpl', 'admin_username', 'admin_password', 'admin_email');

			foreach ($requiredFields as $fieldName)
			{
				if (!Helper::getPost($fieldName, false))
				{
					$errorList[] = $fieldName;
				}
			}

			if (Helper::getPost('admin_password') != Helper::getPost('admin_password2'))
			{
				$errorList[] = 'admin_password2';
			}

			$port = (int)Helper::getPost('dbport', 3306);
			if ($port > 65536 || $port <= 0)
			{
				$_POST['dbport'] = 3306;
			}

			if (!Helper::email(Helper::getPost('admin_email')))
			{
				$errorList[] = 'admin_email';
			}

			if (!preg_match('/^[a-zA-Z0-9._-]*$/i', Helper::getPost('admin_username')))
			{
				$errorList[] = 'admin_username';
			}

			if (empty($errorList))
			{
				$link = @mysql_connect(Helper::getPost('dbhost') . ':' . Helper::getPost('dbport', 3306),
					Helper::getPost('dbuser'), Helper::getPost('dbpwd'));
				$prefix = Helper::getPost('prefix');

				if (!$link)
				{
					$error = true;
					$message = 'MySQL server: ' . mysql_error() . '<br />';
				}

				if (!$error && !mysql_select_db(Helper::getPost('dbname'), $link))
				{
					$error = true;
					$message = 'Could not select database ' . Helper::_html($_POST['dbname']) . ': ' . mysql_error();
				}

				if (!$error && !Helper::getPost('delete_tables', false))
				{
					$res = mysql_query('SHOW TABLES', $link);
					if (mysql_num_rows($res) > 0)
					{
						while ($array = mysql_fetch_row($res))
						{
							if (strpos($array[0], Helper::_sql($prefix)) !== false)
							{
								$error = true;
								$message = 'Tables with prefix "' . $prefix . '" already exist.';
								$errorList[] = 'prefix';

								break;
							}
						}
					}
					unset($res);
				}

				if (!$error)
				{
					$mysql_ver = version_compare('4.1', mysql_get_server_info($link), '<=') ? '41' : '40';
					$mysql_ver_data = ($mysql_ver == '41') ? 'ENGINE=MyISAM DEFAULT CHARSET=utf8' : 'TYPE=MyISAM';
					$filename = JUASSI_INSTALL . 'dump' . JUASSI_DS . 'install_v' . JUASSI_VER . ($mysql_ver == "41" ? '' : '_mysql5') . '.sql';
					$default = JUASSI_INSTALL . 'dump' . JUASSI_DS . 'install' . ($mysql_ver == "41" ? '' : '_mysql5') . '.sql';

					if (!file_exists($filename))
					{
						if (!file_exists($default))
						{
							$error = true;
							$message = 'Could not open file with sql instructions: [install_v' . JUASSI_VER . '.sql] or [install.sql]';
						}
						else
						{
							$filename = $default;
						}
					}
				}
				
				

				if (!$error)
				{
					$search = array(
						'{install:dir}' => trim(JUASSI_HOME, '/'),
						'{install:base}' => JUASSI_HOME,
						'{install:base_url}' => URL_HOME,
						'{install:tmpl}' => Helper::_sql(Helper::getPost('tmpl')),
						'{install:lang}' => 'en',
						'{install:admin_username}' => Helper::_sql(Helper::getPost('admin_username')),
						'{install:email}' => Helper::_sql(Helper::getPost('admin_email')),
						'{install:mysql_version}' => $mysql_ver_data,
						'{install:version}' => JUASSI_VERSION,
						'{install:drop_tables}' => ('on' == Helper::getPost('delete_tables')) ? '' : '#',
						'{install:prefix}' => Helper::_sql(Helper::getPost('prefix', '', false))
					);
					$message = $s_sql = '';
					$cnt = 0;
					$file = file($filename);
					if (count($file) > 0)
					{
						foreach ($file as $s)
						{
							$s = trim ($s);
							if (isset($s[0]) && ($s[0] == '#' || $s[0] == '' || 0 === strpos($s, '--')))
							{
								continue;
							}

							if ($s && $s[strlen($s) - 1] == ';')
							{
								$s_sql .= $s;
							}
							else
							{
								$s_sql .= $s;
								continue;
							}

							$s_sql = str_replace(array_keys($search), array_values($search), $s_sql);

							$query = mysql_query($s_sql, $link);
							if (!$query)
							{
								$error = true;
								if ($cnt == 0)
								{
									$cnt++;
									$message .= '<div class="db_errors">';
								}
								$message .= "<div class=\"qerror\">'" . mysql_errno() . " " . mysql_error()
										. "' during the following query:</div> <div class=\"query\">{$s_sql} </div>";
							}
							$s_sql = '';
						}
						$message .= $message ? '</div>' : '';
					}
					else
					{
						$error = true;
						$message = 'Mysql dump is empty! Please check the file!';
					}
				}

				if (!$error)
				{
					$config = file_get_contents(JUASSI_INSTALL . 'modules' . JUASSI_DS . 'config.sample');
					$body = <<<HTML
Congratulations,

You have successfully installed C-Blog ({version}) on your server.

This e-mail contains important information regarding your installation and
should be kept for reference. Your password has been securely stored in our
database and cannot be retrieved. In the event that it is forgotten, you
will be able to reset it using the email address associated with your
account.

----------------------------
Site configuration
----------------------------
 Username: {username}
 Password: {password}
 Board URL: {url}
----------------------------
Mysql configuration
----------------------------
 Hostname: {dbhost}:{dbport}
 Database: {dbname}
 Username: {dbuser}
 Password: {dbpass}
 Prefix: {dbprefix}
----------------------------

Useful information regarding the C-Blog can be found on juassi.com's support page -
http://www.juassi.com/soporte/ticketsnewguest.php
__________________________
The Juassi Support Team
http://www.juassi.com
HTML;
					$params = array(
						'{version}' => JUASSI_VERSION,
						'{date}' => date('d F Y H:i:s'),
						'{mysql_version}' => version_compare('4.1', mysql_get_server_info(), '<=') ? '41' : '40',
						'{dbhost}' => Helper::getPost('dbhost'),
						'{dbuser}' => Helper::getPost('dbuser'),
						'{dbpass}' => Helper::getPost('dbpwd', '', false),
						'{dbname}' => Helper::getPost('dbname'),
						'{dbport}' => Helper::getPost('dbport'),
						'{dbprefix}' => Helper::getPost('prefix'),
						'{salt}' => '#' . strtoupper(substr(md5(JUASSI_HOME.JUASSI_DS), 21, 10)),
						'{debug}' => Helper::getPost('debug', 0, false),
						'{username}' => Helper::_sql(Helper::getPost('admin_username')),
						'{password}' => Helper::_sql(Helper::getPost('admin_password')),
						'{url}' => URL_HOME . 'admin/'
					);
					$body = str_replace(array_keys($params), array_values($params), $body);
					$config = str_replace(array_keys($params), array_values($params), $config);

					@mail(Helper::_sql(Helper::getPost('admin_email')), 'C-Blog Installed', $body, 'From: jcarlosreyesc@juassi.com');
					$filename = JUASSI_HOME.'/' . 'privado' . JUASSI_DS . 'config.php';
					$configMsg = '';

					if (is_writable(JUASSI_HOME .'/' . 'privado' . JUASSI_DS) || is_writable($filename))
					{
						if (!$handle = fopen($filename, 'w+'))
						{
							$error = true;
							$configMsg = 'Cannot open file: ' . $filename;
						}

						if (fwrite($handle, $config, strlen($config)) === false)
						{
							$error = true;
							$configMsg = 'Cannot write to file: ' . $filename;
						}
					}
					else
					{
						$configMsg = 'Cannot write to folder.';
					}

					Helper::cleanUpDirectoryContents(JUASSI_HOME . '/' . 'tmp' . JUASSI_DS);

					if (!$error)
					{
						$step = 'finish';
						$Output->step = 'finish';
					}

					$Output->config = $config;
					$Output->description = $configMsg;
				}

/*				if (!$error)
				{
					$Users = Helper::loadCoreClass('users', 'core');
					$Users->changePassword(1, Helper::getPost('admin_password'));
				}
*/
				if (!$error)
				{
					$TemplateInstaller = Helper::loadCoreClass('template');

					$templateInstallationFile = JUASSI_HOME .'/' . 'templates' . JUASSI_DS . 'default' . JUASSI_DS . 'info' . JUASSI_DS . 'install.xml';
					$TemplateInstaller->getFromPath($templateInstallationFile);

					$TemplateInstaller->parse();
					$TemplateInstaller->check();

					$notes = $TemplateInstaller->getNotes();
					if ($notes)
					{
						$error = true;
						$message = implode('<br />', $notes);
					}

					$TemplateInstaller->install(Template::SETUP_INITIAL);
				}

				if (!$error && $builtinPlugins)
				{
					$pluginsFolder = JUASSI_HOME.'/' . 'juassi-content/juassi-plugins' . JUASSI_DS;
					foreach ($builtinPlugins as $pluginName)
					{
						$installationFile = file_get_contents($pluginsFolder . $pluginName . JUASSI_DS . Helper::INSTALLATION_FILE_NAME);
						if ($installationFile !== false)
						{
							$ExtrasInstaller = Helper::loadCoreClass('extras');

							$ExtrasInstaller->setXml($installationFile);
							$ExtrasInstaller->parse();

							if (!$ExtrasInstaller->getNotes())
							{
								$result = $ExtrasInstaller->install();
							}
						}
					}

					// disable default plugins uninstallation
					$sql = 'UPDATE `' . Helper::_sql(Helper::getPost('prefix', '', false)) . "extras` SET `removable` = 0 WHERE `name` IN ('" . implode("','", $builtinPlugins) . "')";
					mysql_query($sql, $link);
				}
			}

			$template = Helper::getPost('tmpl', $template);
		}

		$Output->errorList = $errorList;
		$Output->template = $template;
		$Output->templates = $templates;

		break;

	case 'download':
		header('Content-Type: text/x-delimtext; name="config.php"');
		header('Content-disposition: attachment; filename="config.php"');

		echo get_magic_quotes_gpc() ? stripslashes($_POST['config_content']) : $_POST['config_content'];
		exit;

	case 'plugins':
		if (Helper::isAjaxRequest())
		{
			if (isset($_POST['plugin']) && $_POST['plugin'])
			{
				echo Helper::installRemotePlugin($_POST['plugin'])
					? 'installed successfully'
					: 'installation is not performed';
				exit();
			}
		}
		else
		{
			$plugins = Helper::getRemotePluginsList(JUASSI_VERSION);
			if ($plugins === false)
			{
				$message = 'Could not get the list of plugins. Please try again in a while.';
			}
			else
			{
				$Output->plugins = $plugins;
			}
		}

		break;

	default:
		return;
}

$Output->steps = array(
	'check' => 'Pre-Installation Check',
	'license' => 'C-Blog License',
	'configuration' => 'Configuration',
	'finish' => 'Finish',
	'plugins' => 'Plugins Installation'
);

$Output->error = $error;
$Output->message = $message;

