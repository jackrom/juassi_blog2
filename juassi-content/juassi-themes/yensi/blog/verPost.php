<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include('header.php'); ?>

<div class="clear"></div>
	<div id="center">
		<!-- main content -->
        <div class="content">
		<div class="col_34" style="border:1px solid yellow;">
           <?php
        if (!empty($juassi_error)) {
			echo $juassi_error;
		}else { ?>

<div class="bloglist">
<div class="blogtitle">
<div class="postcomment">
                <?php if (juassi_post_show_comment_count()) { ?>
                <h3><a href="<?php echo juassi_post_permalink(); ?>#comments">
                <?php echo juassi_post_comment_count(); }?></a></h3></div>
                <div class="posttitle"><h3><a href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/verPost.php?post_id=<?php echo $juassi_post['post_id'] ?>"><?php echo juassi_post_title(); ?></a></h3></div>
                <div class="clear"></div>
              </div>
              <div class="clear"></div>
              <div class="postimage">
                <img src="images/blogimg1.jpg" alt="" />
              </div>
              <div class="clear"></div>
              <div class="postdate">
              	<?php
					$fechaMayor = date('D, d M Y g:i A', strtotime(juassi_post_date()));
					$fecha = explode(' ',$fechaMayor);
				?>
                <h2><?php echo $fecha[1]; ?></h2>
                <h5><?php echo $fecha[2]; ?></h5>
              </div>
              	<div class="postcontent">
                	<?php echo juassi_post_body(); ?>
                <div class="postmeta">
                  Posted by <a href="<?php echo juassi_get_config('address'); ?>/contact/"><?php echo juassi_post_author(); ?>
                  <?php if (juassi_user_can('edit_posts')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-post.php?post_id=' . juassi_post_id() . '">(edit)</a></sub>'; ?>
                  </a> bajo las categorias: <a href="#"><?php echo juassi_post_cat(); ?></a>
                  <a href="#" class="readmore">Continue Reading &rarr;</a>
                </div>
              </div>
            </div>
            <div class="clear"></div>
            <div class="divider"></div>
            <?php } ?>