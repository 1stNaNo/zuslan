<rss version="2.0">
<channel>
 <title>{{trans('resource.logoText')}}</title>
 <description>{{ url('') }} RSS</description>
 <link>{{ url('') }}</link>



    @foreach($news as $item)
      <item>
        <title>{{$item->title}}</title>
         <description>{{url(''.$item->thumbnail)}}</description>
        <link>{{ url('/post/'.$item->id) }}</link>
        <pubDate>{{$item->insert_date}}</pubDate>
      </item>
    @endforeach



</channel>
</rss>
