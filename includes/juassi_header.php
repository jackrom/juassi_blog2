<?php
	//incluimos las acciones (funciones) comunes del sitio
	include('functions/juassi_common.php');
	//verificamos si nos hemos registrado como usuario
	if (!isset($_SESSION['juassi_page']) || $_SESSION['juassi_page'] != $_SERVER['REQUEST_URI']) {
		$_SESSION['juassi_page'] = $_SERVER['REQUEST_URI'];
	}

	$juassi_content_identifier = juassi_get_content_identifier();

	$juassi_error = '';
	$juassi_input_error = '';

	if (isset($_SESSION['juassi_input_error']) && !empty($_SESSION['juassi_input_error'])) {
		$juassi_input_error = $_SESSION['juassi_input_error'];
		$_SESSION['juassi_input_error'] = '';
	}
	//default title
	juassi_set_title(juassi_get_config('description'));
	/*
	This section is where we start the process of getting data based on the content type
	*/
	juassi_set_404();
	switch($juassi_content_identifier['type']) {
		case 'blog':
			juassi_unset_404();
			$juassi_post_categories = new juassi_categories($juassi_tb->categories);
			$juassi_posts = new juassi_posts();
			$juassi_content_identifier['limit'] = (int) juassi_get_config('limit_posts');
			$juassi_content_identifier['comment_count'] = 1;
			$juassi_content_identifier['post_type'] = 'published';
			//paging support.
			$juassi_content_identifier['offset'] = $juassi_content_identifier['limit'] * $juassi_content_identifier['page'] - $juassi_content_identifier['limit'];
			if ($juassi_content_identifier['offset'] < 0) {
				$juassi_content_identifier['offset'] = 0;
			}
			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
			$juassi_content_identifier['theme_type'] = 'blog';

			//if no posts found trigger not found message (only used if no posts were found in a category)
			if (empty($juassi_post_array)) $juassi_error = '<h2>Esta categor&iacute;a actualmente esta vac&iacute;a.</h2>';

			if (isset($juassi_post_array[0])) {
				$juassi_post = $juassi_post_array[0];
				if ($juassi_posts->matches_permalink()) {
					juassi_set_title(juassi_run_content_filter('post_title', $juassi_post['post_title']));
				}
				unset($juassi_post);
			}
		break;

		case 'cms':
			juassi_unset_404();
			$juassi_post_categories = new juassi_categories($juassi_tb->categories);
			$juassi_posts = new juassi_posts();
			$juassi_content_identifier['limit'] = 1;
			unset($juassi_content_identifier['comment_count']);
			$juassi_content_identifier['post_type'] = 'published_content';
			//paging support.
			$juassi_content_identifier['offset'] = $juassi_content_identifier['limit'] * $juassi_content_identifier['page'] - $juassi_content_identifier['limit'];
			if ($juassi_content_identifier['offset'] < 0) {
				$juassi_content_identifier['offset'] = 0;
			}
			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
			$juassi_content_identifier['theme_type'] = 'cms';

			if (isset($juassi_post_array[0])) {
				$juassi_post = $juassi_post_array[0];
				if ($juassi_posts->matches_permalink_content()) {
					juassi_set_title(juassi_run_content_filter('post_title', $juassi_post['post_title']));
				}
				unset($juassi_post);
			}
		break;

		case 'rss':
			juassi_unset_404();
			$juassi_content_identifier['limit'] = (int) juassi_get_config('limit_posts');
			$juassi_content_identifier['post_type'] = 'published';
			$juassi_post_categories = new juassi_categories($juassi_tb->categories);
			$juassi_posts = new juassi_posts();
			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
			$juassi_content_identifier['theme_type'] = '';
			juassi_set_title('');

		break;

		case 'rss_comments':
			juassi_unset_404();
			$juassi_post_categories = new juassi_categories($juassi_tb->categories);
			$juassi_posts = new juassi_posts();
			$juassi_post_array = $juassi_posts->get_posts($juassi_content_identifier);
			if (count($juassi_post_array) == 1) {
				$juassi_post = $juassi_post_array[0];
				$juassi_content_identifier['get_posts'] = true;
				$juassi_content_identifier['order'] = 1;
				juassi_post_comments_setup();
				//unset($juassi_post);
			}
			else {
				juassi_feed_comments_setup();
			}

			$juassi_content_identifier['theme_type'] = '';
			juassi_set_title('');

		break;


		default:

			//pass all other content types to plugins that might handle them
			juassi_run_section_ref('other_content_' . $juassi_content_identifier['type'], $juassi_content_identifier);
	}

	/*
	we can do real 404s now :)
	*/
	if (juassi_is_404()) {
		juassi_run_section('404');
	}

	juassi_send_headers();

	juassi_run_section('header_loaded');
	/*
		Theme Support
	*/
	if (juassi_get_config('themes') && !empty($juassi_content_identifier['theme_type'])) {
		$juassi_theme = juassi_check_current_theme();
		$juassi_theme_type = juassi_check_theme_type($juassi_theme, $juassi_content_identifier['theme_type']);
		define('JUASSI_CURRENT_THEME', $juassi_theme);
		define('JUASSI_CURRENT_THEME_TYPE', $juassi_theme_type);

		//Themes can over the Juassi default 'theme_handle' (without the need to use a plugin) if they need to load themes in a different manner
		include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/' . $juassi_theme . '/' . $juassi_theme . '.theme.php');

		juassi_run_section('theme_type_' . JUASSI_CURRENT_THEME_TYPE);
	}
?>

