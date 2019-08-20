@extends('layouts.app')

@section('content')
        @if($user->top_image_url)
            <img id="change" class="rounded img-fluid" src="{{ Storage::url($user->top_image_url) }}" width="1000px" height="200px" style="width:100%; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
        @endif
        <li class="media">
            @if($user->icon_image_url)
                <img class="rounded img-fluid" src="{{ Storage::url($user->icon_image_url) }}" width="50px" height="50px">
            @else
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
            @endif
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
        </li>
            @if(Auth::check())
                @include('user_follow.follow_button',['user'=>$user])
            @endif
        <h1>{{ $user->channel_name }}</h1>
        <div class="col-sm-8">
            @include('users.navtabs',['user'=>$user])

            @include('movies.movies_all', ['user'=>$user,'movies' => $movies])
        </div>

        <h2>お気に入りワード：{{ $favorite_word }}</h2>

        @foreach($videos as $video)
            <iframe width="200" height="112.5" src="{{ 'https://www.youtube.com/embed/' . $video['id']['videoId'] }}" allowfullscreen></iframe>
            <div>{{ $video['snippet']['title'] }}</div>
        @endforeach
@endsection