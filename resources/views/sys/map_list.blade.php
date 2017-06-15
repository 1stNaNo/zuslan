@extends('layouts.admin')

@section('content')
<div id="window_mapList" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{ trans('Газар') }}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="sysmap.add()" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div style="display: none;" class="ucolumn-cont" data-table="map_grid">
        <ucolumn name="id" source="id" visible="false"/>
        <ucolumn name="name" source="name"/>
        <ucolumn name="latitude" source="latitude"/>
        <ucolumn name="longitude" source="longitude"/>
        <ucolumn name="radius" source="radius"/>
        <ucolumn name="value" source="value"/>
        <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="sysmap.edit" uclass="fa fa-pencil ucGreen" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
        <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="sysmap.remove" uclass="fa fa-trash-o ucRed" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
      </div>
      <table action="/sys/map/list" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="map_grid" width="100%">
        <thead>
          <tr>
            <th>{{trans('resource.weblinks.id')}}</th>
            <th>{{trans('resource.name')}}</th>
            <th>{{trans('Өргөрөг')}}</th>
            <th>{{trans('Уртраг')}}</th>
            <th>{{trans('Тойрог')}}</th>
            <th>{{trans('Төрөл')}}</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
      </table>
  	</div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var buttons = [];
    // buttons.push('<button onclick="sysmasters.add(); return false;" class="btn btn-primary pull-left" style="margin-left:12px" id="">{{trans('resource.buttons.add')}}</button>');
    baseGridFunc.init("map_grid", buttons);
  });

  var sysmap = {
      add: function(){
        var postData = {};
        uPage.call('/sys/map/edit',postData);
      },

      edit: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.id;

          uPage.call('/sys/map/edit',postData);
      },

      save: function(){

          $.ajax({
              url: '/sys/map/save',
              type: "POST",
              dataType: "json",
              data : $("#mapRegister_form").serializeObject(),
              success: function(data){
                  if(data.type == 'success'){
                    umsg.success(messages.saved);
                    uPage.close('window_mapRegister');
                    baseGridFunc.reload("map_grid");
                  }else{
                    uvalidate.setErrors(data);
                  }
              }
          });
      },

      remove: function(gridId ,elmnt){

        var rowData = baseGridFunc.getRowData(gridId ,elmnt);

        var postData = {};
        postData['id'] = rowData.id;
        $.ajax({
            url: '/sys/map/remove',
            type: "POST",
            dataType: "json",
            data : postData,
            success: function(data){
                if(data.type == 'success'){
                  umsg.success(messages.removed);
                  baseGridFunc.reload("map_grid");
                }
            }
        });
      }
  }

</script>
@endsection
