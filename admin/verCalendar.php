<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Calendario');
	juassi_set_in_admin(true);
	include('include/html-header.php');

	include_once('calendar/eventer-config.php');
	include_once('../includes/EventerCalendarVars.php');
	include_once('../includes/EventerCalendarOptions.php');
	
	$eventerCalendarVars = new EventerCalendarVars();
	
	if (isset($_GET['eventer_month']) && $_GET['eventer_month'] !='') {
		$eventerCalendarVars->currentMonth = $_GET["eventer_month"];
	}
	else {
		$eventerCalendarVars->currentMonth = date('m');
	}
	
	if (isset($_GET['eventer_year']) && $_GET['eventer_year'] !='') {
		$eventerCalendarVars->currentYear = $_GET["eventer_year"];
	}
	else {
		$eventerCalendarVars->currentYear = date('Y');
	}
	
	$eventerCalendarVars->prevYear = $eventerCalendarVars->currentYear;
	$eventerCalendarVars->nextYear = $eventerCalendarVars->currentYear;
	$eventerCalendarVars->prevMonth = $eventerCalendarVars->currentMonth - 1;
	$eventerCalendarVars->nextMonth = $eventerCalendarVars->currentMonth + 1;
	
	if ($eventerCalendarVars->prevMonth == 0) {
		$eventerCalendarVars->prevMonth = 12;
		$eventerCalendarVars->prevYear = $eventerCalendarVars->currentYear - 1;
	}
	
	if ($eventerCalendarVars->nextMonth == 13) {
		$eventerCalendarVars->nextMonth = 1;
		$eventerCalendarVars->nextYear = $eventerCalendarVars->currentYear + 1;
	}
	
	$eventer_row = 0;
	$eventer_col = 0;
	
	$eventer_options_recset = mysql_query("SELECT * from juassi2_options LIMIT 1");
	$eventer_options_row = mysql_fetch_assoc($eventer_options_recset);
	
	$eventerCalendarOptions = new EventerCalendarOptions();
	
	$eventerCalendarOptions->colorTheme = $eventer_options_row['color_theme'];
	
	$eventerCalendarOptions->calendarPadding = $eventer_options_row['calendar_padding'];
	$eventerCalendarOptions->calendarBackgroundWidth = $eventer_options_row['calendar_background_width'];
	
	$eventerCalendarOptions->dateBoxWidth = $eventer_options_row['date_box_width'];
	$eventerCalendarOptions->dateBoxHeight = $eventer_options_row['date_box_height'];
	$eventerCalendarOptions->dateBoxHorizontalSpace = $eventer_options_row['date_box_horizontal_space'];
	$eventerCalendarOptions->dateBoxVerticalSpace = $eventer_options_row['date_box_vertical_space'];
	$eventerCalendarOptions->dateBoxCornerRadius = $eventer_options_row['date_box_corner_radius'];
	
	$eventerCalendarOptions->dateBoxBGColor = $eventer_options_row['date_box_bg_color'];
	$eventerCalendarOptions->todayDateBoxBGColor = $eventer_options_row['today_date_box_bg_color'];
	$eventerCalendarOptions->emptyDateBoxAlpha = $eventer_options_row['empty_date_box_alpha'];
	
	$eventerCalendarOptions->dateFormat = $eventer_options_row['date_format'];
	$eventerCalendarOptions->startingWeekDay = $eventer_options_row['starting_week_day'];
	$eventerCalendarOptions->weekDayNamesShort = $eventer_options_row['week_day_names_short'];
	$eventerCalendarOptions->weekDayNamesLong = $eventer_options_row['week_day_names_long'];
	$eventerCalendarOptions->weekDayNamesFormat = $eventer_options_row['week_day_names_format'];
	$eventerCalendarOptions->monthNamesShort = $eventer_options_row['month_names_short'];
	$eventerCalendarOptions->monthNamesLong = $eventer_options_row['month_names_long'];
	$eventerCalendarOptions->monthNamesFormat = $eventer_options_row['month_names_format'];
	$eventerCalendarOptions->showMonthsNavigation = $eventer_options_row['show_months_navigation'];
	$eventerCalendarOptions->repeatEvents = $eventer_options_row['repeat_events'];
	
	if ($eventerCalendarOptions->showMonthsNavigation == '0') {
		$eventerCalendarVars->currentMonth = date('m');
		$eventerCalendarVars->currentYear = date('Y');
	}
	
	if ($eventerCalendarOptions->monthNamesFormat == 'short') {
		$eventerCalendarVars->monthNames = explode(',', $eventerCalendarOptions->monthNamesShort);
	}
	else {
		$eventerCalendarVars->monthNames = explode(',', $eventerCalendarOptions->monthNamesLong);
	}
	
	if ($eventerCalendarOptions->weekDayNamesFormat == 'long') {
		$eventerCalendarVars->weekDayNames = explode(',', $eventerCalendarOptions->weekDayNamesLong);
	}
	else {
		$eventerCalendarVars->weekDayNames = explode(',', $eventerCalendarOptions->weekDayNamesShort);
	}
	
	if ($eventerCalendarOptions->dateFormat == 'UK') {
		$eventerCalendarVars->dateFormatShort = 'dd-mm-YYYY';
		$eventerCalendarVars->dateFormatLong = 'd F Y';
	}
	else {
		$eventerCalendarVars->dateFormatShort = 'mm-dd-YYYY';
		$eventerCalendarVars->dateFormatLong = 'F d, Y';
	}
	
	if ($eventerCalendarOptions->startingWeekDay == 1) {
		// Move the Sunday from the end of the array to the start of array
		array_unshift($eventerCalendarVars->weekDayNames, array_pop($eventerCalendarVars->weekDayNames));
	}
	
	if ($eventerCalendarOptions->colorTheme == "Dark") {
?>
<link href="../juassi-resources/css/calendar/eventer-dark.css" rel="stylesheet" type="text/css"/>
<?php
	}
	else {
?>
<link href="../juassi-resources/css/calendar/eventer.css" rel="stylesheet" type="text/css"/>
<?php
	}
