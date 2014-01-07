<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Editar Comentarios');
	juassi_set_in_admin(true);

	include('include/html-header.php');
?>
	<div class="contain">
<?php
	if (juassi_user_can('edit_comments')) {

		if (isset($_REQUEST['comment_id']) && (int)$_REQUEST['comment_id'] != 0) {
			$comment_id = (int) $_REQUEST['comment_id'];

			$juassi_comments = new juassi_comments();

			if (isset($_POST['submit']))  {

				$juassi_content_identifier['comment_id'] = $comment_id;
				$juassi_content_identifier['limit'] = 1;
				$juassi_content_identifier['all_comments'] = 1;

				$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);

				if (!empty($juassi_comment_array)) {
					$juassi_comment = $juassi_comment_array[0];
					$juassi_comment['comment_body'] = $_POST['juassi_comment_body'];
					if (!juassi_comment_user()) {
						$juassi_comment['comment_display_name'] = $_POST['juassi_comment_name'];
						$juassi_comment['comment_email'] = $_POST['juassi_comment_email'];
						$juassi_comment['comment_website'] = $_POST['juassi_comment_website'];
					}
					if (juassi_comment_trackback()) {
						$juassi_comment['comment_title'] = $_POST['juassi_comment_title'];
					}
					$juassi_comments->edit_comment($juassi_comment);
					unset($juassi_comment);
					$message = '<strong>Comment Edited.</strong>';
				}
				else {

				}

				unset($juassi_comment_array);

			}

			$juassi_content_identifier['limit'] = 1;
			$juassi_content_identifier['all_comments'] = 1;
			$juassi_content_identifier['comment_id'] = $comment_id;
			$juassi_content_identifier['get_posts'] = true;


			$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);

			if (!empty($juassi_comment_array)) {
				$juassi_comment = $juassi_comment_array[0];
				$juassi_post = $juassi_comment;
			}
			else {
				$message = '<strong>Comentario no encontrado.</strong>';
			}
		}
		else {
			$message = '<strong>Comentario no encontrado.</strong>';
		}
	}
	else {
		$message = '<strong>Tu no tienes permisos para editar comentarios.</strong>';
	}

?>
<div class="row-fluid">
	<div class="span12">
		<h2 class="heading">Editar Comentario</h2>
		
		<?php if (isset($message)) echo juassi_admin_message($message); ?>
		<?php if (isset($juassi_comment)) { ?>
		
		<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
		
			<label>Editor de comentarios</label>
			<textarea id="editor" name="juassi_comment_body" cols="120" rows="15" ><?php echo juassi_comment_body_raw(); ?></textarea>
			
			

			
				<legend>Detalles del usuario</legend>
				<?php if(juassi_comment_user()) { ?>
				<p><a href="user-profile.php?user_id=<?php echo juassi_comment_user_id(); ?>">Click aqu&iacute; para editar detalles del (<?php echo juassi_comment_display_name(); ?>) usuario.</a></p>
				<?php } else { ?>
					<div class="formSep">
						<label>Nombre</label>
						<input name="juassi_comment_name" value="<?php echo juassi_comment_display_name(); ?>" type="text" style="width:99%; font-size:18px; height:30px;"/>
					</div>
					
					<div class="formSep">
						<label>Email</label>
						<input name="juassi_comment_email" value="<?php echo juassi_comment_email(); ?>" type="text" style="width:99%; font-size:18px; height:30px;"/>
					</div>
					
					<div class="formSep">
						<label>Website</label>
						<input name="juassi_comment_website" value="<?php echo juassi_comment_url(); ?>" type="text" style="width:99%; font-size:18px; height:30px;"/>
					</div>
					
					
					
					<?php if (juassi_comment_trackback()) { ?>
					<p>Titulo del Trackback <br /><input type="text" name="juassi_comment_title" size="30" value="<?php echo juassi_comment_trackback_title(); ?>" /></p>
					<p>Nota: Este comentario es un trackback.</p>
					<?php } ?>
				<?php } ?>
				
			<legend>Detalles del comentario</legend>	
			<table data-msg_rowlink="a" class="table table_vam mbox_table dTableR" id="dt_inbox">
				<thead>
					<tr>
						<th>Direcci&oacute;n IP</th>
						<th>Spam Score</th>
						<th>Fecha del comentario</th>
						<th>Art&iacute;culo</th>
						<?php if (juassi_comment_akismet_spam()) { ?> <th>&nbsp;</th><?php } ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th><a href="http://services.juassi.com/lookup/?type=rdns&amp;ip_address=<?php echo juassi_comment_ip_address(); ?>"><?php echo juassi_comment_ip_address(); ?></a></th>
						<th><?php echo juassi_comment_spam_score(); ?></th>
						<th><?php echo juassi_comment_date(); ?></th>
						<th><a href="<?php echo juassi_post_permalink(); ?>"><?php echo juassi_post_title(); ?></a></th>
						<?php if (juassi_comment_akismet_spam()) { ?><th>Note: Akismet piensa que este es un comentario span.</th><?php } ?>
					</tr>
				</tbody>
			</table>

			<fieldset>
				<?php if (juassi_comment_akismet_spam()) { ?><p>Note: Akismet piensa que este es un comentario span.</p><?php } ?>
			</fieldset>

			<fieldset>
				<legend>Eliminar Comentario</legend>
				<p>Click <a href="delete-comment.php?comment_id=<?php echo juassi_comment_id(); ?>">aqu&iacute;</a> para eliminar este comentario.</p>
			</fieldset>

			<br style="clear:both;" />

			<p>
			<input type="hidden" name="comment_id" value="<?php echo juassi_comment_id(); ?>" />
			<input type="submit" name="submit" value="Edit" />
			</p>
		</form>
		<?php } ?>
	</div>
