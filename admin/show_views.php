<?php
include('include/admin-header.php');
juassi_set_admin_title('Show Views');
juassi_set_in_admin(true);
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Viewer', 'event-viewer.php');
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Details', 'event.php');
include('include/html-header.php');
//include 'webAnalytics/visitCounter.php';
//$contador = new visitCount();
//include 'userInfoGeneral.php';
?>
<?php
/* This file is part of BBClone (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: show_views.php,v 1.45 2011/12/30 23:02:10 joku Exp $
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
if(!defined("_JUASSI_PAGE_NAME")){define("_JUASSI_PAGE_NAME", "Show Views");}
//////////////////////
// Show Views Stats //
//////////////////////

// START Time Measuring, load-time of the page (see config)
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

// Read constants
if (is_readable("constantes.php")) require_once("constantes.php");
else exit("ERROR: Imposible cabrir a constantes.php");

foreach (array($JUASSI_CONFIG_FILE, $JUASSI_LIB_PATH."selectlang.php", $JUASSI_LAST_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else exit(juassi_msg($i));
}

function juassi_visit_time($this_time, $next_time, $nr = 0) {
  $diff = ($next_time !== false) ? ($next_time - $this_time) : 0;

  if ($diff <  1) return false;
  elseif ($diff >= 3600) {
    $h = floor($diff / 3600);
    $m = floor((($mod = $diff % 3600) / 60));
    $s = $mod % 60;

    return "$h&nbsp;h&nbsp;".(($m < 10) ? "0".$m : $m)."&nbsp;m&nbsp;".(($s < 10) ? "0".$s : $s)."&nbsp;s&nbsp;";
  }
  elseif (($diff > 60) && ($diff < 3600)) {
    return ((($rnd = floor(($diff / 60))) < 10) ? "0".$rnd : $rnd)."&nbsp;m&nbsp;".((($mod = $diff % 60) < 10) ?
           "0".$mod : $mod)."&nbsp;s";
  }
  else return (($diff < 10) ? "0".$diff : $diff)."&nbsp;s";
}

function juassi_list_visits() {
  global $JUASSI_MAXVISIBLE, $JUASSI_HTML, $translation, $last;
  if (_JUASSI_PHP < 410) global $HTTP_GET_VARS;
  
  $fields_title = array(
    "id"			=> $translation['dstat_id'],
    "prx_ip" 		=> $translation['dstat_prx'],
    "ip" 			=> $translation['dstat_ip'],
    "user_agent"	=> $translation['dstat_user_agent'],
    
  );

  $str = "<div class=\"row-fluid\">
              <div class=\"span12\">
                    <table class='table table-striped table-bordered mediaTable'>
                        <thead><tr>";

  foreach (array_keys($fields_title) as $val) $str .= "<td class=\"optional\"><b>".$fields_title[$val]."</b></td>";

  $str .= "</tr></thead>";


  $is_id = 0;

  if (((_JUASSI_PHP < 410) ? !isset($HTTP_GET_VARS['id']) : !isset($_GET['id'])) ||
      !preg_match(":^[\d]+$:", ((_JUASSI_PHP < 410) ? $HTTP_GET_VARS['id'] : $_GET['id'])) ||
      !is_array($last['traffic']) || empty($last['traffic'])) {
    return $translation['dstat_no_data'].".";
  }

  reset($last['traffic']);

  // Search for traffic row with selected id, result in $connect
  while (list(, $connect) = each($last['traffic'])) {
    if ((isset($connect['id'])) && ($connect['id'] == ((_JUASSI_PHP < 410) ? $HTTP_GET_VARS['id'] : $_GET['id']))) {
      $is_id = 1;
      break;
    }
  }
  
  //si no tenemos dato, no escribimos nada
  if (!$is_id) {
  	$str .= "</tbody><tr><td class=\"optional\">" . $translation['dstat_no_data'].".</td></tr></tbody>";
  	return $str;
  }

  $prx_ip = (($connect['prx_ip'] == "unknown") || ($connect['prx_ip'] == $connect['ip'])) ? $translation['global_no'] : $connect['prx_ip'];
  $previous_visit_count = $connect['visits'] - ($JUASSI_MAXVISIBLE + (isset($connect['off']) ? $connect['off'] : 0));

  $viewcount = count($connect['views']);
  
  $style_class = $JUASSI_HTML->connect_color_class($connect);

  $str .= "<tbody><tr>";
  $str .= "<td class=\"optimal\">".$connect['id']."</td>"
         ."<td class=\"optimal\">".$prx_ip."</td>"
         ."<td class=\"optimal\">".$connect['ip']."</td>"
         ."<td class=\"optimal\">&nbsp;"
         .(($connect['agent'] == "unknown") ? $translation['unknown'] : $connect['agent'])."</td></tr></tbody></table></div></div>";

  $str.= '<div class="row-fluid"><h3 class="heading"class="heading">Detalles del Registro</h3>';
  $str.= '            <table class="table table-striped table-bordered mediaTable"><thead><tr class=\"optimal\">';
  $fields_title2 = array(
    "nr" 		=> $translation['dstat_nr'],
    "pages" 		=> $translation['dstat_pages'],
    "visit_length" 	=> $translation['dstat_visit_length'],
    "reloads" 		=> $translation['dstat_reloads'],);
  foreach(array_keys($fields_title2) as $value){
        $str.= '<td><b>'.$fields_title2[$value].'</b></td>';}
     $str.= '</thead>
                    <tbody><tr class=\"optimal\">';
  for ($i = 0; $i < $viewcount; $i++) {
	if ($i != 0) {
		$str .= "";
                                        
	}
	
        $page = substr($connect['views'][$i], (strpos($connect['views'][$i], "|") + 1));
        $page = substr($page, 0, strpos($page, "|"));
        $page = ($last['pages'][$page] == "index") ? $translation['navbar_main_site'] : $last['pages'][$page];
        $reload = substr($connect['views'][$i], (strrpos($connect['views'][$i], "|") + 1)) - 1;
        $this_time = substr($connect['views'][$i], 0, strpos($connect['views'][$i], "|"));
        $next_time = !isset($connect['views'][($i + 1)]) ? $connect['time'] :
                     substr($connect['views'][($i + 1)], 0, strpos($connect['views'][($i + 1)], "|"));
        $length = juassi_visit_time($this_time, $next_time, $i);
        $length = (($i + 1 !== $viewcount) && ($length === false)) ? "00&nbsp;s" : $length;
        $visit_count = ($i + (($previous_visit_count > 0) ? ($previous_visit_count + 1) : 1));

        $str .= "<td class=\"optimal\">".$visit_count."</td>\n"
               ."<td class=\"optimal\">&nbsp;".$page."</td>"
               ."<td class=\"optimal\">".$length."&nbsp;</td>\n"
               ."<td class=\"optimal\">".(($reload > 0) ? $reload : "")."</td>"
               ."</tr>";
  }
  
  $str .= "</tbody></table>";
  
  return $str;
}

// Generate page (with use of the functions above)
echo $JUASSI_HTML->color_explain()
    .juassi_list_visits()
    .$JUASSI_HTML->copyright();

// END + DISPLAY Time Measuring, load-time of the page (see config)
global $JUASSI_LOADTIME;

if (!empty($JUASSI_LOADTIME)) {
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	$total_time = round(($finish - $start), 4);
	echo "<div class=\"loadtime\">".$translation['generated'].$total_time.$translation['seconds']."</div>\n";
}


?>


<script src="../juassi-resources/javascript/jquery.min.js"></script>
<!-- smart resize event -->
<script src="../juassi-resources/javascript/jquery.debouncedresize.min.js"></script>
<!-- hidden elements width/height -->
<script src="../juassi-resources/javascript/jquery.actual.min.js"></script>
<!-- js cookie plugin -->
<script src="../juassi-resources/javascript/jquery.cookie.min.js"></script>
<!-- main bootstrap js -->
<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap plugins -->
<script src="../juassi-resources/javascript/bootstrap.plugins.min.js"></script>
<!-- tooltips -->
<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>
<!-- jBreadcrumbs -->
<script src="../juassi-resources/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
<!-- sticky messages -->
<script src="../juassi-resources/lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="../juassi-resources/javascript/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="../juassi-resources/lib/antiscroll/antiscroll.js"></script>
<script src="../juassi-resources/lib/antiscroll/jquery-mousewheel.js"></script>
<!-- common functions -->
<script src="../juassi-resources/javascript/gebo_common.js"></script>

<!-- colorbox -->
<script src="../juassi-resources/lib/colorbox/jquery.colorbox.min.js"></script>
<!-- datatable -->
<script src="../juassi-resources/lib/datatables/jquery.dataTables.min.js"></script>
<!-- additional sorting for datatables -->
<script src="../juassi-resources/lib/datatables/jquery.dataTables.sorting.js"></script>
<!-- tables functions -->
<script src="../juassi-resources/javascript/gebo_tables.js"></script>
<?php
include 'include/sidebar.php';
//include 'include/html-footer.php';
?>
