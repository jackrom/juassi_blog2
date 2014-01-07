<?php
include('include/admin-header.php');
juassi_set_admin_title('Show Config');
juassi_set_in_admin(true);
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Viewer', 'event-viewer.php');
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Details', 'event.php');
include('include/html-header.php');
//include 'webAnalytics/visitCounter.php';
//$contador = new visitCount();
//include 'userInfoGeneral.php';
?>
<?php
/* This file is part of JUASSI Analytics (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: show_config.php,v 1.72 2011/12/30 23:02:10 joku Exp $
 *  
 * Copyright (C) 2011-2012, the JUASSI Team (see doc/authors.txt for details)
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
if(!defined("_JUASSI_PAGE_NAME")){define("_JUASSI_PAGE_NAME", "Show Config");}
/////////////////////////
// Show Config JUASSI //
/////////////////////////

// START Time Measuring, load-time of the page (see config)
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

// Read constants
if (is_readable("constantes.php")) require_once("constantes.php");
else exit("ERROR: Imposible abrir constantes.php");

foreach (array($JUASSI_CONFIG_FILE, $JUASSI_LIB_PATH."selectlang.php", $JUASSI_ACCESS_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else exit(juassi_msg($i));
}

// Determine whether we are allowed to display show_config.php
if (empty($JUASSI_SHOW_CONFIG)) {
	header("Location: show_global.php");
	return;
}

// Generate page
echo '<div class=\"row-fluid\">'

    ."<table class=\"table table-striped table-bordered mediaTable\">"
// TABLE TITLES
    ."<thead><tr>"
            ."<td><b>".$translation['config_variable_name']."</b></td>"
            ."<td><b>".$translation['config_explanations']."</b></td>"
            ."<td><b>".$translation['config_variable_value']."</b></td>"
        ."</tr></thead><tbody><tr>"
            .$JUASSI_HTML->show_config("JUASSI_MAINSITE")
            .$JUASSI_HTML->show_config("JUASSI_SHOW_CONFIG", 1)
            .$JUASSI_HTML->show_config("JUASSI_TITLEBAR")
            .$JUASSI_HTML->show_config("JUASSI_LANGUAGE")
            .$JUASSI_HTML->show_config("JUASSI_MAXTIME")
            .$JUASSI_HTML->show_config("JUASSI_MAXVISIBLE")
            .$JUASSI_HTML->show_config("JUASSI_DETAILED_STAT_FIELDS")
            .$JUASSI_HTML->show_config("JUASSI_TIME_OFFSET")
            .$JUASSI_HTML->show_config("JUASSI_NO_DNS", 1)
            .$JUASSI_HTML->show_config("JUASSI_NO_HITS", 1)
            .$JUASSI_HTML->show_config("JUASSI_IGNORE_IP")
            .$JUASSI_HTML->show_config("JUASSI_IGNORE_REFER")
            .$JUASSI_HTML->show_config("JUASSI_IGNORE_BOTS")
            .$JUASSI_HTML->show_config("JUASSI_IGNORE_AGENT", 1)
            .$JUASSI_HTML->show_config("JUASSI_KILL_STATS", 1)
            .$JUASSI_HTML->show_config("JUASSI_PURGE_SINGLE", 1)
        //    .$JUASSI_HTML->show_config("JUASSI_EXT_LOOKUP")
    //    .$JUASSI_HTML->show_config("JUASSI_CSS_FILE")
        ."</tr>
      </tbody>
  </table>"
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
echo '</div></div>';
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