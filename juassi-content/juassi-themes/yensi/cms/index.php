<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/header.php'); ?>
		<div class="news">
			<?php
					if (!empty($juassi_error)) {
						echo $juassi_error;
					}
					else {
						foreach ($juassi_post_array as $juassi_post) { ?>
							<h2>
								<?php echo juassi_content_title(); ?><?php if (juassi_user_can('edit_content')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-content-page.php?content_id=' . juassi_content_id() . '">(edit)</a></sub>'; ?>
							</h2>
							<div class="newstext">
								<?php echo juassi_content_body(); ?>
								<br clear="all" />
								<div class="postlinks">
									<a href="<?php echo juassi_content_permalink() ;?>">Permalink</a>
								</div>
							</div>

						<?php } ?>
					<?php } ?>
		</div>
<?php include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/footer.php'); ?>