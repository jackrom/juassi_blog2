<?php
include('include/admin-header.php');
juassi_set_admin_title('Delete Comment');
juassi_set_in_admin(true);

if (juassi_user_can('edit_comments')) {
	if (isset($_REQUEST['comment_id']) && (int)$_REQUEST['comment_id'] != 0) {
		$comment_id = (int) $_REQUEST['comment_id'];
		$juassi_comments = new juassi_comments();

		if (isset($_POST['submit']) && $_POST['submit'] == 'Delete') {
			$juassi_comments->delete_comment($comment_id);
			$message = '<strong>Comment deleted.</strong>';
			juassi_set_header('Location: comments.php');
			juassi_send_headers();
		}
		else {
			$juassi_content_identifier['comment_id'] = $comment_id;
			$juassi_content_identifier['limit'] = 1;
			$juassi_content_identifier['all_comments'] = 1;

			$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
			if (!empty($juassi_comment_array)) {
				$juassi_comment = $juassi_comment_array[0];
			}
			else {
				$message = '<strong>Comment not found.</strong>';
			}
		}
	}
	else {
		$message = '<strong>Comment not found.</strong>';
	}
}
else {
	$message = '<strong>You don\'t have permission to edit comments.</strong>';
}
include('include/html-header.php');
?>
<div class="contain">
	<h1>Delete Comment</h1>
<?php
	if (isset($message)) echo juassi_admin_message($message);
	if (isset($juassi_comment)) {
		?>
		<p>Are you sure you wish to delete this comment?</p>
		<div class="comments">
			<cite>
				On <?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?>, <?php echo juassi_comment_name_url(); ?> wrote:
			</cite>
			<div class="comments_body">
				<?php echo juassi_comment_body(); ?>
			</div>
			<div class="comments_bottom">

			</div>
		</div>
		<form method="post" action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
			<p><input type="hidden" name="comment_id" value="<?php echo juassi_comment_id(); ?>" /><input type="submit" name="submit" value="Delete" /></p>
		</form>
		<br />
		<?php
	}
?>
</div>

<?php include('include/html-footer.php'); ?>