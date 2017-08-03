@extends('layouts.main.main')

@section('content')
<div class="col-md-2"></div>
<div class="blog-posts col-md-8">

    <article class="post">

      <!-- <div class="post-image">

      </div> -->

      <!-- <section class="page-header"> -->
        <div class="container">
          <div class="row">
            <div class="col-md-6" style="padding:0 !important">
              <h2 style="color: black; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;">{{$news->title}}</h2>
            </div>
          </div>
        </div>
      <!-- </section> -->

      <div class="post-content">
        <div class="post-meta">
          <span><i class="fa fa-comments"></i> {{$news->comment_count}}</span>
          <span><i class="fa fa-eye"></i> {{$news->views}}</span>
          <span><a href="/category/{{$news->cat_id}}" class="text-decoration-none"><i class="fa fa-tag"></i> {{$news->ca_title}}</a></span>
          <span class="pull-right"><i class="fa fa-calendar-check-o"></i> {{\Carbon\Carbon::parse($news->insert_date)->format('Y-m-d')}}</span>
        </div>
      </div>

      <hr class="tall">
      <!-- POST BODY -->
      <div class="post-content">

        <img class="img-responsive pull-left" src="{{$news->thumbnail}}" alt="" style="width: 600px !important; margin: 20px !important;">
        {!!$news->source!!}
      </div>

      <a href="#" onclick="window.open( 'https://www.facebook.com/sharer.php?caption=&description={{$news->title}}&u={{Request::url()}}&picture={{url($news->thumbnail)}}', 'Facebook' ,'height=500,width=500'); return false"><i class="fa fa-facebook"></i><span class="mb-pt-hide">- share</span></a>

      <!-- COMMENT START -->
      <div class="post-block post-comments clearfix">
        <h3 class="heading-primary"><i class="fa fa-comments"></i>{{trans('resource.comments')}} ({{$news->comment_count}})</h3>

        <ul class="comments">
          @foreach($comments as $c)
          <li>
            <div class="comment">
              <div class="img-thumbnail">
                <img class="avatar" alt="" src="/img/avatar-2.jpg">
              </div>
              <div class="comment-block">
                <div class="comment-arrow"></div>
                <span class="comment-by">
                  <strong>{{$c->name}}</strong>
                </span>
                <p>{{$c->comment}}</p>
                <span class="date pull-right">{{\Carbon\Carbon::parse($c->insert_date)->format('Y-m-d')}}</span>
              </div>
            </div>
          </li>
          @endforeach
        </ul>

      </div>

      <!-- COMMENT END -->
      <!-- LEAVE COMMENT START-->
      <div class="post-block post-leave-comment">
        {{-- <h3 class="heading-primary">Сэтгэгдэл үлдээх</h3> --}}

        <form action="/savecomment" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="post_id" value="{{$news->id}}"/>
          <div class="row">
            <div class="form-group">
              <div class="col-md-6">
                <label>{{trans('resource.name')}} *</label>
                <input type="text" value="" maxlength="100" class="form-control" name="name" id="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-md-12">
                <label>{{trans('resource.comment')}} *</label>
                <textarea maxlength="5000" rows="10" class="form-control" name="comment" id="comment"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input type="submit" value="{{trans('resource.post')}}" class="btn btn-primary btn-lg" data-loading-text="Уншиж байна...">
            </div>
          </div>
        </form>
      </div>
      <!-- LEAVE COMMENT END -->

    </article>

</div>
@endsection
