<?php
	$juassi_content_type = 'rss';
	include('includes/juassi_header.php');
	if (juassi_is_404()) exit;
	header('Content-type: text/xml; charset=UTF-8', true);
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
>
	<channel>
		<title><?php echo juassi_get_title(); ?></title>
		<link><?php echo juassi_get_config('address'); ?></link>
		<description><?php echo juassi_get_config('description'); ?></description>
		<copyright>Copyright <?php echo juassi_get_config('installed'); ?></copyright>
		<generator><?php echo juassi_get_config('address'); ?></generator>
		<?php //this will need to be updated so that it takes into account edits ?>
		<lastBuildDate><?php echo date('D, d M Y H:i:s', strtotime(juassi_posts_date())) . ' ' . juassi_get_config('time_zone') . '00'; ?></lastBuildDate>
		<?php
		if (juassi_get_config('rss')) {
			foreach ($juassi_post_array as $juassi_post) {
			?>
				<item>
					<title><?php echo juassi_post_title(); ?></title>
					<link><?php echo juassi_post_permalink() ;?></link>
					<comments><?php echo juassi_post_permalink() . '#comments' ;?></comments>
					<pubDate><?php echo date('D, d M Y H:i:s', strtotime(juassi_post_date())) . ' ' . juassi_get_config('time_zone') . '00'; ?></pubDate>
					<dc:creator><?php echo juassi_post_author(); ?></dc:creator>
					<description><![CDATA[<?php echo juassi_post_body(); ?>]]></description>
				</item>
			<?php
			}
		}
		else {
			?>
			<item>
				<title>RSS Feed Disabled</title>
			</item>
			<?php
		}
		?>
	</channel>
</rss>