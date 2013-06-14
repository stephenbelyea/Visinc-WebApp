<?php 
	require 'includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<script src="http://maps.googleapis.com/maps/api/js?key=<?php echo KEY_GOOGLE; ?>&sensor=false"></script>
	<script>

		var map;
		var toronto = new google.maps.LatLng(43.655,-79.389);
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
			  	zoom: 13,
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
				position: toronto,
				map: map
			});

			var georssLayer = new google.maps.KmlLayer({
		    	url: 'http://api.flickr.com/services/feeds/geo/?g=<?php echo FLICKR_ID; ?>&lang=en-us&format=feed-georss',
		    	map: map
		  	});
		  	//georssLayer.setMap(map);

		}

		google.maps.event.addDomListener(window, 'load', initialize);

	</script>
</head>
<body>

	<div id="map-canvas" style="width:1000px;height:1000px;margin:50px auto;"></div>

</body>
</html>