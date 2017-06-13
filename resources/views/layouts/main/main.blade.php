<!DOCTYPE html>
<html>
  @include('layouts.main.header')
	<body>
		<div class="body">
      <!-- HEADER -->
      <header id="header" data-plugin-options='{"stickyEnabled": false, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
        <div class="header-body">
          <div class="header-container container">
            <div class="header-row">
              <div class="header-column">
                <div class="header-logo">
                  <a href="/">
                    <img alt="" width="60" height="60" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="img/logo-niislel.gif">
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
                    <form id="searchForm" action="page-search-results.html" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control" name="q" id="q" placeholder="Хайлт..." required>
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
            <div class="menu-item">
              <img alt="" class="img-responsive" src="img/menu/zuslan.png">
              <div class="menu-title">Зуслан</div>
            </div>
            <div class="menu-item">
              <img alt="" class="img-responsive" src="img/menu/baigali_orchin.png">
              <div class="menu-title">Байгаль орчин</div>
            </div>
            <div class="menu-item">
              <img alt="" class="img-responsive" src="img/menu/uilchilgee.png">
              <div class="menu-title">Зуслангийн бүсэд төрөөс үзүүлэх үйлчилгээ</div>
            </div>
            <div class="menu-item">
              <img alt="" class="img-responsive" src="img/menu/hailt.png">
              <div class="menu-title">Хайлт</div>
            </div>
            <div class="menu-item menu-item-active">
              <img alt="" class="img-responsive" src="img/menu/tohijilt.png">
              <div class="menu-title">Тохижилт</div>
            </div>
            <div class="menu-item">
              <img alt="" class="img-responsive" src="img/menu/medlegt.png">
              <div class="menu-title">Таны мэдлэгт</div>
            </div>
          </div>
        </div>
      </div>

      <!-- SUBMENU -->
      <div class="row" style="background: #fff">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="owl-carousel owl-theme stage-margin" data-plugin-options='{"items": 3, "margin": 10, "loop": false, "nav": true, "dots": false, "stagePadding": 40}' style="margin-top: 20px;">

            <div class="menu-item-sub">
              <img alt="" class="img-responsive" src="img/submenu/baiguullagiin_tuhai.png">
              <div class="menu-title-sub">Байгууллагын тухай</div>
            </div>
            <div class="menu-item-sub">
              <img alt="" class="img-responsive" src="img/submenu/zuslangiin_bus.png">
              <div class="menu-title-sub">Зуслангын бүс</div>
            </div>
            <div class="menu-item-sub">
              <img alt="" class="img-responsive" src="img/submenu/aan_medeelel.png">
              <div class="menu-title-sub">Зуслангийн бүсэд үйл ажиллагаа эрхлэж буй ААН мэдээлэл</div>
            </div>

          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          @yield('content')
        </div>
      </div>
		</div>
	</body>
  @include('layouts.main.foot')
</html>
