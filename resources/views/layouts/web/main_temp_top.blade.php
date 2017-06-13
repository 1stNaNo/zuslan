<header id="header" class="header-narrow header-full-width" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 65, "stickySetTop": "-170px", "stickyChangeLogo": true}'>
  <div class="header-body">
    <div class="header-container container">
      <div class="header-row">
        <div class="header-search hidden-xs">
          <form id="searchForm" action="/listsearch" method="get">
            <div class="input-group">
              <input type="text" class="form-control" name="keyword" id="q" placeholder="{{trans('resource.search')}}..." required>
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        </div>
        <nav class="header-nav-top">
          <ul class="nav nav-pills">
            {{-- <li class="hidden-xs">
              <a href=""><i class="fa fa-angle-right"></i> Бидний тухай</a>
            </li> --}}
            <li class="hidden-xs">
              <a href="/complaints"><i class="fa fa-angle-right"></i> {{trans('resource.complaints')}}</a>
            </li>
            {{-- <li class="hidden-xs">
              <span class="ws-nowrap"><i class="fa fa-phone"></i> 99******</span>
            </li> --}}
            <li>
              <a href="#" class="dropdown-menu-toggle" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img src="/img/blank.gif" class="flag flag-{{($cur_lang->lang_key == 'en') ? 'us' : $cur_lang->lang_key}}" alt="" /> {{$cur_lang->lang_name}}
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
                @foreach($langs as $l)
                <li><a href="" onclick="$.get('/changeLang/{{$l->lang_key}}', null, function(){ location.reload() })"><img src="/img/blank.gif" class="flag flag-{{($l->lang_key == 'en') ? 'us' : $l->lang_key}}" alt="" /> {{$l->lang_name}}</a></li>
                @endforeach
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <div class="header-row" style="background: url('{{$banner->value}}') no-repeat; background-size: 100%;">
        <div class="header-column">
          <div class="headLogoCont">
            <div class="header-logo">
              <a href="/">
                <img alt="Асгат" width="82" height="82" src="/img/asgat_logo.png">
              </a>
            </div>
            <div class="logoDescripion">
              <p class="logoText">{{$title->title}}</p>
              <p class="logoTag">{{$title->body}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="header-row">
        <div class="header-column">
          <div class="header-row">
            <div class="header-nav">
              <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                <i class="fa fa-bars"></i>
              </button>
              <ul class="header-social-icons social-icons hidden-xs">
                <li class="social-icons-facebook"><a href="{{$fb->link}}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li class="social-icons-twitter"><a href="{{$tw->link}}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              </ul>
              <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                <nav>
                  <ul class="nav nav-pills" id="mainNav">
                    @php
                      $allcat = clone $categories;
                      $tmp_allcat = clone $categories;
                    @endphp
                    @foreach($allcat->where('parent_id', 0)->get() as $category)
                      @php
                        $tmp = clone $tmp_allcat;

                        $url = '';
                        if($category->url == '#$cat$#'){
                          $url = '/category/'.$category->ca_id;
                        }else{
                          $url = $category->url;
                        }
                      @endphp
                      @if(count($tmp->where('parent_id', $category->ca_id)->get()) != 0)
                        <li class="dropdown"><a href="{{$url}}" target="{{$category->target}}" class="dropdown-toggle"> {{$category->source}} </a>
                      @else
                        <li class="dropdown"><a href="{{$url}}" target="{{$category->target}}"> {{$category->source}} </a>
                      @endif

                      {{getSource($category, clone $categories)}}
                      <li>
                    @endforeach
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-row">
        @include('layouts.web.shorter')
      </div>
    </div>
  </div>
  @php
    function getSource($c, $tmp_allcats){
      $subcats = clone $tmp_allcats;
      $tmp_subcats = clone $tmp_allcats;
      $cats = $tmp_allcats->where('parent_id', $c->ca_id)->get();
      if(count($cats) != 0){
        echo '<ul class="dropdown-menu">';
        foreach($cats as $cat){

          $url = '';
          if($cat->url == '#$cat$#'){
            $url = '/category/'.$cat->ca_id;
          }else{
            $url = $cat->url;
          }

          if(count($subcats->where('parent_id', $cat->ca_id)->get()) != 0){
            echo '<li class="dropdown-submenu"><a href="'.$url.'" target="'.$cat->target.'">'.$cat->source.'</a>';
            getSource($cat, $tmp_subcats);
          }else{
            echo '<li><a href="'.$url.'" target="'.$cat->target.'">'.$cat->source.'</a>';
          }
          echo '</li>';
        }
        echo '</ul>';
      }

    }
  @endphp

</header>
