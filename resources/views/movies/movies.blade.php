
<ul class="list-unstyled">
    @foreach ($users as $user)
        @php
            $movie=$user->movies->last();
        @endphp

        @if($movie)
            {{--@php
            $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie->url&key=AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw&part=snippet,contentDetails,statistics,status";
            $json = file_get_contents($get_api_url);
            $getData = json_decode( $json , true);
            foreach((array)$getData['items'] as $key => $gDat){
	           $video_title = $gDat['snippet']['title'];
            }
            @endphp--}}

            <li class="media mb-3">
                 @if($user->icon_image_url)
                    <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="50px" height="50px">
                 @else
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email,50) }}" alt="">
                 @endif
                    <div class="media-body">
                        @if($user->channel_name)
                        <div>
                            {!! link_to_route('users.show',$user->channel_name,['id'=>$user->id]) !!}
                        </div>
                        @else
                        @endif
                        <div>
                            {!! link_to_route('users.show',$user->name,['id'=>$user->id]) !!}
                        </div>
                        <div>
                            <div class="video-wrap">
                                <iframe width="200" height="112.5" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            @if($movie->title)
                                <p class="mb-0">{!! nl2br(e($movie->title)) !!}</p>
                            @elseif(isset($video_title))
                                <p class="mb-0">{!! nl2br(e($video_title)) !!}</p>
                            @else
                                <p class="mb-0">タイトルがありません</p>
                            @endif
                        </div>
                        @if(Auth::check())
                            @include('user_follow.follow_button',['user'=>$user])
                        @endif
                    </div>
            </li>

        @else
            <li class="media mb-3">
                 @if($user->icon_image_url)
                    <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="50px" height="50px">
                 @else
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email,50) }}" alt="">
                 @endif
                    <div class="media-body">
                        @if($user->channel_name)
                        <div>
                            {!! link_to_route('users.show',$user->channel_name,['id'=>$user->id]) !!}
                        </div>
                        @else
                        @endif
                        <div>
                            {!! link_to_route('users.show',$user->name,['id'=>$user->id]) !!}
                        </div>
                        <p class="mb-0">※動画は登録されていません</p>
                        @if(Auth::check())
                            @include('user_follow.follow_button',['user'=>$user])
                        @endif
            </li>
        @endif

    @endforeach
</ul>
{{ $users->render('pagination::bootstrap-4') }}