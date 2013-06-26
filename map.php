<?php 
	$pageTitle = 'Map';
	$pageClass = 'map';
	require 'includes/head.php'; 
?>
		<script src="http://maps.googleapis.com/maps/api/js?key=<?php echo KEY_GOOGLE; ?>&amp;sensor=false"></script>
		<script>

			var map;
			var toronto = new google.maps.LatLng(43.72,-79.42);
			var VISINC_MAPTYPE_ID = 'visinc_style';

			function initialize(){

				var featureOpt = [
			    	{
				      stylers: [
				        { hue: '#58b6dd' },
				        { visibility: 'simplified' },
				        { gamma: 0.6 },
				        { weight: 0.9 }
				      ]
				    },
				    {
				      elementType: 'labels',
				      stylers: [
				        { visibility: 'on' },
				        { gamma: 0.9 },
				        { lightness: 70 },
				        { saturation: 20 }
				      ]
				    },
				    {
				      featureType: 'water',
				      stylers: [
				        { color: '#58b6dd' }
				      ]
				    }
			  	];

				var mapOpt = {
				  	center: toronto,
				  	zoom: 12,
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

				// var marker = new google.maps.Marker({
				// 	position: toronto,
				// 	map: map
				// });

				var georssLayer = new google.maps.KmlLayer({
			     	url: 'http://api.flickr.com/services/feeds/geo/?g=<?php echo FLICKR_ID; ?>&lang=en-us&format=feed-georss',
			     	map: map
			  	});

			}

			google.maps.event.addDomListener(window, 'load', initialize);

		</script>
		
		<div id="wrap">

			<article class="main map">
				<div id="map-canvas"></div>
			</article>

		</div>

<?php require 'includes/footer.php'; ?>