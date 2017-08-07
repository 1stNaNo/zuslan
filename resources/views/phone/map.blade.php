
    <script type="text/javascript">
        $(document).ready(function(){
          getCurrentLocation();
        });

        var map;
        var markers = {};
        var directionsService;
        var directionsDisplay;
        var matrixService;

        function initMap() {
          directionsService = new google.maps.DirectionsService;
          directionsDisplay = new google.maps.DirectionsRenderer;
          matrixService = new google.maps.DistanceMatrixService;

          $("#mapList").html('');

          map = new google.maps.Map(document.getElementById('mapCont'), {
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

          $("#mapList").html('');

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

                var html = '';

                html += '<li onclick="getRoute({{$item->id}})" mapid="{{$item->id}}">';
                html +=  '<a href="#" class="close-panel">';
                html +=      'Нэр: {{$item->name}} </br>';
                html +=      'Зай: '+ result.distance.text +'</br>';
                html +=      'Хугацаа: '+ result.duration.text +'</br>';
                html +=  '</a>';
                html += '</li>';

                if($("#mapList li[mapid='{{$item->id}}']").length <= 0){
                  $("#mapList").append(html);
                }
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

          var myApp = new Framework7();

          myApp.closePanel('right');
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
            console.log(status);
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
    </script>
