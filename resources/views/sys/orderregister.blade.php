<div id="window_orderregister" class="page-window active-window">
  <input type="hidden" class="prev_window"/>
  <form action="/sys/order/save" id="orderregister_form" class="form-horizontal form-bordered">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <div class="panel-actions">
              <a class="panel-action panel-action-toggle" href="#" data-panel-toggle=""></a>
              <a class="panel-action panel-action-dismiss" href="#" data-panel-dismiss=""></a>
            </div>
            <h2 class="panel-title">Захиалга бүртгэл</h2>
          </header>

          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="panel-group" id="accordion">
                  @php
                    $i = 0;
                    $types_child = clone $types;
                    $types_subchild = clone $types;
                  @endphp
                  @foreach($types->where('parent_id', 0)->get() as $type)
                    <div class="panel panel-accordion">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$type->id}}One">
                            {{$type->name}}
                          </a>
                        </h4>
                      </div>
                      <div id="collapse{{$type->id}}One" class="accordion-body collapse">
                        <div class="panel-body">
                          @php
                            if(count($types_child->where('parent_id', $type->id)->get()) != 0){
                              drawChildAccordion($type, $types_child, $products, $units);
                            }
                          @endphp
                        </div>
                      </div>
                    </div>
                  @php $i++; @endphp
                  @endforeach
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 form-group">
                <button class="btn pull-right" type="button" onclick="uPage.close('window_orderregister')">Хаах</button>
                <button class="btn btn-primary pull-right" type="button" onclick="continueOrder()">Үргэлжлүүлэх</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  </form>
  <script>
    function continueOrder(){
      var checkErr = false;
      $('#window_orderregister').find('.product_size').each(function(i, v){

          $(this).find('.product_size_sub').each(function(){
            if($(this).val().length > 0){
              checkErr = true;
            }
          });

      });

      if(checkErr){
        uPage.call('/sys/orderconf');
      }else{
        umsg.error('Мэдээлэл оруулна уу!');
      }
    }
  </script>
</div>

@php
  function drawChildAccordion($type, $types, $products, $units){
    $type_subchilds = clone $types;
    echo '<div id="#collapse'.$type->id.'One" class="panel-group">';
    foreach($types->where('parent_id', $type->id)->get() as $t){
      echo '<div class="panel panel-accordion"><div class="panel-heading"><h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse'.$t->parent_id.'One" href="#collapse'.$t->id.'One">'
              .$t->name.
            '</a></h4></div><div id="collapse'.$t->id.'One" class="accordion-body collapse"><div class="panel-body">';
      if(count($types->where('parent_id', $t->id)->get()) == 0){
        drawProducts($t->id, $products, $units);
      }else{
        drawChildAccordion($t, $types, $products, $units);
      }
      echo '</div></div></div>';
    }
    echo '</div>';
  }

  function drawProducts($type_id, $products, $units){
    foreach($products->where('cat', $type_id)->get() as $p){
      echo '<div class="form-group">
              <div class="col-md-4">
                <input class="form-control" type="text" name="product" disabled="true" value="'.$p->name.'"/>
              </div>
              <div class="col-md-1">
                <select id="unit_id" name="unit_id" class="uselect2 unit_id" style="width:100%">';
                  foreach($units->where('product_id', $p->id)->get() as $u){
                      echo '<option value="'.$u->master_id.'">'.$u->unit_name.'</option>';
                  }
                echo '</select>
              </div>';
              if($p->split == 0){
                echo '<div class="col-md-3">
                  <div class="product_size">
                    <input class="product_size_sub form-control" type="text" name="product_size" value="" placeholder="Тоо хэмжээ"/>
                    <input class="is_split" type="hidden" name="is_split" value="'.$p->split.'" id="is_split"/>
                    <input class="product_id" type="hidden" name="product_id" value="'.$p->id.'"/>
                  </div>
                </div>';
              }
        echo '</div>';

        if($p->split == 1){
          echo '<div class="product_size form-group">
            <input class="is_split" type="hidden" name="is_split" id="is_split" value="'.$p->split.'" id="is_split"/>
            <input class="product_id" type="hidden" name="product_id" value="'.$p->id.'"/>';
            for($i = 1; $i < 6; $i++){
              echo '<div class="col-md-2">'.$i.' өдөр<input class="product_size_sub form-control" type="text" name="product_size" value="" placeholder="Тоо хэмжээ"/></div>';
            }
          echo '</div>';
        }
    }
  }
@endphp
