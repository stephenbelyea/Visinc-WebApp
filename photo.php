<?php
	require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr($key);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	// Get id of photo  
	$id = isset($_GET['id']) ? $_GET['id'] : NULL; 
	//echo $id;

	// access the getInfo method, passing in the photo's id  
	$photo = $f->photos_getInfo($id, $secret = NULL); 
	 
	print ('<pre>') ;
	print_r($photo);
	print ('</pre>');
	echo "<br /><br />This is the ID: " . $photo[id];

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
		<h1>telltale</h1>
		<div class="feed">
			<?php  
 				// The photo's title once again  
				echo"<h2>$photo[title]</h2>";  
				  
				// The photo itself, you'll recognise $photoUrl from above where we  built the photo's url, we are also accessing the $size array that we  prepared earlier to get the width and height  
				// and the title once again   
				// We'll also make it link to the version on Flickr for good measure  
				echo"<a href=\"http://flickr.com/photos/$username/$photo[id]/\" title=\"View $photo[title] on Flickr \">";  
				echo"<img src=\"$photoUrl\" width=\"$size[width]\" height=\"$size[height]\" alt=\"$photo[title]\" />";  
				echo"</a>";  
				  
				// The photo's description  
				echo"<p>$photo[description]</p>";
			?>
		</div>
		<p>This product uses the Flickr API but is not endorsed or certified by Flickr.</p>
	</article>
	
</body>
</html>