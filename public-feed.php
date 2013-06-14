<?php
	function attr($s,$attrname) { // return html attribute
	    preg_match_all('#\s*('.$attrname.')\s*=\s*["|\']([^"\']*)["|\']\s*#i', $s, $x);
	    if (count($x)>=3) return $x[2][0]; else return "";
	}
	
	$adamID = "12072678@N00";
	// id = id of the feed
	// n = number of thumbs
	function parseFlickrFeed($n,$id) {
		if ( $id ){
			$id = "id={$id}&";
		}
		else{
			$id = "";
		}
	    $url = "http://api.flickr.com/services/feeds/photos_public.gne?{$id}lang=en-us&format=rss_200";
	    $s = file_get_contents($url);
	    preg_match_all('#<item>(.*)</item>#Us', $s, $items);
	    $out = "";
	    for($i=0;$i<count($items[1]);$i++) {
	        if($i>=$n) return $out;
	        $item = $items[1][$i];
	        preg_match_all('#<link>(.*)</link>#Us', $item, $temp);
	        $link = $temp[1][0];
	        preg_match_all('#<title>(.*)</title>#Us', $item, $temp);
	        $title = $temp[1][0];
	        preg_match_all('#<media:thumbnail([^>]*)>#Us', $item, $temp);
	        $thumb = attr($temp[0][0],"url");
	        $out.="<li>
	        		<a href='$link' target='_blank' title=\"".str_replace('"','',$title)."\">
	        		<img src='$thumb' />
	        		</a>
	        		</li>";
	    }
	    return $out;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Flickr Feed</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	
	<article class="main">
		<ul class="feed">
			<?php echo parseFlickrFeed(20); ?>
		</ul>
	</article>
	
</body>
</html>