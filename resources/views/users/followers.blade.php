@extends('layouts.app')

@section('content')
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