<?php ob_flush(); ?>
<html>
<head>
<title>Documento sin título</title>
<meta http-equiv="Content-Type" content="text/html; charset=Occidental ISO-8859-15" />
</head>

<body>
<div>
<img src="webAnalytics/pCharts/SmallStacked.png"/>
<img src="webAnalytics/pCharts/example3.png"/>
<img src="webAnalytics/pCharts/example4.png"/>
<img src="webAnalytics/pCharts/example5.png"/>
<img src="webAnalytics/pCharts/example6.png"/>
<img src="webAnalytics/pCharts/example7.png"/>
<img src="webAnalytics/pCharts/example8.png"/>
<img src="webAnalytics/pCharts/example9.png"/>
<img src="webAnalytics/pCharts/example10.png"/>
<img src="webAnalytics/pCharts/example11.png"/>
<img src="webAnalytics/pCharts/example12.png"/>
<img src="webAnalytics/pCharts/example13.png"/>
<img src="webAnalytics/pCharts/example14.png"/>
<img src="probarGrafico.png"/>
<img src="probarGrafico2.png"/>
<img src="probarGrafico3.png"/>
<img src="probarGrafico4.png"/>
<img src="probarGrafico5.png"/>
<img src="probarGrafico6.png"/>
<img src="GraficoPie.png"/>
</div>
</body>
</html>

<?php
include('../includes/crearGrafico.class.php');
require('webAnalytics/seoreport.php');
$grafico = new crearGrafico(400,300,'probarGrafico.png');
$data = array("Alex"=>99, "Mary"=>98, "Joan"=>70, "Ed"=>90);
$grafico->agregarData($data);
$grafico->setTitle("Test Scores");
$grafico->setTextColor("blue");
$grafico->dibujarGrafico();


ob_end_flush();
?>

<?php
$graph = new crearGrafico(500,350,'probarGrafico2.png');
$data = array(12124, 5535, 43373, 22223, 90432, 23332, 15544, 24523,
 32778, 38878, 28787, 33243, 34832, 32302);
$graph->agregarData($data);
$graph->setTitle('Widgets Produced');
$graph->setGradient('red', 'maroon');
$graph->dibujarGrafico();
?>

<?php
$graph = new crearGrafico(350,280, 'probarGrafico3.png');
$data = array("Roger"=>145, "Ralph"=>102, "Rhonda"=>123, "Ronaldo"=>137, 
"Rosario"=>149, "Robin"=>99, "Robert"=>88, "Rustof"=>111);
$graph->setBackgroundColor("black");
$graph->agregarData($data);
$graph->setBarColor('255,255,204');
$graph->setTitle('IQ Scores');
$graph->setTitleColor('yellow');
$graph->configurarYAxis(12, 'yellow');
$graph->configurarXAxis(20, 'yellow');
$graph->setGrid(false);
$graph->setGradient('silver', 'gray');
$graph->setBarOutlineColor('white');
$graph->setTextColor('white');
$graph->setDataPoints(true);
$graph->setDataPointColor('yellow');
$graph->setLine(true);
$graph->setLineColor('yellow');
$graph->dibujarGrafico();
?>

<?php 
$graph=new crearGrafico(520,280, 'probarGrafico4.png');
$data=array("Alpha" => 1145, "Beta" => 1202, "Cappa" => 1523, 
"Delta" => 1437, "Echo" => 949, "Falcon" => 999, "Gamma" => 1188);
$data2=array("Alpha" => 898, "Beta" => 1498, "Cappa" => 1343, 
"Delta" => 1345, "Echo" => 1045, "Falcon" => 1343, "Gamma" => 987);
$graph->agregarData($data, $data2);
$graph->setBarColor('blue', 'green');
$graph->setTitle('Company Production');
$graph->configurarYAxis(12, 'blue');
$graph->configurarXAxis(20);
$graph->setGrid(false);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Week-37', 'Week-38');
$graph->setXValuesHorizontal(true);
$graph->dibujarGrafico();
?>

<?php
$graph=new crearGrafico(500,280, 'probarGrafico5.png');
$data = array(23, 45, 20, 44, 41, 18, 49, 19, 42);
$data2 = array(15, 23, 23, 11, 54, 21, 56, 34, 23);
$data3 = array(43, 23, 34, 23, 53, 32, 43, 41);
$graph->agregarData($data, $data2, $data3);
$graph->setTitle('CPU Cycles x1000');
$graph->setTitleLocation('left');
$graph->setLegend(true);
$graph->setLegendTitle('Module-1', 'Module-2', 'Module-3');
$graph->setGradient('green', 'olive');
$graph->dibujarGrafico();
?>

<?php
$graph = new crearGrafico(450,300, 'probarGrafico6.png');
$data = array("Jan" => -10.1, "Feb" => -3.6, "Mar" => 11.0, "Apr" => 30.7, 
"May" => 48.6, "Jun" => 59.8, "Jul" => 62.5, "Aug" => 56.8, "Sep" => 45.5,
 "Oct" => 25.1, "Nov" => 2.7, "Dec" => -6.5);
$graph->agregarData($data);
$graph->setBarColor('navy');
$graph->configurarXAxis(20, 'blue');
$graph->setTitle('Average Temperature by Month, in Fairbanks Alaska');
$graph->setTitleColor('blue');
$graph->setGridColor('153,204,255');
$graph->setDataValues(true);
$graph->setDataValueColor('navy');
$graph->setDataFormat('degrees');
$graph->setGoalLine('32');
$graph->setGoalLineColor('red');
$graph->dibujarGrafico();
?>

<?php
include('../includes/crearGrafico_pie.class.php');
$graph = new crearGraficoPie(400, 200, 'graficoPie.png');
$data = array("CBS" => 6.3, "NBC" => 4.5,"FOX" => 2.8, "ABC" => 2.7, "CW" => 1.4);
$graph->agregarData($data);
$graph->generarDataLabel(600, 100);
$graph->setTitle('8/29/07 Top 5 TV Networks Market Share');
$graph->setLabelTextColor('50,50,50');
$graph->setLegendTextColor('50,50,50');
$graph->dibujarGrafico();




echo get_html('http://www.juassi.com');


?>