<?php
	require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr($key);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	$result = $f->people_findByUsername($user);
	$nsid = $result["id"];

	$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, 18);
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
		<ul class="feed">
			<?php  
				// loop through each photo  
				 foreach ($photos['photos']['photo'] as $photo) {  
				    
					// print out a link to the photo page, attaching the id of the photo  
					echo "<li><a href=\"photo.php?id=$photo[id]\" title=\"View $photo[title]\">";  
					//echo "<li><a href=\"" . $f->buildPhotoURL($photo, 'Large') . "\" title=\"View $photo[title]\">";
					      
					// This next line uses buildPhotoURL to construct the location of our image, and we want the 'Square' size  
					// It also gives the image an alt attribute of the photo's title  
					echo "<img src=\"" . $f->buildPhotoURL($photo, "large square") .  "\" alt=\"$photo[title]\" />";  
					  
					// close link   
					echo "</a></li>";  
					  
					// end loop  
				}  
			?>
		</ul>
		<p>This product uses the Flickr API but is not endorsed or certified by Flickr.</p>
	</article>
	
</body>
</html>