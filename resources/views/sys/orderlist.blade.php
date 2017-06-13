@extends('layouts.admin')

@section('content')
<div id="window_orderList" class="page-window active-window">
  <section class="panel">
  	<header class="panel-heading">
  		<div class="panel-actions">
  			<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
  			<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
  		</div>

  		<h2 class="panel-title">{{trans('resource.category.title')}}</h2>
  	</header>
  	<div class="panel-body">
  		<div class="row">
  			<div class="col-sm-6">
  				<div class="mb-md">
  					<button onclick="uPage.call('/sys/orderregister', null); return false;" class="btn btn-primary">{{trans('resource.buttons.add')}} <i class="fa fa-plus"></i></button>
  				</div>
  			</div>
      </div>
      <div class="grid-body">
        <div style="display: none;" class="ucolumn-cont" data-table="order_grid" rowclick="onClickRow.callop">
          <ucolumn name="id" source="id" visible="false"></ucolumn>
          <ucolumn name="client_id" source="client_id" visible="false"></ucolumn>
          <ucolumn name="name" source="name"></ucolumn>
          <ucolumn name="username" source="username"></ucolumn>
          <ucolumn name="insert_date" source="insert_date"></ucolumn>
          <ucolumn name="comment" source="comment"></ucolumn>
        </div>
        <table action="/sys/order/data" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="order_grid" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Байгууллага</th>
              <th>Хэрэглэгч</th>
              <th>Огноо</th>
              <th>Тайлбар</th>
            </tr>
          </thead>
        </table>
      </div>
      <hr class="tall">
      <div class="row">
        <div id="show-op-container">

        </div>
      </div>
  	</div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {

      var buttons = [];
      // buttons.push('<button onclick="ucategory.add()" class="btn btn-primary" style="margin-left:12px">{{trans('resource.buttons.add')}}</button>');

      baseGridFunc.init("order_grid", buttons);
  });

</script>
  @endsection
