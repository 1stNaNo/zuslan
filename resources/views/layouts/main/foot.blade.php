<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="contact-details">
          <h4>Холбоо барих</h4>
          <ul class="contact">
            <li><p><i class="fa fa-map-marker"></i> <strong>Хаяг:</strong> 1234 Street Name, City Name, United States</p></li>
            <li><p><i class="fa fa-phone"></i> <strong>Утас:</strong> (123) 456-789</p></li>
            <li><p><i class="fa fa-envelope"></i> <strong>Цахим шуудан:</strong> <a href="mailto:mail@example.com">mail@example.com</a></p></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <h4>Биднийг дагах</h4>
        <ul class="social-icons">
          <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
          <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
          <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h4>Хандалтын тоо</h4>
        <ul class="contact">
          <li><p><i class="fa fa-eye"></i> <strong>Нийт:</strong> {{ Counter::showAndCount('home') }} </p></li>
          <li><p><i class="fa fa-eye"></i> <strong>Энэ 7 хоног:</strong> {{ Counter::showAndCount('home') }} </p></li>
          <li><p><i class="fa fa-eye"></i> <strong>Өнөөдөр:</strong> {{ Counter::showAndCount('home') }} </p></li>
        </ul>
      </div>
      <div class="col-md-3">
        <div class="contact-details">
          <h4>Санал хүсэлт</h4>
          <form method="post" action="/complaints/save">
            <ul class="contact">
              <li><p><strong>Нэр:</strong> <input type="text" class="form-control" name="name"></p></li>
              <li><p><strong>И-мэйл:</strong> <input type="text" class="form-control" name="email"></p></li>
              <li><p><strong>Санал хүсэлт:</strong> <textarea row="4" class="form-control" name="bodytext" style="resize:none;"></textarea></p></li>
              <li><button type="submit" class="btn btn-primary">Илгээх</button></li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-1">
          <a href="index.html" class="logo">

          </a>
        </div>
        <div class="col-md-7">
          <p>© 2017. УЛААНБААТАР ХОТ. Нийслэлийн Байгаль орчны газар</p>
        </div>
        <div class="col-md-4">
          <nav id="sub-menu">

          </nav>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Vendor -->

<!-- Theme Base, Components and Settings -->
<script src="/js/theme.js"></script>

<!-- Current Page Vendor and Views -->

<script src="/js/views/view.home.js"></script>

<!-- Theme Custom -->
<script src="/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/js/theme.init.js"></script>
