@extends('layouts.main.main')

@section('content')

<div class="row">
  <div class="col-md-12">
    MAP
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="row">
      <div class="feature-box">
        <!-- ICON -->
        <div class="feature-box-icon">
          <i class="fa fa-star"></i>
        </div>
        <div class="feature-box-info">
        <!-- TITLE -->
          <div class="heading heading-secondary heading-border heading-bottom-border">
            <h1 class="heading-quaternary">
              <strong>Шинэ</strong> мэдээ
            </h1>
          </div>

        </div>

        <div class="owl-carousel owl-theme stage-margin owl-loaded owl-drag owl-carousel-init" data-plugin-options='{"items": 2, "margin": 10, "loop": true, "nav": true, "dots": true, "stagePadding": 40}'>
          @foreach($news as $n)
          <div>
            <a class="text-decoration-none block-link pt-md" href="/post/{{$n->id}}">
              <span class="thumb-info thumb-info-centered-info">
                <span class="thumb-info-wrapper">
                  <img alt="" class="img-responsive img-rounded" src="{{$n->thumbnail}}">
                  <span class="thumb-info-title">
                    <span class="thumb-info-inner">
                      <i class="fa fa-commenting-o"></i> {{$n->comment_count}} &nbsp; &nbsp; <i class="fa fa-eye"></i> {{$n->views}}
                    </span>
                  </span>
                  <span class="thumb-info-action">
                  </span>
                </span>
              </span>
              <p style="white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word; ">{{$n->title}}</p>
            </a>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  <!-- LASTEST NEWS END -->
    <hr>
  <!-- MOST VIEW NEWS START -->
    <div class="row">
      <div class="feature-box">
        <!-- ICON -->
        <div class="feature-box-icon">
          <i class="fa fa-eye"></i>
        </div>
        <div class="feature-box-info">
        <!-- TITLE -->
          <div class="heading heading-secondary heading-border heading-bottom-border">
            <h1 class="heading-quaternary">
              Их <strong>уншсан</strong>
            </h1>
          </div>

        </div>

        <div class="owl-carousel owl-theme stage-margin owl-loaded owl-drag owl-carousel-init" data-plugin-options='{"items": 2, "margin": 10, "loop": true, "nav": true, "dots": true, "stagePadding": 40}'>
          @foreach($viewnews as $n)
          <div>
            <a class="text-decoration-none block-link pt-md" href="/post/{{$n->id}}">
              <span class="thumb-info thumb-info-centered-info">
                <span class="thumb-info-wrapper">
                  <img alt="" class="img-responsive img-rounded" src="{{$n->thumbnail}}">
                  <span class="thumb-info-title">
                    <span class="thumb-info-inner">
                      <i class="fa fa-commenting-o"></i> {{$n->comment_count}} &nbsp; &nbsp; <i class="fa fa-eye"></i> {{$n->views}}
                    </span>
                  </span>
                  <span class="thumb-info-action">
                  </span>
                </span>
              </span>
              <p style="white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word; ">{{$n->title}}</p>
            </a>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