?>
<script type="text/javascript" src="../juassi-resources/javascript/calendar/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../juassi-resources/javascript/calendar/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../juassi-resources/javascript/calendar/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="../juassi-resources/javascript/calendar/eventer-1.0.min.js"></script>

<script type="text/javascript">
	jQuery.easing.def = "easeOutQuint";
	
	$(function(){
		$eventer_events_calendar = new EventerEventsCalendar('#eventer-events-calendar-container');
		$eventer_events_calendar.init(
			{
				calendarPadding:<?php echo $eventerCalendarOptions->calendarPadding; ?>,
				calendarBackgroundWidth:<?php echo "'".$eventerCalendarOptions->calendarBackgroundWidth."'"; ?>,
				dateBoxWidth:<?php echo $eventerCalendarOptions->dateBoxWidth; ?>,
				dateBoxHeight:<?php echo $eventerCalendarOptions->dateBoxHeight; ?>,
				dateBoxHSpace:<?php echo $eventerCalendarOptions->dateBoxHorizontalSpace; ?>,
				dateBoxVSpace:<?php echo $eventerCalendarOptions->dateBoxVerticalSpace; ?>,
				dateBoxCornerRadius:<?php echo $eventerCalendarOptions->dateBoxCornerRadius; ?>,
				dateBoxBGColor:'<?php echo $eventerCalendarOptions->dateBoxBGColor; ?>',
				todayDateBoxBGColor:'<?php echo $eventerCalendarOptions->todayDateBoxBGColor; ?>',
				emptyDateBoxAlpha:<?php echo $eventerCalendarOptions->emptyDateBoxAlpha; ?>
			}
		);
	});
</script>

<div class="content-header">
    <h1 class="title">Calendario Gr&aacute;fico</h1>
    <div class="add-new-item"><a href="event-add.php" class="header-action add-action">Agregar Evento</a>   |   <a href="images.php" class="header-action">Ver Imagenes</a></div>
