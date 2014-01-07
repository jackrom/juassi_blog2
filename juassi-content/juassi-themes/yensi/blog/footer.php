<!-- footer -->

<!-- social block -->

<div class="social_block">

 <div class="wraper">

  <p>Mantente conectado con tu red social favorita!</p>

  <ul>

   <li class="facebook"><a href="#">Facebook</a></li>

   <li class="twitter"><a href="#">Twitter</a></li>

   <li class="linkedin"><a href="#">LinkedIn</a></li>

   <li class="rss"><a href="juassi-rss.php">RSS</a></li>

   <li class="dribbble"><a href="#">Dribbble</a></li>

   <li class="google"><a href="#">Google+</a></li>

  </ul>

 </div>

</div>

<!-- /social block -->



<div class="footer">

 <footer>

  <!-- bottom about -->

  <div class="bottom_about">

   <p><img src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/logo.png" alt="" /></p>

   <p style="text-align: justify;">disfruto cocinar, ya que siempre esta ligado a momentos muy gratos, como son los de compartir, celebrar, festejar alguna reunion o union, el nacimiento o el cumpleaños de alguien, el logro de una meta ansiada.</p>
  </div>

  <!-- /bottom about -->

  <!-- recent tweets -->

  <div class="recent_tweets">

   <h3><span>Tweets recientes</span></h3>

   <ul>

    <li><a href="#">@laurakalbag</a> I will be very soon. Ase result reco endation <a href="#">31 minutes ago</a></li>

    <li><a href="#">@laurakalbag</a> you got chocolates!? That's i I'm signing up. <a href="#">37 minutes ago</a></li>

   </ul>

  </div>

  <!-- /recent tweets -->

  <!-- recent posts -->

  <div class="recent_posts">

   <h3><span>Art&iacute;culos recientes</span></h3>

   <ul>
       <?php foreach ($juassi_post_array as $juassi_post) { ?>
    <li><a href="<?php echo juassi_post_permalink();?>" ><?php echo $juassi_post['post_title']; ?></a></li>
        <?php } ?>
   </ul>
    
  </div>

  <!-- /recent posts -->

  <!-- subscribe block -->

  <div class="subscribe_block">

   <h3><span>Mantente al d&iacute;a</span></h3>

   <form method="post" action="#">

    <p><input type="text" id="name" value="NOMBRE ..." /></p>

    <p><input type="text" id="email" value="EMAIL ..." /></p>

    <p><input type="submit" value="Suscribete" /></p>

   </form>

  </div>

  <!-- /subscribe block -->

 </footer>

</div>



<!-- copyright -->

<div class="copyright">

 <div class="wraper">

  <p><span>Copyright 2012 Juassi</span>All Rights Reserved<a href="#">RSS</a><a href="#">Comments</a></p>

  <a class="top" href="#">Back to the top</a>

 </div>

</div>

<!-- /copyright -->

<!-- /footer -->
<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://localhost/piwik/" : "http://localhost/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://localhost/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
</body>

</html> 
