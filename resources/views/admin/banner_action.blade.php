
<div id="window_bannerRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('resource.banner.banner')}}</h2>
            </header>
            <div class="panel-body">
              <form action="" id="bannerRegister_form" class="form-horizontal form-bordered" enctype="multipart/form-data">

                <input type="hidden" name="id" value="{{ (count($banner) > 0) ? $banner->banner_id : ''}}"/>

                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-6">
                    <img id="holder" src="{{ (count($banner) > 0) ? $banner->value : '' }}" style="width: 325px; height: 78px;"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">{{trans('resource.weblinks.img')}}</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <input class="form-control" id="thumbnail" type="text" name="img_hidden" value="{{ (count($banner) > 0) ? $banner->value : '' }}"/>
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
                      <button type="button" class="btn btn-primary" onclick="ubanner.save();">{{trans('resource.buttons.save')}}</button>
                      <button type="button" class="btn" onclick="uPage.close('window_bannerRegister')">{{trans('resource.buttons.close')}}</button>
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
