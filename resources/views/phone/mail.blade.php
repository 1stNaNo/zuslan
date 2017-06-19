  <div class="col-md-2"></div>
  <div class="header-search col-md-8">
    <h2 class="mb-sm mt-sm">Өргөдөл гомдол</h2>
    <form id="complaintsForm" data-ajax="false" action="http://192.168.0.103:8000/sendmail" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="form-group">
          <div class="col-md-12">
            <label>Гарчиг *</label>
            <input type="text" value="" data-msg-required="Гарчиг оруулна уу" maxlength="100" class="form-control" name="title" id="title" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-12">
            <textarea maxlength="5000" data-msg-required="{{trans('resource.enterComplaints')}}" rows="10" class="form-control" name="message" id="message" required></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">Зураг хавсаргах </div>
        <div class="col-md-10">
          <img id="tempPic" src=""/>
          <input type="button" name="pics[]" onclick="uploadImage()" id="picField" multiple accept="image/*"/>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-lg mb-xlg">Илгээх</button>
        </div>
      </div>

    </form>
  </div>
  <div class="col-md-2"></div>
  <script type="text/javascript">

    var allImg = [];
  
    function uploadImage(){
      navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
        destinationType: Camera.DestinationType.DATA_URL,
        sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY
      });
    }



    function onSuccess(imageData) {
        console.log(imageData);
        var image = document.getElementById('tempPic');
        image.src = "data:image/jpeg;base64," + imageData;
    }

    function onFail(message) {
        alert('Failed because: ' + message);
    }

      function sendEmail(){

        var data = $("#complaintsForm").serialize();
        console.log(data);
        $.ajax({
            url: 'http://192.168.0.103:8000/sendmail',
            type: 'GET',
            dataType: "json",
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function(data){
                $("#complaintsForm").reset();
            },
            error: function(error){
              console.log(JSON.stringify(error));
            }
        });
      }
  </script>
