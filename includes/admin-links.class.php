<?php

class juassi_admin_links {

	var $links_store;
	var $link_level = -1;

	var $home = 0;
	var $post = 1;
	var $edit = 2;
	var $comment_moderation = 3;
	var $categories = 4;
	var $personal = 5;
	var $file_upload = 6;
	var $presentation = 7;
	var $settings = 8;
	var $user_admin = 9;
	var $event_viewer = 10;
	var $plugins = 11;
	var $connector = 12;
    var $mail = 13;
    var $eventer = 14;
    var $analytics = 15;

	function juassi_admin_links() {

		$this->links_store = array(
			array(
				'Inicio', 'index.php',
				array(
					array()
				)
			),
			array(
				'Articulos', 'post.php',
				array(
					array(
						'Agregar Nuevo Artículo', 'post.php'
					),
					array(
						'Agregar Nueva Página', 'add-content.php'
					)
				)
			),
			array(
				'Editar', 'edit.php',
				array(
					array(
						'Editar Artículo', 'edit.php'
					),
					array(
						'Editar Contennido', 'edit-content.php'
					)
				)
			),
			array(
				'Comentarios', 'comments.php',
				array(
					array()
				)
			),
			array(
				'Categorias', 'categories.php',
				array(
					array()
				)
			),
			array(
				'Personal', 'personal-settings.php',
				array(
					array(
						'Configuración Personal', 'personal-settings.php'
					),
					array(
						'Tus Comentarios', 'your-comments.php'
					)
				)
			),
			array(
				'Media', 'file-upload.php',
				array(
					array()
				)
			),
			array(
				'Presentacion', 'link-settings.php',
				array(
					array(
						'Configuración de link', 'link-settings.php'
					),
					array(
						'Configuración de plantillas', 'theme-settings.php'
					)
				)
			),
			array(
				'Configuracion', 'general-settings.php',
				array(
					array(
						'Configuración General', 'general-settings.php'
					),
					array(
						'Configuración de Spam', 'spam-settings.php'
					),
					array(
						'Configuración Permalink', 'permalink-settings.php'
					),
					array(
						'Mantenimiento del Sitio', 'maintenance.php'
					),
				)
			),
			array(
				'Usuarios', 'user-admin.php',
				array(
					array(
						'Administración de usuarios', 'user-admin.php'
					)
				)
			),
			array(
				'Eventos', 'event-viewer.php',
				array(
					array(
					)
				)
			),
			array(
				'Plugins', 'plugins.php',
				array(
					array(
						'Plugins', 'plugins.php'
					)
				)
			),
			array(
				'Conector', 'soap-server-settings.php',
				array(
					array(
						'Connector Server', 'soap-server-settings.php'
					),
					array(
						'Connector Client', 'soap-client-settings.php'
					),
					array(
						'tareas del Sitio', 'soap-tasks.php'
					),
				)
			),
            array(
				'Mail', 'mailSystem.php',
				array(
					array(
						
					),
				)
			),
                        array(
                                    'Calendario', 'events.php',
                                    array(
                                            array(
                                                    'Imagenes', 'images.php'
                                            ),
                                            array(
                                                    'Nuevo Evento', 'event-add.php'
                                            ),
                                            array(
                                                    'Opciones', 'options.php'
                                            ),
                                            array(
                                                    'Configuración', 'admin.php'
                                            ),
                                            array(
                                                    'Calendario', 'verCalendar.php'
                                            ),
                                    )
                            ),
                        array(
                                    'Analiticas', 'webAnalytics.php',
                                    array(
                                            array(
                                                'General', 'webAnalytics.php'
                                            ),
                                            array(
                                                'Configuración', 'show_config.php'
                                            ),
                                            array(
                                                'Globales', 'show_global.php'
                                            ),
                                            array(
                                                'Detalles', 'show_detailed.php'
                                            ),
                                            array(
                                                'Temporaless', 'show_time.php'
                                            ),
                                            array(
                                                'Vistas', 'show_views.php'
                                            )
                                    )
			),
		);
	}

	function prepare_links() {

		$current_file = juassi_current_file();

		for($i = 0; $i < sizeof($this->links_store); $i++) {
			$array = explode('?', $this->links_store[$i][1]);
			$file = array_shift($array);
			if ($current_file == $file) {
				$this->link_level = $i;
				break;
			}
			else {
				for($x = 0; $x < sizeof($this->links_store[$i][2]); $x++) {
					if (in_array($current_file, $this->links_store[$i][2][$x], true)) {
						$this->link_level = $i;
						break;
					}
				}
			}
		}
	}

