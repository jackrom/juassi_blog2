<?php
/* This file is part of JUASSI Analytics (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: mark_page.php,v 1.106 2011/12/30 23:02:10 joku Exp $
 *  
 * Copyright (C) 2001-2012, the BBClone Team (see doc/authors.txt for details)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * See doc/copying.txt for details
 */

////////////////////////////////
// Mark Page and Write to Var //
////////////////////////////////

if (!defined("_MARK_PAGE")) define("_MARK_PAGE", "1");
else return;

// Check for PHP 4.0.3 or older
if (!function_exists("array_sum")) exit("<hr /><b>Error:</b> PHP ".PHP_VERSION." is too old for JUASSI Analytics.");
elseif ((!defined("_JUASSI_DIR")) || (!is_readable(_JUASSI_DIR."constantes.php"))) return;
else require_once(_JUASSI_DIR."constantes.php");

foreach (array($JUASSI_LIB_PATH."io.php", $JUASSI_LIB_PATH."marker.php", $JUASSI_CONFIG_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else {
    if (empty($JUASSI_DEBUG)) return;
    else exit(juassi_msg($i));
  }
}

if (extension_loaded("sysvsem") && (stristr("sem", $JUASSI_USE_LOCK) !== false)) define("_JUASSI_SEM", 1);
if (extension_loaded("dio") && (stristr("dio", $JUASSI_USE_LOCK) !== false)) define("_JUASSI_DIO", 1);

// locking method must not be empty
$JUASSI_USE_LOCK = empty($JUASSI_USE_LOCK) ? "flk" :  $JUASSI_USE_LOCK;

if (!function_exists("flock") && (stristr("flk", $JUASSI_USE_LOCK) !== false)) {
  if (empty($JUASSI_DEBUG)) return;
  else exit(juassi_msg("", "l"));
}

if (!is_readable($JUASSI_CACHE_PATH)) {
  if (empty($JUASSI_DEBUG)) return;
  else exit(juassi_msg($JUASSI_CACHE_PATH));
}

ignore_user_abort(1);

// Don't write to counter files if we want to reset stats
if (empty($JUASSI_KILL_STATS)) {
  // needs to be always executed because otherwise our counter wouldn't work
  // any longer by the time $BBC_DEBUG was activated
  $i = juassi_exec_marker();

  // Don't process anything unless we are told to do so
  if (!defined("_OK")) {
    if (empty($JUASSI_DEBUG)) return ignore_user_abort(0);
    else exit($i);
  }
  else !empty($JUASSI_DEBUG) ? print($i) : "";
}

foreach (array("ACCESS_FILE", "LAST_FILE", "LOCK") as $i) {
  if (!is_readable(${"JUASSI_".$i})) {
    if (empty($JUASSI_DEBUG)) return;
    else exit(juassi_msg(${"JUASSI_".$i}));
  }
  if (!is_writable(${"JUASSI_".$i})) {
    if (empty($JUASSI_DEBUG)) return;
    else exit(juassi_msg(${"JUASSI_".$i}, "w"));
  }
}

// Kill'em all if requested and return
if (!empty($JUASSI_KILL_STATS)) {
  juassi_kill_stats();

  if (empty($JUASSI_DEBUG)) return;
  else exit(juassi_msg("", "k"));
}

foreach (array($JUASSI_LOG_PROCESSOR, $JUASSI_LIB_PATH."new_connect.php", $JUASSI_LIB_PATH."timecalc.php",
               $JUASSI_LIB_PATH."referrer.php", $JUASSI_LIB_PATH."charconv.php", $JUASSI_LIB_PATH."browser.php",
               $JUASSI_LIB_PATH."os.php", $JUASSI_LIB_PATH."robot.php") as $i) {
  if (!is_readable($i)) {
    if (empty($JUASSI_DEBUG)) return;
    else exit(juassi_msg($i));
  }
}

// Extension (country) look-up via plugin 
if ($JUASSI_EXT_LOOKUP) {
	$EXT_INCLUDE = $JUASSI_PLUGIN_PATH."ext_lookup_".strtolower($JUASSI_EXT_LOOKUP).".php";
	if (!is_readable($EXT_INCLUDE)) {
		if (empty($JUASSI_DEBUG)) return;
		else exit(juassi_msg($EXT_INCLUDE));
	}
	require_once($EXT_INCLUDE);
}

if (($JUASSI_TIMESTAMP <= filemtime($JUASSI_ACCESS_FILE)) || (function_exists("juassi_sort_time_sc"))) return;
clearstatcache();

if (filesize($JUASSI_LOCK) !== 0) {
  // crash recovery if lockfile is older than 30 secs
  if ($JUASSI_TIMESTAMP - filemtime($JUASSI_LOCK) > 30) fclose(fopen($JUASSI_LOCK, "wb"));
  return;
}

// write to lockfile
if (($al = juassi_begin_write($JUASSI_LOCK, "1")) !== false) {
  foreach (array($JUASSI_LOG_PROCESSOR, $JUASSI_LIB_PATH."new_connect.php", $JUASSI_LIB_PATH."timecalc.php",
                 $JUASSI_LIB_PATH."referrer.php", $JUASSI_LIB_PATH."charconv.php") as $i) require_once($i);

  require($JUASSI_ACCESS_FILE);
  require($JUASSI_LAST_FILE);

  // global and time stats
  if (juassi_add_new_connections_to_old()) {
    $af = juassi_begin_write($JUASSI_ACCESS_FILE, "<?php\nglobal \$access;\n\$access =\n".juassi_array_to_str($access).";\n?>");
    juassi_end_write($af);
    !empty($JUASSI_DEBUG) ? print(juassi_msg(basename($JUASSI_ACCESS_FILE), "o")) : "";
    juassi_update_last_access();

    $af = juassi_begin_write($JUASSI_LAST_FILE, "<?php\nglobal \$last;\n\$last =\n".juassi_array_to_str($last).";\n?>");
    juassi_end_write($af);
    !empty($JUASSI_DEBUG) ? print(juassi_msg(basename($JUASSI_LAST_FILE), "o")) : "";
  }
}
else (!empty($JUASSI_DEBUG) ? print(juassi_msg("", "l")) : "");

// once we've finished we unlock and truncate the lock file
juassi_end_write($al);
fclose(fopen($JUASSI_LOCK, "wb"));
ignore_user_abort(0);

// Exit if debug mode is turned on.
if (!empty($JUASSI_DEBUG)) exit();
?>
