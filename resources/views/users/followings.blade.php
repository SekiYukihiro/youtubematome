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

            @if(Auth::check())
                @include('user_follow.follow_button',['user'=>$user])
            @endif

        <h1>{{ $user->channel_name }}</h1>

            @include('users.navtabs',['user'=>$user])

            @include('movies.movies', ['users'=>$users,'movies' => $movies])

@endsection