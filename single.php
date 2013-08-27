<?php 
	$pageTitle = 'View Image';
	$pageClass = 'img';
	require 'includes/head.php'; 
	require 'includes/phpFlickr.php';
	//require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr(KEY_FLICKR);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	$imgID = $_GET['imgID'];
	$imgURL = $_GET['imgURL'];

	$photoArray = $f->photos_getInfo($imgID);
	$photo = $photoArray['photo'];
	$location = $photo['location'];
?>
		
	<div id="wrap">

		<article class="main single">
			<div class="img-back">
				<div class="img-btns">
					<div class="btn-back">
						<a href="#" onclick="history.back();return false;">Back</a>
					</div>
					<div class="btn-info">
						<a href="#info">Info</a>
					</div>
				</div>
			<?php 
				$desc = $photo['description'];
				if( !$desc ){ $desc = "No description available"; }
				// Image element version.
				// echo 	"<div class='img-big'>" .
				// 		"<img src='" .
				// 		$imgURL .
				// 		"' alt='" .
				// 		$desc . 
				// 		"' />" .
				// 		"</div>";
				// Background image version.
				echo 	"<div class='img-big' style='background-image:url(" . 
						$imgURL .
						");'>" .
						"</div>";
			?>
			</div>
			<div class="img-info" id="info">
				<div class="info-inner">
					<h2><?php echo $photo['title']; ?></h2>
					<p class="desc"><?php echo $desc; ?></p>
				<?php  
					$local = $location['locality']['_content'];
					if( $local ){
						$neigh = str_replace( $local, "", $location['neighbourhood']['_content'] );
						$region = str_replace( "Ontario", "ON", $location['region']['_content']);
						if( $neigh ){ $neigh = $neigh . " - "; } 
						$area = $neigh .
								$local . ", " . 
								$region . ", " .
								$location['country']['_content'] . ".";
						echo 	"<p class='location'>" . $area . "</p>";
						$lat = 	$location['latitude'];
						$lon = 	$location['longitude'];
						$coor = $lat . ", " . $lon;
						$mapIt ="map-single.php?lat=" .
								$lat . 
								"&lon=" . 
								$lon .
								"&id=" . 
								$imgID;
						echo 	"<p class='coor'>Coordinates: " . $coor . "</p>";
						echo 	"<div class='map-it'><a href='" .
								$mapIt .
								"'>Map it</a></div>";
					}
					else{
						echo 	"<p class='location'>Sorry, no location info available.</p>";
					}
				?>
				</div>
			</div>
		</article>

	</div>

<?php require 'includes/footer.php'; ?>

<?php 
	echo 	"<div class='array'>";
	echo 	"<pre>";
	print_r($photo);
	echo 	"</pre>";
	echo 	"</div>";
?>