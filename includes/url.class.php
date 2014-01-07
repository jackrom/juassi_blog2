<?php
/*

*/
class url {
	private $url_empty 	= NULL;
	private $url		= NULL;

	function get_content_identifier() {
		$url_parts 				= $this->get_url_parts($this->url);
		$content_identifier 	= $this->match_url($url_parts);

		return $content_identifier;
	}

	function __construct() {
		$this->url				= $this->get_url();
		$url_parts 				= $this->get_url_parts($this->url);
		$content_identifier 	= $this->match_url($url_parts);
		//print_r($content_identifier);
		//print_r($url_parts);
	}
	function get_url() {
		if (isset($_SERVER['PATH_INFO'])) {
			$url = $_SERVER['PATH_INFO'];
		}
		if (isset($_SERVER['REQUEST_URI'])) {
			$url = $_SERVER['REQUEST_URI'];

			if (juassi_get_config('script_path') !== '') {
				$url = str_replace(juassi_get_config('script_path'), '', $url);
			}
		}

		$url = trim($url, '/');

		$indexpos = stripos($url, 'index.php');

		if ($indexpos === 0) {
			$url = substr($url, 9, strlen($url) - 9);
		}

		$url = trim($url, '/');

		if ($url != '') {
			$this->url_empty = false;
		}
		else {
			$this->url_empty = true;
		}

		return $url;
	}
	function get_url_parts($url) {
		if (!$this->url_empty) {
			$url_array = explode('/', $url);
			return $url_array;
		}
		return array();
	}

	function match_url($url_parts) {

		if ($this->url_empty) {
			$juassi_content_identifier['year'] = '';
			$juassi_content_identifier['month'] = '';
			$juassi_content_identifier['day'] = '';
			$juassi_content_identifier['x_title'] = '';
			//blog, cms, rss etc
			$juassi_content_identifier['type'] = 'blog';
			//send the user to a 404 unless the content type is picked up
			$juassi_content_identifier['theme_type'] = '404';
			$juassi_content_identifier['id'] = '';
			$juassi_content_identifier['page'] = '';
			$juassi_content_identifier['category'] = '';
			$juassi_content_identifier['empty'] = 1;

			juassi_run_section_ref('content_identifier_defaults', $juassi_content_identifier);
		}
		else {
			$url_parts[0] = preg_replace('([^0-9a-z_\/-])', '', $url_parts[0]);

			$default_type_lookup = array(
								'archive' 	=> 'blog',
								'page'		=> 'cms',
								'contact'	=> 'contact_form',
								'category'	=> 'blog',
								'admin'	=> 'admin'
							);
			if (array_key_exists($url_parts[0], $default_type_lookup)) {
				$juassi_content_identifier['type'] = $default_type_lookup[$url_parts[0]];
				$juassi_content_identifier['404'] = 0;
			}
			else {
				$juassi_content_identifier['404'] = 1;
			}
			//$juassi_content_identifier['theme_type'] = 'cf_theme_handle';

		}

		juassi_run_section_ref('content_identifier', $juassi_content_identifier);

		return $juassi_content_identifier;
	}
}
?>