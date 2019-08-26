<section class="clearfix">
<div class="semicolon">”</div>
<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row d-flex mt-5 text-center">
    @foreach ($users as $key => $user)
        @php
            $movie=$user->movies->last();
        @endphp

        @if($loop->iteration % 3 == 1 && $loop->iteration != 1)
            @php
                echo '</div><div class="row text-center mt-3">';
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
                }
            @endphp
        @endif
            <li class="col-lg-4 mb-5 list-unstyled">
                <div class="wrapper text-left d-inline-block">
                <div class="name">
                 @if($user->icon_image_url)
                    <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="50px" height="50px">
                 @else
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email,50) }}" alt="">
                 @endif

                        @if($user->channel_name)

                            {!! link_to_route('users.show',$user->channel_name,['id'=>$user->id],['class'=>'']) !!}

                            <div class="text-right">
                            ＠{!! link_to_route('users.show',$user->name,['id'=>$user->id],['class'=>'']) !!}
                            </div>

                        @else

                            {!! link_to_route('users.show',$user->name,['id'=>$user->id],['class'=>'']) !!}

                            <div>
                                <br>
                            </div>

                        @endif
                </div>
                        <div class="movie">
                            <div class="video-wrap movie">
                                @if($movie)
                                <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/'.$movie->url }}?controls=1&loop=1&playlist={{ $movie->url }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/' }}?controls=1&loop=1&playlist=" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @php
                                        $video_title="※動画が未登録　or　一時的な情報制限中";
                                    @endphp
                                @endif
                            </div>
                                <p class="video_title mb-0">
                                    @if(isset($movie->title))
                                        {!! nl2br(e($movie->title)) !!}
                                    @elseif(isset($video_title))
                                        {!! nl2br(e($video_title)) !!}
                                    @else
                                        ※動画が未登録　or　一時的な情報制限中
                                    @endif
                                </p>
                        </div>
                        @if(Auth::check())
                            @include('user_follow.follow_button',['user'=>$user])
                        @endif
                </div>
            </li>

    @endforeach
</div>

<div class="text-center mb-5">
    {{ $users->render('pagination::bootstrap-4') }}
</div>

</section>