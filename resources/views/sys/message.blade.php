@extends('layouts.admin')

@section('content')
<div id="window_clientsRegister" class="page-window">
  <input type="hidden" class="prev_window"/>
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
              </div>

              <h2 class="panel-title">{{trans('Chat')}}</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-3" style="border-right: solid 1px grey">
                  <div class="scrollable visible-slider" data-plugin-scrollable style="min-height: 60vh">
                    <div class="scrollable-content" style="padding: 0;">
                      <ul class="simple-user-list mb-xlg chat-thread">
  											@foreach ($thr_user as $item)
                          @php
                            $userIds = array_slice(explode(",", $item->user_ids), 0,4);
                            $userNames = "";
                            $orgNames = "";
                            for($i=0; $i < count($userIds); $i++){
                                $names = $users->where('user_id',$userIds[$i])->first();
                                if(!empty($names['name'])){
                                      $userNames .= $names['name'].',';
                                }

                                if(!empty($names['client_name'])){
                                  $orgNames .= $names['client_name'].',';
                                }
                            }
                          @endphp
                          <li class="pointer" onclick="umessage.show(this)" thread-id="{{$item->id}}">
                            <figure class="image rounded">
                                <span class="count" style="padding: 2px 5px; border-radius: 5px; background: #ad0000; color: #fff; display:none;">0</span>
                  					</figure>
                            <span class="title">{{(empty($item->name)) ? $userNames : $item->name}}</span>
                            <span class="message"> {{$orgNames}}</span>
                          </li>
  											@endforeach
  										</ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <div class="scrollable visible-slider msgContent" data-plugin-scrollable style="min-height: 60vh">
                    <div class="scrollable-content" style="padding: 0;" id="msgContent">

                    </div>
                  </div>
                  <input type="text" id="message" class="form-control" placeholder="Type here" style="border: solid 1px grey"/>
                    {{-- <div class="msgRow right">
                        <span class="user">qwje jkqwe jqjke qkjejkq</span><br/>
                        <span class="msg">21231231</span><br/>
                        <span class="date">21231231</span>
                    </div>
                    <div class="msgRow left">
                        <span class="user">qwje jkqwe jqjke qkjejkq</span><br/>
                        <span class="msg">21231231</span><br/>
                        <span class="date">21231231</span>
                    </div> --}}
                </div>
              </div>
            </div>
          </section>
      </div>
  </div>
  <script type="text/javascript">
      var socket = io (":6001");
      $(document).ready(function(){

          var userData = {};
          userData['user_id'] = {{\Auth::user()->user_id}};
          userData['name'] = '{{\Auth::user()->name}}';

          socket.emit('login', userData);

          socket.on('global',function(data){
            console.log(data);
          });

          socket.on('resetuser',function(data){

            console.log(data);

            $("#uChatUsers li").removeClass('status-online').addClass('status-offline');

            for(var key in data){
              $("#uChatUsers li[userid='"+ key +"']").removeClass('status-offline').addClass('status-online');
            }

          });

          socket.on('reconnect',function(){
            socket.emit('login', userData);
          });

          socket.on('message:{{\Auth::user()->user_id}}',function(data){

            if($("#msgContent").attr('thread-id') == data.thread_id){
                $("#msgContent").append(umessage.buildHtml(data));
            }else{
              var tmpElmnt = $(".chat-thread li[thread-id='"+ data.thread_id +"'] .count");
              var tmpCount = tmpElmnt.text();
              tmpCount = parseInt(tmpCount) + 1;

              tmpElmnt.text(tmpCount).show();
            }

            umessage.scrollBottom();
          });

          var thread_id = {{$thread_id}};
          if(thread_id != 0 ){
            umessage.show($(".chat-thread li[thread-id='"+ thread_id +"']"));
          }

          $("#message").on('keyup', function (e) {
              if (e.keyCode == 13) {
                  umessage.post();
              }
          });

      });

      var umessage = {
        show: function(elmnt){

          $(".chat-thread li").removeClass('selected');
          $(elmnt).addClass('selected');

          var postData = {};
          postData['thread_id'] = $(elmnt).attr("thread-id");

          $.ajax({
              url: '/messages/show',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){

                var tmphtml = '';

                for(var i=0; i < data.length; i++){
                    tmphtml += umessage.buildHtml(data[i]);
                }

                $("#msgContent").attr('thread-id',postData['thread_id']).html(tmphtml);

                umessage.scrollBottom();
              }
          });
        },

        post: function(){

          var postData = {};
          postData['thread_id'] = $(".chat-thread li.selected").attr("thread-id");
          postData['message'] = $("#message").val();

          $.ajax({
              url: '/messages/post',
              type: "POST",
              dataType: "json",
              data : postData,
              success: function(data){
                $("#message").val("");
              }
          });
        },

        buildHtml: function(data){

          var tmphtml = '';

          var side = 'left';
          if(data.sender_id  == usid){
              side = 'right'
          }
          tmphtml += '<div class="msgRow '+ side +'">';
          tmphtml += '<span class="user">'+ data.name +'</span><br/>';
          tmphtml += '<span class="msg">'+ data.message +'</span><br/>';
          tmphtml += '<span class="date">'+ data.created_at +'</span>';
          tmphtml += '</div>';

          return tmphtml;
        },

        scrollBottom: function(){
          $(".msgContent").nanoScroller();
          $(".msgContent").nanoScroller({ scroll: 'bottom' });
        }
      }
  </script>
</div>
@endsection
