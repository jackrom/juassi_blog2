<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include('header.php'); ?>
		<div class="container">
			<div class="row">
				<?php
					include 'sidebar.php';
					echo '<!-- Blog Post -->
							<div class="col-md-8 pull-right no-padding">';
					if (!empty($juassi_error)) {
						echo $juassi_error;
					}else {
						foreach ($juassi_post_array as $juassi_post) { ?>
							<article class="post col-md-12">
								<div class="post-thumb">
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
									
									
										<?php 
											if(!juassi_post_comments()){
												echo "<a href='".juassi_post_permalink()."'><img $imagen class='img-responsive' width='700' alt='".juassi_post_title()."' /></a>";
											}
											
											$imagen = str_replace('src=', '', $imagen);
											$imagen = str_replace('"', '', $imagen);
											
										?>
										<div class="shadow-left-big"></div>
										<!-- end post image -->
									<?php
										}
					                ?>
									<!-- end post image -->
								</div>
				
								<div class="post-info">
									<h4><a href="<?php echo juassi_post_permalink() ;?>"><?php echo juassi_post_title(); ?></a></h4>
									<p>
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
					             	</p>
								</div>
								<div class="post-meta">
									<div class="post-format-image"><i class="fa fa-comments"></i></div>
									<div class="meta-right">
									<div class="meta-info">
										<span>Posteado por: <a href="<?php echo juassi_get_config('address'); ?>/contact/"><?php echo juassi_post_author(); ?></a></span> <em>/</em> 
										<span><?php echo juassi_post_cat(); ?></span> <em>/</em>
										<span>
											<?php if (juassi_post_show_comment_count()) { ?>
												<a href="<?php echo juassi_post_permalink(); ?>#comments"><?php echo juassi_post_comment_count(); ?> Comentarios</a>
											<?php } ?>
									 	</span>
									</div>
									<div class="post-more">
										<a href="blog_single.html">Leer m&aacute;s &rarr;</a>
									</div>
									</div>
								</div>
				
							</article>
								
						<?php 
						}
					}
					?>		
							
							
							
							<?php if (juassi_post_comments()) {
								juassi_post_comments_setup();
							?>
								<h4 class="section-title"><span>Comments (<?php echo juassi_post_comment_count(); ?>)</span></h4>
							<?php	
								foreach ($juassi_comment_array as $juassi_comment) { ?>
										<a id="comments-<?php echo juassi_comment_id(); ?>"></a>
										
										<div class="comment">
										<?php if(juassi_comment_user()) { ?>
											<!-- Comments -->
								            
								            <div class="comments-wrap">
								            
									            
												<cite style="background-color: #0099CC;">
												On <?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?>, <?php echo juassi_comment_name_url(); ?> (of <strong><?php echo juassi_htmlentities(juassi_get_config('domain')); ?></strong>) wrote
												</cite>
												<div style="background-color: #FFE1C4;" class="commentsbody">
													<?php echo juassi_comment_body(); ?>
												</div>
												<div style="background-color:#FFCC99" class="commentsbottom">
												<?php echo juassi_comment_number(); ?>: <?php echo juassi_comment_permalink(); ?><?php if (juassi_user_can('edit_comments')) echo ': <a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>'; ?>
												</div>
												<br />
												
												
											<?php } elseif (juassi_comment_trackback()) { ?>
												<cite>
												On <?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?>, <?php echo juassi_comment_name_url(); ?> sent this trackback
												</cite>
												<div class="commentsbody">
													<strong><?php echo juassi_comment_trackback_title(); ?></strong>
													<?php echo juassi_comment_body(); ?>
												</div>
												<div class="commentsbottom">
												<?php echo juassi_comment_number(); ?>: <?php echo juassi_comment_permalink(); ?><?php if (juassi_user_can('edit_comments')) echo ': <a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Editar</a>'; ?>
												</div>
												<br />
											<?php } else { ?>
											
											
							                    <div class="comment-head">
							                        <img src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/demo/author.jpg" alt=""/>
							                        <div class="comment-meta">
							                            <h4 class="comment-author">
							                            		<?php echo juassi_comment_name_url(); ?>
							                            </h4>
							                            <h5><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?></h5>
							                        </div>
							                    </div>
							                    <div class="comment-body">
							                        <p><?php echo juassi_comment_body(); ?></p>
							                    </div>
							                    <?php echo juassi_comment_number(); ?>: <?php echo juassi_comment_permalink(); ?><?php if (juassi_user_can('edit_comments')) echo ': <a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Editar</a>'; ?>
							                
											<?php }	?>
										</div>
								<?php }
							} ?>
							<?php if (juassi_post_comment_form()) {
								include('comment_form.php');
							} ?>
						
					
		</div>
	</div>
</div>
</div>
<?php include('footer.php'); ?>