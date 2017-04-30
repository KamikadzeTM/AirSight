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
           var mishoLoc = {lat:43.433359,lng: 5.217761};
           map = new google.maps.Map(document.getElementById('map'), {
               center: mishoLoc,
               zoom: 10
           });

           //path geolocations
           /*var flightPlanCoordinates = [
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
           ];*/
           var flightPlanCoordinates = [
               {lat:43.433359,lng: 5.217761},
               {lat:44.054259,lng: 5.048906},
               {lat:44.137585,lng: 4.807289},
               {lat:44.551444,lng: 4.746983},
               {lat:45.428255,lng: 4.395366},
               {lat:46.439203,lng: 4.119595},
               {lat:47.483714,lng: 3.909408},
               {lat:47.780862,lng: 3.580330},
               {lat:48.198012,lng: 3.282860},
               {lat:48.848265,lng: 2.346014},
               {lat:49.887337,lng: 2.296769},
               {lat:50.405974,lng: 1.588200},
               {lat:50.852699,lng: 0.572673},
               {lat:51.233393,lng: -0.569637},
               {lat:51.448992,lng: -0.979467},
               {lat:51.861870,lng: -2.238851},
               {lat:52.052122,lng: -2.716873},
               {lat:52.410883,lng: -4.080819},
               {lat:53.198768,lng: -6.111328},
               {lat:53.421075,lng: -6.269945}
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

           var image = "{{asset('images/tr2-small.png')}}";
           var planeMarker = new google.maps.Marker({
               position: location,
               map: map,
               icon: image
           });


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
               var image = "{{asset('images/map_marker.png')}}";
               for (var i = 0; i < results.length; i++) {
                   createMarker(results[i],image);
               }
           }
       }

       function createMarker(place,image) {
           var placeLoc = place.geometry.location;
           var marker = new google.maps.Marker({
               map: map,
               position: place.geometry.location,
               icon: image
           });
            /*
           var req = $.ajax({
               type: "GET",
               url: '/wikinfo',
               data: {locName: place.name} //location name
           });*/

           //req.done(function (data) {

            google.maps.event.addListener(marker, 'click', function() {
                //alert(wikiText);
                var contentString = place.name + "<br>" + place.vicinity;

                infowindow.setContent(contentString);
                infowindow.open(map, this);
            });
           //});
       }


   </script>
</head>
<body>
<div id="map"></div>


<form method="GET" action="/testControl">
   Choose path point:
   <input type="range" value="0" name="pathIndex" min="0" max="19">
   <input type="submit"  value="Choose">

   <!--<img src="{{asset('images/tr2-small.png')}}" >
   <img src="{{asset('images/map_marker.png')}}" > -->
</form>


</body>
</html>




