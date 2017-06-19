<ul class="features_list_detailed">

   @foreach ($vw_news as $item)
     <li>
       <div class="feat_small_icon" style="width: auto;">
         <img src="{{ url($item->thumbnail) }}" alt="" title="" />
       </div>
       <div class="feat_small_details" style="width: 98%;">
         <h4 style="color: #000;">{{$item->title}}</h4>
         <p style="color: #000;">{{$item->insert_date}}</p>
         <div style="color: #000;" id="newsData">{!!$item->source!!}</div>
       </div>
     </li>
   @endforeach

</ul>
