<?php
include('include/admin-header.php');
juassi_set_admin_title('Web Analytics');
juassi_set_in_admin(true);
include('include/html-header.php');
//include 'webAnalytics/visitCounter.php';
//$contador = new visitCount();
//include 'userInfoGeneral.php';
?>
<?php
/* This file is part of JUASSI Analytics (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: show_global.php,v 1.108 2011/12/30 23:02:10 joku Exp $
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
if (is_readable("constantes.php")) require_once("constantes.php");
else exit("ERROR: Imposible abrir constantes.php");

foreach (array($JUASSI_CONFIG_FILE, $JUASSI_LIB_PATH."selectlang.php", $JUASSI_ACCESS_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else exit(juassi_msg($i));
}

// Generate page (with use of the functions above)

    //  .$JUASSI_HTML->last_reset()

echo juassi_show_browser();  
echo juassi_show_os();
            
   
echo juassi_show_extension();

    if (!empty($JUASSI_IGNORE_BOTS) && ($JUASSI_IGNORE_BOTS == 2)) {
      
    }
    else {
      echo juassi_show_robot();
    }

echo juassi_show_top_hosts();
echo juassi_show_top_pages();

echo juassi_show_top_origins();
echo juassi_show_top_keys();

echo juassi_show_access()
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
<script src="../juassi-resources/javascript/gebo_dashboard.js"></script>
<?php
include 'include/sidebar.php';
//include 'include/html-footer.php';
?>