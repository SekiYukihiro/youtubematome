<div class="movies row d-flex mt-5 text-center">
@foreach ($movies as $key => $movie)

        @if($loop->iteration % 3 == 1 && $loop->iteration != 1)
            @php
                echo '</div><div class="row text-center d-flex mt-3">';
            @endphp
        @endif

        @if($movie)

            @php
                $api = "AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw";
                $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie->url&key=$api&part=snippet,contentDetails,statistics,status";
                $json = @file_get_contents($get_api_url);

                if($json){
                    $getData = json_decode( $json , true);
                    foreach((array)$getData['items'] as $key => $gDat){
	                    $video_title = $gDat['snippet']['title'];
                    }
                }else{
                    $video_title="※一時的な情報制限中です";
                }
            @endphp

        @endif

        <li class="col-lg-4 mb-5 list-unstyled">

            <div class="wrapper text-left d-inline-block">

                <div class="movie">

                    <div class="video-wrap movie">
                        @if($movie)
                            <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/' }}?controls=1&loop=1&playlist=" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @php
                                $video_title="※動画が未登録です";
                            @endphp
                        @endif
                    </div>

                    <p class="video_title mb-0">
                        @if(isset($movie->title))
                            {!! nl2br(e($movie->title)) !!}
                        @elseif(isset($video_title))
                            {!! nl2br(e($video_title)) !!}
                        @else
                            ※動画が未登録です
                        @endif
                    </p>

                    <a href="{{ route('movies.select', ['id' => $movie->user->id, 'm_id' => $movie->id])}}">選択する？</a>

                </div>

            </div>

        </li>

    @endforeach

</div>

<div class="text-center mb-5">
    {{ $movies->render('pagination::bootstrap-4') }}
</div>


<div class="row mt-0 d-flex text-center">

    <li class="col-lg-4 mb-5 list-unstyled">

        <h3 class="selected text-left d-inline-block">※選択された動画</h3>

        <div class="wrapper text-left d-inline-block">

            <div class="movie">

                <div class="video-wrap movie">
                    @if($target_url)

                        @php
                            $api = "AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw";
                            $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$target_url&key=$api&part=snippet,contentDetails,statistics,status";
                            $json = @file_get_contents($get_api_url);

                            if($json){
                                $getData = json_decode( $json , true);
                                foreach((array)$getData['items'] as $key => $gDat){
                                    $video_title = $gDat['snippet']['title'];
                                }
                            }else{
                                $video_title="※一時的な情報制限中です";
                            }
                        @endphp

                        <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/'.$target_url }}?controls=1&loop=1&playlist={{ $target_url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    @else

                        <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/' }}?controls=1&loop=1&playlist=" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @php
                            $video_title="※動画が未登録です";
                        @endphp

                    @endif
                </div>

                <p class="video_title mb-0">
                    @if(isset($movie->title))
                        {!! nl2br(e($movie->title)) !!}
                    @elseif(isset($video_title))
                        {!! nl2br(e($video_title)) !!}
                    @else
                        ※動画が選択されていません
                    @endif
                </p>

            </div>

            {!! Form::model($target_movie,['route'=>['movies.delete',$target_id]]) !!}
                {!! Form::submit('この動画を削除する？',['class'=>'button btn btn-danger w-100']) !!}
            {!! Form::close() !!}

        </div>

    </li>

</div>