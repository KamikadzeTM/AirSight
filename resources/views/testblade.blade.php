<!DOCTYPE html>
<html>
<head>
   <title>Place searches</title>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
   <meta charset="utf-8">
   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
         height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
         height: 600px;
         margin: 0;
         padding: 0;
      }
   </style>
   <!-- this includes javascript file-->
   <script type="text/javascript" src="{{ URL::asset('js/testJS.js') }}"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFZ6geFJkMoNyZhOBVIVNl2_yfdXORaUc&libraries=places&callback=initMap" async defer></script>
   <script>
       // This example requires the Places library. Include the libraries=places
       // parameter when you first load the API. For example:
       // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

       var map;
       var infowindow;

       function initMap() {
           var ruse = {lat: 43.835587, lng: 25.965493};
           var paris = {lat:  48.858612, lng: 2.296099};
           map = new google.maps.Map(document.getElementById('map'), {
               center: paris,
               zoom: 10
           });

           //path geolocations
           var flightPlanCoordinates = [
            {lat:48.961468,lng: 2.437183},
            {lat:49.565116,lng: 3.602775},
            {lat:50.100371,lng: 4.819541},
            {lat:50.467083,lng: 5.690625},
            {lat:50.647731,lng: 6.178970},
            {lat:50.931120,lng: 6.997686},
            {lat: 51.127386,lng: 7.602531},
            {lat:51.881767,lng: 10.554865},
            {lat:52.222383,lng: 12.421855},
            {lat:52.378574,lng: 13.520646}
           ];
           var flightPath = new google.maps.Polyline({
               path: flightPlanCoordinates,
               geodesic: true,
               strokeColor: '#000000',
               strokeOpacity: 1.0,
               strokeWeight: 2
           });
            //sets the polyline
           flightPath.setMap(map);
           @if( $flightPathIndex!=null)

           var geoIndex = {{ $flightPathIndex  }}  ;
           var location = flightPlanCoordinates[geoIndex];
           infowindow = new google.maps.InfoWindow();
           var service = new google.maps.places.PlacesService(map);
           service.nearbySearch({
               location: location,
               radius: 2000,
               keyword: "point of interest"
           }, callback);
           map.panTo(location);
          @endif

       }

       function callback(results, status) {
           if (status === google.maps.places.PlacesServiceStatus.OK) {
               for (var i = 0; i < results.length; i++) {
                   createMarker(results[i]);
               }
           }
       }

       function createMarker(place) {
           var placeLoc = place.geometry.location;
           var marker = new google.maps.Marker({
               map: map,
               position: place.geometry.location
           });

           google.maps.event.addListener(marker, 'click', function() {
               var contentString = place.name + "<br>" + place.vicinity;

               infowindow.setContent(contentString);
               infowindow.open(map, this);
           });
       }

   </script>
</head>
<body>
<div id="map"></div>


<form method="GET" action="/testControl">
   Choose path point:
   <input type="number" value="0" name="pathIndex" min="0" max="9">
   <input type="submit"  value="Choose">
</form>
{{  TestController::getWikiText() }}}
<!-- this writes value returned from JS function-->
<!--<script>document.write( myFunc())</script>-->


</body>
</html>




