<?php
/*
Created by Yougapi Technology - http://yougapi.com - March 2010
Last update: 30 May 2011

require 'php-sdk/facebook.php';
	$facebook = new Facebook(array(
		'appId'  => '537771372978280',
		'secret' => 'f856f6b9f77ef08e535df168bfdfc8d1'
	));
	*/
class Facebook_plugins_class

{
	var $app_id = '654726914570405';
	var $lang = 'es_ES'; //en_US, fr_FR, es_LA, ko_KR, ja_JP, de_DE
	var $fb_sdk = '1';
	
	function Facebook_plugins_class($criteria=array()) {
		static $witness;
		if($criteria['app_id']!='') $this->app_id = $criteria['app_id'];
		if($criteria['lang']!='') $this->lang = $criteria['lang'];
		if($criteria['fb_sdk']!='') $this->fb_sdk = $criteria['fb_sdk'];
		
		if($witness=='') {
			if($this->fb_sdk=='1') echo '<div id="fb-root"></div><script src="http://connect.facebook.net/'.$this->lang.'/all.js#appId='.$this->app_id.'&amp;xfbml=1"></script>';
			$witness=1;
		}
	}
	
	/*
	Like button
	http://developers.facebook.com/docs/reference/plugins/like/
	*/
	
	function get_like_button($criteria=array()) {
		$url = $criteria['url'];
		$layout = $criteria['layout'];
		$width = $criteria['width'];
		$height = $criteria['height'];
		$colorscheme = $criteria['colorscheme'];
		$showfaces = $criteria['showfaces'];
		$action = $criteria['action'];
		$font = $criteria['font'];
		
		if($url=='') $url = '';
		if($layout=='') $layout = 'standard'; //standard, button_count, box_count
		if($width=='') $width = '450';
		if($height=='') $height = '80';
		if($colorscheme=='') $colorscheme = 'light'; //light, dark
		if($showfaces=='') $showfaces = 'true'; //true, false
		if($action=='') $action = 'like'; //like, recommend
		if($font=='') $font = ''; //'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
		
		$content = '<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$layout.'&amp;show_faces='.$showfaces.'&amp;width='.$width.'&amp;action='.$action.'&amp;font='.$font.'&amp;colorscheme='.$colorscheme.'&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		//$content = '<fb:like href="'.$url.'" layout="'.$layout.'" show_faces="'.$showfaces.'" width="'.$width.'" action="'.$action.'" font="'.$font.'" colorscheme="'.$colorscheme.'"></fb:like>';
		
		return $content;
	}
	
	/*
	Activity feed
	http://developers.facebook.com/docs/reference/plugins/activity/
	*/
	
	function get_activity_feed($criteria=array()) {
		$domain = $criteria['domain'];
		$width = $criteria['width'];
		$height = $criteria['height'];
		$colorscheme = $criteria['colorscheme'];
		$header = $criteria['header'];
		$recommendations = $criteria['recommendations'];
		$border_color = $criteria['border_color'];
		$font = $criteria['font'];
		
		if($domain=='') $domain = '';
		if($width=='') $width = '300';
		if($height=='') $height = '300';
		if($colorscheme=='') $colorscheme = 'light'; //light, dark
		if($header=='') $header = 'true';
		if($recommendations=='') $recommendations = 'false';
		if($border_color=='') $border_color = '';
		if($font=='') $font = ''; //'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
		
		$content = '<iframe src="http://www.facebook.com/plugins/activity.php?site='.$domain.'&amp;width='.$width.'&amp;height='.$height.'&amp;header='.$header.'&amp;colorscheme='.$colorscheme.'&amp;font='.$font.'&amp;border_color='.$border_color.'&amp;recommendations='.$recommendations.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		
		return $content;
	}
	
	/*
	Recommendations
	http://developers.facebook.com/docs/reference/plugins/recommendations/
	*/
	
	function get_recommendations($criteria=array()) {
		$domain = $criteria['domain'];
		$width = $criteria['width'];
		$height = $criteria['height'];
		$colorscheme = $criteria['colorscheme'];
		$header = $criteria['header'];
		$border_color = $criteria['border_color'];
		$font = $criteria['font'];
		
		if($domain=='') $domain = '';
		if($width=='') $width = '300';
		if($height=='') $height = '300';
		if($colorscheme=='') $colorscheme = 'light'; //light, dark
		if($header=='') $header = true;
		if($border_color=='') $border_color = '';
		if($font=='') $font = ''; //'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
		
		$content = '<iframe src="http://www.facebook.com/plugins/recommendations.php?site='.$domain.'&amp;width='.$width.'&amp;height='.$height.'&amp;header='.$header.'&amp;colorscheme='.$colorscheme.'&amp;font='.$font.'&amp;border_color='.$border_color.'&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		
		return $content;
	}
	
	/*
	Like box
	http://developers.facebook.com/docs/reference/plugins/like-box/
	*/
	