</div>

<div id="eventer-events-calendar-container">
    	
    <div id="calendar-nav" class="calendar-nav-right">
        <?php
			if ($eventerCalendarOptions->showMonthsNavigation == '1') {
		?>
		<span id="prev-month" class="calendar-nav-btn"><a href="verCalendar.php?eventer_year=<?php echo $eventerCalendarVars->prevYear; ?>&eventer_month=<?php  echo $eventerCalendarVars->prevMonth ?>"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->prevMonth - 1].' '.$eventerCalendarVars->prevYear; ?></a></span>
		<?php
			}
		?>
		<span id="selected-month-year"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$eventerCalendarVars->currentYear; ?></span>
		<?php
			if ($eventerCalendarOptions->showMonthsNavigation == '1') {
		?>
		<span id="next-month" class="calendar-nav-btn"><a href="verCalendar.php?eventer_year=<?php echo $eventerCalendarVars->nextYear; ?>&eventer_month=<?php  echo $eventerCalendarVars->nextMonth ?>"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->nextMonth - 1].' '.$eventerCalendarVars->nextYear; ?></a></span>
		<?php
			}
		?>
    </div>
    <div class="clear"></div>
    <ul id="week-day-names-container">
    <?php
        for ($m = 0; $m < count($eventerCalendarVars->weekDayNames); $m++) {
            if ($m == count($eventerCalendarVars->weekDayNames) - 1) {
    ?>
        <li class="week-day week-day-last" id="week-day-<?php echo $m; ?>"><?php echo $eventerCalendarVars->weekDayNames[$m]; ?></li>
    <?php
            }
            else {
    ?>
        <li class="week-day" id="week-day-<?php echo $m; ?>"><?php echo $eventerCalendarVars->weekDayNames[$m]; ?></li>
    <?php
            }
        }
    ?>
    </ul>
    <div class="clear"></div>
    <ul id="month-dates-container">
    <?php
        if (is_callable("cal_days_in_month")) {
			$eventerCalendarVars->numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $eventerCalendarVars->currentMonth, $eventerCalendarVars->currentYear);
		}
		else {
			$eventerCalendarVars->numDaysInMonth = 2 ? ($eventerCalendarVars->currentYear % 4 ? 28 : ($eventerCalendarVars->currentYear % 100 ? 29 : ($eventerCalendarVars->currentYear %400 ? 28 : 29))) : (($eventerCalendarVars->currentMonth - 1) % 7 % 2 ? 30 : 31);
		}
		
		$eventerTimeStamp = mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $eventerCalendarOptions->startingWeekDay, $eventerCalendarVars->currentYear);
        $eventerDateObject = getdate($eventerTimeStamp);
        $eventerCalendarVars->weekStartDayID = $eventerDateObject['wday'];
        
        $smsDateIterator = 1;
        
        for ($m = 1; $m <= 42; $m++) {
            // We add different css class to some of date boxes e.g. date box with current date
            $cssClasses = '';
            
            if ($m % 7 == 0) {
                $cssClasses .= ' date-box-last';
            }
            else if ($eventer_col == 0) {
                $cssClasses .= ' date-box-first';
            }
            
            if ($m >= ($eventerCalendarVars->weekStartDayID + 1) && $m <= $eventerCalendarVars->numDaysInMonth + $eventerCalendarVars->weekStartDayID) {
                
                //assign class of date-box-current to today's date box
                $eventerTodayDateObject = getdate();
                if ($smsDateIterator == $eventerTodayDateObject['mday'] && $eventerTodayDateObject['mon'] == $eventerCalendarVars->currentMonth && $eventerTodayDateObject['year'] == $eventerCalendarVars->currentYear) {
                    $cssClasses .= ' date-box-current';
                }
                
                $dateBoxHTML = '<li class="date-box'. $cssClasses .' date-box-row-'. ($eventer_row + 1) .'" id="date-box-'. $m .'">';
                    $dateBoxHTML .= '<div class="date-labels-wrapper">';
                        $dateBoxHTML .= '<div class="date-labels">';
                            $dateBoxHTML .= '<h1 class="date-label">'. $smsDateIterator .'</h1>';
                            //$dateBoxHTML .= '<h1 class="date-label-full">'.$eventerCalendarVars->weekDayNames[$m % 7 - 1].' '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$smsDateIterator.', '.$eventerCalendarVars->currentYear.'</h1>';
							$eventerTimeStamp = mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $smsDateIterator, $eventerCalendarVars->currentYear);
							
							if ($eventerCalendarOptions->dateFormat == 'UK') {
                            	$dateBoxHTML .= '<h1 class="date-label-full">'.date('l', $eventerTimeStamp).', '.$smsDateIterator.' '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].', '.$eventerCalendarVars->currentYear.'</h1>';
							}
							else {
								$dateBoxHTML .= '<h1 class="date-label-full">'.date('l', $eventerTimeStamp).', '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$smsDateIterator.', '.$eventerCalendarVars->currentYear.'</h1>';
							}
							
                        $dateBoxHTML .= '</div>';
                    $dateBoxHTML .= '</div>';
                    
                    $startDate = date("Y-m-d", mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $smsDateIterator, $eventerCalendarVars->currentYear));
                    $endDate = date("Y-m-d", mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $eventerCalendarVars->numDaysInMonth, $eventerCalendarVars->currentYear));
                    
                    if ($eventerCalendarOptions->repeatEvents) {
                        //$query = "SELECT * from eventer_events WHERE start_date<='$startDate' AND end_date>='$startDate' AND status='1'";
						
						// For repeat events use a UNION query to get events
						// because if the end_event for a particular event is empty then that will not be return using start_date<='$startDate' AND end_date>='$startDate'
						$query = "SELECT * FROM `juassi2_eventer` WHERE start_date<='$startDate' AND end_date>='$startDate' UNION SELECT * FROM `juassi2_eventer` WHERE  start_date='$startDate'";
                    }
                    else {
                        $query = "SELECT * from juassi2_eventer WHERE start_date='$startDate' AND status='1'";
                    }
                    
                    $eventer_recset = mysql_query($query);
                    $eventerNumOfRows = mysql_num_rows($eventer_recset);
                    
                    if ($eventerNumOfRows) {
                        
                        $dateBoxHTML .= '<div class="date-box-close-btn"><a href="#"><span></span></a></div>';
                        $dateBoxHTML .= '<ul class="event-items-nav">';
                            $dateBoxHTML .= '<li class="date-box-back-btn"><a href="#"><span></span></a></li>';
                            if ($eventerNumOfRows > 1) {
								$dateBoxHTML .= '<li class="date-box-prev-event-btn"><a href="#"></a></li>';
                                $dateBoxHTML .= '<li class="date-box-next-event-btn"><a href="#"><span></span></a></li>';
                            }
                        $dateBoxHTML .= '</ul>';
                        
                        $dateBoxHTML .= '<div class="date-box-events-wrapper">';
                            $dateBoxHTML .= '<ul class="date-box-events">';
                                
                                $eventerEventIterator = 1;
                                while ($eventerEventRow = mysql_fetch_assoc($eventer_recset)) {
                                    $dateBoxHTML .= '<li class="events-list-item" id="date-box-event-'.$smsDateIterator.'-'.$eventerEventIterator++.'"><a href="#">'.$eventerEventRow['title'].'</a></li>';
                                }
                            
                            $dateBoxHTML .= '</ul>';
                            $dateBoxHTML .= '<div class="event-details-items-wrapper">';
                                $dateBoxHTML .= '<ul class="event-details-items">';
                                    
									// Restart iterating the eventer_recset by resetting the pointer to 0 index
                                    $eventerEventIterator = 1;
                                    mysql_data_seek($eventer_recset, 0);
                                    
                                    while ($eventerEventRow = mysql_fetch_assoc($eventer_recset)) {
                                        $image = '';
                                        if ($eventerEventRow['image'] != '') {
                                                $imageAlignment = $eventerEventRow['image_alignment'];
                                                $image = '<img src="calendar/images/'.$eventerEventRow['image'].'" class="align'.$imageAlignment.'"/>';
                                        }
										
                                        $dateBoxHTML .= '<li>';
                                            $dateBoxHTML .= '<div class="event-item-details-scrollbar" id="eventItemDetailsScrollbar-'.$smsDateIterator.'-'.$eventerEventIterator++.'">';
                                                $dateBoxHTML .= '<div class="scrollbar">';
                                                    $dateBoxHTML .= '<div class="track"><div class="thumb"><div class="end"></div></div></div>';
                                                $dateBoxHTML .= '</div>';
                                                $dateBoxHTML .= '<div class="viewport">';
                                                    $dateBoxHTML .= '<div class="overview">';
                                                        $dateBoxHTML .= '<div class="event-item-content">';
															
                                                            $dateBoxHTML .= '<h1 class="event-heading">'.$eventerEventRow['title'].'</h1>';
															
                                                            $dateBoxHTML .= '<div class="meta-panel">';

                                                            if ($eventerEventRow['start_date'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item start-date-label"><strong>Start Date: </strong>'.date($eventerCalendarVars->dateFormatLong, strtotime($eventerEventRow['start_date'])).'</p>';
                                                            }

                                                            if ($eventerEventRow['end_date'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item end-date-label"><strong>End Date: </strong>'.date($eventerCalendarVars->dateFormatLong, strtotime($eventerEventRow['end_date'])).'</p>';
                                                            }

                                                            if ($eventerEventRow['start_time'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item start-time-label"><strong>Start Time: </strong>'.date("g:i a", strtotime($eventerEventRow['start_time'])).'</p>';
                                                            }

                                                            if ($eventerEventRow['end_time'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item end-time-label"><strong>End Time: </strong>'.date("g:i a", strtotime($eventerEventRow['end_time'])).'</p>';
                                                            }

                                                            if ($eventerEventRow['venue'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item venue-label"><strong>Venue: </strong>'.$eventerEventRow['venue'].'</p>';
                                                            }

                                                            if ($eventerEventRow['link'] != '') {
                                                                    $dateBoxHTML .= '<p class="meta-item meta-item-link">'.$eventerEventRow['link'].'</p>';
                                                            }

                                                            $dateBoxHTML .= '</div>';

                                                            $dateBoxHTML .= '<div class="info-panel">'.$image.$eventerEventRow['description'].'</div>';

                                                            if ($eventerEventRow['link'] != '') {
                                                                    $dateBoxHTML .= '<div class="meta-panel"><p class="meta-item-link" style="margin:0;">'.$eventerEventRow['link'].'</p></div>';
                                                            }
															
                                                        $dateBoxHTML .= '</div>';
                                                    $dateBoxHTML .= '</div>';
                                                $dateBoxHTML .= '</div>';
                                            $dateBoxHTML .= '</div>';
                                        $dateBoxHTML .= '</li>';
                                    }
                                    
                                $dateBoxHTML .= '</ul>';
                            $dateBoxHTML .= '</div>';
                        $dateBoxHTML .= '</div>';
                    }
                    
                $dateBoxHTML .= '</li>';
                
                echo $dateBoxHTML;
                
                $smsDateIterator++;
            }
            else {
                echo '<li class="date-box'. $cssClasses .' date-box-row-'. ($eventer_row + 1) .' date-box-disabled" id="date-box-'. ($m) .'"><div class="date-labels-wrapper"><div class="date-labels"><h1 class="date-label"></h1><h1 class="date-label-full"></h1></div></div></li>';
            }
            
            $eventer_col++;
            if ($eventer_col == 7) {
                $eventer_row++;
                $eventer_col = 0;
            }
			
        }
    ?>
    </ul>
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
</div>
<?php
include 'include/sidebar.php';
//include 'include/html-footer.php';
?>

