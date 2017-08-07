<form class="cmxform" id="ContactForm" method="post" action="">
  {{ csrf_field() }}
  <label>Гарчиг:</label>
  <input type="text" name="ContactEmail" id="ContactEmail" value="" class="form_input" />

  <textarea name="ContactComment" id="ContactComment" class="form_textarea textarea required" rows="" cols="" style="height:200px;"></textarea>
  <img src="images/A_blank_flag.png"  class="contactImg" onclick="testShareSheet(this)"/>

  <button type="button" onclick="sendContact(); return false;" name="submit" class="form_submit" id="submit">Илгээх</button>
  <label id="loader" style="display:none;"><img src="images/loader.gif" alt="Loading..." id="LoadingGraphic" /></label>
</form>