	function get_like_box($criteria=array()) {
		$url = $criteria['url'];
		$width = $criteria['width'];
		$height = $criteria['height'];
		$colorscheme = $criteria['colorscheme'];
		$header = $criteria['header'];
		$showfaces = $criteria['showfaces'];
		$stream = $criteria['stream'];
		
		if($url=='') $url = '';
		if($width=='') $width = '292';
		if($height=='') $height = '427';
		if($colorscheme=='') $colorscheme = 'light'; //light, dark
		if($header=='') $header = 'true';
		if($show_faces=='') $show_faces = 'true';
		if($stream=='') $stream = 'true';
		
		$content = '<iframe src="http://www.facebook.com/plugins/likebox.php?href='.$url.'&amp;width='.$width.'&amp;colorscheme='.$colorscheme.'&amp;show_faces='.$show_faces.'&amp;stream='.$stream.'&amp;header='.$header.'&amp;height='.$height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		
		return $content;
	}
	
	/*
	Facepile
	http://developers.facebook.com/docs/reference/plugins/facepile/
	*/
	
	function get_facepile($criteria=array()) {
		$url = $criteria['url'];
		$app_id = $criteria['app_id'];
		$width = $criteria['width'];
		$max_rows = $criteria['max_rows'];
		
		if($url=='') $url = '';
		if($app_id==''&&$url=='') $app_id = $this->app_id;
		if($width=='') $width = '200';
		if($max_rows=='') $max_rows = '2';
		
		if($app_id!='') $content = '<iframe src="http://www.facebook.com/plugins/facepile.php?app_id='.$app_id.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px;" allowTransparency="true"></iframe>';
		else $content = '<iframe src="http://www.facebook.com/plugins/facepile.php?href='.$url.'&amp;width='.$width.'&amp;max_rows='.$max_rows.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px;" allowTransparency="true"></iframe>';
		
		return $content;
	}
	
	/*
	Live Stream
	http://developers.facebook.com/docs/reference/plugins/live-stream/
	*/
	
	function get_live_stream($criteria=array()) {
		$app_id = $criteria['app_id'];
		$width = $criteria['width'];
		$height = $criteria['height'];
		$xid = $criteria['xid'];
		$attr_url = $criteria['attr_url'];
		$always_post_to_friends = $criteria['always_post_to_friends'];
		
		if($app_id=='') $app_id = $this->app_id;
		if($width=='') $width = '400';
		if($height=='') $height = '500';
		if($xid=='') $xid = '';
		if($attr_url=='') $attr_url = '';
		if($always_post_to_friends=='') $always_post_to_friends = 'false';
		
		$content = '<fb:live-stream event_app_id="'.$app_id.'" width="'.$width.'" height="'.$height.'" xid="'.$xid.'" always_post_to_friends="'.$always_post_to_friends.'"></fb:live-stream>';
		
		return $content;
	}
	
	/*
	Comments
	http://developers.facebook.com/docs/reference/plugins/comments/
	*/
	
	function get_comments($criteria=array()) {
		$app_id = $criteria['app_id'];
		$width = $criteria['width'];
		$num_posts = $criteria['num_posts'];
		$href = $criteria['href'];
		$colorscheme = $criteria['colorscheme'];
		
		if($app_id=='') $app_id = $this->app_id;
		if($width=='') $width = '500';
		if($num_posts=='') $num_posts = '10';
		if($url=='') $url = '';
		
		if($colorscheme=='dark') $colorscheme='colorscheme="dark"';
		else $colorscheme='';
		
		$content = '<fb:comments href="'.$href.'" num_posts="'.$num_posts.'" width="'.$width.'" '.$colorscheme.'></fb:comments>';
		
		return $content;
	}
	
	/*
	Status update
	http://developers.facebook.com/docs/reference/javascript/fb.ui/
	*/
	function display_status_update($criteria=array()) {
		$app_id = $criteria['app_id'];
		$title = $criteria['title'];
		$message = $criteria['message'];
		$name = $criteria['name'];
		$link = $criteria['link'];
		$picture = $criteria['picture'];
		$caption = $criteria['caption'];
		$description = $criteria['description'];
		
		if($app_id=='') $app_id = $this->app_id;
		if($title=='') $title = '';
		if($message=='') $message = '';
		if($name=='') $name = '';
		if($link=='') $link = '';
		if($picture=='') $picture = '';
		if($caption=='') $caption = '';
		if($description=='') $description = '';
		
		$random = rand(9999,9999999).rand(9999,9999999).rand(9999,9999999);
		
		$js = '
		<script>
		function fc_post_fb_update_'.$random.'() {
			FB.ui({ 
				method: \'feed\',
				message: \''.$message.'\',
				name: \''.$name.'\',
     			link: \''.$link.'\',
     			picture: \''.$picture.'\',
     			caption: \''.$caption.'\',
     			description: \''.$description.'\',
			});
		}
		</script>
		';
		
		$content = '<a href="javascript:" onclick="fc_post_fb_update_'.$random.'()">'.$title.'</a>';
		
		return $content.$js;
	}
	
	/*
	Add friend dialog
	http://developers.facebook.com/docs/reference/dialogs/friends/
	*/
	
	function display_add_friend_dialog($criteria=array()) {
		$app_id = $criteria['app_id'];
		$id = $criteria['id'];
		$title = $criteria['title']; //link title
		
		if($app_id=='') $app_id = $this->app_id;
		if($id=='') $id = '';
		if($title=='') $title = '';
		
		$js = '
		<script>
		function fc_add_friend_'.$random.'() {
			FB.ui({ 
				method: \'friends\',
				id: \''.$id.'\',
			});
		};
		
		</script>
		';
		
		$content = '<a href="javascript:" onclick="fc_add_friend_'.$random.'()">'.$title.'</a>';
		
		return $content.$js;
	}
}

?>