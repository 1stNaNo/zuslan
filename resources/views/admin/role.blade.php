@extends('layouts.admin')

@section('content')
<div id="window_roleList" class="page-window active-window">
  <div class="row-fluid">
  <div class="span12">
    <div class="grid simple ">
      <div class="grid-title">
        <h4><span class="semi-bold">{{trans('resource.role.title')}}</span></h4>
        <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="javascript:;" onclick="baseGridFunc.reload('role_grid')" class="reload"></a> </div>
      </div>
      <div class="grid-body ">
        <div style="display: none;" class="ucolumn-cont" data-table="role_grid">
          <ucolumn name="id" source="id" visible="false"></ucolumn>
          <ucolumn name="display_name" source="display_name"></ucolumn>
          <ucolumn name="description" source="description"></ucolumn>
          <ucolumn width="50px" name="edit_btn" source="edit_btn" utype="btn" func="ucategory.edit" uclass="btn-warning" utext="{{trans('resource.buttons.edit')}}"></ucolumn>
          <ucolumn width="50px" name="remove_btn" source="remove_btn" utype="btn" func="ucategory.remove" uclass="btn-danger" utext="{{trans('resource.buttons.remove')}}"></ucolumn>
        </div>
        <table action="role/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="role_grid" width="100%">
          <thead>
            <tr>
              <th>{{trans('resource.category.id')}}</th>
              <th>{{trans('resource.category.name')}}</th>
              <th>{{trans('resource.role.description')}}</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {

      var buttons = [];
      buttons.push('<button onclick="urole.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("role_grid", buttons);
  });

   var urole = {

        add: function(){
          var postData = {};
          uPage.call('category/index',postData);
        },

        edit: function(gridId ,elmnt){

            var rowData = baseGridFunc.getRowData(gridId ,elmnt);

            var postData = {};
            postData['isEdit'] = true;
            postData['id'] = rowData.ca_id;

            uPage.call('category/index',postData);
        },

        save: function(){
            var data = $("#category_action_form").serializeObject();

            $.ajax({
                url: '/admin/category/save',
                type: "POST",
                dataType: "json",
                data : data,
                success: function(data){
                    if(data.type == 'success'){
                      alert(messages.saved);
                      uPage.close('window_roleList');
                      baseGridFunc.reload("category_grid");
                    }else{
                        uvalidate.setErrors(data);
                    }
                }
            });
        },

        remove: function(gridId ,elmnt){

          var rowData = baseGridFunc.getRowData(gridId ,elmnt);

          var postData = {};
          postData['id'] = rowData.ca_id;
          $.ajax({
              url: '/admin/category/remove',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                  if(data.type == 'success'){
                    alert(messages.removed);
                    baseGridFunc.reload("category_grid");
                  }
              }
          });
        },
        urlFormatter: function(data, type, row){
          var retVal = "";

          if(data == "#$cat$#"){
              retVal = categoryres.news;
          }else{
            retVal = data;
          }

          return retVal;
        },

        targetFormatter: function(data, type, row){
            var retVal = "";

            if(data == "_self"){
              retVal = categoryres.self;
            }else{
              retVal = categoryres.blank;
            }

            return retVal;
        },

        activeFlagFormatter: function(data, type, row){
          var retVal = "";

          if(data == 1){
            retVal = mainres.active;
          }else{
            retVal = mainres.deactive;
          }

          return retVal;
        }

   }
</script>
  @endsection
