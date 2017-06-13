
<div id="window_weblinkRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.news.title')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="weblinkRegister_form" class="form-horizontal form-bordered">
                <input type="hidden" name="id" value="{{ (count($weblinks) > 0) ? $weblinks->id : ''}}"/>
                @foreach($langs as $lang)
                      <div class="form-group">
                        <label class="col-md-3 control-label">{{trans('resource.weblinks.title')}} {{$lang->lang_name}}</label>
                        <div class="col-md-6">
                          <input class="form-control" type="text" name="title[{{$lang->lang_key}}]" value="{{ (count($source->get($lang->lang_key)) > 0) ? $source->get($lang->lang_key)->source : '' }}"/>
                        </div>
                      </div>
                @endforeach
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.weblinks.category')}}</label>
                  <div class="col-md-6">
                    <select name="category_id">
                      @if(count($weblinks) > 0)
                          <option {{($weblinks->category_id == 1) ? 'selected="selected"' : ''}} value="1">{{trans('resource.weblinks.sums')}}</option>
                          <option {{($weblinks->category_id == 2) ? 'selected="selected"' : ''}} value="2">{{trans('resource.weblinks.agency')}}</option>
                          <option {{($weblinks->category_id == 3) ? 'selected="selected"' : ''}} value="3">{{trans('resource.weblinks.others')}}</option>
                      @else
                        <option value="1">{{trans('resource.weblinks.sums')}}</option>
                        <option value="2">{{trans('resource.weblinks.agency')}}</option>
                        <option value="3">{{trans('resource.weblinks.others')}}</option>
                      @endif
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.weblinks.link')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="link" value="{{ (count($weblinks) > 0) ? $weblinks->link : '' }}"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.weblinks.img')}}</label>
                  <div class="col-md-6">
                    <img src="{{ (count($weblinks) > 0) ? $weblinks->img : '' }}" style="width: 115px; height: 85px;" id="holder"/>
                    <div class="input-group">
                      <input class="form-control" id="thumbnail" type="text" name="img_hidden" value="{{ (count($weblinks) > 0) ? $weblinks->img : '' }}"/>
                      <div class="spinner-buttons input-group-btn">
                          <span class="btn btn-default" id="lfm" data-input="thumbnail" data-preview="holder">
                               <i class="fa fa-file-picture-o"></i>
                          </span>
                      </div>
                    </div>
                    <input type="file" name="img" style="display:none"/>
                  </div>
                </div>
                <div class="form-group usticky" style="background: #fff;">
                  <div class="col-md-12">
                    <div style="float: right;">
                      <button type="button" class="btn btn-primary" onclick="uweblinks.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_weblinkRegister')">{{trans('resource.buttons.close')}}</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
      </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#lfm').filemanager('image', {prefix: route_prefix});
    });
  </script>
</div>
