 @if($menu == 1)
   <div style="width: auto; height: 30px; overflow-y: hidden; overflow-x: scroll;">
     <div id="newsMenu">
       <span onclick="getNews(0)" style="float: left; padding: 0 10px; font-size: 16px;border-right: solid 1px grey; color: #20c456">Бүгд</span>
       @foreach($vw_category as $item)
         @if($item->url == '#$cat$#')
           <span onclick="getNews({{$item->ca_id}})" style="float: left; padding: 0 10px; font-size: 16px;border-right: solid 1px grey; color: #20c456">{{$item->source}}</span>
         @endif
       @endforeach
     </div>
   </div>
<div id="newsCont">
 @endif

   <ul class="features_list_detailed">

       @foreach ($vw_news as $item)
         <li>
           <div class="feat_small_icon" style="width: auto;">
             <img src="{{ url($item->thumbnail) }}" alt="" title="" />
           </div>
           <div class="feat_small_details">
             <h4>{{$item->title}}</h4>
             <p>{{$item->insert_date}}</p>
             <a href="#" onclick="newsDetail({{$item->id}})" class="button_small">Цааш үзэх</a>
           </div>
         </li>
       @endforeach

   </ul>
@if($menu == 1)
 </div>
 @endif
