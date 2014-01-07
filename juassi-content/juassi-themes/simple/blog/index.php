<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include('header.php'); ?>
<div class="news">
	<?php foreach ($juassi_post_array as $juassi_post) { ?>
		<h2><a href="<?php echo juassi_post_permalink() ;?>"><?php echo juassi_post_title(); ?></a></h2>
		<cite>Posted by <a href="<?php echo juassi_get_config('address'); ?>/contact/"><?php echo juassi_post_author(); ?></a> on <?php echo date('D, d M Y g:i A', strtotime(juassi_post_date())); ?> <?php if (juassi_user_can('edit_posts')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-post.php?post_id=' . juassi_post_id() . '">(edit)</a></sub>'; ?></cite>
		<?php echo juassi_post_body(); ?>
	<?php } ?>
</div>
<?php include('footer.php'); ?>