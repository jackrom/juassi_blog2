<?php
/* This file is part of JUASSI Analytics (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: io.php,v 1.80 2011/12/30 23:03:47 joku Exp $
 *  
 * Copyright (C) 2011-2012, the Juassi Team (see doc/authors.txt for details)
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

///////////////////////
// IO (Input/Output) //
///////////////////////

// remove unwanted stuff from user input
function juassi_clean($input, $sep = 0) {
  $sp = strpos($input, $sep);
  // only look for separator if really needed
  $input = (!empty($sep) && ($sp !== false)) ? substr($input, 0, $sp) : $input;
  $input = strip_tags(str_replace("\\", "/", stripslashes($input)));
  $input = trim(str_replace("$", "&#36;", htmlspecialchars($input, ENT_QUOTES)));

  // Limit the maximum length to 512 chars
  return substr($input, 0, 512);
}

//initialize the bbc_marker class
function juassi_exec_marker() {
  $juassi_marker = new juassi_marker;

  if ($juassi_marker->ignored === true) return juassi_msg(false, "i");
  else $msg = $juassi_marker->juassi_write_entry();

  switch ($msg[1]) {
    case "o":
      if (!defined("_OK")) define("_OK", 1);
      return juassi_msg($msg[0], "o");
    case "l":
      return juassi_msg($msg[0], "l");
    case "w":
      return juassi_msg($msg[0], "w");
    default:
      return juassi_msg($msg[0]);
  }
}

// kill stats if desired
function juassi_kill_stats() {
  global $JUASSI_ACCESS_FILE, $JUASSI_CACHE_PATH, $JUASSI_COUNTER_FILES, $JUASSI_COUNTER_PREFIX, $JUASSI_COUNTER_SUFFIX,
         $JUASSI_DEBUG, $JUASSI_LAST_FILE;

  for ($i = 0; $i < $JUASSI_COUNTER_FILES; $i++) {
    $file = $JUASSI_CACHE_PATH.$JUASSI_COUNTER_PREFIX.$i.$JUASSI_COUNTER_SUFFIX;

    fclose(fopen($file, "wb"));
  }

  fclose(fopen($JUASSI_ACCESS_FILE, "wb"));
  fclose(fopen($JUASSI_LAST_FILE, "wb"));
}

// Parse all counter files of var/ and return an array of N rows,
// with N as amount of new connections, sorted in increasing time of connection.
// The counters files are emptied afterwards.
function juassi_counter_to_array() {
  global $JUASSI_CACHE_PATH, $JUASSI_COUNTER_PREFIX, $JUASSI_COUNTER_SUFFIX, $JUASSI_SEP, $JUASSI_COUNTER_COLUMNS,
         $JUASSI_COUNTER_COLUMN_NAMES, $JUASSI_COUNTER_FILES, $JUASSI_DEBUG;

  for ($i = 0, $nb_new_entry = 0; $i < $JUASSI_COUNTER_FILES; $i++) {
    $file = $JUASSI_CACHE_PATH.$JUASSI_COUNTER_PREFIX.$i.$JUASSI_COUNTER_SUFFIX;

    if (!is_readable($file)) {
      !empty($JUASSI_DEBUG) ? print(juassi_msg($file)) : "";
      $no_acc = 1;
      continue;
    }

    $fp = fopen($file, "rb");
    //Obtenemo una línea del puntero en el archivo y lo examinamos para tratar campos CSV
    while (($line = fgetcsv($fp, 4096, $JUASSI_SEP)) !== false) {
        //pasamos un bucle por todas las linea y eliminamos los caracteres en blanco
      for ($j = 0, $max = count($line); $j < $max; $j++) $line[$j] = trim($line[$j]);
      // Evitamos el archivo mal contado
      if ((empty($line[0])) || (!preg_match(":^[0-9]+$:",$line[0]))) continue;

      for ($k = 0; ($k < $JUASSI_COUNTER_COLUMNS); $k++) {
        $counter_array[$nb_new_entry][($JUASSI_COUNTER_COLUMN_NAMES[$k])] = $line[$k];
      }
      $nb_new_entry++;
    }
    fclose($fp);

    // reset the counter files
    if (is_writable($file)) fclose(fopen($file, "wb"));
    else (empty($no_acc) && !empty($JUASSI_DEBUG)) ? print(juassi_msg($file, "w")) : "";
  }
  if (!empty($counter_array)) usort($counter_array, "juassi_sort_time_sc");
  return (empty($counter_array) ? array() : $counter_array);
}

function juassi_array_to_str(&$tab) {
// This function return a string description of an array.
// Format (_ == space):
// |_array(
// |__key1 => scal1, key2 => scal2, ...
// |__key3 =>
// |___array(
// |____key1 => scal1, ...
// |___),
// |__key4 => scal4, ...
// |_)

  static $indent = "";

  $oldindent = $indent;
  $indent   .= "  ";
  $sep       = "";

  $str = $indent."array(\n";
  $last_is_array = false;
  $k = 0;

  reset($tab);

  while (list($key, $val) = each($tab)) {
    // The separator treatment
    if (($last_is_array) || (is_array($val) && ($k !== 0))) {
      $str .= $sep."\n";
    }
    else $str .= $sep;

    // The key treatment
    if (preg_match(":^[0-9]+$:", $key)) {
      if ($key !== $k) {
        $str .= (((is_array($val)) || ($k === 0) || ($last_is_array)) ? "$indent  " : "")
               ."$key =>".((is_array($val)) ? "\n" : " ");
      }
      else $str .= ($k === 0) ? (is_array($val) ? "" : "$indent  ") : "";
    }
    else {
      $str .= (((is_array($val)) || ($k === 0) || ($last_is_array)) ? "$indent  " : "")
             ."\"$key\" =>".((is_array($val)) ? "\n" : " ");
    }

    // The value treatment
    $last_is_array = false;
    if (is_array($val)) {
      $str .= juassi_array_to_str($val);
      $last_is_array = true;
      $sep = ",";
    }
    else {
      $str .= (preg_match(":^[0-9]+$:", $val) ? $val : "\"$val\"");
      $sep = ", ";
    }
    $k++;
  }
  $str .= "\n$indent)";
  $indent = $oldindent;
  return $str;
}

function juassi_ftok($file) {
  $stat = stat($file);
  $dev = decbin($stat[0]);
  $inode = decbin($stat[1]);

  foreach (array("dev", "inode") as $what) {
    $lim = ($what == "inode") ? 16 : 8;

    if ($$what < $lim) $$what = str_pad($$what, $lim, 0);
    elseif ($$what > $lim) $$what = substr($$what, -$lim);
    else continue;
  }
  return bindec("1111000".$dev.$inode);
}

// returns the lock id
function juassi_semlock($file) {
  $id = sem_get(juassi_ftok($file), 1);

  sem_acquire($id);
  return $id;
}

// write data, returns file pointer on success else false
function juassi_begin_write($file, $data) {
  $fp = defined("_JUASSI_DIO") ? dio_open($file, O_RDWR | O_APPEND) : fopen($file, "rb+");

  if (defined("_JUASSI_DIO") && (dio_fcntl($fp, F_SETLK, 1) !== -1)) {
    dio_seek($fp, 0);
    dio_truncate($fp, 0);
    dio_write($fp, $data);
    return $fp;
  }
  elseif (defined("_JUASSI_SEM") ? ($id = juassi_semlock($file)) : flock($fp, LOCK_EX)) {
    rewind($fp);
    fwrite($fp, $data);
    fflush($fp);
    ftruncate($fp, ftell($fp));
    return (defined("_JUASSI_SEM") ? array($fp, $id) : $fp);
  }
  else {
    defined("_JUASSI_DIO") ? dio_close($fp) : fclose($fp);
    return false;
  }
}

// finish writing to a file
function juassi_end_write($fp) {
  if (defined("_JUASSI_SEM") ? ((!is_array($fp)) || ($fp[0] === false)) : ($fp === false)) return false;

  if (defined("_JUASSI_DIO")) {
    dio_fcntl($fp, F_SETLK, 0);
    dio_close($fp);
  }
  else {
    defined("_JUASSI_SEM") ? sem_release($fp[1]) : flock($fp, LOCK_UN);
    fclose(defined("_JUASSI_SEM") ? $fp[0] : $fp);
  }
  return true;
}
?>