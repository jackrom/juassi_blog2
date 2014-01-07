<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php
$html = juassi_htmlentities('<a href="" title="" rel=""></a> <b></b> <blockquote cite=""></blockquote> <em></em> <i></i> <strike></strike> <strong></strong> <li></li> <ol></ol> <ul></ul>'); ?>
<!-- /Leave a Comment -->

<div class="help_button">Click for comments help.</div>
<div class="help">
<p>HTML allowed: <?php echo $html; ?><br />
ie: &lt;b&gt;<b>bold</b>&lt;/b&gt;</p>
<p>Your comment may need to be reviewed before it is published.</p>
</div>

<div class="leave_comment">
	<h4>Comments?</h4>



<?php if (juassi_post_allowed_trackbacks()) { ?>
<p><small>Trackback URL: <?php echo juassi_htmlentities(juassi_post_trackback_link()); ?></small></p>
<?php } ?>
<a name="posted"></a>
<form id="post" action="<?php echo juassi_get_config('address') . '/juassi-post-comment.php'; ?>" method="post">

		<?php
			if(!empty($juassi_input_error)) {
				echo $juassi_input_error . '<br />';
			}
		?>
		
			<?php if (!juassi_is_logged_in()) { ?>
			<p><label for="namet">Name</label>(required)</br><input name="juassi_comment_display_name" type="text" id="namet" value="<?php echo juassi_comment_guest_display_name(); ?>"/></p>
			<p><label for="mailt">E-mail</label>(required)</br><input name="juassi_comment_email" type="text" id="mailt" value="<?php echo juassi_comment_guest_email(); ?>"/></p>
			<p><label for="website">Website</label></br><input name="juassi_comment_website" type="text" id="website" value="<?php echo juassi_comment_guest_website(); ?>"/></p>
			
			<?php } else { ?>
			<p>You're currently logged in as <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?>. Your user account details shall be used.</p>
			<?php } ?>
            <p><label for="message">Message</label><textarea name="juassi_comment_body" cols="75" rows="10" id="message"></textarea></p>
            <div><input name="juassi_comment_contact_form" type="checkbox" <?php if (juassi_comment_allow_contact_form()) echo 'checked="checked"'; ?> value="1" />Allow contact form email</div>
			<div><input name="juassi_comment_remember_details" type="checkbox" <?php if (juassi_comment_remember_details()) echo 'checked="checked"'; ?> value="1" />Remember details</div>
			<?php juassi_run_section('comment_form'); ?>
		<p><input type="hidden" name="bt_comment_spamblock" value="<?php echo juassi_comment_spam_block(); ?>"/>
		<input type="hidden" name="juassi_id" value="<?php echo juassi_post_id(); ?>"/>
		<input type="submit" name="juassi_submit" value="Submit" class="btn_m"/></p>

</form>
</div>