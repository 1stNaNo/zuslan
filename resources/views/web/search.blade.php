@extends('layouts.main.main')

@section('content')
  <div class="col-md-2"></div>
  <div class="header-search col-md-8">
    <form id="searchForm" action="/listsearch" method="get">
      <div class="input-group">
        <input type="text" class="form-control" name="keyword" id="q" placeholder="Хайлт..." required>
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
  </div>
  <div class="col-md-2"></div>

@endsection
