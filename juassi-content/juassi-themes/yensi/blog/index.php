<?php if (!defined('JUASSI_ROOT')) exit; ?>
<?php include('header.php'); 
include_once 'includes/admin.functions.php';
global $juassi_content_identifier;
?>



		
			<?php
			if (!empty($juassi_error)) {
					echo $juassi_error;
			}
			else {
                            //verificamos que no hemos llamado a una pagina o post en particular, si es asi mostramos la información requerida
                           foreach ($juassi_post_array as $juassi_post) { ?>
                                    <div class="post">
                                        <div class="img_wrap bwWrapper">
                                            <div class="date"><?php echo changeDate(date('D, d M Y g:i A', strtotime(juassi_post_date()))); ?></div>
                                                <!--tomamos la imagen incluida en el cuerpo del articulo y la mostramos-->
                                                <?php
                                                //comienzo de la etiqueta a buscar
                                                $tag1='src';
                                                //final de la etiqueta a buscar
                                                $tag2='style';
                                                //posicion donde comenzar a buscar
                                                $inicioBusqueda=strpos(juassi_post_body(),$tag1);
                                                //posicion hasta donde buscar
                                                $finalBusqueda=strpos(juassi_post_body(),$tag2)+5;
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
                                                $imagen_p = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                                                $imagenF = ($tipo == 'jpg')?imagecreatefromjpeg($imagen):imagecreatefrompng($imagen);
                                                imagecopyresampled($imagen_p, $imagenF, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                                                //$imagen = strpos(strrchr('.', $nombreArchivo),'.gif');
                                                // guardar imagen
                                                imagejpeg($imagen_p,$_SERVER['DOCUMENT_ROOT'].'/juassi/juassi-content/juassi-themes/yensi/blog/images/blog/'.juassi_post_title().'.jpg', 100);
                                                

                                                ?>
                                                
                                                <a href="<?php echo juassi_post_permalink();?>"><img <?php echo $imagen;?> width="640px" height="265px" alt="" /></a>
                                        </div>
                                        <div class="desc">
                                            <h4><a href="<?php echo juassi_post_permalink();?>" ><?php echo juassi_post_title(); ?></a><span style="text-decoration:none; font-size:12px; bottom: 2px; left:5px; position:relative;"><?php if (juassi_user_can('edit_posts')) echo '<sub><a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-post.php?post_id=' . juassi_post_id() . '" style="color:#F00;"> editar </a></sub>'; ?></span></h4>
                                            <?php 
                                                    //si estamos mostrando el articulo, mostramos todo su contenido, sino solo un resumen
                                                    if(juassi_post_comments()){
                                                        echo strip_tags(juassi_post_body());
                                                    }else{
                                                        $resumen=  strip_tags(juassi_post_body());
                                                        if(strlen($resumen)>=520 )
                                                            $resumen = substr($resumen,1,520);
                                                        // uso de preg_mach_all con la expresion regular
                                                        echo $resumen.'...';
                                                        //echo juassi_post_body();
                                                    }
                                            ?>
                                            <div class="metadata">
                                                <strong class="dots"></strong>
                                                By <a href="<?php echo juassi_get_config('address'); ?>/contact/"><?php echo juassi_post_author(); ?></a>  |  <?php echo juassi_post_cat(); ?>  |  
                                                <?php if (juassi_post_show_comment_count()) { ?>
                                                <a href="<?php echo juassi_post_permalink(); ?>#comments"><?php echo juassi_post_comment_count(); ?> Comments</a>
                                                <?php } ?>
                                                <?php if(!juassi_post_comments()){ ?>
                                                <a href="<?php echo juassi_post_permalink() ;?>" class="read_more btn_col">Read More</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>   
				    <?php if (juassi_post_comments()) { ?>
                                    <!-- /share story -->
                                    <div class="share_story">
					<h4>Share This Story!</h4>
                                        <ul>
                                            <li><a class="facebook" href="#">facebook</a></li>
                                            <li><a class="tweeter" href="#">tweeter</a></li>
                                            <li><a class="in" href="#">in</a></li>
                                            <li><a class="baby" href="#">baby</a></li>
                                            <li><a class="rss" href="juassi-rss-comments.php">rss</a></li>
                                            <li><a class="google" href="#">google</a></li>
                                            <li><a class="www" href="#">www</a></li>
                                        </ul>
                                    </div>
                                    <!-- /share story -->
                                    <?php juassi_post_comments_setup(); ?>
                                    <!-- /Comments -->
                                    <div class="comments">
                                        <h4>Comments</h4>
        				<div class="add_comment c_after"><a class="btn_m" href="#">Add Comment</a></div>
                                        <ul>
                                           <?php
                                            foreach ($juassi_comment_array as $juassi_comment) { ?>
                                                <?php if(juassi_comment_user()) { ?>
                                                    <li>
                                                        <div class="info"><img src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/avatar.png" alt="" /><strong><?php echo juassi_comment_name_url(); ?> (of <strong><?php echo juassi_htmlentities(juassi_get_config('domain')); ?></strong>) </strong>  |  <i>On <?php echo changeDate(date('D, d M Y', strtotime(juassi_comment_date()))); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?></i>  | <a href="#">Reply</a> | <?php if (juassi_user_can('edit_comments')) echo '<a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '" >Edit</a>'; ?></div>
                                                        <p><?php echo juassi_comment_body(); ?></p>
                                                    </li>
                                                    <?php } elseif (juassi_comment_trackback()) { ?>	
                                                    <li>
                                                        <div class="info"><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?> | <?php echo juassi_comment_name_url(); ?> sent this trackback | <?php if (juassi_user_can('edit_comments')) echo ': <a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>'; ?></div>
                                                        <h5><?php echo juassi_comment_trackback_title(); ?></h5>
                                                        <p><?php echo juassi_comment_body(); ?></p>
                                                    </li>
                                                    <?php } else { ?>
                                                    <li>
                                                        <div class="info"><?php echo date('D, d M Y', strtotime(juassi_comment_date())); ?> at <?php echo date('g:i A', strtotime(juassi_comment_date())); ?> | <?php echo juassi_comment_name_url(); ?> sent this trackback | <?php if (juassi_user_can('edit_comments')) echo '<a href="' . juassi_get_config('address') . JUASSI_ADMIN . '/edit-comment.php?comment_id=' . juassi_comment_id() . '">Edit</a>' ?></div>
                                                        <?php echo juassi_comment_body(); ?>
                                                    </li>
                                                    <?php }	?>
                                            <?php }
                                        echo '</ul></div>';
                                     } ?>
                                     <?php if (juassi_post_comment_form()) {
					include('comment_form.php');
                                    } 
                            ?> 
                            <?php }
                            
                            
                            
                           
                       } ?> 


	<!-- pager_nav -->
 <?php
if(!juassi_post_comments()){
echo '<div class="pager_nav">';
   
    
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
                echo '<span class="seleccionado">';
                echo $j;
                echo '</span>';
            }elseif($j==1){
                echo '<span class="seleccionado">';
                echo $j;
                echo '</span>';
            }else{
                echo '<a href="'.juassi_get_config('address').$permalink.'page/' . $j.'" class="paginador">';
                echo $j;
                echo '</a>';
            }
        }
		if(juassi_total_post_count() > 10)
        	echo '<a href="'.juassi_posts_next_page().'" class="paginador">pagina siguiente &raquo; </a>';
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
                    echo '<span class="seleccionado">';
                    echo $j;
                    echo '</span>';
                }else{
                    echo '<a href="'.juassi_get_config('address').$permalink.'page/' . $j.'" class="paginador">';
                    echo $j;
                    echo '</a>';
                }
            }  
            echo '<a href="'.juassi_posts_next_page().'" class="paginador">pagina siguiente &raquo; </a>';
        }elseif((int)$juassi_content_identifier['page'] > 1 && (int)$juassi_content_identifier['page'] < $totalPaginas){
            $articulosdePagina = (int)$juassi_content_identifier['page'] * $numPagesPost;
            echo $articulosdePagina.' de '.$totalPost.' | ';
            echo '<a href="'.juassi_posts_previous_page().'" class="paginador">&laquo; pagina anterior</a>';
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
                    echo '<span class="seleccionado">';
                    echo $j;
                    echo '</span>';
                }else{
                    echo '<a href="'.juassi_get_config('address').$permalink.'page/' . $j.'" class="paginador">';
                    echo $j;
                    echo '</a>';
                }
            } 
            echo '<a href="'.juassi_posts_next_page().'" class="paginador">pagina siguiente &raquo; </a>';
        }else{
            $articulosdePagina = (int)$juassi_content_identifier['page'] * $numPagesPost;
            echo $totalPost.' de '.$totalPost.' | ';
            echo '<a href="'.juassi_posts_previous_page().'" class="paginador">&laquo; pagina anterior</a>';
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
                    echo '<span class="seleccionado">';
                    echo $j;
                    echo '</span>';
                }else{
                    echo '<a href="'.juassi_get_config('address').$permalink.'page/' . $j.'" class="paginador">';
                    echo $j;
                    echo '</a>';
                }
            } 
            echo ' <span class="seleccionado">pagina siguiente &raquo; </span>';
        }
	
    }
 echo '</div>';
}
    ?>
    


                                    




<?php
include('sidebar.php');
include('footer.php');
?>