<?php
	include('include/sidebar.php');
	//include('include/html-footer.php');
?>
<script src="../juassi-resources/js/jquery.min.js"></script>
			<!-- smart resize event -->
			<script src="../juassi-resources/js/jquery.debouncedresize.min.js"></script>
			<!-- hidden elements width/height -->
			<script src="../juassi-resources/js/jquery.actual.min.js"></script>
			<!-- js cookie plugin -->
			<script src="../juassi-resources/js/jquery.cookie.min.js"></script>
			<!-- main bootstrap js -->
			<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
			<!-- tooltips -->
			<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>
			<!-- jBreadcrumbs -->
			<script src="../juassi-resources/lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="../juassi-resources/js/ios-orientationchange-fix.js"></script>
            <!-- scroll -->
			<script src="../juassi-resources/lib/antiscroll/antiscroll.js"></script>
			<script src="../juassi-resources/lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- common functions -->
			<script src="../juassi-resources/js/gebo_common.js"></script>
			
			<script src="../juassi-resources/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="../juassi-resources/js/forms/jquery.ui.touch-punch.min.js"></script>
			<!-- colorbox -->
			<script src="../juassi-resources/lib/colorbox/jquery.colorbox.min.js"></script>
			<!-- datatable (inbox,outbox) -->
			<script src="../juassi-resources/lib/datatables/jquery.dataTables.min.js"></script>
			<!-- additional sorting for datatables -->
			<script src="../juassi-resources/lib/datatables/jquery.dataTables.sorting.js"></script>
			<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/plupload.full.js"></script>
			<script type="text/javascript" src="../juassi-resources/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
			<!-- autosize textareas (new message) -->
			<script src="../juassi-resources/js/forms/jquery.autosize.min.js"></script>
			<!-- tag handler (recipients) -->
			<script src="../juassi-resources/lib/tag_handler/jquery.taghandler.min.js"></script>
			<!-- mailbox functions -->
			<script src="../juassi-resources/js/gebo_mailbox.js"></script>
			
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
			
			<!-- CK editor -->




            <script src="../juassi-resources/lib/tinymce/tinymce.min.js"></script>
            <script src="../juassi-resources/lib/tinymce/jquery.tinymce.min.js"></script>
  
            <script type="text/javascript">
			tinymce.init({
			    selector: "#editor",
			    theme: "modern",
			    plugins: [
			        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
			        "searchreplace wordcount visualblocks visualchars code fullscreen",
			        "insertdatetime media nonbreaking save table contextmenu directionality",
			        "emoticons template paste textcolor"
			    ],
			    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
			    
			    image_advtab: true,
			    templates: [
			        {title: 'Test template 1', content: 'Test 1'},
			        {title: 'Test template 2', content: 'Test 2'}
			    ]
			});
			</script>
		
		</div>
	</body>
</html>