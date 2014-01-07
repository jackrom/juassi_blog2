<!-- Sidebar -->
		<aside class="sidebar grid_3" id="sidebar">
			
			<?php 
			if (function_exists('search_html_form')) {
				search_html_form();
			}
			?>
					
			
			<!-- /Search Widget -->
			<!-- Categories Widget -->
			<div class="categories widget widget__sidebar">
				<h3 class="widget-title">Categor&iacute;as</h3>
				<div class="widget-content">
					<div class="list list-style__check">
						
						<ul>
							<?php echo juassi_post_all_cat(); ?>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Categories Widget -->
			<!-- Tags Widget -->
			<div class="tagcloud widget widget__sidebar">
				<h3 class="widget-title">Tags</h3>
				<div class="widget-content">
					<?php echo juassi_post_all_clouds_cat(); ?>
				</div>
			</div>
			<!-- /Tags Widget -->
			<!-- Text Widget -->
			<div class="text-widget widget widget__sidebar">
				<h3 class="widget-title">Recomendaciones</h3>
				<div class="widget-content">
					Sed in dignissim sem. Etiam sceler elit eu magna tempus nec bibendum purus accumsan. Aenean libero libero, rutrum ac vehicula sed, pretium 
				</div>
			</div>
			<!-- /Text Widget -->
			<!-- Recent Posts Widget -->
			<div class="latest-posts widget widget__sidebar">
				<h3 class="widget-title">Los &uacute;ltimos art&iacute;culos</h3>
				<div class="widget-content">
				<?php 
				$query = 'SELECT * FROM jb2_posts ORDER BY post_date DESC LIMIT 3';
				$latestPost = dbAll($query);
				echo '<ul class="thumbs-list thumbs-list__clean">';
				foreach($latestPost as $post){
					//comienzo de la etiqueta a buscar
					$tag1='src';
					//final de la etiqueta a buscar
					$tag2='jpg';
					//posicion donde comenzar a buscar
					$inicioBusqueda=stripos($post['post_body'],$tag1);
					//posicion hasta donde buscar
                   	if(stripos($post['post_body'],$tag2))
                   		$finalBusqueda = stripos($post['post_body'],$tag2)+4;
                   	else 
                   		$finalBusqueda = stripos($post['post_body'],'png')+4; 
					//los numeros de caracteres de la cadena
					$numeroCaracteres=strlen($post['post_body']);
					//los numeros de caracteres a extraer de la cadena
					$numCaracterExtraer = $finalBusqueda-$inicioBusqueda;
					//extraer la imagen
					$imagen =substr($post['post_body'],$inicioBusqueda,$numCaracterExtraer);
					
					
					echo '<li class="list-item clearfix">';
					if(strpos($imagen, 'jpg') || strpos($imagen, 'png')){
						echo '<figure class="thumb-simple thumb__hovered">
									<a href="'.juassi_post_permalink().'"><img '.$imagen.' width="70" alt=""></a>
							  </figure>';
					}
					echo '<h5 class="item-heading"><a href="'.juassi_permalink($post).'">';
					echo $post['post_title'];
					echo '</a></h5>
							<span class="date">';
					echo changeDate(date('D, d M Y', strtotime($post['post_date'])));
					echo '</span>
							<div class="item-excerpt" style="text-align:justify;">';
					$minitext = $post['post_body'];
					if(strlen($minitext)>=200 )
						$minitext = substr($minitext,0,200);
					// uso de preg_mach_all con la expresion regular
					echo strip_tags($minitext).'...';
					echo '</div>';
					echo '</li>';
					
				}
				echo '<ul>';
				?>
					<a href="<?php echo juassi_get_config('address'); ?>" class="button"><span class="button-inner">Ver Todos</span></a>
				</div>
			</div>
			<!-- /Recent Posts Widget -->
		</aside>
		<!-- Sidebar / End -->
	</div>
</div>
<!-- END CONTENT WRAPPER -->