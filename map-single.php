<?php 
	$pageTitle = 'Map';
	$pageClass = 'map';
	require 'includes/head.php'; 
	require 'includes/phpFlickr.php';
	//require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr(KEY_FLICKR);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	$imgID = $_GET['id'];

	$photoArray = $f->photos_getInfo($imgID);
	$photo = $photoArray['photo'];
	$location = $photo['location'];
?>
		<script src="http://maps.googleapis.com/maps/api/js?key=<?php echo KEY_GOOGLE; ?>&amp;sensor=false"></script>
		<script>

			var map;
			var toronto = new google.maps.LatLng(43.72,-79.42);
			var imgLat = <?php echo $_GET['lat']; ?>;
			var imgLon = <?php echo $_GET['lon']; ?>;
			var mapIt = new google.maps.LatLng(imgLat,imgLon);
			var VISINC_MAPTYPE_ID = 'visinc_style';

			function initialize(){

				var featureOpt = [
			    	{
				      stylers: [
				        { hue: '#000000' },
				        { saturation: -100 },
				        //{ visibility: 'simplified' },
				        { gamma: 0.2 },
				        { lightness: 80 },
				        { weight: 0 }
				      ]
				    },
				    {
				      elementType: 'labels',
				      stylers: [
				        { visibility: 'on' },
				        { gamma: 0.1 },
				        { lightness: 0 },
				        { saturation: -100 }
				      ]
				    },
				    {
				      featureType: 'water',
				      stylers: [
				        { color: '#b3b3b3' }
				      ]
				    }
			  	];

				var mapOpt = {
				  	center: mapIt,
				  	zoom: 16,
				  	mapTypeControlOptions: {
				  		mapTypeIds: [google.maps.MapTypeId.ROADMAP, VISINC_MAPTYPE_ID]
				  	},
				  	mapTypeId: VISINC_MAPTYPE_ID
				};

				map = new google.maps.Map(document.getElementById("map-canvas"), mapOpt);

				var styledMapOptions = {
	    			name: 'VisInc Style'
	  			};

	  			var customMapType = new google.maps.StyledMapType(featureOpt, styledMapOptions);

	  			map.mapTypes.set(VISINC_MAPTYPE_ID, customMapType);

				var marker = new google.maps.Marker({
				 	position: mapIt,
				 	map: map
				});

			}

			google.maps.event.addDomListener(window, 'load', initialize);

		</script>
		
		<div id="wrap">

			<article class="main map">
				<div class="map-btns">
					<div class="btn-back">
						<a href="#" onclick="history.back();return false;">Back</a>
					</div>
					<div class="btn-info">
						<a href="#info">Info</a>
					</div>
				</div>
				<div id="map-canvas"></div>
				<div class="map-info" id="info">
					<div class="info-inner">
						<h2><?php echo $photo['title']; ?></h2>
						<p class="desc"><?php echo $desc; ?></p>
					<?php  
						$desc = $photo['description'];
						if( !$desc ){ $desc = "No description available"; }
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
							echo 	"<p class='coor'>Coordinates: " . $coor . "</p>";
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