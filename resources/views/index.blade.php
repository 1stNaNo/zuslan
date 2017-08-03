@extends('layouts.main.main_nowidget')

@section('map')

<div class="row">
  <div class="col-md-12">
    <div id="floating-panel">
      <b>Газрууд: </b>
      <select id="start">
        @foreach ($mapCategory as $item)
          <option value="{{$item->id}}">{{$item->value}}</option>
        @endforeach
      </select>

      <style>
        #floating-panel {
          position: absolute;
          top: 10px;
          left: 25%;
          z-index: 5;
          background-color: #fff;
          padding: 5px;
          border: 1px solid #999;
          text-align: center;
          font-family: 'Roboto','sans-serif';
          line-height: 30px;
          padding-left: 10px;
        }
      </style>
    </div>
    <div id="floating-panel-left">

      <style>
        #floating-panel-left {
          position: absolute;
          top: 50px;
          left: 2%;
          z-index: 5;
          max-height: 320px;
          overflow: scroll;
          background-color: #fff;
          padding: 5px;
          border: 1px solid #999;
          text-align: left;
          font-family: 'Roboto','sans-serif';
          line-height: 30px;
          padding-left: 10px;
        }

        #floating-panel-left div{
          border-bottom: solid 1px grey;
          cursor: pointer;
          font-size: 12px;
          line-height: 18px;
        }
      </style>
    </div>
    <div id="map" style="height: 400px;"></div>
    <script type="text/javascript">
        $(document).ready(function(){
          getCurrentLocation();
        });

        var map;
        var currentLocation;
        var cityCircle;
        var markers = {};
        var directionsService;
        var directionsDisplay;
        var matrixService;

        function initMap() {

          directionsService = new google.maps.DirectionsService;
          directionsDisplay = new google.maps.DirectionsRenderer;
          matrixService = new google.maps.DistanceMatrixService;

          map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: currentLocation
          });

          directionsDisplay.setMap(map);

          var marker = new google.maps.Marker({
            position: currentLocation,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
          });

          var infowindow = new google.maps.InfoWindow({
            content: 'Таны байгаа газар'
          });

          marker.set("id", 0);

          markers['0'] = {};
          markers['0']['marker'] = marker;
          markers['0']['info'] = infowindow;

          marker.addListener('click', function() {
              markers[this.get("id")]["info"].open(map, markers[this.get("id")]["marker"]);
          });

          @foreach($map as $item)
            var marker = new google.maps.Marker({
              position: {lat: {{$item->latitude}}, lng: {{$item->longitude}}},
              map: map,
              animation: google.maps.Animation.DROP
            });

            var infowindow = new google.maps.InfoWindow({
              content: '{{$item->name}}'
            });

            circle = new google.maps.Circle();
            setCircle(map, circle, {lat: {{$item->latitude}}, lng: {{$item->longitude}}}, {{$item->radius}});

            marker.set("id", {{$item->id}});

            markers['{{$item->id}}'] = {};
            markers['{{$item->id}}']['marker'] = marker;
            markers['{{$item->id}}']['info'] = infowindow;
            markers['{{$item->id}}']['circle'] = circle;

            matrixService.getDistanceMatrix({
              origins: [currentLocation],
              destinations: [{lat: {{$item->latitude}}, lng: {{$item->longitude}}}],
              travelMode: 'DRIVING',
              unitSystem: google.maps.UnitSystem.METRIC,
              avoidHighways: false,
              avoidTolls: false
            }, function(response, status) {
              if (status !== 'OK') {
                alert('Error was: ' + status);
              } else {
                var result = response.rows[0].elements[0];
                $('#floating-panel-left').append('<div onclick="getRoute({{$item->id}})"> Нэр: {{$item->name}} </br>' +'Зай: '+ result.distance.text +'</br>Хугацаа: '+ result.duration.text +"</div>");
              }
            });

            marker.addListener('click', function() {
                closeInfo();
                markers[this.get("id")]["info"].open(map, markers[this.get("id")]["marker"]);
                directionsService.route({
                    // origin: document.getElementById('start').value,
                    origin: currentLocation,

                    // destination: marker.getPosition(),
                    destination: {
                        lat: this.getPosition().lat(),
                        lng: this.getPosition().lng()
                    },
                    travelMode: 'DRIVING'
                }, function(response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            });
          @endforeach



          //  setCircle(map, uluru, $("#mapRadius").val());
          //

          //
          // $("#mapRadius").change(function(){
          //   setCircle(map, {lat: $("#mapRegister_form [name='latitude']").val(), lng: $("#mapRegister_form [name='longitude']").val()}, $("#mapRadius").val());
          // });
        }

        function getRoute(id){

          closeInfo();
          markers[id]["info"].open(map, markers[id]["marker"]);
          directionsService.route({
              // origin: document.getElementById('start').value,
              origin: currentLocation,

              // destination: marker.getPosition(),
              destination: {
                  lat: markers[id]["marker"].getPosition().lat(),
                  lng: markers[id]["marker"].getPosition().lng()
              },
              travelMode: 'DRIVING'
          }, function(response, status) {
              if (status === 'OK') {
                  directionsDisplay.setDirections(response);
              } else {
                  window.alert('Directions request failed due to ' + status);
              }
          });
        }

        function closeInfo(){
            for(key in markers){
              markers[key]["info"].close(map);
            }
        }

        function setCircle(map, circle, center, radius){

          if(radius == ""){
            radius = 0;
          }

          circle.setOptions({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.35,
              map: map,
              center: center,
              radius: Math.sqrt(radius) * 100
          });
        }

        function getCurrentLocation(){
          // Try HTML5 geolocation.
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };

              currentLocation = pos;
              initMap();
            }, function(error) {
              console.log(error);
            },{timeout: 30000, enableHighAccuracy: true, maximumAge: 75000});
          } else {
            // Browser doesn't support Geolocation
            console.log("BROWSER DOESNT SUPPORT");
          }
        }
    </script>
  </div>
