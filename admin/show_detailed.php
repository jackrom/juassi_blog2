<?php
include('include/admin-header.php');
juassi_set_admin_title('Show Details');
juassi_set_in_admin(true);
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Viewer', 'event-viewer.php');
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Details', 'event.php');
include('include/html-header.php');
//include 'webAnalytics/visitCounter.php';
//$contador = new visitCount();
//include 'userInfoGeneral.php';
?>
<?php
/* This file is part of JUASSI (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: show_detailed.php,v 1.108 2011/12/30 23:02:10 joku Exp $
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
if(!defined("_JUASSI_PAGE_NAME")){define("_JUASSI_PAGE_NAME", "Show Detailed");}
/////////////////////////
// Show Detailed Stats //
/////////////////////////

// START Time Measuring, load-time of the page (see config)
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

// Read constants
if (is_readable("constantes.php")) require_once("constantes.php");
else exit("ERROR: Imposible abrir constantes.php");

foreach (array($JUASSI_CONFIG_FILE, $JUASSI_LIB_PATH."selectlang.php", $JUASSI_LAST_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else exit(juassi_msg($i));
}

// Functions to generate Stats for each row
function juassi_show_connect_field($connect, $field, $lng, $titles = false) {
  global $JUASSI_WHOIS, $JUASSI_IMAGES_PATH, $JUASSI_LIB_PATH, $JUASSI_HTML, $extensions, $translation;

  $id = empty($connect['id']) ? 0 : $connect['id'];

  switch ($field) {
    case "id":
      return "<div align=\"center\">".$connect['id']."&nbsp;</div>";

    case "time":
      return "<div align=\"center\">".str_replace(" ", "&nbsp;", date_format_translated($translation["global_time_format"], $connect['time']))."&nbsp;</div>";

    case "visits":
      return "<div align=\"center\"><a href=\"show_views.php?id=$id&amp;lng=$lng\">".$connect['visits']."</a>&nbsp;</div>";

    case "ext":
      if (isset($extensions[$connect['ext']])) $label = $extensions[$connect['ext']];
      else $label = $connect['ext'];
      return "<div align=\"center\">&nbsp;<img src=\"".$JUASSI_IMAGES_PATH."ext/".$connect['ext'].".png\" class=\"icon\" alt=\"".$label."\" title=\"".$label."\" />&nbsp;&nbsp;".$label."</div>";

    case "dns":
      if (strlen($connect['dns']) > 50) $connect['dns'] = "...".substr($connect['dns'], -47);
      $dns_str = $connect['dns'];
      $ip_str = $connect['ip'];
      if (!strcasecmp ($dns_str, $ip_str))
      	if ($JUASSI_WHOIS) return "<div align=\"center\">&nbsp;".$connect[$field]."&nbsp;<a href=\"".$JUASSI_WHOIS.$dns_str."\" target=\"blank\" title=\"".$translation['dstat_whois_information']."\">(?)</a></div>";
      return "<div align=\"center\">&nbsp;".$connect['dns']."</div>";

    case "referer":
      if (strpos($connect['referer'], "://") === false) return "&nbsp;";

      $url = substr(strstr($connect['referer'], "://"), 3);
      $str = (($slash = strpos($url, "/")) !== false) ? substr($url, 0, $slash) : $url;
      $str = (strlen($str) > 50) ? "...".substr($str, -47) : $str;

      return "<div align=\"center\">&nbsp;"
            ."<script type=\"text/javascript\">"
            ."<!--"
            ."document.write('<a href=\"http://$url\" rel=\"nofollow\" title=\"$str\">$str<\/a>');"
            ."-->"
            ."</script>"
            ."<noscript><span title=\"$str\">$str</span></noscript>"
            ."</div>";

    case "browser":
      if (!empty($connect['robot'])) return juassi_show_connect_field($connect, "robot", $lng);
      elseif (is_readable($JUASSI_LIB_PATH."browser.php")) require($JUASSI_LIB_PATH."browser.php");
      else return juassi_msg($JUASSI_LIB_PATH."browser.php");

      if (!$match = (!isset($browser[$connect[$field]]) ? false : $browser[$connect[$field]])) return "&nbsp;";

      $title = str_replace("other", $translation['misc_other'], $match['title']);

      return "<div align=\"center\">&nbsp;<img src=\"".$JUASSI_IMAGES_PATH."browser/".$match['icon'].".png\" class=\"icon\" alt=\"$title\" title=\"$title\" />"
      		."&nbsp;&nbsp;".str_replace(" ", "&nbsp;", $title)
            .(empty($connect['browser_note']) ? "" : "&nbsp;".$connect['browser_note'])."</div>";

    case "os":
      if (!empty($connect['robot'])) return juassi_show_connect_field($connect,"robot", $lng);
      elseif (is_readable($JUASSI_LIB_PATH."os.php")) require($JUASSI_LIB_PATH."os.php");
      else return juassi_msg($JUASSI_LIB_PATH."os.php");

      if (!$match = (!isset($os[$connect[$field]]) ? false : $os[$connect[$field]])) return "&nbsp;";

      $title = str_replace("other", $translation['misc_other'], $match['title']);
      if (isset($connect['screen_res'])) $res_str = "(".$connect['screen_res'].")";

      return "<div align=\"center\">&nbsp;<img src=\"".$JUASSI_IMAGES_PATH."os/".$match['icon'].".png\" class=\"icon\" alt=\"$title\" title=\"$title\" />"
      		."&nbsp;&nbsp;".str_replace(" ", "&nbsp;", $title)
      		.(empty($connect['os_note']) ? "" : "&nbsp;".$connect['os_note']).(isset($res_str) ? "&nbsp;".$res_str : "")."</div>";

    case "robot":
      if (is_readable($JUASSI_LIB_PATH."robot.php")) require($JUASSI_LIB_PATH."robot.php");
      else return juassi_msg($JUASSI_LIB_PATH."robot.php");

      if (!$match = (!isset($robot[$connect[$field]]) ? false : $robot[$connect[$field]])) return "&nbsp;";

      $title = str_replace("other", $translation['misc_other'], $match['title']);

      return "<div align=\"center\">&nbsp;<img src=\"".$JUASSI_IMAGES_PATH."robot/".$match['icon'].".png\" class=\"icon\" alt=\"$title\" title=\"$title\" />"
      		."&nbsp;&nbsp;".str_replace(" ", "&nbsp;", $title)
            .(empty($connect['robot_note']) ? "" : "&nbsp;".$connect['robot_note'])."</div>";

    case "page":
      if (!isset($connect['page'])) return "&nbsp;";

      $last_page = $titles[($connect['page'])];
      $last_page = ($last_page == "index") ? $translation["navbar_main_site"] : $last_page;

      return "<div align=\"center\">&nbsp;$last_page</div>";

    default:
      if (!isset($connect[$field]) || ($connect[$field] == "-")) return "&nbsp;";
      return "<div align=\"center\">&nbsp;".$connect[$field]."</div>";
  }
}

// Main functions to generate Stats
function juassi_rows_gen() {
  global $JUASSI_DETAILED_STAT_FIELDS, $JUASSI_MAXVISIBLE, $JUASSI_HTML, $translation, $last;

  $fields_title = array(
    "browser" => $translation['dstat_browser'],
    "dns" => $translation['dstat_dns'],
    "ext" => $translation['dstat_extension'],
    "id" => $translation['dstat_id'],
    "ip" => $translation['dstat_ip'],
    "os" => $translation['dstat_os'],
    "page" => $translation['dstat_last_page'],
    "prx_ip" => $translation['dstat_prx'],
    "referer" => $translation['dstat_from'],
    "search" => $translation['dstat_search'],
    "time" => $translation['dstat_time'],
    "visits" => $translation['dstat_visits'],
  );

  $fields = explode(",", str_replace(" ", "", $JUASSI_DETAILED_STAT_FIELDS));
  $nb_access = isset($last['traffic']) ? count($last['traffic']) : 0;
  $str = "<tr>";

  foreach ($fields as $val) $str .= "<td class=\"optional\">".$fields_title[$val]."</td>";

  $str .= "</tr>";

  for ($k = $nb_access - 1; $k >= max(0, $nb_access - $JUASSI_MAXVISIBLE); $k--) {
  	$style_class = $JUASSI_HTML->connect_color_class($last['traffic'][$k]);
    $str .= "<tr>";
    reset($fields);
    while (list(, $val) = each($fields)) {
      $cell = juassi_show_connect_field($last['traffic'][$k], $val, $JUASSI_HTML->lng, $last['pages']);
      $str .= "<td class=\"optional\">".(empty($cell) ? "&nbsp;" : $cell)."</td>";
    }
    $str .= "</tr>";
  }
  return $str;
}

// Generate page (with use of the functions above)
echo $JUASSI_HTML->color_explain()
        .'<div class=\"row-fluid\">
            <div class=\"span12\">'
                ."<table class=\"table table-striped table-bordered mediaTable\">"
                    .juassi_rows_gen()
                ."</table>"
                    .$JUASSI_HTML->copyright();

// END + DISPLAY Time Measuring, load-time of the page (see config)
global $JUASSI_LOADTIME;

if (!empty($JUASSI_LOADTIME)) {
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	$total_time = round(($finish - $start), 4);
	echo "<div class=\"loadtime\">".$translation['generated'].$total_time.$translation['seconds']."</div>";
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