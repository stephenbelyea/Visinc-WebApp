<?php 
	$pageTitle = 'Gallery';
	$pageClass = 'gal';
	require 'includes/head.php'; 
	require 'includes/phpFlickr.php';
	//require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr(KEY_FLICKR);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	$result = $f->people_findByUsername(FLICKR_USER);
	$nsid = $result["id"];

	$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, 18);
?>
		
		<div id="wrap">

			<article class="main feed">
				<ul>
					<?php 
						$i = 0; 
						// loop through each photo  
						foreach ($photos['photos']['photo'] as $photo) {  
							$i++;
							if($i&1){ $oddEven = 'odd'; }
							else{ $oddEven = 'even'; }
						    
							// print out a link to the photo page, attaching the id of the photo  
							//echo "<li class='thumb'><a href=\"photo.php?id=$photo[id]\" title=\"View $photo[title]\">";  
							echo "<li class='" . $oddEven . "'>";
							echo "<a href=\"" . $f->buildPhotoURL($photo, 'Large') . "\" title=\"View $photo[title]\">";
							      
							// This next line uses buildPhotoURL to construct the location of our image, and we want the 'Square' size  
							// It also gives the image an alt attribute of the photo's title  
							//echo "<img src=\"" . $f->buildPhotoURL($photo, "Medium") .  "\" alt=\"$photo[title]\" />"; 
							echo "<div class='crop' style='background-image: url(" . $f->buildPhotoURL($photo, "Medium") .  ");'></div>"; 
							  
							// close link   
							echo "</a></li>";  
							  
							// end loop  
						}  
					?>
				</ul>
			</article>

		</div>

<?php require 'includes/footer.php'; ?>