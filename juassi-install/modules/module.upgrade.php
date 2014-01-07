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


$ia_version = true;
include IA_HOME . 'system.php';

$iaOutput->layout()->title = 'Upgrade Wizard';

$iaOutput->steps = array(
	'check' => 'Pre-Upgrade Check',
	'download' => 'Start Upgrade',
	'finish' => 'Finish'
);

// check if a user performing an upgrade is administrator
$iaUsers = iaHelper::loadCoreClass('users', 'core');

$proceed = false;
if (iaUsers::hasIdentity())
{
	if (iaUsers::MEMBERSHIP_ADMINISTRATOR == iaUsers::getIdentity()->usergroup_id)
	{
		$proceed = true;
	}
}
if (!$proceed)
{
	$iaOutput->errorCode = 'authorization';

	return false;
}

switch ($step)
{
	case 'check':
		$patchVersion = trim($_SERVER['REQUEST_URI'], '/');
		$patchVersion = explode('/', $patchVersion);
		$patchVersion = end($patchVersion);

		if (!preg_match('#\d{1}\.\d{1}\.\d{1}#', $patchVersion))
		{
			if (!isset($_SESSION['upgrade_to']) && empty($_SESSION['upgrade_to']))
			{
				$iaOutput->errorCode = 'version';
			}
		}
		else
		{
			$_SESSION['upgrade_to'] = $patchVersion;
		}

		if (!iaHelper::hasAccessToRemote())
		{
			$iaOutput->errorCode = 'remote';
		}

		if (isset($_SESSION['upgrade_to']))
		{
			$iaOutput->version = $_SESSION['upgrade_to'];
		}

		break;

	case 'download':
		$patchUrl = 'http://tools.subrion.com/download/patch/%s/%s/';
		$patchUrl = sprintf($patchUrl, IA_VERSION, $_SESSION['upgrade_to']);

		$patchFileContent = iaHelper::getRemoteContent($patchUrl);

		if ($patchFileContent !== false)
		{
			$file = fopen(IA_HOME . 'tmp' . IA_DS . 'patch.iap', 'wb');
			fwrite($file, $patchFileContent);
			fclose($file);

			$iaOutput->size = strlen($patchFileContent);
		}
		else {
			$iaOutput->error = true;
		}

		break;

	case 'finish':
		require_once IA_INSTALL . 'classes/ia.patch.parser.php';
		require_once IA_INSTALL . 'classes/ia.patch.applier.php';

		try
		{
			$patchFileContent = @file_get_contents(IA_HOME . 'tmp' . IA_DS . 'patch.iap');
			if (false === $patchFileContent)
			{
				throw new Exception('Could not get downloaded patch file. Please download it again.');
			}

			$patchParser = new iaPatchParser($patchFileContent);

			$patch = $patchParser->patch;

			if ($patch['info']['version_from'] != str_replace('.', '', IA_VERSION))
			{
				throw new Exception('Patch is not applicable to your version of Subrion CMS.');
			}

			$forceMode = (bool)(isset($_GET['mode']) && 'force' == $_GET['mode']);

			$patchApplier = new iaPatchApplier(IA_HOME, array(
				'host' => INTELLI_DBHOST . ':' . INTELLI_DBPORT,
				'database' => INTELLI_DBNAME,
				'user' => INTELLI_DBUSER,
				'password' => INTELLI_DBPASS,
				'prefix' => INTELLI_DBPREFIX
			), $forceMode);
			$patchApplier->process($patch, $_SESSION['upgrade_to']);

			$textLog = $patchApplier->getLog();

			$tempFolder = IA_HOME . 'tmp' . IA_DS;
			iaHelper::cleanUpDirectoryContents($tempFolder);

			$logFile = 'upgrade-log-' . $patch['info']['version_to'] . '_' . date('d-m-y-H-i') . '.txt';
			$logFile = fopen($tempFolder . $logFile, 'wt');
			if ($logFile)
			{
				fwrite($logFile, $textLog);
				fclose($logFile);
			}

			$iaOutput->log = str_replace(array('SUCCESS', 'ERROR', 'ALERT'), array(
				'<p><span class="label label-success">SUCCESS</span>',
				'<p><span class="label label-important">ERROR</span>',
				'<p><span class="label label-warning">ALERT</span>'
			), nl2br($textLog));
		}
		catch (Exception $e)
		{
			@unlink(IA_HOME . 'tmp' . IA_DS . 'patch.iap');

			$iaOutput->message = $e->getMessage();
		}
		unset($_SESSION['upgrade_to']);

		break;
}