<aside class="sidebar">

  {{-- <hr style="margin: 8px 0;"/> --}}

  {{-- video widget --}}
  <object data="{{$video->link}}" width="320" height="215"></object>

  {{-- most viewed , most commented, last new  --}}
  <div class="tabs mb-xlg">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#latestPosts" data-toggle="tab" class="font12">{{trans('resource.latestNews')}}</a></li>
      <li><a href="#viewedPosts" data-toggle="tab" class="font12">{{trans('resource.most_viewed')}}</a></li>
      <li><a href="#commentPosts" data-toggle="tab" class="font12">{{trans('resource.most_comment')}}</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="latestPosts">
        <ul class="simple-post-list">
          @foreach ($latest as $item)
            <li>
              <div class="post-image">
                <div class="img-thumbnail">
                  <a href="/post/{{$item->id}}">
                    <img src="{{$item->thumbnail}}" alt="" style="height: 50px; width: 50px;">
                  </a>
                </div>
              </div>
              <div class="post-info">
                <a href="/post/{{$item->id}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->title}}</div></a>
                <div class="post-meta">
                   {{$item->update_date}}
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="tab-pane" id="viewedPosts">
        <ul class="simple-post-list">
          @foreach ($viewed as $item)
            <li>
              <div class="post-image">
                <div class="img-thumbnail">
                  <a href="/post/{{$item->id}}">
                    <img src="{{$item->thumbnail}}" alt="" style="height: 50px; width: 50px;">
                  </a>
                </div>
              </div>
              <div class="post-info">
                <a href="/post/{{$item->id}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->title}}</div></a>
                <div class="post-meta">
                   {{$item->update_date}}
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="tab-pane" id="commentPosts">
        <ul class="simple-post-list">
          @foreach ($comment as $item)
            <li>
              <div class="post-image">
                <div class="img-thumbnail">
                  <a href="/post/{{$item->id}}">
                    <img src="{{$item->thumbnail}}" alt="" style="height: 50px; width: 50px;">
                  </a>
                </div>
              </div>
              <div class="post-info">
                <a href="/post/{{$item->id}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->title}}</div></a>
                <div class="post-meta">
                   {{$item->update_date}}
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="tabs mb-xlg">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#sumsLink" data-toggle="tab" class="font12">{{trans('resource.weblinks.sums')}}</a></li>
      <li><a href="#agentLink" data-toggle="tab" class="font12">{{trans('resource.weblinks.agency')}}</a></li>
      <li><a href="#otherLink" data-toggle="tab" class="font12">{{trans('resource.weblinks.others')}}</a></li>
    </ul>
    <div class="nano" style="height: 200px;">
      <div class="nano-content">
        <div class="tab-content">
          <div class="tab-pane active" id="sumsLink">
                <ul class="simple-post-list">
                  @foreach ($weblinks->where('category_id', 1) as $item)
                    <li>
                      <div class="post-image">
                        <div class="img-thumbnail">
                          <a href="{{$item->link}}">
                            <img src="{{$item->img}}" alt="" style="height: 50px; width: 50px;">
                          </a>
                        </div>
                      </div>
                      <div class="post-info">
                        <a href="{{$item->link}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->source}}</div></a>
                      </div>
                    </li>
                  @endforeach
                </ul>
          </div>
          <div class="tab-pane" id="agentLink">
              <ul class="simple-post-list">
                @foreach ($weblinks->where('category_id', 2) as $item)
                  <li>
                    <div class="post-image">
                      <div class="img-thumbnail">
                        <a href="{{$item->link}}">
                          <img src="{{$item->img}}" alt="" style="height: 50px; width: 50px;">
                        </a>
                      </div>
                    </div>
                    <div class="post-info">
                      <a href="{{$item->link}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->source}}</div></a>
                    </div>
                  </li>
                @endforeach
              </ul>
          </div>
          <div class="tab-pane" id="otherLink">
                <ul class="simple-post-list">
                  @foreach ($weblinks->where('category_id', 3) as $item)
                    <li>
                      <div class="post-image">
                        <div class="img-thumbnail">
                          <a href="{{$item->link}}">
                            <img src="{{$item->img}}" alt="" style="height: 50px; width: 50px;">
                          </a>
                        </div>
                      </div>
                      <div class="post-info">
                        <a href="{{$item->link}}"><div style="overflow: hidden; height: 50px; font-size: 12px;line-height: 18px;">{{$item->source}}</div></a>
                      </div>
                    </li>
                  @endforeach
                </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h4 class="heading-primary">{{trans('resource.viewfile')}}</h4>
  <blockquote class="with-borders">
    <ul style="list-style: none; padding-left: 0;">
    @foreach($filetypes as $filetype)
      <li class="file-item">
        <a href="/file/{{$filetype->ft_id}}">
          <i class="fa fa-{{$filetype->icon}}" style="cursor: pointer;"></i>
          <label style="cursor: pointer;">{{$filetype->source}}</label>
          <input type="hidden" value="{{$filetype->ft_id}}" name="type_id"/>
        </a>
      </li>
    @endforeach
    </ul>
  </blockquote>
  <iframe id="forecast_embed" type="text/html" frameborder="0" height="270" width="260" src="http://tsag-agaar.gov.mn/embed/?name={{$weather[0]->link}}&color=ef6e25&color2=cc530e&color3=ffffff&color4=ffffff&type=vertical&tdegree=cwidth=270"> </iframe>
  <!-- POLL START -->
  @if(!empty($poll))
  {{ csrf_field() }}
  <blockquote class="blockquote-secondary">
    <h6 class="heading-primary">{{trans('resource.polling')}}</h6>
  </blockquote>
  <blockquote class="with-borders">
    <blockquote class="">
      <h6 class=""><strong>{{$poll->source}}</strong></h6>
    </blockquote>
    <div id="poll-list">
    @foreach($answers as $a)
      @if(Session::get('poll'))
        <div><label class="rd-label">{{$a->source}}</label>&nbsp;-&nbsp;<label class="rd-label pull-right">{{$a->total}}</label></div>
      @else
        <div class="radio"><label><input type="radio" name="answer" value="{{$a->id}}"> {{$a->source}}</label></div>
      @endif
    @endforeach
    </div>
    @if(!Session::get('poll'))
    <button class="btnPollSubmit btn btn-borders btn-default mr-xs mb-sm" type="button" onclick="submitpoll({{$poll->id}})">{{trans('resource.poll.givepoll')}}</button>
    @endif
  </blockquote>
  @endif
  <!-- POLL END -->
</aside>

<script>

$(document).ready(function(){
  $(".nano").nanoScroller();
});

function submitpoll(poll_id){
    if($("[name=answer]").val() != undefined && $("[name=answer]").val() != null){
        $.post("/submitpoll", {'answer_id': $("[name=answer]:checked").val(), 'poll_id' : poll_id, '_token' : $("[name='_token']").val()}, function(data){
            $obj = "";
            $.each(data, function(i, v){
                $obj += '<div><label class="rd-label">'+v.source+'</label>&nbsp;-&nbsp;<label class="rd-label pull-right" >'+v.total+'</label></div>';
            });
            $(".btnPollSubmit").remove();
            $("#poll-list").html($obj);
            refreshPollDashboard();
        });
    }
}
</script>
