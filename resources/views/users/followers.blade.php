@extends('layouts.app')

@section('content')
        @if($user->top_image_url)
            <img id="change" class="rounded img-fluid" src="{{ Storage::url($user->top_image_url) }}" width="1000px" height="200px" style="width:100%; height:200px; object-fit:cover; object-position:0% {{ $user->top_trim }}%;">
        @endif
        <li class="media">
            <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
        </li>

        <h1>{{ $user->channel_name }}</h1>
        <div class="col-sm-8">
            @include('users.navtabs',['user'=>$user])

            @include('movies.movies', ['users'=>$users,'movies' => $movies])
        </div>
@endsection