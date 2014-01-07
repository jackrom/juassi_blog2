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


class PatchApplier
{
	const PERMISSIONS_FULL_ACCESS = 0777;

	const EMPTY_FILE_HASH = '#0000000-0000000-0000000-0000000';

	const EXTRA_TYPE_PLUGIN = true;
	const EXTRA_TYPE_PACKAGE = false;

	const FILE_ACTION_CREATE = 0x2;
	const FILE_ACTION_REMOVE = 0x4;
	const FILE_FORMAT_BINARY = 0x20;
	const FILE_FORMAT_TEXT = 0x40;

	const LOG_ERROR = 'error';
	const LOG_ALERT = 'alert';
	const LOG_SUCCESS = 'success';

	protected $_dbConnectionParams;
	protected $_forceMode;
	protected $_scriptRoot;

	private $_signatures = array(
		765 => array(
			'COMPANY: Intelliants LLC',
			'PROJECT: Subrion Content Management System',
			'LICENSE: http://www.subrion.com/license.html',
			'http://www.subrion.com/',
			'This program is an open source php content management system.',
			'Link to Subrion.com may not be removed from the software pages',
			'PHP code copyright notice may not be removed from source code',
			'http://www.intelliants.com/'
		),
		22 => array('/******************************************************************************
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
')
	);

	private $_log = array();


	public function __construct($scriptRoot, $dbConnectionParams = null, $forceMode = false)
	{
		$this->_dbConnectionParams = $dbConnectionParams;
		$this->_forceMode = $forceMode;
		$this->_scriptRoot = $scriptRoot;
	}

	public function process($patch, $version)
	{
		if (count($patch['queries']))
		{
			if (!$this->_dbConnect())
			{
				$this->_logInfo('Unable to connect to the database :database.', self::LOG_ERROR, array('database' => $this->_dbConnectionParams['database']));
				return;
			}
			$this->_logInfo('Starting to process SQL queries...', self::LOG_SUCCESS);
			foreach ($patch['queries'] as $entry) {
				$this->_processQuery($entry);
			}
		}
		if (count($patch['files']))
		{
			$this->_logInfo('Starting to process files in :mode mode...', self::LOG_SUCCESS, array('mode' => $this->_forceMode ? 'forced' : 'regular'));
			chdir($this->_scriptRoot);
			foreach ($patch['files'] as $entry)
			{
				$this->_processFile($entry);
			}
		}
		if (count($patch['extras']))
		{
			foreach ($patch['extras'] as $entry)
			{
				$this->_processExtra($entry);
			}
		}

		// finally, update the version num in DB
		if ($this->_dbConnectionParams['link'])
		{
			$sql = sprintf("UPDATE `{prefix}config` SET `value` = '%s' WHERE `name` = '%s'", $version, 'version');
			$this->_processQuery($sql);
		}
	}

	protected function _logInfo($message, $type = self::LOG_ALERT, $params = array())
	{
		if (is_array($params) && $params)
		{
			foreach ($params as $key => $value) {
				$message = str_replace(':' . $key, $value, $message);
			}
		}
		$this->_log[] = array('type' => $type, 'message' => $message);
	}

	protected function _processQuery($query)
	{
		$query = str_replace('{prefix}', $this->_dbConnectionParams['prefix'], $query);

		mysql_query($query, $this->_dbConnectionParams['link'])
			? $this->_logInfo('Query executed: :query', self::LOG_SUCCESS, array('query' => $query))
			: $this->_logInfo('Query failed: :query (:error)', self::LOG_ERROR, array('query' => $query, 'error' => mysql_error($this->_dbConnectionParams['link'])));
	}

	protected function _processFile($entry)
	{
		$pathName = $entry['path'] . '/' . $entry['name'];

		switch (true)
		{
			// file/directory removal task
			case $entry['flags'] & self::FILE_ACTION_REMOVE:

				if (!file_exists($pathName))
				{
					$this->_logInfo('File/folder to be removed does already not exist: :file', self::LOG_SUCCESS, array('file' => $pathName));
					break;
				}
				if (is_dir($pathName))
				{
					$this->_recursivelyRemoveDirectory($pathName);
					clearstatcache();
					is_dir($pathName)
						? $this->_logInfo('Removal of directory :directory', self::LOG_SUCCESS, array('directory' => $pathName))
						: $this->_logInfo('Unable to remove the directory: :directory', self::LOG_ERROR, array('directory' => $pathName));
				}
				else
				{
					@unlink($pathName)
						? $this->_logInfo('Removal of single file: :file', self::LOG_SUCCESS, array('file' => $pathName))
						: $this->_logInfo('Unable to remove the file: :file', self::LOG_ERROR, array('file' => $pathName));
				}

				break;

			// default case - file create/rewrite task
			case $entry['flags'] & self::FILE_ACTION_CREATE:

				if (file_exists($pathName))
				{
					if (!$this->_forceMode)
					{
						if ($entry['flags'] & self::FILE_FORMAT_TEXT)
						{
							if (self::EMPTY_FILE_HASH != $entry['hash'])
							{
								$content = @file_get_contents($pathName);

								if (false === $content)
								{
									$this->_logInfo('Unable to get contents of the file to calculate the checksum: :file. Skipped', self::LOG_ERROR, array('file' => $pathName));
									return;
								}

								if (!$this->_checkTokenValidity($content, $entry['hash']))
								{
									$this->_logInfo('The checksum is not equal: :file (seems modified). Skipped', self::LOG_ERROR, array('file' => $pathName));
									return;
								}
							}
						}
					}
				}

				$folder = dirname($pathName);

				if (!is_dir($folder))
				{
					$umask = umask(0);
					@mkdir($folder, self::PERMISSIONS_FULL_ACCESS, true);
					umask($umask);

					// because of mkdir with recursive param set to true does always return false
					if (!is_dir($folder))
					{
						$this->_logInfo('Could not create a directory :directory to write the file: :file', self::LOG_ALERT, array('directory' => $folder, 'file' => $pathName));
					}
				}

				if (is_writable($folder))
				{
					$this->_writeFile($pathName, $entry['contents'], $entry['flags'] & self::FILE_FORMAT_BINARY);
				}
				else
				{
					$this->_logInfo('File is non-writable: :file. Skipped', self::LOG_ERROR, array('file' => $pathName));
				}

				break;
		}
	}

	protected function _processExtra($entry)
	{
		$friendlyName = ucfirst($entry['name']);
		if ($entry['type'] == self::EXTRA_TYPE_PLUGIN)
		{
			iaHelper::installRemotePlugin($entry['name'])
				? $this->_logInfo('Installation of :name is successfully completed.', self::LOG_SUCCESS, array('name' => $friendlyName))
				: $this->_logInfo('Unable to install :name due to errors.', self::LOG_ERROR, array('name' => $friendlyName));
		}
		else
		{
			$this->_logInfo('Installation of ":name" requested. Ignored since installation of this type is not currently implemented.', self::LOG_ALERT, array('name' => $friendlyName));
		}
	}

	protected function _writeFile($filename, $content, $isBinary)
	{
		$mode = $isBinary ? 'b' : 't';

		$file = @fopen($filename, 'w' . $mode);

		if (is_resource($file))
		{
			fwrite($file, $content);
			fclose($file);

			$this->_logInfo('File successfully written: :file', self::LOG_SUCCESS, array('file' => $filename));
			return;
		}

		$this->_logInfo('Unable to write the file: :file', self::LOG_ERROR, array('file' => $filename));
	}

	protected function _dbConnect()
	{
		if (is_array($this->_dbConnectionParams) && $this->_dbConnectionParams)
		{
			$link = mysql_connect($this->_dbConnectionParams['host'], $this->_dbConnectionParams['user'], $this->_dbConnectionParams['password']);
			if ($link)
			{
				if (mysql_select_db($this->_dbConnectionParams['database'], $link))
				{
					$this->_dbConnectionParams['link'] = $link;

					return true;
				}
			}
		}

		return false;
	}

	public function getLog()
	{
		$output = '';

		if ($this->_log)
		{
			foreach ($this->_log as $entry) {
				$output .= '' . strtoupper($entry['type']) . ': ' . $entry['message'] . PHP_EOL;
			}
		}

		return $output;
	}

	private function _recursivelyRemoveDirectory($path)
	{
		$fileList = scandir($path);
		foreach ($fileList as $file) {
			if ('.' == $file || '..' == $file) {
				continue;
			}
			$file = $path . '/' . $file;
			is_dir($file) ? $this->_recursivelyRemoveDirectory($file) : @unlink($file);
		}
		@rmdir($path);
	}

	private function _checkTokenValidity($content, $validToken)
	{
		$signatureFound = false;
		$factor = 0;

		foreach ($this->_signatures as $factor => $signatures)
		{
			foreach ($signatures as $signature)
			{
				if (false !== strpos($content, $signature))
				{
					$signatureFound = true;
					break 2;
				}
			}
		}

		$calculatedToken = md5($signatureFound ? substr($content, $factor) : $content);

		return ($calculatedToken == $validToken);
	}
}