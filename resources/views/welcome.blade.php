@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
            <div class="text-center">
                <h1>YouTubeまとめ×コミュニケーション</h1>
            </div>
        </div>
    @if(Auth::check())
        <a href="{{ route('users.show',['id'=>Auth::id()]) }}"><img class="mr-2 rounded" src="{{ Gravatar::src(Auth::user()->email, 50) }}" alt=""></a>
        {{ Auth::user()->name }}
    @else
    @endif
    @include('movies.movies', ['users'=>$users])
@endsection