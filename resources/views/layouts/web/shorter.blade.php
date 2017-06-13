<div class="latest_newsarea">
  <span>{{trans('resource.shorter')}}</span>
  <ul id="ticker01" class="news_sticker" style="display:none">
    @foreach($model as $item)
        <li><a href="{{$item->url}}" target="_{{$item->target}}">{{$item->source}}</a></li>
    @endforeach
  </ul>
</div>
