<?php

/*
	Juassi Search 1.1 - Diciembre 2012
	The search function was written by Cal Henderson with modifications by Michael Dale to turn this into a plugin for Bluetrait 2.
	
	Licence:
	"Creative Commons Attribution-ShareAlike 2.5 License"
	http://creativecommons.org/licenses/by-sa/2.5/
	
	The following two lines should be in your Juassi mod_rewrite rules:
	RewriteRule ^search([/]*)$ index.php?juassi_type=search
	RewriteRule ^search/([_0-9a-z-]+)$ index.php?juassi_type=search&s=$1
	
	Use search_html_form() within your template to display the search box
	
	Version 1.1: Minor changes to HTML
*/

//stops the plugin file from being accessed directly
if (!defined('JUASSI_ROOT')) exit;

juassi_add_task('search', 'other_content_search', 'search_add_type');
juassi_add_task('search', 'theme_type_search', 'search_theme_handle');

function search_theme_handle() {
	global $juassi_post_array, $juassi_db, $juassi_tb, $juassi_error, $juassi_post, $juassi_comment_array, $juassi_input_error, $juassi_comment;

	include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/header.php'); ?>
	<div class="news">
		<h2>Search Results</h2>
			<br />
			<?php
			if (!empty($juassi_error)) {
				echo $juassi_error;
			}
			else {
			?>
			<?php
				$juassi_post_array = search_results($_REQUEST['s']);
				if (!empty($juassi_post_array)) {
				?>
				<h4 style="margin-bottom:10px;font-size:16px;">Sorted by relevance (<?php echo count($juassi_post_array); ?> result(s) found):</h4>
				<div style="border-bottom:1px solid #999;"></div>
				<ul>
				<?php
					foreach ($juassi_post_array as $juassi_post) { ?>
					<li style="margin-top:20px;">
						<h4><a href="<?php echo juassi_post_permalink() ;?>">
							<?php echo juassi_post_title(); ?>
						</a></h4>
						<?php 
							$resumen=  strip_tags(juassi_post_body());
                            if(strlen($resumen)>=520 )
                            	$resumen = substr($resumen,1,220);
                            // uso de preg_mach_all con la expresion regular
                            echo $resumen.'...';
							echo '<p>date: '.date('D, d M Y g:i A', strtotime(juassi_post_date())).' </p> ';
				
					}
				}
				else {
					echo '<strong>No Results.</strong>';
				}
			} 
			?>
			</ul>
	</div>
	<?php 
	if(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/sidebar.php'){
		include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/sidebar.php');
	}
	include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/'. JUASSI_CURRENT_THEME .'/blog/footer.php');
}

function search_html_form() {
?>
	
	<!-- Search Widget -->
	<div class="search-widget widget widget__sidebar">
		<div class="widget-content">
			<form method="post" action="<?php echo juassi_get_config('address'); ?>/search/" class="search-form clearfix">
				<input type="text" name="s" id="search-t-i" placeholder="Buscar...">
				<button type="submit"><i class="icon-search"></i></button>
			</form>
		</div>
	</div>
	
<?php
}

function search_add_type($juassi_content_identifier) {
	global $juassi_post_categories, $juassi_error, $juassi_tb;
	juassi_unset_404();
	$juassi_content_identifier['theme_type'] = 'search';
	$juassi_post_categories = new juassi_categories($juassi_tb->categories);
	if (isset($_REQUEST['s'])) {
		$title = juassi_htmlentities($_REQUEST['s']);
		juassi_set_title('Search: ' . $title);
	}
	else {
		$juassi_error = '<strong>No Search Term.</strong>';
	}
}

/*
	The following code was written by Cal Henderson and is under the "Creative Commons Attribution-ShareAlike 2.5 License".
	For more details about this licence please visit: http://creativecommons.org/licenses/by-sa/2.5/
	The original publication of this code can be found here: http://iamcal.com/publish/articles/php/search
*/
function search_split_terms($terms){

	$terms = preg_replace("/\"(.*?)\"/e", "search_transform_term('\$1')", $terms);
	$terms = preg_split("/\s+|,/", $terms);

	$out = array();

	foreach($terms as $term){

		$term = preg_replace("/\{WHITESPACE-([0-9]+)\}/e", "chr(\$1)", $term);
		$term = preg_replace("/\{COMMA\}/", ",", $term);

		$out[] = $term;
	}

	return $out;
}

function search_transform_term($term){
	$term = preg_replace("/(\s)/e", "'{WHITESPACE-'.ord('\$1').'}'", $term);
	$term = preg_replace("/,/", "{COMMA}", $term);
	return $term;
}

function search_escape_rlike($string){
	return preg_replace("/([.\[\]*^\$])/", '\\\$1', $string);
}

function search_db_escape_terms($terms){
	$out = array();
	foreach($terms as $term){
		$out[] = '[[:<:]]'.AddSlashes(search_escape_rlike($term)).'[[:>:]]';
	}
	return $out;
}

function search_perform($terms, $func_select = '*', $search_type = 'posts'){
	global $juassi_db, $juassi_tb;

	$terms = search_split_terms($terms);
	$terms_db = search_db_escape_terms($terms);
	$terms_rx = search_rx_escape_terms($terms);
	
	if($search_type == 'comments') {
		$func_table = $juassi_tb->comments;
		$func_column = 'comment_body';
	}
	else {
		$func_table = $juassi_tb->posts;
		$func_column = 'post_body';
	}

	$parts = array();
	foreach($terms_db as $term_db){
		$parts[] = $func_column . " RLIKE '$term_db'";
	}
	$parts = implode(' AND ', $parts);

	$sql = 'SELECT ' . $func_select . ' FROM ' . $func_table . " WHERE $parts";

	$rows = array();
	
	foreach ($juassi_db->query($sql) as $row) {

		$row['score'] = 0;

		foreach($terms_rx as $term_rx){
			$row['score'] += preg_match_all("/$term_rx/i", $row[$func_column], $null);
		}

		$rows[] = $row;
	}

	uasort($rows, 'search_sort_results');

	return $rows;
}

function search_rx_escape_terms($terms){
	$out = array();
	foreach($terms as $term){
		$out[] = '\b'.preg_quote($term, '/').'\b';
	}
	return $out;
}

function search_sort_results($a, $b){

	$ax = $a['score'];
	$bx = $b['score'];

	if ($ax == $bx){ return 0; }
	return ($ax > $bx) ? -1 : 1;
}

function search_html_escape_terms($terms){
	$out = array();

	foreach($terms as $term){
		if (preg_match("/\s|,/", $term)){
			$temp[] = '"'.HtmlSpecialChars($term).'"';
		}else{
			$temp[] = HtmlSpecialChars($term);
		}
	}

	return $out;	
}

function search_pretty_terms($terms_html){

	if (count($terms_html) == 1){
		return array_pop($terms_html);
	}

	$last = array_pop($terms_html);

	return implode(', ', $terms_html)." and $last";
}

function search_results($search_term, $search_type = 'posts') {
	#
	# do the search here...
	#

	if ($search_type == 'comments') {
		$results = search_perform($search_term, $func_select = '*', $search_type = 'comments');
	}
	else {
		$results = search_perform($search_term);
	}
	
	return $results;
}

?>
