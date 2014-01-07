<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php
$html = juassi_htmlentities('<a href="" title="" rel=""></a> <b></b> <blockquote cite=""></blockquote> <em></em> <i></i> <strike></strike> <strong></strong> <li></li> <ol></ol> <ul></ul>'); ?>
            
<h4 style="margin-top:15px;">Quieres Comentar?</h4>
<div class="help_button">Click aqu&iacute; para ayuda a comentarios.</div>
<div class="help">
<p>HTML permitido: <?php echo $html; ?><br />
ie: &lt;b&gt;<b>bold</b>&lt;/b&gt;</p>

<p style="color:red;">Tus comentarios puede necesitar ser revisados antes de ser publicados.</p>

</div>
<?php if (juassi_post_allowed_trackbacks()) { ?>
<p><small>Trackback URL: <?php echo juassi_htmlentities(juassi_post_trackback_link()); ?></small></p>
<?php } ?>
<a name="posted"></a>


<!-- Comment-form -->
<div class="lcomment-form">
	
	<div class="space40"></div>
	<?php
		if(!empty($juassi_input_error)) {
			echo $juassi_input_error . '<br />';
		}
	?>
	<form class="contact-form" id="post" action="<?php echo juassi_get_config('address') . '/juassi-post-comment.php'; ?>" method="post">
		<?php if (!juassi_is_logged_in()) { ?>
		<input type="text" name="juassi_comment_display_name" id="juassi_comment_display_name" class="form-control" value="<?php echo juassi_comment_guest_display_name(); ?>" placeholder="Tu nombre..." />
		<input type="text" name="juassi_comment_email" id="juassi_comment_email" class="form-control" value="<?php echo juassi_comment_guest_email(); ?>" placeholder="Tu email..."/>
		<input type="text" name="juassi_comment_website" id="juassi_comment_website" class="form-control" value="<?php echo juassi_comment_guest_website(); ?>" placeholder="Tu webpage..."/>
		<?php } else { ?>
		<p style="font-weight: bold;">Actualmente est&aacute;s logueado como: <span style="color: black;"><?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?></span>. Los detalles de tu cuenta ser&aacute;n usados.</p>
		<?php } ?>
		<textarea rows="8" class="form-control" name="juassi_comment_body" id="comment-message" placeholder="Your message..."></textarea>
		<input name="juassi_comment_contact_form" type="checkbox" <?php if (juassi_comment_allow_contact_form()) echo 'checked="checked"'; ?> value="1" />Permite el contacto por email
		<input name="juassi_comment_remember_details" type="checkbox" <?php if (juassi_comment_remember_details()) echo 'checked="checked"'; ?> value="1" />Recordar detalles
		<?php juassi_run_section('comment_form'); ?>
		<input type="hidden" name="juassi_comment_spamblock" value="<?php echo juassi_comment_spam_block(); ?>"/>
		<input type="hidden" name="juassi_id" value="<?php echo juassi_post_id(); ?>"/>
		<div class="space25"></div>
		<input type="submit" name="juassi_submit" value="Submit" class="button-blue btn" />
	</form>
</div>


