
<ul class="list-unstyled">
    @foreach ($movies as $movie)
        {{--@php
            $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie->url&key=AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw&part=snippet,contentDetails,statistics,status";
            $json = file_get_contents($get_api_url);
            $getData = json_decode( $json , true);
            foreach((array)$getData['items'] as $key => $gDat){
	           $video_title = $gDat['snippet']['title'];
            }
        @endphp--}}

            <li class="media mb-3">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($movie->user->email,50) }}" alt="">
                    <div class="media-body">
                        @if($movie->user->channel_name)
                        <div>
                            {!! link_to_route('users.show',$movie->user->channel_name,['id'=>$movie->user->id]) !!}
                        </div>
                        @else
                        @endif
                        <div>
                            {!! link_to_route('users.show',$movie->user->name,['id'=>$movie->user->id]) !!}
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
                            <a href="{{ route('movies.select', ['id' => $movie->user->id, 'm_id' => $movie->id])}}">選択する？</a>
                        </div>
                        @if(Auth::check())
                            @include('user_follow.follow_button',['user'=>$movie->user])
                        @endif
                    </div>
            </li>

    @endforeach
</ul>
{{ $movies->render('pagination::bootstrap-4') }}


<h3>※選択された動画</h3>
<div class="video-wrap">
    <iframe width="200" height="112.5" src="{{ 'https://www.youtube.com/embed/'.$target_url }}?controls=1&loop=1&playlist={{ $target_url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

　　{!! Form::model($target_movie,['route'=>['movies.delete',$target_id]]) !!}
            {!! Form::submit('この動画を削除する？',['class'=>'btn btn-danger btn-lg d-block ml-3']) !!}

    {!! Form::close() !!}

</div>
