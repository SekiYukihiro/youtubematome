@extends('layouts.app')

@section('content')


            @include('users.user_top',['user'=>$user])

            @include('users.navtabs',['user'=>$user])

            @include('movies.movies_all', ['user'=>$user,'movies' => $movies])


@if($favorite_word)
    <h4 class="okiniiri mb-5">お気に入りワード<span class="favorite_word pl-3">"{{ $favorite_word }}"</span></h4>
@else
    <h4 class="okiniiri mb-5">お気に入りワード<span class="favorite_word pl-3">"未登録です"</span></h4>
@endif

@if($videos)

    <div class="row d-flex text-center">

        @foreach ($videos as $video)
            <li class="col-lg-4 mb-5 list-unstyled">

                <div class="wrapper text-left d-inline-block">
                    <div class="movie">

                        <div class="video-wrap movie">
                            <iframe width="300" height="168.75" src="{{ 'https://www.youtube.com/embed/'.$video['id']['videoId'] }}?controls=1&loop=1&playlist={{ $video['id']['videoId'] }}" frameborder="0"  allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>

                        <p class="video_title mb-0">
                            @if(isset($movie->title))
                                {!! nl2br(e($movie->title)) !!}
                            @elseif(isset($video['snippet']['title']))
                                {!! nl2br(e($video['snippet']['title'])) !!}
                            @else
                                ※動画が未登録です
                            @endif
                        </p>

                    </div>
                </div>

            </li>
        @endforeach

    </div>

@endif


@endsection