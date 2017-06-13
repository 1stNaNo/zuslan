<h6>{{trans('resource.users')}}</h6>
<ul>
@foreach ($users as $item)
    @if($item->user_id != \Auth::user()->user_id)
        <li class="pointer status-offline" userid="{{$item->user_id}}" onclick="window.location.href='/messages?reciever_id={{$item->user_id}}'">
            <figure class="profile-picture">
              <img src="/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
            </figure>
            <div class="profile-info">
              <span class="name">{{$item->name}}</span>
              @php
                $info = $infoUsers->where('user_id',$item->user_id)->first();
              @endphp
              <span class="title">{{$info->client_name}}</span>
            </div>
        </li>
    @endif
@endforeach
</ul>
