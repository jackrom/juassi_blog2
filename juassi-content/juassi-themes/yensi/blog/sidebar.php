</div>
<!-- sidebar -->
<div class="sidebar">
    <!-- Search ---->
    <div>
        <?php search_html_form() ?>
    </div>
	<!-- most popular -->
	<div class="most_popular">
		<h4>Art&iacute;culos mas populares</h4>
		<ul>
                   
                    
                    
                    <?php 
                            foreach($juassi_post_array as $juassi_post) { ?>
                    
                        
                                <li>
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
                                <div class="bwWrapper"><a href="<?php echo juassi_post_permalink()?>"><img <?php echo $imagen ?> width="60" height="55" alt="" /></a></div>
                                <?php } ?>
				<div class="desc">
                                    <p><strong><a href="<?php echo juassi_post_permalink()?>" ><?php echo $juassi_post['post_title']; ?></a></strong></p>
					<?php
                                        $resumen=  strip_tags($juassi_post['post_body']);
                                        if(strlen($resumen)>=50 )
                                            $resumen = substr($resumen,1,50);
                                        // uso de preg_mach_all con la expresion regular
                                        echo '<p>'.$resumen.'...</p>';
                                        //echo juassi_post_body();
                                        ?>
                                        
                                        
					<p><span><?php echo changeDate(date('D, d M Y', strtotime($juassi_post['post_date']))); ?>   <a href="<?php echo juassi_get_config('address'); ?>/contact/"><?php echo $juassi_post['display_name']; ?></a></span></p>
				</div>
                                </li>
                          <?php  }  
?>
			
		</ul>
	</div>
	<!-- /most popular -->
        
        <!-- categorias ----->
        <div class="most_popular">
		<h4>Categor&iacute;as</h4>
                <ul>
                    <?php echo juassi_post_all_cat(); ?>
                </ul>
        </div>
        <!-- /categorias ----->
        
        <!-- archivo -->
	<div class="most_popular">
		<h4>Archivo</h4>
			<ul>
                                <li><a href="#">January 2012 (12)</a></li>
                                <li><a href="#">February 2012 (12)</a></li>
                                <li><a href="#">March 2012 (12)</a></li>
                                <li><a href="#">April 2012 (12)</a></li>
                                <li><a href="#">May 2012 (12)</a></li>
                                <li><a href="#">June 2012 (12)</a></li>
                                <li><a href="#">July 2012 (12)</a></li>
                        </ul>
	</div>
        <!-- /archivo -->
        
        <!-- ultimos comentarios ----->
        <div class="most_popular">
		<h4>&Uacute;ltimos Comentarios</h4>
                <?php 
                    $juassi_content_identifier['order'] = 1;

                    $juassi_comments = new juassi_comments();
                    $juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);
                    global $juassi_db, $juassi_tb;
                    $juassi_comment_array = dbAll("SELECT * FROM $juassi_tb->comments ORDER BY comment_id DESC LIMIT 6")
                ?>
                <ul>
                     <?php foreach ($juassi_comment_array as $juassi_comment) { ?>
                    <li><a href="#tab-3"><?php echo '<strong>'.$juassi_comment['comment_display_name'].'</strong> coment&oacute;:'. juassi_comment_body().' el '.  changeDate(date('D, d M Y', strtotime(juassi_comment_date()))); ?></a></li>
                     <?php } ?>
                 </ul>
        </div>
        <!-- /ultimos comentarios ----->

	
			
   <!-- latest tweets -->
	<div class="latest_tweets">
		<h4>&Uacute;ltimos tweets</h4>
        <ul>
            <li><a href="#">@crucio</a> what an incredible site!<br /><a href="#">less than a minute ago</a></li>
            <li><a href="#">@themesector</a> love this theme, tons of options, lots of goodies and crazy good support.  I cant ask for anything better!<br /><a href="#">about 3 hours ago</a></li>
            <li><a href="#">@themeforest</a> where do you get support for account issues?  <a href="#">http://t.co/sr324nLrQw</a><br /><a href="#">less than a minute ago</a></li>
        </ul>
	</div>
	<!-- /latest tweets -->

   <!-- our clients -->
	<div class="our_clients">
		<h4>Nuestros lectores</h4>
			<ul class="clients_slider">
				<li>
					<blockquote>
						<p>"Nam libero tempore, cum soluta nobis est eligendi optio cumque nihl impedit quois minus id quod maxime placeat facere rendus sit sadipsamets."</p>
						<p>Jane Doe, CEO of Imperio</p>
					</blockquote>
				</li>	
				<li>
					<blockquote>
						<p>"Cum soluta nobis est eligendi optio cumque nihl impedit quois minus id quod maxime placeait sadipsamets."</p>
						<p>Jane Doe, CEO of Imperio</p>
					</blockquote>
				</li>	
				<li>
					<blockquote>
						<p>"Libero tempore, cuendi optio cumque nihl impedit quois minus id quod maxime placeat facere rendus sit sadipsamets."</p>
						<p>Jane Doe, CEO of Imperio</p>
					</blockquote>
				</li>	
				<li>
					<blockquote>
						<p>"Nam libero tempore, cum soluta nobis es nihl impedit quois minus id quod maxime placeat facere rendus sit sadipsamets."</p>
						<p>Jane Doe, CEO of Imperio</p>
					</blockquote>
				</li>	
				<li>
					<blockquote>
						<p>"Am libero tempore, cum soluta nobis est eligendi optio cumque ipsamets."</p>
						<p>Jane Doe, CEO of Imperio</p>
					</blockquote>
				</li>	
			</ul>   
		</div>
		<!-- /our clients -->

   		<!-- flyout_area sidebar -->
		<div class="flyout_area">
			<dl id="faq">
				<dt><h4>Flyout Content Area 1</h4></dt>
                    <dd>
                        <div>
                            <p>Fugiat dapibus, tellus ac cursus commodo, mauris sit condime ntum nibh, ut fermentum massa justo vitaes amet risus amets un.  osi sectetut amet fermentum aecenas faucib. doplores sadips uns.</p>
                        </div> 
                    </dd>
				<dt><h4>Flyout Content Area 2</h4></dt>
					<dd>
						<div>
							<p>Fugiat dapibus, tellus ac cursus commodo, mauris sit condime ntum nibh, ut fermentum massa justo vitaes amet risus amets un.  osi sectetut amet fermentum aecenas faucib. doplores sadips uns.</p>
						</div> 
					</dd>
				<dt><h4>Flyout Content Area 3</h4></dt>
					<dd>
						<div>
							<p>Fugiat dapibus, tellus ac cursus commodo, mauris sit condime ntum nibh, ut fermentum massa justo vitaes amet risus amets un.  osi sectetut amet fermentum aecenas faucib. doplores sadips uns.</p>
						</div> 
					</dd>
			</dl>
		</div>
		<!-- /flyout_area sidebar -->

   		<!-- recent work -->
		<div class="recent_work">
			<h4>&Uacute;ltimas Recetas </h4>
                        <ul class="recent_slider">
                            
                                    <li>
                                        <?php
                                foreach ($juassi_post_array as $juassi_post) { 
                                   
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
                                        <div class="bwWrapper">
                                            <a href="#"><img <?php echo $imagen; ?>  height="59" alt="" /></a>
                                        </div>
                                        <?php }} ?>
                                    </li>
                            
                        </ul>
		</div>
		<!-- /recent work -->

  <!-- /sidebar -->
</div>

</div>
</div>