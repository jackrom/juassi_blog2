<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Carga de Archivos');
	juassi_set_in_admin(true);
	include('include/html-header.php');

?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Subidas de Archivos <span>(file upload)</</span></h2>

	<?php
		if (isset($_POST['submit'])) {
			$message = juassi_upload_script();
			if (!empty($message)) {
				echo juassi_admin_message('<strong>' . juassi_htmlentities($message[0]) . '</strong>');
			}
			else {
				echo juassi_admin_message('<strong style="color:red;">Archivo(s) Cargado(s) exitosamente.</strong>');
			}
		}
	?>
	<script type="text/javascript">
		// select file function only for styling up input[type="file"]
		function select_file(){
			document.getElementById('image').click();
			return false;
		}
	</script>
 	<form method="post" enctype="multipart/form-data" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		<p>Actual Ruta de carga de archivos: <?php echo juassi_htmlentities(juassi_get_upload_path()); ?></p>
		
		<div class="file_upload">
			<p><strong>Archivos</strong><br /></p>
			<!-- <p><input type="file" id="first_file_element" /></p>  -->
			
			<div class="formSep">
				
				<div class="row-fluid">
				
					<p style="margin-top:-27px; margin-left:390px;"><span class="label label-inverse">Imagenes a cargar</span></p>
				
				
					<div class="span4" style="margin-left:-70px;">
						<div data-fileupload="image" class="fileupload fileupload-new"><input type="hidden">
							<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /></div>
							<div style="max-width: 400px; max-height: 300px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
							<div>
								<span class="btn btn-file"><span class="fileupload-new">Seleccionar Imagen</span><span class="fileupload-exists">Cambiar</span><input type="file" id="first_file_element" /></span>
								<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Eliminar</a>
							</div>
						</div>
					</div>
					<p><span class="label label-inverse">Archivo a cargar</span></p>
					<div class="span5">
						<div data-fileupload="file" class="fileupload fileupload-new"><input type="hidden" />
							<div class="input-append">
								<div class="uneditable-input span2"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new" onclick="select_file()">Seleccionar archivo</span><span class="fileupload-exists">Agregar otro archivo</span><input type="file" id="image" name="image" /></span><a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Eliminar</a>
							</div>
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
						</div>
					</div>
				
				
				
					
				</div> 
				
				<div class="files_list" id="files_list">
					<strong>Archivos (m&aacute;ximo 5 archivos):</strong>
				</div>
				
			</div>
			
			<p><script src="<?php echo juassi_get_config('address') . '/juassi-resources/javascript/multifile.js'; ?>"></script></p>
		</div>

		<p>Nota: Tu puedes cambiar la ruta de subida desde el panel de <a href="general-settings.php">Configuraci&oacute;n General</a>.</p>
		
		<!-- <button onclick="window.parent.startProgress(); return true;" class="btn btn-large btn-inverse" name="submit" type="submit" value="" /><i class="splashy-check"></i> Cargar Archivos</button></p> -->
		<input onclick="window.parent.startProgress(); return true;" type="submit" name="submit" value="enviar" />
		
		
		<script type="text/javascript">

		function getProgress(){
		  GDownloadUrl("file-upload.php?progress_key=<?php echo($id)?>", 
               function(percent, responseCode) {
                   document.getElementById("progressinner").style.width = percent+"%";
                   if (percent < 100){
                        setTimeout("getProgress()", 100);
                   }
               });
		
		}
		
		function startProgress(){
		    document.getElementById("progressouter").style.display="block";
		    setTimeout("getProgress()", 1000);
		}
		
		</script>
		
		
		<div id="progressouter" style="width: 500px; height: 20px; border: 6px solid red;">
		   <div id="progressinner" style="position: relative; height: 20px; background-color: purple; width: 0%; ">
		   </div>
		</div>
		<button onclick="startProgress()">Start me up!</button>
		

	</form>
</div>
</div>


<?php
	include('include/sidebar.php');
	//include('include/html-footer.php');
?>
<!-- jQuery Library-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<!-- jQuery Form Plug in -->
	<script type="text/javascript" src="../juassi-resources/javascript/jquery.form.min.js"></script>
<script>
$(document).ready(function() {
	/* variables */
	var preview = $('img');
	var status = $('.status');
	var percent = $('.percent');
	var bar = $('.bar');

	/* only for image preview */
	$("#image").change(function(){
		preview.fadeOut();

		/* html FileRender Api */
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("image").files[0]);

		oFReader.onload = function (oFREvent) {
			preview.attr('src', oFREvent.target.result).fadeIn();
		};
	});

	/* submit form with ajax request */
	$('form').ajaxForm({

		/* set data type json */
		dataType:¬†¬†'json',

		/* reset before submitting */
		beforeSend: function() {
			status.fadeOut();
			bar.width('0%');
			percent.html('0%');
		},

		/* progress bar call back*/
		uploadProgress: function(event, position, total, percentComplete) {
			var pVel = percentComplete + '%';
			bar.width(pVel);
			percent.html(pVel);
		},

		/* complete call back */
		complete: function(data) {
			preview.fadeOut(800);
			status.html(data.responseJSON.status).fadeIn();
		}

	});
});
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
			<!-- lightbox -->
            <script src="../juassi-resources/lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- common functions -->
			<script src="../juassi-resources/javascript/gebo_common.js"></script>
	
            <script src="../juassi-resources/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="../juassi-resources/javascript/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- masked inputs -->
            <script src="../juassi-resources/javascript/forms/jquery.inputmask.min.js"></script>
            <!-- autosize textareas -->
            <script src="../juassi-resources/javascript/forms/jquery.autosize.min.js"></script>
            <!-- textarea limiter/counter -->
            <script src="../juassi-resources/javascript/forms/jquery.counter.min.js"></script>
            <!-- datepicker -->
            <script src="../juassi-resources/lib/datepicker/bootstrap-datepicker.min.js"></script>
            <!-- timepicker -->
            <script src="../juassi-resources/lib/datepicker/bootstrap-timepicker.min.js"></script>
            <!-- tag handler -->
            <script src="../juassi-resources/lib/tag_handler/jquery.taghandler.min.js"></script>
            <!-- input spinners -->
            <script src="../juassi-resources/javascript/forms/jquery.spinners.min.js"></script>
            <!-- styled form elements -->
            <script src="../juassi-resources/lib/uniform/jquery.uniform.min.js"></script>
            <!-- animated progressbars -->
            <script src="../juassi-resources/javascript/forms/jquery.progressbar.anim.js"></script>
            <!-- multiselect -->
            <script src="../juassi-resources/lib/multiselect/js/jquery.multi-select.min.js"></script>
            <!-- enhanced select (chosen) -->
            <script src="../juassi-resources/lib/chosen/chosen.jquery.min.js"></script>
            <!-- TinyMce WYSIWG editor -->
            <script src="../juassi-resources/lib/tiny_mce/jquery.tinymce.js"></script>
            
			<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/plupload.full.js"></script>
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
            <!-- colorpicker -->
			<script src="../juassi-resources/lib/colorpicker/bootstrap-colorpicker.js"></script>
			<!-- form functions -->
            <script src="../juassi-resources/javascript/gebo_forms.js"></script>
    
		
		</div>
	</body>
</html>