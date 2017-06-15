
<div id="window_mapRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('Газар')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="mapRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (!empty($map)) ? $map->id : '' }}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Төрөл')}}</label>
                  <div class="col-md-6">
                    <select name="cat_id">
                        @foreach ($mapCategory as $item)
                          @if(!empty($map))
                            @if ($item->id == $map->cat_id)
                              <option selected="selected" value="{{$item->id}}">{{$item->value}}</option>
                            @else
                              <option value="{{$item->id}}">{{$item->value}}</option>
                            @endif
                          @else
                              <option value="{{$item->id}}">{{$item->value}}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.name')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="name" class="" value="{{(!empty($map)) ? $map->name : ''}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Өргөрөг')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="latitude" class="" value="{{(!empty($map->latitude)) ? $map->latitude : '47.918821'}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Уртраг')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="longitude" class="" value="{{(!empty($map->longitude)) ? $map->longitude : '106.917530'}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('Тойрог')}}</label>
                  <div class="col-md-6">
                    <input type="text" id="mapRadius" class="form-control" name="radius" class="" value="{{(!empty($map->radius)) ? $map->radius : '5'}}"/>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <div id="map" style="height: 400px;"></div>
                  </div>
                </div>

                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="sysmap.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_mapRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function(){

        $(".uselect2").select2();
        initMap();
      });

      var map;
      var cityCircle;

      function initMap() {
        var uluru = {lat: parseFloat($("#mapRegister_form [name='latitude']").val()), lng: parseFloat($("#mapRegister_form [name='longitude']").val())};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
        });

         cityCircle =  new google.maps.Circle();

         setCircle(map, uluru, $("#mapRadius").val());

        google.maps.event.addListener(marker, 'dragend', function (event) {
          $("#mapRegister_form [name='latitude']").val(this.getPosition().lat());
          $("#mapRegister_form [name='longitude']").val(this.getPosition().lng());

          setCircle(map, {lat: this.getPosition().lat(), lng: this.getPosition().lng()}, $("#mapRadius").val());
        });

        $("#mapRadius").change(function(){
          setCircle(map, {lat: $("#mapRegister_form [name='latitude']").val(), lng: $("#mapRegister_form [name='longitude']").val()}, $("#mapRadius").val());
        });
      }

      function setCircle(map, center, radius){

        if(radius == ""){
          radius = 0;
        }

        cityCircle.setOptions({
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
</div>
