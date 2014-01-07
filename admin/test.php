<?php 
 //------ Counter -----------------------------------
 define("_JUASSI_PAGE_NAME", "Test");
 define("_JUASSI_DIR", "bbclone/");
 define("COUNTER", _JUASSI_DIR."mark_page.php");
 if (is_readable(COUNTER)) include_once(COUNTER);
 
  
 //------ Display Total Page Downloads -----------------------
 require("var/access.php");
 $totalvisits = $access["stat"]["totalvisits"];
 echo "Total Page Downloads  $totalvisits<br />";
 
 ?>

<?php 
 //------ Display Total Unique ----------------------
 require("var/access.php");
 $totalcount = $access["stat"]["totalcount"];
 echo "Total Unique Visitors  $totalcount<br />";
 ?>

<?php 
 require("var/access.php");
 $totalvisits   = $access["stat"]["totalvisits"];
 $totalcount    = $access["stat"]["totalcount"];
 $visitorsmonth = $access["time"]["month"][date("n")-1];
 $visitorstoday = $access["time"]["wday"][date("w")];
 $wday          = $access["time"]["wday"];

 for($week = 0; list(,$wdays) = each($wday); $week += $wdays);

 echo " "." ".date ("l")." ".date ("d F Y")." ".date ("G:i:s")." "
     .date ("T")." GMT ".date("O")
     ."<br /><br />\n"
     ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\">\n"
     ."<tr><td>Total Visitscode%</td><td align=\"left\">\n"
     ."<div align=\"right\">$totalvisits</div></td></tr>\n"
     ."<tr><td>Total Unique&nbsp;</td><td align=\"left\">\n"
     ."<div align=\"right\">$totalcount</div></td></tr>\n"
     ."<tr><td>Visitors Month&nbsp;</td><td align=\"left\">\n"
     ."<div align=\"right\">$visitorsmonth</div></td></tr>\n"
     ."<tr><td>Visitors Week&nbsp;</td><td align=\"left\">\n"
     ."<div align=\"right\">$week</div></td></tr>\n"
     ."<tr><td>Visitors Today&nbsp;</td><td align=\"left\">\n"
     ."<div align=\"right\">$visitorstoday</div></td></tr>\n"
     ."</table>\n";
 ?>

<?php 
 //-------Display Internet Explorer ---------------
 require("var/access.php");
 $browser = $access["stat"]["browser"]["explorer"];
 echo "Internet Explorer $browser";
 ?>

<?php 
 //-------Display page downloads of "Sales" -----------
 require("var/access.php");
 // number of hits by title
 echo "Sales: ".$access["page"]["Sales"]["count"]." visits";
 ?>



<?php 
//----Display Bargraph Week------------- 
require_once("var/access.php"); 
include_once("graphs.inc.php"); 
//-------------------------------------- 
$wday = $access ["time"]["wday"]; 
$week = implode(",", $wday); 
$graph = new BAR_GRAPH("hBar"); 
$graph->values = "$week"; 
$graph->labels = "Sun,Mon,Tue,Wed,Thu,Fri,Sat"; 
$graph->showValues = 1; 
$graph->barWidth = 10; 
$graph->barLength = 1.0; 
$graph->labelSize = 8; 
$graph->absValuesSize = 8; 
$graph->percValuesSize = 8; 
$graph->graphPadding = 5; 
$graph->graphBGColor = "#ABCDEF"; 
$graph->graphBorder = "1px solid blue"; 
$graph->barColors = "#A0C0F0?"; 
$graph->barBGColor = "#E0F0FF?"; 
$graph->barBorder = "2px outset white"; 
$graph->labelColor = "#000000"; 
$graph->labelBGColor = "#C0E0FF?"; 
$graph->labelBorder = "2px groove white"; 
$graph->absValuesColor = "#000000"; 
$graph->absValuesBGColor = "#FFFFFF"; 
$graph->absValuesBorder = "2px groove white"; 
echo $graph->create(); 
?>