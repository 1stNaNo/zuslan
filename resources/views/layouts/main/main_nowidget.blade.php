<!DOCTYPE html>
<html>
  @include('layouts.main.header')
	<body>
		<div class="body">
      <!-- HEADER -->
      <header id="header" class="hidden-xs" data-plugin-options='{"stickyEnabled": false, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
        <div class="header-body">
          <div class="header-container container">
            <div class="header-row">
              <div class="header-column">
                <div class="header-logo">
                  <a href="/">
                    <img alt="" width="100" height="100" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="/img/logo-niislel.gif">
                  </a>
                </div>
                <div class="logoDescripion">
                  <p class="logoTag">Нийслэлийн Байгаль</p>
                  <p class="logoTag">орчны газар</p>
                </div>
              </div>
              <div class="header-column">
                <div class="header-row">
                  <div class="header-search hidden-xs">
                    <form id="searchForm" action="/listsearch" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control" name="keyword" id="q" placeholder="Хайлт..." required>
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                      </div>
                    </form>
                  </div>

                </div>
                <div class="header-row">
                  <div class="header-nav">
                    <ul class="header-social-icons social-icons hidden-xs">
                      <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                      <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                      <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- MENU -->
      <div class="row" style="background: #20c456">
        <div class="col-md-12">
          <div class="owl-carousel owl-theme stage-margin" data-plugin-options='{"items": 6, "margin": 10, "loop": true, "nav": true, "dots": false, "stagePadding": 40}' style="margin-top: 20px;">
            @php
              $chk = clone $subcategories;
              $tmpchk = null;
            @endphp
            @foreach($categories->get() as $c)
              @php $tmpchk = clone $chk; @endphp
              @if(count($tmpchk->where('parent_id',$c->ca_id)->get()) == 0)
                @if($c->url == '#$cat$#')
                <a target="{{$c->target}}" href="/category/{{$c->ca_id}}" style="text-decoration: none;">
                @else
                <a target="{{$c->target}}" href="{{$c->url}}" style="text-decoration: none;">
                @endif
              @else
                <a target="{{$c->target}}" href="#" onclick="showSubMenu({{$c->ca_id}})" style="text-decoration: none;">
              @endif
              <div class="menu-item">
                <img alt="" class="img-responsive" src="/{{$c->img}}">
                <div class="menu-title">{{$c->source}}</div>
              </div>
            </a>
            @endforeach
          </div>
        </div>
      </div>

      <!-- SUBMENU -->
      <div class="row" style="background: #fff; display:none;" id="sub-menu-container">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="owl-carousel owl-theme stage-margin" data-plugin-options='{"items": 3, "margin": 10, "loop": false, "nav": true, "dots": false, "stagePadding": 40}' style="margin-top: 20px;">
            @foreach($subcategories->get() as $sc)
              @if($sc->url == '#$cat$#')
              <a target="{{$sc->target}}" href="/category/{{$sc->ca_id}}" style="text-decoration: none;">
              @else
              <a target="{{$sc->target}}" href="{{$sc->url}}" style="text-decoration: none;">
              @endif
              <div class="menu-item-sub sub-item-{{$sc->parent_id}}">
                <img alt="" class="img-responsive" src="/{{$sc->img}}">
                <div class="menu-title-sub">{{$sc->source}}</div>
              </div>
            </a>
            @endforeach

          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          @yield('map')
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          @yield('content')
        </div>
      </div>
		</div>
	</body>
  <script>
   function showSubMenu(parent_id){
     $('.menu-item-sub').parent().hide();
     $('#sub-menu-container').slideDown('fast');
     $('.sub-item-'+parent_id).parent().fadeIn('fast');
   }
  </script>
  @include('layouts.main.foot')
</html>
