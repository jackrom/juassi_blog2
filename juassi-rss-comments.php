<?php
	$juassi_content_type = 'rss_comments';
	include('includes/juassi_header.php');
	if (juassi_is_404()) exit;
	header('Content-type: text/xml; charset=UTF-8', true);
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title><?php echo juassi_get_title(); ?></title>
		<link><?php echo juassi_get_config('address'); ?></link>
		<description><?php echo juassi_get_config('description'); ?></description>
		<copyright>Copyright <?php echo juassi_get_config('installed'); ?></copyright>
		<generator><?php echo juassi_get_config('address'); ?></generator>
		<?php
		if (juassi_get_config('rss')) {
			foreach ($juassi_comment_array as $juassi_comment) {
			$juassi_post = $juassi_comment;
			?>
				<item>
					<title><?php echo 'Comment by '. juassi_comment_display_name() . ' on ' . juassi_post_title(); ?></title>
					<link><?php echo juassi_post_permalink(). '#comments-' . juassi_comment_id(); ?></link>
					<comments><?php echo juassi_post_permalink(); ?></comments>
					<pubDate><?php echo date('D, d M Y H:i:s', strtotime(juassi_comment_date())) . ' ' . juassi_get_config('time_zone') . '00'; ?></pubDate>
					<dc:creator><?php echo juassi_comment_display_name(); ?></dc:creator>
					<description><![CDATA[<?php echo juassi_comment_body(); ?>]]></description>
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