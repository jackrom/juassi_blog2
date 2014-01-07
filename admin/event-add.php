<?php
        include('include/admin-header.php');
	juassi_set_admin_title('Event Add');
	juassi_set_in_admin(true);
        include 'include/html-header.php';
	include_once('calendar/eventer-config.php');
	include_once('session-check.php');
?>
<?php
	$images_folder = "calendar/images/";
	
	// to check if Submit button is clicked...
	if(isset($_POST['Submit'])) {
		$title = $_POST['title'];
		
		if (isset($_POST['start_date']) && $_POST['start_date'] != '') {
			$date = $_POST['start_date'];
			$dateArr = explode("-",$date);
			
			if ($date_format == 'UK') {
				$start_date = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
			}
			else {
				$start_date = $dateArr[2]."-".$dateArr[0]."-".$dateArr[1];
			}
		}
		else {
			$start_date = '';
		}
		
		if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
			//$end_date = date('Y-m-d', $_POST['end_date']);
			$date = $_POST['end_date'];
			$dateArr = explode("-",$date);
			
			if ($date_format == 'UK') {
				$end_date = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
			}
			else {
				$end_date = $dateArr[2]."-".$dateArr[0]."-".$dateArr[1];
			}
		}
		else {
			$end_date = '';
		}
		
		/*$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];*/
	   
	   	$start_hour = $_POST['start_hour'];
		$start_hour = $_POST['start_hour'];
		if ($start_hour == '-1') {
			$start_time = '-1';
		}
		else {
			$start_minutes = $_POST['start_minutes'];
			$start_time = $start_hour.$start_minutes.':00';
		}
		
		$end_hour = $_POST['end_hour'];
		if ($end_hour == '-1') {
			$end_time = '-1';
		}
		else {
			$end_minutes = $_POST['end_minutes'];
			$end_time = $end_hour.$end_minutes.':00';
		}
		
		$image = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		
		$image_alignment = $_POST['image_alignment'];
		
		$fdir = $images_folder.$image;
		
		if($image) {
			move_uploaded_file($tmp,$fdir) or die("file uploading failed");
		}
		
		$description = $_POST['description'];
		$venue = $_POST['venue'];
		
		$link = $_POST['link'];
		$status = $_POST['status'];
		
		$query = "INSERT INTO `juassi2_eventer` (`start_date`, `end_date`, `start_time`, `end_time`, `title`, `description`, `venue`, `link`, `image`, `image_alignment`, `status`) VALUES ('$start_date', '$end_date', '$start_time', '$end_time', '$title', '$description', '$venue', '$link', '$image', '$image_alignment', '$status'); ";
		mysql_query($query) or die(mysql_error());
		
		header("Location:events.php?Msg=Record+Inserted+Successfully");
	}
?>

    

        <div class="content-header">
            <h1 class="title">Crear Evento de Calendario</h1>
            <div class="add-new-item"><a href="event-add.php" class="header-action add-action">Agregar Evento</a>   |   <a href="images.php" class="header-action">Ver Imagenes</a></div>
        </div>
        <input type="hidden" id="DPC_TODAY_TEXT" value="today">
        <input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
        <input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
        <input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table border="0" class="rows">
            <tr>
              <td width="150"><strong>Titulo</strong></td>
              <td width="650"><label for="title"></label>
              <input name="title" type="text" id="title" size="69" /></td>
            </tr>
            <tr>
              <td><strong>Fecha</strong></td>
				<?php
					$option_recset = mysql_query("SELECT date_format FROM juassi2_options");
					$option_row = mysql_fetch_assoc($option_recset);
					$date_format = $option_row['date_format'];
					if ($date_format == "UK") {
						$date_picker_format = "DD-MM-YYYY";
					}
					else {
						$date_picker_format = "MM-DD-YYYY";
					}
                ?>
              <td><input name="start_date" type="text" class="flatedit" id="start_date" size="29" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>"></td>
            </tr>
            <tr>
              <td><strong>Date</strong></td>
              <td><input name="end_date" type="text" class="flatedit" id="end_date" size="29" datepicker="true" datepicker_format="<?php echo $date_picker_format; ?>"></td>
            </tr>
            <tr>
                <td><strong>Hora de Inicio</strong></td>
                <td>
                    <select name="start_hour" id="start_hour">
                    <option value="-1">Hour</option>
                    <?php
                        $start_hour = 0;
                        while($start_hour < 24) {
                    ?>
                    <option value="<?php echo $start_hour; ?>"><?php echo $start_hour++; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <select name="start_minutes" id="start_minutes">
                    <option value=":00">Minutes</option>
                    <?php
                        $minutes = 0;
                        while($minutes < 60) {
                    ?>
                    <option value="<?php echo ':'.$minutes; ?>"><?php echo $minutes++; ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Hora de Termino</strong></td>
                <td>
                    <select name="end_hour" id="end_hour">
                    <option value="-1">Horas</option>
                    <?php
                        $end_hour = 0;
                        while($end_hour < 24) {
                    ?>
                    <option value="<?php echo $end_hour; ?>"><?php echo $end_hour++; ?></option>
                    <?php
                        }
                    ?>
                    
                    </select> 
                    
                    <select name="end_minutes" id="end_minutes">
                    <option value=":00">Minutos</option>
                    <?php
                        $minutes = 0;
                        while($minutes < 60) {
                    ?>
                    <option value="<?php echo ':'.$minutes; ?>"><?php echo $minutes++; ?></option>
                    <?php
                        }
                    ?>
                    
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Lugar</strong></td>
                <td><input name="venue" type="text" id="venue" size="69" value="" /></td>
            </tr>
            <tr>
                <td><strong>Imagen</strong></td>
                <td><label for="file"></label><input name="file" type="file" id="file" size="29" /></td>
            </tr>
            <tr>
                <td><strong>Alineaci&oacute; Imagen</strong></td>
                <td>
                	<select name="image_alignment" id="image_alignment">
                        <option value="left">Izquierda</option>
                        <option value="right">Derecha</option>
                        <option value="center">Centro</option>
                    </select>
                </td>
              </tr>
            <tr>
                <td><strong>Descripci&oacute;n del evento</strong></td>
                <td><textarea id="description" name="description" class="tinymce"></textarea></td>
            </tr>
            <tr>
                <td><strong>URL o Link de Informaci&oacute;n</strong></td>
                <td><input name="link" type="text" id="link" size="69" /></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td><input type="radio" name="status" id="status" value="1" checked="checked"/><strong>Habilitar</strong><input type="radio" name="status" id="status" value="0" /><strong>Deshabilitar</strong></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            	<td><input type="submit" name="Submit" id="Submit" value="Add Event" /></td>
            </tr>
          </table>
        </form>
<script type="text/javascript" src="../juassi-resources/javascript/datepickercontrol.js"></script>
<script language="JavaScript">
 if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol_lnx.css">');
 }
 else{
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css">');
 }
</script>
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

<?php
                include 'include/sidebar.php';
                //include 'include/html-footer.php';
?>