	function add_link_block($links) {
		/*
		Example of how you'd add extra links to admin panel
		$links = array(
			array(
				'Plugin', 'add-blog.php',
				array(
					array(
					'Add Blog','add-blog.php'
					)
				)
			)
		);

		class->add_link_block($links);
		*/
		$this->links_store = array_merge_recursive($this->links_store, $links);
	}

	function add_lower_link($level, $name, $url) {
		/*
		get $level from this class. i.e to add a link to the credits page do
		class->add_lower_link($class->credits, 'Awesome Plugin Name', 'awesome-plugin.php', 8);
		*/
		end($this->links_store[$level][2]);
		$next_link_index = key($this->links_store[$level][2]);
		if (!empty($this->links_store[$level][2][$next_link_index])) $next_link_index++;
		$this->links_store[$level][2][$next_link_index] = array($name, $url);
	}

	function add_top_link($name, $url) {

		$links = array(
			array(
				$name, $url,
				array(
					array()
				)
			)
		);

		$this->links_store = array_merge_recursive($this->links_store, $links);
		end($this->links_store);
		return key($this->links_store);
	}

	function change_top_link($level, $name, $url) {
		$this->links_store[$level][0] = $name;
		$this->links_store[$level][1] = $url;
	}

	/*


	Change a top level link name
	$links[8][0] = 'Changed!';


	*/

	function display_top_links() {

		$permitted_files = juassi_get_permitted_files();

		for($i = 0; $i < sizeof($this->links_store); $i++) {
			$array = explode('?', $this->links_store[$i][1]);
			$file = array_shift($array);
			if (in_array($file, $permitted_files)) {
				?><li
					<?php if ($i == $this->link_level) echo ' class="active"'; ?>
						style="background-image: url(../juassi-resources/img/gCons/<?php echo $this->links_store[$i][0]; ?>.png);
						       background-repeat: no-repeat;
						       background-position: center 10px;">
						<a href="<?php echo $this->links_store[$i][1]; ?>">
							<?php
							if($this->links_store[$i][0] == 'Comment'){
								echo '<span class="label label-important">';
								echo juassi_total_mod_comment_count();
								echo '</span>';
							}
							if($this->links_store[$i][0] == 'Post'){
								echo '<span class="label label-success">';
								echo juassi_total_post_count();
								echo '</span>';
							}
							if($this->links_store[$i][0] == 'Events'){
								echo '<span class="label label-info">';
								echo '+'.juassi_total_event_count();
								echo '</span>';
							}
							if($this->links_store[$i][0] == 'Users'){
								echo '<span class="label label-info">';
								echo '+'.juassi_total_users_count();
								echo '</span>';
							}
                            if($this->links_store[$i][0] == 'Mail'){
								echo '<span class="label label-important">';
								echo '+'.juassi_total_mail_count();
								echo '</span>';
							}
                        	
							echo $this->links_store[$i][0]; ?>
						</a>
				</li><?php
			}
		}
	}

	function lower_links() {

		$permitted_files = juassi_get_permitted_files();

		if (!empty($this->links_store[$this->link_level][2][0]) && (in_array($this->links_store[$this->link_level][1], $permitted_files))) {
			return true;
		}
		else {
			return false;
		}

	}

	function display_lower_links() {
		$permitted_files = juassi_get_permitted_files();
		$juassi_current_file = juassi_current_file();

		for($i = 0; $i < sizeof($this->links_store[$this->link_level][2]); $i++) {
			$array = explode('?', $this->links_store[$this->link_level][2][$i][1]);
			$file = array_shift($array);
			if (in_array($file, $permitted_files)) {
				?>
				<li class="dropdown" <?php if ($this->links_store[$this->link_level][2][$i][1] == $juassi_current_file) echo ' class="active"'; ?> style="display: inline; float:left; position:relative; width:150px; text-align:center;">
				<a href="<?php echo $this->links_store[$this->link_level][2][$i][1] ?>"><?php echo $this->links_store[$this->link_level][2][$i][0] ?></a></li><?php

		}
	}
}

}
?>
