<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php
$html = juassi_htmlentities('<a href="" title="" rel=""></a> <b></b> <blockquote cite=""></blockquote> <em></em> <i></i> <strike></strike> <strong></strong> <li></li> <ol></ol> <ul></ul>'); ?>
<!-- Comment Form -->
<div class="comments-form-wrapper clearfix">
	<h4>Envienos su comentario</h4>

	<div class="alert alert-warning" style="color:#38332c;">
		<i class="icon-warning-sign"></i>
		<p>HTML permitido: <?php echo $html; ?></p>
		ie: &lt;b&gt;<b>bold</b>&lt;/b&gt;
	</div><!-- //.warning -->
	<div class="alert alert-warning" style="color:#38332c;margin-bottom:10px;">
		<i class="icon-warning-sign"></i>
			Tus comentarios pueden necesitar ser revisados antes de ser publicados.
	</div>
	
	
	<?php if (juassi_post_allowed_trackbacks()) { ?>
	<p><small>Trackback URL: <?php echo juassi_htmlentities(juassi_post_trackback_link()); ?></small></p>
	<?php } ?>
	
	<form action="<?php echo juassi_get_config('address') . '/juassi-post-comment.php'; ?>" method="post" id="comment-form" class="comment-form input-blocks">
		<?php
			if(!empty($juassi_input_error)) {
				echo '<div class="alert alert-info" style="margin-bottom:15px;">
						<i class="icon-info-sign"></i>';
				echo $juassi_input_error . '<br />';
				echo '</div><!-- //.info -->';
				
			}
		?>
		<?php if (!juassi_is_logged_in()) { ?>
		<div class="clearfix">
			<div class="grid_3 alpha">
				<div class="field">
					<label for="comment-name"><strong>Su nombre</strong> (requerido)</label>
					<input type="text" name="juassi_comment_display_name" id="comment-name" value="<?php echo juassi_comment_guest_display_name(); ?>">
				</div>
			</div>
			<div class="grid_3">
				<div class="field">
					<label for="comment-mail"><strong>E-mail</strong> (requerido)</label>
					<input type="email" name="juassi_comment_email" id="comment-mail" value="<?php echo juassi_comment_guest_email(); ?>">
				</div>
			</div>
			<div class="grid_3 omega">
				<div class="field">
					<label for="comment-site"><strong>Website</strong></label>
					<input type="text" name="juassi_comment_website" id="comment-site" value="<?php echo juassi_comment_guest_website(); ?>">
				</div>
			</div>
		</div>
		<?php } else { ?>
			<p style="display:inline;float:left;">Actualmente estas logueado como: <h5 style="display:inline; float:left;margin:0 10px;margin-top:-2px;"><?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?></h5> Los detalles de tu cuenta ser&aacute;n usados.</p>
		<?php } ?>
		<div class="clearfix">
			<div class="grid_9 alpha omega">
				<div class="field">
					<label for="comment-message"><strong>Su comentario</strong> (requerido)</label>
					<textarea name="juassi_comment_body" id="comment-message" cols="30" rows="10"></textarea>
				</div>
			</div>
		</div>
		<p><input name="juassi_comment_contact_form" type="checkbox" <?php if (juassi_comment_allow_contact_form()) echo 'checked="checked"'; ?> value="1" />&nbsp;&nbsp;Permitir contacto por email &nbsp;&nbsp;&nbsp;&nbsp;
		<input name="juassi_comment_remember_details" type="checkbox" <?php if (juassi_comment_remember_details()) echo 'checked="checked"'; ?> value="1" />&nbsp;&nbsp;Recordar detalles</p>
		<p><input type="hidden" name="juassi_comment_spamblock" value="<?php echo juassi_comment_spam_block(); ?>"/></p>
		<?php juassi_run_section('comment_form'); ?>
		<p><input type="hidden" name="juassi_id" value="<?php echo juassi_post_id(); ?>"/></p>
		<input type="submit" name="juassi_submit" value="Submit">
	</form>
	
</div>
<!-- Comment Form / End -->

<!-- Content / End -->