</div>
@endsection
@section('content')
<hr class="tall">
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row">
      <div class="col-md-6">
      <div class="feature-box-info">
        <div class="feature-box">
          <!-- ICON -->

            <div class="feature-box-icon">
              <i class="fa fa-star"></i>
            </div>
          <!-- TITLE -->
            <div class="heading heading-secondary heading-border heading-bottom-border">
              <h2 class="heading-quaternary">
                Шинэ мэдээ
              </h2>
            </div>

          </div>

          <div class="col-md-12" style="padding: 0 !important">
            @foreach($news as $n)
            <div class="n-item row">
              <div class="col-md-4">
                <a href="/post/{{$n->id}}">
                  <span class="thumb-info thumb-info-centered-info">
                    <span class="thumb-info-wrapper">
                      <img alt="" class="img-responsive img-rounded" src="{{$n->thumbnail}}"  style="height: 87px !important">
                      <span class="thumb-info-title">
                        <span class="thumb-info-inner">
                          <i class="fa fa-commenting-o"></i> {{$n->comment_count}} &nbsp; &nbsp; <i class="fa fa-eye"></i> {{$n->views}}
                        </span>
                      </span>
                      <span class="thumb-info-action">
                      </span>
                    </span>
                  </span>
                </a>
              </div>
              <div class="col-md-8">
                <a href="/post/{{$n->id}}">{{$n->title}}</a>
                <div><p class=""><i class="fa fa-calendar-check-o"></i> {{\Carbon\Carbon::parse($n->insert_date)->format('Y-m-d')}}</p></div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
      <div class="col-md-6">
      <div class="feature-box-info">
        <div class="feature-box">
          <!-- ICON -->
          <div class="feature-box-icon">
            <i class="fa fa-eye"></i>
          </div>

          <!-- TITLE -->
            <div class="heading heading-secondary heading-border heading-bottom-border">
              <h2 class="heading-quaternary">
                Их уншсан
              </h2>
            </div>

          </div>

          <div class="col-md-12" style="padding: 0 !important">
            @foreach($viewnews as $n)
            <div class="n-item row">
              <div class="col-md-4">
                <a href="/post/{{$n->id}}">
                  <span class="thumb-info thumb-info-centered-info">
                    <span class="thumb-info-wrapper">
                      <img alt="" class="img-responsive img-rounded" src="{{$n->thumbnail}}" style="height: 87px !important">
                      <span class="thumb-info-title">
                        <span class="thumb-info-inner">
                          <i class="fa fa-commenting-o"></i> {{$n->comment_count}} &nbsp; &nbsp; <i class="fa fa-eye"></i> {{$n->views}}
                        </span>
                      </span>
                      <span class="thumb-info-action">
                      </span>
                    </span>
                  </span>
                </a>
              </div>
              <div class="col-md-8">
                <a href="/post/{{$n->id}}">{{$n->title}}</a>
                <div><p class=""><i class="fa fa-calendar-check-o"></i> {{\Carbon\Carbon::parse($n->insert_date)->format('Y-m-d')}}</p></div>
              </div>

            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
