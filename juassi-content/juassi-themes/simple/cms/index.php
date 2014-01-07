<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/header.php'); ?>
		<div class="news">
			<?php
			foreach ($juassi_post_array as $juassi_post) { ?>
				<h2><?php echo juassi_content_title(); ?></h2>
				<?php echo juassi_content_body(); ?>
				<?php if (juassi_user_can('edit_content')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-content-page.php?content_id=' . juassi_content_id() . '">(edit)</a></sub>'; ?>
			<?php } ?>
		</div>
<?php include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/footer.php'); ?>