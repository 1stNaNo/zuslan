<!DOCTYPE html>
<html>
  @include('layouts.main.header')
	<body>
		<div class="body">
      <!-- HEADER -->
			<div class="row row-eq-height" style="padding : 10px; margin: 10px;">
        <div class="col-md-6">
            <div class="row">
              <div class="col-md-2">
                <img src="img/logo-niislel.gif" class="" style="max-width: 100%; height: auto;"/>
              </div>
              <div class="col-md-4 align-middle" style="height:100% !important">Нийслэлийн Байгаль орчны газар</div>
            </div>
        </div>
        <div class="col-md-6 align-right">
          Хайлт
        </div>
      </div>
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
