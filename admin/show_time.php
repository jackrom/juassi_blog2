<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Show-time');
	juassi_set_in_admin(true);
	include('include/html-header.php');
        include('../includes/crearGrafico.class.php');
?>
<?php
/* This file is part of JUASSI (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: show_time.php,v 1.77 2011/12/30 23:02:10 joku Exp $
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
if(!defined("_JUASSI_PAGE_NAME")){define("_JUASSI_PAGE_NAME", "Show Time");}

?>

<?php


/////////////////////
// Show Time Stats //
/////////////////////

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

// funcion que calcula las estadisticas
function juassi_graph_spacer($last, $nr, $values) {
  if ($nr == $last) $str = "none";
  else $str = ($values[$nr] > $values[($nr + 1)]) ? "solid" : "none";

  $str .= " none ";

  if ($nr === 0) $str .= "none";
  else $str .= ($values[$nr] >= $values[($nr - 1)]) ? "solid" : "none";

  return $str;
}

// Dibuja una secuencia de numeros enteros positivos $y en funcion de una secuencia $x
// (sea lo que sea) en un marco tamaño [$width * $height] in pixels
function juassi_plot($x, $y, $width, $height) {
  global $JUASSI_IMAGES_PATH, $translation;

  // Varios tamaños
  $nb_x = count($x);
  $nb_y = count($y);
  $nb = !empty($x) ? min($nb_x, $nb_y) : $nb_y;
  $bar_width = round($width / $nb);

  $sum_y = array_sum($y);
  $nb_e = $nb;
  if ($nb_e == 12) {
  	for ($i = 0; $i < 12; $i++) {
            if ($y[$i] != 0) {
        $nb_e = $nb_e-$i;
        break;
      }
    }
  }
  $avarage=round($sum_y/$nb_e);

  // Buscando el maximo valor
  for ($k = 0, $max_y = 0; $k < $nb; $max_y = max($y[$k],$max_y), $k++);
  // La altura de una unidad
  $unit_height = !empty($max_y) ? (0.92 * ($height / $max_y)) : 0;

  $avarage_height = round($max_y*$unit_height) - round($avarage*$unit_height)+17;
  $str = "<div><div class=\"graph-line\" style=\"top:".$avarage_height."px; \"><p align=\"left\" style=\"color:#df5959; padding:0px;margin:0px;\"><em>".$translation['tstat_average'].": ".$avarage."</em></p></div>";
  $str  .= "<table class=\"centerbox\">\n"
         ."<tr class=\"graph-background\">\n";

  for ($k = 0; $k < $nb; $k++) {
    $bar_height = round($y[$k] * $unit_height);

    $str .= "<td class=\"nopadding\" width=\"$bar_width\" height=\"$height\">\n"
           ."<table class=\"centerdata\">\n"
           ."<tr>\n";

    if ($y[$k]) {
      $numb = ($y[$k] >= 1000) ? substr(($tmp = $y[$k] / 1000) ,0 , (strpos($tmp, ".") + 2))."k" : $y[$k];

      $juassi_column_color = "column";  // default column color
      if ($nb > 27 || $nb == 7) {  // make sure it's a month and not a week, hour, etc.
        $juassi_weekend = mktime(0, 0, 0, date("m"), date("d") - ($nb - $k - 1), date("Y"));
        if (date("w", $juassi_weekend) == 0 || date("w", $juassi_weekend) == 6) {  // 0 is Sunday and 6 is Saturday
          $juassi_column_color = "weekend-column";  // column color for weekends
        }
      } else if ($nb == 24) {
        $juassi_weekend = mktime(date("G") - ($nb - $k - 1), 0, 0, date("m"), date("d"), date("Y"));
      } else {
        $juassi_weekend = mktime(0, 0, 0, date("m") - ($nb - $k - 1), date("d"), date("Y"));
      }

      $str .= "<td class=\"sky\" height=\"".($height - $bar_height)."\" "
           ."style=\"border-style: none ".juassi_graph_spacer(($nb - 1), $k, $y)."\">"
           ."<span class=\"label-graph-ydata\">$numb</span>"
           ."</td>\n"
           ."</tr>\n"
           ."<tr class=\"".$juassi_column_color."\">\n";
      if ($nb > 27 || $nb == 7) {  // make sure it's a month and not a week, hour, etc.
      	// week (7 days), and full month (>27 days)
        $str .= "<td title=\"".date_format_translated($translation['global_day_format'], $juassi_weekend)."&nbsp;&laquo;".$y[$k]."&raquo;\" height=\"$bar_height\" class=\"brd\" ";
      } else if ($nb == 24) {
      	// hours (24)
        $str .= "<td title=\"".date_format_translated($translation['global_hours_format'], $juassi_weekend)."&nbsp;&laquo;".$y[$k]."&raquo;\" height=\"$bar_height\" class=\"brd\" ";  
      } else {
      	// months (12)
        $str .= "<td title=\"".date_format_translated($translation['global_month_format'], $juassi_weekend)."&nbsp;&laquo;".$y[$k]."&raquo;\" height=\"$bar_height\" class=\"brd\" ";  
      }
      $str .= "style=\"border-style: solid ".juassi_graph_spacer(($nb - 1), $k, $y)."\"></td>\n";
    }
    else $str .= "<td height=\"$height\"></td>\n";

    $str .= "</tr>\n"
           ."</table>\n"
           ."</td>\n";
  }

  $str .= "</tr>\n"
         ."<tr class=\"bottombox\">\n";

  for ($k = 0; $k < $nb; $k++) {
    $str .= "<td class=\"center\" width=\"$bar_width\" height=\"15\">\n"
           ."<table class=\"brd\" style=\"border-style: solid none none\" align=\"center\" border=\"0\" "
           ."cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n"
           ."<tr>\n"
           ."<td class=\"label-graph-xdata\">".$x[$k]."</td>\n"
           ."</tr>\n"
           ."</table>\n"
           ."</td>\n";
  }

  $str .= "</tr>\n"
         ."</table>\n";

  $str .= "</div>";
  return $str;
}

function juassi_show_plot_time_type($time_type, $width, $height) {
  global $JUASSI_TIMESTAMP, $JUASSI_TIME_OFFSET, $translation, $access;

  $last_time = isset($access['time']['last']) ? $access['time']['last'] : 0;
  $current_time = $JUASSI_TIMESTAMP + ($JUASSI_TIME_OFFSET * 60);
  $nb_seconds_in_day  = 86400;
  $nb_seconds_in_week = 7 * $nb_seconds_in_day;
  $last_month = date("n", $last_time) - 1;
  $nb_seconds_in_last_year = (date("L", $last_time) ? 366 : 365) * $nb_seconds_in_day;

  switch ($time_type) {
    case "hour":
      $current_hour = date("G", $current_time);
      $last_hour    = date("G", $last_time);

      for ($k = $current_hour - 23; $k <= $current_hour; $x[] = ($k < 0) ? ($k + 24) : $k, $k++);
      for ($k = 0; $k < 24; $y[$k] = 0, $k++);
      if (($current_time - $last_time) <= $nb_seconds_in_day) {
        $elapsed = $current_hour - $last_hour;
        $elapsed = ($elapsed < 0) ? ($elapsed + 24) : $elapsed;

        for ($k = $elapsed; $k < 24; $k++) {
          $y[$k - $elapsed] = $access['time']['hour'][($last_hour + 1 + $k) % 24];
        }
      }
      break;

    case "wday":
      $day_name = array($translation['tstat_su'], $translation['tstat_mo'], $translation['tstat_tu'], $translation['tstat_we'], $translation['tstat_th'], $translation['tstat_fr'], $translation['tstat_sa']);

      $current_wday = date("w", $current_time);
      $last_wday    = date("w", $last_time);

      for ($k = $current_wday - 6; $k <= $current_wday;
        $x[] = $day_name[($k < 0) ? $k + 7 : $k], $k++);
      for ($k = 0; $k < 7; $y[$k] = 0, $k++);
      if (($current_time - $last_time) <= $nb_seconds_in_week) {
        $elapsed = $current_wday - $last_wday;
        $elapsed = ($elapsed < 0) ? $elapsed + 7 : $elapsed;

        for ($k = $elapsed; $k < 7; $k++) {
          $y[$k - $elapsed] = $access['time']['wday'][($last_wday + 1 + $k) % 7];
        }
      }
      break;

    case "day":
      // We suppose that the first day of the month is 0 for array compatibility
      $current_day    = date("j", $current_time) - 1;
      $last_day       = date("j", $last_time) - 1;
      $time_in_prec_month = $current_time - ($current_day + 1) * $nb_seconds_in_day;
      $lg_prec_month  = date("t", $time_in_prec_month);
      $lg_prec_month  = ($current_day >= $lg_prec_month) ? ($current_day + 1) : $lg_prec_month;
      $current_month  = date("n", $current_time);
      $prec_month     = date("n", $time_in_prec_month);

      // Computing the $x
      for ($k = $current_day + 1; $k < $lg_prec_month; $x[] = ($k + 1), $k++);
      for ($k = 0; $k <= $current_day; $x[] = ($k + 1), $k++);
      // Computing the $y
      for ($k = 0; $k < 31; $y[$k] = 0, $k++);
      if (($current_time - $last_time) <= ($lg_prec_month * $nb_seconds_in_day)) {
        $elapsed = $current_day - $last_day;
        $elapsed = ($elapsed < 0) ? ($elapsed + $lg_prec_month) : $elapsed;

        for ($k = $elapsed; $k < $lg_prec_month; $k++) {
          $y[$k - $elapsed] = $access['time']['day'][($last_day + 1 + $k) % $lg_prec_month];
        }
      }
      break;

    case "month":
      $month_name = array($translation['tstat_jan'], $translation['tstat_feb'], $translation['tstat_mar'], $translation['tstat_apr'], $translation['tstat_may'], $translation['tstat_jun'],
      					  $translation['tstat_jul'], $translation['tstat_aug'], $translation['tstat_sep'], $translation['tstat_oct'], $translation['tstat_nov'], $translation['tstat_dec']);

      $current_month = date("n", $current_time) - 1;
      $last_month    = date("n", $last_time) - 1;

      for ($k = $current_month - 11; $k <= $current_month; $x[] = $month_name[(($k < 0) ? ($k + 12) : $k)], $k++);
      for ($k = 0; $k < 12; $y[$k] = 0, $k++);

      if (($current_time - $last_time) <= $nb_seconds_in_last_year) {
        $elapsed = $current_month - $last_month;
        $elapsed = ($elapsed < 0) ? $elapsed + 12 : $elapsed;

        for ($k = $elapsed; $k < 12; $k++) {
          $y[$k - $elapsed] = $access['time']['month'][(($last_month + 1 + $k) % 12)];
        }
      }
      break;
  }
  return juassi_plot($x, $y, $width, $height);
}

// Generate page (with use of the functions above)
function mostrarGrafico($ancho, $alto, $data, $typeGraph, $name){
    global $JUASSI_TIMESTAMP, $JUASSI_TIME_OFFSET, $translation, $access;
    global $JUASSI_IMAGES_PATH, $translation;
    
    $last_time = isset($access['time']['last']) ? $access['time']['last'] : 0;
    $current_time = $JUASSI_TIMESTAMP + ($JUASSI_TIME_OFFSET * 60);
    $nb_seconds_in_day  = 86400;
    $nb_seconds_in_week = 7 * $nb_seconds_in_day;
    $last_month = date("n", $last_time) - 1;
    $nb_seconds_in_last_year = (date("L", $last_time) ? 366 : 365) * $nb_seconds_in_day;
  
    switch($data){
        case 'horas':
            $data = $access['time']['hour'];
            break;
        case 'dias':
            $data = $access['time']['wday'];
            break;
        case 'dia':
            $data = $access['time']['day'];
            break;
        case 'month':
            $data = $access['time']['month'];
            break;
    }
    switch($typeGraph){
        case 1:
            $graph = new crearGrafico($ancho,$alto,$name);
            $data = $access['time']['hour'];
            
            $graph->agregarData($data);
            $graph->setTitle('Visitas por horas ultimo dia');
            $graph->setTitleColor('#006D8D');
            $graph->setBarColor('#3993ba');
            $graph->setDataValues(true);
            $graph->setXValuesHorizontal(true);
            $graph->dibujarGrafico();
            break;
        case 2:
            $avarage=round($sum_y/$nb_e);
            $day_name = array($translation['tstat_su'], $translation['tstat_mo'], $translation['tstat_tu'], $translation['tstat_we'], $translation['tstat_th'], $translation['tstat_fr'], $translation['tstat_sa']);

            $current_wday = date("w", $current_time);
            $last_wday    = date("w", $last_time);

            for ($k = $current_wday - 6; $k <= $current_wday;$x[] = $day_name[($k < 0) ? $k + 7 : $k], $k++);
            for ($k = 0; $k < 7; $y[$k] = 0, $k++);
            if (($current_time - $last_time) <= $nb_seconds_in_week) {
              $elapsed = $current_wday - $last_wday;
              $elapsed = ($elapsed < 0) ? $elapsed + 7 : $elapsed;

              for ($k = $elapsed; $k < 7; $k++) { 
                $y[$k - $elapsed] = $access['time']['wday'][($last_wday + 1 + $k) % 7];
              }
            }
            $graph = new crearGrafico($ancho,$alto,$name);
            $data = $access['time']['wday'];
            $graph->agregarData($data);
            $graph->setTitle('Visitas ultima semana');
            $graph->setTitleColor('#006D8D');
            $graph->setDataValues(true);
            $graph->setXValuesHorizontal(true);
            $graph->setBarColor('#3993ba');
            $graph->dibujarGrafico();
            break;
        case 3:
            $month_name = array($translation['tstat_jan'], $translation['tstat_feb'], $translation['tstat_mar'], $translation['tstat_apr'], $translation['tstat_may'], $translation['tstat_jun'],
      					  $translation['tstat_jul'], $translation['tstat_aug'], $translation['tstat_sep'], $translation['tstat_oct'], $translation['tstat_nov'], $translation['tstat_dec']);

            $current_month = date("n", $current_time) - 1;
            $last_month    = date("n", $last_time) - 1;

            for ($k = $current_month - 11; $k <= $current_month; $x[] = $month_name[(($k < 0) ? ($k + 12) : $k)], $k++);
            for ($k = 0; $k < 12; $y[$k] = 0, $k++);

            if (($current_time - $last_time) <= $nb_seconds_in_last_year) {
              $elapsed = $current_month - $last_month;
              $elapsed = ($elapsed < 0) ? $elapsed + 12 : $elapsed;

              for ($k = $elapsed; $k < 12; $k++) {
                $y[$k - $elapsed] = $access['time']['month'][(($last_month + 1 + $k) % 12)];
              }
            }
            $graph = new crearGrafico($ancho,$alto,$name);
            //$k = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
            $data = $access['time']['month'];
            $graph->agregarData($data);
            $graph->setTitle('Visitas por mes ultimo anio');
            $graph->setTitleColor('#006D8D');
            $graph->setDataValues(true);
            $graph->setBarColor('#3993ba');
            $graph->setXValuesHorizontal(true);
            $graph->dibujarGrafico();
            break;
        case 4:
            $current_day    = date("j", $current_time) - 1;
            $last_day       = date("j", $last_time) - 1;
            $time_in_prec_month = $current_time - ($current_day + 1) * $nb_seconds_in_day;
            $lg_prec_month  = date("t", $time_in_prec_month);
            $lg_prec_month  = ($current_day >= $lg_prec_month) ? ($current_day + 1) : $lg_prec_month;
            $current_month  = date("n", $current_time);
            $prec_month     = date("n", $time_in_prec_month);

            // Computing the $x
            for ($k = $current_day + 1; $k < $lg_prec_month; $x[] = ($k + 1), $k++);
            for ($k = 0; $k <= $current_day; $x[] = ($k + 1), $k++);
            // Computing the $y
            for ($k = 0; $k < 31; $y[$k] = 0, $k++);
            if (($current_time - $last_time) <= ($lg_prec_month * $nb_seconds_in_day)) {
              $elapsed = $current_day - $last_day;
              $elapsed = ($elapsed < 0) ? ($elapsed + $lg_prec_month) : $elapsed;

              for ($k = $elapsed; $k < $lg_prec_month; $k++) {
                $y[$k - $elapsed] = $access['time']['day'][($last_day + 1 + $k) % $lg_prec_month];
              }
            }
            $graph = new crearGrafico($ancho,$alto,$name);
            //$k = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
            $data  = $access['time']['day'];
            
            $graph->agregarData($data);
            $graph->setTitle('Visitas por dias ultimo mes');
            $graph->setTitleColor('#006D8D');
            $graph->setXValues(true);
            $graph->setBarColor('#3993ba');
            $graph->setDataValues(true);
            $graph->setXValuesHorizontal(true);
            $graph->dibujarGrafico();
            break;
    }
    
}

echo $JUASSI_HTML->html_begin();
mostrarGrafico(1000, 250, 'horas', 1, 'lastDay.png');
mostrarGrafico(450,300,'dias',2,'lastDias.png');
mostrarGrafico(1000,300,'dia',3,'lastDia.png');
mostrarGrafico(1000,300,'month',4,'lastMonth.png');
echo '<div class="row-fluid">
    <div class="span12">
            <h3 class="heading">'.$translation['tstat_last_day'].'</h3>
            <div id="fl_a" style="width:100%;margin:40px auto 10px"><img src="lastDay.png" /></div>
            <div class="clearfix chart_colors">
                    <label class="radio inline"><input type="radio" value="ch_blue" name="ch_color" id="chC_blue" />Blue</label>
                    <label class="radio inline"><input type="radio" value="ch_green" name="ch_color" id="chC_green" />Green</label>
                    <label class="radio inline"><input type="radio" value="ch_brown" name="ch_color" id="chC_brown" checked="checked" />Brown</label>
            </div>
    </div>
</div>';
echo '<div class="row-fluid">
        <div class="span6">
                <h3 class="heading">'.$translation['tstat_last_week'].'</h3>
                <div id="fl_a" style="width:100%;margin:40px 50px 10px"><img src="lastDias.png" /></div>
                <div class="clearfix chart_colors">
                        <label class="radio inline"><input type="radio" value="ch_blue" name="ch_color" id="chC_blue" />Blue</label>
                        <label class="radio inline"><input type="radio" value="ch_green" name="ch_color" id="chC_green" />Green</label>
                        <label class="radio inline"><input type="radio" value="ch_brown" name="ch_color" id="chC_brown" checked="checked" />Brown</label>
                </div>
        </div>
        <div class="span6">
                <h3 class="heading">'.$translation['tstat_last_day'].'</h3>
                <div id="fl_a" style="width:100%;margin:40px 50px 10px"><img src="lastDias.png" /></div>
                <div class="clearfix chart_colors">
                        <label class="radio inline"><input type="radio" value="ch_blue" name="ch_color" id="chC_blue" />Blue</label>
                        <label class="radio inline"><input type="radio" value="ch_green" name="ch_color" id="chC_green" />Green</label>
                        <label class="radio inline"><input type="radio" value="ch_brown" name="ch_color" id="chC_brown" checked="checked" />Brown</label>
                </div>
        </div>
    </div>';
echo '<div class="row-fluid">
    <div class="span12">
            <h3 class="heading">'.$translation['tstat_last_month'].'</h3>
            <div id="fl_a" style="width:100%;margin:40px auto 10px"><img src="lastMonth.png" /></div>
            <div class="clearfix chart_colors">
                    <label class="radio inline"><input type="radio" value="ch_blue" name="ch_color" id="chC_blue" />Blue</label>
                    <label class="radio inline"><input type="radio" value="ch_green" name="ch_color" id="chC_green" />Green</label>
                    <label class="radio inline"><input type="radio" value="ch_brown" name="ch_color" id="chC_brown" checked="checked" />Brown</label>
            </div>
    </div>
</div>';
echo '<div class="row-fluid">
    <div class="span12">
            <h3 class="heading">'.$translation['tstat_last_year'].'</h3>
            <div id="fl_a" style="width:100%;margin:40px auto 10px"><img src="lastDia.png" /></div>
            <div class="clearfix chart_colors">
                    <label class="radio inline"><input type="radio" value="ch_blue" name="ch_color" id="chC_blue" />Blue</label>
                    <label class="radio inline"><input type="radio" value="ch_green" name="ch_color" id="chC_green" />Green</label>
                    <label class="radio inline"><input type="radio" value="ch_brown" name="ch_color" id="chC_brown" checked="checked" />Brown</label>
            </div>
    </div>
</div>';
/*
echo "<table class=\"center\">\n"
    ."<tr><td class=\"padding\">\n"
    ."<table class=\"centerbox\">\n"
    ."<tr>\n"
    ."<td class=\"label\" colspan=\"2\"><br />".$translation['tstat_last_day']."</td>\n"
    ."</tr>\n"
    ."<tr>\n"
    ."<td class=\"padding\" align=\"center\" colspan=\"2\">\n"
    .juassi_show_plot_time_type("hour", 840, 200)
    ."</td>\n"
    ."</tr>\n"
    ."<tr>\n"
    ."<td class=\"label\">".$translation['tstat_last_week']."</td>\n"
    ."<td class=\"label\">".$translation['tstat_last_year']."</td>\n"
    ."</tr>\n"
    ."<tr>\n"
    ."<td class=\"padding\" align=\"center\">\n"
    .juassi_show_plot_time_type("wday", 203, 200)
    ."</td>\n"
    ."<td class=\"padding\" align=\"center\">\n"
    .juassi_show_plot_time_type("month", 407, 200)
    ."</td>\n"
    ."</tr>\n"
    ."<tr>\n"
    ."<td class=\"label\" colspan=\"2\">".$translation['tstat_last_month']."</td>\n"
    ."</tr>\n"
    ."<tr>\n"
    ."<td class=\"padding\" align=\"center\" colspan=\"2\">\n"
    .juassi_show_plot_time_type("day", 640, 200)
    ."</td></tr></table></td></tr></table>\n"
    .$JUASSI_HTML->copyright()
    .$JUASSI_HTML->topbar(0, 1);
*/
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

// End of HTML
echo $JUASSI_HTML->html_end()
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
include 'include/html-footer.php';
?>
