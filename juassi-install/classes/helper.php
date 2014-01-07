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


class Helper
{
	const PLUGINS_LIST_SOURCE = 'http://tools.subrion.com/plugins-list/?version=%s';
	const PLUGINS_DOWNLOAD_SOURCE = 'http://tools.subrion.com/download-plugin/?plugin=%s&version=%s';

	const USER_AGENT = 'C-Blog Bot';

	const HTTP_STATUS_OK = 200;

	const INSTALLATION_FILE_NAME = 'install.xml';


	public static function isAjaxRequest()
	{
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}

	public static function getIniSetting($name)
	{
		return ini_get($name) == '1' ? 'ON' : 'OFF';
	}

	public static function cleanUpDirectoryContents($directory, $removeFolder = false)
	{
		$directory = substr($directory, -1) == JUASSI_DS
			? substr($directory, 0, -1)
			: $directory;
		if (!file_exists($directory) || !is_dir($directory))
		{
			return false;
		}
		elseif (is_readable($directory))
		{
			$handle = opendir($directory);
			while ($item = readdir($handle))
			{
				if (!in_array($item, array('.', '..', '.htaccess')))
				{
					$path = $directory . JUASSI_DS . $item;
					if (is_dir($path))
					{
						self::cleanUpDirectoryContents($path, true);
					}
					else
					{
						unlink($path);
					}
				}
			}
			closedir($handle);
			if ($removeFolder)
			{
				if (!rmdir($directory))
				{
					return false;
				}
			}
		}
		return true;
	}

	public static function loadCoreClass($name, $type = 'admin')
	{
		if (!class_exists('Core'))
		{
			define('JUASSI_LANGUAGE', 'en');

			define('JUASSI_INCLUDES', JUASSI_HOME .JUASSI_DS. 'includes' . JUASSI_DS);
			define('JUASSI_PRIVADO', JUASSI_HOME .JUASSI_DS. 'privado' . JUASSI_DS);
			define('JUASSI_SMARTY', JUASSI_INCLUDES . 'smarty3' . JUASSI_DS);
			define('JUASSI_CLASSES', JUASSI_INCLUDES . 'classes' . JUASSI_DS);
			define('JUASSI_PLUGINS', JUASSI_HOME. JUASSI_DS . 'juassi-content' . JUASSI_DS . 'juassi-plugins');
			define('JUASSI_TMP', JUASSI_HOME .JUASSI_DS. 'tmp' . JUASSI_DS);
			define('JUASSI_CACHEDIR', JUASSI_TMP . 'cache' . JUASSI_DS);

			if (file_exists(JUASSI_PRIVADO . 'config.php'))
			{
				include_once JUASSI_PRIVADO . 'config.php';
			}
			else
			{
				define('JUASSI_CONNECT', 'mysql');
				define('JUASSI_DBHOST', self::getPost('dbhost', 'localhost'));
				define('JUASSI_DBPORT', self::getPost('dbport', 3306));
				define('JUASSI_DBUSER', self::getPost('dbuser'));
				define('JUASSI_DBPASS', self::getPost('dbpwd'));
				define('JUASSI_DBNAME', self::getPost('dbname'));
				define('JUASSI_DBPREFIX', self::getPost('prefix', '', false));
				define('JUASSI_DEBUG', false);
			}

			set_include_path(JUASSI_CLASSES);
			require_once 'debug.php';
			require_once 'system.php';
			require_once 'interfaces.php';
			require_once 'core.php';
			
			if (function_exists('spl_autoload_register') && function_exists('spl_autoload_unregister'))
			{
				spl_autoload_register(array('System', 'autoload'));
			}

			$Core = Core::instance();

			System::setDebugMode();

			$Core->factory(Core::CORE, array('sanitize', 'validate'));
			$Core->Db = $Core->factory(Core::CORE, 'db');
			$Core->factory(Core::CORE, 'language');
			$Core->View = $Core->factory(Core::CORE, 'view');

			$languages = $Core->Db->one_bind(array('value'), '`name` = :name', array('name' => 'languages'), 'config');
			$languages = empty($languages) ? array('en' => 'English') : unserialize($languages);
			$Core->languages = $languages;

			define('JUASSI_CLEAR_URL', $Core->Db->one(array('value'), "`name` = 'baseurl'", 'config'));
			define('JUASSI_URL', JUASSI_CLEAR_URL);
			define('JUASSI_FRONT_TEMPLATES', JUASSI_HOME . '/' . 'templates' . JUASSI_DS);
			define('JUASSI_TEMPLATES', JUASSI_FRONT_TEMPLATES);
			define('JUASSI_ADMIN', false);
		}

		return Core::instance()->factory($type, $name);
	}

	public static function hasAccessToRemote()
	{
		if (extension_loaded('curl'))
		{
			return true;
		}

		if (ini_get('allow_url_fopen'))
		{
			if (function_exists('fsockopen'))
			{
				return true;
			}
			if (function_exists('stream_get_meta_data') && in_array('http', stream_get_wrappers()))
			{
				return true;
			}
		}

		return false;
	}

