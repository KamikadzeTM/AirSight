<!DOCTYPE html>
<html lang="en">
<head>
    <title>AirSight</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all">


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFZ6geFJkMoNyZhOBVIVNl2_yfdXORaUc&libraries=places&callback=initMap" async defer></script>


    <script>
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


            var element = document.getElementById('txtfieldFrom');
            element.value= "Marceille";
            element = document.getElementById('txtfieldTo');
            element.value= "Dublin";
            element = document.getElementById('dateDepart');
            element.value= "04/30/2017";
            element = document.getElementById('timeDepart');
            element.value= "09:52";
            element = document.getElementById('flightDuration');
            element.value= "01:11";
            element = document.getElementById('flightETA');
            element.value= "11:03";
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

            google.maps.event.addListener(marker, 'click', function() {
                var contentString = place.name + "<br>" + place.vicinity;

                infowindow.setContent(contentString);
                infowindow.open(map, this);
                document.getElementById("info-segment").style.visibility = "visible";
            });
        }


    </script>
</head>

<body id="page1">
<!-- START PAGE SOURCE -->
<div class="body1">
    <div class="main">
        <header>
            <div class="wrapper headings">
                <h1>AirSight</h1>

            </div>
        </header>
    </div>
</div>
<div class="main">
    <div id="banner">
        <div class="text1">      </p>
        </div>

    </div>
    <div class="main">
        <section id="content">
            <article class="col1">
                <div class="pad_1">
                    <h2>Flight information</h2>
                    <form id="form_1" action="#" method="post">

                        <div class="wrapper"> Leaving From:
                            <div class="bg">
                                <input type="text" id="txtfieldFrom" class="input input1" value="Enter City or Airport Code" onBlur="if(this.value=='') this.value='Enter City or Airport Code'" onFocus="if(this.value =='Enter City or Airport Code' ) this.value=''">
                            </div>
                        </div>
                        <div class="wrapper"> Going To:
                            <div class="bg">
                                <input type="text" id="txtfieldTo" class="input input1" value="Enter City or Airport Code" onBlur="if(this.value=='') this.value='Enter City or Airport Code'" onFocus="if(this.value =='Enter City or Airport Code' ) this.value=''">
                            </div>
                        </div>
                        <div class="wrapper"> Departure Date and Time:
                            <div class="wrapper">
                                <div class="bg left">
                                    <input type="text" id="dateDepart" class="input input2" value="mm/dd/yyyy " onBlur="if(this.value=='') this.value='mm/dd/yyyy '" onFocus="if(this.value =='mm/dd/yyyy ' ) this.value=''">
                                </div>
                                <div class="bg right">
                                    <input type="text" id="timeDepart" class="input input2" value="12:00am" onBlur="if(this.value=='') this.value='12:00am'" onFocus="if(this.value =='12:00am' ) this.value=''">
                                </div>
                            </div>
                        </div>
                        <p> </p>
                        <div class="wrapper">

                            <div class="bg left">

                            </div>
                            <a href="#" class="button2">go!</a> </div>
                        <div class="wrapper"> Flight duration:
                            <div class="wrapper">

                                <div class="bg right">
                                    <input type="text" id="flightDuration" class="input input2" value="12:00am" onBlur="if(this.value=='') this.value='12:00am'" onFocus="if(this.value =='12:00am' ) this.value=''">
                                </div>
                            </div>
                        </div>
                        <div class="wrapper"> ETA:
                            <div class="wrapper">

                                <div class="bg right">
                                    <input type="text" id="flightETA" class="input input2" value="12:00am" onBlur="if(this.value=='') this.value='12:00am'" onFocus="if(this.value =='12:00am' ) this.value=''">
                                </div>
                            </div>
                        </div>
                        <div class="wrapper"> Progress:
                            <div class="w3-light-grey">
                                <div id="myBar" class="w3-container w3-green" style="height:24px;width:20%"></div>
                            </div>


                        </div>

                    </form>
                    <form method="GET" action="/">
                        Choose flight progress:
                        <input type="range"  name="pathIndex" min="0" max="19"
                               value=
                               @if($flightPathIndex!=null)
                                       "{{$flightPathIndex}}"
                               @else
                                    "0"
                               @endif
                                >
                        <input type="submit"  value="Choose">

                    </form>
                    <h2>We are now over Paris  </h2>
                    <div id="info-segment" class="info-segment">The Catacombs of Paris are underground ossuaries in Paris, France, which hold the remains of more than six million people in a small part of the ancient Mines of Paris tunnel network.</div>
                </div>
            </article>
            <article class="col2 pad_left1">
                <div id="map" style="width:600px;height:600px;background:yellow"></div>

    </div>
</div>
</div>
</article>
</section>
</div>
<div class="body2">
    <div class="main">
        <footer>
            <div class="footerlink">

                <div style="clear:both;"></div>
            </div>
        </footer>
    </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>