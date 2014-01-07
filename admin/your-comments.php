<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Your Comment');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>

<?php
	$juassi_content_identifier = juassi_get_content_identifier();

	$juassi_content_identifier['limit'] = 100;
	//paging support.
	$juassi_content_identifier['offset'] = $juassi_content_identifier['limit'] * $juassi_content_identifier['page'] - $juassi_content_identifier['limit'];
	if ($juassi_content_identifier['offset'] < 0) {
		$juassi_content_identifier['offset'] = 0;
	}
	$juassi_content_identifier['order'] = 1;
	$juassi_content_identifier['get_posts'] = true;

	$juassi_content_identifier['user_id'] = juassi_get_user_data('user_id');

	$juassi_comments = new juassi_comments();
	$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);

	$juassi_next_page = (int) $juassi_content_identifier['page'] + 1;
	$juassi_previous_page = (int) $juassi_content_identifier['page'] - 1;
	if ($juassi_previous_page < 1) {
		$juassi_previous_page = 1;
	}
	if ($juassi_next_page < 1) {
		$juassi_next_page = 1;
	}
	$comments_page_num = count($juassi_comment_array);

	if ($comments_page_num != 100) {
		$juassi_next_page = 1;
		$link_text = 'Primera p&aacute;gina';
	}
	else {
		$link_text = 'Siguiente p&aacute;gina';
	}
	?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Tus Comentarios</h2>

		<p><a href="your-comments.php?juassi_page=<?php echo $juassi_previous_page; ?>">&laquo; p&aacute;gina anterior</a> <a href="your-comments.php?juassi_page=<?php echo $juassi_next_page; ?>"><?php echo $link_text; ?> &raquo;</a></p>
	

<table data-msg_rowlink="a" class="table table_vam mbox_table dTableR" id="dt_inbox">
	<thead>
		<tr>
			<th>ID</th>
			<th>articulo</th>
			<th>mail</th>
			<th>acci&oacute;n</th>
			<th>IP</th>
			<th>fecha</th>
			<th>hora</th>
			<th>usuario</th>
			<th>mensaje</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
		//reset comment number
		juassi_comment_number(true);
		$juassi_content_identifier['only_normal_spam'] = 0;
		$juassi_content_identifier['only_akismet_spam'] = 0;
		$juassi_content_identifier['limit'] = 10;
		$juassi_content_identifier['order'] = 1;
		$juassi_content_identifier['comment_approved'] = 1;
		$juassi_content_identifier['get_posts'] = true;

		$juassi_comments = new juassi_comments();
		$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
		foreach ($juassi_comment_array as $juassi_comment) {
			$juassi_post = $juassi_comment;
		?>
		<tr class="unread">
			<?php 
				$botones = explode(':',juassi_comment_admin_bottom());
				//echo juassi_comment_admin_bottom();
				echo '<td class="nohref">';
				echo juassi_comment_number();
				echo '</td>';
				echo '<td>';
				echo juassi_comment_view_post();
				echo '</td>';
				echo '<td>';
				echo juassi_comment_email_address();
				echo '</td>';
				echo '<td>';
				echo juassi_comment_action();
				echo '</td>';
				echo '<td>';
				echo juassi_comment_ip();
				echo '</td>';
			?>
			<td><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?></td>
			<td><?php echo date('g:i A', strtotime(juassi_comment_date())); ?></td>
			<td><?php echo juassi_comment_name_url(); ?></td>
			<td><?php echo juassi_comment_body(); ?></td>
			
			
		</tr>
		<?php }	?>
	</tbody>
</table>
<p><a href="your-comments.php?juassi_page=<?php echo $juassi_previous_page; ?>">&laquo; p&aacute;gina anterior</a> <a href="your-comments.php?juassi_page=<?php echo $juassi_next_page; ?>"><?php echo $link_text; ?> &raquo;</a></p>			
			
			
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
		
		</div>
	</body>
</html>