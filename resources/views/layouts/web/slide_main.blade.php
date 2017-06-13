<div class="thumbnail_slider_area">
  <div class="owl-carousel owl-theme full-width" data-plugin-options='{"items": 3, "loop": true, "nav": true, "dots": false}'>
    @foreach($slidernews as $sn)
      <div class="signle_iteam">
        <img src="{{$sn->thumbnail}}" alt="img" style="height: 245px">
        <div class="sing_commentbox slider_comntbox">
          <p><i class="fa fa-calendar"></i>{{$sn->insert_date}}&nbsp;&nbsp;<a href="#"><i class="fa fa-comments"></i> {{$sn->comment_count}} {{trans('resource.comments')}}</a></p>
        </div>
        <a class="slider_tittle" href="/post/{{$sn->id}}">{{$sn->title}}</a>
      </div>
      @endforeach
  </div>
<div class="thumbnail_slider_area">
