@foreach ($response as $item)
  @foreach ($item->channel->item as $news)
    <div class="owl-item cloned" style="margin-right: 10px;"><div>
        <a class="text-decoration-none block-link pt-md" href="{{$news->link}}" target="_blank">
          <span class="thumb-info thumb-info-centered-info">
            <span class="thumb-info-wrapper">
              <img alt="" class="img-responsive img-rounded" src="{{$news->description}}" style="height: 150px;">
              <span class="thumb-info-title">
                <span class="thumb-info-inner">
                  {{$news->author}}
                </span>
              </span>
              <span class="thumb-info-action">
              </span>
            </span>
          </span>
          <p class="sumsTitle">
                {{$news->title}}
          </p>
          <p style="font-weight: bold;">{{$news->pubDate}}</p>
        </a>
      </div>
    </div>
  @endforeach
@endforeach
