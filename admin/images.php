<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Images');
	juassi_set_in_admin(true);
        include 'include/html-header.php';
        include_once('eventer-config.php');
	//include_once('session-check.php');
?>
<?php
	if (isset($_GET['imageID'])) {
		$imageID = $_GET['imageID'];
		
		$query = "DELETE FROM juassi2_images WHERE id='$imageID'";
		$status = mysql_query($query);
	}

	$query = "SELECT * FROM juassi2_images ORDER BY id";
	$recset = mysql_query($query);
?>
	

        <div class="content-header">
            <h1 class="title">Visor de Imagenes</h1>
            <div class="add-new-item"><a href="images-add.php" class="header-action add-action">Subir Imagenes</a>   |   <a href="event-add.php" class="header-action">Agregar Evento  </a>   |   <a href="events.php" class="header-action">Ver Eventos  </a></div>
        </div>
        <ul class="grid">
        	<?php
				while ($row = mysql_fetch_assoc($recset)) {
					$imageID = $row['id'];
			?>
        		<li class="grid-item">
                	<div class="image-wrapper"><img src="timthumb.php?src=calendar/images/<?php echo $row['path']; ?>&w=220&h=140" /></div>
                    <div class="panel">
                    	<?php
                        	if (strlen($row['name']) == 0) {
						?>
                        	<a href="images-edit.php?imageID=<?php echo $imageID; ?>"> Agregar nombre</a>
                        <?php
							}
							else {
						?>
                        <p class="image-name"><?php echo $row['name']; ?></p>
                        <?php
							}
						?>
						<div class="buttons"><a href="images.php?imageID=<?php echo $imageID; ?>" onclick="return confirmDelete('Image')"><img src="" />Delete</a> <a href="#"><img src="" /><!--Download--></a></div>
					</div>
				</li>
			<?php
				}
			?>
        </ul>

<script language="javascript" type="text/javascript">
	function confirmDelete(element) {
		if(confirm("Do you really want to delete " + element + "?")) {
			return true;
		}
		else {
			return false;
		}
	}
</script>
<script type="text/javascript">
	$(document).ready(function(e) {
		var loading = false;
		var targetRow;
		
		 $('#date_box_bg_color, #today_date_box_bg_color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
		
        $('td a.view-details-btn').click(function(e) {
			e.preventDefault();
			
			targetRow = $(this).closest( "tr" );
			if (!loading) {
				loading = true;
				$.get('event-get.php', {eventID:$(this).attr('id')}, function (result) {
					
					if (result.status == 'success') {
						var eventHTML = '<tr><td colspan="4"><table>';
						
						eventHTML += '<tr><td>Start Date</td><td>' + result.eventData.start_date + '</td></tr>';
						eventHTML += '<tr><td>End Date</td><td>' + result.eventData.end_date + '</td></tr>';
						eventHTML += '<tr><td>Start Time</td><td>' + result.eventData.start_time + '</td></tr>';
						eventHTML += '<tr><td>End Time</td><td>' + result.eventData.end_time + '</td></tr>';
						eventHTML += '<tr><td>Venue</td><td>' + result.eventData.venue + '</td></tr>';
						eventHTML += '<tr><td>Link</td><td>' + result.eventData.link + '</td></tr>';
						eventHTML += '<tr><td>Description</td><td>' + result.eventData.description + '</td></tr>';
						eventHTML += '<tr><td>Status</td><td>' + result.eventData.status + '</td></tr>';
						
						eventHTML += '</table></td></tr>';
						
						$(targetRow).after(eventHTML);
					}
					
					loading = false;
				}, 'json');
			}
		
		//$(this).closest( "tr" ).after('<tr><td colspan="4"><table></table></td></tr>');
        });
		
		
		$('#swfupload-control').swfupload({
			upload_url: "image-uploader.php",
			file_post_name: 'uploadfile',
			file_size_limit : "2048",
			file_types : "*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : 10,
			flash_url : "../juassi-resources/javascript/swfupload/swfupload.swf",
			button_image_url : '../juassi-resources/javascript/swfupload/XPButtonUploadText_61x22.png',
			button_width : 61,
			button_height : 22,
			button_placeholder : $('#button')[0],
			debug: false
		})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			$('#log').append(listitem);
			$('li#'+file.id+' .cancel').bind('click', function(){ //Remove from queue on cancel click
				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			$('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			$('#log li#'+file.id).find('p.status').text('Uploading...');
			$('#log li#'+file.id).find('span.progressvalue').text('0%');
			$('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=$('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="../admin/calendar/images/'+file.name+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		})
		
		
    });
	
</script>
<?php
                    include 'include/sidebar.php';
                    include 'include/html-footer.php';
?>