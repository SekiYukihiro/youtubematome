@extends('layouts.app')

@section('content')
        @if($user->top_image_url)
            <div class="mb-4">
                <img id="change" class="rounded img-fluid" src="{{ Storage::url($user->top_image_url) }}" style="width:1200px; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
            </div>
        @endif
            <div class="text-right">
            @if($user->icon_image_url)
                <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="80px" height="80px">
            @else
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 80) }}" alt="">
            @endif
                        {{ $user->name }}
            </div>

        <div class="mt-2">
            @if(Auth::check())
                @include('user_follow.follow_button',['user'=>$user])
            @endif
        </div>

        @if($user->channel_name)
            <div class="row">
                <h2 class="channel_name mt-3 col-12">{{ $user->channel_name }}</h1>
            </div>
        @endif

            @include('users.navtabs',['user'=>$user])

            @include('movies.movies_all', ['user'=>$user,'movies' => $movies])


        <h4 class="okiniiri">お気に入りワード<span class="favorite_word pl-3">"{{ $favorite_word }}"</span></h4>

@if($videos)
<div class="row d-flex mt-5  text-center">
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
                                        ※動画が未登録　or　一時的な情報制限中
                                    @endif
                            </p>
                    </div>
                </div>
            </li>

    @endforeach
</div>
@endif


@endsection