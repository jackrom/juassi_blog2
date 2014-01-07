<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php 
include 'header.php';
include_once 'Facebook_plugins_class.php'; 
include_once 'includes/admin.functions.php';
global $juassi_content_identifier;
?>
<!-- BEGIN CONTENT WRAPPER -->
<div id="content-wrapper" class="content-wrapper">
<div class="container">
<!-- Content -->
<div class="content grid_9" id="content">
<!-- Post Standard -->
<?php
if(!empty($juassi_error)) {
	echo '<div class="alert alert-info" style="margin-bottom:15px;">
			<i class="icon-info-sign"></i>';
	echo $juassi_error;
	echo '</div><!-- //.info -->';

}else {
	foreach ($juassi_post_array as $juassi_post) { ?>
						

			<article class="entry entry__simple entry__medium">
				<?php
                   	//comienzo de la etiqueta a buscar
	                //procedemos a capturar la imagen del articulo
					$tag1='src';
					//final de la etiqueta a buscar
					if(stripos(juassi_post_body(),'jpg')){
						$tag2 = 'jpg';
					}elseif(stripos(juassi_post_body(),'png')){
						$tag2 = 'png';
					}elseif(stripos(juassi_post_body(),'gif')){
						$tag2 = 'gif';
					}
					
                   	//posicion donde comenzar a buscar
                   	$inicioBusqueda=strpos(juassi_post_body(),$tag1);
                   	
                   	//posicion hasta donde buscar
                   	if(stripos(juassi_post_body(),$tag2))
                   		$finalBusqueda = stripos(juassi_post_body(),$tag2)+4;
                   	else 
                   		$finalBusqueda = stripos(juassi_post_body(),'png')+4; 
                   	
                   	//los numeros de caracteres de la cadena
                   	$numeroCaracteres=strlen(juassi_post_body());
                   	//los numeros de caracteres a extraer de la cadena
                   	$numCaracterExtraer = $finalBusqueda-$inicioBusqueda;
                   	//extraer la imagen
                   	$imagen =substr(juassi_post_body(),$inicioBusqueda,$numCaracterExtraer);
              	   	
                	
                   	
                 	$anchoImagen = 640;

					list($ancho, $alto, $tipo) = getimagesize($imagen);

                    $porcentaje = $anchoImagen / $ancho;
                    $nuevo_ancho = $ancho * $porcentaje;
                    $nuevo_alto = 265;
                    $imagen_p = imagecreatetruecolor($ancho, $alto);
                    $imagenF = ($tipo == 'jpg')?imagecreatefromjpeg($imagen):imagecreatefrompng($imagen);
                    imagecopyresampled($imagen_p, $imagenF, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                    //$imagen = strpos(strrchr('.', $nombreArchivo),'.gif');
                    // guardar imagen
                    imagejpeg($imagen_p,juassi_get_config("address").'/juassi-content/juassi-themes/juassi/blog/images/blog/'.juassi_post_title().'.jpg', 100);
                    
                    
                    if(stripos($imagen,'jpg') || stripos($imagen,'png') || stripos($imagen,'gif')){
				?>
					<!-- begin post image -->
					<?php 
						if(!juassi_post_comments()){
							echo '<figure class="thumb">';
							echo '<a href="'.juassi_post_permalink().'"><img '.$imagen.' width="240" alt="<?php juassi_post_title() ?>" /></a>';
							echo '</figure>';
						}
						
						$imagen = str_replace('src=', '', $imagen);
						$imagen = str_replace('"', '', $imagen);
						
						?>
						
					
					<!-- end post image -->
				<?php
					}
                ?>
				<!-- end post image -->
				
				<!-- begin post heading -->
				<header class="entry-header">
					<div class="entry-header-inner">
						<h3 class="entry-title"><a href="<?php echo juassi_post_permalink() ;?>"><?php echo juassi_post_title(); ?></a></h3>
						<p class="post-meta">
							<span class="post-meta-date"><a href="#"><i class="icon-calendar"></i><?php echo changeDate(date('D, d M Y', strtotime(juassi_post_date()))); ?></a></span>
							<span class="post-meta-cats"><i class="icon-tag"></i><a href="#"><?php echo juassi_post_cat(); ?></a></span>
							<span class="post-meta-author"><a href="<?php echo juassi_get_config('address'); ?>/jcr/"><i class="icon-user"></i><?php echo juassi_post_author(); ?></a></span>
							<span class="post-meta-comments"><a href="<?php echo juassi_post_permalink(); ?>#comments"><i class="icon-comments-alt"></i> <?php echo juassi_post_comment_count(); ?></a></span>
							<?php if (juassi_user_can('edit_posts')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-post.php?post_id=' . juassi_post_id() . '">(edit)</a></sub>'; ?>
						</p>
					</div>
				</header>
				<!-- end post heading -->
				
				<!-- begin post content -->
				<div class="entry-content" style="text-align:justify; min-height:120px;">
					<?php 
                    //si estamos mostrando el articulo, mostramos todo su contenido, sino solo un resumen
                    if(juassi_post_comments()){
                  		echo juassi_post_body_raw();
                   	}else{
                        $resumen = juassi_post_body();
                   		if(strlen($resumen)>=450 )
                     		$resumen = substr($resumen,0,450);
                    	// uso de preg_mach_all con la expresion regular
                        echo strip_tags($resumen).'...';
                        //echo juassi_post_body();
                    }
                    ?>
				</div>
				<!-- end post content -->
				<?php 
				$domain = $_SERVER['HTTP_HOST'];
				$name = juassi_get_config("script_path");
				$final = str_replace('http://'.$domain.$name,'', juassi_post_permalink());
				//http://localhost/juassi_blog2/archive/2013/07/20/juassi-2/
				?>
				
				
				
					<?php 
					if (!juassi_post_comments()) {
						echo '<a href="';
						echo juassi_post_permalink();
						echo '" class="link">Ver art&iacute;culo completo... <i class="icon-chevron-sign-right"></i></a>
								</footer>
								<!-- end post footer -->';
					}else{
						echo '<div class="container" style="margin-bottom:0;">
								<div class="product grid_3">
								Como valoras: El contenido
								<div id="rating_1" class="ratings">
									<div class="star_1 ratings_stars"></div>
									<div class="star_2 ratings_stars"></div>
									<div class="star_3 ratings_stars"></div>
									<div class="star_4 ratings_stars"></div>
									<div class="star_5 ratings_stars"></div>
									<div class="total_votes">resultados</div>
								</div>
							</div>
							<div class="product grid_3">
								Como valoras: El dise&ntilde;o
								<div id="rating_2" class="ratings">
									<div class="star_1 ratings_stars"></div>
									<div class="star_2 ratings_stars"></div>
									<div class="star_3 ratings_stars"></div>
									<div class="star_4 ratings_stars"></div>
									<div class="star_5 ratings_stars"></div>
									<div class="total_votes">resultados</div>
								</div>
							</div></div>
							</footer>
							<!-- end post footer -->
							
							';

					}
					?>
					<!-- begin post footer -->
				<footer class="entry-footer">
					<footer class="team-footer grid_3"  style="float:right;text-align:right;margin-top:-10px;">
						<!-- Social Links -->
						<p style="display:inline; float:left;margin:0 5px;">Comparte</p>
						<ul class="social-links social-links__small">
							<li class="link-twitter"><a href="javascript:void(0);" onclick="window.open('http://twitter.com/home?status=Te recomiendo la lectura de: <?php echo juassi_post_title(); ?> excelente art&iacute;culo– via @jcarlosreyesc <?php echo juassi_post_permalink() ;?>','ventanacompartir', 'top=160, left=100, toolbar=0, status=0, width=650, height=350');"><i class="icon-twitter"></i></a></li>
							<li class="link-facebook">
		                    	<?php
								//include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/Facebook_plugins_class.php');
								$f1 = new Facebook_plugins_class();
								$display = $f1->display_status_update(array('title'=>'<i class="icon-facebook"></i>', 'link'=> juassi_post_permalink(), 'picture'=>$imagen));
								echo $display;
								?>
		                        
		                    </li>
							<li class="link-google">
								<a href="https://plus.google.com/share?url= http://www.juassi.com/blog<?php echo $final ;?>" onclick="javascript:window.open(this.href,
								  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
								<i class="icon-google-plus"></i></a>
							</li>
							<li class="link-pinterest"><a href="#"><i class="icon-pinterest"></i></a></li>
							<li class="link-rss"><a href="#"><i class="icon-rss"></i></a></li>
						</ul>
						<!-- /Social Links -->
					</footer>
					</article>
				
				
				<!-- /Post Standard -->
				<?php 
					if (juassi_post_comments()) { 
						
						?>
						
						<div class="grid_9" style="margin-bottom:50px; ">
							<div style="margin-bottom:0px;left:90px;position:absolute;">
								<a href="https://twitter.com/juassic" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size = "medium">Follow Juassi</a>
							</div>
							<!-- Place this tag where you want the +1 button to render. -->
							<div class="g-plusone" ></div>
							<div class="fb-like grid_4" style="position:absolute; left:235px;margin-top:-28px;" data-href="http://www.juassi.com/blog/<?php echo juassi_post_title(); ?>" data-send="true" data-show-faces="true" data-font="tahoma"></div>
							<div id="fb-root" class="facebookLike"></div>
						</div>
				<?php

						juassi_post_comments_setup();
						if(juassi_post_comment_count() > 0){
						?>
						
						<!-- Comments -->
						
							<h4>Comentarios (<?php echo juassi_post_comment_count(); ?>) </h4>
	                        <?php
                              foreach ($juassi_comment_array as $juassi_comment) {
                              	 if(juassi_comment_user()) { ?>	
                              	 	<!-- BEGIN COMMENTS LIST -->
									<div class="comments-wrapper">
									<ol class="commentlist">
										<li class="comment">
											<!-- BEGIN SINGLE COMMENT -->
											<div class="comment-wrapper">
												<div class="comment-author vcard">
													<p class="gravatar">
														<a href="#">
															<img src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/samples/avatar1.jpg" alt="" width="56" height="56" />
														</a>
													</p>
													<span class="author"><?php echo juassi_comment_name_url(); ?><?php if (juassi_user_can('edit_comments')) echo '<a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '" >Edit</a>'; ?></span>
												</div>
												<div class="comment-meta">
													<div class="comment-meta"><?php echo changeDate(date('D, d M Y', strtotime(juassi_comment_date()))); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?> de <?php echo juassi_comment_name_url(); ?> <?php echo juassi_htmlentities(juassi_get_config('domain')); ?></div>
												</div>
												<div class="comment-body">
													<?php echo juassi_comment_body(); ?>
												</div>
												<div class="comment-reply">
													<a href="#">Reply &rarr;</a>
												</div>
											</div>
										</li>
									</ol>
								</div>
								<!-- END SINGLE COMMENT -->
                              	<?php } elseif (juassi_comment_trackback()) { ?>
                              	<!-- BEGIN COMMENTS LIST -->
									<div class="comments-wrapper">
									<ol class="commentlist">
										<li class="comment">
											<!-- BEGIN SINGLE COMMENT -->
											<div class="comment-wrapper">
												<div class="comment-author vcard">
													<span class="author"><?php echo juassi_comment_trackback_title(); ?></span>
												</div>
												<div class="comment-meta">
													<div class="comment-meta"><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> 
                                                        	at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?> 
                                                        	| <?php echo juassi_comment_name_url(); ?> sent this trackback 
                                                        	| <?php if (juassi_user_can('edit_comments')) 
                                                        		echo ': <a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>'; ?>
                                                    </div>
												</div>
												<div class="comment-body">
													<?php echo juassi_comment_body(); ?>
												</div>
												<div class="comment-reply">
													<a href="#">Reply &rarr;</a>
												</div>
											</div>
										</li>
									</ol>
								</div>
								<!-- END SINGLE COMMENT -->
                              	<?php } else { ?>
                              		<!-- BEGIN COMMENTS LIST -->
									<div class="comments-wrapper">
										<ol class="commentlist">
											<li class="comment">
												<!-- BEGIN SINGLE COMMENT -->
												<div class="comment-wrapper">
													<div class="comment-meta">
														<div class="comment-meta"><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?> | <?php echo juassi_comment_name_url(); ?> sent this trackback | <?php if (juassi_user_can('edit_comments')) echo '<a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>' ?></div>
													</div>
													<div class="comment-body">
														<?php echo juassi_comment_body(); ?>
													</div>
													<div class="comment-reply">
														<a href="#">Reply &rarr;</a>
													</div>
												</div>
											</li>
										</ol>
									<!-- END SINGLE COMMENT -->
									</div>
                               <?php }
                               }	
							}
							include('comment_form.php');
							echo '</div>';
						}
					?>
						
		<?php }

} ?>



<!-- pager_nav -->
 <?php
if(!juassi_post_comments()){
echo '<ul class="pagination">';
   
    
    //global $juassi_content_identifier;
	
    $totalPost = juassi_total_post_count();
    
    
    $numPagesPost = juassi_get_config('limit_posts');
    $totalPaginas = ceil($totalPost/$numPagesPost);
    $paginaActual = $juassi_content_identifier['page'];
    $numeroArticulos = $paginaActual * $numPagesPost;
    
    if ((int)$juassi_content_identifier['page'] == 0) {
        echo juassi_total_post_count().' art&iacute;culos en total   ';
        //echo '<span class="seleccionado">&laquo; pagina anterior </span>';
        for($i=0;$i<$totalPaginas;$i++){
            $permalink_format = juassi_get_config('post_permalink_format');

            $permalink = str_replace('%year%', '', $permalink_format);
            $permalink = str_replace('%month%', '', $permalink);
            $permalink = str_replace('%day%', '', $permalink);
            $permalink = str_replace('%x_title%', '', $permalink);
            $permalink = str_replace('%post_id%', '', $permalink);
            $j=$i+1;
            //$permalink .= 'page/' . ((int)$juassi_content_identifier['page'] + $j) . '/';
            if($j == $juassi_content_identifier['page']){
                echo '<li class="current"><span>';
                echo $j;
                echo '</span></li>';
            }elseif($j==1){
                echo '<li class="current"><span>';
                echo $j;
                echo '</span></li>';
            }else{
                echo '<li><a href="'.juassi_get_config('address').$permalink.'page/' . $j.'">';
                echo $j;
                echo '</a></li>';
            }
        }
		if(juassi_total_post_count() > 10)
        	echo '<li class="next"><a href="'.juassi_posts_next_page().'"><i class="icon-angle-right"></a>';
    }else{
        if ((int)$juassi_content_identifier['page'] == 1) {
            $articulosdePagina = (int)$juassi_content_identifier['page'] * $numPagesPost;
            echo $articulosdePagina.' de '.$totalPost.' | ';
            //echo '<span class="seleccionado">&laquo; pagina anterior </span>';
            for($i=0;$i<$totalPaginas;$i++){
                $permalink_format = juassi_get_config('post_permalink_format');

                $permalink = str_replace('%year%', '', $permalink_format);
                $permalink = str_replace('%month%', '', $permalink);
                $permalink = str_replace('%day%', '', $permalink);
                $permalink = str_replace('%x_title%', '', $permalink);
                $permalink = str_replace('%post_id%', '', $permalink);
                $j=$i+1;
                //$permalink .= 'page/' . ((int)$juassi_content_identifier['page']).'/'. $j ;
                if($j == $juassi_content_identifier['page']){
                    echo '<li class="current"><span>';
                    echo $j;
                    echo '</span></li>';
                }else{
                    echo '<li><a href="'.juassi_get_config('address').$permalink.'page/' . $j.'">';
                    echo $j;
                    echo '</a></li>';
                }
            }  
            echo '<li class="next"><a href="'.juassi_posts_next_page().'"><i class="icon-angle-right"> </a></li>';
        }elseif((int)$juassi_content_identifier['page'] > 1 && (int)$juassi_content_identifier['page'] < $totalPaginas){
            $articulosdePagina = (int)$juassi_content_identifier['page'] * $numPagesPost;
            echo $articulosdePagina.' de '.$totalPost.' | ';
            echo '<li class="prev"><a href="'.juassi_posts_previous_page().'"><i class="icon-angle-left"></i></a><li>';
            for($i=0;$i<$totalPaginas;$i++){
                $permalink_format = juassi_get_config('post_permalink_format');

                $permalink = str_replace('%year%', '', $permalink_format);
                $permalink = str_replace('%month%', '', $permalink);
                $permalink = str_replace('%day%', '', $permalink);
                $permalink = str_replace('%x_title%', '', $permalink);
                $permalink = str_replace('%post_id%', '', $permalink);
                $j=$i+1;
                //$permalink .= 'page/' . ((int)$juassi_content_identifier['page']).'/'. $j ;
                if($j == $juassi_content_identifier['page']){
                    echo '<li class="current"><span>';
                    echo $j;
                    echo '</span></li>';
                }else{
                    echo '<li><a href="'.juassi_get_config('address').$permalink.'page/' . $j.'">';
                    echo $j;
                    echo '</a></li>';
                }
            } 
            echo '<li class="next"><a href="'.juassi_posts_next_page().'"><i class="icon-angle-right"></i></a></li>';
        }else{
            $articulosdePagina = (int)$juassi_content_identifier['page'] * $numPagesPost;
            echo $totalPost.' de '.$totalPost.' | ';
            echo '<li class="prev"><a href="'.juassi_posts_previous_page().'"><i class="icon-angle-left"></i></a>';
            for($i=0;$i<$totalPaginas;$i++){
                $permalink_format = juassi_get_config('post_permalink_format');

                $permalink = str_replace('%year%', '', $permalink_format);
                $permalink = str_replace('%month%', '', $permalink);
                $permalink = str_replace('%day%', '', $permalink);
                $permalink = str_replace('%x_title%', '', $permalink);
                $permalink = str_replace('%post_id%', '', $permalink);
                $j=$i+1;
                //$permalink .= 'page/' . ((int)$juassi_content_identifier['page']).'/'. $j ;
                if($j == $juassi_content_identifier['page']){
                    echo '<li class="current"><span>';
                    echo $j;
                    echo '</span></li>';
                }else{
                    echo '<li><a href="'.juassi_get_config('address').$permalink.'page/' . $j.'">';
                    echo $j;
                    echo '</a></li>';
                }
            } 
            echo ' <span class="seleccionado">pagina siguiente &raquo; </span>';
        }
	
    }
 echo '</ul></div>';
}
?>
    

<!-- Content / End -->
<?php include('sidebar.php'); ?>


<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'es'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();
</script>

<!-- Facebook. -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=276583045711474";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


<?php include('footer.php'); ?>


