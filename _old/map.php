<?php
  require "includes/config.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple styled maps</title>
    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo KEY_GOOGLE; ?>&sensor=false"></script>
    <script>
      var map;
      var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);

      var MY_MAPTYPE_ID = 'custom_style';

      function initialize() {

        var featureOpts = [
          {
            stylers: [
              { hue: '#890000' },
              { visibility: 'simplified' },
              { gamma: 0.5 },
              { weight: 0.5 }
            ]
          },
          {
            elementType: 'labels',
            stylers: [
              { visibility: 'off' }
            ]
          },
          {
            featureType: 'water',
            stylers: [
              { color: '#890000' }
            ]
          }
        ];

        var mapOptions = {
          zoom: 12,
          center: brooklyn,
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
          },
          mapTypeId: MY_MAPTYPE_ID
        };

        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        var styledMapOptions = {
          name: 'Custom Style'
        };

        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
      }

      google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>