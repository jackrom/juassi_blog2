<?php if (!defined('JUASSI_ROOT')) exit; ?>
	<!-- BEGIN FOOTER -->
	<footer id="footer" class="footer">
		
		<!-- Footer Widgets -->
		<div class="widgets-footer">
			<div class="container clearfix">
				<div class="grid_3">
					<!-- Social Widget -->
					<div class="social-widget widget widget__footer">
						<h3 class="widget-title">Social Networks</h3>
						<div class="widget-content">
							<ul class="social-links">
								<li class="link-twitter"><a href="http://www.twitter.com/juassic"><i class="icon-twitter"></i></a></li>
								<li class="link-facebook"><a href="https://www.facebook.com/DigitalkCommunity"><i class="icon-facebook"></i></a></li>
								<li class="link-google"><a href="#"><i class="icon-google-plus"></i></a></li>
								<li class="link-pinterest"><a href="#"><i class="icon-pinterest"></i></a></li>
								<li class="link-rss"><a href="#"><i class="icon-rss"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- /Social Widget -->
					<!-- Contact Widget -->
					<div class="contact-widget widget widget__footer">
						<h3 class="widget-title">Necesitas consultar algo?</h3>
						<div class="widget-content">
							<span class="phone-num">1-900-1234-5678</span>
						</div>
					</div>
					<div class="soporte">
						<ul>
							<li><i class="icon-wrench"></i><h3 class="soporte-title"><a href="http://www.juassi.com/soporte/">Soporte (Tickets)</a></h3></li>
							<li><i class="icon-comments"></i><h3 class="soporte-title"><a href="" onclick="venta()">Soporte On Line (chat)</a></h3></li>
							
							<script language="JavaScript">
								function venta() {
									ventana = open("http://www.juassi.com/chat/clientes/index.php" , "chat", 'location=yes , resizable=yes , width=695 , height=630, scrollbars=yes')
								}
							</script>
						</ul>
					</div>
					<!-- /Contact Widget -->
				</div>
				<div class="grid_3">
					<!-- Twitter Widget -->
					<div class="twitter-widget widget widget__footer">
						<h3 class="widget-title">Twitter</h3>
						<div class="widget-content">
							<ul id="twitter-feed" class="twitter_update_list" id="twitIcon"></ul>
						</div>
					</div>
					<!-- /Twitter Widget -->
				</div>
				<div class="grid_3">
					<!-- Recent Post Widget -->
					<div class="recent-posts widget widget__footer">
						<h3 class="widget-title">Desde nuestro Blog</h3>
						<div class="widget-content">
							<?php 
								$query = 'SELECT * FROM jb2_posts ORDER BY post_date DESC LIMIT 3';
								$latestPost = dbAll($query);
								echo '<ul class="recent-posts-list">';
								foreach($latestPost as $post){
									echo '<li><a href="'.juassi_permalink($post).'">'.$post['post_title'].'</a></li>';
								}
							?>
						</div>
					</div>
					<!-- /Recent Post Widget -->
				</div>
				<div class="grid_3">
					<!-- FLickr Widget -->
					<div class="flickr-widget widget widget__footer">
						<h3 class="widget-title">Flickr</h3>
						<div class="widget-content">
							<!-- Flickr images will appear here -->
							<ul id="flickr" class="thumbs"></ul>
						</div>
					</div>
					<!-- /Flickr Widget -->
				</div>
			</div>
		</div>
		<!-- /Footer Widgets -->
		
		<!-- Copyright -->
		<div class="copyright">
			<div class="container clearfix">
				<div class="grid_12 mobile-nomargin">
					<div class="clearfix">
						<div class="copyright-primary" style="margin-right:150px;">
							Juassi Studios &copy; 2013 <span class="separator">|</span><a href="privacidad.php">Po&iacute;tica de Privacidad</a>
						</div>
						<?php echo juassi_stop_timer(4) . ' Seconds'; ?> Powered by <a href="http://www.juassi.com/">Juassi</a>
						<?php echo juassi_memory_usage(); ?>
						<?php echo $juassi_db->juassi_num_queries(); ?> Queries
						<div class="copyright-secondary">
							Creado por <a href="jcr/">Juan Carlos Reyes</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Copyright -->
		
	</footer>
	<!-- END FOOTER -->
	</div>
		
	
</div>
<!-- END WRAPPER -->


<!-- Javascript Files
================================================== -->

<!-- initialize jQuery Library -->
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery-1.9.1.min.js"></script>
<!-- jQuery migrate plugin -->
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery-migrate-1.1.1.min.js"></script>
<!-- Modernizr -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/modernizr.custom.14583.js"></script>
<!-- easing plugin -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.easing.min.js"></script>
<!-- Mobile Navigation -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.mobilemenu.js"></script>
<!-- Navigation -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.superfish.js"></script>
<!-- Slider -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.flexslider-min.js"></script>
<!-- FitVideo -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.fitvids.js"></script>
<!-- Flickr -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jflickrfeed.js"></script>
<!-- Twitter -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.twitter.js"></script>
<!-- Carousel -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.touchSwipe.min.js"></script>
<!-- Isotope -->
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.isotope.min.js"></script>
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.imagesloaded.min.js"></script>
<!-- Magnific Popup -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/jquery.magnific-popup.min.js"></script>

<!-- Custom -->
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/custom.js"></script>

<!-- Flex Slider Thumbs Init -->
<script type="text/javascript">
jQuery(function($){
	
	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: true,
		itemWidth: 140,
		itemMargin: 20,
		asNavFor: '#flexslider',
		prevText: "<i class='icon-chevron-left'></i>",
    	nextText: "<i class='icon-chevron-right'></i>",
	});

	$('#flexslider').flexslider({
		animation: "slide",
		directionNav: false,
		controlNav: false,
		animationLoop: false,
		slideshow: true,
		slideshowSpeed: 6000,
		sync: "#carousel",
		start: function(slider){
			jQuery('#flexslider').removeClass('loading');
		}
	});
});
</script>

<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/js/rating.js"></script>


<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42026380-1', 'juassi.com');
  ga('send', 'pageview');

</script>
<!-- Google Analytics / End -->


	
</body>
</html>