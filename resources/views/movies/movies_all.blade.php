
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
                    <div class="media-body">
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
                    </div>
            </li>

    @endforeach
</ul>
{{ $movies->render('pagination::bootstrap-4') }}