	public static function getPost($name, $default = '', $notEmpty = true)
	{
		if (isset($_POST[$name]))
		{
			if (empty($_POST[$name]) && $notEmpty) return $default;
			return $_POST[$name];
		}
		return $default;
	}

	public static function email($email)
	{
		return (bool)preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email);
	}

	public static function getRemoteContent($sourceUrl, $savePath = null)
	{
		$result = false;

		if (extension_loaded('curl'))
		{
			set_time_limit(60);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sourceUrl);
			curl_setopt($ch, CURLOPT_HEADER, 0);

			if ($savePath)
			{
				$fh = fopen($savePath, 'w');
				curl_setopt($ch, CURLOPT_FILE, $fh);
			}
			else
			{
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			}

			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
			$response = curl_exec($ch);
			if (self::HTTP_STATUS_OK == curl_getinfo($ch, CURLINFO_HTTP_CODE))
			{
				$result = $response;
			}
			curl_close($ch);

			if (isset($fh))
			{
				fclose($fh);
			}
		}
		elseif (ini_get('allow_url_fopen'))
		{
			ini_set('user_agent', self::USER_AGENT);
			$result = @file_get_contents($sourceUrl);
			ini_restore('user_agent');

			if ($result !== false)
			{
				if ($savePath)
				{
					$fh = fopen($savePath, 'w');
					$result = fwrite($fh, $result);
					fclose($fh);
				}
			}
		}

		return $result;
	}

	public static function _html ($string, $mode = ENT_QUOTES)
	{
		return htmlspecialchars($string, $mode);
	}

	public static function _sql ($string)
	{
		if (is_array($string))
		{
			foreach ($string as $k => $v)
			{
				$string[$k] = self::_sql($v);
			}
		}
		else
		{
			$string = mysql_real_escape_string($string);
		}
		return $string;
	}

	protected static function _getInstalledPluginsList()
	{
		self::loadCoreClass('db', 'core');
		$Db = Core::instance()->Db;

		$list = $Db->onefield('name', "type = 'plugin'", 0, null, 'extras');

		return empty($list)
			? array()
			: $list;
	}

	public static function getRemotePluginsList($coreVersion, $checkIfInstalled = true)
	{
		$result = false;

		$response = self::getRemoteContent(sprintf(self::PLUGINS_LIST_SOURCE, $coreVersion));
		if ($response !== false)
		{
			$response = json_decode($response);
			if (isset($response->plugins) && count($response->plugins))
			{
				$result = $response->plugins;
			}
		}

		if ($checkIfInstalled)
		{
			$installedPlugins = self::_getInstalledPluginsList();
			foreach ($installedPlugins as $pluginName) {
				if (isset($result->$pluginName))
				{
					$result->$pluginName->installed = 1;
				}
			}
		}

		return $result;
	}

	// performs complete plugin installation
	public static function installRemotePlugin($pluginName)
	{
		$result = false;

		if ($pluginName)
		{
			$downloadPath = self::_composePath(array(JUASSI_HOME . JUASSI_DS , 'tmp', 'plugins'));
			if (!is_dir($downloadPath))
			{
				mkdir($downloadPath);
			}

			$savePath = $downloadPath . $pluginName . '.plugin';
			if (!self::getRemoteContent(sprintf(self::PLUGINS_DOWNLOAD_SOURCE, $pluginName, JUASSI_VERSION), $savePath))
			{
				return false;
			}

			if (is_file($savePath))
			{
				$extrasFolder = self::_composePath(array(JUASSI_HOME . JUASSI_DS, 'plugins'));
				if (is_writable($extrasFolder))
				{
					$pluginFolder = self::_composePath(array($extrasFolder, $pluginName));
					if (is_dir($pluginFolder))
					{
						self::cleanUpDirectoryContents($pluginFolder);
					}
					else
					{
						mkdir($pluginFolder);
					}

					require_once self::_composePath(array(JUASSI_HOME . JUASSI_DS, 'includes', 'pclzip')) . 'pclzip.lib.php';
					$zipSource = new PclZip($savePath);

					if ($zipSource->extract(PCLZIP_OPT_PATH, $extrasFolder))
					{
						$installationFile = file_get_contents($pluginFolder . self::INSTALLATION_FILE_NAME);
						if ($installationFile !== false)
						{
							$Extras = self::loadCoreClass('extras');

							$Extras->setXml($installationFile);
							$Extras->parse();

							if (!$Extras->getNotes())
							{
								$result = $Extras->install();

							}
						}
					}
				}

				Helper::cleanUpDirectoryContents(JUASSI_HOME . JUASSI_DS . 'tmp' . JUASSI_DS);
			}
		}

		return $result;
	}

	// handy function to create a path
	protected static function _composePath (array $path)
	{
		foreach ($path as $key => $value)
		{
			$path[$key] = trim($value, JUASSI_DS);
		}
		return (stripos(PHP_OS, 'win') !== false ? '' : JUASSI_DS) . implode(JUASSI_DS, $path) . JUASSI_DS;
	}
}