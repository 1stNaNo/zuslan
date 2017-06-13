@extends('layouts.main.main')

@section('content')

    <script>

      $(document).ready(function(){
        rss();
      });

      function rss(){

        $.ajax({
            url: '/external',
            type: 'GET',
            dataType: 'HTML',
            success: function(data){
              $("#externalCont").html(data);
              $("#externalCont").owlCarousel('destroy');
              $("#externalCont").owlCarousel(
                {"items": 3, "margin": 10, "loop": true, "nav": true, "dots": false, "navText": ""}
              );
            },
            error: function(data){
              console.log(data);
            }
        });

      }

    </script>

  @foreach ($data as $item)
    <div class="single_category wow fadeInDown">
      <div class="category_title">
        <a href="/category/{{$item[0]->cat_id}}">{{$item[0]->ca_title}}</a>
      </div>
      <div class="single_category_inner">
        <ul class="catg_nav">
          @foreach($item as $news)
            @if(!$loop->parent->first)
              @if($loop->index < 2)
                <li>
                  <div class="catgimg_container">
                    <a class="catg1_img" href="/post/{{$news->id}}">
                      <img src="{{$news->thumbnail}}" alt="img">
                      </a>
                  </div>
                  <a class="catg_title" href="/post/{{$news->id}}"> {{$news->title}}</a>
                  <div class="sing_commentbox">
                    <p><i class="fa fa-calendar"></i>{{$news->insert_date}}</p>
                    <a href="/post/{{$news->id}}"><i class="fa fa-comments"></i>{{$news->comment_count}} {{trans('resource.comments')}}</a>
                  </div>
                </li>
              @endif
            @else
              <li>
                <div class="catgimg_container">
                  <a class="catg1_img" href="/post/{{$news->id}}">
                    <img src="{{$news->thumbnail}}" alt="img">
                    </a>
                </div>
                <a class="catg_title" href="/post/{{$news->id}}"> {{$news->title}}</a>
                <div class="sing_commentbox">
                  <p><i class="fa fa-calendar"></i>{{$news->insert_date}}</p>
                  <a href="/post/{{$news->id}}"><i class="fa fa-comments"></i>{{$news->comment_count}} {{trans('resource.comments')}}</a>
                </div>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  @endforeach

  <h4>{{trans('resource.sums_news')}}</h4>
  <div class="owl-carousel owl-theme show-nav-title" data-plugin-options='{"items": 3, "margin": 10, "loop": false, "nav": true, "dots": false}' id="externalCont">

  </div>

  <div class="row">
    <div class="col-md-6">
      <article class="post post-tp-5">
        <h5 class="title-5">{{trans('resource.decision.menu')}}</h5>
          <figure>
              <div id="pie">
                  <div id="pieChartContainer" style="max-width: 800px; margin: 0 auto"></div>
              </div>
          </figure>
      </article>
    </div>
    <div class="col-md-6">
      <h5 class="title-5">{{trans('resource.polling')}}</h5>
      <div id="pie">
          <div id="pieChartContainerPoll" style="max-width: 800px; margin: 0 auto"></div>
      </div>
    </div>
  </div>

  <script>

  $(function () {

      $.post("/complaintInfo", {'_token' : $('[name="_token"]').val()}, function(data){

          var unsolved = 0;
          var solvedpositive = 0;
          var solvednegative = 0;
          $.each(data, function(i, v){
              if(v['type'] == 0){
                  unsolved += 1;
              }else{
                  if(v['kind'] == 2)
                      solvednegative += 1;
                  else
                      solvedpositive += 1;
              }
          });

          var data = [
              {name : '{!! trans('resource.decision.undone') !!}', value : unsolved},
              {name : '{!! trans('resource.decision.negative') !!}', value : solvednegative},
              {name : '{!! trans('resource.decision.positive') !!}', value : solvedpositive}
          ]

          $("#pieChartContainer").dxPieChart({
              dataSource: data,
              series: {
                  argumentField: 'name',
                  valueField: 'value',
                  type: 'doughnut',
                  label: {
                      visible: true,
                      connector: { visible: true },
                      format: {
                          type: 'largeNumber',
                          precision: 0
                      }
                  }
              },
              palette: 'Ocean',
              adaptiveLayout: {
                  width: 300
              },
              legend: {
                  horizontalAlignment: 'center',
                  verticalAlignment: 'bottom'
              }

          });



      });

  });

  $(function () {
      refreshPollDashboard();
  });

  function refreshPollDashboard(){
    $.post("/pollInfo", {'_token' : $('[name="_token"]').val()}, function(data){


        var chartData = [];

        $.each(data, function(i, v){
            var tmpObj = {};
            tmpObj['name'] = v.source;
            tmpObj['value'] = v.total;
            console.log(tmpObj);
            chartData.push(tmpObj);
        });

        console.log(chartData);

        $("#pieChartContainerPoll").dxPieChart({
            dataSource: chartData,
            series: {
                argumentField: 'name',
                valueField: 'value',
                type: 'doughnut',
                label: {
                    visible: true,
                    connector: { visible: true },
                    format: {
                        type: 'largeNumber',
                        precision: 0
                    }
                }
            },
            palette: 'Ocean',
            adaptiveLayout: {
                width: 300
            },
            legend: {
                horizontalAlignment: 'center',
                verticalAlignment: 'bottom'
            }

        });



    });
  }
  </script>

@endsection
