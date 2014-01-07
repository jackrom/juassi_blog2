<?php
include('include/admin-header.php');
juassi_set_admin_title('Web Analytics');
juassi_set_in_admin(true);
//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Viewer', 'event-viewer.php');
$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Details', 'event.php');
include('include/html-header.php');
//include 'webAnalytics/visitCounter.php';
//$contador = new visitCount();
//include 'userInfoGeneral.php';
include('../includes/crearGrafico.class.php');
include('../includes/crearGrafico_pie.class.php');


if (is_readable("constantes.php")) require_once("constantes.php");
else exit("ERROR: Imposible abrir constantes.php");
foreach (array($JUASSI_CONFIG_FILE, $JUASSI_LIB_PATH."selectlang.php", $JUASSI_ACCESS_FILE) as $i) {
  if (is_readable($i)) require_once($i);
  else exit(juassi_msg($i));
}



$graph = new crearGraficoPie(430, 220, 'visitaPaises.png');
$data = $access['stat']['ext'];
$graph->agregarData($data);
$graph->setTitle('Total Visitas por Paises');
$graph->setTitleColor('#006D8D');
$graph->setLabelTextColor('50,50,50');
$graph->setLegendTextColor('50,50,50');
$graph->dibujarGrafico();



$graph = new crearGrafico(650,340,'visitasDiarias.png');
$data = $access['time']['day'];
$graph->agregarData($data);
$graph->setTitle('PPM Per Container');
$graph->setBars(false);
$graph->setLine(true);
$graph->setDataPoints(true);
$graph->setDataPointColor('#006D8D');
$graph->setDataValues(true);
$graph->setDataValueColor('#006D8D');
$graph->setGoalLine(.0025);
$graph->setGoalLineColor('red');
$graph->setXValuesHorizontal(true);
$graph->dibujarGrafico();


?>

<div class="row-fluid">
    <div class="span5">
            <h3 class="heading">Total Visitas por Pa&iacute;ses</h3>
            <div style="height:250px;width:100%;margin:30px 30px 10px"><img src="visitaPaises.png"/></div>
    </div>
    <div class="span7">
            <h3 class="heading"><?php echo $translation['tstat_last_month'] ?></h3>
            <div style="height:270px;width:90%;margin:15px auto 0"><img src="visitasDiarias.png"/></div>
    </div>
</div>


<?php echo juassi_show_access(); ?>




<script src="../juassi-resources/javascript/jquery.min.js"></script>
<!-- smart resize event -->
<script src="../juassi-resources/javascript/jquery.debouncedresize.min.js"></script>
<!-- hidden elements width/height -->
<script src="../juassi-resources/javascript/jquery.actual.min.js"></script>
<!-- js cookie plugin -->
<script src="../juassi-resources/javascript/jquery.cookie.min.js"></script>
<!-- main bootstrap js -->
<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
<!-- tooltips -->
<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>
<!-- jBreadcrumbs -->
<script src="../juassi-resources/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
<!-- sticky messages -->
<script src="../juassi-resources/lib/sticky/sticky.min.js"></script>
<!-- fix for ios orientation change -->
<script src="../juassi-resources/js/ios-orientationchange-fix.js"></script>
<!-- scrollbar -->
<script src="../juassi-resources/lib/antiscroll/antiscroll.js"></script>
<script src="../juassi-resources/lib/antiscroll/jquery-mousewheel.js"></script>
<!-- lightbox -->
<script src="../juassi-resources/lib/colorbox/jquery.colorbox.min.js"></script>
<!-- common functions -->
<script src="../juassi-resources/javascript/gebo_common.js"></script>
<!-- charts -->
<script src="../juassi-resources/lib/flot/jquery.flot.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.resize.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.pie.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.curvedLines.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.orderBars.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.multihighlight.min.js"></script>
<script src="../juassi-resources/lib/flot/jquery.flot.pyramid.min.js"></script>
<script src="../juassi-resources/lib/moment_js/moment.min.js"></script>
<!-- charts functions -->
<script src="../juassi-resources/javascript/gebo_charts.js"></script>



<?php
include 'include/sidebar.php';
//include 'include/html-footer.php';
?>