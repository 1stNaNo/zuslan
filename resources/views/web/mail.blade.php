@extends('layouts.main.main')

@section('content')
  <div class="col-md-2"></div>
  <div class="header-search col-md-8">
    <h2 class="mb-sm mt-sm">Өргөдөл гомдол</h2>
    <form id="complaintsForm" action="/sendmail" method="POST" enctype="multipart/form-data">
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
          <input type="file" name="pics[]" id="picField" multiple accept="image/*">
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <input type="submit" value="Илгээх" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading...">
        </div>
      </div>

    </form>
  </div>
  <div class="col-md-2"></div>
@endsection
