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

	// Get ID when only USER is available.
	//$result = $f->people_findByUsername(FLICKR_USER);
	//$nsid = $result["id"];
	// Set ID with actual ID
	$nsid = FLICKR_ID;
	$extras = "description, date_upload, geo, media";

	$photos = $f->people_getPublicPhotos($nsid, NULL, $extras, 24);
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

							// Get image title. If no title, set as 'Untitled'.
							$title = $photo['title'];
							if( !$title ){ $title = 'Untitled'; }

							$desc = $photo['description'];
							if( !$desc ){ $desc = 'No description available.'; }

							if( $photo['place_id'] ){
								$singlePhoto = $f->photos_getInfo($photo['id']);
								$location = $singlePhoto['photo']['location'];
								$local = $location['locality']['_content'];
								if( $local ){
									$neigh = str_replace( $local, "", $location['neighbourhood']['_content'] );
									$region = str_replace( "Ontario", "ON", $location['region']['_content']);
									if( $neigh ){ $neigh = $neigh . " - "; } 
									$area = $neigh .
											$local . ", " . 
											$region . ", " .
											$location['country']['_content'] . ".";
								}
							}
							else{
								$area = "No location specified.";
							}
						    
							// print out a link to the photo page, attaching the id of the photo  
							//echo "<li class='thumb'><a href=\"photo.php?id=$photo[id]\" title=\"View $photo[title]\">";  
							echo "<li class='" . $oddEven . "'>";
							echo 	"<a href='single.php?imgID=" .
									$photo['id'] .
									"&imgURL=" .
									$f->buildPhotoURL($photo, 'Large') .
									"' title='View " . $photo['title'] . "'>";
							      
							// This next line uses buildPhotoURL to construct the location of our image, and we want the 'Square' size  
							// It also gives the image an alt attribute of the photo's title  
							//echo "<img src=\"" . $f->buildPhotoURL($photo, "Medium") .  "\" alt=\"$photo[title]\" />"; 
							echo "<div class='crop' style='background-image: url(" . $f->buildPhotoURL($photo, "Medium") .  ");'></div>";
							echo "<div class='info'>";
							echo "<h2>" . $title . "</h2>";
							echo "<p class='desc'>" . $desc . "</p>";
							echo "<p class='location'>" . $area . "</p>";
							echo "</div>";  
							// close link   
							echo "</a></li>";  
							  
							// end loop  
						}  
					?>
				</ul>
			</article>

		</div>

<?php require 'includes/footer.php'; ?>